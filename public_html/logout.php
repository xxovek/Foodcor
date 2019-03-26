<?php
session_start();
unset($_SESSION['comapnyIdid']);
unset($_SESSION['PersonId']);

session_destroy();
header("Location:./");
?>
