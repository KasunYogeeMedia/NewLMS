<?php

session_start();

include '../dashboard/conn.php';

if (isset($_SESSION['tid'])) {

    echo "<script>window.location='home.php';</script>";
}

$error_not_match = 0;

$error_not_found = 0;

if (isset($_POST['login_bt'])) {

    $username = mysqli_real_escape_string($conn, $_POST['username']);

    $password = md5(mysqli_real_escape_string($conn, $_POST['password']));

    $usr_check = mysqli_query($conn, "SELECT * FROM lmstealmsr WHERE contactnumber  ='$username'");

    if (mysqli_num_rows($usr_check) > 0) {

        $user_resalt = mysqli_fetch_array($usr_check);

        if ($password == $user_resalt['password']) {

            $_SESSION['tid'] = $user_resalt['tid'];

            echo "<script>window.location='home.php';</script>";
        } else {
            //password not match
            $error_not_match = 1;
        }
    } else {
        //not found		
        $error_not_found = 1;
    }
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
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <p>
                                        <center><img class="img-fluid" src="../dashboard/settings/logo/<?php echo $main_logo; ?>"></center>
                                    </p>
                                    <h4 class="text-center mb-4">Log In | Smart Student</h4>
                                    <hr>
                                    <?php if ($error_not_found == 1) { ?> <div style="background: linear-gradient(red,darkred); color: white; padding: 10px; text-align: center;">User not found, Please try agian.</div> <?php } ?>
                                    <?php if ($error_not_match == 1) { ?> <div style="background: linear-gradient(red,darkred); color: white; padding: 10px; text-align: center;">your enterd password not match, Please try agian.</div> <?php } ?>
                                    <form action="index.php" method="POST">
                                        <div class="form-group">
                                            <label><strong>Username</strong></label>
                                            <input type="text" name="username" id="exampleInputUsername" class="form-control" placeholder="Enter Username">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Password</strong></label>
                                            <input type="password" name="password" id="exampleInputPassword" class="form-control" placeholder="Enter Password">
                                        </div>
                                        <div class="text-center">
                                            <input type="submit" class="btn btn-primary btn-block" name="login_bt" value="Login">
                                        </div>
                                    </form>
                                    <p class="mt-4">Smart Student ලෙස log විය හැක්කේ අභිමන් ගුරුතුමාගේ පන්ති සමග සම්බන්ධ වන දරුවන් හට පමණි. අනෙක් සියලු දරුවන් "නොමිලේ අධ්‍යාපනය" ඔස්සේ පිවිසෙන්න</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once 'copyright.php';
?>
<?php
require_once 'footer.php';
?>