<?php
	require("../../source/includes/config.php");
	require_once("../../source/includes/checksession.php");
	if(isset($_SESSION['login_user']))
	{
		if((time() - $_SESSION['last_login_time']) > 900)
		{
			// 900 = 15 * 60
			session_destroy();
			$_SESSION['status'] = "Your Account is Inactive!! Its been Sign out!";
			$_SESSION['status_code'] = "success";
			header("location: ../../signin/universal-signin.php");
			exit();
		}
		else
		{
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
		}
	}
	else
	{
		header("location: ../../signin/universal-signin.php");
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
		<link rel="stylesheet" href="../../source/preloader/loader.css" />
		<title>Add Subjects</title>
	</head>
	<body>
		<div class="mobile">
			<h1>????</h1>
			<h2>Unavailable for Mobile Device..</h2>
			<h3></h3>
		</div>
		<div class="desktop ">
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
				<a class="navbar-brand p-0 m-0" href="adviser-homepage.php" id="nav-logo">
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
							<a class="nav-link active py-0" href="#" data-toggle="modal" data-target="#profileModal" aria-disabled="true"><i id="icons" class="fas fa-user-tie"></i><span class="nav-label"> My Profile</span></a>
						</li>
						<!-- notifications 
						<li class="nav-item dropstart">
							<?php
								//$check_stud_req = "SELECT count(id) FROM tblrequest_account WHERE req_usertype='Student' and course_id_fk='$courseid' and yearlevel='$year'";
								//$stud_check = mysqli_query($connection,$check_stud_req);
								//$stud_total = mysqli_fetch_array($stud_check);
								//$stud_row = $stud_total[0];

								$check_stud_grade = "SELECT count(id) FROM tblstudent_pdf WHERE submission_status='Pending' and yearlevel='$year'";
								$grade_check = mysqli_query($connection,$check_stud_grade);
								$grade_total = mysqli_fetch_array($grade_check);
								$grade_row = $grade_total[0];

								$total_noti = $grade_row;
							?>
							<a class="nav-link dropstart active py-0" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false"> <i id="icons" class="fas fa-bell"></i><span class="badge rounded-pill bg-info text-white align-text-top" id="notif-number"><?php echo $total_noti ?></span><span class="nav-label"> Notifications</span> </a>
							<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
								<li>
								<?php
								/*
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
									}*/
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
        <?php
			$Studid = $_SESSION['studentid'];
			$Currid = $_SESSION['currid'];
            $select_stud = mysqli_query($connection,"SELECT * FROM tblstudent_list WHERE id='$Studid'");
            while($st=mysqli_fetch_array($select_stud))
            {
                $suffix = $st['suffix'];
                if($suffix != "")
                {
                    $full = ucfirst($st['firstname']).' '.ucfirst($st['middle']).' '.ucfirst($st['lastname']).' '.ucfirst($suffix).'.';
                }
                else
                {
                    $full = ucfirst($st['firstname']).' '.ucfirst($st['middle']).' '.ucfirst($st['lastname']);
                }
            }
            $select_curri = mysqli_query($connection,"SELECT * FROM tblcurriculum WHERE id='$Currid'");
            while($cu=mysqli_fetch_array($select_curri))
            {
                $currCode = $cu['curr_code'];
            }
		?>

        <!-- 
            <div class="row">
                            <div class="col">
                                <select name="currid" class="text-center p-2">
                                    <option value="0">Select Curriculum</option>
                                    <option value="1st">1st Semester</option>
                                    <option value="2nd">2nd Semester</option>
                                    <option value="summer">Summer</option>
                                </select>
                            </div>
                            <div class="col">
                                <button type="submit" name="search-sem" class="btn btn-success fas fa-search"> Search</button>
                            </div>
                        </div>
        -->
		<!-- CONTENT -->
        <div class="container" >
			<p class="text mt-3 text-uppercase text-danger fw-bold text-center fs-2" style="cursor: default;"><?php echo $code?> Add Student Subjects</p>
            <p class="text text-uppercase text-danger fw-bold text-center fs-4" style="cursor: default;"><?php echo $full.' - '.$currCode?></p>
		</div>

		<div class="container container-fluid mt-3 mb-5">
			<div class="row border">
                <div class="col mt-2 mb-2">
					<button type="button" class="btn rounded btn-secondary p-2 fas fa-chevron-left" title="Back" onclick="location.href='adviser-loadsubjects.php'"> Back</button>
				<?php
					$open_view = mysqli_query($connection,"SELECT * FROM tbladviser_send_sub_to_stud WHERE status='Pending' and adviser_id_fk='$adviserid' and student_id_fk='$Studid' and curri_id_fk='$Currid' and course_id_fk='$courseid'");
					if(mysqli_num_rows($open_view) > 0)
					{
				?>
					<button type="button" class="btn rounded btn-info p-2 fas fa-list" title="Subject" id="viewSendSubjects" data-toggle="modal" data-target="#viewAddSubject"> View Add Subjects</button>
				<?php
					}
				?>
                    
				</div>
                <div class="col mt-2 mb-2" align="right">
                    <form action="" method="POST">
                        <button class="btn btn-white dropdown-toggle border p-2" type="button" title="More Option" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Select Semester
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="cursor: pointer;">
                            <form action="adviser-sendsubject.php" method="POST">
                                <input type="hidden" name="sem" value="1st">
                                <button type="submit" name="search" class="dropdown-item">1st Semester</button>
                            </form>
                            <form action="adviser-sendsubject.php" method="POST">
                                <input type="hidden" name="sem" value="2nd">
                                <button type="submit" name="search" class="dropdown-item">2nd Semester</button>
                            </form>
                            <form action="adviser-sendsubject.php" method="POST">
                                <input type="hidden" name="sem" value="summer">
                                <button type="submit" name="search" class="dropdown-item">Summer</button>
                            </form>
                        </div>
                    </form>
                </div>
			</div>
            <?php
                if(isset($_POST['search']))
                {
                    $search = $_POST['sem'];
                    if($search == "summer")
                    {
                        $search = "Summer";
                    }
                    if(mysqli_query($connection,$search)){}
            ?>
            <div class="row border mt-2" style="max-height:700px;">
                <span class="fw-bold fs-4 mt-2 mb-2"><center><?php echo $search?> Semester</center></span>
                <div class="mb-3">
                    <div class="row">
                        <div class="col" align="left">
                            <input type="text" id="myInput" class="rounded" onkeyup="mySearch()" placeholder="Search Subject Title.." autocomplete="off"/>
                        </div>
                        <div class="col" align="right">
							<form action="managedata.php" method="POST">
                            <button type="submit" name="save_send" id="button" class="btn btn-success" style="display: none;">Add subject</button>
                        </div>
                    </div>
                </div>

                <div class="col" style="max-height:390px; overflow-y: scroll;">
                <table class="table table-striped" id="tableSend" width="100%">
					<input type="hidden" name="currid" value="<?php echo $Currid?>">
					<input type="hidden" name="adviserid" value="<?php echo $adviserid?>">
					<input type="hidden" name="studid" value="<?php echo $Studid?>">
					<input type="hidden" name="courseid" value="<?php echo $courseid?>">
					<input type="hidden" name="collegeid" value="<?php echo $collegeid?>">
					<thead class="text-white">
                        <tr>
                            <th width="5%"><center></center></th>
                            <th hidden><center>id</center></th>
                            <th><center>Code</center></th>
                            <th width="25%"><center>Title</center></th>
                            <th scope="col"><center>Lec</center></th>
                            <th scope="col"><center>Lab</center></th>
                            <th scope="col"><center>Units</center></th>
                            <th ><center>Year Level</center></th>
                        </tr>
					</thead>
					<tbody>
            <?php
				$select_subject_sem = mysqli_query($connection,"SELECT * FROM tblsubject WHERE semester='$search' and curr_id_fk='$Currid' and course_id_fk='$courseid'");
                if(mysqli_num_rows($select_subject_sem) > 0)
                {
                    foreach($select_subject_sem as $se)
                    {
						$subjectID = $se['id'];
                        $yearlvl = $se['yearlevel'];
                        if($yearlvl == "1")
                        {
                            $yrlvl = "1st";
                        }
                        else if($yearlvl == "2")
                        {
                            $yrlvl = "2nd";
                        }
                        else if($yearlvl == "3")
                        {
                            $yrlvl = "3rd";
                        }
                        else if($yearlvl == "4")
                        {
                            $yrlvl = "4th";
                        }
                        else if($yearlvl == "5")
                        {
                            $yrlvl = "5th";
                        }

						$check_send_subid = mysqli_query($connection,"SELECT * FROM tbladviser_send_sub_to_stud WHERE adviser_id_fk='$adviserid' and student_id_fk='$Studid' and subject_id_fk='$subjectID' and curri_id_fk='$Currid' and course_id_fk='$courseid'");
						while($k=mysqli_fetch_array($check_send_subid))
						{
							$Send_subID = $k['subject_id_fk'];
						}

						if(mysqli_num_rows($check_send_subid) == 0)
						{
            ?>
                    <tr>
                        <td><center><input type="checkbox" name="sub_id[]" id="myCheck" value="<?php echo $se['id']?>" onclick="myCheckBox()"></center></td>
                        <td hidden><center><?php echo $se['id']?></center></td>
                        <td><center><?php echo $se['subject_code']?></center></td>
                        <td><center><?php echo $se['description']?></center></td>
                        <td><center><?php echo $se['lec']?></center></td>
                        <td><center><?php echo $se['lab']?></center></td>
                        <td><center><?php echo $se['units']?></center></td>
                        <td><center><?php echo $yrlvl?></center></td>
                    </tr>
            <?php
						}
                    }
                }
            ?>
                    </tbody>
                    <tfoot >	
						<!-- table footer -->
					</tfoot>
				</table>
				</form>
                </div>
            </div>
                <?php
                }
                else
                {
            ?>
            <div class="row border mt-2">
                <span class="fw-bold fs-4 mt-2 mb-2"><center>Select Semester First!!</center></span>
				<div class="mb-3">
                    <div class="row">
                        <div class="col" align="left">
                            <input type="text" id="myInput" class="rounded" onkeyup="mySearch()" placeholder="Search for subject.." autocomplete="off" readonly/>
                        </div>
                    </div>
                </div>
                <div class="col">
					<table class="table table-striped" id="" width="100%">
						<thead class="text-white">
							<tr>
								<th><center></center></th>
								<th hidden><center>id</center></th>
								<th><center>Code</center></th>
								<th scope="col"><center>Title</center></th>
								<th scope="col"><center>Lec</center></th>
								<th scope="col"><center>Lab</center></th>
								<th scope="col"><center>Units</center></th>
								<th ><center>year</center></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td></td>
								<td hidden></td>
								<td></td>
								<td></td>
								<td><center>No Data Found</center></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						</tbody>
						<tfoot >	
							<!-- table footer -->
						</tfoot>
					</table>
				</div>
            </div>
            <?php
                }
            ?>
		</div>

		<!-- Start View Subjects Modal -->
		<div class="container container-fluid">
			<div class="modal fade" id="viewAddSubject" tabindex="-1" role="dialog" aria-labelledby="manage-requestLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document" style="max-width: 1240px;">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title fw-bold text-uppercase" id="manage-requestLabel">Subjects</h5>
							<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
						</div>

						<div class="modal-body">
							<!-- Inputs -->
							<form action="managedata.php" method="POST">
								<!-- 1st Year Subjects -->
								<div class="border-top border-bottom mt-2">
									<div class="text-uppercase fw-bold text-center fs-4 mt-2 mb-1">
										<span class="text-uppercase fw-bold text-center fs-4 mt-2 mb-1">Final Check Pre-Advised Subject</span>
									</div>
									<table class="table table-striped" width="100%">
										<input type="hidden" name="currid" value="<?php echo $Currid?>">
										<input type="hidden" name="adviserid" value="<?php echo $adviserid?>">
										<input type="hidden" name="studid" value="<?php echo $Studid?>">
										<input type="hidden" name="courseid" value="<?php echo $courseid?>">
										<input type="hidden" name="collegeid" value="<?php echo $collegeid?>">
										<thead class="text-white">
											<tr>
												<th hidden><center>id</center></th>
												<th><center>Code</center></th>
												<th width="25%"><center>Title</center></th>
												<th scope="col"><center>Lec</center></th>
												<th scope="col"><center>Lab</center></th>
												<th scope="col"><center>Units</center></th>
												<th ><center>Year Level</center></th>
												<th><center>School Year</center></th>
												<th><center>Action</center></th>
											</tr>
										</thead>
										<tbody>
								<?php
									$get_pending_sub = mysqli_query($connection,"SELECT * FROM tbladviser_send_sub_to_stud WHERE status='Pending' and adviser_id_fk='$adviserid' and student_id_fk='$Studid' and curri_id_fk='$Currid' and course_id_fk='$courseid'");
									if(mysqli_num_rows($get_pending_sub) > 0)
									{
										while($l=mysqli_fetch_array($get_pending_sub))
										{
											$SubjID = $l['subject_id_fk'];
											$yearlvl = $l['yearlevel'];
											if($yearlvl == "1")
											{
												$yrlvl = "1st";
											}
											else if($yearlvl == "2")
											{
												$yrlvl = "2nd";
											}
											else if($yearlvl == "3")
											{
												$yrlvl = "3rd";
											}
											else if($yearlvl == "4")
											{
												$yrlvl = "4th";
											}
											else if($yearlvl == "5")
											{
												$yrlvl = "5th";
											}
											$get_subid = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$SubjID'"); 
											While($j=mysqli_fetch_array($get_subid))
											{
								?>
										<tr>
											<td hidden><center><?php echo $l['id']?></center></td>
											<td><center><?php echo $j['subject_code']?></center></td>
											<td><center><?php echo $j['description']?></center></td>
											<td><center><?php echo $l['lec']?></center></td>
											<td><center><?php echo $l['lab']?></center></td>
											<td><center><?php echo $l['units']?></center></td>
											<td><center><?php echo $yrlvl?></center></td>
											<td><center><?php echo $l['school_year']?></center></td>
											<td><center><button type="button" title="Delete" class="btn btn-danger fas fa-trash deleteAddSubjectbtn"></button></center></td>
										</tr>
								<?php
											}
										}
									}
									//$select_lec = "SELECT sum(lec) FROM tbladviser_send_sub_to_stud WHERE status='Pending' and adviser_id_fk='$adviserid' and student_id_fk='$Studid' and curri_id_fk='$Currid' and course_id_fk='$courseid'";
									//$count_lec = mysqli_query($connection,$select_lec);
									//$lec_count = mysqli_fetch_array($count_lec);
									//$Total_lec = $lec_count[0];

									//$select_lab = "SELECT sum(lab) FROM tbladviser_send_sub_to_stud WHERE status='Pending' and adviser_id_fk='$adviserid' and student_id_fk='$Studid' and curri_id_fk='$Currid' and course_id_fk='$courseid'";
									//$count_lab = mysqli_query($connection,$select_lab);
									//$lab_count = mysqli_fetch_array($count_lab);
									//$Total_lab = $lab_count[0];

									$select_units = "SELECT sum(units) FROM tbladviser_send_sub_to_stud WHERE status='Pending' and adviser_id_fk='$adviserid' and student_id_fk='$Studid' and curri_id_fk='$Currid' and course_id_fk='$courseid'";
									$count_units = mysqli_query($connection,$select_units);
									$units_count = mysqli_fetch_array($count_units);
									$Total_units = $units_count[0];
								?>
										</tbody>
										<tfoot >	
											<!-- table footer -->
											<tr style="vertical-align: bottom;">
												<td hidden></td>
												<td></td>
												<td class="fw-bold"><center>Total: </center></td>
												<td><center></center></td>
												<td><center></center></td>
												<td class="fw-bold"><center><?php echo $Total_units?></center></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>
										</tfoot>
									</table>
								</div>
						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Closed</button>
                            <button type="submit" name="approved_add_send_sub" class="btn btn-success">Approved</button>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- End of View Add Subject -->

		<!-- DELETE view add Subject MODAL-->
		<div class="container container-fluid">
			<div class="modal fade mt-5" id="deleteAddSubjectModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Delete Student Subjects</h5></h5>
						<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
					</div>
						<form action="managedata.php" method="POST">
							<input type="hidden" name="addid" id="add_id">
							<center>
								<div class="modal-body">
									This data will be deleted! 
									Are you sure you want to delete Student Subject?
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
									<button type="submit" name="delete_view_add_subject" class="btn btn-success">Yes</button>
								</div>                     
							</center>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!--END OF DELETE view add Subject Modal -->

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
			$(document).ready(function() {
				$('body').on('click','.deleteAddSubjectbtn',function() {
					$('#deleteAddSubjectModal').modal('show');
		
					$tr = $(this).closest('tr');
		
					var data = $tr.children('td').map(function() {
						return $(this).text();
					}).get();
		
					console.log(data);
					$('#add_id').val(data[0]);
				});
			});

			function myFunction() {
				var x = document.getElementById("password");
				if (x.type === "password") {
					x.type = "text";
				} else {
					x.type = "password";
				}
			}

          function mySearch() {
            var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("myInput");
                filter = input.value.toUpperCase();
                table = document.getElementById("tableSend");
                tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                td = tr[i].getElementsByTagName("td")[1];
                td = tr[i].getElementsByTagName("td")[2];
                td = tr[i].getElementsByTagName("td")[3];
                if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
                }
            }
          }

			$('#tableSend').on('change', ':checkbox', function() {
				$('#button').toggle(!!$('input:checkbox:checked').length);
			});
		</script>
	</body>
</html>
