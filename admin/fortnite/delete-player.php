<?php
require_once('../includes/functions.php');
require_once('../includes/settings.php');

session_start();

if(!isset($_SESSION['logged_in'])){
	redirect("../index.php");			
}

global $servername;
global $dbname;
global $dbusername;
global $dbpassword;
?>

<!doctype html>
<html lang="en">
	<head>
	    <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Fortnite Admin Section | Add Score</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
		<link rel="stylesheet" href="../css/tools.css?v=1.1">
		<link rel="stylesheet" type="text/css" href="../css/custom-boot.css?ver=1">
	</head>
	<body class="bg-dark text-light">
		<div class="container-fluid">
			<div class="d-flex justify-content-center">
				<h1 style="text-align: center;">Delete Player</h1></br>
			</div>
			
			<form action="../includes/fortnite/player-delete.php" method="post" align="center" id="form1">
				<div class="form-group">
					<label for="sel1">Player/Team Name:</label>
					<select class="form-control border-0 rounded bg-secondary text-white" id="sel1" name="name">
				<?php
				try{
					$conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $dbusername, $dbpassword);
					if (!$conn){
						$_SESSION['error'] = "Couldn't connect to the database";
						redirect('../../members.php');
					}				

					$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					
					$sql_select = 'SELECT name FROM noah_fortnite';
					
					foreach ($conn->query($sql_select) as $row) {
						$n = $row["name"];
						echo '<option value = "'.$n.'">'.$n.'</option>';
					}
					
				}
				catch(PDOException $e){
					echo $sql . "<br>" . $e->getMessage();
				}

				$conn = null;						
				?>		
					</select>
				</div>

				<div class="form-group" style="text-align: center;">
				  <label for="usr">Are you sure?</label></br>
				  <label><input type="checkbox" name="sure" value="Yes"> Yes</label>	
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
				
				<button type="submit" form="form1" class="btn btn-primary btn-lg">Submit</button></br></br>
				<a href="../index.php"><button type="button" class="btn btn-warning btn-lg">Back</button></a>		
			</form>
		</div>
		
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>						
	</body>
</html>