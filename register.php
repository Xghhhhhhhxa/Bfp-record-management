<?php
include('db_con.php'); // Include the database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $birthdate = $_POST['birthdate'];
    $contact_number = $_POST['contact_number'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role']; // Role selected from the form
    $status = "1";
    
    // Check if the passwords match
    if ($password != $confirm_password) {
        echo "Passwords do not match!";
        exit();
    }

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // SQL query to insert data into the table
    $sql = "INSERT INTO users (first_name, middle_name, last_name, birthdate, contact_number, gender, address, username, password, role, status)
            VALUES ('$first_name', '$middle_name', '$last_name', '$birthdate', '$contact_number', '$gender', '$address', '$username', '$hashed_password', '$role', '$status')";

    if ($db_con->query($sql) === TRUE) {
        echo "New account created successfully!";
        header("Location: loginpage.php"); // Redirect to login page after successful registration
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $db_con->error;
    }

    // Close the connection
    $db_con->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Register</title>
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Grid Layout */
    .parent {
      display: grid;
      grid-template-columns: repeat(2, 1fr); /* Two equal columns */
      gap: 20px;
      max-width: 1200px; /* Maximum width for larger screens */
      margin: 0 auto; /* Center the grid container */
    }

    .register-card {
      width: 100%;
      padding: 30px;
      border: 1px solid #ddd;
      border-radius: 8px;
      background-color: #fff;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Input fields to stretch */
    .form-control {
      width: 100%; /* Ensure inputs take up the full width */
    }

    /* Make buttons fill the width of their container */
    .btn {
      width: 100%;
    }

    /* Spacing adjustments for larger screen sizes */
    @media (max-width: 768px) {
      .parent {
        grid-template-columns: 1fr; /* Stack columns on smaller screens */
      }
    }

    /* Small margin between form fields for better spacing */
    .mb-3 {
      margin-bottom: 1.5rem;
    }
  </style>
</head>

<body>

  <main>
    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="row justify-content-center">
          <div class="col-lg-12 col-md-12"> <!-- Full-width container for the form -->

            <!-- Parent grid container (horizontal layout) -->
            <div class="parent">

              <!-- First section of the form -->
              <div>
                <div class="register-card">
                  <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                  <p class="text-center small">Enter your personal details to create an account</p>
                  <form method="POST" novalidate>

                    <!-- Role Selection -->
                    <div class="mb-3">
                      <label for="role" class="form-label">Select Your Role</label>
                      <select class="form-control" name="role" id="role" required>
                        <option value="" disabled selected>Select Role</option>
                        <option value="bfp_staff">BFP Staff</option>
                        <option value="inspector">Inspector</option>
                        <option value="admin">Admin</option>
                      </select>
                      <div class="invalid-feedback">Please select your role!</div>
                    </div>

                    <!-- Personal Information Fields -->
                    <div class="mb-3">
                      <label for="firstName" class="form-label">First Name</label>
                      <input type="text" name="first_name" class="form-control" id="firstName" required>
                      <div class="invalid-feedback">Please enter your first name!</div>
                    </div>

                    <div class="mb-3">
                      <label for="middleName" class="form-label">Middle Name</label>
                      <input type="text" name="middle_name" class="form-control" id="middleName">
                    </div>

                    <div class="mb-3">
                      <label for="lastName" class="form-label">Last Name</label>
                      <input type="text" name="last_name" class="form-control" id="lastName" required>
                      <div class="invalid-feedback">Please enter your last name!</div>
                    </div>

                    <div class="mb-3">
                      <label for="birthdate" class="form-label">Birthdate</label>
                      <input type="date" name="birthdate" class="form-control" id="birthdate" required>
                      <div class="invalid-feedback">Please enter your birthdate!</div>
                    </div>

                    <div class="mb-3">
                      <label for="contactNumber" class="form-label">Contact Number</label>
                      <input type="text" name="contact_number" class="form-control" id="contactNumber" required>
                      <div class="invalid-feedback">Please enter your contact number!</div>
                    </div>

                  </form>
                </div>
              </div>

              <!-- Second section of the form -->
              <div>
                <div class="register-card">

                  <form method="POST" novalidate>
                    <div class="mb-3">
                      <label for="gender" class="form-label">Gender</label>
                      <select class="form-control" name="gender" id="gender" required>
                        <option value="" disabled selected>Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                      </select>
                    </div>

                    <div class="mb-3">
                      <label for="address" class="form-label">Address</label>
                      <textarea name="address" class="form-control" id="address" rows="3" required></textarea>
                      <div class="invalid-feedback">Please enter your address!</div>
                    </div>

                    <div class="mb-3">
                      <label for="yourUsername" class="form-label">Username</label>
                      <input type="text" name="username" class="form-control" id="yourUsername" required>
                      <div class="invalid-feedback">Please choose a username.</div>
                    </div>

                    <div class="mb-3">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="mb-3">
                      <label for="confirmPassword" class="form-label">Confirm Password</label>
                      <input type="password" name="confirm_password" class="form-control" id="confirmPassword" required>
                      <div class="invalid-feedback">Please confirm your password!</div>
                    </div>

                    <button class="btn btn-primary" type="submit">Create Account</button>
                    <p class="small text-center mt-3">Already have an account? <a href="loginpage.php">Log in</a></p>
                  </form>
                </div>
              </div>

            </div>
          </div>
        </div>
      </section>
    </div>
  </main>

  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
