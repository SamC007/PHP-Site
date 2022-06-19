<?php

require_once("./_connect/_connect.php"); //Calls the database

if (!isset($_POST["email"]) || !isset($_POST["password"])) //if there is no email or password posted, this will die as either the course id is incorrect or someone is trying to access a page they shouldn't.
{
    die("Password incorrect");
} //Post strings, with real escape for added security
$email = mysqli_real_escape_string($db_connect, $_POST["email"]);
$password = mysqli_real_escape_string($db_connect, $_POST["password"]);
$access = mysqli_real_escape_string($db_connect, $_POST["access"]);
$jobtitle = mysqli_real_escape_string($db_connect, $_POST["job_title"]);
$hashed = password_hash($password, PASSWORD_DEFAULT);


$query = "INSERT INTO `t_users` (`UID`, `email`, `password`, `access`, `login_counter`, `Job_Title`, `timestamp`) VALUES (NULL, '$email', '$hashed', '$access', '0', '$jobtitle', current_timestamp())";
//Insert query
mysqli_query($db_connect, $query);

echo $email." has been added successfully"; //This echo is useless, I love it
header("Location:admin.php");
?>