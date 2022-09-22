<?php

session_start();

require_once 'includes.php';

?>
<?php

require("conn.php");

require_once 'dbconfig4.php';

if (isset($_GET['sbid'])) {
	$sbid = mysqli_real_escape_string($conn, $_GET['sbid']);
	$view_qury = mysqli_query($conn, "SELECT * FROM lmssubject WHERE sid='$sbid'");
	$view_result = mysqli_fetch_array($view_qury);
} else {
	echo "<script>window.location='subject.php';</script>";
}


if (isset($_POST['update'])) {
	$class_id = $_POST['class_id'];
	$name = $_POST['name'];
	$status = $_POST['status'];

	$sbid = $_GET['sbid'];

	if (!isset($errMSG)) {
		$stmt = $DB_con->prepare('UPDATE lmssubject
			SET class_id=:class_id,
				name=:name,
				status=:status
			WHERE sid=:sbid');
		$stmt->bindParam(':class_id', $class_id);
		$stmt->bindParam(':name', $name);
		$stmt->bindParam(':status', $status);
		$stmt->bindParam(':sbid', $sbid);
		if ($stmt->execute()) {

			$successMSG = "Subject Successfully Updated ....";

			header("refresh:2;subject.php"); // redirects image view page after 5 seconds.

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
					<h4>Edit Subject</h4>
				</div>
			</div>
			<div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.php">Home</a></li>
					<li class="breadcrumb-item active"><a href="subject.php">Subject</a></li>
					<li class="breadcrumb-item active"><a href="edit_admin.php">Edit Subject</a></li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-xl-12 col-xxl-12 col-sm-12">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Edit Subject</h5>
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
						<form action="" method="POST" enctype="multlmsrt/form-data">
							<div class="row">
								<div class="col-lg-3 col-md-3 col-sm-12">
									<div class="form-group">
										<label class="form-label">Grade</label>
										<select name="class_id" class="form-control">
											<?php
											$class_qury = mysqli_query($conn, "SELECT * FROM lmsclass ORDER BY name");
											while ($class_result = mysqli_fetch_array($class_qury)) {
											?>
												<option <?php if ($view_result['class_id'] == $class_result['cid']) {
															echo "selected";
														} ?> value="<?php echo $class_result['cid']; ?>"><?php echo $class_result['name']; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-12">
									<div class="form-group">
										<label class="form-label">Subject Name</label>
										<input type="text" class="form-control" name="name" value="<?php echo $view_result['name']; ?>" required>
									</div>
								</div>
								<div class="col-lg-2 col-md-2 col-sm-12">
									<div class="form-group fallback w-100">
										<label class="form-label">Status</label>
										<select class="form-control" id="input-6" name="status" required>
											<option <?php if ($view_result['status'] == "Publish") {
														echo "selected";
													} ?>>Publish</option>
											<option <?php if ($view_result['status'] == "Unpublish") {
														echo "selected";
													} ?>>Unpublish</option>
										</select>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12">
									<input type="submit" name="update" class="btn btn-primary" value="Update">
									<a class="btn btn-light" href="subject.php"><i class="fa fa-times"></i> Close</a>
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