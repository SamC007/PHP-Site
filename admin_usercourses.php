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

    <title>Users and Courses</title>

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
            <li class="nav-item">
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
					<li class="nav-item active">
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
        include_once("./_connect/_connect.php");
        $query = "SELECT`t_link`.`ID`,`t_link`.`UID`,`t_link`.`CID`,`t_link`.`TIMESTAMP`,`t_users`.`UID`,`t_users`.`email`,`t_courses`.`CID`,`t_courses`.`TITLE`
         FROM `t_link` LEFT JOIN `t_users` ON `t_link`.`UID` = `t_users`.`UID` LEFT JOIN `t_courses` ON `t_link`.`CID` = `t_courses`.`CID`"; //LEFT JOIN query
         //Complex query to join UID, CID, email & TITLE together so the database is more comprehensible for admins.

        $dbquery = mysqli_query($db_connect, $query);
        ?>
                        <main role="main" class="container">
                            <table class="table table-striped table-responsive">

                                <h1>Users in a course:</h1>
                                <thead> <!-- This is all the table code - all of this is to take everything I can from the database and display it here -->
                                    <th>ID</th>
                                    <th>UID</th>
                                    <th>Email</th>
                                    <th>Title</th>
                                    <th>CID</th>
                                    <th>Timestamp</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($dbquery))
            {
            ?>
                                    <tr> <!-- PHP to echo the database code. The loop above means that it works for each person registered in the database -->
                                        <td><?php echo $row["ID"]?></td>
                                        <td><?php echo $row["UID"]?></td>
                                        <td><?php echo $row["email"]?></td>
                                        <td><?php echo $row["TITLE"]?></td>
                                        <td><?php echo $row["CID"]?></td>
                                        <td><?php echo $row["TIMESTAMP"]?></td>
                                        <td><button type="button" class="btn btn-success"
                                                data-id="<?php echo $row['ID']; ?>"
                                                data-cid="<?php echo $row['CID']; ?>"
                                                data-uid="<?php echo $row['UID']; ?>"
                                                data-title="<?php echo $row['TITLE']; ?>"
                                                data-email="<?php echo $row['email']; ?>" data-toggle="modal"
                                                data-target="#EditModal">Edit</button></td>
                                        <td><button type="button" class="btn btn-danger"
                                                data-id="<?php echo $row['ID']; ?>"
                                                data-cid="<?php echo $row["CID"];?>"
                                                data-uid="<?php echo $row['UID'] ?>" data-toggle="modal"
                                                data-target="#deletemodal">Delete</button></td>
                                    </tr>
                                    <?php
            }
            ?>
                                </tbody>
                            </table>
                    </div>
                </div>
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
                <form method="POST" id="DeleteForm" action="delete_usercourse.php"> <!-- This is to post the ID to delete.php so I can see what I am deleting -->
                    <label>Are you sure you want to delete this?</label>
                    <input id="ID" name="ID" hidden>
                    <button class="w-100 btn btn-lg btn-danger" type="submit">Delete</button>
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
                <form method="POST" id="EditForm" action="edit_usercourses.php"> <!-- This posts the ID, CID & UID so I see what I am editing -->
                    <input id="ID" name="ID" hidden>
                    <label>Course Title:</label>
                    <input id="title" name="title" readonly="true">
                    <br>
                    <label>CID:</label>
                    <input id="CID" name="CID">
                    <br>
                    <label>Email:</label>
                    <input id="email" name="email" readonly="true">
                    <br>
                    <label>UID:</label>
                    <input id="UID" name="UID">
                    <br>
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
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Click "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
            <a type="button" class="btn btn-success" id="logoutbutton" href="logout.php">Yes</a> <!-- This redirects to a php page where you it destroys the session. -->
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
        let ID = button.data("id")
        modal.find(".modal-body #ID").val(ID)
    });
</script>
<script>
    $("#EditModal").on("show.bs.modal", function (event) { //JavaScript for the edit modal
        $("form").show();
        let button = $(event.relatedTarget)
        let modal = $(this)
        let CID = button.data("cid")
        let UID = button.data("uid")
        let title = button.data("title")
        let email = button.data("email")
        let ID = button.data("id")
        modal.find(".modal-body #CID").val(CID)
        modal.find(".modal-body #UID").val(UID)
        modal.find(".modal-body #title").val(title)
        modal.find(".modal-body #email").val(email)
        modal.find(".modal-body #ID").val(ID)
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
            $("#EditForm").on("submit", function (setFormData) {
                //prevent form from submitting
                setFormData.preventDefault();
                var formData = $(this).serialize();
                $.post("edit_usercourses.php", formData, function (functionName) {
                    $("form").hide(); //Hides the form
                    var functionResponse = (functionName); //Stores the response in functionResponse
                    if (functionResponse == "admin"){ //If correct function response...
						window.location.replace("admin_usercourses.php");
					} else {
						window.location.replace("index.php?e=" + functionName);
					}
                });
                var data = $.ajax({ //sets data, url, etc.
                    url: 'edit_usercourses.php', 
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
                $.post("delete_usercourse.php", formData, function (functionName) {
                    $("form").hide(); //Hides the form
                    var functionResponse = (functionName); //Stores the response in functionResponse
                    if (functionResponse == "admin"){ //If correct function response...
						window.location.replace("admin_usercourses.php");
					} else {
						window.location.replace("index.php?e=" + functionName);
					}
                });
                var data = $.ajax({ //sets data, url, etc.
                    url: 'delete_usercourse.php', 
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
                    var data = $.ajax({  //sets data, url, etc.
                        url: 'logout.php',
                        dataType: "text", 
                        async: false
                    }).responseText;
                });
</script>
</body>

</html>