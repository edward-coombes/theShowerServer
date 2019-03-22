<?php

function initConn(){
    //initiates the connection to the database
    $servername = "localhost";
    $username = "";
    $password = "";

    //Create the connection, and then check to make sure there are no errors
    $conn = new mysqli($servername,$username,$password);
    if($conn->connect_error)
        die("Connection failed: " . $conn->connect_error);

    return $conn;
}/**/

function selectTimerData($conn,$userId){
	/* this function selects timer records from a specific userId
	 *	
	 */
	$delimeter = ",";
	$outStr = "";
	$sql = "SELECT elapsedTime, goalTime, tstamp FROM app.showerInstance WHERE userId = "
		 . $userId;
	$result = $conn->query($sql);
	$dbdata = array();

	//Fetch into associative array
  	while ( $row = $result->fetch_assoc())  {
		$dbdata[]=$row;
  	}

	//Print array in JSON format
	return json_encode($dbdata);
}

$conn = initConn();

if($_POST["userId"]){
	//sanitize userId
	$userId = filter_var($_POST["userId"],FILTER_SANITIZE_STRING);
	echo selectTimerData($conn,$userId);
} else {
	echo "Error: no userId supplied";
}
$conn->close();
