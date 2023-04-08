<?php 
function printPost($post){
    global $db;
    $sql = "SELECT * FROM `users` WHERE name='" . $post['username'] . "'";
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
                    $post_image = '';
                    if (isset($post['img']) && $post['img'] !== '') {
                        $post_image = '<img src="data:image;base64,' . $post['img'] . '"/>';
                    }
                    $sql= "SELECT * FROM `comments` WHERE postid='" . $post['id'] . "'";
                    $num_comments=mysqli_num_rows(mysqli_query($db, $sql));
                    echo '
                    <a class="post-link" href="post.php?id='.$post['id'].'"> 
                        <div class="post">
                            <div class="post-left">
                                <div class="post-username">
                                    <div class="profile-picture">
                                    ' . $profile_image . '
                                    </div>
                                    Created by ' . $post['username'] . '
                                </div>
                                <div class="post-title">' . htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') . '</div>
                                <div class="post-body">
                                    ' . htmlspecialchars($post['content'], ENT_QUOTES, 'UTF-8') . '
                                    ' . $post_image . '
                                </div>
                                <div class="post-like">
                                    <form class="like-post" action="" method="POST">
                                        <input type="hidden" name="postid" value="'.$post['id'].'">
                                        <input type="submit" name="like" value="Like: ' . $post['likes'] . '">
                                    </form>
                                </div>
                                <div class="post-comment">Comments: '.$num_comments.'</div>
                            </div>
                        </div>
                    </a>
                    ';
}

function printReport($report){
    global $db;
    $sql = "SELECT * FROM `users` WHERE name='" . $report['username'] . "'";
                    $profile_image = '';
                    if ($result = mysqli_query($db, $sql)) {
                        if (mysqli_num_rows($result) === 1) {
                            $row = mysqli_fetch_assoc($result);
                            if ($row['img'] != null) {
                                $profile_image = '<img src="data:image;base64,' . $row['img'] . '"/>';
                            } else {
                                $profile_image = '<img src="images/default-user.jpg"/>';
                            }
                            if($report['commentid']==null){
                            echo '
                            <a class="post-link" href="post.php?id='.$report['postid'].'"> 
                                <div class="report">
                                    <div class="report-left">
                                        <div class="report-username">
                                            <div class="profile-picture">
                                            ' . $profile_image . '
                                            </div>
                                            Created by ' . $report['username'] . '
                                        </div>
                                        <div class="post-title">Post:</div>
                                        <div class="post-body">
                                            ' . $report['content'] . '
                                        </div>
                                    </div>
                                </div>
                            </a>
                            ';
                            }else{
                                echo '
                                <div class="report">
                                    <div class="report-left">
                                        <div class="report-username">
                                            <div class="profile-picture">
                                            ' . $profile_image . '
                                            </div>
                                            Created by ' . $report['username'] . '
                                        </div>
                        <form class="delete-post" action="actions/create-comment-action.php" method="POST">
                                <input type="hidden" name="commentid" value="' . $report['commentid'] . '">
                                <input type="submit" name="delete-comment" value="Delete">
                            </form>
                                        <div class="post-title">Comment:</div>
                                        <div class="post-body">
                                            ' . $report['content'] . '
                                        </div>
                                    </div>
                                </div>
                                ';
                            }
                        }
                    }
}

function deletePost($postid){
    global $db;
    $sql = "SELECT * FROM `posts` WHERE id='" . $postid . "'";
    if ($result = mysqli_query($db, $sql)) {
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            $sql = "SELECT * FROM `users` WHERE name='" . $_SESSION['name'] . "'";
            $result=mysqli_query($db, $sql);
            $user = mysqli_fetch_assoc($result);
            if($_SESSION['name']==$row['username'] || $user['role']=='admin'){
                $sql = "DELETE FROM `posts` WHERE id='" . $postid . "'";
                mysqli_query($db, $sql);
                $sql = "DELETE FROM `comments` WHERE postid='" . $postid . "'";
                mysqli_query($db, $sql);
                $sql = "DELETE FROM `reports` WHERE postid='" . $postid . "'";
                mysqli_query($db, $sql);
            }
        }
    }
}

function deleteComment($commentid){
    global $db;
    $sql = "SELECT * FROM `comments` WHERE id='" . $commentid . "'";
    if ($result = mysqli_query($db, $sql)) {
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            $sql = "SELECT * FROM `users` WHERE name='" . $_SESSION['name'] . "'";
            $result=mysqli_query($db, $sql);
            $user = mysqli_fetch_assoc($result);
            if($_SESSION['name']==$row['username'] || $user['role']=='admin'){
                $sql = "UPDATE `comments` SET `content`='DELETED' WHERE id='" . $commentid . "'";
                mysqli_query($db, $sql);
                $sql = "DELETE FROM `reports` WHERE commentid='" . $commentid . "'";
                mysqli_query($db, $sql);
            }
        }
    }
}
?>