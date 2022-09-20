<?php

session_start();

require_once 'includes.php';

require_once 'conn.php';

require_once 'dbconfig4.php';

$msg = '';

$msg5 = '';

$systemid_val = time();

if (isset($_POST['add_bt'])) {

	$fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
	$district = mysqli_real_escape_string($conn, $_POST['district']);
	$contactnumber = (int)mysqli_real_escape_string($conn, $_POST['contactnumber']);
	$pcontactno = (int)mysqli_real_escape_string($conn, $_POST['pcontactno']);
	$school = mysqli_real_escape_string($conn, $_POST['school']);
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$password = md5(mysqli_real_escape_string($conn, $_POST['password']));
	$systemid = mysqli_real_escape_string($conn, $_POST['systemid']);
	$town = mysqli_real_escape_string($conn, $_POST['town']);
	$birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
	$gender = mysqli_real_escape_string($conn, $_POST['gender']);
	$joindate = mysqli_real_escape_string($conn, $_POST['joindate']);

	date_default_timezone_set("Asia/Colombo");
	$add_date = date("Y-m-d H:i:s");

	if (!$_FILES['image']['name'] == "") {

		if ($_FILES['image']['type'] == "image/jpeg") {
			$imagename = time() . $_FILES['image']['name'];
			$source = $_FILES['image']['tmp_name'];
			$target = "images/teacher/" . str_replace(" ", "_", $imagename);
			$db_send_name = str_replace(" ", "_", $imagename);
			move_uploaded_file($source, $target);

			$imagepath = $imagename;
			$save = "images/teacher/" . $imagepath; //This is the new file you saving
			$file = "images/teacher/" . $imagepath; //This is the original file

			list($width, $height) = getimagesize($file);

			$modwidth = 300;

			$diff = $width / $modwidth;

			$modheight = $height / $diff;
			$tn = imagecreatetruecolor($modwidth, $modheight);
			$image = imagecreatefromjpeg($file);
			imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height);

			imagejpeg($tn, $save, 100);
		} else {
			$db_send_name = "";
		}
	} else {
		$db_send_name = "";
	}

	mysqli_query($conn, "INSERT INTO lmstealmsr(systemid, fullname, district, contactnumber,pcontactno, school, username, password, image, town, birthday, gender, joindate, add_date, status) VALUES ('$systemid','$fullname','$district','$contactnumber','$pcontactno','$school','$username','$password','$db_send_name','$town','$birthday','$gender','$joindate','$add_date','0')");

	if (!empty($_POST['lavel'])) {
		foreach ($_POST['lavel'] as $lavel) {
			mysqli_query($conn, "INSERT INTO lmstealmsr_multiple(tealmsr_system_id, tealmsr_type, tealmsr_contain_id) VALUES ('$systemid','2','$lavel')");
		}
	}

	if (!empty($_POST['subject'])) {
		foreach ($_POST['subject'] as $subject) {
			mysqli_query($conn, "INSERT INTO lmstealmsr_multiple(tealmsr_system_id, tealmsr_type, tealmsr_contain_id) VALUES ('$systemid','3','$subject')");
		}
	}
}
?>
<?php
require_once 'header.php';
?>
<?php
require_once 'navheader.php';
?>
<?php
require_once 'sidebarmenu.php';
?>


<div class="content-wrapper">
	<!-- row -->
	<div class="container-fluid">

		<div class="row page-titles mx-0">
			<div class="col-sm-6 p-md-0">
				<div class="welcome-text">
					<h4>Add Student</h4>
				</div>
			</div>
			<div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.php">Home</a></li>
					<li class="breadcrumb-item"><a href="javascript:void(0);">Student</a></li>
					<li class="breadcrumb-item active"><a href="javascript:void(0);">Add Student</a></li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Add Student</h4>
					</div>
					<div class="card-body">
						<?php

						if (isset($errMSG)) {

						?>

							<div class="alert alert-danger alert-dismissible alert-alt solid fade show">
								<button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
								<strong>Error!</strong> <?php echo $errMSG; ?>
							</div>

						<?php

						} else if (isset($successMSG)) {

						?>

							<div class="alert alert-success alert-dismissible alert-alt solid fade show">
								<button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
								<strong>Success!</strong> <?php echo $successMSG; ?>.
							</div>

						<?php

						}

						?>
						<form method="POST" enctype="multipart/form-data">
							<div class="row">
								<div class="col-lg-2 col-md-2 col-sm-6">
									<div class="form-group">
										<label class="form-label">Profile Photo</label>
										<p style="color:red;">Only JPG</p>
										<input type="hidden" name="systemid" id="" value="<?php echo $systemid_val; ?>">

										<label for="fileName"><img src="../profile/images/hd_dp.jpg" id="yourImgTag" class="pro_pick img-fluid"></label>
										<input type="file" name="image" id="fileName" hidden="lms" onChange="dis_name();">

										<script>
											function dis_name() {
												var input = document.getElementById("fileName");
												var fReader = new FileReader();
												fReader.readAsDataURL(input.files[0]);
												fReader.onloadend = function(event) {
													var img = document.getElementById("yourImgTag");
													img.src = event.target.result;
												}
											}
										</script>
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-6">
									<div class="form-group">
										<label class="form-label">Full Name</label>
										<input type="text" class="form-control" name="fullname" placeholder="Enter Full Name" required>
									</div>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-6">
									<div class="form-group">
										<label class="form-label">Medium</label>
										<table>
											<tbody>
												<?php
												$level_qury = mysqli_query($conn, "SELECT * FROM lmsclass ORDER BY name");
												while ($level_resalt = mysqli_fetch_array($level_qury)) {
												?>
													<tr valign="middle">
														<td style="width: 20px;"><input type="checkbox" name="lavel[]" id="<?php echo "level" . $level_resalt['cid']; ?>" value="<?php echo $level_resalt['cid']; ?>"></td>
														<td><label for="<?php echo "level" . $level_resalt['cid']; ?>"><?php echo $level_resalt['name']; ?></label></td>
													</tr>
												<?php
												}
												?>
											</tbody>
										</table>
									</div>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-6">
									<div class="form-group">
										<label class="form-label">Grade</label>
										<table>
											<tbody>
												<?php
												$subject_qury = mysqli_query($conn, "SELECT * FROM lmssubject ORDER BY name");
												while ($subject_resalt = mysqli_fetch_array($subject_qury)) {
												?>
													<tr valign="middle">
														<td style="width: 20px;"><input type="checkbox" name="subject[]" id="<?php echo "subject" . $subject_resalt['sid']; ?>" value="<?php echo $subject_resalt['sid']; ?>"></td>
														<td><label for="<?php echo "subject" . $subject_resalt['sid']; ?>"><?php echo $subject_resalt['name']; ?> - [<?php

																																										$id = $subject_resalt['class_id'];

																																										$query = $DB_con->prepare('SELECT name FROM lmsclass WHERE cid=' . $id);

																																										$query->execute();

																																										$result = $query->fetch();

																																										echo $result['name'];

																																										?>]</label></td>
													</tr>
												<?php
												}
												?>
											</tbody>
										</table>
									</div>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-6">
									<div class="form-group">
										<label class="form-label">Phone Number</label>
										<input type="tel" class="form-control" name="contactnumber" placeholder="Enter Contact Number" required pattern="\d*">
									</div>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-6">
									<div class="form-group">
										<label class="form-label">Parent Phone Number</label>
										<input type="text" class="form-control" name="pcontactno" placeholder="Enter Subject Details" required>
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-6">
									<div class="form-group">
										<label class="form-label">School</label>
										<input type="text" class="form-control" name="school" placeholder="Enter School" required>
									</div>
								</div>
								<div class="col-lg-2 col-md-2 col-sm-6">
									<div class="form-group">
										<label class="form-label">District</label>
										<input type="text" class="form-control" name="district" placeholder="Enter District" required>
									</div>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-6">
									<div class="form-group">
										<label class="form-label">Town</label>
										<input type="text" class="form-control" name="town" placeholder="Enter Town" required>
									</div>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-6">
									<div class="form-group">
										<label class="form-label">Birthday</label>
										<input type="text" class="form-control" name="birthday" placeholder="Enter Birthday" required>
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-6">
									<div class="form-group">
										<label class="form-label">Email Address(User Name)</label>
										<input type="email" class="form-control" name="username" placeholder="Enter User Name" required>
									</div>
								</div>
								<div class="col-lg-2 col-md-2 col-sm-6">
									<div class="form-group">
										<label class="form-label">Gender</label>
										<select name="gender" class="form-control">
											<option value="Male">Male</option>
											<option value="Female">Female</option>
										</select>
									</div>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-6">
									<div class="form-group">
										<label class="form-label">Joined Date</label>
										<input type="text" class="form-control" name="joindate" placeholder="Enter Joined Date" required>
									</div>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-6">
									<div class="form-group">
										<label class="form-label">Password</label>
										<input type="password" class="form-control" name="password" placeholder="Enter Password" required>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12">
									<input type="submit" name="add_bt" class="btn btn-primary" value="Save changes">
									<a class="btn btn-light" href="teachers.php"><i class="fa fa-times"></i> Cancel</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
<?php
require_once 'footer.php';
?>