<?php

session_start();

require_once 'includes.php';

?>

<?php

require_once("config.php");

require_once 'dbconfig4.php';

$msg = '';

$msg5 = '';

if (isset($_POST['save'])) {

	$class = $_POST['class'];

	$name = $_POST['name'];

	$price = $_POST['price'];

	$fvp = $_POST['fees_valid_period'];

	$status = $_POST['status'];

	if (empty($class)) {
		$errMSG = "Please Enter Class.";
	} else if (empty($name)) {
		$errMSG = "Please Enter Name.";
	} else if (empty($price)) {
		$errMSG = "Please Enter Price.";
	} else if (empty($status)) {
		$errMSG = "Please Select Publilms Or Unpublilmsed.";
	}

	// if no error occured, continue ....

	if (!isset($errMSG)) {

		$stmt = $DB_con->prepare('INSERT INTO lmssubject(class_id,name,price,fees_valid_period,status) VALUES(:class,:name,:price,:fees_valid_period,:status)');

		$stmt->bindParam(':class', $class);

		$stmt->bindParam(':name', $name);

		$stmt->bindParam(':price', $price);

		$stmt->bindParam(':fees_valid_period', $fvp);

		$stmt->bindParam(':status', $status);

		if ($stmt->execute()) {

			$successMSG = "Successfully! Add Your Grade....";

			header("refresh:2;grade.php"); // redirects image view page after 5 seconds.

		} else {

			$errMSG = "error while inserting....";
		}
	}
}

?>

<?php
require_once '../includes/header.php';
require_once 'admin_navbar.php';
require_once 'admin_sidebar.php';
?>
<div class="content-wrapper">
	<!-- row -->
	<div class="container-fluid">

		<div class="row page-titles mx-0">
			<div class="col-sm-6 p-md-0">
				<div class="welcome-text">
					<h4>Add Grade</h4>
				</div>
			</div>
			<div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.php">Home</a></li>
					<li class="breadcrumb-item"><a href="javascript:void(0);">Grade</a></li>
					<li class="breadcrumb-item active"><a href="javascript:void(0);">Add Grade</a></li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Add Grade</h4>
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
						<form method="POST" enctype="multlmsrt/form-data">
							<div class="row">
								<div class="col-lg-3 col-md-3 col-sm-12">
									<div class="form-group">
										<label class="form-label">Medium</label>
										<select name="class" class="form-control">
											<option selected>Select Medium</option>
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
								<div class="col-lg-3 col-md-3 col-sm-12">
									<div class="form-group">
										<label class="form-label">Grade Name</label>
										<input type="text" class="form-control" name="name" placeholder="Enter Grade Name" required>
									</div>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-12">
									<div class="form-group">
										<label class="form-label">Price</label>
										<input type="text" class="form-control" name="price" placeholder="Enter Price" required>
									</div>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-12">
									<div class="form-group">
										<label class="form-label">Fees Valid Period</label>
										<select name="fees_valid_period" class="form-control">
											<option value="1">1 Day</option>
											<option value="30">30 Days</option>
											<option value="40">40 Days</option>
											<option value="45">45 Days</option>
											<option value="90">90 Days</option>
										</select>
									</div>
								</div>
								<div class="col-lg-2 col-md-2 col-sm-12">
									<div class="form-group">
										<label class="form-label">Status</label>
										<select class="form-control" name="status" required>
											<option>Publish</option>
											<option>Unpublish</option>
										</select>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12">
									<input type="submit" name="save" class="btn btn-primary" value="Save changes">
									<a class="btn btn-light" href="grade.php"><i class="fa fa-times"></i> Cancel</a>
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
require_once '../includes/footer.php';
?>