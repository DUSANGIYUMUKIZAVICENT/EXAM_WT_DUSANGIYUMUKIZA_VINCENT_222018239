<?php
session_start();
include('database_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user input
    $email = $connection->real_escape_string($_POST['email']);
    $password = $connection->real_escape_string($_POST['password']);

    // Prepare and execute SQL statement to prevent SQL injection
    $sql = "SELECT id, email, password FROM users WHERE email=?";
    $stmt = $connection->prepare($sql);
    
    // Check if the statement was prepared successfully
    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if user exists
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            // Verify the hashed password
            if (password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['id'];
                $stmt->close(); // Close the prepared statement
                $connection->close(); // Close the database connection
                header("Location: home.html"); // Redirect to home page after successful login
                exit();
            } else {
                $error = "Invalid email or password"; // Set error message if password is incorrect
            }
        } else {
            $error = "User not found"; // Set error message if user does not exist
        }
    } else {
        $error = "Failed to prepare SQL statement"; // Set error message if preparation fails
    }
    $stmt->close(); // Close the prepared statement
    $connection->close(); // Close the database connection
}
?>
