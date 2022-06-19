<?php
include_once("_connect/_connect.php"); //connects to database
ini_set('session.cookie_secure', 'On'); //XSS Protection
ini_set("session.cookie_httponly", "On");
session_start();

if (isset($_SESSION["auth"])) //checks if the user is authenticated to get to this page
{
    if (mysqli_real_escape_string($db_connect, $_SESSION["auth"]) == "admin")
    {
        $auth = (mysqli_real_escape_string($db_connect,$_SESSION["auth"]));
    }
    else
    {
        header("location: index.php?e=1"); //redirects them to the login page, with error 1
        die("Incorrect email or password"); //in case the redirect doesn't work
    }
}
else
{
    $auth = "pending";
    header("location:index.php?e=1"); //redirects them to the login page, with error 1
    die("Incorrect authentication"); //in case the redirect doesn't work
}