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
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: user_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('../Asset/user_dashboardPic.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh;
            overflow: hidden;
            color: white;
            text-align: center;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            padding-top: 10vh;
        }
        h2{
            color: black;
            font-size: 40px;
        }
        .option {
            max-width: 600px;
            display: flex;
            margin: 20vh auto auto auto;
            justify-content: space-between;
        }
        .name{
            color: #007bff;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            transition: all 0.3s ease-in;
            margin-top: 20px;
        }

        button:hover {
            background-color: #0056b3;
            transform: translateY(-5px);
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Welcome, <span class="name"><?php  echo $_SESSION['username']; ?>!</span> This is your Dashboard.</h2>
        <div class="option">
            <form action="index.php" method="get">
                <button type="submit">Home</button>
            </form>
            <form action="../Web Pages/book_ticket.html" method="get">
                <button type="submit">Book Ticket</button>
            </form>
            <form action="../Web Pages/cancel_ticket.html" method="get">
                <button type="submit">Cancel Ticket</button>
            </form>
            <form action="../Web Pages/booking_history.html" method="get">
                <button type="submit">Booking History</button>
            </form>
        </div>
    </div>
    <script>
        // setTimeout(function() {
        //     window.location.href = "../Web Pages/book_ticket.html";
        // }, 5000); 
    </script>
</body>

</html>