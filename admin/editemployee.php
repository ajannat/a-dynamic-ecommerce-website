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
		$user_email = $get_user_email['email'];

}
// $fname="";
// echo "$epid";
$query = "SELECT * FROM admin WHERE id ='$epid'" or die(mysql_error());
$getposts = mysqli_query($db_connect, $query);
	// if (mysqli_num_rows($getposts) > 0) {
		$row = mysqli_fetch_assoc($getposts);
		$id = $row['id'];
		$fname = $row['firstName'];
		$lname = $row['lastName'];
		$email = $row['email'];
		$mobile = $row['mobile'];
		$address = $row['address'];
		$urole = $row['type'];
	// }	
//update profile
if (isset($_POST['updatepro'])) {
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$mobile = $_POST['mobile'];
	$address = $_POST['address'];
	$role = $_POST['role'];
	//triming name
	$_POST['fname'] = trim($_POST['fname']);
	$_POST['lname'] = trim($_POST['lname']);

	$query = "UPDATE admin SET firstName='$_POST[fname]',lastName='$_POST[lname]',email='$_POST[email]',mobile='$_POST[mobile]',address='$_POST[address]',type='$_POST[role]' WHERE id='$epid'";

	if($result = mysqli_query($db_connect, $query)){
		header("Location: allemployee.php");

	}else {
		echo "no changed";
	}
}




if (isset($_POST['delprod'])) {
//triming name
	$em = $_POST['email'];
	$query = "SELECT * FROM admin WHERE email='$em'" or die(mysqli_error());
	$getposts1 = mysqli_query($db_connect, $query);
	$ttl = mysqli_fetch_assoc($getposts1);
			if ($ttl['email'] === $user_email) {
						$error_message = "User is currently logged in.";
						echo "<script type='text/javascript'>alert('$error_message');</script>";
					}
					else {
						$query = "DELETE FROM admin WHERE id='$epid'";
						if(mysqli_query($db_connect, $query)){
						header('Location: allemployee.php');
					}
					
					}
	}

$search_value = "";

// echo '<input name="pname" id="first_name" placeholder="Product Name" required="required" class="form-control first_name signupbox" type="text" size="30" value="'.$fname.'" >';
?>
<?php include ( "include/header.php" ); ?>


	<div class="holecontainer" style=" padding-top: 20px; padding: 0 20%">
		<div class="container signupform_content ">
			<div>

				<h2 style="padding-bottom: 20px;">Edit Employee Info</h2>
				<div >
				<?php 
					echo '
						<div class="">
						<div class="signupform_text"></div>
						<div>
							<form action="" method="POST" class="registration">
								<div class="signup_form">
									<div class="form-group">
											<input name="fname" id="first_name" placeholder="Product Name" required="required" class="form-control first_name signupbox" type="text" size="30" value="'.$fname.'" >
									</div>
									<div class="form-group">
											<input name="lname" id="last_name" placeholder="Price" required="required" class="form-control last_name signupbox" type="text" size="30" value="'.$lname.'" >
									</div>
									<div class="form-group">
											<input name="email" placeholder="Available Quantity" required="required" class="form-control email signupbox" type="text" size="30" value="'.$email.'">
									</div>
									<div class="form-group">
											<input name="mobile" id="first_name" placeholder="Description" required="required" class="form-control first_name signupbox" type="text" size="30" value="'.$mobile.'" >
									</div>
									<div class="form-group">
											<input name="address" id="first_name" placeholder="Description" required="required" class="form-control first_name signupbox" type="text" size="30" value="'.$address.'" >
									</div>
									<div class="form-group">'; ?>
										<?php
											$sql = "SELECT type FROM admin";
											$result = mysqli_query($db_connect, $sql);
										?><?php echo '
											<select name="role" required="required" class="form-control">
												<option selected value="'.$urole.'">'.$urole.'</option>';?>
												<?php 
												while ($row = mysqli_fetch_assoc($result)) { ?>
													<option value="<?php echo $row['type']; ?>"><?php echo $row['type']; ?></option>
												<?php } ?><?php echo '
											</select>

									</div>
									<div class="form-group">
										<input name="updatepro" class="btn btn-primary form-control uisignupbutton signupbutton" type="submit" value="Update Profile">
									</div>
									<div class="form group">
										<input name="delprod" class="btn btn-danger form-control uisignupbutton signupbutton" type="submit" value="Delete User">
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
	
	</div>
	
<?php include ( "include/footer.php" ); ?>