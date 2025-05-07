<?php
include 'db.php';

// Ensure necessary columns exist
$columnsToCheck = [
    'expiry_date' => "ALTER TABLE establishments ADD COLUMN expiry_date DATE AFTER application_date",
    'file' => "ALTER TABLE establishments ADD COLUMN file VARCHAR(255)",
    'image' => "ALTER TABLE establishments ADD COLUMN image VARCHAR(255)"
];

foreach ($columnsToCheck as $col => $alterQuery) {
    $check = $conn->query("SHOW COLUMNS FROM establishments LIKE '$col'");
    if ($check->num_rows == 0) {
        $conn->query($alterQuery);
    }
}

function getStatusClass($status) {
    return match ($status) {
        'Pending' => 'warning',
        'Approved' => 'success',
        'Rejected' => 'danger',
        default => 'secondary'
    };
}

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$barangay = isset($_GET['barangay']) ? $_GET['barangay'] : '';
$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$where = "WHERE 1=1";
$params = [];
$types = "";

if (!empty($search)) {
    $where .= " AND (name LIKE ? OR type_of_occupancy LIKE ? OR owner LIKE ? OR address LIKE ? OR hazard_type LIKE ? OR barangay LIKE ?)";
    $params = array_fill(0, 6, '%' . $search . '%');
    $types = "ssssss";
}
if (!empty($barangay)) {
    $where .= " AND barangay = ?";
    $params[] = $barangay;
    $types .= "s";
}

$totalResults = 0;
$totalPages = 0;
$apps = [];

if (!empty($barangay)) {
    $stmt = $conn->prepare("SELECT COUNT(*) as total FROM establishments $where");
    if (!empty($params)) $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $totalResults = $result['total'];
    $totalPages = ceil($totalResults / $limit);

    $query = "SELECT * FROM establishments $where LIMIT ?, ?";
    $params[] = $offset;
    $params[] = $limit;
    $types .= "ii";

    $stmt = $conn->prepare($query);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $apps = $stmt->get_result();
}
?>
<?php
include 'db.php'; // Database connection

$barangay = isset($_GET['barangay']) ? $_GET['barangay'] : '';
$single_record = false;

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare a SQL query to select a specific record filtered by barangay
    $sql = "SELECT * FROM inspector_checklist WHERE id = ? AND barangay_assigned = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $id, $barangay); // "i" for integer id, "s" for string barangay
    $stmt->execute();
    $result_single = $stmt->get_result();
    $record = $result_single->fetch_assoc();
    $single_record = true;
} else {
    // Fetch list of submissions filtered by barangay if available
    if (!empty($barangay)) {
        $sql = "SELECT id, created_at, business_name FROM inspector_checklist WHERE barangay_assigned = ? ORDER BY id DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $barangay);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        // Fetch all if no barangay filter
        $sql = "SELECT id, created_at, business_name FROM inspector_checklist ORDER BY id DESC";
        $result = $conn->query($sql);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard with Barangay Folder Grid</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <style>
    @media print {
      .no-print {
        display: none !important;
      }
    }

    body { overflow-x: hidden; font-family: Arial, sans-serif; }
    .folder {
      text-align: center;
      padding: 20px;
      border: 1px solid #dee2e6;
      border-radius: 12px;
      background: linear-gradient(145deg, #ffffff, #e6e6e6);
      margin-bottom: 20px;
      box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.1), -4px -4px 8px rgba(255, 255, 255, 0.7);
      transition: transform 0.3s, box-shadow 0.3s;
    }
    .folder:hover {
      transform: translateY(-8px);
      box-shadow: 6px 6px 12px rgba(0, 0, 0, 0.15), -6px -6px 12px rgba(255, 255, 255, 0.8);
      background-color: #f1f1f1;
    }
    .folder-icon {
      font-size: 50px;
      color: #007bff;
      margin-bottom: 10px;
    }
    .folder-title {
      font-size: 18px;
      font-weight: bold;
      color: #333;
    }
    .expired-row { background-color: #f8d7da !important; }
    td:nth-child(6) { max-width: 250px; white-space: normal; word-break: break-word; }
    .table th, .table td { text-align: center; vertical-align: middle; }
    .table th { background-color: #343a40; color: white; }
    .image-thumbnail { max-width: 100px; max-height: 100px; object-fit: cover; cursor: pointer; }

    /* Responsive Design */
    @media (max-width: 768px) {
      .folder {
        padding: 15px;
      }
      .folder-icon {
        font-size: 40px;
      }
      .folder-title {
        font-size: 16px;
      }
    }

    .table {
      border-collapse: collapse;
      margin: 20px 0;
      font-size: 16px;
      min-width: 100%;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
    }

    .table th, .table td {
      padding: 12px 15px;
      text-align: center;
      vertical-align: middle;
    }

    .table th {
      background-color: #343a40;
      color: #ffffff;
      font-weight: bold;
    }

    .table-hover tbody tr:hover {
      background-color: #f1f1f1;
    }

    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
    }

    .btn-primary:hover {
      background-color: #0056b3;
      border-color: #004085;
    }

    .btn-success {
      background-color: #28a745;
      border-color: #28a745;
    }

    .btn-success:hover {
      background-color: #218838;
      border-color: #1e7e34;
    }
    
  </style>
</head>
<body>

<div class="container py-4">
  <!-- Folder Grid Section -->
  <div class="container py-4">
    <?php if (empty($barangay)): ?>
      <div class="row mb-4">
        <div class="col-md-6 offset-md-3 d-flex">
          <input type="text" id="searchInput" class="form-control me-2" placeholder="Search Barangay..." onkeyup="filterBarangays()">
          <button class="btn btn-primary" onclick="filterBarangays()">Search</button>
        </div>
      </div>

      <div class="row g-3" id="barangayContainer">
        <?php
        $brgyResult = $conn->query("SELECT * FROM barangays ORDER BY barangay_name ASC");
        while ($row = $brgyResult->fetch_assoc()):
            $brgy = $row['barangay_name'];
        ?>
          <div class="col-md-3 barangay-folder" data-name="<?= strtolower($brgy) ?>">
            <a href="?barangay=<?= urlencode($brgy) ?>" class="text-decoration-none text-dark">
              <div class="folder">
                <div class="folder-icon">📁</div>
                <h5 class="folder-title"><?= htmlspecialchars($brgy) ?></h5>
              </div>
            </a>
          </div>
        <?php endwhile; ?>
      </div>

      <!-- No results message -->
      <div class="row mt-3" id="noResultsMessage" style="display: none;">
        <div class="col text-center">
          <p class="text-muted">No matching barangays found.</p>
        </div>
      </div>
    <?php endif; ?>
  </div>

  <?php if (!empty($barangay)): ?>
    <?php if ($single_record): ?>
      <!-- Single Record View -->
      <div class="center-title">
        <h2>FIRE SAFETY INSPECTION CHECKLIST</h2>
        <p>FOR SMALL/GENERAL BUSINESS ESTABLISHMENT</p>
      </div>
      <!-- Add your single record display logic here -->
    <?php else: ?>
      <!-- List View -->
      <button class="print-button no-print btn btn-success mb-3" onclick="window.print()">🖨️ Print Record</button>

      <?php if ($result->num_rows > 0): ?>
        <div class="table-responsive">
          <table class="table table-bordered table-hover">
            <thead class="table-dark">
              <tr>
                <th>ID</th>
                <th>Business Name</th>
                <th>Date Submitted</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                  <td><?= htmlspecialchars($row['id']) ?></td>
                  <td><?= htmlspecialchars($row['business_name']) ?></td>
                  <td><?= htmlspecialchars(date("F j, Y", strtotime($row['created_at']))) ?></td>
                  <td><a href="print.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">View & Print</a></td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      <?php else: ?>
        <p class="text-center text-muted">No checklist submissions found.</p>
      <?php endif; ?>
    <?php endif; ?>
  <?php endif; ?>
</div>

<!-- Filter Script -->
<script>
  function filterBarangays() {
    const input = document.getElementById('searchInput').value.toLowerCase();
    const barangays = document.querySelectorAll('.barangay-folder');
    let anyVisible = false;

    barangays.forEach(folder => {
      const name = folder.getAttribute('data-name');
      if (name.includes(input)) {
        folder.style.display = 'block';
        anyVisible = true;
      } else {
        folder.style.display = 'none';
      }
    });

    document.getElementById('noResultsMessage').style.display = anyVisible ? 'none' : 'block';
  }
</script>

</body>
</html>