<?php
session_start();
include('db.php'); // Include the database connection

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL query to find the user with the provided username
    $sql = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($conn, $sql);

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
                $_SESSION['role_id'] = $user['role_id'];  // Store the role_id in session

                // Redirect based on the user's role_id
                if ($user['role_id'] == '2') {
                    header("Location: dashboard_admin.php");  // Admin's dashboard
                    exit();
                } elseif ($user['role_id'] == '1') {
                  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                
                    // Prepare SQL to check username and password in the 'users' table
                    $sql = "SELECT * FROM users WHERE username = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $username); // 's' stands for string type
                    $stmt->execute();
                    $result = $stmt->get_result();
                
                    if ($result->num_rows > 0) {
                        // User found, check password
                        $user = $result->fetch_assoc();
                        if (password_verify($password, $user['password'])) {
                            // Password is correct
                
                            // Start the session for the logged-in user
                            $_SESSION['user_id'] = $user['id']; // Store user ID
                            $_SESSION['fullname'] = $user['fullname']; // Assuming fullname is stored
                            $_SESSION['username'] = $user['username'];
                
                            // Fetch the assigned barangays using JOIN between inspector_barangay_assignments and barangay table
                            $inspector_id = $user['id']; // Get the inspector's ID from the session
                            $barangay_sql = "
                                SELECT b.barangay_name 
                                FROM barangays b
                                INNER JOIN inspector_barangay_assignments iba 
                                ON b.id = iba.barangay_id 
                                WHERE iba.inspector_id = ?";
                            $barangay_stmt = $conn->prepare($barangay_sql);
                            $barangay_stmt->bind_param("i", $inspector_id); // 'i' stands for integer type
                            $barangay_stmt->execute();
                            $barangay_result = $barangay_stmt->get_result();
                
                            // Store the assigned barangays in session
                            $assigned_barangays = [];
                            while ($barangay = $barangay_result->fetch_assoc()) {
                                $assigned_barangays[] = $barangay['barangay_name'];
                            }
                
                            // Store the assigned barangays in session
                            $_SESSION['barangay_assigned'] = $assigned_barangays;
                
                            // Redirect to choice.php
                            header("Location: dashboard_inspector.php");
                            exit();
                        } else {
                            // Invalid password
                            $_SESSION['error_message'] = "Invalid username or password.";
                            header("Location: login.php");
                            exit();
                        }
                    } else {
                        // User not found
                        $_SESSION['error_message'] = "Invalid username or password.";
                        header("Location: login.php");
                        exit();
                    }
                } else {
                    // Redirect to login page if the form is not submitted
                    header("Location: login.php");
                    exit();
                }
                  // Inspector's dashboard
                    exit();
                } elseif ($user['role_id'] == '3' || $user['status'] == 'approved') {
                    header("Location: dashboard_staff.php");  // BFP Staff dashboard
                    exit();
                } else {
                    header("Location: default_dashboard.php"); // Default redirect if no specific role_id
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

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Nunito:300,400,600,700|Poppins:300,400,600,700" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

    <!-- External Css -->
  <link href="css/loginpagestyle.css" rel="stylesheet">

     <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

 
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">

          <div class="row justify-content-center">
            <div class="col-lg-10 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="card mb-3">
                <div class="card-body">
                  <div class="pt-4 pb-2 text-center">
                    <div class="logo-container">
                      <img src="img/leftlogo1.png" alt="Logo 1"> <!-- Replace with actual logo path -->
                      <span class="logo-text">Bureau of Fire Protection Hinigaran</span>
                      <img src="img/logright.png" alt="Logo 2"> <!-- Replace with actual logo path -->
                    </div>
                    <h5 class="card-title pb-0 fs-4">Login to BFP Admin Dashboard</h5>
                  </div>

                  <form action="login.php" method="POST">
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
