<?php 
	function GetValue($name, $init_value)
	{
		if(isset($_POST[$name])){
			$data = $_POST[$name];
			return DataProcess($data);
		}
		else if(isset($_GET[$name])){
			$data = $_GET[$name]; 
			return DataProcess($data);
		}
		else
			return $init_value;
	}

	function DataProcess($data) {
		if(is_array($data)){
			return $data;
		}
		else {
			trim($data);
			return $data;
		}
	}
?>