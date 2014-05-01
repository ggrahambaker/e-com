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
      <h1>Enroll</h1></br>
      <?php
	 //This is for connecting
    require_once("../html_data/pdoconnection.php");
	$db = connect();
	$username = getCurrentUserName();
	$class = $_GET['Class'];
	$queue = $db->query("SELECT 1 FROM cart WHERE username='$username' AND class='$class'");
	$existing = $queue->fetch(PDO::FETCH_ASSOC);
	if (!empty($_GET['enroll'])) 
	{
		if (empty($existing)) 
		{
			$db->query("INSERT INTO cart (username,class,number) VALUES ('$username','$class','1')");
			echo "<h2>Added to your shopping cart!</h2><br><br>";
			setFlash("classAdded", "$class was added to your cart");
			redirect("classes.php");
			$existing = 1;
		} 
		else 
		{
			echo "<h2>Already in your cart!</h2><br><br>";
		}
	}
	$result = $db->query("SELECT * FROM classes WHERE ClassName='$class'");
	while ($row = $result->fetch(PDO::FETCH_ASSOC))
	{
		$ImageLoc = $row['ImageLoc'];
		$Fee = $row['Fee'];
		$LongDesc = $row['LongDesc'];
	}
	?>
		<table class = "class_table">
			<tr>
				<th class = "table_header">Textbook</th>
				<th class = "table_header">Class</th>
				<th class = "table_header">Description</th>
				<th class = "table_header">Price</th>
			</tr>
			<tr>
				<td width='20%'>
					<?php
					echo "<img src='$ImageLoc' width='100' height='100'></td>";
					echo "<td width='25%'>$class</td>";
					echo "<td width='40%' align='left'>$LongDesc</td>";
					echo "<td width='15%'>$$Fee</td>";
					?>

	<?php
	// echo "<font color=black><table align='center'><tr><th>Textbook</th><th>Class</th><th>Description</th><th>Price</th><th>See More</th></tr><tr><td width='30%'><img src='$ImageLoc' width='100' height='100'></td><td width='20%'>$class</td><td width='20%'>$LongDesc</td><td width='15%'>$$Fee</td><td width='20%'>";
	// if (empty($existing)) 
	// {
	// 	echo "<form action='buy.php' method='get'><input id='button' name=enroll type='submit' value='Add to cart!'><input type='hidden' name='Class' value='$class'>";
	// } 
	// else 
	// {
	// 	echo "class already in cart";
	// }

	// echo "</form></td></tr></table></font><br><br><a href='classes.php'>Return</a>";
	//This is code trying to check for duplicates. Here's mine, below. I'll keep the other for posterity.
		
		
		
//		$check = $db->query("SELECT class FROM cart");
//		$duplicate = FALSE;
//		while ($row = $check->fetch(PDO::FETCH_ASSOC))
//		{
//			echo $row['class'];
//			if($class == $row['class'])
//			{
//
//				// echo "<h2> You've already enrolled in this class! </h2>";
//				// $duplicate = TRUE;
//			}
//		}
//		if(!$duplicate)
//		{
			//$db->query("INSERT INTO $username (username,class) VALUES ('$username','$class')");	
	
	?>		
	</table>
	<?php
	if(isset($_GET['return']))
	{
		header("location: classes.php");
		exit;
	}
	if (empty($existing)) 
	{
		echo "<form action='buy.php' method='get'><input id='button' name=enroll type='submit' value='Add to cart!'><input type='hidden' name='Class' value='$class'>";
	} 
	else 
	{
		echo "<p> Class already in cart </p>";
	}
	?>
	<form action = "">
		<input type="submit" method ="GET" name ="return" value = "Return to classes">
	</form>
    </div>
  </div>

</div>

<?php require_once("footer.php") ?>
</body>
</html>
<?php clearFlash(); ?>