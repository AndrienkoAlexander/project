<?php
	require 'functions.php';
	$title = "Файловый навигатор";
	$content_title = "Файловый навигатор"; 
	include "php/header.php";

	$formFN = GetValue("formFN", "");
	if($formFN == "formFileNav") {

		$folder = GetValue("folder", "");
		$f = str_replace(" ", "+", $folder);
		$sbm = GetValue("submit", "");
		$fl = GetValue("fl", "");
		$newname = "Папка";

		echo '<form action="do.php?folder='.$f.'" method="POST" id="FileNav">';
		echo '<input type="hidden" name="formR" value="formRequest">';

		if ($sbm == "Удалить")
		{
			if($fl != "") 
			{
				echo '<p>Удалить файлы?</p>';
				foreach ($fl as $i)
				{
					$tmp = str_replace("+", " ", $i);
					echo '<input type="hidden" name=fl[] value='.$i.'>';
					echo '<p>'.$tmp.' из папки '.$folder.'</p>';
					$fd = opendir($folder);
					if(is_dir($folder."/".$tmp) == True)
					{
						$hdl = opendir($folder."/".$tmp);
						$cnt = 0;
						while (false != ($file = readdir($hdl)))
						{
							$cnt++;
							if($cnt > 2) {
								echo '<p>'.$tmp.' содержит файлы!</p>';
								break;
							}
						}
						closedir($hdl);
					}
					closedir($fd);
				}
				echo '<input type="submit" value="Удалить" name="submit">';
			}
			else {
				echo '<div>Файлы не выбраны!</div>';
			}
		}
		else
		{
			echo '<div>Введите имя папки:</div><input value='.$newname.' type="text" name="newname"><br><input type="submit" value="Создать папку" name="submit">';
		}
	}
?>

	<input type="submit" value="Отмена" name="submit">
</form>

<?php include "php/footer.php";?>