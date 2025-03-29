<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Dashboard</title>

    <!-- Link to Bootstrap CSS for styling -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Add your custom styles here -->
    <style>
        /* Sidebar */
        .sidebar {
            height: 100vh;
            background-color: #343a40;
            color: white;
            padding-top: 20px;
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
            margin-left: 220px;
            padding: 20px;
        }

        /* Back-to-top button */
        .back-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #007bff;
            color: white;
            padding: 10px;
            border-radius: 50%;
            cursor: pointer;
            display: none;
        }

        /* Show back-to-top button when scrolled down */
        .back-to-top.show {
            display: block;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h3 class="text-center text-white">Dashboard</h3>
        <a href="#">Home</a>
        <a href="#">Profile</a>
        <a href="#">Settings</a>
        <a href="#">Logout</a>
    </div>

    <!-- Content -->
    <div class="content">
        <!-- Header -->
        <header class="d-flex justify-content-between align-items-center">
            <h1>Welcome to Your Dashboard</h1>
            <button class="btn btn-primary">Profile</button>
        </header>

        <!-- Dashboard Content -->
        <div class="row mt-5">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Users</h5>
                        <p class="card-text">Currently, there are 1500 users registered.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Active Sessions</h5>
                        <p class="card-text">There are 500 active sessions right now.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">New Messages</h5>
                        <p class="card-text">You have 15 new messages waiting for you.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Back-to-top button -->
    <button class="back-to-top" id="backToTop">
        <i class="bi bi-arrow-up-short"></i>
    </button>

    <!-- Bootstrap and custom JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

    <script>
        // Scroll to top functionality for back-to-top button
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('#backToTop').addClass('show');
            } else {
                $('#backToTop').removeClass('show');
            }
        });

        $('#backToTop').click(function () {
            $('html, body').animate({ scrollTop: 0 }, 500);
        });
    </script>

</body>

</html>
