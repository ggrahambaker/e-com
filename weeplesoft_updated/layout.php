 <?php
function printLayout()
{
  echo <<<FORMSTUFF
    <div id="header_container">
        <div id="header">
        <h1> WEEPLESOFT </h1>
        </div>
    </div>


<div id="container">
    <div id="backround_img">
        <div id="form_body">
            <form action = "createuser.php" method = "post">
            <p class="form_font"> Username: </p> <input type="text" name="firstname" size="35"><br>
            <p class="form_font"> Password: </p> <input type="password" name="firstname" size="35"><br><br>

            <input type=submit name="submit" value="create"><br>
            <input type=submit name="submit" value="login"><br>
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
FORMSTUFF;
}
?>