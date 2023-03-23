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
    $sql = "SELECT * FROM `posts` WHERE id='" . $_GET['id']. "'";
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
            echo '
            <div class="post">
                <div class="post-left">
                    <div class="post-username">
                        <div id="profile-picture">
                        ' . $profile_image . '
                        </div>
                        Created by ' . $row['username'] . '
                    </div>
                    <div class="post-title">' . $row['title'] . '</div>
                    <div class="post-body">
                        ' . $row['content'] . '
                        ' . $post_image . '
                    </div>
                    <div class="post-like">Likes: ' . $row['likes'] . '</div>
                    <div class="post-comment">Comments:</div>
                </div>
                </div>
            ';
            }
    }
    ?>

</body>

</html>