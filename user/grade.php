<?php

require_once("../dashboard/conn.php");

?>

<?php
require_once 'header.php';
?>

<?php
require_once 'navheader.php';
?>

<?php 

$grade =0;
$medium = 4;
   if( $_GET["grade"] != null && $_GET["medium"] != null  ){

        $grade = (int)$_GET["grade"];
        $medium = (int)$_GET["medium"];
        
   }
    
?>

<div class="content-wrapper p-2 gd">
    <div class="content_head pt-2">
        <h4 class="text-center" data-grade-id="">Grade</h4>
    </div>
    <div class="content_body text-center pt-2">
        <div class="row">
            <div class="col-9 left_side">
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <a class="btn btn-secondary" href="video_list.php">
                            Lesson Explanation
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <a class="btn btn-secondary" href="pdf.php">
                            Lesson Explanation by Students

                            <?php 
                               $pdflist =  "SELECT `tdocument` FROM `lmsclasstute_std`where `class`=4 and `subject`=18"; 
                               
                               $retval = mysql_query( $pdflist, $conn );

                               while($row = mysql_fetch_array($retval, MYSQL_ASSOC)) {
                                echo "EMP ID :{$row['emp_id']}  <br> ".
                                   "EMP NAME : {$row['emp_name']} <br> ".
                                   "EMP SALARY : {$row['emp_salary']} <br> ".
                                   "--------------------------------<br>";
                             }


                            ?>
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <a class="btn btn-secondary" href="pdf.php">
                            Student Notes
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <a class="btn btn-secondary" href="video_list.php">
                            Lesson Revision
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <a class="btn btn-secondary" href="pdf.php">
                            Practicals by Students
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <a class="btn btn-secondary" href="pdf.php">
                            Students School Papers
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <a class="btn btn-secondary" href="video_list.php">
                            Paper Discussions
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <a class="btn btn-secondary" href="pdf.php">
                            Books and Papers
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <a class="btn btn-secondary" class="btn btn-primary" href="">
                            Students Class Papers
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-3 right_side">
                <div class="row">
                    <div class="col-md-12">
                        <a class="btn btn-info" href="std_list.php">
                            Our Smart Students
                        </a>
                    </div>
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