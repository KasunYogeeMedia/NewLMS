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

		<h4>Dashboard</h4>
		<hr>

		<table>
			<tbody>
				<tr>
					<td><img src="<?php echo $image_path; ?>" class="pro_pick"></td>
					<td style="padding-left: 20px;">
						<h3><?php echo $user_resalt['fullname']; ?></h3>
						<p style="color: #999999;"><?php echo $user_resalt['qualification']; ?></p>
						<p style="color: #999999;"><?php echo "0" . (int)$user_resalt['contactnumber']; ?></p>
						<p style="color: #999999;">Status:
							<?php if ($user_resalt['status'] == 1) { ?>
								<span class="badge badge-rounded badge-success">Active</span>
							<?php } ?>
							<?php if ($user_resalt['status'] == 0) { ?>
								<span class="badge badge-rounded badge-danger">Deactive</span>
							<?php } ?>
						</p>
						<!--<a href="profile.php"><i class="fa fa-edit"></i> Edit My Profile</a>-->
					</td>
				</tr>
			</tbody>
		</table>
		<hr>
		<div class="row">
			<div class="col-xl-12 col-xxl-12 col-sm-12">
				<div class="row">
					<div class="col-xl-4 col-xxl-4 col-sm-6">
						<div class="widget-stat card bg-success">
							<div class="card-body">
								<div class="media">
									<span class="mr-3">
										<i class="la la-slideshare"></i>
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
						</div>
					</div>
					<div class="col-xl-4 col-xxl-4 col-sm-6">
						<div class="widget-stat card bg-primary">
							<div class="card-body">
								<div class="media">
									<span class="mr-3">
										<i class="la la-book"></i>
									</span>
									<div class="media-body text-white">
										<p class="mb-1">Total Tutes</p>
										<h3 class="text-white"><?php
																$my_tute = mysqli_query($conn, "SELECT * FROM lmsclasstute WHERE tid='$_SESSION[tid]'");
																echo number_format(mysqli_num_rows($my_tute), 0);
																?></h3>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-4 col-xxl-4 col-sm-6">
						<div class="widget-stat card bg-warning">
							<div class="card-body">
								<div class="media">
									<span class="mr-3">
										<i class="la la-play-circle-o"></i>
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
					</div>
					<div class="col-xl-4 col-xxl-4 col-sm-6">
						<div class="widget-stat card bg-secondary">
							<div class="card-body">
								<div class="media">
									<span class="mr-3">
										<i class="la la-black-tie"></i>
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
					</div>
				</div>
			</div>
		</div>

	</div>
</div>

<?php
require_once 'footer.php';
?>