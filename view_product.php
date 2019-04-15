<?php include ( "inc/connect.inc.php" ); ?>
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
if (isset($_REQUEST['pid'])) {
	
	$pid = mysqli_real_escape_string($db_connect, $_REQUEST['pid']);
}else {
	header('location: index.php');
}

$query = "SELECT * FROM products WHERE id ='$pid'" or die(mysqli_error());
$getposts = mysqli_query($db_connect, $query);
					if (mysqli_num_rows($getposts)) {
						$row = mysqli_fetch_assoc($getposts);
						$id = $row['id'];
						$pName = $row['pName'];
						$price = $row['price'];
						$description = $row['description'];
						$picture = $row['picture'];
						$cat_name = $row['category'];
						$available =$row['available'];
					}	

?>

<!DOCTYPE html>
<html>
<head>
	<title>Product</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
		<!-- bootstrap -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<?php include ( "inc/mainheader.inc.php" ); ?>
	<div class="container">
		<div style="margin: 0 97px; padding: 10px">

			<?php 
				echo '
					<div class = "row">
						<div class="col-md-6">
							<img src="image/product/'.$cat_name.'/'.$picture.'" style="height: 500px; width: 500px; padding: 2px; border: 2px solid #c7587e;">
						</div>
						
						<div class="col-md-6" style="width: 40%;color: #067165;background-color: #ddd;padding: 10px;">
							<div class="pl-4">
								<h3 style="font-size: 25px; font-weight: bold; ">Product name: '.$pName.'</h3><hr>
								<h3 style="padding: 20px 0 0 0; font-size: 20px;">Prize: '.$price.' Tk</h3><hr>
								<h3 style="padding: 20px 0 0 0; font-size: 22px; ">Description:</h3>
								<p>
									'.$description.'
								</p><hr>

								<div>
									<div id="srcheader">
										<form id="" method="post" action="orderform.php?poid='.$pid.'">
										    <input type="submit" value="Order Now" class=" btn btn-success srcbutton mt-1" >
										</form>
										<div class="srcclear"></div>
									</div>
								</div>

							</div>
						</div>
					</div>

				';
			?>

		</div>
		<div style="padding: 30px 95px; font-size: 25px; margin: 20px auto; display: table; width: 98%;">
			<h3 style="padding-bottom: 20px">Recommand Product For You:</h3>
			<?php 
				$query = "SELECT * FROM products WHERE available >='1' AND id != '".$pid."' AND category ='".$cat_name."'  ORDER BY RAND() LIMIT 3" or die(mysqli_error());
				$getposts = mysqli_query($db_connect, $query);
						if (mysqli_num_rows($getposts)) {
						echo '<ul id="recs">';
						while ($row = mysqli_fetch_assoc($getposts)) {
							$id = $row['id'];
							$pName = $row['pName'];
							$price = $row['price'];
							$description = $row['description'];
							$picture = $row['picture'];
							
							echo '
								<ul style="float: left;">
									<li style="float: left; padding: 0px 25px 25px 25px;">
										<div class="home-prodlist-img"><a href="view_product.php?pid='.$id.'">
											<img src="image/product/'.$cat_name.'/'.$picture.'" class="home-prodlist-imgi">
											</a>
											<div style="text-align: center; padding: 0 0 6px 0;"> <span style="font-size: 15px;">'.$pName.'</span><br> Price: '.$price.' Tk</div>
										</div>
										
									</li>
								</ul>
							';

							}
					}
			?>
				
		</div>
	</div>
</body>
</html>
