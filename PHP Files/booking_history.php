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

    $sql = "SELECT * FROM Tickets"; 
    $result = $conn->query($sql);
    $booking_history = array();

    if (!$result) {
        die("Error fetching booking history: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $row = array_map('htmlspecialchars', $row);
            $booking_history[] = $row;
        }
    }

    $conn->close();
    header('Content-Type: application/json');
    echo json_encode($booking_history);
?>
