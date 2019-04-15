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
$type_name = $_POST['type_name'];
$cat_name  = $_POST['cat_name'];

//triming name
$_POST['type_name'] = trim($_POST['type_name']);

// check if type already exists
	$query = "SELECT type_name FROM `type` WHERE type_name='$type_name'";
	$check = mysqli_query($db_connect, $query);
	$type_check = mysqli_num_rows($check);

	$cat = "SELECT cat_id FROM `category` WHERE cat_name='$cat_name'";
	$result = mysqli_query($db_connect, $cat);

	$row = mysqli_fetch_assoc($result);
	$cat_id = $row['cat_id'];

	if ($type_check == 0) {

		$query = "INSERT INTO type (cat_id, type_name) VALUES ('$cat_id', '$type_name')";
		$result = mysqli_query($db_connect, $query);
		header("Location: alltype.php");
		// echo '$cat_name';
	}
		
	else {
		echo 'Type already exists!';
	}
}

?>


<?php include ( "include/header.php" ); ?>


		<?php 
			if(isset($success_message)) {echo $success_message;}
			else { ?>
			
					<div class="holecontainer" style="margin: 0 30% 0 30%; padding-top: 20px;">
						<div class="container">
						
							<div class="signupform_content">
								<h2>Add New Type</h2>
								<div class="signup_error_msg">'
									<?php if (isset($error_message)) {echo $error_message;} ?>
								</div>
								<!-- <div class=""></div> -->
								<div>
									<form action="" method="POST" class="registration" enctype="multipart/form-data">
										
										<div class="form-group">
										
											<?php
												$sql = "SELECT cat_name FROM category";
												$result = mysqli_query($db_connect, $sql);
											?>
											<!-- <input name="cat_name" id="cat_name" class="form-control" placeholder="Select Category*" required="required" class="cat_name signupbox" type="text" size="30" value="" > -->
											<select name="cat_name" class="form-control" required>
												<option value="">Select Category*</option>
												<?php 
												while ($row = mysqli_fetch_assoc($result)) { ?>
													<option value="<?php echo $row['cat_name']; ?>"><?php echo $row['cat_name']; ?></option>
												<?php } ?> 
											</select>
									
										</div>
										<div class="form-group">
										
											<input name="type_name" id="type_name" class="form-control" placeholder="Type*" required="required" class="type_name signupbox" type="text" size="30" value="" >
									
										</div>
										<div class="form-group">
											<input name="signup" class="form-control signupbutton uisignupbutton add-product-btn" type="submit" value="Add Type">
										</div>
									</form>
									
								</div>
							</div>
								
							
						</div>
					</div>
				
			<?php } ?>
<?php include ( "include/footer.php" ); ?>