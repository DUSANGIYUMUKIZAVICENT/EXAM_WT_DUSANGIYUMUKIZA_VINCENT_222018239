<?php
include('database_connection.php');

// Check if campaignID is set
if(isset($_REQUEST['campaignID'])) {
    $campaignID = $_REQUEST['	campaignID'];
   
    // Prepare and execute SELECT statement to retrieve campaigns details
    $stmt = $connection->prepare("SELECT * FROM campaigns WHERE campaignID = ?");
    $stmt->bind_param("i", $campaignID);
    $stmt->execute();
    $result = $stmt->get_result();
   
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $campaignID = $row['campaignID'];
        $campaignname = $row['campaignname'];
        $description = $row['description'];
        $goal = $row['goal'];
        $startdate = $row['startdate'];
        $enddate = $row['enddate'];
        $organizerID = $row['organizerID'];
    } else {
        echo "campaigns not found.";
    }
}

?>

<html>
<body>
    <form method="POST">
        <label for="campaignID">campaignsID:</label>
        <input type="number" name="campaignID" value="<?php echo isset($campaignID) ? $campaignID : ''; ?>">
        <br><br>

        <label for="campaignname">campaignname:</label>
        <input type="text" name="campaignname" value="<?php echo isset($campaignname) ? $campaignname : ''; ?>">
        <br><br>

        <label for="description">description:</label>
        <input type="text" name="description" value="<?php echo isset($description) ? $description : ''; ?>">
        <br><br>
       
        <label for="goal">goal:</label>
        <input type="goal" name="goal" value="<?php echo isset($goal) ? $goal : ''; ?>">
        <br><br>
       
        <label for="startdate">enddate:</label>
        <input type="date" name="startdate" value="<?php echo isset($startdate) ? $startdate : ''; ?>">
        <br><br>
       
        <label for="enddate">enddate:</label>
        <input type="date" name="enddate" value="<?php echo isset($enddate) ? $enddate : ''; ?>">
        <br><br>
        <label for="organizerID">organizerID:</label>
        <input type="number" name="organizerID" value="<?php echo isset($organizerID) ? $organizer : ''; ?>">
        <br><br>
        

       
        <input type="submit" name="up" value="Update">
       
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $campaignID = $_POST['campaignID'];
    $campaignname = $_POST['campaignname'];
    $description = $_POST['description'];
    $goal = $_POST['goal'];
    $startdate = $_POST['startdate'];
    $senddate = $_POST['enddate'];
    $organizerID = $_POST['organizerID'];

    // Update the campaigns in the database
    $stmt = $connection->prepare("UPDATE campaigns SET campaignname=?, description=?, goal=?, startdate=?, enddate=?, organizerID=?WHERE campaignID=?");
    $stmt->bind_param("sssssii", $campaignname, $description, $goal, $startdate, $enddate, $organizerID);
   
    if ($stmt->execute()) {
        // Redirect to campaigns.php after successful update
        header('Location: campaigns.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating campaigns: " . $stmt->error;
    }
}
?>
