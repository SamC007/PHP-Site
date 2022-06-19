<?php
require_once("./_connect/_connect.php"); //Calls the database

//Select query, don't need to worry so much about the uid not being legit, if it isn't it won't affect the database - real escape string is added protection just in case
$uid = htmlentities(mysqli_real_escape_string($db_connect, $_POST["UID"]));

$select = "SELECT * FROM `t_users` WHERE `UID` = $uid";

$query = mysqli_query($db_connect, $select);

$result = mysqli_fetch_assoc($query);
//Checks if the UID is legit.
if (isset($_POST["UID"]))
{ //Posts, with escape string for security
$uid = mysqli_real_escape_string($db_connect, $_POST["UID"]);
$email = mysqli_real_escape_string($db_connect, $_POST["email"]);
$password = mysqli_real_escape_string($db_connect, $_POST["password"]);
$access = mysqli_real_escape_string($db_connect, $_POST["access"]);
$jobtitle = mysqli_real_escape_string($db_connect, $_POST["job_title"]);
$hashed = password_hash($password, PASSWORD_DEFAULT);

$update = "UPDATE `t_users` SET `email` = '$email', `password` = '$hashed', `access` = '$access', `Job_Title` = '$jobtitle' WHERE `t_users`.`UID` = $uid";
//Update query
mysqli_query($db_connect, $update);
       die("admin"); //This is grabbed by the ajax code
}
?>