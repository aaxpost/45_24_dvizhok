<?php
	
	include ('../elems/init.php');
	
	if (!empty($_SESSION['auth'])) {
	
		function getPage()
		{
			$title = 'admin add new page';
			
			if (isset($_POST['title']) and isset($_POST['url']) and isset($_POST['text'])) { 
				$title = $_POST['title'];
				$url = $_POST['url'];
				$text = $_POST['text'];
				
			} else {
				$title = '';
				$url = '';
				$text = '';
			}
			
			//Хитро инклудим данные в буфер.
			ob_start();
			include 'elems/form.php';
			$content = ob_get_clean();
				
			include 'elems/layout.php';
		}
		
		function addPage($link) 
		{
				if (isset($_POST['title']) and isset($_POST['url']) and isset($_POST['text'])) { 
					$title = mysqli_real_escape_string($link, $_POST['title']);
					$url = mysqli_real_escape_string($link, $_POST['url']);
					$text = mysqli_real_escape_string($link, $_POST['text']);
				
					$query = "SELECT COUNT(*) as count FROM pages WHERE url = '$url'";
					$result = mysqli_query($link, $query) or die(mysqli_error($link));
					$isPage = mysqli_fetch_assoc($result)['count'];
					//var_dump($isPage);
				
					if ($isPage) {
						$_SESSION['message'] = [
						'text' => 'Page whith this url exists!', 
						'status' => 'error'
						];
					} else { 
						$query = "INSERT INTO pages (title, url, text) VALUES ('$title', '$url', '$text')";
						mysqli_query($link, $query) or die(mysqli_error($link));
						
						$_SESSION['message'] = [
						'text' => 'Page added successfully', 
						'status' => 'success'
						];
						
						header('location: /admin/'); die();	
					}			
			} else {
				return '';
			}	
		}
		
		$info = addPage($link);	
		getPage();
		
	} else {
		header('location: /admin/login.php'); die();
		}
