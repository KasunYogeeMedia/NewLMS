<?php

session_start();

require_once 'includes.php';

require_once 'conn.php';

require_once 'dbconfig4.php';

if (isset($_GET['remove'])) {
    $remove = mysqli_real_escape_string($conn, $_GET['remove']);
    if (mysqli_query($conn, "DELETE FROM lms_exam_details WHERE lms_exam_id='$remove'")) {
        echo "<script>window.location='exam.php?removed';</script>";
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
                    <h4>All Exams</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0);">Exams</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0);">All Exams</a></li>
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
                                <h4 class="card-title">All Exams</h4>
                                <a href="new_exam.php" class="btn btn-square btn-secondary float-right">+ Add Exams</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example3" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Action</th>
                                                <th>EXAM</th>
                                                <th>TEACHER</th>
                                                <th>SUBJECT</th>
                                                <th>TYPE</th>
                                                <th>TIME DURATION</th>
                                                <th>QUESTIONS PER PAPER</th>
                                                <th>ADD TIME</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $join_str = "lms_exam_details INNER JOIN lmssubject ON lms_exam_details.lms_exam_subject=lmssubject.sid";
                                            $exam_qury = mysqli_query($conn, "SELECT * FROM $join_str ORDER BY lms_exam_id DESC");
                                            while ($exam_resalt = mysqli_fetch_array($exam_qury)) {
                                            ?>
                                                <tr>
                                                    <td style="white-space: nowrap;">
                                                        <a href="q_list.php?exam_id=<?php echo $exam_resalt['lms_exam_id']; ?>" class="btn btn-sm btn-success" title="Add question"><i class="fa fa-question"></i></a>
                                                        <a href="new_exam.php?lms_exam_id=<?php echo $exam_resalt['lms_exam_id']; ?>" class="btn btn-sm btn-primary" title="Test Exam"><i class="fa fa-edit"></i></a>
                                                        <a href="exam.php?remove=<?php echo $exam_resalt['lms_exam_id']; ?>" class="btn btn-sm btn-danger" title="Test Exam" onClick="JavaScript:return confirm('Are your sure remove this exam?');">
                                                            <i class="fa fa-trash"></i></a>

                                                    </td>
                                                    <td><?php echo $exam_resalt['lms_exam_name']; ?></td>
                                                    <td><?php

                                                        $id = $exam_resalt['lms_exam_add_user'];

                                                        $query = $DB_con->prepare('SELECT fullname FROM lmstealmsr WHERE tid=' . $id);

                                                        $query->execute();

                                                        $result = $query->fetch();

                                                        echo $result['fullname'];

                                                        ?></td>
                                                    <td><?php echo $exam_resalt['name']; ?></td>
                                                    <td>
                                                        <?php

                                                        if ($exam_resalt['lms_exam_pay_type'] == "0") {

                                                            echo '<button class="btn btn-primary btn-sm">Free</button>';
                                                        } else if ($exam_resalt['lms_exam_pay_type'] == "1") {

                                                            echo '<button class="btn btn-success btn-sm">Payed</button>';
                                                        }

                                                        ?>
                                                    </td>
                                                    <td><?php echo $exam_resalt['lms_exam_time_duration'] . "Min"; ?></td>
                                                    <td><?php echo $exam_resalt['lms_exam_question']; ?></td>
                                                    <td><?php echo date_format(date_create($exam_resalt['lms_exam_add_time']), "M d, Y - h:i:s A"); ?></td>
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