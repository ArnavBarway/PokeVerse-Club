<?php
include('db.php');

// Assume that you already have a registration form that sends POST data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL query to insert user
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sss", $username, $email, $hashed_password);
        $stmt->execute();
        echo "Account created successfully!";
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
