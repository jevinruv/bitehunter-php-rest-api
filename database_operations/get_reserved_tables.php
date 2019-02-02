<?php

    // include db connect 
    require_once('../db_con.php');
	
	// array for JSON response

	$response = array();
	
	if(isset($_POST['checkin']) && isset($_POST['checkout'])){
		
		$checkinVal = $_POST['checkin'];
		$checkoutVal = $_POST['checkout'];
			
		// select the reserved tables within the time range (inverse)
		/*$result = mysqli_query($con, "SELECT DISTINCT table_id FROM reservations 
										WHERE checkin  < '02:00:00'
										AND checkout > '01:30:00';"); */

		$result = mysqli_query($con, "SELECT DISTINCT table_id FROM reservations 
										WHERE checkin  < '$checkoutVal'
										AND   checkout > '$checkinVal' ;"); 
		// check for empty result
		if (mysqli_num_rows($result) > 0) {

			// looping through all results
		
			$response["tableList"] = array();

			while ($row = mysqli_fetch_array($result)) {

				// temp table array
				$table = array();

				$table["table_id"] = $row["table_id"];

				// push single table into final response array
				array_push($response["tableList"], $table);

			}		

			// success
			$response["success"] = 1;

			// echoing JSON response
			echo json_encode($response);
		}

		else {

			// no tables reserved
			$response["success"] = 2;
			$response["message"] = "No tables reserved";	

			// echo no users JSON
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