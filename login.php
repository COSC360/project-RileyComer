<?php 
require_once "config/config.php";
session_start();
if (isset($_SESSION["name"]) && $_SESSION["name"] !== "") {
    header("location: home.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="utf-8">
        <title>Login</title>
        <link rel="stylesheet" href="css/main.css" />
        <link rel="stylesheet" href="css/login.css" />
        <link rel="stylesheet" href="css/req-field.css" />
        <script type="text/javascript" src="javascript/req-field.js"></script>
    </head>
    <body>
        <?php
            $email_error = '';
            $password_error = '';

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email']) && isset($_POST['password'])) {
                $email = trim(mysqli_real_escape_string($db, $_POST['email']));
                $password = trim(mysqli_real_escape_string($db, $_POST['password']));
                $password_hash = md5($password);
                
                $email_error = '';
                $password_error = '';

                $sql = "SELECT * FROM `users` WHERE email='" . $email . "'";
                if ($result = mysqli_query($db, $sql)) {
                    if (mysqli_num_rows($result) == 0) {
                        $email_error.='<p class="error">No user exists with this email.</p>';
                    }else {
                        $row = mysqli_fetch_assoc($result);
                        if($row['password']===$password_hash){
                            $_SESSION['name'] = $row['name'];
                            header("Location: home.php");
                        }else{
                            $password_error.='<p class="error">Incorrect password.</p>';
                        }
                    }
                }
            }
        ?>
        <main>
            <div class="container">
                <h1>Login</h1>
                <form method="post" action="" id="mainForm">
                    <label>Email:</label>
                    <input name="email" type="email" class="required <?php if(!empty($email_error)){echo 'highlight';}?>">
                    <?php echo $email_error; ?>
                    <label>Password:</label>
                    <input name="password" type="password" class="required <?php if(!empty($password_error)){echo 'highlight';}?>">
                    <?php echo $password_error; ?>
                    <button type="submit">Login</button>
                </form>
                <p>Don't have an account?</p>
                <a href="signup.php">Sign Up</a>
            </div>
        </main>
    </body>
</html>