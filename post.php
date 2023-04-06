<?php
require_once "config/config.php";
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
    <link rel="stylesheet" href="css/comments.css" />
    <link rel="stylesheet" href="css/profilepic.css" />
    <script src="javascript/nav.js"></script>
    <script src="javascript/home.js"></script>
</head>

<body>
    <?php
    

    function getComments($postid){
        global $db;
        $sql = "SELECT * FROM `comments` WHERE postid='" . $postid. "' AND commentid IS NULL";
        $data = mysqli_query($db, $sql);

        while ($comment = mysqli_fetch_array($data)) {
            $sql = "SELECT * FROM `users` WHERE name='" . $comment['username'] . "'";
            $profile_image = '';
            if ($result = mysqli_query($db, $sql)) {
                if (mysqli_num_rows($result) === 1) {
                    $row = mysqli_fetch_assoc($result);
                    if ($row['img'] != null) {
                        $profile_image = '<img src="data:image;base64,' . $row['img'] . '"/>';
                    } else {
                        $profile_image = '<img src="images/default-user.jpg"/>';
                    }
                }
            }
            echo '
                <div class="comment">
                    <div class="comment-username">
                        <div class="profile-picture">
                            ' . $profile_image . '
                        </div>
                        ' . $comment['username'] . '
                    </div>
                    <div class="comment-body">
                        ' . $comment['content'] . '
                    </div>
                    <div class="replies">
                    <form method="POST" action="actions/create-comment-action.php" id="commentForm">
                        <div id="create-comment">
                            <input type="hidden" name="postid" value="'.$postid.'">
                            <input type="hidden" name="commentid" value="'.$comment['id'].'">
                            <textarea name="content" placeholder="Write here" type="content"></textarea>
                            <button name="submit-comment" type="submit">Post</button>
                        </div> 
                    </form>
                        ';
                        getReplies($comment['id']);
        echo '      </div>
                </div>
            ';
        }
    }

    function getReplies($commentid){
        global $db;
        $sql = "SELECT * FROM `comments` WHERE commentid='" . $commentid. "'";
        $data = mysqli_query($db, $sql);

        while ($comment = mysqli_fetch_array($data)) {
            $sql = "SELECT * FROM `users` WHERE name='" . $comment['username'] . "'";
            $profile_image = '';
            if ($result = mysqli_query($db, $sql)) {
                if (mysqli_num_rows($result) === 1) {
                    $row = mysqli_fetch_assoc($result);
                    if ($row['img'] != null) {
                        $profile_image = '<img src="data:image;base64,' . $row['img'] . '"/>';
                    } else {
                        $profile_image = '<img src="images/default-user.jpg"/>';
                    }
                }
            }
            echo '
                <div class="comment">
                    <div class="comment-username">
                        <div class="profile-picture">
                            ' . $profile_image . '
                        </div>
                        ' . $comment['username'] . '
                    </div>
                    <div class="comment-body">
                        ' . htmlspecialchars($comment['content'], ENT_QUOTES, 'UTF-8') . '
                    </div>
                    <div class="replies">
                    <form method="POST" action="actions/create-comment-action.php" id="commentForm">
                        <div id="create-comment">
                            <input type="hidden" name="postid" value="'.$comment['postid'].'">
                            <input type="hidden" name="commentid" value="'.$comment['id'].'">
                            <textarea name="content" placeholder="Write here" type="content"></textarea>
                            <button name="submit-comment" type="submit">Post</button>
                        </div> 
                    </form>
                        ';
                        getReplies($comment['id']);
        echo '      </div>
                </div>
            ';
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
        <span id="search-bar-container">
            <form action="home.php" method="GET"><input name="search" type="text" placeholder="Search"></form>
        </span>
        <?php
        if (isset($_SESSION["name"]) && $_SESSION["name"] !== '') {
            echo '<span id="username"><a href="account.php">' . $_SESSION['name'] . '</a></span>';
            echo '<span id="username"><a href="home.php?logout=true">Logout</a></span>';
            if (isset($_GET['logout']) && $_GET['logout'] === 'true') {
                $_SESSION["name"] = '';
                header("location: home.php");
            }
        } else {
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
            $sql = "SELECT * FROM `posts` WHERE id='" . $_GET['id'] . "'";
            $profile_image = '';
            if ($result = mysqli_query($db, $sql)) {
                if (mysqli_num_rows($result) === 1) {
                    $row = mysqli_fetch_assoc($result);
                    if ($row['img'] != null) {
                        $profile_image = '<img src="data:image;base64,' . $row['img'] . '"/>';
                    } else {
                        $profile_image = '<img src="images/default-user.jpg"/>';
                    }
                    $post_image = '';
                    if (isset($row['img']) && $row['img'] !== '') {
                        $post_image = '<img src="data:image;base64,' . $row['img'] . '"/>';
                    }
                    $sql= "SELECT * FROM `comments` WHERE postid='" . $row['id'] . "'";
                    $num_comments=mysqli_num_rows(mysqli_query($db, $sql));
                    echo '
                        <div class="post">
                            <div class="post-left">
                            ';
                            $sql = "SELECT * FROM `users` WHERE name='" . $_SESSION['name'] . "'";
                            $result=mysqli_query($db, $sql);
                            $user = mysqli_fetch_assoc($result);
                            if($_SESSION['name']==$row['username'] || $user['role']=='admin'){
                                echo '
                                <span>
                                <form class="delete-post" action="actions/create-comment-action.php" method="POST">
                                <input type="hidden" name="postid" value="'.$row['id'].'">
                                <input type="submit" name="delete" value="Delete">
                                </form>
                                </span>';
                            }
                            echo '
                                <span>
                                <form method="POST" action="actions/create-comment-action.php" id="commentForm">
                                    <div id="create-comment">
                                        <input type="hidden" name="postid" value="'.$row['id'].'">
                                        <textarea name="content" placeholder="Write reason for report here" type="content"></textarea>
                                        <button name="submit-report" type="submit">Report Post</button>
                                    </div> 
                                </form>
                                </span>
                                <div class="post-username">
                                    <div id="profile-picture">
                                    ' . $profile_image . '
                                    </div>
                                    Created by ' . $row['username'] . '
                                </div>
                                <div class="post-title">' . htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8') . '</div>
                                <div class="post-body">
                                    ' . htmlspecialchars($row['content'], ENT_QUOTES, 'UTF-8') . '
                                    ' . $post_image . '
                                </div>
                                <div class="post-like">
                                <form class="like-post" action="actions/create-comment-action.php" method="POST">
                                    <input type="hidden" name="postid" value="'.$row['id'].'">
                                    <input type="submit" name="like" value="Like: ' . $row['likes'] . '">
                                </form>
                                </div>
                                <div class="post-comment">Comments: '.$num_comments.'</div>
                            </div>
                        </div>
                    ';

                    echo 
                    '<form method="POST" action="actions/create-comment-action.php" id="commentForm">
                        <div id="create-comment">
                            <input type="hidden" name="postid" value="'.$row['id'].'">
                            <textarea name="content" placeholder="Write here" type="content"></textarea>
                            <button name="submit-comment" type="submit">Post</button>
                        </div> 
                    </form>'
                ;

                    //comments
                    getComments($_GET['id']);
                }
            }
            ?>
        </div>
    </main>

</body>

</html>