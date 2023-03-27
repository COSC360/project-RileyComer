<?php
require_once "config.php";
require __DIR__ . '/util.php';
session_start();
$sql = "SELECT * FROM `users` WHERE name='" . $_SESSION["name"] . "'";
if ($result = mysqli_query($db, $sql)) {
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if ($row['role'] !='admin') {
            header("location: account.php");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="utf-8">
    <title>Home</title>
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/header.css" />
    <link rel="stylesheet" href="css/nav.css" />
    <link rel="stylesheet" href="css/account.css" />
    <link rel="stylesheet" href="css/post.css" />
    <script src="javascript/nav.js"></script>
    <script src="javascript/home.js"></script>
</head>

<body>
<header>
        <span id="nav-button-opened" onclick="closeNav()">
            <div></div>
            <div></div>
            <div></div>
        </span>
        <span id="nav-button-closed" onclick="openNav()">
            <div></div>
            <div></div>
            <div></div>
        </span>
        <span id="banner"><a href="home.php">
                <h2>Readit</h2>
            </a></span>
            <span id="search-bar-container"><form action="home.php" method="GET"><input name="search" type="text" placeholder="Search"></form></span>
        <?php 
        if(isset($_SESSION["name"]) && $_SESSION["name"] !== ''){
            echo '<span id="username"><a href="account.php">'.$_SESSION['name'].'</a></span>';
            echo '<span id="username"><a href="home.php?logout=true">Logout</a></span>';
            if(isset($_GET['logout']) && $_GET['logout'] === 'true') {
                $_SESSION["name"] = '';
                header("location: home.php");
            }
        }else{
            echo '<span id="username"><a href="login.php">Login</a></span>';
        }
        ?>
    </header>
    <main>
        <div id="nav-container">
            <nav>
                <a href="create-post.php">
                    <div class="create-post"> Create Post </div>
                </a>
                <a href="home.php">
                    <h2>Home</h2>
                </a>
                <a href="account.php">
                    <h2>Account</h2>
                </a>
            </nav>
        </div>
        <div id="content">
            <?php
             $sql = "SELECT * FROM `reports`";
            $results = array();
            $data = mysqli_query($db, $sql);
            while ($line = mysqli_fetch_array($data)) {
                printReport($line);
            }
            ?>
        </div>
    </main>
</body>
</html>