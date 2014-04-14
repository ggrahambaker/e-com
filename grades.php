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
	<div id="backround_img">
		<div id="form_body">
			<form name="classes" action="" onsubmit="gradeCheck()">
			<p class="form_font"> Check Grades? </p><br>
            <label>
            <input type="checkbox" name="Ochem"/> Organic Chemistry <br>
            <input type="checkbox" name="Yoga"/> Yoga <br>
            <input type="checkbox" name="Bitcoin"/> BUS 453 <br>
            <input type="checkbox" name="Psyc"/> PSYC 313<br>
            <input type="checkbox" name="Ecom"/> Ecommerce <br>
            <input type="input" name="Form stuff"/> Put some form stuff here! <br>
            </label>
			<br />
			<input id="button" type="submit" value="Submit">
            
			</form>
		</div>
	</div>
</div>


<div id="footer_container">
<div id="footer">

	<a class="link_on_foot" href="privacy_policy.html" target="">Privacy Policy</a>
	<a class="link_on_foot" href="contact_us.html" target="">Contact Us</a>

</div>
</div>
<script>
function gradeCheck()
{
	var names = new Array();
	names[0] = "Ochem";
    names[1] = "Yoga";
    names[2] = "Bitcoin";
    names[3] = "Psyc";
    names[4] = "Ecom";
	
	var code = new Array();
	code[0] = getElementById("Ochem").innerHTML;
    code[1] = getElementById("Yoga").innerHTML;
    code[2] = getElementById("Bitcoin").innerHTML;
    code[3] = getElementById("Psyc").innerHTML;
    code[4] = getElementById("Ecom").innerHTML;
	window.alert("Ho")
	
	var classes = new Array();
	classes[0] = document.getElementsByName("Ochem")[0].checked;
	classes[1] = document.getElementsByName("Yoga")[0].checked;
	classes[2] = document.getElementsByName("Bitcoin")[0].checked;
	classes[3] = document.getElementsByName("Psyc")[0].checked;
	classes[4] = document.getElementsByName("Ecom")[0].checked;
	window.alert("Hey")

	var grades = new Array();
	grades[0] = "A-";
	grades[1] = "B+";
	grades[2] = "B;"
	grades[3] = "B";
	grades[4] = "F";
	
	for(var x=0;x<5;x++)
	{
		if (classes[x])
		{
			document.getElementById(names[x]).innerHTML = (code[x].innerHTML + ": " + grades[x])
			window.alert("Hi" + x)
		}
	}
}
</script>
</body>
</html><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>

<?php clearFlash(); ?>