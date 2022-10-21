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
        <h4 class="text-center" data-gid-id=""><?php echo $result['name']; ?> - සිංහල මාධ්‍යය</h4>
    </div>
    <div class="content_body text-center pt-2">
        <div class="row">
            <div class="col-sm-3 right_side">
                <div class="row">
                    <div class="col-md-12">
                        <a class="btn btn-info" href="std_list_sin.php?gid=<?php echo "$gid" ?>">
                            අපගේ පන්තියට සම්බන්ධ වන සිසුන්
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-9 left_side">
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <a class="btn btn-secondary" href="video_explanation.php?gid=<?php echo "$gid" ?>">
                            අභිමන් ගුරුතුමා විසින් සිදුකරන ලද පාඩම් පැහැදිලි කිරීම්
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <a class="btn btn-secondary" href="std_lessons.php?gid=<?php echo "$gid" ?>">
                            සිසුන් විසින් සිදුකරන ලද පාඩම් පැහැදිලි කිරීම්
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <a class="btn btn-secondary" href="pdf.php?gid=<?php echo "$gid" ?>">
                            පොත් සහ ප්‍රශ්න පත්‍ර
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <a class="btn btn-secondary" href="video_revision.php?gid=<?php echo "$gid" ?>">
                            අභිමන් ගුරුතුමා විසින් සිදුකරන ලද පාඩම් පුණරීක්ෂණ
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <a class="btn btn-secondary" href="std_practicles.php?gid=<?php echo "$gid" ?>">
                            සිසුන් විසින් සිදුකරන ලද විද්‍යාව ප්‍රායෝගික පරීක්ෂණ
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <a class="btn btn-secondary" href="std_pdf_school.php?gid=<?php echo "$gid" ?>">
                            සිසුන් විසින් පිළිතුරු සපයන ලද පාසල් ප්‍රශ්න පත්‍ර
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <a class="btn btn-secondary" href="video_discussions.php?gid=<?php echo "$gid" ?>">
                            අභිමන් ගුරුතුමා විසින් සිදුකරන ලද ප්‍රශ්න පත්‍ර සාකච්ඡා
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <a class="btn btn-secondary" href="std_pdf_notes.php?gid=<?php echo "$gid" ?>">
                            සිසුන්ගේ සටහන්
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <a class="btn btn-secondary" class="btn btn-primary" href="std_pdf_class.php?gid=<?php echo "$gid" ?>">
                            සිසුන් විසින් පිළිතුරු සපයන ලද විද්‍යාව පන්තියේ ප්‍රශ්න පත්‍ර
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="logo_banner text-center py-3 mt-4">
        <img class="img-fluid fot_logo" src="inc/img/logo.png" alt="">
    </div>
</div>
<?php
require_once '../dashboard/copyright.php';
?>
<?php
require_once '../dashboard/footer.php';
?>