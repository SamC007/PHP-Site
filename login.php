<?php
include_once("./_connect/_connect.php");
ini_set('session.cookie_secure', 'On');
ini_set("session.cookie_httponly", "On");
session_start();
//captcha response
if ($_POST['g-recaptcha-response']!="")
{
	$secret = '6LdkHp8aAAAAAJc7Zp5jzB9eUdEJFh7NrqHSAuYh';
	$url = 'https://www.google.com/recaptcha/api/siteverify';
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secret) .  '&response=' . urlencode($_POST['g-recaptcha-response']);
        $response = file_get_contents($url);
        $responseKeys = json_decode($response,true);
        // should return JSON with success as true
        if($responseKeys["success"])
	{

if (!isset($_POST["email"]) || !isset($_POST["password"])) {
    //if username or password has not been entered
    die("3"); //This is grabbed by the ajax code
}
else
{
    $email = mysqli_real_escape_string($db_connect, $_POST["email"]);
    $password = mysqli_real_escape_string($db_connect, $_POST["password"]);

    $query = "SELECT * FROM `t_users` WHERE `email` = '$email' LIMIT 1";
    $run = mysqli_query($db_connect, $query);
    $result = mysqli_fetch_assoc($run);
    $count = mysqli_num_rows($run);
    if ($count < 1)
    {
        die("1"); //This is grabbed by the ajax code
    }
    if ($result["login_counter"] > 4)
    {
    	die("2"); //This is grabbed by the ajax code
    }


    if ($count === 1) {
        //password decryptor
        $hash = $result["password"];
        if (password_verify($password, $hash))
        {
            //if username and password is correct
            $access = $result["access"];
            $_SESSION["auth"] = $access;
            $_SESSION["name"] = $result["First_Name"]." ".$result["Last_Name"];
            $_SESSION["UID"] = $result["UID"];

            if ($access == "admin")
            {
                die("admin"); //This is grabbed by the ajax code //This is grabbed by the ajax code
            }
            if ($access == "user")
            {

                die("user"); //This is grabbed by the ajax code 
            }
            die("4"); //This is grabbed by the ajax code
        }
    
    else
    {
        $sql2 = "UPDATE `t_users` SET `login_counter` = `login_counter` + 1 WHERE `t_users`.`email` = '$email'";
        $run2 = mysqli_query($db_connect, $sql2);
        //if incorrect redirect the user to login page with error*/
        die("1"); //This is grabbed by the ajax code
    }
}
}
	}
	else
	{
		die("5"); //This is grabbed by the ajax code
	}
}
else
{
	die("5"); //This is grabbed by the ajax code
}
?>