<?php 
include 'core/init.php';
include 'include/overall/header.php';

?>
<h1>Home</h1>
<p>Just a template.</p>  
<?php
if (isset($_SESSION['user_id']))
{
	echo   "Logged in";
}
else
{
	echo  "not logged in";
}
?>
<?php include 'include/overall/footer.php'; ?>   