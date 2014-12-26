<?php 
include 'core/init.php';
protect_page();
include 'include/overall/header.php';
?>
<h1>List of Movies</h1>
<p></p>  
<?php
view_films();
?>
<?php include 'include/overall/footer.php'; ?>   