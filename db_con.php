<?php
// Database credentials
$servername = "localhost";
$username = "root"; // Your MySQL username (usually 'root' for localhost)
$password = ""; // Your MySQL password (empty for localhost)
$dbname = "user_db"; // Replace with your database name

// Create a connection
$db_con = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$db_con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
