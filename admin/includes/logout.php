<?php 

session_start(); 

require_once('functions.php'); 
include('settings.php');

if (!isset($_SESSION['logged_in'])){ 
	redirect('../index.php'); 
} 

// Kill session variables 
unset($_SESSION['logged_in']); 
unset($_SESSION['f_settings']);	

// Destroy session 
session_destroy();

redirect('../index.php');			  

?>