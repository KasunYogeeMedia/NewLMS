<?php

session_start();

require_once 'includes.php';

require_once 'dbconfig4.php';

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
					<h4>All Reviews</h4>
				</div>
			</div>
			<div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="home.php">Home</a></li>
					<li class="breadcrumb-item active"><a href="javascript:void(0);">Reviews</a></li>
					<li class="breadcrumb-item active"><a href="javascript:void(0);">All Reviews</a></li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<ul class="nav nav-pills mb-3">
					<li class="nav-item"><a href="#list-view" data-toggle="tab" class="nav-link btn btn-square btn-secondary float-right mr-1 show active">List View</a></li>
				</ul>
			</div>
			<div class="col-lg-12">
				<div class="row tab-content">
					<div id="list-view" class="tab-pane fade active show col-lg-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">All Reviews</h4>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example3" class="table table-bordered">
										<thead>
											<tr>
												<th>ID</th>
												<th>Action</th>
												<th>Option</th>
												<th>Student</th>
												<th>Teacher name</th>
												<th>Title</th>
												<th>Rate</th>
												<th>Review</th>
												<th>Date</th>
											</tr>
										</thead>
										<tbody>
											<?php

											$stmt = $DB_con->prepare('SELECT * FROM lmscomments ORDER BY id');

											$stmt->execute();

											if ($stmt->rowCount() > 0) {

												while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

													extract($row);

											?>
													<tr>
														<td><?php echo $row['id']; ?></td>
														<td>
															<a class="btn btn-danger" href="delete_review.php?rrid=<?php echo $row["id"]; ?>">
																<i class="fa fa-times-circle"></i>
															</a>
														</td>
														<td><?php

															if ($row['status'] == "0") {

																echo '<button class="btn btn-primary btn-sm" on>Pending</button>';
															} else if ($row['status'] == "1") {

																echo '<button class="btn btn-success btn-sm">Success</button>';
															}

															?></td>
														<td>
															<img src="../profile/uploadImg/<?php

																							$id = $row['uid'];

																							$query = $DB_con->prepare('SELECT image FROM lmsregister WHERE reid=' . $id);

																							$query->execute();

																							$result = $query->fetch();

																							echo $result['image'];

																							?>" alt="" id="dis_image" style="width: 32px; height: 32px; border-radius: 100%; cursor: pointer; object-fit: cover; background-position: center;" />


															<?php

															$id = $row['uid'];

															$query = $DB_con->prepare('SELECT fullname FROM lmsregister WHERE reid=' . $id);

															$query->execute();

															$result = $query->fetch();

															echo $result['fullname'];

															?>
														</td>
														<td>
															<img src="images/teacher/<?php

																						$id = $row['tealmsr'];

																						$query = $DB_con->prepare('SELECT image FROM lmstealmsr WHERE tid=' . $id);

																						$query->execute();

																						$result = $query->fetch();

																						echo $result['image'];

																						?>" alt="" id="dis_image" style="width: 32px; height: 32px; border-radius: 100%; cursor: pointer; object-fit: cover; background-position: center;" />

															<?php

															$id = $row['tealmsr'];

															$query = $DB_con->prepare('SELECT fullname FROM lmstealmsr WHERE tid=' . $id);

															$query->execute();

															$result = $query->fetch();

															echo $result['fullname'];

															?>
														</td>
														<td><?php echo $row['title']; ?></td>
														<td>
															<h5 style="font-weight:bold;color:orange;">
																<?php

																if ($row['rate'] == "1") {

																	echo '<i class="ti-star active"></i>';
																} else if ($row['rate'] == "2") {

																	echo '<i class="ti-star active"></i><i class="ti-star active"></i>';
																} else if ($row['rate'] == "3") {

																	echo '<i class="ti-star active"></i><i class="ti-star active"></i><i class="ti-star active"></i>';
																} else if ($row['rate'] == "4") {

																	echo '<i class="ti-star active"></i><i class="ti-star active"></i><i class="ti-star active"></i><i class="ti-star active"></i>';
																} else if ($row['rate'] == "5") {

																	echo '<i class="ti-star active"></i><i class="ti-star active"></i><i class="ti-star active"></i><i class="ti-star active"></i><i class="ti-star"></i>';
																}

																?>
															</h5>
														</td>
														<td>"<?php echo $row['review']; ?>"</td>
														<td><?php echo $row['add_date']; ?></td>
													</tr>
											<?php
												}
											}
											?>
										</tbody>
									</table>
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
require_once 'copyright.php';
?>
<?php
require_once 'footer.php';
?>