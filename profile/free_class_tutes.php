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
					<h4 class="item_title">Download Free Class Tutes</h4>
					<hr>
				</div>
				<div class="col-lg-12">
					<div class="widget-box bg-light mb-2">
						<form method="post">
							<div class="row">
								<div class="col-lg-3 col-md-3">
									From : <input name="s_month" type="month" class="form-control" id="s_month" value="<?php echo date("Y-m"); ?>">
								</div>
								<div class="col-lg-3 col-md-3">
									To : <input name="e_month" type="month" class="form-control" id="e_month" value="<?php echo date("Y-m"); ?>">
								</div>
								<div class="col-lg-3 col-md-3">
									Class : <select name="fsubject" required class="form-control" style="border: 2px solid #ccc;">
										<option hidden="yes">Select Class</option>
										<?php
										$sub_array = array();
										$sub_qury = mysqli_query($conn, "SELECT * FROM lmsreq_subject WHERE sub_req_reg_no='$user_resalt[contactnumber]'");
										while ($sub_resalt = mysqli_fetch_assoc($sub_qury)) {
											array_push($sub_array, "'" . $sub_resalt['sub_req_sub_id'] . "'");
										}
										$sub_array_join = join(",", $sub_array);

										$stmt = $DB_con->prepare("SELECT * FROM lmssubject WHERE sid IN ($sub_array_join) and status='Publish' ORDER BY name");
										$stmt->execute();
										if ($stmt->rowCount() > 0) {
											while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
												extract($row);
										?>
												<option value="<?php echo $row['sid']; ?>"><?php echo $row['name']; ?> [<?php

																														$id = $row['class_id'];

																														$query = $DB_con->prepare('SELECT name FROM lmsclass WHERE cid=' . $id);

																														$query->execute();

																														$result = $query->fetch();

																														echo $result['name'];

																														?>]</option>
										<?php }
										}
										?>
									</select>
								</div>
								<div class="col-lg-3 col-md-3">
									<br><button name="fil_bt" type="submit" class="btn btn-dark">Filter</button>
								</div>
							</div>
						</form>

					</div>
				</div>
				<div class="col-md-12">
					<div class="_14d25">
						<div class="row">
							<?php
							if (isset($_POST['fil_bt'])) {
								$s_month = date("Y-m-01", strtotime($_POST['s_month']));
								$e_month = date("Y-m-t", strtotime($_POST['e_month']));
								$fsubject = $_POST['fsubject'];

								$sub_array = array();
								$sub_qury = mysqli_query($conn, "SELECT * FROM lmsreq_subject WHERE sub_req_reg_no='$user_resalt[contactnumber]'");
								while ($sub_resalt = mysqli_fetch_assoc($sub_qury)) {
									array_push($sub_array, "'" . $sub_resalt['sub_req_sub_id'] . "'");
								}
								$sub_array_join = join(",", $sub_array);

								$tute_qury = mysqli_query($conn, "SELECT * FROM lmsclasstute WHERE subject IN ($sub_array_join) and ctype='Free Class' and status='1' and add_date BETWEEN '$s_month' and '$e_month' and subject='$fsubject'");
								while ($tute_resalt = mysqli_fetch_array($tute_qury)) {

									$tealmsr_qury = mysqli_query($conn, "SELECT * FROM lmstealmsr WHERE tid='$tute_resalt[tid]'");
									$tealmsr_resalt = mysqli_fetch_array($tealmsr_qury);

							?>
									<div class="col-lg-3 col-md-4">
										<div class="fcrse_1 mt-30">
											<a href="#" class="fcrse_img">
												<img src="images/pro_pick2.png" class="pro_pick2" style="height:300px;">
												<div class="course-overlay">
													<div class="badge_seller"><i class="uil uil-star"></i> <?php echo $tute_resalt['ctype']; ?></div>
													<div class="crse_reviews">
														<i class="fa fa-check-circle"></i> <?php echo date_format(date_create($tute_resalt['add_date']), "F"); ?>
													</div>

													<div class="crse_timer">
														<?php

														$id = $tute_resalt['class'];

														$query = $DB_con->prepare('SELECT name FROM lmsclass WHERE cid=' . $id);

														$query->execute();

														$result = $query->fetch();

														echo $result['name'];

														?> - <?php

																$id = $tute_resalt['class'];

																$query = $DB_con->prepare('SELECT name FROM lmssubject WHERE class_id=' . $id);

																$query->execute();

																$result = $query->fetch();

																echo $result['name'];

																?> </div>
												</div>
											</a>
											<div class="fcrse_content">
												<a href="#" class="crse14s"><?php echo $tute_resalt['title']; ?> - (<?php echo $tute_resalt['month']; ?>)</a>
												<div class="auth1lnkprce">
													<p class="cr1fot">
													<div class="user-status">
														<div class="user-avatar">
															<?php if ($tealmsr_resalt['image'] == "") {
																$pro_img = "images/hd_dp.jpg";
															} else {
																$pro_img = "../dashboard/images/teacher/" . $tealmsr_resalt['image'];
															} ?><img src="<?php echo $pro_img; ?>" class="pro_pick">
														</div>
														<p class="user-status-title"><span class="bold"><?php echo $tealmsr_resalt['fullname']; ?></span></p>
														<p class="user-status-tag online">Teacher</p>
														<br>
														<a href="../dashboard/images/classtute/<?php echo $tute_resalt['tdocument']; ?>" class="save_btn btn-block" target="_blank" style="background-color:#151fc1;" download>Download Tute</a>
													</div>
												</div>

											</div>
										</div>
									</div>
								<?php
								}
							} else {
								?>
								<?php

								$sub_array = array();
								$sub_qury = mysqli_query($conn, "SELECT * FROM lmsreq_subject WHERE sub_req_reg_no='$user_resalt[contactnumber]'");
								while ($sub_resalt = mysqli_fetch_assoc($sub_qury)) {
									array_push($sub_array, "'" . $sub_resalt['sub_req_sub_id'] . "'");
								}
								$sub_array_join = join(",", $sub_array);

								$tute_qury = mysqli_query($conn, "SELECT * FROM lmsclasstute WHERE subject IN ($sub_array_join) and ctype='Free Class' and status='1'");

								while ($tute_resalt = mysqli_fetch_array($tute_qury)) {

									$tealmsr_qury = mysqli_query($conn, "SELECT * FROM lmstealmsr WHERE tid='$tute_resalt[tid]'");
									$tealmsr_resalt = mysqli_fetch_array($tealmsr_qury);

								?>
									<div class="col-lg-3 col-md-4">
										<div class="fcrse_1 mt-30">
											<a href="#" class="fcrse_img">
												<img src="images/pro_pick2.png" class="pro_pick2" style="height:300px;">
												<div class="course-overlay">
													<div class="badge_seller"><i class="uil uil-star"></i> <?php echo $tute_resalt['ctype']; ?></div>
													<div class="crse_reviews">
														<i class="fa fa-check-circle"></i> <?php echo date_format(date_create($tute_resalt['add_date']), "F"); ?>
													</div>

													<div class="crse_timer">
														<?php

														$id = $tute_resalt['class'];

														$query = $DB_con->prepare('SELECT name FROM lmsclass WHERE cid=' . $id);

														$query->execute();

														$result = $query->fetch();

														echo $result['name'];

														?> - <?php

																$id = $tute_resalt['subject'];

																$query = $DB_con->prepare('SELECT name FROM lmssubject WHERE sid=' . $id);

																$query->execute();

																$result = $query->fetch();

																echo $result['name'];

																?> </div>
												</div>
											</a>
											<div class="fcrse_content">
												<a href="#" class="crse14s"><?php echo $tute_resalt['title']; ?> - (<?php echo $tute_resalt['month']; ?>)</a>
												<div class="auth1lnkprce">
													<p class="cr1fot">
													<div class="user-status">
														<div class="user-avatar">
															<?php if ($tealmsr_resalt['image'] == "") {
																$pro_img = "images/hd_dp.jpg";
															} else {
																$pro_img = "../dashboard/images/teacher/" . $tealmsr_resalt['image'];
															} ?><img src="<?php echo $pro_img; ?>" class="pro_pick">
														</div>
														<p class="user-status-title"><span class="bold"><?php echo $tealmsr_resalt['fullname']; ?></span></p>
														<p class="user-status-tag online">Teacher</p>
														<br>
														<a href="../dashboard/images/classtute/<?php echo $tute_resalt['tdocument']; ?>" class="save_btn btn-block" target="_blank" style="background-color:#151fc1;" download>Download Tute</a>
													</div>
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
<!-- Body End -->
<?php
require_once 'copyright.php';
?>
<?php
require_once 'footer.php';
?>