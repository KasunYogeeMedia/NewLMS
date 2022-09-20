<?php

session_start();

require_once 'includes.php';

require_once 'conn.php';

require_once 'dbconfig4.php';

if (isset($_GET['delete'])) {
	$delete = mysqli_real_escape_string($conn, $_GET['delete']);
	mysqli_query($conn, "DELETE FROM lmstealmsr WHERE tid='$delete'");
	echo "<script>window.location='teachers.php';</script>";
}

if (isset($_GET['status']) && isset($_GET['type'])) {
	$status = mysqli_real_escape_string($conn, $_GET['status']);
	$type = mysqli_real_escape_string($conn, $_GET['type']);

	if ($type == 1) {
		$update = 0;
	}
	if ($type == 0) {
		$update = 1;
	}

	mysqli_query($conn, "UPDATE lmstealmsr SET status='$update' WHERE tid='$status'");

	echo "<script>window.location='teachers.php';</script>";
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
				<div class="welcome-text mt-2">
					<h4>All Students</h4>
				</div>
			</div>
			<div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="home.php">Home</a></li>
					<li class="breadcrumb-item active"><a href="javascript:void(0);">Students</a></li>
					<li class="breadcrumb-item active"><a href="javascript:void(0);">All Students</a></li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<ul class="nav nav-pills mb-3">
					<li class="nav-item"><a href="#list-view" data-toggle="tab" class="btn btn-primary mr-2 show active">List View</a></li>
					<li class="nav-item"><a href="#grid-view" data-toggle="tab" class="btn btn-secondary">Grid View</a></li>
				</ul>
			</div>
			<div class="col-lg-12">
				<div class="row tab-content">
					<div id="list-view" class="tab-pane fade active show col-lg-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">All Students </h4>
								<div class="text-right">
									<a href="add_teacher.php" class="btn btn-square btn-dark">+ Add Student</a>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example3" class="table table-bordered">
										<thead>
											<tr>
												<th>#</th>
												<th>Profile</th>
												<th>Action</th>
												<th>Status</th>
												<th>Name</th>
												<th>Medium</th>
												<th>Grade</th>
												<th>Phone</th>
												<th>Parent Phone</th>
												<th>School</th>
												<th>District</td>
												<th>Town</th>
												<th>Birthday</th>
												<th>Email</th>
												<th>Gender</th>
												<th>Date of joining the class</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$count = 0;
											$tec_qury = mysqli_query($conn, "SELECT * FROM lmstealmsr ORDER BY fullname");
											while ($tec_resalt = mysqli_fetch_array($tec_qury)) {
												$count++;
											?>
												<tr>
													<td><?php echo number_format($count, 0); ?></td>
													<td><?php if ($tec_resalt['image'] == "") {
															$pro_img = "../profile/images/hd_dp.jpg";
														} else {
															$pro_img = "images/teacher/" . $tec_resalt['image'];
														} ?><img src="<?php echo $pro_img; ?>" class="pro_pick"></td>
													<td style="white-space: nowrap">
														<a href="edit_teacher.php?edit=<?php echo $tec_resalt['tid']; ?>" title="Edit" class="btn btn-sm btn-primary" style="margin-right: 5px;"><i class="fa fa-pen"></i></a>
														<a href="teachers.php?status=<?php echo $tec_resalt['tid']; ?>&type=<?php echo $tec_resalt['status']; ?>" title="Status Change" style="margin-right: 5px;" onClick="JavaScript:return confirm('Are you sure change this status?');" class="btn btn-sm btn-secondary"><i class="fa fa-lg fa-cogs" style="color: darkblue;"></i></a>
														<a href="teachers.php?delete=<?php echo $tec_resalt['tid']; ?>" title="Delete" onClick="JavaScript:return confirm('Are you sure delete this student?');" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
													</td>
													<td align="center">
														<?php
														if ($tec_resalt['status'] == 1) {
														?>
															<span class="btn btn-success btn-sm">Active</span>
														<?php
														}
														if ($tec_resalt['status'] == 0) {
														?>
															<span class="btn btn-primary btn-sm">Deactive</span>
														<?php
														}
														?>
													</td>
													<td style="text-transform: capitalize;"><?php echo $tec_resalt['fullname']; ?></td>
													<td>
														<?php
														$level_array = array();
														$level_qury = mysqli_query($conn, "SELECT * FROM lmstealmsr_multiple INNER JOIN lmsclass ON lmstealmsr_multiple.tealmsr_contain_id=lmsclass.cid WHERE tealmsr_system_id='$tec_resalt[systemid]' and tealmsr_type='2'");
														while ($level_resalt = mysqli_fetch_array($level_qury)) {
															array_push($level_array, "" . $level_resalt['name']);
														}
														echo join("<br>", $level_array);
														?>
													</td>
													<td>
														<?php
														$subject_array = array();
														$subject_qury = mysqli_query($conn, "SELECT * FROM lmstealmsr_multiple INNER JOIN lmssubject ON lmstealmsr_multiple.tealmsr_contain_id=lmssubject.sid WHERE tealmsr_system_id='$tec_resalt[systemid]' and tealmsr_type='3'");
														while ($subject_resalt = mysqli_fetch_array($subject_qury)) {
															array_push($subject_array, "" . $subject_resalt['name']);
														}
														echo join("<br>", $subject_array);
														?>
													</td>
													<td><?php echo "0" . (int)$tec_resalt['contactnumber']; ?></td>
													<td><?php echo $tec_resalt['pcontactno']; ?></td>
													<td><?php echo $tec_resalt['school']; ?></td>
													<td><?php echo $tec_resalt['district']; ?></td>
													<td><?php echo $tec_resalt['town']; ?></td>
													<td><?php echo $tec_resalt['birthday']; ?></td>
													<td><?php echo $tec_resalt['username']; ?></td>
													<td><?php echo $tec_resalt['gender']; ?></td>
													<td><?php echo $tec_resalt['joindate']; ?></td>

												</tr>
											<?php
											}
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div id="grid-view" class="tab-pane fade col-lg-12">
						<div class="row">
							<tbody>
							<tbody>
								<?php
								$count = 0;
								$tec_qury = mysqli_query($conn, "SELECT * FROM lmstealmsr ORDER BY fullname");
								while ($tec_resalt = mysqli_fetch_array($tec_qury)) {
									$count++;
								?>
									<div class="col-lg-4 col-md-6 col-sm-6 col-12">
										<div class="card">
											<div class="card-body">
												<div class="text-center">
													<div class="profile-photo">
														<?php if ($tec_resalt['image'] == "") {
															$pro_img = "../profile/images/hd_dp.jpg";
														} else {
															$pro_img = "images/teacher/" . $tec_resalt['image'];
														} ?><img src="<?php echo $pro_img; ?>" class="pro_pick">
													</div>
													<h3 class="mt-4 mb-1"><strong><?php echo $tec_resalt['fullname']; ?></strong></h3>
													<p class="text-muted"><strong>AL Year : <?php
																							$level_array = array();
																							$level_qury = mysqli_query($conn, "SELECT * FROM lmstealmsr_multiple INNER JOIN lmsclass ON lmstealmsr_multiple.tealmsr_contain_id=lmsclass.cid WHERE tealmsr_system_id='$tec_resalt[systemid]' and tealmsr_type='2'");
																							while ($level_resalt = mysqli_fetch_array($level_qury)) {
																								array_push($level_array, "• " . $level_resalt['name']);
																							}
																							echo join("<br>", $level_array);
																							?></strong></p>
													<p class="text-muted"><strong>Class : <?php
																							$subject_array = array();
																							$subject_qury = mysqli_query($conn, "SELECT * FROM lmstealmsr_multiple INNER JOIN lmssubject ON lmstealmsr_multiple.tealmsr_contain_id=lmssubject.sid WHERE tealmsr_system_id='$tec_resalt[systemid]' and tealmsr_type='3'");
																							while ($subject_resalt = mysqli_fetch_array($subject_qury)) {
																								array_push($subject_array, "• " . $subject_resalt['name']);
																							}
																							echo join("<br>", $subject_array);
																							?></strong></p>
													<hr>
													<p class="text-muted"><strong>school : <?php echo $tec_resalt['school']; ?></strong></p>
													<ul class="list-group mb-3 list-group-flush">
														<li class="list-group-item px-0 d-flex justify-content-between">
															<span class="mb-0">User : </span><strong><?php echo $tec_resalt['username']; ?></strong>
														</li>
														<li class="list-group-item px-0 d-flex justify-content-between">
															<span class="mb-0">Contact No : </span><strong><?php echo "0" . (int)$tec_resalt['contactnumber']; ?></strong>
														</li>
														<li class="list-group-item px-0 d-flex justify-content-between">
															<span class="mb-0">Status : </span><strong>
																<?php
																if ($tec_resalt['status'] == 1) {
																?>
																	<span class="btn btn-success btn-sm">Active</span>
																<?php
																}
																if ($tec_resalt['status'] == 0) {
																?>
																	<span class="btn btn-primary btn-sm">Deactive</span>
																<?php
																}
																?></strong>
														</li>

													</ul>
													<a href="edit_teacher.php?edit=<?php echo $tec_resalt['tid']; ?>" title="Edit" class="btn btn-primary btn-rounded mt-3 px-4"><i class="fa fa-pen"></i></a>
													<a href="teachers.php?status=<?php echo $tec_resalt['tid']; ?>&type=<?php echo $tec_resalt['status']; ?>" title="Status Change" class="btn btn-success btn-rounded mt-3 px-4" onClick="JavaScript:return confirm('Are you sure change this status?');" class="btn btn-sm btn-secondary"><i class="fa fa-lg fa-cogs" style="color: darkblue;"></i></a>
													<a href="teachers.php?delete=<?php echo $tec_resalt['tid']; ?>" title="Delete" class="btn btn-danger btn-rounded mt-3 px-4" onClick="JavaScript:return confirm('Are you sure delete this student?');"><i class="fa fa-trash"></i></a>

												</div>
											</div>
										</div>
									</div>
								<?php
								}
								?>
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