<?php
	//include db connect
	require_once('../db_con.php');
	
	//array for JSON response
	$response = array();
	
	$u = "admin";
	$p = "admin";
	
	//mysql inserting a new row
	$result = mysqli_query($con, "SELECT * FROM user WHERE username = '$u' AND password = '$p' ");
	
	//check for empty result
	if(mysqli_num_rows($result) > 0){
		//looping through all results
		
		//success
		$response["success"] = 1;
		$response["message"] = "User found";

		
		//echoing JSON response
		echo json_encode($response);
	}
	else{
		//no user found
		$response["sucess"] = 0;
		$response["message"] = "No user found";
		
		//echo no users JSON
		echo json_encode($response);
		
	}
	
?>