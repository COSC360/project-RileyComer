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
    $image_error='';
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit-text'])) {
        $sql = "INSERT INTO `posts` (`username`, `title`, `content`, `likes`, `date`, `tags`) VALUES ('".$_SESSION['name']."', '".$_POST['title']."', '".$_POST['content']."', '0', CURRENT_DATE(), '".$_POST['tags']."')";
        $statement = mysqli_prepare($db, $sql);
        mysqli_stmt_execute($statement);
        header("Location: home.php");
    }else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit-image'])) {
        $image_error='';
        if (getimagesize($_FILES['post-img']['tmp_name'])==false) {
            $image_error= '<p class="error">no image.</p>';
        }else{
            $image = $_FILES['post-img']['tmp_name'];
            $size=strlen(file_get_contents(addslashes($image)));
            if($size<65535){
                $image= base64_encode(file_get_contents(addslashes($image)));
                $sql = "INSERT INTO `posts` (`username`, `title`, `img`, `likes`, `date`, `tags`) VALUES ('".$_SESSION['name']."', '".$_POST['title']."', '".$image."', '0', CURRENT_DATE(), '".$_POST['tags']."')";
                $statement = mysqli_prepare($db, $sql);
                mysqli_stmt_execute($statement);
                header("Location: home.php");
            }else{
                $image_error.='<p class="error">File is too large.</p>';
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
                <form method="POST" action="" id="mainForm" enctype="multipart/form-data">
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
                    </div> 
                </form>
            </div>
            <?php echo $image_error; ?>
        </div>
    </main>
</body>
</html>