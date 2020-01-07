<?php 
	include("includes/db.php");
	
	if(isset($_GET['edit_brand'])) {
		$brand_id = $_GET['edit_brand'];
        $edit_brand = "SELECT * FROM brands WHERE brand_id='$brand_id'";
        
		$run_edit = mysqli_query($con, $edit_brand); 
		$row_edit = mysqli_fetch_array($run_edit);
		
        $brand_edit_id = $row_edit['brand_id'];
		$brand_title = $row_edit['brand_title'];
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Brand</title>
    <style>
        form {
            margin: 15%;
        }
    </style>
</head> 
<body>
    <form action="" method="POST">
        <b>Edit This Brand</b>
        <input type="text" name="brand_title" value="<?php echo $brand_title; ?>"/>
        <input type="submit" name="update_brand" value="Update Brand" />
    </form>
</body>
</html>
<?php
    if(isset($_POST['update_brand'])) {
        $brand_title_new = $_POST['brand_title'];
        $update_brand = "UPDATE brands SET brand_title='$brand_title_new' WHERE brand_id='$brand_edit_id'";
        $run_brand = mysqli_query($con, $update_brand);
        
        if($run_brand) {
            echo "<script>alert('Brand Has been Updated')</script>";
			echo "<script>window.open('index.php?view_brand','_self')</script>";
        }
    }
?>