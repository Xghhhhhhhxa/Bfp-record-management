<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Folder Grid</title>
    <!-- Bootstrap CSS for easy grid system -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>
        /* Custom Styles for Folder Grid */
        .folder-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .folder-item {
            background-color: #f0f0f0;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: all 0.3s ease-in-out;
        }

        .folder-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }

        .folder-item i {
            font-size: 50px;
            color: #007bff;
            margin-bottom: 15px;
        }

        .folder-item h5 {
            margin-top: 10px;
            font-size: 18px;
            color: #007bff;
        }

        .folder-item p {
            font-size: 14px;
            color: #666;
        }

        /* Button Style */
        .folder-item .btn {
            margin-top: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            text-transform: uppercase;
            transition: all 0.3s ease-in-out;
        }

        .folder-item .btn:hover {
            background-color: #0056b3;
            cursor: pointer;
        }

        /* Search bar styling */
        .search-bar {
            margin-bottom: 20px;
            text-align: center;
        }

        /* Optional: Styling for the grid container */
        body {
            font-family: Arial, sans-serif;
            background-color: #fafafa;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Barangay Folder Grid</h1>
        

        <!-- Search Bar -->
        <div class="search-bar">
            <input type="text" id="searchInput" class="form-control" placeholder="Search Folders..." onkeyup="searchFolders()">
        </div>

        <?php include('foldergrid.php'); ?>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <!-- Search Functionality -->
    <script>
        function searchFolders() {
            let filter = document.getElementById('searchInput').value.toUpperCase();
            let folderItems = document.querySelectorAll('.folder-item');
            
            folderItems.forEach(function(item) {
                let title = item.querySelector('h5').textContent || item.querySelector('h5').innerText;
                if (title.toUpperCase().indexOf(filter) > -1) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>
