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
				</tr>
				<tr>
					<?php //include ( "../inc/connect.inc.php");
					$sl = 0;
					$query = "SELECT * FROM category";
					$run = mysqli_query($db_connect, $query);
					while ($row=mysqli_fetch_assoc($run)) {
						$id = $row['cat_id'];
						$cat_name = $row['cat_name'];

						$sl++;
					
					 ?>
					<th><?php echo $sl; ?></th>
					<th><?php echo $cat_name; ?></th>
				</tr>
				<?php } ?>
			</table>
		</div>

<?php include ( "include/footer.php" ); ?>