function validate() {
	var form = document.querySelector('.formWithValidation');
	var validateBtn = document.getElementById('validateBtn');
	var fname = document.getElementById('fname');
	var sname = document.getElementById('sname');
	var patronymic = document.getElementById('patronymic');
	var fields = form.querySelectorAll('.fields');
	var inv = true;
	//Remove validation
	var errors = form.querySelectorAll('.error');
	for (var i = 0; i < errors.length; i++) {
		errors[i].remove();
  	}

  	for (var i = 0; i < fields.length; i++) {
  		//Check field presence
  		if (!fields[i].value) {
			inv = false;
			console.log('field is blank', fields[i]);
			form[i].parentElement.insertBefore(SetError(fields[i], 'Поле не заполнено'), fields[i]);
			continue;
    	}
    	//Check characters
		if(fields[i].value.match(/[^A-Za-z]+/)){
			inv = false;
			console.log('сontains invalid character', fields[i]);
			form[i].parentElement.insertBefore(SetError(fields[i], 'Недопустимый символ'), fields[i]);
			continue;
		}
	}
	return inv;
}

function SetError(field, str) {
	var error = document.createElement('div');
	error.className = 'error';
	error.style.color = 'red';
	error.innerHTML = str;
	return error;
}

window.onload = Animation;
function Animation() {
	var icons = document.querySelectorAll(".icons");
	var ic_style = [window.getComputedStyle(icons[0], null), window.getComputedStyle(icons[1])];
	var from = [180, 230]; // Начальная координата Y
	var to = [68, 117]; // Конечная координата Y
	var duration = 1000; // Длительность
	var start = new Date().getTime(); // Время старта
	var progress = [0, 0];
	var i = 0;

	setTimeout(function() {
		var now = (new Date().getTime()) - start; // Текущее время
		progress[i] = now / duration; // Прогресс анимации

		var result = (to[i] - from[i]) * delta(progress[i]) + from[i];

		icons[i].style.top = result + "px";

		if (progress[i] < 1) // Если анимация не закончилась, продолжаем
			setTimeout(arguments.callee, 10);
		else if (i < icons.length-1) { // Переход к следующему блоку иконок
			icons[i].style.top = to[i] + "px";
			i++;
			start = new Date().getTime(); // Время старта
			setTimeout(arguments.callee, 10);
		}
	}, 10);
}

function delta(progress) {
    return Math.pow(progress, 0.5);
}

function Redirect() {
	setTimeout(function () {window.location.href = "../lab/index.php";}, 3000); 
}

function ajaxRequest() {
	var file_name = "xml/auto_shop.xml";
	var xmlhttp = new XMLHttpRequest();
	var id = ajaxRequest.caller.arguments[0].target.id;
	var params = 'id=' + encodeURIComponent(id) +
		'&file_name=' + file_name;

	if(document.getElementById("open") != null)
	{
		var open = document.getElementById("open");
		var id_open = open.innerHTML.match(/<span class="car_id">(.*?)<\/span>/);
		open.id = id_open[1];
		var l = document.getElementById(open.id + 'l').children;
		document.getElementById(open.id + 'l').innerHTML = '<li>' + l[0].innerHTML + '</li>';
		open.innerHTML += '<p class="more" id="'+ open.id +'" onclick="ajaxRequest()">Подробнее</p>';
	}


	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == XMLHttpRequest.DONE) {   // XMLHttpRequest.DONE == 4
			if (xmlhttp.status == 200) {
				jsonFile = JSON.parse(xmlhttp.responseText);
				var html = '<p class="car_name"><span class="car_id">' + jsonFile.attr_id + "</span>. " + jsonFile.name + '</p>' +
				'<img src="xml/auto/' + jsonFile.file_name + '" alt="' + jsonFile.name + '">' +
				'<ul id="'+ jsonFile.attr_id +'l">' +
				'<li>Цена: $' + jsonFile.price + '</li>' +
				'<li>Серийный номер: ' + jsonFile.serial_num + '</li>' +
				'<li>Год:' + jsonFile.year + '</li>' +
				'<li>Тип автомобиля: ' + jsonFile.car_type + '</li>' +
				'<li>Коробка передач: ' + jsonFile.gear_box + '</li>' +
				'<li>Мощность: ' + jsonFile.power + ' л.с.</li>' +
				'</ul>';
				document.getElementById(id).innerHTML = html;
				document.getElementById(id).id = "open";
			}
			else if (xmlhttp.status == 400) {
				alert('There was an error 400');
			}
			else {
				alert('something else other than 200 was returned');
			}
		}
	};

	xmlhttp.open("GET", "/lab/ajaxServer.php?" + params, true);
	xmlhttp.send(); 
}

$('.mr').live('click', function(){
	var file_name = "xml/auto_shop.xml";
	var id = $(this).attr('id');

	if($('div').is('#open'))
	{
		var open = $('#open');
		var id_open = open.html().match(/<span class="car_id">(.*?)<\/span>/);
		open.attr('id', id_open[1]);
		var l = $('#' + open.attr('id') + 'l').children();
		$('#' + open.attr('id') + 'l').html('<li>' + l[0].innerHTML + '</li>');
		open.html(open.html() + '<p class="mr" id="'+ open.attr('id') +'">Подробнее</p>');
	}

	$.ajax({
		url: "ajaxServerJQ.php",
		type: "get",
		dataType: "json",
		data: {
			"id": id,
			"file_name": file_name
		},
		success: function(data){
			if(data.result == 'success'){
				var html = '<p class="car_name"><span class="car_id">' + data.attr_id + "</span>. " + data.name + '</p>' +
				'<img src="xml/auto/' + data.file_name + '" alt="' + data.name + '">' +
				'<ul id="'+ data.attr_id +'l">' +
				'<li>Цена: $' + data.price + '</li>' +
				'<li>Серийный номер: ' + data.serial_num + '</li>' +
				'<li>Год:' + data.year + '</li>' +
				'<li>Тип автомобиля: ' + data.car_type + '</li>' +
				'<li>Коробка передач: ' + data.gear_box + '</li>' +
				'<li>Мощность: ' + data.power + ' л.с.</li>' +
				'</ul>';
				$('#' + id).html(html);
				$('#' + id).attr('id', 'open');
			}
			else
			{
				alert('Error');
			}
		}
	});
});

$(document).ready(function() {
	$("a[rel=example_group]").fancybox({
		'transitionIn'		: 'none',
		'transitionOut'		: 'none',
		'titlePosition' 	: 'over',
		'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
			return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
		}
	});
});

$('input[name=all]').live('click', function(){
	$('input[name=cb[]]').each(function(){
		var $t = $(this);
		$t.attr('checked', 'true');
	});
});

$('input[name=off]').live('click', function(){
	$('input[name=cb[]]').each(function(){
		var $t = $(this);
		$t.removeAttr('checked');
	});
});

$('input[name=not]').live('click', function(){
	$('input[name=cb[]]').each(function(){
		var $attr = $(this).attr('checked');
		var $t = $(this);
		if(typeof $attr == typeof undefined || $attr == false)
		{
			$t.attr('checked', 'true');
		}
		else 
		{
			$t.removeAttr('checked');
		}

	});
});

$(document).ready(function(){
	// Устанавливаем обработчик потери фокуса для всех полей ввода текста
	$('input#fname, input#sname, input#patronymic, select#age').unbind().blur(function(){
		// Для удобства записываем обращения к атрибуту и значению каждого поля в переменные
		var id = $(this).attr('id');
		var val = $(this).val();
		switch(id)
		{
			case 'age':
				if($('option').attr('selected') == true){
					setFieldError(id, 'поле обязательно для заполнения');
				}
				else 
				{
					setNotError(id);
				}
			break;

			default: 
				var res = checkField(val);
				if(res == 1)
				{
					var str = 'поле обязательно для заполнения,<br> длина строки должна составлять не менее 2 символов';
					setFieldError(id, str);
				}
				else if(res == 2)
				{
					var str = 'поле должно содержать только латинские буквы';
					setFieldError(id, str);
				}
				else
				{
					setNotError(id);
				}
			break;
		}
	});

	$('form.formWithValidation').submit(function(e){
		// Запрещаем стандартное поведение для кнопки submit
		e.preventDefault();
		// После того, как мы нажали кнопку "Отправить", делаем проверку,
		// если кол-во полей с классом .not_error равно 4 (так как у нас всего 4 поля), то есть все поля заполнены верно,
		// выполняем наш Ajax сценарий и отправляем письмо адресату
		if($('.not_error').length == 4)
		{
			$('form.formWithValidation :input').removeAttr('disabled');
			$('form.formWithValidation :input').css('border-color', 'black');
            $('form.formWithValidation :text, select').val('').removeClass().next('.error-box').text('');
			return true;
		}
		else
		{
			alert('Заполните поля!');
			$('form.formWithValidation :text, select').css('border-color', 'red');
			return false;
		}
	});
});

function checkField(val) {
	var rv = /[^A-Za-z]+/;
	if(val.length < 2) { 
		return 1; 
	}
	else if(val.match(rv)) { 
		return 2; 
	}
	else { 
		return 0; 
	}
}

function setFieldError(id, str) {
	$('#'+id).css('border-color', 'red');
	$('#'+id).removeClass('not_error').addClass('errorf');
		$('#'+id).next('.error-box').html(str)
			.css('color','red')
			.animate({'paddingLeft':'10px'},400)
			.animate({'paddingLeft':'5px'},400);
}

function setNotError(id) {
	$('#'+id).css('border-color', 'green');
	$('#'+id).addClass('not_error');
		$('#'+id).next('.error-box').text('Принято')
			.css('color','green')
			.animate({'paddingLeft':'10px'},400)
			.animate({'paddingLeft':'5px'},400);
}

function simple_tooltip(target_items, name){
	$(target_items).each(function(i){
		$("body").append("<div class='"+name+"' id='"+name+i+"'><p>"+$(this).attr('data-description')+"</p></div>");
		var my_tooltip = $("#"+name+i);

		$(this).mouseover(function(){
			my_tooltip.css({opacity:0.8, display:"none"}).fadeIn(400);
		}).mousemove(function(kmouse){
			my_tooltip.css({left:kmouse.pageX+15, top:kmouse.pageY+15});
		}).mouseout(function(){
			my_tooltip.fadeOut(400);
		});
	});
}

$(document).ready(function(){
	simple_tooltip("input[class=field]","tooltip");
});
