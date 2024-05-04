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
        $ticket_id = $_POST['cancel_ticket_id'];
        $stmt = $conn->prepare("UPDATE Tickets SET Status = 'Cancelled' WHERE TicketID = ?");
        $stmt->bind_param("i", $ticket_id);

        if ($stmt->execute()) {
            echo "<script>
                    setTimeout(function() {
                        alert('Ticket cancelled successfully');
                        window.location.href = 'user_dashboard.php';
                    }, 100); // Delay in milliseconds
                </script>";
        }
        else {
            echo "Error cancelling ticket: " . $conn->error;
        }
        
        $stmt->close();
    }
    $conn->close();
?>
