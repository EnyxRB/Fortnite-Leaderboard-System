<?php

require_once('functions.php'); 
require_once('password.php');
include('settings.php');

session_start();

function login($username,$password){	
	global $servername;
	global $dbname;
	global $dbusername;
	global $dbpassword;
	
	try{
		$conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $dbusername, $dbpassword);
		if (!$conn){
			$_SESSION['error'] = "Couldn't connect to the database";
			redirect('../index.php');
		}				

		$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$sql_select = "SELECT * FROM noah_users WHERE username=:username";
		$query = $conn->prepare($sql_select);
		
		$query->execute(array(':username' => $username));
		
		$num_rows = $query->rowCount();
		$dbtype = NULL;
		$dbemail = "";
		
		if ($num_rows > 0){
		
			foreach ($query as $row) {
				$dbuname = $row['username'];
				$dbemail = $row['email'];	
				$dbpw = $row['password'];		
			}
			
			if(($username==$dbuname)&&password_verify($password, $dbpw)){
				if (isset($_SESSION['error'])){
					unset($_SESSION['error']);
				}

				$_SESSION['logged_in'] = true; 								
				redirect('loadup.php');					
			}
			
			else{
				$_SESSION['error'] = "Your username or password is incorrect";
				redirect('../index.php');				
			}
		}
		else{
			$_SESSION['error'] = "Your username or password is incorrect";
			redirect('../index.php');		
		}
	}
	catch(PDOException $e){
		echo $sql . "<br>" . $e->getMessage();
	}

	$conn = null;	
}

$username = $_POST['username'];
$password = $_POST['password'];

if($username&&$password)
{	
	login($username,$password);	
}
else
	$_SESSION['error'] = "Please enter a username and password";
	redirect('../index.php');
	
?>