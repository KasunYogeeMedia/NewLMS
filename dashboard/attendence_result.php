<?php
$url = $_SERVER['REQUEST_URI'];
$parts = parse_url($url);
parse_str($parts['query'], $query);
$att_res =  $query['att_res'];
session_start();

require_once 'includes.php';

require_once 'conn.php';

require_once 'dbconfig4.php';

$count_att = mysqli_query($conn, "SELECT COUNT(*) FROM user_attandance WHERE lid = $att_res");
$row = mysqli_fetch_array($count_att);
$total = $row[0];
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
                    <h4>Total Attendence - <?php echo $total; ?></h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0);">Students Attendence</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0);">All Students Attendence</a></li>
                </ol>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-12">
                <div class="row tab-content">
                    <div id="list-view" class="tab-pane fade active show col-lg-12">
                        <div class="card">

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example3" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Reg Number</th>
                                                <th>Student name</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count = 0;
                                            $list_qury = mysqli_query($conn, "SELECT * FROM `lmsregister` INNER JOIN user_attandance ON lmsregister.reid = user_attandance.userid WHERE lid=$att_res; ");

                                            while ($list_resalt = mysqli_fetch_array($list_qury)) {
                                                $count++;

                                            ?>
                                                <tr>
                                                    <td><?php echo number_format($count, 0); ?></td>
                                                    <td style="text-transform: capitalize;"><?php echo $list_resalt['stnumber']; ?></td>
                                                    <td style="text-transform: capitalize;"><?php echo $list_resalt['fullname']; ?></td>


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

                </div>
            </div>
        </div>

    </div>
</div>

<?php
require_once 'footer.php';
?>