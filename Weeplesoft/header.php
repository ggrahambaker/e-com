<?php
function printHeader(){
	echo <<<FORMSTUFF

		<div id="header_container">
			<div id="header">
				<h1> <a href= "index.php">WEEPLESOFT</a> </h1>
			</div>
		</div>

FORMSTUFF;
}
?>

<?php if (getCurrentUser()): ?>
	<h1>You're signed in</h1>	
<?php endif ?>