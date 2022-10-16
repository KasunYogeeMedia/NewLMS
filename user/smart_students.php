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

$gid=0;
if ($_GET["gid"] != null) {
    
    $gid=(int)$_GET["gid"];
}

?>

<div class="content-wrapper p-2 ml-0 std_list">
    <div class="content_head pt-2">
        <h4 class="text-center">Student name</h4>
    </div>
    <div class="content_body text-center pt-2">
        <div class="row">
            <div class="col-sm-9 col-xs-12 left_side">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <a class="btn btn-secondary" href="std_video.php">
                            Student Practicals
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <a class="btn btn-secondary" href="std_pdf.php">
                            Student School Papers
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <a class="btn btn-secondary" href="std_video.php">
                            Student Lesson Explanations
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <a class="btn btn-secondary" href="std_pdf.php">
                            Students Class Papers
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <a class="btn btn-secondary" href="std_pdf.php">
                            Students Notes
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <a class="btn btn-secondary" href="std_pdf.php">
                            Students Achevements
                        </a>
                    </div>

                </div>
            </div>
            <div class="col-sm-3 col-xs-12 right_side col-md-push-1">
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        $aaid =
                            $tec_qury = mysqli_query($conn, "SELECT * FROM lmstealmsr Where tid = 16");
                        $tec_resalt = mysqli_fetch_array($tec_qury);
                        ?>
                        <?php if ($tec_resalt['image'] == "") {
                            $pro_img = "../profile/images/hd_dp.jpg";
                        } else {
                            $pro_img = "../dashboard/images/teacher/" . $tec_resalt['image'];
                        } ?><img src="<?php echo $pro_img; ?>" class="img-fluid">

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