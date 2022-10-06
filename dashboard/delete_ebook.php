<?php

	require_once 'dbconfig4.php';
	
	if(isset($_GET['cttid']))
	{

		$stmt_select = $DB_con->prepare('SELECT tdocument FROM lmsebook WHERE ctuid =:cttid');
		$stmt_select->execute(array(':cttid'=>$_GET['cttid']));
		$imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);
		unlink("img/classtute/".$imgRow['tdocument']);

		$stmt_delete = $DB_con->prepare('DELETE FROM lmsebook WHERE ctuid =:cttid');
		$stmt_delete->bindParam(':cttid',$_GET['cttid']);
		$stmt_delete->execute();

		echo"<script type='text/javascript'>window.location.href = 'ebook.php';</script>";
		
	}

?>