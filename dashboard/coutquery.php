<?php	
							
require_once 'dbconfig4.php';

$stmt = $DB_con->prepare('SELECT COUNT(*) AS user_count FROM lmsusers');
$stmt->execute();
$result = $stmt->fetch();
$total_users = $result['user_count'];

$stmt = $DB_con->prepare('SELECT COUNT(*) AS  register_count FROM lmsregister');
$stmt->execute();
$result = $stmt->fetch();
$total_register = $result['register_count'];

$stmt = $DB_con->prepare('SELECT COUNT(*) AS tealmsr_count FROM lmstealmsr');
$stmt->execute();
$result = $stmt->fetch();
$total_teacher = $result['tealmsr_count'];

$stmt = $DB_con->prepare('SELECT COUNT(*) AS class_count FROM lmsclass');
$stmt->execute();
$result = $stmt->fetch();
$total_class = $result['class_count'];

$stmt = $DB_con->prepare('SELECT COUNT(*) AS subject_count FROM lmssubject');
$stmt->execute();
$result = $stmt->fetch();
$total_subject = $result['subject_count'];

$stmt = $DB_con->prepare('SELECT COUNT(*) AS lesson_count FROM lmslesson');
$stmt->execute();
$result = $stmt->fetch();
$total_lesson = $result['lesson_count'];

$stmt = $DB_con->prepare('SELECT COUNT(*) AS class_schlmsle_count FROM lmsclass_schlmsle');
$stmt->execute();
$result = $stmt->fetch();
$total_class_schedule = $result['class_schlmsle_count'];

$stmt = $DB_con->prepare('SELECT COUNT(*) AS payment_count FROM lmspayment');
$stmt->execute();
$result = $stmt->fetch();
$total_payment = $result['payment_count'];

// new add

$stmt = $DB_con->prepare('SELECT COUNT(*) AS ebook_count FROM lmsebook');
$stmt->execute();
$result = $stmt->fetch();
$total_ebook = $result['ebook_count'];

$stmt = $DB_con->prepare('SELECT COUNT(*) AS apppdf_count FROM lmsclasstute_std');
$stmt->execute();
$result = $stmt->fetch();
$total_apppdf = $result['apppdf_count'];

$stmt = $DB_con->prepare('SELECT COUNT(*) AS pdf_count FROM lms_pdf');
$stmt->execute();
$result = $stmt->fetch();
$total_pdf = $result['pdf_count'];

$stmt = $DB_con->prepare('SELECT COUNT(*) AS olresult_count FROM lmsclasstute');
$stmt->execute();
$result = $stmt->fetch();
$total_olresult = $result['olresult_count'];

?>