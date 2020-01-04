<?php
    session_start();
    include('./includes/db.php');
    include('./functions/function.php'); //link to function . php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Shop</title>

    <!-- Link customer css -->
    <link rel="stylesheet" href="./styles/style.css">
</head>
<body>
    
    <div class="main_wrapper">

        <div class="header_wrapper">
            <a href="index.php"><img src="./images/logo.gif" alt="Logo Image" style="float: left"></a>
            <img src="./images/ad_banner.gif" alt="Advertisment" style="float: right">
        </div>

        <!-- Navigation Bar Starts -->
        <div id="navbar">
            <ul id="menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="all_products.php">All Products</a></li>
                <li><a href="my_account.php">My Account</a></li>
                <li><a href="user_regiester.php">Sign Up</a></li>
                <li><a href="cart.php">Shopping Cart</a></li>
                <li><a href="contact.php">Contact Us</a></li>
            </ul>
            <div id="form">
                <form action="result.php" method="GET" enctype="multipart/form-data">
                    <input type="text" name="user_query" placeholder="Search a product">
                    <input type="submit" name="search" value="Search">
                </form>
            </div>
        </div>
        <!--  -->
        <div class="content_wrapper">
            <div id="left_sidebar">
                <div id="sidebar_title">Categories</div>
                <ul id="cats">
                    <?php
                        getCat();
                    ?>
                </ul>
                <!--  -->
                <div id="sidebar_title">Brands</div>
                <ul id="cats">
                    <?php
                        getBrands();
                    ?>
                </ul>
            </div>
            <div id="right_content">
                <?php cart(); ?>
                <div id="headline">
                    <div id="headline_content">
                        <b>Welcome Guest!</b>
                        <b style="color: yellow">Shopping Cart </b>
                        <span>- Total Items: <?php items(); ?> - Total Price: <?php total_price(); ?><a href="cart.php" class="cart"> - Go to cart</a>
                        <?php
                        if(!isset($_SESSION['customer_email'])) {
                            echo "<a href='checkout.php' style='color: orangered'>Login</a>";
                        } else {
                            echo "<a href='logout.php' style='color: red'>Logout</a>";
                        }
                        ?>
                        </span>
                    </div>
                </div>
                <!-- products list -->
                <div class="products_box">
                    <?php 
                        if(!isset($_SESSION['customer_email'])) {
                            include('./customer/customer_login.php');
                        } else {
                            include('./payment_options.php');
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="footer">
            <h2>&copy; 2019 - By www.noname.com</h2>
        </div>
    </div>

</body>
</html>