<?php

	require_once 'dbconfig4.php';
	
	if(isset($_GET['cttid']))
	{

		$stmt_select = $DB_con->prepare('SELECT tdocument FROM lmsclasstute_std WHERE ctuid =:cttid');
		$stmt_select->execute(array(':cttid'=>$_GET['cttid']));
		$imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);
		unlink("img/classtute/".$imgRow['tdocument']);

		$stmt_delete = $DB_con->prepare('DELETE FROM lmsclasstute_std WHERE ctuid =:cttid');
		$stmt_delete->bindParam(':cttid',$_GET['cttid']);
		$stmt_delete->execute();

		echo"<script type='text/javascript'>window.location.href = 'approve_pdf.php';</script>";
		
	}

?>