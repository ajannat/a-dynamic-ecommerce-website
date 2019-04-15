<?php include ( "inc/connect.inc.php" ); ?>
<?php session_start(); ?>
<?php
ob_start();
if (isset($_POST['submit'])) {
	$message = "A reset link has been sent to your email.";
echo "<script type='text/javascript'>alert('$message');</script>";
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Password Recover</title>
		<!-- bootstrap -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<meta charset="uft-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body class="home-welcome-text" style="background-color: #171211e6;">
	<div>
		<div class="homepageheader">
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
	</div>
	<div class="holecontainer" style="float: right; margin-right: 36%; padding-top: 110px;">
		<div class="container">
			<div>
				<div>
					<div class="signupform_content">
						<h2>Enter email to reset password!</h2>
						<div class="signupform_text"></div>
						<div>
							<form action="" method="POST" class="registration">
								<div class="signup_form">
									<div class="form-group">
											<input type="text" autocomplete="off" name="username" class="form-control" placeholder="Write Your Email..." size="30" required autofocus>
									
									</div>
									<div class="form-group">
										<input class="form-control btn btn-primary" type="submit" name="submit" id="senddata" value="Submit">
									</div>
									<div class="signup_error_msg">
									</div>
								</div>
							</form>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>