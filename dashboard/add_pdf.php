<?php

session_start();

require_once 'includes.php';

require_once 'conn.php';

require_once("config.php");

require_once 'dbconfig4.php';

$msg5 = '';

if (isset($_POST['add_classtute'])) {

	$class = $_POST['class'];
	$subject = $_POST['subject'];
	$ctype = $_POST['ctype'];
	$title = $_POST['title'];
	$status = $_POST['status'];

	date_default_timezone_set("Asia/Colombo");

	$imgFile = $_FILES['user_image']['name'];
	$tmp_dir = $_FILES['user_image']['tmp_name'];
	$imgSize = $_FILES['user_image']['size'];

	if (empty($class)) {
		$errMSG = "Please Select Class.";
	} else if (empty($subject)) {
		$errMSG = "Please Select Subject.";
	} else if (empty($ctype)) {
		$errMSG = "Please Select Type.";
	} else if (empty($title)) {
		$errMSG = "Please Select Title.";
	} {
		$upload_dir = 'images/classtute/'; // upload directory

		$imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension

		// valid image extensions
		$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'docx', 'pdf', 'video', 'mp3'); // valid extensions

		// rename uploading image
		$userpic = rand(1, 1000000) . "." . $imgExt;

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
		$stmt = $DB_con->prepare('INSERT INTO lms_pdf(class,subject,ctype,title,tdocument,status) VALUES(:class,:subject,:ctype,:title,:upic,:status)');
		$stmt->bindParam(':class', $class);
		$stmt->bindParam(':subject', $subject);
		$stmt->bindParam(':ctype', $ctype);
		$stmt->bindParam(':title', $title);
		$stmt->bindParam(':upic', $userpic);
		$stmt->bindParam(':status', $status);

		if ($stmt->execute()) {

			$successMSG = "PDF Successfully Added.";

			header("refresh:2;pdf.php"); // redirects image view page after 5 seconds.

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
					<h4>Add PDF</h4>
				</div>
			</div>
			<div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.php">Home</a></li>
					<li class="breadcrumb-item"><a href="javascript:void(0);">PDF</a></li>
					<li class="breadcrumb-item active"><a href="javascript:void(0);">Add PDF</a></li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Add PDF</h4>
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
										<label class="form-label">Grade</label>
										<select class="form-control" name="class" onChange="JavaScript:send_level(this.value);" required>
											<option value="" hidden="yes">Select Grade</option>
											<?php

											$stmt = $DB_con->prepare('SELECT * FROM lmsclass ORDER BY cid');
											$stmt->execute();
											if ($stmt->rowCount() > 0) {
												while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
													extract($row);
											?>
													<option value="<?php echo $row['cid']; ?>"><?php echo $row['name']; ?></option>
											<?php
												}
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
										<label class="form-label">Class Subject</label>
										<span id="subject_dis">
											<select name="subject" class="form-control" required>
												<option hidden="yes"><?php if (isset($_GET['edit'])) {
																			echo $edit_resalt['subject'];
																		} else {
																			echo "Subject Not Found";
																		} ?></option>
											</select>
										</span>
									</div>
								</div>
								
								<div class="col-lg-2 col-md-2 col-sm-12">
									<div class="form-group">
										<label class="form-label">Class Type</label>
										<select class="form-control" name="ctype" required>
											<option style="display:none;">Select Type</option>
											<option>Books and Papers</option>
										</select>
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-12">
									<div class="form-group">
										<label class="form-label">Title</label>
										<input type="text" class="form-control" name="title" placeholder="Enter PDF Title" required>
									</div>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-12">
									<div class="form-group">
										<label class="form-label">Upload Document</label>
										<input type="file" class="form-control" name="user_image">
										<hr>
										<p style="font-weight:bold;color:red;">Note : "Only Upload - PDF|Docx|Jpg|Png"</p>
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
									<a class="btn btn-light" href="pdf.php"><i class="fa fa-times"></i> Cancel</a>
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