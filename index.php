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
            <img src="./images/logo.gif" alt="Logo Image" style="float: left">
            <img src="./images/ad_banner.gif" alt="Advertisment" style="float: right">
        </div>

        <!-- Navigation Bar Starts -->
        <div id="navbar">
            <ul id="menu">
                <li><a href="#">Home</a></li>
                <li><a href="#">All Products</a></li>
                <li><a href="#">My Account</a></li>
                <li><a href="#">Sign Up</a></li>
                <li><a href="#">Shopping Cart</a></li>
                <li><a href="#">Contact Us</a></li>
            </ul>
            <div id="form">
                <form action="results.php" method="GET" enctype="multipart/form-data">
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
                    <li><a href="#">Laptops</a></li>
                    <li><a href="#">Mobiles</a></li>
                    <li><a href="#">Cameras</a></li>
                    <li><a href="#">Tables</a></li>
                    <li><a href="#">Computers</a></li>
                    <li><a href="#">Others Devices</a></li>
                </ul>
                <!--  -->
                <div id="sidebar_title">Brands</div>
                <ul id="cats">
                    <li><a href="#">Motorola</a></li>
                    <li><a href="#">Nokia</a></li>
                    <li><a href="#">HP</a></li>
                    <li><a href="#">DELL</a></li>
                    <li><a href="#">SAMSUNG</a></li>
                    <li><a href="#">SONY</a></li>
                    <li><a href="#">ASUS</a></li>
                </ul>
            </div>
            <div id="right_content">Right Content</div>
        </div>
        <div class="footer">
            <h2>&copy; 2019 - By www.noname.com</h2>
        </div>
    </div>

</body>
</html>