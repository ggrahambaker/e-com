<?php 
	$auth = $_COOKIE['authorization'];
	header ("Cache-Control:no-cache");
	if(!$auth == "ok") {
		header ("Location:notlogged.html");
		echo "Not logged in!";
		exit();
	}
?>
<html>
<head> <title>Logged In</title> </head>
<body>
	<p>Successful log-in.</p>
</form>
</body>
</html>