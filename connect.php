<?php
 
$conn = mysqli_connect("localhost","root","","pharmacy");
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
