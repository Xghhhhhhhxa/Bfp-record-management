<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0">
    <title>BFP Record Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome CDN for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        /* Sidebar Styles */
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: -250px; /* Sidebar hidden initially */
            background-color: gray;
            color: white;
            padding-top: 20px;
            transition: left 0.3s ease;
        }

        .sidebar a {
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            display: block;
            margin-bottom: 10px;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .content {
            margin-left: 0;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        .sidebar-toggle {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 1000;
            font-size: 30px;
            cursor: pointer;
            color: #343a40;
        }

        .sidebar.open {
            left: 0; /* Sidebar shown */
        }

        .content.open {
            margin-left: 250px; /* Shift content to the right when sidebar is open */
        }

        .sidebar .icon {
            font-size: 22px;
            margin-right: 10px;
        }

        .container {
            display: flex;
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            min-height: 100vh; /* Make sure the container fills the entire height */
            padding: 20px; /* Optional: Adds some padding around the container */
        }

        /* Folder Grid Styles */
        .folder-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .folder-item {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .folder-item:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .folder-item i {
            font-size: 50px;
            color: #007bff;
        }

        .folder-item h5 {
            margin-top: 10px;
            font-size: 18px;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <h3 class="text-center text-white">BFP System</h3>
        <a href="checklist.php"><i class="icon fas fa-clipboard-list"></i> Check List</a> <!-- Updated icon -->
        <a href="#renewal-establishment"><i class="icon fas fa-business-time"></i> Renewal Establishment</a> <!-- Updated icon -->
        <a href="logout.php" class="btn btn-danger"><i class="icon fas fa-sign-out-alt"></i> Log Out</a> <!-- Updated icon -->
    </div>

    <!-- Toggle Button -->
    <span class="sidebar-toggle" id="toggleSidebar">&#9776;</span> <!-- Hamburger icon -->

    <!-- Content -->
    <div class="content" id="content">
        <center><h2>Welcome to the BFP Record Management System</h2></center>
        <div class="container">
            <!-- Folder Grid Layout -->
            <div class="folder-grid">
                <!-- Record Management Folder -->
                <div id="record-management" class="folder-item">
                    <i class="icon fas fa-clipboard-check"></i> <!-- Updated icon -->
                    <h5>FOR RENEWAL</h5>
                    <a href="checklist.php" class="btn btn-primary btn-sm">RENEWAL</a>
                </div>

                <!-- Renewal Establishment Folder -->
                <div id="renewal-establishment" class="folder-item">
                    <i class="icon fas fa-file-signature"></i> <!-- Updated icon -->
                    <h5>NEW APPLICATION</h5>
                    <a href="#renewal-establishment" class="btn btn-success btn-sm">APPLICATION</a>
                </div>

                <!-- Additional Content Folder -->
                <div class="folder-item">
                    <i class="icon fas fa-cogs"></i> <!-- Updated icon -->
                    <h5>Additional Section</h5>
                    <p>Additional functionality such as reports or notifications.</p>
                    <a href="#" class="btn btn-info btn-sm">Go to Section</a>
                </div>

                <!-- Another Folder Item (Example) -->
                <div class="folder-item">
                    <i class="icon fas fa-credit-card"></i> <!-- Updated icon for payment -->
                    <h5>Manage Payments</h5>
                    <p>Manage payments and invoices within the system.</p>
                    <a href="pay.php" class="btn btn-warning btn-sm">PAYMENT</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"></script>

    <!-- JavaScript to Toggle Sidebar -->
    <script>
        // Get elements
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');
        const toggleButton = document.getElementById('toggleSidebar');

        // Toggle sidebar
        toggleButton.addEventListener('click', () => {
            sidebar.classList.toggle('open');
            content.classList.toggle('open');
        });
    </script>
</body>
</html>
