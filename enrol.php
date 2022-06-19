<?php 

require_once("./_connect/_connect.php");

if (!isset($_POST["UID"]))
{
    die("No user selected");
}
if (!isset($_POST["CID"]))
{
    die("No course selected");
}
$uid = $_POST["UID"];
$cid = $_POST["CID"];

$query = "INSERT INTO `t_link` (`ID`, `UID`, `CID`, `TIMESTAMP`) VALUES (NULL, '$uid', '$cid', current_timestamp());";

mysqli_query($db_connect, $query);

die("admin");
?>