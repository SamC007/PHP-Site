<?php

require_once("./_connect/_connect.php"); //Calls the database

if (!isset($_POST["CID"]))
{
    die("Course ID incorrect"); //if there is no CID posted, this will die as either the course id is incorrect or someone is trying to access a page they shouldn't.
} //Post strings, with real escape for added security
$cid = mysqli_real_escape_string($db_connect, $_POST["CID"]);
$title = mysqli_real_escape_string($db_connect, $_POST["TITLE"]);
$date = mysqli_real_escape_string($db_connect, $_POST["DATE"]);
$duration = mysqli_real_escape_string($db_connect, $_POST["DURATION"]);
$max = mysqli_real_escape_string($db_connect, $_POST["MAX_ATTENDEES"]);
$desc = mysqli_real_escape_string($db_connect, $_POST["DESCRIPTION"]);

$query = "INSERT INTO `t_courses` (`CID`, `TITLE`, `DATE`, `DURATION`, `MAX_ATTENDEES`, `DESCRIPTION`, `TIMESTMAP`) VALUES (NULL, '$title', '$date', '$duration', '$max', '$desc', current_timestamp());";
//Insert Query
mysqli_query($db_connect, $query); //runs query

echo $title." has been added successfully"; //this echo is useless, I love it
header("Location:admin_courses.php"); //redirect
?>