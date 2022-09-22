<?php

session_start();

require_once 'includes.php';

require_once 'conn.php';

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
					<h4>All Gallery</h4>
				</div>
			</div>
			<div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="home.php">Home</a></li>
					<li class="breadcrumb-item active"><a href="javascript:void(0);">Gallery</a></li>
					<li class="breadcrumb-item active"><a href="javascript:void(0);">All Gallery</a></li>
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
								<h4 class="card-title">All Gallery</h4>
								<a href="add_gallery.php" class="btn btn-square btn-secondary float-right">+ Add Gallery</a>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example3" class="table table-bordered">
										<thead>
											<tr>
												<th>ID</th>
												<th>Image</th>
												<th>Date</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php

											$stmt = $DB_con->prepare('SELECT * FROM lmsgallery ORDER BY id');

											$stmt->execute();

											if ($stmt->rowCount() > 0) {

												while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

													extract($row);

											?>
													<tr>
														<td><?php echo $row['id']; ?></td>
														<td><img src="images/gallery/<?php echo $row['image']; ?>" alt="" width="100" height="60"></td>
														<td><?php echo $row['add_date']; ?></td>
														<td><span class="badge badge-success"><?php echo $row['status']; ?></span></td>
														<td><a class="btn btn-primary" href="edit_gallery.php?glid=<?php echo $row["id"]; ?>">
																<i class="fa fa-edit"></i>
															</a>
															<a class="btn btn-danger" href="delete_gallery.php?glid=<?php echo $row["id"]; ?>">
																<i class="fa fa-times-circle"></i>
															</a>
														</td>
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
					<div id="grid-view" class="tab-pane fade col-lg-12">
						<div class="row">
							<tbody>
								<?php

								$stmt = $DB_con->prepare('SELECT * FROM lmsgallery ORDER BY id');

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
															<img src="images/gallery/<?php echo $row['image']; ?>" width="100%" height="250">
														</div>
														<ul class="list-group mb-3 list-group-flush">
															<li class="list-group-item px-0 d-flex justify-content-between">
																<span class="mb-0">Status : </span><strong><span class="badge badge-success"><?php echo $row['status']; ?></span></strong>
															</li>
															<li class="list-group-item px-0 d-flex justify-content-between">
																<span class="mb-0">Added Date : </span><strong><?php echo $row['add_date']; ?></strong>
															</li>
														</ul>
														<a class="btn btn-primary btn-rounded mt-3 px-4" href="edit_gallery.php?glid=<?php echo $row["id"]; ?>">
															<i class="fa fa-edit"></i>
														</a>
														<a class="btn btn-danger btn-rounded mt-3 px-4" href="delete_gallery.php?glid=<?php echo $row["id"]; ?>">
															<i class="fa fa-times-circle"></i>
														</a>
													</div>
												</div>
											</div>
										</div>
								<?php
									}
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