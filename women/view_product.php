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
if (isset($_REQUEST['pid'])) {
	
	$pid = mysql_real_escape_string($_REQUEST['pid']);
}else {
	header('location: index.php');
}


$getposts = mysql_query("SELECT * FROM products WHERE id ='$pid'") or die(mysql_error());
					if (mysql_num_rows($getposts)) {
						$row = mysql_fetch_assoc($getposts);
						$id = $row['id'];
						$pName = $row['pName'];
						$price = $row['price'];
						$description = $row['description'];
						$picture = $row['picture'];
						$item = $row['item'];
						$available =$row['available'];
					}	

?>

<!DOCTYPE html>
<html>
<head>
	<title>Product</title>
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
	<div style="margin: 0 97px; padding: 10px">

		<?php 
			echo '
				<div style="float: left;">
				<div>
					<img src="../image/product/'.$item.'/'.$picture.'" style="height: 500px; width: 500px; padding: 2px; border: 2px solid #FF5D5D;">
				</div>
				</div>
				<div style="float: right;width: 40%;color: #FFFFFF;background-color: #857C7F;padding: 10px;">
					<div style="">
						<h3 style="font-size: 25px; font-weight: bold; ">'.$pName.'</h3><hr>
						<h3 style="padding: 20px 0 0 0; font-size: 20px;">Prize: ₹ '.$price.'</h3><hr>
						<h3 style="padding: 20px 0 0 0; font-size: 22px; ">Description:</h3>
						<p>
							'.$description.'
						</p>

						<div>
							<h3 style="padding: 20px 0 5px 0; font-size: 20px;">Want to buy this product? </h3>
							<div id="srcheader">
								<form id="" method="post" action="../orderform.php?poid='.$pid.'">
								        <input type="submit" value="Order Now" class="srcbutton" >
								</form>
								<div class="srcclear"></div>
							</div>
						</div>

					</div>
				</div>

			';
		?>

	</div>
	<div style="padding: 30px 95px; font-size: 25px; margin: 0 auto; display: table; width: 98%;">
		<h3 style="padding-bottom: 20px">Recommended Products For You:</h3>
		<div>
		<?php 
			$getposts = mysql_query("SELECT * FROM products WHERE available >='1' AND id != '".$pid."' AND item ='".$item."'  ORDER BY RAND() LIMIT 3") or die(mysql_error());
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
										<img src="../image/product/'.$item.'/'.$picture.'" class="home-prodlist-imgi">
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
