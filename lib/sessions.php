<?php

define ("FILENAME", "/home/tail/html_data/passwords.txt");
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
    if($user == null) 
    {
        setFlash("error", "Username not found");
        redirect("index.php");
    }
    $hasher = new PasswordHash(8,false) or die("unable to hash PW");
    if (!$hasher->CheckPassword($password, $user[1])) 
    {
        setFlash("error", "Bad password");
        redirect("index.php");
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
    $userArray = getCurrentUser();
    return $userArray[0];
}

function requireUser()
{
    if (!getCurrentUser()) 
    {
        setFlash("notice", "You have to be signed in to see that page.");
        redirect("index.php");
    }
}

function signUp($username, $password)
{
    if(getUser($username)) 
    {
        setFlash("error", "Bad password");
        redirect("index.php");
    }
    if(preg_match('^[a-zA-Z0-9]{8,}$', $username))
    {
        setFlash("error", "Legal characters inlcude: (A-Z), (a-z), (0-9), ($')");
        redirect("index.php");
        //preg_match('^[a-zA-Z0-9]{8,}$', $username)
        //[a-zA-Z0-9]

    }
    if(strlen($username) < 1)
    {
        setFlash("error", "Username can't be blank");
        redirect("index.php");        
    }
    if(strlen($password) < 6)
    {
        setFlash("error", "Password is too short");
        redirect("index.php");
    }
    storeUser($username, $password);
    signIn($username, $password);
}   


function signIn($username, $password)
{
    authenticate($username, $password);
    setCurrentUser($username);
    setFlash("notice", "You are now signed in.");
    redirect("dashboard.php");
}

function signOut()
{
    setCurrentUser(null);
    setFlash("notice", "You are now signed out.");
    redirect("index.php");   
}

function redirect($url)
{
    header('Location: '. $url);
    die();
}

function setFlash($type, $message) 
{
    $_SESSION[$type] = $message;
}

function getFlash($type) 
{
    if (isset($_SESSION[$type])) 
    {
        return $_SESSION[$type];
    }
}

function clearFlash()
{
    unset($_SESSION["error"]);
    unset($_SESSION["notice"]);
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