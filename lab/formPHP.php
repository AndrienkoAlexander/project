<?php 
	require 'functions.php';
	$title = "Регистрация PHP";
	$content_title = "Регистрация";
	include "php/header.php";

	$formv = $patronymicERR = $fnameERR = $snameERR = "";
	$fname = "Ivan";
	$sname = "Ivanov";
	$patronymic = "Ivanovich";
	$age = "1";
	$about = "";
	$error = false;

	$formv = GetValue("formv", "");

	if ($formv == "formvalid") {
		$fname = GetValue("fname", "Ivan");
		$sname = GetValue("sname", "Ivanov");
		$patronymic = GetValue("patronymic", "Ivanovich");
		$age = GetValue("age", "1");
		$about = GetValue("about", "");
		
		$fnameERR = CheckField($fname, $error);
		$snameERR = CheckField($sname, $error);
		$patronymicERR = CheckField($patronymic, $error);

		if(!$error){
			$msg = true;
		}
	}

	function CheckField($field, &$error)
	{
		$str = "";
		if ($field == ""){
			$str = "Пустое поле";
			$error = true;
			return $str;
		}
		if (preg_match("/[^A-Za-z]+/", $field)) {
			$str = "Недопустимый символ";
			$error = true;
		}
		return $str;
	}

	if(isset($msg)){
		echo '<script language="javascript">';
		echo 'alert("Регистрация прошла успешно!")';
		echo '</script>';
		echo '<div id="valid">Регистрация прошла успешно!</div>';
	}
	else {
?>

<form method="POST" class="formWithValidation">
	<input type="hidden" name="formv" value="formvalid" >
	<div>
		<div>
			<label>Имя:</label>
		</div>
		<div class="error"><?=$fnameERR;?></div>
		<div>
			<input id="fname" name="fname" type="text" class="fields" value="<?=$fname;?>" />
		</div>
	</div>
	<div>
		<div>
			<label>Фамилия:</label>
		</div>
		<div class="error"><?=$snameERR;?></div>
		<div>
			<input id="sname" name="sname" type="text" class="fields" value="<?=$sname;?>" />
		</div>
	</div>
	<div>
		<div>
			<label>Отчество:</label>
		</div>
		<div class="error"><?=$patronymicERR;?></div>
		<div>
			<input id="patronymic" name="patronymic" type="text" class="fields" value="<?=$patronymic;?>" />
		</div>
	</div>
	<div>
		<div>
			<label>Возраст:</label>
		</div>
		<div>
			<select id="age" name="age">
				<option></option>
				<option value="1" <?php if($age == "1"){echo ("selected");}?> >до 16</option>
				<option value="2" <?php if($age == "2"){echo ("selected");}?> >16-21</option>
				<option value="3" <?php if($age == "3"){echo ("selected");}?> >21-27</option>
				<option value="4" <?php if($age == "4"){echo ("selected");}?> >27-35</option>
				<option value="5" <?php if($age == "5"){echo ("selected");}?> >35-45</option>
				<option value="6" <?php if($age == "6"){echo ("selected");}?> >45-55</option>
				<option value="7" <?php if($age == "7"){echo ("selected");}?> >больше 55</option>
			</select>
		</div>
	</div>
	<div>
		<div>
			<label>О себе:</label>
		</div>
		<div>
			<textarea id="about" name="about" value="<?=$about;?>"></textarea>
		</div>
	</div>
	<div>
		<input type="submit" id="validateBtn" value="Отправить" />
	</div>
</form>

<?php
	}
	include "php/footer.php";
?>