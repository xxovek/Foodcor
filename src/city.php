<?php

include '../config/connection.php';

$state_id = $_REQUEST["state_id"];
$response = [];
$myArr = [];
//$mysql_qry = "select id,name from cities WHERE state_id = (select id from states where name = '$countryname')";
$mysql_qry = "select id,name from cities WHERE state_id ='$state_id'";
$result = mysqli_query($con ,$mysql_qry);
if(mysqli_num_rows($result) > 0)
{
	while ($row = mysqli_fetch_array($result)){
	// $row=mysqli_fetch_row($result);

	// array_push($myArr,$row);

	array_push($response,[
	'id' => $row['id'],
	'name' => $row['name'],
	// 'ptype' => $row['PersonType'],
	]);

	}
		echo json_encode($response);

	//exit(json_encode($myArr));
   	// print_r($myArr);

  	mysqli_free_result($result);


}
else
{
	//print_r("INVALID USERNAME AND PASSWORD");
	$result = null;

}

?>
