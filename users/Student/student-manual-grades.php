<?php
    session_start();
    include "../../source/includes/config.php";

	$usertype = "Student";
    $username = $_SESSION['login_user'];
    $sql = "SELECT * usertype='Student' FROM tbluser";
    $result = mysqli_query($connection,$sql);

    $get_user = mysqli_query($connection,"SELECT * FROM tbluser WHERE email='$username'");
    while($getuser=mysqli_fetch_array($get_user))
    {
        $studentid = $getuser['id'];
        $firstname = $getuser['firstname'];
        $lastname = $getuser['lastname'];
        $fullname = ucfirst($firstname).' '.ucfirst($lastname);
        $Currid = $getuser['curri_id'];
		$collegeid = $getuser['college_id_fk'];
		$courseid = $getuser['course_id_fk'];
		$year = $getuser['yearlevel'];
		$section = $getuser['section'];
    }

	$get_image = mysqli_query($connection,"SELECT * FROM tblcollege WHERE id='$collegeid'");
	while($sa = mysqli_fetch_array($get_image))
	{
		$code = $sa['collegecode'];
		$seal = $sa['seal'];
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<!-- Wmsu-Icon -->
	<link rel="icon" href="../../source/assets/images/wmsulogo.png">
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- BOOTSTRAP -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css"/>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"/>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous" />
	<!-- OFFLINE BOOTSTRAP -->
	<link rel="stylesheet" href="../../source/bootstrap/bootstrap-4.6.1-dist/css/bootstrap.min.css" />
	<!-- fontawesome -->
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
	<!-- DATATABLE -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.0/css/dataTables.bootstrap4.min.css" /> 
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<!-- local css -->
    <link rel="stylesheet" href="../../source/css/style-student.css" />
    <title>Manual Input Grades</title>
</head>
<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top" id="navbar">
        <div class="container-fluid">
            <!-- COLLEGE LOGO/SEAL -->
			<a class="navbar-brand p-0 m-0" id="nav-logo" style="cursor: default;">
				<img class="rounded-circle p-0" src="../../source/upload/college_seal/<?php echo $seal?>" alt="ICS SEAL" width="32" height="32" />
				<span class="text-uppercase text-light">Online Pre-Advising</span>
			</a>

            <!-- MOBILE TOGGLE -->
			<button class="navbar-toggler m-0" type="button" data-toggle="collapse"data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span><i class="fas fa-bars"></i></span></button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <!-- Help -->
                    <li class="nav-item" data-toggle="tooltip" data-placement="bottom" title="Help">
                    <a id="icons" class="nav-link active py-0" href="#" data-toggle="modal" data-target="#help" aria-disabled="true"><i class="fas fa-question"></i><span class="nav-label"> Help</span></a>
                    </li>
                    <!-- logout -->
                    <li class="nav-item" data-toggle="tooltip" data-placement="bottom" title="Logout">
                        <a id="icons" class="nav-link active py-0" href="#" data-toggle="modal" data-target="#logoutmodal" aria-disabled="true"><i class="fas fa-sign-out-alt"></i><span class="nav-label"> Logout</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END OF NAVBAR -->

    <!-- CONTENT -->
    <div class="container container-fluid" id="desktop-view">
        <h2 class="text fw-bold text-center mt-4 text-danger" style="cursor: default;">Manual Input Grades</h2>
        <!-- <h4 class="text-center fw-light">via Manual Input</h4> -->

        <!-- Choices -->
        <div class="container container-fluid p-3 mt-2">
            <div class="row">
                <div class="row border mb-3">
                    <div class="col mt-2 mb-2">
                        <button type="button" class="btn btn-secondary fas fa-chevron-left p-2" onclick="history.back()"> Back</button>
                        <!--<span>Note: Search Your Grade by Year and Semester.</span>-->
                    </div>
                    <!--
                    <div class="col-sm-4 dropdown mt-3 mb-3" align="right">
                        <div id="select">
                            <select class="select text-center rounded" aria-label="Default select example">
                                <div id="ul-drop">
                                    <option selected>Year-Semesters</option>
                                    <option value="1">1st-1st Semester</option>
                                    <option value="2">1st-2nd Semester</option>
                                    <option value="3">2nd-1st Semester</option>
                                    <option value="2">2nd-2nd Semester</option>
                                    <option value="1">3rd-1st Semester</option>
                                    <option value="2">3rd-2nd Semester</option>
                                    <option value="1">4th-1st Semester</option>
                                    <option value="2">4th-2nd Semester</option>
                                    <option value="1">5th-1st Semester</option>
                                    <option value="2">5th-2nd Semester</option>
                                    <option value="1">Summer Semester</option>
                                </div>
                            </select>
                            <button type="button" name="search" class="btn btn-info fas fa-search text-white p-3"></button>
                        </div>
                    </div>-->

                    <div class="col mt-2 mb-2" align="right">
                        <a class="btn btn-info text-light fas fa-file p-2" href="#" data-toggle="modal" data-target="#sendGradesModal"> Send Grades</a>
                    </div>
                </div>

                <div class="row border">
                    <div class="mt-3 mb-3">
            <?php
                $check_sub = mysqli_query($connection,"SELECT * FROM tbladviser_send_sub_to_stud WHERE student_id_fk='$studentid' and curri_id_fk='$Currid'");
            ?>
                        <table class="table table-striped" id="table" width="100%">
                            <thead class="text-white">
                                <tr>
                                    <th hidden><center>id</center></th>
                                    <th><center>Subject Code</center></th>
                                    <th><center>Title</center></th>
                                    <th><center>Semester</center></th>
                                    <th><center>Grades</center></th>
                                    <th><center>Action</center></th>
                                </tr>
                            </thead>
                            <tbody>
            <?php
                if(mysqli_num_rows($check_sub) > 0)
                {
                    while($fa=mysqli_fetch_array($check_sub))
                    {
                        $SubjectiD = $fa['subject_id_fk'];
                        $Select_sub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$SubjectiD'");
                        while($su=mysqli_fetch_array($Select_sub))
                        {
                            $SubjectCode = $su['subject_code'];
                            $SubjectDes = $su['description'];
                        }
            ?>
                                <tr>
                                    <td hidden><center><?php echo $fa['id'] ?></center></td>
                                    <td><center><?php echo $SubjectCode ?></center></td>
                                    <td><center><?php echo $SubjectDes ?></center></td>
                                    <td><center><?php echo $fa['semester'] ?></center></td>
                                    <td><center><?php echo $fa['grades'] ?></center></td>
                                    <td><center><button style="font-size: 1.3rem;" title="Edit" class="fas fa-edit btn rounded btn-success editGradesbtn"></button>
                                    </center></td>
                                </tr>
            <?php
                    }
                }
            ?>
                            </tbody>
                            <tfoot >	
                                <!-- table footer -->
                            </tfoot>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
        <!-- Container of Choices END-->

    <!-- Send Grades -->
    <div class="modal fade" id="sendGradesModal" role="dialog" tabindex="-1" aria-labelledby="manage-subject" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="manage-curriculum">Send Grade</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                    <div class="modal-body">
                <form action="managedata.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="studentid" value="<?php echo $studentid?>">
                        <input type="hidden" name="currid" value="<?php echo $Currid?>">
                        <input type="hidden" name="collegeid" value="<?php echo $collegeid?>">
                        <input type="hidden" name="courseid" value="<?php echo $courseid?>">
                        <input type="hidden" name="yearlevel" value="<?php echo $year?>">

                        <div class="mb-3">
                            <label for="pdf">PDF Grades</label>
                            <input type="file" name="pdf-file" class="form-control-file border p-2" id="pdf" accept=".pdf" required>
                        </div>
                    </div>	

                    <div class="modal-footer" align="right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="send_grades" class="btn btn-success">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Send GRADES END -->

    <!-- Update Grades -->
    <div class="modal fade" id="editGradesModal" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="manage-subject" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="manage-curriculum">Input Grade</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                    <div class="modal-body">
                <form action="managedata.php" method="POST">
                        <input type="hidden" name="sub_send_id" id='sub_stud_id'> 
                        <!-- Grade -->		
						<div class="container p-0 mb-3" id="select-course">
							<label for="3rd_grade_1st" class="form-label" >Grade</label>
							<select name="grade" class="custom-select text-center p-2" required id="3rd_grade_1st">
								<option selected>Select Year Level</option>
								<option value="1.0">1.0</option>
								<option value="1.25">1.25</option>
                                <option value="1.50">1.50</option>
								<option value="1.75">1.75</option>
                                <option value="2.0">2.0</option>
								<option value="2.25">2.25</option>
                                <option value="2.50">2.50</option>
								<option value="2.75">2.75</option>
                                <option value="3.0">3.0</option>
                                <option value="5.0">5.0</option>
                                <option value="INC">INC</option>
                                <option value="DROP">DROP</option>
							</select>			
						</div>	
                    </div>	

                    <div class="modal-footer" align="right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="update_grades" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- UPDATE GRADES END -->

        <!-- HELP POPUP -->
        <div class="modal fade" id="help" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="exampleModalLabel">Help <p class="badge  bg-info rounded-circle">?</p></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <p>Download your grades from WMSU portal .<br> <br>
                            Not downloaded yet?<br>
                        <a href="#" onclick="site()">Check your grades from the WMSU Portal</a></p>
                    </div>

                    <script>
                        function site(){
                            window.open('http://wmsu.edu.ph/');
                        }
                    </script>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>     
                </div>
            </div>
        </div>
        <!-- HELP POPUP END -->

        <!-- User Logout MODAL-->
		<div class="container container-fluid">
        	<div class="modal fade" id="logoutmodal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            	<div class="modal-dialog">
                	<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Sign-out</h5></h5>
							<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
					</div>
                    <form action="../../source/includes/logout.php" method="POST">
                        <center>
                            <input type="hidden" name="id" id="deleteid" value="<?php echo $studentid?>">

                            <div class="modal-body">
                                Sign-out! 
                                Are you sure you want to Sign-out?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                <button type="submit" name="logout" class="btn btn-success">Yes</button>
                            </div>                     
                        </center>
                    </form>
                </div>
            </div>
        </div>
    	<!--END OF user logout MODAL-->
    </div>
    <!-- CONTENT END -->
        <!-- Option 2: Separate Popper and Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

		<!-- Datatables link -->    
		<script scr="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>    
		<script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>  
		<script src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap4.min.js"></script>
		<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
		<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap.min.js"></script>
		<?php
			include("../../source/includes/alertmessage.php");
		?>
    <script>
        $('#table').DataTable();

        $(document).ready(function() {
            $('body').on('click','.editGradesbtn',function() {
                $('#editGradesModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#sub_stud_id').val(data[0]);
            });
        });
    </script>
</body>
</html>