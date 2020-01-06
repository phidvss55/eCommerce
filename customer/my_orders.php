<?php

    include('includes/db.php');
    // include('functions/function.php');

    //getting the customer ID
    $c = $_SESSION['customer_email'];
    $get_c = "SELECT * FROM customer WHERE customer_email='$c'";

    $run_c = mysqli_query($db, $get_c);

    $row_c = mysqli_fetch_array($run_c);
    $customer_id = $row_c['customer_id'];
    
?>
<h3 style="text-align: center; margin: 20px 0;">All The orders Detail</h3>
<table width="750" align="center">
    <tr>
        <th>Order No</th>
        <th>Due Amount</th>
        <th>Invoice No</th>
        <th>Total Products</th>
        <th>Order Date</th>
        <th>Paid/Unpaid</th>
        <th>Status</th>
    </tr>
    <?php
        $get_orders = "SELECT * FROM customer_orders WHERE customer_id = '$customer_id'";
        $run_orders = mysqli_query($con, $get_orders);

        $i = 0;

        while($row_orders = mysqli_fetch_array($run_orders)) {
            $order_id = $row_orders['order_id'];
            $due_amount = $row_orders['due_amount'];
            $invoice_no = $row_orders['invoice_no'];
            $total_products = $row_orders['total_products'];
            $order_date = $row_orders['order_date'];
            $order_status = $row_orders['order_status'];

            $i++;
            if($order_status == 'Pending') {
                $order_status = 'Unpaid';
            } else {
                $order_status = 'Paid';
            }
            echo "
                <tr style='text-align:center'>
                    <td>$i</td>
                    <td>$due_amount</td>
                    <td>$invoice_no</td>
                    <td>$total_products</td>
                    <td>$order_date</td>
                    <td>$order_status</td>
                    <td><a href='confirm.php?order_id=$order_id' target='_blank'>Confirm Paid</a></td>
                </tr>
            ";
        }
    ?>
    <tr>

    </tr>
</table>