<?php

//FIX NEED TO VALIDATE USER TYPE SO PEOPLE CANT ENTER A USER GROUP THAT DOESNT EXIST BY EDITING THE HTML. MAKE PHPMYADMIN TABLE OF GROUPS.

require_once('../functions.php'); 
include('../settings.php');

session_start();

if(!isset($_SESSION['logged_in'])){
	redirect("../../index.php");			
}

if (!isset($_POST['sure'])){
	$_SESSION['error'] = "Tickbox not checked.";
	redirect('../../fortnite/delete-player.php');
}

$uname = $_POST['name'];

global $servername;
global $dbname;
global $dbusername;
global $dbpassword;	

$con = new mysqli($servername,$dbusername,$dbpassword,$dbname);
if ($con->connect_errno)
{
    echo "Error: " . $con->connect_error . "\n";
    exit;
}

$sql="DELETE FROM fortnite WHERE name='$uname'";
$con->query($sql);

$_SESSION['error'] = "Player deleted";

$con->close();
redirect('../../fortnite/delete-player.php');
?>