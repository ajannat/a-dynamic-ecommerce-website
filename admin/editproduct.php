<?php include ( "../inc/connect.inc.php" ); ?>
<?php 

ob_start();
session_start();
if (!isset($_SESSION['admin_login'])) {
	$user = "";
	header("location: login.php?ono=".$epid."");
}
else {
	if (isset($_REQUEST['epid'])) {
	
		$epid = mysqli_real_escape_string($db_connect, $_REQUEST['epid']);
	}else {
		header('location: index.php');
	}
	$user = $_SESSION['admin_login'];
	$query = "SELECT * FROM admin WHERE id='$user'";
	$result = mysqli_query($db_connect, $query);
	$get_user_email = mysqli_fetch_assoc($result);
		$uname_db = $get_user_email['firstName'];

}
$query = "SELECT * FROM products WHERE id ='$epid'" or die(mysql_error());
$getposts = mysqli_query($db_connect, $query);
	if (mysqli_num_rows($getposts)) {
		$row = mysqli_fetch_assoc($getposts);
		$id = $row['id'];
		$pName = $row['pName'];
		$price = $row['price'];
		$description = $row['description'];
		$picture = $row['picture'];
		// $item = $row['item'];
		// $itemu = ucwords($row['item']);
		$type = $row['brand'];
		$typeu = ucwords($row['brand']);
		$category = $row['category'];
		$categoryu = ucwords($row['category']);
		$code = $row['pCode'];
		$available =$row['available'];
	}	

//update product
if (isset($_POST['updatepro'])) {
	$pname = $_POST['pname'];
	$price = $_POST['price'];
	$available = $_POST['available'];
	$category = $_POST['category'];
	$type = $_POST['type'];
	// $item = $_POST['item'];
	$pCode = $_POST['code'];
	//triming name
	$_POST['pname'] = trim($_POST['pname']);

	$query = "UPDATE products SET pName='$_POST[pname]',price='$_POST[price]',description='$_POST[descri]',available='$_POST[available]',category='$_POST[category]',brand='$_POST[type]',pCode='$_POST[code]' WHERE id='$epid'";

	if($result = mysqli_query($db_connect, $query)){
		header("Location: allproducts.php");

	}else {
		echo "no changed";
	}
}
if (isset($_POST['updatepic'])) {

if($_FILES['profilepic'] == ""){
	
		echo "not changed";
}else {
	//finding file extention
$profile_pic_name = @$_FILES['profilepic']['name'];
$file_basename = substr($profile_pic_name, 0, strripos($profile_pic_name, '.'));
$file_ext = substr($profile_pic_name, strripos($profile_pic_name, '.'));

if (((@$_FILES['profilepic']['type']=='image/jpeg') || (@$_FILES['profilepic']['type']=='image/png') || (@$_FILES['profilepic']['type']=='image/jpg') || (@$_FILES['profilepic']['type']=='image/gif')) && (@$_FILES['profilepic']['size'] < 1000000)) {

	$item = $item;
	if (file_exists("../image/product/$item")) {
		//nothing
	}else {
		mkdir("../image/product/$item");
	}
	
	
	$filename = strtotime(date('Y-m-d H:i:s')).$file_ext;

	if (file_exists("../image/product/$item/".$filename)) {
		echo @$_FILES["profilepic"]["name"]."Already exists";
	}else {
		if(move_uploaded_file(@$_FILES["profilepic"]["tmp_name"], "../image/product/$item/".$filename)){
			$photos = $filename;
			if($result = mysqli_query("UPDATE products SET picture='$photos' WHERE id='$epid'")){

				$delete_file = unlink("../image/product/$item/".$picture);
				header("Location: editproduct.php?epid=".$epid."");
			}else {
				echo "Wrong!";
			}
		}else {
			echo "Something Worng on upload!!!";
		}
		//echo "Uploaded and stored in: userdata/profile_pics/$item/".@$_FILES["profilepic"]["name"];
		
		
	}
	}
	else {
		$error_message = "Choose a picture!";
	}

}
}



if (isset($_POST['delprod'])) {
//triming name
	$query = "SELECT pid FROM orders WHERE pid='$epid'" or die(mysqli_error());
	$getposts1 = mysqli_query($db_connect, $query);
					if ($ttl = mysqli_num_rows($getposts1)) {
						$error_message = "You can not delete this product.<br>Someone ordered this.";
					}
					else {
						$query = "DELETE FROM products WHERE id='$epid'";
						if(mysqli_query($db_connect, $query)){
						header('Location: orders.php');
						}
					}
	}

$search_value = "";

?>

<?php include ( "include/header.php" ); ?>


	<div class="holecontainer" style=" padding-top: 20px; padding: 0 20%">
		<div class="container signupform_content ">
			<div>

				<h2 style="padding-bottom: 20px;">Edit Product Info</h2>
				<div style="float: right;">
				<?php 
					echo '
						<div class="">
						<div class="signupform_text"></div>
						<div>
							<form action="" method="POST" class="registration">
								<div class="signup_form">
									<div class="form-group">
											<input name="pname" id="first_name" placeholder="Product Name" required="required" class="form-control first_name signupbox" type="text" size="30" value="'.$pName.'" >
									</div>
									<div class="form-group">
											<input name="price" id="last_name" placeholder="Price" required="required" class="form-control last_name signupbox" type="text" size="30" value="'.$price.'" >
									</div>
									<div class="form-group">
											<input name="available" placeholder="Available Quantity" required="required" class="form-control email signupbox" type="text" size="30" value="'.$available.'">
									</div>
									<div class="form-group">
											<input name="descri" id="first_name" placeholder="Description" required="required" class="form-control first_name signupbox" type="text" size="30" value="'.$description.'" >
									</div>
									<div class="form-group">'; ?>
										<?php
											$sql = "SELECT cat_name FROM category";
											$result = mysqli_query($db_connect, $sql);
										?><?php echo '
											<select name="category" required="required" class="form-control">
												<option selected value="'.$category.'">'.$categoryu.'</option>';?>
												<?php 
												while ($row = mysqli_fetch_assoc($result)) { ?>
													<option value="<?php echo $row['cat_name']; ?>"><?php echo $row['cat_name']; ?></option>
												<?php } ?><?php echo '
											</select>

									</div>
									<div class="form-group">
											<input name="type" id="first_name" placeholder="Description" required="required" class="form-control first_name signupbox" type="text" size="30" value="'.$type.'" >
									</div>
									<div class="form-group">
											<input name="code" id="password-1" required="required"  placeholder="Code" class="form-control password signupbox " type="text" size="30" value="'.$code.'">
									</div>
									<div class="form-group">
										<input name="updatepro" class="btn btn-primary form-control uisignupbutton signupbutton" type="submit" value="Update Product">
									</div>
									<div class="form group">
										<input name="delprod" class="btn btn-danger form-control uisignupbutton signupbutton" type="submit" value="Delete This Product">
									</div>
									<div class="signup_error_msg">
										<?php 
											if (isset($error_message)) {echo $error_message;}
											
										?>
									</div>
								</div>
							</form>
						</div>
					</div>

					';
					if(isset($success_message)) {echo $success_message;}

				 ?>
					
				</div>
			</div>
		</div>
		<div style="float: left;">
			<div>
				<?php
					echo '
						<ul style="float: left;">
							<li style="float: left; padding: 0px 25px 25px 25px;">
								<div class="home-prodlist-img prodlist-img">';
								if (file_exists('../image/product/'.$category.'/'.$picture.'')){
									echo '<img src="../image/product/'.$category.'/'.$picture.'" class="home-prodlist-imgi">';
								}else {
									echo '
									<div class="home-prodlist-imgi" style="text-align: center; padding: 0 0 6px 0;">No Image Found!</div>';
								} echo '
									
								</div>
							</li>
							<li>
								<form action="" method="POST" class="registration" enctype="multipart/form-data">
										<div class="signup_form">
											<div class="form-group">
													<input name="profilepic" style="width: 100%; font-size: 15px;" class="form-control-file password signupbox" type="file" value="Add Picture">
											</div>
											<div class="form-group">
												<input name="updatepic" style="width: 144px;" class="btn btn-primary form-control uisignupbutton signupbutton" type="submit" value="Change Picture">
											</div>
											<div class="signup_error_msg">';
											if(isset($error_message)) {echo $error_message;}
											' </div>
										</div>
									</form>
							</li>
						</ul>
					';
				?>
			</div>

		</div>
	</div>
	
<?php include ( "include/footer.php" ); ?>