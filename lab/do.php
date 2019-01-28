<?php
	require 'functions.php';
	$title = "Файловый навигатор";
	$content_title = "Файловый навигатор"; 
	include "php/header.php";

		function delfiles($fld)
		{
			$hdl = opendir($fld);
			while (false != ($file = readdir($hdl)))
			{
				if (($file != ".") && ($file != ".."))
				{
					if (is_dir($fld."/".$file) == True)
					{
						delfiles ($fld."/".$file);
						rmdir ($fld."/".$file);
					}
					else
					{
						unlink ($fld."/".$file);    
					}
				}
			}
			closedir($hdl); 
		}

	$formR = GetValue("formR", "");
	if($formR == "formRequest")
	{
		$begin="files";
		$folder = GetValue("folder", "");
		$sbm = GetValue("submit", "");
		$fl = GetValue("fl", "");
		$newname = GetValue("newname", "Folder");

		if ((strpos($folder,$begin) != 0) || (strpos($folder,"..") != False))
		{
			exit;
		}

		if ($sbm == "Удалить")
		{
			foreach ($fl as $i => $v) 
			{
				$fl[$i] = str_replace("+", " ", $fl[$i]);
			}

			foreach ($fl as $i) 
			{
				if (is_dir($folder."/".$i) == True)
				{
					delfiles ($folder."/".$i);
					rmdir ($folder."/".$i);
				}
				else
				{
					unlink ($folder."/".$i);
				}
			}
		}
		else if($sbm == "Создать папку")
		{
			if(strlen($newname) == 0)
			{
				$newname = "Папка";
			}
			$newname=$folder."/".strtr($newname, " []{},/\!@#$%^&*", "____________________");
			if(file_exists($newname))
			{
				$rename = $newname;
				for ($i=1; file_exists($rename); $i++) { 
					$rename = $newname . " (" . $i . ")";
				}
				$newname = $rename;
			}
			mkdir ($newname, 0666);
		}
	}
	Header("Location: FileNavigator.php?fold=$folder");
?>