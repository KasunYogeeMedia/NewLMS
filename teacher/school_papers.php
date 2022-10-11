<?php

session_start();

require_once 'includes.php';

require_once '../dashboard/dbconfig4.php';

require_once("../dashboard/conn.php");



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
					<h4>All Uploads</h4>
				</div>
			</div>
			<div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="home.php">Home</a></li>
					<li class="breadcrumb-item active"><a href="javascript:void(0);">Uploads</a></li>
					<li class="breadcrumb-item active"><a href="javascript:void(0);">All Uploads</a></li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<ul class="nav nav-pills mb-3">
					<li class="nav-item"><a href="#list-view" data-toggle="tab" class="btn btn-primary mr-1 show active">List View</a></li>
					<li class="nav-item"><a href="#grid-view" data-toggle="tab" class="btn btn-primary">Grid View</a></li>
				</ul>
			</div>
			<div class="col-lg-12">
				<div class="row tab-content">
					<div id="list-view" class="tab-pane fade active show col-lg-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">All Uploads</h4>
								<a href="add_class_tute.php" class="btn btn-square btn-secondary float-right">+ Add Uploads</a>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example1" class="table table-bordered">
										<thead>
											<tr>
												<th>ID</th>
												<th>Option</th>
												<th>Action</th>
												<th>Topic</th>
												<!-- <th>Student</th> -->
												<th>Medium</th>
												<th>Grade</th>
												
												<th>Class Type</th>
												
												<th>Document</th>
												<th>Date</th>
											</tr>
										</thead>
										<tbody>
											<?php

											$stmt = $DB_con->prepare('SELECT * FROM lmsclasstute_std where tid="' . $_SESSION['tid'] . '" and ctype = "School Papers" ORDER BY ctuid');

											$stmt->execute();

											if ($stmt->rowCount() > 0) {

												while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

													extract($row);

											?>
													<tr>
														<td><?php echo $row['ctuid']; ?></td>
														<td>
															<?php

															if ($row['status'] == "0") {

																echo '<button class="btn btn-primary btn-sm" on>Pending</button>';
															} else if ($row['status'] == "1") {

																echo '<button class="btn btn-success btn-sm">Published</button>';
															}

															?>
														</td>
														<td>
															<a class="btn btn-primary" href="edit_class_tute.php?cttid=<?php echo $row["ctuid"]; ?>">
																<i class="fa fa-edit"></i>
															</a>
															<a class="btn btn-danger" href="delete_class_tute.php?cttid=<?php echo $row["ctuid"]; ?>">
																<i class="fa fa-times-circle"></i>
															</a>
														</td>
														<td><?php echo $row['title']; ?></td>
														<!-- <td>
															<?php

															$id = $row['tid'];

															$query = $DB_con->prepare('SELECT fullname FROM lmstealmsr WHERE tid=' . $id);

															$query->execute();

															$result = $query->fetch();

															echo $result['fullname'];

															?>
														</td> -->
														<td>
															<?php
															$id = $row['class'];
															$query = $DB_con->prepare('SELECT name FROM lmsclass WHERE cid=' . $id);
															$query->execute();
															$result = $query->fetch();
															echo $result['name'];
															?></td>
														<td>
															<?php
															$id = $row['subject'];
															$query = $DB_con->prepare('SELECT name FROM lmssubject WHERE sid=' . $id);
															$query->execute();
															$result = $query->fetch();
															echo $result['name'];
															?>
														</td>
														<td><?php echo $row['ctype']; ?></td>
														
														<td><a href="../dashboard/images/classtute/<?php echo $row['tdocument']; ?>" class="badge badge-primary" target="_blank">View Tute</a></td>
														<td><?php echo $row['add_date']; ?></td>
													</tr>
											<?php }
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
								<?php

								$stmt = $DB_con->prepare('SELECT * FROM lmsclasstute_std ORDER BY ctuid');

								$stmt->execute();

								if ($stmt->rowCount() > 0) {

									while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

										extract($row);

								?>
										<div class="col-lg-4 col-md-6 col-sm-6 col-12">
											<div class="card">
												<div class="card-body">
													<div class="text-center">
														<div class="profile-photo">
															<a class="btn btn-success btn-rounded mt-3 px-4" href="../dashboard/images/classtute/<?php echo $row['tdocument']; ?>" target="_blank">View Tute</a>
														</div>
														<h3 class="mt-4 mb-1"><strong><?php echo $row['title']; ?></strong></h3>
														<p class="text-muted"><strong>Month : <?php echo $row['month']; ?></strong></p>
														<ul class="list-group mb-3 list-group-flush">
															<li class="list-group-item px-0 d-flex justify-content-between">
																<span class="mb-0">Type :</span><strong><?php echo $row['ctype']; ?></strong>
															</li>
															<li class="list-group-item px-0 d-flex justify-content-between">
																<span class="mb-0">Medium :</span><strong>
																	<?php
																	$id = $row['class'];
																	$query = $DB_con->prepare('SELECT name FROM lmsclass WHERE cid=' . $id);
																	$query->execute();
																	$result = $query->fetch();
																	echo $result['name'];
																	?></strong>
															</li>
															<li class="list-group-item px-0 d-flex justify-content-between">
																<span class="mb-0">Class :</span><strong>
																	<?php
																	$id = $row['subject'];
																	$query = $DB_con->prepare('SELECT name FROM lmssubject WHERE sid=' . $id);
																	$query->execute();
																	$result = $query->fetch();
																	echo $result['name'];
																	?></strong>
															</li>
															<!-- <li class="list-group-item px-0 d-flex justify-content-between">
																<span class="mb-0">Student : </span><strong>
																	<?php

																	$id = $row['tid'];

																	$query = $DB_con->prepare('SELECT fullname FROM lmstealmsr WHERE tid=' . $id);

																	$query->execute();

																	$result = $query->fetch();

																	echo $result['fullname'];

																	?></strong>
															</li> -->

															<li class="list-group-item px-0 d-flex justify-content-between">
																<span class="mb-0">Status : </span><strong>
																	<?php

																	if ($row['status'] == "0") {

																		echo '<button class="btn btn-primary btn-sm" on>Pending</button>';
																	} else if ($row['status'] == "1") {

																		echo '<button class="btn btn-success btn-sm">Published</button>';
																	}

																	?></strong>
															</li>
															<li class="list-group-item px-0 d-flex justify-content-between">
																<span class="mb-0">Added Date :</span><strong><?php echo $row['add_date']; ?></strong>
															</li>
														</ul>
														<a class="btn btn-primary btn-rounded mt-3 px-4" href="edit_class_tute.php?cttid=<?php echo $row["ctuid"]; ?>">
															<i class="fa fa-edit"></i>
														</a>
														<a class="btn btn-danger btn-rounded mt-3 px-4" href="delete_class_tute.php?cttid=<?php echo $row["ctuid"]; ?>">
															<i class="fa fa-times-circle"></i>
														</a>
													</div>
												</div>
											</div>
										</div>
								<?php }
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
require_once 'copyright.php';
?>
<?php
require_once 'footer.php';
?>