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
    <link rel="icon" href="../Asset/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Ticket</title>
    <link rel="stylesheet" href="../Styles/ticket.css">
</head>

<body>
    <div class="main-content">
        <div class="ticket">
            <div class="ticket__main">
                <div class="header">Rajdhani Express</div>
                <div class="info passenger">
                    <div class="info__item">Passenger</div>
                    <div class="info__detail">Owen Shaw</div>
                </div>
                <div class="info platform"> <span>Depart </span><span>from </span><span>platform</span>
                    <div class="number">
                        <div>22</div>
                    </div>
                </div>
                <div class="info departure">
                    <div class="arrow">
                        <div class="info__item">Departure</div>
                        <div class="info__detail">Kolkata</div>
                    </div>
                    <span>
                        <img class="right-arrow" src="../Asset/right-arrow.png" alt="">
                    </span>
                </div>
                <div class="info arrival">
                    <div class="info__item">Destination</div>
                    <div class="info__detail">Delhi</div>
                </div>
                <div class="info date">
                    <div class="info__item">Date</div>
                    <div class="info__detail">30 Nov 2025</div>
                </div>
                <div class="info time">
                    <div class="info__item">Departure Time</div>
                    <div class="info__detail">11:00AM</div>
                </div>
                <div class="info carriage">
                    <div class="info__item">Type</div>
                    <div class="info__detail">2-AC</div>
                </div>
                <div class="info seat">
                    <div class="info__item">Seat</div>
                    <div class="info__detail">42/SU</div>
                </div>
                <div class="fineprint">
                    <p> • Boarding begins 30 minutes before departure.<br> • Snacks available from official IRCTC Pantry
                        Express.</p>
                    <p>This ticket is Non-refundable<br>Indian Express Railway Authority</p>
                </div>
                <div class="snack"><svg viewBox="0 -11 414.00053 414">
                        <path d="m202.480469 352.128906c0-21.796875-17.671875-39.46875-39.46875-39.46875-21.800781 0-39.472657 17.667969-39.472657 39.46875 0 21.800782 17.671876 39.472656 39.472657 39.472656 21.785156-.023437 39.445312-17.683593 39.46875-39.472656zm0 0">
                        </path>
                        <path d="m348.445312 348.242188c2.148438 21.691406-13.695312 41.019531-35.390624 43.167968-21.691407 2.148438-41.015626-13.699218-43.164063-35.390625-2.148437-21.691406 13.695313-41.019531 35.386719-43.167969 21.691406-2.148437 41.019531 13.699219 43.167968 35.390626zm0 0">
                        </path>
                        <path d="m412.699219 63.554688c-1.3125-1.84375-3.433594-2.941407-5.699219-2.941407h-311.386719l-3.914062-24.742187c-3.191407-20.703125-21.050781-35.9531252-42-35.871094h-42.699219c-3.867188 0-7 3.132812-7 7s3.132812 7 7 7h42.699219c14.050781-.054688 26.03125 10.175781 28.171875 24.0625l33.800781 213.515625c3.191406 20.703125 21.050781 35.957031 42 35.871094h208.929687c3.863282 0 7-3.132813 7-7 0-3.863281-3.136718-7-7-7h-208.929687c-14.050781.054687-26.03125-10.175781-28.171875-24.0625l-5.746094-36.300781h213.980469c18.117187-.007813 34.242187-11.484376 40.179687-28.597657l39.699219-114.578125c.742188-2.140625.402344-4.511718-.914062-6.355468zm0 0">
                        </path>
                    </svg></div>
                <div class="barcode">
                    <div class="barcode__scan"></div>
                    <div class="barcode__id">123456789</div>
                </div>
            </div>
            <div class="ticket__side">
                <div class="logo">
                    <p>Rajdhani Express</p>
                </div>
                <div class="info side-arrive">
                    <div class="info__item">Destination</div>
                    <div class="info__detail">Delhi</div>
                </div>
                <div class="info side-depart">
                    <div class="info__item">Departure</div>
                    <div class="info__detail">Kolkata</div>
                </div>
                <div class="info side-date">
                    <div class="info__item">Date</div>
                    <div class="info__detail">22 NOV 2025</div>
                </div>
                <div class="info side-time">
                    <div class="info__item">Time</div>
                    <div class="info__detail">11:00AM</div>
                </div>
                <div class="barcode">
                    <div class="barcode__scan"></div>
                    <div class="barcode__id">123456789</div>
                </div>
            </div>
        </div>
    </div>
    <script>
        alert("Ticket Booked Succesfully")
    </script>
</body>

</html>