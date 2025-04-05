<?php
session_start();
include('db_con.php'); // Include the database connection

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL query to find the user with the provided username
    $sql = "SELECT * FROM users WHERE username = ? LIMIT 1";
    if ($stmt = mysqli_prepare($db_con, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $username);  // Bind the username parameter
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

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
                        header("Location: index.php");  // Admin's dashboard
                        exit();
                    } elseif ($user['role'] == 'inspector') {
                        header("Location: index.php");  // Inspector's dashboard
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
        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <script defer src="assets/fontawesome/js/all.min.js"></script>
    <link rel="stylesheet" href="assets/css/app.css">
</head>

<body>
    <div id="auth">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-12 mx-auto">
                    <div class="card pt-4">
                        <div class="card-body">
                            <div class="text-center mb-5">
                                <h3>Sign In</h3>
                            </div>
                            <!-- Form submission to the same page -->
                            <form action="" method="POST">
                                <div class="form-group position-relative has-icon-left">
                                    <label for="username">Username</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" id="username" name="username" required>
                                        <div class="form-control-icon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group position-relative has-icon-left">
                                    <div class="clearfix">
                                        <label for="password">Password</label>
                                        <a href="#" class='float-end'>
                                            <small>Forgot password?</small>
                                        </a>
                                    </div>
                                    <div class="position-relative">
                                        <input type="password" class="form-control" id="password" name="password" required>
                                        <div class="form-control-icon">
                                            <i class="fa fa-key"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class='form-check clearfix my-4'>
                                    <div class="checkbox float-start">
                                        <a href="index.html" class='float-end'>
                                            <small>admin</small>
                                        </a>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <button class="btn btn-primary float-end">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>
