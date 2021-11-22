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

if (isset($_REQUEST['keywords'])) {

	$epid = mysql_real_escape_string($_REQUEST['keywords']);
	if($epid != "" && ctype_alnum($epid)){
		
	}else {
		header('location: index.php');
	}
}else {
	header('location: index.php');
}

$search_value = "";
$search_value = trim($_GET['keywords']);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Search</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<div class="homepageheader">
		<div class="signinButton loginButton">
			<div class="uiloginbutton signinButton loginButton" style="margin-right: 40px;">
				<?php 
					if ($user!="") {
						echo '<a style="text-decoration: none; color: #fff;" href="logout.php">Log Out</a>';
					}
					else {
						echo '<a style="text-decoration: none; color: #fff;" href="signin.php">Sign In</a>';
					}
				 ?>
				
			</div>
			<div class="uiloginbutton signinButton loginButton" style="">
				<?php 
					if ($user!="") {
						echo '<a style="text-decoration: none; color: #fff;" href="profile.php?uid='.$user.'">Hi '.$uname_db.'</a>';
					}
					else {
						echo '<a style="text-decoration: none; color: #fff;" href="login.php">Log In</a>';
					}
				 ?>
			</div>
		</div>
		<div style="float: left; margin: 5px 0px 0px 23px;">
			<a href="index.php">
				<img style=" height: 75px; width: 130px;" src="image/me.jpg">
			</a>
		</div>
		<div id="srcheader">
				<form id="newsearch" method="get" action="search.php">
				        <?php 
				        	echo '<input type="text" class="srctextinput" name="keywords" size="21" maxlength="120"  placeholder="Search Here..." value="'.$search_value.'"><input type="submit" value="Search" class="srcbutton" >';
				         ?>
				</form>
			<div class="srcclear"></div>
		</div>
	</div>
	<div class="categolis">
		<table>
			<tr>
				<th>
					<a href="women/ethnicwear.php" style="text-decoration: none;color: #FFF;padding: 4px 12px;background-color: #857C7F;border-radius: 12px;">EthnicWear</a>
				</th>
				<th><a href="women/jewelry.php" style="text-decoration: none;color: #FFF;padding: 4px 12px;background-color: #857C7F;border-radius: 12px;">Jewelry</a></th>
				<th><a href="women/watch.php" style="text-decoration: none;color: #FFF;padding: 4px 12px;background-color: #857C7F;border-radius: 12px;">Watch</a></th>
				<th><a href="women/perfume.php" style="text-decoration: none;color: #FFF;padding: 4px 12px;background-color: #857C7F;border-radius: 12px;">Perfume</a></th>
				<th><a href="women/bracelets.php" style="text-decoration: none;color: #FFF;padding: 4px 12px;background-color: #857C7F;border-radius: 12px;">Bracelets</a></th>
				<th><a href="women/casualwear.php" style="text-decoration: none;color: #FFF;padding: 4px 12px;background-color: #857C7F;border-radius: 12px;">CsasualWear</a></th>
				<th><a href="women/footwear.php" style="text-decoration: none;color: #FFF;padding: 4px 12px;background-color: #857C7F;border-radius: 12px;">FootWear</a></th>
				<th><a href="women/hairaccessories.php" style="text-decoration: none;color: #FFF;padding: 4px 12px;background-color: #857C7F;border-radius: 12px;">HairAccessories</a></th>
			</tr>
		</table>
	</div>
	<div style="padding: 30px 120px; font-size: 25px; margin: 0 auto; display: table; width: 98%;">
		<div>
		<?php 
			if (isset($_GET['keywords']) && $_GET['keywords'] != ""){
				$search_value = trim($_GET['keywords']);
				$getposts = mysql_query("SELECT * FROM products WHERE pName like '%$search_value%'  ORDER BY id DESC") or die(mysql_error());
					if ( $total = mysql_num_rows($getposts)) {
					echo '<ul id="recs">';
					echo '<div style="text-align: center;"> '.$total.' Products Found... </div><br>';
					while ($row = mysql_fetch_assoc($getposts)) {
						$id = $row['id'];
						$pName = $row['pName'];
						$price = $row['price'];
						$description = $row['description'];
						$picture = $row['picture'];
						$item = $row['item'];
						
						echo '
							<ul style="float: left;">
								<li style="float: left; padding: 0px 25px 25px 25px;">
									<div class="home-prodlist-img"><a href="women/view_product.php?pid='.$id.'">
										<img src="image/product/'.$item.'/'.$picture.'" class="home-prodlist-imgi">
										</a>
										<div style="text-align: center; padding: 0 0 6px 0;"> <span style="font-size: 15px;">'.$pName.'</span><br> Price: ₹ '.$price.'</div>
									</div>
									
								</li>
							</ul>
						';

						}
				}else {
				echo "Nothing Found!";
			}
			}else {
				echo "Input Something...";
			}
			
		?>
			
		</div>
	</div>
</body>
</html>