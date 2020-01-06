<?php 
    @session_start();
    include("./includes/db.php");
    // include("functions/function.php");
?>
<div style="text-align: center; margin: 20px 0;">
    <h2>Login or Register</h2>
    <form action="checkout.php" method="POST">
        <b>Username</b><input type="text" name="c_email" placeholder="Enter you email"><br>
        <b>Password</b><input type="password" name="c_pass" placeholder="Enter your password"><br>
        <input type="submit" name="c_login" value="Login"><br><hr>
        <a href="forgot_pass.php">Forgot Password?</a>
    </form>
    <h3><a href="customer_register.php">New Register Here!</a></h3>
</div>

<?php 
    if(isset($_POST['c_login'])) {
        $customer_email = $_POST['c_email'];
        $customer_password = $_POST['c_pass'];

        $sel_customer = "SELECT * FROM customer WHERE customer_email='$customer_email' AND customer_password='$customer_password'";

        $run_customer = mysqli_query($con, $sel_customer);

        $check_customer = mysqli_num_rows($run_customer);

        $get_ip = getRealIpAddr();
        $sel_cart = "SELECT * FROM cart WHERE ip_add = '$get_ip'";
        $run_cart = mysqli_query($con, $sel_cart);
        $check_cart = mysqli_num_rows($run_cart);

        if($check_customer == 0) {
            echo "<script>alert('Username or Password wrong, Please try again.')</script>";
            exit();            
        } 
        
        if($check_customer == 1 AND $check_cart == 0) {
            $_SESSION['customer_email'] = $customer_email;
            echo "<script>window.open('customer/my_account.php', '_self')</script>";
        } else {
            $_SESSION['customer_email'] = $customer_email;
            echo "<script>alert('You successfully logged in, You can order now.')</script>";
            include("payment_options.php");
        }
    }
?>