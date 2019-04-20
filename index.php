<?php
session_start();
if(isset($_SESSION['company_id'])){
  header('Location:public_html/index.php');
}else {
header('Location:public_html/login.php');
}
 ?>
