<?php
	//include db connect
	require_once('../db_con.php');
	
	//array for JSON response
	$response = array();
	
	if(isset($_POST['username'])  && isset($_POST['password']) ){

	$username = $_POST['username'];
	$password = $_POST['password'];
	
	//mysql inserting a new row
	$result = mysqli_query($con, "SELECT * FROM user WHERE username = '$username' AND password = '$password' ");
	
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
	
	}
	else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
	
?>