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
                    <h4>Settings</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0);">Settings</a></li>
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
                        <form action="settings_save.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Reg Name Prefix</label>
                                <input type="text" name="rgname_prefix" class="form-control" placeholder="<?php echo $reg_prefix; ?>">
                            </div>
                            <div class="form-group">
                                <label>Application Name</label>
                                <input type="text" name="ap_name" class="form-control" placeholder="<?php echo $application_name; ?>">
                            </div>
                            <div class="form-group">
                                <label>Main Logo</label>
                            </div>
                            <div class="form-group">
                                <img src="./settings/logo/<?php echo $main_logo; ?>" class="img-responsive" alt="Atlas">

                            </div>
                            <div class="form-group">
                                <input type="file" name="main_logo" class="form-control" />
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