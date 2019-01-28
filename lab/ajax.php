<?php  
	$title = "AJAX JS"; 
	$content_title = "AJAX JS";
	include 'php/header.php';
	require 'car.php';

	$db = xml_to_object("xml/auto_shop.xml");
	if(!is_bool($db)) {
		printCarsAX($db);
	}
	else {
		echo '<div class="products"><p>Файл не найден!</p></div>';
	}
	include 'php/footer.php';
?>