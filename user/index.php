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


<div class="content-wrapper p-2 ml-0 pt-5">
    <div class="content_head pt-2">
        <h4 class="text-center">Smart Science</h4>
    </div>
    <div class="content_body text-center pt-2">
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <h5 class="pb-3">English Medium</h5>
                <div class="links-1">
                    <a class="btn btn-primary btn-lg w-100 mb-2" href="grade.php?gid=7">Grade 6</a>
                    <a class="btn btn-primary btn-lg w-100 mb-2" href="grade.php?gid=8">Grade 7</a>
                    <a class="btn btn-primary btn-lg w-100 mb-2" href="grade.php?gid=9">Grade 8</a>
                    <a class="btn btn-primary btn-lg w-100 mb-2" href="grade.php?gid=10">Grade 9</a>
                    <a class="btn btn-primary btn-lg w-100 mb-2" href="grade.php?gid=11">Grade 10</a>
                    <a class="btn btn-primary btn-lg w-100 mb-2" href="grade.php?gid=12">Grade 11</a>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 mid_col">
                <div class="links-2">
                    <div class="mid_logo">
                        <img class="img-fluid fot_logo px-4 py-2" src="inc/img/logo.png" alt="">
                    </div>
                    <a class="btn btn-secondary btn-lg w-100 mb-2" href="common_video.php?gid=13">Science of Life <br> ජිවිත විද්‍යාව</a>
                    <a class="btn btn-secondary btn-lg w-100 mb-2" href="ol_result.php">O/L Result</a>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <h5 class="pb-3">සිංහල මාධ්‍යය</h5>
                <div class="links-3">
                    <a class="btn btn-primary btn-lg w-100 mb-2" href="grade_sin.php?gid=1">6 ශ්‍රේණිය</a>
                    <a class="btn btn-primary btn-lg w-100 mb-2" href="grade_sin.php?gid=2">7 ශ්‍රේණිය</a>
                    <a class="btn btn-primary btn-lg w-100 mb-2" href="grade_sin.php?gid=3">8 ශ්‍රේණිය</a>
                    <a class="btn btn-primary btn-lg w-100 mb-2" href="grade_sin.php?gid=4">9 ශ්‍රේණිය</a>
                    <a class="btn btn-primary btn-lg w-100 mb-2" href="grade_sin.php?gid=5">10 ශ්‍රේණිය</a>
                    <a class="btn btn-primary btn-lg w-100 mb-2" href="grade_sin.php?gid=6">11 ශ්‍රේණිය</a>
                </div>
            </div>
        </div>
        <div class="row pt-4">
            <div class="col-sm-4">
                <img class="img-fluid" src="inc/img/Whatsapp_Webnote.png" alt="">
            </div>
            <div class="col-sm-4">
                <img class="img-fluid" src="inc/img/Youtube_Webnote.png" alt="">
                <script src="https://apis.google.com/js/platform.js"></script>

                <div class="g-ytsubscribe" data-channelid="UCeODAbqACW-Ab8kmang9Mvw" data-layout="full" data-count="default"></div>
            </div>
            <div class="col-sm-4">
                <img class="img-fluid" src="inc/img/print _Webnote.png" alt="">
            </div>
        </div>
    </div>

</div>
<?php
require_once 'copyright.php';
?>
<?php
require_once '../dashboard/footer.php';
?>