<?php 
require_once "config.php";
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
   <script src="javascript/nav.js"></script>
   <script src="javascript/home.js"></script>
</head>
<body>

    <?php
    function printPost($post){
        echo '
            <div class="post">
                <div class="post-left">
                    <div class="post-username">Created by '.$post['username'].'</div>
                    <div class="post-title">'.$post['title'].'</div>
                    <div class="post-body">
                        '.$post['content'].'
                    </div>
                    <div class="post-like">Likes: '.$post['likes'].'</div>
                    <div class="post-comment">Comments:</div>
                </div>
            </div>
        ';
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
        <span id="banner"><a href="home.php"><h2>Readit</h2></a></span>
        <span id="search-bar-container"><input type="text" placeholder="Search"></span>
        <?php 
        if(isset($_SESSION["name"]) && $_SESSION["name"] !== ''){
            echo '<span id="username"><a href="account.php">'.$_SESSION['name'].'</a></span>';
	    echo '<span id="username"><a href="home.php?logout=true">Logout</a></span>';
   	    if(isset($_GET['logout']) && $_GET['logout'] === 'true') {
        	$_SESSION["name"] = '';
	    }
	}else{
            echo '<span id="username"><a href="login.php">Login</a></span>';
        }
        ?>
    </header>
    <main>
        <div id="nav-container">
            <nav>
                <a href="create-post.php"><div class="create-post">   Create Post   </div></a>
                <a href="home.php"><h2>Home</h2></a>
                <a href="account.php"><h2>Account</h2></a>
            </nav>
        </div>
        <div id="content">
            <a href="create-post.php"><div class="create-post">Create Post</div></a>
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
                $data=mysqli_query($db, $sql);
                while($line = mysqli_fetch_array($data)){
                    $results[] = $line;
                }
                array_map('printPost', $results);
            ?>
            </div>
            <div class="top-on">
            <?php 
                $sql = "SELECT * FROM `posts` ORDER BY 'likes'";
                $results = array();
                $data=mysqli_query($db, $sql);
                while($line = mysqli_fetch_array($data)){
                    $results[] = $line;
                }
                array_map('printPost', $results);
            ?>
            </div>
        </div>
    </main>
</body>
</html>