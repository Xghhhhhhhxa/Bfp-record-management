<?php
include 'db.php';
require 'vendor/autoload.php';
require 'vendor/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/src/SMTP.php';
require 'vendor/phpmailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Pagination variables
$limit = 10;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $limit;

// Get total number of users
$totalResult = $conn->query("SELECT COUNT(*) as total FROM users");
$totalUsers = $totalResult->fetch_assoc()['total'];
$totalPages = ceil($totalUsers / $limit);

// Function to fetch paginated users
function getUsersWithRolesPaginated($conn, $limit, $offset) {
    $users = [];
    $sql = "
        SELECT 
            u.id, 
            u.fullname, 
            u.username, 
            u.status, 
            u.created_at, 
            r.name AS role_name 
        FROM users u 
        LEFT JOIN roles r ON u.role_id = r.id
        ORDER BY u.created_at DESC
        LIMIT $limit OFFSET $offset
    ";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
    }
    return $users;
}

// Form handling (same as before)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = trim($_POST['fullname']);
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $role_id = intval($_POST['role_id']);

    if (empty($fullname) || empty($username) || empty($password) || empty($role_id)) {
        $error = "All fields are required.";
    } else {
        $roleCheck = $conn->prepare("SELECT id, name FROM roles WHERE id = ?");
        $roleCheck->bind_param("i", $role_id);
        $roleCheck->execute();
        $roleCheck->store_result();
        $roleCheck->bind_result($r_id, $r_name);

        if ($roleCheck->num_rows == 0) {
            $error = "Invalid role selected.";
        } else {
            $roleCheck->fetch();

            $check = $conn->prepare("SELECT id FROM users WHERE username = ?");
            $check->bind_param("s", $username);
            $check->execute();
            $check->store_result();

            if ($check->num_rows > 0) {
                $error = "Username already exists.";
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO users (fullname, username, password, role_id, status) VALUES (?, ?, ?, ?, 'active')");
                $stmt->bind_param("sssi", $fullname, $username, $hashedPassword, $role_id);

                if ($stmt->execute()) {
                    $mail = new PHPMailer(true);
                    try {
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'aldrinjadebadana@gmail.com';
                        $mail->Password = 'jfqe voos kyay lfnk'; // App-specific password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port = 587;

                        $mail->setFrom('aldrinjadebadana@gmail.com', 'CPSU Fire Safety');
                        $mail->addAddress($username, $fullname);
                        $mail->isHTML(true);

                        $roleLabel = ucfirst($r_name);
                        $mail->Subject = "Your $roleLabel Account Credentials";
                        $mail->Body = "
                            <h3>Welcome to Fire Safety System</h3>
                            <p>Hello <strong>$fullname</strong>,</p>
                            <p>You have been registered as a <strong>$roleLabel</strong>.</p>
                            <p><strong>Username:</strong> $username</p>
                            <p><strong>Password:</strong> $password</p>
                            <p>You can log in here: <a href='http://yourdomain.com/login.php'>Login</a></p>
                            <p>Thank you!</p>
                        ";
                        $mail->send();
                        $success = "User successfully added and email sent!";
                    } catch (Exception $e) {
                        $error = "User added but email failed: " . $mail->ErrorInfo;
                    }
                } else {
                    $error = "Database error: " . $stmt->error;
                }
                $stmt->close();
            }
            $check->close();
        }
        $roleCheck->close();
    }
}

// Fetch paginated users
$users = getUsersWithRolesPaginated($conn, $limit, $offset);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Add Inspector</title>
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
        <a class="navbar-brand" href="#">Add Inspector</a>
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
      <h2>Add Inspector</h2>
      <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
      <?php elseif (isset($success)): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
      <?php endif; ?>

      <form method="POST" class="row g-3">
        <div class="col-md-4">
          <label for="fullname" class="form-label">Full Name</label>
          <input type="text" class="form-control" name="fullname" required>
        </div>
        <div class="col-md-4">
          <label for="username" class="form-label">Email (Username)</label>
          <input type="email" class="form-control" name="username" required>
        </div>
        <div class="col-md-4">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" name="password" required>
        </div>
        <div class="col-md-4">
          <label for="role_id" class="form-label">Role</label>
          <select class="form-control" name="role_id" required>
            <option value="1">Inspector</option>
            <option value="3">Staff</option>
          </select>
        </div>
        <div class="col-12">
          <button type="submit" class="btn btn-primary">Add User</button>
        </div>
      </form>

      <h3 class="mt-5">User List</h3>
      <table class="table table-bordered mt-3">
        <thead>
          <tr>
            <th>Full Name</th>
            <th>Username</th>
            <th>Role</th>
            <th>Status</th>
            <th>Created At</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($users as $user): ?>
          <tr>
            <td><?= htmlspecialchars($user['fullname']) ?></td>
            <td><?= htmlspecialchars($user['username']) ?></td>
            <td><?= ucfirst($user['role_name']) ?></td>
            <td><?= ucfirst($user['status']) ?></td>
            <td><?= $user['created_at'] ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <!-- Pagination controls -->
      <nav>
        <ul class="pagination justify-content-center">
          <?php if ($page > 1): ?>
            <li class="page-item"><a class="page-link" href="?page=<?= $page - 1 ?>">Previous</a></li>
          <?php endif; ?>
          <?php if ($page < $totalPages): ?>
            <li class="page-item"><a class="page-link" href="?page=<?= $page + 1 ?>">Next</a></li>
          <?php endif; ?>
        </ul>
      </nav>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Sidebar toggle functionality
  document.getElementById('toggleSidebar').addEventListener('click', () => {
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.querySelector('.main-content');
    if (sidebar.classList.contains('sidebar-collapsed')) {
      sidebar.classList.remove('sidebar-collapsed');
      mainContent.style.marginLeft = '250px';
    } else {
      sidebar.classList.add('sidebar-collapsed');
      mainContent.style.marginLeft = '0';
    }
  });
</script>
</body>
</html>
