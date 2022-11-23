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
$gid = 1;
if ($_GET["gid"] != null) {
    $gid = (int)$_GET["gid"];
}

?>

<div class="content-wrapper p-2 ml-0 pt-5 gd">
    <div class="content_head pt-2">
        <?php
        $query = $DB_con->prepare('SELECT name FROM lmssubject WHERE sid=' . $gid);
        $query->execute();
        $result = $query->fetch();
        ?>
        <h4 class="text-center" data-gid-id=""><?php echo $result['name']; ?> - English Medium</h4>
    </div>
    <div class="content_body text-center pt-2">
        <div class="row">
            <div class="col-sm-3 right_side">
                <div class="row">
                    <div class="col-md-12">
                        <a class="btn btn-info" href="std_list.php?gid=<?php echo "$gid" ?>">
                            Our Smart Students
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-9 left_side">
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <a class="btn btn-secondary" href="video_explanation.php?gid=<?php echo "$gid" ?>">
                            Lesson Explanation
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <a class="btn btn-secondary" href="std_lessons.php?gid=<?php echo "$gid" ?>">
                            Lesson Explanation by Students
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <a class="btn btn-secondary" href="pdf.php?gid=<?php echo "$gid" ?>">
                            Books and Papers
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <a class="btn btn-secondary" href="video_revision.php?gid=<?php echo "$gid" ?>">
                            Lesson Revision
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <a class="btn btn-secondary" href="std_practicles.php?gid=<?php echo "$gid" ?>">
                            Practicals by Students
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <a class="btn btn-secondary" href="std_pdf_school.php?gid=<?php echo "$gid" ?>">
                            Students School Papers
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <a class="btn btn-secondary" href="video_discussions.php?gid=<?php echo "$gid" ?>">
                            Paper Discussions
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-12">

                        <a class="btn btn-secondary" href="std_pdf_notes.php?gid=<?php echo "$gid" ?>">
                            Student Notes
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <a class="btn btn-secondary" class="btn btn-primary" href="std_pdf_class.php?gid=<?php echo "$gid" ?>">
                            Students Class Papers
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pt-4">
            <div class="col-sm-4">
                <img class="img-fluid" src="inc/img/Whatsapp_Webnote.png" alt="">
            </div>
            <div class="col-sm-4">
            <img class="img-fluid" src="inc/img/Youtube_Webnote.png" alt="">
            </div>
            <div class="col-sm-4">
            <img class="img-fluid" src="inc/img/print _Webnote.png" alt="">
            </div>
        </div>
    </div>
    
</div>
<?php
require_once 'copyright.php';
?>
<?php
require_once '../dashboard/footer.php';
?>