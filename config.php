<?php
// MySQL server configuration
$server = "127.0.0.1";
$username = "root";
$password = ""; // Replace with your actual MySQL password
$database = "society_mgmt";
$port = 3307; // Replace with your actual MySQL port if different

// Create a connection
$conn = new mysqli($server, $username, $password, $database, $port);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// echo "Connected successfully";
?>
