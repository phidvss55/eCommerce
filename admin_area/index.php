<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Area</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <div class="wrapper">
        <div class="header">
        
        </div>
        <div class="right">
            <h2>Manage Contents</h2><hr>
            <a href="index.php?insert_product">Insert New Products</a>
            <a href="index.php?view_products">View All Products</a>
            <a href="index.php?insert_cart">Insert New Category</a>
            <a href="index.php?view_cart">View All Category</a>
            <a href="index.php?insert_brand">Insert New Brands</a>
            <a href="index.php?view_brand">View All Brands</a>
            <a href="index.php?view_customer">View All Customers</a>
            <a href="index.php?view_orders">View All Orders</a>
            <a href="index.php?view_payments">View Payments</a>
            <a href="logout.php">Admin Logout</a>
        </div>
        <div class="left">
            <?php
                include("includes/db.php");
                if(isset($_GET['insert_product'])) {
                    include("insert_product.php");
                }
                if(isset($_GET['view_products'])) {
                    include("view_products.php");
                }
                if(isset($_GET['edit_pro'])) {
                    include("edit_pro.php");
                }
            ?>
        </div>
    </div>
</body>
</html>