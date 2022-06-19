<?php
require_once("./_connect/_connect.php"); //Calls the database
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') { //This is if the server requests a post
$userinput = mysqli_real_escape_string($db_connect, $_POST["email"]);
$jobtitle = mysqli_real_escape_string($db_connect, $_POST["job_title"]);
$query = "SELECT * FROM `t_users` WHERE `t_users`.`email` = '$userinput' AND `t_users`.`Job_Title` = '$jobtitle';";
$result = mysqli_query($db_connect, $query);
if (mysqli_num_rows($result) == 1)
{
    $row = mysqli_fetch_array($result);
    $pw = mysqli_real_escape_string($db_connect, $_POST["password"]);
    $hashed = password_hash($pw, PASSWORD_DEFAULT); //password hasher
    $query = "UPDATE `t_users` SET `password` = '$hashed' WHERE `t_users`.`email` = '$userinput' AND `t_users`.`Job_Title` = '$jobtitle';";
    //update query
    mysqli_query($db_connect, $query);
    //header("Location:index.php");
}
else
{
    //The user isn't legit, so we kick them out
    header("Location:index.php");
}
}
else
{
    ?>
<html>
	<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Forgot Password</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>
	<body>
    <form method="post" action="index.php?e=6"> <!-- New form if the user is legit but no post -->
    <label>What is your email address?:</label>
    <input type="email" name="email" placeholder="email" required>
    <br>
    <label>What is your job title?:</label>
    <input type="text" name="job_title" placeholder="job title" required>
    <br>
    <label>New Password</label>
    <input type="password" name="password" placeholder="password" required>
    <br>
    <button type="submit">Submit</button>
    </form>
	</body>
</html>
    <?php
}
?>
