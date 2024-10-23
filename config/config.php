<?php

//database inloggegevens
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$db = "86712";

$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
error_reporting(0);
ob_start();
//https://www.canva.com/colors/color-palettes/summer-splash
//https://www.canva.com/colors/color-palettes/mountain-haze