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
<style>
form, table {
	display: inline;
	margin: 0px;
	padding: 0px;
}
</style>
</head>
<body>
<?php require_once("header.php") ?>
<div id="container">
  <?php require_once("lib/flash.php"); ?>
  <div id="backround_img">
    <div id="form_body">
      <h1>Classes</h1>
      <?php
$classnumber = 1; // Change to actual number displayed
for ($i=0; $i<=$classnumber-1; $i++) {
	$images[$i] = "images/Math%20textbook.JPG";
	$images[$i+1] = "images/lit.jpg"; // Take out
	$images[$i+2] = "images/worldhistory2.jpg"; // Take out
}
for ($i=0; $i<=$classnumber-1; $i++) {
	$titles[$i] = "Mathematics 301";
	$titles[$i+1] = "English 216"; // Take out
	$titles[$i+2] = "History 412"; // Take out
}
for ($i=0; $i<=$classnumber-1; $i++) {
	$prices[$i] = "500";
	$prices[$i+1] = "750"; // Take out
	$prices[$i+2] = "600"; // Take out
}
for ($i=0; $i<=$classnumber-1; $i++) {
	$urls[$i] = "math301.php";
	$urls[$i+1] = "eng216.php"; // Take out
	$urls[$i+2] = "hist312.php"; // Take out
}
for ($i=0; $i<=$classnumber+1; $i++) { // take out the classnumber addition
	echo "<font color=black><img src=$images[$i] width='100' height='100'></br> <b>Description:</b> $titles[$i] <b>Course Price:</b> $$prices[$i] <a href=$urls[$i]>See more!</a> <form action='buy.php' method='post'><input id='button' type='submit' name='classname/$titles[$i]' value='Enroll!'></form></br></font>";
}
?>
    </div>
  </div>
</div>
<?php require_once("footer.php") ?>
</body>
</html>
<?php clearFlash(); ?>