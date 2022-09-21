<?php

session_start();

require_once 'includes.php';

require_once '../dashboard/conn.php';

require_once("../dashboard/config.php");

require_once '../dashboard/dbconfig4.php';

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

date_default_timezone_set("Asia/Colombo");

if (isset($_GET['lms_exam_system_id'])) {
	$lms_exam_system_id = mysqli_real_escape_string($conn, $_GET['lms_exam_system_id']);
}

if (isset($_POST['update_bt'])) {
	$edit = mysqli_real_escape_string($conn, $_GET['edit']);
	$lms_question = mysqli_real_escape_string($conn, $_POST['lms_question']);
	$lms_answer1 = mysqli_real_escape_string($conn, $_POST['lms_answer1']);
	$lms_answer2 = mysqli_real_escape_string($conn, $_POST['lms_answer2']);
	$lms_answer3 = mysqli_real_escape_string($conn, $_POST['lms_answer3']);
	$lms_answer4 = mysqli_real_escape_string($conn, $_POST['lms_answer4']);
	$lms_answer_correct = mysqli_real_escape_string($conn, $_POST['lms_answer_correct']);
	if (mysqli_query($conn, "UPDATE lms_question_answer SET lms_question='$lms_question',lms_answer1='$lms_answer1',lms_answer2='$lms_answer2',lms_answer3='$lms_answer3',lms_answer4='$lms_answer4',lms_answer_correct='$lms_answer_correct' WHERE lms_question_answer_id='$edit'")) {
		echo "<script>window.location='add_question.php?update&lms_exam_system_id=$lms_exam_system_id';</script>";
	} else {
		echo "<script>window.location='add_question.php?update_fail&lms_exam_system_id=$lms_exam_system_id';</script>";
	}
}

if (isset($_POST['add_bt'])) {
	$lms_question_answer_time = date("Y-m-d H:i:s");
	$lms_question = mysqli_real_escape_string($conn, $_POST['lms_question']);
	$lms_answer1 = mysqli_real_escape_string($conn, $_POST['lms_answer1']);
	$lms_answer2 = mysqli_real_escape_string($conn, $_POST['lms_answer2']);
	$lms_answer3 = mysqli_real_escape_string($conn, $_POST['lms_answer3']);
	$lms_answer4 = mysqli_real_escape_string($conn, $_POST['lms_answer4']);
	$lms_answer_correct = mysqli_real_escape_string($conn, $_POST['lms_answer_correct']);

	if (mysqli_query($conn, "INSERT INTO lms_question_answer(lms_question_answer_examid, lms_question, lms_answer1, lms_answer2, lms_answer3, lms_answer4, lms_answer_correct, lms_question_answer_time) VALUES ('$lms_exam_system_id','$lms_question','$lms_answer1','$lms_answer2','$lms_answer3','$lms_answer4','$lms_answer_correct','$lms_question_answer_time')")) {
		echo "<script>window.location='add_question.php?success&lms_exam_system_id=$lms_exam_system_id';</script>";
	} else {
		echo "<script>window.location='add_question.php?fail&lms_exam_system_id=$lms_exam_system_id';</script>";
	}
}

if (isset($_GET['remove'])) {
	$remove = mysqli_real_escape_string($conn, $_GET['remove']);
	mysqli_query($conn, "DELETE FROM lms_question_answer WHERE lms_question_answer_id='$remove'");
	echo "<script>window.location='add_question.php?removed&lms_exam_system_id=$lms_exam_system_id';</script>";
}

if (isset($_GET['edit'])) {
	$edit = mysqli_real_escape_string($conn, $_GET['edit']);
	$edit_qury = mysqli_query($conn, "SELECT * FROM lms_question_answer WHERE lms_question_answer_id='$edit'");
	$edit_resalt = mysqli_fetch_array($edit_qury);
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
					<h4>Add Question</h4>
				</div>
			</div>
			<div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.php">Home</a></li>
					<li class="breadcrumb-item"><a href="javascript:void(0);">Add Question</a></li>
					<li class="breadcrumb-item active"><a href="javascript:void(0);">Add Question</a></li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Add Question | <?php echo $lms_exam_system_id; ?></h4>
					</div>
					<div class="card-body">
						<?php if (isset($_GET['update'])) { ?>
							<div class="alert alert-success alert-dismissible alert-alt solid fade show">
								<button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
								<strong>Success!</strong> Exam Details Updated Successfully..
							</div>
						<?php

						}

						?>

						<?php if (isset($_GET['success'])) { ?><div class="alert alert-success alert-dismissible alert-alt solid fade show">
								<button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
								<strong>Success!</strong> New Question Added Successfully.
							</div><?php } ?>
						<?php if (isset($_GET['removed'])) { ?><div class="alert alert-danger alert-dismissible alert-alt solid fade show">
								<button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
								<strong>Success!</strong> Question Removed Successfully.
							</div><?php } ?>
						<?php if (isset($_GET['update'])) { ?><div class="alert alert-primary alert-dismissible alert-alt solid fade show">
								<button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
								<strong>Success!</strong> Question Updated Successfully.
							</div><?php } ?>
						<form method="post" autocomplete="off">
							<div class="row">
								<div class="col-lg-3 col-md-3 col-sm-12">
									<div class="form-group">
										<label class="form-label">Question</label>
										<input name="lms_question" type="text" class="form-control" id="" required value="<?php if (isset($_GET['edit'])) {
																																echo $edit_resalt['lms_question'];
																															} ?>">
									</div>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-12">
									<div class="form-group">
										<label class="form-label">Subject</label>
										<select name="lms_exam_subject" id="" class="form-control" required>
											<option value="<?php if (isset($_GET['lms_exam_id'])) {
																echo $edit_resalt['lms_exam_subject'];
															} ?>" hidden="lms"><?php if (isset($_GET['lms_exam_id'])) {
																																								echo $edit_resalt['name'] . " - " . $edit_resalt['course'] . " - " . $edit_resalt['class'];
																																							} else {
																																								echo "Choose...";
																																							} ?></option>
											<?php
											$sub_qury = mysqli_query($conn, "SELECT * FROM lmssubject ORDER BY name");
											while ($sub_resalt = mysqli_fetch_array($sub_qury)) {
											?>
												<option value="<?php echo $sub_resalt['sid']; ?>"><?php echo $sub_resalt['name']; ?>-<?php $id = $sub_resalt['class_id'];
																																		$query = $DB_con->prepare('SELECT name FROM lmsclass WHERE cid=' . $id);
																																		$query->execute();
																																		$result = $query->fetch();
																																		echo $result['name'];						?></option>
											<?php
											}
											?>
										</select>
									</div>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-12">
									<div class="form-group">
										<label class="form-label">Time Duration (Enter in minutes)</label>
										<input name="lms_exam_time_duration" type="text" class="form-control" pattern="\d*" value="<?php if (isset($_GET['lms_exam_id'])) {
																																		echo $edit_resalt['lms_exam_time_duration'];
																																	} ?>" required>
									</div>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-12">
									<div class="form-group">
										<label class="form-label">Questions Per Paper</label>
										<input name="lms_exam_question" type="text" class="form-control" pattern="\d*" value="<?php if (isset($_GET['lms_exam_id'])) {
																																	echo $edit_resalt['lms_exam_question'];
																																} ?>" required>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12">
									<button name="<?php if (isset($_GET['lms_exam_id'])) {
														echo "update_bt";
													} else {
														echo "add_bt";
													} ?>" type="submit" class="btn btn-primary"><?php if (isset($_GET['lms_exam_id'])) {
																																												echo "Update Exam";
																																											} else {
																																												echo "Add Exam";
																																											} ?></button>
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
require_once 'footer.php';
?>
