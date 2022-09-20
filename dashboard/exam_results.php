<?php

session_start();

require_once 'includes.php';

require_once 'conn.php';

require_once 'dbconfig4.php';

if (isset($_POST['filter'])) {
    if ($_POST['exam_report_paper'] == "All") {
        header("location:exam_results.php");
    }
}

if (isset($_GET['remove'])) {
    $lms_report_id = mysqli_real_escape_string($conn, $_GET['remove']);
    if (mysqli_query($conn, "DELETE FROM lms_exam_report WHERE lms_report_id='$lms_report_id'")) {
        header("location:exam_results.php");
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
                    <h4>Exam Result</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0);">Exam</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0);">Exam Result</a></li>
                </ol>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-12">
                <div class="row tab-content">
                    <div id="list-view" class="tab-pane fade active show col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Exam Result</h4>
                            </div>
                            <div class="card-body">
                                <form method="post" class="mb-2">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <select name="exam_report_paper" required="required" class="form-control" id="exam_report_paper">
                                                        <option value="All">All Exam</option>
                                                        <?php
                                                        $ex_qury = mysqli_query($conn, "SELECT * FROM lms_exam_details ORDER BY lms_exam_id DESC");
                                                        while ($ex_resalt = mysqli_fetch_assoc($ex_qury)) {
                                                        ?>
                                                            <option <?php if (isset($_POST['exam_report_paper'])) {
                                                                        if ($_POST['exam_report_paper'] == $ex_resalt['lms_exam_id']) {
                                                                            echo "selected";
                                                                        }
                                                                    } ?> value="<?php echo $ex_resalt['lms_exam_id']; ?>"><?php echo $ex_resalt['lms_exam_name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td><button name="filter" type="submit" class="btn btn-sm btn-success ml-2">Filter</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </form>
                                <div class="table-responsive">
                                    <table id="example3" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Action</th>
                                                <th>Exam/Subject</th>
                                                <th>Student</th>
                                                <th>Faced</th>
                                                <th>Correct</th>
                                                <th>Percentage</th>
                                                <th>Complet Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($_POST['filter'])) {
                                                $r_qury = mysqli_query($conn, "SELECT er.*,ed.lms_exam_name,s.name,r.fullname,ed.lms_exam_question
FROM lms_exam_report er INNER JOIN lms_exam_details ed ON er.exam_report_paper=ed.lms_exam_id
INNER JOIN lmssubject s ON ed.lms_exam_subject=s.sid
INNER JOIN lmsregister r ON er.exam_report_user=r.reid
WHERE er.exam_report_paper='$_POST[exam_report_paper]'
ORDER BY er.lms_report_id DESC");
                                            } else {
                                                $r_qury = mysqli_query($conn, "SELECT er.*,ed.lms_exam_name,s.name,r.fullname,ed.lms_exam_question
FROM lms_exam_report er INNER JOIN lms_exam_details ed ON er.exam_report_paper=ed.lms_exam_id
INNER JOIN lmssubject s ON ed.lms_exam_subject=s.sid
INNER JOIN lmsregister r ON er.exam_report_user=r.reid
ORDER BY er.lms_report_id DESC");
                                            }
                                            while ($r_esalt = mysqli_fetch_assoc($r_qury)) {
                                            ?>
                                                <tr>
                                                    <td><a href="exam_results.php?remove=<?php echo $r_esalt['lms_report_id']; ?>" class="btn btn-sm btn-danger" onClick="return confirm('Are you sure to remove this exam result?');">Remove</a></td>
                                                    <td><?php echo $r_esalt['lms_exam_name']; ?><br><?php echo $r_esalt['name']; ?></td>
                                                    <td><?php echo $r_esalt['fullname']; ?></td>
                                                    <td><?php echo $r_esalt['lms_exam_question']; ?>/<?php echo $r_esalt['exam_report_faced']; ?></td>
                                                    <td><?php echo $r_esalt['exam_report_corect']; ?></td>
                                                    <td align="center"><?php echo $r_esalt['exam_report_percent']; ?>%</td>
                                                    <td><?php echo date("Y-m-d h:i:s A", strtotime($r_esalt['exam_report_complet_time'])); ?></td>
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