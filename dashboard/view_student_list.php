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
                    <h4>All Student List</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0);">Student List</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0);">All Student List</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <ul class="nav nav-pills mb-3">
                    <li class="nav-item"><a href="#list-view" data-toggle="tab" class="btn btn-primary mr-1 show active">List View</a></li>
                </ul>
            </div>
            <div class="col-lg-12">
                <div class="row tab-content">
                    <div class="table-responsive">



                        <table id="example" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Address</th>
                                    <th>Amount</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $feeID = mysqli_real_escape_string($conn, $_GET['feeID']);
                                $pay_sub_id = mysqli_real_escape_string($conn, $_GET['pay_sub_id']);
                                $list_qury = mysqli_query($conn, "SELECT * FROM lmspayment WHERE feeID='$feeID' and pay_sub_id='$pay_sub_id'");
                                while ($list_resalt = mysqli_fetch_array($list_qury)) {

                                    $stu_qury = mysqli_query($conn, "SELECT * FROM lmsregister WHERE reid='$list_resalt[userID]'");
                                    $stu_resalt = mysqli_fetch_array($stu_qury);
                                ?>
                                    <tr>
                                        <td><?php echo $stu_resalt['fullname']; ?></td>
                                        <td><?php echo "0" . $stu_resalt['contactnumber']; ?></td>
                                        <td><?php echo $stu_resalt['address']; ?></td>
                                        <td><?php echo number_format($list_resalt['amount'], 2); ?></td>
                                        <td><?php echo date_format(date_create($list_resalt['created_at']), "M d, Y - h:i:s A"); ?></td>
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

<!-- Required vendors -->
<script src="vendor/global/global.min.js"></script>
<script src="js/deznav-init.js"></script>
<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="js/custom.min.js"></script>

<!-- Datatable -->
<script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="js/plugins-init/datatables.init.js"></script>

<!-- Svganimation scripts -->
<script src="vendor/svganimation/vivus.min.js"></script>
<script src="vendor/svganimation/svg.animation.js"></script>

<?php
require_once 'copyright.php';
?>
<?php
require_once 'footer.php';
?>