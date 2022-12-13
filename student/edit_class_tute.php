<?php

session_start();

require_once 'includes.php';

require_once '../dashboard/dbconfig4.php';

require_once("../dashboard/conn.php");

if (isset($_SESSION['tid'])) {

	$user_qury = mysqli_query($conn, "SELECT * FROM lmstealmsr WHERE tid='$_SESSION[tid]'");

	$user_resalt = mysqli_fetch_array($user_qury);



	if ($user_resalt['image'] == "") {

		$image_path = "../profile/images/hd_dp.jpg";
	} else {

		$image_path = "../dashboard/images/teacher/" . $user_resalt['image'];
	}
} else {

	echo "<script>window.location='home.php';</script>";
}

if (isset($_GET['cttid']) && !empty($_GET['cttid'])) {

	$id = $_GET['cttid'];

	$stmt_edit = $DB_con->prepare('SELECT * FROM lmsclasstute_std WHERE ctuid =:cttid');

	$stmt_edit->execute(array(':cttid' => $id));

	$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);

	extract($edit_row);
} else {

	header("Location: home.php");
}

if (isset($_POST['update'])) {

	$tid = $_POST['tid'];
	$class = $_POST['class'];
	$subject = $_POST['subject'];

	$ctype = $_POST['ctype'];
	$title = $_POST['title'];
	$status = $_POST['status'];

	date_default_timezone_set("Asia/Colombo");

	$imgFile = $_FILES['user_image']['name'];
	$tmp_dir = $_FILES['user_image']['tmp_name'];
	$imgSize = $_FILES['user_image']['size'];
	if ($imgFile) {

		$upload_dir = 'images/classtute/'; // upload directory	

		$imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension

		$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'docx', 'pdf', 'video', 'mp3'); // valid extensions

		$userpic = rand(1, 1000000) . "." . $imgExt;

		if (in_array($imgExt, $valid_extensions)) {

			if ($imgSize < 5000000) {

				unlink($upload_dir . $edit_row['tdocument']);

				move_uploaded_file($tmp_dir, $upload_dir . $userpic);
			} else {

				$errMSG = "Sorry, your file is too large it lmsould be less then 5MB";
			}
		} else {

			$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		}
	} else {

		// if no image selected the old image remain as it is.

		$userpic = $edit_row['tdocument']; // old image from database

	}

	if (!isset($errMSG)) {

		$stmt = $DB_con->prepare('UPDATE lmsclasstute_std
									     SET tid=:tid,									 											 
											 class=:class,										 											 
											 subject=:subject,											 											 
											 ctype=:ctype,
											 title=:title,
										     tdocument=:upic,
											 status=:status
								       WHERE ctuid=:cttid');

		$stmt->bindParam(':tid', $tid);
		$stmt->bindParam(':class', $class);
		$stmt->bindParam(':subject', $subject);
		$stmt->bindParam(':ctype', $ctype);
		$stmt->bindParam(':title', $title);
		$stmt->bindParam(':upic', $userpic);
		$stmt->bindParam(':status', $status);
		$stmt->bindParam(':cttid', $id);
		if ($stmt->execute()) {

			$successMSG = "Uploads Successfully Updated ...";

			header("refresh:2;home.php"); // redirects image view page after 5 seconds.
		} else {
			$errMSG = "Sorry Data Could Not Updated !";
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
					<h4>Edit Uploads</h4>
				</div>
			</div>
			<div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.php">Home</a></li>
					<li class="breadcrumb-item active"><a href="home.php">Uploads</a></li>
					<li class="breadcrumb-item active"><a href="edit_class_tute.php">Edit Uploads</a></li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-xl-12 col-xxl-12 col-sm-12">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Edit Uploads</h5>
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
								<div class="col-lg-6 col-md-6 col-sm-12">
									<div class="form-group">
										<label class="form-label">Topic</label>
										<input type="text" class="form-control" name="title" value="<?php echo $title; ?>">
									</div>
								</div>

								<div class="col-lg-3 col-md-3 col-sm-12">
									<div class="form-group">
										<label class="form-label">Medium</label>
										<select class="form-control" name="class" required onChange="JavaScript:send_level(this.value);">
											<option value="<?php
															$id = $class;
															$query = $DB_con->prepare('SELECT cid FROM lmsclass WHERE cid=' . $id);
															$query->execute();
															$result = $query->fetch();
															echo $result['cid'];
															?>" hidden="lms"><?php
																				$id = $class;
																				$query = $DB_con->prepare('SELECT name FROM lmsclass WHERE cid=' . $id);
																				$query->execute();
																				$result = $query->fetch();
																				echo $result['name'];
																				?>
											</option>
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
									</div>
								</div>
								<script>
									function send_level(level_id) {
										var xhttp = new XMLHttpRequest();
										xhttp.onreadystatechange = function() {
											if (this.readyState == 4 && this.status == 200) {
												document.getElementById("subject_dis").innerHTML = this.responseText;
											}
										};
										xhttp.open("GET", "ajax_subject_filter.php?level_id=" + level_id, true);
										xhttp.send();
									}
								</script>
								<div class="col-lg-3 col-md-3 col-sm-12">
									<div class="form-group">
										<label class="form-label">Grade</label>
										<span id="subject_dis">
											<select name="subject" class="form-control" required>
												<?php
												if ($_GET['leid']) {
													$sub_qury = mysqli_query($conn, "SELECT * FROM lmslesson WHERE lid='$_GET[leid]'");
													$sub_resalt = mysqli_fetch_array($sub_qury);
												}
												?>
												<option hidden="lms"><?php if (isset($_GET['leid'])) {
																			echo $sub_resalt['subject'];
																		} else {
																			echo "Grade Not Found";
																		} ?></option>
											</select>
										</span>
									</div>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-12" style="display: none;">
									<div class="form-group">
										<label class="form-label">Student</label>
										<select class="form-control" name="tid" required>
											<option value="<?php

															$id = $tid;

															$query = $DB_con->prepare('SELECT tid FROM lmstealmsr WHERE tid=' . $id);

															$query->execute();

															$result = $query->fetch();

															echo $result['tid'];

															?>"><?php

																$id = $tid;

																$query = $DB_con->prepare('SELECT fullname FROM lmstealmsr WHERE tid=' . $id);

																$query->execute();

																$result = $query->fetch();

																echo $result['fullname'];

																?></option>
											<?php

											$stmt = $DB_con->prepare('SELECT * FROM lmstealmsr where tid="' . $_SESSION['tid'] . '" and status="1" ORDER BY tid');

											$stmt->execute();

											if ($stmt->rowCount() > 0) {

												while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

													extract($row);

											?>
													<option value="<?php echo $row['tid']; ?>"><?php echo $row['fullname']; ?></option>
											<?php }
											}
											?>
										</select>
									</div>
								</div>
								<div class="col-lg-2 col-md-2 col-sm-12" style="display: none;">
									<div class="form-group">
										<label class="form-label">Class Type</label>
										<select class="form-control" name="ctype" required>
											<option><?php echo $ctype; ?></option>

										</select>
									</div>
								</div>

								<div class="col-lg-5 col-md-5 col-sm-12">
									<div class="form-group">
										<label class="form-label">Upload Document</label>
										<input type="file" class="form-control" name="user_image">
										<hr>
										<p style="font-weight:bold;color:red;">Note : "Only Upload - Pdf|Docx|Jpg|Png"</p>
									</div>
								</div>

								<div style="display: none;" class="col-lg-2 col-md-2 col-sm-12">
									<div class="form-group">
										<label class="form-label">Status</label>
										<select class="form-control" name="status" required>
											<option value="1" <?php if (['status'] == "1") {
																	echo "selected";
																} ?>>Published</option>
											<option value="0" <?php if (['status'] == "0") {
																	echo "selected";
																} ?>>Unpublished</option>
										</select>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12">
									<input type="submit" name="update" class="btn btn-primary" value="Update">
									<a class="btn btn-light" href="home.php"><i class="fa fa-times"></i> Cancel</a>
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
require_once 'copyright.php';
?>
<?php
require_once 'footer.php';
?>