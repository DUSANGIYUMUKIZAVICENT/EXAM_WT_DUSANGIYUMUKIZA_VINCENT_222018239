<?php
include('database_connection.php');

// Check if mediaID is set
if(isset($_REQUEST['mediaID'])) {
    $mediaID = $_REQUEST['mediaID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM media WHERE mediaID=?");
    $stmt->bind_param("i", $mediaID);
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $connection->error;
    }

    $stmt->close();
} else {
    echo "mediaID is not set.";
}

$connection->close();
?>
