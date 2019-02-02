<?php

    // include db connect 
    require_once('../db_con.php');
	
	// array for JSON response
	$response = array();
	
	// mysql inserting a new row
    $result = mysqli_query($con,"SELECT * FROM restaurants");
	
    // check for empty result
	if (mysqli_num_rows($result) > 0) {
		// looping through all results
	
		// products node
		$response["restaurants"] = array();

		while ($row = mysqli_fetch_array($result)) {
			// temp user array
			$restaurant = array();
			$restaurant["restaurant_id"] = $row["restaurant_id"];
			$restaurant["restaurant_name"] = $row["restaurant_name"];
			$restaurant["table_count"] = $row["table_count"];
			$restaurant["time_open"] = $row["time_open"];
			$restaurant["time_close"] = $row["time_close"];
	 
			// push single restaurant into final response array
			array_push($response["restaurants"], $restaurant);
		}
		
		// success
		$response["success"] = 1;
		// echoing JSON response
		echo json_encode($response);
	}
	else {
		// no restaurants found
		$response["success"] = 0;
		$response["message"] = "No restaurants found";
	 
		// echo no users JSON
		echo json_encode($response);
}




?>