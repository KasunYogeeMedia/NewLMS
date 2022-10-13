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

<div class="content-wrapper p-2 ml-0">
    <div class="content_head pt-2">
        <h4 class="text-center">student List</h4>
    </div>
    <div class="content_body text-center pt-2">
        <table class="table table-dark table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Profile Picture </th>
                    <th scope="col">Student Name</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 0;
                $tec_qury = mysqli_query($conn, "SELECT * FROM lmstealmsr ORDER BY fullname");
                while ($tec_resalt = mysqli_fetch_array($tec_qury)) {
                    $count++;
                ?>
                    <tr>
                        <th scope="row">
                            <?php echo $tec_resalt['tid']; ?>
                        </th>
                        <td>
                            <?php if ($tec_resalt['image'] == "") {
                                $pro_img = "../profile/images/hd_dp.jpg";
                            } else {
                                $pro_img = "../dashboard/images/teacher/" . $tec_resalt['image'];
                            } ?><img src="<?php echo $pro_img; ?>" class="img_fluid">
                        </td>
                        <td>
                            <a href="smart_students.php" class="btn btn-primary"><?php echo $tec_resalt['fullname']; ?></a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
require_once '../dashboard/copyright.php';
?>
<?php
require_once '../dashboard/footer.php';
?>