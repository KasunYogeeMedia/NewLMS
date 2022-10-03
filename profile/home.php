<?php

session_start();

require_once '../dashboard/dbconfig4.php';

include '../dashboard/conn.php';

if (!isset($_SESSION['reid'])) {

	header('location:../login.php');

	die();
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

<!-- Body Start -->
<div class="content-wrapper p-2">
	<div class="content_head pt-2">
		<h4 class="text-center">Smart Science</h4>
	</div>
	<div class="content_body text-center pt-2">
		<div class="row">
			<div class="col-md-4 col-sm-4">
				<h5 class="pb-3">English Medium</h5>
				<div class="links-1">
					<a class="btn btn-primary btn-lg w-100 mb-2" href="">Grade 6</a>
					<a class="btn btn-primary btn-lg w-100 mb-2" href="">Grade 7</a>
					<a class="btn btn-primary btn-lg w-100 mb-2" href="">Grade 8</a>
					<a class="btn btn-primary btn-lg w-100 mb-2" href="">Grade 9</a>
					<a class="btn btn-primary btn-lg w-100 mb-2" href="">Grade 10</a>
					<a class="btn btn-primary btn-lg w-100 mb-2" href="">Grade 11</a>
				</div>
			</div>
			<div class="col-md-4 col-sm-4">
				<div class="links-2 my-5">
					<a class="btn btn-secondary btn-lg w-100 mb-2" href="">Science of Life <br> ජිවිත විද්‍යාව</a>
					<a class="btn btn-secondary btn-lg w-100 mb-2" href="">O/L Result</a>
				</div>
			</div>
			<div class="col-md-4 col-sm-4">
				<h5 class="pb-3">සිංහල මාධ්‍යය</h5>
				<div class="links-3">
				<a class="btn btn-primary btn-lg w-100 mb-2" href="">Grade 6</a>
					<a class="btn btn-primary btn-lg w-100 mb-2" href="">Grade 7</a>
					<a class="btn btn-primary btn-lg w-100 mb-2" href="">Grade 8</a>
					<a class="btn btn-primary btn-lg w-100 mb-2" href="">Grade 9</a>
					<a class="btn btn-primary btn-lg w-100 mb-2" href="">Grade 10</a>
					<a class="btn btn-primary btn-lg w-100 mb-2" href="">Grade 11</a>
				</div>
			</div>
		</div>
	</div>
	<table id="example3" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Medium</th>
                                                <th>Grade</th>
                                               
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
                                                            <a href="edit_subject.php?sbid=<?php echo $row["sid"]; ?>" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                                                            <a href="delete_subject.php?sbid=<?php echo $row["sid"]; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
</div>