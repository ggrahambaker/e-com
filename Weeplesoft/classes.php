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
      <h1>Classes</h1><br><font color=black>click on table headings to reorder the list!</font></br></br>
      <?php
	  // Create connection
		$con=mysqli_connect("localhost", "tail", "password",  "tail");

		// Check connection
		if (mysqli_connect_errno())
		{
  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		} else {
$result = mysqli_query($con, "SELECT MAX(ClassId) AS 'ClassId' FROM classes");
while ($row = mysqli_fetch_array($result))
{
$classnumber = $row['ClassId'];
}
for ($i=1; $i<=$classnumber; $i++) {
	$images = mysqli_query($con, "SELECT * FROM classes WHERE ClassId=$i");
	while($row = mysqli_fetch_array($images))
  	{
  		$ImageLoc[$i] = $row['ImageLoc'];
  	}
}
for ($j=1; $j<=$classnumber; $j++) {
	$titles = mysqli_query($con, "SELECT * FROM classes WHERE ClassId=$j");
	while($row = mysqli_fetch_array($titles))
  	{
  		$ClassName[$j] = $row['ClassName'];
  	}
}
for ($k=1; $k<=$classnumber; $k++) {
	$prices = mysqli_query($con, "SELECT * FROM classes WHERE ClassId=$k");
	while($row = mysqli_fetch_array($prices))
  	{
  		$Fee[$k] = $row['Fee'];
  	}
}
echo "<font color=black><table align='center'><tr><th><a href='javascript:;'>Textbook</a></th><th><a href='javascript:;'>Class</a></th><th><a href='javascript:;'>Price</a></th><th><a href='javascript:;'>See More</a></th></tr>";
for ($i=1; $i<=$classnumber; $i++) {
	echo "<tr><td width='30%'><img src='$ImageLoc[$i]' width='100' height='100'></td><td width='40%'>$ClassName[$i]</td><td width='15%'>$$Fee[$i]</td><td width='20%'><form action='buy.php' method='get'><input id='button' type='submit' value='See more!' name='name'><input type='hidden' name='Class' value='$ClassName[$i]'></form></td></tr>";
}
echo "</table></font>";
		}
?>
    </div>
  </div>
</div>
<?php require_once("footer.php") ?>
</body>
</html>
<?php clearFlash(); ?>