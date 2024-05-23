<?php
include('database_connection.php');

// Check if donationID is set
if(isset($_REQUEST['donorID'])) {
    $donorID = $_REQUEST['donorID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM donations WHERE donorID=?");
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
