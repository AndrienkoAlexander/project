<?php 
	$title = "POST";
	$content_title = "POST"; 
	include 'php/header.php';
?>

<form method="POST" action="ServerVariables.php" class="formWithValidation">
	<div>
		<div>
			<label>Переменная var1:</label>
		</div>
		<div>
			<input id="fname" name="var1" type="text"/>
		</div>
	</div>
	<div>
		<div>
			<label>Переменная var2:</label>
		</div>
		<div>
			<input id="sname" name="var2" type="text"/>
		</div>
	</div>
	<div>
		<div>
			<label>Переменная var3:</label>
		</div>
		<div>
			<input id="patronymic" name="var3" type="text"/>
		</div>
	</div>
	<div>
		<input type="submit" id="validateBtn" value="Отправить" />
	</div>
</form>

<?php include 'php/footer.php';?>