<?php
session_start(); //starts the session just to destroy it, how cruel :(
session_destroy();
header("location:index.php"); //This is grabbed by the ajax code
?> 