<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Insert Category</title>
    <style>
        form {
            margin: 15%;
        }
    </style>
</head>
<body>
    <form action="" method="POST">
        <b>Insert New Category</b>
        <input type="text" name="cat_title">
        <input type="submit" name="insert_cat" value="Insert Catogory">
    </form>
    <?php

        include("includes/db.php");

        if(isset($_POST['insert_cat'])) {
            $cat_title = $_POST['cat_title'];
            $insert_cat = "INSERT INTO categories(cat_title) VALUES('$cat_title')";
            $run_cat = mysqli_query($con, $insert_cat);
            if($run_cat) {
                echo "<script>alert('Insert Category Successfully!');</script>";
                echo "<script>window.open('index.php?view_cat', '_self');</script>";
            }
        }
    ?>
</body>
</html>