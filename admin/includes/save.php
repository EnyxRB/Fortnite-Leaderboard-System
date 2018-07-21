<?php
require_once('../includes/functions.php');

session_start();

if(!isset($_SESSION['logged_in'])){
	redirect("../index.php");			
}

function sendError($error){
	$_SESSION["error"] = $error;
	redirect("../fortnite/settings.php");
}

function checkNumber($val, $min, $max, $err){
	if (is_numeric($val)){
		if ($val < $min){
			sendError($err);
		}
		if ($max != 0){
			if ($val > $max){
				sendError($err);
			}
		}
	}
	else{
		sendError($err);
	}
}

$array = array();




$array["Mode"] = $_POST['s0'];
$array["Games To Play"] = filter_input(INPUT_POST, 's1', FILTER_VALIDATE_INT);

$array["Points per Solo kill"] = filter_input(INPUT_POST, 's2', FILTER_VALIDATE_INT);
$array["Points per Duo kill"] = filter_input(INPUT_POST, 's3', FILTER_VALIDATE_INT);
$array["Points per Trio kill"] = filter_input(INPUT_POST, 's4', FILTER_VALIDATE_INT);
$array["Points per Squad kill"] = filter_input(INPUT_POST, 's5', FILTER_VALIDATE_INT);
$array["Points for 1st Placement"] = filter_input(INPUT_POST, 's6', FILTER_VALIDATE_INT);
$array["Points for 2nd Placement"] = filter_input(INPUT_POST, 's7', FILTER_VALIDATE_INT);
$array["Points for 3rd Placement"] = filter_input(INPUT_POST, 's8', FILTER_VALIDATE_INT);

$array["Points per kill"] = filter_input(INPUT_POST, 's9', FILTER_VALIDATE_INT);
$array["Points for 1st Placement2"] = filter_input(INPUT_POST, 's10', FILTER_VALIDATE_INT);

//ERROR CHECKING OF SETTINGS
checkNumber($array["Games To Play"], 1, 0, "Games To Play must be a number and more than 0!");

checkNumber($array["Points per Solo kill"], 1, 0, "Tournament: Points per Solo kill must be a number and more than 0!");
checkNumber($array["Points per Duo kill"], 1, 0, "Tournament: Points per Duo kill must be a number and more than 0!");
checkNumber($array["Points per Trio kill"], 1, 0, "Tournament: Points per Trio kill must be a number and more than 0!");
checkNumber($array["Points for 1st Placement"], 1, 0, "Tournament: Points for 1st Placement must be a number and more than 0!");
checkNumber($array["Points for 2nd Placement"], 1, 0, "Tournament: Points for 2nd Placement must be a number and more than 0!");
checkNumber($array["Points for 3rd Placement"], 1, 0, "Tournament: Points for 3rd Placement must be a number and more than 0!");

checkNumber($array["Points per kill"], 1, 0, "Party: Points per kill must be a number and more than 0!");
checkNumber($array["Points for 1st Placement2"], 1, 0, "Party: Points for 1st Placement must be a number and more than 0!");

//SET NEW SESSION VARIABLES
if (isset($_SESSION["f_settings"])){
	unset($_SESSION["f_settings"]);
}

$_SESSION["f_settings"] = $array;

$json = json_encode($array);
if (json_last_error() != JSON_ERROR_NONE){
	echo "ERROR ENCODING JSON";
	exit();
}

$file = fopen("options.txt", "w") or die("Cannot edit File at the moment. Please try again.");
fwrite($file, $json);
fclose($file);

//REDIRECT BACK
redirect("../fortnite/index.php");
?>