<?php
include('database_connection.php');

// Check if volunteerID is set
if(isset($_REQUEST['volunteerID'])) {
    $volunteerID = $_REQUEST['    volunteerID'];
   
    // Prepare and execute SELECT statement to retrieve volunteer's details
    $stmt = $connection->prepare("SELECT * FROM volunter WHERE volunteerID = ?");
    $stmt->bind_param("i", $volunteerID);
    $stmt->execute();
    $result = $stmt->get_result();
   
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $volunteerID = $row['volunteerID'];
        $contactinfo = $row['contactinfo'];
        $availability = $row['availability'];
        $assignedtasks = $row['assignedtasks'];
        $skills = $row['skills'];
        
        
    } else {
        echo "volunteer not found.";
    }
}

?>

<html>
<body>
    <form method="POST">
        <label for="volunteerID">volunteerID:</label>
        <input type="number" name="volunteerID" value="<?php echo isset($volunteerID) ? $volunteerID : ''; ?>">
        <br><br>

        

        <label for="contactinfo">contactinfo:</label>
        <input type="number" name="contactinfo" value="<?php echo isset($contactinfo) ? $contactinfo : ''; ?>">
        <br><br>
       
        <label for="availability">availability:</label>
        <input type="availability" name="availability" value="<?php echo isset($availability) ? $availability : ''; ?>">
        <br><br>
       
        <label for="assignedtasks">assignedtasks:</label>
        <input type="text" name="assignedtasks" value="<?php echo isset($assignedtasks) ? $assignedtasks : ''; ?>">
        <br><br>
       
        <label for="skills">skills:</label>
        <input type="text" name="skills" value="<?php echo isset($skills) ? $skills : ''; ?>">
        <br><br>
        

       
        <input type="submit" name="up" value="Update">
       
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $volunteerID = $_POST['volunteerID'];
    
    $availability = $_POST['availability'];
    $assignedtasks = $_POST['assignedtasks'];
    $skills = $_POST['skills'];
    
    $contactinfo = $_POST['contactinfo'];

    // Update the volunteer in the database
    $stmt = $connection->prepare("UPDATE volunteer SET availability=?, assignedtasks=?, skills=?, contactinfo=?WHERE volunteerID=?");
    $stmt->bind_param("sssssi", $availability, $assignedtasks, $skills, $contactinfo,  $volunteerID);
   
    if ($stmt->execute()) {
        // Redirect to campaigns.php after successful update
        header('Location: volunteer.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating volunteer: " . $stmt->error;
    }
}
?>
