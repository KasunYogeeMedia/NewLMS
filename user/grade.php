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
            <div class="col-md-4 col-sm-12">
                <a class="" href="video_explanation.php?gid=<?php echo "$gid" ?>">
                    <img src="inc/img/1.png" class="img-fluid p-2 p-sm-3" alt="smartstudent">
                </a>
            </div>
            <div class="col-md-4 col-sm-12">
                <a class="" href="std_lessons.php?gid=<?php echo "$gid" ?>">
                    <img src="inc/img/2.png" class="img-fluid p-2 p-sm-3" alt="smartstudent">
                </a>
            </div>
            <div class="col-md-4 col-sm-12">
                <a class="" href="pdf.php?gid=<?php echo "$gid" ?>">
                    <img src="inc/img/3.png" class="img-fluid p-2 p-sm-3" alt="smartstudent">
                </a>
            </div>
            <div class="col-md-4 col-sm-12">
                <a class="" href="video_revision.php?gid=<?php echo "$gid" ?>">
                    <img src="inc/img/4.png" class="img-fluid p-2 p-sm-3" alt="smartstudent">
                </a>
            </div>
            <div class="col-md-4 col-sm-12">
                <a class="" href="std_practicles.php?gid=<?php echo "$gid" ?>">
                    <img src="inc/img/5.png" class="img-fluid p-2 p-sm-3" alt="smartstudent">
                </a>
            </div>
            <div class="col-md-4 col-sm-12">
                <a class="" href="std_pdf_school.php?gid=<?php echo "$gid" ?>">
                    <img src="inc/img/6.png" class="img-fluid p-2 p-sm-3" alt="smartstudent">
                </a>
            </div>
            <div class="col-md-4 col-sm-12">
                <a class="" href="video_discussions.php?gid=<?php echo "$gid" ?>">
                    <img src="inc/img/7.png" class="img-fluid p-2 p-sm-3" alt="smartstudent">
                </a>
            </div>
            <div class="col-md-4 col-sm-12">

                <a class="" href="std_pdf_notes.php?gid=<?php echo "$gid" ?>">
                    <img src="inc/img/8.png" class="img-fluid p-2 p-sm-3" alt="smartstudent">
                </a>
            </div>
            <div class="col-md-4 col-sm-12">
                <a class="" class="btn btn-primary" href="std_pdf_class.php?gid=<?php echo "$gid" ?>">
                    <img src="inc/img/9.png" class="img-fluid p-2 p-sm-3" alt="smartstudent">
                </a>
            </div>
            <div class="col-sm-12 right_side">
                <div class="mx-auto col-sm-4">
                    <a class="" href="std_list.php?gid=<?php echo "$gid" ?>">
                        <img src="inc/img/001.png" class="img-fluid p-2 p-sm-3" alt="smartstudent">
                    </a>
                </div>
            </div>
        </div>
        <div class="row pt-4">
            <div class="col-sm-4">
                <a href="https://wa.me/+772879970" target="_blank">
                    <img class="img-fluid" src="inc/img/Whatsapp_Webnote.png" alt="">
                </a>
            </div>
            <div class="col-sm-4">
                <img class="img-fluid" src="inc/img/Youtube_Webnote.png" alt="">
                <script src="https://apis.google.com/js/platform.js"></script>

                <div class="g-ytsubscribe" data-channelid="UC2ykzJT3wdnBae-7_hDlgLQ" data-layout="full" data-count="default"></div>
            </div>
            <div class="col-sm-4">
                <a href="https://wa.me/+778376761" target="_blank"><img class="img-fluid" src="inc/img/print _Webnote.png" alt=""></a>
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