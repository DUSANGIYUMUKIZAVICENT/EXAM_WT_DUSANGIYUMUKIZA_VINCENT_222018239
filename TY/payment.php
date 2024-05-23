<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Linking to external stylesheet -->
    <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
    <!-- Defining character encoding -->
    <meta charset="utf-8">
    <!-- Setting viewport for responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>payment Form</title>
       <style>
    /* Normal link */
    a {
      padding: 5px;
      color: white;
      background-color: pink;
      text-decoration: none;
      margin-right: 1px;
    }

    /* Visited link */
    a:visited {
      color: purple;
    }
    /* Unvisited link */
    a:link {
      color: brown; /* Changed to lowercase */
    }
    /* Hover effect */
    a:hover {
      background-color: white;
    }

    /* Active link */
    a:active {
      background-color: red;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
    }
    /* Extend margin left for search button */
    input.form-control {
      margin-left: 1200px; /* Adjust this value as needed */

      padding: 8px;
     
    }
  </style>
  </head>

  <header>

<body><body bgcolor="greenyellow">
  <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;"><img src="./Images/STATUS.jpg" width="90" height="60" alt="Logo"></li>
    <li style="display: inline; margin-right: 10px;"><a href="./home.html">home</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html">about</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">contact</a></li>
    
    <li style="display: inline; margin-right: 10px;"><a href="./campaigns.html">campaigns</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./donations.html">donations</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./beneficiaries.html">beneficiaries</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./reports.html">reports</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./media.html">media</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./volunteer.html">volunteer</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./payment.html">payment</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./notification.html">notification</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./feedback.html">feedback</a></li>
  
  
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
      </div>
    </li><br><br>
    
    
    
  </ul>

</header>
<section style=" color: orange;">
  <marquee><h1 style="color: brown;">WELCOME TO donation crowdsourcing platform </h1></marquee>
  <div class="container">



<h1>payment Form</h1>
<form method="post" action="payment.php">

<label for="paymentID">paymentID:</label>
<input type="number" id="paymentID" name="paymentID"><br><br>

<label for="donorID">donorID:</label>
<input type="number" id="donorID" name="donorID" required><br><br>

<label for="amount">Amount:</label>
<input type="number" id="amount" name="amount" required><br><br>

<label for="transactionID">transactionID:</label>
<input type="transactionID" id="transactionID" name="transactionID" required><br><br>
<label for="timestamp">timestamp:</label>
<input type="text" id="timestamp" name="timestamp" required><br><br>
        <input type="submit" name="add" value="Insert"><br><br>
<marquee><h1 style="color: green;"> dusangiyumukiza vincent222018239 </h1></marquee>
        <!-- PHP code starts here -->

        <?php
        include('database_conection.php');

// Check if the form is submitted for insert
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    // Insert section
    $stmt = $connection->prepare("INSERT INTO payment (paymentID, donorID, transactionID, amount, timestamp) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $paymentID, $donorID, $transactionID, $amount, $timestamp);
    // Set parameters from POST and execute
    $paymentID = $_POST['donorID'];
    $transactionID = $_POST['transactionID'];
    $amount = $_POST['amount']; // Corrected here
    $transactionID = $_POST['transactionID'];
    $timestamp = $_POST['timestamp'];

    if ($stmt->execute()) {
        echo "New record has been added successfully.<br><br>
             <a href='payment.php'>Back to Form</a>";
    } else {
        echo "Error inserting data: " . $stmt->error;
    }

    $stmt->close();
}

// SQL query to fetch data from the pharmacy table
$sql = "SELECT * FROM payment";
$result = $connection->query($sql);
?>

<!-- Displaying fetched data in a table -->
<table>
    <tr>
        <th>paymentID</th>
        <th>donorID</th>
        <th>transactionID</th>
        <th>amount</th>
        <th>timestamp</th>
    </tr> 
    <?php 
    // Output data of each row
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["paymentID"] . "</td>
                  <td>" . $row["donorID"] . "</td>
                  <td>" . $row["transactionID"] . "</td> <!-- Corrected here -->
                  <td>" . $row["amount"] . "</td>
                  <td>" . $row["timestamp"] . "</td>
                  <td><a style='padding:4px' href='delete_payment.php?paymentID=" . $row["paymentID"] . "'>Delete</a></td>
                  <td><a style='padding:4px' href='update_payment.php?paymentID=" . $row["paymentID"] . "'>Update</a></td>
              </td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='9'>No data found</td></tr>";
    }
    ?>        
</table>

<?php
// Close connection
$connection->close();
?>  
<footer>
    <center> 
        <b>UR CBE BIT &copy; 2024 &reg;, created by:dusangiyumukiza vincent</b>
    </center>
</footer>
</body>
</html>
