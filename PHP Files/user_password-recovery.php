<?php
    $servername = "localhost";
    $port = 3306;
    $username = "supra";
    $password = "supra@12345";
    $database = "railway";

    $conn = new mysqli($servername . ':' . $port, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $recover_email = $_POST['recover_email'];

        $sql_check_email = "SELECT * FROM Users WHERE Email='$recover_email'";
        $result_check_email = $conn->query($sql_check_email);
        if ($result_check_email->num_rows > 0) {
            echo "Password recovery instructions sent to your email";
        } 
        else {
            echo "Email not found";
        }
    }

    $conn->close();
?>
