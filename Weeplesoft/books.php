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
	            <h1>Books</h1>
				<br>
				<p class="body_text">Ender's Game <br>
				Every Harry Potter <br>
				LOTR <br>
				How to Build an Old Wooden Ship: a beginner's guide</p> 
			</div>
			
		</div>
	</div>
	<?php require_once("footer.php") ?>
</body>	
</html>

<?php clearFlash(); ?>