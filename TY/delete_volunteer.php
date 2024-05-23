<?php
include('database_connection.php');

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if volunteerID is set
if(isset($_REQUEST['volunteerID'])) {
    $volunteerID = $_REQUEST['volunteerID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM volunteer WHERE volunteerID=?");
    if (!$stmt) {
        echo "Error preparing statement: " . $connection->error;
    } else {
        $stmt->bind_param("i", $volunteerID);
        if ($stmt->execute()) {
            echo "Record deleted successfully.";
        } else {
            echo "Error deleting data: " . $stmt->error;
        }
        $stmt->close();
    }
} else {
    echo "volunteerID is not set.";
}

$connection->close();
?>
