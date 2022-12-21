<?php

session_start();

require_once 'includes.php';

require_once 'conn.php';

require_once("config.php");

require_once 'dbconfig4.php';

$msg5 = '';

if (isset($_POST['add_lesson'])) {
	$tid = $_POST['tid'];
	$type = $_POST['type'];
	$class = $_POST['class'];
	$subject = $_POST['subject'];
	$title = $_POST['title'];
	$video = $_POST['video'];
	$status = $_POST['status'];

	date_default_timezone_set("Asia/Colombo");

	// $imgFile = $_FILES['user_image']['name'];
	// $tmp_dir = $_FILES['user_image']['tmp_name'];
	// $imgSize = $_FILES['user_image']['size'];
	if (empty($type)) {
		$errMSG = "Please Select Type.";
	} else if (empty($class)) {
		$errMSG = "Please Select Class.";
	} else if (empty($subject)) {
		$errMSG = "Please Select Grade.";
	} else if (empty($title)) {
		$errMSG = "Please Enter Title.";
	} else if (empty($video)) {
		$errMSG = "Please Copy Video Code Or Link.";
	} else if (empty($status)) {
		$errMSG = "Please Select Status.";
	} {
		// $upload_dir = 'images/lesson/cover/'; // upload directory

		// $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension
		// // valid image extensions
		// $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'docx', 'pdf', 'video', 'mp3'); // valid extensions
		// // rename uploading image
		// $userpic = rand(1, 1000000) . "." . $imgExt;
		// // allow valid image file formats
		// if (in_array($imgExt, $valid_extensions)) {
		// 	// check file size '5MB'
		// 	if ($imgSize < 5000000) {
		// 		move_uploaded_file($tmp_dir, $upload_dir . $userpic);
		// 	} else {
		// 		$errMSG = "Sorry, your file is too large.";
		// 	}
		// } else {
		// 	$errMSG = "Sorry, only JPG, JPEG, PNG & GIF , DOCX & PDF files are allowed.";
		// }
	}
	if (!isset($errMSG)) {
		$stmt = $DB_con->prepare('INSERT INTO lmslesson(tid,type,class,subject,title,video,status) VALUES(:tid,:type,:class,:subject,:title,:video,:status)');
		$stmt->bindParam(':tid', $tid);
		$stmt->bindParam(':type', $type);
		$stmt->bindParam(':class', $class);
		$stmt->bindParam(':subject', $subject);
		$stmt->bindParam(':title', $title);
		// $stmt->bindParam(':upic', $userpic);
		$stmt->bindParam(':video', $video);
		$stmt->bindParam(':status', $status);


		if ($stmt->execute()) {
			$successMSG = "Your Video Lessons Successfully Submitted.";

			// header("refresh:2;video_lessons.php");
		} else {
			$errMSG = "error while inserting....";
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
					<h4>Add Video Lessons</h4>
				</div>
			</div>
			<div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.php">Home</a></li>
					<li class="breadcrumb-item"><a href="javascript:void(0);">Video Lessons</a></li>
					<li class="breadcrumb-item active"><a href="javascript:void(0);">Add Video Lessons</a></li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Add Video Lessons</h4>
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
								<div class="col-lg-3 col-md-3 col-sm-12">
									<div class="form-group">
										<label class="form-label">Student</label>
										<select class="form-control" name="tid" required>
											<option value="" selected>Select Student</option>
											<?php

											$stmt = $DB_con->prepare('SELECT * FROM lmstealmsr ORDER BY tid');

											$stmt->execute();

											if ($stmt->rowCount() > 0) {

												while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

													extract($row);

											?>
													<option value="<?php echo $row['tid']; ?>"><?php echo $row['fullname']; ?></option>
											<?php
												}
											}
											?>
										</select>
									</div>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-12">
									<div class="form-group">
										<label class="form-label">Type</label>
										<select class="form-control" name="type" required>
											<option value="">Select Type </option>
											<option value="general">General</option>
											<option value="lesson_explanations">Lesson Explanations</option>
											<option value="lesson_revision">Lesson Revision</option>
											<option value="paper_discussions">Paper Discussions</option>
											<option value="student_lesson_explanations">Students Lesson Explanations</option>
											<option value="student_practicals">Students Practicals</option>
										</select>
									</div>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-12">
									<div class="form-group">
										<label class="form-label">Medium</label>
										<select class="form-control" name="class" required onChange="JavaScript:send_level(this.value);">
											<option value="" hidden="lms">Select Medium</option>
											<?php
											require_once 'dbconfig4.php';
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
											<select name="subject" id="" required class="form-control">
												<option hidden="lms"><?php if (isset($_GET['edit'])) {
																			echo $edit_resalt['subject'];
																		} else {
																			echo "Grade Not Found";
																		} ?></option>
											</select>
										</span>
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-12">
									<div class="form-group">
										<label class="form-label">Title</label>
										<input type="text" class="form-control" name="title" placeholder="Enter Title" required>
									</div>
								</div>
								<!-- <div class="col-lg-4 col-md-4 col-sm-12">
									<div class="form-group">
										<label class="form-label">Cover Image</label>
										<input type="file" class="form-control" name="user_image">
										<hr>
										<p style="font-weight:bold;color:red;">Note : "Only Upload - Jpg|Png"</p>
									</div>
								</div> -->
								<div class="col-lg-6 col-md-6 col-sm-12">
									<div class="form-group">
										<label class="form-label">Video URL</label>
										<input class="form-control" type="text" name="video" placeholder="Video URL" required>
									</div>
								</div>

				

								<div class="col-lg-2 col-md-2 col-sm-12">
									<div class="form-group">
										<label class="form-label">Status</label>
										<select class="form-control" id="input-6" name="status" required>
											<option value="1">Published</option>
											<option value="0">Unpublshed</option>
										</select>
									</div>
								</div>

							

								<div class="col-lg-12 col-md-12 col-sm-12">
									<input type="submit" name="add_lesson" class="btn btn-primary" value="Save changes">
									<a class="btn btn-light" href="video_lessons.php"><i class="fa fa-times"></i> Cancel</a>
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