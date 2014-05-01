<?php require_once("lib/sessions.php") ?>
<?php requireUser(); ?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Welcome to Weeplesoft</title>


<link rel="stylesheet" type="text/css" href="splash.css">
<link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Galdeano' rel='stylesheet' type='text/css'>

</head>
<body>
	<?php require_once("header.php") ?>
	
	<div id="container">
		<?php require_once("lib/flash.php"); ?>

		

		<div id="backround_img">
			<div id="form_body">
	            <h1>Debugging page</h1>
				<br>
				<a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class = "table_link">passwords.txt<a>

				

					<p class="body_text"> Note: we know this page serves no purpose, so don't file it as a bug. We created it during the early stages of Weeplesoft</p>

			</div>
			
		</div>
	</div>
	<?php require_once("footer.php") ?>
</body>	
</html>
<?php clearFlash(); ?>