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