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
                    <h4>Students Attendence</h4>
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
                                    <table id="example1" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Teacher</th>
                                                <th>Lesson</th>
                                                <th>Grade</th>
                                                <th>Subject</th>
                                                <th>Month</th>
                                                <th>Date</th>
                                                <th>Start</th>
                                                <th>End</th>
                                                <th>Add Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count = 0;
                                            $list_qury = mysqli_query($conn, "SELECT * FROM lmsclass_schlmsle INNER JOIN lmstealmsr ON lmsclass_schlmsle.tealmsr=lmstealmsr.tid ORDER BY classid DESC");

                                            while ($list_resalt = mysqli_fetch_array($list_qury)) {
                                                $count++;

                                                $level_qury = mysqli_query($conn, "SELECT * FROM lmsclass WHERE cid='$list_resalt[level]'");
                                                $level_resalt = mysqli_fetch_array($level_qury);

                                                $subject_qury = mysqli_query($conn, "SELECT * FROM lmsclass_schlmsle WHERE classid='$list_resalt[classid]'");
                                                $subject_resalt = mysqli_fetch_array($subject_qury);
                                            ?>
                                                <tr>
                                                    <td><?php echo number_format($count, 0); ?></td>
                                                    <td style="text-transform: capitalize;"><?php echo $list_resalt['fullname']; ?></td>
                                                    <td style="text-transform: capitalize;"><a href="attendence_result.php?att_res=<?php echo $list_resalt['classid']; ?>"><?php echo $list_resalt['lesson']; ?></a></td>
                                                    <td style="text-transform: capitalize;"><?php echo $level_resalt['name']; ?></td>
                                                    <td style="text-transform: capitalize;">
                                                        <?php

                                                        $id = $subject_resalt['subject'];

                                                        require_once 'dbconfig4.php';

                                                        $query = $DB_con->prepare('SELECT name FROM lmssubject WHERE sid=' . $id);

                                                        $query->execute();

                                                        $result = $query->fetch();

                                                        echo $result['name'];

                                                        ?>
                                                    </td>
                                                    <td><span class="badge badge-primary" style="font-size:14px;"> <?php echo date_format(date_create($list_resalt['add_date2']), "F"); ?></span></td>
                                                    <td><?php echo date_format(date_create($list_resalt['classdate']), "M d, Y"); ?></td>
                                                    <td><?php echo date_format(date_create($list_resalt['class_start_time']), "h:i:s A"); ?></td>
                                                    <td><?php echo date_format(date_create($list_resalt['class_end_time']), "h:i:s A"); ?></td>
                                                    <td><?php echo date_format(date_create($list_resalt['add_date2']), " h:i:s A"); ?></td>

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
require_once 'copyright.php';
?>
<?php
require_once 'footer.php';
?>