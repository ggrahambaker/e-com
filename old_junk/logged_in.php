<?php 
define ("FILENAME", "/home/tail/html_data/passwords.txt");
require 'PasswordHash.php';
	
$user = $_COOKIE['username'];
$pass = $_COOKIE['password'];
$hashed_pw = getPW($user);

if ($hashed_pw != null)
        {
			$hasher = new PasswordHash(8,false) or die("unable to hash PW");
            if ($hasher->CheckPassword($pass, $hashed_pw))
			 	{
					header ("Cache-Control:no-cache");
					echo "Successful Login!";
				} else {
					header ("Location:notlogged.html");
				}
		} else {
			header ("Location:notlogged.html");
		}
	
function getPW($username)
{
    $file = fopen(FILENAME, "r") or die("Unable to open pw file");
    while (!feof($file))
    {
        $user = fgetcsv($file);
        if ($user[0] == $username)
        {
            fclose($file);
            return $user[1];
        }
    }
    fclose($file);
}	
?>
<html>
<head> <title>Logged In</title> </head>
<body>
</body>
</html>