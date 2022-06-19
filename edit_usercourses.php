<?php
require_once("./_connect/_connect.php"); //Calls the database
//posts with escape string
$id = mysqli_real_escape_string($db_connect, $_POST["ID"]);
$uid = mysqli_real_escape_string($db_connect,$_POST["UID"]);
$cid = mysqli_real_escape_string($db_connect,$_POST["CID"]);

$select = "SELECT * FROM `t_link` WHERE `UID` = $uid AND `CID` = $cid";
//Select query
$query = mysqli_query($db_connect, $select);

$result = mysqli_fetch_assoc($query);
//Checks if the UID and CID is legit.
if (isset($_POST["UID"]))
{ //posts with escape string
$id = mysqli_real_escape_string($db_connect, $_POST["ID"]);
$uid = mysqli_real_escape_string($db_connect, $_POST["UID"]);
$cid = mysqli_real_escape_string($db_connect, $_POST["CID"]);

$update = "UPDATE `t_link` SET `UID` = '$uid', `CID` = '$cid' WHERE `t_link`.`ID` = $id;";
//update query
mysqli_query($db_connect, $update); //runs query
die("admin"); //This is grabbed by the ajax code
}
?>