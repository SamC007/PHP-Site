<?php
require_once("./_connect/_connect.php"); //Calls the database
$id = mysqli_real_escape_string($db_connect, $_POST["ID"]);

//Checks if the ID is legit.
if (isset($_POST["ID"]))
{
$id = mysqli_real_escape_string($db_connect, $id);

$update = "DELETE FROM `t_link` WHERE `t_link`.`ID` = $id;";
//update query
mysqli_query($db_connect, $update);
die("admin"); //redirect
}
else
{
    die("no ID selected"); //This is grabbed by the ajax code
}
?>