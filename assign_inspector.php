<?php
include 'db.php'; // Your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inspector_id = $_POST['inspector_id'];
    $assignments = $_POST['assignment']; // Changed to an array to handle multiple barangays

    // Check if fields are empty
    if (empty($inspector_id) || empty($assignments)) {
        $error = "All fields are required.";
    } else {
        // Check if each barangay_id exists in the barangays table
        foreach ($assignments as $barangay) {
            $stmt = $conn->prepare("SELECT COUNT(*) FROM barangays WHERE id = ?");
            $stmt->bind_param("i", $barangay);
            $stmt->execute();
            $stmt->bind_result($count);
            $stmt->fetch();
            $stmt->close();

            if ($count == 0) {
                $error = "Barangay ID $barangay does not exist in the database.";
                break;
            }

            // Insert the assignment into the database
            $stmt = $conn->prepare("INSERT INTO inspector_barangay_assignments (inspector_id, barangay_id) VALUES (?, ?)");
            $stmt->bind_param("ii", $inspector_id, $barangay); // Adjust for integer IDs

            if (!$stmt->execute()) {
                $error = "Failed to assign inspector: " . $stmt->error;
                break;
            }
            $stmt->close();
        }

        if (!isset($error)) {
            $success = "Inspector assigned successfully!";
        }
    }
}

// Get list of inspectors
$inspectors = $conn->query("SELECT id, fullname FROM users WHERE role_id = 1");

// Get list of barangays
$barangayQuery = mysqli_query($conn, "SELECT * FROM barangays");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Assign Inspector</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">


    <!-- Include Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    

    <style>
        body {
            overflow-x: hidden;
            font-family: 'Arial', sans-serif;
        }
        .sidebar {
            width: 250px; /* Ensure the sidebar has a fixed width */
            height: 100vh;
            background-color: #343a40;
            padding-top: 1rem;
            transition: all 0.3s ease;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
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
<body id="page-top">
    <div class="d-flex">
        <!-- Sidebar -->
        <div id="sidebar" class="sidebar">
            <?php include 'sidebar.php'; ?>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <nav class="navbar navbar-expand navbar-light bg-light">
                <div class="container-fluid">
                    <!-- Sidebar Toggle Button -->
                    <button class="btn btn-outline-secondary me-3 d-md-none" id="toggleSidebar">
                        <i class="fas fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="#">Assign Inspector</a>
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

            <div class="container mt-4">
                <h2>Assign Inspector</h2>
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php elseif (isset($success)): ?>
                    <div class="alert alert-success"><?php echo $success; ?></div>
                <?php endif; ?>

                <form method="POST" class="row g-3">
                    <div class="col-md-6">
                        <label for="inspector_id" class="form-label">Select Inspector</label>
                        <select class="form-control" id="inspector_id" name="inspector_id" required>
                            <option value="">-- Select --</option>
                            <?php while ($row = $inspectors->fetch_assoc()): ?>
                                <option value="<?php echo $row['id']; ?>">
                                    <?php echo htmlspecialchars($row['fullname']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="assignment" class="form-label">Assign Barangays</label>
                        <select class="form-control select2" id="assignment" name="assignment[]" multiple="multiple" required>
                            <option value="">Select Barangays</option>
                            <?php while ($barangay = mysqli_fetch_assoc($barangayQuery)): ?>
                                <option value="<?php echo $barangay['id']; ?>">
                                    <?php echo htmlspecialchars($barangay['barangay_name']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Assign Inspector</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Include necessary JavaScript files -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.2.0/dist/fullcalendar.min.js"></script>

    <!-- Include Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script>
        // Sidebar toggle functionality
        document.getElementById('toggleSidebar').addEventListener('click', () => {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.querySelector('.main-content');
            if (sidebar.classList.contains('sidebar-collapsed')) {
                sidebar.classList.remove('sidebar-collapsed');
                sidebar.style.width = '250px'; // Ensure the width is restored
                mainContent.style.marginLeft = '250px';
            } else {
                sidebar.classList.add('sidebar-collapsed');
                sidebar.style.width = '0'; // Collapse the sidebar
                mainContent.style.marginLeft = '0';
            }
        });

        // Initialize Select2 for the Barangay assignment dropdown
        $(document).ready(function() {
            $('#assignment').select2({
                placeholder: 'Select Barangays',
                allowClear: true,
                width: '100%'
            });
        });
    </script>
</body>
</html>
