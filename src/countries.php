<?php

include '../config/connection.php';

//$user_name = $_POST["username"];
$response = [];
$myArr = [];
$mysql_qry = "select id,sortname,name,phonecode from countries";
$result = mysqli_query($con ,$mysql_qry);
if(mysqli_num_rows($result) > 0)
{
	while ($row = mysqli_fetch_array($result)){
	// $row=mysqli_fetch_row($result);

	// array_push($myArr,$row);

	array_push($response,[
	'id' => $row['id'],
	'sortname' => $row['sortname'],
	'name' => $row['name'],
	'phonecode' => $row['phonecode'],
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
