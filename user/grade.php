<?php

require_once '../dashboard/dbconfig4.php';

require_once("../dashboard/config.php");

include '../dashboard/conn.php';
?>

<?php
require_once 'header.php';
?>

<?php
require_once 'navheader.php';
?>

<?php
$grade = 0;
if ($_GET["grade"] != null) {

    // $grade = (int)$_GET["grade"];
    $grade = (int)$_GET["grade"];
}

?>

<div class="content-wrapper p-2 ml-0 gd">
    <div class="content_head pt-2">
        <?php
        $query = $DB_con->prepare('SELECT name FROM lmssubject WHERE sid=' . $grade);
        $query->execute();
        $result = $query->fetch();
        echo $result['name'];
        ?>
        <h4 class="text-center" data-grade-id="">Grade <?php echo "$grade" ?></h4>
    </div>
    <div class="content_body text-center pt-2">
        <div class="row">
            <div class="col-9 left_side">
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <a class="btn btn-secondary" href="video_list.php?grade=<?php echo "$grade" ?>">
                            Lesson Explanation
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <a class="btn btn-secondary" href="std_video_list.php">
                            Lesson Explanation by Students
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <a class="btn btn-secondary" href="std_pdf.php">
                            Student Notes
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <a class="btn btn-secondary" href="video_list.php">
                            Lesson Revision
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <a class="btn btn-secondary" href="std_video_list.php">
                            Practicals by Students
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <a class="btn btn-secondary" href="std_pdf.php">
                            Students School Papers
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <a class="btn btn-secondary" href="video_list.php">
                            Paper Discussions
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <a class="btn btn-secondary" href="pdf.php">
                            Books and Papers
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <a class="btn btn-secondary" class="btn btn-primary" href="std_pdf.php">
                            Students Class Papers
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-3 right_side">
                <div class="row">
                    <div class="col-md-12">
                        <a class="btn btn-info" href="std_list.php">
                            Our Smart Students
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once '../dashboard/copyright.php';
?>
<?php
require_once '../dashboard/footer.php';
?>