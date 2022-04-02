<?php
    require("../../source/includes/config.php");
    require_once("../../source/includes/checksession.php");
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
		<link rel="stylesheet" href="../../source/preloader/loader.css" />
		<title>Student Lists</title>
	</head>
	<body onmousemove="reset_interval()" onclick="reset_interval()" onkeypress="reset_interval()" onscroll="reset_interval()">
<?php
    if(isset($_SESSION['login_user']))
    {
			$_SESSION['last_login_time'] = time();
            $usertype = "Adviser";
            $username = $_SESSION['login_user'];
            $sql = "SELECT * usertype='Adviser' FROM tbluser";
            $result = mysqli_query($connection,$sql);
        
            $get_user = mysqli_query($connection,"SELECT * FROM tbluser WHERE email='$username'");
            while($getuser=mysqli_fetch_array($get_user))
            {
                $adviserid = $getuser['id'];
                $firstname = $getuser['firstname'];
                $lastname = $getuser['lastname'];
                $email = $getuser['email'];
                $password = $getuser['password'];
                $full = ucfirst($firstname).' '.ucfirst($lastname);
                $collegeid = $getuser['college_id_fk'];
                $courseid = $getuser['course_id_fk'];
            }
        
            $get_image = mysqli_query($connection,"SELECT * FROM tblcollege WHERE id='$collegeid'");
            while($sa = mysqli_fetch_array($get_image))
            {
                $code = $sa['collegecode'];
                $seal = $sa['seal'];
            }
?>
<div class="mobile">
			<h1>📴</h1>
			<h2>Unavailable for Mobile Device..</h2>
			<h3></h3>
		</div>
		<div class="desktop">
			<!--preloader-->
			<div class="loader">
				<div class="preloadermain">
					<div class="precircle"></div>
					<div class="preloader01"></div>
					<div class="preloader02"></div>
					<div class="preloader03"></div>
					<div class="preloader02"></div>
				</div>
			</div>
			<script src="../../source/preloader/loader.js"></script>
		<!-- NAVBAR -->
		<nav class="navbar navbar-expand-lg navbar-dark sticky-top" id="navbar">
			<div class="container-fluid">
				<!-- ICS LOGO -->
				<a class="navbar-brand p-0 m-0" href="adviser-homepage.php" title="Home" id="nav-logo">
					<img class="rounded-circle p-0" src="../../source/upload/college_seal/<?php echo $seal?>" alt="ICS SEAL" width="32" height="32" />
					<span class="text-uppercase">Online Pre-Advising</span>
				</a>

				<!-- MOBILE TOGGLE -->
				<button class="navbar-toggler m-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
						<!-- notifications 
						<li class="nav-item dropstart">
							<?php
								$check_stud_req = "SELECT count(id) FROM tblrequest_account WHERE req_usertype='Student' and course_id_fk='$courseid' and yearlevel='$yearlevel'";
								$stud_check = mysqli_query($connection,$check_stud_req);
								$stud_total = mysqli_fetch_array($stud_check);
								$stud_row = $stud_total[0];

								$check_stud_grade = "SELECT count(id) FROM tblstudent_pdf WHERE submission_status='Pending' and yearlevel='$yearlevel'";
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
										$notif_num = mysqli_query($connection,"SELECT * FROM tblrequest_account WHERE req_usertype='Student' and course_id_fk='$courseid' and yearlevel='$yearlevel'");
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
									$check_stud_grade = mysqli_query($connection,"SELECT * FROM tblstudent_pdf WHERE submission_status='Pending' and yearlevel='$yearlevel' and course_id_fk='$courseid'");
									if(mysqli_num_rows($check_stud_grade) > 0)
									{
										while($ca=mysqli_fetch_array($check_stud_grade))
										{
											$Student_id = $ca['student_id_fk'];
											$Curr_id = $ca['curri_id_fk']; 
										}
								?>
									<a class="dropdown-item" href="#" data-toggle="modal" data-target="#checkStudentModal">
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
							</ul>
						</li>-->
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
		<div class="container" >
			<p class="text  mt-3 text-danger fw-bold text-center fs-2" style="cursor: default;"><?php echo $code ?> old Student Info and Subjects Lists</p>
		</div>
	
		<!-- TABLE -->
		<div class="container p-2 container-fluid mb-3" >
			<div class="container overflow-auto" >
				<div class="mb-3" align="right"></div>
		<?php
			$check_student = mysqli_query($connection,"SELECT * FROM tblstudent_list WHERE status='Unenrolled' and course_id_fk='$courseid' and adviser_id_fk='$adviserid'");
		?>
                <table class="table table-striped" id="table">
                    <thead class="text-white">
                        <tr>
                            <th hidden><center>ID</center></th>
                            <th><center>Fullname</center></th>
							<th hidden><center>firstname</center></th>
							<th hidden><center>lastname</center></th>
							<th hidden><center>m.i</center></th>
                            <th><center>Email</center></th>
                            <th><center>Contact</center></th>
							<th hidden><center>Course</center></th>
							<th ><center>Curriculum</center></th>
							<th hidden><center>Status</center></th>
							<th hidden><center>Curriculumid</center></th>
							<th hidden><center>Suffix</center></th>
							<th hidden><center>Student Status</center></th>
                            <th><center>Action</center></th>
                        </tr>
                    </thead>
                    <tbody>
		<?php
			if(mysqli_num_rows($check_student) > 0)
			{
				while($fa = mysqli_fetch_array($check_student))
				{
					$curri_id = $fa['curri_id_fk'];
					$suffix = $fa['suffix'];
					if($suffix != "")
					{
						$fullname = ucfirst($fa['lastname']).' '.ucfirst($suffix).'. ,'.ucfirst($fa['firstname']).' '.ucfirst($fa['middle']);
					}
					else
					{
						$fullname = ucfirst($fa['lastname']).','.ucfirst($fa['firstname']).' '.ucfirst($fa['middle']);
					}
					
					$select_curri = mysqli_query($connection,"SELECT * FROM tblcurriculum WHERE id='$curri_id'");
					while($c=mysqli_fetch_array($select_curri))
					{
						$curr_code = $c['curr_code'];
					}
		?>
						<tr>
                            <td hidden><center><?php echo $fa['id'] ?></center></td>
							<td ><center><?php echo $fullname ?></center></td>
                            <td hidden><center><?php echo $fa['firstname'] ?></center></td>
							<td hidden><center><?php echo $fa['lastname'] ?></center></td>
							<td hidden><center><?php echo $fa['middle'] ?></center></td>
                            <td><center><?php echo $fa['email'] ?></center></td>
                            <td><center><?php echo $fa['contact'] ?></center></td>
							<td hidden><center><?php echo $fa['course_id_fk'] ?></center></td>
							<td ><center>
								<form action="managedata.php" method="POST">
									<input type="hidden" name="curr_id" value="<?php echo $curri_id?>">
									<input type="hidden" name="studentid" value="<?php echo $fa['id']?>">
									<button type="submit" name="old_check" class="btn btn-success text-light"><?php echo $curr_code ?></button>
								</form>
							</center></td>
							<td hidden><center><?php echo $fa['status'] ?></center></td>
							<td hidden><center><?php echo $curri_id ?></center></td>
							<td hidden><center><?php echo $suffix ?></center></td>
							<td hidden><center><?php echo $fa['college_status'] ?></center></td>
                            <td><center>
									<button class="btn btn-white" type="button" title="More Option" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="cursor: pointer;">
                                        <a class="dropdown-item editStudentbtn" title="Edit">Edit Student Info</a>
                                    </div>
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
	
	<!-- User Profile MODAL-->
		<div class="container container-fluid">
			<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            	<div class="modal-dialog modal-dialog-scrollable" role="document">
                	<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Profile</h5></h5>
							<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
					</div>
                            <div class="modal-body container">
					<form action="managedata.php" method="POST">
                            <input type="hidden" name="userid" value="<?php echo $adminid?>">
                                <!-- Inputs -->
								<div class="mb-3">
									<label for="firstname" class="form-label">Firstname</label>
									<input type="text" name="firstname" class="form-control text-center" value="<?php echo ucfirst($firstname);?>" id="firstname">
								</div>
								
								<div class="mb-3">
									<label for="lastname" class="form-label">Lastname</label>
									<input type="text" name="lastname" class="form-control text-center" value="<?php echo ucfirst($lastname);?>" id="lastname">
								</div>

								<div class="mb-3">
									<label for="email" class="form-label">Email</label>
									<input type="email" name="email" class="form-control text-center" value="<?php echo $email;?>" id="email">
								</div>

								<div class="mb-3">
									<label for="password" class="form-label">Password</label>
									<input type="password" name="password" class="form-control text-center" value="<?php echo $password;?>" id="password">
									<center>
										<div class="row mt-3">
											<div class="col">
												<input type="checkbox" onclick="myFunction()"> Show Password
											</div>
										</div>
									</center>
								</div>
								
                            </div>
                            <div class="modal-footer" align="right">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
								<button type="submit" name="profile_update" class="btn btn-success">Update</button>
							</div>                    
                    </form>
                </div>
            </div>
        </div>
    <!--END OF user Profile MODAL-->

<!-- For Student Accounts -->
    <!-- ADD NEW Students POPUP -->
    <div class="container container-fluid">
        <div class="modal fade" id="addAdviserModal" tabindex="-1" role="dialog" aria-labelledby="addDepLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="addDepLabel">Add New Students</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>

                        <div class="modal-body">
                    <form action="managedata.php" method="POST">
                        <!-- Inputs -->
							<input type="hidden" name="collegeid" value="<?php echo $collegeid ?>">
							<input type="hidden" name="adviserid" value="<?php echo $adviserid ?>">
							<div class="form-group">
								<label for="exampleFormControlSelect1">Curriculum</label>
								<select name="currid" class="form-control text-center" id="exampleFormControlSelect1">
									<option value="0">Select Curriculum</option>
									<?php 
										$select_curri = mysqli_query($connection,"SELECT * FROM tblcurriculum WHERE college_id_fk='$collegeid' and course_id_fk='$courseid'");
										if(mysqli_num_rows($select_curri))
										{
											foreach($select_curri as $c)
											{
									?>
											<option value="<?php echo $c['id'] ?>"><?php echo $c['curr_code']?></option>
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

                            <div class="row mb-3">
								<div class="col">
									<label for="input-name" class="form-label">Firstname</label>
									<input type="text" name="firstname" class="form-control text-center" placeholder="Enter Firstname" id="input-name" aria-describedby="input-name-help" autocomplete="off" required>
								</div>
								<div class="col-5">
									<label for="input-name" class="form-label">M.I</label>
									<input type="text" name="middle" class="form-control text-center" placeholder="Enter M.I" id="input-name" aria-describedby="input-name-help" autocomplete="off">
								</div>
							</div>

							<div class="row mb-3">
								<div class="col">
									<label for="input-name" class="form-label">Lastname</label>
									<input type="text" name="lastname" class="form-control text-center" placeholder="Enter Lastname" id="input-name" aria-describedby="input-name-help" autocomplete="off" required>
								</div>
								<div class="col-5">
									<label for="input-name" class="form-label">Suffix</label>
									<input type="text" name="suffix" class="form-control text-center" placeholder="Enter Suffix" id="input-name" aria-describedby="input-name-help" autocomplete="off">
									<span class="text-secondary"><center>Optional: Jr,Sr etc.</center></span>
								</div>
							</div>

							<div class="mb-3">
								<label for="input-contact" class="form-label">Email</label>
								<input type="email" name="email" class="form-control text-center" placeholder="@wmsu.edu.ph" id="input-contact" autocomplete="off" required>
							</div>

                            <div class="mb-3">
								<label for="input-contact" class="form-label">Contact</label>
								<input type="text" name="contact" class="form-control text-center" placeholder="Contact No." onkeypress="return isNumber(event)" onpaste="return false;" id="input-contact" autocomplete="off">
							</div>

							<!-- Course -->		
							<div class="container p-0 mb-3" id="select-college">
								<label for="select-college" class="form-label" >Course</label>
								<select name="courseid" class="custom-select text-center p-2" id="select-college" required>
									<option value="0">Select Course..</option>
								<?php
									$select_course = mysqli_query($connection,"SELECT * FROM tblcourse WHERE college_id_fk='$collegeid'");
									if(mysqli_num_rows($select_course))
									{
										while($fa = mysqli_fetch_array($select_course))
										{
								?>
										<option value="<?php echo $fa['id'] ?>"><?php echo $fa['course'] ?></option>
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
                        </div>

                        <div class="modal-footer" align="right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" name="addStudent" class="btn btn-success">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ADD NEW Students END -->

    <!-- DELETE All Student MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteAllStudentModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete All Students</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="managedata.php" method="POST">
                        <center>
							<input type="hidden" name="courseid" value="<?php echo $courseid ?>">
							<input type="hidden" name="adviserid" value="<?php echo $adviserid ?>">
                            <div class="modal-body">
                                All data will be deleted! 
                                Are you sure you want to delete All Students?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                <button type="submit" name="deleteAllStudent" class="btn btn-success">Yes</button>
                            </div>                     
                        </center>
                    </form>
                </div>
            </div>
        </div>
	</div>
    <!--END OF DELETE All Student Modal -->

    <!-- Start Edit Student MANAGE -->
    <div class="modal fade" id="editStudentModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="manage-curriculum" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="manage-curriculum">Manage Account</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
				<form action="managedata.php" method="POST">
                    <!-- Inputs -->
					<input type="hidden" name="studentid" id="student-id">
					<input type="hidden" name="adviserid" value="<?php echo $adviserid ?>">
					<input type="hidden" name="collegeid" value="<?php echo $collegeid ?>">

					<div class="form-group">
						<label for="student_curri">Curriculum</label>
						<select name="curr_code" class="form-control text-center" id="student-curri">
							<option value="0">Select Curriculum</option>
							<?php 
								$select_curri = mysqli_query($connection,"SELECT * FROM tblcurriculum WHERE college_id_fk='$collegeid'");
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

                    <div class="row mb-3">
						<div class="col">
							<label for="student_firstname" class="form-label">Firstname</label>
							<input type="text" name="firstname" class="form-control text-center" id="student-firstname" aria-describedby="input-name-help" autocomplete="off" required>
						</div>
						<div class="col-5">
							<label for="student-middle" class="form-label">M.I</label>
							<input type="text" name="middle" class="form-control text-center" id="student-middle" placeholder="Enter M.I" aria-describedby="input-name-help" autocomplete="off">
						</div>
					</div>

					<div class="row mb-3">
						<div class="col">
							<label for="student-lastname" class="form-label">Lastname</label>
							<input type="text" name="lastname" class="form-control text-center" id="student-lastname" placeholder="Enter Lastname" aria-describedby="input-name-help" autocomplete="off" required>
						</div>
						<div class="col-5">
							<label for="student-suffix" class="form-label">Suffix</label>
							<input type="text" name="suffix" class="form-control text-center" id="student-suffix" placeholder="Enter Suffix" aria-describedby="input-name-help" autocomplete="off">
							<span class="text-secondary"><center>Optional: Jr,Sr etc.</center></span>
						</div>
					</div>

					<div class="mb-3">
						<label for="student-email" class="form-label">Email</label>
						<input type="email" name="email" class="form-control text-center" placeholder="@wmsu.edu.ph" id="student-email" autocomplete="off" readonly required>
					</div>

					<!-- Course -->		
					<div class="container p-0 mb-3" id="select-college">
						<label for="student-course" class="form-label" >Course</label>
						<select name="courseid" class="custom-select text-center p-2" id="student-course" required>
							<option value="0">Select Course</option>
						<?php
							$select_course = mysqli_query($connection,"SELECT * FROM tblcourse WHERE college_id_fk='$collegeid'");
							if(mysqli_num_rows($select_course))
							{
								while($fa = mysqli_fetch_array($select_course))
								{
						?>
								<option value="<?php echo $fa['id'] ?>"><?php echo $fa['course'] ?></option>
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

					<div class="form-group">
						<label for="exampleFormControlSelect1">Current Status</label>
						<select name="status" class="form-control text-center" id="student-status">
							<option value="0">Select Status</option>
							<option value="Enrolled">Enrolled</option>
							<option value="Unenrolled">Unenrolled</option>
						</select>
					</div>

                    <div class="form-group">
						<label for="exampleFormControlSelect1">Student Status</label>
						<select name="college_status" class="form-control text-center" id="college-status">
							<option value="0">Select Status</option>
							<option value="Regular">Regular</option>
							<option value="Irregular">Irregular</option>
							<option value="Shiftee">Shiftee</option>
							<option value="Transferee">Transferee</option>
							<option value="Graduate">Graduate</option>
						</select>
					</div>

					<div class="mb-3">
						<label for="student-contact" class="form-label">Contact</label>
						<input type="text" name="contact" class="form-control text-center" onkeypress="return isNumber(event)" onpaste="return false;" id="student-contact" autocomplete="off">
					</div>
                </div>

                <div class="modal-footer" align="right">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="editStudents" class="btn btn-success">Update</button>
                </div>
                </form>    
            </div>
        </div>
    </div>
    <!-- END Edit Student Modal -->

    <!-- DELETE Student MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteStudentModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Delete This Adviser</h5></h5>
                  <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="managedata.php" method="POST">
                        <center>
                            <input type="hidden" name="id" id="deleteid">

                            <div class="modal-body">
                                All data will be deleted! 
                                Are you sure you want to delete this Adviser?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                <button type="submit" name="deleteStudents" class="btn btn-success">Yes</button>
                            </div>                     
                        </center>
                    </form>
                </div>
            </div>
        </div>
	</div>
    <!--END OF DELETE Student MODAL-->
<!-- End of Student Accounts -->

	<!-- Check Grades Modal -->
	<div class="modal fade" id="checkStudentModal" tabindex="-1" aria-labelledby="manage-curriculum" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document" style="max-width: 1260px;">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="manage-curriculum">View Student Grades</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                <form action="managedata.php" method="POST">
                    <!-- Inputs -->
					<input type="hidden" name="studentid" value="<?php echo $Student_id?>">
					<input type="hidden" name="currid" value="<?php echo $Curr_id?>">

					<div class="container border-top border-bottom mt-2">
						<div class="row mt-2 mb-2">
						<?php
							$select_studid = mysqli_query($connection,"SELECT * FROM tblstudent_grade_sub WHERE student_id_fk='$Student_id' and curri_id_fk='$Curr_id' and course_id_fk='$courseid'");
							$get_pdf = mysqli_query($connection,"SELECT * FROM tblstudent_pdf WHERE student_id_fk='$Student_id' and curri_id_fk='$Curr_id'");
							while($p=mysqli_fetch_array($get_pdf))
							{
								$PDF = $p['pdf_grade'];
							}
							$checkStud = mysqli_query($connection,"SELECT * FROM tbluser WHERE id='$Student_id' and curri_id='$Curr_id' and course_id_fk='$courseid'");
							while($o=mysqli_fetch_array($checkStud))
							{
								$fullname = ucfirst($o['lastname']).','.ucfirst($o['firstname']);
								$FulSec = $o['yearlevel'].''.$o['section'];
							}
						?>
						<div class="row">
							<div class="col mt-2 mb-3" align="left">
								<span class="text-dark fw-bold fs-5"><?php echo $fullname?> - <?php echo $FulSec?></span>
							</div>
							<div class="col mb-3" align="right">
								<a class="btn btn-secondary text-light fas fa-file" id="pdf" onclick="window.open('../../source/upload/grade_files/<?php echo $PDF ?>')"> Student PDF Grade</a>
								<!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
							</div>
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

									$select_Sub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$SubID' and course_id_fk='$courseid'");
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
                    <button type="submit" name="disapproved_grades" class="btn btn-danger">Disapproved</button>
                    <button type="submit" name="approved_grades" class="btn btn-success">Approved</button>
                </div>
                </form>    
            </div>
        </div>
    </div>
    <!-- Check Grades Modal END -->

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

		<!-- User Logout Auto MODAL-->
		<div class="container container-fluid">
        	<div class="modal fade" id="logoutAuto" tabindex="-1" data-backdrop="static" aria-labelledby="deletemodalLabel" aria-hidden="true">
            	<div class="modal-dialog">
                	<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Sign-out</h5></h5>
					</div>
                    <form action="../../source/includes/logout.php" method="POST">
                        <center>
                            <input type="hidden" name="id" id="deleteid" value="<?php echo $adminid?>">

                            <div class="modal-body">
                                You idle too long! 
                                Your account has been automatically logout in the site!!
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="logout" class="btn btn-success">Ok</button>
                            </div>                     
                        </center>
                    </form>
                </div>
            </div>
        </div>
    	<!--END OF user logout Auto MODAL-->

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
			function myFunction() {
				var x = document.getElementById("password");
				if (x.type === "password") {
					x.type = "text";
				} else {
					x.type = "password";
				}
			}

			function isNumber(evt) {
                evt = (evt) ? evt : window.event;
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if ( (charCode > 31 && charCode < 48) || charCode > 57) {
                    return false;
                }
                return true;
            }

			function password_show_hides() {
				var x = document.getElementById("student-password");
				var show_eye = document.getElementById("show_eye");
				var hide_eye = document.getElementById("hide_eye");
				hide_eye.classList.remove("d-none");
				if (x.type === "password") {
				x.type = "text";
				show_eye.style.display = "none";
				hide_eye.style.display = "block";
				} else {
				x.type = "password";
				show_eye.style.display = "block";
				hide_eye.style.display = "none";
				}
			}

			$('#table').DataTable();

			$('#addAdviser').on('click', function() {
				$('#addAdviserModal').modal('show');
			});

			$('#deleteAllStudent').on('click', function() {
				$('#deleteAllStudentModal').modal('show');
			});

			$(document).ready(function() {
			$('body').on('click','.editStudentbtn',function() {
				$('#editStudentModal').modal('show');

				$tr = $(this).closest('tr');

				var data = $tr.children('td').map(function() {
					return $(this).text();
				}).get();

				console.log(data);

				$('#student-id').val(data[0]);
				$('#student-full').val(data[1]);
				$('#student-firstname').val(data[2]);
				$('#student-lastname').val(data[3]);
				$('#student-middle').val(data[4]);
				$('#student-email').val(data[5]);
				$('#student-contact').val(data[6]);
				$('#student-course').val(data[7]);
				$('#student-code').val(data[8]);
				$('#student-status').val(data[9]);
				$('#student-curri').val(data[10]);
				$('#student-suffix').val(data[11]);
				$('#college-status').val(data[12]);
			});
			});

			$(document).ready(function() {
			$('body').on('click','.deleteStudentbtn',function() {
				$('#deleteStudentModal').modal('show');

				$tr = $(this).closest('tr');

				var data = $tr.children('td').map(function() {
					return $(this).text();
				}).get();

				console.log(data);
				$('#deleteid').val(data[0]);
			});
			});
		</script>

		<script type="text/javascript">
			//the interval 'timer' is set as soon as the page loads
			var timer = setInterval(function(){ auto_logout() }, 900000);
			// the figure '20000' (20 seconds) indicates how many milliseconds the timer be set to.
			//e.g. if you want it to set 5 mins, calculate 5min= 5x60=300 sec => 300,000 milliseconds.
			function reset_interval(){
				//first step: clear the existing timer
				clearInterval(timer); 
				//second step: implement the timer again
				timer = setInterval(function(){ auto_logout() }, 900000);
				//..completed the reset of the timer
			}
			
			function auto_logout(){
				//this function will redirect the user to the logout script
				$("#logoutAuto").modal("show");
			}
		</script>
<?php
    }
    else
    {
        header("location: ../../signin/universal-signin.php");
    }
?>
	</body>
</html>
