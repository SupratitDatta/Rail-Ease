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

$ticket_details = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $departure = isset($_POST['departure']) ? trim($_POST['departure']) : null;
    $destination = isset($_POST['destination']) ? trim($_POST['destination']) : null;
    $date = isset($_POST['date']) ? trim($_POST['date']) : null;
    $train_id = isset($_POST['train_id']) ? intval($_POST['train_id']) : null;
    $ticket_type = isset($_POST['ticket_type']) ? trim($_POST['ticket_type']) : null;

    if (empty($departure) || empty($destination) || empty($date) || $train_id === null) {
        echo "<script>
                    setTimeout(function() {
                        alert('Please provide all required information');
                        window.location.href = '../Web Pages/book_ticket.html';
                    }, 100); // Delay in milliseconds
                </script>";
        exit();
    }

    $check_train_sql = "SELECT * FROM trains WHERE TrainID = ?";
    $stmt = $conn->prepare($check_train_sql);
    $stmt->bind_param("i", $train_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        echo "<script>
                    setTimeout(function() {
                        alert('Invalid TrainID');
                        window.location.href = '../Web Pages/book_ticket.html';
                    }, 100); // Delay in milliseconds
                </script>";
        exit();
    }

    $user_id = 1;
    $user_name = $_SESSION['username'];
    $fare = 50.00;

    $sql_book_ticket = "INSERT INTO Tickets (UserID, TrainID, BookingDate, Fare, Departure, Destination, SeatType, UserName) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql_book_ticket);
    $stmt->bind_param("iisdssss", $user_id, $train_id, $date, $fare, $departure, $destination, $ticket_type, $user_name);

    if ($stmt->execute()) {
        $ticket_id = $stmt->insert_id;
        $sql_get_ticket_details = "SELECT * FROM Tickets WHERE TicketID = ?";
        $stmt_get_ticket_details = $conn->prepare($sql_get_ticket_details);
        $stmt_get_ticket_details->bind_param("i", $ticket_id);
        $stmt_get_ticket_details->execute();
        $result_ticket_details = $stmt_get_ticket_details->get_result();

        if ($result_ticket_details->num_rows > 0) {
            $ticket_details = $result_ticket_details->fetch_assoc();
        }
    } else {
        echo "Error booking ticket: " . $stmt->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booked Ticket Details</title>
    <style>
        body {
            text-align: center;
            padding: 10vh;
            padding-top: 5vh;
            background-image: url("../Asset/adminLogin.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            transition: background-color 0.5s;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            width: 40vw;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(10, 10, 10, 0.1);
            text-align: center;
        }

        h1 {
            color: #007bff;
        }

        p {
            margin: 10px 0 10px 0;
            font-size: 18px;
        }

        .data1,
        .data2,
        .data3 {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .data1,
        .data2 {
            margin: 3vh auto 3vh auto;
        }

        button {
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .arrow {
            height: 5vh;
            width: auto;
            margin-right: 10px;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Ticket Details</h1>
        <div class="data1">
            <p>Train ID: <?php echo $ticket_details['TrainID']; ?></p>
            <p>Booking Date: <?php echo $ticket_details['BookingDate']; ?></p>
        </div>
        <div class="data2">
            <p>Departure: <?php echo $ticket_details['Departure']; ?></p>
            <img class="arrow" src="https://cdn-icons-png.flaticon.com/512/66/66831.png">
            <p>Destination: <?php echo $ticket_details['Destination']; ?></p>
        </div>
        <div class="data3">
            <p>Status: Booked</p>
            <div>
                <p>Fare: <?php echo $ticket_details['Fare']; ?></p>
                <p>Seat Type: <?php echo $ticket_details['SeatType']; ?></p>
            </div>
        </div>
        <button onclick="window.location.href = '../Web Pages/booking_history.html';">Go to Booking History</button>
        <button onclick="window.location.href = './user_dashboard.php';">Go to Home</button>
    </div>
    <script>
        alert("Ticket Booked Succesfully")
    </script>
</body>

</html>