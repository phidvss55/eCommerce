<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Brands</title>
    <style>
        tr, th {
            border: 3px groove #000;
        }
    </style>
</head>
<body>
    <table width="794" align="center" bgcolor="#FFCCCC" border="2">
        <tr align="center">
            <td colspan="4"><h2>View All Brands</h2></td>
        </tr>
        <tr>
            <th>Brands ID</th>
            <th>Brands Title</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
        <?php 
            include("includes/db.php"); 
            
            $get_brand = "SELECT * FROM brands";
            $run_brand  = mysqli_query($con, $get_brand); 
            while($row_brands = mysqli_fetch_array($run_brand)){
                $brand_id = $row_brands['brand_id'];
                $brand_title = $row_brands['brand_title'];
        ?>

        <tr align="center">
            <td><?php echo $brand_id ?></td>
            <td><?php echo $brand_title ?></td>
            <td><a href="delete_brand.php?delete_brand=<?php echo $brand_id; ?>">Delete</a></td>
            <td><a href="index.php?edit_brand=<?php echo $brand_id; ?>">Edit</a></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>