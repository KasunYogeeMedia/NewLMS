<?php

session_start();

require_once 'includes.php';

require_once("conn.php");

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

	<?php
	require_once 'coutquery.php';
	?>


	<div class="content-wrapper">
		<!-- row -->
		<div class="container-fluid">

			<div class="row">
				<div class="col-xl-12 col-xxl-12 col-sm-12">
					<div class="row">
						<div class="col-xl-4 col-xxl-4 col-sm-6">
							<div class="widget-stat card bg-primary">
								<div class="card-body">
									<div class="media">
										<span class="mr-3">
											<i class="la la-users"></i>
										</span>
										<div class="media-body text-white">
											<p class="mb-1">Total Students</p>
											<h3 class="text-white"><?php echo $total_register ?></h3>
											<div class="progress mb-2 bg-white">
												<div class="progress-bar progress-animated bg-light" style="width: 80%"></div>
											</div>
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
											<i class="la la-black-tie"></i>
										</span>
										<div class="media-body text-white">
											<p class="mb-1">Total Teachers</p>
											<h3 class="text-white"><?php echo $total_teacher ?></h3>
											<div class="progress mb-2 bg-white">
												<div class="progress-bar progress-animated bg-light" style="width: 50%"></div>
											</div>
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
											<i class="la la-calendar-o"></i>
										</span>
										<div class="media-body text-white">
											<p class="mb-1">Total Grade</p>
											<h3 class="text-white"><?php echo $total_class ?></h3>
											<div class="progress mb-2 bg-white">
												<div class="progress-bar progress-animated bg-light" style="width: 76%"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-xxl-4 col-sm-6">
							<div class="widget-stat card bg-danger">
								<div class="card-body">
									<div class="media">
										<span class="mr-3">
											<i class="la la-buysellads"></i>
										</span>
										<div class="media-body text-white">
											<p class="mb-1">Total Subjects</p>
											<h3 class="text-white"><?php echo $total_subject ?></h3>
											<div class="progress mb-2 bg-white">
												<div class="progress-bar progress-animated bg-light" style="width: 30%"></div>
											</div>
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
											<i class="la la-play-circle-o"></i>
										</span>
										<div class="media-body text-white">
											<p class="mb-1">Total Video Lessons</p>
											<h3 class="text-white"><?php echo $total_lesson ?></h3>
											<div class="progress mb-2 bg-white">
												<div class="progress-bar progress-animated bg-light" style="width: 30%"></div>
											</div>
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
											<i class="la la-slideshare"></i>
										</span>
										<div class="media-body text-white">
											<p class="mb-1">Total Class Schedule</p>
											<h3 class="text-white"><?php echo $total_class_schedule ?></h3>
											<div class="progress mb-2 bg-white">
												<div class="progress-bar progress-animated bg-light" style="width: 30%"></div>
											</div>
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
											<i class="la la-money"></i>
										</span>
										<div class="media-body text-white">
											<p class="mb-1">Total Payment</p>
											<h3 class="text-white"><?php echo $total_payment ?></h3>
											<div class="progress mb-2 bg-white">
												<div class="progress-bar progress-animated bg-light" style="width: 30%"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-xxl-4 col-sm-6">
							<div class="widget-stat card bg-danger">
								<div class="card-body">
									<div class="media">
										<span class="mr-3">
											<i class="la la-user-secret"></i>
										</span>
										<div class="media-body text-white">
											<p class="mb-1">Total Admin Users</p>
											<h3 class="text-white"><?php echo $total_users ?></h3>
											<div class="progress mb-2 bg-white">
												<div class="progress-bar progress-animated bg-light" style="width: 30%"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-xxl-4 col-sm-6">
							<div class="widget-stat card bg-success">
								<div class="card-body">
									<div class="media">
										<span class="mr-3">
											<i class="fa fa-university"></i>
										</span>
										<div class="media-body text-white">
											<p class="mb-1">Total Revenue</p>
											<h3 class="text-white"><?php
																	$c_date = date("Y-01-01");

																	$income_qury = mysqli_query($conn, "SELECT SUM(amount) as total_income FROM lmspayment WHERE pay_month = '$c_date' AND status='1'");
																	$icome_resalt = mysqli_fetch_array($income_qury);

																	$pay_qury = mysqli_query($conn, "SELECT SUM(lms_teacher_payment_history_amount) as total_pay FROM lms_teacher_payment_history");
																	$pay_resalt = mysqli_fetch_array($pay_qury);

																	$pay_qury1 = mysqli_query($conn, "SELECT SUM(lms_teacher_payment_company_amount) as total_pay1 FROM lms_teacher_payment_history");
																	$pay_resalt1 = mysqli_fetch_array($pay_qury1);

																	$a = $icome_resalt['total_income'] - ($pay_resalt['total_pay'] + $pay_resalt1['total_pay1']);

																	$payment_count = mysqli_query($conn, "SELECT SUM(amount) amount
FROM lmspayment
WHERE status=1");
																	$payment_resalt = mysqli_fetch_assoc($payment_count);

																	/*echo 'Rs '.number_format((float)$icome_resalt['amount'],2);*/
																	?></h3>
											<h3><?php echo number_format($payment_resalt['amount'], 2) ?></h3>
											<div class="progress mb-2 bg-white">
												<div class="progress-bar progress-animated bg-light" style="width: 30%"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-12 col-lg-12 col-xxl-12 col-md-12">
					<div class="col-xl-12 col-lg-12 col-xxl-12 col-md-12">
						<div class="row">
							<div class="col-xl-12 col-lg-12 col-xxl-12 col-md-12">
								<div class="card-header">
									<h2 style="font-weight:bold;text-align:center;">Grade Wise Total Student Couting</h2>
									<hr>
								</div>
							</div>
							<br>
							<hr>
							<?php
							$sub_qury = mysqli_query($conn, "SELECT * FROM lmsclass order by cid");
							while ($sub_resalt = mysqli_fetch_array($sub_qury)) { ?>
								<div class="col-xl-4 col-xxl-4 col-sm-6">
									<div class="widget-stat card" style="background-color:#046ce4;">
										<div class="card-body">
											<div class="media">
												<span class="mr-3">
													<i class="la la-users"></i>
												</span>
												<div class="media-body text-white">
													<p class="mb-1"><?php echo $sub_resalt['name']; ?></p>
													<h3 class="text-white">Total Students - <?php
																							$stmt = $DB_con->prepare('SELECT COUNT(*) AS  register_count1 FROM lmsregister where level="' . $sub_resalt['cid'] . '"');
																							$stmt->execute();
																							$result = $stmt->fetch();
																							$total_register1 = $result['register_count1']; ?> [<?php echo $total_register1 ?>]</h3>
													<div class="progress mb-2 bg-white">
														<div class="progress-bar progress-animated bg-light" style="width: 80%"></div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php
		require_once 'footer.php';
		?>