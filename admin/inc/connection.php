<?php

$db = mysqli_connect('localhost', 'root', '', 'newstoday');
if($db){
	//echo 'database connection established';
}
else{
	die('database connection error'.mysqli_error($db));}
?>