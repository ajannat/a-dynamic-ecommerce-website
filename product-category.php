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
?>

<!DOCTYPE html>
<html>
<head>
	<title>SAREE</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<?php include ( "inc/mainheader.inc.php" ); ?>
	<div class="categolis">
		<table>
			<tr>

				<form id="myform" method="post">
				<select name = 'select'>
					<option>select</option>
				<?php
					$query = "SELECT * FROM category";
					$result = mysqli_query($db_connect, $query);
					while ($row = mysqli_fetch_assoc($result)) {
						$cat_name = $row['cat_name'];
						$cat_name_up = ucfirst($cat_name);
								
				?>
					<option><?php echo $cat_name; ?></option>
				<?php } ?>
					<!-- <input type="text" name ="street" id="street" value="" /> -->
				</select><input type="submit" name="formSubmit" value="Submit" ></form>


			
			</tr>
		</table>
	</div>
	<div style="padding: 30px 120px; font-size: 25px; margin: 0 auto; display: table; width: 98%;">
		<div>
		<?php 
			if(isset($_POST['formSubmit']) ){
			$name = $_POST['select'];
 			//$query = mysql_query("select street from table where name = '".$name."'");
			$query = "SELECT * FROM products WHERE available >='1' AND category ='$name'  ORDER BY id DESC LIMIT 10" or die(mysqli_error());
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
										<img src="image/product/'.$name.'/'.$picture.'" class="home-prodlist-imgi">
										</a>
										<div style="text-align: center; padding: 0 0 6px 0;"> <span style="font-size: 15px;">'.$pName.'</span><br> Price: '.$price.' Tk</div>
									</div>
									
								</li>
							</ul>
						';

						}
				}
			}
		?>
			
		</div>
	</div>


</body>
</html>


<div style="padding: 30px 120px; font-size: 25px; margin: 0 auto; display: table; width: 98%;">

						<?php 
							if(isset($_POST['formSubmit']) ){
							$cat_name = $_POST['select'];
				 			//$query = mysql_query("select street from table where name = '".$name."'");
							$query = "";
				 			if ($cat_name === 'Select Category') {
				 				$query = "SELECT * FROM products WHERE available >='1' LIMIT 10" or die(mysqli_error());
				 			}
				 			else{
								$query = "SELECT * FROM products WHERE available >='1' AND category ='$cat_name'  ORDER BY id DESC LIMIT 10" or die(mysqli_error());
				 			}
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

										if ($name === 'Select Category') {
											$q = "SELECT * FROM products WHERE id = '$id'";
											$re = mysqli_query($db_connect, $q);
											$ro = mysqli_fetch_assoc($re);
											$name = $ro['category'];
										}
										
									echo '
										<ul style="float: left;">
											<li style="float: left; padding: 0px 25px 25px 25px;">
												<div class="home-prodlist-img"><a href="view_product.php?pid='.$id.'">
													<img src="image/product/'.$name.'/'.$picture.'" class="home-prodlist-imgi">
													</a>
													<div style="text-align: center; padding: 0 0 6px 0;"> <span style="font-size: 15px;">'.$pName.'</span><br> Price: '.$price.' Tk</div>
												</div>
												
											</li>
										</ul>
									';

									}
									}
								}
							?>
					</div>