<?php
require_once("./_connect/_connect.php"); //Connects to database


$cid = mysqli_real_escape_string($db_connect, $_POST["CID"]); //real_escape_string for security

$select = "SELECT * FROM `t_courses` WHERE `CID` = $cid"; //Select statement

$query = mysqli_query($db_connect, $select); //runs query

$result = mysqli_fetch_assoc($query); //stores query result
//Checks if the UID is legit.
if (isset($_POST["CID"]))
{ //get variables that are posted, real escape string for security
    $cid = mysqli_real_escape_string($db_connect, $_POST["CID"]);
    $course = mysqli_real_escape_string($db_connect, $_POST["course"]);
    $date = mysqli_real_escape_string($db_connect, $_POST["date"]);
    $duration = mysqli_real_escape_string($db_connect, $_POST["duration"]);
    $max = mysqli_real_escape_string($db_connect, $_POST["max_attendees"]);
    $desc = mysqli_real_escape_string($db_connect, $_POST["description"]);
//update query
$update = "UPDATE `t_courses` SET `TITLE` = '$course', `DATE` = '$date', `DURATION` = '$duration', `MAX_ATTENDEES` = '$max', `DESCRIPTION` = '$desc' WHERE `t_courses`.`CID` = $cid;
";
       
mysqli_query($db_connect, $update); //runs update query
	die("admin"); //This is grabbed by the ajax code 
}
?>