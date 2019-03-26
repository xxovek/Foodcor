<?php
include '../config/connection.php';
session_start();
$company_id= $_SESSION['company_id'];
$person_id= $_SESSION['person_id'];
$response=[];

  $sql1 = "SELECT DocumentNumber FROM ContactDocument WHERE personId='$person_id' AND DocumentId=1";
  $result1= mysqli_query($con,$sql1);
  if(mysqli_num_rows($result1)>0)
  {
    $cpan=$_REQUEST['cpan'];
    $sql2="UPDATE ContactDocument SET DocumentNumber='$cpan' WHERE personId='$person_id' AND DocumentId=1";
    mysqli_query($con,$sql2);
}
else if(!empty($_REQUEST['cpan']))
{
  $cpan=$_REQUEST['cpan'];
      $sql3="INSERT into ContactDocument (DocumentId,personId,DocumentNumber) values(1,'$person_id','$cpan')";
    mysqli_query($con,$sql3);
  }

  $sql4 = "SELECT DocumentNumber FROM ContactDocument WHERE personId='$person_id' AND DocumentId=2";
  $result2= mysqli_query($con,$sql4);
  if(mysqli_num_rows($result2)>0)
{
    $cadhar=$_REQUEST['cadhar'];
    $sql5="UPDATE ContactDocument SET DocumentNumber='$cadhar' WHERE personId='$person_id' AND DocumentId=2";
    mysqli_query($con,$sql5);
}
else if(!empty($_REQUEST['cadhar']))
{
  $cadhar=$_REQUEST['cadhar'];
      $sql6="INSERT into ContactDocument (DocumentId,personId,DocumentNumber) values(2,'$person_id','$cadhar')";
      mysqli_query($con,$sql6);
  }
  $sql7= "SELECT DocumentNumber FROM ContactDocument WHERE personId='$person_id' AND DocumentId=3";
  $result3= mysqli_query($con,$sql7);
  if(mysqli_num_rows($result3)>0)
{
    $cpassport=$_REQUEST['cpassport'];
    $sql8="UPDATE ContactDocument SET DocumentNumber='$cpassport' WHERE personId='$person_id' AND DocumentId=3";
    mysqli_query($con,$sql8);
}
else if(!empty($_REQUEST['cpassport']))
{
  $cpassport=$_REQUEST['cpassport'];
      $sql9="INSERT into ContactDocument (DocumentId,personId,DocumentNumber) values(3,'$person_id','$cpassport')";
      mysqli_query($con,$sql9);
  }
  $sql10 = "SELECT DocumentNumber FROM ContactDocument WHERE personId='$person_id' AND DocumentId=4";
  $result4= mysqli_query($con,$sql10);
  if(mysqli_num_rows($result4)>0)
{
    $cgstin=$_REQUEST['cgstin'];
    $sql11="UPDATE ContactDocument SET DocumentNumber='$cgstin' WHERE personId='$person_id' AND DocumentId=4";
    mysqli_query($con,$sql11);
}
else if(!empty($_REQUEST['cgstin']))
{
  $cgstin=$_REQUEST['cgstin'];
      $sql12="INSERT into ContactDocument (DocumentId,personId,DocumentNumber) values(4,'$person_id','$cgstin')";
      mysqli_query($con,$sql12);
  }
  $sql13 = "SELECT DocumentNumber FROM ContactDocument WHERE personId='$person_id' AND DocumentId=5";
  $result5= mysqli_query($con,$sql13);
  if(mysqli_num_rows($result5)>0)
{
    $ccin=$_REQUEST['ccin'];
    $sql14="UPDATE ContactDocument SET DocumentNumber='$ccin' WHERE personId='$person_id' AND DocumentId=5";
    mysqli_query($con,$sql14);
}
else if(!empty($_REQUEST['ccin']))
{
  $ccin=$_REQUEST['ccin'];
  $sql15="INSERT into ContactDocument (DocumentId,personId,DocumentNumber) values(5,'$person_id','$ccin')";
  mysqli_query($con,$sql15);
  }

if($result1 || $result2 || $result3 || $result4 || $result5)
  $response['true']=true;
  else
      $response['false']=false;

mysqli_close($con);
exit(json_encode($response));
 ?>
