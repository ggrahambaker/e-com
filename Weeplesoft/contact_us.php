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
	            <h1>Contact us</h1>
	            <h2> Main developers </h2>
	            <p> Graham Baker - gbaker@pugetsound.edu </p>
	            <p> Jasper Reynolds - jreynolds@pugetsound.edu </p>
	            <p> Zach Eddy - zeddy@pugetsound.edu </p>
			</div>
			
		</div>
	</div>
	<?php require_once("footer.php") ?>
</body>	
</html>

<?php clearFlash(); ?>