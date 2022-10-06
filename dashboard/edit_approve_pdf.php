<?php

session_start();

require_once 'includes.php';

require_once '../dashboard/dbconfig4.php';

require_once("../dashboard/conn.php");

if (isset($_SESSION['tid'])) {

	$user_qury = mysqli_query($conn, "SELECT * FROM lmstealmsr");

	$user_resalt = mysqli_fetch_array($user_qury);



	if ($user_resalt['image'] == "") {

		$image_path = "../profile/images/hd_dp.jpg";
	} else {

		$image_path = "../dashboard/images/teacher/" . $user_resalt['image'];
	}
} else {

	echo "<script>window.location='approve_pdf.php';</script>";
}

if (isset($_GET['cttid']) && !empty($_GET['cttid'])) {

	$id = $_GET['cttid'];

	$stmt_edit = $DB_con->prepare('SELECT * FROM lmsclasstute_std WHERE ctuid =:cttid');

	$stmt_edit->execute(array(':cttid' => $id));

	$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);

	extract($edit_row);
} else {

	header("Location: approve_pdf.php");
}

if (isset($_POST['update'])) {

	$status = $_POST['status'];

	if (!isset($errMSG)) {

		$stmt = $DB_con->prepare('UPDATE lmsclasstute_std
									     SET status=:status
								       WHERE ctuid=:cttid');

		$stmt->bindParam(':status', $status);
		$stmt->bindParam(':cttid', $id);
		if ($stmt->execute()) {

			$successMSG = "Uploads Successfully Updated ...";

			header("refresh:2;approve_pdf.php"); // redirects image view page after 5 seconds.
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
					<li class="breadcrumb-item active"><a href="approve_pdf.php">Uploads</a></li>
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

								<div class="col-lg-2 col-md-2 col-sm-12">
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
									<a class="btn btn-light" href="approve_pdf.php"><i class="fa fa-times"></i> Cancel</a>
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