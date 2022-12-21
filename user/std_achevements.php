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
    $sid = (int)$_GET["sid"];
}

?>

<div class="content-wrapper p-2 ml-0 pt-5 pdf">
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
                    <h4 class="text-center"> - Student Achevements <?php echo $result['name']; ?></h4>
                </td>
            </tr>
        </table>
    </div>
    <div class="content_body text-center pt-2">
        <table id="example1" class="table table-dark table-bordered">
            <thead>
                <tr>
                    <th>Medium</th>
                    <th>Grade</th>
                    <th>Title</th>
                    <th>Document</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $stmt = $DB_con->prepare('SELECT * FROM lmsebook Where subject = "' . $gid . '" AND tid = "' . $sid . '" ORDER BY ctuid');

                $stmt->execute();

                if ($stmt->rowCount() > 0) {

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                        extract($row);

                ?>
                        <tr>

                            <td>
                                <?php
                                $id = $row['class'];
                                $query = $DB_con->prepare('SELECT name FROM lmsclass WHERE cid=' . $id);
                                $query->execute();
                                $result = $query->fetch();
                                echo $result['name'];
                                ?></td>
                            <td>
                                <?php
                                $id = $row['subject'];
                                $query = $DB_con->prepare('SELECT name FROM lmssubject WHERE sid=' . $id);
                                $query->execute();
                                $result = $query->fetch();
                                echo $result['name'];
                                ?>
                            </td>
                            <td><?php echo $row['title']; ?></td>

                            <td><a href="../dashboard/images/classtute/<?php echo $row['tdocument']; ?>" target="_blank">View Student Achievement</a></td>
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