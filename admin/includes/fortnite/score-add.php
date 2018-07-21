<?php

//FIX NEED TO VALIDATE USER TYPE SO PEOPLE CANT ENTER A USER GROUP THAT DOESNT EXIST BY EDITING THE HTML. MAKE PHPMYADMIN TABLE OF GROUPS.

require_once('../functions.php'); 
include('../settings.php');

session_start();

if(!isset($_SESSION['logged_in'])){
	redirect("../../index.php");			
}

function f($a, $x){
	return pow($a,$x);
}

function register($name,$placement,$kills){	
	global $servername;
	global $dbname;
	global $dbusername;
	global $dbpassword;	
		
	//Get current score and number of players
	$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
	$sql = "SELECT name, score, players FROM fortnite";
	$result = $conn->query($sql);
	$players = 0;
	$curscore = 0;
	
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			if ($row["name"] == $name){
				$players = $row["players"];
				$curscore = $row["score"];
			}
		}
	} else {
		echo "0 results";
	}
	$conn->close();
	
	//Setting up Custom Score variables
	$mode = $_SESSION['f_settings']['Mode'];
	
	$score = 0;
	$inc = 0;
	
	if ($mode == "tournament"){ //TOURNEY MODE				
		if ($placement == 1){$score = $_SESSION['f_settings']['Points for 1st Placement'];}
		else if ($placement == 2){$score = $_SESSION['f_settings']['Points for 2nd Placement'];}
		else if ($placement == 3){$score = $_SESSION['f_settings']['Points for 3rd Placement'];}
		
		if ($players == 1){$inc = $_SESSION['f_settings']['Points per Solo kill'];}
		else if ($players == 2){$inc = $_SESSION['f_settings']['Points per Duo kill'];}
		else if ($players == 3){$inc = $_SESSION['f_settings']['Points per Trio kill'];}
		else if ($players == 4){$inc = $_SESSION['f_settings']['Points per Squad kill'];}	
	}
	else{ //PARTY MODE
		$maxscore = $_SESSION['f_settings']['Points for 1st Placement2'];
		$inc = $_SESSION['f_settings']['Points per kill'];
		
		$score = ($maxscore + 1) - $placement; //E.g If maxscore = 100, 1st Points = 100
	}
	
	$score = $score + ($kills * $inc);
	$newscore = $curscore + $score;
	
	// Overwrite data
	$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
	$sql = "UPDATE fortnite SET score = ".$newscore.", games = games + 1 WHERE name='".$name."'";

	if ($conn->query($sql) === TRUE) {
		echo "Record updated successfully";
	} else {
		echo "Error updating record: " . $conn->error;
	}

	$conn->close();
	$_SESSION['error'] = "Score updated";
	redirect('../../fortnite/add-score.php');
}

$uname = $_POST['name'];
$uplacement = $_POST['placement'];
$ukills = $_POST['kills'];

if (str_replace(' ', '', $uname)==""){
	$_SESSION['error'] = "Please enter a name";
	redirect('../../fortnite/add-score.php');	
}

elseif (str_replace(' ', '', $uplacement)==""){
	$_SESSION['error'] = "Please enter a placement";
	redirect('../../fortnite/add-score.php');	
}

elseif (!is_numeric($uplacement)){
	$_SESSION['error'] = "Placement must be a number";
	redirect('../../fortnite/add-score.php');		
}

elseif (str_replace(' ', '', $ukills)==""){
	$_SESSION['error'] = "Please enter an amount of kills";
	redirect('../../fortnite/add-score.php');		
}

elseif (!is_numeric($ukills)){
	$_SESSION['error'] = "Kills must be a number";
	redirect('../../fortnite/add-score.php');		
}

else
	register($uname,$uplacement,$ukills);

?>