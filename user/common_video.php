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

    $gid = (int)$_GET["gid"];
}

?>

<div class="content-wrapper p-2 ml-0">
    <div class="content_head pt-2">
        <h4 class="text-center">Science of life - ජිවිත විද්‍යාව </h4>
    </div>
    <div class="content_body text-center pt-2">
        <table id="example1" class="table table-dark table-bordered">
            <thead>
                <tr>
                    <th scope="col">Topic</th>
                    <th scope="col">Video</th>

                </tr>
            </thead>
            <tbody>
                <?php

                $stmt = $DB_con->prepare('SELECT * FROM lmslesson WHERE type = "general" ORDER BY lid');

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
                <?php
                    }
                } else {
                    echo "0 results";
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