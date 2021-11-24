<?php include ( "../inc/connect.inc.php" ); ?>
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
	<title>Jewelry</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<?php include ( "../inc/mainheader.inc.php" ); ?>
	<div class="categolis">
		<table>
			<tr>
				<th>
					<a href="ethnicwear.php" style="text-decoration: none;color: #FFF;padding: 4px 12px;background-color: #857C7F;border-radius: 12px;">EthnicWear</a>
				</th>
				<th><a href="jewelry.php" style="text-decoration: none;color: #FFF;padding: 4px 12px;background-color: #857C7F;border-radius: 12px;">Jewelry</a></th>
				<th><a href="watch.php" style="text-decoration: none;color: #FFF;padding: 4px 12px;background-color: #857C7F;border-radius: 12px;">Watch</a></th>
				<th><a href="perfume.php" style="text-decoration: none;color: #FFF;padding: 4px 12px;background-color: #857C7F;border-radius: 12px;">Perfume</a></th>
				<th><a href="bracelets.php" style="text-decoration: none;color: #FFF;padding: 4px 12px;background-color: #857C7F;border-radius: 12px;">Bracelets</a></th>
				<th><a href="casualwear.php" style="text-decoration: none;color: #FFF;padding: 4px 12px;background-color: #857C7F;border-radius: 12px;">CasualWear</a></th>
				<th><a href="footwear.php" style="text-decoration: none;color: #FFF;padding: 4px 12px;background-color: #857C7F;border-radius: 12px;">FootWear</a></th>
				<th><a href="hairaccessories.php" style="text-decoration: none;color: #FFF;padding: 4px 12px;background-color: #857C7F;border-radius: 12px;">HairAccessories</a></th>
			</tr>
		</table>
	</div>
	<div style="padding: 30px 120px; font-size: 25px; margin: 0 auto; display: table; width: 98%;">
		<div>
		<?php 
			$getposts = mysql_query("SELECT * FROM products WHERE available >='1' AND item ='Jewelry'  ORDER BY id DESC LIMIT 10") or die(mysql_error());
					if (mysql_num_rows($getposts)) {
					echo '<ul id="recs">';
					while ($row = mysql_fetch_assoc($getposts)) {
						$id = $row['id'];
						$pName = $row['pName'];
						$price = $row['price'];
						$description = $row['description'];
						$picture = $row['picture'];
						
						echo '
							<ul style="float: left;">
								<li style="float: left; padding: 0px 25px 25px 25px;">
									<div class="home-prodlist-img"><a href="view_product.php?pid='.$id.'">
										<img src="../image/product/jewelry/'.$picture.'" class="home-prodlist-imgi">
										</a>
										<div style="text-align: center; padding: 0 0 6px 0;"> <span style="font-size: 15px;">'.$pName.'</span><br> Price: ₹ '.$price.'</div>
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