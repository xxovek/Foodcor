<?php
include '../config/connection.php';

// session_start();
$invoice_number = $_REQUEST['tid'];
$sql1 = "SELECT * FROM `TransactionMaster` WHERE TransactionId=$invoice_number";
$result1 = mysqli_query($con,$sql1);
$row1 = mysqli_fetch_array($result1);
$cId=$row1['companyId'];
$uid=$row1['PersonId'];
$sql = "SELECT companyName,contactAddress,contactNumber,country,CState, city,zipcode,logo FROM
 `CompanyMaster` cm,`ContactMaster` c WHERE cm.`contactId`=c.`contactId` AND cm.`CompanyId`='$cId'";
 $sql_person = "SELECT * FROM PersonMaster PM  LEFT JOIN PersonContact PC ON PC.PersonId = PM.PersonId LEFT JOIN ContactMaster CM ON CM.contactId = PC.ContactId
WHERE PM.PersonId = $uid";
 $sql_cust = mysqli_query($con, $sql_person);
$response = [];
if($result = mysqli_query($con,$sql)){
  if(mysqli_num_rows($result)>0){
    $row = mysqli_fetch_array($result);
    $row_cust = mysqli_fetch_array($sql_cust);
if(empty($row['logo'])){
  $logo = 'default-logo.png';
}else {
$logo = $row['logo'];
}
    array_push($response,[
        'cName' => ucwords($row['companyName']),
        'addr' => $row['contactAddress'],
        'phone' => $row['contactNumber'],
        'ccountry' => $row['country'].',' .$row['CState'].','.$row['city'].','.$row['zipcode'],
        'logo' => $logo,

        'pName' => ucwords($row_cust['FirstName'].' '.$row_cust['lastName']),
        'paddr' => $row_cust['contactAddress'],
        'pphone' => $row_cust['contactNumber'],
        'pcountry' => $row_cust['country'].',' .$row_cust['CState'].','.$row_cust['city'].','.$row_cust['zipcode'],
        'pemail' => $row_cust['EmailId'],

        ]);
  }
}
mysqli_close($con);
exit(json_encode($response));
?>
