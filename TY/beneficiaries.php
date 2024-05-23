<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Beneficiaries Form</title>
    <style>
        /* Your CSS styles here */
    </style>
</head>
<body bgcolor="yellow">
    <header>
        <!-- Your header content here -->
    </header>
    <section style="color: orange;">
        <marquee><h1 style="color: brown;">WELCOME TO DONATION CROWDSOURCING PLATFORM</h1></marquee>
        <div class="container">
            <h1>Beneficiariestable Form</h1>
            <form method="post" action="beneficiariestable.php">
                <label for="beneficiaryId">Beneficiary ID</label>
                <input type="number" id="beneficiaryId" name="beneficiaryId"><br><br>

                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required><br><br>

                <label for="description">Description:</label>
                <input type="text" id="description" name="description" required><br><br>

                <label for="contactinfo">Contact Info:</label>
                <input type="text" id="contactinfo" name="contactinfo" required><br><br>

                <input type="submit" name="add" value="Insert"><br><br>
            </form>

            <?php
            include('database_connection.php');

            $sql = "SELECT beneficiaryID, name, description, contactinfo FROM beneficiariestable";
            $result = $connection->query($sql);
            ?>

            <table>
                <tr>
                    <th>Beneficiary ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Contact Info</th>
                    <th>Action</th>
                </tr> 
                <?php
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["beneficiaryID"] . "</td>
                                <td>" . $row["name"] . "</td>
                                <td>" . $row["description"] . "</td> 
                                <td>" . $row["contactinfo"] . "</td>
                                <td>
                                    <a style='padding:4px' href='delete_beneficiaries.php?beneficiaryID=" . $row["beneficiaryID"] . "'>Delete</a>
                                    <a style='padding:4px' href='update_beneficiaries.php?beneficiaryID=" . $row["beneficiaryID"] . "'>Update</a>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No beneficiaries found</td></tr>";
                }
                ?>        
            </table>

            <?php
            $connection->close();
            ?>  
        </div>

        <footer>
            <center> 
                <b>UR CBE BIT &copy; 2024 &reg;, Designed by: Vincent</b>
            </center>
        </footer>
    </section>
</body>
</html>
