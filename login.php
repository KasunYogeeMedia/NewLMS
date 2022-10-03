<?php
session_start();
error_reporting(0);

require_once 'dashboard/conn.php';
require_once 'dashboard/config.php';
require_once 'dashboard/dbconfig4.php';

if (isset($_SESSION["reid"])) {
}

$ip_address = time();


if (isset($_POST['login'])) {

	$username = (int)$_POST['username'];

	$password = md5($_POST['password']);

	$sql = mysqli_query($conn, "SELECT * FROM lmsregister WHERE contactnumber = '$username' and status='1'");

	if (mysqli_num_rows($sql) > 0) {

		$result = mysqli_fetch_array($sql);
		if ($password == $result['password']) {
			$token = getToken(10);
			$_SESSION['token'] = $token;
			$_SESSION['username'] = $username;

			$result_token = mysqli_query($con, "select count(*) as allcount from lmsregister where contactnumber='" . $username . "' ");
			$row_token = mysqli_fetch_assoc($result_token);

			if ($row_token['allcount'] > 0) {
				mysqli_query($conn, "update lmsregister set ip_address ='" . $token . "' where contactnumber='" . $username . "'");
			} else {
				mysqli_query($conn, "insert into lmsregister(ip_address) values('" . $token . "')");
			}

			if ($result['relogin'] == 0) {

				$_SESSION['reid'] = $result['reid'];

				//setcookie('reid', $result['reid'], time() + (86400 * 30), "/");
				$sql = mysqli_query($conn, "SELECT * FROM lmsregister WHERE contactnumber = '$username' and status='1'");
				$result = mysqli_fetch_array($sql);
				if ($result['ip_address'] == $_SESSION['token']) {

					// echo "<script>window.location='profile/student_profile.php';</script>";
					echo "<script>window.location='profile/home.php';</script>";
				} else {
					echo "<script>window.location='../logout.php';</script>";
				}
			} else {
				echo "<script>window.location='login.php?ip_error';</script>";
			}
		} else {
			//password not match
			echo "<script>window.location='login.php?password_error';</script>";
		}
	} else {
		//user not found
		echo "<script>window.location='login.php?user_error';</script>";
	}
}

// Generate token
function getToken($length)
{
	$token = "";
	$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
	$codeAlphabet .= "0123456789";
	$max = strlen($codeAlphabet); // edited

	for ($i = 0; $i < $length; $i++) {
		$token .= $codeAlphabet[random_int(0, $max - 1)];
	}

	return $token;
}
?>

<?php
require_once 'header.php';
?>
<script>
	(function(w, d, s, l, i) {
		w[l] = w[l] || [];
		w[l].push({
			'gtm.start': new Date().getTime(),
			event: 'gtm.js'
		});
		var f = d.getElementsByTagName(s)[0],
			j = d.createElement(s),
			dl = l != 'dataLayer' ? '&l=' + l : '';
		j.async = true;
		j.src =
			'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
		f.parentNode.insertBefore(j, f);
	})(window, document, 'script', 'dataLayer', 'GTM-5RH22F3');
</script>

<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5RH22F3" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<div class="contentiner">
	<div class="sign_in_up_bg" style="height: inherit;">
		<div class="container">
			<div class="row justify-content-lg-center justify-content-md-center">
				<div class="col-lg-6 col-md-8">
					<div class="sign_form">
						<div class="main_logo25" id="logo">
							<a href="index.php" title="Home "> <img src="./dashboard/settings/logo/<?php echo $main_logo; ?>" class="img-responsive" alt="Sample"></a>
						</div>
						<h2>Welcome to <?php echo $application_name; ?></h2>
						<p>Log In to <?php echo $application_name; ?> Account!</p>
						<form method="POST">
							<?php if (isset($_GET['request'])) { ?><div class="alert alert-info text-center"><strong>Information!</strong><br>Your Re login request send successfully. Waiting for approval your request.</div><?php } ?>
							<?php if (isset($_GET['password_error'])) { ?><div class="alert alert-danger text-center"><strong>We're sorry! </strong><br>The username or password you entered doesn't match our records.
									Please try again or use the forgot my password button to reset your password</div><?php } ?>
							<?php if (isset($_GET['user_error'])) { ?><div class="alert alert-danger text-center"><strong>Sorry!</strong><br>The phone number you entered isn't connected to an account, please register</div><?php } ?>
							<?php if (isset($_GET['ip_error'])) { ?><div class="alert alert-danger text-center"><strong>Sorry!</strong><br>Your account has been blocked due to unautorised access.<br><br><a style="color: dodgerblue; cursor: pointer;" onClick="JavaScript:window.location='login.php?req_id=<?php echo $_GET['u']; ?>';">Request Re login?</a></div><?php } ?>
							<?php if (isset($_GET['success'])) { ?><div class="alert alert-success" style="font-weight:bold;background-color:#075E55;color:#ffffff;"> Thanks for registering! Sign in now and start learning right away! </div><?php } ?>
							<div class="row">
								<div class="col-lg-12">
									<div class="single-form">
										<label style="font-weight:bold;float:left;">PHONE NUMBER</label>
										<input name="username" id="username" value="<?php if (isset($_POST['username'])) {
																						echo $_POST['username'];
																					} ?>" type="text" class="form-control phone_val" required placeholder="Your Phone Number" maxlength="10" minlength="10" style="border: 2px solid #ccc;">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
									<div class="single-form">
										<label style="font-weight:bold;float:left;">PASSWORD </label>
										<input name="password" type="password" class="form-control" required id="myInput" placeholder="Your Password" style="border: 2px solid #ccc;">
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-lg-12">
									<div class="single-form">
										<input name="login" type="submit" value="Login" class="btn btn-primary btn-block">
									</div>
								</div>
							</div>
						</form>
						<p class="sgntrm145">Or <a href="forgot_password.php">Forgot My Password</a>.</p>

						<p class="mb-0 mt-30 hvsng145">Don't have an account? <a href="register.php">Register</a></p>

					</div>
					<div class="sign_footer">
						Copyrights 2021
						© <?php echo $application_name; ?> | Website by <a target="_blank" title="Click to visit" href="https://yogeemedia.com/">yogeemedia.com</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
require_once 'footer.php';
?>