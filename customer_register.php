<?php
    session_start();
    include('includes/db.php');
    include('functions/function.php'); //link to function . php
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
                    <form action="customer_register.php" method="POST" enctype="multipart/form-data">
                        <table class="table_format">
                            <tr>
                                <td colspan="2"><h2>Create An Account.</h2></td>
                            </tr>
                            <tr>
                                <td><b>Customer Name: </b></td>
                                <td><input type="text" name="c_name" required></td>
                            </tr>
                            <tr>
                                <td><b>Customer Email: </b></td>
                                <td><input type="text" name="c_email" required></td>
                            </tr>
                            <tr>
                                <td><b>Customer Password: </b></td>
                                <td><input type="password" name="c_pass" required></td>
                            </tr>
                            <tr>
                                <td><b>Customer Country: </b></td>
                                <td>
                                    <select name="c_country" id="">
                                        <option value="">Select A Country.</option>
                                        <option value="Viet Nam">Viet Nam</option>
                                        <option value="Japan">Japanese</option>
                                        <option value="Singapore">Singapore</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Customer City: </b></td>
                                <td><input type="text" name="c_city" required></td>
                            </tr>
                            <tr>
                                <td><b>Customer Mobile: </b></td>
                                <td><input type="text" name="c_contact" required></td>
                            </tr>
                            <tr>
                                <td><b>Customer Address: </b></td>
                                <td><input type="text" name="c_address" required></td>
                            </tr>
                            <tr>
                                <td><b>Customer Image: </b></td>
                                <td><input type="file" name="c_image" required></td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="submit" name="register" value="Submit"></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
        <div class="footer">
            <h2>&copy; 2019 - By www.noname.com</h2>
        </div>
    </div>

</body>
</html>

<?php

    if(isset($_POST['register'])) {
        $c_name = $_POST['c_name'];
        $c_email = $_POST['c_email'];
        $c_pass = $_POST['c_pass'];
        $c_country = $_POST['c_country'];
        $c_city = $_POST['c_city'];
        $c_contact = $_POST['c_contact'];
        $c_address = $_POST['c_address'];
        $c_image = $_FILES['c_image']['name'];
        $c_image_tmp = $_FILES['c_image']['tmp_name'];

        $c_ip = getRealIpAddr();

        $insert_customer = "INSERT INTO customer(customer_name, customer_email, customer_password, customer_country, customer_city, customer_contact, customer_address, customer_image, customer_ip)
        VALUES ('$c_name', '$c_email', '$c_pass', '$c_country', '$c_city', '$c_contact', '$c_address', '$c_image', '$c_ip')";;

        $run_customer = mysqli_query($con, $insert_customer);

        move_uploaded_file($c_image_tmp, "./customer/customer_photos/$c_image");
        
        $set_cart = "SELECT * FROM cart WHERE ip_add='$c_ip'";

        $run_cart = mysqli_query($con, $sel_cart);
        $check_cart = mysqli_num_rows($run_cart);
        if($check_cart == 1) {
            $_SESSION['customer_email'] = $c_email;
            echo "<script>alert('Account Created Successfully, Thank You!')</script>";
            echo "<script>window.open('checkout.php','_self')</script>";
        } else {
            $_SESSION['customer_email'] = $c_email;
            echo "<script>alert('Account Created Successfully, Thank You!')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        }
    }

?>