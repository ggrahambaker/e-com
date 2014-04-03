<?php
require('checkuser.php');

// output form for logging in or for creating a user account.
// use GET params to determine which operation.
// Default op is login
// GET param 'dest' is used to redirect user after successful login
function outputForm()
{
    if (empty($_GET) || !isset($_GET['op']) || $_GET['op']==='login') 
        $value = 'login';
    else
        $value = 'create';
    if (isset($_GET['dest']))
    {
        $destination = $_GET['dest'];
        $dest = "?dest=$destination";
    }
    else
        $dest = "";
echo <<<FORMSTUFF
 <div id="container">
    <div id="backround_img">
        <div id="form_body">
            <h2>Log In</h2>
            <form action='createuser.php$dest' method='post'>
            username: <input class="form_font" type=text name=username><br>
            password: <input class="form_font" type=password name=password><br>
            <input type=submit name='submit' value='$value'><br>
            </form>
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



FORMSTUFF;
}

// code for processing form data
// Option 1: display blank form
if (empty($_POST))
{
    mustBeSecure();
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
<?php outputForm(); ?>
</body>
</html>
<?php
} else {
    // Option 2: create a new user
    if ($_POST['submit'] == 'create')
    {
        if (userAlreadyExists($_POST['username']))
        {
?>
<!doctype html>
<html>
<body>
User already exists. Please pick a new username.<br>
<?php outputForm(); ?>
</body>
</html>
<?php
        } else {
            $password = $_POST['password'];
            $hasher = new PasswordHash(8,false) or die('unable to hash PW');
            $hash = $hasher->HashPassword($password);
            if (strlen($hash)< 20) die('Invalid hashed PW');
            $file =fopen(FILENAME, 'a') or die('Unable to open pw file');
            fputs($file, $_POST['username'] . ',' . 
                $hash . "\n")
                or die('Unable to update pw file');
            fclose($file)
                or die('Unable to update pw file');
            markUserLoggedIn($_POST['username']);
            header('Location: index.html');
        }
    } elseif ($_POST['submit'] == 'login') {
        // OPTION 3: user is attempting login
        if (userIsLoggedIn()) session_destroy();
        if (validateCredentials($_POST['username'], $_POST['password']))
        {
            markUserLoggedIn($_POST['username']);
            if (isset($_GET['dest']))
            {
                $dest = $_GET['dest'];
                header("Location: $dest");
            }
            else
                header('Location: index.html');
        } else {
?>
<!doctype html>
<html>
<body>
Invalid username/password<br>
<?php outputForm(); ?>
</body>
</html>
<?php
        }
    }
}
?>
