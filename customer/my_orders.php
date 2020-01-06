<?php

    include('includes/db.php');
    include('functions/function.php');

    //getting the customer ID
    $c = $_SESSION['customer_email'];
    $get_c = "SELECT * FROM customer WHERE customer_id='$c'";
    $run_c = mysqli_query($c, $get_c);

    $row_c = mysqli_fetch_array($run_c);
    

?>