<?php include ( "inc/connect.inc.php" ); ?>
<?php
ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
}
else {
	header("location: index.php");
}

$u_fname = "";
$u_lname = "";
$u_email = "";
$u_mobile = "";
$u_address = "";
$u_pass = "";

if (isset($_POST['signup'])) {
//declare veriable
$u_fname = $_POST['first_name'];
$u_lname = $_POST['last_name'];
$u_email = $_POST['email'];
$u_mobile = $_POST['mobile'];
$u_address = $_POST['signupaddress'];
$u_pass = $_POST['password'];
//triming name
$_POST['first_name'] = trim($_POST['first_name']);
$_POST['last_name'] = trim($_POST['last_name']);
	try {
		if(empty($_POST['first_name'])) {
			throw new Exception('Fullname can not be empty');
			
		}
		if (is_numeric($_POST['first_name'][0])) {
			throw new Exception('Please write your correct name!');

		}
		if(empty($_POST['last_name'])) {
			throw new Exception('Lastname can not be empty');
			
		}
		if (is_numeric($_POST['last_name'][0])) {
			throw new Exception('lastname first character must be a letter!');

		}
		if(empty($_POST['email'])) {
			throw new Exception('Email can not be empty');
			
		}
		if(empty($_POST['mobile'])) {
			throw new Exception('Phone number can not be empty');
			
		}
		if(empty($_POST['password'])) {
			throw new Exception('Password can not be empty');
			
		}
		if(empty($_POST['signupaddress'])) {
			throw new Exception('Address can not be empty');
			
		}

		
		// Check if email adress already exists
		
		$check = 0;
		$e_check = mysql_query("SELECT email FROM `user` WHERE email='$u_email'");
		$email_check = mysql_num_rows($e_check);
		if (strlen($_POST['first_name']) >2 && strlen($_POST['first_name']) <16 ) {
			if ($check == 0 ) {
				if ($email_check == 0) {
					if (strlen($_POST['password']) >1 ) {
						$d = date("Y-m-d"); //Year - Month - Day
						$_POST['first_name'] = ucwords($_POST['first_name']);
						$_POST['last_name'] = ucwords($_POST['last_name']);
						$_POST['last_name'] = ucwords($_POST['last_name']);
						$_POST['email'] = mb_convert_case($u_email, MB_CASE_LOWER, "UTF-8");
						$_POST['password'] = md5($_POST['password']);
						$confirmCode   = substr( rand() * 900000 + 100000, 0, 6 );
						// send email
						$msg = "
						Welcome to Milady's Exotica...
						
						Your activation code: ".$confirmCode."
						Signup email: ".$_POST['email']."
						
						";
							
						$result = mysql_query("INSERT INTO user (firstName,lastName,email,mobile,address,password,confirmCode) VALUES ('$_POST[first_name]','$_POST[last_name]','$_POST[email]','$_POST[mobile]','$_POST[signupaddress]','$_POST[password]','$confirmCode')");
						
						//success message
						$success_message = '
						<div class="signupform_content"><h2><font face="bookman">Registration successfull!!!</font></h2>
						<div class="signupform_text" style="font-size: 18px; text-align: center;">
						<font face="bookman">
							Email: '.$u_email.'<br>
							Your activation code: '.$confirmCode.' <br>
							Please copy your Activation Code!<br>
							It will be used for logging in the first time :) 
							

						</font></div></div>';
						
						
						
					}else {
						throw new Exception('Password not strong enough!');
					}
				}else {
					throw new Exception('Email already taken!');
				}
			}else {
				throw new Exception('Username already taken!');
			}
		}else {
			throw new Exception('Firstname must be 2-15 characters!');
		}

	}
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
}


?>


<!doctype html>
<html>
	<head>
		<title>Milady's Exotica</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body class="home-welcome-text" style="background-image: url(image/homebackgrndimg2.png);">
		<div class="homepageheader" style="position: inherit;">
			<div class="signinButton loginButton">
				<div class="uiloginbutton signinButton loginButton" style="margin-right: 40px;">
					<a style="text-decoration: none;color: #FFFFFF" href="login.php">User Login</a>
				</div> 
				<div class="uiloginbutton signinButton loginButton" style="">
					<a style="text-decoration: none;color: #FFFFFF" href="admin/login.php">Admin Login</a>
				</div>
			</div>
			<div style="float: left; margin: 5px 0px 0px 23px;">
				<a href="index.php">
					<img style=" height: 75px; width: 130px;" src="image/me.jpg">
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
		<?php 
			if(isset($success_message)) {echo $success_message;}
			else {
				echo '
					<div class="holecontainer" style="float: right; margin-right: 36%; padding-top: 26px;">
						<div class="container">
							<div>
								<div>
									<div class="signupform_content">
										<h2>Sign Me Up!!!</h2>
										<div class="signupform_text"></div>
										<div>
											<form action="" method="POST" class="registration">
												<div class="signup_form">
													<div>
														<td >
															<input name="first_name" id="first_name" placeholder="First Name" required="required" class="first_name signupbox" type="text" style="color: #B0B0B0" size="30" value="'.$u_fname.'" >
														</td>
													</div>
													<div>
														<td >
															<input name="last_name" id="last_name" placeholder="Last Name" required="required" class="last_name signupbox" type="text" style="color: #B0B0B0" size="30" value="'.$u_lname.'" >
														</td>
													</div>
													<div>
														<td>
															<input name="email" placeholder="Enter Your Email" required="required" class="email signupbox" type="email" style="color: #B0B0B0" size="30" value="'.$u_email.'">
														</td
			>										</div>
													<div>
														<td>
															<input name="mobile" placeholder="Enter Your Mobile" required="required" class="email signupbox" type="text" style="color: #B0B0B0" size="30" value="'.$u_mobile.'">
														</td>
													</div>
													<div>
														<td>
															<input name="signupaddress" placeholder="Write Your Full Address" required="required" class="email signupbox" style="color: #B0B0B0" type="text" size="30" value="'.$u_address.'">
														</td>
													</div>
													<div>
														<td>
															<input name="password" id="password-1" required="required"  placeholder="Enter New Password" class="password signupbox " type="password" style="color: #B0B0B0" size="30" value="'.$u_pass.'">
														</td>
													</div>
													<div>
														<input name="signup" class="uisignupbutton signupbutton" type="submit" value="Sign Me">
													</div>
													<div class="signup_error_msg">';
														
															if (isset($error_message)) {echo $error_message;}
															
														
													echo'</div>
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
