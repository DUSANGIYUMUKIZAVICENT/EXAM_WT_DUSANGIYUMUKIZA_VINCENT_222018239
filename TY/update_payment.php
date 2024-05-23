<?php
include('database_connection.php');
// Check if paymentID is set
if(isset($_REQUEST['paymentID'])) {
    $paymentID = $_REQUEST['paymentID'];
   
    // Prepare and execute SELECT statement to retrieve payment details
    $stmt = $connection->prepare("SELECT * FROM payment WHERE paymentID = ?");
    $stmt->bind_param("i", $paymentID);
    $stmt->execute();
    $result = $stmt->get_result();
   
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $paymentID = $row['paymentID'];
        $donorID = $row['donorID'];
        $amount = $row['amount'];
        $timestamp = $row['timestamp'];
    } else {
        echo "payment not found.";
    }
}

?>

<html>
<body>
    <form method="POST">
        <label for="paymentID">payment ID:</label>
        <input type="number" name="paymentID" value="<?php echo isset($paymentID) ? $paymentID : ''; ?>">
        <br><br>

        <label for="donorID">donorID:</label>
        <input type="number" name="donorID" value="<?php echo isset($donorID) ? $donorID : ''; ?>">
        <br><br>

        <label for="amount">amount:</label>
        <input type="number" name="amount" value="<?php echo isset($amount) ? $amount : ''; ?>">
        <br><br>
       
        <label for="timestamp">timestamp:</label>
        <input type="text" name="timestamp" value="<?php echo isset($timestamp) ? $timestamp : ''; ?>">
        <br><br>
       
        <input type="submit" name="up" value="Update">
       
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $paymentID = $_POST['paymentID'];
    $donorID = $_POST['donorID'];
    $amount = $_POST['amount'];
    $timestamp = $_POST['timestamp'];

    // Update the payment in the database
    $stmt = $connection->prepare("UPDATE payment SET donorID=?, amount=?, timestamp=? WHERE paymentID=?");
    $stmt->bind_param("sssi", $donorID, $amount, $timestamp, $paymentID);
   
    if ($stmt->execute()) {
        // Redirect to some_page.php after successful update
        header('Location: payment.php');
        exit();
    } else {
        echo "Error updating payment: " . $stmt->error;
    }
}
?>
