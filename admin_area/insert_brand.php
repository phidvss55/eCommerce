<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Insert Brand</title>
    <style>
        form {
            margin: 15%;
        }
    </style>
</head>
<body>
    <form action="" method="POST">
        <b>Insert New Brand</b>
        <input type="text" name="brand_title">
        <input type="submit" name="insert_brand" value="Insert Brand">
    </form>
    <?php

        include("includes/db.php");

        if(isset($_POST['insert_brand'])) {

            $brand_title = $_POST['brand_title'];

            $insert_brand = "INSERT INTO brands(brand_title) VALUES('$brand_title')";
            $run_brand = mysqli_query($con, $insert_brand);
            if($run_brand) {
                echo "<script>alert('Insert Brand Successfully!');</script>";
                echo "<script>window.open('index.php?view_brand', '_self');</script>";
            }

        }
    ?>
</body>
</html>