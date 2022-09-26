<?php
session_start();
require_once '../dashboard/dbconfig4.php';
require_once("../dashboard/config.php");
include '../dashboard/conn.php';
if (!isset($_SESSION['reid'])) {
	header('location:../login.php');
	die();
}
$user_qury = mysqli_query($conn, "SELECT * FROM lmsregister INNER JOIN lmsclass ON lmsregister.level=lmsclass.cid WHERE reid='$_SESSION[reid]'");
$user_resalt = mysqli_fetch_array($user_qury);

$image_qury = mysqli_query($conn, "SELECT * FROM lmsregister WHERE reid='$_SESSION[reid]'");
$image_resalt = mysqli_fetch_array($image_qury);

if ($image_resalt['image'] == "") {
	$dis_image_path = "images/hd_dp.jpg";
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
<!-- Body Start -->
<div class="content-wrapper">
	<div class="sa4d25">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<h4 class="item_title">Watch Your Video Lesson</h4>
					<a href="paid_lesson.php" class="see150">See all</a>
				</div>
				<div class="col-xl-12 col-lg-12">
					<div class="section3125">
						<?php
						if (isset($_GET['video'])) {
							$stmt = $DB_con->prepare("SELECT * FROM lmslesson where lid='" . $_GET['video'] . "' and type='Free' and status='1' order by lid ASC");

							$stmt->execute();

							if ($stmt->rowCount() > 0) {

								while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

									extract($row);

						?>
									<div class="live1452">
										<div style="padding:0 0 0 0;position:relative;">

											<a href="<?php echo $row['video']; ?>" target="_blank" class="btn btn-success">Watch Now</a>

										</div>
									</div>
									<div class="user_dt5">
										<div class="user_dt_left">
											<div class="live_user_dt">
												<div class="user_img5">
													<img src="images/hd_dp.jpg" class="pro_pick">
												</div>
												<div class="user_cntnt">
													<h4><?php

														$id = $row['tid'];

														$query = $DB_con->prepare('SELECT fullname FROM lmstealmsr WHERE tid=' . $id);

														$query->execute();

														$result = $query->fetch();

														echo $result['fullname'];

														?></h4>
													<button class="subscribe-btn"><?php

																					$id = $row['tid'];

																					$query = $DB_con->prepare('SELECT subdetails FROM lmstealmsr WHERE tid=' . $id);

																					$query->execute();

																					$result = $query->fetch();

																					echo $result['subdetails'];

																					?></button>
												</div>
											</div>
										</div>
									</div>
						<?php
								}
							}
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php
	require_once 'footer.php';
	?>
</div>
<!-- Body End -->

<!-- Demo ads. Please ignore and remove. -->
<script src="http://cdn.tutorialzine.com/misc/enhance/v3.js" async></script>
<script src="js/script.js"></script>
<script type="text/jscript">
	function disableContextMenu() {
		window.frames["video"].document.oncontextmenu = function() {
			alert("No way!");
			return false;
		};
		// Or use this
		// document.getElementById("fraDisabled").contentWindow.document.oncontextmenu = function(){alert("No way!"); return false;};;    
	}
</script>
<script type="text/javascript">
	// https://developers.google.com/youtube/iframe_api_reference

	// global variable for the player
	var player;

	// this function gets called when API is ready to use
	function onYouTubePlayerAPIReady() {
		// create the global player from the specific iframe (#video)
		player = new YT.Player("video", {
			events: {
				// call this function when player is ready to use
				onReady: onPlayerReady
			}
		});
	}

	function onPlayerReady(event) {
		// bind events
		var playButton = document.getElementById("play-button");
		playButton.addEventListener("click", function() {
			player.playVideo();
		});

		var pauseButton = document.getElementById("pause-button");
		pauseButton.addEventListener("click", function() {
			player.pauseVideo();
		});
	}

	// Inject YouTube API script
	var tag = document.createElement("script");
	tag.src = "//www.youtube.com/player_api";
	var firstScriptTag = document.getElementsByTagName("script")[0];
	firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
	new YouTubeToHtml5();
</script>

<?php
require_once 'copyright.php';
?>
<?php
require_once 'footer.php';
?>