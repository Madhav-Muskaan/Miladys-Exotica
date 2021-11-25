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
$pname = "";
$price = "";
$available = "";
$category = "";
$type = "";
$item = "";
$pCode = "";
$descri = "";

if (isset($_POST['signup'])) {
//declare veriable
$pname = $_POST['pname'];
$price = $_POST['price'];
$available = $_POST['available'];
$category = $_POST['category'];
$type = $_POST['type'];
$item = $_POST['item'];
$pCode = $_POST['code'];
$descri = $_POST['descri'];
//triming name
$_POST['pname'] = trim($_POST['pname']);

//finding file extention
$profile_pic_name = @$_FILES['profilepic']['name'];
$file_basename = substr($profile_pic_name, 0, strripos($profile_pic_name, '.'));
$file_ext = substr($profile_pic_name, strripos($profile_pic_name, '.'));

if (((@$_FILES['profilepic']['type']=='image/jpeg') || (@$_FILES['profilepic']['type']=='image/png') || (@$_FILES['profilepic']['type']=='image/gif')) && (@$_FILES['profilepic']['size'] < 1000000)) {

	$item = $item;
	if (file_exists("../image/product/$item")) {
		//nothing
	}else {
		mkdir("../image/product/$item");
	}
	
	
	$filename = strtotime(date('Y-m-d H:i:s')).$file_ext;

	if (file_exists("../image/product/$item/".$filename)) {
		echo @$_FILES["profilepic"]["name"]."Already exists";
	}else {
		if(move_uploaded_file(@$_FILES["profilepic"]["tmp_name"], "../image/product/$item/".$filename)){
			$photos = $filename;
			$result = mysql_query("INSERT INTO products(pName,price,description,available,category,type,item,pCode,picture) VALUES ('$_POST[pname]','$_POST[price]','$_POST[descri]','$_POST[available]','$_POST[category]','$_POST[type]','$_POST[item]','$_POST[code]','$photos')");
				header("Location: allproducts.php");
		}else {
			echo "Something went wrong!!!";
		}
		
		
	}
	}
	else {
		$error_message = 'Add picture!';
	}
}
$search_value = "";

?>


<!doctype html>
<html>
	<head>
		<title>Milady's Exotica</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body class="home-welcome-text" style="background-image: url(../image/homebackgrndimg2.png);">
		<div class="homepageheader">
			<div class="signinButton loginButton">
				<div class="uiloginbutton signinButton loginButton" style="margin-right: 40px;">
					<?php 
						if ($user!="") {
							echo '<a style="text-decoration: none;color: #fff;" href="logout.php">Log Out</a>';
						}
					 ?>
					
				</div>
				<div class="uiloginbutton signinButton loginButton">
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
						<a href="index.php" style="text-decoration: none;color: #fff;padding: 4px 12px;background-color: #857C7F;border-radius: 12px;">Home</a>
					</th>
					<th><a href="addproduct.php" style="text-decoration: none;color: #fff;padding: 4px 12px;background-color: #857C7F;border-radius: 12px;">Add Product</a></th>
					<th><a href="newadmin.php" style="text-decoration: none;color: #fff;padding: 4px 12px;background-color: #857C7F;border-radius: 12px;">New Admin</a></th>
					<th><a href="allproducts.php" style="text-decoration: none;color: #fff;padding: 4px 12px;background-color: #857C7F;border-radius: 12px;">All Products</a></th>
					<th><a href="orders.php" style="text-decoration: none;color: #fff;padding: 4px 12px;background-color: #857C7F;border-radius: 12px;">Orders</a></th>
				</tr>
			</table>
		</div>
		<?php 
			if(isset($success_message)) {echo $success_message;}
			else {
				echo '
					<div class="holecontainer" style="float: right; margin-right: 36%; padding-top: 20px;">
						<div class="container">
							<div>
								<div>
									<div class="signupform_content">
										<h2>Yay!!! A new product :)</h2>
										<div class="signup_error_msg">';
											if (isset($error_message)) {echo $error_message;}
										echo '</div>
										<div class="signupform_text"></div>
										<div>
											<form action="" method="POST" class="registration" enctype="multipart/form-data">
												<div class="signup_form">
													<div>
														<td >
															<input name="pname" id="first_name" placeholder="Product Name" required="required" class="first_name signupbox" type="text" style= "color: #B0B0B0" size="30" value="'.$pname.'" >
														</td>
													</div>
													<div>
														<td >
															<input name="price" id="last_name" placeholder="Price" required="required" class="last_name signupbox" type="text" style= "color: #B0B0B0" size="30" value="'.$price.'" >
														</td>
													</div>
													<div>
														<td>
															<input name="available" placeholder="Available Quantity" required="required" class="email signupbox" type="text" style= "color: #B0B0B0" size="30" value="'.$available.'">
														</td>
													</div>
													<div>
														<td >
															<input name="descri" id="first_name" placeholder="Description" required="required" class="first_name signupbox" type="text" style= "color: #B0B0B0" size="30" value="'.$descri.'" >
														</td>
													</div>
													<div>
														<td>
															<select name="category" required="required" style=" font-size: 20px;
														font-style: italic;margin-bottom: 3px;margin-top: 0px;padding: 14px;line-height: 25px;border-radius: 4px;border: 1px solid #857C7F;color: #B0B0B0;margin-left: 0;width: 300px;background-color: transparent;" class="">
																<option selected value="women">Women</option>
															</select>
														</td>
													</div>
													<div>
														<select name="type" required="required" style=" font-size: 20px;
														font-style: italic;margin-bottom: 3px;margin-top: 0px;padding: 14px;line-height: 25px;border-radius: 4px;border: 1px solid #857C7F;color: #B0B0B0;margin-left: 0;width: 300px;background-color: transparent;" class="">
																<option selected value="clothing">Clothing</option>
																<option value="other">Other</option>
															</select>
													</div>
													<div>
														<td>
															<select name="item" required="required" style=" font-size: 20px;
														font-style: italic;margin-bottom: 3px;margin-top: 0px;padding: 14px;line-height: 25px;border-radius: 4px;border: 1px solid #857C7F;color: #B0B0B0;margin-left: 0;width: 300px;background-color: transparent;" class="">
																<option selected value="EthnicWear">EthnicWear</option>
																<option value="Jewelry">Jewelry</option>
																<option value="Watch">Watch</option>
																<option value="Perfume">Perfume</option>
																<option value="Bracelets">Bracelets</option>
																<option value="CasualWear">CasualWear</option>
																<option value="FootWear">FootWear</option>
																<option value="HairAccessories">HairAccessories</option>
															</select>
														</td>
													</div>
													<div>
														<td>
															<input name="code" id="password-1" required="required"  placeholder="Code" class="password signupbox " type="text" style= "color: #B0B0B0" size="30" value="'.$pCode.'">
														</td>
													</div>
													<div>
														<td>
															<input name="profilepic" class="password signupbox" type="file" value="Add Picture">
														</td>
													</div>
													<div>
														<input name="signup" class="uisignupbutton signupbutton" type="submit" value="Add Product">
													</div>
												</div>
											</form>
											
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				';
			}

		 ?>
	</body>
</html>