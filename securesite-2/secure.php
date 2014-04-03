<?php 
include('checkuser.php'); 
mustBeLoggedIn();
?>
<!doctype html>
<html>
    <head>
        <title>WeepleSoft</title>
        <link rel="stylesheet" type="text/css" href="splash.css">
		<link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Galdeano' rel='stylesheet' type='text/css'>

    </head>
    <body>
        <div id="container">
			<div id="backround_img">
				<div id="form_body">
					<?php outputGreeting() ?>
					<p> There is some great content here</p><br>
					<p> You must be logged in to see this page.</p>
				</div>
			</div>
		</div>


<div id="footer_container">
    <div id="footer">

            <a class="link_on_foot" href=createuser.php?op=create>create user</a>
            <a class="link_on_foot" href=createuser.php?op=login>login user</a>
            <a class="link_on_foot" href=unsecure.php>unsecure page</a>
            <a class="link_on_foot" href=secure.php>secure page</a>
            <a class="link_on_foot" href=logout.php>logout</a>

    </div>
</div>
    </body>
</html>
