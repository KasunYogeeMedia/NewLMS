<?php

session_start();

require_once 'includes.php';

require_once("conn.php");

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
					<h4>All Video Lessons</h4>
				</div>
			</div>
			<div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="home.php">Home</a></li>
					<li class="breadcrumb-item active"><a href="javascript:void(0);">Video Lessons</a></li>
					<li class="breadcrumb-item active"><a href="javascript:void(0);">All Video Lessons</a></li>
				</ol>
			</div>
		</div>

		<div class="row admin_vd">
			<div class="col-xxl-2 col-xl-2 col-md-4 col-sm-6">
				<div class="widget-stat card bg-secondary">
					<a href="video_type_1.php">
						<div class="card-body">
							<table class="media">
								<tr>
									<td>
										<span class="mr-3">
											<i class="fa fa-users"></i>
										</span>
									</td>
									<td>
										<div class="media-body text-white">
											<p class="mb-1">Science of Life (ජිවිත විද්‍යාව)</p>
										</div>
									</td>
								</tr>
							</table>
						</div>
					</a>
				</div>
			</div>
			<div class="col-xxl-2 col-xl-2 col-md-4 col-sm-6">
				<div class="widget-stat card bg-secondary">
					<a href="video_type_2.php">
						<div class="card-body">
							<table class="media">
								<tr>
									<td>
										<span class="mr-3">
											<i class="fa fa-users"></i>
										</span>
									</td>
									<td>
										<div class="media-body text-white">
											<p class="mb-1">Lession Explanations</p>
										</div>
									</td>
								</tr>
							</table>
						</div>
					</a>
				</div>
			</div>
			<div class="col-xxl-2 col-xl-2 col-md-4 col-sm-6">
				<div class="widget-stat card bg-secondary">
					<a href="video_type_3.php">
						<div class="card-body">
							<table class="media">
								<tr>
									<td>
										<span class="mr-3">
											<i class="fa fa-users"></i>
										</span>
									</td>
									<td>
										<div class="media-body text-white">
											<p class="mb-1">Lession Revision</p>
										</div>
									</td>
								</tr>
							</table>
						</div>
					</a>
				</div>
			</div>
			<div class="col-xxl-2 col-xl-2 col-md-4 col-sm-6">
				<div class="widget-stat card bg-secondary">
					<a href="video_type_4.php">
						<div class="card-body">
							<table class="media">
								<tr>
									<td>
										<span class="mr-3">
											<i class="fa fa-users"></i>
										</span>
									</td>
									<td>
										<div class="media-body text-white">
											<p class="mb-1">Paper Discussions</p>
										</div>
									</td>
								</tr>
							</table>
						</div>
					</a>
				</div>
			</div>
			<div class="col-xxl-2 col-xl-2 col-md-4 col-sm-6">
				<div class="widget-stat card bg-secondary">
					<a href="video_type_5.php">
						<div class="card-body">
							<table class="media">
								<tr>
									<td>
										<span class="mr-3">
											<i class="fa fa-users"></i>
										</span>
									</td>
									<td>
										<div class="media-body text-white">
											<p class="mb-1">Lession Explanations by Students </p>
										</div>
									</td>
								</tr>
							</table>
						</div>
					</a>
				</div>
			</div>
			<div class="col-xxl-2 col-xl-2 col-md-4 col-sm-6">
				<div class="widget-stat card bg-secondary">
					<a href="video_type_6.php">
						<div class="card-body">
							<table class="media">
								<tr>
									<td>
										<span class="mr-3">
											<i class="fa fa-users"></i>
										</span>
									</td>
									<td>
										<div class="media-body text-white">
											<p class="mb-1">Practicals By Students</p>
										</div>
									</td>
								</tr>
							</table>
						</div>
					</a>
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