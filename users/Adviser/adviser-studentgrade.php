<?php
    session_start();
    include "../../source/includes/config.php";

	$usertype = "Adviser";
    $username = $_SESSION['login_user'];
    $sql = "SELECT * usertype='Adviser' FROM tbluser";
    $result = mysqli_query($connection,$sql);

    $get_user = mysqli_query($connection,"SELECT * FROM tbluser WHERE email='$username'");
    while($getuser=mysqli_fetch_array($get_user))
    {
        $adminid = $getuser['id'];
        $firstname = $getuser['firstname'];
        $lastname = $getuser['lastname'];
        $full = ucfirst($firstname).' '.ucfirst($lastname);
		$collegeid = $getuser['college_id_fk'];
		$courseid = $getuser['course_id_fk'];
		$year = $getuser['yearlevel'];
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
		<link rel="stylesheet" href="../../source/css/style-adviser.css" />
		<title>Home</title>
	</head>

	<body>
		<div class="mobile">
			<h1>📴</h1>
			<h2>Unavailable for Mobile Device..</h2>
			<h3></h3>
		</div>
		<div class="desktop ">
		<!-- NAVBAR -->
		<nav class="navbar navbar-expand-lg navbar-dark" id="navbar">
			<div class="container-fluid">
				<!-- ICS LOGO -->
				<a class="navbar-brand p-0 m-0" href="adviser-homepage.php" id="nav-logo">
					<img class="rounded-circle p-0" src="../../source/upload/college_seal/<?php echo $seal?>" alt="ICS SEAL" width="32" height="32" />
					<span class="text-uppercase">Online Pre-Advising</span>
				</a>

				<!-- MOBILE TOGGLE -->
				<button class="navbar-toggler m-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span><i class="fas fa-bars"></i></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav">
						<!-- Home -->
						<li class="nav-item">
							<a class="nav-link active py-0" aria-current="page" href="adviser-homepage.php"><i id="icons" class="fas fa-home"></i><span class="nav-label"> Home</span></a>
						</li>
						<!-- Profile -->
						<li class="nav-item">
							<a class="nav-link active py-0" aria-current="page" href="adviser-profile.php"><i id="icons" class="fas fa-user-tie"></i><span class="nav-label"> My Profile</span></a>
						</li>
						<!-- notifications -->
						<li class="nav-item dropstart">
							<?php
								$check_stud_req = "SELECT count(id) FROM tblrequest_account WHERE req_usertype='Student' and course_id_fk='$courseid' and yearlevel='$year'";
								$stud_check = mysqli_query($connection,$check_stud_req);
								$stud_total = mysqli_fetch_array($stud_check);
								$stud_row = $stud_total[0];

								$check_stud_grade = "SELECT count(id) FROM tblstudent_pdf WHERE submission_status='Pending' and yearlevel='$year'";
								$grade_check = mysqli_query($connection,$check_stud_grade);
								$grade_total = mysqli_fetch_array($grade_check);
								$grade_row = $grade_total[0];

								$total_noti = $stud_row + $grade_row;
							?>
							<a class="nav-link dropstart active py-0" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false"> <i id="icons" class="fas fa-bell"></i><span class="badge rounded-pill bg-info text-white align-text-top" id="notif-number"><?php echo $total_noti ?></span><span class="nav-label"> Notifications</span> </a>
							<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
								<li>
								<?php
									if($stud_row == 0){
										echo '<a class="dropdown-item" href="#">
											<span class="badge bg-success">Account</span>
											<span class="font-weight-bold" aria-disabled="true">
											There is no Request </a>';	
									}
									else
									{
										$notif_num = mysqli_query($connection,"SELECT * FROM tblrequest_account WHERE req_usertype='Student' and course_id_fk='$courseid' and yearlevel='$year'");
										echo'<a data-toggle="modal" data-target="#manage-request" class="dropdown-item" href="#">
											<span class="badge bg-success">Account</span>
											<span class="font-weight-bold" aria-disabled="true">';
											$notif_count = mysqli_num_rows($notif_num);	
										echo 'REQUEST ACCOUNT '.$notif_count;	
											while($fa=mysqli_fetch_array($notif_num))
											{
												$req_tudent_id = $fa['id'];
											}
										echo'</a>';
									}
								?>
								</li>
								<li>
								<?php 
									$check_stud_grade = mysqli_query($connection,"SELECT * FROM tblstudent_pdf WHERE submission_status='Pending' and yearlevel='$year'");
									if(mysqli_num_rows($check_stud_grade) > 0)
									{
								?>
									<a class="dropdown-item" href="adviser-studentgrade.php">
										<span class="badge bg-primary">Grade</span>
										<span class="text fw-bold">Students</span> Submitted their grade
									</a>
								<?php		
									}
									else
									{
								?>
									<a class="dropdown-item" href="#">
										<span class="badge bg-primary">Grade</span>
										<span class="text fw-bold">No Grade been Submitted</span>
									</a>
								<?php
									}
								?>
								</li>
								<!-- <li><hr class="dropdown-divider" /></li> -->
								
							</ul>
						</li>
						<!-- logout -->
						<li class="nav-item">
							<a id="icons" class="nav-link active py-0" href="#" data-toggle="modal" data-target="#logoutmodal" aria-disabled="true"><i class="fas fa-sign-out-alt"></i><span class="nav-label"> Logout</span></a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- END OF NAVBAR -->

		<!-- CONTENT -->
		<div class="container mt-5" >
			<p class="text  mt-3 text-danger fw-bold text-center fs-2" style="cursor: default;">ICS Student Grade Lists</p>
		</div>
	
		<!-- TABLE -->
		<div class="container p-2 container-fluid mt-2 mb-3" >
			<div class="container overflow-auto" >
		<?php
			$get_stu = mysqli_query($connection,"SELECT * FROM tblstudent_pdf WHERE course_id_fk='$courseid' and yearlevel='$year'");
		?>
                <table class="table table-striped" id="table">
                    <thead class="text-white">
                        <tr>
                            <th hidden><center>ID</center></th>
							<th hidden><center>Student ID</center></th>
							<th hidden><center>Curri ID</center></th>
                            <th><center>Firstname</center></th>
							<th><center>Lastname</center></th>
                            <th><center>Course</center></th>
                            <th><center>Year Level</center></th>
							<th><center>Action</center></th>
                        </tr>
                    </thead>
                    <tbody>
		<?php
			if(mysqli_num_rows($get_stu) > 0)
			{
				while($fa=mysqli_fetch_array($get_stu))
				{
					$studentid = $fa['student_id_fk'];
					$StudCurri = $fa['curri_id_fk'];
					#$_SESSION['student_id_fk'] = $Studid; 
					#$_SESSION['curri_id_fk'] = $CurriID;
					$Stud_join = $studentid.'-'.$StudCurri;

					$get_stud = mysqli_query($connection,"SELECT * FROM tbluser WHERE id='$studentid'");
					while($sa=mysqli_fetch_array($get_stud))
					{
						$Firstname = ucfirst($sa['firstname']);
						$Lastname = ucfirst($sa['lastname']);
						$Yearlvl = $sa['yearlevel'];
						$Courseid = $sa['course_id_fk'];
					}

					$get_course = mysqli_query($connection,"SELECT * FROM tblcourse WHERE id='$Courseid'");
					while($co=mysqli_fetch_array($get_course))
					{
						$Course_code = $co['coursecode'];
					}
		?>
						<tr>
							<td hidden><center><?php echo $fa['id'] ?></center></td>
							<td hidden><center><?php echo $studentid ?></center></td>
							<td hidden><center><?php echo $StudCurri ?></center></td>
                            <td><center><?php echo $Firstname ?></center></td>
							<td><center><?php echo $Lastname ?></center></td>
                            <td><center><?php echo $Course_code ?></center></td>
                            <td><center><?php echo $Yearlvl ?></center></td>
                            <td><center><button style="font-size: 1.3rem;" title="Edit" class="fas fa-edit btn rounded btn-success editAdviserbtn"></button>
                                <button style="font-size: 1.3rem;" title="Delete" class="fas fa-trash-alt btn rounded btn-danger deleteAdviserbtn"></button>
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

		<!-- For Adviser Accounts -->
    <!-- ADD NEW Adviser POPUP -->
    <div class="container container-fluid">
        <div class="modal fade" id="addAdviserModal" tabindex="-1" role="dialog" aria-labelledby="addDepLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="addDepLabel">Add New Adviser</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                        <div class="modal-body">
                    <form>
                        <!-- Inputs -->
                            <div class="mb-3">
								<label for="input-name" class="form-label">Name</label>
								<input type="text" class="form-control" id="input-name" aria-describedby="input-name-help" required>
								<!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
							</div>

							<div class="mb-3">
								<label for="input-id" class="form-label">Adviser ID</label>
								<input type="text" class="form-control" id="input-id" required>
							</div>

							<div class="mb-3">
								<label for="input-pass" class="form-label">Password</label>
								<input type="password" class="form-control" id="input-pass" required>
							</div>
							
							<div class="mb-3">
								<label for="input-pass2" class="form-label">Confirm Password</label>
								<input type="password" class="form-control" id="input-pass2" required>
							</div>

                            <div class="mb-3">
								<label for="input-contact" class="form-label">Contact</label>
								<input type="number" class="form-control" id="input-contact" required>
							</div>


							<!-- Deapartment -->		
							<div class="container p-0 mb-3" id="select-college">
								<label for="select-college" class="form-label" >Assigned To</label>
								<select class="custom-select p-2 " id="select-college" required>
									<option selected>Select College Department...</option>

                                    <!-- INSERT DATABASE HERE BELOW FOR COLLEGES -->
                                    <option value="1">ICS</option>
                                    <option value="2">CLA</option>
                                
								</select>			
							</div>		
                        </div>

                        <div class="modal-footer" align="right">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ADD NEW adviser END -->

    <!-- DELETE All Adviser MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteAllAdviserModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete All Adviser</h5></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="" method="POST">
                        <center>
                            <div class="modal-body">
                                All data will be deleted! 
                                Are you sure you want to delete All Adviser?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                <button type="submit" name="delete_all_user" class="btn btn-success">Yes</button>
                            </div>                     
                        </center>
                    </form>
                </div>
            </div>
        </div>
	</div>
    <!--END OF DELETE All Adviser Modal -->

	<!-- Session MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="editAdviserModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Instruction Modal</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="" method="POST">
                        <center>
                            <div class="modal-body">
								<input type="text" name="studid" id="userid">
								<input type="text" name="curiid" id="currid">
                                Approved and Disapproved A student Grade! 
                                If theres any problem with the Grade of student you can send them your concern note.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                <button type="submit" name="instruc" class="btn btn-success">Yes</button>
                            </div>                     
                        </center>
                    </form>
                </div>
            </div>
        </div>
	</div>
    <!-- Session Modal -->

	<?php
		if(isset($_POST['instruc']))
		{
			$Stuid = $_POST['studid'];
			$Curid = $_POST['curiid'];
			$_SESSION['studentid'] = $Stuid;
			$_SESSION['currid'] = $Curid;
		}
	?>

    <!-- COLLEGE MANAGE -->
    <div class="modal fade" id="checkStudentModal" tabindex="-1" aria-labelledby="manage-curriculum" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document" style="max-width: 1260px;">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="manage-curriculum">View Student Grades</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                <form action="" method="POST">
                    <!-- Inputs -->
					
				<?php
					echo $StudID = $_SESSION['studentid'];
					echo $StudCuri = $_SESSION['currid'];
				?>
					<div class="container border-top border-bottom mt-2">
						<div class="row mt-2 mb-2">
						<?php
							$select_studid = mysqli_query($connection,"SELECT * FROM tblstudent_grade_sub WHERE student_id_fk='$StudID' and curri_id_fk='$StudCuri'");
							$get_pdf = mysqli_query($connection,"SELECT * FROM tblstudent_pdf WHERE student_id_fk='$StudID' and curri_id_fk='$StudCuri'");
							while($p=mysqli_fetch_array($get_pdf))
							{
								$PDF = $p['pdf_grade'];
							}
						?>
						<div class="mb-3" align="right">
							<a class="btn btn-secondary text-light fas fa-file" id="pdf" onclick="window.open('../../source/upload/grade_files/<?php echo $PDF ?>')"> Student PDF Grade</a>
							<!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
						</div>
							<table class="table table-striped" id="table-view" width="100%">
								<thead class="text-white">
									<tr>
										<th hidden><center>id</center></th>
										<th><center>Subject Code</center></th>
										<th><center>Title</center></th>
										<th><center>Semester</center></th>
										<th><center>Grades</center></th>
									</tr>
								</thead>
								<tbody>
						<?php
							if(mysqli_num_rows($select_studid) > 0)
							{
								while($op=mysqli_fetch_array($select_studid))
								{
									$SubID = $op['subject_id_fk'];
									$Grade = $op['grades'];

									$select_Sub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$SubID'");
									while($u=mysqli_fetch_array($select_Sub))
									{
										$SubCode = $u['subject_code'];
										$SubDes = $u['description'];
										$SubSem = $u['semester'];
									}
						?>
									<tr>
										<td hidden><center><?php echo $op['id'] ?></center></td>
										<td><center><?php echo $SubCode ?></center></td>
										<td><center><?php echo $SubDes ?></center></td>
										<td><center><?php echo $SubSem ?></center></td>
										<td><center><?php echo $Grade ?></center></td>
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

                <div class="modal-footer" align="right">
                    <button type="submit" name="disapproved" class="btn btn-danger">Disapproved</button>
                    <button type="submit" name="approved" class="btn btn-success">Approved</button>
                </div>
                </form>    
            </div>
        </div>
    </div>
    <!-- MANAGE COLLEGE END -->

    <!-- DELETE Adviser MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteAdviserModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Delete This Adviser</h5></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="" method="POST">
                        <center>
                            <input type="hidden" name="id" id="deleteid">

                            <div class="modal-body">
                                All data will be deleted! 
                                Are you sure you want to delete this Adviser?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                <button type="submit" name="delete_user" class="btn btn-success">Yes</button>
                            </div>                     
                        </center>
                    </form>
                </div>
            </div>
        </div>
    <!--END OF DELETE Adviser MODAL-->
    <!-- End of Adviser Accounts -->

		<!-- REQUEST POPUP -->
		<div class="container container-fluid">
			<div class="modal fade" id="manage-request" tabindex="-1" aria-labelledby="manage-requestLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-scrollable" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title fw-bold" id="manage-requestLabel">Student Account Request</h5>
							<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
						</div>
					<?php
						$get_req_stud = mysqli_query($connection,"SELECT * FROM tblrequest_account WHERE id='$req_tudent_id'");
						while($sa=mysqli_fetch_array($get_req_stud))
						{
							$student_id = $sa['id'];
							$student_first = $sa['firstname'];
							$student_last = $sa['lastname'];
							$student_email = $sa['email'];
							$student_password = $sa['password'];
							$student_type = $sa['req_usertype'];
							$student_contact = $sa['contact'];
							$student_year = $sa['yearlevel'];
							$student_sec = $sa['section'];
							$student_colid = $sa['college_id_fk'];
							$student_courseid = $sa['course_id_fk'];

							$row = explode("@",$student_email,"2");
							$student_ID = $row[0];

							$select_course = mysqli_query($connection,"SELECT * FROM tblcourse WHERE id='$student_courseid'");
							while($co=mysqli_fetch_array($select_course))
							{
								$CourseCode = $co['coursecode'];
							}

							$Full_course = $CourseCode.' '.$student_year.''.$student_sec;
						}
					?>
						<div class="modal-body">
							<!-- Inputs -->
							<form action="managedata.php" method="POST">
								<input type="hidden" name="student_id" value="<?php echo $student_id ?>">

								<div class="mb-3">
									<label for="student_curri">Curriculum</label>
									<select name="currid" class="form-control text-center" id="student-curri">
										<option value="0" selected>Select Curriculum</option>
										<?php 
											$select_curri = mysqli_query($connection,"SELECT * FROM tblcurriculum WHERE college_id_fk='$collegeid' and course_id_fk='$courseid'");
											if(mysqli_num_rows($select_curri))
											{
												while($cu=mysqli_fetch_array($select_curri))
												{
										?>
												<option value="<?php echo $cu['id'] ?>"><?php echo $cu['curr_code']?></option>
										<?php

												}
											}
											else
											{
												echo "No Records Found!!";
											}
										?>
									</select>
								</div>

								<div class="mb-3">
									<label for="input-name" class="form-label">Full Name</label>
									<input type="text" class="form-control text-center" id="input-name" aria-describedby="input-name-help" value="<?php echo ucfirst($student_first).' '.ucfirst($student_last)?>" readonly>
									<!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
								</div>
	
								<div class="mb-3">
									<label for="input-id" class="form-label">Student ID</label>
									<input type="text" class="form-control text-center" id="input-id" value="<?php echo $student_ID?>" readonly>
								</div>

								<div class="mb-3">
									<label for="input-email" class="form-label">Email</label>
									<input type="email" class="form-control text-center" id="input-email" value="<?php echo $student_email ?>" readonly>
								</div>

								<div class="mb-3">
									<label for="input-advised" class="form-label">Course and Year</label>
									<input type="text" class="form-control text-center" id="input-advised" value="<?php echo $Full_course ?>" readonly>
								</div>
							</div>
	
							<div class="modal-footer" align="right">
								<button type="submit" name="disapproved" class="btn btn-danger">Disapproved</button>
								<button type="submit" name="approved" class="btn btn-success">Approve</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- REQUEST END -->

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
                            <input type="hidden" name="id" id="deleteid" value="<?php echo $adminid?>">

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

		<!-- CONTENET END -->
	</div>

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
			$('#table-view').DataTable();

			$('#addAdviser').on('click', function() {
				$('#addAdviserModal').modal('show');
			});

			$('#deleteAllAdviser').on('click', function() {
				$('#deleteAllAdviserModal').modal('show');
			});

			$(document).ready(function() {
			$('body').on('click','.editAdviserbtn',function() {
				$('#editAdviserModal').modal('show');

				$tr = $(this).closest('tr');

				var data = $tr.children('td').map(function() {
					return $(this).text();
				}).get();

				console.log(data);

				$('#userid').val(data[1]);
				$('#currid').val(data[2]);
			});
			});

			$(document).ready(function() {
			$('body').on('click','.deleteAdviserbtn',function() {
				$('#deleteAdviserModal').modal('show');

				$tr = $(this).closest('tr');

				var data = $tr.children('td').map(function() {
					return $(this).text();
				}).get();

				console.log(data);
				$('#deleteid').val(data[0]);
			});
			});
		</script>
	</body>
</html>
