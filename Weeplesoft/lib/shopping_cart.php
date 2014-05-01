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
    	 <h1>Shopping Cart</h1>
    	 <?php
    	 //This is for connecting
	  	require_once("../html_data/pdoconnection.php");
		$db = connect();
		//Grab the current username
		$username = getCurrentUserName();
		//Checks if user's coming from a reorder; if so, order them.
		if (empty($_GET['order'])) 
		{
			$query="SELECT * FROM cart,classes,dept WHERE username='$username' AND Dept=DeptId AND ClassName=class";
		} 
		else
		{
			$order = $_GET['order'];
			$query="SELECT * FROM cart,classes,dept WHERE username='$username' AND Dept=DeptId AND ClassName=class ORDER BY $order";
		}
		//Grab the array, check how many rows there are	
		$result = $db->query($query);

		$res = $db->query("SELECT COUNT(*) FROM cart WHERE username='$username'");
		$num_rows = $res->fetchColumn();

		//Spit something out if they have no items
		if ($num_rows == 0) 
		{	
		echo "<h2>Cart is currently empty. Click <a href=classes.php>here</a> to add items</h2>";
		}
		else
		{
		//Grab individual rows, store them into incremented arrays
		$i = 1;
		while ($row = $result->fetch(PDO::FETCH_ASSOC))
		{
			$ImageLoc[$i] = $row['ImageLoc'];
			$ClassName[$i] = $row['ClassName'];
			$Department[$i] = $row['Department'];
			$Fee[$i] = $row['Fee'];
			$Entry[$i] = $row['EntryId'];
			$i = $i+1;
		}
		//Echoes the table headings. Changes a heading's link to a reverse if you're on that order. Checks if there's any Order at all; if not, skips the whole thing to prevent PHP errors.
		echo "<font color=black><table align='center'><tr><th>Textbook</th><th>";
		if (!empty($_GET['order'])) 
		{
			if ($_GET['order']!='ClassName') 
			{
				echo "<a href='shopping_cart.php?order=ClassName'>";
			} 
			else 
			{
				echo "<a href='shopping_cart.php?order=ClassName DESC'>";
			}
			echo "Class</a></th><th>";
			if ($_GET['order']!='Dept') 
			{
				echo "<a href='shopping_cart.php?order=Dept'>";
			} 
			else 
			{
				echo "<a href='shopping_cart.php?order=Dept DESC'>";
			}
			echo "Department</a></th><th>";
			if ($_GET['order']!='Fee') 
			{
				echo "<a href='shopping_cart.php?order=Fee'>";
			} 
			else 
			{
				echo "<a href='shopping_cart.php?order=Fee DESC'>";
			}
		} 
		else 
		{
			echo "<a href='shopping_cart.php?order=ClassName'>Class</a></th><th><a href='shopping_cart.php?order=Dept'>Department</a></th><th><a href='shopping_cart.php?order=Fee'>";
		}
		echo "Price</a></th></tr>";
		//Echoes the individual rows.
		for ($i=1; $i<=$num_rows; $i++) 
		{
			
			echo "<tr>";
				echo "<td width='30%'>";
					echo "<img src='$ImageLoc[$i]' width='100' height='100'></td>";
					echo "<td width='25%'>$ClassName[$i]</td>";
					echo "<td width='20%'>$Department[$i]</td>";
					echo "<td width='15%'>$$Fee[$i]</td>";
					echo "<td>";
					echo "<input id='$ClassName[$i]' type='submit' action = \"\" method = \"GET\" name='$ClassName[$i]' value='Remove'>";
					echo "</td>";
			echo "</tr>";
			
		}
		$result = $db->query("SELECT * FROM cart");
		while ($row = $result->fetch(PDO::FETCH_ASSOC))
		{
			for ($i=1; $i<=$num_rows; $i++) 
		{
			// echo "<h2>we dasdasfdasfd</h2>";
			echo "<h2>'$ClassName[$i]'</h2>";
			echo "<h2>'$_GET['$ClassName[$i]']'</h2>";
			if(!empty($_GET['$ClassName[$i]']))
			{
				$db->query("DELETE FROM cart WHERE class = '$ClassName[$i]'");	
				echo "<h2>we tried to delete( something)</h2>";
				echo "$ClassName[$i]";
			}
		}				
		}

		// for ($i=1; $i<=$num_rows; $i++) 
		// {
		// 	echo "<h2>we dasdasfdasfd</h2>";
		// 	echo "<h2>'$ClassName[$i]'</h2>";
		// 	if(!empty($_GET['$ClassName[$i]']))
		// 	{
		// 		$db->query("DELETE FROM cart WHERE class = '$ClassName[$i]'");	
		// 		echo "<h2>we tried to delete( something)</h2>";
		// 		echo "$ClassName[$i]";
		// 	}
		// }



		echo "</table></font><br><br><input id='disabled' type='submit' name=enroll value='CheckOut' disabled>";
	}




		?>
    </div>
   </div>
  </div>

<?php require_once("footer.php") ?>
</body>
</html>
<?php clearFlash(); ?>