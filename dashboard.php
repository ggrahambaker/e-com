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
				<h1>Welcome to your dashboard, <?php echo getCurrentUserName(); ?></h1>
				<?php require_once("lib/flash.php"); ?>

			</div>
		</div>
	</div>
	<?php require_once("footer.php") ?>
</body>	
</html>

<?php clearFlash(); ?>