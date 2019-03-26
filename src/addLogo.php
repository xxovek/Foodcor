<?php
include '../config/connection.php';
session_start();
$company_id= $_SESSION['company_id'];

if(isset($_FILES['image']))
{
    $file_name=$_FILES['image']['name'];
    $file_tmp=$_FILES['image']['tmp_name'];

    move_uploaded_file($file_tmp,"../public_html/assets/img/".$file_name);
    echo "uploaded" ;
}
$sql="UPDATE CompanyMaster,ContactMaster SET logo='$file_name' WHERE  CompanyId='$company_id'";
$result=mysqli_query($con,$sql);
?>
