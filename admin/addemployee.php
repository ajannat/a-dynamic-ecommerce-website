
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
$u_fname = $_POST['first_name'];
$u_lname = $_POST['last_name'];
$u_email = $_POST['email'];
$u_mobile = $_POST['mobile'];
$u_address = $_POST['signupaddress'];
//triming name
$_POST['first_name'] = trim($_POST['first_name']);
$_POST['last_name'] = trim($_POST['last_name']);
	try {
		if(empty($_POST['first_name'])) {
			throw new Exception('Fullname can not be empty');
			
		}
		if (is_numeric($_POST['first_name'][0])) {
			throw new Exception('Please write your correct name!');

		}
		if(empty($_POST['last_name'])) {
			throw new Exception('Lastname can not be empty');
			
		}
		if (is_numeric($_POST['last_name'][0])) {
			throw new Exception('lastname first character must be a letter!');

		}
		if(empty($_POST['email'])) {
			throw new Exception('Email can not be empty');
			
		}
		if(empty($_POST['mobile'])) {
			throw new Exception('Mobile can not be empty');
			
		}
		if(empty($_POST['password'])) {
			throw new Exception('Password can not be empty');
			
		}
		if(empty($_POST['admintype'])) {
			throw new Exception('Admin Type can not be empty');
			
		}
		if(empty($_POST['signupaddress'])) {
			throw new Exception('Address can not be empty');
			
		}

		
		// Check if email already exists
		
		$check = 0;
		$query = "SELECT email FROM `admin` WHERE email='$u_email'";
		$e_check = mysqli_query($db_connect, $query);
		$email_check = mysqli_num_rows($e_check);
		if (strlen($_POST['first_name']) >2 && strlen($_POST['first_name']) <16 ) {
			if ($check == 0 ) {
				if ($email_check == 0) {
					if (strlen($_POST['password']) > 4 ) {
						$d = date("Y-m-d"); //Year - Month - Day
						$_POST['first_name'] = ucwords($_POST['first_name']);
						$_POST['last_name'] = ucwords($_POST['last_name']);
						$_POST['password'] = md5($_POST['password']);
						$confirmCode   = substr( rand() * 900000 + 100000, 0, 6 );
						// send email
						$msg = "
						Assalamu Alaikum...
						
						Your activation code: ".$confirmCode."
						Signup email: ".$_POST['email']."
						
						";
						//if (@mail($_POST['email'],"eBuyBD Activation Code",$msg, "From:eBuyBD <no-reply@ebuybd.xyz>")) {
							
						$query = "INSERT INTO admin (firstName,lastName,email,mobile,address,password,type,confirmCode) VALUES ('$_POST[first_name]','$_POST[last_name]','$_POST[email]','$_POST[mobile]','$_POST[signupaddress]','$_POST[password]','$_POST[admintype]','$confirmCode')";
						$result = mysqli_query($db_connect, $query);
						
						//success message
						$success_message = '
						<div class="signupform_content"><h2><font face="bookman">Employee Registration Successfull!</font></h2>
						<div class="signupform_text">
						<font face="bookman">
							Email: '.$u_email.'<br>
							Account Successfully Created. <br>
						</font></div></div>';
						//}else {
						//	throw new Exception('Email is not valid!');
						//}
						
						
					}else {
						throw new Exception('Password must be 5 or more then 5 characters!');
					}
				}else {
					throw new Exception('Email already taken!');
				}
			}else {
				throw new Exception('Username already taken!');
			}
		}else {
			throw new Exception('Firstname must be 2-15 characters!');
		}

	}
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
}

$search_value = "";
?>


<?php include ( "include/header.php" ); ?>

		<?php 
			if(isset($success_message)) {echo $success_message;}
			else { ?>
					<div class="holecontainer" style="float: right; margin-right: 36%; padding-top: 20px;">
						<div class="container">
							
							<div class="signupform_content">
								<h2>Add Employee Details</h2>
							
									<form action="" method="POST" class="registration">
										<div class="signup_form">
											<div class="form-group">
						
												<input name="first_name" id="first_name" placeholder="First Name" required="required" class="form-control" type="text" size="30" value="" >
									
											</div>
											<div class="form-group">
							
												<input name="last_name" id="last_name" placeholder="Last Name" required="required" class="last_name form-control" type="text" size="30" value="" >
								
											</div>
											<div class="form-group">
								
												<input name="email" placeholder="Enter Your Email" required="required" class="email form-control" type="email" size="30" value="">
											</div>
											<div class="form-group">
						
												<input name="mobile" placeholder="Enter Your Mobile" required="required" class="email form-control" type="text" size="30" value="">
								
											</div>
											<div class="form-group">
						
												<input name="signupaddress" placeholder="Full Address" required="required" class="email form-control" type="text" size="30" value="">
									
											</div>
											<div class="form-group">
								
												<input name="password" id="password-1" required="required"  placeholder="Enter New Password" class="password form-control" type="password" size="30" value="">
									
											</div>
											<div class="form-group">
							
												<select name="admintype" required="required" class="form-control">
													<option selected value="manager">Admin</option>
													<option value="seller">Manager</option>
													<option value="seller">Employee</option>
													<option value="other">Other</option>
												</select>
							
											</div>
											<div class="form-group">
												<input name="signup" class="form-control signupbutton uisignupbutton add-product-btn" type="submit" value="Add Employee">
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
					</div>
			
			<?php } ?>

<?php include ( "include/footer.php" ); ?>