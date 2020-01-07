<?php 
	include("includes/db.php");
	
	if(isset($_GET['edit_cat'])) {
		$cat_id = $_GET['edit_cat'];
		$edit_cat = "SELECT * FROM categories WHERE cat_id='$cat_id'";
		$run_edit = mysqli_query($con, $edit_cat); 
		$row_edit = mysqli_fetch_array($run_edit);
		
        $cat_edit_id = $row_edit['cat_id'];
		$cat_title = $row_edit['cat_title'];
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Category</title>
    <style>
        form {
            margin: 15%;
        }
    </style>
</head> 
<body>
    <form action="" method="POST">
        <b>Edit This Category</b>
        <input type="text" name="cat_title" value="<?php echo $cat_title; ?>"/>
        <input type="submit" name="update_cat" value="Update Category" />
    </form>
</body>
</html>
<?php
    if(isset($_POST['update_cat'])) {
        $cat_title_new = $_POST['cat_title'];
        $update_cat = "UPDATE categories SET cat_title='$cat_title_new' WHERE cat_id='$cat_edit_id'";
        $run_cat = mysqli_query($con, $update_cat);
        
        if($run_cat) {
            echo "<script>alert('Category Has been Updated')</script>";
			echo "<script>window.open('index.php?view_cat','_self')</script>";
        }
    }
?>