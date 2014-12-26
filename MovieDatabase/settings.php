<?php 
include 'core/init.php';
protect_page();
include 'include/overall/header.php';
?>
<h1><Settings</h1>
<form action="" method="post">
	<ul>
	<li>
		First name:<br>
		<input type="text" name="first_name">
	</li>
	<li>
		Last name:<br>
		<input type="text" name="last_name">
	</li>
	<li>
		Email:<br>
		<input type="text" name="Email">
	</li>
	<li>
		<input type="submit" value="UPDATE">
	</li>
	</ul>
</form>




<?php
include 'include/overall/footer.php';
?>   
