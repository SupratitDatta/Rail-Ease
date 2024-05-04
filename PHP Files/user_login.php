<?php
    session_start();
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
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $sql = "SELECT * FROM Users WHERE Username='$username' AND Password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $_SESSION['username'] = $username;
            header("Location: user_dashboard.php");
            exit();
        } 
        else {
            echo "<script>
                    setTimeout(function() {
                        alert('Invalid username or password');
                        window.location.href = '../Web Pages/user_login.html';
                    }, 100); // Delay in milliseconds
                </script>";
        }
    }
    $conn->close();
?>
