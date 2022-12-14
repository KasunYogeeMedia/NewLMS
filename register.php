<?php
session_start();
error_reporting(0);

require_once 'dashboard/conn.php';
require_once 'dashboard/config.php';
require_once 'dashboard/dbconfig4.php';



$success_msg = 0;

if (isset($_POST['register'])) {
	$stnumber = mysqli_real_escape_string($con, $_POST['stnumber']);
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$dob = mysqli_real_escape_string($con, $_POST['dob']);
	$gender = mysqli_real_escape_string($con, $_POST['gender']);
	$school = mysqli_real_escape_string($con, $_POST['school']);
	$district = mysqli_real_escape_string($con, $_POST['district']);
	$town = mysqli_real_escape_string($con, $_POST['town']);



	$fullname = mysqli_real_escape_string($con, $_POST['fullname']);
	$address = mysqli_real_escape_string($con, $_POST['address']);
	$contactnumber = (int)mysqli_real_escape_string($conn, $_POST['contactnumber']);
	$to = "0" . (int)mysqli_real_escape_string($conn, $_POST['contactnumber']);
	$level = mysqli_real_escape_string($conn, $_POST['level']);
	$password = md5(mysqli_real_escape_string($con, $_POST['password']));
	$re_password = md5(mysqli_real_escape_string($con, $_POST['re_password']));

	if ($password == $re_password) {

		$amilack_mobile_qury = mysqli_query($con, "SELECT * FROM lmsregister WHERE contactnumber='$contactnumber'");
		if (mysqli_num_rows($amilack_mobile_qury) > 0) {
			//user allready
			$success_msg = 1;
		} else {
			//pass
			if (mysqli_query($con, "INSERT INTO lmsregister (stnumber,email,dob,gender,school,district,town,fullname,contactnumber, address, level,password, image, add_date, status, ip_address, relogin, reloging_ip, payment, verifycode) VALUES ('$stnumber','$email','$dob','$gender','$school','$district','$town','$fullname','$contactnumber','$address','$level','$password','', CURRENT_TIMESTAMP, '1', '', '0', '0', '0', '')")) {

				if (!empty($_POST['subjects'])) {
					foreach ($_POST['subjects'] as $subject_id) {
						mysqli_query($conn, "INSERT INTO lmsreq_subject(sub_req_reg_no, sub_req_sub_id) VALUES ('$contactnumber','$subject_id')");
					}
				}

				$to = "+94" . (int)mysqli_real_escape_string($conn, $_POST['contactnumber']);
				$contactnumber_user = "0" . (int)mysqli_real_escape_string($conn, $_POST['contactnumber']);
				$message_text = "Congratulations on joining successonline! To log in please use the below details.\nUser name: $contactnumber_user\npassword: $_POST[password]\n";
				$message = urlencode($message_text);
				send_sms($to, $message);

				echo "<img src=''>";

				echo "<script>window.location='login.php?success';</script>";
			} else {
				//error
				$success_msg = 3;
			}
		}
	} else {
		//password error
		$success_msg = 2;
	}
}

?>

<?php
require_once 'header.php';
?>
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5RH22F3" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<div class="sign_in_up_bg">
	<div class="container">
		<div class="row justify-content-lg-center justify-content-md-center">
			<div class="col-lg-12">
				<div class="main_logo25" id="logo">
					<!--<a href="index.php"><img src="./inc/images/Atlas-logo.png" alt="" style="text-align:center;"></a>-->
					<!--<a href="index.php"><img class="img-responsive" src="./inc/images/Atlas-logo.png" alt="Atlas"></a>-->
				</div>
			</div>

			<div class="col-lg-6 col-md-8">
				<div class="sign_form">
					<h2>Welcome to <?php echo $application_name; ?> </h2>
					<p>Register Now & Start
						Learning Today!</p>
					<form method="POST" id="myform">
						<?php if ($success_msg == 1) { ?><div class="alert alert-primary" style="font-weight:bold;background-color:#007bff;color:#ffffff;">Sorry! You are already registered.</div><?php } ?>
						<?php if ($success_msg == 2) { ?><div class="alert alert-danger" style="font-weight:bold;background-color:#dc3545;color:#ffffff;">Error! The Re-Enter Password you entered does not match.</div><?php } ?>
						<?php if ($success_msg == 3) { ?><div class="alert alert-danger" style="font-weight:bold;background-color:#dc3545;color:#ffffff;">Error! Your entered details something is wrong. Please try again.</div><?php } ?>
						<?php if (isset($_GET['success'])) { ?><div class="alert alert-success" style="font-weight:bold;background-color:#075E55;color:#ffffff;"> Thanks for registering! Sign in now and start learning right away! </div><?php } ?>
						<div class="row">
							<div class="col-lg-6">
								<div class="single-form">
									<?php
									$code_feed = "0123456789";
									$code_length = 5;  // Set this to be your desired code length
									$final_code = "";
									$feed_length = strlen($code_feed);

									for ($i = 0; $i < $code_length; $i++) {
										$feed_selector = rand(0, $feed_length - 1);
										$final_code .= substr($code_feed, $feed_selector, 1);
									}

									?>
									<label style="font-weight:bold;text-align:left;">Student Number</label>
									<input name="stnumber" required type="text" class="form-control stnumber" value="<?php echo $reg_prefix; ?>-<?php echo $final_code; ?>" >
								</div>
							</div>
							<div class="col-lg-6">
								<div class="single-form">
									<label style="font-weight:bold;text-align:left;">Email</label>
									<input name="email" required type="text" class="form-control email" placeholder="Enter Your Email" value="<?php if (isset($_POST['email'])) {
																																					echo $_POST['email'];
																																				} ?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6">
								<div class="single-form">
									<label style="font-weight:bold;text-align:left;">Full Name</label>
									<input name="fullname" required type="text" class="form-control fullname" placeholder="Enter Full Name" value="<?php if (isset($_POST['fullname'])) {
																																						echo $_POST['fullname'];
																																					} ?>">
								</div>
							</div>
							<div class="col-lg-6">
								<div class="single-form">
									<label style="font-weight:bold;text-align:left;">Phone Number (Will be used for logging in)</label>
									<input name="contactnumber" type="text" required placeholder="Enter Phone Number" class="form-control phone_val" value="<?php if (isset($_POST['contactnumber'])) {
																																								echo $_POST['contactnumber'];
																																							} ?>" maxlength="10" minlength="10">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6">
								<div class="single-form">
									<label style="font-weight:bold;text-align:left;">Date Of Birth</label>
									<input name="dob" required type="date" class="form-control dob" placeholder="Enter Your Birthday" value="<?php if (isset($_POST['dob'])) {
																																					echo $_POST['dob'];
																																				} ?>">
								</div>
							</div>
							<div class="col-lg-6">
								<div class="single-form">
									<label style="font-weight:bold;text-align:left;">Gender</label>
									<select name="gender" required class="form-control gender">
										<option value="male">Male</option>
										<option value="female">Female</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6">
								<div class="single-form">
									<label style="font-weight:bold;text-align:left;">Address</label>
									<input name="address" type="text" required placeholder="Enter Address" class="form-control phone_val" value="<?php if (isset($_POST['address'])) {
																																						echo $_POST['address'];
																																					} ?>">
								</div>
							</div>
							<div class="col-lg-6">
								<div class="single-form">
									<label style="font-weight:bold;text-align:left;">Grade</label><br>
									<span id="class_load">
										<select name="level" required id="class_val" onChange="JavaScript:select_subject(this.value);" class="form-control simple" style="width:100%;">
											<option value="" hidden="yes">Select Grade</option>
											<?php
											$stmt = $DB_con->prepare('SELECT * FROM lmsclass ORDER BY cid');
											$stmt->execute();
											if ($stmt->rowCount() > 0) {
												while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
													extract($row);
											?>
													<option value="<?php echo $row['cid']; ?>"><?php echo $row['name']; ?></option>
											<?php }
											} 
											?>
										</select>
									</span>
								</div>
							</div>
						</div>
						<script>
							function select_subject(sub_val) {
								var xhttp = new XMLHttpRequest();
								xhttp.onreadystatechange = function() {
									if (this.readyState == 4 && this.status == 200) {
										document.getElementById("sub_load").innerHTML = this.responseText;
									}
								};
								xhttp.open("GET", "sub_load.php?cid=" + sub_val, true);
								xhttp.send();
							}
						</script>
						<div class="row">
							<div class="col-lg-12">
								<div class="single-form">
									<label style="font-weight:bold;text-align:left;">Subject</label>
									<br>
									<div id="sub_load">
										<hr>
										Subject Not Found
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6">
								<div class="single-form">
									<label style="font-weight:bold;text-align:left;">School</label>
									<input name="school" type="text" class="form-control school" placeholder="Enter Your School" value="<?php if (isset($_POST['school'])) {
																																			echo $_POST['school'];
																																		} ?>">
								</div>
							</div>
							<div class="col-lg-6">
								<div class="single-form">
									<label style="font-weight:bold;text-align:left;">District</label>
									<select name="district" required class="form-control district">
										<option value="Ampara">Ampara</option>
										<option value="Anuradhapura">Anuradhapura</option>
										<option value="Badulla">Badulla</option>
										<option value="Batticaloa">Batticaloa</option>
										<option value="Colombo">Colombo</option>
										<option value="Galle">Galle</option>
										<option value="Gampaha">Gampaha</option>
										<option value="Hambantota">Hambantota</option>
										<option value="Jaffna">Jaffna</option>
										<option value="Kalutara">Kalutara</option>
										<option value="Kandy">Kandy</option>
										<option value="Kegalle">Kegalle</option>
										<option value="Kilinochchi">Kilinochchi</option>
										<option value="Kurunegala">Kurunegala</option>
										<option value="Mannar">Mannar</option>
										<option value="Matale">Matale</option>
										<option value="Matara">Matara</option>
										<option value="Monaragala">Monaragala</option>
										<option value="Mullaitivu">Mullaitivu</option>
										<option value="Nuwara-Eliya">Nuwara Eliya</option>
										<option value="Polonnaruwa">Polonnaruwa</option>
										<option value="Puttalam">Puttalam</option>
										<option value="Ratnapura">Ratnapura</option>
										<option value="Trincomalee">Trincomalee</option>
										<option value="Vavuniya">Vavuniya</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<div class="single-form">
									<label style="font-weight:bold;text-align:left;">Town/City</label>
									<input name="town" type="text" class="form-control school" placeholder="Enter Your Town/City" value="">
								</div>
							</div>

						</div>

						<!-- newly aded section end -->


						<div class="row">
							<div class="col-lg-6">
								<div class="single-form">
									<label style="font-weight:bold;text-align:left;">Password</label>
									<input name="password" type="password" class="form-control password" placeholder="Enter more than 8 characters" minlength="8">
								</div>
							</div>
							<div class="col-lg-6">
								<div class="single-form">
									<label style="font-weight:bold;text-align:left;">Confirm Password</label>
									<input name="re_password" type="password" class="form-control passwordcon" placeholder="Enter your password again" minlength="8">
								</div>
							</div>
						</div>
						<!-- newly aded section start -->


						<!-- newly aded section end -->
						<br>
						<div class="row">
							<div class="col-lg-12">
								<div class="single-form">
									<input type="submit" id="submit" name="register" value="Register" class="btn btn-primary btn-block" style="background:#075E55;color:#ffffff; border-color: #075E55;">
								</div>
							</div>
						</div>
					</form>
					<p class="mb-0 mt-30">Already have an account? <a href="login.php">Log In</a></p>
				</div>
				<div class="sign_footer">?? <?php echo date("Y"); ?> <?php echo $application_name; ?> | All Rights Reserved | Developed By Yogeemedia</div>
			</div>
		</div>
	</div>
</div>
<!-- Signup End -->
<?php
require_once 'footer.php';
?>