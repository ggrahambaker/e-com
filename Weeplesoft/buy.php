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
      <h1>Enroll</h1></br>
      <?php
	 //This is for connecting
	  require_once("../html_data/pdoconnection.php");
$db = connect();

//Grab username and GET params
$username = getCurrentUserName();

$class = $_GET['Class'];

//Checks if the user is enrolling. If so, checks if the entry already exists. If so, lets you know and stops the process. If not, lets you know and inserts it into the cart table. Stores empty, 1 or Array into $existing.
		$queue = $db->query("SELECT 1 FROM cart WHERE username='$username' AND class='$class'");
		$existing = $queue->fetch(PDO::FETCH_ASSOC);
		if (!empty($_GET['enroll'])) 
	{
		if (empty($existing)) {
			$db->query("INSERT INTO cart (username,class,number) VALUES ('$username','$class','1')");
			echo "<h2>Added to your shopping cart!</h2><br><br>";
			$existing = 1;
		} else {
			echo "<h2>Already in your cart!</h2><br><br>";
		}
	}
//Grabs the rows of table classes			
$result = $db->query("SELECT * FROM classes WHERE ClassName='$class'");
while ($row = $result->fetch(PDO::FETCH_ASSOC))
{
$ImageLoc = $row['ImageLoc'];
$Fee = $row['Fee'];
$LongDesc = $row['LongDesc'];
}
//Prints out the table
echo "<font color=black><table align='center'><tr>";
echo "<th>Textbook</th>";
echo "<th>Class</th>";
echo "<th>Description</th>";
echo "<th>Price</th>";
echo "<th>See More</th></tr>";
echo "<tr><td width='30%'><img src='$ImageLoc' width='100' height='100'></td>";
echo "<td width='20%'>$class</td>";
echo "<td width='20%'>$LongDesc</td>";
echo "<td width='15%'>$$Fee</td>";
echo "<td width='20%'>";
//Puts down the "enroll" button, but disables it if that class is already in the cart table.
if (empty($existing)) {
	echo "<form action='buy.php' method='get'><input id='button' name=enroll type='submit' value='Enroll!'><input type='hidden' name='Class' value='$class'>";
} else {
	echo "<form action='buy.php?Class=Mathematics+301' method='get'><input id='disabled' type='submit' name=enroll value='Enroll!' disabled>";
}
echo "</form></td></tr></table></font><br><br><a href='classes.php'>Return</a>";					
?>
    </div>
  </div>
</div>
<?php require_once("footer.php") ?>
</body>
</html>
<?php clearFlash(); ?>