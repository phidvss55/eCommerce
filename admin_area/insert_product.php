<?php
    include('./includes/db.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Insert Product</title>
<!-- //this is just a editor for textarea
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
    tinymce.init({
        selector: '#mytextarea'
    });
    </script> -->
</head>

<body style="background-color: #999999;">
    <form action="insert_product.php" method="POST" enctype="multipart/form-data">
        <table width="750" style="margin: 0 auto; background-color: #006699" border="1">
            <tr>
                <td colspan="2">
                    <h2>Insert New Product</h2>
                </td>
            </tr>
            <tr>
                <td><b>Product Title</b></td>
                <td><input type="text" name="product_title" size="50"></td>
            </tr>
            <tr>
                <td><b>Product Category</b></td>
                <td>
                    <select name="product_cat" id="">
                        <option value="">Select a Category</option>
                        <?php
                        $get_cats = "SELECT * FROM categories";
                        $run_cats = mysqli_query($con, $get_cats);
                        while ($row_cats = mysqli_fetch_array($run_cats)) {

                            $cat_id = $row_cats['cat_id'];
                            $cat_title = $row_cats['cat_title'];

                            echo '<option value="' . $cat_id . '">' . $cat_title . '</option>';
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><b>Product Brand</b></td>
                <td>
                    <select name="product_brand" id="">
                        <option value="">Select a Brand</option>
                        <?php
                        $get_brands = "SELECT * FROM brands";
                        $run_brands = mysqli_query($con, $get_brands);
                        while ($row_brands = mysqli_fetch_array($run_brands)) {

                            $brand_id = $row_brands['brand_id'];
                            $brand_title = $row_brands['brand_title'];

                            echo '<option value="' . $brand_id . '">'. $brand_title . '</option>';
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><b>Product Image 1</b></td>
                <td><input type="file" name="product_img1"></td>
            </tr>
            <tr>
                <td><b>Product Image 2</b></td>
                <td><input type="file" name="product_img2"></td>
            </tr>
            <tr>
                <td><b>Product Image 3</b></td>
                <td><input type="file" name="product_img3"></td>
            </tr>
            <tr>
                <td><b>Product Price</b></td>
                <td><input type="text" name="product_price" size="50"></td>
            </tr>
            <tr>
                <td><b>Product Description</b></td>
                <td><textarea name="product_desc" id="mytextarea" cols="46" rows="10"></textarea></td>
            </tr>
            <tr>
                <td><b>Product Keywords</b></td>
                <td><input type="text" name="product_keywords" size="50"></td>
            </tr>
            <tr>
                <td colspan="2" align="center" style="margin: 0 auto;"><input type="submit" name="insert_product" value="Insert Product"></td>
            </tr>
        </table>
    </form>
</body>
</html>

<?php
    if(isset($_POST['insert_product'])) {

        //text data variables
        $product_title = $_POST['product_title'];
        $product_category = $_POST['product_cat'];
        $product_brand = $_POST['product_brand'];
        $product_price = $_POST['product_price'];
        $product_desc = $_POST['product_desc'];
        $product_keywords = $_POST['product_keywords'];
        $status = 'on';

        //image names
        $product_img1 = $_FILES['product_img1']['name'];
        $product_img2 = $_FILES['product_img2']['name'];
        $product_img3 = $_FILES['product_img3']['name'];

        //image temp names
        $temp_img1 = $_FILES['product_img1']['tmp_name'];
        $temp_img2 = $_FILES['product_img2']['tmp_name'];
        $temp_img3 = $_FILES['product_img3']['tmp_name'];

        if($product_title == '' or $product_category=='' or $product_brand == ''
        or $product_price == '' or $product_desc == '' or $product_keywords == '' or $product_img1 == '') {
            echo '<script>alert("Please Fill All the fields.")</script>';
            exit();
        } else {
            //uploading images to its folder
            move_uploaded_file($temp_img1, './product_images/'.$product_img1);
            move_uploaded_file($temp_img2, './product_images/'.$product_img2);
            move_uploaded_file($temp_img3, './product_images/'.$product_img3);

            $insert_product = "INSERT INTO products (cat_id,brand_id,date, product_title, product_img1, product_img2, product_img3, product_price, product_desc, status) 
            VALUES ('$product_category', '$product_brand', NOW(), '$product_title', '$product_img1', '$product_img2','$product_img3', '$product_price', '$product_desc', '$status')";

            $run_product = mysqli_query($con, $insert_product);

            if($run_product) {
                echo "<script>alert('Product Inserted successfully.')</script>";
                echo "<script>window.open('index.php', '_self');</script>";
            } else {
                echo "<script>alert('Falled to insert product.')</script>";
            }
        }
    }
?>