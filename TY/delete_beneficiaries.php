<?php
include('database_connection.php');


// Check if beneficiaries is set
if(isset($_REQUEST['beneficiaryID'])) {
    $beneficiaryID = $_REQUEST['beneficiaryID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM beneficiaries WHERE beneficiaryID=?");
    $stmt->bind_param("i", $beneficiaryID);
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $connection->error;
    }

    $stmt->close();
} else {
    echo "beneficiaryID is not set.";
}

$connection->close();
?>
