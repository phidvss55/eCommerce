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
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    
    <div class="main_wrapper">

        <div class="header_wrapper">
            <a href="../index.php"><img src="../images/logo.gif" alt="Logo Image" style="float: left"></a>
            <img src="../images/ad_banner.gif" alt="Advertisment" style="float: right">
        </div>

        <!-- Navigation Bar Starts -->
        <div id="navbar">
            <ul id="menu">
                <li><a href="../index.php">Home</a></li>
                <li><a href="../all_products.php">All Products</a></li>
                <li><a href="my_account.php">My Account</a></li>
                <?php
                    if(isset($_SESSION['customer_email'])) {
                        echo "<span style='display:none;'><li><a href='../user_regiester.php'>Sign Up</a></li></span>";
                    } else {
                        echo "<li><a href='../user_resgister.php'>Sign Up</a></li>";
                    }
                ?>

                <li><a href="../cart.php">Shopping Cart</a></li>
                <li><a href="../contact.php">Contact Us</a></li>
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
                <div id="sidebar_title">Manage Account</div>
                <ul id="cats">
                    <?php
                        if(isset($_SESSION['customer_email'])) {
                            $user_session = $_SESSION['customer_email'];
                            $get_customer_pic = "SELECT * FROM customer WHERE customer_email='$user_session'";
                            echo $get_customer_pic;
                            $run_customer = mysqli_query($con, $get_customer_pic);
                            $row_customer = mysqli_fetch_array($run_customer);
                            $customer_pic = $row_customer['customer_image'];
                            echo "<li><img src='customer_photos/$customer_pic' width='150' height='150'><li>
                            <li><b><a href='change_pic.php' style='font-size:16px; color: aqua'>Change Picture</a></b></li><br>
                            ";
                        }
                    ?>
                    <li><a href="my_account.php?my_orders">My Orders</a></li>
                    <li><a href="my_account.php?edit_account">Edit Account</a></li>
                    <li><a href="my_account.php?change_pass">Change Password</a></li>
                    <li><a href="my_account.php?delete_account">Delete Account</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
            <div id="right_content">
                <?php cart(); ?>
                <div id="headline">
                    <div id="headline_content">
                        <?php
                            if(isset($_SESSION['customer_email'])) {
                                echo "<b>Welcome: <span style='font-size: 18px; color: yellow; text-transform: capitalize'>"
                                . $_SESSION['customer_email']." </span></b>";
                            }
                        
                            if(!isset($_SESSION['customer_email'])) {
                                echo "<a href='checkout.php' style='color: orangered'>Login</a>";
                            } else {
                                echo "<a href='logout.php' style='color: red'>Logout</a>";
                            }
                        ?>
                        </span>
                    </div>
                </div>
                <div class="title">
                    <h2>Manage Your Account Here</h2>
                </div>
            </div>
            <?php 
                getDefault() ;

                if(isset($_GET['my_orders'])) {
                    include("my_orders.php");
                }
                
                if(isset($_GET['edit_account'])) {
                    include("edit_account.php");
                }

                if(isset($_GET['change_pass'])) {
                    include("change_pass.php");
                }

                if(isset($_GET['delete_account'])) {
                    include("delete_account.php");
                }
            
            ?>
        </div>
        <div class="footer">
            <h2>&copy; 2019 - By www.noname.com</h2>
        </div>
    </div>

</body>
</html>