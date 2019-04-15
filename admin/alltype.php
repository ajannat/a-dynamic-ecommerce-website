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
					<th>Category Name</th>
					<th>Type</th>
				</tr>
				<tr>
					<?php //include ( "../inc/connect.inc.php");
					$sl = 0;
					$query = "SELECT * FROM type";
					$run = mysqli_query($db_connect, $query);
					while ($row=mysqli_fetch_assoc($run)) {
						$cat_id = $row['cat_id'];
						$type_name = $row['type_name'];

						$sql = "SELECT cat_name FROM category WHERE cat_id = '$cat_id'";
						$result = mysqli_query($db_connect, $sql);

						$ro = mysqli_fetch_assoc($result);
						$cat_name = $ro['cat_name'];

						$sl++;
					
					 ?>
					<th><?php echo $sl; ?></th>
					<th><?php echo $cat_name; ?></th>
					<th><?php echo $type_name; ?></th>
				</tr>
				<?php } ?>
			</table>
		</div>

<?php include ( "include/footer.php" ); ?>