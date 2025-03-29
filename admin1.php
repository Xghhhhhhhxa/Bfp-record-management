<?php
session_start();

// Ensure the user is an admin before proceeding
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- Navbar for Home and Log Out -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Dashboard</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="admin1.php">Home</a>
                <a class="nav-link" href="logout.php">Log Out</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">

        <!-- Box container for folder item -->
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <i class="icon" style="font-size: 30px;">&#128736;</i> <!-- Icon for the folder -->
                <h5 class="card-title">Manage Users</h5>
                <p class="card-text">Manage users and their permissions within the system.</p>
                <a href="admin.php" class="btn btn-warning btn-sm">Manage Users</a> <!-- Link to manage users -->
            </div>
        </div>

    </div>

</body>
</html>
