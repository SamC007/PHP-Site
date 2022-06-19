<?php
include_once("./_connect/_connect.php"); //connects to database
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login Page</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Captcha v2 link and extra JavaScript -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script type="text/javascript">
  var onloadCallback = function() {
    alert("grecaptcha is ready!");
  };
</script>

</head>

<body id="page-top">


    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="min-width:100px"> <!-- This creates the blue dashboard on the left of the page -->
            <li class="nav-item">
                <a class="nav-link" href="index.php"> <!-- Here is the dashboard link -->
                    <i class="fas fa-fw fa-tachometer-alt"></i> <!-- Dashboard image -->
                    <span>Dashboard</span></a>
            </li>
            <!-- Heading -->
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <div class="row">
                    <div class="col-sm-4">
                    </div>
                    <div class="col-sm-7"><h2>Login Page</h2></div> <!-- The div clases force the title into the middle of the page -->
                    <div class="col-sm-1">
                        <br>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#LoginModal"> <!-- The login button -->
                        Login
                      </button>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-3">
                    </div>
                    <!-- Basic Card Example -->
                    <div class="col-sm-3">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Forgot your password?</h6>
                            </div>
                            <div class="card-body">
                                <a type="button" class="btn btn-danger" href="forgot_password.php">Forgot Password</a> <!-- the button for if you've forgotten your password -->
                                <br>
                                <br>
                                <img height="90%", width="90%", src="./img/forgot-password.jpg"></img>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <!-- Begin Page Content -->
                <?php
                if (isset($_GET["e"])) { //This code is for grabbing any errors that could be on the URL of the page.
                ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">

                <?php
                switch ($_GET["e"]) 
                { //This code here is a switch for all potential error messages. It only goes up to four.
                case 1:
                    ?>
                    <p>Incorrect password or email</p>
                    <?php break;
                case 2:
                    ?>
                    <p>Too many login attempts, contact the admin</p>
                    <?php
                    break;
                case 3:
                    ?>
                    <p>No email or password set</p>
                    <?php
                    break;
                case 4:
                    ?>
                    <p>Contact admin, account still pending</p>
                    <?php
                    break;
					?>
					<?php
				case 5:
					?>
					<p>Captcha incorrect</p>
					<?php
					break;
					?>
					<?php
					case 6:
						?>
					<p>Password Changed</p>
					<?php
						break;
                }
                ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <!-- This is so the alert has a button that can close the error message -->
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <?php
                }
                ?>
                <div class="container-fluid">
                        </div>
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Weston College 2021</span> <!-- This is the footer text -->
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
		</div>
        <!-- End of Content Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Login modal -->
    <div class="modal" tabindex="-1" role="dialog" id="LoginModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="h3 mb-3 fw-normal">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <!-- A button to close the modal -->
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="login.php" id="LoginForm"> <!-- This form is for creating and posting the login details. -->
                        <label for="email" class="visually-hidden">Email address</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email address" required autofocus>
                        <br>
                        <label for="password" class="visually-hidden">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                        <br>
                        <div class="g-recaptcha" data-sitekey="6LdkHp8aAAAAABM9m4cu5vQHtI5b59Z4Zqt4J6mH"></div>
                        <br>
                        <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
                    </form>
                </div>
            </div>
        </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
	<script> 
        $(document).ready(function () {
            $("#LoginForm").on("submit", function (setFormData) {
                //prevent form from submitting
                setFormData.preventDefault();
                var formData = $(this).serialize();
                $.post("login.php", formData, function (functionName) {
                    $("form").hide(); //Hides the form
                    var functionResponse = (functionName); //Stores the response in functionResponse
                    if (functionResponse == "user"){
						window.location.replace("users.php");
					}
					else if (functionResponse == "admin"){
						window.location.replace("admin.php");
					} else {
						window.location.replace("index.php?e=" + functionName);
					}
                });
                var data = $.ajax({
                    url: 'login.php', 
                    dataType: "text", 
                    async: false
                }).responseText;
            });
        });
    </script>
</body>

</html>