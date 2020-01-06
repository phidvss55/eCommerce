<?php
    session_start();
    include('includes/db.php');
    
    if(isset($_GET['order_id'])) {
        $order_id = $_GET['order_id'];
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirm Payment</title>

    <!-- <link rel="stylesheet" href="styles/style.css"> -->
</head>
<body bgcolor="#39c">
    <form action="confirm.php?order_id=<?php echo $order_id ?>" method="POST" style="margin: 0 auto !Important;">
        <table width="800" height="400" align="center" border="2" bgcolor="#cccccc">
            <tr>
                <td colspan="2" align="center"><h2>Please Confirm your payment!</h2></td>
            </tr>
            <tr>
                <td>Invoice No: </td>
                <td><input type="text" name="invoice_no"></td>
            </tr>
            <tr>
                <td>Amount Sent: </td>
                <td><input type="text" name="amount"></td>
            </tr>
            <tr>
                <td>Select Payment method: </td>
                <td>
                    <select name="payment_method" id="">
                        <option>Select payment</option>
                        <option value="Bank transfer">Bank transfer</option>
                        <option value="Western Union">Western Union</option>
                        <option value="Vietcombank">Vietcombank</option>
                        <option value="Paypal">Paypal</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Transaction/Refference ID: </td>
                <td><input type="text" name="tr"></td>
            </tr>
            <tr>
                <td>EasyPaise Code: </td>
                <td><input type="text" name="code"></td>
            </tr>
            <tr>
                <td>Payment Date: </td>
                <td><input type="text" name="date"></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" name="confirm" value="Confirm payment"></td>
            </tr>
        </table>
    </form>
</body>
</html>

<?php
    if(isset($_POST['confirm'])) {
        $invoice_no = $_POST['invoice_no'];
        $amount = $_POST['amount'];
        $payment_method = $_POST['payment_method'];
        $tr = $_POST['tr'];
        $code = $_POST['code'];
        $date = $_POST['date'];

        $insert_payment = "INSERT INTO payments(invoice_no, amount, payment_mode, ref_no, code, payment_date)
        VALUES ('$invoice_no', '$amount', '$payment_method', '$tr', '$code', '$date')";

        $run_payment = mysqli_query($con, $insert_payment);

        if($run_payment) {
            echo "<h2 style='text-align:center; color: white;'>Payment received, You orders will be completed within 24 hours</h2>";
        }

        $update_order = "UPDATE customer_orders SET order_status='Completed' WHERE order_id='$order_id'";

        $run_order = mysqli_query($con, $update_order);
    }
?>