<?php
    session_start();
    include("includes/db.php");
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Login Area</title>
    <link rel="stylesheet" href="styles/login.css" media="all" />
</head>
<body>
    <div class="login">
        <h1>Admin Login</h1>
        <form method="post">
            <input type="text" name="admin_email" placeholder="Email" required="required" />
            <input type="password" name="admin_pass" placeholder="Password" required="required" />
            <button type="submit" class="btn btn-primary btn-block btn-large" name="login">Admin Login</button>
        </form>
    </div>

    <h2 style="color:white; text-align:center; padding:20px;"><?php echo @$_GET['logout']; ?></h2>
</body>

</html>


<?php
if (isset($_POST['login'])) {

    $user_email = $_POST['admin_email'];
    $user_pass = $_POST['admin_pass'];

    $sel_admin = "SELECT * FROM admin WHERE admin_user='$user_email' AND admin_pass='$user_pass'";
    $run_admin = mysqli_query($con, $sel_admin);
    $check_admin = mysqli_num_rows($run_admin);

    if ($check_admin == 1) {
        $_SESSION['admin_email'] = $user_email;
        echo "<script>window.open('index.php?logged_in=You successfully Logged in!','_self')</script>";
    } else {
        echo "<script>alert('Admin Email or Password is incorrect, try again')</script>";
    }
}
?>