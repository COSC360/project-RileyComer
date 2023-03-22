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
        <span id="banner"><a href="home.html"><h2>Readit</h2></a></span>
        <span id="search-bar-container"><input type="text" placeholder="Search"></span>
        <?php 
        if(isset($_SESSION["name"]) && $_SESSION["name"] !== ''){
            echo '<span id="username"><a href="account.html">'.$_SESSION['name'].'</a></span>';
        }else{
            echo '<span id="username"><a href="login.php">Login</a></span>';
        }
        ?>
    </header>
    <main>
        <div id="nav-container">
            <nav>
                <a href="create-post.html"><div class="create-post">   Create Post   </div></a>
                <a href="home.html"><h2>Home</h2></a>
                <a href="account.html"><h2>Account</h2></a>
            </nav>
        </div>
        <div id="content">
            <a href="create-post.html"><div class="create-post">Create Post</div></a>
            <div id="filter-container">
                <div id="top-on">Top</div>
                <div id="top-off" onclick="selectTop()">Top</div>
                <div id="new-on">New</div>
                <div id="new-off" onclick="selectNew()">New</div>
            </div>
            <div id="post">
                <div id="post-left">
                    <div id="post-username">Created by Steve</div>
                    <div id="post-title">Post Title</div>
                    <div id="post-body">
                        placeholder text placeholder text placeholder text placeholder text placeholder text placeholder text placeholder text placeholder text placeholder text 
                        placeholder text placeholder text placeholder text placeholder text placeholder text placeholder text placeholder text placeholder text placeholder text 
                        placeholder text placeholder text placeholder text placeholder text placeholder text placeholder text placeholder text placeholder text placeholder text 
                        placeholder text placeholder text placeholder text placeholder text placeholder text placeholder text placeholder text placeholder text placeholder text 
                        placeholder text placeholder text placeholder text placeholder text placeholder text placeholder text placeholder text placeholder text placeholder text 
                        placeholder text placeholder text placeholder text placeholder text placeholder text placeholder text placeholder text placeholder text placeholder text 
                        placeholder text placeholder text placeholder text placeholder text placeholder text placeholder text placeholder text placeholder text placeholder text 
                    </div>
                    <div id="post-like">Likes:</div>
                    <div id="post-comment">Comments:</div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>