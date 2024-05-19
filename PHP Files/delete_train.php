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
        if (isset($_POST['TrainID'])) {

            $train_id = mysqli_real_escape_string($conn, $_POST['TrainID']);
            $sql = "DELETE FROM trains WHERE TrainID='$train_id'";

            if ($conn->query($sql) === TRUE) {
                echo "<script>
                    setTimeout(function() {
                        alert('Train deleted successfully');
                        window.location.href = './admin_panel.php';
                    }, 100); // Delay in milliseconds
                </script>";
            } 
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } 
        else {
            echo "TrainID is not set.";
        }
    }

    $conn->close();
?>
