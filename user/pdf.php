<?php

require_once("../dashboard/conn.php");

?>

<?php
require_once 'header.php';
?>

<?php
require_once 'navheader.php';
?>

<div class="content-wrapper p-2 pdf">
    <div class="content_head pt-2">
        <h4 class="text-center">PDF List</h4>
    </div>
    <div class="content_body text-center pt-2">
        <table class="table table-dark table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Document</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Sample Document</td>
                    <td>
                        <a href="" class="btn btn-primary" data-toggle="modal">Document</a>
                    </td>
                </tr>
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