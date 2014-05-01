<?php require_once("lib/sessions.php");
    $userName = getCurrentUserName();
    if(!empty($userName))
    {
        redirect("dashboard.php");
    }
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Welcome to Weeplesoft</title>


    <link rel="stylesheet" type="text/css" href="splash.css">
    <link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Galdeano' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="/images/w.ico">

</head>
<body>
    <?php require_once("header.php") ?>

    <div id="container">
        <div id="backround_img">
            <div id="form_body">

                <?php require_once("lib/flash.php"); ?>
                <form action="login.php" method="post">

                <?php
                $password = getFlash("password");
                $username = getFlash("username");

                
                if(!empty($username)) //bad username
                {
                    ?>
                    <p class= "form_font"> Username: </p> <input type="text" name="username" size="35" class = "user_password_error"><br>
                    <p class= "form_font"> Password: </p> <input name="password" type="password" size="35" class = "user_password"><br><br>
                    <?php
                }
                else if(!empty($password)) //bad password
                {
                    $user = $_SESSION["user"];
                    ?>
                    <p class= "form_font"> Username: </p> <input type="text" name="username" size="35" value = "<?php echo $user ?>" class = "user_password"><br> 
                    <p class= "form_font"> Password: </p> <input name="password" type="password" size="35" class = "user_password_error"><br><br>
                    <?php
                    unset($_SESSION["user"]);

                }
                else //everything is fine
                {
                    ?>
                    <p class= "form_font"> Username: </p> <input type="text" name="username" size="35" class = "user_password"><br>
                    <p class= "form_font"> Password: </p> <input name="password" type="password" size="35" class = "user_password"><br><br>
                    <?php
                }
                ?>
                

               <!--  <form action="login.php" method="post">

                    <p class= "form_font"> Username: </p> <input type="text" name="username" size="35" class = "user_password"><br>
                    <p class= "form_font"> Password: </p> <input name="password" type="password" size="35" class = "user_password"><br><br> -->



                    <input id="button" type="submit" name="submit" value="Create Account">
                    <input id="button" type="submit" name="submit" value="Sign In">
                    
                </form>
            </div>
        </div>
    </div>
    
    <?php require_once("footer.php") ?>
</body>
</html>

<?php clearFlash(); ?>