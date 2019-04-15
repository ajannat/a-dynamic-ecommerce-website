<?php include ( "../inc/connect.inc.php" ); ?>

<?php
ob_start();
session_start();
if (!isset($_SESSION['admin_login'])) {
}
else {
	header("location: index.php");
}

if (isset($_POST['login'])) {
	if (isset($_POST['email']) && isset($_POST['password'])) {
		$user_login = mysqli_real_escape_string($db_connect, $_POST['email']);
		$user_login = mb_convert_case($user_login, MB_CASE_LOWER, "UTF-8");	
		$password_login = mysqli_real_escape_string($db_connect,$_POST['password']);		
		$num = 0;
		$password_login_md5 = md5($password_login);
		$query = "SELECT * FROM admin WHERE (email='$user_login') AND password='$password_login_md5'";
		$result = mysqli_query($db_connect, $query);
		$num = mysqli_num_rows($result);
		$get_user_email = mysqli_fetch_assoc($result);
			$get_user_uname_db = $get_user_email['id'];
		if ($num>0) {
			$_SESSION['admin_login'] = $get_user_uname_db;
			setcookie('admin_login', $user_login, time() + (365 * 24 * 60 * 60), "/");
			header('location: index.php');
			exit();
		}
		else {
			$error_message = '<br><br>
				<div class="maincontent_text" style="text-align: center; font-size: 18px;">
				<font face="bookman">Username or Password incorrect.<br>
				</font></div>';
			
		}
	}

}

$search_value = "";

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Managing Panel</title>
		<!-- bootstrap -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

		<!-- main css -->
		<link rel="stylesheet" type="text/css" href="assets/css/admin-style.css">
	</head>
	<body class="home-welcome-text" style="background-image: url(assets/img/frontpagebg.jpg);">

			
		<div class="homepageheader">
			<div class="container-fluid ">

				<div class="" style="float: left; margin: 0px 0px 0px 0px;">
					<a href="index.php">
						<ul>
							<li><img style=" height: 75px; width: 130px;" src="assets/img/logo.png"></li>
							<li style="position: absolute; top: 20px; left: 120px;"><h3 style="color: #fff; font-size: 35px;">BRAC BAZAR</h3></li>
						</ul>
					</a>
				</div>
			<div class="signinButton loginButton">
				<div class="uiloginbutton signinButton loginButton" style="margin-right: 40px;">
					<a style="text-decoration: none;" href="login.php">LOG IN</a>
				</div>
			</div>
		</div>
		<div class="holecontainer" style="float: right; margin-right: 36%; padding-top: 110px;">
			<div class="container">

				<div class="signupform_content">
					<h2>Admin Login</h2>
					<div class="signupform_text"></div>
					<div>
						<form action="" method="POST" class="registration">
							<div class="signup_form">
								<div class="form-group">
										<input name="email" placeholder="Enter Your Email" required="required" class="form-control email signupbox" type="email" size="30" value="">
								</div>
								<div class="form-group">
										<input name="password" id="password-1" required="required"  placeholder="Enter Password" class="form-control password signupbox " type="password" size="30" value="">
								</div>
								<div class="form-group">
									<input name="login" class="form-control btn btn-primary uisignupbutton signupbutton" type="submit" value="Log In">
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
		</div>
	</body>
</html>