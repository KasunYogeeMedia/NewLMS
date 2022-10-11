<?php

session_start();

require_once 'includes.php';

require_once 'dbconfig4.php';

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
                    <h4>All Admin</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0);">Admin</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0);">All Admin</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <ul class="nav nav-pills mb-3">
                    <li class="nav-item"><a href="#list-view" data-toggle="tab" class="nav-link btn btn-square btn-secondary float-right mr-1 show active">List View</a></li>
                </ul>
            </div>
            <div class="col-lg-12">
                <div class="row tab-content">
                    <div id="list-view" class="tab-pane fade active show col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All Admin </h4>
                                <a href="add_admin.php" class="btn btn-square btn-secondary float-right">+ Add Admin</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Menu List</th>
                                                <th>Option</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $stmt = $DB_con->prepare('SELECT * FROM lmsusers ORDER BY user_id');

                                            $stmt->execute();

                                            if ($stmt->rowCount() > 0) {

                                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                                                    extract($row);

                                            ?>
                                                    <tr>
                                                        <td><?php echo $row['user_id']; ?></td>
                                                        <td><a href="javascript:void(0);"><strong><?php echo $row['user_name']; ?></strong></a></td>
                                                        <td><a href="javascript:void(0);"><strong><?php echo $row['user_email']; ?></strong></a></td>
                                                        <td><a href="javascript:void(0);"><strong><?php echo $row['admintype']; ?></strong></a></td>
                                                        <td>
                                                            <p><strong>Admin - <span class="badge badge-pill badge-secondary"><?php echo $row['admin']; ?></span><strong>
                                                                        <p>
                                                                        <p>Students - <span class="badge badge-pill badge-secondary"><?php echo $row['students']; ?></span><strong>
                                                                                <p>
                                                                                <p>Teachers - <span class="badge badge-pill badge-secondary"><?php echo $row['teachers']; ?></span><strong>
                                                                                        <p>
                                                                                        <p>Class - <span class="badge badge-pill badge-secondary"><?php echo $row['class']; ?></span><strong>
                                                                                                <p>
                                                                                                <p>Subject - <span class="badge badge-pill badge-secondary"><?php echo $row['subject']; ?></span><strong>
                                                                                                        <p>
                                                                                                        <p>Lesson - <span class="badge badge-pill badge-secondary"><?php echo $row['lesson']; ?></span><strong>
                                                                                                                <p>
                                                                                                                <p>Payments - <span class="badge badge-pill badge-secondary"><?php echo $row['payments']; ?></span><strong>
                                                                                                                        <p>
                                                                                                                        <p>Class Schedule - <span class="badge badge-pill badge-secondary"><?php echo $row['class_schedule']; ?></span><strong>
                                                                                                                                <p>
                                                                                                                                <p>Mail - <span class="badge badge-pill badge-secondary"><?php echo $row['mail']; ?></span>
                                                                                                                            </strong></p>
                                                        </td>
                                                        <td>
                                                            <?php

                                                            if ($row['status'] == "0") {

                                                                echo '<a class="badge badge-warning">Pending</a>';
                                                            } else if ($row['status'] == "1") {

                                                                echo '<a class="badge badge-success">Success</a>';
                                                            }

                                                            ?>
                                                        </td>
                                                        <td>
                                                            <a href="edit_admin.php?adid=<?php echo $row["user_id"]; ?>" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                                                            <a href="delete_admin.php?adid=<?php echo $row["user_id"]; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
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