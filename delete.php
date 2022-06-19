<?php

require_once("./_connect/_connect.php"); //Calls the database

if (!isset($_POST["UID"])) //if there is no UID posted, this will die as either the course id is incorrect or someone is trying to access a page they shouldn't.
{
    die("No user selected");
}
//grabs uid, with real escape string for extra security
$uid = htmlentities(mysqli_real_escape_string($db_connect, $_POST["UID"]));

$query = "DELETE FROM `t_users` WHERE `t_users`.`UID` = $uid";

$run = mysqli_query($db_connect, $query);
die("admin"); //This is grabbed by the ajax code
?>