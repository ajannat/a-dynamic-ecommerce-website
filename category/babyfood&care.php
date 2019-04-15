<?php include ( "../inc/connect.inc.php" ); ?>
<?php 

ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
	$user = "";
}
else {
	$user = $_SESSION['user_login'];
	$query = "SELECT * FROM user WHERE id='$user'";
	$result = mysqli_query($db_connect, $query);
		$get_user_email = mysqli_fetch_assoc($result);
			$uname_db = $get_user_email['firstName'];
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>BRAC BAZAR</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<!-- bootstrap -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<script src="/js/homeslideshow.js"></script>
	</head>
	<body style="min-width: 980px;">
		<div class="homepageheader" style="position: relative;">
			<div class="signinButton loginButton">
				<div class="uiloginbutton signinButton loginButton" style="margin-right: 40px;">
					<?php 
						if ($user!="") {
							echo '<a style="text-decoration: none; color: #fff;" href="logout.php">LOG OUT</a>';
						}
						else {
							echo '<a style="color: #fff; text-decoration: none;" href="signin.php">SIGN UP</a>';
						}
					 ?>
					
				</div>
				<div class="uiloginbutton signinButton loginButton" style="">
					<?php 
						if ($user!="") {
							echo '<a style="text-decoration: none; color: #fff;" href="profile.php?uid='.$user.'">Hi '.$uname_db.'</a>';
						}
						else {
							echo '<a style="text-decoration: none; color: #fff;" href="login.php">LOG IN</a>';
						}
					 ?>
				</div>
			</div>
			<div style="float: left; margin: 5px 0px 0px 23px;">
				<a href="../index.php">
					<ul>
						<li><img style=" height: 75px; width: 130px;" src="../image/logo.png"></li>
						<li style="position: absolute; top: 20px; left: 120px;"><h3 style="color: #fff; font-size: 35px;">BRAC BAZAR</h3></li>
					</ul>
				</a>
			</div>
			<!-- <div class="">
				<div id="srcheader">
					<form id="newsearch" method="get" action="search.php">
					        <input type="text" class="srctextinput" name="keywords" size="21" maxlength="120"  placeholder="Search Here..."><input type="submit" value="search" class="srcbutton" >
					</form>
				<div class="srcclear"></div>
				</div>
			</div> -->
		</div>


		<div class="home-welcome">
			<div class="home-welcome-text" style=" height: 380px; ">
				<h1 style="margin: 0px;">Welcome to BRAC BAZAR</h1>
				<h2>Largest Online Grocery Shop In Bangladesh</h2>
			</div>
			<div class="home-after"></div>
		</div>
 <?php 
//  $product_id="";
// if(isset($_GET['id']) && $_GET['id'] !== ''){
//   $product_id = $_GET['id'];
//   echo $product_id;
// } else {
//   echo "failed";
// }
?> 

		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<div class="home-prodlist">
						<form id="myform" method="post">
							<div class="form-group categories">
								<h4>Categories</h4>
								<ul>
									<?php
									$query = "SELECT * FROM category";
									$result = mysqli_query($db_connect, $query);
									while ($row = mysqli_fetch_assoc($result)) {
										$cat_name = $row['cat_name'];
										$cat_name_up = ucfirst($cat_name);

										$s=ucfirst($cat_name);
										$bar = ucwords(strtolower($s));
										$data= preg_replace('/\s+/', '', $bar).'.php';
										$data = strtolower($data);
												
									?>
									
									<li><a href="<?php echo $data; ?>"><?php echo $cat_name_up; ?></a></li>
									<?php } ?>
								</ul>

							</div>
						</form>
					</div>
				</div>
				<div class="col-md-9">
					<div class="home-items pl-5" style="padding: 50px 10px; font-size: 25px; margin: 0 auto; display: table; width: 98%;">

						<?php 

							$query = "SELECT * FROM products WHERE available >='1' AND category='baby food & care' LIMIT 15" or die(mysqli_error());
							$getposts = mysqli_query($db_connect, $query);
									if (mysqli_num_rows($getposts)) {
									echo '<ul id="recs">';
									while ($row = mysqli_fetch_assoc($getposts)) {
										$id = $row['id'];
										$pName = $row['pName'];
										$price = $row['price'];
										$description = $row['description'];
										$picture = $row['picture'];
										$name = $row['category'];



										// <div class="col-md-4">baal</div>										
									echo '

										
											<div class="col-md-4 float-left">
												<ul style="">
													<li style="">
														<div class="home-prodlist-img"><a href="../view_product.php?pid='.$id.'">
															<img src="../image/product/'.$name.'/'.$picture.'" class="home-prodlist-imgi">
															</a>
															<div style="text-align: center; padding: 0 0 6px 0;"> <span style="font-size: 15px;">'.$pName.'</span><br> Price: '.$price.' Tk</div>
														</div>
														
													</li>
												</ul>
											</div>
										
									';

									}
									}
								
							?>
					<!-- </div> -->
				</div>
			</div>
		</div>
		


		


		
	</body>
</html>