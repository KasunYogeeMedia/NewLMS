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
                <div class="links-2 my-5">
                    <a class="btn btn-secondary btn-lg w-100 mb-2" href="common_video.php?gid=13">Science of Life <br> ජිවිත විද්‍යාව</a>
                    <a class="btn btn-secondary btn-lg w-100 mb-2" href="ol_result.php">O/L Result</a>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <h5 class="pb-3">සිංහල මාධ්‍යය</h5>
                <div class="links-3">
                    <a class="btn btn-primary btn-lg w-100 mb-2" href="grade.php?gid=1">Grade 6</a>
                    <a class="btn btn-primary btn-lg w-100 mb-2" href="grade.php?gid=2">Grade 7</a>
                    <a class="btn btn-primary btn-lg w-100 mb-2" href="grade.php?gid=3">Grade 8</a>
                    <a class="btn btn-primary btn-lg w-100 mb-2" href="grade.php?gid=4">Grade 9</a>
                    <a class="btn btn-primary btn-lg w-100 mb-2" href="grade.php?gid=5">Grade 10</a>
                    <a class="btn btn-primary btn-lg w-100 mb-2" href="grade.php?gid=6">Grade 11</a>
                </div>
            </div>
        </div>
    </div>
    <div class="logo_banner text-center py-3 mt-4">
        <img class="img-fluid fot_logo" src="inc/img/logo.png" alt="">
    </div>
</div>
<?php
require_once '../dashboard/copyright.php';
?>
<?php
require_once '../dashboard/footer.php';
?>