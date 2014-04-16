
<div id="footer_container">
	<div id="footer">
		<a class="link_on_foot" href="privacy_policy.php" target="">Privacy Policy</a>
		<a class="link_on_foot" href="contact_us.php" target="">Contact Us</a>
		<a class="link_on_foot" href="classes.php" target="">Classes</a>
		<a class="link_on_foot" href="books.php" target="">Books</a>
		<a class="link_on_foot" href="index.php" target="">Home</a>
		<?php
			require_once("lib/sessions.php"); 
			require_once("lib/flash.php");
			$userName = getCurrentUserName();
			if(!empty($userName))
			{
				echo "<span class=\"text_on_foot\">Signed in as $userName</span>";
				echo "<a class=\"link_on_foot\" href=\"log_out.php\" target=\"\">Logout</a>";
			}
			else
			{
				echo "<span class=\"text_on_foot\">Not signed in</span>";
			}
		?>
	</div>
</div>