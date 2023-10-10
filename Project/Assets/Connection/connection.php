<?php
$server="localhost";
$username="root";
$password="";
$db="db_launtech";
$con=mysqli_connect($server,$username,$password,$db);
if(!$con)
{ 
	echo "connection failed";
}

?>