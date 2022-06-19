<?php
include_once("./_connect/_connect.php"); //connects to database
include_once("auth.php"); //Protects for if someone tries to connect to the page through the url directly
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>User Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

   <!-- Admin Dashboard -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="min-width:100px">
            <?php
             if($_SESSION["auth"] == "admin")
             {
             ?>
            <li class="nav-item">
                <a class="nav-link" href="admin.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <?php
             }
             ?>
             <?php if($_SESSION["auth"] == "user")
             { ?>
            <li class="nav-item active">
            <a class="nav-link" href="users.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
            </li>
			<li class="nav-item">
            <a class="nav-link" href="courses.php">
               <span>Enrol or leave a class</span>
            </a>
			</li>
            <?php
            }
            ?>
            <?php
            if($_SESSION["auth"] == "admin")
            {
            ?>
			<!-- Heading -->
                <li class="nav-item">
                    <a class="nav-link" href="admin_courses.php">
                        <span>Courses</span>
                    </a>
				</li>

                    <!-- Heading -->
					<li class="nav-item">
                    <a class="nav-link" href="admin_usercourses.php">
                        <span>Users in courses</span>
                    </a>
					</li>

                <li class="nav-item">
                    <a class="nav-link" href="courses.php">
                        <span>Enrol or leave a class</span>
                    </a>
					</li>
                <li class="nav-item active">
                    <a class="nav-link" href="users.php">
                        <span>User Dashboard</span>
                    </a>
					</li>
                    <?php
                    }
                    ?>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
            <div class="row">
                    <div class="col-sm-11">
                    </div>
                    <div class="col-sm-1">
                        <br>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#LogoutModal">
                            Logout
                        </button>

                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-5">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary"></h6>
                            </div>
                            <div class="card-body">
                                <p>Welcome, User #<?php echo $_SESSION["UID"] ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary"></h6>
                            </div>
                            <div class="card-body">
                                <p>This is your dashboard</p>
                            </div>
                        </div>
                    </div>
                        <div class="col-2"></div>
                        <div class="col-8">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                            </div>
                            <div class="card-body text-center">
                                <img style="height:30vh; width:35vw;" src="./img/persian.jpg">
                            </div>
                        </div>
                        </div>
                </div>
            </div>
            <!-- Begin Page Content -->
            <div class="container-fluid">
            </div>
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Weston College 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
        <!-- Modal -->
        <div class="modal fade" id="LogoutModal" tabindex="-1" role="dialog" aria-labelledby="LogoutModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Do you want to log out?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    Do you want to log out?
                    </div>
                    <div class="modal-footer">
                        <a type="button" id="logoutbutton" class="btn btn-success" href="logout.php">Yes</a>
                    </div>
                </div>
            </div>
        </div>
</body>
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
		<script> //prevent logout button from redirecting
            $(document).on("click", "#logoutbutton", function(event) {
                setFormData.preventDefault();
                var formData = $(this).serialize();
                //posts information
                $.post("logout.php", formData, function (functionName)) {
                var functionResponse = (functionName); //stores response
                window.location.replace("index.php?e=" + functionResponse); //sets e in the URL
            });
                    var data = $.ajax({ //sets data, url, etc.
                        url: 'logout.php',
                        dataType: "text", 
                        async: false
                    }).responseText;
                });
		</script>

</html>