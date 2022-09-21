<?php

session_start();

require_once '../dashboard/dbconfig4.php';

require_once("../dashboard/config.php"); 

include '../dashboard/conn.php';

if (!isset($_SESSION['reid'])) {

    header('location:../login.php');

    die();
}

$video_id = $_POST["video_id"];
$user_id = $_SESSION['reid'];
$check_select = mysqli_query($conn,"SELECT * FROM `lmsviewcount` WHERE user_id = '$user_id' AND video_id='$video_id'"); 

$numrows=mysqli_num_rows($check_select);

if($numrows > 0){

    while($row = $check_select->fetch_assoc())
        {
            
            $sql = "UPDATE lmsviewcount SET count=$row[count]+1 WHERE id=$row[id]";
            
            if (mysqli_query($conn, $sql)) {
              echo "<script>location.href='paid_video_view.php?video=$video_id';</script>";   
              
            } else {
              echo "Error updating record: " . mysqli_error($conn);
            }
         

        }

}

else{
    
$sql = "INSERT INTO lmsviewcount (video_id, user_id, count)
VALUES ($video_id, $user_id, 1)";

if ($conn->query($sql) === TRUE) {
 echo "<script>location.href='paid_video_view.php?video=$video_id';</script>";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

}
?>