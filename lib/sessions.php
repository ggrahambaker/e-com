<?php
define ("FILENAME", dirname(__FILE__) . "/passwords.txt");
require 'PasswordHash.php';

function getUser($username)
{
    $file = fopen(FILENAME, "r") or die("Unable to open pw file");
    while (!feof($file))
    {
        $user = fgetcsv($file);
        if ($user[0] == $username)
        {
            fclose($file);
            return $user;
        }
    }
    fclose($file);
}

function storeUser($username, $password)
{
    $hashed = hashPassword($password);
    $file = fopen(FILENAME, "a") or die("Unable to open pw file");
    fputs($file, $username . "," . $hashed . "\n") or die("Unable to update pw file");
    fclose($file) or die("Unable to update pw file");
}

function hashPassword($password)
{
    $hasher = new PasswordHash(8,false) or die("unable to hash PW");
    $hashed = $hasher->HashPassword($password);
    if (strlen($hashed)< 20) {
        die("Invalid hashed PW");  
    }
    return $hashed;
}

function authenticate($username, $password)
{
    $user = getUser($username);
    if($user == null) {
        die("Username not found");
    }
    $hasher = new PasswordHash(8,false) or die("unable to hash PW");
    if (!$hasher->CheckPassword($password, $user[1])) {
        die("Wrong password");
    }
}

function setCurrentUser($username) 
{
    $_SESSION['current_username'] = $username;
}

function getCurrentUser()
{
    if(isset($_SESSION['current_username'])) {
        return getUser($_SESSION['current_username']);
    }
}

function getCurrentUserName()
{
    return getCurrentUser()[0];
}

function requireUser()
{
    getCurrentUser() or redirect("/login.php");
}

function signUp($username, $password)
{
    if(getUser($username)) 
    {
        die("username taken");
    }
    if(strlen($password) < 6)
    {
        die("password must be more than 6 characters");
    }
    storeUser($username, $password);
    signIn($username, $password);
}   


function signIn($username, $password)
{
    authenticate($username, $password);
    setCurrentUser($username);
    redirect("/dashboard.php");
}

function signOut()
{
    setCurrentUser(null);
    redirect("login.php");   
}

function redirect($url)
{
    header('Location: '. $url);
    die();
}

session_start();

if (!empty($_POST))
{
    if ($_POST["submit"] == "Create Account")
    {
        signUp($_POST["username"], $_POST["password"]);
    }
    elseif ($_POST["submit"] == "Sign Out") 
    {
        signOut();
    }
    else 
    {
        signIn($_POST["username"], $_POST["password"]);
    }
}
?>
