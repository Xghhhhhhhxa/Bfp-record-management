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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<style>
 /* Container for the small box */
.small-box {
  position: relative;
  display: block;
  background-color: #17a2b8; /* bg-info */
  color: white;
  border-radius: 10px;
  padding: 20px;
  overflow: hidden;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
}

.small-box:hover {
  background-color: #138496; /* Darker blue on hover */
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
}

/* Inner content for number and text */
.small-box .inner {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: flex-start;
}

.small-box h3 {
  font-size: 40px;
  font-weight: bold;
  margin: 0;
  padding: 0;
}

.small-box p {
  font-size: 18px;
  margin: 0;
  padding: 5px 0;
}

/* Icon styles */
.small-box .icon {
  position: absolute;
  top: 15px;
  right: 15px;
  font-size: 40px;
  color: rgba(255, 255, 255, 0.7);
}

/* Footer link styles */
.small-box-footer {
  display: block;
  position: absolute;
  bottom: 10px;
  left: 10px;
  right: 10px;
  font-size: 14px;
  color: rgba(255, 255, 255, 0.8);
  text-decoration: none;
  transition: color 0.3s;
}

.small-box-footer:hover {
  color: white;
  text-decoration: underline;
}

/* Responsive */
@media (max-width: 767px) {
  .small-box h3 {
    font-size: 30px;
  }

  .small-box p {
    font-size: 16px;
  }

  .small-box .icon {
    font-size: 30px;
    top: 10px;
    right: 10px;
  }
}
s

   </style> 


        
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
        <div class="container" style="background-color: rgb(255, 0, 0); height: 150px; width: 350px; border-radius: 10px; margin: 20px;">
    <div data-text="completed task" style="margin-bottom: 20px; margin-top: 20px">
        <i class="fas fa-check-circle" style="margin-right: 10px;"></i> Completed task
    </div>
    <div class="number" style="font-size: 50px;">
        85
    </div>
</div>
<div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>150</h3>

                <p>New Orders</p>
              </div>
              <svg
                    class="small-box-icon"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                  >
                    <path
                      d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z"
                    ></path>
                  </svg>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>



      
    </div>

</body>
</html>
