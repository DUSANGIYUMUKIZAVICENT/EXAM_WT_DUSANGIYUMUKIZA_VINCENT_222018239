<?php
include('database.php');

// Check if report_id is set
if(isset($_REQUEST['feedbackID'])) {
    $report_id = $_REQUEST['feedbackID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM feedback WHERE feedbackID=?");
    $stmt->bind_param("i", $feedbackID);
    
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $connection->error;
    }

    $stmt->close();
} else {
    echo "feedbackID is not set.";
}

$connection->close();
?>
