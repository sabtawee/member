<?php
	require_once "config.php";
	
	$gbprime_ip1 = "203.151.205.33"; //อย่าแก้
	$gbprime_ip2 = "203.151.205.45"; //อย่าแก้
	$request_ip = $_SERVER['REMOTE_ADDR'];

	if ($request_ip == $gbprime_ip1 OR $request_ip == $gbprime_ip2) {
		
		$json_str = file_get_contents('php://input');	
		$json_obj = json_decode($json_str);
		
		if($json_obj->resultCode == 00){
			
			$user_id = $json_obj->detail;
			$acc_id = $json_obj->customerName;
			$amount = $json_obj->amount;
			$status = 1;
			$getdate = $json_obj->date;
			$gettime = $json_obj->time;
			$date = substr_replace(substr_replace($getdate, "-", 2, 0), "-", 5, 0);
			$time = substr_replace(substr_replace($gettime, ":", 2, 0), ":", 5, 0);
			$dt = new DateTime($date." ".$time);
			$datetime = $dt->format('Y-m-d H:i:s');
			$referenceNo = $json_obj->referenceNo;
			$gbpReferenceNo = $json_obj->gbpReferenceNo;
			
			$MYSQLiCash = "INSERT INTO donate (userid, account_id, amount, status, added_time, referenceNo, gbpReferenceNo) VALUES ('".$user_id."', '".$acc_id."', '".$amount."', '".$status."', '".$datetime."', '".$referenceNo."', '".$gbpReferenceNo."')";
			if (mysqli_query($ConSql, $MYSQLiCash)) {
				$myfile = fopen("status.txt", "w") or die("Unable to open file!");
				fwrite($myfile, "Complete");
			}
		}
	} else {
		echo "Your IP is not Allowed to Open !!";
		fwrite($myfile, $request_ip);
	}
?>