

<?php
include('database.php');


// Check if feedbackID is set
if(isset($_REQUEST['feedbackID'])) {
    $feedbackID = $_REQUEST['feedbackID'];
   
    // Prepare and execute SELECT statement to retrieve feedback details
    $stmt = $connection->prepare("SELECT * FROM feedback WHERE feedbackID = ?");
    $stmt->bind_param("i", $feedbackID);
    $stmt->execute();
    $result = $stmt->get_result();
   
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $feedbackID = $row['feedbackID'];
        $userID = $row['userID'];
        $rating = $row['rating'];
        $comment = $row['comment'];
        
    } else {
        echo "feedback not found.";
    }
}

?>

<html>
<body>
    <form method="POST">
        <label for="feedbackID">feedback ID:</label>
        <input type="number" name="feedbackID" value="<?php echo isset($feedbackID) ? $feedbackID : ''; ?>">
        <br><br>

        <label for="userID">user ID:</label>
        <input type="number" name="userID" value="<?php echo isset($userID) ? $userID : ''; ?>">
        <br><br>

        <label for="rating">rating:</label>
        <input type="number" name="rating" value="<?php echo isset($rating) ? $rating : ''; ?>">
        <br><br>
       
        <label for="comment">coment:</label>
        <input type="text" name="comment" value="<?php echo isset($comment) ? $comment : ''; ?>">
        <br><br>
       
       
       
        <input type="submit" name="up" value="Update">
       
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $feedbackID = $_POST['feedbackID'];
    $userID = $_POST['userID'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
   
    // Update the feedback in the database
    $stmt = $connection->prepare("UPDATE feedback SET feedbackID=?, userID=?, rating=?, comment=? WHERE feedbackID=?");
    $stmt->bind_param("sssi", $feedbackID, $userID, $rating, $comment);
   
    if ($stmt->execute()) {
        // Redirect to feedback.php after successful update
        header('Location: feedback.php');
        exit();
    } else {
        echo "Error updating feedback: " . $stmt->error;
    }
}
?>
