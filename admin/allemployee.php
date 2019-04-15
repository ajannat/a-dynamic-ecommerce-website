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
					<th>First Name</th>
					<th>Last Name</th>
					<th>Email</th>
					<th>Mobile</th>
					<th>Address</th>
					<th>Role</th>
					<th>Edit</th>
				</tr>
				<tr>
					<?php //include ( "../inc/connect.inc.php");
					$sl = 0;
					$query = "SELECT * FROM admin ORDER BY id DESC";
					$run = mysqli_query($db_connect, $query);
					while ($row=mysqli_fetch_assoc($run)) {
						$id = $row['id'];
						$fname = substr($row['firstName'], 0,50);
						$lname = $row['lastName'];
						$email = $row['email'];
						$mobile = $row['mobile'];
						$address = $row['address'];
						// $type = $row['type'];
						$urole = $row['type'];

						$sl++;
					
					 ?>
					<th><?php echo $sl; ?></th>
					<th><?php echo $fname; ?></th>
					<th><?php echo $lname; ?></th>
					<th><?php echo $email; ?></th>
					<th><?php echo $mobile; ?></th>
					<th><?php echo $address; ?></th>
					<!-- <th><?php //echo $type; ?></th> -->
					<th><?php echo $urole; ?></th>

					<th><a class = "btn btn-primary" href="editemployee.php?epid=<?php echo $id; ?>">Edit User</a></th>

					
					
				</tr>
				<?php } ?>
			</table>
		</div>

<?php include ( "include/footer.php" ); ?>