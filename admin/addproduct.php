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
$pname = "";
$price = "";
$available = "";
$category = "";
$type = "";
$item = "";
$pCode = "";
$descri = "";

if (isset($_POST['signup'])) {
//declere veriable
$pname = $_POST['pname'];
$price = $_POST['price'];
$available = $_POST['available'];
$category = $_POST['category'];
// $type = $_POST['type'];
$brand = $_POST['brand'];
$pCode = $_POST['code'];
$descri = $_POST['descri'];
//triming name
$_POST['pname'] = trim($_POST['pname']);

//finding file extention
$profile_pic_name = @$_FILES['profilepic']['name'];
$file_basename = substr($profile_pic_name, 0, strripos($profile_pic_name, '.'));
$file_ext = substr($profile_pic_name, strripos($profile_pic_name, '.'));

if (((@$_FILES['profilepic']['type']=='image/jpeg') || (@$_FILES['profilepic']['type']=='image/png') || (@$_FILES['profilepic']['type']=='image/jpg') || (@$_FILES['profilepic']['type']=='image/gif')) && (@$_FILES['profilepic']['size'] < 1000000)) {

	$category = $category;
	if (file_exists("../image/product/$category")) {
		//nothing
	}else {
		mkdir("../image/product/$category");
	}
	
	
	$filename = strtotime(date('Y-m-d H:i:s')).$file_ext;

	if (file_exists("../image/product/$category/".$filename)) {
		echo @$_FILES["profilepic"]["name"]."Already exists";
	}else {
		if(move_uploaded_file(@$_FILES["profilepic"]["tmp_name"], "../image/product/$category/".$filename)){
			$photos = $filename;
			$query = "INSERT INTO products(pName,price,description,available,category,brand,pCode,picture) VALUES ('$_POST[pname]','$_POST[price]','$_POST[descri]','$_POST[available]','$_POST[category]','$_POST[brand]','$_POST[code]','$photos')";
			$result = mysqli_query($db_connect, $query);
				header("Location: allproducts.php");
		}else {
			echo "Something Worng on upload!!!";
		}
		//echo "Uploaded and stored in: userdata/profile_pics/$item/".@$_FILES["profilepic"]["name"];
		
		
	}
	}
	else {
		$error_message = 'Add picture!';
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
								<h2>Add Product Details</h2>
								<div class="signup_error_msg">'
									<?php if (isset($error_message)) {echo $error_message;} ?>
								</div>
								<div class=""></div>
								<div>
									<form action="" method="POST" class="registration" enctype="multipart/form-data">
										
										<div class="form-group">
										
											<input name="pname" id="first_name" class="form-control" placeholder="Product Name" required="required" class="first_name signupbox" type="text" size="30" value="" >
									
										</div>
										<div class="form-group">
							
											<input name="price" id="last_name" class="form-control" placeholder="Price" required="required" class="last_name signupbox" type="text" size="30" value="" >
									
										</div>
										<div class="form-group">
										
											<input name="available" class="form-control" placeholder="Available Quantity" required="required" class="email signupbox" type="text" size="30" value="">
										
										</div>
										<div class="form-group">
								
											<input name="descri" id="first_name" class="form-control" placeholder="Description" required="required" class="first_name signupbox" type="text" size="30" value="" >
										
										</div>
										<div class="form-group">
											<?php
												$sql = "SELECT cat_name FROM category";
												$result = mysqli_query($db_connect, $sql);
											?>
									
											<select name="category" class="form-control" required>
												<option selected value="">Select Category</option>
												<?php 
												while ($row = mysqli_fetch_assoc($result)) { ?>
													<option value="<?php echo $row['cat_name']; ?>"><?php echo $row['cat_name']; ?></option>
												<?php } ?>
											</select>
										
										</div><!-- 
										<div class="form-group">
								
											<input name="item" id="first_name" class="form-control" placeholder="Enter Item" required class="signupbox" type="text" size="30" value="" >
											
										</div> -->
										<div class="form-group">
								
											<input name="brand" id="first_name" class="form-control" placeholder="Product Brand" required="required" class="signupbox" type="text" size="30" value="" >
										
										</div>
										<div class="form-group">
										
											<input name="code" class="form-control" id="password-1" required="required"  placeholder="Product Code" class="password signupbox " type="text" size="30" value="">
										
										</div>
										<div class="form-group">
										
											<input name="profilepic" class="form-controll" id="file-input" type="file" value="Upload Pic" style="color: #fff; font-size: 15px; height: 30px;">
											
										</div>
										<div class="form-group">
											<input name="signup" class="form-control signupbutton uisignupbutton add-product-btn" type="submit" value="Add Product">
										</div>
									</form>
									
								</div>
							</div>
								
							
						</div>
					</div>
				
			<?php } ?>
<?php include ( "include/footer.php" ); ?>