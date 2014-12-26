<?php
$connect_error = 'Sorry Were experienceing connection problems';
mysql_connect('localhost','root','') or die($connect_error);
mysql_select_db('db');
?>