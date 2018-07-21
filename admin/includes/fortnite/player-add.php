<?php

//FIX NEED TO VALIDATE USER TYPE SO PEOPLE CANT ENTER A USER GROUP THAT DOESNT EXIST BY EDITING THE HTML. MAKE PHPMYADMIN TABLE OF GROUPS.

require_once('../functions.php'); 
include('../settings.php');

session_start();

if(!isset($_SESSION['logged_in'])){
	redirect("../../index.php");			
}

function register($name,$players){	
	global $servername;
	global $dbname;
	global $dbusername;
	global $dbpassword;
					
	try{
		$conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $dbusername, $dbpassword);
		if (!$conn){
			$_SESSION['error'] = "Couldn't connect to the database";
			redirect('../../pages/functions/fortnite/add-player.php');
		}				
		
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		//Finding if a user exists with that username inside database
		$sql_select = 'SELECT * FROM fortnite WHERE name=:name';
		$query_select = $conn->prepare($sql_select);
		
		$query_select->execute(array(':name' => $name));
		$dbuname = "";		
		$sql_insert = "";
		
		
		foreach ($query_select as $row) {
			$dbuname = $row['name'];	
		}
		
		if(strtolower($name)==strtolower($dbuname)){
			$_SESSION['error'] = "A player/team with that name has already been registered";
			//$sql_insert = "UPDATE fortnite SET score="+$score+", games="+$games+", players="+$players+" WHERE name='"+$name+"'";
			//$_SESSION['error'] = "Score updated";
			redirect('../../pages/functions/fortnite/add-player.php');			
		}
		
		else{
			//Inserting new user data into database
			$sql_insert = "INSERT INTO fortnite (name, players) VALUES (:name, :players)";
			$_SESSION['error'] = "Player added";
		}
		
		$query_insert = $conn->prepare($sql_insert);
		
		$query_insert->execute(array(
			':name' => $name,
			':players' => $players
		));
			
			
		redirect('../../fortnite/add-player.php');	
	
				
	}
	catch(PDOException $e){
		echo $sql . "<br>" . $e->getMessage();
	}

	$conn = null;
}

$uname = $_POST['name'];
$uplayers = $_POST['players'];

if (str_replace(' ', '', $uname)==""){
	$_SESSION['error'] = "Please enter a name";
	redirect('../../fortnite/add-player.php');	
}

else
	register($uname,$uplayers);

?>