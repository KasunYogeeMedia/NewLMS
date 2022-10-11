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
                    <h4>All Medium</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0);">Medium</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0);">All Medium</a></li>
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
                                <h4 class="card-title">All Medium </h4>
                                <a href="add_grade.php" class="btn btn-square btn-secondary float-right">+ Add Medium</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Medium</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Option</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $stmt = $DB_con->prepare('SELECT * FROM lmsclass ORDER BY cid');

                                            $stmt->execute();

                                            if ($stmt->rowCount() > 0) {

                                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                                                    extract($row);

                                            ?>
                                                    <tr>
                                                        <td><?php echo $row['cid']; ?></td>
                                                        <td><a href="javascript:void(0);"><strong><?php echo $row['name']; ?></strong></a></td>
                                                        <td><?php echo $row['add_date']; ?></td>
                                                        <td>
                                                            <?php

                                                            if ($row['status'] == "Unpublish") {

                                                                echo '<a class="badge badge-warning">Pending</a>';
                                                            } else if ($row['status'] == "Publish") {

                                                                echo '<a class="badge badge-success">Success</a>';
                                                            }

                                                            ?>
                                                        </td>
                                                        <td>
                                                            <a href="edit_grade.php?clid=<?php echo $row["cid"]; ?>" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                                                            <a href="delete_grade.php?clid=<?php echo $row["cid"]; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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