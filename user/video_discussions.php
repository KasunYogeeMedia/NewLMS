<?php

require_once '../dashboard/dbconfig4.php';

require_once("../dashboard/config.php");

include '../dashboard/conn.php';
?>

<?php
require_once '../dashboard/header.php';
?>

<?php

$gid=0;
if ($_GET["gid"] != null) {

    $gid=(int)$_GET["gid"];
}

?>

<div class="content-wrapper p-2 ml-0 video">
    <div class="content_head pt-2">
    <?php
        $query = $DB_con->prepare('SELECT name FROM lmssubject WHERE sid=' . $gid);
        $query->execute();
        $result = $query->fetch();
        ?>
        <h4 class="text-center">Video List <?php echo $result['name']; ?></h4>
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

                $stmt = $DB_con->prepare('SELECT * FROM lmslesson WHERE type = "paper_discussions" AND subject = "'.$gid.'"  ORDER BY lid');

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