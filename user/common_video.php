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

$grade = 0;
if ($_GET["grade"] != null) {

    // $grade = (int)$_GET["grade"];
    $grade = (int)$_GET["grade"];
}

?>

<style type="text/css">
    .modal-content iframe {
        margin: 0 auto;
        display: block;
    }

    iframe {
        width: 100%;
    }
</style>
<script type="text/javascript">
    $(document).ready(function() {
        var url = $("#cartoonVideo").attr('src');

        $("#myModal").on('hide.bs.modal', function() {
            $("#cartoonVideo").attr('src', '');
        });

        $("#myModal").on('show.bs.modal', function() {
            $("#cartoonVideo").attr('src', url);
        });
    });
</script>

<div class="content-wrapper p-2 ml-0">
    <div class="content_head pt-2">
        <h4 class="text-center">Science of life</h4>
    </div>
    <div class="content_body text-center pt-2">
        <table class="table table-dark table-bordered">
            <thead>
                <tr>
                    <th scope="col">Topic</th>
                    <th scope="col">Video Link</th>

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
                                <a href="#myModal" class="btn btn-primary" data-toggle="modal">Watch Video</a>
                                <div id="myModal" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-body">
                                                <iframe width="560" height="315" src="https://www.youtube.com/embed/e9p4Epkqv0k" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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
require_once '../dashboard/copyright.php';
?>
<?php
require_once '../dashboard/footer.php';
?>