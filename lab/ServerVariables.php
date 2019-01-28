<?php  
	$title = "Серверные переменные"; 
	$content_title = "Серверные переменные";
	include 'php/header.php';
?>

<div id="server_var">
	<table>		
		<tr>
			<td>Переменная:</td>
			<td>Содержимое:</td>
		</tr>
		<?php 
		foreach ($_SERVER as $key => $value){
			echo '<tr><td><div class="fc">$_SERVER['.$key.']</div></td><td><div class="sc">'.$value.'</div></td></tr>';
		} 
		foreach ($_POST as $key => $value){
			echo '<tr><td><div class="fc">$_POST['.$key.']</div></td><td><div class="sc">'.$value.'</div></td></tr>';
		} 
		foreach ($_GET as $key => $value){
			echo '<tr><td><div class="fc">$_GET['.$key.']</div></td><td><div class="sc">'.$value.'</div></td></tr>';
		} 
		?>
	</table>
</div>

<?php include 'php/footer.php';?>