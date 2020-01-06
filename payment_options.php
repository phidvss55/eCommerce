<?php
    include('./includes/db.php');
    // include('./functions/function.php');
    function createDatabase() {
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Options</title>
</head>
<body>
    <div style="padding:20px; text-align:center;">
        <h2>Payment Options for you</h2>
        <?php
            $ip = getRealIpAddr();

            $get_customer = "SELECT * FROM customer WHERE customer_ip='$ip'";
        
            $run_customer = mysqli_query($con, $get_customer);
            $customer = mysqli_fetch_array($run_customer);

            $customer_id = $customer['customer_id'];
        ?>
        <b>Pay With - </b><a href="http://www.paypal.com"><img src="./images/paypal.png" alt="Paypal options"></a>
            <b> Or <a href="order.php?c_id=<?php echo $customer_id; ?>">Pay Offline</a></b>
        <b><p>If you selected "Pay Offline" option then please check your account to find Invoice. No for your order.</p></b>
    </div>
</body>
</html>