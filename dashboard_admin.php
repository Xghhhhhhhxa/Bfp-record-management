<?php
// Include database connection
include 'db.php';

// Function to fetch total users count
function getTotalUsers($conn) {
    $sqlUsers = "SELECT COUNT(*) AS total_users FROM users";
    $resultUsers = $conn->query($sqlUsers);
    $rowUsers = $resultUsers->fetch_assoc();
    return $rowUsers['total_users'];
}

// Function to fetch active users count
function getActiveUsers($conn) {
    $sqlActiveUsers = "SELECT COUNT(*) AS active_users FROM users WHERE status = 'active'";
    $resultActiveUsers = $conn->query($sqlActiveUsers);
    $rowActiveUsers = $resultActiveUsers->fetch_assoc();
    return $rowActiveUsers['active_users'];
}

// Function to fetch total establishments count
function getTotalEstablishments($conn) {
    $sql = "SELECT COUNT(*) AS total_establishments FROM establishments";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['total_establishments'];
}

// Function to get all users with roles
function getAllUsersWithRoles($conn) {
    $users = [];
    $sql = "
        SELECT 
            u.id, 
            u.fullname, 
            u.username, 
            u.status, 
            u.role_id,
            u.created_at, 
            r.name AS role_name 
        FROM users u 
        LEFT JOIN roles r ON u.role_id = r.id
        ORDER BY u.created_at DESC
    ";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
    }
    return $users;
}

// Handle update user
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $roleId = $_POST['role_id'];
    $status = $_POST['status'];

    $sqlUpdate = "UPDATE users SET fullname = ?, username = ?, role_id = ?, status = ? WHERE id = ?";
    if ($stmt = $conn->prepare($sqlUpdate)) {
        $stmt->bind_param("ssssi", $fullname, $email, $roleId, $status, $userId);
        if ($stmt->execute()) {
            echo "<script>alert('User updated successfully'); window.location.href = 'adsb.php';</script>";
        } else {
            echo "<script>alert('Error updating user'); window.location.href = 'adsb.php';</script>";
        }
    }
}

// Handle delete user
if (isset($_GET['delete_id'])) {
    $userId = $_GET['delete_id'];
    $sqlDeleteAssignments = "DELETE FROM inspector_barangay_assignments WHERE inspector_id = ?";
    if ($stmt = $conn->prepare($sqlDeleteAssignments)) {
        $stmt->bind_param("i", $userId);
        $stmt->execute();
    }

    $sqlDeleteUser = "DELETE FROM users WHERE id = ?";
    if ($stmt = $conn->prepare($sqlDeleteUser)) {
        $stmt->bind_param("i", $userId);
        if ($stmt->execute()) {
            echo "<script>alert('User deleted successfully'); window.location.href = 'adsb.php';</script>";
        } else {
            echo "<script>alert('Error deleting user'); window.location.href = 'adsb.php';</script>";
        }
    }
}

// Data for dashboard
$totalUsers = getTotalUsers($conn);
$activeUsers = getActiveUsers($conn);
$totalEstablishments = getTotalEstablishments($conn);
$users = getAllUsersWithRoles($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <style>
    body {
      overflow-x: hidden;
      font-family: 'Arial', sans-serif;
    }
    .sidebar {
      height: 100vh;
      background-color: #343a40;
      padding-top: 1rem;
      transition: all 0.3s ease;
      width: 250px;
      position: fixed; /* Fix the sidebar to the left */
      top: 0;
      left: 0;
      overflow-y: auto; /* Allow scrolling if content exceeds height */
    }
    .main-content {
      margin-left: 250px; /* Offset the main content by the sidebar width */
      padding: 20px;
      flex-grow: 1;
    }
    .sidebar a {
      color: #ddd;
      display: block;
      padding: 10px 20px;
      text-decoration: none;
      transition: background-color 0.3s ease;
    }
    .sidebar a:hover {
      background-color: #495057;
      color: #fff;
    }
    .sidebar-collapsed {
      width: 0 !important;
      overflow: hidden;
      padding: 0 !important;
    }
    .sidebar-collapsed a {
      display: none;
    }
  </style>
</head>
<body>
<div class="d-flex">
  <!-- Sidebar -->
<?php include 'sidebar.php'; ?>

  <!-- Main Content -->
  <div class="main-content">
    <nav class="navbar navbar-expand navbar-light bg-light">
      <div class="container-fluid">
        <!-- Sidebar Toggle Button -->
        <button class="btn btn-outline-secondary me-3 d-md-none" id="toggleSidebar">
          <i class="fas fa-bars"></i>
        </button>
        <a class="navbar-brand" href="#">Dashboard</a>
        <div class="ms-auto dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="userMenu" role="button" data-bs-toggle="dropdown">
            <i class="fas fa-user-circle fa-lg"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="p-4">
      <!-- Stats -->
      <div class="row g-4">
        <div class="col-md-6 col-xl-3">
          <div class="card text-white bg-primary h-100">
            <div class="card-body">
              <h5 class="card-title"><i class="fas fa-users me-2"></i>Total Users</h5>
              <p class="card-text fs-4"><?php echo number_format($totalUsers); ?></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-xl-3">
          <div class="card text-white bg-success h-100">
            <div class="card-body">
              <h5 class="card-title"><i class="fas fa-store me-2"></i>Total Establishments</h5>
              <p class="card-text fs-4"><?php echo number_format($totalEstablishments); ?></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-xl-3">
          <div class="card text-white bg-warning h-100">
            <div class="card-body">
              <h5 class="card-title"><i class="fas fa-user-shield me-2"></i>Total Active Users</h5>
              <p class="card-text fs-4"><?php echo number_format($activeUsers); ?></p>
            </div>
          </div>
        </div>
      </div>

      <hr class="my-5">

      <!-- User Management -->
      <h2 class="mb-4">User Management</h2>
      <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
          <thead class="table-dark">
            <tr>
              <th>User Name</th>
              <th>Email</th>
              <th>Role</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($users as $user): ?>
              <tr>
                <td><?php echo htmlspecialchars($user['fullname']); ?></td>
                <td><?php echo htmlspecialchars($user['username']); ?></td>
                <td><?php echo ucfirst($user['role_name'] ?? ''); ?></td>
                <td>
                  <span class="badge <?php echo $user['status'] == 'active' ? 'bg-success' : 'bg-secondary'; ?>">
                    <?php echo ucfirst($user['status']); ?>
                  </span>
                </td>
                <td>
                  <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editUserModal"
                    data-id="<?php echo $user['id']; ?>"
                    data-fullname="<?php echo htmlspecialchars($user['fullname']); ?>"
                    data-email="<?php echo htmlspecialchars($user['username']); ?>"
                    data-role="<?php echo $user['role_id']; ?>"
                    data-status="<?php echo $user['status']; ?>">
                    <i class="fas fa-edit"></i>
                  </button>
                  <a href="?delete_id=<?php echo $user['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">
                    <i class="fas fa-trash-alt"></i>
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="editUserId" name="user_id">
          <div class="mb-3">
            <label for="editFullname" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="editFullname" name="fullname" required>
          </div>
          <div class="mb-3">
            <label for="editEmail" class="form-label">Email</label>
            <input type="email" class="form-control" id="editEmail" name="email" required>
          </div>
          <div class="mb-3">
            <label for="editRole" class="form-label">Role</label>
            <select class="form-select" id="editRole" name="role_id" required>
              <option value="1">Inspector</option>
              <option value="3">Staff</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="editStatus" class="form-label">Status</label>
            <select class="form-select" id="editStatus" name="status" required>
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.getElementById('toggleSidebar').addEventListener('click', () => {
    const sidebar = document.getElementById('sidebar');
    if (sidebar.classList.contains('d-none')) {
      sidebar.classList.remove('d-none');
      sidebar.classList.add('d-block');
    } else {
      sidebar.classList.remove('d-block');
      sidebar.classList.add('d-none');
    }
  });

  var editModal = document.getElementById('editUserModal');
  editModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    document.getElementById('editUserId').value = button.getAttribute('data-id');
    document.getElementById('editFullname').value = button.getAttribute('data-fullname');
    document.getElementById('editEmail').value = button.getAttribute('data-email');
    document.getElementById('editRole').value = button.getAttribute('data-role');
    document.getElementById('editStatus').value = button.getAttribute('data-status');
  });

  document.querySelector('form').addEventListener('submit', function (e) {
    const fullname = document.getElementById('editFullname').value.trim();
    const email = document.getElementById('editEmail').value.trim();
    if (!fullname || !email) {
      e.preventDefault();
      alert('Please fill in all required fields.');
    }
  });
</script>
</body>
</html>
``` 
