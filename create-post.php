<?php 
require_once "config.php";
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
   <link rel="stylesheet" href="css/create-post.css" />
   <link rel="stylesheet" href="css/req-field.css" />
   <script src="javascript/nav.js"></script>
   <script src="javascript/home.js"></script>
   <script type="text/javascript" src="javascript/req-field.js"></script>
</head>
<body>
    <?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        //Create User
        $sql = "INSERT INTO `posts` (`username`, `title`, `content`, `likes`, `date`, `tags`) VALUES ('".$_SESSION['name']."', '".$_POST['title']."', '".$_POST['content']."', '0', CURRENT_DATE(), '".$_POST['tags']."')";
        $statement = mysqli_prepare($db, $sql);
        mysqli_stmt_execute($statement);
        header("Location: home.php");
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
        <span id="username"><a href="account.php">Steve</a></span>
    </header>
    <main>
        <div id="nav-container">
            <nav>
                <a href="create-post.php"><div class="create-post">   Create Post   </div></a>
                <a href="home.php"><h2>Home</h2></a>
                <a href="account.html"><h2>Account</h2></a>
            </nav>
        </div>
        <div id="content">
            <div id="create-post-header">
                <div id="title"> Create Post</div>
                <div id="filter-container">
                    <div id="text-on">Text</div>
                    <div id="text-off" onclick="selectText()">Text</div>
                    <div id="image-on">Image</div>
                    <div id="image-off" onclick="selectImage()">Image</div>
                </div>
            </div>
            <form method="POST" action="" id="mainForm">
                <div id="create-post">
                    <input name="title" placeholder="Title" type="title" id="not-content" class="required">
                    <textarea name="content" placeholder="Write here" type="content" form="mainForm" class="required"></textarea>
                    <input name="tags" placeholder="Tags" type="tag" id="not-content">
                </div>
            </form>
            <button name="submit" type="submit" form="mainForm">Post</button>    
        </div>
    </main>
</body>
</html>