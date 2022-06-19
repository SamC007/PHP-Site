<?php
include_once("./_connect/_connect.php"); //connects to database
include_once("auth.php"); //Protects for if someone tries to connect to the page through the url directly
$query = "SELECT * FROM `t_courses` WHERE `t_courses`.`DATE` > CURRENT_DATE();"; //query for pulling courses that aren't out of date
$run = mysqli_query($db_connect, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Courses Page</title>

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
             if($_SESSION["auth"] == "admin") //if you're logged in as an admin
             {
             ?>
                 <li class="nav-item active">
                <a class="nav-link" href="admin.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <?php
             }
             ?>
             <?php if($_SESSION["auth"] == "user")
             { ?>
            <li class="nav-item">
            <a class="nav-link" href="users.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
            </li>
            <?php
            }
            ?>
            <?php
            if($_SESSION["auth"] == "admin") //This adds extra dashboard options if you're logged in as an admin
            {
            ?>
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
                    <?php } ?>
			
                <li class="nav-item active">
                    <a class="nav-link" href="courses.php">
                        <span>Enrol or leave a class</span>
                    </a>
					</li>
                    <?php if ($_SESSION["auth"] == "admin") //This option only appears if you're logged in as an admin
                    { ?>
                <li class="nav-item">
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
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#LogoutModal"> <!-- The logout button -->
                            Logout
                        </button>
                    </div>
                </div>
                <br>
                <div class="row">
                    <?php while ($row = mysqli_fetch_array($run)) //This loops until all courses are displayed
                {

                 ?>
                 <div class="col-sm-3">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary"><?php echo $row["TITLE"]; ?></h6> <!-- This add the title of courses into cards. -->
                            </div>
                            <div class="card-body">
                                <p><?php echo $row["DESCRIPTION"] ?></p> <!-- Here is the description of the courses -->
                                <?php 
                            $CID = $row["CID"];
                            $UID = $_SESSION["UID"];
                            //This query selects the UID from a course where there CID is equal to the CID selected.
                            $query2 = "SELECT `UID` FROM `t_link` WHERE `CID` = $CID";
                            $run2 = mysqli_query($db_connect, $query2);
                            $max_enrolled = mysqli_num_rows($run2);

                            $query3 = "SELECT * FROM `t_link` WHERE `t_link`.`UID` = $UID AND `t_link`.`CID` = $CID"; //This query selects only courses that users are enrolled in.
                            $run3 = mysqli_query($db_connect, $query3);
                            $enrolledornot = mysqli_num_rows($run3);
                            //This if statement is for checking if the user is enrolled in the course
                            if ($enrolledornot > 0) { ?>
                                <a class="btn btn-danger" data-uid2="<?php echo $UID; ?>"
                                    data-cid2="<?php echo $CID; ?>" data-toggle="modal" data-target="#leavemodal">Leave <!-- If you want to leave the course -->
                                    Course</a>
                                <?php } else
                            {
                                //This if statement is for checking if the course is full
                            if ($row["MAX_ATTENDEES"] == $max_enrolled) {
                                
                            ?>
                                <p class="btn btn-danger">COURSE FULL</p> <!-- This button only appears if the course is full and you are not enrolled on it. -->
                                <?php } else { 
                            ?>
                                <a class="btn btn-success " data-uid="<?php echo $UID; ?>"
                                    data-cid="<?php echo $CID; ?>" data-toggle="modal" 
                                    data-target="#enrolmodal">Enrol</a> <!-- This button is for if you are not enrolled in a course and the course is not full -->
                                <?php }} ?>
                                <?php 
                                echo $max_enrolled. "/". $row["MAX_ATTENDEES"]; //This statement shows how many people are enrolled in a course, compared to how many it can take


                                ?>
                            </div>
                        </div>
                    </div>
            <?php } ?>
            <!-- Begin Page Content -->
            <div class="container-fluid">
            </div>


        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->
                    <!-- Footer -->
                    <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Weston College 2021</span> <!-- This is the footer text -->
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Enrol modal -->
    <div class="modal" tabindex="-1" role="dialog" id="enrolmodal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="h3 mb-3 fw-normal">Enrol</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="formtwo" action="enrol.php"> <!-- This form is to gather the UID and CID, so I can use them later to see who is enrolling on what course -->
                        <label>Are you sure you want to enrol on this course?</label>
                        <input id="UID" name="UID" hidden>
                        <input id="CID" name="CID" hidden>
                        <br>
                        <button class="w-100 btn btn-lg btn-success" type="submit">Enrol</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Leave modal -->
    <div class="modal" tabindex="-1" role="dialog" id="leavemodal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="h3 mb-3 fw-normal">Leave Course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="leaveform" action="leave_course.php"> <!-- This form is for storing the UID & CID so I can use them later to see who is leaving what course -->
                        <label>Are you sure you want to leave this course?</label>
                        <input id="UID2" name="UID" hidden>
                        <input id="CID2" name="CID" hidden>
                        <br>
                        <button class="w-100 btn btn-lg btn-danger" type="submit">Leave Course</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Logout Modal-->
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
                        <a type="button" id="logoutbutton" class="btn btn-success" href="logout.php">Yes</a> <!-- This redirects to a php page where you it destroys the session. -->
                    </div>
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
        $("#leavemodal").on("show.bs.modal", function (event) { //JavaScript for the leave modal.
            $("form").show();
            let button = $(event.relatedTarget)
            let modal = $(this)
            let UID = button.data("uid2")
            let CID = button.data("cid2")
            modal.find(".modal-body #UID2").val(UID)
            modal.find(".modal-body #CID2").val(CID)
        });
    </script>
    <script>
        $("#enrolmodal").on("show.bs.modal", function (event) { //JavaScript for the enrol modal.
            $("formtwo").show();
            let button = $(event.relatedTarget)
            let modal = $(this)
            let UID = button.data("uid")
            let CID = button.data("cid")
            modal.find(".modal-body #UID").val(UID)
            modal.find(".modal-body #CID").val(CID)
        });
    </script>
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
	<script> 
        $(document).ready(function () {
            $("#formtwo").on("submit", function (setFormData) {
                //prevent form from submitting
                setFormData.preventDefault();
                var formData = $(this).serialize();
                $.post("enrol.php", formData, function (functionName) {
                    $("form").hide(); //Hides the form
                    var functionResponse = (functionName); //Stores the response in functionResponse
                    if (functionResponse == "admin"){ //If correct function response...
						window.location.replace("courses.php");
					} else {
						window.location.replace("index.php?e=" + functionName);
					}
                });
                var data = $.ajax({ //sets data, url, etc.
                    url: 'enrol.php', 
                    dataType: "text", 
                    async: false
                }).responseText;
            });
        });
	</script>
	<script> 
        $(document).ready(function () {
            $("#leaveform").on("submit", function (setFormData) {
                //prevent form from submitting
                setFormData.preventDefault();
                var formData = $(this).serialize();
                $.post("leave_course.php", formData, function (functionName) {
                    $("form").hide(); //Hides the form
                    var functionResponse = (functionName); //Stores the response in functionResponse
                    if (functionResponse == "admin"){
						window.location.replace("courses.php");
					} else {
						window.location.replace("index.php?e=" + functionName);
					}
                });
                var data = $.ajax({ //sets data, url, etc.
                    url: 'leave_course.php', 
                    dataType: "text", 
                    async: false
                }).responseText;
            });
        });
	</script>
	
</body>

</html>