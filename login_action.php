<?php
session_start();  // Start a session

// Include the database connection
include('db.php');

// Get username and password from the form (make sure to use POST method)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];  // username field in the form
    $password = $_POST['password'];  // password field in the form

    // Prepare the SQL query to fetch the user's data from the database
    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameters to the prepared statement
        $stmt->bind_param("s", $username);  // "s" stands for string
        $stmt->execute();
        
        // Bind the result to variables
        $stmt->bind_result($id, $db_username, $db_password);
        
        // Check if the username exists
        if ($stmt->fetch()) {
            // Verify the password
            if (password_verify($password, $db_password)) {
                // Password is correct, set session variables
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $db_username;
                header("Location: index.html");  // Redirect to a protected page (e.g., dashboard)
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "No user found with that username.";
        }
        $stmt->close();
    }
}
?>
