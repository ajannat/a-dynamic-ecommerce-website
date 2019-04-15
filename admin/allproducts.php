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

$search_value = "";

?>


<?php include ( "include/header.php" ); ?>


		<div>
			<table class="table table-striped table-dark rightsidemenu">
				<tr style="font-weight: bold;" colspan="10" bgcolor="#4DB849">
					<th>SL.</th>
					<th>P Name</th>
					<th>Description</th>
					<th>Price</th>
					<th>Available</th>
					<th>Category</th>
					<th>Brand</th>
					<!-- <th>Item</th> -->
					<th>P Code</th>
					<th>Edit</th>
				</tr>
				<tr>
					<?php //include ( "../inc/connect.inc.php");
					$sl = 0;
					$query = "SELECT * FROM products ORDER BY id DESC";
					$run = mysqli_query($db_connect, $query);
					while ($row=mysqli_fetch_assoc($run)) {
						$id = $row['id'];
						$pName = substr($row['pName'], 0,50);
						$descri = $row['description'];
						$price = $row['price'];
						$available = $row['available'];
						$category = $row['category'];
						// $type = $row['type'];
						$brand = $row['brand'];
						$pCode = $row['pCode'];
						$picture = $row['picture'];

						$sl++;
					
					 ?>
					<th><?php echo $sl; ?></th>
					<th><?php echo $pName; ?></th>
					<th><?php echo $descri; ?></th>
					<th><?php echo $price; ?></th>
					<th><?php echo $available; ?></th>
					<th><?php echo $category; ?></th>
					<!-- <th><?php //echo $type; ?></th> -->
					<th><?php echo $brand; ?></th>
					<th><?php echo $pCode; ?></th>
					<th><?php echo '<div class="home-prodlist-img"><a href="editproduct.php?epid='.$id.'">
									<img src="../image/product/'.$category.'/'.$picture.'" class="home-prodlist-imgi" style="height: 75px; width: 75px;">
									</a>
								</div>' ?></th>
				</tr>
				<?php } ?>
			</table>
		</div>

<?php include ( "include/footer.php" ); ?>