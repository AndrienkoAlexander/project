<html lang="ru">
<head>
	<meta http-equiv="Content-Type" content="text/html">
	<meta charset="utf-8">
	<title><?=$title;?></title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<link rel="stylesheet" type="text/css" href="css/form.css">
	<link rel="stylesheet" type="text/css" href="css/jquery.fancybox-1.3.4.css" media="screen"/>	
	<script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>
	<script type="text/javascript" src="js/jquery.mousewheel-3.0.4.pack.js"></script>
	<script type="text/javascript" src="js/jquery.fancybox-1.3.4.pack.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
</head>
<body>
	<div id="wrapper">
		<header>
			<div id="hdr_img">
				<div id="logo"><a class="logoref" href="/"><img id="logoimg" src="images/logo.jpg" alt="СБС Фармация"></a></div>
			</div>
		</header>

		<div class="upp_block">
			<div id ="p_area">
				<div id="pa_img">
					<ul id="nav_itms">
						<li><a href="../lab/imageGallery.php">галерея</a></li>
						<li><a href="../lab/eventHandlerJQ.php">события jq</a></li>
						<li><a href="../lab/formJQ.php">валидация JQ</a></li>
						<li><a href="/">подписка</a></li>
						<li><a href="/">регистрация</a></li>
					</ul>
					<form>
						<div id="button"><input id="in" type="button" name="in" value="ВОЙТИ"/></div>
						<div class="field">
							<label for="n">логин</label>
							<input type="text"/>
						</div>
						<div class="field">
							<label for="ln">пароль</label>
							<input type="text"/>
						</div>
					</form>
				</div>
			</div>

			<div id="menu">
				<div class="icons">
						<div class="icon">
							<a href="/">
								<img id="sub" src="images/sub.png">
								<p>подписка</p>
							</a>
						</div>
						<div class="icon">
							<a href="/">
								<img id="price" src="images/price.png">
								<p>прайс</p>
							</a>
						</div>
						<div class="icon">
							<a href="/">
								<img id="offers" src="images/offers.png">
								<p>заказы</p>
							</a>
						</div>
				</div>
				<div class="icons">
						<div class="icon">
							<a id="int" href="/">
								<img id="int_img" src="images/int.png">
								<p>интернет-магазин</p>
							</a>
						</div>
						<div class="icon">
							<a href="/">
								<img id="reports" src="images/reports.png">
								<p>отчеты</p>
							</a>
						</div>
				</div>
			</div>
		</div>
		
		<nav>
			<div id="nav_head"></div>
			<ul class="menu_items">
				<li><a href="../lab/index.php">главная страница</a></li>
				<li><a href="../lab/formJS.php">валидация js</a></li>
				<li><a href="../lab/formPHP.php">валидация php</a></li>
				<li><a href="../lab/redirect.php">redirect</a></li>
				<li><a href="../lab/ServerVariables.php">Серверные перем.</a></li>
				<li><a href="../lab/post.php">Проверка post</a></li>
				<li><a href="../lab/FileNavigator.php?fold=files">файловый нав.</a></li>
				<li><a href="../lab/XmlParser.php">xml</a></li>
				<li><a href="../lab/ajax.php">ajax js</a></li>
				<li><a href="../lab/ajaxJQ.php">ajax jq</a></li>
			</ul>
			<div id="nav_end"></div>
		</nav>
		
		<main>
			<div id="main_head">
				<div class="main_open"></div>
				<div><h1><?=$content_title;?></h1></div>
				<div class="main_close"></div>
			</div>