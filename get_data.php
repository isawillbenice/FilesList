<?php

if (!empty($_POST['updateData'])) {
	clearTable($link);
}

$rows = getFilesInfoFromTable($link);
if (count($rows) === 0) {
	$rows = getFilesInfoFromDir(__DIR__);
	saveFilesInfoInTable($link, $rows);
}

function getFilesInfoFromTable($link) {
	$rows = array();

	$query = 'SELECT * FROM files';
	$result = mysqli_query($link, $query);

	if ($result->num_rows === 0) {
		return $rows;
	}

	while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC))) {
		$rows[] = $row;
	}

	mysqli_free_result($result);
	mysqli_close($link);

	return $rows;
}

function getFilesInfoFromDir($dir) {
	$paths = scandir($dir);
	$result = array();
	
	foreach($paths as $key => $value) {
		
		if (!in_array($value, array(".",".."))) {
			$info = pathinfo($value);
			$result[$key]['name'] = $info['filename'];
			$result[$key]['modified'] = date("Y-m-d H:i:s", filemtime($value));
			
			if (is_dir($value)) {
				$result[$key]['size'] = '[DIR]';
				$result[$key]['extension'] = '';
			}
			else {
				$result[$key]['size'] = filesize($value);
				$result[$key]['extension'] = $info['extension'];
			}
		}
	}

	return $result;
}

function saveFilesInfoInTable($link, $rows) {
	if (count($rows) === 0) {
		return;
	}

	$query = "INSERT INTO files (name, size, extension, modified) values ";

	$valuesArr = array();
	foreach($rows as $key => $value) {
		$name = mysqli_real_escape_string($link, $value['name']);
	    $size = $value['size'];
	    $extension = mysqli_real_escape_string($link, $value['extension']);
	    $modified = date('Y-m-d H:i:s', strtotime($value['modified'])); 

	    $valuesArr[] = "('$name', '$size', '$extension', '$modified')";
	}

	$query .= implode(',', $valuesArr);

	mysqli_query($link, $query); 
	mysqli_close($link);
}

function clearTable($link) {
	$query = 'TRUNCATE TABLE files';
	return mysqli_query($link, $query);
}
?>