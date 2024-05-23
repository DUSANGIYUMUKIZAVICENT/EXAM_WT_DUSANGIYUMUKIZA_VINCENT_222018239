<?php
include('database_connection.php');


// Check if donationID is set
if(isset($_REQUEST['donationID'])) {
    $patient_id = $_REQUEST['donationID'];
   
    // Prepare and execute SELECT statement to retrieve donations details
    $stmt = $connection->prepare("SELECT * FROM donations WHERE donationID = ?");
    $stmt->bind_param("i", $donationID); // Corrected variable name
    $stmt->execute();
    $result = $stmt->get_result();
   
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['donationID'];
        $y = $row['donorID'];
        $z = $row['campaignID'];
        $v = $row['amount'];
        $w = $row['timestamp']; // Corrected variable name
        $v = $row['paymentstatus'];
        
    } else {
        echo "donations not found."; // Corrected spelling
    }
}

?>

<html>
<body>
    <form method="POST">
        <label for="donationID">donationID:</label>
        <input type="number" name="donationID" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="donorID">donorID:</label>
        <input type="number" name="donorID" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="campaignID">campaignID:</label>
        <input type="number" name="campaignID" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
       
        <label for="amount">amount:</label>
        <input type="number" name="amount" value="<?php echo isset($v) ? $v : ''; ?>">
        <br><br>
       
        <label for="timestamp">timestamp:</label>
        <input type="date" name="timestamp" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>
        <label for="paymentstatus">paymentstatus:</label>
        <input type="number" name="paymentstatus" value="<?php echo isset($v) ? $v : ''; ?>">
        <br><br>
        
       
        <input type="submit" name="up" value="Update">
       
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $donationID = $_POST['donationID'];
    $donorID = $_POST['donorID'];
    $campaignID = $_POST['campaignID'];
    $amount = $_POST['amount'];
    $timestamp = $_POST['timestamp'];
    $paymentstatus = $_POST['paymentstatus'];
   

    // Update the donations in the database
    $stmt = $connection->prepare("UPDATE donations SET donorID=?, campaignID=?, amount=?, timestamp=?, paymentstatus=? WHERE donationID=?");
    $stmt->bind_param("sssisi", $donorID, $campaignID, $amount, $timestamp, $paymentstatus,  $donationID); // Corrected data types and parameter order
   
    if ($stmt->execute()) {
        // Redirect to donations.php after successful update
        header('Location: donations.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating donations: " . $stmt->error;
    }
}
?>
