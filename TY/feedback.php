<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Linking to external stylesheet -->
    <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
    <!-- Defining character encoding -->
    <meta charset="utf-8">
    <!-- Setting viewport for responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>feedback Form</title>
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
    <li style="display: inline; margin-right: 15px;">
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
  <marquee><h1 style="color: brown;">WELCOME TO DONATION CROWDSOURCING PLATFORM </h1></marquee>
  <div class="container">
        <h1>feedback Form</h1>
<form method="post" action="feedback.php">

<label for="feedbackID">feedbackID:</label>
<input type="number" id="feedbackID" name="feedbackID"><br><br>

<label for="username">userID:</label>
<input type="text" id="userID" name="userID" required><br><br>

<label for="rating">rating:</label>
<input type="text" id="rating" name="rating" required><br><br>

<label for="comment">comment:</label>
<input type="text" id="comment" name="comment" required><br><br>

<input type="submit" name="add" value="Insert"><br><br>
<marquee><h1 style="color: blue;"> dusangiyumukiza vincent222018239 </h1></marquee>

        <!-- PHP code starts here -->

        <?php
        include('database_connection.php');

        // Check if the form is submitted for insert
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
            // Insert section
            $stmt = $connection->prepare("INSERT INTO feedback (feedbackID, userID, rating,comment) VALUES (?, ?, ?,?)");
            $stmt->bind_param("isss", $feedbackID, $userID, $rating,$comment);

            // Set parameters from POST and execute
            $feedbackID = $_POST['feedbackID'];
            $userID = $_POST['userID'];
            $rating = $_POST['rating'];
            $comment = $_POST['comment'];


            


            

            if ($stmt->execute()) {
                echo "New record has been added successfully.<br><br>
                     <a href='feedback.html'>Back to Form</a>";
            } else {
                echo "Error inserting data: " . $stmt->error;
            }

            $stmt->close();
        }

        // SQL query to fetch data from the reports table
        $sql = "SELECT * FROM feedback";
        $result = $connection->query($sql);
        ?>

        <!-- Displaying fetched data in a table -->
        <table>
            <tr>
                <th>feedbackID</th>
                <th>userID</th>
                <th>rating</th>
                <th>comment</th>


                


                
            </tr> 
            <?php 
            // Output data of each row
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["feedbackID"] . "</td>
                          <td>" . $row["userID"] . "</td>
                          <td>" . $row["rating"] . "</td>
                          <td>" . $row["comment"] . "</td>
                          

                          
                          <td><a style='padding:4px' href='delete_feedback.php?feedbackID=" . $row["feedbackID"] . "'>Delete</a></td>
                          <td><a style='padding:4px' href='update_feedback.php?feedbackID=" . $row["feedbackID"] . "'>Update</a></td>
                      </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No data found</td></tr>";
            }
            ?>        
        </table>

        <?php
        // Close connection
        $connection->close();
        ?>  
    </div>

    <!-- Footer -->
    <footer>
        <center> 
            <b>UR CBE BIT &copy; 2024 &reg;, Designed by: vincent</b>
        </center>
    </footer>
</body>
</html>
