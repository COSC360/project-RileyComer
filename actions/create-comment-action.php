<?php 
require_once "../config/config.php";
require '../util.php';
session_start();

if (!(isset($_SESSION["name"]) && $_SESSION["name"] !== "")) {
    header("location: ../login.php");
    exit;
}

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['delete']))
{
    deletePost($_POST['postid']);
    header("location: ../home.php");
}

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['like']))
{
    $sql="UPDATE posts SET likes = likes + 1 WHERE id='".$_POST['postid']."'";
    mysqli_query($db, $sql);
    header("location: ../post.php?id=".$_POST['postid']."");
}

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['submit-comment']))
{
    $sql="INSERT INTO `comments` (`postid`, `username`, `content`, `commentid`) VALUES ('".$_POST['postid']."', '".$_SESSION['name']."', '".mysqli_real_escape_string($db, $_POST['content'])."', NULL)";
    if(isset($_POST['commentid'])){

        $sql="INSERT INTO `comments` (`postid`, `username`, `content`, `commentid`) VALUES ('".$_POST['postid']."', '".$_SESSION['name']."', '".mysqli_real_escape_string($db, $_POST['content'])."', ".$_POST['commentid'].")";
    }
    mysqli_query($db, $sql);
    header("location: ../post.php?id=".$_POST['postid']."");
}

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['submit-report']))
{
    $sql="INSERT INTO `reports` (`postid`, `username`, `content`) VALUES ('".$_POST['postid']."', '".$_SESSION['name']."', '".mysqli_real_escape_string($db, $_POST['content'])."')";
    mysqli_query($db, $sql);
    header("location: ../post.php?id=".$_POST['postid']."");
}

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['submit-comment-report']))
{
    $sql="INSERT INTO `reports` (`postid`, `commentid`, `username`, `content`) VALUES ('".$_POST['postid']."', '".$_POST['commentid']."', '".$_SESSION['name']."', '".mysqli_real_escape_string($db, $_POST['content'])."')";
    mysqli_query($db, $sql);
    header("location: ../post.php?id=".$_POST['postid']."");
}

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['delete-comment']))
{
    deleteComment($_POST['commentid']);
    header("location: ../reports.php");
}
?>