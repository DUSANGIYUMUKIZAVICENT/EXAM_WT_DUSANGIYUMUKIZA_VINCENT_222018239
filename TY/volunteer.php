

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Linking to external stylesheet -->
    <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
    <!-- Defining character encoding -->
    <meta charset="utf-8">
    <!-- Setting viewport for responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>volunteer Form</title>
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
    <li class="dropdown" style="display: inline; margin-right: 5px;">
      <a href="#" style="padding: 5px; color: blue; background-color: skyblue; text-decoration: none; margin-right: 5px;">Settings</a>
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
            <form method="post">

<h1>volunteer Form</h1>
<form method="post" action="volunteer.php">

<label for="volunteerID">volunterID:</label>
<input type="number" id="volunterID" name="volunterID"><br><br>

<label for="userID">userID:</label>
<input type="number" id="contactinfo" name="contactinfo" required><br><br>

<label for="availability">availability:</label>
<input type="number" id="availability" name="availability" required><br><br>

<label for="assignedtasks"> assignedtasks:</label>
<input type="assignedtasks" id="assignedtasks" name="assignedtasks" required><br><br>
<label for="skills">skills:</label>
<input type="text" id="skills" name="skills" required><br><br>

<input type="text" id="status" name="status" required><br><br>
<input type="submit" name="add" value="Insert"><br><br>
<marquee><h1 style="color: bisque;"> DUSANGIYUMUKIZA VINCENT222018239</h1></marquee>

            <!-- Your PHP code for inserting and displaying data -->
            <?php
            include('database.php');
            

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
                $volunteer = $_POST['volunterID'];
                $userID = $_POST['userID'];
                $contactinfo = $_POST['contactinfo'];
                $availability = $_POST['availability']; // Corrected variable name
                $assignedtasks = $_POST['assignedtasks'];
                $skills= $_POST['skills'];
                

                $stmt = $connection->prepare("INSERT INTO volunteer(volunterID,userID, contactinfo, availability, assignedtasks, skills) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssi", $volunterID, $userID, $contactinfo, $availability, $assignedtasks, $skills);

                if ($stmt->execute()) {
                    echo "New record has been added successfully.<br><br>
                        <a href='volunteer.html'>Back to Form</a>";
                } else {
                    echo "Error inserting data: " . $stmt->error;
                }

                $stmt->close();
            }

            $sql = "SELECT * FROM volunteer";
            $result = $connection->query($sql);

            if ($result->num_rows > 0) {
                echo "<table>
                        <tr>
                            <th>volunterID</th>
                            <th>userID</th>
                            <th>availability</th>
                            <th>assignedtasks</th>
                            <th>contactinfo</th>
                            <th>skills</th>
                            
                        </tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["volunterID"] . "</td>
                            <td>" . $row["userID"] . "</td>
                            <td>" . $row["contactinfo"] . "</td>
                            <td>" . $row["availability"] . "</td>
                            <td>" . $row["assignedtasks"] . "</td>
                            <td>" . $row["skills"] . "</td>
                            <td><a style='padding:4px' href='delete_volunteer.php?volunteerID=" . $row["volunteerID"] . "'>Delete</a></td>
                    <td><a style='padding:4px' href='update_volunteer.php?volunteerID=" . $row["volunteerID"] . "'>Update</a></td>
                </tr>";
            
                }

            } else {
                echo "<tr><td colspan='5'>No data found</td></tr>";
            }
            ?>        
        </table>

        <?php
        // Close connection
        $connection->close();
        ?>  
    </div>

    <footer>
        <center> 
            <b>UR CBE BIT &copy; 2024 &reg;, Designed by: dusangiyumukiza vincent222018239</b>
        </center>
    </footer>
</body>
</html>
