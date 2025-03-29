<?php
// Start a session to manage user login data
session_start();

// Check if the user is logged in and if the user is an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    // Redirect to login page if not logged in or not an admin
    header("Location: admin.php");
    exit();
}

// Include the database connection file
include('db_con.php');

// Check if the database connection was successful
if (!$db_con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle Approve User
if (isset($_GET['approve'])) {
    $user_id = $_GET['approve'];

    // Update user status to 'approved'
    $query = "UPDATE users SET status = 'approved' WHERE id = ?";
    $stmt = $db_con->prepare($query);
    $stmt->bind_param("i", $user_id); // Bind the user ID as an integer

    if ($stmt->execute()) {
        // Redirect back to the admin page after approval
        header("Location: admin.php");
        exit();
    } else {
        echo "Error approving user: " . $db_con->error;
    }
}

// Handle Delete User
if (isset($_GET['delete'])) {
    $user_id = $_GET['delete'];

    // Delete the user from the database
    $query = "DELETE FROM users WHERE id = ?";
    $stmt = $db_con->prepare($query);
    $stmt->bind_param("i", $user_id); // Bind the user ID as an integer

    if ($stmt->execute()) {
        // Redirect back to the admin page after deletion
        header("Location: admin.php");
        exit(); // Ensure no further code is executed
    } else {
        echo "Error deleting user: " . $db_con->error;
    }
}

// Handle Update User
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_user'])) {
    $user_id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $role = $_POST['role'];
    $status = $_POST['status'];

    // Update user details in the database
    $query = "UPDATE users SET first_name = ?, middle_name = ?, last_name = ?, username = ?, role = ?, status = ? WHERE id = ?";
    $stmt = $db_con->prepare($query);
    $stmt->bind_param("ssssssi", $first_name, $middle_name, $last_name, $username, $role, $status, $user_id);

    if ($stmt->execute()) {
        // Redirect back to the admin page after updating
        header("Location: admin.php");
        exit();
    } else {
        echo "Error updating user: " . $db_con->error;
    }
}

// Get all users to display them
$query = "SELECT id, first_name, middle_name, last_name, username, status, role FROM users";
$stmt = $db_con->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
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
        <h3 class="text-center">Admin Dashboard</h3>

        <div class="table-container">
            <h4>User Management</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Status</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($user = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['id']); ?></td>
                            <td><?php echo htmlspecialchars($user['first_name']) . ' ' . htmlspecialchars($user['middle_name']) . ' ' . htmlspecialchars($user['last_name']); ?></td>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                            <td>
                                <?php echo ($user['status'] == 'approved') ? 'Approved' : 'Pending'; ?>
                            </td>
                            <td><?php echo htmlspecialchars($user['role']); ?></td>
                            <td>
                                <!-- Approve user button -->
                                <?php if ($user['status'] == 'pending') { ?>
                                    <a href="admin.php?approve=<?php echo $user['id']; ?>" class="btn btn-success btn-sm">Approve</a>
                                <?php } ?>

                                <!-- Edit user button (opens the update form) -->
                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#updateModal" onclick="populateUpdateForm(<?php echo $user['id']; ?>, '<?php echo $user['first_name']; ?>', '<?php echo $user['middle_name']; ?>', '<?php echo $user['last_name']; ?>', '<?php echo $user['username']; ?>', '<?php echo $user['role']; ?>', '<?php echo $user['status']; ?>')">Update</button>

                                <!-- Delete user button -->
                                <a href="admin.php?delete=<?php echo $user['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Modal for updating user -->
        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Update User Information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="admin.php" method="POST">
                            <input type="hidden" name="id" id="user_id">
                            <div class="mb-3">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" class="form-control" name="first_name" id="first_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="middle_name" class="form-label">Middle Name</label>
                                <input type="text" class="form-control" name="middle_name" id="middle_name">
                            </div>
                            <div class="mb-3">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="last_name" id="last_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" id="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select name="role" id="role" class="form-control">
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="approved">Approved</option>
                                    <option value="pending">Pending</option>
                                </select>
                            </div>
                            <button type="submit" name="update_user" class="btn btn-primary">Update User</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"></script>

    <!-- JavaScript function to populate the modal with the user's data -->
    <script>
        function populateUpdateForm(id, first_name, middle_name, last_name, username, role, status) {
            document.getElementById('user_id').value = id;
            document.getElementById('first_name').value = first_name;
            document.getElementById('middle_name').value = middle_name;
            document.getElementById('last_name').value = last_name;
            document.getElementById('username').value = username;
            document.getElementById('role').value = role;
            document.getElementById('status').value = status;
        }
    </script>
</body>
</html>
