<?php
include('database_connection.php');

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if campaignID is set
if(isset($_REQUEST['campaignID'])) {
    $campaignID = $_REQUEST['campaignID'];
    
    // Delete related records in campaignstable table first
    $stmt_delete_campaignstable = $connection->prepare("DELETE FROM campaigns WHERE campaignID=?");
    $stmt_delete_campaigns->bind_param("i", $campaignID);
    if ($stmt_delete_campaigns->execute()) {
        // If related campaigns are deleted successfully, then delete the campaign record
        $stmt_delete_campaign = $connection->prepare("DELETE FROM campaign WHERE campaignID=?");
        $stmt_delete_campaign->bind_param("i", $campaignID);
        if ($stmt_delete_campaign->execute()) {
            echo "Record deleted successfully.";
        } else {
            echo "Error deleting doctor data: " . $stmt_delete_campaign->error;
        }
        $stmt_delete_campaignstable->close();
    } else {
        echo "Error deleting campaigns data: " . $stmt_delete_campaigns->error;
    }
    $stmt_delete_campaignstable->close();
} else {
    echo "campaignID is not set.";
}

$connection->close();
?>
