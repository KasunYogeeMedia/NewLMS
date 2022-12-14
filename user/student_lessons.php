<?php

require_once '../dashboard/dbconfig4.php';

require_once("../dashboard/config.php");

include '../dashboard/conn.php';
?>

<?php
require_once 'header.php';
?>

<?php

$gid = 0;
if ($_GET["gid"] != null) {

    $gid = (int)$_GET["gid"];
    $sid = (int)$_GET["sid"];
}

?>

<div class="content-wrapper p-2 ml-0 pt-5 video">
<button onclick="history.back()" class="btn btn-secondary"><i class="fa fa-chevron-left" aria-hidden="true"> </i></button>
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
                                <!-- Button HTML (to Trigger Modal) -->
                                <a href="#myModal<?php echo $row['lid']; ?>" class="btn btn-primary btn-sm" data-toggle="modal">Watch Video</a>

                                <!-- Modal HTML -->
                                <div id="myModal<?php echo $row['lid']; ?>" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">YouTube Video</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="embed-responsive embed-responsive-16by9">
                                                    <iframe id="cartoonVideo" class="embed-responsive-item" width="100%" height="auto" src="<?php echo $row['video']; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
require_once 'copyright.php';
?>
<?php
require_once '../dashboard/footer.php';
?>