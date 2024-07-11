<?php
$servername = "localhost";
$username = "user_nayakbeach";
$password = 'vVd*yM57?;HX';

date_default_timezone_set('Asia/Kolkata');
session_start(); 
$conDB = mysqli_connect("localhost","$username","$password","nayakbeach") or die("Connection Failed");


?>