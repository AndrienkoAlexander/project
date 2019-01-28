<?php
	require 'functions.php';
	require 'car.php';

	$id = GetValue("id", "");
	$file_name = GetValue("file_name", "file");
	$car = getCar($file_name, $id);
	if(is_bool($car)) {
		echo json_encode(array('result' => 'error'));
	}
	echo json_encode(array_merge(array('result' => 'success'), (array)$car));
?>