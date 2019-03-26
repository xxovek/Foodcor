<?php
include '../config/connection.php';
$pid=$_REQUEST['pid'];
$sql = "SELECT * FROM ContactMaster cm,PersonMaster pm,PersonType pt,PersonContact pc where pt.personTypeId=pm.personTypeId and
 pc.ContactId=cm.ContactId and pc.PersonId=pm.PersonId  AND pm.PersonId=$pid";
 // echo $sql;
$response = [];
$sqlgst = mysqli_query($con,"SELECT DocumentNumber FROM ContactDocument where DocumentId='4' AND PersonId=$pid");
$resgst=mysqli_fetch_array($sqlgst);

$sqlPAN = mysqli_query($con,"SELECT DocumentNumber FROM ContactDocument where DocumentId='1' AND PersonId=$pid");
$resPAN=mysqli_fetch_array($sqlPAN);

$sql1="SELECT c.id as cid,s.id as sid,ct.id as ctid,cm.contactAddress,cm.country,cm.CState,cm.city,cm.zipcode FROM countries c,states s,cities ct,ContactMaster cm,PersonMaster pm,PersonType pt,PersonContact pc WHERE cm.country=c.name AND cm.CState=s.name AND cm.city=ct.name
 AND pc.ContactId=cm.ContactId AND pc.PersonId=pm.PersonId  AND pm.PersonId=$pid AND cm.AddressId=2";

$sqlsaddr = mysqli_query($con,$sql1);
$ressaddr=mysqli_fetch_array($sqlsaddr);

$sql2 = "SELECT c.id as cid,s.id as sid,ct.id as ctid FROM countries c,states s,cities ct,ContactMaster cm,PersonContact pc,PersonMaster pm,PersonType pt WHERE cm.country=c.name AND cm.CState=s.name AND cm.city=ct.name
AND pt.personTypeId=pm.personTypeId AND cm.contactId=pc.ContactId AND pc.PersonId=pm.PersonId AND pm.PersonId=$pid AND cm.AddressId=1";
$sqlgetid = mysqli_query($con,$sql2);
// echo $sql2;
$resid=mysqli_fetch_array($sqlgetid);


if($result = mysqli_query($con,$sql)){
  if(mysqli_num_rows($result)>0){
    $row = mysqli_fetch_array($result);
    $response['pid'] = $row['PersonId'];
    $response['ptype'] = $row['PersonType'];
    $response['personTypeId'] = $row['personTypeId'];
    $response['fname'] = ucwords($row['FirstName']);
    $response['mname'] = $row['middleName'];
    $response['lname'] = ucwords($row['lastName']);
    $response['email'] = $row['EmailId'];
    $response['CompanyName'] = $row['CompanyName'];
    $response['phone'] = $row['contactNumber'];
    $response['gstin'] = $resgst['DocumentNumber'];
    $response['Pan'] = $resPAN['DocumentNumber'];
    $response['bcountryid'] = $resid['cid'];
    $response['bcountry'] = $row['country'];
    $response['bstateid'] = $resid['sid'];
    $response['bstate'] = $row['CState'];
    $response['bcityid'] = $resid['ctid'];
    $response['bcity'] = $row['city'];
    $response['bzip'] = $row['zipcode'];
    $response['scountry'] = $ressaddr['country'];
    $response['scountryid'] = $ressaddr['cid'];
    $response['sstateid'] = $ressaddr['sid'];
    $response['scityid'] = $ressaddr['ctid'];
    $response['sstate'] = $ressaddr['CState'];
    $response['scity'] = $ressaddr['city'];
    $response['szip'] = $ressaddr['zipcode'];
    $response['billaddress'] = ucwords($row['contactAddress']);
    $response['shipaddress'] = $ressaddr['contactAddress'];
    $response['baddr'] = $row['country'].'  '.$row['CState'].'  '.$row['city'];
    $response['saddr'] = $ressaddr['country'].'  '.$ressaddr['CState'].'  '.$ressaddr['city'];
    }
  }
mysqli_close($con);
exit(json_encode($response));
  ?>
