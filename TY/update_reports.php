<?php
include('database_connection.php');

// Check if reportID is set
if(isset($_REQUEST['reportID'])) {
    $record_id = $_REQUEST['reportID'];
   
    // Prepare and execute SELECT statement to retrieve reports details
    $stmt = $connection->prepare("SELECT * FROM reports WHERE reportID = ?");
    $stmt->bind_param("i", $reportID);
    $stmt->execute();
    $result = $stmt->get_result();
   
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $reportID = $row['reportID'];
        $reportname = $row['reportname'];
        $description = $row['description'];
        
    } else {
        echo "reports not found.";
    }
}

?>

<html>
<body>
    <form method="POST">
        <label for="reportID">reportID:</label>
        <input type="number" name="reportID" value="<?php echo isset($record_id) ? $reportID : ''; ?>">
        <br><br>

        <label for="reportname">reportname:</label>
        <input type="text" name="reportname" value="<?php echo isset($reportname) ? $reportname : ''; ?>">
        <br><br>

        <label for="description">description:</label>
        <input type="text" name="description" value="<?php echo isset($description) ? $description : ''; ?>">
        <br><br>
       
        <
       
        <input type="submit" name="up" value="Update">
       
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $ = $_POST['reportID'];
    $reportID = $_POST['reportID'];
    $reportname = $_POST['reportname'];
    $description = $_POST['description'];
    
    // Update the reports in the database
    $stmt = $connection->prepare("UPDATE reports SET  reportname=?, description=? WHERE reportID=?");
    $stmt->bind_param("iis", $reportname, $description, $reportID);
   
    if ($stmt->execute()) {
        // Redirect to reports.php after successful update
        header('Location: reports.php');
        exit();
    } else {
        echo "Error updating reports: " . $stmt->error;
    }
}
?>
