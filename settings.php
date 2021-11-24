<?php include ( "inc/connect.inc.php" ); ?>
<?php 

ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
	header("location: login.php");
}
else {
	$user = $_SESSION['user_login'];
	$result = mysql_query("SELECT * FROM user WHERE id='$user'");
		$get_user_email = mysql_fetch_assoc($result);
			$uname_db = $get_user_email['firstName'];
			$uemail_db = $get_user_email['email'];
			$upass = $get_user_email['password'];

			$umob_db = $get_user_email['mobile'];
			$uadd_db = $get_user_email['address'];
}

if (isset($_REQUEST['uid'])) {
	
	$user2 = mysql_real_escape_string($_REQUEST['uid']);
	if($user != $user2){
		header('location: index.php');
	}
}else {
	header('location: index.php');
}

if (isset($_POST['changesettings'])) {
//declare veriable
$email = $_POST['email'];
$opass = $_POST['opass'];
$npass = $_POST['npass'];
$npass1 = $_POST['npass1'];
//triming name
	try {
		if(empty($_POST['email'])) {
			throw new Exception('Email can not be empty');
			
		}
			if(isset($opass) && isset($npass) && isset($npass1) && ($opass != "" && $npass != "" && $npass1 != "")){
				if( md5($opass) == $upass){
					if($npass == $npass1){
						$npass = md5($npass);
						mysql_query("UPDATE user SET password='$npass' WHERE id='$user'");
						$success_message = '
						<div class="signupform_text" style="font-size: 18px; text-align: center;">
						<font face="bookman">
							Password changed.
						</font></div>';
					}else {
					$success_message = '
						<div class="signupform_text" style=" color: red; font-size: 18px; text-align: center;">
						<font face="bookman">
							Password does not match!!
						</font></div>';
					}
				}else {
				$success_message = '
					<div class="signupform_text" style=" color: red; font-size: 18px; text-align: center;">
					<font face="bookman">
						Fillup password field correctly.
					</font></div>';
				}
			}else {
				$success_message = '
					<div class="signupform_text" style=" color: red; font-size: 18px; text-align: center;">
					<font face="bookman">
						Fillup password field correctly.
					</font></div>';
				}

			if($uemail_db != $email) {
				if(mysql_query("UPDATE user SET  email='$email' WHERE id='$user'")){
					//success message
					$success_message = '
					<div class="signupform_text" style="font-size: 18px; text-align: center;">
					<font face="bookman">
						Successfully Changed!!!
					</font></div>';
				}
			}

	}
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Settings</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body style="background-image: url(image/homebackgrndimg1.png);">
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
			<div class="">
				<div id="srcheader">
					<form id="newsearch" method="get" action="http://www.google.com">
					        <input type="text" class="srctextinput" name="q" size="21" maxlength="120"  placeholder="Search Here..."><input type="submit" value="Search" class="srcbutton" >
					</form>
				<div class="srcclear"></div>
				</div>
			</div>
		</div>
	<div class="categolis">
		<table>
			<tr>
				<th>
					<a href="women/ethnicwear.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #857C7F;border-radius: 12px;">EthnicWear</a>
				</th>
				<th><a href="women/jewelry.php" style="text-decoration: none;color: #FFF;padding: 4px 12px;background-color: #857C7F;border-radius: 12px;">Jewelry</a></th>
				<th><a href="women/watch.php" style="text-decoration: none;color: #FFF;padding: 4px 12px;background-color: #857C7F;border-radius: 12px;">Watch</a></th>
				<th><a href="women/perfume.php" style="text-decoration: none;color: #FFF;padding: 4px 12px;background-color: #857C7F;border-radius: 12px;">Perfume</a></th>
				<th><a href="women/bracelets.php" style="text-decoration: none;color: #FFF;padding: 4px 12px;background-color: #857C7F;border-radius: 12px;">Bracelets</a></th>
				<th><a href="women/casualwear.php" style="text-decoration: none;color: #FFF;padding: 4px 12px;background-color: #857C7F;border-radius: 12px;">CasualWear</a></th>
				<th><a href="women/footwear.php" style="text-decoration: none;color: #FFF;padding: 4px 12px;background-color: #857C7F;border-radius: 12px;">FootWear</a></th>
				<th><a href="women/hairaccessories.php" style="text-decoration: none;color: #FFF;padding: 4px 12px;background-color: #857C7F;border-radius: 12px;">HairAccessories</a></th>
			</tr>
		</table>
	</div>
	<div style="margin-top: 20px;">
		<div style="width: 901px; margin: 0 auto;">
		
			<ul>
				<li style="float: left;">
					<div class="settingsleftcontent">
						<ul>
							<li><?php echo '<a href="profile.php?uid='.$user.'" >My Orders</a>'; ?></li>
							<li><?php echo '<a href="settings.php?uid='.$user.'" style=" background-color: #FF5D5D; border-radius: 4px; color: #fff;">Settings</a>'; ?></li>
						</ul>
					</div>
				</li>
				<li style="float: right;">
					<div class="holecontainer" style=" padding-top: 20px; padding: 0 20%">
						<form action="" method="POST" class="registration">
							<div class="container signupform_content ">
								<div style="text-align: center;font-size: 20px;color: #fff;margin: 0 0 5px 0;">
									<td >Change Password:</td>
								</div>
								<div>
									<td><input class="email signupbox" type="password" name="opass" style= "color: #B0B0B0" placeholder="Old Password"></td>
								</div>
								<div>
									<td><input class="email signupbox" type="password" name="npass" style= "color: #B0B0B0" placeholder="New Password"></td>
								</div>
								<div>
									<td><input class="email signupbox" type="password" name="npass1" style= "color: #B0B0B0" placeholder="Repeat Password"></td>
								</div>
								<div style="text-align: center;font-size: 20px;color: #fff;margin: 0 0 5px 0;">
									<td >Change Email:</td>
								</div>
								<div>
									<td><?php echo '<input class="email signupbox" required type="email" name="email" style="color: #B0B0B0" placeholder="New Email" value="'.$uemail_db.'">'; ?></td>
								</div>
								<div>
									<td><input class="uisignupbutton signupbutton" type="submit" name="changesettings" value="Update Settings"></td>
								</div>
								<div>
									<?php if (isset($success_message)) {echo $success_message;} ?>
								</div>
							</div>
						</form>
					</div>
				</li>
			</ul>
		</div>
	</div>

	
</body>
</html>