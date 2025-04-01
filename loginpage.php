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
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login Page</title>
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Nunito:300,400,600,700|Poppins:300,400,600,700" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">
                <div class="card-body">
                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your username & password to login</p>
                  </div>

                  <form action="loginpage.php" method="POST">
                    <div class="mb-3">
                      <label for="yourUsername" class="form-label">Username</label>
                      <input type="text" name="username" class="form-control" id="yourUsername" required>
                    </div>

                    <div class="mb-3">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                    </div>

                    <div class="mb-3 form-check">
                      <input class="form-check-input" type="checkbox" name="remember" id="rememberMe" value="true">
                      <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Login</button>
                    <p class="small text-center mt-3">Don't have an account? <a href="register.php">Create an account</a></p>
                  </form>

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
