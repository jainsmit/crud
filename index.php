<!DOCTYPE html>
<html>
<head>
        <title>MySQL Table Viewer</title>
</head>
<body>
        <h1>MySQL Table Viewer</h1>
        <?php
                // Define database connection variables
                $servername = "mysql-gl-test-server.mysql.database.azure.com";
                $username = "myadmin";
                $password = "smit2682@JAIN";
                $dbname = "mydatabase";
                $certpath = "/var/www/html/DigiCertGlobalRootCA.crt.pem";

                // Create database connection
                //$conn = new mysqli($servername, $username, $password, $dbname);
                $conn = mysqli_init();
                mysqli_ssl_set($conn,NULL,NULL, "$certpath", NULL, NULL);
                mysqli_real_connect($conn, $servername, $username, $password, $dbname, 3306, MYSQLI_CLIENT_SSL);

                // Check connection
                if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                }

                // Query database for all rows in the table
                $sql = "SELECT * FROM employees LIMIT 100";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                        // Display table headers
                        echo "<table><tr><th> ID </th> <th> Name  </th> <th> Email </th></tr>";
                        // Loop through results and display each row in the table
                        while($row = $result->fetch_assoc()) {
                                echo "<tr><td>" . $row["emp_no"] . "</td><td>" . $row["first_name"]. " ". $row["last_name"]. "</td><td>" . $row["email_id"] . "</td></tr>";
                        }
                        echo "</table>";
                } else {
                        echo "0 results";
                }

                // Close database connection
                $conn->close();
        ?>
</body>
</html>
