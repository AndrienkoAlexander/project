<?php
	require 'functions.php';
	$title = "Файловый навигатор";
	$content_title = "Файловый навигатор"; 
	include "php/header.php";
	$begin="files";
	$fold = GetValue("fold", "");
	
	if ((strpos($fold,$begin) != 0) || (strpos($fold,"..") != False) ||($fold == ""))
	{
		$dirct = $begin;
	}
	else
	{
		$dirct = $fold;
		$d = str_replace(" ", "+", $dirct);
	}

?>

	<form action="request.php?folder=<?=$d;?>" method="POST" id="FileNav">
		<input type="hidden" name="formFN" value="formFileNav">
<?php
    echo '';
    echo '<div id="files">';
	if ($dirct != $begin)
	{
		$back = substr ($dirct, 0, strrpos($dirct, "/"));
		$back = str_replace(" ", "+", $back);
		echo '<div class="back"><a href="FileNavigator.php?fold='.$back.'">Назад</a></div>';
	}
	$hdl = opendir($dirct);
	while (false != ($file = readdir($hdl)))
	{
		if (($file != "..")&&($file != "."))
		{
	    	$a[]=$file;
		}
	}
	closedir($hdl);

	function show_size($f,$format=true) 
	{ 
		if($format)
		{
			$size=show_size($f,false); 
			if($size<=1024) return $size.' bytes'; 
			else if($size<=1024*1024) return round($size/(1024),2).' Kb'; 
			else if($size<=1024*1024*1024) return round($size/(1024*1024),2).' Mb'; 
			else if($size<=1024*1024*1024*1024) return round($size/(1024*1024*1024),2).' Gb'; 
			else if($size<=1024*1024*1024*1024*1024) return round($size/(1024*1024*1024*1024),2).' Tb';
			else return round($size/(1024*1024*1024*1024*1024),2).' Pb'; 
		}
		else
		{
			if(is_file($f)) return filesize($f); 
			$size=0; 
			$dh=opendir($f); 
			while(($file=readdir($dh))!==false) 
			{ 
				if($file=='.' || $file=='..') continue; 
				if(is_file($f.'/'.$file)) $size+=filesize($f.'/'.$file); 
				else $size+=show_size($f.'/'.$file,false); 
			} 
			closedir($dh); 
			return $size+filesize($f); // +filesize($f) for *nix directories 
		} 
	}

	if(isset($a)) 
	{
		if (sizeof($a)>0)
		{
?>

<table>		
	<tr>
		<td></td>
		<td></td>
		<td>Имя</td>
		<td>Размер</td>
		<td>Дата создания</td>
	</tr>

<?php
			natcasesort($a);
			foreach ($a as $k)
			{
				$full = $f = $dirct . "/" . $k;
				$size = show_size($full);
				$dt = date ("d.m.Y H:i",filectime($full));
				$tmp = str_replace(" ", "+", $k);
				if (is_dir($full) == true)
				{
                    echo '<tr><td class="c1"><div><input name=fl[] value='.$tmp.' type="checkbox"></td>';
					$full = str_replace(" ", "+", $full);
					echo '<td class="c2"><a href=FileNavigator.php?fold='.$full.'><div class="dir"></div></a></td><td class="c3"><a href=FileNavigator.php?fold='.$full.'>'.$k.'</a></td><td class="c4">'.$size.'</td><td class="c5">'.$dt.'</td></tr>';
				}
			}

            foreach ($a as $k)
            {
                $full = $f = $dirct . "/" . $k;
                $size = show_size($full);
                $dt = date ("d.m.Y H:i",filectime($full));
                $tmp = str_replace(" ", "+", $k);
                if (!is_dir($full) == true)
                {
                    echo '<tr><td class="c1"><div><input name=fl[] value='.$tmp.' type="checkbox"></td>';
                    echo '<td class="c2"><div class="file"></div></td><td class="c3">'.$k.'</td><td class="c4">'.$size.'</td><td class="c5">'.$dt.'</td></tr>';
                }
            }
			echo '</table> </div>';
		}
?>

		<input type="submit" value="Удалить" name="submit"></input>
		<input type="submit" value="Создать папку" name="submit"></input>
	</form>

<?php
	}
	else {
		echo '<b>Папка пуста!</b>';
		echo '<br><input type="submit" value="Создать папку" name="submit"></input></br>';
	}
	include "php/footer.php";
?>