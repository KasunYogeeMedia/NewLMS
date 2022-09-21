<?php
session_start();
include '../dashboard/conn.php';
require_once '../dashboard/dbconfig4.php';

//print_r($_POST);

if (isset($_GET['exam_id'])) {

	$exam_id = $_GET['exam_id'];

	$sql = "SELECT * FROM sft_exam_details WHERE sft_exam_id = :id";
	$query = $DB_con->prepare($sql);
	$query->bindParam('id', $exam_id);
	$query->execute();


	if ($query->rowCount() == 0) {
		die();
	}

	$result = $query->fetch();

	$exam_name = $result[3];
	$exam_time_duration = $result[6];


	$sql = "SELECT * FROM sft_mcq_questions WHERE exam_id = :exam_id";
	$query = $DB_con->prepare($sql);
	$query->bindParam('exam_id', $exam_id);
	$query->execute();

	$result = $query->fetchAll();

	//print_r($edit_result);
} else {
	//die();
}




$user_qury = mysqli_query($conn, "SELECT * FROM sftregister WHERE reid='$_SESSION[reid]'");
$user_resalt = mysqli_fetch_array($user_qury);

$image_qury = mysqli_query($conn, "SELECT * FROM sftregister WHERE reid='$_SESSION[reid]'");
$image_resalt = mysqli_fetch_array($image_qury);

if ($image_resalt['image'] == "") {
	$dis_image_path = "img/pro_pick.png";
} else {
	$dis_image_path = "uploadImg/" . $image_resalt['image'];
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

<!--Main container start -->
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="db-breadcrumb">
			<h4 class="breadcrumb-title">Exam Details</h4>
			<ul class="db-breadcrumb-list">
				<li><a href="student_profile.php"><i class="fa fa-home"></i>Home</a></li>
				<li>Exam</li>
			</ul>
		</div>

		<div class="row">

			<div class="col-sm-12">
				<form id="quiz" action="results.php" method="POST">
					<?php
					$q_number = 1;
					foreach ($result as $question) {

					?>

						<h3 class="question"><?php echo $q_number; ?>) <?php echo $question[2]; ?></h3>
						<label class="container">A) <?php echo $question[3] ?>
							<input type="radio" value="1" name="q-<?php echo $question[0]; ?>-ans">
							<span class="checkmark"></span>
						</label>
						<label class="container">B) <?php echo $question[4] ?>
							<input type="radio" value="2" name="q-<?php echo $question[0]; ?>-ans">
							<span class="checkmark"></span>
						</label>
						<label class="container">C) <?php echo $question[5] ?>
							<input type="radio" value="3" name="q-<?php echo $question[0]; ?>-ans">
							<span class="checkmark"></span>
						</label>
						<label class="container">D) <?php echo $question[6] ?>
							<input type="radio" value="4" name="q-<?php echo $question[0]; ?>-ans">
							<span class="checkmark"></span>
						</label>

					<?php
						$q_number++;
					}
					?>

					<input type="hidden" name="exam_id" value="<?php echo $exam_id; ?>">
					<input type="submit" name="submit" class="btn btn-success submit-btn" value="Submit">
				</form>

			</div>

			<div class="col-sm-4">
				<div class="Time_dis">
					<div id="demo">Time: 0:0:0</div>
					<p>Ends automatically</p>
				</div>

			</div>

		</div>

	</div>
</div>

<script>
	// Set the date we're counting down to
	var countDownDate = new Date("<?php date_default_timezone_set("Asia/Colombo");
									echo date("M d, Y H:i:s", time() + 60 * $exam_time_duration); ?>").getTime();

	// Update the count down every 1 second
	var x = setInterval(function() {

		// Get today's date and time
		var now = new Date().getTime();

		// Find the distance between now and the count down date
		var distance = countDownDate - now;

		// Time calculations for days, hours, minutes and seconds
		var days = Math.floor(distance / (1000 * 60 * 60 * 24));
		var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		var seconds = Math.floor((distance % (1000 * 60)) / 1000);

		// Display the result in the element with id="demo"
		document.getElementById("demo").innerHTML = "Time: " + hours + ":" +
			minutes + ":" + seconds;

		// If the count down is finithed, write some text
		if (distance < 0) {
			clearInterval(x);
			document.getElementById("demo").innerHTML = "Time: 0:0:0";
			//window.location="results.php";
			document.getElementById("quiz").submit();
		}
	}, 1000);
</script>

<?php
require_once 'footer.php';
?>