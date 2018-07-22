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

function save_directory($dirname) {
	 if (is_dir($dirname)){
	   $dir_handle = opendir($dirname);
	 }
     if (!$dir_handle)
          return false;
     while($file = readdir($dir_handle)) {
           if ($file != "." && $file != "..") {
                if (!is_dir($dirname."/".$file))
                     unlink($dirname."/".$file);
                else
                     save_directory($dirname.'/'.$file);
           }
     }
     closedir($dir_handle);
     rmdir($dirname);
     return true;
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