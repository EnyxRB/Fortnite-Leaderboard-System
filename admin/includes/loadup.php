<?php
require_once('../includes/functions.php');

session_start();

if(!isset($_SESSION['logged_in'])){
	redirect("../index.php");			
}

$array = array();

$baseTable = array( //DO NOT CHANGE ANY OF THESE VALUES.
//GENERAL OPTIONS
"Mode" => "tournament",
"Games To Play" => 4,

//TOURNAMENT OPTIONS
"Points per Solo kill" => 10,
"Points per Duo kill" => 5,
"Points per Trio kill" => 3,
"Points per Squad kill" => 2,
"Points for 1st Placement" => 100,
"Points for 2nd Placement" => 50,
"Points for 3rd Placement" => 20,

//PARTY OPTIONS
"Points per kill" => 10,
"Points for 1st Placement2" => 100 
);

$baseJson = json_encode($baseTable);

//Error Checker
if (json_last_error() != JSON_ERROR_NONE){
	echo "The format of the baseTable is incorrect! Please check loadup.php script.";
}

if(file_exists("options.txt")){
	$file = fopen("options.txt", "r") or die("Unable to read Settings file 'options.txt'. Please try again.");
	$string = fread($file,filesize("options.txt"));
	fclose($file);

	$array = json_decode($string, true);
	if (json_last_error() != JSON_ERROR_NONE){
		echo "Settings file 'options.txt' is corrupt! Please go to admin/includes and manually delete it.";
		exit();
	}	
}
else{
	$file = fopen("options.txt", "w") or die("Cannot create File at the moment. Please try again.");
	fwrite($file, $baseJson);
	fclose($file);
	
	$array = $baseTable;
	echo "New settings file 'options.txt' created";
}

if (isset($_SESSION["f_settings"])){
	unset($_SESSION["f_settings"]);
}

$_SESSION["f_settings"] = $array;
redirect("../fortnite/index.php");
?>