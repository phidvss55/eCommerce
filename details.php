<?php
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
                <li><a href="customer/my_account.php">My Account</a></li>
                <li><a href="customer_register.php">Sign Up</a></li>
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
                <div id="headline">
                    <div id="headline_content">
                        <b>Welcome Guest!</b>
                        <b style="color: yellow">Shopping Cart </b>
                        <span>- Items: - Price: </span>
                    </div>
                </div>
            <!-- products list -->
            <div class="products_box">
                <?php 
                    if(isset($_GET['pro_id'])) {
                        $product_id = $_GET['pro_id'];
                        $get_products = "SELECT * FROM products where product_id=".$product_id;
                    
                        $run_products = mysqli_query($db, $get_products);

                        while($row_products = mysqli_fetch_array($run_products)) {
                            $pro_id = $row_products['product_id'];
                            $pro_title = $row_products['product_title'];
                            $pro_desc = $row_products['product_desc'];
                            $pro_price = $row_products['product_price'];
                            $pro_image1 = $row_products['product_img1'];
                            $pro_image2 = $row_products['product_img2'];
                            $pro_image3 = $row_products['product_img3'];

                            echo "<div id='single_product'>
                                    <h3>$pro_title</h3>
                                    <img src='./admin_area/product_images/$pro_image1' width='180' height='180'/>
                                    <img src='./admin_area/product_images/$pro_image2' width='180' height='180'/>
                                    <img src='./admin_area/product_images/$pro_image3' width='180' height='180'/><br>

                                    <p><b>Price: <span style='color:red'>$pro_price</span></b></p>
                                    <p>$pro_desc</p>
                                    
                                    <a href='index.php' style='float:left;'>Go Back</a>
                                    <a href='index.php?add_cart=$pro_id'><button style='float:right;'>Add To Cart</button></a>
                                </div>
                            ";
                        }
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