<?php

session_start();

require_once 'includes.php';

?>

<?php

require_once 'dbconfig4.php';

$msg = '';

$msg5 = '';

if (isset($_POST['save'])) {

	$user_name = $_POST['user_name'];

	$user_email = $_POST['user_email'];

	$user_pass = $_POST['user_pass'];

	$user_pass = password_hash($user_pass, PASSWORD_DEFAULT);

	$admintype = $_POST['admintype'];

	$admin = $_POST['admin'];

	$students = $_POST['students'];

	$teachers = $_POST['teachers'];

	$class = $_POST['class'];

	$subject = $_POST['subject'];

	$lesson = $_POST['lesson'];

	$payments = $_POST['payments'];

	$class_schedule = $_POST['class_schedule'];

	$mail = $_POST['mail'];

	$status = $_POST['status'];

	// if no error occured, continue ....

	if (!isset($errMSG)) {

		$stmt = $DB_con->prepare('INSERT INTO lmsusers(user_name,user_email,user_pass,admintype,admin,students,teachers,class,subject,lesson,payments,class_schedule,mail,status) VALUES(:user_name,:user_email,:user_pass,:admintype,:admin,:students,:teachers,:class,:subject,:lesson,:payments,:class_schedule,:mail,:status)');

		$stmt->bindParam(':user_name', $user_name);

		$stmt->bindParam(':user_email', $user_email);

		$stmt->bindParam(':user_pass', $user_pass);

		$stmt->bindParam(':admintype', $admintype);

		$stmt->bindParam(':admin', $admin);

		$stmt->bindParam(':students', $students);

		$stmt->bindParam(':teachers', $teachers);

		$stmt->bindParam(':class', $class);

		$stmt->bindParam(':subject', $subject);

		$stmt->bindParam(':lesson', $lesson);

		$stmt->bindParam(':payments', $payments);

		$stmt->bindParam(':class_schedule', $class_schedule);

		$stmt->bindParam(':mail', $mail);

		$stmt->bindParam(':status', $status);

		if ($stmt->execute()) {

			$successMSG = "Successfully! Created New Admin User Account....";

			header("refresh:2;admin.php"); // redirects image view page after 5 seconds.

		} else {

			$errMSG = "error while inserting....";
		}
	}
}

?>

<?php
require_once 'header.php';
?>

<?php require_once 'navheader.php'; ?>

<?php
require_once 'sidebarmenu.php';
?>

<div class="content-wrapper">
	<!-- row -->
	<div class="container-fluid">

		<div class="row page-titles mx-0">
			<div class="col-sm-6 p-md-0">
				<div class="welcome-text">
					<h4>Add Admin</h4>
				</div>
			</div>
			<div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.php">Home</a></li>
					<li class="breadcrumb-item"><a href="javascript:void(0);">Admin</a></li>
					<li class="breadcrumb-item active"><a href="javascript:void(0);">Add Admin</a></li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Add Admin Users Account</h4>
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
										<label class="form-label">Username</label>
										<input type="text" class="form-control" name="user_name" placeholder="Enter Username" required>
									</div>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-12">
									<div class="form-group">
										<label class="form-label">Email</label>
										<input type="email" class="form-control" name="user_email" placeholder="Enter Email" required>
									</div>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-12">
									<div class="form-group">
										<label class="form-label">Password</label>
										<input type="password" class="form-control" name="user_pass" placeholder="Enter Password" required>
									</div>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-12">
									<div class="form-group">
										<label class="form-label">Admin Type</label>
										<select class="form-control" name="admintype" required>
											<option>Super Admin</option>
											<option>Core Admin</option>
											<option>Editor</option>
											<option>Viewer</option>
										</select>
									</div>
								</div>
								<div class="col-lg-2 col-md-2 col-sm-12">
									<div class="form-group">
										<label class="form-label">Admin</label>
										<select class="form-control" name="admin" required>
											<option>True</option>
											<option>False</option>
										</select>
									</div>
								</div>
								<div class="col-lg-2 col-md-2 col-sm-12">
									<div class="form-group">
										<label class="form-label">Students</label>
										<select class="form-control" name="students" required>
											<option>True</option>
											<option>False</option>
										</select>
									</div>
								</div>
								<div class="col-lg-2 col-md-2 col-sm-12">
									<div class="form-group">
										<label class="form-label">Teachers</label>
										<select class="form-control" name="teachers" required>
											<option>True</option>
											<option>False</option>
										</select>
									</div>
								</div>
								<div class="col-lg-2 col-md-2 col-sm-12">
									<div class="form-group">
										<label class="form-label">Class</label>
										<select class="form-control" name="class" required>
											<option>True</option>
											<option>False</option>
										</select>
									</div>
								</div>
								<div class="col-lg-2 col-md-2 col-sm-12">
									<div class="form-group">
										<label class="form-label">Subject</label>
										<select class="form-control" name="subject" required>
											<option>True</option>
											<option>False</option>
										</select>
									</div>
								</div>
								<div class="col-lg-2 col-md-2 col-sm-12">
									<div class="form-group">
										<label class="form-label">Lesson</label>
										<select class="form-control" name="lesson" required>
											<option>True</option>
											<option>False</option>
										</select>
									</div>
								</div>
								<div class="col-lg-2 col-md-2 col-sm-12">
									<div class="form-group">
										<label class="form-label">Payments</label>
										<select class="form-control" name="payments" required>
											<option>True</option>
											<option>False</option>
										</select>
									</div>
								</div>
								<div class="col-lg-2 col-md-2 col-sm-12">
									<div class="form-group">
										<label class="form-label">Class Schedule</label>
										<select class="form-control" name="class_schedule" required>
											<option>True</option>
											<option>False</option>
										</select>
									</div>
								</div>
								<div class="col-lg-2 col-md-2 col-sm-12">
									<div class="form-group">
										<label class="form-label">Mail</label>
										<select class="form-control" name="mail" required>
											<option>True</option>
											<option>False</option>
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
									<a class="btn btn-light" href="admin.php"><i class="fa fa-times"></i> Cancel</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
<!--**********************************
            Content body end
        ***********************************-->

<?php
require_once 'copyright.php';
?>
<?php
require_once 'footer.php';
?>

