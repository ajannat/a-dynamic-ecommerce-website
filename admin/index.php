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
		
		<div class="home-welcome">
			<div class="home-welcome-text">
				<h1>Welcome To Managing Panel</h1>
				<h2>You have all permission to do anything!</h2>
			</div>
		</div>
		
<?php include ( "include/footer.php" ); ?>