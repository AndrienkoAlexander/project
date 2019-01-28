<?php
	class Car {
		var $attr_id;
		var $name;
		var $price;
		var $serial_num;
		var $year;
		var $file_name;
		var $car_type;
		var $gear_box;
		var $power;

		function __construct($aa) 
		{
			foreach ($aa as $k=>$v)
				$this->$k = $v;
	    }
	}

	function getCar($filename, $id){
		$N = 8;
		// чтение XML-базы данных
		if(!file_exists($filename))
		{
			return false;
		}
		$data = file_get_contents($filename);

		$parser = xml_parser_create();
		xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
		xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
		xml_parse_into_struct($parser, $data, $values, $tags);
		xml_parser_free($parser);

		$car["attr_id"] = $id;
		foreach ($values as $val) {
			if($val['tag'] == "car" && $val['type'] == "open") {
				if($val['attributes']['id'] == $id) {
					$j = array_keys($values, $val)[0] + 1;
					for ($i=$j; $i < $j+$N; $i++) { 
						$car[$values[$i]["tag"]] = $values[$i]["value"];
					}
					break;
				}
			}
		}
		return new Car($car);
	}

	function xml_to_object($filename) 
	{
		// чтение XML-базы данных
		if(!file_exists($filename))
		{
			return false;
		}
		$data = file_get_contents($filename);

		$parser = xml_parser_create();
		xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
		xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
		xml_parse_into_struct($parser, $data, $values, $tags);
		xml_parser_free($parser);

		// проход через структуры
		foreach ($tags as $key=>$val) {
			if ($key == "car") {
				$carranges = $val;
				// каждая смежная пара значений массивов является верхней и
				// нижней границей определения
				for ($i=0; $i < count($carranges); $i+=2) {
					$offset = $carranges[$i] + 1;
					$len = $carranges[$i + 1] - $offset;
					$tdb[] = parseCar(array_slice($values, $offset, $len));
				}
			} 
			else { continue; }
		}

		return getAttributes($values, $tdb);
	}

	function parseCar($cvalues) 
	{
		for ($i=0; $i < count($cvalues); $i++) {
			$car[$cvalues[$i]["tag"]] = $cvalues[$i]["value"];
		}
		return new Car($car);
	}

	function getAttributes($values, $tdb){
		$i = 0;
		foreach ($values as $val) {
			if($val['tag'] == "car" && $val['type'] == "open"){
				$tdb[$i]->attr_id = $val['attributes']['id'];
				$i++;
			}
		}
		return $tdb;
	}

	function printCars($db){
		echo '<div class="products">';
		foreach ($db as $key => $value) {
			echo '<div class="cars">';
			echo '<p class="car_name">'. $value->attr_id . ". " . $value->name .'</p>';
			echo '<img src="xml/auto/'. $value->file_name .'" alt="'. $value->name .'">';
			echo '<ul>';
			echo '<li>Цена: $'. $value->price .'</li>';
			echo '<li>Серийный номер: '. $value->serial_num .'</li>';
			echo '<li>Год:'. $value->year .'</li>';
			echo '<li>Тип автомобиля: '. $value->car_type .'</li>';
			echo '<li>Коробка передач: '. $value->gear_box .'</li>';
			echo '<li>Мощность: '. $value->power .' л.с.</li>';
			echo '</ul>';
			echo '</div>';
		}
		echo '</div>';
	}

	function printCarsAX($db){
		echo '<div class="products">';
		foreach ($db as $key => $value) {
			echo '<div class="cars" id="'. $value->attr_id .'">';
			echo '<p class="car_name"><span class="car_id">'. $value->attr_id . "</span>. " . $value->name .'</p>';
			echo '<img src="xml/auto/'. $value->file_name .'" alt="'. $value->name .'">';
			echo '<ul id="'. $value->attr_id .'l">';
			echo '<li>Цена: $'. $value->price .'</li>';
			echo '</ul>';
			echo '<p class="more" id="'. $value->attr_id .'" onclick="ajaxRequest()">Подробнее</p>';
			echo '</div>';
		}
		echo '</div>';
	}

	function printCarsJQ($db){
		echo '<div class="products">';
		foreach ($db as $key => $value) {
			echo '<div class="cars" id="'. $value->attr_id .'">';
			echo '<p class="car_name"><span class="car_id">'. $value->attr_id . "</span>. " . $value->name .'</p>';
			echo '<img src="xml/auto/'. $value->file_name .'" alt="'. $value->name .'">';
			echo '<ul id="'. $value->attr_id .'l">';
			echo '<li>Цена: $'. $value->price .'</li>';
			echo '</ul>';
			echo '<p class="mr" id="'. $value->attr_id .'">Подробнее</p>';
			echo '</div>';
		}
		echo '</div>';
	}
?>