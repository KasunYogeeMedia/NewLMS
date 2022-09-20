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
                    <h4>All Subject</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0);">Subject</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0);">All Subject</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <ul class="nav nav-pills mb-3">
                    <li class="nav-item"><a href="#list-view" data-toggle="tab" class="nav-link btn btn-square btn-secondary mr-1 show active">List View</a></li>
                </ul>
            </div>
            <div class="col-lg-12">
                <div class="row tab-content">
                    <div id="list-view" class="tab-pane fade active show col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All Subject </h4>
                                <a href="add_subject.php" class="btn btn-square btn-secondary">+ Add Subject</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example3" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Grade</th>
                                                <th>Subject</th>
                                                <th>Price</th>
                                                <th>Fees valid period</th>
                                                <th>Date</th>
                                                <th>Option</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $stmt = $DB_con->prepare('SELECT * FROM lmssubject ORDER BY sid');

                                            $stmt->execute();

                                            if ($stmt->rowCount() > 0) {

                                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                                                    extract($row);

                                            ?>
                                                    <tr>
                                                        <td><?php echo $row['sid']; ?></td>
                                                        <td><a href="javascript:void(0);"><strong><?php

                                                                                                    $id = $class_id;

                                                                                                    $query = $DB_con->prepare('SELECT name FROM lmsclass WHERE cid=' . $id);

                                                                                                    $query->execute();

                                                                                                    $result = $query->fetch();

                                                                                                    echo $result['name'];

                                                                                                    ?></strong></a></td>
                                                        <td><a href="javascript:void(0);"><strong><?php echo $row['name']; ?></strong></a></td>
                                                        <td><a href="javascript:void(0);"><strong><?php echo $row['price']; ?></strong></a></td>
                                                        <td><a href="javascript:void(0);"><strong><?php echo $row['fees_valid_period']; ?></strong></a></td>
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
                                                            <a href="edit_subject.php?sbid=<?php echo $row["sid"]; ?>" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                                            <a href="delete_subject.php?sbid=<?php echo $row["sid"]; ?>" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>
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
