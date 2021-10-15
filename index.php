<?php include ( "inc/connect.inc.php" ); ?>
<?php 
ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
	$user = "";
}
else {
	$user = $_SESSION['user_login'];
	$result = mysql_query("SELECT * FROM user WHERE id='$user'");
		$get_user_email = mysql_fetch_assoc($result);
			$uname_db = $get_user_email['firstName'];
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Milady's Exotica</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">

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
				<a href="index.php">
					<img style=" height: 65px; width: 100px;" src="image/me.jpg">
				</a>
			</div>
			<div class="">
				<div id="srcheader">
					<form id="newsearch" method="get" action="search.php">
					        <input type="text" class="srctextinput" name="keywords" size="21" maxlength="120"  placeholder="Search Here..."><input type="submit" value="search" class="srcbutton" >
					</form>
				<div class="srcclear"></div>
				</div>
			</div>
		</div>
		<div class="home-welcome">
			<div class="home-welcome-text" style="background-image: url(image/homebackgrndimg.png); height: 380px; ">
				<h1 style="margin: 0px;">Milady's Exotica</h1>
				<h2>Women's Stop</h2>
			</div>
		</div>
		<div class="home-prodlist" style="background-image: url(image/back.jpg);">
			<div>
				<h3 style="text-align: center;"><b><br>Products Category</b></h3>
			</div>
			<div style="padding: 20px 30px; width: 85%; margin: 0 auto; ">
				<ul style="float: left;">
					<li style="float: left; padding: 25px;">
						<div class="home-prodlist-img" ><a href="women/ethnicwear.php">
							<img src="./image/product/ethnicwear/ethnic wear.jpg" class="home-prodlist-imgi">
							</a>
						</div>
					</li>
				</ul>
				<ul style="float: left;">
					<li style="float: left; padding: 25px;">
						<div class="home-prodlist-img"><a href="women/perfume.php">
							<img src="./image/product/perfume/perfume.jpg" class="home-prodlist-imgi">
							</a>
						</div>
					</li>
				</ul>
				<ul style="float: left;">
					<li style="float: left; padding: 25px;">
						<div class="home-prodlist-img"><a href="women/bracelets.php">
							<img src="./image/product/bracelets/bracelet.jpg" class="home-prodlist-imgi"></a>
						</div>
					</li>
				</ul>
				<ul style="float: left;">
					<li style="float: left; padding: 25px;">
						<div class="home-prodlist-img"><a href="women/hairaccessories.php">
							<img src="./image/product/hairaccessories/hair accessories.jpg" class="home-prodlist-imgi"></a>
						</div>
					</li>
				</ul>
				<ul style="float: left;">
					<li style="float: left; padding: 25px;">
						<div class="home-prodlist-img"><a href="women/footwear.php">
							<img src="./image/product/footwear/footwear.jpg" class="home-prodlist-imgi"></a>
						</div>
					</li>
				</ul>
				<ul style="float: left;">
					<li style="float: left; padding: 25px;">
						<div class="home-prodlist-img"><a href="women/casualwear.php">
							<img src="./image/product/casualwear/casual wear.jpg" class="home-prodlist-imgi"></a>
						</div>
					</li>
				</ul>
				<ul style="float: left;">
					<li style="float: left; padding: 25px;">
						<div class="home-prodlist-img"><a href="women/watch.php">
							<img src="./image/product/watch/watch.jpg" class="home-prodlist-imgi"></a>
						</div>
					</li>
				</ul>
				<ul style="float: left;">
					<li style="float: left; padding: 25px;">
						<div class="home-prodlist-img"><a href="women/jewelry.php">
							<img src="./image/product/jewelry/Jewelry.jpg" class="home-prodlist-imgi"></a>
						</div>
					</li>
				</ul>
			</div>			
		</div>
	</body>
</html>