<!DOCTYPE html>
<html>
<body>

<h1>Thanks for your help!</h1>

<?php 
session_start();
$var_value = $_SESSION['sticazzi'];
echo "$var_value";
?>


</html>
