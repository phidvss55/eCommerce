<?php
    include('includes/db.php');
    if(isset($_GET['delete_cat'])) {
        $delete_id = $_GET['delete_cat'];

        $delete_cat = "DELETE FROM categories WHERE cat_id = '$delete_id'";

        $run_delete = mysqli_query($con, $delete_cat);
        if($run_delete) {
            echo "<script>alert('One category has been deleted.!')</script>";
            echo "<script>window.open('index.php?view_cat', '_self')</script>";
        }
    }
?>