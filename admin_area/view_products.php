<?php
    // if(!isset($_SESSION['admin_email'])) {
    //     echo "<script>window.open('login.php', '_self');</script>";
    // } else {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Products</title>

    <style>
        th, td {
            border: 3px groove #000;
        }

        table {
            border: 2px solid #000;
        }
    </style>
</head>
<body>
    <?php 
    if(isset($_GET['view_products'])) { ?>
    <table align="center" width="794" bgcolor="#FFCC99" border="2">
        <tr align="center">
            <td colspan="8">
                <h2>View All Products</h2>
            </td>
        </tr>
        <tr>
            <th>Product No</th>
            <th>Title</th>
            <th>Image</th>
            <th>Price</th>
            <th>Total Sold</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php
            include('includes/db.php');
            $i = 0;
            $get_pro = "SELECT * FROM products";
            $run_pro = mysqli_query($con, $get_pro);

            while($row_pro = mysqli_fetch_array($run_pro)) {
                $p_id = $row_pro['product_id'];
                $p_title = $row_pro['product_title'];
                $p_image = $row_pro['product_img1'];
                $p_price = $row_pro['product_price'];
                $status = $row_pro['status'];
                $i++;
        ?>
        <tr align="center">
            <td><?php echo $i; ?></td>
            <td><?php echo $p_title; ?></td>
            <td><img src="product_images/<?php echo $p_image ?>" alt="" width="60" height="60"></td>
            <td><?php echo $p_price?></td>
            <td>
                <?php 
                    $get_sold = "SELECT * FROM pending_orders WHERE product_id='$p_id'";
                    $run_sold = mysqli_query($con, $get_sold);
                    $count = mysqli_num_rows($run_sold);
                    echo $count;
                ?>
            </td>
            <td><?php echo $status; ?></td>
            <td><a href="index.php?edit_pro=<?php echo $p_id; ?>">Edit</a></td>
            <td><a href="delete_pro.php?delete_pro=<?php echo $p_id; ?>">Delete</a></td>
        </tr>
        <?php } ?>
    </table>
    <?php } ?>
</body>
</html>

<?php //} ?>