<?php

session_start();

require_once 'includes.php';

require_once("../dashboard/conn.php");

require_once '../dashboard/dbconfig4.php';

if (isset($_SESSION['tid'])) {

	$user_qury = mysqli_query($conn, "SELECT * FROM lmstealmsr WHERE tid='$_SESSION[tid]'");

	$user_resalt = mysqli_fetch_array($user_qury);



	if ($user_resalt['image'] == "") {

		$image_path = "../profile/images/hd_dp.jpg";
	} else {

		$image_path = "../dashboard/images/teacher/" . $user_resalt['image'];
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
	<div class="container-fluid">

		<h4>Student Login</h4>
		<hr>

		<div class="container st_card text-center">
			<div class="text-center">
				<h4>Smart Student</h4>
				<h5><b><?php echo $user_resalt['fullname']; ?></b></h5>
			</div>
			<!-- <table width="100%">
			<tbody>
				<tr>
					<td>
						<img src="<?php echo $image_path; ?>" class="pro_pick">
					</td>
					<td style="padding-left: 20px;">
						<h3><?php echo $user_resalt['fullname']; ?></h3>
						<p style="color: #999999;"><?php echo $user_resalt['school']; ?></p>
						<p style="color: #999999;"><?php echo "0" . (int)$user_resalt['contactnumber']; ?></p>
						<p style="color: #999999;">Status:
							<?php if ($user_resalt['status'] == 1) { ?>
								<span class="badge badge-rounded badge-success">Active</span>
							<?php } ?>
							<?php if ($user_resalt['status'] == 0) { ?>
								<span class="badge badge-rounded badge-danger">Deactive</span>
							<?php } ?>
						</p>
						<a href="profile.php"><i class="fa fa-edit"></i> Edit My Profile</a>
					</td>
				</tr>
			</tbody>
		</table> -->
		</div>
		<hr>
		<div class="row">
			<div class="col-xl-12 col-xxl-12 col-sm-12">
				<div class="row">
					<div class="col-xl-4 col-xxl-4 col-sm-6">
						<div class="widget-stat card bg-dark">
							<a href="add_class_tute.php">
								<div class="card-body">
									<div class="media">
										<span class="mr-3">
											<i class="fa fa-slideshare"></i>
										</span>
										<div class="media-body text-white">
											<p class="mb-1">Upload your notes</p>
											<h3 class="text-white"><?php
																	$my_class = mysqli_query($conn, "SELECT * FROM lmsclass_schlmsle WHERE tealmsr='$_SESSION[tid]'");
																	echo number_format(mysqli_num_rows($my_class), 0);
																	?> </h3>
										</div>
									</div>
								</div>
							</a>
						</div>
					</div>
					<!-- <div class="col-xl-4 col-xxl-4 col-sm-6">
						<div class="widget-stat card bg-success">
							<a href="">
								<div class="card-body">
									<div class="media">
										<span class="mr-3">
											<i class="fa fa-slideshare"></i>
										</span>
										<div class="media-body text-white">
											<p class="mb-1">Total Classes</p>
											<h3 class="text-white"><?php
																	$my_class = mysqli_query($conn, "SELECT * FROM lmsclass_schlmsle WHERE tealmsr='$_SESSION[tid]'");
																	echo number_format(mysqli_num_rows($my_class), 0);
																	?> </h3>
										</div>
									</div>
								</div>
							</a>
						</div>
					</div> -->
					<div class="col-xl-4 col-xxl-4 col-sm-6">
						<div class="widget-stat card bg-primary">
							<a href="add_class_tute.php">
								<div class="card-body">
									<div class="media">
										<span class="mr-3">
											<i class="fa fa-book"></i>
										</span>
										<div class="media-body text-white">
											<p class="mb-1">Upload your School Papers</p>
											<h3 class="text-white"><?php
																	$my_tute = mysqli_query($conn, "SELECT * FROM lmsclasstute WHERE tid='$_SESSION[tid]'");
																	echo number_format(mysqli_num_rows($my_tute), 0);
																	?></h3>
										</div>
									</div>
								</div>
							</a>
						</div>
					</div>
					<div class="col-xl-4 col-xxl-4 col-sm-6">
						<div class="widget-stat card bg-primary">
							<a href="add_class_tute.php">
								<div class="card-body">
									<div class="media">
										<span class="mr-3">
											<i class="fa fa-book"></i>
										</span>
										<div class="media-body text-white">
											<p class="mb-1">Upload your Class Papers</p>
											<h3 class="text-white"><?php
																	$my_tute = mysqli_query($conn, "SELECT * FROM lmsclasstute WHERE tid='$_SESSION[tid]'");
																	echo number_format(mysqli_num_rows($my_tute), 0);
																	?></h3>
										</div>
									</div>
								</div>
							</a>
						</div>
					</div>

					<!-- <div class="col-xl-4 col-xxl-4 col-sm-6">
						<div class="widget-stat card bg-warning">
							<div class="card-body">
								<div class="media">
									<span class="mr-3">
										<i class="fa fa-play-circle-o"></i>
									</span>
									<div class="media-body text-white">
										<p class="mb-1">Total Videos</p>
										<h3 class="text-white"><?php
																$my_videos = mysqli_query($conn, "SELECT * FROM lmslesson WHERE tid='$_SESSION[tid]'");
																echo number_format(mysqli_num_rows($my_videos), 0);
																?></h3>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<!-- <div class="col-xl-4 col-xxl-4 col-sm-6">
						<div class="widget-stat card bg-secondary">
							<div class="card-body">
								<div class="media">
									<span class="mr-3">
										<i class="fa fa-black-tie"></i>
									</span>
									<div class="media-body text-white">
										<p class="mb-1">Total Student</p>
										<h3 class="text-white"><?php
																$student_count = mysqli_query($conn, "SELECT COUNT(feeID) count
																	FROM lmspayment
																	WHERE feeID='$_SESSION[tid]'
																	GROUP BY feeID");
																$student_resalt = mysqli_fetch_assoc($student_count);
																echo $student_resalt['count'];
																?></h3>
									</div>
								</div>
							</div>
						</div>
					</div> -->
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-xl-6 col-xxl-6 col-sm-6">
					<div class="widget-stat card bg-dark">
						<a href="">
							<div class="card-body">
								<div class="media">
									<img class="img-fluid mx-auto" src="../dist/img/abiman_sir.jpg" alt="">
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-xl-6 col-xxl-6 col-sm-6">
					<div class="widget-stat card bg-dark">
						<a href="">
							<div class="card-body">
								<div class="media">
									<img src="<?php echo $image_path; ?>" class="img-fluid mx-auto">
								</div>
							</div>
						</a>
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