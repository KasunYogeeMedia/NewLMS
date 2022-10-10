<?php

require_once '../dashboard/dbconfig4.php';

require_once("../dashboard/config.php");

include '../dashboard/conn.php';
?>

<?php
require_once 'header.php';
?>

<div class="content-wrapper p-2 video">
    <div class="content_head pt-2">
        <h4 class="text-center">Video List</h4>
    </div>
    <div class="content_body text-center pt-2">
        <table class="table table-dark table-bordered">
            <thead>
                <tr>

                    <th scope="col">Title</th>
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