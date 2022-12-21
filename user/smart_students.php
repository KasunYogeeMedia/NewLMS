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

$gid = 0;
if ($_GET["gid"] != null) {

    $sid = (int)$_GET["sid"];
    $gid = (int)$_GET["gid"];
}

?>

<div class="content-wrapper p-2 ml-0 pt-5 std_list">
    <div class="content_head pt-2">
        <?php
        $query = $DB_con->prepare('SELECT fullname FROM lmstealmsr WHERE tid=' . $sid);
        $query->execute();
        $result = $query->fetch();
        ?>
        <h4 class="text-center" data-gid-id=""><?php echo $result['fullname']; ?></h4>
    </div>
    <div class="content_body text-center pt-2">
        <div class="row">
            <div class="col-sm-5 col-xs-12 right_side col-md-push-1">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="equl_img">
                            <img class="img-fluid" src="../dist/img/abiman_sir.jpg" alt="">
                        </div>
                        <div class="img_capt mt-2">
                            <span>Smart Teacher</span>
                            <br>
                            <span class="img_name"><?php echo $result['fullname']; ?></span>
                        </div>

                    </div>
                    <div class="col-md-6 col-sm-12">

                        <?php
                        $aaid =
                            $tec_qury = mysqli_query($conn, 'SELECT * FROM lmstealmsr Where tid =' . $sid);
                        $tec_resalt = mysqli_fetch_array($tec_qury);
                        ?>
                        <?php if ($tec_resalt['image'] == "") {
                            $pro_img = "../profile/images/hd_dp.jpg";
                        } else {
                            $pro_img = "../dashboard/images/teacher/" . $tec_resalt['image'];
                        } ?>
                        <div class="equl_img">
                            <img src="<?php echo $pro_img; ?>" class="img-fluid">
                        </div>
                        <div class="img_capt mt-2">
                            <span>Smart Student</span>
                            <br>
                            <span class="img_name"><?php echo $result['fullname']; ?></span>
                        </div>


                    </div>

                </div>
            </div>
            <div class="col-md-7 col-sm-6 col-xs-12 left_side">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <a class="btn btn-secondary" href="student_lessons.php?gid=<?php echo "$gid" ?>&sid=<?php echo "$sid" ?>">
                            Student Lesson Explanations
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <a class="btn btn-secondary" href="student_school.php?gid=<?php echo "$gid" ?>&sid=<?php echo "$sid" ?>">
                            Student School Papers
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <a class="btn btn-secondary" href="student_practicles.php?gid=<?php echo "$gid" ?>&sid=<?php echo "$sid" ?>">
                            Student Practicals
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <a class="btn btn-secondary" href="student_class.php?gid=<?php echo "$gid" ?>&sid=<?php echo "$sid" ?>">
                            Students Class Papers
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <a class="btn btn-secondary" href="student_notes.php?gid=<?php echo "$gid" ?>&sid=<?php echo "$sid" ?>">
                            Students Notes
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <a class="btn btn-secondary" href="std_achevements.php?gid=<?php echo "$gid" ?>&sid=<?php echo "$sid" ?>">
                            Students Achevements
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
require_once 'copyright.php';
?>
<?php
require_once '../dashboard/footer.php';
?>