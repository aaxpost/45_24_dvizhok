<?php
	//45.24
	include ('../elems/init.php');
	//include ('elems/password.php');
	
	if (isset($_POST['password']) and md5($_POST['password']) == '202cb962ac59075b964b07152d234b70') {
		$_SESSION['auth'] = true;
		
		$_SESSION['message'] = [
			'text' => 'You login successfully', 
			'status' => 'success'
			];
		
		header('location: /admin/index.php'); die();
		
	} else {
		
	$password = "";
	if (isset($_POST['password'])) {
		echo "<p class=\"error\">Password is incorrect</p>";
		$password = $_POST['password'];
		}
?>
<link rel="stylesheet" href="style.css" type="text/css">
<form action="" method="POST">
	<input type="password" name="password" value ="<?= $password ?>">
	<input type="submit" name="submit">
</form>
<?php } 






	


	
