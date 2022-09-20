<?php

session_start();

require_once 'includes.php';

?>
<?php

require("conn.php");

require_once 'dbconfig4.php';

if (isset($_GET['clid'])) {
    $clid = mysqli_real_escape_string($conn, $_GET['clid']);
    $view_qury = mysqli_query($conn, "SELECT * FROM lmsclass WHERE cid='$clid'");
    $view_result = mysqli_fetch_array($view_qury);
} else {
    echo "<script>window.location='grade.php';</script>";
}


if (isset($_POST['update'])) {

    $cid = $_GET['clid'];
    $name = $_POST['name'];
    $status = $_POST['status'];

    if (!isset($errMSG)) {

        $stmt = $DB_con->prepare('UPDATE lmsclass
			SET name=:name,
			status=:status
			WHERE cid=:clid');
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':clid', $cid);

        if ($stmt->execute()) {

            $successMSG = "Grade Successfully Updated ...";

            header("refresh:2;grade.php"); // redirects image view page after 5 seconds.

        } else {

            $errMSG = "Sorry Data Could Not Updated !";
        }
    }
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
                    <h4>Edit Grade</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active"><a href="grade.php">Grade</a></li>
                    <li class="breadcrumb-item active"><a href="edit_admin.php">Edit Grade</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-xxl-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Edit Grade</h5>
                    </div>
                    <div class="card-body">
                        <?php

                        if (isset($errMSG)) {

                        ?>

                            <div class="alert alert-danger alert-dismissible alert-alt solid fade show">
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
                                <strong>Error!</strong> <?php echo $errMSG; ?>
                            </div>

                        <?php

                        } else if (isset($successMSG)) {

                        ?>

                            <div class="alert alert-success alert-dismissible alert-alt solid fade show">
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
                                <strong>Success!</strong> <?php echo $successMSG; ?>.
                            </div>

                        <?php

                        }

                        ?>
                        <form action="" method="POST" enctype="multlmsrt/form-data">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Grade</label>
                                        <input type="text" class="form-control" name="name" value="<?php echo $view_result['name']; ?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-12">
                                    <div class="form-group fallback w-100">
                                        <label class="form-label">Status</label>
                                        <select class="form-control" name="status" required>
                                            <option <?php if ($view_result['status'] == "Publish") {
                                                        echo "selected";
                                                    } ?>>Publish</option>
                                            <option <?php if ($view_result['status'] == "Unpublish") {
                                                        echo "selected";
                                                    } ?>>Unpublish</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <input type="submit" name="update" class="btn btn-primary" value="Update">
                                    <a class="btn btn-light" href="grade.php"><i class="fa fa-times"></i> Close</a>
                                </div>
                            </div>
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