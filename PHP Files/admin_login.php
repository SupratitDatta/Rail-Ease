<?php
session_start();
$servername = "localhost";
$port = 3306;
$username = "supra";
$password = "supra@12345";
$database = "railway";

$conn = new mysqli($servername, $username, $password, $database, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_username = $_POST['admin_username'];
    $admin_password = $_POST['admin_password'];
    
    $sql = "SELECT Username, Email FROM Admins WHERE Username='$admin_username' AND Password='$admin_password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['admin_username'] = $row['Username'];
        $_SESSION['admin_email'] = $row['Email']; 
        header("Location: ./admin_panel.php");
        exit();
    } 
    else {
        echo "<script>
                setTimeout(function() {
                    alert('Invalid admin username or password');
                    window.location.href = '../Web Pages/admin_login-signup.html';
                }, 100); // Delay in milliseconds
            </script>";
    }
}
$conn->close();
?>
