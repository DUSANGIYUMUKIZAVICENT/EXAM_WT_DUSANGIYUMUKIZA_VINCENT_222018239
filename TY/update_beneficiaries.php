<?php
include('database_connection.php');

// Check if beneficiaryID is set
if(isset($_REQUEST['beneficiaryID'])) {
    $beneficiaryID = $_REQUEST['beneficiaryID'];
   
    // Prepare and execute SELECT statement to retrieve beneficiaries details
    $stmt = $connection->prepare("SELECT * FROM beneficiaries WHERE beneficiaryID = ?");
    $stmt->bind_param("i", $beneficiaryID);
    $stmt->execute();
    $result = $stmt->get_result();
   
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $beneficiaryID = $row['beneficiaryID'];
        $name = $row['name'];
        $description = $row['description'];
        $contactinfo = $row['contactinfo'];
    } else {
        echo "Beneficiaries not found.";
    }
}

?>

<html>
<body>
    <form method="POST">
        <label for="beneficiaryID">Beneficiary ID:</label>
        <input type="number" name="beneficiaryID" value="<?php echo isset($beneficiaryID) ? $beneficiaryID : ''; ?>">
        <br><br>

        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo isset($name) ? $name : ''; ?>">
        <br><br>

        <label for="description">Description:</label>
        <input type="text" name="description" value="<?php echo isset($description) ? $description : ''; ?>">
        <br><br>
       
        <label for="contactinfo">Contact Info:</label>
        <input type="text" name="contactinfo" value="<?php echo isset($contactinfo) ? $contactinfo : ''; ?>">
        <br><br>
       
        <input type="submit" name="up" value="Update">
       
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $beneficiaryID = $_POST['beneficiaryID'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $contactinfo = $_POST['contactinfo'];

    // Update the beneficiaries in the database
    $stmt = $connection->prepare("UPDATE beneficiaries SET name=?, description=?, contactinfo=? WHERE beneficiaryID=?");
    $stmt->bind_param("sssi", $name, $description, $contactinfo, $beneficiaryID);
   
    if ($stmt->execute()) {
        // Redirect to some_page.php after successful update
        header('Location: beneficiaries.php');
        exit();
    } else {
        echo "Error updating beneficiaries: " . $stmt->error;
    }
}
?>
