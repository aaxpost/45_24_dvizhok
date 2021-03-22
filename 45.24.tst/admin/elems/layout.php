<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="style.css" type="text/css">
		<meta content="text/html; charset=utf-8">
		<title><?= $title ?></title>
	</head>
	<body>
		<div id="wraper">
			<header>
				<a href="/admin/add.php">add new page</a>
				<a href="/admin/logout.php">logout</a>
			</header>
			<main>
				<?php include 'elems/info.php'; ?>
				<?php echo $content; ?>
			</main>
			<footer>
				footer
			</footer>
		</div>
	</body>
</html>
