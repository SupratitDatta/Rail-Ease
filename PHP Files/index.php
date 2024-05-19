<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../Asset/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rail Ease</title>
    <link rel="stylesheet" href="../Styles/index.css">
</head>

<body>
    <video autoplay loop muted>
        <source src="../Asset/background_video.mp4" type="video/mp4">
    </video>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <div class="shape1"></div>
    <div class="container-fluid">
        <div class="container mt-5">
            <div class="row glass_panel">
                <div class="col-md-12">
                    <nav class="navbar navbar-expand-lg">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="#">
                                <img src="../Asset/train.png" class="site-icon">
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarScroll">
                                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">About</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">User Services</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link">Contact</a>
                                    </li>
                                </ul>
                                <form class="d-flex" role="search">
                                    <a class="login-btn" href="../Web Pages/login-signup.html">Login</a>
                                </form>
                            </div>
                        </div>
                    </nav>
                </div>
                <div class="main">
                    <h1 class="heading">RAIL EASE</h1>
                    <ul>
                        <li><a class="user" href="../Web Pages/login-signup.html">User</a></li>
                        <li><a class="admin" href="../Web Pages/admin_login-signup.html">Admin</a></li>
                    </ul>
                </div>
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
                <div class="p-5 rounded row">
                    <div class="col-md-4 mt-5">
                        <a class="btn btn-lg btn-primary w-50 p-1" href="" role="button">More »</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>