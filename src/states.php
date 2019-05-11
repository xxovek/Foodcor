<?php

include '../config/connection.php';

$countryname = $_POST["countryname"];
$response = [];
$myArr = [];
$mysql_qry = "select id,name from states WHERE country_id = (select id from countries where name = 'India')";
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
