<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Management Dashboard</title>

    <!-- Link to Bootstrap CSS for styling -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Sidebar */
        .sidebar {
            height: 100vh;
            background-color: #343a40;
            color: white;
            padding-top: 20px;
            position: fixed;
            width: 220px;
            top: 0;
            left: 0;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px;
            display: block;
        }

        .sidebar a:hover {
            background-color: #575757;
        }

        /* Content */
        .content {
            margin-left: 240px;
            padding: 20px;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h3 class="text-center text-white">BFP-RMSGIS</h3>
        <a href="#">Home</a>
        <a href="#">Business Permit</a>
        <a href="#">Building Permit</a>
        <a href="#">Print Blank Forms</a>
        <a href="#">History Log</a>
        <a href="#">Settings</a>
        <a href="#">Logout</a>
    </div>

    <!-- Content -->
    <div class="content">
        <header class="d-flex justify-content-between align-items-center">
            <h1>Dashboard Overview</h1>
            <button class="btn btn-primary">Profile</button>
        </header>

        <div class="row mt-5">
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">No. of Users</h5>
                        <p class="card-text">45</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">No. of Office</h5>
                        <p class="card-text">10</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Business Clients</h5>
                        <p class="card-text">65</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Business for Inspection</h5>
                        <p class="card-text">9</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</body>

</html>
