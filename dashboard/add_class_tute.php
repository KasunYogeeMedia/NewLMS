<?php

session_start();

require_once 'includes.php';

require_once 'conn.php';

require_once("config.php");

require_once 'dbconfig4.php';

$msg5 = '';

if (isset($_POST['add_classtute'])) {

	$stName = $_POST['stName'];
	$title = $_POST['title'];
	$month = $_POST['month'];
	$ctype = $_POST['ctype'];
	$status = $_POST['status'];

	date_default_timezone_set("Asia/Colombo");

	$imgFile = $_FILES['user_image']['name'];
	$tmp_dir = $_FILES['user_image']['tmp_name'];
	$imgSize = $_FILES['user_image']['size'];

	if (empty($month)) {
		$errMSG = "Please Select Month.";
	} else if (empty($ctype)) {
		$errMSG = "Please Select Type.";
	} else if (empty($stName)) {
		$errMSG = "Please Select Name.";
	} else if (empty($title)) {
		$errMSG = "Please Select Title.";
	} else if (empty($status)) {
		$errMSG = "Please Select Status.";
	} {
		$upload_dir = 'images/classtute/'; // upload directory

		$imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION));
		// valid image extensions
		$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'docx', 'pdf', 'video', 'mp3'); // valid extensions

		// rename uploading image
		$userpic = $imgFile . "." . $imgExt;

		// allow valid image file formats
		if (in_array($imgExt, $valid_extensions)) {
			// lmsck file size '5MB'
			if ($imgSize < 5000000) {
				move_uploaded_file($tmp_dir, $upload_dir . $userpic);
			} else {
				$errMSG = "Sorry, your file is too large.";
			}
		} else {
			$errMSG = "Sorry, only JPG, JPEG, PNG & GIF , DOCX & PDF files are allowed.";
		}
	}
	// if no error occured, continue ....
	if (!isset($errMSG)) {
		$stmt = $DB_con->prepare('INSERT INTO ol_result(month,stName,ctype,title,tdocument,status) VALUES(:month,:stName,:ctype,:title,:upic,:status)');
		$stmt->bindParam(':month', $month);
		$stmt->bindParam(':ctype', $ctype);
		$stmt->bindParam(':stName', $stName);
		$stmt->bindParam(':title', $title);
		$stmt->bindParam(':upic', $userpic);
		$stmt->bindParam(':status', $status);

		if ($stmt->execute()) {

			$successMSG = "Class Tute Successfully Added.";

			header("refresh:2;class_tute.php"); // redirects image view page after 5 seconds.

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
					<h4>Add O/L Result</h4>
				</div>
			</div>
			<div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.php">Home</a></li>
					<li class="breadcrumb-item"><a href="javascript:void(0);">Class Tute</a></li>
					<li class="breadcrumb-item active"><a href="javascript:void(0);">Add Class Tute</a></li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Add O/L Result</h4>
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
								<div class="col-lg-4 col-md-4 col-sm-12">
									<div class="form-group">
										<label class="form-label">Student Name</label>
										<input type="text" class="form-control" name="stName" placeholder="Enter Student Name" required>
									</div>
								</div>
								<div class="col-lg-5 col-md-5 col-sm-12">
									<div class="form-group">
										<label class="form-label">Batch</label>
										<input type="text" class="form-control" name="title" placeholder="Enter Batch" required>
									</div>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-12 mb-2">
									<label class="form-label">Index Number</label>
									<input name="ctype" type="text" id="ctype" class="form-control" placeholder="Enter Index Number">
								</div>
								<div class="col-lg-3 col-md-3 col-sm-12">
									<div class="form-group">
										<label class="form-label">Science Result</label>
										<select class="form-control" name="month" required>
											<option style="display:none;">Select Result</option>
											<option>A</option>
											<option>B</option>
											<option>C</option>
											<option>S</option>
											<option>F</option>
										</select>
									</div>
								</div>
								<div class="col-lg-7 col-md-7 col-sm-12">
									<div class="form-group">
										<label class="form-label">Upload Document</label>
										<input type="file" class="form-control" name="user_image">
										<hr>
										<p style="font-weight:bold;color:red;">Note : "Only Upload - Pdf|Docx|Jpg|Png"</p>
									</div>
								</div>
								<div class="col-lg-2 col-md-2 col-sm-12">
									<div class="form-group">
										<label class="form-label">Status</label>
										<select class="form-control" name="status" required>
											<option value="1">Published</option>
											<option value="0">Unpublished</option>
										</select>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12">
									<input type="submit" name="add_classtute" class="btn btn-primary" value="Save changes">
									<a class="btn btn-light" href="class_tute.php"><i class="fa fa-times"></i> Cancel</a>
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