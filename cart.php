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
                <?php cart(); ?>
                <div id="headline">
                    <div id="headline_content">
                        <?php
                            if(!isset($_SESSION['customer_email'])) {
                                echo "<b>WelCome Guest!</b>";
                            } else {
                                echo "<b>Welcome <span style='font-size: 18px; color: red; text-transform: capitalize'>". $_SESSION['customer_email']."</span></b>";
                            }
                        ?>
                        <b style="color: yellow">Shopping Cart </b>
                        <span>- Total Items: <?php items(); ?> - Total Price: <?php total_price(); ?> - <a href="index.php" style="color:#FF0">Back to shopping</a>
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
            <div class="products_box"><br>
                    <form action="cart.php" method="POST" enctype="multipart/form-data">
                        <table class="table_format">
                            <tr>
                                <td><b>Remove</b></td>
                                <td><b>Product (s)</b></td>
                                <td><b>Quantity</b></td>
                                <td><b>Total Price</b></td>
                            </tr>
                            <?php
                                $ip_add = getRealIpAddr();
                                $total = 0;
                                $set_price = "SELECT * FROM cart WHERE ip_add ='$ip_add'";
                                $run_price = mysqli_query($con, $set_price);
                                while($record = mysqli_fetch_array($run_price)) {
                            
                                    $pro_id = $record['p_id'];
                                    $pro_price = "SELECT * FROM products WHERE product_id ='$pro_id'";
                                    $run_pro_price = mysqli_query($db, $pro_price);
                                    while($p_price = mysqli_fetch_array($run_pro_price)) {

                                        $product_price = array($p_price['product_price']); 
                                        $product_title = $p_price['product_title']; 
                                        $product_image = $p_price['product_img1'];
                                        $only_price = $p_price['product_price'];

                                        $values = array_sum($product_price);
                                        $total += $values;
                            ?>
                            <tr>
                                <td><input type="checkbox" name="remove[]" value="<?php echo $pro_id; ?>"></td>
                                <td><?php echo $product_title; ?><br><img src="./admin_area/product_images/<?php echo $product_image ?>" height="80" width="80px" alt=""></td>
                                <td><input type="number" name="qty" value="1" style="width:80px"></td>
                                <?php
                                    if(isset($_POST['update'])) {
                                        $qty = $_POST['qty'];
                                        $insert_qty = "UPDATE cart SET qty = '$qty' WHERE ip_add ='$ip_add'";
                                        $run_sql = mysqli_query($con, $insert_qty);
                                        $total = $total * $qty;
                                    }
                                ?>
                                <td><?php echo "$". $only_price; ?></td>
                            </tr>
                            <?php }} ?>

                            <tr>
                                <td colspan="3" align="right"><b>Sub Total</b></td>
                                <td><b><?php echo "$". $total ?></b></td>
                            </tr>
                            <tr>
                                <td><input type="submit" name="update" value="Update Cart"></td>
                                <td><input type="submit" name="continue" value="Continue Shopping"></td>
                                <td><button><a href="checkout.php" style="text-decoration:none">Checkout</a></button></td>
                            </tr>
                        </table>
                    </form>
                <?php
                    function updatecart() {
                        global $con;
                        if(isset($_POST['update'])) {
                            foreach($_POST['remove'] as $remove_id) {
                                $delete_products = "DELETE FROM cart WHERE p_id ='$remove_id'";
                                $run_sql = mysqli_query($con, $delete_products);
                                if($run_sql) {
                                    echo "<script>alert('Deleted product successful.</script>";
                                    echo "<script>window.open('cart.php', '_self')</script>";
                                }
                            }
                        }
                        if(isset($_POST['continue'])) {
                            echo "<script>window.open('index.php', '_self')</script>";
                        }
                    }
                    echo @$up_cart = updatecart();
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