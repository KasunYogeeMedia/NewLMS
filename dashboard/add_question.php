<?php

session_start();

require_once 'includes.php';
require_once 'conn.php';
require_once("config.php");
require_once 'dbconfig4.php';

date_default_timezone_set("Asia/Colombo");


$edit = 0;

if (isset($_GET["edit"])) {
    $edit = 1;
}

if (isset($_POST['submit']) && isset($_POST['update'])) {

    print_r($_POST);

    $exam_id = $_POST['exam_id'];

    $sql = "SELECT * FROM lms_exam_details where lms_exam_id = :id";
    $query = $DB_con->prepare($sql);
    $query->bindParam('id', $exam_id);
    $query->execute();

    if ($query->rowCount() == 0) {
        die();
    }

    $result = $query->fetch();

    $question_count = $result['lms_exam_question'];

    $sql = "UPDATE lms_mcq_questions SET question = :question, ans_1 = :ans_1, ans_2 = :ans_2, ans_3 = :ans_3, ans_4 = :ans_4, ans = :ans WHERE id = :q_id";
    $query = $DB_con->prepare($sql);

    for ($i = 1; $i <= $question_count; $i++) {

        $q_id = htmlspecialchars($_POST["q_" . $i . "_id"]);
        $question = $_POST["q_" . $i . "_question"];
        $ans_1 = htmlspecialchars($_POST["q_" . $i . "_ans_1"]);
        $ans_2 = htmlspecialchars($_POST["q_" . $i . "_ans_2"]);
        $ans_3 = htmlspecialchars($_POST["q_" . $i . "_ans_3"]);
        $ans_4 = htmlspecialchars($_POST["q_" . $i . "_ans_4"]);
        $ans = htmlspecialchars($_POST["q_" . $i . "_ans"]);

        $query->bindParam('q_id', $q_id);
        $query->bindParam('question', $question);
        $query->bindParam('ans_1', $ans_1);
        $query->bindParam('ans_2', $ans_2);
        $query->bindParam('ans_3', $ans_3);
        $query->bindParam('ans_4', $ans_4);
        $query->bindParam('ans', $ans);
        $query->execute();

        $edit = 1;
    }
}



if (isset($_POST['submit'])) {

    $exam_id = $_POST['exam_id'];

    $sql = "SELECT * FROM lms_exam_details where lms_exam_id = :id";
    $query = $DB_con->prepare($sql);
    $query->bindParam('id', $exam_id);
    $query->execute();

    if ($query->rowCount() == 0) {
        die();
    }

    $result = $query->fetch();

    $question_count = $result['lms_exam_question'];

    $sql = "INSERT INTO lms_mcq_questions (exam_id, question, ans_1, ans_2, ans_3, ans_4, ans) VALUES (:exam_id, :question, :ans_1, :ans_2, :ans_3, :ans_4, :ans)";
    $query = $DB_con->prepare($sql);
    $query->bindParam('exam_id', $exam_id);

    for ($i = 1; $i <= $question_count; $i++) {

        $question = $_POST["q_" . $i . "_question"];
        $ans_1 = htmlspecialchars($_POST["q_" . $i . "_ans_1"]);
        $ans_2 = htmlspecialchars($_POST["q_" . $i . "_ans_2"]);
        $ans_3 = htmlspecialchars($_POST["q_" . $i . "_ans_3"]);
        $ans_4 = htmlspecialchars($_POST["q_" . $i . "_ans_4"]);
        $ans = htmlspecialchars($_POST["q_" . $i . "_ans"]);

        $query->bindParam('question', $question);
        $query->bindParam('ans_1', $ans_1);
        $query->bindParam('ans_2', $ans_2);
        $query->bindParam('ans_3', $ans_3);
        $query->bindParam('ans_4', $ans_4);
        $query->bindParam('ans', $ans);
        $query->execute();

        $edit = 1;
    }
    exit();
}


if ($edit == 1) {

    $sql = "SELECT * FROM lms_mcq_questions WHERE exam_id = :exam_id";
    $query = $DB_con->prepare($sql);
    $query->bindParam('exam_id', $exam_id);
    $query->execute();
    $edit_result = $query->fetchAll();

    //print_r($edit_result);
}

?>

<?php
require_once 'header.php';
?>
<?php
require_once 'navheader.php';
?>
<?php
require_once 'sidebarmenu.php';
?>
<div class="content-wrapper">
    <!-- row -->
    <div class="container-fluid">

        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Add Question</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Add Question</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0);">Add Question</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add questions</h4>
                    </div>
                    <div class="card-body">
                        <?php if (isset($_GET['update'])) { ?>
                            <div class="alert alert-success alert-dismissible alert-alt solid fade show">
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
                                <strong>Success!</strong> Exam Details Updated Successfully..
                            </div>
                        <?php

                        }

                        ?>

                        <?php if (isset($_GET['success'])) { ?><div class="alert alert-success alert-dismissible alert-alt solid fade show">
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
                                <strong>Success!</strong> New Question Added Successfully.
                            </div><?php } ?>
                        <?php if (isset($_GET['removed'])) { ?><div class="alert alert-danger alert-dismissible alert-alt solid fade show">
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
                                <strong>Success!</strong> Question Removed Successfully.
                            </div><?php } ?>
                        <?php if (isset($_GET['update'])) { ?><div class="alert alert-primary alert-dismissible alert-alt solid fade show">
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
                                <strong>Success!</strong> Question Updated Successfully.
                            </div><?php } ?>
                        <form method="post" autocomplete="off">



                            <?php

                            $exam_id = $_GET['exam_id'];

                            $sql = "SELECT * FROM lms_exam_details where lms_exam_id = :id";
                            $query = $DB_con->prepare($sql);
                            $query->bindParam('id', $exam_id);
                            $query->execute();

                            if ($query->rowCount() == 0) {
                                die();
                            }

                            $result = $query->fetch();

                            $question_count = $result['lms_exam_question'];


                            for ($i = 1; $i <= $question_count; $i++) {

                                $j = $i - 1;
                            ?>
                                <div class="question-title">Question <?php echo $i; ?></div>
                                <div class="form-group">
                                    <label class="form-control" for="q_<?php echo $i; ?>_question">Question</label>

                                    <?php
                                    if ($edit == 1) {
                                        echo "<input type=\"hidden\" name=\"q_" . $i . "_id\" value=" . $edit_result[$j][0] . ">";
                                    }
                                    ?>

                                    <textarea class="q-editor" name="q_<?php echo $i; ?>_question" class="form-control" required="required"><?php if ($edit) {
                                                                                                                                                echo $edit_result[$j][2];
                                                                                                                                            } ?></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="text" value="<?php if ($edit) {
                                                                    echo $edit_result[$j][3];
                                                                } ?>" name="q_<?php echo $i; ?>_ans_1" class="form-control" placeholder="answer 1" required="required">
                                </div>
                                <div class="form-group">
                                    <input type="text" value="<?php if ($edit) {
                                                                    echo $edit_result[$j][4];
                                                                } ?>" name="q_<?php echo $i; ?>_ans_2" class="form-control" placeholder="answer 2" required="required">
                                </div>
                                <div class="form-group">
                                    <input type="text" value="<?php if ($edit) {
                                                                    echo $edit_result[$j][5];
                                                                } ?>" name="q_<?php echo $i; ?>_ans_3" class="form-control" placeholder="answer 3" required="required">
                                </div>
                                <div class="form-group">
                                    <input type="text" value="<?php if ($edit) {
                                                                    echo $edit_result[$j][6];
                                                                } ?>" name="q_<?php echo $i; ?>_ans_4" class="form-control" placeholder="answer 4" required="required">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label class="form-control" for="q_<?php echo $i; ?>_ans">Pick the correct answer</label>
                                        </div>
                                        <div class="col-sm-6">
                                            <select name="q_<?php echo $i; ?>_ans" class="form-control">
                                                <option value="1" <?php if ($edit && $edit_result[$j][7] == 1) {
                                                                        echo "selected= \"selected\"";
                                                                    } ?>>Answer 1</option>
                                                <option value="2" <?php if ($edit && $edit_result[$j][7] == 2) {
                                                                        echo "selected= \"selected\"";
                                                                    } ?>>Answer 2</option>
                                                <option value="3" <?php if ($edit && $edit_result[$j][7] == 3) {
                                                                        echo "selected= \"selected\"";
                                                                    } ?>>Answer 3</option>
                                                <option value="4" <?php if ($edit && $edit_result[$j][7] == 4) {
                                                                        echo "selected= \"selected\"";
                                                                    } ?>>Answer 4</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }

                            ?>





                            <div class="form-group">
                                <?php
                                if ($edit == 1) {
                                    echo "<input type=\"hidden\" name=\"update\" value=\"1\">";
                                }
                                ?>
                                <input type="hidden" name="exam_id" value="<?php echo $exam_id; ?>">
                                <input type="submit" name="submit" value="Submit" class="form-control">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>

<script>
    $(".q-editor").each(function() {
        CKEDITOR.replace(this);
    });
</script>

<?php
require_once 'copyright.php';
?>
<?php
require_once 'footer.php';
?>