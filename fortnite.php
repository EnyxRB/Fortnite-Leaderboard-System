<?php

require_once('admin/includes/functions.php');
require_once('admin/includes/settings.php');

session_start();

global $servername;
global $dbname;
global $dbusername;
global $dbpassword;
?>

<html>
	<head>
	<link rel="stylesheet" href="admin/css/scoreboard.css?v=1.1">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="refresh" content="15" />
	</head>
	<body>
		<div id="content">
			<img src="admin/images/fortnite.png">
			<table>
				<tr>
					<th>Name</th>
					<th>Number of Players</th>
					<th>Games Played</th>
					<th>Total Score</th>
				</tr>
				<?php
					try{
						$conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $dbusername, $dbpassword);
						if (!$conn){
							$_SESSION['error'] = "Couldn't connect to the database";
							redirect('../../members.php');
						}				

						$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
						$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						
						$sql_select = 'SELECT name, players, games, score FROM fortnite ORDER BY score + 0 DESC';
						$offlineAr = array();
						
					    foreach ($conn->query($sql_select) as $row) {
							echo'
							<tr>
								<td>'.$row["name"].'</td>
								<td>'.$row["players"].'</td>
								<td>'.$row["games"].'</td>
								<td>'.$row["score"].'</td>
							</tr>
							';
					    }

					    foreach ($offlineAr as $ar) {
							echo'
							<tr>
								<td>'.$ar[0].'</td>
								<td>'.$ar[1].'</td>
								<td>'.$ar[2].'</td>
								<td>'.$ar[3].'</td>
							</tr>
							';    	
					    }

					}
					catch(PDOException $e){
						echo $sql . "<br>" . $e->getMessage();
					}

					$conn = null;
				?>

			</table>

		</div>
	</body>
</html>