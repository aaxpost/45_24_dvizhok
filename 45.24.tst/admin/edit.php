<?php
	
	include ('../elems/init.php');
	
	if (!empty($_SESSION['auth'])) {
	
		function getPage($link)
		{
			$title = 'admin add new page';
			
			if (isset($_GET['id'])) {
				$id = $_GET['id'];
				$query = "SELECT * FROM pages WHERE id = '$id'";
				$result = mysqli_query($link, $query) or die(mysqli_error($link));
				$page = mysqli_fetch_assoc($result);
				
				if ($page) {
					
					if (isset($_POST['title']) and isset($_POST['url']) and isset($_POST['text'])) { 
						$title = $_POST['title'];
						$url = $_POST['url'];
						$text = $_POST['text'];
					} else {
						$title = $page['title'];
						$url = $page['url'];
						$text = $page['text'];
					}
						
					//Хитро инклудим данные в буфер.
					ob_start();
					include 'elems/form.php';
					$content = ob_get_clean();	
					
				} else {
					$content = 'Page not found';
				}	
					
					
				} else {
					$content = 'Content not found';
					}
					
			include 'elems/layout.php';
		}
		
		function addPage($link) 
		{
				//Записываем в переменные данные из формы
				if (isset($_POST['title']) and isset($_POST['url']) and isset($_POST['text'])) { 
					$title = mysqli_real_escape_string($link, $_POST['title']);
					$url = mysqli_real_escape_string($link, $_POST['url']);
					$text = mysqli_real_escape_string($link, $_POST['text']);
					
					//Присваеваем переменной значение из гет звпроса.
					if (isset($_GET['id'])) {
						$id = $_GET['id'];
						
							//Получаем страницу с заданным запросом.
							$query = "SELECT * FROM pages WHERE id = $id";
							$result = mysqli_query($link, $query) or die(mysqli_error($link));
							$page = mysqli_fetch_assoc($result);
						
							//Если урл изменился посылаем запрос и проверяем нет ли уже такого.
							if ($page['url'] !== $url) {
								$query = "SELECT COUNT(*) as count FROM pages WHERE url = '$url'";
								$result = mysqli_query($link, $query) or die(mysqli_error($link));
								$isPage = mysqli_fetch_assoc($result)['count'];
								//var_dump($isPage);
								
									if ($isPage == 1) {
										$_SESSION['message'] = [
											'text' => 'Page whith this url exists!', 
											'status' => 'error'
											];
										}
										
								
							}
					
						$query = "UPDATE pages SET title='$title', url='$url', text='$text' WHERE id=$id";
						mysqli_query($link, $query) or die(mysqli_error($link));
						
						$_SESSION['message'] = [
											'text' => "Page '{$page['title']}' edit successfully", 
											'status' => 'success'
											];
											
						header('location: /admin/'); die();
					
					}
				
					/*
					if ($isPage) {
						
					} else { 
						
						
						//header('location: /admin/?added=true');	
					}
					*/
								
			} else {
				return '';
			}	
		}
		
		addPage($link);	
		getPage($link);
		
	} else {
		header('location: /admin/login.php'); die();	
	}







	


	
