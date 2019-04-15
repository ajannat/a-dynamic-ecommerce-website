<?php include ( "inc/connect.inc.php" ); ?>
<?php
ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
}
else {
	header("Location: index.php");
}

$u_fname = "";
$u_lname = "";
$u_email = "";
$u_mobile = "";
$u_address = "";
$u_pass = "";

if (isset($_POST['signup'])) {
//declere veriable
$u_fname = $_POST['first_name'];
$u_lname = $_POST['last_name'];
$u_email = $_POST['email'];
$u_mobile = $_POST['mobile'];
$u_address = $_POST['signupaddress'];
$u_pass = $_POST['password'];
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
		if(empty($_POST['signupaddress'])) {
			throw new Exception('Address can not be empty');
			
		}

		
		// Check if email already exists
		
		$check = 0;
		$query = "SELECT email FROM `user` WHERE email='$u_email'";
		$e_check = mysqli_query($db_connect, $query);
		$email_check = mysqli_num_rows($e_check);
		if (strlen($_POST['first_name']) >2 && strlen($_POST['first_name']) <16 ) {
			if ($check == 0 ) {
				if ($email_check == 0) {
					if (strlen($_POST['password']) >1 ) {
						$d = date("Y-m-d"); //Year - Month - Day
						$_POST['first_name'] = ucwords($_POST['first_name']);
						$_POST['last_name'] = ucwords($_POST['last_name']);
						$_POST['last_name'] = ucwords($_POST['last_name']);
						$_POST['email'] = mb_convert_case($u_email, MB_CASE_LOWER, "UTF-8");
						$_POST['password'] = md5($_POST['password']);
						$confirmCode   = substr( rand() * 900000 + 100000, 0, 6 );
						// send email
						$msg = "
						Assalamu Alaikum...
						
						Your activation code: ".$confirmCode."
						Signup email: ".$_POST['email']."
						
						";
						if (2<3) {
							
						$query = "INSERT INTO user (firstName,lastName,email,mobile,address,password,confirmCode) VALUES ('$_POST[first_name]','$_POST[last_name]','$_POST[email]','$_POST[mobile]','$_POST[signupaddress]','$_POST[password]','$confirmCode')";
						$result = mysqli_query($db_connect, $query);
						
						//success message
						$success_message = '
						<div class=" text-center signupform_content"><h2><font face="bookman">Registration successfull!</font></h2>
						<div class="signupform_text" style="font-size: 18px; text-align: center;">
						<font face="bookman">
							Email: '.$u_email.'<br>
							Thank you for being with us.
						</font></div></div>';
						}
						else {
							throw new Exception('Email is not valid!');
						}
						
						
					}else {
						throw new Exception('Make strong password!');
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


?>


<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to ebuybd online shop</title>
		<!-- bootstrap -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body class="home-welcome-text" style="background-color: #171211e6;">
		<div class="homepageheader" style="position: inherit;">
			<div class="signinButton loginButton">
				<div class="uiloginbutton signinButton loginButton" style="margin-right: 40px;">
					<a style="text-decoration: none;" href="signin.php">SIGN IN</a>
				</div>
				<div class="uiloginbutton signinButton loginButton" style="">
					<a style="text-decoration: none;" href="login.php">LOG IN</a>
				</div>
			</div>
			<div style="float: left; margin: 5px 0px 0px 23px;">
				<a href="index.php">
					<ul>
						<li><img style=" height: 75px; width: 130px;" src="image/logo.png"></li>
						<li style="position: absolute; top: 20px; left: 120px;"><h3 style="color: #fff; font-size: 35px;">BRAC BAZAR</h3></li>
					</ul>
				</a>
			</div>
		</div>
		<?php 
			if(isset($success_message)) {echo $success_message;}
			else { ?>
				<div class="holecontainer" style="float: right; margin-right: 36%; padding-top: 26px;">
			<div class="container">
				
					
				<div class="signupform_content">
					<h2>Sign Up Form!</h2>
					<div class="signupform_text"></div>
					<div>
						<form action="" method="POST" class="registration">
							<div class="signup_form">
								<div class="form-group">
										<input name="first_name" id="first_name" placeholder="First Name" required="required" class="form-control" type="text" size="40" value="" >

								</div>
								<div class="form-group">
										<input name="last_name" id="last_name" placeholder="Last Name" required="required" class="form-control" type="text" size="40" value="" >
				
								</div>
								<div class="form-group">
										<input name="email" placeholder="Enter Your Email" required="required" class="form-control" type="email" size="40" value="">
														
								</div>
								<div class="form-group">
										<input name="mobile" placeholder="Enter Your Mobile" required="required" class="form-control" type="text" size="40" value="">
				
								</div>
								<div class="form-group">
										<input name="signupaddress" placeholder="Address" required="required" class="form-control" type="text" size="40" value="">
				
								</div>
								<div class="form-group">
										<input name="password" id="password-1" required="required"  placeholder="Enter New Password" class="form-control" type="password" size="40" value="">
		
								</div>
								<div class="form-group">
									<input name="signup" class="form-control btn btn-primary" type="submit" value="Sign Me Up!">
								</div>
								<div class="signup_error_msg">


									
									<?php  	if (isset($error_message)) {echo $error_message;}
									?>
										
								</div>
							</div>
						</form>
						
					</div>
				</div>
					
				
			</div>
		</div>
			<?php } ?>

		 
	</body>
</html>
