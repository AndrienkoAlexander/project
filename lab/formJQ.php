<?php 
	$title = "Регистрация JQ";
	$content_title = "Регистрация";
	include "php/header.php";
?>

<form method="GET" class="formWithValidation">
	<div class="inputBlock">
		<label for="fname">Имя:</label>
		<input name="fname" id="fname" type="text" class="field" data-description="Разрешены только латинские символы! Минимальная длина 2 символа."/>
		<div class="error-box"></div>
	</div>

	<div class="inputBlock">
		<label for="sname">Фамилия:</label>
		<input name="sname" id="sname" type="text" class="field" data-description="Разрешены только латинские символы! Минимальная длина 2 символа."/>
		<div class="error-box"></div>
	</div>

	<div class="inputBlock">
		<label for="patronymic">Отчество:</label>
		<input name="patronymic" id="patronymic" type="text" class="field" data-description="Разрешены только латинские символы! Минимальная длина 2 символа."/>
		<div class="error-box"></div>
	</div>

	<div class="inputBlock">
		<label for="age">Возраст:</label>
		<select name="age" id="age">
			<option></option>
			<option value="1">до 16</option>
			<option value="2">16-21</option>
			<option value="3">21-27</option>
			<option value="4">27-35</option>
			<option value="5">35-45</option>
			<option value="6">45-55</option>
			<option value="7">больше 55</option>
		</select>
		<div class="error-box"></div>
	</div>

	<div>
		<label for="about">О себе:</label>
		<textarea name="about" id="about"></textarea>
		<div class="error-box"></div>
	</div>

	<div>
		<input type="submit" id="validateBtn" value="Отправить"/>	
	</div>
</form>

<?php include "php/footer.php";?>