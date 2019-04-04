<?php
include '../config/connection.php';
session_start();
if(isset($_SESSION['company_id'])){
  $companyId = $_SESSION['company_id'];
}else{
  $companyId = $_POST['company_id'];
}
$response  = [];
$ctype     = $_REQUEST['ctype'];
$ctype     = !empty($ctype) ? $ctype : "NULL";
$ctype1    = $_REQUEST['ctype1'];
$ctype1    = !empty($ctype1) ? $ctype1 : "NULL";
$fname     = $_REQUEST['fname'];
$mname     = $_REQUEST['mname'];
$lname     = $_REQUEST['lname'];
$email     = $_REQUEST['email'];
$phone     = $_REQUEST['phone'];
$billaddr  = $_REQUEST['billaddr'];
$bcountry  = $_REQUEST['bcountry'];

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

$bzip     = $_REQUEST['bzip'];
$shipaddr = $_REQUEST['shipaddr'];
$scountry = $_REQUEST['scountry'];

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

$szip        = $_REQUEST['szip'];
$gstin       = $_REQUEST['gstin'];
$PAN         = $_REQUEST['Pan'];
$companyName = $_REQUEST['companyName'];
$companyName = !empty($companyName) ? $companyName : "NULL";

if(!empty($_REQUEST['pid'])){
  $i=0;
  $pid=$_REQUEST['pid'];

  $PMUpdate_sql="UPDATE PersonMaster SET CompanyName='$companyName',PersonTypeId =$ctype1,FirstName ='$fname',middleName='$mname',
   lastName ='$lname' where PersonId = $pid";

   if(mysqli_query($con,$PMUpdate_sql)){
     $i++;

     $CMUpdateBAddr_sql="UPDATE ContactMaster,PersonContact SET contactAddress='$billaddr',contactNumber='$phone',country='$bcountry',
     CState='$bstate',city ='$bcity',zipcode='$bzip' where ContactMaster.AddressId = 1 and ContactMaster.contactId=PersonContact.ContactId and PersonContact.PersonId= $pid ";
    
      if(mysqli_query($con,$CMUpdateBAddr_sql)){
      $i++;

    $CMUpdateSAddr_sql="UPDATE ContactMaster,PersonContact SET contactAddress='$shipaddr',contactNumber='$phone',country='$scountry', CState='$sstate',
    city ='$scity',zipcode='$szip' where ContactMaster.AddressId = 2 and ContactMaster.contactId=PersonContact.ContactId AND PersonContact.PersonId= $pid ";

    if(mysqli_query($con,$CMUpdateSAddr_sql)){
      $i++;

    $CDUpdateGst_sql="UPDATE ContactDocument SET DocumentNumber='$gstin' where DocumentId='4' AND PersonId='$pid'";
   if(mysqli_query($con,$CDUpdateGst_sql)){
    $i++;
 
   $CDUpdatePan_sql= "UPDATE ContactDocument SET DocumentNumber='$PAN' where DocumentId='1' AND PersonId='$pid'";

   if(mysqli_query($con,$CDUpdatePan_sql)){
    $i++;
          }
        }
      } 
    }
  }
if($i==5){
  $response['msg']=$ctype.' '.$fname." Updated Successfully";
}else{
  $response['msg']='Server Error Please Try Again';
} 
}
else {
$i =0;
$check_company_id = "SELECT companyId,personTypeId FROM PersonMaster WHERE EmailId ='$email' AND personTypeId = 4";
    if($result_1 = mysqli_query($con,$check_company_id)){
      if(mysqli_num_rows($result_1)==1){
        $row = mysqli_fetch_array($result_1);
          $PersoncompanyId = $row['companyId'];
          $personTypeId = $row['personTypeId'];
      }else{
        $PersoncompanyId = 'NULL';
      }
    }

$sql1="INSERT INTO PersonMaster (companyId,personTypeId,FirstName,middleName,lastName,EmailId,CompanyName,PersonCompanyId) VALUES($companyId,$ctype1,'$fname','$mname','$lname','$email','$companyName',$PersoncompanyId)";

if(mysqli_query($con,$sql1)){
  $personid = mysqli_insert_id($con);
  $i++;

  $sql2="INSERT INTO ContactMaster (AddressId,contactNumber,country,CState,city,contactAddress,zipcode) VALUES(1,'$phone','$bcountry','$bstate','$bcity','$billaddr','$bzip')";
  if(mysqli_query($con,$sql2)){
    $contactid = mysqli_insert_id($con);
    $i++;

    $sql3="INSERT INTO PersonContact (ContactId,PersonId) VALUES($contactid,$personid)";
  if(mysqli_query($con,$sql3)){
    $i++;

    $sql6="INSERT INTO ContactMaster (AddressId,country,CState,city,contactAddress,zipcode) VALUES(2,'$scountry','$sstate','$scity','$shipaddr','$szip')";
  if(mysqli_query($con,$sql6)){
    $contactid1=mysqli_insert_id($con);
    $i++;

    $sql7="INSERT INTO PersonContact (ContactId,PersonId) VALUES($contactid1,$personid)";
  if(mysqli_query($con,$sql7)){
    $i++;

    $sql4="INSERT INTO ContactDocument (DocumentId,PersonId,DocumentNumber) VALUES(4,$personid,'$gstin')";
  if(mysqli_query($con,$sql4)){
    $i++;

    $sql5="INSERT INTO ContactDocument (DocumentId,PersonId,DocumentNumber) VALUES(1,$personid,'$PAN')";
if(mysqli_query($con,$sql5)){
  $i++;
            }
          }
        }
      }
    }
  }
}
if($i==7){
 $response['msg']=$ctype.' '.$fname." Added Successfully";
}
else{
  $response['msg']='Server Error Please Try Again';
}
}
mysqli_close($con);
exit(json_encode($response));
?>