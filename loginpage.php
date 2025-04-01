<?php
session_start();
include('db_con.php'); // Include the database connection

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL query to find the user with the provided username
    $sql = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($db_con, $sql);

    // Check if the user exists
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Check the user status
            if ($user['status'] == 'pending') {
                echo "<script>alert('Your account is pending approval by the admin. Please wait until it is approved.');</script>";
            } else {
                // Password is correct, and account is approved, set session variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];  // Store the role in session

                // Redirect based on the user's role
                if ($user['role'] == 'admin') {
                    header("Location: admin1.php");  // Admin's dashboard
                    exit();
                } elseif ($user['role'] == 'inspector') {
                    header("Location: dshbrdins.php");  // Inspector's dashboard
                    exit();
                } elseif ($user['role'] == 'bfp_staff' || $user['status'] == 'approved') {
                    header("Location: staf.php");  // BFP Staff dashboard
                    exit();
                } else {
                    header("Location: default_dashboard.php"); // Default redirect if no specific role
                    exit();
                }
            }
        } else {
            // Incorrect password
            echo "<script>alert('Incorrect password.');</script>";
        }
    } else {
        // User does not exist
        echo "<script>alert('Username does not exist.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="card shadow p-4" style="width: 350px;">
        <h3 class="text-center">Login</h3>
        <p>Enter your username & password to login</p>
    
        <form class="row g-3 needs-validation" action="loginpage.php" method="POST" novalidate>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
            <div class="col-12">
        <p class="small mb-0">Don't have account? <a href="register.php">Create an account</a></p>
    </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
