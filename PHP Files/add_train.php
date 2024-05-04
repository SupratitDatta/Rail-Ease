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

        $train_name = mysqli_real_escape_string($conn, $_POST['TrainName']);
        $departure = mysqli_real_escape_string($conn, $_POST['DepartureTime']);
        $arrival = mysqli_real_escape_string($conn, $_POST['ArrivalTime']); 
        $destination = mysqli_real_escape_string($conn, $_POST['Destination']);
        $source = mysqli_real_escape_string($conn, $_POST['Source']);
        $distance = mysqli_real_escape_string($conn, $_POST['Distance']); 
        
        $sql = "INSERT INTO trains (TrainName, DepartureTime, ArrivalTime, Destination,Source,Distance) VALUES ('$train_name', '$departure', '$arrival', '$destination','$source', '$distance')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>
                    setTimeout(function() {
                        alert('Train added successfully');
                        window.location.href = '../Web Pages/admin_dashboard.html';
                    }, 100); // Delay in milliseconds
                </script>";
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
?>
