<?php

require_once '../dashboard/dbconfig4.php';

require_once("../dashboard/config.php");

include '../dashboard/conn.php';
?>

<?php
require_once 'header.php';
?>

<style type="text/css">
    .modal-content iframe {
        margin: 0 auto;
        display: block;
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

<div class="content-wrapper p-2 video">
    <div class="content_head pt-2">
        <h4 class="text-center">Video List</h4>
    </div>
    <div class="content_body text-center pt-2">
        <table class="table table-dark table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Video</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Sample Video</td>
                    <td>
                        <a href="#myModal" class="btn btn-primary" data-toggle="modal">Watch Video</a>
                        <div id="myModal" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-body">
                                        <iframe id="cartoonVideo" width="100%" height="315" src="//www.youtube.com/embed/YE7VzlLtp-4" frameborder="0" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
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