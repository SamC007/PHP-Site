<?php
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

    <title>Dashboard</title>

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
            <li class="nav-item active">
                <a class="nav-link" href="admin.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

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
                <li class="nav-item">
                    <a class="nav-link" href="users.php">
                        <span>User Dashboard</span>
                    </a>
					</li>
        </ul>
        <!-- End of Dashboard -->

        <!-- Content Wrapper -->
        <div class="container-fluid">
            <div id="content-wrapper" class="d-flex flex-column">
                <!-- Main Content -->
                <div id="content">
                    <br>
                    <div class="row">
                <div class="col-sm-11">
                <h3>Welcome to Admin!</h3> <!-- Welcome message :) -->
                        </div>
                        <div class="col-sm-1">
                            <br>
                            <button type="button" id="logoutbutton" class="btn btn-danger" data-toggle="modal" data-target="#LogoutModal"> <!-- Logout button -->
                                Logout
                            </button> <!-- The logout modal -->
                        </div>
                    <div class="col-sm-12">

                        <?php
        include_once("./_connect/_connect.php"); //This is just in case
        $query = "SELECT * FROM `t_users`"; //SELECT query to grab everything from t_users, as it will be shown now

        $dbquery = mysqli_query($db_connect, $query); //runs query
        ?>
                        <main role="main" class="container">
                            <table class="table table-striped table-responsive"> <!-- This is all the table code - all of this is to take everything I can from the database and display it here -->

                                <h3>User Accounts</h3>
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#exampleModalCenter">Add User</button>
                                <thead>
                                    <th>UID</th>
                                    <th>email</th>
                                    <th>access</th>
                                    <th>timestamp</th>
                                    <th>Login Counter</th>
                                    <th>Job Title</th>
                                    <th>Edit</th>
                                    <th>Reset Counter</th>
                                    <th>Delete</th>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($dbquery))
            {
            ?>
                                    <tr> <!-- PHP to echo the database code. The loop above means that it works for each person registered in the database -->
                                        <td><?php echo $row["UID"]?></td>
                                        <td><?php echo $row["email"]?></td>
                                        <td><?php echo $row["access"]?></td>
                                        <td><?php echo $row["timestamp"]?></td>
                                        <td><?php echo $row["login_counter"]?></td>
                                        <td><?php echo $row["Job_Title"] ?></td>
                                        <td><button type="button" class="btn btn-success"
                                                data-uid="<?php echo $row['UID']; ?>" data-toggle="modal"
                                                data-target="#EditModal">Edit</button></td> <!-- Button for the edit modal -->
                                        <td><button type="button" class="btn btn-primary"
                                                data-uid="<?php echo $row["UID"]; ?>" data-toggle="modal"
                                                data-target="#resetmodal">Reset</button> <!-- Button for the reset counter modal -->
                                        <td><button type="button" class="btn btn-danger"
                                                data-uid="<?php echo $row["UID"]?>" data-toggle="modal"
                                                data-target="#deletemodal">Delete</button></td> <!-- Button for the delete modal -->
                                    </tr>
                                    <?php
            }
            ?>
                                </tbody>
                            </table>
                    </div>
                </div>

                <!-- Add user modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Add User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <html>
                                <title>Registration</title>
                                <form action="addusers.php" method="post"> <!-- This form is for grabbing all the necessary info to add a user to the database -->

                                    <body>
                                        <label>Email:</label>
                                        <input name="email" placeholder="email" required>
                                        <br>
                                        <label>Password:</label>
                                        <input type="password" name="password" placeholder="password" required>
                                        <br>
                                        <label>Access:</label>
                                        <input name="access" placeholder="access">
                                        <br>
                                        <label>Job Title:</label>
                                        <input name=job_title placeholder="job title">
                                        <br>
                                        <button type="submit" class="btn btn-success">Register</button>
                                </form>
                            </div>
                        </div>
                    </div>
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
            </div>
                    <!-- End of Content Wrapper -->
    </div>
    </div>
    </div>
    
    
    <!-- End of Page Wrapper -->
        </div>
    </div>
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
                    <form method="POST" action="delete.php" id="DeleteForm"> <!-- This is to post the UID to delete.php so I can see who I am deleting -->
                        <label>Are you sure you want to delete this record?</label>
                        <input id="UID" name="UID" hidden>
                        <br>
                        <button class="w-100 btn btn-lg btn-danger" action="delete.php">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Reset modal -->
    <div class="modal" tabindex="-1" role="dialog" id="resetmodal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="h3 mb-3 fw-normal">Reset</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="reset_counter.php" id="ResetForm"> <!-- This posts the UID so I see which counter I am resetting -->
                        <label>Are you sure you want to reset the counter?</label>
                        <input id="UID" name="UID" hidden>
                        <br>
                        <button class="w-100 btn btn-lg btn-warning" action="reset_counter.php">Reset</button>
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
                    <form method="POST" action="edit.php" id="EditForm"> <!-- This form takes all the changes you could make and sends it to edit for it to update the database with -->
                        <label>UID:</label>
                        <input id="UID" name="UID" readonly="true">
                        <br>
                        <label>Email:</label>
                        <input name="email" placeholder="email" required>
                        <br>
                        <label>Password:</label>
                        <input type="password" name="password" placeholder="password" required>
                        <br>
                        <label>Access:</label>
                        <input name="access" placeholder="access">
                        <br>
                        <label>Job Title:</label>
                        <input name=job_title placeholder="job title">
                        <br>
                        <button class="w-100 btn btn-lg btn-success" type="submit">Edit</button>
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
                    <a type="button" class="btn btn-success" href="logout.php">Yes</a> <!-- This redirects to a php page where you it destroys the session. -->
                </div>
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
<script>
    $("#deletemodal").on("show.bs.modal", function (event) { //JavaScript for the delete modal.
        $("form").show();
        let button = $(event.relatedTarget)
        let modal = $(this)
        let UID = button.data("uid")
        modal.find(".modal-body #UID").val(UID)
    });
</script>
<script>
    $("#EditModal").on("show.bs.modal", function (event) { //JavaScript for the edit modal.
        $("form").show();
        let button = $(event.relatedTarget)
        let modal = $(this)
        let UID = button.data("uid")
        modal.find(".modal-body #UID").val(UID)
    });
</script>
<script>
    $("#resetmodal").on("show.bs.modal", function (event) {  //JavaScript for the reset modal.
        $("form").show();
        let button = $(event.relatedTarget)
        let modal = $(this)
        let UID = button.data("uid")
        modal.find(".modal-body #UID").val(UID)
    });
</script>
	<script> 
        $(document).ready(function () {
            $("#EditForm").on("submit", function (setFormData) {
                //prevent form from submitting
                setFormData.preventDefault();
                var formData = $(this).serialize();
                $.post("edit.php", formData, function (functionName) {
                    $("form").hide(); //Hides the form
                    var functionResponse = (functionName); //Stores the response in functionResponse
                    if (functionResponse == "admin"){ //If correct function response...
						window.location.replace("admin.php");
					} else {
						window.location.replace("index.php?e=" + functionName);
					}
                });
                var data = $.ajax({ //sets data, url, etc.
                    url: 'edit.php', 
                    dataType: "text", 
                    async: false
                }).responseText;
            });
        });
    </script>
	<script> 
        $(document).ready(function () {
            $("#DeleteForm").on("submit", function (setFormData) {
                //prevent form from submitting
                setFormData.preventDefault();
                var formData = $(this).serialize();
                $.post("delete.php", formData, function (functionName) {
                    $("form").hide(); //Hides the form
                    var functionResponse = (functionName); //Stores the response in functionResponse
                    if (functionResponse == "admin"){ //If correct function response...
						window.location.replace("admin.php");
					} else {
						window.location.replace("index.php?e=" + functionName);
					}
                });
                var data = $.ajax({ //sets data, url, etc.
                    url: 'delete.php', 
                    dataType: "text", 
                    async: false
                }).responseText;
            });
        });
    </script>
	<script> 
        $(document).ready(function () {
            $("#ResetForm").on("submit", function (setFormData) {
                //prevent form from submitting
                setFormData.preventDefault();
                var formData = $(this).serialize();
                $.post("reset_counter.php", formData, function (functionName) {
                    $("form").hide(); //Hides the form
                    var functionResponse = (functionName); //Stores the response in functionResponse
                    if (functionResponse == "admin"){ //If correct function response...
						window.location.replace("admin.php");
					} else {
						window.location.replace("index.php?e=" + functionName);
					}
                });
                var data = $.ajax({ //sets data, url, etc.
                    url: 'reset_counter.php', 
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