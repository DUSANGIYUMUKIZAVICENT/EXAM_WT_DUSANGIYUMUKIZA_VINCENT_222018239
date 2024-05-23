<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Linking to external stylesheet -->
    <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
    <!-- Defining character encoding -->
    <meta charset="utf-8">
    <!-- Setting viewport for responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reports Form</title>
    <style>
        /* CSS styles */
        a {
            padding: 5px;
            color: white;
            background-color: pink;
            text-decoration: none;
            margin-right: 1px;
        }
        a:visited {
            color: purple;
        }
        a:link {
            color: brown; 
        }
        a:hover {
            background-color: white;
        }
        a:active {
            background-color: red;
        }
        button.btn {
            margin-left: 15px;
            margin-top: 4px;
        }
        input.form-control {
            margin-left: 1200px;
            padding: 8px;
        }
    </style>
</head>
<body bgcolor="greenyellow">
<header>
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
                        <a href="login.html">Login</a>
                        <a href="register.html">Register</a>
                        <a href="logout.php">Logout</a>
                    </div>
                </li><br><br>
            </ul>
        </li>
    </ul>
</header>
<section style="color: orange;">
    <marquee><h1 style="color: brown;">WELCOME TO DONATION CROWDSOURCING PLATFORM </h1></marquee>
    <div class="container">
        <h1>Reports Form</h1>
        <form method="post" action="reports.php">
            <label for="reportID">Report ID:</label>
            <input type="number" id="reportID" name="reportID"><br><br>

            <label for="reportname">Report Name:</label>
            <input type="text" id="reportname" name="reportname" required><br><br>

            <label for="description">Description:</label>
            <input type="text" id="description" name="description" required><br><br>

            <input type="submit" name="add" value="Insert"><br><br>
            <marquee><h1 style="color: blue;">Dusangiyumukiza Vincent222018239 </h1></marquee>

            <!-- PHP code starts here -->
            <?php
            include('database.php');

            // Check if the form is submitted for insert
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
                // Insert section
                $stmt = $connection->prepare("INSERT INTO reports (reportID, reportname, Description) VALUES (?, ?, ?)");
                $stmt->bind_param("iss", $reportID, $reportname, $description);

                // Set parameters from POST and execute
                $reportID = $_POST['reportID'];
                $reportname = $_POST['reportname'];
                $description = $_POST['description'];

                if ($stmt->execute()) {
                    echo "New record has been added successfully.<br><br>
                     <a href='reports.html'>Back to Form</a>";
                } else {
                    echo "Error inserting data: " . $stmt->error;
                }

                $stmt->close();
            }

            // SQL query to fetch data from the reports table
            $sql = "SELECT * FROM reports";
            $result = $connection->query($sql);
            ?>

            <!-- Displaying fetched data in a table -->
            <table>
                <tr>
                    <th>Report ID</th>
                    <th>Report Name</th>
                    <th>Description</th>
                </tr> 
                <?php 
                // Output data of each row
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["reportID"] . "</td>
                          <td>" . $row["reportname"] . "</td>
                          <td>" . $row["Description"] . "</td> 
                          
                          <td><a style='padding:4px' href='delete_reports.php?reportID=" . $row["reportID"] . "'>Delete</a></td>
                          <td><a style='padding:4px' href='update_reports.php?reportID=" . $row["reportID"] . "'>Update</a></td>
                      </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No data found</td></tr>";
                }
                ?>        
            </table>

            <?php
            // Close connection
            $connection->close();
            ?>  
        </form>
    </div>

    <!-- Footer -->
    <footer>
        <center> 
            <b>UR CBE BIT &copy; 2024 &reg;, Designed by: Vincent</b>
        </center>
    </footer>
</section>
</body>
</html>
