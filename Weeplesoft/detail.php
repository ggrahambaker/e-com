<?php require_once("lib/sessions.php") ?>
<?php requireUser(); ?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>form.form.form</title>


<link rel="stylesheet" type="text/css" href="splash.css">
<link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Galdeano' rel='stylesheet' type='text/css'>
</head>
<body>
	<div id="header_container">
		<div id="header">
		<h1> WEEPLESOFT </h1>
		</div>
	</div>


<div id="container">
	<div class="detail">
		<img src="images/desc_book.jpg"  height="42" width="42" alt="woooah">
		<p class="form_font">Math 301</p>
		<p class="form_font">You are gonna learn a bunch in this class!</p> 

		                <form action="checkout.php" method="post">
		                <p> Select Section: </p> 

							<select>
								<option value="null"></option>
								<option value="section_a">Section A</option>
								<option value="section_b">Section B</option>
							</select>
						
		                    <input id="button" type="submit" name="submit" value="Submit">
                		</form>

                		<a href="classes.php">Return to Course Offerings</a>
	</div>
</div>


	<div id="footer_container">
		<div id="footer">


		</div>
	</div>

</body>
</html>
<?php clearFlash(); ?>