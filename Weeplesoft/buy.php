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
      <h1>Enroll</h1><br><font color=black>click on table headings to reorder the list!</font></br></br>
      <?php
	  // Create connection
		$con=mysqli_connect("localhost", "tail", "password",  "tail");

		// Check connection
		if (mysqli_connect_errno())
		{
  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		} else {
			$class = $_GET['Class'];
$result = mysqli_query($con, "SELECT * FROM classes WHERE ClassName='$class'");
while ($row = mysqli_fetch_array($result))
{
$ImageLoc = $row['ImageLoc'];
$ClassName = $row['ClassName'];
$Fee = $row['Fee'];
$LongDesc = $row['LongDesc'];
}
echo "<font color=black><table align='center'><tr><th><a href='javascript:;'>Textbook</a></th><th><a href='javascript:;'>Class</a></th><th><a href='javascript:;'>Description</a></th><th><a href='javascript:;'>Price</a></th><th><a href='javascript:;'>See More</a></th></tr><tr><td width='30%'><img src='$ImageLoc' width='100' height='100'></td><td width='20%'>$ClassName</td><td width='20%'>$LongDesc</td><td width='15%'>$$Fee</td><td width='20%'><form action='buy.php' method='post'><input id='button' type='submit' value='Enroll!' name='buy' disabled></form></td></tr></table></font><br><br><a href='classes.php'>Return</a>";
		}
?>
    </div>
  </div>
</div>
<?php require_once("footer.php") ?>
</body>
</html>
<?php clearFlash(); ?>