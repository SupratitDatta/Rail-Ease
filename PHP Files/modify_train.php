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

        $train_id = $_POST['train_id_modify'];
        $new_destination = $_POST['new_destination'];
        $sql_modify_train = "UPDATE Trains SET Destination = '$new_destination' WHERE TrainID = $train_id";
        
        if ($conn->query($sql_modify_train) === TRUE) {
            echo "<script>
                    setTimeout(function() {
                        alert('Train details modified successfully');
                        window.location.href = './admin_panel.php';
                    }, 100); // Delay in milliseconds
                </script>";
        } 
        else {
            echo "Error modifying train details: " . $conn->error;
        }
    }

    $conn->close();
?>
