<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'on');
	
	//Подключаемся к базе данных
	$host = 'localhost';
	$user = 'root';
	$password = '';
	$db_name = 'test';
	$link = mysqli_connect($host, $user, $password, $db_name)
		or die(mysqli_error($link));	
	mysqli_query($link, "SET NAMES 'utf8'");
	
	//Получаем название страницы из гет запроса и формируем путь
	if (isset($_GET['page'])) {
		$page = $_GET['page'];
	} else {
		$page = '/';	
	}
	
	$query = "SELECT*FROM pages WHERE url='$page'";
	$result = mysqli_query($link, $query) or die(mysqli_error($link));
	$page = mysqli_fetch_assoc($result);
			
	if (!$page) {	
		$query = "SELECT*FROM pages WHERE url='404'";
		$result = mysqli_query($link, $query) or die(mysqli_error($link));
		$page = mysqli_fetch_assoc($result);
		
		header("HTTP/1.0 404 Not Found");
	}
	
	$title = $page['title'];
	$content = $page['text'];
	
	include 'layout.php';


	


	
