<?php

require_once("./_connect/_connect.php"); //Connects to database

if (!isset($_POST["CID"])) //dies if no CID
{
    die("No user selected");
}

$cid = mysqli_real_escape_string($db_connect, $_POST["CID"]); //real_escape_string for security, grabs the CID

$query = "DELETE FROM `t_courses` WHERE `t_courses`.`CID` = $cid";
//Query
$run = mysqli_query($db_connect, $query); //runs query
die("admin"); //This is grabbed by the ajax code
?>