<?php

session_start();

require_once 'includes.php';

?>
<?php

error_reporting(~E_NOTICE);

require_once 'dbconfig4.php';

if (isset($_GET['adid']) && !empty($_GET['adid'])) {

	$id = $_GET['adid'];

	$stmt_edit = $DB_con->prepare('SELECT * FROM lmsusers WHERE user_id =:adid');

	$stmt_edit->execute(array(':adid' => $id));

	$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);

	extract($edit_row);
} else {

	echo "<script type='text/javascript'>window.location.href = 'admin.php';</script>";
}

if (isset($_POST['update'])) {

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

	if (!isset($errMSG)) {

		$stmt = $DB_con->prepare('UPDATE lmsusers

									     SET user_name=:user_name,
											 
											 user_email=:user_email,
											 
											 user_pass=:user_pass,
											 
											 admintype=:admintype,
											 
											 admin=:admin,
											 
											 students=:students,
											 
											 teachers=:teachers,

											 class=:class,
											 
											 subject=:subject,
											 
											 lesson=:lesson,

											 payments=:payments,
											 
											 class_schedule=:class_schedule,
											 
											 mail=:mail,

											 status=:status

								       WHERE user_id=:adid');

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

		$stmt->bindParam(':adid', $id);

		if ($stmt->execute()) {

			$successMSG = "New Admin Users Account Successfully Updated ...";

			header("refresh:2;admin.php"); // redirects image view page after 5 seconds.

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
					<h4>Edit Admin</h4>
				</div>
			</div>
			<div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.php">Home</a></li>
					<li class="breadcrumb-item active"><a href="admin.php">Admin</a></li>
					<li class="breadcrumb-item active"><a href="edit_admin.php">Edit Admin</a></li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-xl-12 col-xxl-12 col-sm-12">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Edit Admin User Account</h5>
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
										<label class="form-label">Username</label>
										<input type="text" class="form-control" name="user_name" value="<?php echo $user_name; ?>" placeholder="Enter Username" required>
									</div>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-12">
									<div class="form-group">
										<label class="form-label">Email</label>
										<input type="email" class="form-control" name="user_email" value="<?php echo $user_email; ?>" placeholder="Enter Email" required>
									</div>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-12">
									<div class="form-group">
										<label class="form-label">Password</label>
										<input type="text" class="form-control" name="user_pass" value="<?php echo $user_pass; ?>" placeholder="Enter Password" required>
									</div>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-12">
									<div class="form-group">
										<label class="form-label">Admin Type</label>
										<select class="form-control" name="admintype" required>
											<option><?php echo $admintype; ?></option>
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
											<option><?php echo $admin; ?></option>
											<option>True</option>
											<option>False</option>
										</select>
									</div>
								</div>
								<div class="col-lg-2 col-md-2 col-sm-12">
									<div class="form-group">
										<label class="form-label">Students</label>
										<select class="form-control" name="students" required>
											<option><?php echo $students; ?></option>
											<option>True</option>
											<option>False</option>
										</select>
									</div>
								</div>
								<div class="col-lg-2 col-md-2 col-sm-12">
									<div class="form-group">
										<label class="form-label">Teacher</label>
										<select class="form-control" name="teachers" required>
											<option><?php echo $teachers; ?></option>
											<option>True</option>
											<option>False</option>
										</select>
									</div>
								</div>
								<div class="col-lg-2 col-md-2 col-sm-12">
									<div class="form-group">
										<label class="form-label">Designation</label>
										<select class="form-control" name="admin" required>
											<option><?php echo $admin; ?></option>
											<option>True</option>
											<option>False</option>
										</select>
									</div>
								</div>
								<div class="col-lg-2 col-md-2 col-sm-12">
									<div class="form-group">
										<label class="form-label">Class</label>
										<select class="form-control" name="class" required>
											<option><?php echo $class; ?></option>
											<option>True</option>
											<option>False</option>
										</select>
									</div>
								</div>
								<div class="col-lg-2 col-md-2 col-sm-12">
									<div class="form-group">
										<label class="form-label">Subject</label>
										<select class="form-control" name="subject" required>
											<option><?php echo $subject; ?></option>
											<option>True</option>
											<option>False</option>
										</select>
									</div>
								</div>
								<div class="col-lg-2 col-md-2 col-sm-12">
									<div class="form-group">
										<label class="form-label">Lesson</label>
										<select class="form-control" name="lesson" required>
											<option><?php echo $lesson; ?></option>
											<option>True</option>
											<option>False</option>
										</select>
									</div>
								</div>
								<div class="col-lg-2 col-md-2 col-sm-12">
									<div class="form-group">
										<label class="form-label">Payments</label>
										<select class="form-control" name="payments" required>
											<option><?php echo $payments; ?></option>
											<option>True</option>
											<option>False</option>
										</select>
									</div>
								</div>
								<div class="col-lg-2 col-md-2 col-sm-12">
									<div class="form-group">
										<label class="form-label">Class Schedule</label>
										<select class="form-control" name="class_schedule" required>
											<option><?php echo $class_schedule; ?></option>
											<option>True</option>
											<option>False</option>
										</select>
									</div>
								</div>
								<div class="col-lg-2 col-md-2 col-sm-12">
									<div class="form-group">
										<label class="form-label">Mail</label>
										<select class="form-control" name="mail" required>
											<option><?php echo $mail; ?></option>
											<option>True</option>
											<option>False</option>
										</select>
									</div>
								</div>
								<div class="col-lg-2 col-md-2 col-sm-12">
									<div class="form-group fallback w-100">
										<label class="form-label">Status</label>
										<select class="form-control" id="input-6" name="status" required>
											<option><?php echo $status; ?></option>
											<option value="1">Publish</option>
											<option value="0">Unpublish</option>
										</select>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12">
									<input type="submit" name="update" class="btn btn-primary" value="Update">
									<a class="btn btn-light" href="admin.php"><i class="fa fa-times"></i> Close</a>
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