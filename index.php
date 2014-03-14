<!DOCTYPE html>
<html>
<head>
    
</head>
<body>
<?php
define ("FILENAME", "/home/tail/html_data/passwords.txt");
require 'PasswordHash.php';

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

if (empty($_POST))
{
    echo <<<FORMSTUFF


FORMSTUFF;
} 
else {
    if ($_POST["submit"] == "create")
    {
        $pw = getPW($_POST['username']);
        if ($pw != null)
        {
            echo "username already exists";
        } else {
            $password = $_POST["password"];
            $hasher = new PasswordHash(8,false) or die("unable to hash PW");
            $hash = $hasher->HashPassword($password);
            if (strlen($hash)< 20) die("Invalid hashed PW");
            $file =fopen(FILENAME, "a") or die("Unable to open pw file");
            fputs($file, $_POST["username"] . "," . 
                $hash . "\n")
                or die("Unable to update pw file");
            fclose($file)
                or die("Unable to update pw file");
            echo "user was created<br>";
        }
    } elseif ($_POST["submit"] == "login") {
        $hashed_pw = getPW($_POST['username']);
        if ($hashed_pw != null)
        {
            $hasher = new PasswordHash(8,false) or die("unable to hash PW");
            if ($hasher->CheckPassword($_POST['password'], $hashed_pw))
                echo "login successful<br>";
            else
                echo "invalid username/password<br>";
        }
    }
}
?>
</body>
</html>



