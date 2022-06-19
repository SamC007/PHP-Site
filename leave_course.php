<?php
require_once("./_connect/_connect.php"); //You know :)

if (!isset($_POST["UID"])) //errors if I try to real escape string this, am just gonna leave it for now
{
    die("No user selected");
}
if (!isset($_POST["CID"])) //both of these ifs check if 
{
    die("No course selected");
}
$course = mysqli_real_escape_string($db_connect, $_POST["CID"]);
$uid = mysqli_real_escape_string($db_connect, $_POST["UID"]);
//Posts with real escape string to protect against malicious attacks
$query = "DELETE FROM `t_link` WHERE `t_link`.`UID` = '$uid' AND `t_link`.`CID` = '$course'";
//delete query
mysqli_query($db_connect, $query);
die("admin"); //ajax grabs this and redirects
?>