<?php
require_once "config.php";
require __DIR__ . '/util.php';
session_start();
?>
<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="utf-8">
    <title>Home</title>
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/header.css" />
    <link rel="stylesheet" href="css/nav.css" />
    <link rel="stylesheet" href="css/home.css" />
    <link rel="stylesheet" href="css/post.css" />
    <link rel="stylesheet" href="css/profilepic.css" />
    <script src="javascript/nav.js"></script>
    <script src="javascript/home.js"></script>
</head>

<body>
    <?php
    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['like']))
    {
        $sql="UPDATE posts
        SET likes = likes + 1";
        mysqli_query($db, $sql);
    }
    
        $search='';
        if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])){
            $search=$_GET['search'];
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
        <span id="search-bar-container"><form action="" method="GET"><input name="search" type="text" placeholder="Search" value="<?php echo $search; ?>"></form></span>
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
            <a href="create-post.php">
                <div class="create-post">Create Post</div>
            </a>
            <div id="filter-container">
                <div class="top-on">Top</div>
                <div class="top-off" onclick="selectTop()">Top</div>
                <div class="new-on">New</div>
                <div class="new-off" onclick="selectNew()">New</div>
            </div>
            <div class="new-on">
                <?php
                $sql = "SELECT * FROM `posts` ORDER BY 'date'";
                $results = array();
                $data = mysqli_query($db, $sql);
                while ($line = mysqli_fetch_array($data)) {
                    printPost($line);
                }
                ?>
            </div>
            <div class="top-on">
                <?php
                $sql = "SELECT * FROM `posts` WHERE `title` like ('%".$search."%')  ORDER BY 'likes'";
                $results = array();
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