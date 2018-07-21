<?php
require_once('includes/functions.php');

session_start();

if(isset($_SESSION['logged_in'])){
	redirect("fortnite/index.php");			
}
?>

<!doctype html>
<html lang="en">
	<head>
	    <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Fortnite Admin Section | Login</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
		<link rel="stylesheet" href="css/tools.css">
	</head>
	<body>
		<div class="container-fluid">
			</br>
			<h1 style="text-align: center;">Fortnite Admin Login</h1>
			</br>
			<form action="includes/login.php" method="post" align="center" id="form1">
				Username: <input type="text" name="username"><p></p>
				Password: <input type="password" name="password"><p class="error">
				<div class="error">
					<?php
						if (isset($_SESSION['error'])){
							echo $_SESSION['error'];
							unset($_SESSION['error']); 
						}					
					?>
				</div>
				<p>
				
				<button type="submit" form="form1" class="btn btn-primary">Log in</button>

			</form>
		</div>
		
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>		
	</body>
</html>