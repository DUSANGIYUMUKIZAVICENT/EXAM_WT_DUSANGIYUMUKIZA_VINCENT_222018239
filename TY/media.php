<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Linking to external stylesheet -->
    <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
    <!-- Defining character encoding -->
    <meta charset="utf-8">
    <!-- Setting viewport for responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>media Form</title>
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
  <marquee><h1 style="color: brown;">welcome to donation crowdsourcing platform </h1></marquee>
        <div class="container">
            <div class="container">
<h1>media Form</h1>
<form method="post" action="media.php">

<label for="mediaID">mediaID:</label>
        <input type="number" id="mediaID" name="mediaID" required><br><br>
        <label for="campaignID">campaignID:</label>
        <input type="text" id="campaignID" name="campaignID" required><br><br>
        <label for="mediaURL">mediaURL:</label>
        <input type="text" id="mediaURL" name="mediaURL" required><br><br>

        <label for="mediaType">mediaType:</label>
        <input type="mediaType" id="mediaType" name="mediaType" required><br><br>

<input type="submit" name="add" value="Insert"><br><br>
<marquee><h1 style="color: blue;"> dusangiyumukiza vincent222018239 </h1></marquee>

            
            <?php
            include('database_connection.php');


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    $mediaID = $_POST['mediaID'];
    $campaignID = $_POST['campaignID'];
    $mediaURL = $_POST['mediaURL'];
    $mediaType = $_POST['mediaType'];
     

    $stmt = $connection->prepare("INSERT INTO media (mediaID, campaignID, mediaURL, mediaType) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", mediaID, $campaignID, $mediaURL, $mediaType);

    if ($stmt->execute()) {
        echo "New record has been added successfully.<br><br>
            <a href='medical_records.html'>Back to Form</a>";
    } else {
        echo "Error inserting data: " . $stmt->error;
    }
}

$sql = "SELECT * FROM mediatables";
$result = $connection->query($sql);
?>
<!-- Your form HTML here -->

   <center><h2>Table of media</h2></center>
    <table border="5">
        <tr>
            <th>mediaID</th>
            <th>campaignID</th>
            <th>mediaURL</th>
            <th>mediatype</th>  
            
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php 
        // Output data of each row
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["mediaID"] . "</td>
                      <td>" . $row["campaignID"] . "</td>
                      <td>" . $row["mediaURL"] . "</td>
                      <td>" . $row["mediaType"] . "</td>
                      
                      <td><a style='padding:4px' href='delete_media.php?mediaID=" . $row["record_id"] . "'>Delete</a></td>
                      <td><a style='padding:4px' href='update_media.php?mediaID=" . $row["mediaID"] . "'>Update</a></td>
                  </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No data found</td></tr>";
        }
        ?>        
    </table>

    <!-- Footer -->
    <footer>
        <center> 
            <b>UR CBE BIT &copy; 2024 &reg;, Designed by:dusangiyumukiza vincent222018239</b>
        </center>
    </footer>
</body>
</html>
