<?php

	$server = "localhost";
	$username = "mozitaco_guruniwasa_lms";
	$pass = "i?tuuNYXHtR(";
	$db = "mozitaco_guruniwasa_lms";

	//create connection 

	$conn = mysqli_connect($server,$username,$pass,$db);
	if($conn->connect_error){

		die ("Connection Failed!". $conn->connect_error);
	}
	
    $main_db=mysqli_query($conn,"SELECT * FROM lmsdb WHERE id=1");
	$main_db_resalt=mysqli_fetch_array($main_db);
	$dbname = $main_db_resalt['dbname'];
	$udbname = $main_db_resalt['username'];
	$dbpassword = $main_db_resalt['password'];


	$setting=mysqli_query($conn,"SELECT * FROM settings WHERE id=1");
	$setting_resalt=mysqli_fetch_array($setting);
	$reg_prefix = $setting_resalt['reg_prefix'];
	$application_name = $setting_resalt['application_name'];
	$main_logo = $setting_resalt['main_logo'];

	function send_sms($receiver_number,$messsage)
    {
		$conn = mysqli_connect("localhost","successo_lms","mVcuP9@pqdF7","successo_lms");
		$sms=mysqli_query($conn,"SELECT * FROM lmssms WHERE id=1");
		$sms_resalt=mysqli_fetch_array($sms);
		$sender_id = $sms_resalt['sender_id'];
		$sa_token = $sms_resalt['sa_token'];
        

        
        $mask = $sender_id;
        $api_key = $sa_token;
        $sms_api_key = '42cEkIqbfkwwVl84l6wPZ6d83V4H7K2l';
        $number = $receiver_number;   //Receiver Number
        $messsage = $messsage;        //SENDING MESSAGE සිංහල / தமிழ் / English

        $url="https://cloud.websms.lk/smsAPI?sendsms&apikey=$sms_api_key&apitoken=$api_key&type=sms&from=$sender_id&to=$number&text=$messsage";
    	file_get_contents($url);
        
    }


	$payment_getway=mysqli_query($conn,"SELECT * FROM lmsgetway WHERE id=1");
	$getway_resalt=mysqli_fetch_array($payment_getway);
	$app_id = $getway_resalt['app_id'];
	$hash_salt = $getway_resalt['hash_salt'];
	$a_token = $getway_resalt['a_token'];

	$lmsurl=mysqli_query($conn,"SELECT * FROM lmsurl WHERE id=1");
	$lmsurl_resalt=mysqli_fetch_array($lmsurl);
	$url = $lmsurl_resalt['url'];
	
	$view_count = 3;
	
	
    if (isset($_SESSION['username'])) {
      $result = mysqli_query($conn, "SELECT ip_address FROM lmsregister where contactnumber='".$_SESSION['username']."'");
     
          if (mysqli_num_rows($result) > 0) {
         
            $row = mysqli_fetch_array($result); 
            $token = $row['ip_address']; 
            
            if($_SESSION['token'] != $token){
              session_destroy();
              header('Location: ../logout.php');
            }
          }
    }
?>