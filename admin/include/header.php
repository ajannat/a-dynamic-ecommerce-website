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
						<?php 
							if ($user!="") {
								echo '<a style="text-decoration: none;color: #fff;" href="logout.php">LOG OUT</a>';
							}
						 ?>
						
					</div>
				
					
					<div class="uiloginbutton signinButton loginButton">
						<?php 
							if ($user!="") {
								echo '<a style="text-decoration: none;color: #fff;" href="login.php">Hi, '.$uname_db.'</a>';

							}
							else {
								echo '<a style="text-decoration: none;color: #fff;" href="login.php">LOG IN</a>';
							}
						 ?>
					</div>
				</div>
				<!-- <div id="srcheader">
					<form id="newsearch" method="get" action="search.php">
					        <?php 
					        	echo '<input type="text" class="srctextinput" name="keywords" size="21" maxlength="120"  placeholder="Search Here..." value="'.$search_value.'"><input type="submit" value="search" class="srcbutton" >';
					         ?>
					</form>
				<div class="srcclear"></div>
				</div> -->
			</div>
		</div>
	

		<!-- <div class="categories">
			<div class="container">
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="addproduct.php">Add Product</a></li>
					<li><a href="addemployee.php">Add Employee</a></li>
					<li><a href="allproducts.php">All Products</a></li>
					<li><a href="orders.php">View Orders</a></li>
				</ul>
			</div>
		</div> -->

		<!-- <div class="categories"> -->
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-2 p-0">
						<div class="categories">
							<ul>
								<!-- <li><a href="index.php">Home</a></li> -->
								<li><a href="orders.php">All Orders</a></li>
								<li><a href="allproducts.php">All Products</a></li>
								<li><a href="allcategory.php">All Category</a></li>
								<!-- <li><a href="alltype.php">All Type</a></li> -->
								<li><a href="allemployee.php">All Employee</a></li>
								<li><a href="addemployee.php">Add Employee</a></li>
								<li><a href="addproduct.php">Add Product</a></li>
								<li><a href="addcategory.php">Add Category</a></li>
								<!-- <li><a href="addtype.php">Add Type</a></li> -->
							</ul>
						</div>
					</div>
					<div class="col-md-10 p-0">
						
					
		<!-- </div> -->