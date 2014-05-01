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
  <div id="backround_img">
    <div id="form_body">
      <h1>Classes</h1><p class = "body_text">
       Click on table headings to reorder the list 
       <br> Click on textbook to enroll in class </p>
      <?php require_once("lib/flash.php"); ?>
      <?php 
      function layout_rows($class_name, $dept, $price, $image_location)
      {
      	?>
      	<tr class = "body_text">
      		<td width='30%'>
      			
      			<?php echo "<a href='buy.php?enroll=Enroll%21&Class=$class_name'> <img src='$image_location' width='100' height='100'> </a>"; ?>
      		</td>
      			<?php echo "<td width='20%'>$class_name</td> <td width='20%'>$dept</td><td width='15%'>$$price</td>"; ?>

      		<td width='20%'>
      			<form action='buy.php' method='get'>
      				<input id='button' type='submit' value='Details' name='name'>
      				<?php echo "<input type='hidden' name='Class' value='$class_name'>"; ?>
      			</form>
      		</td>
      	</tr>
      	<?php
      }

	  //This is for connecting
	  require_once("../html_data/pdoconnection.php");
	  $db = connect();
//Checks to see if we're only looking at one dept
if (isset($_GET['deptView']))
{
	$deptview = $_GET['deptView'];
}


//Checks if user's coming from a reorder; if so, order them.

	if (empty($_GET['order'])) 
	{
		$query="SELECT * FROM classes,dept WHERE Dept=DeptId";
		if (isset($_GET['deptView']) && $deptview!='All')
		{
			$query="SELECT * FROM classes,dept WHERE Dept=DeptId AND Department='$deptview'";
		}
	} 
	else
	{
		$order = $_GET['order'];
		$query="SELECT * FROM classes,dept WHERE Dept=DeptId ORDER BY $order";
		if (isset($_GET['deptView']) && $deptview!='All')
		{
			$query="SELECT * FROM classes,dept WHERE Dept=DeptId AND Department='$deptview' ORDER BY $order";
		}
	}
	//Grab the array, check how many rows there are. If viewing by department, act accordingly.
	$result = $db->query($query);
	
	if (!isset($_GET['deptView']) || $deptview == 'All') {
		$res = $db->query('SELECT COUNT(*) FROM classes');
	} else {
		$res = $db->query("SELECT COUNT(*) FROM classes,dept WHERE Dept=DeptId AND Department='$deptview'");
	}
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
	
//Checks whether the dropdown menu is somewhere interesting. If so adds a new hidden button to all buttons. If not empties the name of that button. Does the same for ordering and the dropdown.
$dropdownName = '';
$orderName = '';

if (isset($_GET['deptView']))
{
	if ($deptview == "English" || $deptview == "History" || $deptview == "Mathematics")
	{
		$dropdownName = 'deptView';
	}
}
if (isset($_GET['order']))
{
		$orderName = 'order';
}


	//Echoes the table headings. Changes a heading's link to a reverse if you're on that order. Checks if there's any Order at all; if not, skips the whole thing to prevent PHP errors.
	$buttonStyle = "background:none;border:none;width:50px;font-family:'Galdeano',sans-serif;font-weight:bold;font-weight:bolder;font-size: 23px;text-decoration:none;";
	$buttonStyleBig = "background:none;border:none;width:100px;font-family:'Galdeano',sans-serif;font-weight:bold;font-weight:bolder;font-size: 23px;text-decoration:none;";
	echo "<form action=classes.php method=get><table align='center'><tr><th table_link></th><th table_link>";

	if (!empty($_GET['order'])) 
	{
		if ($_GET['order']!='ClassName') 
		{
			echo "<form action=classes.php method=get ><input type='submit' class = \"table_button\" name='' value='Name' style='$buttonStyle'><input type='hidden' name='order' value='ClassName'>";
			echo "<input type='hidden' name='$dropdownName' value='$deptview'>";
		} 
		else 
		{
			echo "<form action=classes.php method=get><input type='submit' class = \"hover_button\" name='' value='Name' style='$buttonStyle'><input type='hidden' name='order' value='ClassName DESC'>";
			echo "<input type='hidden' name='$dropdownName' value='$deptview'>";
		}
		echo "</form></th><th class = \"table_link\">";

		if ($_GET['order']!='Department') 
		{
			echo "<form action=classes.php method=get><input type='submit' class = \"hover_button\" name='' value='Department' style='$buttonStyleBig'><input type='hidden' name='order' value='Department'>";
			echo "<input type='hidden' name='$dropdownName' value='$deptview'>";
		}
		else 
		{
			echo "<form action=classes.php method=get><input type='submit'  name='' value='Department' style='$buttonStyleBig'><input type='hidden' name='order' value='Department DESC'>";
			echo "<input type='hidden' name='$dropdownName' value='$deptview'>";
		}
		echo "</form></th><th>";

		if ($_GET['order']!='Fee') 
		{
			echo "<form action=classes.php method=get><input type='submit'  name='' value='Price' style='$buttonStyle'><input type='hidden' name='order' value='Fee'>";
			echo "<input type='hidden' name='$dropdownName' value='$deptview'>";
		} 
		else 
		{
			echo "<form action=classes.php method=get><input type='submit' name='' value='Price' style='$buttonStyle'><input type='hidden' name='order' value='Fee DESC'>";
			echo "<input type='hidden' name='$dropdownName' value='$deptview'>";
		}
		echo "</form></th><th>";
	} 
	else 
	{
		echo "<form action=classes.php method=get><input type='submit' class = 'order' value='Name' style='$buttonStyle'><input type='hidden' name='order' value='ClassName'>";
		echo "<input type='hidden' name='$dropdownName' value='$deptview'></form></th>";
		echo "<th><form action=classes.php method=get><input type='submit' class = 'order' name='' value='Department' style='$buttonStyleBig'><input type='hidden' name='order' value='Department'>";
		echo "<input type='hidden' name='$dropdownName' value='$deptview'></form></th>";
		echo "<th><form action=classes.php method=get><input type='submit' class = 'order' name='' value='Price' style='$buttonStyle'><input type='hidden' name='order' value='Fee'>";
		echo "<input type='hidden' name='$dropdownName' value='$deptview'></form></th><th>";
	}

// Echoes the dropdown list for department viewing. If one's selected, defaults to that.
	echo "<form action=classes.php method=get><br><font color=black>View only:</font>
	  <select name='deptView' onchange='this.form.submit()'>
	  <option value='All'>All</option>";
	  	if (isset($_GET['deptView']))
	{
		if ($deptview == "English")
		{
			echo "<option value='English' selected>English</option>
      <option value='History'>History</option>
      <option value='Mathematics'>Math</option>";
		} elseif ($deptview == "History")
		{
			echo "<option value='English'>English</option>
      <option value='History' selected>History</option>
      <option value='Mathematics'>Math</option>";
		} elseif ($deptview == "Mathematics")
		{
			echo "<option value='English'>English</option>
      <option value='History'>History</option>
      <option value='Mathematics' selected>Math</option>";
		} else {
			echo "<option value='English'>English</option>
      <option value='History'>History</option>
      <option value='Mathematics'>Math</option>";
		}
	} else {
		echo "<option value='English'>English</option>
      <option value='History'>History</option>
      <option value='Mathematics'>Math</option>";
	}
      echo "<input type='hidden' name='$orderName' value='$order'>";
	  echo "</th></tr></form>";

//Echoes the individual rows.
	for ($i=1; $i<=$num_rows; $i++) 
	{
		//function layout_rows($class_name, $dept, $price, $image_location)
		layout_rows($ClassName[$i], $Department[$i], $Fee[$i], $ImageLoc[$i]);


		// echo "<tr><td width='30%'><a href='buy.php?enroll=Enroll%21&Class=$ClassName[$i]'><img src='$ImageLoc[$i]' width='100' height='100'></a></td><td width='20%'>$ClassName[$i]</td><td width='20%'>$Department[$i]</td><td width='15%'>$$Fee[$i]</td><td width='20%'><form action='buy.php' method='get'><input id='button' type='submit' value='See more!' name='name'><input type='hidden' name='Class' value='$ClassName[$i]'></form></td></tr>";
	} 
	echo "</table>";
	?>
    </div>
  </div>
</div>
<?php require_once("footer.php") ?>
</body>
</html>
<?php clearFlash(); ?>