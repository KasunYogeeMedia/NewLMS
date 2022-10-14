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


<div class="content-wrapper p-2 ml-0">
    <div class="content_head pt-2">
        <h4 class="text-center">Smart Science</h4>
    </div>
    <div class="content_body text-center pt-2">
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <h5 class="pb-3">English Medium</h5>
                <div class="links-1">
                    <a class="btn btn-primary btn-lg w-100 mb-2" href="grade.php?grade=7">Grade 6</a>
                    <a class="btn btn-primary btn-lg w-100 mb-2" href="grade.php?grade=8">Grade 7</a>
                    <a class="btn btn-primary btn-lg w-100 mb-2" href="grade.php?grade=9">Grade 8</a>
                    <a class="btn btn-primary btn-lg w-100 mb-2" href="grade.php?grade=10">Grade 9</a>
                    <a class="btn btn-primary btn-lg w-100 mb-2" href="grade.php?grade=11">Grade 10</a>
                    <a class="btn btn-primary btn-lg w-100 mb-2" href="grade.php?grade=12">Grade 11</a>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="links-2 my-5">
                    <a class="btn btn-secondary btn-lg w-100 mb-2" href="common_video.php?grade=13">Science of Life <br> ජිවිත විද්‍යාව</a>
                    <a class="btn btn-secondary btn-lg w-100 mb-2" href="ol_result.php">O/L Result</a>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <h5 class="pb-3">සිංහල මාධ්‍යය</h5>
                <div class="links-3">
                    <a class="btn btn-primary btn-lg w-100 mb-2" href="grade.php?grade=1">Grade 6</a>
                    <a class="btn btn-primary btn-lg w-100 mb-2" href="grade.php?grade=2">Grade 7</a>
                    <a class="btn btn-primary btn-lg w-100 mb-2" href="grade.php?grade=3">Grade 8</a>
                    <a class="btn btn-primary btn-lg w-100 mb-2" href="grade.php?grade=4">Grade 9</a>
                    <a class="btn btn-primary btn-lg w-100 mb-2" href="grade.php?grade=5">Grade 10</a>
                    <a class="btn btn-primary btn-lg w-100 mb-2" href="grade.php?grade=6">Grade 11</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once '../dashboard/copyright.php';
?>
<?php
require_once '../dashboard/footer.php';
?>