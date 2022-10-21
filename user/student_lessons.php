<?php

require_once '../dashboard/dbconfig4.php';

require_once("../dashboard/config.php");

include '../dashboard/conn.php';
?>

<?php
require_once '../dashboard/header.php';
?>

<?php

$gid = 0;
if ($_GET["gid"] != null) {

    $gid = (int)$_GET["gid"];
    $sid = (int)$_GET["sid"];
}

?>

<div class="content-wrapper p-2 ml-0 pt-5 video">
    <div class="content_head pt-2">
        <table>
            <tr>
                <td>
                    <?php
                    $query = $DB_con->prepare('SELECT fullname FROM lmstealmsr WHERE tid=' . $sid);
                    $query->execute();
                    $result = $query->fetch();
                    ?>
                    <h4 class="text-center" data-gid-id=""><?php echo $result['fullname']; ?>&nbsp;</h4>
                </td>
                <td>
                    <?php
                    $query = $DB_con->prepare('SELECT name FROM lmssubject WHERE sid=' . $gid);
                    $query->execute();
                    $result = $query->fetch();
                    ?>
                    <h4 class="text-center"> - Student Lesson Explanations <?php echo $result['name']; ?></h4>
                </td>
            </tr>
        </table>
    </div>
    <div class="content_body text-center pt-2">
        <table id="example1" class="table table-dark table-bordered">
            <thead>
                <tr>

                    <th scope="col">Title</th>
                    <th scope="col">Video</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $stmt = $DB_con->prepare('SELECT * FROM lmslesson WHERE type = "student_lesson_explanations" AND subject = "' . $gid . '" AND tid = "' . $sid . '" ORDER BY lid');

                $stmt->execute();

                if ($stmt->rowCount() > 0) {

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                        extract($row);
                ?>
                        <tr>
                            <td><?php echo $row['title']; ?></td>
                            <td>
                                <a class="btn btn-danger" target="_blank" href="<?php echo $row['video']; ?>">Video</a>
                            </td>
                        </tr>
                <?php }
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