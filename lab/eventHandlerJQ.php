<?php
	$title = "Обработка событий JQ"; 
	$content_title = "Обработка событий JQ";
	include 'php/header.php';
?>

<form id="eventForm">
	<div>
		<input type="checkbox" name="cb[]" id="sport">
		<label for="sport">Спорт</label>
	</div>
	<div>
		<input type="checkbox" name="cb[]" id="animals">
		<label for="animals">Животные</label>
	</div>
	<div>
		<input type="checkbox" name="cb[]" id="art">
		<label for="art">Искусство</label>
	</div>
	<div>
		<input type="checkbox" name="cb[]" id="tech">
		<label for="tech">Техника</label>
	</div>
	<div>
		<input type="checkbox" name="cb[]" id="prog">
		<label for="prog">Программирование</label>
	</div>
	<div>
		<input type="checkbox" name="cb[]" id="study">
		<label for="study">Учеба</label>
	</div>
	<div>
		<input type="checkbox" name="cb[]" id="friends">
		<label for="friends">Друзья</label>
	</div>
	<div>
		<input type="checkbox" name="cb[]" id="music">
		<label for="music">Музыка</label>
	</div>
	<div>
		<input type="checkbox" name="cb[]" id="dance">
		<label for="dance">Танцы</label>
	</div>
	<div>
		<input type="checkbox" name="cb[]" id="khai">
		<label for="khai">ХАИ</label>
	</div>
	<div>
		<input type="checkbox" name="cb[]" id="work">
		<label for="work">Работа</label>
	</div>
	<input type="button" name="all" value="Отметить все">
	<input type="button" name="off" value="Снять выделение">
	<input type="button" name="not" value="Инвертировать">
</form>

<?php
	include 'php/footer.php';
?>