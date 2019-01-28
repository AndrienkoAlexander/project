<?php 
	$title = "Регистрация JS";
	$content_title = "Регистрация";
	include "php/header.php";
?>

<form method="GET" class="formWithValidation" onsubmit="validate();">
	<div>
		<div>
			<label>Имя:</label>
		</div>
		<div>
			<input id="fname" name="fname" type="text" class="fields" />
		</div>
	</div>
	<div>
		<div>
			<label>Фамилия:</label>
		</div>
		<div>
			<input id="sname" name="sname" type="text" class="fields" />
		</div>
	</div>
	<div>
		<div>
			<label>Отчество:</label>
		</div>
		<div>
			<input id="patronymic" name="patronymic" type="text" class="fields" />
		</div>
	</div>
	<div>
		<div>
			<label>Возраст:</label>
		</div>
		<div>
			<select id="age" name="age">
				<option></option>
				<option value="1">до 16</option>
				<option value="2">16-21</option>
				<option value="3">21-27</option>
				<option value="4">27-35</option>
				<option value="5">35-45</option>
				<option value="6">45-55</option>
				<option value="7">больше 55</option>
			</select>
		</div>
	</div>
	<div>
		<div>
			<label>О себе:</label>
		</div>
		<div>
			<textarea id="about" name="about"></textarea>
		</div>
	</div>
	<div>
		<input type="submit" id="validateBtn" value="Отправить" onclick="return validate()" />
	</div>
</form>

<?php include "php/footer.php";?>