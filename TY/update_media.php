<?php
include('database_connection.php');


// Check if mediaID is set
if(isset($_REQUEST['mediaID'])) {
    $id = $_REQUEST['mediaID'];
   
    // Prepare and execute SELECT statement to retrieve media details
    $stmt = $connection->prepare("SELECT * FROM media WHERE  mediaID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
   
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['mediaID'];
        $y = $row['campaignID'];
        $z = $row['mediaURL'];
        $q = $row['mediatype']; // Corrected variable name from 'z' to 'q'
        
    
    } else {
        echo "media not found.";
    }
}

?>

<html>
<body>
    <form method="POST">
        <label for="mediaID">mediaID:</label>
        <input type="number" name="mediaID" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="campaignID">campaignID:</label>
        <input type="number" name="campaignID" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="mediaURL">mediaURL:</label>
        <input type="text" name="mediaURL" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
       
        <label for="mediatype">mediatype:</label>
        <input type="mediatype" name="mediatype" value="<?php echo isset($q) ? $q : ''; ?>"> <!-- Corrected input type -->
        <br><br>
        
    
        <input type="submit" name="up" value="Update">
       
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $mediaID = $_POST['mediaID'];
    $campaignID = $_POST['campaignID'];
    $mediaURL= $_POST['mediaURL'];
    $mediatype = $_POST['mediatype'];
    
    

    // Update the media in the database
    $stmt = $connection->prepare("UPDATE media SET  campaignID=?, mediaURL=?, media type=? WHERE mediaID=?");
    $stmt->bind_param("sssi", $campaignID, $mediaURL, $mediatype,  $mediaID); // Corrected parameter order
   
    if ($stmt->execute()) {
        // Redirect to payment.php after successful update
        header('Location: media.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating media: " . $stmt->error;
    }
}
?>
