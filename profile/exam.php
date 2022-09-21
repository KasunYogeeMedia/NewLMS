<?php
session_start();
include '../dashboard/conn.php';
require_once '../dashboard/dbconfig4.php';

$user_qury = mysqli_query($conn, "SELECT * FROM lmsregister WHERE reid='$_SESSION[reid]'");
$user_resalt = mysqli_fetch_array($user_qury);

$image_qury = mysqli_query($conn, "SELECT * FROM lmsregister WHERE reid='$_SESSION[reid]'");
$image_resalt = mysqli_fetch_array($image_qury);

if ($image_resalt['image'] == "") {
	$dis_image_path = "images/hd_dp.jpg";
} else {
	$dis_image_path = "uploadImg/" . $image_resalt['image'];
}

if (isset($_GET['exam_id'])) {
	$_SESSION['exam_id'] = $_GET['exam_id'];
	header("location:exam.php");
}

$ex_qury = mysqli_query($conn, "SELECT *
FROM lms_exam_details ed
WHERE ed.lms_exam_id='$_SESSION[exam_id]'");
$ex_resalt = mysqli_fetch_assoc($ex_qury);

if (!isset($_SESSION['exam_id'])) {
	header("location:exam_list.php");
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
	<div class="sa4d25">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<h4 class="item_title">Exam Details</h4>

					<div class="Time_dis">
						<div id="demo">Time: 0:0:0</div>
						<p>Ends automatically</p>
					</div>
				</div>
			</div>
			<div class="row mb-4">

				<div class="col-sm-12">

					<?php
					$q_count = 0;
					$q_qury = mysqli_query($conn, "SELECT *
FROM lms_mcq_questions mcq
WHERE mcq.exam_id='$_SESSION[exam_id]'");
					while ($q_resalt = mysqli_fetch_assoc($q_qury)) {
						$q_count++;
					?>

						<h3 class="question"><?php echo $q_count; ?>.<br><?php echo $q_resalt['question']; ?></h3>

						<label class="container">A) <?php echo $q_resalt['ans_1']; ?><input type="radio" value="1" name="answer<?php echo $q_count; ?>" onChange="answer_mark('<?php echo $_SESSION['exam_id']; ?>','<?php echo $q_resalt['id']; ?>','1');"> <span class="checkmark"></span></label>
						<label class="container">B) <?php echo $q_resalt['ans_2']; ?><input type="radio" value="1" name="answer<?php echo $q_count; ?>" onChange="answer_mark('<?php echo $_SESSION['exam_id']; ?>','<?php echo $q_resalt['id']; ?>','2');"> <span class="checkmark"></span></label>
						<label class="container">C) <?php echo $q_resalt['ans_3']; ?><input type="radio" value="1" name="answer<?php echo $q_count; ?>" onChange="answer_mark('<?php echo $_SESSION['exam_id']; ?>','<?php echo $q_resalt['id']; ?>','3');"> <span class="checkmark"></span></label>
						<label class="container">D) <?php echo $q_resalt['ans_4']; ?><input type="radio" value="1" name="answer<?php echo $q_count; ?>" onChange="answer_mark('<?php echo $_SESSION['exam_id']; ?>','<?php echo $q_resalt['id']; ?>','4');"> <span class="checkmark"></span></label>

					<?php
					}
					?>
					<a href="results.php" class="btn btn-success submit-btn">Submit</a>

				</div>



			</div>
		</div>
	</div>

	<?php
	require_once 'footer.php';
	?>
</div>
<!-- Body End -->


<script>
	// Set the date we're counting down to
	var countDownDate = new Date("<?php date_default_timezone_set("Asia/Colombo");
									echo date("M d, Y H:i:s", time() + 60 * $ex_resalt['lms_exam_time_duration']); ?>").getTime();

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
			window.location = "results.php";
			//document.getElementById("quiz").submit();
		}
	}, 1000);

	function answer_mark(paper, q, a) {
		console.log(paper + " " + q + " " + a);
		const xhttp = new XMLHttpRequest();
		xhttp.onload = function() {
			//document.getElementById("demo").innerHTML = this.responseText;
		}
		xhttp.open("GET", "ajax_exam_answer_mark.php?paper=" + paper + "&q=" + q + "&a=" + a, true);
		xhttp.send();
	}
</script>

<?php
require_once 'footer.php';
?>