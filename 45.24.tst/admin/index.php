<?php
	
	include ('../elems/init.php');
	
	if (!empty($_SESSION['auth'])) {
	
	function showPageTable($link)
	{
		$query = "SELECT id, title, url FROM pages WHERE url != '404'";
		$result = mysqli_query($link, $query) or die(mysqli_error($link));
		for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
	
	
		$content = '<table>
			<tr>
				<th>title</th>
				<th>url</th>
				<th>edit</th>
				<th>delete</th>
			</tr>';
		foreach ($data as $page) {
			$content .= "<tr>
				<td>{$page['title']}</td>
				<td>{$page['url']}</td>
				<td><a href=\"/admin/edit.php?id={$page['id']}\">edit</a></td>
				<td><a href=\"?delete={$page['id']}\">delete</a></td>
			</tr>";	
			}
		$content .= '</table>';	
		$title = 'admin main page';
		
		
		include 'elems/layout.php';
		
		}
		
	function deletePage($link)
	{
		if (isset($_GET['delete'])) {
			$id = $_GET['delete'];
			$query = "DELETE FROM pages WHERE id=$id";
			mysqli_query($link, $query) or die(mysqli_error($link));
			
			$_SESSION['message'] = [
				'text' => 'Page deleted successfully', 
				'status' => 'success'
				];
				
			header('location: /admin/'); die();
			
		} 
	}
		
	
	
	deletePage($link);
	
	showPageTable($link);
	
	} else {
		header('location: /admin/login.php'); die();
	}
	

	





	


	
