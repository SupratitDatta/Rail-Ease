<?php
    session_start();
    $servername = "localhost";
    $port = 3306;
    $username = "supra";
    $password = "supra@12345";
    $database = "railway";

    $conn = new mysqli($servername, $username, $password, $database, $port);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (!isset($_SESSION['admin_username'])) {
        header("Location: admin_login-signup.html");
        exit();
    }

    $admin_username = $_SESSION['admin_username'];
    $admin_email = $_SESSION['admin_email'];

    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../Asset/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../Styles/admin_dashboard.css">
    <link rel="stylesheet" href="../Styles/admin_panel.css">
</head>

<body>
    <header role="banner">
        <h1 class="admin-panel">ADMIN PANEL</h1>
        <ul class="utilities">
            <br>
            <li class="users"><a href="#">My Account</a></li>
            <li class="logout warn"><a href="../Web Pages/admin_login-signup.html">Log Out</a></li>
        </ul>
    </header>

    <nav role='navigation'>
        <ul class="main">
            <li class="dashboard"><a href="#">Dashboard</a></li>
            <li class="write"><a href="../Web Pages/add_trains.html">Add Trains</a></li>
            <li class="edit"><a href="../Web Pages/modify_trains.html">Modify Trains</a></li>
            <li class="comments"><a href="../Web Pages/delete_trains.html">Delete Trains</a></li>
            <li class="users"><a href="#">Manage Users</a></li>
        </ul>
    </nav>

    <main role="main">
        <div>
            <div class="bg-cover"></div>
            <div class="container">
                <div class="header">
                    <i class="fa fa-bars"></i>
                    <i class="fa fa-cog"></i>
                </div>
                <div class="middle">
                    <img src="../Asset/profile.png" alt="Profile" class="user-pic" />
                    <h4 class="user-data user-name"><?php echo $admin_username; ?></h4>
                    <h4 class="user-data"><?php echo $admin_email; ?></h4>
                    <h4 class="social">
                        <i class="fa fa-phone"></i>
                        <i class="fa fa-facebook"></i>
                        <i class="fa fa-linkedin"></i>
                    </h4>
                </div>
                <div class="footer">
                    <button class="btn-follow">Send a Mail</button>
                    <h4 class="data">
                        <i class="fa fa-book"></i>
                        <i class="fa fa-image"></i>
                        <i class="fa fa-envelope"></i>
                        <i class="fa fa-bell"></i>
                    </h4>
                </div>
            </div>
        </div>
    </main>
</body>

</html>