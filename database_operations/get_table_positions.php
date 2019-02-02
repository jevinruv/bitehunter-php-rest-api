<?php
	header('Access-Control-Allow-Origin: *');
	//include db connect
	require_once('../db_con.php');
	
	//array for JSON response
	$response = array();
	
	if(isset($_POST['restaurant_id']) ){

	$restaurant_id = $_POST['restaurant_id'];
	
  $result = mysqli_query($con, "SELECT * FROM table_positions WHERE restaurant_id = $restaurant_id");
	
	//check for empty result
	if(mysqli_num_rows($result) > 0){
		//looping through all results
		
		// products node
		$response["table_data"] = array();

		while ($row = mysqli_fetch_array($result)) {
			// temp restaurant array
			$restaurant = array();
		//	$restaurant["id"] = $row["id"];
			$restaurant["restaurant_id"] = $row["restaurant_id"];
			$restaurant["table_id"] = $row["table_id"];
			$restaurant["left_margin"] = $row["left_margin"];
			$restaurant["top_margin"] = $row["top_margin"];
	 
			// push single restaurant into final response array
			array_push($response["table_data"], $restaurant);
		}

		// success
		$response["success"] = 1;
		
		//echoing JSON response
		echo json_encode($response);
	}
	else{
		//no restaurant found
		$response["sucess"] = 0;
		$response["message"] = "No restaurant found";
		
		//echo no restaurant JSON
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