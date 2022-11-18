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

<div class="content-wrapper p-2 ml-0 pt-5">
    <div class="content_head pt-2">
        <?php
        $query = $DB_con->prepare('SELECT name FROM lmssubject WHERE sid=' . $gid);
        $query->execute();
        $result = $query->fetch();
        ?>
        <h4 class="text-center"><?php echo $result['name']; ?> ශිෂ්‍යය ලැයිස්තුව</h4>
    </div>
    <div class="content_body text-center pt-2">
        <table class="table table-dark table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Profile Picture </th>
                    <th scope="col">Student Name</th>
                    <th scope="col">Details</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 0;
                // $tec_qury = mysqli_query($conn, "SELECT * FROM lmstealmsr ORDER BY fullname");
                $tec_qury = mysqli_query($conn, "SELECT * FROM lmstealmsr INNER JOIN lmstealmsr_multiple ON lmstealmsr.systemid=lmstealmsr_multiple.tealmsr_system_id INNER JOIN lmssubject ON lmstealmsr_multiple.tealmsr_contain_id=lmssubject.sid WHERE lmssubject.sid = '" . $gid . "' ");

                while ($tec_resalt = mysqli_fetch_array($tec_qury)) {
                    $count++;
                ?>
                    <tr>
                        <th scope="row">
                            <?php echo $tec_resalt['tid']; ?>
                        </th>
                        <td class="img_td">
                            <?php if ($tec_resalt['image'] == "") {
                                $pro_img = "../profile/images/hd_dp.jpg";
                            } else {
                                $pro_img = "../dashboard/images/teacher/" . $tec_resalt['image'];
                            } ?><img src="<?php echo $pro_img; ?>" class="img_fluid">
                        </td>
                        <td>
                            <?php echo $tec_resalt['fullname']; ?>
                        </td>
                        <td>
                            <a href="smart_students.php?gid=<?php echo "$gid" ?>&sid=<?php echo $tec_resalt['tid']; ?>" class="btn btn-primary">View</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
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