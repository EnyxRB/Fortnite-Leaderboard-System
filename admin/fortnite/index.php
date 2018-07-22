<?php
require_once('../includes/functions.php');

session_start();

if(!isset($_SESSION['logged_in'])){
	redirect("../index.php");			
}
?>

<!doctype html>
<html lang="en">
	<head>
	    <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Fortnite Admin Section | Tools</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
		<link rel="stylesheet" href="../css/tools.css?ver=1.1">
		<link rel="stylesheet" type="text/css" href="../css/custom-boot.css?ver=1">
	</head>
	<body class="bg-dark text-light">
		<div class="container-fluid">
			<div class="d-flex justify-content-center">
				<h1 style="text-align: center;">Fortnite Leaderboard Admin Panel</h1></br>
			</div>
			</br>
			<a href="add-player.php"><button type="button" class="btn btn-primary btn-lg">Add Player</button></a></br></br>
			<a href="add-score.php"><button type="button" class="btn btn-primary btn-lg">Add Score</button></a></br></br>
			<a href="delete-player.php"><button type="button" class="btn btn-primary btn-lg">Delete Player</button></a></br></br>
			<a href="view-scores.php"><button type="button" class="btn btn-primary btn-lg">View Leaderboard</button></a></br></br>
			<a href="settings.php"><button type="button" class="btn btn-primary btn-lg">Settings</button></a></br></br>
			
			<a href="../includes/logout.php"><button type="button" class="btn btn-danger btn-md">Log Out</button></a>
		</div>
		
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>		
	</body>
</html>