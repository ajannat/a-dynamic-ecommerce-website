<?php include ( "../inc/connect.inc.php" ); ?>
<?php 
ob_start();
session_start();
if (!isset($_SESSION['admin_login'])) {
	header("location: login.php");
	$user = "";
}
else {
	$user = $_SESSION['admin_login'];
	$query = "SELECT * FROM admin WHERE id='$user'";
	$result = mysqli_query($db_connect, $query);
		$get_user_email = mysqli_fetch_assoc($result);
			$uname_db = $get_user_email['firstName'];
}



if (isset($_POST['signup'])) {
//declere veriable
$cat_name = $_POST['cat_name'];

//triming name
$_POST['cat_name'] = trim($_POST['cat_name']);

// check if category already exists
	$query = "SELECT cat_name FROM `category` WHERE cat_name='$cat_name'";
	$check = mysqli_query($db_connect, $query);
	$cat_check = mysqli_num_rows($check);

	if ($cat_check == 0) {

		$query = "INSERT INTO category(cat_name) VALUES ('$_POST[cat_name]')";
		$result = mysqli_query($db_connect, $query);
		header("Location: allcategory.php");
	}
		
	else {
		echo 'Category already exists!';
	}
}
$search_value = "";

?>


<?php include ( "include/header.php" ); ?>


		<?php 
			if(isset($success_message)) {echo $success_message;}
			else { ?>
			
					<div class="holecontainer" style="margin: 0 30% 0 30%; padding-top: 20px;">
						<div class="container">
						
							<div class="signupform_content">
								<h2>Add New Category</h2>
								<div class="signup_error_msg">'
									<?php if (isset($error_message)) {echo $error_message;} ?>
								</div>
								<div class=""></div>
								<div>
									<form action="" method="POST" class="registration" enctype="multipart/form-data">
										
										<div class="form-group">
										
											<input name="cat_name" id="cat_name" class="form-control" placeholder="Category Name*" required="required" class="cat_name signupbox" type="text" size="30" value="" >
									
										</div>
										<div class="form-group">
											<input name="signup" class="form-control signupbutton uisignupbutton add-product-btn" type="submit" value="Add Category">
										</div>
									</form>
									
								</div>
							</div>
								
							
						</div>
					</div>
				
			<?php } ?>
<?php include ( "include/footer.php" ); ?>