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
	$result = mysql_query("SELECT * FROM admin WHERE id='$user'");
		$get_user_email = mysql_fetch_assoc($result);
			$uname_db = $get_user_email['firstName'];
}
$search_value = "";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Milady's Exotica</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="/js/homeslideshow.js"></script>
	</head>
	<body style="min-width: 980px; background-image: url(../image/homebackgrndimg4.png);">
		<div class="homepageheader">
			<div class="signinButton loginButton">
				<div class="uiloginbutton signinButton loginButton" style="margin-right: 40px;">
					<?php 
						if ($user!="") {
							echo '<a style="text-decoration: none;color: #fff;" href="logout.php">Log Out</a>';
						}
						else {
							echo '<a style="text-decoration: none;color: #fff;" href="signin.php">Sign In</a>';
						}
					 ?>
					
				</div>
				<div class="uiloginbutton signinButton loginButton" style="">
					<?php 
						if ($user!="") {
							echo '<a style="text-decoration: none;color: #fff;" href="login.php">Hi '.$uname_db.'</a>';
						}
						else {
							echo '<a style="text-decoration: none;color: #fff;" href="login.php">Log In</a>';
						}
					 ?>
				</div>
			</div>
			<div style="float: left; margin: 5px 0px 0px 23px;">
				<a href="index.php">
					<img style=" height: 75px; width: 130px;" src="../image/me.jpg">
				</a>
			</div>
			<div class="">
				<div id="srcheader">
					<form id="newsearch" method="get" action="search.php">
					        <input type="text" class="srctextinput" name="keywords" size="21" maxlength="120"  placeholder="Search Here..."><input type="submit" value="Search" class="srcbutton" >
					</form>
				<div class="srcclear"></div>
				</div>
			</div>
		</div>
		<div class="categolis">
			<table>
				<tr>
					<th>
						<a href="index.php" style="text-decoration: none;color: #fff;padding: 4px 12px;background-color: #857C7F;border-radius: 12px;">Home</a>
					</th>
					<th><a href="addproduct.php" style="text-decoration: none;color: #fff;padding: 4px 12px;background-color: #857C7F;border-radius: 12px;">Add Product</a></th>
					<th><a href="newadmin.php" style="text-decoration: none;color: #fff;padding: 4px 12px;background-color: #857C7F;border-radius: 12px;">New Admin</a></th>
					<th><a href="allproducts.php" style="text-decoration: none;color: #fff;padding: 4px 12px;background-color: #857C7F;border-radius: 12px;">All Products</a></th>
					<th><a href="orders.php" style="text-decoration: none;color: #fff;padding: 4px 12px;background-color: #857C7F;border-radius: 12px;">Orders</a></th>
				</tr>
			</table>
		</div>
		<div class="home-welcome">
			<div class="home-welcome-text">
				<h1>Hello Boss!!!</h1>
				<h2>What would you like to do today?</h2>
			</div>
		</div>
	</body>
</html>