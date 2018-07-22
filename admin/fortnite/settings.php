<?php

require_once('../includes/functions.php');

session_start();

if(!isset($_SESSION['logged_in'])){
	redirect("../index.php");			
}

if(!isset($_SESSION['f_settings'])){
	redirect("../includes/loadup.php");
}

?>

<!doctype html>
<html lang="en">
	<head>
	    <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Fortnite Admin Section | Settings</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
		<link rel="stylesheet" href="../css/tools.css?v=1.1">	
		<link rel="stylesheet" type="text/css" href="../css/custom-boot.css?ver=1">
	</head>
	<body class="bg-dark text-light">
		<div class="container-fluid">
			<div class="d-flex justify-content-center">
				<h1 style="text-align: center;">Leaderboard Settings</h1></br></br>
			</div>
			
			<div class="d-flex justify-content-center">
			<?php
				if (isset($_SESSION['error'])){
					echo '<div class="error alert alert-danger" role="alert">';
						echo $_SESSION['error'];
					echo '</div>';
					unset($_SESSION['error']); 
				}
				else{
					echo "</br>";
				}
			?>
			</div>		
			
			<h2 style="text-align: left;">General Options:</h2>
						
			<form action="../includes/save.php" method="post" align="center" id="form1" class="form-horizontal">

				<div class="form-group">
				  <label for="usr">Games to play (Default 4):</label>
				  <input type="text" class="form-control border-0 rounded bg-secondary text-white" id="usr" name="s1" value="<?php echo $_SESSION['f_settings']['Games To Play']; ?>">	
				</div>			
			
				<div class="form-group">
				  <label for="sel1">Mode:</label>
				  <select class="form-control border-0 rounded bg-secondary text-white" id="sel1" name="s0">
					<?php 
					$mode = $_SESSION['f_settings']['Mode'];
					
					if ($mode == "tournament"){
						echo'<option value = "tournament" selected="selected">Tournament Mode</option>
							<option value = "party">Party Mode</option>
							';
					}
					else{
						echo'<option value = "tournament">Tournament Mode</option>							
							<option value = "party" selected="selected">Party Mode</option>
							';						
					}
					?>
				  </select>
				</div>
				
				<div style="text-align: left;">
					<p><span style="font-weight: bold;">
					Tournament Mode</span></br>
					-Players get a set amount of points for getting 1st, 2nd or 3rd placement in a game.</br>
					-Players get points for kills, based on the number of players in a party.</br>
					</br>
					<span style="font-weight: bold;">
					Party Mode</span></br>
					-All Players will get points, depending on their placement in a game (e.g. points = 101 points - placement).</br>
					-All Players get a set amount of points per kill.</br>
					</p></br>
				</div>
			
				<h2 style="text-align: left;">Tournament Options:</h2>
				
				<div class="form-group">
				  <label for="usr">Points per Solo kill (Default 10):</label>
				  <input type="text" class="form-control border-0 rounded bg-secondary text-white" id="usr" name="s2" value="<?php echo (int)$_SESSION['f_settings']['Points per Solo kill']; ?>">	
				</div>
				
				<div class="form-group">
				  <label for="usr">Points per Duo kill (Default 5):</label>
				  <input type="text" class="form-control border-0 rounded bg-secondary text-white" id="usr" name="s3" value="<?php echo (int)$_SESSION['f_settings']['Points per Duo kill']; ?>">	
				</div>	

				<div class="form-group">
				  <label for="usr">Points per Trio kill (Default 3):</label>
				  <input type="text" class="form-control border-0 rounded bg-secondary text-white" id="usr" name="s4" value="<?php echo (int)$_SESSION['f_settings']['Points per Trio kill']; ?>">	
				</div>		

				<div class="form-group">
				  <label for="usr">Points per Squad kill (Default 2):</label>
				  <input type="text" class="form-control border-0 rounded bg-secondary text-white" id="usr" name="s5" value="<?php echo $_SESSION['f_settings']['Points per Squad kill']; ?>">	
				</div>	

				<div class="form-group">
				  <label for="usr">Points for 1st Placement (Default 100):</label>
				  <input type="text" class="form-control border-0 rounded bg-secondary text-white" id="usr" name="s6" value="<?php echo $_SESSION['f_settings']['Points for 1st Placement']; ?>">	
				</div>	

				<div class="form-group">
				  <label for="usr">Points for 2nd Placement (Default 50):</label>
				  <input type="text" class="form-control border-0 rounded bg-secondary text-white" id="usr" name="s7" value="<?php echo $_SESSION['f_settings']['Points for 2nd Placement']; ?>">	
				</div>

				<div class="form-group">
				  <label for="usr">Points for 3rd Placement (Default 20):</label>
				  <input type="text" class="form-control border-0 rounded bg-secondary text-white" id="usr" name="s8" value="<?php echo $_SESSION['f_settings']['Points for 3rd Placement']; ?>">	
				</div></br>					
								
				<h2 style="text-align: left;">Party Options:</h2>
	
				<div class="form-group">
				  <label for="usr">Points per kill (Default 10):</label>
				  <input type="text" class="form-control border-0 rounded bg-secondary text-white" id="usr" name="s9" value="<?php echo $_SESSION['f_settings']['Points per kill']; ?>">	
				</div>
	
				<div class="form-group">
				  <label for="usr">Points for 1st Placement (Default 100):</label>
				  <input type="text" class="form-control border-0 rounded bg-secondary text-white" id="usr" name="s10" value="<?php echo $_SESSION['f_settings']['Points for 1st Placement2']; ?>">	
				</div></br>				
							
				<button type="submit" form="form1" class="btn btn-primary btn-lg">Submit</button></br></br>
				<a href="../index.php"><button type="button" class="btn btn-warning btn-lg">Back</button></a>
			</form></br>
		</div>
		
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>		
	</body>
</html>