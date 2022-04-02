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
        $email = $getuser['email'];
		$password = $getuser['password'];
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
		<title>Curriculum</title>
	</head>
    <style>
        .cards{
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: .5rem;
            margin-top: 1rem;
            margin-bottom: 1rem;
            margin-left: 1rem;
            margin-right: 1rem;
        }

        .cards-single{
            display: flex;
            justify-content: space-between;
            background: #A9A9A9;
            padding: 1.3rem;
            cursor: pointer;
        }

        .cards-single span{
            padding: 1rem;
        }

        @media screen and (max-width: 1200px){
            .cards{
                grid-template-columns: repeat(2, 1fr);
                margin-left: 4.5rem;
            }
        }

        @media screen and (max-width: 1000px){
            .cards{
                grid-template-columns: repeat(1, 1fr);
                margin-left: 10rem;
            }
        }
    </style>

	<body>
		<div class="mobile">
			<h1>📴</h1>
			<h2>Unavailable for Mobile Device..</h2>
			<h3></h3>
		</div>
		<div class="desktop ">
		<!-- NAVBAR -->
		<nav class="navbar navbar-expand-lg navbar-dark sticky-top" id="navbar">
			<div class="container-fluid">
				<!-- ICS LOGO -->
				<a class="navbar-brand p-0 m-0" href="adviser-homepage.php" id="nav-logo">
					<img class="rounded-circle p-0" src="../../source/upload/college_seal/<?php echo $seal?>" alt="ICS SEAL" width="32" height="32" />
					<span class="text-uppercase">Online Pre-Advising</span>
				</a>

				<!-- MOBILE TOGGLE -->
				<button class="navbar-toggler m-0" type="button" data-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
							<a class="nav-link active py-0" href="#" data-toggle="modal" data-target="#profileModal" aria-disabled="true"><i id="icons" class="fas fa-user-tie"></i><span class="nav-label"> My Profile</span></a>
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
									$check_stud_grade = mysqli_query($connection,"SELECT * FROM tblstudent_pdf WHERE submission_status='Pending' and yearlevel='$year' and course_id_fk='$courseid'");
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
		<div class="container">
            <p class="text mt-3 text-danger fw-bold text-center fs-2" style="cursor: default;">Curriculum</p>
            <div class="row border">
                <div class="col border-bottom mt-3" align="left">
                    <button type="button" class="btn btn-secondary fas fa-chevron-left mb-3" onclick="location.href='adviser-homepage.php'"> Back</button>
                    <span class="text-secondary">Select Curriculum to Load student and their subjects.</span>
                </div>

                <!--<div class="col border-bottom mt-3" align="right">
                    <button type="button" class="btn rounded btn-success fas fa-clipboard mb-3" data-toggle="modal" data-target="#addCurriculum" id="add-curriculum"> Add</button>
                    <button type="button" class="btn rounded btn-warning text-white fas fa-edit mb-3" data-toggle="modal" data-target="#editCurriculum" id="del-curriculum"> Edit</button>
                    <button type="button" class="btn rounded btn-danger fas fa-trash-alt mb-3" data-toggle="modal" data-target="#delCurriculum" id="del-curriculum"> Delete</button>
                </div>-->

                <div class="justify-content-md-center bg-light bg-gradient">
                    <div class="cards">
                    <?php
                        $getcur =mysqli_query($connection, "SELECT * from tblcurriculum WHERE college_id_fk='$collegeid'");
                        while($fa_curr = mysqli_fetch_array($getcur))
                        {
                            $currid = $fa_curr['id'];
                            $currcode = $fa_curr['curr_code'];

                            $get_stud = "SELECT count(id) FROM tbluser WHERE curri_id='$currid' and college_id_fk='$collegeid' and course_id_fk='$courseid'";
                            $stud_tol = mysqli_query($connection,$get_stud);
                            $tol_stu = mysqli_fetch_array($stud_tol);
                            $total_stud = $tol_stu[0];
                    ?>
                        <form action="managedata.php" method="POST">
                            <input type='hidden' name='id' value="<?php echo $currid ?>">
                            <button type="submit" name='getidbtn' class="btn rounded cards-single text-center fs-5" value="<?php echo $currcode ?>"> <?php echo $currcode ?> - <?php echo $total_stud?> Student</button>
                        </form>     
                    <?php
                        }
                    ?>
                    </div>   
                </div>
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
		<!-- CONTENET END -->

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
		</script>
	</body>
</html>
