<?php
include('database_connection.php');

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if paymentID is set
if(isset($_REQUEST['donorID'])) {
    $donorID = $_REQUEST['donorID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM payment WHERE donorID=?");
    $stmt->bind_param("i", $donorID);
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $connection->error;
    }

    $stmt->close();
} else {
    echo "donorID is not set.";
}

$connection->close();
?>
