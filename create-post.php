<?php 
require_once "config/config.php";
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
   <link rel="stylesheet" href="css/profilepic.css" />
   <script src="javascript/nav.js"></script>
   <script src="javascript/home.js"></script>
   <script type="text/javascript" src="javascript/req-field.js"></script>
</head>
<body>
    <?php 
    $image_error='';
    if(isset($_GET['error'])){
        $image_error=urldecode($_GET['error']);
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
        <span id="search-bar-container"><form action="home.php" method="GET"><input name="search" type="text" placeholder="Search"></form></span>
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
                <a href="account.html"><h2>Account</h2></a>
            </nav>
        </div>
        <div id="content">
            <div id="create-post-header">
                <div id="title"> Create Post</div>
                <div id="filter-container">
                    <div class="text-on">Text</div>
                    <div class="text-off" onclick="selectText()">Text</div>
                    <div class="image-on">Image</div>
                    <div class="image-off" onclick="selectImage()">Image</div>
                </div>
            </div>
                <form method="POST" action="actions/create-post-action.php" id="mainForm" enctype="multipart/form-data">
                    <div id="create-post">
                        <input name="title" placeholder="Title" type="title" id="not-content" class="required">
                        <input name="tags" placeholder="Tags" type="tag" id="not-content">
                         <div class="text-on">
                            <textarea name="content" placeholder="Write here" type="content"></textarea>
                            <button name="submit-text" type="submit">Post</button>
                        </div>
                        <div class="image-on">
                            <input name="post-img" type="file">
                            <button name="submit-image" type="submit">Post</button> 
                        </div>
                        <?php echo $image_error; ?>
                    </div> 
                </form>
            </div>
        </div>
    </main>
</body>
</html>