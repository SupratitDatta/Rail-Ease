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
        $admin_email = $_POST['admin_email'];
        $admin_id = $_POST['admin_id'];
        $admin_username = $_POST['admin_username'];
        $admin_password = $_POST['admin_password'];

        $sql_check_email = "SELECT * FROM Admins WHERE Email='$admin_email'";
        $result_check_email = $conn->query($sql_check_email);
        if ($result_check_email->num_rows > 0) {
            echo "<script>
                    setTimeout(function() {
                        alert('Admin with this email already exists');
                        window.location.href = '../Web Pages/admin_registration.html';
                    }, 100); // Delay in milliseconds
                </script>";
        } 
        else {
            $sql_insert_admin = "INSERT INTO Admins (Email, AdminID, Username, Password) VALUES ('$admin_email', '$admin_id', '$admin_username', '$admin_password')";
            if ($conn->query($sql_insert_admin) === TRUE) {
                echo "<script>
                    setTimeout(function() {
                        alert('Admin registration successful');
                        window.location.href = 'index.php';
                    }, 100); // Delay in milliseconds
                </script>";
            } else {
                echo "Error: " . $sql_insert_admin . "<br>" . $conn->error;
            }
        }
    }
    $conn->close();
?>
