<?php

require_once("./_connect/_connect.php"); //Calls the database

if (!isset($_POST["UID"])) //why doesn't isset work with real escape string?? it upsets me
{
    die("No user selected"); //if no uid, the program dies because there is no uid to update
}
//post with real escape string
$uid = htmlentities(mysqli_real_escape_string($db_connect, $_POST["UID"]));
$query = "UPDATE `t_users` SET `login_counter` = '0' WHERE `t_users`.`UID` = $uid;";
//update query
$run = mysqli_query($db_connect, $query); //runs query
die("admin"); //This is grabbed by the ajax code
?>