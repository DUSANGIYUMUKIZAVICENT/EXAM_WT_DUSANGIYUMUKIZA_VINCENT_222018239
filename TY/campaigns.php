<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Linking to external stylesheet -->
    <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
    <!-- Defining character encoding -->
    <meta charset="utf-8">
    <!-- Setting viewport for responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>campaigns Form</title>
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

<body><body bgcolor="yellow">
  <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 15px;">
    
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
        <h1>campaigns Form</h1>
            <form method="post" action="campaigns.php">
                <label for="campaignsID">campaignsID:</label>
                <input type="text" id="campaignsID" name="campaignsID"><br><br>

                <label for="campaignname">campaignname:</label>
                <input type="text" id="campaignname" name="campaignname" required><br><br>

                <label for="descriptin">description:</label>
                <input type="text" id="description" name="description" required><br><br>

                <label for="goal">goal:</label>
                <input type="text" id="goal" name="goal" required><br><br>

                <label for="startdate">startdate:</label>
                <input type="text" id="startdate" name="startdate" required><br><br>

                <label for="enddate">enddate:</label>
                <input type="text" id="enddate" name="enddate" required><br><br>
                <label for="organizerID">organizerID:</label>


                <input type="text" id="organizerID" name="organizerID" required><br><br>
                <input type="submit" name="add" value="Insert"><br><br>
            <marquee><h1 style="color: green;"> dusangiyumukiza vincent222018239 </h1></marquee>

        <!-- PHP code starts here -->

        <?php
        include('database_connection.php');
        // Check if the form is submitted for insert
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
            // Insert section
            $stmt = $connection->prepare("INSERT INTO campaigns (campaignsID, campaignsname, description, goal, startdate, enddate,organizerID) VALUES (?, ?, ?, ?, ?, ?,?)");
            $stmt->bind_param("sssssi", $campaignsID, $campaignsname, $description, $goal, $startdate, $enddate,$organizerID);
// Set parameters from POST and execute
            $compaignID = $_POST['campaignID'];
            $campaignsname = $_POST['campaignsname'];
            $description = $_POST['description'];
            $goal = $_POST['goal'];
            $startdate = $_POST['startdate'];
            
            $enddate = $_POST['enddate'];
            $organizerID = $_POST['organizerID'];

            if ($stmt->execute()) {
                echo "New record has been added successfully.<br><br>
                     <a href='campaigns.html'>Back to Form</a>";
            } else {
                echo "Error inserting data: " . $stmt->error;
            }

            $stmt->close();
        }

        // SQL query to fetch data from the campaigns table
        $sql = "SELECT * FROM campaigns";
        $result = $connection->query($sql);
        ?>

        <!-- Displaying fetched data in a table -->
        <table>
            <tr>
                <th>campaignID</th>
                <th>campaignsname</th>
                <th>description</th>
                <th>goal</th>
                <th>startdate</th>
                
                <th>enddate</th>
                <th>organizerID</th>
            </tr> 
            <?php 
            // Output data of each row
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["compaignID"] . "</td>
                          <td>" . $row["compaignsname"] . "</td>
                          <td>" . $row["description"] . "</td> 
                          <td>" . $row["goal"] . "</td>
                          <td>" . $row["startdate"] . "</td>
                          <td>" . $row["enddate"] . "</td>
                          <td>" . $row["organizerID"] . "</td>
                          <td><a style='padding:4px' href='delete_campaigns.php?compaignID=" . $row["campaignID"] . "'>Delete</a></td>
                          <td><a style='padding:4px' href='update_compaigns.php?compaignID=" . $row["compaignID"] . "'>Update</a></td>
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
