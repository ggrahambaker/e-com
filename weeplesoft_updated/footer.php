
<div id="footer_container">
	<div id="footer">
		<a class="link_on_foot" href="privacy_policy.php" target="">Privacy Policy</a>
		<a class="link_on_foot" href="contact_us.php" target="">Contact Us</a>
		<a class="link_on_foot" href="grades.php" target="">Classes</a>
		<a class="link_on_foot" href="books.php" target="">Books</a>
		<a class="link_on_foot" href="index.php" target="">Home</a>
		<?php require_once("lib/sessions.php"); ?>
		<?php require_once("lib/flash.php"); ?>
		<?php
			$userName = getCurrentUserName();
			if(!empty($userName))
			{
				echo "<div>Signed in as $userName</div>";
			}
			else
			{
				echo "<div>Not signed in</div>";
			}
		?>
	</div>
</div>