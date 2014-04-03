<?php
session_set_cookie_params(0, '/~gbaker/', '', true, true);
session_start();
define ("FILENAME", "/home/gbaker/html_data/password.txt");
require 'PasswordHash.php';

// return hash of the PW
// return false if no such user
function getHashedPW($username)
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
    return false;
}

// return true if the user is in the PW file
function userAlreadyExists($user)
{
    $hash = getHashedPW($user);
    if ($hash === false) return false;
    return true;
}

// return true if specified user/pw are in the PW file
function validateCredentials($user, $pw)
{
    $hashed_pw = getHashedPW($user);
    if ($hashed_pw == null) 
    {
        return false;
    }

    $hasher = new PasswordHash(8,false) or die("unable to hash PW");
    if ($hasher->CheckPassword($pw, $hashed_pw)) 
    {
        echo "user is logged in";
        return true;
    }

    return false;
}

// add user/pw to PW file.
// NOTE: assumes user and pw are already validated
function createUser($user, $pw)
{
    $hasher = new PasswordHash(8,false) or die("unable to hash PW");
    $hash = $hasher->HashPassword($password);
    if (strlen($hash)< 20) die("Invalid hashed PW");
    $file =fopen(FILENAME, "a") or die("Unable to open pw file");
    fputs($file, $_POST["username"] . "," .  $hash . "\n")
        or die("Unable to update pw file");
    fclose($file) or die("Unable to update pw file");

    return true;
}

// return true if a user is currently logged in
function userIsLoggedIn()
{
    if (session_id() == '') return false;
    if (!isset($_SESSION['user'])) 
    {
        session_destroy();
        return false;
    }
    $user = $_SESSION['user'];
    if (!isset($_SESSION['hash']))
    {
        session_destroy();
        return false;
    }
    $hash = $_SESSION['hash'];
    if ($hash != md5($user))
    {
        session_destroy();
        return false;
    }

    return true;
}

// create session variables to indicate user is logged in
// Must only be done after validateCredentials
function markUserLoggedIn($user)
{
    if (session_id() == '') session_start();
    $_SESSION['user'] = $user;
    $_SESSION['hash'] = md5($user);
}

// If user is not logged in, redirect to login page
// user GET dest param to redirect here after successful login
function mustBeLoggedIn()
{
    $dest = htmlspecialchars($_SERVER['PHP_SELF']);
    if (!userIsLoggedIn()) 
    {
        header("location: createuser.php?op=login&dest=$dest");
        exit();
    }
}

// return user name if logged in
function getUserName()
{
    if (!userIsLoggedIn()) return false;
    return $_SESSION['user'];
}

// output a greeting if a user is logged in
function outputGreeting()
{
    if (userIsLoggedIn())
    {
        $user = getUserName();
        echo "<p> HOWDY $user <p><br>";
    }
}

// redirect to HTTPS if necessary
function mustBeSecure()
{
    if(!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "")
    {
        $redirect = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        header("Location: $redirect");
        exit();
    }
}


