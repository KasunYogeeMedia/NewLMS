<?php

session_start();

require_once 'includes.php';

include 'conn.php';

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
					<li class="nav-item"><a href="#list-view" data-toggle="tab" class="btn btn-primary mr-1 show active">List View</a></li>
					<li class="nav-item"><a href="#grid-view" data-toggle="tab" class="btn btn-primary">Grid View</a></li>
				</ul>
			</div>
			<div class="col-lg-12">
				<div class="row tab-content">
					<div id="list-view" class="tab-pane fade active show col-lg-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">All Students </h4>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<div>
										<form class="form-horizontal" action="functions.php" method="post" name="upload_excel" enctype="multipart/form-data">
											<div class="form-group">
												<div class="col-md-12 col-md-offset-4" style="text-align:right;">
													<input type="submit" name="Export" class="btn btn-success" value="export to excel" />
												</div>
											</div>
										</form>
									</div>
									<table id="example1" class="table table-bordered">
										<thead>
											<tr>
												<th>ID</th>
												<th>Action</th>
												<th>Status</th>
												<th>Student</th>
												<th>Grade</th>
												<th>Subject</th>
												<th>Date</th>
											</tr>
										</thead>
										<tbody>
											<?php

											$stmt = $DB_con->prepare('SELECT * FROM lmsregister ORDER BY reid');

											$stmt->execute();

											if ($stmt->rowCount() > 0) {

												while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

													extract($row);

											?>
													<tr>
														<td><?php echo $row['reid']; ?></td>
														<td>
															<a class="btn btn-sm btn-danger" href="delete_students.php?stid=<?php echo $row["reid"]; ?>" onClick="return confirm('Are youe sure remove this student');"><i class="fa fa-trash"></i></a>
														</td>
														<td>
															<?php

															if ($row['status'] == "0") {

																echo '<button class="btn btn-primary btn-sm">Pending</button>';
															} else if ($row['status'] == "1") {

																echo '<button class="btn btn-success btn-sm">Success</button>';
															}

															?>
														</td>
														<td>
															<p><?php if ($row['image'] == "") {
																	$pro_img = "../profile/images/hd_dp.jpg";
																} else {
																	$pro_img = "../profile/uploadImg/" . $row['image'];
																} ?><img src="<?php echo $pro_img; ?>" class="pro_pick">
																<strong><?php echo $row['fullname']; ?></strong>
															</p>
															<p><strong>Student Number : <?php echo $row['stnumber']; ?></strong></p>
															<p><strong>Birth Day : <?php echo $row['dob']; ?></strong></p>
															<p><strong>Email : <?php echo $row['email']; ?></strong></p>
															<p><strong>Gender : <?php echo $row['gender']; ?></strong></p>
															<p><strong>School: <?php echo $row['school']; ?></strong></p>
															<p><strong>District : <?php echo $row['district']; ?></strong></p>
															<p><strong>Town/City : <?php echo $row['town']; ?></strong></p>
															<p><strong>Parent Contct No : <?php echo "0" . (int)$row['pcontactnumber']; ?></strong></p>
															<p><strong>Contct No/Username : <?php echo "0" . (int)$row['contactnumber']; ?></strong></p>
															<p>Address : <?php echo $row['address']; ?></p>
														</td>
														<td><a href="javascript:void(0);"><strong><?php

																									$id = $row['level'];

																									$query = $DB_con->prepare('SELECT name FROM lmsclass WHERE cid=' . $id);

																									$query->execute();

																									$result = $query->fetch();

																									echo $result['name'];

																									?></strong></a></td>
														<td><strong><?php
																	$sub_qury = mysqli_query($conn, "SELECT * FROM lmsreq_subject INNER JOIN lmssubject ON lmsreq_subject.sub_req_sub_id=lmssubject.sid WHERE sub_req_reg_no='$row[contactnumber]'");
																	while ($sub_resalt = mysqli_fetch_array($sub_qury)) {
																	?><?php echo $sub_resalt['name'], "<br>"; ?><?php } ?></strong></td>
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

								$stmt = $DB_con->prepare('SELECT * FROM lmsregister ORDER BY reid');

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
															<?php if ($row['image'] == "") {
																$pro_img = "../profile/images/hd_dp.jpg";
															} else {
																$pro_img = "../profile/uploadImg/" . $row['image'];
															} ?><img src="<?php echo $pro_img; ?>" class="pro_pick">
														</div>
														<h3 class="mt-4 mb-1"><strong><?php echo $row['fullname']; ?></strong></h3>
														<p class="text-muted"><strong>Classes :- <?php
																									$sub_qury = mysqli_query($conn, "SELECT * FROM lmsreq_subject INNER JOIN lmssubject ON lmsreq_subject.sub_req_sub_id=lmssubject.sid WHERE sub_req_reg_no='$row[contactnumber]'");
																									while ($sub_resalt = mysqli_fetch_array($sub_qury)) {
																									?><?php echo $sub_resalt['name'], "<br>"; ?><?php } ?></strong></p>
														<ul class="list-group mb-3 list-group-flush">
															<li class="list-group-item px-0 d-flex justify-content-between">
																<span class="mb-0">Student Number. :</span><strong><?php echo $row['stnumber']; ?></strong>
															</li>
															<li class="list-group-item px-0 d-flex justify-content-between">
																<span class="mb-0">Birth day. :</span><strong><?php echo $row['dob']; ?></strong>
															</li>
															<li class="list-group-item px-0 d-flex justify-content-between">
																<span class="mb-0">Email. :</span><strong><?php echo $row['email']; ?></strong>
															</li>
															<li class="list-group-item px-0 d-flex justify-content-between">
																<span class="mb-0">Gender. :</span><strong><?php echo $row['gender']; ?></strong>
															</li>
															<li class="list-group-item px-0 d-flex justify-content-between">
																<span class="mb-0">School. :</span><strong><?php echo $row['school']; ?></strong>
															</li>
															<li class="list-group-item px-0 d-flex justify-content-between">
																<span class="mb-0">District. :</span><strong><?php echo $row['district']; ?></strong>
															</li>
															<li class="list-group-item px-0 d-flex justify-content-between">
																<span class="mb-0">Town/City. :</span><strong><?php echo $row['town']; ?></strong>
															</li>
															<li class="list-group-item px-0 d-flex justify-content-between">
																<span class="mb-0">Parent Contact No. :</span><strong><?php echo "0" . (int)$row['pcontactnumber']; ?></strong>
															</li>
															<li class="list-group-item px-0 d-flex justify-content-between">
																<span class="mb-0">Contact No. :</span><strong><?php echo "0" . (int)$row['contactnumber']; ?></strong>
															</li>
															<li class="list-group-item px-0 d-flex justify-content-between">
																<span class="mb-0">Grade :</span><strong><?php

																											$id = $row['level'];

																											$query = $DB_con->prepare('SELECT name FROM lmsclass WHERE cid=' . $id);

																											$query->execute();

																											$result = $query->fetch();

																											echo $result['name'];

																											?></strong>
															</li>
															<li class="list-group-item px-0 d-flex justify-content-between">
																<span class="mb-0">Added Date. :</span><strong><?php echo $row['add_date']; ?></strong>
															</li>
														</ul>
														<a class="btn btn-sm btn-danger btn-rounded mt-3 px-4" href="delete_students.php?stid=<?php echo $row["reid"]; ?>" onClick="return confirm('Are youe sure remove this student');"><i class="fa fa-trash"></i></a>
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

<script>
	$(document).ready(function() {

		loadGallery(true, 'a.thumbnail');

		//This function disables buttons when needed
		function disableButtons(counter_max, counter_current) {
			$('#lmsow-previous-image, #lmsow-next-image').lmsow();
			if (counter_max == counter_current) {
				$('#lmsow-next-image').hide();
			} else if (counter_current == 1) {
				$('#lmsow-previous-image').hide();
			}
		}

		/**
		 *
		 * @param setIDs        Sets IDs when DOM is loaded. If using a PHP counter, set to false.
		 * @param setClickAttr  Sets the attribute for the click handler.
		 */

		function loadGallery(setIDs, setClickAttr) {
			var current_image,
				selector,
				counter = 0;

			$('#lmsow-next-image, #lmsow-previous-image').click(function() {
				if ($(this).attr('id') == 'lmsow-previous-image') {
					current_image--;
				} else {
					current_image++;
				}

				selector = $('[data-image-id="' + current_image + '"]');
				updateGallery(selector);
			});

			function updateGallery(selector) {
				var $sel = selector;
				current_image = $sel.data('image-id');
				$('#image-gallery-caption').text($sel.data('caption'));
				$('#image-gallery-title').text($sel.data('title'));
				$('#image-gallery-image').attr('src', $sel.data('image'));
				disableButtons(counter, $sel.data('image-id'));
			}

			if (setIDs == true) {
				$('[data-image-id]').each(function() {
					counter++;
					$(this).attr('data-image-id', counter);
				});
			}
			$(setClickAttr).on('click', function() {
				updateGallery($(this));
			});
		}
	});
</script>

<script>
	function Publilmsed_tealmsrs(id) {

		$.ajax({
			url: 'publilmsed_tealmsrs.php',
			method: 'POST',
			data: {
				id: id
			},
			success: function(data) {
				location.reload();

			}
		});

	}

	function Reject_ads(id) {
		alert(id);
		$.ajax({
			url: 'reject_tealmsrs.php',
			method: 'POST',
			data: {
				id: id
			},
			success: function(data) {
				location.reload();

			}
		});

	}
</script>


<?php
require_once 'copyright.php';
?>
<?php
require_once 'footer.php';
?>