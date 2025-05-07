<?php
// Database configuration
$host = 'localhost'; // e.g. 'localhost'
$db_name = 'bfp_db'; // Replace with your database name
$db_user = 'root'; // Replace with your database username
$db_pass = ''; // Replace with your database password

// Create connection
$conn = new mysqli($host, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optionally, set the character set to UTF-8 for better encoding support
$conn->set_charset('utf8');
?>
