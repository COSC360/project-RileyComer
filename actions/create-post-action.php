<?php
require_once "../config/config.php";
session_start();
if (!(isset($_SESSION["name"]) && $_SESSION["name"] !== "")) {
    header("location: ../login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $image_error = '';
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit-text'])) {
        $sql = "INSERT INTO `posts` (`username`, `title`, `content`, `likes`, `date`, `tags`) VALUES ('" . $_SESSION['name'] . "', '" . mysqli_real_escape_string($db, $_POST['title']) . "', '" . mysqli_real_escape_string($db, $_POST['content']) . "', '0', CURRENT_DATE(), '" . mysqli_real_escape_string($db, $_POST['tags']) . "')";
        $statement = mysqli_prepare($db, $sql);
        mysqli_stmt_execute($statement);
        header("Location: ../home.php");
    } else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit-image'])) {
        $image_error = '';
        if ($_FILES['post-img']['tmp_name'] == null || getimagesize($_FILES['post-img']['tmp_name']) == false) {
            $image_error = '<p class="error">no image.</p>';
            header("Location: ../create-post.php?error=" . urlencode($image_error));
        } else {
            $image = $_FILES['post-img']['tmp_name'];
            $size = strlen(file_get_contents(addslashes($image)));
            if ($size < 65535) {
                $image = base64_encode(file_get_contents(addslashes($image)));
                $sql = "INSERT INTO `posts` (`username`, `title`, `img`, `likes`, `date`, `tags`) VALUES ('" . $_SESSION['name'] . "', '" . mysqli_real_escape_string($db, $_POST['title']) . "', '" . $image . "', '0', CURRENT_DATE(), '" . mysqli_real_escape_string($db, $_POST['tags']) . "')";
                $statement = mysqli_prepare($db, $sql);
                mysqli_stmt_execute($statement);
                header("Location: ../home.php");
            } else {
                $image_error .= '<p class="error">File is too large.</p>';
                header("Location: ../create-post.php?error=" . urlencode($image_error));
            }
        }
    }
}
?>