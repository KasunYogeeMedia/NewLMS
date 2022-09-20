<?php

session_start();

require_once 'includes.php';

require_once 'conn.php';

require_once("config.php");

require_once 'dbconfig4.php';

date_default_timezone_set("Asia/Colombo");
$id = mysqli_real_escape_string($conn, $_GET['id']);

if (isset($_POST['pay_bt'])) {
    $lms_teacher_payment_history_time = date("Y-m-d H:i:s");
    $lms_teacher_payment_history_amount = mysqli_real_escape_string($conn, $_POST['lms_teacher_payment_history_amount']);
    $lms_teacher_payment_company_amount = mysqli_real_escape_string($conn, $_POST['lms_teacher_payment_company_amount']);
    mysqli_query($conn, "INSERT INTO lms_teacher_payment_history(lms_teacher_payment_history_tid, lms_teacher_payment_company_amount, lms_teacher_payment_history_amount, lms_teacher_payment_history_time) VALUES ('$id','$lms_teacher_payment_company_amount','$lms_teacher_payment_history_amount','$lms_teacher_payment_history_time')");
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
                    <h4>Add Add Teacher Payment</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Add Teacher Payment</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0);">Add Add Teacher Payment</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Add Teacher Payment</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">

                            <?php
                            $tec_qury = mysqli_query($conn, "SELECT * FROM lmstealmsr WHERE tid='$id'");
                            $tec_resalt = mysqli_fetch_array($tec_qury);

                            $income_qury = mysqli_query($conn, "SELECT SUM(amount) as total_income FROM lmspayment WHERE feeID='$tec_resalt[tid]' and status='1'");
                            $icome_resalt = mysqli_fetch_array($income_qury);

                            $pay_qury = mysqli_query($conn, "SELECT SUM(lms_teacher_payment_history_amount) as total_pay FROM lms_teacher_payment_history WHERE lms_teacher_payment_history_tid='$tec_resalt[tid]'");
                            $pay_resalt = mysqli_fetch_array($pay_qury);

                            $pay_qury1 = mysqli_query($conn, "SELECT SUM(lms_teacher_payment_company_amount) as total_pay1 FROM lms_teacher_payment_history WHERE lms_teacher_payment_history_tid='$tec_resalt[tid]'");
                            $pay_resalt1 = mysqli_fetch_array($pay_qury1);

                            $a = $icome_resalt['total_income'] - ($pay_resalt['total_pay'] + $pay_resalt1['total_pay1']);

                            $b = $a / 100 * $tec_resalt['Percentage'];

                            $c = $a - $b;

                            $d = $a - $c;

                            ?>


                            <form method="post">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>Company Rate<br><input type="text" readonly name="lms_teacher_payment_company_amount" class="form-control" required value="<?php echo $d; ?>"></td>
                                            <td></td>
                                        </tr>

                                        <tr>
                                            <td>Payment<br><input type="text" readonly name="lms_teacher_payment_history_amount" class="form-control" required value="<?php echo $c; ?>"></td>
                                            <td><br><button type="submit" name="pay_bt" class="btn btn-success">Pay</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form><br>

                            <table id="example" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Time</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $payment_qury = mysqli_query($conn, "SELECT * FROM lms_teacher_payment_history WHERE lms_teacher_payment_history_tid='$id' ORDER BY lms_teacher_payment_history_id DESC");
                                    while ($payment_resalt = mysqli_fetch_array($payment_qury)) {
                                    ?>
                                        <tr>
                                            <td align="center"><a href="" style="color: darkred;"><i class="fa fa-trash fa-lg"></i></a></td>
                                            <td><?php echo date_format(date_create($payment_resalt['lms_teacher_payment_history_time']), "M d, Y - h:i:s A"); ?></td>
                                            <td><?php echo number_format($payment_resalt['lms_teacher_payment_history_amount'], 2); ?></td>
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
require_once 'footer.php';
?>
