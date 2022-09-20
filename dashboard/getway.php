<?php

session_start();

require_once 'includes.php';

require_once 'conn.php';

require_once 'dbconfig4.php';

if (isset($_GET['remove'])) {
    $remove = mysqli_real_escape_string($conn, $_GET['remove']);
    mysqli_query($conn, "DELETE FROM lmsclass_schlmsle WHERE classid='$remove'");
    echo "<script>window.location='class_schedule.php';</script>";
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
                    <h4>Payment Getway Settings</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0);">Payment Getway Settings</a></li>
                </ol>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-12">
                <?php if (isset($_GET['added'])) { ?>

                    <div class="alert alert-success alert-dismissible alert-alt solid fade show">

                        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>

                        <strong>Success!</strong> New Added Successfully.

                    </div>

                <?php } ?>

                <?php if (isset($_GET['update'])) { ?>

                    <div class="alert alert-success alert-dismissible alert-alt solid fade show">

                        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>

                        <strong>Success!</strong> Updated Successfully,

                    </div>

                <?php } ?>
                <div class="row tab-content">
                    <div class="card-body">
                        <form action="getway_save.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>App ID</label>
                                <input type="text" name="app_id" class="form-control" placeholder="<?php echo $app_id; ?>">
                            </div>
                            <div class="form-group">
                                <label>Hash salt</label>
                                <input type="text" name="hash_salt" class="form-control" placeholder="<?php echo $hash_salt; ?>">
                            </div>
                            <div class="form-group">
                                <label>App Token</label>
                                <input type="text" name="a_token" class="form-control" placeholder="<?php echo $a_token; ?>">
                            </div>

                            <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php
require_once 'footer.php';
?>