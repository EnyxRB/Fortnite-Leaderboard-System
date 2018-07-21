<?php 

$usergroups = array(
	"Admin",
	"Artist",
	"Developer",
	"User"
);

$access = array(
	array('image-upload','code-upload','add-member','bug-list','report-bug','cloud','user list','pw encoder','traffic data','func creator'),
	array('image-upload','report-bug'),
	array('code-upload','report-bug','user list','add-score','add-player','delete-player','view-scores'),
	array('report-bug')
);	

function userHasAccess($function){	
	global $usergroups;
	global $access;
	$hasAccess = false;
	if (isset($_SESSION['logged_in'])){ 
		if (isset($_SESSION['type'])){
			$type = $_SESSION['type'];
			$length = count($usergroups);
			for ($i = 0; $i < $length; $i++) {
				if ($usergroups[$i] == $type){
					for ($j = 0; $j < count($access[$i]); $j++) {
						if ($access[$i][$j]==$function){
							$hasAccess = true;
							return $hasAccess;	
						}					
					}
				}
			}		
		}
	}
	return $hasAccess;
}

function redirect($page){ 
    header('Location: ' . $page); 
    exit(); 
} 

function debug($error){
	$_SESSION['debug'] = $error;
	redirect("http://aeropath.co.uk/includes/debugger.php");
}
  
?>