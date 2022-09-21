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
                    <h4>All Mail</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0);">Mail</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0);">All Mail</a></li>
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
                                <h4 class="card-title">All Mail </h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example3" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Subjects</th>
                                                <th>Message</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $stmt = $DB_con->prepare('SELECT * FROM lmsmail ORDER BY mid');

                                            $stmt->execute();

                                            if ($stmt->rowCount() > 0) {

                                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                                                    extract($row);

                                            ?>
                                                    <tr>
                                                        <td><?php echo $row['mid']; ?></td>
                                                        <td><a href="javascript:void(0);"><strong><?php echo $row['name']; ?></strong></a></td>
                                                        <td><a href="javascript:void(0);"><strong><?php echo $row['email']; ?></strong></a></td>
                                                        <td><a href="javascript:void(0);"><strong><?php echo $row['subject']; ?></strong></a></td>
                                                        <td><a href="javascript:void(0);"><strong><?php echo $row['message']; ?></strong></a></td>
                                                        <td><?php echo $row['add_date']; ?></td>
                                                        <td>
                                                            <a href="delete_mail.php?mid=<?php echo $row["mid"]; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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
require_once 'footer.php';
?>