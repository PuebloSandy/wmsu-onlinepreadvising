<?php 
 $connection=mysqli_connect("localhost","root","","online_preadvising");

 if($connection === false){
 	die("ERROR: COULD NOT CONNECT." .mysqli_connect_error());
 }
?>