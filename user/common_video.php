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
<!-- test-->
<button type="button" class="video-btn" data-bs-toggle="modal" data-bs-target="#videoModal" data-bs-src="https://www.youtube.com/embed/EzDC8aAJln0">
    <img src="//via.placeholder.com/300x200" class="img-fluid" alt="DbSchema Video Presentation">
</button>
<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="dbschemaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
                <div class="ratio ratio-16x9">
                    <iframe class="embed-responsive-item" src="" id="video" allowscriptaccess="always" allow="autoplay"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var videoBtn = document.querySelector('.video-btn')
    var videoModal = document.getElementById('videoModal')
    var video = document.getElementById('video')
    var videoSrc

    videoBtn.addEventListener('click', function(e) {
        videoSrc = videoBtn.getAttribute('data-bs-src')
    })

    videoModal.addEventListener('shown.bs.modal', (e) => {
        video.setAttribute('src', videoSrc + '?autoplay=1&amp;modestbranding=1&amp;showinfo=0')
    })

    videoModal.addEventListener('hide.bs.modal', (e) => {
        video.setAttribute('src', videoSrc)
    })
</script>
<!-- test -->

<?php
require_once 'copyright.php';
?>
<?php
require_once '../dashboard/footer.php';
?>