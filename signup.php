<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="utf-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/login.css"/>
    <link rel="stylesheet" href="css/req-field.css" />
    <script type="text/javascript" src="javascript/req-field.js"></script>
</head>

<body>
    <?php

    require_once "config.php";
    require_once "session.php";

    $email_error = '';
    $name_error = '';
    $password_error = '';
    $confirm_error = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $confirm_password = trim($_POST['confirm']);
        $password_hash = md5($password);

        $email_error = '';
        $name_error = '';
        $password_error = '';
        $confirm_error = '';

        //Check if valid user
        $sql = "SELECT * FROM `users` WHERE email='" . $email . "'";
        if ($result = mysqli_query($db, $sql)) {
            if (mysqli_num_rows($result) > 0) {
                $email_error.='<p class="error">A user already exists with this email.</p>';
            }
        }
        $sql = "SELECT * FROM `users` WHERE name='" . $name . "'";
        if ($result = mysqli_query($db, $sql)) {
            if (mysqli_num_rows($result) > 0) {
                $name_error.='<p class="error">A user already exists with this username.</p>';
            }
        }
        if (strlen($password) < 6) {
            $password_error .= '<p class="error">Password must have atleast 6 characters.</p>';
        }
        if (empty($confirm_password)) {
            $confirm_error .= '<p class="error">Please confirm password.</p>';
        } else {
            if (empty($error) && ($password != $confirm_password)) {
                $confirm_error .= '<p class="error">Passwords do not match.</p>';
            }
        }
        if (empty($email_error) && empty($name_error) && empty($password_error) && empty($confirm_error)) {
            //Create User
            $sql = "INSERT INTO `users`(`email`, `name`, `role`, `password`) VALUES ('" . $email . "','" . $name . "','user','" . $password_hash . "')";
            $statement = mysqli_prepare($db, $sql);
            mysqli_stmt_execute($statement);
            $_SESSION['name'] = $name;
            header("Location: home.html");
        }
    }


    mysqli_close($db);
    ?>
    <main>
        <div class="container">
            <h1>Sign Up</h1>
            <form id="mainForm" action="" method="post">
                <label>Email:</label>
                <input name="email" type="email" class="required <?php if(!empty($email_error)){echo 'highlight';} ?>">
                <?php echo $email_error; ?>
                <label>Username:</label>
                <input name="name" type="text" class="required <?php if(!empty($name_error)){echo 'highlight';} ?>">
                <?php echo $name_error; ?>
                <label>Password:</label>
                <input name="password" type="password" class="required <?php if(!empty($password_error)){echo 'highlight';} ?>">
                <?php echo $password_error; ?>
                <label>Confirm Password:</label>
                <input name="confirm" type="password" class="required <?php if(!empty($confirm_error)){echo 'highlight';} ?>">
                <?php echo $confirm_error; ?>
                <button name='submit' type="submit">Sign up</button>
            </form>
            <p>Already have an account?</p>
            <a href="login.php">Login</a>
        </div>
    </main>
</body>

</html>