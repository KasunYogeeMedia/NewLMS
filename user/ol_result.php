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

<div class="content-wrapper p-2 ml-0 pt-5">
    <div class="content_head pt-2">
        <h4 class="text-center">Smart Science</h4>
    </div>
    <div class="content_body text-center pt-2">
        <table id="example1" class="table table-dark table-bordered">
            <thead>
                <tr>
                    <th scope="col">Student Name</th>
                    <th scope="col">Batch</th>
                    <th scope="col">Index No</th>
                    <th scope="col">Result</th>
                    <th scope="col">Document</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $stmt = $DB_con->prepare('SELECT * FROM lmsclasstute ORDER BY ctuid');

                $stmt->execute();

                if ($stmt->rowCount() > 0) {

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                        extract($row);

                ?>
                        <tr>
                            <td>
                                <?php

                                $id = $row['tid'];

                                $query = $DB_con->prepare('SELECT fullname FROM lmstealmsr WHERE tid=' . $id);

                                $query->execute();

                                $result = $query->fetch();

                                echo $result['fullname'];

                                ?>
                            </td>
                            <td><?php echo $row['title']; ?></td>
                            <td><?php echo $row['ctype']; ?></td>
                            <td><?php echo $row['month']; ?></td>
                            <td><a href="../dashboard/images/classtute/<?php echo $row['tdocument']; ?>" target="_blank">View Tute</a></td>
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