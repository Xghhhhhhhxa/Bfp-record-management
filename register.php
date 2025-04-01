<?php
include('db_con.php'); // Include the database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and retrieve form data safely
    $first_name = isset($_POST['first_name']) ? trim($_POST['first_name']) : '';
    $middle_name = isset($_POST['middle_name']) ? trim($_POST['middle_name']) : '';
    $last_name = isset($_POST['last_name']) ? trim($_POST['last_name']) : '';
    $birthdate = isset($_POST['birthdate']) ? trim($_POST['birthdate']) : '';
    $contact_number = isset($_POST['contact_number']) ? trim($_POST['contact_number']) : '';
    $gender = isset($_POST['gender']) ? trim($_POST['gender']) : '';
    $address = isset($_POST['address']) ? trim($_POST['address']) : '';
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $confirm_password = isset($_POST['confirm_password']) ? trim($_POST['confirm_password']) : '';
    $role = isset($_POST['role']) ? trim($_POST['role']) : '';
    $status = "1";

// Check if all required fields are filled
   
  

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
        exit();
    }

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);


    $query = $db_con->prepare("SELECT * FROM users WHERE username = ?");
    $query->bind_param("s", $username);
    $result = $query-> get_result();

    if($result->num_rows > 0){

      echo "Username already Taken";
    }else{
          $stmt = $db_con->prepare("INSERT INTO users (first_name, middle_name, last_name, birthdate, contact_number, gender, address, username, password, role, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
          $stmt->bind_param("sssssssssss", $first_name, $middle_name, $last_name, $birthdate, $contact_number, $gender, $address, $username, $hashed_password, $role, $status);
          if ($stmt->execute()) {
            echo "New account created successfully!";
            header("Location: loginpage.php"); // Redirect to login page after successful registration
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    
    }



    // Prevent SQL Injection using prepared statements
   

    
    // Close the statement and connection
    $stmt->close();
    $db_con->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container-center {
            max-width: 70%;
            max-height: 90vh;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="container container-center">
        <div class="card shadow p-4 w-100">
            <h3 class="text-center">Register</h3>
            <p class="text-center">Create a new account</p>
            <form action="register.php" method="POST">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter your first name" required>
                    </div>
                    <div class="col-md-4">
                        <label for="middle_name" class="form-label">Middle Name</label>
                        <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Enter your middle name">
                    </div>
                    <div class="col-md-4">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter your last name" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="birthdate" class="form-label">Birthdate</label>
                        <input type="date" class="form-control" id="birthdate" name="birthdate" required>
                    </div>
                    <div class="col-md-6">
                        <label for="contact_number" class="form-label">Contact Number</label>
                        <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="Enter your contact number" required pattern="\d{11}" maxlength="11" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Enter your address" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                    </div>
                    <div class="col-md-6">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Register</button>
                <div class="col-12 text-center mt-3">
                    <p class="small mb-0">Already have an account? <a href="loginpage.php">Login here</a></p>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
