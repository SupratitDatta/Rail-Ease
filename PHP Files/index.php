<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Indian Railways</title>
    <link rel="stylesheet" href="style.css">
    <style>
        @import url("https://fonts.cdnfonts.com/css/one-piece");
        @import url(//db.onlinewebfonts.com/c/c1f81144897fc5acffc67de8febd9690?family=Saiyan+Sans);
        @media (min-aspect-ratio: 16/9) {
            video {
                width: 100%;
                height: auto;
            }
        }

        @media (max-aspect-ratio: 16/9) {
            video {
                width: auto;
                height: 100%;
            }
        }

        body {
            font-family: Arial, sans-serif;
            /* background-image: url('../Asset/indexPic.jpg'); */
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            padding: 30px;
            padding-top: 5vh;
            height: auto;
            margin: 0;
            color: #fff;
            text-align: center;
            animation: changeBackground 30s infinite;
            background-color: rgba(255, 255, 255, 0.3);
        }

        .heading {
            font-size: 50px;
            margin-bottom: 15vh;
            animation: colorChange 5s infinite alternate;
        }

        h2 {
            color: black;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: rgba(255, 255, 255, 0.3);
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            background-color: transparent;
            color: black;
        }

        th {
            background-color: rgba(0, 123, 255, 0.7);
        }

        tr:nth-child(even) {
            background-color: rgba(242, 242, 242, 0.7);
        }

        tr:hover {
            background-color: rgba(221, 221, 221, 0.7);
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        li {
            margin: 10px;
        }

        a {
            text-decoration: none;
            color: #fff;
            padding: 10px 20px;
            margin: 10px;
            border: 2px solid #fff;
            border-radius: 5px;
            transition: all 0.3s ease-in;
            display: inline-block;
        }

        a:hover {
            background-color: #fff;
            color: #222;
            transform: translateY(-10px);
        }

        video {
            position: fixed;
            top: 0;
            left: 0;
            min-width: 100%;
            min-height: 100%;
            z-index: -1;
        }

        @keyframes colorChange {
            0% {
                color: #007bff;
            }

            50% {
                color: #ff6347;
            }

            100% {
                color: #4caf50;
            }
        }
    </style>
</head>

<body>
    <video autoplay loop muted>
        <source src="../Asset/background_video.mp4" type="video/mp4">
    </video>
    <h1 class="heading">Indian Railways</h1>
    <ul>
        <li><a href="../Web Pages/user_login.html">User Login</a></li>
        <li><a href="../Web Pages/user_registration.html">User Registration</a></li>
        <li><a href="../Web Pages/admin_login.html">Admin Login</a></li>
        <li><a href="../Web Pages/admin_registration.html">Admin Registration</a></li>
    </ul>

    <div class="train-list">
        <h2>Trains Available</h2>
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

        $sql = "SELECT * FROM trains";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Train ID</th><th>Train Name</th><th>Source</th><th>Destination</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["TrainID"] . "</td>";
                echo "<td>" . $row["TrainName"] . "</td>";
                echo "<td>" . $row["Source"] . "</td>";
                echo "<td>" . $row["Destination"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No trains available.";
        }

        $conn->close();
        ?>
    </div>
</body>

</html>