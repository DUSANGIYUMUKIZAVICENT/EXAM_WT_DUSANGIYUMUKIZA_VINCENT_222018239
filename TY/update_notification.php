<?php
include('database_connection.php');

// Check if notification is set
if(isset($_REQUEST['notificationID'])) {
    $doctor_id = $_REQUEST['    notificationID'];
   
    // Prepare and execute SELECT statement to retrieve notification details
    $stmt = $connection->prepare("SELECT * FROM notification WHERE notificationID = ?");
    $stmt->bind_param("i", $notificationID);
    $stmt->execute();
    $result = $stmt->get_result();
   
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $notificationID = $row['notificationID'];
        $message = $row['message'];
        $timestamp = $row['timestamp'];
        $isread = $row['isread'];
        
    } else {
        echo "notification not found.";
    }
}

?>

<html>
<body>
    <form method="POST">
        <label for="notificationID">notificationID:</label>
        <input type="number" name="notificationID" value="<?php echo isset($notificationID) ? $notificationID : ''; ?>">
        <br><br>

        <label for="message">message:</label>
        <input type="text" name="message" value="<?php echo isset($message) ? $message : ''; ?>">
        <br><br>

        <label for="timestamp">timestamp:</label>
        <input type="text" name="timestamp" value="<?php echo isset($timestamp) ? $timestamp : ''; ?>">
        <br><br>
       
        <label for="isread">isread:</label>
        <input type="text" name="isread" value="<?php echo isset($isread) ? $isread : ''; ?>">
        <br><br>
       
       
       
       
        
        

       
        <input type="submit" name="up" value="Update">
       
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $notificationID = $_POST['notificationID'];
    $message = $_POST['message'];
    $timestamp = $_POST['timestamp'];
    $isread = $_POST['isread'];
    

    // Update the notification in the database
    $stmt = $connection->prepare("UPDATE notification SET message=?, timestamp=?, isread=?WHERE notificationID=?");
    $stmt->bind_param("ssii", $message, $timestamp, $isread,   notificationID);
   
    if ($stmt->execute()) {
        // Redirect to notification.php after successful update
        header('Location: notification.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating notification: " . $stmt->error;
    }
}
?>
