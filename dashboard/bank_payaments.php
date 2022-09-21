<?php

session_start();

require_once 'includes.php';

include 'dbconfig4.php';

require_once("conn.php");

if (isset($_GET['id'])) {

    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $status = mysqli_real_escape_string($conn, $_GET['status']);

    if ($status == 1) {
        $to = "+94" . (int)$_GET['mobile'];
        $message_text = "We have approved your payment.Your classes and learning materials are unlocked now.";
        $message = urlencode($message_text);
        send_sms($to, $message);

        echo "<img src=''>";
    } else if ($status == 2) {
        $to = "+94" . (int)$_GET['mobile'];
        $message_text = "We regret to inform you that your payment is got rejected. Please contact 0704000628 for more details.";
        $message = urlencode($message_text);
        send_sms($to, $message);

        echo "<img src=''>";
    }

    mysqli_query($conn, "UPDATE lmspayment SET status='$status' WHERE pid='$id'");
    //echo "<script>window.location='bank_payments.php';</script>";

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
                    <h4>Pending Bank Payments</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0);">Pending Bank Payments</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0);">Pending Bank Payments</a></li>
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
                                <h4 class="card-title">Pending Bank Payments</h4>
                            </div>
                            <div class="card-body">

                                <div class="table-responsive">
                                    <div>
                                        <form class="form-horizontal" action="functions.php" method="post" name="upload_excel" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <div class="col-md-12 col-md-offset-4" style="text-align:right;">
                                                    <input type="submit" name="Pending" class="btn btn-success" value="export to excel" />
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <table id="example3" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Action</th>
                                                <th>Slip</th>
                                                <th>Status</th>
                                                <th>Student Name</th>
                                                <th>Subject/Grade</th>
                                                <th>Class Fee</th>
                                                <th>Valid Date - Paid Month</th>
                                                <th>Pay Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count = 0;
                                            $payment_qury = mysqli_query($conn, "SELECT * FROM lmspayment WHERE paymentMethod='Bank' and status='0' ORDER BY created_at DESC");
                                            while ($payment_resalt = mysqli_fetch_array($payment_qury)) {
                                                $count++;

                                                $user_qury = mysqli_query($conn, "SELECT * FROM lmsregister WHERE reid='$payment_resalt[userID]'");
                                                $user_resalt = mysqli_fetch_array($user_qury);
                                            ?>
                                                <tr>
                                                    <td><?php echo number_format($count, 0); ?></td>
                                                    <td>

                                                        <a href="bank_payaments.php?id=<?php echo $payment_resalt['pid']; ?>&status=1&mobile=<?php echo "0" . (int)$user_resalt['contactnumber']; ?>" title="Approval Payment" onClick="JavaScript:return confirm('Are your sure change this payment status?');" class="badge badge-success"><i class="fa fa-check"></i> Approval</a>

                                                        <a href="bank_payaments.php?id=<?php echo $payment_resalt['pid']; ?>&status=2&mobile=<?php echo "0" . (int)$user_resalt['contactnumber']; ?>" title="Unapproval Payment" onClick="JavaScript:return confirm('Are your sure change this payment status?');" class="badge badge-danger"><i class="fa fa-trash"></i> Reject</a>

                                                    </td>
                                                    <td>
                                                        <a href="<?php echo "$url/profile/uploadslip/" . $payment_resalt['fileName']; ?>" target="_blank" class="badge badge-primary">View Slip</a>
                                                    </td>
                                                    <td>
                                                        <?php if ($payment_resalt['status'] == 0) { ?>
                                                            <span class="badge badge-warning">Not Approval</span>
                                                        <?php } ?>
                                                        <?php if ($payment_resalt['status'] == 1) { ?>
                                                            <span class="badge badge-success">Approval</span>
                                                        <?php } ?>
                                                    </td>
                                                    <td><?php echo $user_resalt['fullname']; ?><br><?php echo "0" . (int)$user_resalt['contactnumber']; ?></td>
                                                    <td><?php
                                                        $sub_qury = mysqli_query($conn, "SELECT * FROM lmssubject WHERE sid='$payment_resalt[pay_sub_id]'");
                                                        while ($sub_resalt = mysqli_fetch_array($sub_qury)) {
                                                        ?> <?php echo $sub_resalt['name']; ?>

                                                            -

                                                            <?php
                                                            $cl_qury = mysqli_query($conn, "SELECT * FROM lmsclass WHERE cid='$sub_resalt[class_id]'");
                                                            while ($cl_resalt = mysqli_fetch_array($cl_qury)) {
                                                            ?> <?php echo $cl_resalt['name']; ?> <?php }
                                                                                            } ?>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-secondary">Pay Rs.<?php echo number_format($payment_resalt['amount'], 2); ?></span>
                                                    </td>
                                                    <td><span class="badge badge-success" style="font-size:14px;color:#ffffff;">Valid Date : <i class="fa fa-check-circle"></i> <?php echo date_format(date_create($payment_resalt['expiredate']), "M d, Y"); ?> - Paid Month : <i class="fa fa-check-circle"></i> <?php echo date_format(date_create($payment_resalt['pay_month']), "F"); ?></span></td>
                                                    <td><?php echo date_format(date_create($payment_resalt['created_at']), "M d, Y - h:i:s A"); ?></td>
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
                    <div id="grid-view" class="tab-pane fade col-lg-12">
                        <div class="row">
                            <tbody>
                                <?php
                                $count = 0;
                                $payment_qury = mysqli_query($conn, "SELECT * FROM lmspayment WHERE paymentMethod='Bank' and status='0' ORDER BY created_at DESC");
                                while ($payment_resalt = mysqli_fetch_array($payment_qury)) {
                                    $count++;

                                    $user_qury = mysqli_query($conn, "SELECT * FROM lmsregister WHERE reid='$payment_resalt[userID]'");
                                    $user_resalt = mysqli_fetch_array($user_qury);
                                ?>
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="text-center">
                                                    <div class="profile-photo">
                                                        <a href="<?php echo "<?php echo $url;?>/profile/uploadslip/" . $payment_resalt['fileName']; ?>" target="_blank" class="badge badge-primary">View Slip</a>
                                                    </div>
                                                    <h3 class="mt-4 mb-1"><strong><?php echo $user_resalt['fullname']; ?><br><?php echo $user_resalt['address']; ?><br><?php echo "0" . (int)$user_resalt['contactnumber']; ?></strong></h3>
                                                    <p class="text-muted"><strong>Subject/Grade :
                                                            <?php
                                                            $sub_qury = mysqli_query($conn, "SELECT * FROM lmssubject WHERE sid='$payment_resalt[pay_sub_id]'");
                                                            while ($sub_resalt = mysqli_fetch_array($sub_qury)) {
                                                            ?> <?php echo $sub_resalt['name']; ?>

                                                                -

                                                                <?php
                                                                $cl_qury = mysqli_query($conn, "SELECT * FROM lmsclass WHERE cid='$sub_resalt[class_id]'");
                                                                while ($cl_resalt = mysqli_fetch_array($cl_qury)) {
                                                                ?> <?php echo $cl_resalt['name']; ?> <?php }
                                                                                                } ?>
                                                        </strong></p>
                                                    <hr>
                                                    <ul class="list-group mb-3 list-group-flush">
                                                        <li class="list-group-item px-0 d-flex justify-content-between">
                                                            <span class="mb-0">Class Fee : </span><strong>Pay Rs.<?php echo number_format($payment_resalt['amount'], 2); ?></strong>
                                                        </li>
                                                        <li class="list-group-item px-0 d-flex justify-content-between">
                                                            <span class="mb-0">Pay Date : </span><strong><?php echo date_format(date_create($payment_resalt['created_at']), "M d, Y - h:i:s A"); ?></strong>
                                                        </li>
                                                        <li class="list-group-item px-0 d-flex justify-content-between">
                                                            <span class="mb-0">Valid Date - Paid Month : </span><strong><span class="badge badge-success" style="font-size:14px;color:#ffffff;">Valid Date : <i class="fa fa-check-circle"></i> <?php echo date_format(date_create($payment_resalt['expiredate']), "M d, Y"); ?> - Paid Month : <i class="fa fa-check-circle"></i> <?php echo date_format(date_create($payment_resalt['pay_month']), "F"); ?></span></strong>
                                                        </li>
                                                        <li class="list-group-item px-0 d-flex justify-content-between">
                                                            <span class="mb-0">Status : </span><strong>
                                                                <?php if ($payment_resalt['status'] == 0) { ?>
                                                                    <span class="badge badge-warning">Not Approval</span>
                                                                <?php } ?>
                                                                <?php if ($payment_resalt['status'] == 1) { ?>
                                                                    <span class="badge badge-success">Approval</span>
                                                                <?php } ?></strong>
                                                        </li>

                                                    </ul>

                                                    <a href="bank_payaments.php?id=<?php echo $payment_resalt['pid']; ?>&status=1&mobile=<?php echo "0" . (int)$user_resalt['contactnumber']; ?>" title="Approval Payment" onClick="JavaScript:return confirm('Are your sure change this payment status?');" class="badge badge-success"><i class="fa fa-check"></i> Approval</a>

                                                    <a href="bank_payaments.php?id=<?php echo $payment_resalt['pid']; ?>&status=2&mobile=<?php echo "0" . (int)$user_resalt['contactnumber']; ?>" title="Unapproval Payment" onClick="JavaScript:return confirm('Are your sure change this payment status?');" class="badge badge-danger"><i class="fa fa-trash"></i> Reject</a>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
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
require_once 'footer.php';
?>