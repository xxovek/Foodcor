<?php
include '../config/connection.php';
session_start();
$response=[];

$companyId = $_SESSION['company_id'];

$ctype=$_REQUEST['ctype'];
$ctype = !empty($ctype) ? $ctype : "NULL";

$ctype1=$_REQUEST['ctype1'];
$ctype1 = !empty($ctype1) ? $ctype1 : "NULL";

$fname=$_REQUEST['fname'];
$mname=$_REQUEST['mname'];
// $mname = !empty($mname) ? $mname : "NULL";

$lname=$_REQUEST['lname'];
// $lname = !empty($lname) ? $lname : "NULL";

$email=$_REQUEST['email'];
// $email = !empty($email) ? $email : "NULL";

$phone=$_REQUEST['phone'];
// $phone = !empty($phone) ? $phone : "NULL";


$billaddr=$_REQUEST['billaddr'];
// $billaddr = !empty($billaddr) ? $billaddr : "NULL";
$bcountry=$_REQUEST['bcountry'];

if(!empty($bcountry)){
  $countryname  = "SELECT name FROM countries WHERE id='$bcountry'";
  $result1 = mysqli_query($con,$countryname);
  $row1 = mysqli_fetch_array($result1);
  $bcountry = $row1['name'];
}

$bstate=$_REQUEST['bstate'];
if(!empty($bstate)){
  $statename  = "SELECT name FROM states WHERE id='$bstate'";
  $result2= mysqli_query($con,$statename);
  $row2 = mysqli_fetch_array($result2);
  $bstate = $row2['name'];
}

$bcity=$_REQUEST['bcity'];
if(!empty($bcity)){
  $citiesname  = "SELECT name FROM cities WHERE id='$bcity'";
  $result3 = mysqli_query($con,$citiesname);
  $row3 = mysqli_fetch_array($result3);
  $bcity = $row3['name'];
}

$bzip=$_REQUEST['bzip'];

$shipaddr=$_REQUEST['shipaddr'];

$scountry= $_REQUEST['scountry'];
if(!empty($scountry)){
  $countryname  = "SELECT name FROM countries WHERE id='$scountry'";
  $result1 = mysqli_query($con,$countryname);
  $row1 = mysqli_fetch_array($result1);
  $scountry = $row1['name'];
}

$sstate=$_REQUEST['sstate'];
if(!empty($sstate)){
  $statename  = "SELECT name FROM states WHERE id='$sstate'";
  $result2= mysqli_query($con,$statename);
  $row2 = mysqli_fetch_array($result2);
  $sstate = $row2['name'];
}
$scity=$_REQUEST['scity'];
if(!empty($scity)){
  $citiesname  = "SELECT name FROM cities WHERE id='$scity'";
  $result3 = mysqli_query($con,$citiesname);
  $row3 = mysqli_fetch_array($result3);
  $scity = $row3['name'];
}

$szip=$_REQUEST['szip'];

$gstin=$_REQUEST['gstin'];
$PAN=$_REQUEST['Pan'];
$companyName = $_REQUEST['companyName'];
$companyName = !empty($companyName) ? $companyName : "NULL";

if(!empty($_REQUEST['pid'])){
  $pid=$_REQUEST['pid'];

  $PMUpdate_sql="UPDATE PersonMaster SET CompanyName='$companyName',PersonTypeId =$ctype1,FirstName ='$fname',middleName='$mname',
   lastName ='$lname',EmailId='$email' where PersonId = $pid";

   mysqli_query($con,$PMUpdate_sql) or die(mysqli_error($con));

   $CMUpdateBAddr_sql="UPDATE ContactMaster,PersonContact SET contactAddress='$billaddr',contactNumber='$phone',country='$bcountry',
     CState='$bstate',city ='$bcity',zipcode='$bzip' where ContactMaster.AddressId = 1 and ContactMaster.contactId=PersonContact.ContactId and PersonContact.PersonId= $pid ";

    mysqli_query($con,$CMUpdateBAddr_sql) or die(mysqli_error($con));

    $CMUpdateSAddr_sql="UPDATE ContactMaster,PersonContact SET contactAddress='$shipaddr',contactNumber='$phone',country='$scountry', CState='$sstate',
     city ='$scity',zipcode='$szip' where ContactMaster.AddressId = 2 and ContactMaster.contactId=PersonContact.ContactId AND PersonContact.PersonId= $pid ";

     mysqli_query($con,$CMUpdateSAddr_sql) or die(mysqli_error($con));

   $CDUpdateGst_sql="UPDATE ContactDocument SET DocumentNumber='$gstin' where DocumentId='4' AND PersonId='$pid'";
   // echo $CDUpdateGst_sql;

   mysqli_query($con,$CDUpdateGst_sql) or die(mysqli_error($con));

   $CDUpdatePan_sql= "UPDATE ContactDocument SET DocumentNumber='$PAN' where DocumentId='1' AND PersonId='$pid'";
   // echo $CDUpdatePan_sql;

   mysqli_query($con,$CDUpdatePan_sql) or die(mysqli_error($con));

   // $response['true']=true;
   $response['msg']=$ctype.' '.$fname." Updated Successfully";
}
else {
$sql1="INSERT INTO PersonMaster (companyId,personTypeId,FirstName,middleName,lastName,EmailId,CompanyName) VALUES($companyId,$ctype1,'$fname','$mname','$lname','$email','$companyName')";

mysqli_query($con,$sql1) or die(mysqli_error($con));
$personid=mysqli_insert_id($con);



$sql2="INSERT INTO ContactMaster (AddressId,contactNumber,country,CState,city,contactAddress,zipcode) VALUES(1,'$phone','$bcountry','$bstate','$bcity','$billaddr','$bzip')";
mysqli_query($con,$sql2);
$contactid=mysqli_insert_id($con);

// $sqlCompany = "INSERT INTO CompanyMaster(companyName,contactId) VALUES('$companyName',$contactid)";
// mysqli_query($con,$sqlCompany);
// $companyIdC=mysqli_insert_id($con);

// $sqlUser = "INSERT INTO UserMaster(emailId,companyId,PersonId,refCompanyId)VALUES('$email',$companyIdC,$personid,$companyId)";
// mysqli_query($con,$sqlUser) or die(mysqli_error($con));

$sql3="INSERT INTO PersonContact (ContactId,PersonId) VALUES($contactid,$personid)";
mysqli_query($con,$sql3) or die(mysqli_error($con));

$sql6="INSERT INTO ContactMaster (AddressId,country,CState,city,contactAddress,zipcode) VALUES(2,'$scountry','$sstate','$scity','$shipaddr','$szip')";
mysqli_query($con,$sql6);
$contactid1=mysqli_insert_id($con);

$sql7="INSERT INTO PersonContact (ContactId,PersonId) VALUES($contactid1,$personid)";
mysqli_query($con,$sql7) or die(mysqli_error($con));

$sql4="INSERT INTO ContactDocument (DocumentId,PersonId,DocumentNumber) VALUES(4,$personid,'$gstin')";
mysqli_query($con,$sql4) or die(mysqli_error($con));
$sql5="INSERT INTO ContactDocument (DocumentId,PersonId,DocumentNumber) VALUES(1,$personid,'$PAN')";
$result5=mysqli_query($con,$sql5) or die(mysqli_error($con));
if($result5){
 $response['msg']=$ctype.' '.$fname." Added Successfully";
}
else{
  $response['msg']='Server Error Please Try Again';
}
}
mysqli_close($con);
exit(json_encode($response));
 ?>