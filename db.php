<?php
// Database configuration
$servername = "localhost";  // Change if your database is hosted elsewhere
$username = "root";  // Your MySQL username
$password = "";  // Your MySQL password
$dbname = "pokeverse_club";  // Name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
