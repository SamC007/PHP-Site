<?php
ini_set('display_errors', '1');
include_once("./_connect/_connect.php"); //connects to database
include_once("adminauth.php"); //Protects for if someone tries to connect to the page through the url directly
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Courses</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Admin Dashboard -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="min-width:100px">
            <li class="nav-item">
                <a class="nav-link" href="admin.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Heading -->
                <li class="nav-item active">
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
                <li class="nav-item">
                    <a class="nav-link" href="users.php">
                        <span>User Dashboard</span>
                    </a>
					</li>
        </ul>
        <!-- End of Dashboard -->


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <br>
                <div class="row">
                <div class="col-sm-11">
                        </div>
                        <div class="col-sm-1">
                            <br>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#LogoutModal">
                                Logout
                            </button> <!-- The logout modal -->
                        </div>
                    <div class="col-sm-12">
                        <?php
        include_once("./_connect/_connect.php"); //This is just in case
        $query = "SELECT * FROM `t_courses`"; //SELECT query to grab everything from t_courses, as it will be shown now

        $dbquery = mysqli_query($db_connect, $query);
        ?>
                        <main role="main" class="container">
                            <table class="table table-striped table-responsive">

                                <h1>Courses: <button type="button" class="btn btn-success" data-toggle="modal"
                                        data-target="#exampleModalCenter">Add Course </h1> 

                                <thead> <!-- This is all the table code - all of this is to take everything I can from the database and display it here -->
                                    <th>CID</th>
                                    <th>title</th>
                                    <th>date</th>
                                    <th>duration</th>
                                    <th>max attendees</th>
                                    <th>description</th>
                                    <th>timestamp</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($dbquery))
            {
            ?><!-- PHP to echo the database code. The loop above means that it works for each course registered in the database -->
                                    <tr>
                                        <td><?php echo $row["CID"]?></td>
                                        <td><?php echo $row["TITLE"]?></td>
                                        <td><?php echo $row["DATE"]?></td>
                                        <td><?php echo $row["DURATION"]?></td>
                                        <td><?php echo $row["MAX_ATTENDEES"]?></td>
                                        <td><?php echo $row["DESCRIPTION"]?></td>
                                        <td><?php echo $row["TIMESTMAP"]?></td>
                                        <td><button type="button" class="btn btn-success"
                                                data-cid="<?php echo $row['CID']; ?>" data-toggle="modal"
                                                data-target="#EditModal">Edit</button></td> <!-- Button for the edit modal -->
                                        <td><button type="button" class="btn btn-danger"
                                                data-cid="<?php echo $row["CID"];?>" data-toggle="modal"
                                                data-target="#deletemodal">Delete</button></td> <!-- Button for the delete modal -->
                                    </tr>
                                    <?php
            }
            ?>
                                </tbody>
                            </table>
                            
                    </div>
                </div>
                <!--Add a course modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Add a course</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <html>
                                <title>Add a course</title>
                                <form action="addcourses.php" method="post"> <!-- This form is for grabbing all the necessary info to add a course to the database -->
                                    <input type="text" name="CID" value="<?php echo $cid ?>" readonly hidden>
                                    <br>
                                    <input type="text" name="TITLE" placeholder="title" required>
                                    <br>
                                    <input type="date" name="DATE" required>
                                    <br>
                                    <input type="text" name="DURATION" placeholder="duration" required>
                                    <br>
                                    <input type="text" name="MAX_ATTENDEES" placeholder="max attendees" required>
                                    <br>
                                    <input type="text" name="DESCRIPTION" placeholder="description" required>
                                    <br>
                                    <button type="submit" class="w-100 btn btn-success">Add Course</button>
                                </form>
</body>
</div>
</div>
</div>
</div>
<!-- Modal -->
<!-- Begin Page Content -->
<div class="container-fluid">
</div>


</div>
<!-- End of Content Wrapper -->
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
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Delete modal -->
<div class="modal" tabindex="-1" role="dialog" id="deletemodal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="h3 mb-3 fw-normal">Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="delete_course.php" id="DeleteForm"> <!-- This is to post the UID to delete_course.php so I can see what course I am deleting -->
                    <label>Are you sure you want to delete this course?</label>
                    <input id="CID" name="CID" hidden>
                    <br>
                    <button class="w-100 btn btn-lg btn-danger" action="delete_course.php">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit modal -->
<div class="modal" tabindex="-1" role="dialog" id="EditModal" aria-labelledby="LabelEditModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="h3 mb-3 fw-normal">Edit</h5>
            </div>
            <div class="modal-body">
                <form method="POST" action="edit_course.php" id="EditForm"> <!-- This form takes all the changes you could make and sends it to edit for it to update the database with -->
                    <label>CID:</label> 
                    <input id="CID" name="CID" readonly="true">
                    <br>
                    <label>Course Title:</label>
                    <input name="course" placeholder="text" required>
                    <br>
                    <label>Date:</label>
                    <input type="date" name="date" required>
                    <br>
                    <label>Duration:</label>
                    <input name="duration" placeholder="duration">
                    <br>
                    <label>Max attendees:</label>
                    <input name="max_attendees" placeholder="max attendees">
                    <br>
                    <label>Description: </label>
                    <input name="description" placeholder="description">
                    <button class="w-100 btn btn-lg btn-success" type="submit">Edit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Logout Modal-->
<div class="modal fade" id="LogoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModallabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
            <div class="modal-body">Click "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
            <a type="button" class="btn btn-success" href="logout.php" id="logoutbutton">Yes</a> <!-- This redirects to a php page where you it destroys the session. -->
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
    $("#deletemodal").on("show.bs.modal", function (event) { //JavaScript for the delete modal
        $("form").show();
        let button = $(event.relatedTarget)
        let modal = $(this)
        let CID = button.data("cid")
        modal.find(".modal-body #CID").val(CID)
    });
</script>
<script>
    $("#EditModal").on("show.bs.modal", function (event) { //JavaScript for the delete modal
        $("form").show();
        let button = $(event.relatedTarget)
        let modal = $(this)
        let CID = button.data("cid")
        modal.find(".modal-body #CID").val(CID)
    });
</script>
<script> 
        $(document).ready(function () {
            $("#DeleteForm").on("submit", function (setFormData) {
                //prevent form from submitting
                setFormData.preventDefault();
                var formData = $(this).serialize();
                $.post("delete_course.php", formData, function (functionName) {
                    $("form").hide(); //Hides the form
                    var functionResponse = (functionName); //Stores the response in functionResponse
                    if (functionResponse == "admin"){
						window.location.replace("admin_courses.php");
					} else {
						window.location.replace("index.php?e=" + functionName);
					}
                });
                var data = $.ajax({
                    url: 'delete_course.php', 
                    dataType: "text", 
                    async: false
                }).responseText;
            });
        });
</script>
	<script> 
        $(document).ready(function () {
            $("#EditForm").on("submit", function (setFormData) {
                //prevent form from submitting
                setFormData.preventDefault();
                var formData = $(this).serialize();
                $.post("edit_course.php", formData, function (functionName) {
                    $("form").hide(); //Hides the form
                    var functionResponse = (functionName); //Stores the response in functionResponse
                    if (functionResponse == "admin"){
						window.location.replace("admin_courses.php");
					} else {
						window.location.replace("index.php?e=" + functionName);
					}
                });
                var data = $.ajax({
                    url: 'edit_course.php', 
                    dataType: "text", 
                    async: false
                }).responseText;
            });
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
</body>

</html>