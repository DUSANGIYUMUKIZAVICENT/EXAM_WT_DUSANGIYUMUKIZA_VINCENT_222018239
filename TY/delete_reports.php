<?php
include('database_connection.php');

// Check if reportID is set
if(isset($_REQUEST['reportID'])) {
    $reportID = $_REQUEST['reportID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM reports WHERE reportID=?");
    $stmt->bind_param("i", $reportID);
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $connection->error;
    }

    $stmt->close();
} else {
    echo "reportID is not set.";
}

$connection->close();
?>
