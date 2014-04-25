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
	  //This is for connecting
	  require_once("../html_data/pdoconnection.php");
$db = connect();

//Checks if user's coming from a reorder; if so, order them.
if (empty($_GET['order'])) {
	$query="SELECT * FROM classes,dept WHERE Dept=DeptId";
	} else {
	$order = $_GET['order'];
	$query="SELECT * FROM classes,dept WHERE Dept=DeptId ORDER BY $order";
	}
//Grab the array, check how many rows there are	
$result = $db->query($query);

$res = $db->query('SELECT COUNT(*) FROM classes');
$num_rows = $res->fetchColumn();

//Grab individual rows, store them into incremented arrays
$i = 1;
while ($row = $result->fetch(PDO::FETCH_ASSOC))
{
		$ImageLoc[$i] = $row['ImageLoc'];
		$ClassName[$i] = $row['ClassName'];
		$Department[$i] = $row['Department'];
		$Fee[$i] = $row['Fee'];
		$i = $i+1;
}
//Echoes the table headings. Changes a heading's link to a reverse if you're on that order. Checks if there's any Order at all; if not, skips the whole thing to prevent PHP errors.
echo "<font color=black><table align='center'><tr><th>Click the textbook to enroll!</th><th>";

if (!empty($_GET['order'])) {
if ($_GET['order']!='ClassName') {
	echo "<a href='classes.php?order=ClassName'>";
} else {
	echo "<a href='classes.php?order=ClassName DESC'>";
}
echo "Class</a></th><th>";

if ($_GET['order']!='Dept') {
	echo "<a href='classes.php?order=Dept'>";
} else {
	echo "<a href='classes.php?order=Dept DESC'>";
}

echo "Department</a></th><th>";

if ($_GET['order']!='Fee') {
	echo "<a href='classes.php?order=Fee'>";
} else {
	echo "<a href='classes.php?order=Fee DESC'>";
}
} else {
	echo "<a href='classes.php?order=ClassName'>Class</a></th><th><a href='classes.php?order=Dept'>Department</a></th><th><a href='classes.php?order=Fee'>";
}

echo "Price</a></th></tr>";

//Echoes the individual rows.
for ($i=1; $i<=$num_rows; $i++) {
	echo "<tr><td width='30%'><a href='buy.php?enroll=Enroll%21&Class=$ClassName[$i]'><img src='$ImageLoc[$i]' width='100' height='100'></a></td><td width='20%'>$ClassName[$i]</td><td width='20%'>$Department[$i]</td><td width='15%'>$$Fee[$i]</td><td width='20%'><form action='buy.php' method='get'><input id='button' type='submit' value='See more!' name='name'><input type='hidden' name='Class' value='$ClassName[$i]'></form></td></tr>";
}
echo "</table></font>";
?>
    </div>
  </div>
</div>
<?php require_once("footer.php") ?>
</body>
</html>
<?php clearFlash(); ?>