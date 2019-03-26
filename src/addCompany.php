<?php
include '../config/connection.php';

$cname=$_REQUEST['cname'];
$caddr=$_REQUEST['caddr'];
$cphone=$_REQUEST['cphone'];
$ccountry=$_REQUEST['ccountry'];
$cstate=$_REQUEST['cstate'];
$city=$_REQUEST['ccity'];
$zip=$_REQUEST['czip'];

$response=[];
if(!empty($_REQUEST['cid']))
{
  $cid=$_REQUEST['cid'];
$sql="UPDATE CompanyMaster,ContactMaster SET companyName='$cname',contactAddress='$caddr',contactNumber='$cphone',country='$ccountry',
      CState='$cstate',city='$city',zipcode='$zip' WHERE  CompanyMaster.contactId=ContactMaster.contactId AND CompanyId='$cid'";
$result=mysqli_query($con,$sql);
if($result)
$response['true']=true;
else
$response['false']=false;
}
else {
}
mysqli_close($con);
exit(json_encode($response));
 ?>
