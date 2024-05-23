<?php
include('database_connection.php');

// Check if notificationID is set
if(isset($_REQUEST['userID'])) {
    $userID = $_REQUEST['userID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM notification WHERE userID=?");
    $stmt->bind_param("i", $userID);
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $connection->error;
    }

    $stmt->close();
} else {
    echo "userID is not set.";
}

$connection->close();
?>
