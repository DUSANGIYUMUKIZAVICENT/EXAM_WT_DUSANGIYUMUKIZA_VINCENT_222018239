  <?php
            // Database connection details
            $host = "localhost";
            $user = "POULISCA";
            $pass = "222018239";
            $database = "donation_crowdsourcing_platform";

            // Creating connection
            $connection = new mysqli($host, $user, $pass, $database);
            // Check connection
            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }

            ?>
