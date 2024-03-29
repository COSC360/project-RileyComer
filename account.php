<?php
require_once "config/config.php";
require __DIR__ . '/util.php';
session_start();
if (!(isset($_SESSION["name"]) && $_SESSION["name"] !== "")) {
    header("location: login.php");
    exit;
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
    <link rel="stylesheet" href="css/profilepic.css" />
    <script src="javascript/nav.js"></script>
    <script src="javascript/home.js"></script>
</head>

<body>
    <?php
    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['like']))
    {
        $sql="UPDATE posts SET likes = likes + 1 WHERE id='".$_POST['postid']."'";
        mysqli_query($db, $sql);
    }
    
    $image_error = '';
    if (isset($_POST['submit'])) {
        $image_error = '';
        if (getimagesize($_FILES['profile-img']['tmp_name']) == false) {
            echo "no image";
        } else {

            $image = $_FILES['profile-img']['tmp_name'];
            $size = strlen(file_get_contents(addslashes($image)));
            if ($size < 65535) {
                $image = base64_encode(file_get_contents(addslashes($image)));
                $sql = "UPDATE `users` SET `img`='$image' WHERE `name`='" . $_SESSION['name'] . "'";
                mysqli_query($db, $sql);
            } else {
                $image_error .= '<p class="error">File is too large.</p>';
            }
        }
    }

    ?>
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
                <a href="create-post.html">
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
            <div class="profile-picture">
                <?php
                $sql = "SELECT * FROM `users` WHERE name='" . $_SESSION["name"] . "'";
                if ($result = mysqli_query($db, $sql)) {
                    if (mysqli_num_rows($result) === 1) {
                        $row = mysqli_fetch_assoc($result);
                        if ($row['img'] != null) {
                            echo '<img src="data:image;base64,' . $row['img'] . '"/>';
                        } else {
                            echo '<img src="images/default-user.jpg"/>';
                        }
                    }
                }
                ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <input name="profile-img" type="file" id="changeProfile">
                    <input name="submit" type="submit">
                    <?php
                    echo $image_error;
                    ?>
                </form>
                <?php
                if (isset($_SESSION["name"]) && $_SESSION["name"] !== '') {
                    echo '<div id="username">' . $_SESSION['name'] . '</div>';
                } else {
                    echo '<span id="username"><a href="login.php">Login to continue</a></span>';
                }
                $sql = "SELECT * FROM `users` WHERE name='" . $_SESSION["name"] . "'";
                if ($result = mysqli_query($db, $sql)) {
                    if (mysqli_num_rows($result) === 1) {
                        $row = mysqli_fetch_assoc($result);
                        if ($row['role'] =='admin') {
                            echo '
                            <a href="reports.php">
                                <h2>Reports page</h2>
                            </a>';
                        }
                    }
                }
                ?>
            </div>
            <hr>
            <div id="title">Posts</div>
            <div id="filter-container">
                <div class="top-on">Top</div>
                <div class="top-off" onclick="selectTop()">Top</div>
                <div class="new-on">New</div>
                <div class="new-off" onclick="selectNew()">New</div>
            </div>
            <div class="new-on">
                <?php
                $sql = "SELECT * FROM `posts` WHERE username = '" . $_SESSION['name'] . "' ORDER BY `date` DESC";
                $data = mysqli_query($db, $sql);
                while ($line = mysqli_fetch_array($data)) {
                    printPost($line);
                }

                ?>
            </div>
            <div class="top-on">
                <?php
                $sql = "SELECT * FROM `posts` WHERE username = '" . $_SESSION['name'] . "' ORDER BY `likes` DESC";
                $data = mysqli_query($db, $sql);
                while ($line = mysqli_fetch_array($data)) {
                    printPost($line);
                }
                ?>
            </div>
        </div>
    </main>
</body>

</html>