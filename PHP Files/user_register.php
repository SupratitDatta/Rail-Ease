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
        $reg_username = $_POST['reg_username'];
        $reg_password = $_POST['reg_password'];

        $sql_check_username = "SELECT * FROM Users WHERE Username='$reg_username'";
        $result_check_username = $conn->query($sql_check_username);
        
        if ($result_check_username->num_rows > 0) {
            echo "<script>
                    setTimeout(function() {
                        alert('User already exists, Please Log In');
                        window.location.href = '../Web Pages/user_registration.html';
                    }, 100); // Delay in milliseconds
                </script>";
        } 
        else {
            $sql_insert_user = "INSERT INTO Users (Username, Password, Role) VALUES ('$reg_username', '$reg_password', 'user')";
            if ($conn->query($sql_insert_user) === TRUE) {
                echo "<script>
                    setTimeout(function() {
                        alert('User registered successfully');
                        window.location.href = 'index.php';
                    }, 100); // Delay in milliseconds
                </script>";
            } 
            else {
                echo "Error: " . $sql_insert_user . "<br>" . $conn->error;
            }
        }
    }
    $conn->close();
?>