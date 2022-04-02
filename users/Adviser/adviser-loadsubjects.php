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
		<!-- Select 2 JQuery -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <!-- local css -->
		<link rel="stylesheet" href="../../source/css/style-adviser.css"/>
        <link rel="stylesheet" href="../../source/preloader/loader.css" />
		<title>Load Student Subjects</title>
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
                $adminid = $getuser['id'];
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
                $curr_courseid = $cu['course_id_fk'];
            }
		?>
		<!-- CONTENT -->
		<div class="container" >
			<p class="text mt-3 text-uppercase text-danger fw-bold text-center fs-2" style="cursor: default;"><?php echo $code?> Student of PreAdvised Subjects</p>
            <p class="text text-uppercase text-danger fw-bold text-center fs-4" style="cursor: default;"><?php echo $full.' - '.$currCode?></p>
		</div>
		<!-- TABLE -->
		<div class="container p-2 container-fluid mb-3" >
			<div class="container overflow-auto" >
				<!--
				<div class="d-flex justify-content-between mb-3">
					<div>
						<button type="button" class="btn rounded btn-success p-3 fas fa-list" title="Subject" id="viewSubjects" data-bs-toggle="modal" data-bs-target="#viewSubject"> View Subjects</button>
					</div>
					
					<div class="d-flex flex-row">
						<select class="form-select" aria-label="Default select example" style="margin-right: .2rem;">
							<option selected>Search Student</option>
							<option value="1">One</option>
							<option value="2">Two</option>
							<option value="3">Three</option>
						</select>
						<button type="button" class="btn rounded btn-info p-3 fas fa-search" title="Subject" id="load"></button>
					</div>
				</div> -->
	
				<div class="mt-2 mb-2">
					<div class="row border mb-3">
						<div class="col mt-2 mb-2">
							<button type="button" class="btn rounded btn-secondary p-2 fas fa-chevron-left" title="Back" onclick="location.href='adviser-studentlists.php'"> Back</button>
                            <button type="button" class="btn rounded btn-info p-2 fas fa-list" title="Subject" id="viewSubjects" data-toggle="modal" data-target="#viewSubject"> View Subjects</button>
						</div>
						<div class="col mt-2 mb-2" align="right">
                            <button type="button" data-toggle="modal" data-target="#addSubjectsmodal" class="btn rounded btn-success p-2 fas fa-clipboard" title="Add Subject"> Add Credited Subjects</button>
						</div>
					</div>

                    <div class="row border mb-3">
                        <div class="d-flex">
                            <div class="mr-auto p-2 mt-2">
                            <?php
                                $show_school_year = mysqli_query($connection,"SELECT * FROM tblschool_year WHERE status='Activated'"); 
                                if(mysqli_num_rows($show_school_year) > 0)
                                {
                                    $y = mysqli_fetch_array($show_school_year);
                                    $sy_show = $y['school_year'];
                            ?>
                                    <span class="fw-bold">This School Year: <?php echo $sy_show ?></span>
                            <?php
                                }
                                else
                                {
                            ?> 
                                    <span class="fw-bold">Please contact the personnel who activate the school year.</span>
                            <?php
                                }
                            ?>
                            </div>
                            <div class="mt-2 mb-2 mr-1">
                            <?php
                                $show_school = mysqli_query($connection,"SELECT * FROM tblschool_year WHERE status='Activated'"); 
                                if(mysqli_num_rows($show_school) > 0)
                                {
                            ?>
                                <form action="managedata.php" method="POST">
                                    <input type="hidden" name="curr_id" value="<?php echo $Currid?>">
                                    <input type="hidden" name="studentid" value="<?php echo $Studid?>">
                                    <button type="submit" name="session-send" class="btn btn-warning p-2 text-light fas fa-file text-light"> Preadvise Subjects</button>
                                </form>
                            <?php    
                                }
                            ?>
                            </div>
                            <div class="mt-2 mb-2">
                            <?php
                                $select_sub = mysqli_query($connection,"SELECT * FROM tbladviser_send_sub_to_stud WHERE status='Approved' and adviser_id_fk='$adminid' and student_id_fk='$Studid' and curri_id_fk='$Currid' and course_id_fk='$courseid'");
                                if(mysqli_num_rows($select_sub) > 0)
                                {
                            ?>
                                <button type="button" class="btn btn-info p-2 fas fa-list text-light" href="#" data-toggle="modal" data-target="#viewSendSubjectModal"> View Send Subjects</button>
                            <?php
                                }
                            ?>
                            </div>
                        </div>
                    </div>

					<div class="row border-top border-bottom mb-2">
						<div class="col text-center">
							<a id="tab1" class="btn my-4 border border-danger fw-bold fs-5" onclick="firsttable()">First Year</a>
						</div>
						<div class="col text-center">
							<a id="tab2" class="btn my-4 border border-danger fw-bold text-center fs-5" onclick="secondtable()">Second Year</a>
						</div>
						<div class="col text-center">
							<a id="tab3" class="btn my-4 border border-danger fw-bold text-center fs-5" onclick="thirdtable()">Third Year</a>
						</div>
						<div class="col text-center">
							<a id="tab4" class="btn my-4 border border-danger fw-bold text-center fs-5" onclick="fourthtable()">Fourth Year</a>
						</div>
						<div class="col text-center">
							<a id="tab5" class="btn my-4 border border-danger fw-bold text-center fs-5" onclick="fifthtable()">Fifth Year</a>
						</div>
						<div class="w-100"></div>
					</div>
		
					<div class="mb-4" id="firstYear">
						<div class="mt-4 mb-3" align="right">	
						</div>
		
						<div class="border-bottom mb-2">
                            <form action="managedata.php" method="POST">
                                <input type="hidden" name="studid" value="<?php echo $Studid?>">
                                <input type="hidden" name="currid" value="<?php echo $Currid ?>">
                                <div class="row mb-2">
                                    <div class="col mt-2" align="left">
                                        <span class="text-uppercase fw-bold">1st Semester</span>
                                    </div>
                                    <div class="col" align="right">
                                        <button type="submit" name="but_update" id="button_update" class="btn btn-success" style="display: none;">Save</button>
                                    </div>
                                </div>
			<?php
				$check_1st_subject_1st = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid' and yearlevel='1' and semester='1st' and course_id_fk='$curr_courseid'");
			?>
							<table class="table table-striped" id="table11stsem" width="100%">
								<thead class="text-white">
									<tr>
										<th><center><input type="checkbox" id="chckAll1stsem1st"></center></th>
                                        <th hidden><center>id</center></th>
										<th><center>Code</center></th>
										<th width="25%"><center>Title</center></th>
										<th scope="col"><center>Lec</center></th>
										<th scope="col"><center>Lab</center></th>
										<th scope="col"><center>Units</center></th>
										<th scope="col"><center>Prerequisite</center></th>
										<th scope="col"><center>Grades</center></th>
										<th hidden><center>Remarks</center></th>
                                        <th hidden><center>year</center></th>
										<th hidden><center>semester</center></th>
                                        <th hidden><center>subid</center></th>
                                        <th ><center>SY</center></th>
                                        <th hidden><center>SY</center></th>
                                        <th hidden><center>Total</center></th>
										<th scope="col"><center>Action</center></th>
									</tr>
								</thead>
								<tbody>
			<?php
				if(mysqli_num_rows($check_1st_subject_1st) > 0)
                {
                    while($fa = mysqli_fetch_array($check_1st_subject_1st))
                    {
                        $PreID = $fa['id'];
						$SubID = $fa['subject_id_fk'];
						$Course_id = $fa['course_id_fk'];
						$Grades = $fa['grades'];
						$Remarks = $fa['remarks'];
                        $Year = $fa['yearlevel'];
                        $Semester = $fa['semester'];
                        $SY = $fa['school_year'];
                        $total_grade_units = $fa['total_grades'];
						$GetSub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$SubID'");
						while($su=mysqli_fetch_array($GetSub))
						{
							$SubCode = $su['subject_code'];
							$SubDes = $su['description'];
							$SubLec = $su['lec'];
							$SubLab = $su['lab'];
							$SubUnits = $su['units'];
							$SubPreq = $su['prerequisite'];
						}
                        if($PreID && $Grades == "INC" && $Remarks == "PASSED")
                        {
                            $color_tr_bg = "#FFFF66";
                        }
                        else if($PreID && $Grades == "CREDITED" && $Remarks == "PASSED")
                        {
                            $color_tr_bg = "#00FFFF";
                        }
                        else if($PreID && $Remarks == "PASSED")
                        {
                            $color_tr_bg = "#90EE90";
                        }
                        else if($PreID && $Remarks == "FAILED")
                        {
                            $color_tr_bg = "#FFCCCB";
                        }
                        else
                        {
                            $color_tr_bg = "#F5F5F5";
                        }
			?>
								<tr style="background: <?php echo $color_tr_bg?>">
                                    <td><center><input type="checkbox" name="sub_list_id[]" value="<?php echo $PreID?>" class="check_1st_sem_1st"></center></td>
									<td hidden><center><?php echo $PreID ?></center></td>
                                    <td><center><?php echo $SubCode ?></center></td>
									<td><center><?php echo $SubDes ?></center></td>
									<td><center><?php echo $SubLec ?></center></td>
									<td><center><?php echo $SubLab ?></center></td>
									<td><center><?php echo $SubUnits ?></center></td>
			<?php
                        if($SubPreq == "NONE")
                        {
                            echo '<td><center>NONE</center></td>';
                        }
                        else if($SubPreq == "HAVE")
                        {              
                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$SubID' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                            $get_check = mysqli_query($connection,$checkprereq);
                            $Rows = mysqli_fetch_array($get_check);
                            $SubID = $Rows[0];
                            
                            if($SubID == 1)
                            {
                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$SubID' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                $checkpreq = mysqli_query($connection,$getpreq);
                                foreach($checkpreq as $rows)
                                {
                                    $new = $rows['subject_id'];    
                                }
                                $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$new' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                while($sa = mysqli_fetch_array($getsubcode))
                                {
                                    $subCode = $sa['subject_code'];
                                }
                                echo '<td><center>'.$subCode.'</center></td>';
                            }
                            else if($SubID > 1)
                            {
            ?>
								<td><center>
			<?php
                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$SubID' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                foreach($getpreq as $rows)
                                {
                                    $news = $rows['subject_id'];     
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$news' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
                                        print_r($sa['subject_code']);
                                        echo "\t";
                                    }                                                
                                }
            ?>
								</center></td>
			<?php
                            }
                        }
            ?>
									<td><center>
                                    <div class="form-group show_1st_grade_1st">
                                        <?php echo $Grades?>
                                    </div>
                                    <div class="form-group hide_1st_grade_1st" style="display: none;">
                                        <select name="grades_<?=$PreID ?>" value="<?php echo $Grades?>" class="form-control text-center">
                                            <option selected><?php echo $Grades?></option>
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
                                            <option value="CREDITED">CREDITED</option>
                                            <option value="DRP">DRP</option>
                                        </select>
                                    </div>
                                    </center></td>
									<td hidden><center><?php echo $Remarks ?></center></td>
                                    <td hidden><center><?php echo $Year ?></center></td>
									<td hidden><center><?php echo $Semester ?></center></td>
                                    <td hidden><center><input type="text" name="subject_id_fk_<?=$PreID ?>" value="<?=$SubID?>"></center></td>
                                    <td><center>
                                    <?php
                                        if($Grades == 0 && $Grades != "INC" && $Grades != "5.0" && $Grades != "DRP" && $Grades != "CREDITED")
                                        {
                                    ?>
                                        <div class="show_1st_grade_1st">
                                            <?php echo $SY?>
                                        </div>
                                        <div class="hide_1st_grade_1st" style="display: none;">
                                            <input type="text" name="SY_<?=$PreID ?>" value="<?php echo $SY?>" class="form-control text-center">
                                        </div>
                                    <?php
                                        }
                                        else if($Grades != 0 || $Grades == "INC" || $Grades == "5.0" || $Grades == "DRP" || $Grades == "CREDITED")
                                        {
                                    ?>
                                        <div class="">
                                            <?php echo $SY?>
                                        </div>
                                        <div class="" style="display: none;">
                                            <input type="text" name="SY_<?=$PreID ?>" value="<?php echo $SY?>" class="form-control text-center">
                                        </div>
                                    <?php
                                        }
                                    ?>
                                    </center></td>
                                    <td hidden><center><?php echo $SY ?></center></td>
									<td hidden><center><?php echo $total_grade_units ?></center></td>
                                    <td><center><button type="button" style="font-size: 1.3rem;" title="Edit" class="fas fa-edit btn rounded btn-success edit1stSubject1stbtn"></button></center></td>
								</tr>
			<?php
                    }				
				}
                $sum_units = "SELECT sum(units) FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid' and yearlevel='1' and semester='1st' and course_id_fk='$courseid'";
                $units_check = mysqli_query($connection,$sum_units);
                $units_total = mysqli_fetch_array($units_check);
                $units_row = $units_total[0];

                $get_total_grades_1st_1st = mysqli_query($connection,"SELECT total_grades FROM tbladviser_presubject WHERE student_id='$Studid' and total_grades in ('INC','DRP','FAILED','CREDITED') and curri_id='$Currid' and yearlevel='1' and semester='1st' and course_id_fk='$courseid'");
                if(mysqli_num_rows($get_total_grades_1st_1st) > 0)
                {
                    $total_grade_units_1st_1st = '<span data-toggle="tooltip" data-placement="top" class="fas fa-ellipsis-h" title="Average not available due to missing grades/Failed grades/INC grades/Credited subjects."></span>'; 
                }
                else if(mysqli_num_rows($get_total_grades_1st_1st) == 0)
                {
                    $sum_stud_grade_1st_1st = "SELECT sum(total_grades) FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid' and yearlevel='1' and semester='1st' and course_id_fk='$courseid'";
                    $check_total_1st_1st = mysqli_query($connection,$sum_stud_grade_1st_1st);
                    $fetch_total_1st_1st = mysqli_fetch_array($check_total_1st_1st);
                    $total_grade_1st_1st = $fetch_total_1st_1st[0];            
                    if($units_row != 0 && $total_grade_1st_1st != 0)
                    {
                        $total_grade_units_1st_1st = round($total_grade_1st_1st / $units_row, 4);
                    }
                    else
                    {
                        $total_grade_units_1st_1st = "";
                    }
                }
                else
                {
                    $total_grade_units_1st_1st = "";
                }
			?>
								</tbody>
								<tfoot >	
									<!-- table footer -->
                                    <tr>
                                        <td></td>
                                        <td hidden></td>
                                        <td></td>
                                        <td class="fw-bold"><center>Total:</center></td>
                                        <td></td>
                                        <td></td>
                                        <td class="fw-bold"><center><?php echo $units_row?></center></td>
                                        <td></td>
                                        <td class="fw-bold"><center>Average: <?php echo $total_grade_units_1st_1st?></center></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td></td>
                                    </tr>
								</tfoot>
							</table>
                            </form>
						</div>

						<div class="mt-2">
                            <form action="managedata.php" method="POST">
                                <input type="hidden" name="studid" value="<?php echo $Studid?>">
                                <input type="hidden" name="currid" value="<?php echo $Currid ?>">
                                <div class="row mb-2">
                                    <div class="col mt-2" align="left">
                                        <span class="text-uppercase fw-bold">2nd Semester</span>
                                    </div>
                                    <div class="col" align="right">
                                        <button type="submit" name="but_update" id="button_update_1st_2nd" class="btn btn-success" style="display: none;">Save</button>
                                    </div>
                                </div>
			<?php
				$check_1st_subject_2nd = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid' and yearlevel='1' and semester='2nd' and course_id_fk='$curr_courseid'");
			?>
							<table class="table table-striped" id="table12ndsem" width="100%">
								<thead class="text-white">
									<tr>
										<th><center><input type="checkbox" id="chckAll1stsem2nd"></center></th>
                                        <th hidden><center>id</center></th>
										<th><center>Code</center></th>
										<th width="25%"><center>Title</center></th>
										<th scope="col"><center>Lec</center></th>
										<th scope="col"><center>Lab</center></th>
										<th scope="col"><center>Units</center></th>
										<th scope="col"><center>Prerequisite</center></th>
										<th scope="col"><center>Grades</center></th>
										<th hidden><center>Remarks</center></th>
                                        <th hidden><center>year</center></th>
										<th hidden><center>semester</center></th>
                                        <th hidden><center>subid</center></th>
                                        <th><center>SY</center></th>
                                        <th hidden><center>SY</center></th>
                                        <th hidden><center>Total Grades</center></th>
										<th scope="col"><center>Action</center></th>
									</tr>
								</thead>
								<tbody>
			<?php
				if(mysqli_num_rows($check_1st_subject_2nd) > 0)
                {
                    while($fa = mysqli_fetch_array($check_1st_subject_2nd))
                    {
                        $PreID = $fa['id'];
						$SubID_2nd = $fa['subject_id_fk'];
                        $Course_id = $fa['course_id_fk'];
						$Grades = $fa['grades'];
						$Remarks = $fa['remarks'];
                        $Year = $fa['yearlevel'];
                        $Semester = $fa['semester'];
                        $SY = $fa['school_year'];
                        $total_grade_units = $fa['total_grades'];
						$GetSub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$SubID_2nd'");
						while($su=mysqli_fetch_array($GetSub))
						{
							$SubCode = $su['subject_code'];
							$SubDes = $su['description'];
							$SubLec = $su['lec'];
							$SubLab = $su['lab'];
							$SubUnits = $su['units'];
							$SubPreq = $su['prerequisite'];
						}
                        if($PreID && $Grades == "INC" && $Remarks == "PASSED")
                        {
                            $color_tr_bg = "#FFFF66";
                        }
                        else if($PreID && $Grades == "CREDITED" && $Remarks == "PASSED")
                        {
                            $color_tr_bg = "#00FFFF";
                        }
                        else if($PreID && $Remarks == "PASSED")
                        {
                            $color_tr_bg = "#90EE90";
                        }
                        else if($PreID && $Remarks == "FAILED")
                        {
                            $color_tr_bg = "#FFCCCB";
                        }
                        else
                        {
                            $color_tr_bg = "#F5F5F5";
                        }
			?>
								<tr style="background: <?php echo $color_tr_bg?>">
									<td><center><input type="checkbox" name="sub_list_id[]" value="<?php echo $PreID?>" class="check_1st_sem_2nd"></center></td>
									<td hidden><center><?php echo $PreID ?></center></td>
                                    <td><center><?php echo $SubCode ?></center></td>
									<td><center><?php echo $SubDes ?></center></td>
									<td><center><?php echo $SubLec ?></center></td>
									<td><center><?php echo $SubLab ?></center></td>
									<td><center><?php echo $SubUnits ?></center></td>
			<?php
                        if($SubPreq == "NONE")
                        {
                            echo '<td><center>NONE</center></td>';
                        }
                        else if($SubPreq == "HAVE")
                        {              
                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$SubID_2nd' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                            $get_check = mysqli_query($connection,$checkprereq);
                            $Rows = mysqli_fetch_array($get_check);
                            $SubID = $Rows[0];
                            
                            if($SubID == 1)
                            {
                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$SubID_2nd' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                $checkpreq = mysqli_query($connection,$getpreq);
                                foreach($checkpreq as $rows)
                                {
                                    $new = $rows['subject_id'];    
                                }
                                $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$new' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                while($sa = mysqli_fetch_array($getsubcode))
                                {
                                    $subCode = $sa['subject_code'];
                                }
                                echo '<td><center>'.$subCode.'</center></td>';
                            }
                            else if($SubID > 1)
                            {
            ?>
								<td><center>
			<?php
                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$SubID_2nd' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                foreach($getpreq as $rows)
                                {
                                    $news = $rows['subject_id'];    
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$news' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
                                        print_r($sa['subject_code']);
                                        echo "\t";
                                    }                                                 
                                }
            ?>
								</center></td>
			<?php
                            }
                        }
            ?>
									<td><center>
                                    <div class="form-group show_1st_grade_2nd">
                                        <?php echo $Grades?>
                                    </div>
                                    <div class="form-group hide_1st_grade_2nd" style="display: none;"> 
                                        <select name="grades_<?=$PreID ?>" value="<?php echo $Grades?>" class="form-control text-center">
                                            <option value="0"><?php echo $Grades?></option>
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
                                            <option value="CREDITED">CREDITED</option>
                                            <option value="DRP">DRP</option>
                                        </select>
                                    </div>
                                    </center></td>
									<td hidden><center><?php echo $Remarks ?></center></td>
                                    <td hidden><center><?php echo $Year ?></center></td>
									<td hidden><center><?php echo $Semester ?></center></td>
                                    <td hidden><center><input type="text" name="subject_id_fk_<?=$PreID ?>" value="<?=$SubID_2nd?>"></center></td>
                                    <td ><center>
                                    <?php
                                        if($Grades == 0 && $Grades != "INC" && $Grades != "5.0" && $Grades != "DRP" && $Grades != "CREDITED")
                                        {
                                    ?>
                                        <div class="form-group show_1st_grade_2nd">
                                            <?php echo $SY?> 
                                        </div>
                                        <div class="form-group hide_1st_grade_2nd" style="display: none;">
                                            <input type="text" name="SY_<?=$PreID ?>" value="<?php echo $SY?>" class="form-control text-center">   
                                        </div>
                                    <?php
                                        }
                                        else if($Grades != 0 || $Grades == "INC" || $Grades == "5.0" || $Grades == "DRP" || $Grades == "CREDITED")
                                        {
                                    ?>
                                        <div class="form-group">
                                            <?php echo $SY?> 
                                        </div>
                                        <div class="form-group" style="display: none;">
                                            <input type="text" name="SY_<?=$PreID ?>" value="<?php echo $SY?>" class="form-control text-center">   
                                        </div>
                                    <?php
                                        }
                                    ?>
                                    </center></td>
                                    <td hidden><center><?php echo $SY ?></center></td>
                                    <td hidden><center><?php echo $$total_grade_units ?></center></td>
									<td><center><button type="button" style="font-size: 1.3rem;" title="Edit" class="fas fa-edit btn rounded btn-success edit1stSubject2ndbtn"></button></center></td>
								</tr>
			<?php
					}				
				}
				$sum_units = "SELECT sum(units) FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid' and yearlevel='1' and semester='2nd' and course_id_fk='$courseid'";
				$units_check = mysqli_query($connection,$sum_units);
				$units_total = mysqli_fetch_array($units_check);
				$units_row_2nd = $units_total[0];

                $get_total_grades_1st_2nd = mysqli_query($connection,"SELECT total_grades FROM tbladviser_presubject WHERE total_grades in ('INC','DRP','FAILED','CREDITED') and student_id='$Studid' and curri_id='$Currid' and yearlevel='1' and semester='2nd' and course_id_fk='$courseid'");
                if(mysqli_num_rows($get_total_grades_1st_2nd) > 0)
                {
                    $total_grade_units_1st_2nd = '<span data-toggle="tooltip" data-placement="top" class="fas fa-ellipsis-h" title="Average not available due to missing grades/Failed grades/INC grades/Credited subjects."></span>'; 
                }
                else if(mysqli_num_rows($get_total_grades_1st_2nd) == 0)
                {
                    $sum_stud_grade_1st_2nd = "SELECT sum(total_grades) FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid' and yearlevel='1' and semester='2nd' and course_id_fk='$courseid'";
                    $check_total_1st_2nd = mysqli_query($connection,$sum_stud_grade_1st_2nd);
                    $fetch_total_1st_2nd = mysqli_fetch_array($check_total_1st_2nd);
                    $total_grade_1st_2nd = $fetch_total_1st_2nd[0];
                    if($units_row_2nd != 0 && $total_grade_1st_2nd != 0)
                    {
                        $total_grade_units_1st_2nd = round($total_grade_1st_2nd / $units_row_2nd, 4);
                    }
                    else if(mysqli_num_rows($get_total_grades_1st_2nd) == 0)
                    {
                        $total_grade_units_1st_2nd = "";
                    }
                }
                else
                {
                    $total_grade_units_1st_2nd = "";
                }
			?>
								</tbody>
								<tfoot >	
									<!-- table footer -->
                                    <tr>
                                        <td></td>
                                        <td hidden></td>
                                        <td></td>
                                        <td class="fw-bold"><center>Total:</center></td>
                                        <td></td>
                                        <td></td>
                                        <td class="fw-bold"><center><?php echo $units_row_2nd?></center></td>
                                        <td></td>
                                        <td class="fw-bold"><center>Average: <?php echo $total_grade_units_1st_2nd?></center></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td></td>
                                    </tr>
								</tfoot>
							</table>
                            </form>
						</div>

                        <div class="mt-2">
                            <form action="managedata.php" method="POST">
                                <input type="hidden" name="studid" value="<?php echo $Studid?>">
                                <input type="hidden" name="currid" value="<?php echo $Currid ?>">
                                <div class="row mb-2">
                                    <div class="col mt-2" align="left">
                                        <span class="text-uppercase fw-bold">Summer</span>
                                    </div>
                                    <div class="col" align="right">
                                        <button type="submit" name="but_update" id="button_update_1st_summer" class="btn btn-success" style="display: none;">Save</button>
                                    </div>
                                </div>
			<?php
				$check_1st_subject_summer = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid' and yearlevel='1' and semester='summer' and course_id_fk='$curr_courseid'");
			?>
							<table class="table table-striped" id="table1summersem" width="100%">
								<thead class="text-white">
									<tr>
										<th><center><input type="checkbox" id="chckAll1stsemsummer"></center></th>
                                        <th hidden><center>id</center></th>
										<th><center>Code</center></th>
										<th width="25%"><center>Title</center></th>
										<th scope="col"><center>Lec</center></th>
										<th scope="col"><center>Lab</center></th>
										<th scope="col"><center>Units</center></th>
										<th scope="col"><center>Prerequisite</center></th>
										<th scope="col"><center>Grades</center></th>
										<th hidden><center>Remarks</center></th>
                                        <th hidden><center>year</center></th>
										<th hidden><center>semester</center></th>
                                        <th hidden><center>subid</center></th>
                                        <th><center>SY</center></th>
                                        <th hidden><center>SY</center></th>
                                        <th hidden><center>Total Grades</center></th>
										<th scope="col"><center>Action</center></th>
									</tr>
								</thead>
								<tbody>
			<?php
				if(mysqli_num_rows($check_1st_subject_summer) > 0)
                {
                    while($fa = mysqli_fetch_array($check_1st_subject_summer))
                    {
                        $PreID = $fa['id'];
						$SubID_summer = $fa['subject_id_fk'];
                        $Course_id = $fa['course_id_fk'];
						$Grades = $fa['grades'];
						$Remarks = $fa['remarks'];
                        $Year = $fa['yearlevel'];
                        $Semester = $fa['semester'];
                        $SY = $fa['school_year'];
                        $total_grade_units = $fa['total_grades'];
						$GetSub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$SubID_summer'");
						while($su=mysqli_fetch_array($GetSub))
						{
							$SubCode = $su['subject_code'];
							$SubDes = $su['description'];
							$SubLec = $su['lec'];
							$SubLab = $su['lab'];
							$SubUnits = $su['units'];
							$SubPreq = $su['prerequisite'];
						}
                        if($PreID && $Grades == "INC" && $Remarks == "PASSED")
                        {
                            $color_tr_bg = "#FFFF66";
                        }
                        else if($PreID && $Grades == "CREDITED" && $Remarks == "PASSED")
                        {
                            $color_tr_bg = "#00FFFF";
                        }
                        else if($PreID && $Remarks == "PASSED")
                        {
                            $color_tr_bg = "#90EE90";
                        }
                        else if($PreID && $Remarks == "FAILED")
                        {
                            $color_tr_bg = "#FFCCCB";
                        }
                        else
                        {
                            $color_tr_bg = "#F5F5F5";
                        }
			?>
								<tr style="background: <?php echo $color_tr_bg?>">
									<td><center><input type="checkbox" name="sub_list_id[]" value="<?php echo $PreID?>" class="check_1st_sem_summer"></center></td>
									<td hidden><center><?php echo $PreID ?></center></td>
                                    <td><center><?php echo $SubCode ?></center></td>
									<td><center><?php echo $SubDes ?></center></td>
									<td><center><?php echo $SubLec ?></center></td>
									<td><center><?php echo $SubLab ?></center></td>
									<td><center><?php echo $SubUnits ?></center></td>
			<?php
                        if($SubPreq == "NONE")
                        {
                            echo '<td><center>NONE</center></td>';
                        }
                        else if($SubPreq == "HAVE")
                        {              
                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$SubID_summer' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                            $get_check = mysqli_query($connection,$checkprereq);
                            $Rows = mysqli_fetch_array($get_check);
                            $SubID = $Rows[0];
                            
                            if($SubID == 1)
                            {
                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$SubID_summer' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                $checkpreq = mysqli_query($connection,$getpreq);
                                foreach($checkpreq as $rows)
                                {
                                    $new = $rows['subject_id'];    
                                }
                                $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$new' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                while($sa = mysqli_fetch_array($getsubcode))
                                {
                                    $subCode = $sa['subject_code'];
                                }
                                echo '<td><center>'.$subCode.'</center></td>';
                            }
                            else if($SubID > 1)
                            {
            ?>
								<td><center>
			<?php
                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$SubID_summer' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                foreach($getpreq as $rows)
                                {
                                    $news = $rows['subject_id'];    
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$news' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
                                        print_r($sa['subject_code']);
                                        echo "\t";
                                    }                                                 
                                }
            ?>
								</center></td>
			<?php
                            }
                        }
            ?>
									<td><center>
                                    <div class="form-group show_1st_grade_summer">
                                        <?php echo $Grades?>
                                    </div>
                                    <div class="form-group hide_1st_grade_summer" style="display: none;">
                                        <select name="grades_<?=$PreID ?>" value="<?php echo $Grades?>" class="form-control text-center">
                                            <option value="0"><?php echo $Grades?></option>
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
                                            <option value="CREDITED">CREDITED</option>
                                            <option value="DRP">DRP</option>
                                        </select>
                                    </div>
                                    </center></td>
									<td hidden><center><?php echo $Remarks ?></center></td>
                                    <td hidden><center><?php echo $Year ?></center></td>
									<td hidden><center><?php echo $Semester ?></center></td>
                                    <td hidden><center><input type="text" name="subject_id_fk_<?=$PreID ?>" value="<?=$SubID_summer?>"></center></td>
                                    <td ><center>
                                    <?php
                                        if($Grades == 0 && $Grades != "INC" && $Grades != "5.0" && $Grades != "DRP" && $Grades != "CREDITED")
                                        {
                                    ?>
                                        <div class="form-group show_1st_grade_summer">
                                            <?php echo $SY?>
                                        </div>
                                        <div class="form-group hide_1st_grade_summer" style="display: none;">
                                            <input type="text" name="SY_<?=$PreID ?>" value="<?php echo $SY?>" class="form-control text-center">
                                        </div>
                                    <?php
                                        }
                                        else if($Grades != 0 || $Grades == "INC" || $Grades == "5.0" || $Grades == "DRP" || $Grades == "CREDITED")
                                        {
                                    ?>
                                        <div class="form-group">
                                            <?php echo $SY?>
                                        </div>
                                        <div class="form-group" style="display: none;">
                                            <input type="text" name="SY_<?=$PreID ?>" value="<?php echo $SY?>" class="form-control text-center">
                                        </div>
                                    <?php
                                        }
                                    ?>
                                    </center></td>
                                    <td hidden><center><?php echo $SY ?></center></td>
									<td hidden><center><?php echo $total_grade_units ?></center></td>
									<td><center><button type="button" style="font-size: 1.3rem;" title="Edit" class="fas fa-edit btn rounded btn-success edit1stSubjectsummerbtn"></button></center></td>
								</tr>
			<?php
					}				
				}
				$sum_units = "SELECT sum(units) FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid' and yearlevel='1' and semester='summer' and course_id_fk='$courseid'";
				$units_check = mysqli_query($connection,$sum_units);
				$units_total = mysqli_fetch_array($units_check);
				$units_row_1st_summer = $units_total[0];

                $get_total_grades_1st_summer = mysqli_query($connection,"SELECT total_grades FROM tbladviser_presubject WHERE total_grades in ('INC','DRP','FAILED','CREDITED') and student_id='$Studid' and curri_id='$Currid' and yearlevel='1' and semester='summer' and course_id_fk='$courseid'");
                if(mysqli_num_rows($get_total_grades_1st_summer) > 0)
                {
                    $total_grade_units_1st_summer = '<span data-toggle="tooltip" data-placement="top" class="fas fa-ellipsis-h" title="Average not available due to missing grades/Failed grades/INC grades/Credited subjects."></span>'; 
                }
                else if(mysqli_num_rows($get_total_grades_1st_summer) == 0)
                {
                    $sum_stud_grade_1st_summer = "SELECT sum(total_grades) FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid' and yearlevel='1' and semester='summer' and course_id_fk='$courseid'";
                    $check_total_1st_summer = mysqli_query($connection,$sum_stud_grade_1st_summer);
                    $fetch_total_1st_summer = mysqli_fetch_array($check_total_1st_summer);
                    $total_grade_1st_summer = $fetch_total_1st_summer[0];
                    if($units_row_1st_summer != 0 && $total_grade_1st_summer != 0)
                    {
                        $total_grade_units_1st_summer = round($total_grade_1st_summer / $units_row_1st_summer, 4);
                    }
                    else
                    {
                        $total_grade_units_1st_summer = "";
                    }
                }
                else
                {
                    $total_grade_units_1st_summer = "";
                }
			?>
								</tbody>
								<tfoot >	
									<!-- table footer -->
                                    <tr>
                                        <td></td>
                                        <td hidden></td>
                                        <td></td>
                                        <td class="fw-bold"><center>Total:</center></td>
                                        <td></td>
                                        <td></td>
                                        <td class="fw-bold"><center><?php echo $units_row_1st_summer?></center></td>
                                        <td></td>
                                        <td class="fw-bold"><center>Average: <?php echo $total_grade_units_1st_summer?></center></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td></td>
                                    </tr>
								</tfoot>
							</table>
                            </form>
						</div>

					</div>
		
					<div class="mt-4 mb-4" id="secondYear">
						<div class="border-bottom mb-2">
                            <form action="managedata.php" method="POST">
                                <input type="hidden" name="studid" value="<?php echo $Studid?>">
                                <input type="hidden" name="currid" value="<?php echo $Currid ?>">
                                <div class="row mb-2">
                                    <div class="col mt-2" align="left">
                                        <span class="text-uppercase fw-bold">1st Semester</span>
                                    </div>
                                    <div class="col" align="right">
                                        <button type="submit" name="but_update" id="button_update_2nd_1st" class="btn btn-success" style="display: none;">Save</button>
                                    </div>
                                </div>
			<?php
				$check_2nd_subject_1st = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid' and yearlevel='2' and semester='1st' and course_id_fk='$curr_courseid'");
			?>
							<table class="table table-striped" id="table21stsem" width="100%">
								<thead class="text-white">
									<tr>
                                        <th><center><input type="checkbox" id="chckAll2ndsem1st"></center></th>
										<th hidden><center>id</center></th>
										<th><center>Code</center></th>
										<th width="25%"><center>Title</center></th>
										<th scope="col"><center>Lec</center></th>
										<th scope="col"><center>Lab</center></th>
										<th scope="col"><center>Units</center></th>
										<th scope="col"><center>Prerequisite</center></th>
										<th scope="col"><center>Grades</center></th>
										<th hidden><center>Remarks</center></th>
                                        <th hidden><center>year</center></th>
										<th hidden><center>semester</center></th>
                                        <th hidden><center>subid</center></th>
                                        <th ><center>SY</center></th>
                                        <th hidden><center>SY</center></th>
                                        <th hidden><center>Total Grades</center></th>
										<th scope="col"><center>Action</center></th>
									</tr>
								</thead>
								<tbody>
			<?php
				if(mysqli_num_rows($check_2nd_subject_1st) > 0)
                {
                    while($fa = mysqli_fetch_array($check_2nd_subject_1st))
                    {
                        $PreID = $fa['id'];
						$SubID_2nd_1st = $fa['subject_id_fk'];
                        $Course_id = $fa['course_id_fk'];
						$Grades = $fa['grades'];
						$Remarks = $fa['remarks'];
                        $Year = $fa['yearlevel'];
                        $Semester = $fa['semester'];
                        $SY = $fa['school_year'];
                        $total_grade_units = $fa['total_grades'];
						$GetSub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$SubID_2nd_1st'");
						while($su=mysqli_fetch_array($GetSub))
						{
							$SubCode = $su['subject_code'];
							$SubDes = $su['description'];
							$SubLec = $su['lec'];
							$SubLab = $su['lab'];
							$SubUnits = $su['units'];
							$SubPreq = $su['prerequisite'];
						}
                        if($PreID && $Grades == "INC" && $Remarks == "PASSED")
                        {
                            $color_tr_bg = "#FFFF66";
                        }
                        else if($PreID && $Grades == "CREDITED" && $Remarks == "PASSED")
                        {
                            $color_tr_bg = "#00FFFF";
                        }
                        else if($PreID && $Remarks == "PASSED")
                        {
                            $color_tr_bg = "#90EE90";
                        }
                        else if($PreID && $Remarks == "FAILED")
                        {
                            $color_tr_bg = "#FFCCCB";
                        }
                        else
                        {
                            $color_tr_bg = "#F5F5F5";
                        }
			?>
								<tr style="background: <?php echo $color_tr_bg?>">
                                    <td><center><input type="checkbox" name="sub_list_id[]" value="<?php echo $PreID?>" class="check_2nd_sem_1st"></center></td>
									<td hidden><center><?php echo $fa['id'] ?></center></td>
									<td><center><?php echo $SubCode ?></center></td>
									<td><center><?php echo $SubDes ?></center></td>
									<td><center><?php echo $SubLec ?></center></td>
									<td><center><?php echo $SubLab ?></center></td>
									<td><center><?php echo $SubUnits ?></center></td>
			<?php
                        if($SubPreq == "NONE")
                        {
                            echo '<td><center>NONE</center></td>';
                        }
                        else if($SubPreq == "HAVE")
                        {              
                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$SubID_2nd_1st' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                            $get_check = mysqli_query($connection,$checkprereq);
                            $Rows = mysqli_fetch_array($get_check);
                            $SubID = $Rows[0];
                            
                            if($SubID == 1)
                            {
                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$SubID_2nd_1st' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                $checkpreq = mysqli_query($connection,$getpreq);
                                foreach($checkpreq as $rows)
                                {
                                    $new = $rows['subject_id'];    
                                }
                                $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$new' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                while($sa = mysqli_fetch_array($getsubcode))
                                {
                                    $subCode = $sa['subject_code'];
                                }
                                echo '<td><center>'.$subCode.'</center></td>';
                            }
                            else if($SubID > 1)
                            {
            ?>
								<td><center>
			<?php
                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$SubID_2nd_1st' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                foreach($getpreq as $rows)
                                {
                                    $news = $rows['subject_id']; 
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$news' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
                                        print_r($sa['subject_code']);
                                        echo "\t";
                                    }                                                    
                                }
            ?>
								</center></td>
			<?php
                            }
                        }
            ?>
									<td><center>
                                    <div class="form-group show_2nd_grade_1st">
                                        <?php echo $Grades?>
                                    </div>
                                    <div class="form-group hide_2nd_grade_1st" style="display: none;">
                                        <select name="grades_<?=$PreID ?>" value="<?php echo $Grades?>" class="form-control text-center">
                                            <option value="0"><?php echo $Grades?></option>
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
                                            <option value="CREDITED">CREDITED</option>
                                            <option value="DRP">DRP</option>
                                        </select>
                                    </div>
                                    </center></td>
									<td hidden><center><?php echo $Remarks ?></center></td>
                                    <td hidden><center><?php echo $Year ?></center></td>
									<td hidden><center><?php echo $Semester ?></center></td>
                                    <td hidden><center><input type="text" name="subject_id_fk_<?=$PreID ?>" value="<?=$SubID_2nd_1st?>"></center></td>
                                    <td><center>
                                    <?php
                                        if($Grades == 0 && $Grades != "INC" && $Grades != "5.0" && $Grades != "DRP" && $Grades != "CREDITED")
                                        {
                                    ?>
                                        <div class="form-group show_2nd_grade_1st">
                                            <?php echo $SY?>
                                        </div>
                                        <div class="form-group hide_2nd_grade_1st" style="display: none;">
                                            <input type="text" name="SY_<?=$PreID ?>" value="<?php echo $SY?>" class="form-control text-center">
                                        </div>
                                    <?php
                                        }
                                        else if($Grades != 0 || $Grades == "INC" || $Grades == "5.0" || $Grades == "DRP" || $Grades == "CREDITED")
                                        {
                                    ?>
                                        <div class="form-group">
                                            <?php echo $SY?>
                                        </div>
                                        <div class="form-group" style="display: none;">
                                            <input type="text" name="SY_<?=$PreID ?>" value="<?php echo $SY?>" class="form-control text-center">
                                        </div>
                                    <?php
                                        }
                                    ?>
                                    </center></td>
                                    <td hidden><center><?php echo $SY ?></center></td>
									<td hidden><center><?php echo $total_grade_units ?></center></td>
									<td><center><button type="button" style="font-size: 1.3rem;" title="Edit" class="fas fa-edit btn rounded btn-success edit2ndSubject1stbtn"></button></center></td>
								</tr>
			<?php
					}				
				}
				$sum_units = "SELECT sum(units) FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid' and yearlevel='2' and semester='1st' and course_id_fk='$courseid'";
				$units_check = mysqli_query($connection,$sum_units);
				$units_total = mysqli_fetch_array($units_check);
				$units_row_2nd_1st = $units_total[0];

                $get_total_grades_2nd_1st = mysqli_query($connection,"SELECT total_grades FROM tbladviser_presubject WHERE student_id='$Studid' and total_grades in ('INC','DRP','FAILED','CREDITED') and curri_id='$Currid' and yearlevel='2' and semester='1st' and course_id_fk='$courseid'");
                if(mysqli_num_rows($get_total_grades_2nd_1st) > 0)
                {
                    $total_grade_units_2nd_1st = '<span data-toggle="tooltip" data-placement="top" class="fas fa-ellipsis-h" title="Average not available due to missing grades/Failed grades/INC grades/Credited subjects."></span>'; 
                }
                else if(mysqli_num_rows($get_total_grades_2nd_1st) == 0)
                {
                    $sum_stud_grade_2nd_1st = "SELECT sum(total_grades) FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid' and yearlevel='2' and semester='1st' and course_id_fk='$courseid'";
                    $check_total_2nd_1st = mysqli_query($connection,$sum_stud_grade_2nd_1st);
                    $fetch_total_2nd_1st = mysqli_fetch_array($check_total_2nd_1st);
                    $total_grade_2nd_1st = $fetch_total_2nd_1st[0];            
                    if($units_row_2nd_1st != 0 && $total_grade_2nd_1st != 0)
                    {
                        $total_grade_units_2nd_1st = round($total_grade_2nd_1st / $units_row_2nd_1st, 4);
                    }
                    else
                    {
                        $total_grade_units_2nd_1st = "";
                    }
                }
                else
                {
                    $total_grade_units_2nd_1st = "";
                }
			?>
								</tbody>
								<tfoot >	
									<!-- table footer -->
                                    <tr>
                                        <td></td>
                                        <td hidden></td>
                                        <td></td>
                                        <td class="fw-bold"><center>Total:</center></td>
                                        <td></td>
                                        <td></td>
                                        <td class="fw-bold"><center><?php echo $units_row_2nd_1st?></center></td>
                                        <td></td>
                                        <td class="fw-bold"><center>Average: <?php echo $total_grade_units_2nd_1st?></center></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td></td>
                                    </tr>
								</tfoot>
							</table>
                            </form>
						</div>

						<div class="mb-2">
                            <form action="managedata.php" method="POST">
                                <input type="hidden" name="studid" value="<?php echo $Studid?>">
                                <input type="hidden" name="currid" value="<?php echo $Currid ?>">
                                <div class="row mb-2">
                                    <div class="col mt-2" align="left">
                                        <span class="text-uppercase fw-bold">2nd Semester</span>
                                    </div>
                                    <div class="col" align="right">
                                        <button type="submit" name="but_update" id="button_update_2nd_2nd" class="btn btn-success" style="display: none;">Save</button>
                                    </div>
                                </div>
			<?php
				$check_2nd_subject_2nd = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid' and yearlevel='2' and semester='2nd' and course_id_fk='$curr_courseid'");
			?>
							<table class="table table-striped" id="table22ndsem" width="100%">
								<thead class="text-white">
									<tr>
                                        <th><center><input type="checkbox" id="chckAll2ndsem2nd"></center></th>
										<th hidden><center>id</center></th>
										<th><center>Code</center></th>
										<th width="25%"><center>Title</center></th>
										<th scope="col"><center>Lec</center></th>
										<th scope="col"><center>Lab</center></th>
										<th scope="col"><center>Units</center></th>
										<th scope="col"><center>Prerequisite</center></th>
										<th scope="col"><center>Grades</center></th>
										<th hidden><center>Remarks</center></th>
                                        <th hidden><center>year</center></th>
										<th hidden><center>semester</center></th>
                                        <th hidden><center>subid</center></th>
                                        <th ><center>SY</center></th>
                                        <th hidden><center>SY</center></th>
                                        <th hidden><center>Total Grades</center></th>
										<th scope="col"><center>Action</center></th>
									</tr>
								</thead>
								<tbody>
			<?php
				if(mysqli_num_rows($check_2nd_subject_2nd) > 0)
                {
                    while($fa = mysqli_fetch_array($check_2nd_subject_2nd))
                    {
                        $PreID = $fa['id'];
						$SubID_2nd_2nd = $fa['subject_id_fk'];
                        $Course_id = $fa['course_id_fk'];
						$Grades = $fa['grades'];
						$Remarks = $fa['remarks'];
                        $Year = $fa['yearlevel'];
                        $Semester = $fa['semester'];
                        $SY = $fa['school_year'];
                        $total_grade_units = $fa['total_grades'];
						$GetSub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$SubID_2nd_2nd'");
						while($su=mysqli_fetch_array($GetSub))
						{
							$SubCode = $su['subject_code'];
							$SubDes = $su['description'];
							$SubLec = $su['lec'];
							$SubLab = $su['lab'];
							$SubUnits = $su['units'];
							$SubPreq = $su['prerequisite'];
						}
                        if($PreID && $Grades == "INC" && $Remarks == "PASSED")
                        {
                            $color_tr_bg = "#FFFF66";
                        }
                        else if($PreID && $Grades == "CREDITED" && $Remarks == "PASSED")
                        {
                            $color_tr_bg = "#00FFFF";
                        }
                        else if($PreID && $Remarks == "PASSED")
                        {
                            $color_tr_bg = "#90EE90";
                        }
                        else if($PreID && $Remarks == "FAILED")
                        {
                            $color_tr_bg = "#FFCCCB";
                        }
                        else
                        {
                            $color_tr_bg = "#F5F5F5";
                        }
			?>
								<tr style="background: <?php echo $color_tr_bg?>">
                                    <td><center><input type="checkbox" name="sub_list_id[]" value="<?php echo $PreID?>" class="check_2nd_sem_2nd"></center></td>
									<td hidden><center><?php echo $fa['id'] ?></center></td>
									<td><center><?php echo $SubCode ?></center></td>
									<td><center><?php echo $SubDes ?></center></td>
									<td><center><?php echo $SubLec ?></center></td>
									<td><center><?php echo $SubLab ?></center></td>
									<td><center><?php echo $SubUnits ?></center></td>
			<?php
                        if($SubPreq == "NONE")
                        {
                            echo '<td><center>NONE</center></td>';
                        }
                        else if($SubPreq == "HAVE")
                        {              
                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$SubID_2nd_2nd' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                            $get_check = mysqli_query($connection,$checkprereq);
                            $Rows = mysqli_fetch_array($get_check);
                            $SubID = $Rows[0];
                            
                            if($SubID == 1)
                            {
                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$SubID_2nd_2nd' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                $checkpreq = mysqli_query($connection,$getpreq);
                                foreach($checkpreq as $rows)
                                {
                                    $new = $rows['subject_id'];    
                                }
                                $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$new' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                while($sa = mysqli_fetch_array($getsubcode))
                                {
                                    $subCode = $sa['subject_code'];
                                }
                                echo '<td><center>'.$subCode.'</center></td>';
                            }
                            else if($SubID > 1)
                            {
            ?>
								<td><center>
			<?php
                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$SubID_2nd_2nd' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                foreach($getpreq as $rows)
                                {
                                    $news = $rows['subject_id'];   
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$news' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
                                        print_r($sa['subject_code']);
                                        echo "\t";
                                    }                                                  
                                }
            ?>
								</center></td>
			<?php
                            }
                        }
            ?>
									<td><center>
                                    <div class="form-group show_2nd_grade_2nd">
                                        <?php echo $Grades?>
                                    </div>
                                    <div class="form-group hide_2nd_grade_2nd" style="display: none;">
                                        <select name="grades_<?=$PreID ?>" value="<?php echo $Grades?>" class="form-control text-center">
                                            <option value="0"><?php echo $Grades?></option>
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
                                            <option value="CREDITED">CREDITED</option>
                                            <option value="DRP">DRP</option>
                                        </select>
                                    </div>
                                    </center></td>
									<td hidden><center><?php echo $Remarks ?></center></td>
                                    <td hidden><center><?php echo $Year ?></center></td>
									<td hidden><center><?php echo $Semester ?></center></td>
                                    <td hidden><center><input type="text" name="subject_id_fk_<?=$PreID ?>" value="<?=$SubID_2nd_2nd?>"></center></td>
                                    <td><center>
                                    <?php
                                        if($Grades == 0 && $Grades != "INC" && $Grades != "5.0" && $Grades != "DRP" && $Grades != "CREDITED")
                                        {
                                    ?>
                                        <div class="form-group show_2nd_grade_2nd">
                                            <?php echo $SY?>
                                        </div>
                                        <div class="form-group hide_2nd_grade_2nd" style="display: none;">
                                            <input type="text" name="SY_<?=$PreID ?>" value="<?php echo $SY?>" class="form-control text-center">
                                        </div>
                                    <?php
                                        }
                                        else if($Grades != 0 || $Grades == "INC" || $Grades == "5.0" || $Grades == "DRP" || $Grades == "CREDITED")
                                        {
                                    ?>
                                        <div class="form-group">
                                            <?php echo $SY?>
                                        </div>
                                        <div class="form-group" style="display: none;">
                                            <input type="text" name="SY_<?=$PreID ?>" value="<?php echo $SY?>" class="form-control text-center">
                                        </div>
                                    <?php
                                        }
                                    ?>
                                    </center></td>
                                    <td hidden><center><?php echo $SY ?></center></td>
									<td hidden><center><?php echo $total_grade_units ?></center></td>
									<td><center><button type="button" style="font-size: 1.3rem;" title="Edit" class="fas fa-edit btn rounded btn-success edit2ndSubject2ndbtn"></button></center></td>
								</tr>
			<?php
					}				
				}
                $sum_units = "SELECT sum(units) FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid' and yearlevel='2' and semester='2nd' and course_id_fk='$courseid'";
                $units_check = mysqli_query($connection,$sum_units);
                $units_total = mysqli_fetch_array($units_check);
                $units_row_2nd_2nd = $units_total[0];

                $get_total_grades_2nd_2nd = mysqli_query($connection,"SELECT total_grades FROM tbladviser_presubject WHERE total_grades in ('INC','DRP','FAILED','CREDITED') and student_id='$Studid' and curri_id='$Currid' and yearlevel='2' and semester='2nd' and course_id_fk='$courseid'");
                if(mysqli_num_rows($get_total_grades_2nd_2nd) > 0)
                {
                    $total_grade_units_2nd_2nd = '<span data-toggle="tooltip" data-placement="top" class="fas fa-ellipsis-h" title="Average not available due to missing grades/Failed grades/INC grades/Credited subjects."></span>'; 
                }
                else if(mysqli_num_rows($get_total_grades_2nd_2nd) == 0)
                {
                    $sum_stud_grade_2nd_2nd = "SELECT sum(total_grades) FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid' and yearlevel='2' and semester='2nd' and course_id_fk='$courseid'";
                    $check_total_2nd_2nd = mysqli_query($connection,$sum_stud_grade_2nd_2nd);
                    $fetch_total_2nd_2nd = mysqli_fetch_array($check_total_2nd_2nd);
                    $total_grade_2nd_2nd = $fetch_total_2nd_2nd[0];            
                    if($units_row_2nd_2nd != 0 && $total_grade_2nd_2nd != 0)
                    {
                        $total_grade_units_2nd_2nd = round($total_grade_2nd_2nd / $units_row_2nd_2nd, 4);
                    }
                    else
                    {
                        $total_grade_units_2nd_2nd = "";
                    }
                }
                else
                {
                    $total_grade_units_2nd_2nd = "";
                }
			?>
								</tbody>
								<tfoot >	
									<!-- table footer -->
                                    <tr>
                                        <td></td>
                                        <td hidden></td>
                                        <td></td>
                                        <td class="fw-bold"><center>Total:</center></td>
                                        <td></td>
                                        <td></td>
                                        <td class="fw-bold"><center><?php echo $units_row_2nd_2nd?></center></td>
                                        <td></td>
                                        <td class="fw-bold"><center>Average: <?php echo $total_grade_units_2nd_2nd?></center></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td></td>
                                    </tr>
								</tfoot>
							</table>
                            </form>
						</div>

                        <div class="mb-2">
                            <form action="managedata.php" method="POST">
                                <input type="hidden" name="studid" value="<?php echo $Studid?>">
                                <input type="hidden" name="currid" value="<?php echo $Currid ?>">
                                <div class="row mb-2">
                                    <div class="col mt-2" align="left">
                                        <span class="text-uppercase fw-bold">Summer</span>
                                    </div>
                                    <div class="col" align="right">
                                        <button type="submit" name="but_update" id="button_update_2nd_summer" class="btn btn-success" style="display: none;">Save</button>
                                    </div>
                                </div>
			<?php
				$check_2nd_subject_summer = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid' and yearlevel='2' and semester='summer' and course_id_fk='$curr_courseid'");
			?>
							<table class="table table-striped" id="table2summersem" width="100%">
								<thead class="text-white">
									<tr>
                                        <th><center><input type="checkbox" id="chckAll2ndsemsummer"></center></th>
										<th hidden><center>id</center></th>
										<th><center>Code</center></th>
										<th width="25%"><center>Title</center></th>
										<th scope="col"><center>Lec</center></th>
										<th scope="col"><center>Lab</center></th>
										<th scope="col"><center>Units</center></th>
										<th scope="col"><center>Prerequisite</center></th>
										<th scope="col"><center>Grades</center></th>
										<th hidden><center>Remarks</center></th>
                                        <th hidden><center>year</center></th>
										<th hidden><center>semester</center></th>
                                        <th hidden><center>subid</center></th>
                                        <th ><center>SY</center></th>
                                        <th hidden><center>SY</center></th>
                                        <th hidden><center>Total Grades</center></th>
										<th scope="col"><center>Action</center></th>
									</tr>
								</thead>
								<tbody>
			<?php
				if(mysqli_num_rows($check_2nd_subject_summer) > 0)
                {
                    while($fa = mysqli_fetch_array($check_2nd_subject_summer))
                    {
                        $PreID = $fa['id'];
						$SubID_2nd_summer = $fa['subject_id_fk'];
                        $Course_id = $fa['course_id_fk'];
						$Grades = $fa['grades'];
						$Remarks = $fa['remarks'];
                        $Year = $fa['yearlevel'];
                        $Semester = $fa['semester'];
                        $SY = $fa['school_year'];
                        $total_grade_units = $fa['total_grades'];
						$GetSub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$SubID_2nd_summer'");
						while($su=mysqli_fetch_array($GetSub))
						{
							$SubCode = $su['subject_code'];
							$SubDes = $su['description'];
							$SubLec = $su['lec'];
							$SubLab = $su['lab'];
							$SubUnits = $su['units'];
							$SubPreq = $su['prerequisite'];
						}
                        if($PreID && $Grades == "INC" && $Remarks == "PASSED")
                        {
                            $color_tr_bg = "#FFFF66";
                        }
                        else if($PreID && $Grades == "CREDITED" && $Remarks == "PASSED")
                        {
                            $color_tr_bg = "#00FFFF";
                        }
                        else if($PreID && $Remarks == "PASSED")
                        {
                            $color_tr_bg = "#90EE90";
                        }
                        else if($PreID && $Remarks == "FAILED")
                        {
                            $color_tr_bg = "#FFCCCB";
                        }
                        else
                        {
                            $color_tr_bg = "#F5F5F5";
                        }
			?>
								<tr style="background: <?php echo $color_tr_bg?>">
                                    <td><center><input type="checkbox" name="sub_list_id[]" value="<?php echo $PreID?>" class="check_2nd_sem_summer"></center></td>
									<td hidden><center><?php echo $fa['id'] ?></center></td>
									<td><center><?php echo $SubCode ?></center></td>
									<td><center><?php echo $SubDes ?></center></td>
									<td><center><?php echo $SubLec ?></center></td>
									<td><center><?php echo $SubLab ?></center></td>
									<td><center><?php echo $SubUnits ?></center></td>
			<?php
                        if($SubPreq == "NONE")
                        {
                            echo '<td><center>NONE</center></td>';
                        }
                        else if($SubPreq == "HAVE")
                        {              
                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$SubID_2nd_summer' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                            $get_check = mysqli_query($connection,$checkprereq);
                            $Rows = mysqli_fetch_array($get_check);
                            $SubID = $Rows[0];
                            
                            if($SubID == 1)
                            {
                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$SubID_2nd_summer' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                $checkpreq = mysqli_query($connection,$getpreq);
                                foreach($checkpreq as $rows)
                                {
                                    $new = $rows['subject_id'];    
                                }
                                $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$new' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                while($sa = mysqli_fetch_array($getsubcode))
                                {
                                    $subCode = $sa['subject_code'];
                                }
                                echo '<td><center>'.$subCode.'</center></td>';
                            }
                            else if($SubID > 1)
                            {
            ?>
								<td><center>
			<?php
                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$SubID_2nd_summer' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                foreach($getpreq as $rows)
                                {
                                    $news = $rows['subject_id'];   
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$news' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
                                        print_r($sa['subject_code']);
                                        echo "\t";
                                    }                                                  
                                }
            ?>
								</center></td>
			<?php
                            }
                        }
            ?>
									<td><center>
                                    <div class="form-group show_2nd_grade_summer">
                                        <?php echo $Grades?>
                                    </div>
                                    <div class="form-group hide_2nd_grade_summer" style="display: none;">
                                        <select name="grades_<?=$PreID ?>" value="<?php echo $Grades?>" class="form-control text-center">
                                            <option value="0"><?php echo $Grades?></option>
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
                                            <option value="CREDITED">CREDITED</option>
                                            <option value="DRP">DRP</option>
                                        </select>
                                    </div>
                                    </center></td>
									<td hidden><center><?php echo $Remarks ?></center></td>
                                    <td hidden><center><?php echo $Year ?></center></td>
									<td hidden><center><?php echo $Semester ?></center></td>
                                    <td hidden><center><input type="text" name="subject_id_fk_<?=$PreID ?>" value="<?=$SubID_2nd_summer?>"></center></td>
                                    <td><center>
                                    <?php
                                        if($Grades == 0 && $Grades != "INC" && $Grades != "5.0" && $Grades != "DRP" && $Grades != "CREDITED")
                                        {
                                    ?>
                                        <div class="form-group show_2nd_grade_summer">
                                            <?php echo $SY?>
                                        </div>
                                        <div class="form-group hide_2nd_grade_summer" style="display: none;">
                                            <input type="text" name="SY_<?=$PreID ?>" value="<?php echo $SY?>" class="form-control text-center">
                                        </div>
                                    <?php
                                        }
                                        else if($Grades != 0 || $Grades == "INC" || $Grades == "5.0" || $Grades == "DRP" || $Grades == "CREDITED")
                                        {
                                    ?>
                                        <div class="form-group">
                                            <?php echo $SY?>
                                        </div>
                                        <div class="form-group" style="display: none;">
                                            <input type="text" name="SY_<?=$PreID ?>" value="<?php echo $SY?>" class="form-control text-center">
                                        </div>
                                    <?php
                                        }
                                    ?>
                                    </center></td>
                                    <td hidden><center><?php echo $SY ?></center></td>
									<td hidden><center><?php echo $total_grade_units ?></center></td>
									<td><center><button type="button" style="font-size: 1.3rem;" title="Edit" class="fas fa-edit btn rounded btn-success edit2ndSubjectsummerbtn"></button></center></td>
								</tr>
			<?php
					}				
				}
                $sum_units = "SELECT sum(units) FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid' and yearlevel='2' and semester='summer' and course_id_fk='$courseid'";
                $units_check = mysqli_query($connection,$sum_units);
                $units_total = mysqli_fetch_array($units_check);
                $units_row_2nd_summer = $units_total[0];

                $get_total_grades_2nd_summer = mysqli_query($connection,"SELECT total_grades FROM tbladviser_presubject WHERE total_grades in ('INC','DRP','FAILED','CREDITED') and student_id='$Studid' and curri_id='$Currid' and yearlevel='2' and semester='summer' and course_id_fk='$courseid'");
                if(mysqli_num_rows($get_total_grades_2nd_summer) > 0)
                {
                    $total_grade_units_2nd_summer = '<span data-toggle="tooltip" data-placement="top" class="fas fa-ellipsis-h" title="Average not available due to missing grades/Failed grades/INC grades/Credited subjects."></span>'; 
                }
                else if(mysqli_num_rows($get_total_grades_2nd_summer) == 0)
                {
                    $sum_stud_grade_2nd_summer = "SELECT sum(total_grades) FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid' and yearlevel='2' and semester='summer' and course_id_fk='$courseid'";
                    $check_total_2nd_summer = mysqli_query($connection,$sum_stud_grade_2nd_summer);
                    $fetch_total_2nd_summer = mysqli_fetch_array($check_total_2nd_summer);
                    $total_grade_2nd_summer = $fetch_total_2nd_summer[0];            
                    if($units_row_2nd_summer != 0 && $total_grade_2nd_summer != 0)
                    {
                        $total_grade_units_2nd_summer = round($total_grade_2nd_summer / $units_row_2nd_summer, 4);
                    }
                    else
                    {
                        $total_grade_units_2nd_summer = "";
                    }
                }
                else
                {
                    $total_grade_units_2nd_summer = "";
                }
			?>
								</tbody>
								<tfoot >	
									<!-- table footer -->
                                    <tr>
                                        <td></td>
                                        <td hidden></td>
                                        <td></td>
                                        <td class="fw-bold"><center>Total:</center></td>
                                        <td></td>
                                        <td></td>
                                        <td class="fw-bold"><center><?php echo $units_row_2nd_summer?></center></td>
                                        <td></td>
                                        <td class="fw-bold"><center>Average: <?php echo $total_grade_units_2nd_summer?></center></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td></td>
                                    </tr>
								</tfoot>
							</table>
                            </form>
						</div>
					</div>
		
					<div class="mt-4 mb-4" id="thirdYear">
						<div class="border-bottom mb-2">
                            <form action="managedata.php" method="POST">
                                <input type="hidden" name="studid" value="<?php echo $Studid?>">
                                <input type="hidden" name="currid" value="<?php echo $Currid ?>">
                                <div class="row mb-2">
                                    <div class="col mt-2" align="left">
                                        <span class="text-uppercase fw-bold">1st Semester</span>
                                    </div>
                                    <div class="col" align="right">
                                        <button type="submit" name="but_update" id="button_update_3rd_1st" class="btn btn-success" style="display: none;">Save</button>
                                    </div>
                                </div>
			<?php
				$check_3rd_subject_1st = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid' and yearlevel='3' and semester='1st' and course_id_fk='$courseid'");
			?>
							<table class="table table-striped" id="table31stsem" width="100%">
								<thead class="text-white">
									<tr>
                                        <th ><center><input type="checkbox" id="chckAll3rdsem1st"></center></th>
										<th hidden><center>id</center></th>
										<th><center>Code</center></th>
										<th width="25%"><center>Title</center></th>
										<th scope="col"><center>Lec</center></th>
										<th scope="col"><center>Lab</center></th>
										<th scope="col"><center>Units</center></th>
										<th scope="col"><center>Prerequisite</center></th>
										<th scope="col"><center>Grades</center></th>
										<th hidden><center>Remarks</center></th>
                                        <th hidden><center>year</center></th>
										<th hidden><center>semester</center></th>
                                        <th hidden><center>subid</center></th>
                                        <th ><center>SY</center></th>
                                        <th hidden><center>SY</center></th>
                                        <th hidden><center>Total Grades</center></th>
										<th scope="col"><center>Action</center></th>
									</tr>
								</thead>
								<tbody>
			<?php
				if(mysqli_num_rows($check_3rd_subject_1st) > 0)
                {
                    while($fa = mysqli_fetch_array($check_3rd_subject_1st))
                    {
                        $PreID = $fa['id'];
						$SubID_3rd_1st = $fa['subject_id_fk'];
                        $Course_id = $fa['course_id_fk'];
						$Grades = $fa['grades'];
						$Remarks = $fa['remarks'];
                        $Year = $fa['yearlevel'];
                        $Semester = $fa['semester'];
                        $SY = $fa['school_year'];
                        $total_grade_units = $fa['total_grades'];
						$GetSub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$SubID_3rd_1st'");
						while($su=mysqli_fetch_array($GetSub))
						{
							$SubCode = $su['subject_code'];
							$SubDes = $su['description'];
							$SubLec = $su['lec'];
							$SubLab = $su['lab'];
							$SubUnits = $su['units'];
							$SubPreq = $su['prerequisite'];
						}
                        if($PreID && $Grades == "INC" && $Remarks == "PASSED")
                        {
                            $color_tr_bg = "#FFFF66";
                        }
                        else if($PreID && $Grades == "CREDITED" && $Remarks == "PASSED")
                        {
                            $color_tr_bg = "#00FFFF";
                        }
                        else if($PreID && $Remarks == "PASSED")
                        {
                            $color_tr_bg = "#90EE90";
                        }
                        else if($PreID && $Remarks == "FAILED")
                        {
                            $color_tr_bg = "#FFCCCB";
                        }
                        else
                        {
                            $color_tr_bg = "#F5F5F5";
                        }
			?>
								<tr style="background: <?php echo $color_tr_bg?>">
                                    <td><center><input type="checkbox" name="sub_list_id[]" value="<?php echo $PreID?>" class="check_3rd_sem_1st"></center></td>
									<td hidden><center><?php echo $fa['id'] ?></center></td>
									<td><center><?php echo $SubCode ?></center></td>
									<td><center><?php echo $SubDes ?></center></td>
									<td><center><?php echo $SubLec ?></center></td>
									<td><center><?php echo $SubLab ?></center></td>
									<td><center><?php echo $SubUnits ?></center></td>
			<?php
                        if($SubPreq == "NONE")
                        {
                            echo '<td><center>NONE</center></td>';
                        }
                        else if($SubPreq == "HAVE")
                        {              
                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$SubID_3rd_1st' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                            $get_check = mysqli_query($connection,$checkprereq);
                            $Rows = mysqli_fetch_array($get_check);
                            $SubID = $Rows[0];
                            
                            if($SubID == 1)
                            {
                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$SubID_3rd_1st' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                $checkpreq = mysqli_query($connection,$getpreq);
                                foreach($checkpreq as $rows)
                                {
                                    $new = $rows['subject_id'];    
                                }
                                $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$new' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                while($sa = mysqli_fetch_array($getsubcode))
                                {
                                    $subCode = $sa['subject_code'];
                                }
                                echo '<td><center>'.$subCode.'</center></td>';
                            }
                            else if($SubID > 1)
                            {
            ?>
								<td><center>
			<?php
                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$SubID_3rd_1st' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                foreach($getpreq as $rows)
                                {
                                    $news = $rows['subject_id'];    
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$news' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
                                        print_r($sa['subject_code']);
                                        echo "\t";
                                    }                                                 
                                }
            ?>
								</center></td>
			<?php
                            }
                        }
            ?>
									<td><center>
                                    <div class="form-group show_3rd_grade_1st">
                                        <?php echo $Grades?>
                                    </div>
                                    <div class="form-group hide_3rd_grade_1st" style="display: none;">
                                        <select name="grades_<?=$PreID ?>" value="<?php echo $Grades?>" class="form-control text-center">
                                            <option value="0"><?php echo $Grades?></option>
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
                                            <option value="CREDITED">CREDITED</option>
                                            <option value="DRP">DRP</option>
                                        </select>
                                    </div>
                                    </center></td>
									<td hidden><center><?php echo $Remarks ?></center></td>
                                    <td hidden><center><?php echo $Year ?></center></td>
									<td hidden><center><?php echo $Semester ?></center></td>
                                    <td hidden><center><input type="text" name="subject_id_fk_<?=$PreID ?>" value="<?=$SubID_3rd_1st?>"></center></td>
                                    <td ><center>
                                    <?php
                                        if($Grades == 0 && $Grades != "INC" && $Grades != "5.0" && $Grades != "DRP" && $Grades != "CREDITED")
                                        {
                                    ?>
                                        <div class="form-group show_3rd_grade_1st">
                                            <?php echo $SY?>
                                        </div>
                                        <div class="form-group hide_3rd_grade_1st" style="display: none;">
                                            <input type="text" name="SY_<?=$PreID ?>" value="<?php echo $SY?>" class="form-control text-center">
                                        </div>
                                    <?php
                                        }
                                        else if($Grades != 0 || $Grades == "INC" || $Grades == "5.0" || $Grades == "DRP" || $Grades == "CREDITED")
                                        {
                                    ?>
                                        <div class="form-group">
                                            <?php echo $SY?>
                                        </div>
                                        <div class="form-group" style="display: none;">
                                            <input type="text" name="SY_<?=$PreID ?>" value="<?php echo $SY?>" class="form-control text-center">
                                        </div>
                                    <?php
                                        }
                                    ?>
                                    </center></td>
                                    <td hidden><center><?php echo $SY ?></center></td>
									<td hidden><center><?php echo $total_grade_units ?></center></td>
									<td><center><button type="button" style="font-size: 1.3rem;" title="Edit" class="fas fa-edit btn rounded btn-success edit3rdSubject1stbtn"></button></center></td>
								</tr>
			<?php
					}				
				}
                $sum_units = "SELECT sum(units) FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid' and yearlevel='3' and semester='1st' and course_id_fk='$courseid'";
                $units_check = mysqli_query($connection,$sum_units);
                $units_total = mysqli_fetch_array($units_check);
                $units_row_3rd_1st = $units_total[0];

                $get_total_grades_3rd_1st = mysqli_query($connection,"SELECT total_grades FROM tbladviser_presubject WHERE total_grades in ('INC','DRP','FAILED','CREDITED') and student_id='$Studid' and curri_id='$Currid' and yearlevel='3' and semester='1st' and course_id_fk='$courseid'");
                if(mysqli_num_rows($get_total_grades_3rd_1st) > 0)
                {
                    $total_grade_units_3rd_1st = '<span data-toggle="tooltip" data-placement="top" class="fas fa-ellipsis-h" title="Average not available due to missing grades/Failed grades/INC grades/Credited subjects."></span>'; 
                }
                else if(mysqli_num_rows($get_total_grades_3rd_1st) == 0)
                {
                    $sum_stud_grade_3rd_1st = "SELECT sum(total_grades) FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid' and yearlevel='3' and semester='1st' and course_id_fk='$courseid'";
                    $check_total_3rd_1st = mysqli_query($connection,$sum_stud_grade_3rd_1st);
                    $fetch_total_3rd_1st = mysqli_fetch_array($check_total_3rd_1st);
                    $total_grade_3rd_1st = $fetch_total_3rd_1st[0];            
                    if($units_row_3rd_1st != 0 && $total_grade_3rd_1st != 0)
                    {
                        $total_grade_units_3rd_1st = round($total_grade_3rd_1st / $units_row_3rd_1st, 4);
                    }
                    else
                    {
                        $total_grade_units_3rd_1st = "";
                    }
                }
                else
                {
                    $total_grade_units_3rd_1st = "";
                }
			?>
								</tbody>
								<tfoot >	
									<!-- table footer -->
                                    <tr>
                                        <td></td>
                                        <td hidden></td>
                                        <td></td>
                                        <td class="fw-bold"><center>Total:</center></td>
                                        <td></td>
                                        <td></td>
                                        <td class="fw-bold"><center><?php echo $units_row_3rd_1st?></center></td>
                                        <td></td>
                                        <td class="fw-bold"><center>Average: <?php echo $total_grade_units_3rd_1st?></center></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td></td>
                                    </tr>
								</tfoot>
							</table>
                            </form>
						</div>

						<div class="mb-2">
                            <form action="managedata.php" method="POST">
                                <input type="hidden" name="studid" value="<?php echo $Studid?>">
                                <input type="hidden" name="currid" value="<?php echo $Currid ?>">
                                <div class="row mb-2">
                                    <div class="col mt-2" align="left">
                                        <span class="text-uppercase fw-bold">2nd Semester</span>
                                    </div>
                                    <div class="col" align="right">
                                        <button type="submit" name="but_update" id="button_update_3rd_2nd" class="btn btn-success" style="display: none;">Save</button>
                                    </div>
                                </div>
			<?php
				$check_3rd_subject_2nd = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid' and yearlevel='3' and semester='2nd' and course_id_fk='$courseid'");
			?>
							<table class="table table-striped" id="table32ndsem" width="100%">
								<thead class="text-white">
									<tr>
                                        <th ><center><input type="checkbox" id="chckAll3rdsem2nd"></center></th>
										<th hidden><center>id</center></th>
										<th><center>Code</center></th>
										<th width="25%"><center>Title</center></th>
										<th scope="col"><center>Lec</center></th>
										<th scope="col"><center>Lab</center></th>
										<th scope="col"><center>Units</center></th>
										<th scope="col"><center>Prerequisite</center></th>
										<th scope="col"><center>Grades</center></th>
										<th hidden><center>Remarks</center></th>
                                        <th hidden><center>year</center></th>
										<th hidden><center>semester</center></th>
                                        <th hidden><center>subid</center></th>
                                        <th ><center>SY</center></th>
                                        <th hidden><center>SY</center></th>
                                        <th hidden><center>Total Grades</center></th>
										<th scope="col"><center>Action</center></th>
									</tr>
								</thead>
								<tbody>
			<?php
				if(mysqli_num_rows($check_3rd_subject_2nd) > 0)
                {
                    while($fa = mysqli_fetch_array($check_3rd_subject_2nd))
                    {
                        $PreID = $fa['id'];
						$SubID_3rd_2nd = $fa['subject_id_fk'];
                        $Course_id = $fa['course_id_fk'];
						$Grades = $fa['grades'];
						$Remarks = $fa['remarks'];
                        $Year = $fa['yearlevel'];
                        $Semester = $fa['semester'];
                        $SY = $fa['school_year'];
                        $total_grade_units = $fa['total_grades'];
						$GetSub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$SubID_3rd_2nd'");
						while($su=mysqli_fetch_array($GetSub))
						{
							$SubCode = $su['subject_code'];
							$SubDes = $su['description'];
							$SubLec = $su['lec'];
							$SubLab = $su['lab'];
							$SubUnits = $su['units'];
							$SubPreq = $su['prerequisite'];
						}
                        if($PreID && $Grades == "INC" && $Remarks == "PASSED")
                        {
                            $color_tr_bg = "#FFFF66";
                        }
                        else if($PreID && $Grades == "CREDITED" && $Remarks == "PASSED")
                        {
                            $color_tr_bg = "#00FFFF";
                        }
                        else if($PreID && $Remarks == "PASSED")
                        {
                            $color_tr_bg = "#90EE90";
                        }
                        else if($PreID && $Remarks == "FAILED")
                        {
                            $color_tr_bg = "#FFCCCB";
                        }
                        else
                        {
                            $color_tr_bg = "#F5F5F5";
                        }
			?>
								<tr style="background: <?php echo $color_tr_bg?>">
                                    <td><center><input type="checkbox" name="sub_list_id[]" value="<?php echo $PreID?>" class="check_3rd_sem_2nd"></center></td>
									<td hidden><center><?php echo $fa['id'] ?></center></td>
									<td><center><?php echo $SubCode ?></center></td>
									<td><center><?php echo $SubDes ?></center></td>
									<td><center><?php echo $SubLec ?></center></td>
									<td><center><?php echo $SubLab ?></center></td>
									<td><center><?php echo $SubUnits ?></center></td>
			<?php
                        if($SubPreq == "NONE")
                        {
                            echo '<td><center>NONE</center></td>';
                        }
                        else if($SubPreq == "HAVE")
                        {              
                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$SubID_3rd_2nd' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                            $get_check = mysqli_query($connection,$checkprereq);
                            $Rows = mysqli_fetch_array($get_check);
                            $SubID = $Rows[0];
                            
                            if($SubID == 1)
                            {
                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$SubID_3rd_2nd' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                $checkpreq = mysqli_query($connection,$getpreq);
                                foreach($checkpreq as $rows)
                                {
                                    $new = $rows['subject_id'];    
                                }
                                $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$new' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                while($sa = mysqli_fetch_array($getsubcode))
                                {
                                    $subCode = $sa['subject_code'];
                                }
                                echo '<td><center>'.$subCode.'</center></td>';
                            }
                            else if($SubID > 1)
                            {
            ?>
								<td><center>
			<?php
                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$SubID_3rd_2nd' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                foreach($getpreq as $rows)
                                {
                                    $news = $rows['subject_id'];    
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$news' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
                                        print_r($sa['subject_code']);
                                        echo "\t";
                                    }                                                 
                                }
            ?>
								</center></td>
			<?php
                            }
                        }
            ?>
									<td><center>
                                    <div class="form-group show_3rd_grade_2nd">
                                        <?php echo $Grades?>
                                    </div>
                                    <div class="form-group hide_3rd_grade_2nd" style="display: none;">
                                        <select name="grades_<?=$PreID ?>" value="<?php echo $Grades?>" class="form-control text-center">
                                            <option value="0"><?php echo $Grades?></option>
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
                                            <option value="CREDITED">CREDITED</option>
                                            <option value="DRP">DRP</option>
                                        </select>
                                    </div>
                                    </center></td>
									<td hidden><center><?php echo $Remarks ?></center></td>
                                    <td hidden><center><?php echo $Year ?></center></td>
									<td hidden><center><?php echo $Semester ?></center></td>
                                    <td hidden><center><input type="text" name="subject_id_fk_<?=$PreID ?>" value="<?=$SubID_3rd_2nd?>"></center></td>
                                    <td ><center>
                                    <?php
                                        if($Grades == 0 && $Grades != "INC" && $Grades != "5.0" && $Grades != "DRP" && $Grades != "CREDITED")
                                        {
                                    ?>
                                        <div class="form-group show_3rd_grade_2nd">
                                            <?php echo $SY?>
                                        </div>
                                        <div class="form-group hide_3rd_grade_2nd" style="display: none;">
                                            <input type="text" name="SY_<?=$PreID ?>" value="<?php echo $SY?>" class="form-control text-center">
                                        </div>
                                    <?php
                                        }
                                        else if($Grades != 0 || $Grades == "INC" || $Grades == "5.0" || $Grades == "DRP" || $Grades == "CREDITED")
                                        {
                                    ?>
                                        <div class="form-group">
                                            <?php echo $SY?>
                                        </div>
                                        <div class="form-group" style="display: none;">
                                            <input type="text" name="SY_<?=$PreID ?>" value="<?php echo $SY?>" class="form-control text-center">
                                        </div>
                                    <?php
                                        }
                                    ?>
                                    </center></td>
                                    <td hidden><center><?php echo $SY ?></center></td>
									<td hidden><center><?php echo $total_grade_units ?></center></td>
									<td><center><button type="button" style="font-size: 1.3rem;" title="Edit" class="fas fa-edit btn rounded btn-success edit3rdSubject2ndbtn"></button></center></td>
								</tr>
			<?php
					}				
				}
                $sum_units = "SELECT sum(units) FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid' and yearlevel='3' and semester='2nd' and course_id_fk='$courseid'";
                $units_check = mysqli_query($connection,$sum_units);
                $units_total = mysqli_fetch_array($units_check);
                $units_row_3rd_2nd = $units_total[0];

                $get_total_grades_3rd_2nd = mysqli_query($connection,"SELECT total_grades FROM tbladviser_presubject WHERE total_grades in ('INC','DRP','FAILED','CREDITED') and student_id='$Studid' and curri_id='$Currid' and yearlevel='3' and semester='2nd' and course_id_fk='$courseid'");
                if(mysqli_num_rows($get_total_grades_3rd_2nd) > 0)
                {
                    $total_grade_units_3rd_2nd = '<span data-toggle="tooltip" data-placement="top" class="fas fa-ellipsis-h" title="Average not available due to missing grades/Failed grades/INC grades/Credited subjects."></span>'; 
                }
                else if(mysqli_num_rows($get_total_grades_3rd_2nd) == 0)
                {
                    $sum_stud_grade_3rd_2nd = "SELECT sum(total_grades) FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid' and yearlevel='3' and semester='2nd' and course_id_fk='$courseid'";
                    $check_total_3rd_2nd = mysqli_query($connection,$sum_stud_grade_3rd_2nd);
                    $fetch_total_3rd_2nd = mysqli_fetch_array($check_total_3rd_2nd);
                    $total_grade_3rd_2nd = $fetch_total_3rd_2nd[0];            
                    if($units_row_3rd_2nd != 0 && $total_grade_3rd_2nd != 0)
                    {
                        $total_grade_units_3rd_2nd = round($total_grade_3rd_2nd / $units_row_3rd_2nd, 4);
                    }
                    else
                    {
                        $total_grade_units_3rd_2nd = "";
                    }
                }
                else
                {
                    $total_grade_units_3rd_2nd = "";
                }
			?>
								</tbody>
								<tfoot >	
									<!-- table footer -->
                                    <tr>
                                        <td></td>
                                        <td hidden></td>
                                        <td></td>
                                        <td class="fw-bold"><center>Total:</center></td>
                                        <td></td>
                                        <td></td>
                                        <td class="fw-bold"><center><?php echo $units_row_3rd_2nd?></center></td>
                                        <td></td>
                                        <td class="fw-bold"><center>Average: <?php echo $total_grade_units_3rd_2nd?></center></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td></td>
                                    </tr>
								</tfoot>
							</table>
                            </form>
						</div>

                        <div class="mb-2">
                            <form action="managedata.php" method="POST">
                                <input type="hidden" name="studid" value="<?php echo $Studid?>">
                                <input type="hidden" name="currid" value="<?php echo $Currid ?>">
                                <div class="row mb-2">
                                    <div class="col mt-2" align="left">
                                        <span class="text-uppercase fw-bold">Summer</span>
                                    </div>
                                    <div class="col" align="right">
                                        <button type="submit" name="but_update" id="button_update_3rd_summer" class="btn btn-success" style="display: none;">Save</button>
                                    </div>
                                </div>
			<?php
				$check_3rd_subject_summer = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid' and yearlevel='3' and semester='summer' and course_id_fk='$courseid'");
			?>
							<table class="table table-striped" id="table3summersem" width="100%">
								<thead class="text-white">
									<tr>
                                        <th ><center><input type="checkbox" id="chckAll3rdsemsummer"></center></th>
										<th hidden><center>id</center></th>
										<th><center>Code</center></th>
										<th width="25%"><center>Title</center></th>
										<th scope="col"><center>Lec</center></th>
										<th scope="col"><center>Lab</center></th>
										<th scope="col"><center>Units</center></th>
										<th scope="col"><center>Prerequisite</center></th>
										<th scope="col"><center>Grades</center></th>
										<th hidden><center>Remarks</center></th>
                                        <th hidden><center>year</center></th>
										<th hidden><center>semester</center></th>
                                        <th hidden><center>subid</center></th>
                                        <th ><center>SY</center></th>
                                        <th hidden><center>SY</center></th>
                                        <th hidden><center>Total Grades</center></th>
										<th scope="col"><center>Action</center></th>
									</tr>
								</thead>
								<tbody>
			<?php
				if(mysqli_num_rows($check_3rd_subject_summer) > 0)
                {
                    while($fa = mysqli_fetch_array($check_3rd_subject_summer))
                    {
                        $PreID = $fa['id'];
						$SubID_3rd_summer = $fa['subject_id_fk'];
                        $Course_id = $fa['course_id_fk'];
						$Grades = $fa['grades'];
						$Remarks = $fa['remarks'];
                        $Year = $fa['yearlevel'];
                        $Semester = $fa['semester'];
                        $SY = $fa['school_year'];
                        $total_grade_units = $fa['total_grades'];
						$GetSub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$SubID_3rd_summer'");
						while($su=mysqli_fetch_array($GetSub))
						{
							$SubCode = $su['subject_code'];
							$SubDes = $su['description'];
							$SubLec = $su['lec'];
							$SubLab = $su['lab'];
							$SubUnits = $su['units'];
							$SubPreq = $su['prerequisite'];
						}
                        if($PreID && $Grades == "INC" && $Remarks == "PASSED")
                        {
                            $color_tr_bg = "#FFFF66";
                        }
                        else if($PreID && $Grades == "CREDITED" && $Remarks == "PASSED")
                        {
                            $color_tr_bg = "#00FFFF";
                        }
                        else if($PreID && $Remarks == "PASSED")
                        {
                            $color_tr_bg = "#90EE90";
                        }
                        else if($PreID && $Remarks == "FAILED")
                        {
                            $color_tr_bg = "#FFCCCB";
                        }
                        else
                        {
                            $color_tr_bg = "#F5F5F5";
                        }
			?>
								<tr style="background: <?php echo $color_tr_bg?>">
                                    <td><center><input type="checkbox" name="sub_list_id[]" value="<?php echo $PreID?>" class="check_3rd_sem_summer"></center></td>
									<td hidden><center><?php echo $fa['id'] ?></center></td>
									<td><center><?php echo $SubCode ?></center></td>
									<td><center><?php echo $SubDes ?></center></td>
									<td><center><?php echo $SubLec ?></center></td>
									<td><center><?php echo $SubLab ?></center></td>
									<td><center><?php echo $SubUnits ?></center></td>
			<?php
                        if($SubPreq == "NONE")
                        {
                            echo '<td><center>NONE</center></td>';
                        }
                        else if($SubPreq == "HAVE")
                        {              
                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$SubID_3rd_summer' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                            $get_check = mysqli_query($connection,$checkprereq);
                            $Rows = mysqli_fetch_array($get_check);
                            $SubID = $Rows[0];
                            
                            if($SubID == 1)
                            {
                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$SubID_3rd_summer' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                $checkpreq = mysqli_query($connection,$getpreq);
                                foreach($checkpreq as $rows)
                                {
                                    $new = $rows['subject_id'];    
                                }
                                $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$new' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                while($sa = mysqli_fetch_array($getsubcode))
                                {
                                    $subCode = $sa['subject_code'];
                                }
                                echo '<td><center>'.$subCode.'</center></td>';
                            }
                            else if($SubID > 1)
                            {
            ?>
								<td><center>
			<?php
                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$SubID_3rd_summer' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                foreach($getpreq as $rows)
                                {
                                    $news = $rows['subject_id'];    
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$news' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
                                        print_r($sa['subject_code']);
                                        echo "\t";
                                    }                                                 
                                }
            ?>
								</center></td>
			<?php
                            }
                        }
            ?>
									<td><center>
                                    <div class="form-group show_3rd_grade_summer">
                                        <?php echo $Grades?>
                                    </div>
                                    <div class="form-group hide_3rd_grade_summer" style="display: none;">
                                        <select name="grades_<?=$PreID ?>" value="<?php echo $Grades?>" class="form-control text-center">
                                            <option value="0"><?php echo $Grades?></option>
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
                                            <option value="CREDITED">CREDITED</option>
                                            <option value="DRP">DRP</option>
                                        </select>
                                    </div>
                                    </center></td>
									<td hidden><center><?php echo $Remarks ?></center></td>
                                    <td hidden><center><?php echo $Year ?></center></td>
									<td hidden><center><?php echo $Semester ?></center></td>
                                    <td hidden><center><input type="text" name="subject_id_fk_<?=$PreID ?>" value="<?=$SubID_3rd_summer?>"></center></td>
                                    <td ><center>
                                    <?php
                                        if($Grades == 0 && $Grades != "INC" && $Grades != "5.0" && $Grades != "DRP" && $Grades != "CREDITED")
                                        {
                                    ?>
                                        <div class="form-group show_3rd_grade_summer">
                                            <?php echo $SY?>
                                        </div>
                                        <div class="form-group hide_3rd_grade_summer" style="display: none;">
                                            <input type="text" name="SY_<?=$PreID ?>" value="<?php echo $SY?>" class="form-control text-center">
                                        </div>
                                    <?php
                                        }
                                        else if($Grades != 0 || $Grades == "INC" || $Grades == "5.0" || $Grades == "DRP" || $Grades == "CREDITED")
                                        {
                                    ?>
                                        <div class="form-group">
                                            <?php echo $SY?>
                                        </div>
                                        <div class="form-group" style="display: none;">
                                            <input type="text" name="SY_<?=$PreID ?>" value="<?php echo $SY?>" class="form-control text-center">
                                        </div>
                                    <?php
                                        }
                                    ?>
                                    </center></td>
                                    <td hidden><center><?php echo $SY ?></center></td>
									<td hidden><center><?php echo $total_grade_units ?></center></td>
									<td><center><button type="button" style="font-size: 1.3rem;" title="Edit" class="fas fa-edit btn rounded btn-success edit3rdSubjectsummerbtn"></button></center></td>
								</tr>
			<?php
					}				
				}
                $sum_units = "SELECT sum(units) FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid' and yearlevel='3' and semester='summer' and course_id_fk='$courseid'";
                $units_check = mysqli_query($connection,$sum_units);
                $units_total = mysqli_fetch_array($units_check);
                $units_row_3rd_summer = $units_total[0];

                $get_total_grades_3rd_summer = mysqli_query($connection,"SELECT total_grades FROM tbladviser_presubject WHERE total_grades in ('INC','DRP','FAILED','CREDITED') and student_id='$Studid' and curri_id='$Currid' and yearlevel='3' and semester='summer' and course_id_fk='$courseid'");
                if(mysqli_num_rows($get_total_grades_3rd_summer) > 0)
                {
                    $total_grade_units_3rd_summer = '<span data-toggle="tooltip" data-placement="top" class="fas fa-ellipsis-h" title="Average not available due to missing grades/Failed grades/INC grades/Credited subjects."></span>'; 
                }
                else if(mysqli_num_rows($get_total_grades_3rd_summer) == 0)
                {
                    $sum_stud_grade_3rd_summer = "SELECT sum(total_grades) FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid' and yearlevel='3' and semester='summer' and course_id_fk='$courseid'";
                    $check_total_3rd_summer = mysqli_query($connection,$sum_stud_grade_3rd_summer);
                    $fetch_total_3rd_summer = mysqli_fetch_array($check_total_3rd_summer);
                    $total_grade_3rd_summer = $fetch_total_3rd_summer[0];            
                    if($units_row_3rd_summer != 0 && $total_grade_3rd_summer != 0)
                    {
                        $total_grade_units_3rd_summer = round($total_grade_3rd_summer / $units_row_3rd_summer, 4);
                    }
                    else
                    {
                        $total_grade_units_3rd_summer = "";
                    }
                }
                else
                {
                    $total_grade_units_3rd_summer = "";
                }
			?>
								</tbody>
								<tfoot >	
									<!-- table footer -->
                                    <tr>
                                        <td></td>
                                        <td hidden></td>
                                        <td></td>
                                        <td class="fw-bold"><center>Total:</center></td>
                                        <td></td>
                                        <td></td>
                                        <td class="fw-bold"><center><?php echo $units_row_3rd_summer?></center></td>
                                        <td></td>
                                        <td class="fw-bold"><center>Average: <?php echo $total_grade_units_3rd_summer?></center></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td></td>
                                    </tr>
								</tfoot>
							</table>
                            </form>
						</div>

					</div>
		
					<div class="mt-4 mb-4" id="fourthYear">
						<div class="border-bottom mb-2">
                            <form action="managedata.php" method="POST">
                                <input type="hidden" name="studid" value="<?php echo $Studid?>">
                                <input type="hidden" name="currid" value="<?php echo $Currid ?>">
                                <div class="row mb-2">
                                    <div class="col mt-2" align="left">
                                        <span class="text-uppercase fw-bold">1st Semester</span>
                                    </div>
                                    <div class="col" align="right">
                                        <button type="submit" name="but_update" id="button_update_4th_1st" class="btn btn-success" style="display: none;">Save</button>
                                    </div>
                                </div>
			<?php
				$check_4th_subject_1st = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid' and yearlevel='4' and semester='1st' and course_id_fk='$courseid'");
			?>
							<table class="table table-striped" id="table41stsem" width="100%">
								<thead class="text-white">
									<tr>
                                        <th ><center><input type="checkbox" id="chckAll4thsem1st"></center></th>
										<th hidden><center>id</center></th>
										<th><center>Code</center></th>
										<th width="25%"><center>Title</center></th>
										<th scope="col"><center>Lec</center></th>
										<th scope="col"><center>Lab</center></th>
										<th scope="col"><center>Units</center></th>
										<th scope="col"><center>Prerequisite</center></th>
										<th scope="col"><center>Grades</center></th>
										<th hidden><center>Remarks</center></th>
                                        <th hidden><center>year</center></th>
										<th hidden><center>semester</center></th>
                                        <th hidden><center>subid</center></th>
                                        <th ><center>SY</center></th>
                                        <th hidden><center>SY</center></th>
                                        <th hidden><center>Total Grades</center></th>
										<th scope="col"><center>Action</center></th>
									</tr>
								</thead>
								<tbody>
			<?php
				if(mysqli_num_rows($check_4th_subject_1st) > 0)
                {
                    while($fa = mysqli_fetch_array($check_4th_subject_1st))
                    {
                        $PreID = $fa['id'];
						$SubID_4th_1st = $fa['subject_id_fk'];
                        $Course_id = $fa['course_id_fk'];
						$Grades = $fa['grades'];
						$Remarks = $fa['remarks'];
                        $Year = $fa['yearlevel'];
                        $Semester = $fa['semester'];
                        $SY = $fa['school_year'];
                        $total_grade_units = $fa['total_grades'];
						$GetSub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$SubID_4th_1st'");
						while($su=mysqli_fetch_array($GetSub))
						{
							$SubCode = $su['subject_code'];
							$SubDes = $su['description'];
							$SubLec = $su['lec'];
							$SubLab = $su['lab'];
							$SubUnits = $su['units'];
							$SubPreq = $su['prerequisite'];
						}
                        if($PreID && $Grades == "INC" && $Remarks == "PASSED")
                        {
                            $color_tr_bg = "#FFFF66";
                        }
                        else if($PreID && $Grades == "CREDITED" && $Remarks == "PASSED")
                        {
                            $color_tr_bg = "#00FFFF";
                        }
                        else if($PreID && $Remarks == "PASSED")
                        {
                            $color_tr_bg = "#90EE90";
                        }
                        else if($PreID && $Remarks == "FAILED")
                        {
                            $color_tr_bg = "#FFCCCB";
                        }
                        else
                        {
                            $color_tr_bg = "#F5F5F5";
                        }
			?>
								<tr style="background: <?php echo $color_tr_bg?>">
                                    <td><center><input type="checkbox" name="sub_list_id[]" value="<?php echo $PreID?>" class="check_4th_sem_1st"></center></td>
									<td hidden><center><?php echo $fa['id'] ?></center></td>
									<td><center><?php echo $SubCode ?></center></td>
									<td><center><?php echo $SubDes ?></center></td>
									<td><center><?php echo $SubLec ?></center></td>
									<td><center><?php echo $SubLab ?></center></td>
									<td><center><?php echo $SubUnits ?></center></td>
			<?php
                        if($SubPreq == "NONE")
                        {
                            echo '<td><center>NONE</center></td>';
                        }
                        else if($SubPreq == "HAVE")
                        {              
                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$SubID_4th_1st' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                            $get_check = mysqli_query($connection,$checkprereq);
                            $Rows = mysqli_fetch_array($get_check);
                            $SubID = $Rows[0];
                            
                            if($SubID == 1)
                            {
                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$SubID_4th_1st' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                $checkpreq = mysqli_query($connection,$getpreq);
                                foreach($checkpreq as $rows)
                                {
                                    $new = $rows['subject_id'];    
                                }
                                $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$new' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                while($sa = mysqli_fetch_array($getsubcode))
                                {
                                    $subCode = $sa['subject_code'];
                                }
                                echo '<td><center>'.$subCode.'</center></td>';
                            }
                            else if($SubID > 1)
                            {
            ?>
								<td><center>
			<?php
                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$SubID_4th_1st' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                foreach($getpreq as $rows)
                                {
                                    $news = $rows['subject_id'];  
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$news' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
                                        print_r($sa['subject_code']);
                                        echo "\t";
                                    }                                                   
                                }
            ?>
								</center></td>
			<?php
                            }
                        }
            ?>
									<td><center>
                                    <div class="form-group show_4th_grade_1st">
                                        <?php echo $Grades?>
                                    </div>
                                    <div class="form-group hide_4th_grade_1st" style="display: none;">
                                        <select name="grades_<?=$PreID ?>" value="<?php echo $Grades?>" class="form-control text-center">
                                            <option value="0"><?php echo $Grades?></option>
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
                                            <option value="CREDITED">CREDITED</option>
                                            <option value="DRP">DRP</option>
                                        </select>
                                    </div>
                                    </center></td>
									<td hidden><center><?php echo $Remarks ?></center></td>
                                    <td hidden><center><?php echo $Year ?></center></td>
									<td hidden><center><?php echo $Semester ?></center></td>
                                    <td hidden><center><input type="text" name="subject_id_fk_<?=$PreID ?>" value="<?=$SubID_4th_1st?>"></center></td>
                                    <td ><center>
                                    <?php
                                        if($Grades == 0 && $Grades != "INC" && $Grades != "5.0" && $Grades != "DRP" && $Grades != "CREDITED")
                                        {
                                    ?>
                                        <div class="form-group show_4th_grade_1st">
                                            <?php echo $SY?>
                                        </div>
                                        <div class="form-group hide_4th_grade_1st" style="display: none;">
                                            <input type="text" name="SY_<?=$PreID ?>" value="<?php echo $SY?>" class="form-control text-center">
                                        </div>
                                    <?php
                                        }
                                        else if($Grades != 0 || $Grades == "INC" || $Grades == "5.0" || $Grades == "DRP" || $Grades == "CREDITED")
                                        {
                                    ?>
                                        <div class="form-group">
                                            <?php echo $SY?>
                                        </div>
                                        <div class="form-group" style="display: none;">
                                            <input type="text" name="SY_<?=$PreID ?>" value="<?php echo $SY?>" class="form-control text-center">
                                        </div>
                                    <?php
                                        }
                                    ?>
                                    </center></td>
                                    <td hidden><center><?php echo $SY ?></center></td>
									<td hidden><center><?php echo $total_grade_units ?></center></td>
									<td><center><button type="button" style="font-size: 1.3rem;" title="Edit" class="fas fa-edit btn rounded btn-success edit4thSubject1stbtn"></button></center></td>
								</tr>
			<?php
					}				
				}
                $sum_units = "SELECT sum(units) FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid' and yearlevel='4' and semester='1st' and course_id_fk='$courseid'";
                $units_check = mysqli_query($connection,$sum_units);
                $units_total = mysqli_fetch_array($units_check);
                $units_row_4th_1st = $units_total[0];	

                $get_total_grades_4th_1st = mysqli_query($connection,"SELECT total_grades FROM tbladviser_presubject WHERE total_grades in ('INC','DRP','FAILED','CREDITED') and student_id='$Studid' and curri_id='$Currid' and yearlevel='4' and semester='1st' and course_id_fk='$courseid'");
                if(mysqli_num_rows($get_total_grades_4th_1st) > 0)
                {
                    $total_grade_units_4th_1st = '<span data-toggle="tooltip" data-placement="top" class="fas fa-ellipsis-h" title="Average not available due to missing grades/Failed grades/INC grades/Credited subjects."></span>'; 
                }
                else if(mysqli_num_rows($get_total_grades_4th_1st) == 0)
                {
                    $sum_stud_grade_4th_1st = "SELECT sum(total_grades) FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid' and yearlevel='4' and semester='1st' and course_id_fk='$courseid'";
                    $check_total_4th_1st = mysqli_query($connection,$sum_stud_grade_4th_1st);
                    $fetch_total_4th_1st = mysqli_fetch_array($check_total_4th_1st);
                    $total_grade_4th_1st = $fetch_total_4th_1st[0];            
                    if($units_row_4th_1st != 0 && $total_grade_4th_1st != 0)
                    {
                        $total_grade_units_4th_1st = round($total_grade_4th_1st / $units_row_4th_1st, 4);
                    }
                    else
                    {
                        $total_grade_units_4th_1st = "";
                    }
                }
                else
                {
                    $total_grade_units_4th_1st = "";
                }
			?>
								</tbody>
								<tfoot >	
									<!-- table footer -->
                                    <tr>
                                        <td></td>
                                        <td hidden></td>
                                        <td></td>
                                        <td class="fw-bold"><center>Total:</center></td>
                                        <td></td>
                                        <td></td>
                                        <td class="fw-bold"><center><?php echo $units_row_4th_1st?></center></td>
                                        <td></td>
                                        <td class="fw-bold"><center>Average: <?php echo $total_grade_units_4th_1st?></center></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td></td>
                                    </tr>
								</tfoot>
							</table>
                            </form>
						</div>

						<div class="mb-2">
                            <form action="managedata.php" method="POST">
                                <input type="hidden" name="studid" value="<?php echo $Studid?>">
                                <input type="hidden" name="currid" value="<?php echo $Currid ?>">
                                <div class="row mb-2">
                                    <div class="col mt-2" align="left">
                                        <span class="text-uppercase fw-bold">2nd Semester</span>
                                    </div>
                                    <div class="col" align="right">
                                        <button type="submit" name="but_update" id="button_update_4th_2nd" class="btn btn-success" style="display: none;">Save</button>
                                    </div>
                                </div>
			<?php
				$check_4th_subject_2nd = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid' and yearlevel='4' and semester='2nd' and course_id_fk='$courseid'");
			?>
							<table class="table table-striped" id="table42ndsem" width="100%">
								<thead class="text-white">
									<tr>
                                        <th><center><input type="checkbox" id="chckAll4thsem2nd"></center></th>
										<th hidden><center>id</center></th>
										<th><center>Code</center></th>
										<th width="25%"><center>Title</center></th>
										<th scope="col"><center>Lec</center></th>
										<th scope="col"><center>Lab</center></th>
										<th scope="col"><center>Units</center></th>
										<th scope="col"><center>Prerequisite</center></th>
										<th scope="col"><center>Grades</center></th>
										<th hidden><center>Remarks</center></th>
                                        <th hidden><center>year</center></th>
										<th hidden><center>semester</center></th>
                                        <th hidden><center>subid</center></th>
                                        <th ><center>SY</center></th>
                                        <th hidden><center>SY</center></th>
                                        <th hidden><center>Total Grades</center></th>
										<th scope="col"><center>Action</center></th>
									</tr>
								</thead>
								<tbody>
			<?php
				if(mysqli_num_rows($check_4th_subject_2nd) > 0)
                {
                    while($fa = mysqli_fetch_array($check_4th_subject_2nd))
                    {
                        $PreID = $fa['id'];
						$SubID_4th_2nd = $fa['subject_id_fk'];
                        $Course_id = $fa['course_id_fk'];
						$Grades = $fa['grades'];
						$Remarks = $fa['remarks'];
                        $Year = $fa['yearlevel'];
                        $Semester = $fa['semester'];
                        $SY = $fa['school_year'];
                        $total_grade_units = $fa['total_grades'];
						$GetSub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$SubID_4th_2nd'");
						while($su=mysqli_fetch_array($GetSub))
						{
							$SubCode = $su['subject_code'];
							$SubDes = $su['description'];
							$SubLec = $su['lec'];
							$SubLab = $su['lab'];
							$SubUnits = $su['units'];
							$SubPreq = $su['prerequisite'];
						}
                        if($PreID && $Grades == "INC" && $Remarks == "PASSED")
                        {
                            $color_tr_bg = "#FFFF66";
                        }
                        else if($PreID && $Grades == "CREDITED" && $Remarks == "PASSED")
                        {
                            $color_tr_bg = "#00FFFF";
                        }
                        else if($PreID && $Remarks == "PASSED")
                        {
                            $color_tr_bg = "#90EE90";
                        }
                        else if($PreID && $Remarks == "FAILED")
                        {
                            $color_tr_bg = "#FFCCCB";
                        }
                        else
                        {
                            $color_tr_bg = "#F5F5F5";
                        }
			?>
								<tr style="background: <?php echo $color_tr_bg?>">
                                    <td><center><input type="checkbox" name="sub_list_id[]" value="<?php echo $PreID?>" class="check_4th_sem_2nd"></center></td>
									<td hidden><center><?php echo $fa['id'] ?></center></td>
									<td><center><?php echo $SubCode ?></center></td>
									<td><center><?php echo $SubDes ?></center></td>
									<td><center><?php echo $SubLec ?></center></td>
									<td><center><?php echo $SubLab ?></center></td>
									<td><center><?php echo $SubUnits ?></center></td>
			<?php
                        if($SubPreq == "NONE")
                        {
                            echo '<td><center>NONE</center></td>';
                        }
                        else if($SubPreq == "HAVE")
                        {              
                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$SubID_4th_2nd' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                            $get_check = mysqli_query($connection,$checkprereq);
                            $Rows = mysqli_fetch_array($get_check);
                            $SubID = $Rows[0];
                            
                            if($SubID == 1)
                            {
                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$SubID_4th_2nd' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                $checkpreq = mysqli_query($connection,$getpreq);
                                foreach($checkpreq as $rows)
                                {
                                    $new = $rows['subject_id'];    
                                }
                                $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$new' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                while($sa = mysqli_fetch_array($getsubcode))
                                {
                                    $subCode = $sa['subject_code'];
                                }
                                echo '<td><center>'.$subCode.'</center></td>';
                            }
                            else if($SubID > 1)
                            {
            ?>
								<td><center>
			<?php
                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$SubID_4th_2nd' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                foreach($getpreq as $rows)
                                {
                                    $news = $rows['subject_id'];    
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$news' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
                                        print_r($sa['subject_code']);
                                        echo "\t";
                                    }                                                 
                                }
            ?>
								</center></td>
			<?php
                            }
                        }
            ?>
									<td><center>
                                    <div class="form-group show_4th_grade_2nd">
                                        <?php echo $Grades?>
                                    </div>

                                    <div class="form-group hide_4th_grade_2nd" style="display: none;">
                                        <select name="grades_<?=$PreID ?>" value="<?php echo $Grades?>" class="form-control text-center">
                                            <option value="0"><?php echo $Grades?></option>
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
                                            <option value="CREDITED">CREDITED</option>
                                            <option value="DRP">DRP</option>
                                        </select>
                                    </div>
                                    </center></td>
									<td hidden><center><?php echo $Remarks ?></center></td>
                                    <td hidden><center><?php echo $Year ?></center></td>
									<td hidden><center><?php echo $Semester ?></center></td>
                                    <td hidden><center><input type="text" name="subject_id_fk_<?=$PreID ?>" value="<?=$SubID_4th_2nd?>"></center></td>
									<td><center>
                                    <?php
                                        if($Grades == 0 && $Grades != "INC" && $Grades != "5.0" && $Grades != "DRP" && $Grades != "CREDITED")
                                        {
                                    ?>
                                        <div class="form-group show_4th_grade_2nd">
                                            <?php echo $SY?>
                                        </div>
                                        <div class="form-group hide_4th_grade_2nd" style="display: none;">
                                            <input type="text" name="SY_<?=$PreID ?>" value="<?php echo $SY?>" class="form-control text-center">
                                        </div>
                                    <?php
                                        }
                                        else if($Grades != 0 || $Grades == "INC" || $Grades == "5.0" || $Grades == "DRP" || $Grades == "CREDITED")
                                        {
                                    ?>
                                        <div class="form-group">
                                            <?php echo $SY?>
                                        </div>
                                        <div class="form-group" style="display: none;">
                                            <input type="text" name="SY_<?=$PreID ?>" value="<?php echo $SY?>" class="form-control text-center">
                                        </div>
                                    <?php
                                        }
                                    ?>
                                    </center></td>
                                    <td hidden><center><?php echo $SY ?></center></td>
									<td hidden><center><?php echo $total_grade_units ?></center></td>
                                    <td><center><button type="button" style="font-size: 1.3rem;" title="Edit" class="fas fa-edit btn rounded btn-success edit4thSubject2ndbtn"></button></center></td>
								</tr>
			<?php
					}				
				}
                $sum_units = "SELECT sum(units) FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid' and yearlevel='4' and semester='2nd' and course_id_fk='$courseid'";
                $units_check = mysqli_query($connection,$sum_units);
                $units_total = mysqli_fetch_array($units_check);
                $units_row_4th_2nd = $units_total[0];	

                $get_total_grades_4th_2nd = mysqli_query($connection,"SELECT total_grades FROM tbladviser_presubject WHERE total_grades in ('INC','DRP','FAILED','CREDITED') and student_id='$Studid' and curri_id='$Currid' and yearlevel='4' and semester='2nd' and course_id_fk='$courseid'");
                if(mysqli_num_rows($get_total_grades_4th_2nd) > 0)
                {
                    $total_grade_units_4th_2nd = '<span data-toggle="tooltip" data-placement="top" class="fas fa-ellipsis-h" title="Average not available due to missing grades/Failed grades/INC grades/Credited subjects."></span>'; 
                }
                else if(mysqli_num_rows($get_total_grades_4th_2nd) == 0)
                {
                    $sum_stud_grade_4th_2nd = "SELECT sum(total_grades) FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid' and yearlevel='4' and semester='2nd' and course_id_fk='$courseid'";
                    $check_total_4th_2nd = mysqli_query($connection,$sum_stud_grade_4th_2nd);
                    $fetch_total_4th_2nd = mysqli_fetch_array($check_total_4th_2nd);
                    $total_grade_4th_2nd = $fetch_total_4th_2nd[0];            
                    if($units_row_4th_2nd != 0 && $total_grade_4th_2nd != 0)
                    {
                        $total_grade_units_4th_2nd = round($total_grade_4th_2nd / $units_row_4th_2nd, 4);
                    }
                    else
                    {
                        $total_grade_units_4th_2nd = "";
                    }
                }
                else
                {
                    $total_grade_units_4th_2nd = "";
                }
			?>
								</tbody>
								<tfoot >	
									<!-- table footer -->
                                    <tr>
                                        <td></td>
                                        <td hidden></td>
                                        <td></td>
                                        <td class="fw-bold"><center>Total:</center></td>
                                        <td></td>
                                        <td></td>
                                        <td class="fw-bold"><center><?php echo $units_row_4th_2nd?></center></td>
                                        <td></td>
                                        <td class="fw-bold"><center>Average: <?php echo $total_grade_units_4th_2nd?></center></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td></td>
                                    </tr>
								</tfoot>
							</table>
                            </form>
						</div>

                        <div class="mb-2">
                            <form action="managedata.php" method="POST">
                                <input type="hidden" name="studid" value="<?php echo $Studid?>">
                                <input type="hidden" name="currid" value="<?php echo $Currid ?>">
                                <div class="row mb-2">
                                    <div class="col mt-2" align="left">
                                        <span class="text-uppercase fw-bold">Summer</span>
                                    </div>
                                    <div class="col" align="right">
                                        <button type="submit" name="but_update" id="button_update_4th_summer" class="btn btn-success" style="display: none;">Save</button>
                                    </div>
                                </div>
			<?php
				$check_4th_subject_summer = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid' and yearlevel='4' and semester='summer' and course_id_fk='$courseid'");
			?>
							<table class="table table-striped" id="table4summersem" width="100%">
								<thead class="text-white">
									<tr>
                                        <th><center><input type="checkbox" id="chckAll4thsemsummer"></center></th>
										<th hidden><center>id</center></th>
										<th><center>Code</center></th>
										<th width="25%"><center>Title</center></th>
										<th scope="col"><center>Lec</center></th>
										<th scope="col"><center>Lab</center></th>
										<th scope="col"><center>Units</center></th>
										<th scope="col"><center>Prerequisite</center></th>
										<th scope="col"><center>Grades</center></th>
										<th hidden><center>Remarks</center></th>
                                        <th hidden><center>year</center></th>
										<th hidden><center>semester</center></th>
                                        <th hidden><center>subid</center></th>
                                        <th ><center>SY</center></th>
                                        <th hidden><center>SY</center></th>
                                        <th hidden><center>Total Grades</center></th>
										<th scope="col"><center>Action</center></th>
									</tr>
								</thead>
								<tbody>
			<?php
				if(mysqli_num_rows($check_4th_subject_summer) > 0)
                {
                    while($fa = mysqli_fetch_array($check_4th_subject_summer))
                    {
                        $PreID = $fa['id'];
						$SubID_4th_summer = $fa['subject_id_fk'];
                        $Course_id = $fa['course_id_fk'];
						$Grades = $fa['grades'];
						$Remarks = $fa['remarks'];
                        $Year = $fa['yearlevel'];
                        $Semester = $fa['semester'];
                        $SY = $fa['school_year'];
                        $total_grade_units = $fa['total_grades'];
						$GetSub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$SubID_4th_summer'");
						while($su=mysqli_fetch_array($GetSub))
						{
							$SubCode = $su['subject_code'];
							$SubDes = $su['description'];
							$SubLec = $su['lec'];
							$SubLab = $su['lab'];
							$SubUnits = $su['units'];
							$SubPreq = $su['prerequisite'];
						}
                        if($PreID && $Grades == "INC" && $Remarks == "PASSED")
                        {
                            $color_tr_bg = "#FFFF66";
                        }
                        else if($PreID && $Grades == "CREDITED" && $Remarks == "PASSED")
                        {
                            $color_tr_bg = "#00FFFF";
                        }
                        else if($PreID && $Remarks == "PASSED")
                        {
                            $color_tr_bg = "#90EE90";
                        }
                        else if($PreID && $Remarks == "FAILED")
                        {
                            $color_tr_bg = "#FFCCCB";
                        }
                        else
                        {
                            $color_tr_bg = "#F5F5F5";
                        }
			?>
								<tr style="background: <?php echo $color_tr_bg?>">
                                    <td><center><input type="checkbox" name="sub_list_id[]" value="<?php echo $PreID?>" class="check_4th_sem_summer"></center></td>
									<td hidden><center><?php echo $fa['id'] ?></center></td>
									<td><center><?php echo $SubCode ?></center></td>
									<td><center><?php echo $SubDes ?></center></td>
									<td><center><?php echo $SubLec ?></center></td>
									<td><center><?php echo $SubLab ?></center></td>
									<td><center><?php echo $SubUnits ?></center></td>
			<?php
                        if($SubPreq == "NONE")
                        {
                            echo '<td><center>NONE</center></td>';
                        }
                        else if($SubPreq == "HAVE")
                        {              
                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$SubID_4th_summer' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                            $get_check = mysqli_query($connection,$checkprereq);
                            $Rows = mysqli_fetch_array($get_check);
                            $SubID = $Rows[0];
                            
                            if($SubID == 1)
                            {
                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$SubID_4th_summer' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                $checkpreq = mysqli_query($connection,$getpreq);
                                foreach($checkpreq as $rows)
                                {
                                    $new = $rows['subject_id'];    
                                }
                                $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$new' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                while($sa = mysqli_fetch_array($getsubcode))
                                {
                                    $subCode = $sa['subject_code'];
                                }
                                echo '<td><center>'.$subCode.'</center></td>';
                            }
                            else if($SubID > 1)
                            {
            ?>
								<td><center>
			<?php
                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$SubID_4th_summer' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                foreach($getpreq as $rows)
                                {
                                    $news = $rows['subject_id'];    
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$news' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
                                        print_r($sa['subject_code']);
                                        echo "\t";
                                    }                                                 
                                }
            ?>
								</center></td>
			<?php
                            }
                        }
            ?>
									<td><center>
                                    <div class="form-group show_4th_grade_summer">
                                        <?php echo $Grades?>
                                    </div>
                                    <div class="form-group hide_4th_grade_summer" style="display: none;">
                                        <select name="grades_<?=$PreID ?>" value="<?php echo $Grades?>" class="form-control text-center">
                                            <option value="0"><?php echo $Grades?></option>
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
                                            <option value="CREDITED">CREDITED</option>
                                            <option value="DRP">DRP</option>
                                        </select>
                                    </div>
                                    </center></td>
									<td hidden><center><?php echo $Remarks ?></center></td>
                                    <td hidden><center><?php echo $Year ?></center></td>
									<td hidden><center><?php echo $Semester ?></center></td>
                                    <td hidden><center><input type="text" name="subject_id_fk_<?=$PreID ?>" value="<?=$SubID_4th_summer?>"></center></td>
									<td><center>
                                    <?php
                                        if($Grades == 0 && $Grades != "INC" && $Grades != "5.0" && $Grades != "DRP" && $Grades != "CREDITED")
                                        {
                                    ?>
                                        <div class="form-group show_4th_grade_summer">
                                            <?php echo $SY?>
                                        </div>
                                        <div class="form-group hide_4th_grade_summer" style="display: none;">
                                            <input type="text" name="SY_<?=$PreID ?>" value="<?php echo $SY?>" class="form-control text-center">
                                        </div>
                                    <?php
                                        }
                                        else if($Grades != 0 || $Grades == "INC" || $Grades == "5.0" || $Grades == "DRP" || $Grades == "CREDITED")
                                        {
                                    ?>
                                        <div class="form-group">
                                            <?php echo $SY?>
                                        </div>
                                        <div class="form-group" style="display: none;">
                                            <input type="text" name="SY_<?=$PreID ?>" value="<?php echo $SY?>" class="form-control text-center">
                                        </div>
                                    <?php
                                        }
                                    ?>
                                    </center></td>
                                    <td hidden><center><?php echo $SY ?></center></td>
									<td hidden><center><?php echo $total_grade_units ?></center></td>
                                    <td><center><button type="button" style="font-size: 1.3rem;" title="Edit" class="fas fa-edit btn rounded btn-success edit4thSubjectsummerbtn"></button></center></td>
								</tr>
			<?php
					}				
				}
                $sum_units = "SELECT sum(units) FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid' and yearlevel='4' and semester='summer' and course_id_fk='$courseid'";
                $units_check = mysqli_query($connection,$sum_units);
                $units_total = mysqli_fetch_array($units_check);
                $units_row_4th_summer = $units_total[0];
                
                $get_total_grades_4th_summer = mysqli_query($connection,"SELECT total_grades FROM tbladviser_presubject WHERE total_grades in ('INC','DRP','FAILED','CREDITED') and student_id='$Studid' and curri_id='$Currid' and yearlevel='4' and semester='summer' and course_id_fk='$courseid'");
                if(mysqli_num_rows($get_total_grades_4th_summer) > 0)
                {
                    $total_grade_units_4th_summer = '<span data-toggle="tooltip" data-placement="top" class="fas fa-ellipsis-h" title="Average not available due to missing grades/Failed grades/INC grades/Credited subjects."></span>'; 
                }
                else if(mysqli_num_rows($get_total_grades_4th_summer) == 0)
                {
                    $sum_stud_grade_4th_summer = "SELECT sum(total_grades) FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid' and yearlevel='4' and semester='summer' and course_id_fk='$courseid'";
                    $check_total_4th_summer = mysqli_query($connection,$sum_stud_grade_4th_summer);
                    $fetch_total_4th_summer = mysqli_fetch_array($check_total_4th_summer);
                    $total_grade_4th_summer = $fetch_total_4th_summer[0];            
                    if($units_row_4th_summer != 0 && $total_grade_4th_summer != 0)
                    {
                        $total_grade_units_4th_summer = round($total_grade_4th_summer / $units_row_4th_summer, 4);
                    }
                    else
                    {
                        $total_grade_units_4th_summer = "";
                    }
                }
                else
                {
                    $total_grade_units_4th_summer = "";
                }
			?>
								</tbody>
								<tfoot >	
									<!-- table footer -->
                                    <tr>
                                        <td></td>
                                        <td hidden></td>
                                        <td></td>
                                        <td class="fw-bold"><center>Total:</center></td>
                                        <td></td>
                                        <td></td>
                                        <td class="fw-bold"><center><?php echo $units_row_4th_summer?></center></td>
                                        <td></td>
                                        <td class="fw-bold"><center>Average: <?php echo $total_grade_units_4th_summer?></center></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td></td>
                                    </tr>
								</tfoot>
							</table>
                            </form>
						</div>
					</div>
		
					<div class="mt-4 mb-4" id="fifthYear">
						<div class="border-bottom mb-2">
                            <form action="managedata.php" method="POST">
                                <input type="hidden" name="studid" value="<?php echo $Studid?>">
                                <input type="hidden" name="currid" value="<?php echo $Currid ?>">
                                <div class="row mb-2">
                                    <div class="col mt-2" align="left">
                                        <span class="text-uppercase fw-bold">1st Semester</span>
                                    </div>
                                    <div class="col" align="right">
                                        <button type="submit" name="but_update" id="button_update_5th_1st" class="btn btn-success" style="display: none;">Save</button>
                                    </div>
                                </div>
			<?php
				$check_5th_subject_1st = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid' and yearlevel='5' and semester='1st' and course_id_fk='$courseid'");
			?>
							<table class="table table-striped" id="table51stsem" width="100%">
								<thead class="text-white">
									<tr>
                                        <th><center><input type="checkbox" id="chckAll5thsem1st"></center></th>
										<th hidden><center>id</center></th>
										<th><center>Code</center></th>
										<th width="25%"><center>Title</center></th>
										<th scope="col"><center>Lec</center></th>
										<th scope="col"><center>Lab</center></th>
										<th scope="col"><center>Units</center></th>
										<th scope="col"><center>Prerequisite</center></th>
										<th scope="col"><center>Grades</center></th>
										<th hidden><center>Remarks</center></th>
                                        <th hidden><center>year</center></th>
										<th hidden><center>semester</center></th>
                                        <th hidden><center>subid</center></th>
                                        <th ><center>SY</center></th>
                                        <th hidden><center>SY</center></th>
                                        <th hidden><center>Total Grades</center></th>
										<th scope="col"><center>Action</center></th>
									</tr>
								</thead>
								<tbody>
			<?php
				if(mysqli_num_rows($check_5th_subject_1st) > 0)
                {
                    while($fa = mysqli_fetch_array($check_5th_subject_1st))
                    {
                        $PreID = $fa['id'];
						$SubID_5th_1st = $fa['subject_id_fk'];
                        $Course_id = $fa['course_id_fk'];
						$Grades = $fa['grades'];
						$Remarks = $fa['remarks'];
                        $Year = $fa['yearlevel'];
                        $Semester = $fa['semester'];
                        $SY = $fa['school_year'];
                        $total_grade_units = $fa['total_grades'];
						$GetSub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$SubID_5th_1st'");
						while($su=mysqli_fetch_array($GetSub))
						{
							$SubCode = $su['subject_code'];
							$SubDes = $su['description'];
							$SubLec = $su['lec'];
							$SubLab = $su['lab'];
							$SubUnits = $su['units'];
							$SubPreq = $su['prerequisite'];
						}
                        if($PreID && $Grades == "INC" && $Remarks == "PASSED")
                        {
                            $color_tr_bg = "#FFFF66";
                        }
                        else if($PreID && $Grades == "CREDITED" && $Remarks == "PASSED")
                        {
                            $color_tr_bg = "#00FFFF";
                        }
                        else if($PreID && $Remarks == "PASSED")
                        {
                            $color_tr_bg = "#90EE90";
                        }
                        else if($PreID && $Remarks == "FAILED")
                        {
                            $color_tr_bg = "#FFCCCB";
                        }
                        else
                        {
                            $color_tr_bg = "#F5F5F5";
                        }
			?>
								<tr style="background: <?php echo $color_tr_bg?>">
                                    <td><center><input type="checkbox" name="sub_list_id[]" value="<?php echo $PreID?>" class="check_5th_sem_1st"></center></td>
									<td hidden><center><?php echo $fa['id'] ?></center></td>
									<td><center><?php echo $SubCode ?></center></td>
									<td><center><?php echo $SubDes ?></center></td>
									<td><center><?php echo $SubLec ?></center></td>
									<td><center><?php echo $SubLab ?></center></td>
									<td><center><?php echo $SubUnits ?></center></td>
			<?php
                        if($SubPreq == "NONE")
                        {
                            echo '<td><center>NONE</center></td>';
                        }
                        else if($SubPreq == "HAVE")
                        {              
                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$SubID_5th_1st' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                            $get_check = mysqli_query($connection,$checkprereq);
                            $Rows = mysqli_fetch_array($get_check);
                            $SubID = $Rows[0];
                            
                            if($SubID == 1)
                            {
                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$SubID_5th_1st' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                $checkpreq = mysqli_query($connection,$getpreq);
                                foreach($checkpreq as $rows)
                                {
                                    $new = $rows['subject_id'];    
                                }
                                $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$new' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                while($sa = mysqli_fetch_array($getsubcode))
                                {
                                    $subCode = $sa['subject_code'];
                                }
                                echo '<td><center>'.$subCode.'</center></td>';
                            }
                            else if($SubID > 1)
                            {
            ?>
								<td><center>
			<?php
                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$SubID_5th_1st' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                foreach($getpreq as $rows)
                                {
                                    $news = $rows['subject_id'];   
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$news' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
                                        print_r($sa['subject_code']);
                                        echo "\t";
                                    }                                                  
                                }
            ?>
								</center></td>
			<?php
                            }
                        }
            ?>
									<td><center>
                                    <div class="form-group show_5th_grade_1st">
                                        <?php echo $Grades?>
                                    </div>
                                    <div class="form-group hide_5th_grade_1st" style="display: none;">
                                        <select name="grades_<?=$PreID ?>" value="<?php echo $Grades?>" class="form-control text-center">
                                            <option value="0"><?php echo $Grades?></option>
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
                                            <option value="CREDITED">CREDITED</option>
                                            <option value="DRP">DRP</option>
                                        </select>
                                    </div>
                                    </center></td>
									<td hidden><center><?php echo $Remarks ?></center></td>
                                    <td hidden><center><?php echo $Year ?></center></td>
									<td hidden><center><?php echo $Semester ?></center></td>
                                    <td hidden><center><input type="text" name="subject_id_fk_<?=$PreID ?>" value="<?=$SubID_5th_1st?>"></center></td>
                                    <td ><center>
                                    <?php
                                        if($Grades == 0 && $Grades != "INC" && $Grades != "5.0" && $Grades != "DRP" && $Grades != "CREDITED")
                                        {
                                    ?>
                                        <div class="form-group show_5th_grade_1st">
                                            <?php echo $SY?>
                                        </div>
                                        <div class="form-group hide_5th_grade_1st" style="display: none;">
                                            <input type="text" name="SY_<?=$PreID ?>" value="<?php echo $SY?>" class="form-control text-center">
                                        </div>
                                    <?php
                                        }
                                        else if($Grades != 0 || $Grades == "INC" || $Grades == "5.0" || $Grades == "DRP" || $Grades == "CREDITED")
                                        {
                                    ?>
                                        <div class="form-group">
                                            <?php echo $SY?>
                                        </div>
                                        <div class="form-group" style="display: none;">
                                            <input type="text" name="SY_<?=$PreID ?>" value="<?php echo $SY?>" class="form-control text-center">
                                        </div>
                                    <?php
                                        }
                                    ?>
                                    </center></td>
                                    <td hidden><center><?php echo $SY ?></center></td>
									<td hidden><center><?php echo $total_grade_units ?></center></td>
									<td><center><button type="button" style="font-size: 1.3rem;" title="Edit" class="fas fa-edit btn rounded btn-success edit5thSubject1stbtn"></button></center></td>
								</tr>
			<?php
					}				
				}
                $sum_units = "SELECT sum(units) FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid' and yearlevel='5' and semester='1st' and course_id_fk='$courseid'";
                $units_check = mysqli_query($connection,$sum_units);
                $units_total = mysqli_fetch_array($units_check);
                $units_row_5th_1st = $units_total[0];

                $get_total_grades_5th_1st = mysqli_query($connection,"SELECT total_grades FROM tbladviser_presubject WHERE total_grades in ('INC','DRP','FAILED','CREDITED') and student_id='$Studid' and curri_id='$Currid' and yearlevel='5' and semester='1st' and course_id_fk='$courseid'");
                if(mysqli_num_rows($get_total_grades_5th_1st) > 0)
                {
                    $total_grade_units_5th_1st = '<span data-toggle="tooltip" data-placement="top" class="fas fa-ellipsis-h" title="Average not available due to missing grades/Failed grades/INC grades/Credited subjects."></span>'; 
                }
                else if(mysqli_num_rows($get_total_grades_5th_1st) == 0)
                {
                    $sum_stud_grade_5th_1st = "SELECT sum(total_grades) FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid' and yearlevel='5' and semester='1st' and course_id_fk='$courseid'";
                    $check_total_5th_1st = mysqli_query($connection,$sum_stud_grade_5th_1st);
                    $fetch_total_5th_1st = mysqli_fetch_array($check_total_5th_1st);
                    $total_grade_5th_1st = $fetch_total_5th_1st[0];            
                    if($units_row_5th_1st != 0 && $total_grade_5th_1st != 0)
                    {
                        $total_grade_units_5th_1st = round($total_grade_5th_1st / $units_row_5th_1st, 4);
                    }
                    else
                    {
                        $total_grade_units_5th_1st = "";
                    }
                }
                else
                {
                    $total_grade_units_5th_1st = "";
                }
			?>
								</tbody>
								<tfoot >	
									<!-- table footer -->
                                    <tr>
                                        <td></td>
                                        <td hidden></td>
                                        <td></td>
                                        <td class="fw-bold"><center>Total:</center></td>
                                        <td></td>
                                        <td></td>
                                        <td class="fw-bold"><center><?php echo $units_row_5th_1st?></center></td>
                                        <td></td>
                                        <td class="fw-bold"><center>Average: <?php echo $total_grade_units_5th_1st?></center></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td></td>
                                    </tr>
								</tfoot>
							</table>
                            </form>
						</div>

						<div class="mb-2">
                            <form action="managedata.php" method="POST">
                                <input type="hidden" name="studid" value="<?php echo $Studid?>">
                                <input type="hidden" name="currid" value="<?php echo $Currid ?>">
                                <div class="row mb-2">
                                    <div class="col mt-2" align="left">
                                        <span class="text-uppercase fw-bold">2nd Semester</span>
                                    </div>
                                    <div class="col" align="right">
                                        <button type="submit" name="but_update" id="button_update_5th_2nd" class="btn btn-success" style="display: none;">Save</button>
                                    </div>
                                </div>
			<?php
				$check_5th_subject_2nd = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid' and yearlevel='5' and semester='2nd' and course_id_fk='$courseid'");
			?>
							<table class="table table-striped" id="table52ndsem" width="100%">
								<thead class="text-white">
									<tr>
                                        <th><center><input type="checkbox" id="chckAll5thsem2nd"></center></th>
										<th hidden><center>id</center></th>
										<th><center>Code</center></th>
										<th width="25%"><center>Title</center></th>
										<th scope="col"><center>Lec</center></th>
										<th scope="col"><center>Lab</center></th>
										<th scope="col"><center>Units</center></th>
										<th scope="col"><center>Prerequisite</center></th>
										<th scope="col"><center>Grades</center></th>
										<th hidden><center>Remarks</center></th>
                                        <th hidden><center>year</center></th>
										<th hidden><center>semester</center></th>
                                        <th hidden><center>subid</center></th>
                                        <th ><center>SY</center></th>
                                        <th hidden><center>SY</center></th>
                                        <th hidden><center>Total Grades</center></th>
										<th scope="col"><center>Action</center></th>
									</tr>
								</thead>
								<tbody>
			<?php
				if(mysqli_num_rows($check_5th_subject_2nd) > 0)
                {
                    while($fa = mysqli_fetch_array($check_5th_subject_2nd))
                    {
                        $PreID = $fa['id'];
						$SubID_5th_2nd = $fa['subject_id_fk'];
                        $Course_id = $fa['course_id_fk'];
						$Grades = $fa['grades'];
						$Remarks = $fa['remarks'];
                        $Year = $fa['yearlevel'];
                        $Semester = $fa['semester'];
                        $SY = $fa['school_year'];
                        $total_grade_units = $fa['total_grades'];
						$GetSub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$SubID_5th_2nd'");
						while($su=mysqli_fetch_array($GetSub))
						{
							$SubCode = $su['subject_code'];
							$SubDes = $su['description'];
							$SubLec = $su['lec'];
							$SubLab = $su['lab'];
							$SubUnits = $su['units'];
							$SubPreq = $su['prerequisite'];
						}
                        if($PreID && $Grades == "INC" && $Remarks == "PASSED")
                        {
                            $color_tr_bg = "#FFFF66";
                        }
                        else if($PreID && $Grades == "CREDITED" && $Remarks == "PASSED")
                        {
                            $color_tr_bg = "#00FFFF";
                        }
                        else if($PreID && $Remarks == "PASSED")
                        {
                            $color_tr_bg = "#90EE90";
                        }
                        else if($PreID && $Remarks == "FAILED")
                        {
                            $color_tr_bg = "#FFCCCB";
                        }
                        else
                        {
                            $color_tr_bg = "#F5F5F5";
                        }
			?>
								<tr style="background: <?php echo $color_tr_bg?>">
                                    <td><center><input type="checkbox" name="sub_list_id[]" value="<?php echo $PreID?>" class="check_5th_sem_2nd"></center></td>
									<td hidden><center><?php echo $fa['id'] ?></center></td>
									<td><center><?php echo $SubCode ?></center></td>
									<td><center><?php echo $SubDes ?></center></td>
									<td><center><?php echo $SubLec ?></center></td>
									<td><center><?php echo $SubLab ?></center></td>
									<td><center><?php echo $SubUnits ?></center></td>
			<?php
                        if($SubPreq == "NONE")
                        {
                            echo '<td><center>NONE</center></td>';
                        }
                        else if($SubPreq == "HAVE")
                        {              
                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$SubID_5th_2nd' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                            $get_check = mysqli_query($connection,$checkprereq);
                            $Rows = mysqli_fetch_array($get_check);
                            $SubID = $Rows[0];
                            
                            if($SubID == 1)
                            {
                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$SubID_5th_2nd' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                $checkpreq = mysqli_query($connection,$getpreq);
                                foreach($checkpreq as $rows)
                                {
                                    $new = $rows['subject_id'];    
                                }
                                $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$new' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                while($sa = mysqli_fetch_array($getsubcode))
                                {
                                    $subCode = $sa['subject_code'];
                                }
                                echo '<td><center>'.$subCode.'</center></td>';
                            }
                            else if($SubID > 1)
                            {
            ?>
								<td><center>
			<?php
                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$SubID_5th_2nd' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                foreach($getpreq as $rows)
                                {
                                    $news = $rows['subject_id'];   
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$news' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
                                        print_r($sa['subject_code']);
                                        echo "\t";
                                    }                                                  
                                }
            ?>
								</center></td>
			<?php
                            }
                        }
            ?>
									<td><center>
                                    <div class="form-group show_5th_grade_2nd">
                                        <?php echo $Grades?>
                                    </div>
                                    <div class="form-group hide_5th_grade_2nd" style="display: none;">
                                        <select name="grades_<?=$PreID ?>" value="<?php echo $Grades?>" class="form-control text-center">
                                            <option value="0"><?php echo $Grades?></option>
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
                                            <option value="CREDITED">CREDITED</option>
                                            <option value="DRP">DRP</option>
                                        </select>
                                    </div>
                                    </center></td>
									<td hidden><center><?php echo $Remarks ?></center></td>
                                    <td hidden><center><?php echo $Year ?></center></td>
									<td hidden><center><?php echo $Semester ?></center></td>
                                    <td hidden><center><input type="text" name="subject_id_fk_<?=$PreID ?>" value="<?=$SubID_5th_2nd?>"></center></td>
                                    <td><center>
                                    <?php
                                        if($Grades == 0 && $Grades != "INC" && $Grades != "5.0" && $Grades != "DRP" && $Grades != "CREDITED")
                                        {
                                    ?>
                                        <div class="form-group show_5th_grade_2nd">
                                            <?php echo $SY?>
                                        </div>
                                        <div class="form-group hide_5th_grade_2nd" style="display: none;">
                                            <input type="text" name="SY_<?=$PreID ?>" value="<?php echo $SY?>" class="form-control text-center">
                                        </div>
                                    <?php
                                        }
                                        else if($Grades != 0 || $Grades == "INC" || $Grades == "5.0" || $Grades == "DRP" || $Grades == "CREDITED")
                                        {
                                    ?>
                                        <div class="form-group">
                                            <?php echo $SY?>
                                        </div>
                                        <div class="form-group" style="display: none;">
                                            <input type="text" name="SY_<?=$PreID ?>" value="<?php echo $SY?>" class="form-control text-center">
                                        </div>
                                    <?php
                                        }
                                    ?>
                                    </center></td>
                                    <td hidden><center><?php echo $SY ?></center></td>
									<td hidden><center><?php echo $total_grade_units ?></center></td>
									<td><center><button type="button" style="font-size: 1.3rem;" title="Edit" class="fas fa-edit btn rounded btn-success edit5thSubject2ndbtn"></button></center></td>
								</tr>
			<?php
					}				
				}
                $sum_units = "SELECT sum(units) FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid' and yearlevel='5' and semester='2nd' and course_id_fk='$courseid'";
                $units_check = mysqli_query($connection,$sum_units);
                $units_total = mysqli_fetch_array($units_check);
                $units_row_5th_2nd = $units_total[0];

                $get_total_grades_5th_2nd = mysqli_query($connection,"SELECT total_grades FROM tbladviser_presubject WHERE total_grades in ('INC','DRP','FAILED','CREDITED') and student_id='$Studid' and curri_id='$Currid' and yearlevel='5' and semester='2nd' and course_id_fk='$courseid'");
                if(mysqli_num_rows($get_total_grades_5th_2nd) > 0)
                {
                    $total_grade_units_5th_2nd = '<span data-toggle="tooltip" data-placement="top" class="fas fa-ellipsis-h" title="Average not available due to missing grades/Failed grades/INC grades/Credited subjects."></span>'; 
                }
                else if(mysqli_num_rows($get_total_grades_5th_2nd) == 0)
                {
                    $sum_stud_grade_5th_2nd = "SELECT sum(total_grades) FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid' and yearlevel='5' and semester='2nd' and course_id_fk='$courseid'";
                    $check_total_5th_2nd = mysqli_query($connection,$sum_stud_grade_5th_2nd);
                    $fetch_total_5th_2nd = mysqli_fetch_array($check_total_5th_2nd);
                    $total_grade_5th_2nd = $fetch_total_5th_2nd[0];            
                    if($units_row_5th_2nd != 0 && $total_grade_5th_2nd != 0)
                    {
                        $total_grade_units_5th_2nd = round($total_grade_5th_2nd / $units_row_5th_2nd, 4);
                    }
                    else
                    {
                        $total_grade_units_5th_2nd = "";
                    }
                }
                else
                {
                    $total_grade_units_5th_2nd = "";
                }
			?>
								</tbody>
								<tfoot >	
									<!-- table footer -->
                                    <tr>
                                        <td></td>
                                        <td hidden></td>
                                        <td></td>
                                        <td class="fw-bold"><center>Total:</center></td>
                                        <td></td>
                                        <td></td>
                                        <td class="fw-bold"><center><?php echo $units_row_5th_2nd?></center></td>
                                        <td></td>
                                        <td class="fw-bold"><center>Average: <?php echo $total_grade_units_5th_2nd?></center></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td></td>
                                    </tr>
								</tfoot>
							</table>
                            </form>
						</div>

                        <div class="mb-2">
                            <form action="managedata.php" method="POST">
                                <input type="hidden" name="studid" value="<?php echo $Studid?>">
                                <input type="hidden" name="currid" value="<?php echo $Currid ?>">
                                <div class="row mb-2">
                                    <div class="col mt-2" align="left">
                                        <span class="text-uppercase fw-bold">Summer</span>
                                    </div>
                                    <div class="col" align="right">
                                        <button type="submit" name="but_update" id="button_update_5th_summer" class="btn btn-success" style="display: none;">Save</button>
                                    </div>
                                </div>
			<?php
				$check_5th_subject_summer = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid' and yearlevel='5' and semester='summer' and course_id_fk='$courseid'");
			?>
							<table class="table table-striped" id="table5summersem" width="100%">
								<thead class="text-white">
									<tr>
                                        <th><center><input type="checkbox" id="chckAll5thsemsummer"></center></th>
										<th hidden><center>id</center></th>
										<th><center>Code</center></th>
										<th width="25%"><center>Title</center></th>
										<th scope="col"><center>Lec</center></th>
										<th scope="col"><center>Lab</center></th>
										<th scope="col"><center>Units</center></th>
										<th scope="col"><center>Prerequisite</center></th>
										<th scope="col"><center>Grades</center></th>
										<th hidden><center>Remarks</center></th>
                                        <th hidden><center>year</center></th>
										<th hidden><center>semester</center></th>
                                        <th hidden><center>subid</center></th>
                                        <th ><center>SY</center></th>
                                        <th hidden><center>SY</center></th>
                                        <th hidden><center>Total Grades</center></th>
										<th scope="col"><center>Action</center></th>
									</tr>
								</thead>
								<tbody>
			<?php
				if(mysqli_num_rows($check_5th_subject_summer) > 0)
                {
                    while($fa = mysqli_fetch_array($check_5th_subject_summer))
                    {
                        $PreID = $fa['id'];
						$SubID_5th_summer = $fa['subject_id_fk'];
                        $Course_id = $fa['course_id_fk'];
						$Grades = $fa['grades'];
						$Remarks = $fa['remarks'];
                        $Year = $fa['yearlevel'];
                        $Semester = $fa['semester'];
                        $SY = $fa['school_year'];
                        $total_grade_units = $fa['total_grades'];
						$GetSub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$SubID_5th_summer'");
						while($su=mysqli_fetch_array($GetSub))
						{
							$SubCode = $su['subject_code'];
							$SubDes = $su['description'];
							$SubLec = $su['lec'];
							$SubLab = $su['lab'];
							$SubUnits = $su['units'];
							$SubPreq = $su['prerequisite'];
						}
                        if($PreID && $Grades == "INC" && $Remarks == "PASSED")
                        {
                            $color_tr_bg = "#FFFF66";
                        }
                        else if($PreID && $Grades == "CREDITED" && $Remarks == "PASSED")
                        {
                            $color_tr_bg = "#00FFFF";
                        }
                        else if($PreID && $Remarks == "PASSED")
                        {
                            $color_tr_bg = "#90EE90";
                        }
                        else if($PreID && $Remarks == "FAILED")
                        {
                            $color_tr_bg = "#FFCCCB";
                        }
                        else
                        {
                            $color_tr_bg = "#F5F5F5";
                        }
			?>
								<tr style="background: <?php echo $color_tr_bg?>">
                                    <td><center><input type="checkbox" name="sub_list_id[]" value="<?php echo $PreID?>" class="check_5th_sem_summer"></center></td>
									<td hidden><center><?php echo $fa['id'] ?></center></td>
									<td><center><?php echo $SubCode ?></center></td>
									<td><center><?php echo $SubDes ?></center></td>
									<td><center><?php echo $SubLec ?></center></td>
									<td><center><?php echo $SubLab ?></center></td>
									<td><center><?php echo $SubUnits ?></center></td>
			<?php
                        if($SubPreq == "NONE")
                        {
                            echo '<td><center>NONE</center></td>';
                        }
                        else if($SubPreq == "HAVE")
                        {              
                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$SubID_5th_summer' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                            $get_check = mysqli_query($connection,$checkprereq);
                            $Rows = mysqli_fetch_array($get_check);
                            $SubID = $Rows[0];
                            
                            if($SubID == 1)
                            {
                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$SubID_5th_summer' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                $checkpreq = mysqli_query($connection,$getpreq);
                                foreach($checkpreq as $rows)
                                {
                                    $new = $rows['subject_id'];    
                                }
                                $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$new' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                while($sa = mysqli_fetch_array($getsubcode))
                                {
                                    $subCode = $sa['subject_code'];
                                }
                                echo '<td><center>'.$subCode.'</center></td>';
                            }
                            else if($SubID > 1)
                            {
            ?>
								<td><center>
			<?php
                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$SubID_5th_summer' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                foreach($getpreq as $rows)
                                {
                                    $news = $rows['subject_id'];   
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$news' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
                                        print_r($sa['subject_code']);
                                        echo "\t";
                                    }                                                  
                                }
            ?>
								</center></td>
			<?php
                            }
                        }
            ?>
									<td><center>
                                    <div class="form-group show_5th_grade_summer">
                                        <?php echo $Grades?>
                                    </div>
                                    <div class="form-group hide_5th_grade_summer" style="display: none;">
                                        <select name="grades_<?=$PreID ?>" value="<?php echo $Grades?>" class="form-control text-center">
                                            <option value="0"><?php echo $Grades?></option>
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
                                            <option value="CREDITED">CREDITED</option>
                                            <option value="DRP">DRP</option>
                                        </select>
                                    </div>
                                    </center></td>
									<td hidden><center><?php echo $Remarks ?></center></td>
                                    <td hidden><center><?php echo $Year ?></center></td>
									<td hidden><center><?php echo $Semester ?></center></td>
                                    <td hidden><center><input type="text" name="subject_id_fk_<?=$PreID ?>" value="<?=$SubID_5th_summer?>"></center></td>
                                    <td><center>
                                    <?php
                                        if($Grades == 0 && $Grades != "INC" && $Grades != "5.0" && $Grades != "DRP" && $Grades != "CREDITED")
                                        {
                                    ?>
                                        <div class="form-group show_5th_grade_summer">
                                            <?php echo $SY?>
                                        </div>
                                        <div class="form-group hide_5th_grade_summer" style="display: none;">
                                            <input type="text" name="SY_<?=$PreID ?>" value="<?php echo $SY?>" class="form-control text-center">
                                        </div>
                                    <?php
                                        }
                                        else if($Grades != 0 || $Grades == "INC" || $Grades == "5.0" || $Grades == "DRP" || $Grades == "CREDITED")
                                        {
                                    ?>
                                        <div class="form-group">
                                            <?php echo $SY?>
                                        </div>
                                        <div class="form-group" style="display: none;">
                                            <input type="text" name="SY_<?=$PreID ?>" value="<?php echo $SY?>" class="form-control text-center">
                                        </div>
                                    <?php
                                        }
                                    ?>
                                    </center></td>
                                    <td hidden><center><?php echo $SY ?></center></td>
									<td hidden><center><?php echo $total_grade_units ?></center></td>
									<td><center><button type="button" style="font-size: 1.3rem;" title="Edit" class="fas fa-edit btn rounded btn-success edit5thSubject2ndbtn"></button></center></td>
								</tr>
			<?php
					}				
				}
                $sum_units = "SELECT sum(units) FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid' and yearlevel='5' and semester='summer' and course_id_fk='$courseid'";
                $units_check = mysqli_query($connection,$sum_units);
                $units_total = mysqli_fetch_array($units_check);
                $units_row_5th_summer = $units_total[0];

                $get_total_grades_5th_summer = mysqli_query($connection,"SELECT total_grades FROM tbladviser_presubject WHERE total_grades in ('INC','DRP','FAILED','CREDITED') and student_id='$Studid' and curri_id='$Currid' and yearlevel='5' and semester='summer' and course_id_fk='$courseid'");
                if(mysqli_num_rows($get_total_grades_5th_summer) > 0)
                {
                    $total_grade_units_5th_summer = '<span data-toggle="tooltip" data-placement="top" class="fas fa-ellipsis-h" title="Average not available due to missing grades/Failed grades/INC grades/Credited subjects."></span>'; 
                }
                else if(mysqli_num_rows($get_total_grades_5th_summer) == 0)
                {
                    $sum_stud_grade_5th_summer = "SELECT sum(total_grades) FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid' and yearlevel='5' and semester='summer' and course_id_fk='$courseid'";
                    $check_total_5th_summer = mysqli_query($connection,$sum_stud_grade_5th_summer);
                    $fetch_total_5th_summer = mysqli_fetch_array($check_total_5th_summer);
                    $total_grade_5th_summer = $fetch_total_5th_summer[0];            
                    if($units_row_5th_summer != 0 && $total_grade_5th_summer != 0)
                    {
                        $total_grade_units_5th_summer = round($total_grade_5th_summer / $units_row_5th_summer, 4);
                    }
                    else
                    {
                        $total_grade_units_5th_summer = "";
                    }
                }
                else
                {
                    $total_grade_units_5th_summer = "";
                }
			?>
								</tbody>
								<tfoot >	
									<!-- table footer -->
                                    <tr>
                                        <td></td>
                                        <td hidden></td>
                                        <td></td>
                                        <td class="fw-bold"><center>Total:</center></td>
                                        <td></td>
                                        <td></td>
                                        <td class="fw-bold"><center><?php echo $units_row_5th_summer?></center></td>
                                        <td></td>
                                        <td class="fw-bold"><center>Average: <?php echo $total_grade_units_5th_summer?></center></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td></td>
                                    </tr>
								</tfoot>
							</table>
                            </form>
						</div>
					</div>
		
					

				</div>
			</div>
		</div>

		<!-- Start View Subjects Modal -->
		<div class="container container-fluid">
			<div class="modal fade" id="viewSubject" tabindex="-1" role="dialog" aria-labelledby="manage-requestLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document" style="max-width: 1240px;">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title fw-bold text-uppercase" id="manage-requestLabel">Subjects</h5>
							<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
						</div>

						<div class="modal-body">
							<!-- Inputs -->
							<form>
								<!-- 1st Year Subjects -->
								<div class="border-top border-bottom mt-2">
									<div class="text-uppercase fw-bold text-center fs-4 mt-2 mb-1">
										<span>First Year</span>
									</div>

									<div class="text-uppercase fw-bold mb-2">
										<span>1st Semester</span>
									</div>
			<?php
                $check_1st_sem_1st = mysqli_query($connection,"SELECT * FROM tblsubject WHERE semester='1st' and curr_id_fk='$Currid' and course_id_fk='$courseid' and yearlevel='1'");
            ?>
									<table class="table table-striped" id="table1year1st" width="100%">
										<thead class="text-white">
											<tr>
											<th hidden>id</th>
											<th><center>Code</center></th>
											<th><center>Title</center></th>
											<th scope="col"><center>Lec Hrs</center></th>
											<th scope="col"><center>Lab Hrs</center></th>
											<th scope="col"><center>Units</center></th>
											<th scope="col"><center>Prerequisite</center></th>
											<th hidden><center>Semester</center></th>
											<th hidden><center>Year</center></th>
											</tr>
										</thead>
										<tbody>
			<?php
                if(mysqli_num_rows($check_1st_sem_1st) > 0)
                {
					$total_lab = 0;
                    $total_lec = 0;
                    $total_units = 0;

                    while($fa = mysqli_fetch_array($check_1st_sem_1st))
                    {
                        $subjectid_save = $fa['id']; 
						$subjectcode = $fa['subject_code'];
                        $prereq = $fa['prerequisite'];
            ?>
                    <tr>
                        <td hidden><?php echo $fa['id']?></td>
                        <td scope="row"><center><?php echo $fa['subject_code']?></center></td>
                        <td><center><?php echo $fa['description']?></center></td>
                        <td><center><?php echo $fa['lec']?></center></td>
                        <td><center><?php echo $fa['lab']?></center></td>
                        <td><center><?php echo $fa['units']?></center></td>
                        <?php
                        if($prereq == "NONE")
                        {
                            echo '<td><center>NONE</center></td>';
                        }
                        else if($prereq == "HAVE")
                        {              
                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$subjectid_save' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                            $get_check = mysqli_query($connection,$checkprereq);
                            $Rows = mysqli_fetch_array($get_check);
                            $SubID = $Rows[0];
                            
                            if($SubID == 1)
                            {
                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$subjectid_save' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                $checkpreq = mysqli_query($connection,$getpreq);
                                foreach($checkpreq as $rows)
                                {
                                    $new = $rows['subject_id'];    
                                }
                                $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$new' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                while($sa = mysqli_fetch_array($getsubcode))
                                {
                                    $subCode = $sa['subject_code'];
                                }
                                echo '<td><center>'.$subCode.'</center></td>';
                            }
                            else if($SubID > 1)
                            {
            ?>
                        <td><center>
            <?php
                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$subjectid_save' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                foreach($getpreq as $rows)
                                {
                                    $news = $rows['subject_id'];     
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$news' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
                                        print_r($sa['subject_code']);
                                        echo "\t";
                                    }                                                
                                }
            ?>
                        </center></td>
            <?php
                            }
                        }
            ?>
                        <td hidden><center><?php echo $fa['semester']?></center></td>
                        <td hidden><center><?php echo $fa['yearlevel']?></center></td>
                    </tr>
            <?php
					$lab = $fa['lab'];
					$lec = $fa['lec'];
					$units = $fa['units'];
					$t_units = $lab + $lec;
										
					$total_lab = $total_lab + $lab;
					$total_lec = $total_lec + $lec;
					$total_units = $total_units + $units;
                    }
                }
				echo'<tr>
                	 <td></td>
                	 <td class="text-center" ><b>TOTAL</b></td>
                	 <td><center>'.$total_lec.'</center></td>
                	 <td><center>'.$total_lab.'</center></td>
                	 <td><center>'.$total_units.'</center></td>
                	 <td></td>
                	 <td></td>
                	 </tr>';
            ?>
										</tbody>
										<tfoot >	
											<!-- table footer -->
										</tfoot>
									</table>

									<div class="text-uppercase fw-bold mb-2">
										<span>2nd Semester</span>
									</div>
			<?php
                $check_1st_sem_2nd = mysqli_query($connection,"SELECT * FROM tblsubject WHERE semester='2nd' and curr_id_fk='$Currid' and course_id_fk='$courseid' and yearlevel='1'");
            ?>
									<table class="table table-striped" id="table1year2nd" width="100%">
										<thead class="text-white">
											<tr>
											<th hidden>id</th>
											<th><center>Code</center></th>
											<th><center>Title</center></th>
											<th scope="col"><center>Lec Hrs</center></th>
											<th scope="col"><center>Lab Hrs</center></th>
											<th scope="col"><center>Units</center></th>
											<th scope="col"><center>Prerequisite</center></th>
											<th hidden><center>Semester</center></th>
											<th hidden><center>Year</center></th>
											</tr>
										</thead>
										<tbody>
			<?php
                if(mysqli_num_rows($check_1st_sem_2nd) > 0)
                {
					$total_lab = 0;
                    $total_lec = 0;
                    $total_units = 0;
					
                    while($fa = mysqli_fetch_array($check_1st_sem_2nd))
                    {
                        $subjectid_save = $fa['id']; 
						$subjectcode = $fa['subject_code'];
                        $prereq = $fa['prerequisite'];
            ?>
                    <tr>
                        <td hidden><?php echo $fa['id']?></td>
                        <td scope="row"><center><?php echo $fa['subject_code']?></center></td>
                        <td><center><?php echo $fa['description']?></center></td>
                        <td><center><?php echo $fa['lec']?></center></td>
                        <td><center><?php echo $fa['lab']?></center></td>
                        <td><center><?php echo $fa['units']?></center></td>
                        <?php
                        if($prereq == "NONE")
                        {
                            echo '<td><center>NONE</center></td>';
                        }
                        else if($prereq == "HAVE")
                        {              
                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$subjectid_save' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                            $get_check = mysqli_query($connection,$checkprereq);
                            $Rows = mysqli_fetch_array($get_check);
                            $SubID = $Rows[0];
                            
                            if($SubID == 1)
                            {
                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$subjectid_save' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                $checkpreq = mysqli_query($connection,$getpreq);
                                foreach($checkpreq as $rows)
                                {
                                    $new = $rows['subject_id'];    
                                }
                                $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$new' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                while($sa = mysqli_fetch_array($getsubcode))
                                {
                                    $subCode = $sa['subject_code'];
                                }
                                echo '<td><center>'.$subCode.'</center></td>';
                            }
                            else if($SubID > 1)
                            {
            ?>
                        <td><center>
            <?php
                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$subjectid_save' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                foreach($getpreq as $rows)
                                {
                                    $news = $rows['subject_id'];    
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$news' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
                                        print_r($sa['subject_code']);
                                        echo "\t";
                                    }                                                 
                                }
            ?>
                        </center></td>
            <?php
                            }
                        }
            ?>
                        <td hidden><center><?php echo $fa['semester']?></center></td>
                        <td hidden><center><?php echo $fa['yearlevel']?></center></td>
                    </tr>
            <?php
					$lab = $fa['lab'];
					$lec = $fa['lec'];
					$units = $fa['units'];
					$t_units = $lab + $lec;
										
					$total_lab = $total_lab + $lab;
					$total_lec = $total_lec + $lec;
					$total_units = $total_units + $units;
                    }
                }
				echo'<tr>
                	 <td></td>
                	 <td class="text-center" ><b>TOTAL</b></td>
                	 <td><center>'.$total_lec.'</center></td>
                	 <td><center>'.$total_lab.'</center></td>
                	 <td><center>'.$total_units.'</center></td>
                	 <td></td>
                	 <td></td>
                	 </tr>';
            ?>
										</tbody>
										<tfoot >	
											<!-- table footer -->
										</tfoot>
									</table>

                                    <div class="text-uppercase fw-bold mb-2">
										<span>Summer</span>
									</div>
			<?php
                $check_1st_sem_summer = mysqli_query($connection,"SELECT * FROM tblsubject WHERE semester='summer' and curr_id_fk='$Currid' and course_id_fk='$courseid' and yearlevel='1'");
            ?>
									<table class="table table-striped" id="table1yearsummer" width="100%">
										<thead class="text-white">
											<tr>
											<th hidden>id</th>
											<th><center>Code</center></th>
											<th><center>Title</center></th>
											<th scope="col"><center>Lec Hrs</center></th>
											<th scope="col"><center>Lab Hrs</center></th>
											<th scope="col"><center>Units</center></th>
											<th scope="col"><center>Prerequisite</center></th>
											<th hidden><center>Semester</center></th>
											<th hidden><center>Year</center></th>
											</tr>
										</thead>
										<tbody>
			<?php
                if(mysqli_num_rows($check_1st_sem_summer) > 0)
                {
					$total_lab = 0;
                    $total_lec = 0;
                    $total_units = 0;
					
                    while($fa = mysqli_fetch_array($check_1st_sem_summer))
                    {
                        $subjectid_save = $fa['id'];
						$subjectcode = $fa['subject_code'];
                        $prereq = $fa['prerequisite'];
            ?>
                    <tr>
                        <td hidden><?php echo $fa['id']?></td>
                        <td scope="row"><center><?php echo $fa['subject_code']?></center></td>
                        <td><center><?php echo $fa['description']?></center></td>
                        <td><center><?php echo $fa['lec']?></center></td>
                        <td><center><?php echo $fa['lab']?></center></td>
                        <td><center><?php echo $fa['units']?></center></td>
                        <?php
                        if($prereq == "NONE")
                        {
                            echo '<td><center>NONE</center></td>';
                        }
                        else if($prereq == "HAVE")
                        {              
                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$subjectid_save' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                            $get_check = mysqli_query($connection,$checkprereq);
                            $Rows = mysqli_fetch_array($get_check);
                            $SubID = $Rows[0];
                            
                            if($SubID == 1)
                            {
                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$subjectid_save' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                $checkpreq = mysqli_query($connection,$getpreq);
                                foreach($checkpreq as $rows)
                                {
                                    $new = $rows['subject_id'];    
                                }
                                $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$new' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                while($sa = mysqli_fetch_array($getsubcode))
                                {
                                    $subCode = $sa['subject_code'];
                                }
                                echo '<td><center>'.$subCode.'</center></td>';
                            }
                            else if($SubID > 1)
                            {
            ?>
                        <td><center>
            <?php
                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$subjectid_save'");
                                foreach($getpreq as $rows)
                                {
                                    $news = $rows['subject_id'];    
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$news'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
                                        print_r($sa['subject_code']);
                                        echo "\t";
                                    }                                                 
                                }
            ?>
                        </center></td>
            <?php
                            }
                        }
            ?>
                        <td hidden><center><?php echo $fa['semester']?></center></td>
                        <td hidden><center><?php echo $fa['yearlevel']?></center></td>
                    </tr>
            <?php
					$lab = $fa['lab'];
					$lec = $fa['lec'];
					$units = $fa['units'];
					$t_units = $lab + $lec;
										
					$total_lab = $total_lab + $lab;
					$total_lec = $total_lec + $lec;
					$total_units = $total_units + $units;
                    }
                }
				echo'<tr>
                	 <td></td>
                	 <td class="text-center" ><b>TOTAL</b></td>
                	 <td><center>'.$total_lec.'</center></td>
                	 <td><center>'.$total_lab.'</center></td>
                	 <td><center>'.$total_units.'</center></td>
                	 <td></td>
                	 <td></td>
                	 </tr>';
            ?>
										</tbody>
										<tfoot >	
											<!-- table footer -->
										</tfoot>
									</table>
								</div>
								<!-- End of 1st Year Subjects -->

								<!-- 2nd Year Subjects -->
								<div class="border-top border-bottom mt-2">
									<div class="text-uppercase fw-bold text-center fs-4 mt-2 mb-1">
										<span>Second Year</span>
									</div>

									<div class="text-uppercase fw-bold mb-2">
										<span>1st Semester</span>
									</div>
			<?php
                $check_2nd_sem_1st = mysqli_query($connection,"SELECT * FROM tblsubject WHERE semester='1st' and curr_id_fk='$Currid' and course_id_fk='$courseid' and yearlevel='2'");
            ?>
									<table class="table table-striped" id="table2year1st" width="100%">
										<thead class="text-white">
											<tr>
											<th hidden>id</th>
											<th><center>Code</center></th>
											<th><center>Title</center></th>
											<th scope="col"><center>Lec Hrs</center></th>
											<th scope="col"><center>Lab Hrs</center></th>
											<th scope="col"><center>Units</center></th>
											<th scope="col"><center>Prerequisite</center></th>
											<th hidden><center>Semester</center></th>
											<th hidden><center>Year</center></th>
											</tr>
										</thead>
										<tbody>
			<?php
                if(mysqli_num_rows($check_2nd_sem_1st) > 0)
                {
					$total_lab = 0;
                    $total_lec = 0;
                    $total_units = 0;
					
                    while($fa = mysqli_fetch_array($check_2nd_sem_1st))
                    {
                        $subjectid_save = $fa['id'];
						$subjectcode = $fa['subject_code'];
                        $prereq = $fa['prerequisite'];
            ?>
                    <tr>
                        <td hidden><?php echo $fa['id']?></td>
                        <td scope="row"><center><?php echo $fa['subject_code']?></center></td>
                        <td><center><?php echo $fa['description']?></center></td>
                        <td><center><?php echo $fa['lec']?></center></td>
                        <td><center><?php echo $fa['lab']?></center></td>
                        <td><center><?php echo $fa['units']?></center></td>
                        <?php
                        if($prereq == "NONE")
                        {
                            echo '<td><center>NONE</center></td>';
                        }
                        else if($prereq == "HAVE")
                        {              
                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$subjectid_save' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                            $get_check = mysqli_query($connection,$checkprereq);
                            $Rows = mysqli_fetch_array($get_check);
                            $SubID = $Rows[0];
                            
                            if($SubID == 1)
                            {
                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$subjectid_save' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                $checkpreq = mysqli_query($connection,$getpreq);
                                foreach($checkpreq as $rows)
                                {
                                    $new = $rows['subject_id'];    
                                }
                                $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$new' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                while($sa = mysqli_fetch_array($getsubcode))
                                {
                                    $subCode = $sa['subject_code'];
                                }
                                echo '<td><center>'.$subCode.'</center></td>';
                            }
                            else if($SubID > 1)
                            {
            ?>
                        <td><center>
            <?php
                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$subjectid_save' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                foreach($getpreq as $rows)
                                {
                                    $news = $rows['subject_id'];    
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$news' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
                                        print_r($sa['subject_code']);
                                        echo "\t";
                                    }                                                 
                                }
            ?>
                        </center></td>
            <?php
                            }
                        }
            ?>
                        <td hidden><center><?php echo $fa['semester']?></center></td>
                        <td hidden><center><?php echo $fa['yearlevel']?></center></td>
                    </tr>
            <?php
					$lab = $fa['lab'];
					$lec = $fa['lec'];
					$units = $fa['units'];
					$t_units = $lab + $lec;
										
					$total_lab = $total_lab + $lab;
					$total_lec = $total_lec + $lec;
					$total_units = $total_units + $units;
                    }
                }
				echo'<tr>
						<td></td>
						<td class="text-center" ><b>TOTAL</b></td>
						<td><center>'.$total_lec.'</center></td>
						<td><center>'.$total_lab.'</center></td>
						<td><center>'.$total_units.'</center></td>
						<td></td>
						<td></td>
                	 </tr>';
            ?>
										</tbody>
										<tfoot >	
											<!-- table footer -->
										</tfoot>
									</table>

									<div class="text-uppercase fw-bold mb-2">
										<span>2nd Semester</span>
									</div>
			<?php
                $check_2nd_sem_2nd = mysqli_query($connection,"SELECT * FROM tblsubject WHERE semester='2nd' and curr_id_fk='$Currid' and course_id_fk='$courseid' and yearlevel='2'");
            ?>
									<table class="table table-striped" id="table2year2nd" width="100%">
										<thead class="text-white">
											<tr>
											<th hidden>id</th>
											<th><center>Code</center></th>
											<th><center>Title</center></th>
											<th scope="col"><center>Lec Hrs</center></th>
											<th scope="col"><center>Lab Hrs</center></th>
											<th scope="col"><center>Units</center></th>
											<th scope="col"><center>Prerequisite</center></th>
											<th hidden><center>Semester</center></th>
											<th hidden><center>Year</center></th>
											</tr>
										</thead>
										<tbody>
			<?php
                if(mysqli_num_rows($check_2nd_sem_2nd) > 0)
                {
					$total_lab = 0;
                    $total_lec = 0;
                    $total_units = 0;
					
                    while($fa = mysqli_fetch_array($check_2nd_sem_2nd))
                    {
                        $subjectid_save = $fa['id'];
						$subjectcode = $fa['subject_code'];
                        $prereq = $fa['prerequisite'];
            ?>
                    <tr>
                        <td hidden><?php echo $fa['id']?></td>
                        <td scope="row"><center><?php echo $fa['subject_code']?></center></td>
                        <td><center><?php echo $fa['description']?></center></td>
                        <td><center><?php echo $fa['lec']?></center></td>
                        <td><center><?php echo $fa['lab']?></center></td>
                        <td><center><?php echo $fa['units']?></center></td>
                        <?php
                        if($prereq == "NONE")
                        {
                            echo '<td><center>NONE</center></td>';
                        }
                        else if($prereq == "HAVE")
                        {              
                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$subjectid_save' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                            $get_check = mysqli_query($connection,$checkprereq);
                            $Rows = mysqli_fetch_array($get_check);
                            $SubID = $Rows[0];
                            
                            if($SubID == 1)
                            {
                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$subjectid_save' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                $checkpreq = mysqli_query($connection,$getpreq);
                                foreach($checkpreq as $rows)
                                {
                                    $new = $rows['subject_id'];    
                                }
                                $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$new' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                while($sa = mysqli_fetch_array($getsubcode))
                                {
                                    $subCode = $sa['subject_code'];
                                }
                                echo '<td><center>'.$subCode.'</center></td>';
                            }
                            else if($SubID > 1)
                            {
            ?>
                        <td><center>
            <?php
                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$subjectid_save' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                foreach($getpreq as $rows)
                                {
                                    $news = $rows['subject_id'];     
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$news' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
                                        print_r($sa['subject_code']);
                                        echo "\t";
                                    }                                                
                                }
            ?>
                        </center></td>
            <?php
                            }
                        }
            ?>
                        <td hidden><center><?php echo $fa['semester']?></center></td>
                        <td hidden><center><?php echo $fa['yearlevel']?></center></td>
                    </tr>
            <?php
					$lab = $fa['lab'];
					$lec = $fa['lec'];
					$units = $fa['units'];
					$t_units = $lab + $lec;
										
					$total_lab = $total_lab + $lab;
					$total_lec = $total_lec + $lec;
					$total_units = $total_units + $units;
                    }
                }
				echo'<tr>
						<td></td>
						<td class="text-center" ><b>TOTAL</b></td>
						<td><center>'.$total_lec.'</center></td>
						<td><center>'.$total_lab.'</center></td>
						<td><center>'.$total_units.'</center></td>
						<td></td>
						<td></td>
                	 </tr>';
            ?>
										</tbody>
										<tfoot >	
											<!-- table footer -->
										</tfoot>
									</table>

                                    <div class="text-uppercase fw-bold mb-2">
										<span>Summer</span>
									</div>
			<?php
                $check_2nd_sem_summer = mysqli_query($connection,"SELECT * FROM tblsubject WHERE semester='summer' and curr_id_fk='$Currid' and course_id_fk='$courseid' and yearlevel='2'");
            ?>
									<table class="table table-striped" id="table2year1st" width="100%">
										<thead class="text-white">
											<tr>
											<th hidden>id</th>
											<th><center>Code</center></th>
											<th><center>Title</center></th>
											<th scope="col"><center>Lec Hrs</center></th>
											<th scope="col"><center>Lab Hrs</center></th>
											<th scope="col"><center>Units</center></th>
											<th scope="col"><center>Prerequisite</center></th>
											<th hidden><center>Semester</center></th>
											<th hidden><center>Year</center></th>
											</tr>
										</thead>
										<tbody>
			<?php
                if(mysqli_num_rows($check_2nd_sem_summer) > 0)
                {
					$total_lab = 0;
                    $total_lec = 0;
                    $total_units = 0;
					
                    while($fa = mysqli_fetch_array($check_2nd_sem_summer))
                    {
                        $subjectid_save = $fa['id'];
						$subjectcode = $fa['subject_code'];
                        $prereq = $fa['prerequisite'];
            ?>
                    <tr>
                        <td hidden><?php echo $fa['id']?></td>
                        <td scope="row"><center><?php echo $fa['subject_code']?></center></td>
                        <td><center><?php echo $fa['description']?></center></td>
                        <td><center><?php echo $fa['lec']?></center></td>
                        <td><center><?php echo $fa['lab']?></center></td>
                        <td><center><?php echo $fa['units']?></center></td>
                        <?php
                        if($prereq == "NONE")
                        {
                            echo '<td><center>NONE</center></td>';
                        }
                        else if($prereq == "HAVE")
                        {              
                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$subjectid_save' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                            $get_check = mysqli_query($connection,$checkprereq);
                            $Rows = mysqli_fetch_array($get_check);
                            $SubID = $Rows[0];
                            
                            if($SubID == 1)
                            {
                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$subjectid_save' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                $checkpreq = mysqli_query($connection,$getpreq);
                                foreach($checkpreq as $rows)
                                {
                                    $new = $rows['subject_id'];    
                                }
                                $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$new' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                while($sa = mysqli_fetch_array($getsubcode))
                                {
                                    $subCode = $sa['subject_code'];
                                }
                                echo '<td><center>'.$subCode.'</center></td>';
                            }
                            else if($SubID > 1)
                            {
            ?>
                        <td><center>
            <?php
                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$subjectid_save' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                foreach($getpreq as $rows)
                                {
                                    $news = $rows['subject_id'];    
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$news' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
                                        print_r($sa['subject_code']);
                                        echo "\t";
                                    }                                                 
                                }
            ?>
                        </center></td>
            <?php
                            }
                        }
            ?>
                        <td hidden><center><?php echo $fa['semester']?></center></td>
                        <td hidden><center><?php echo $fa['yearlevel']?></center></td>
                    </tr>
            <?php
					$lab = $fa['lab'];
					$lec = $fa['lec'];
					$units = $fa['units'];
					$t_units = $lab + $lec;
										
					$total_lab = $total_lab + $lab;
					$total_lec = $total_lec + $lec;
					$total_units = $total_units + $units;
                    }
                }
				echo'<tr>
						<td></td>
						<td class="text-center" ><b>TOTAL</b></td>
						<td><center>'.$total_lec.'</center></td>
						<td><center>'.$total_lab.'</center></td>
						<td><center>'.$total_units.'</center></td>
						<td></td>
						<td></td>
                	 </tr>';
            ?>
										</tbody>
										<tfoot >	
											<!-- table footer -->
										</tfoot>
									</table>
								</div>
								<!-- End of 2nd Year Subjects -->

								<!-- 3rd Year Subjects -->
								<div class="border-top border-bottom mt-2">
									<div class="text-uppercase fw-bold text-center fs-4 mt-2 mb-1">
										<span>Third Year</span>
									</div>

									<div class="text-uppercase fw-bold mb-2">
										<span>1st Semester</span>
									</div>
			<?php
                $check_3rd_sem_1st = mysqli_query($connection,"SELECT * FROM tblsubject WHERE semester='1st' and curr_id_fk='$Currid' and course_id_fk='$courseid' and yearlevel='3'");
            ?>
									<table class="table table-striped" id="table3year1st" width="100%">
										<thead class="text-white">
											<tr>
											<th hidden>id</th>
											<th><center>Code</center></th>
											<th><center>Title</center></th>
											<th scope="col"><center>Lec Hrs</center></th>
											<th scope="col"><center>Lab Hrs</center></th>
											<th scope="col"><center>Units</center></th>
											<th scope="col"><center>Prerequisite</center></th>
											<th hidden><center>Semester</center></th>
											<th hidden><center>Year</center></th>
											</tr>
										</thead>
										<tbody>
			<?php
                if(mysqli_num_rows($check_3rd_sem_1st) > 0)
                {
					$total_lab = 0;
                    $total_lec = 0;
                    $total_units = 0;
					
                    while($fa = mysqli_fetch_array($check_3rd_sem_1st))
                    {
                        $subjectid_save = $fa['id'];
						$subjectcode = $fa['subject_code'];
                        $prereq = $fa['prerequisite'];
            ?>
                    <tr>
                        <td hidden><?php echo $fa['id']?></td>
                        <td scope="row"><center><?php echo $fa['subject_code']?></center></td>
                        <td><center><?php echo $fa['description']?></center></td>
                        <td><center><?php echo $fa['lec']?></center></td>
                        <td><center><?php echo $fa['lab']?></center></td>
                        <td><center><?php echo $fa['units']?></center></td>
                        <?php
                        if($prereq == "NONE")
                        {
                            echo '<td><center>NONE</center></td>';
                        }
                        else if($prereq == "HAVE")
                        {              
                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$subjectid_save' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                            $get_check = mysqli_query($connection,$checkprereq);
                            $Rows = mysqli_fetch_array($get_check);
                            $SubID = $Rows[0];
                            
                            if($SubID == 1)
                            {
                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$subjectid_save' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                $checkpreq = mysqli_query($connection,$getpreq);
                                foreach($checkpreq as $rows)
                                {
                                    $new = $rows['subject_id'];    
                                }
                                $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$new' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                while($sa = mysqli_fetch_array($getsubcode))
                                {
                                    $subCode = $sa['subject_code'];
                                }
                                echo '<td><center>'.$subCode.'</center></td>';
                            }
                            else if($SubID > 1)
                            {
            ?>
                        <td><center>
            <?php
                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$subjectid_save' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                foreach($getpreq as $rows)
                                {
                                    $news = $rows['subject_id'];      
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$news' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
                                        print_r($sa['subject_code']);
                                        echo "\t";
                                    }                                               
                                }
            ?>
                        </center></td>
            <?php
                            }
                        }
            ?>
                        <td hidden><center><?php echo $fa['semester']?></center></td>
                        <td hidden><center><?php echo $fa['yearlevel']?></center></td>
                    </tr>
            <?php
					$lab = $fa['lab'];
					$lec = $fa['lec'];
					$units = $fa['units'];
					$t_units = $lab + $lec;
										
					$total_lab = $total_lab + $lab;
					$total_lec = $total_lec + $lec;
					$total_units = $total_units + $units;
                    }
                }
				echo'<tr>
						<td></td>
						<td class="text-center" ><b>TOTAL</b></td>
						<td><center>'.$total_lec.'</center></td>
						<td><center>'.$total_lab.'</center></td>
						<td><center>'.$total_units.'</center></td>
						<td></td>
						<td></td>
                	 </tr>';
            ?>
										</tbody>
										<tfoot >	
											<!-- table footer -->
										</tfoot>
									</table>

									<div class="text-uppercase fw-bold mb-2">
										<span>2nd Semester</span>
									</div>
			<?php
                $check_3rd_sem_2nd = mysqli_query($connection,"SELECT * FROM tblsubject WHERE semester='2nd' and curr_id_fk='$Currid' and course_id_fk='$courseid' and yearlevel='3'");
            ?>
									<table class="table table-striped" id="table3year2nd" width="100%">
										<thead class="text-white">
											<tr>
											<th hidden>id</th>
											<th><center>Code</center></th>
											<th><center>Title</center></th>
											<th scope="col"><center>Lec Hrs</center></th>
											<th scope="col"><center>Lab Hrs</center></th>
											<th scope="col"><center>Units</center></th>
											<th scope="col"><center>Prerequisite</center></th>
											<th hidden><center>Semester</center></th>
											<th hidden><center>Year</center></th>
											</tr>
										</thead>
										<tbody>
			<?php
                if(mysqli_num_rows($check_3rd_sem_2nd) > 0)
                {
					$total_lab = 0;
                    $total_lec = 0;
                    $total_units = 0;
					
                    while($fa = mysqli_fetch_array($check_3rd_sem_2nd))
                    {
                        $subjectid_save = $fa['id'];
						$subjectcode = $fa['subject_code'];
                        $prereq = $fa['prerequisite'];
            ?>
                    <tr>
                        <td hidden><?php echo $fa['id']?></td>
                        <td scope="row"><center><?php echo $fa['subject_code']?></center></td>
                        <td><center><?php echo $fa['description']?></center></td>
                        <td><center><?php echo $fa['lec']?></center></td>
                        <td><center><?php echo $fa['lab']?></center></td>
                        <td><center><?php echo $fa['units']?></center></td>
                        <?php
                        if($prereq == "NONE")
                        {
                            echo '<td><center>NONE</center></td>';
                        }
                        else if($prereq == "HAVE")
                        {              
                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$subjectid_save' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                            $get_check = mysqli_query($connection,$checkprereq);
                            $Rows = mysqli_fetch_array($get_check);
                            $SubID = $Rows[0];
                            
                            if($SubID == 1)
                            {
                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$subjectid_save' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                $checkpreq = mysqli_query($connection,$getpreq);
                                foreach($checkpreq as $rows)
                                {
                                    $new = $rows['subject_id'];    
                                }
                                $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$new' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                while($sa = mysqli_fetch_array($getsubcode))
                                {
                                    $subCode = $sa['subject_code'];
                                }
                                echo '<td><center>'.$subCode.'</center></td>';
                            }
                            else if($SubID > 1)
                            {
            ?>
                        <td><center>
            <?php
                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$subjectid_save' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                foreach($getpreq as $rows)
                                {
                                    $news = $rows['subject_id'];  
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$news' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
                                        print_r($sa['subject_code']);
                                        echo "\t";
                                    }                                                   
                                }
            ?>
                        </center></td>
            <?php
                            }
                        }
            ?>
                        <td hidden><center><?php echo $fa['semester']?></center></td>
                        <td hidden><center><?php echo $fa['yearlevel']?></center></td>
                    </tr>
            <?php
					$lab = $fa['lab'];
					$lec = $fa['lec'];
					$units = $fa['units'];
					$t_units = $lab + $lec;
										
					$total_lab = $total_lab + $lab;
					$total_lec = $total_lec + $lec;
					$total_units = $total_units + $units;
                    }
                }
				echo'<tr>
						<td></td>
						<td class="text-center" ><b>TOTAL</b></td>
						<td><center>'.$total_lec.'</center></td>
						<td><center>'.$total_lab.'</center></td>
						<td><center>'.$total_units.'</center></td>
						<td></td>
						<td></td>
                	 </tr>';
            ?>
										</tbody>
										<tfoot >	
											<!-- table footer -->
										</tfoot>
									</table>

                                    <div class="text-uppercase fw-bold mb-2">
										<span>Summer</span>
									</div>
			<?php
                $check_3rd_sem_summer = mysqli_query($connection,"SELECT * FROM tblsubject WHERE semester='summer' and curr_id_fk='$Currid' and course_id_fk='$courseid' and yearlevel='3'");
            ?>
									<table class="table table-striped" id="table3year1st" width="100%">
										<thead class="text-white">
											<tr>
											<th hidden>id</th>
											<th><center>Code</center></th>
											<th><center>Title</center></th>
											<th scope="col"><center>Lec Hrs</center></th>
											<th scope="col"><center>Lab Hrs</center></th>
											<th scope="col"><center>Units</center></th>
											<th scope="col"><center>Prerequisite</center></th>
											<th hidden><center>Semester</center></th>
											<th hidden><center>Year</center></th>
											</tr>
										</thead>
										<tbody>
			<?php
                if(mysqli_num_rows($check_3rd_sem_summer) > 0)
                {
					$total_lab = 0;
                    $total_lec = 0;
                    $total_units = 0;
					
                    while($fa = mysqli_fetch_array($check_3rd_sem_summer))
                    {
                        $subjectid_save = $fa['id'];
						$subjectcode = $fa['subject_code'];
                        $prereq = $fa['prerequisite'];
            ?>
                    <tr>
                        <td hidden><?php echo $fa['id']?></td>
                        <td scope="row"><center><?php echo $fa['subject_code']?></center></td>
                        <td><center><?php echo $fa['description']?></center></td>
                        <td><center><?php echo $fa['lec']?></center></td>
                        <td><center><?php echo $fa['lab']?></center></td>
                        <td><center><?php echo $fa['units']?></center></td>
                        <?php
                        if($prereq == "NONE")
                        {
                            echo '<td><center>NONE</center></td>';
                        }
                        else if($prereq == "HAVE")
                        {              
                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$subjectid_save' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                            $get_check = mysqli_query($connection,$checkprereq);
                            $Rows = mysqli_fetch_array($get_check);
                            $SubID = $Rows[0];
                            
                            if($SubID == 1)
                            {
                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$subjectid_save' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                $checkpreq = mysqli_query($connection,$getpreq);
                                foreach($checkpreq as $rows)
                                {
                                    $new = $rows['subject_id'];    
                                }
                                $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$new' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                while($sa = mysqli_fetch_array($getsubcode))
                                {
                                    $subCode = $sa['subject_code'];
                                }
                                echo '<td><center>'.$subCode.'</center></td>';
                            }
                            else if($SubID > 1)
                            {
            ?>
                        <td><center>
            <?php
                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$subjectid_save' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                foreach($getpreq as $rows)
                                {
                                    $news = $rows['subject_id'];      
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$news' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
                                        print_r($sa['subject_code']);
                                        echo "\t";
                                    }                                               
                                }
            ?>
                        </center></td>
            <?php
                            }
                        }
            ?>
                        <td hidden><center><?php echo $fa['semester']?></center></td>
                        <td hidden><center><?php echo $fa['yearlevel']?></center></td>
                    </tr>
            <?php
					$lab = $fa['lab'];
					$lec = $fa['lec'];
					$units = $fa['units'];
					$t_units = $lab + $lec;
										
					$total_lab = $total_lab + $lab;
					$total_lec = $total_lec + $lec;
					$total_units = $total_units + $units;
                    }
                }
				echo'<tr>
						<td></td>
						<td class="text-center" ><b>TOTAL</b></td>
						<td><center>'.$total_lec.'</center></td>
						<td><center>'.$total_lab.'</center></td>
						<td><center>'.$total_units.'</center></td>
						<td></td>
						<td></td>
                	 </tr>';
            ?>
										</tbody>
										<tfoot >	
											<!-- table footer -->
										</tfoot>
									</table>
								</div>
								<!-- End of 3rd Year Subjects -->

								<!-- 4th Year Subjects -->
								<div class="border-top border-bottom mt-2">
									<div class="text-uppercase fw-bold text-center fs-4 mt-2 mb-1">
										<span>Fourth Year</span>
									</div>

									<div class="text-uppercase fw-bold mb-2">
										<span>1st Semester</span>
									</div>
			<?php
                $check_4th_sem_1st = mysqli_query($connection,"SELECT * FROM tblsubject WHERE semester='1st' and curr_id_fk='$Currid' and course_id_fk='$courseid' and yearlevel='4'");
            ?>
									<table class="table table-striped" id="table4year1st" width="100%">
										<thead class="text-white">
											<tr>
											<th hidden>id</th>
											<th><center>Code</center></th>
											<th><center>Title</center></th>
											<th scope="col"><center>Lec Hrs</center></th>
											<th scope="col"><center>Lab Hrs</center></th>
											<th scope="col"><center>Units</center></th>
											<th scope="col"><center>Prerequisite</center></th>
											<th hidden><center>Semester</center></th>
											<th hidden><center>Year</center></th>
											</tr>
										</thead>
										<tbody>
			<?php
                if(mysqli_num_rows($check_4th_sem_1st) > 0)
                {
					$total_lab = 0;
                    $total_lec = 0;
                    $total_units = 0;
					
                    while($fa = mysqli_fetch_array($check_4th_sem_1st))
                    {
                        $subjectid_save = $fa['id'];
						$subjectcode = $fa['subject_code'];
                        $prereq = $fa['prerequisite'];
            ?>
                    <tr>
                        <td hidden><?php echo $fa['id']?></td>
                        <td scope="row"><center><?php echo $fa['subject_code']?></center></td>
                        <td><center><?php echo $fa['description']?></center></td>
                        <td><center><?php echo $fa['lec']?></center></td>
                        <td><center><?php echo $fa['lab']?></center></td>
                        <td><center><?php echo $fa['units']?></center></td>
                        <?php
                        if($prereq == "NONE")
                        {
                            echo '<td><center>NONE</center></td>';
                        }
                        else if($prereq == "HAVE")
                        {              
                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$subjectid_save' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                            $get_check = mysqli_query($connection,$checkprereq);
                            $Rows = mysqli_fetch_array($get_check);
                            $SubID = $Rows[0];
                            
                            if($SubID == 1)
                            {
                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$subjectid_save' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                $checkpreq = mysqli_query($connection,$getpreq);
                                foreach($checkpreq as $rows)
                                {
                                    $new = $rows['subject_id'];    
                                }
                                $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$new' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                while($sa = mysqli_fetch_array($getsubcode))
                                {
                                    $subCode = $sa['subject_code'];
                                }
                                echo '<td><center>'.$subCode.'</center></td>';
                            }
                            else if($SubID > 1)
                            {
            ?>
                        <td><center>
            <?php
                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$subjectid_save' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                foreach($getpreq as $rows)
                                {
                                    $news = $rows['subject_id'];     
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$news' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
                                        print_r($sa['subject_code']);
                                        echo "\t";
                                    }                                                
                                }
            ?>
                        </center></td>
            <?php
                            }
                        }
            ?>
                        <td hidden><center><?php echo $fa['semester']?></center></td>
                        <td hidden><center><?php echo $fa['yearlevel']?></center></td>
                    </tr>
            <?php
					$lab = $fa['lab'];
					$lec = $fa['lec'];
					$units = $fa['units'];
					$t_units = $lab + $lec;
										
					$total_lab = $total_lab + $lab;
					$total_lec = $total_lec + $lec;
					$total_units = $total_units + $units;
                    }
                }
				echo'<tr>
						<td></td>
						<td class="text-center" ><b>TOTAL</b></td>
						<td><center>'.$total_lec.'</center></td>
						<td><center>'.$total_lab.'</center></td>
						<td><center>'.$total_units.'</center></td>
						<td></td>
						<td></td>
                	 </tr>';
            ?>
										</tbody>
										<tfoot >	
											<!-- table footer -->
										</tfoot>
									</table>

									<div class="text-uppercase fw-bold mb-2">
										<span>2nd Semester</span>
									</div>
			<?php
                $check_4th_sem_2nd = mysqli_query($connection,"SELECT * FROM tblsubject WHERE semester='2nd' and curr_id_fk='$Currid' and course_id_fk='$courseid' and yearlevel='4'");
            ?>
									<table class="table table-striped" id="table4year2nd" width="100%">
										<thead class="text-white">
											<tr>
											<th hidden>id</th>
											<th><center>Code</center></th>
											<th><center>Title</center></th>
											<th scope="col"><center>Lec Hrs</center></th>
											<th scope="col"><center>Lab Hrs</center></th>
											<th scope="col"><center>Units</center></th>
											<th scope="col"><center>Prerequisite</center></th>
											<th hidden><center>Semester</center></th>
											<th hidden><center>Year</center></th>
											</tr>
										</thead>
										<tbody>
			<?php
                if(mysqli_num_rows($check_4th_sem_2nd) > 0)
                {
					$total_lab = 0;
                    $total_lec = 0;
                    $total_units = 0;
					
                    while($fa = mysqli_fetch_array($check_4th_sem_2nd))
                    {
                        $subjectid_save = $fa['id'];
						$subjectcode = $fa['subject_code'];
                        $prereq = $fa['prerequisite'];
            ?>
                    <tr>
                        <td hidden><?php echo $fa['id']?></td>
                        <td scope="row"><center><?php echo $fa['subject_code']?></center></td>
                        <td><center><?php echo $fa['description']?></center></td>
                        <td><center><?php echo $fa['lec']?></center></td>
                        <td><center><?php echo $fa['lab']?></center></td>
                        <td><center><?php echo $fa['units']?></center></td>
                        <?php
                        if($prereq == "NONE")
                        {
                            echo '<td><center>NONE</center></td>';
                        }
                        else if($prereq == "HAVE")
                        {              
                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$subjectid_save' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                            $get_check = mysqli_query($connection,$checkprereq);
                            $Rows = mysqli_fetch_array($get_check);
                            $SubID = $Rows[0];
                            
                            if($SubID == 1)
                            {
                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$subjectid_save' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                $checkpreq = mysqli_query($connection,$getpreq);
                                foreach($checkpreq as $rows)
                                {
                                    $new = $rows['subject_id'];    
                                }
                                $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$new' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                while($sa = mysqli_fetch_array($getsubcode))
                                {
                                    $subCode = $sa['subject_code'];
                                }
                                echo '<td><center>'.$subCode.'</center></td>';
                            }
                            else if($SubID > 1)
                            {
            ?>
                        <td><center>
            <?php
                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$subjectid_save' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                foreach($getpreq as $rows)
                                {
                                    $news = $rows['subject_id'];     
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$news' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
                                        print_r($sa['subject_code']);
                                        echo "\t";
                                    }                                                
                                }
            ?>
                        </center></td>
            <?php
                            }
                        }
            ?>
                        <td hidden><center><?php echo $fa['semester']?></center></td>
                        <td hidden><center><?php echo $fa['yearlevel']?></center></td>
                    </tr>
            <?php
					$lab = $fa['lab'];
					$lec = $fa['lec'];
					$units = $fa['units'];
					$t_units = $lab + $lec;
										
					$total_lab = $total_lab + $lab;
					$total_lec = $total_lec + $lec;
					$total_units = $total_units + $units;
                    }
                }
				echo'<tr>
						<td></td>
						<td class="text-center" ><b>TOTAL</b></td>
						<td><center>'.$total_lec.'</center></td>
						<td><center>'.$total_lab.'</center></td>
						<td><center>'.$total_units.'</center></td>
						<td></td>
						<td></td>
                	 </tr>';
            ?>
										</tbody>
										<tfoot >	
											<!-- table footer -->
										</tfoot>
									</table>

                                    <div class="text-uppercase fw-bold mb-2">
										<span>Summer</span>
									</div>
			<?php
                $check_4th_sem_summer = mysqli_query($connection,"SELECT * FROM tblsubject WHERE semester='summer' and curr_id_fk='$Currid' and course_id_fk='$courseid' and yearlevel='4'");
            ?>
									<table class="table table-striped" id="table4year1st" width="100%">
										<thead class="text-white">
											<tr>
											<th hidden>id</th>
											<th><center>Code</center></th>
											<th><center>Title</center></th>
											<th scope="col"><center>Lec Hrs</center></th>
											<th scope="col"><center>Lab Hrs</center></th>
											<th scope="col"><center>Units</center></th>
											<th scope="col"><center>Prerequisite</center></th>
											<th hidden><center>Semester</center></th>
											<th hidden><center>Year</center></th>
											</tr>
										</thead>
										<tbody>
			<?php
                if(mysqli_num_rows($check_4th_sem_summer) > 0)
                {
					$total_lab = 0;
                    $total_lec = 0;
                    $total_units = 0;
					
                    while($fa = mysqli_fetch_array($check_4th_sem_summer))
                    {
                        $subjectid_save = $fa['id'];
						$subjectcode = $fa['subject_code'];
                        $prereq = $fa['prerequisite'];
            ?>
                    <tr>
                        <td hidden><?php echo $fa['id']?></td>
                        <td scope="row"><center><?php echo $fa['subject_code']?></center></td>
                        <td><center><?php echo $fa['description']?></center></td>
                        <td><center><?php echo $fa['lec']?></center></td>
                        <td><center><?php echo $fa['lab']?></center></td>
                        <td><center><?php echo $fa['units']?></center></td>
                        <?php
                        if($prereq == "NONE")
                        {
                            echo '<td><center>NONE</center></td>';
                        }
                        else if($prereq == "HAVE")
                        {              
                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$subjectid_save' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                            $get_check = mysqli_query($connection,$checkprereq);
                            $Rows = mysqli_fetch_array($get_check);
                            $SubID = $Rows[0];
                            
                            if($SubID == 1)
                            {
                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$subjectid_save' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                $checkpreq = mysqli_query($connection,$getpreq);
                                foreach($checkpreq as $rows)
                                {
                                    $new = $rows['subject_id'];    
                                }
                                $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$new' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                while($sa = mysqli_fetch_array($getsubcode))
                                {
                                    $subCode = $sa['subject_code'];
                                }
                                echo '<td><center>'.$subCode.'</center></td>';
                            }
                            else if($SubID > 1)
                            {
            ?>
                        <td><center>
            <?php
                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$subjectid_save' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                foreach($getpreq as $rows)
                                {
                                    $news = $rows['subject_id'];     
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$news' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
                                        print_r($sa['subject_code']);
                                        echo "\t";
                                    }                                                
                                }
            ?>
                        </center></td>
            <?php
                            }
                        }
            ?>
                        <td hidden><center><?php echo $fa['semester']?></center></td>
                        <td hidden><center><?php echo $fa['yearlevel']?></center></td>
                    </tr>
            <?php
					$lab = $fa['lab'];
					$lec = $fa['lec'];
					$units = $fa['units'];
					$t_units = $lab + $lec;
										
					$total_lab = $total_lab + $lab;
					$total_lec = $total_lec + $lec;
					$total_units = $total_units + $units;
                    }
                }
				echo'<tr>
						<td></td>
						<td class="text-center" ><b>TOTAL</b></td>
						<td><center>'.$total_lec.'</center></td>
						<td><center>'.$total_lab.'</center></td>
						<td><center>'.$total_units.'</center></td>
						<td></td>
						<td></td>
                	 </tr>';
            ?>
										</tbody>
										<tfoot >	
											<!-- table footer -->
										</tfoot>
									</table>
								</div>
								<!-- End of 4th Year Subjects -->

								<!-- 5th Year Subjects -->
								<div class="border-top border-bottom mt-2">
									<div class="text-uppercase fw-bold text-center fs-4 mt-2 mb-1">
										<span>Fifth Year</span>
									</div>

									<div class="text-uppercase fw-bold mb-2">
										<span>1st Semester</span>
									</div>
			<?php
                $check_5th_sem_1st = mysqli_query($connection,"SELECT * FROM tblsubject WHERE semester='1st' and curr_id_fk='$Currid' and course_id_fk='$courseid' and yearlevel='5'");
            ?>
									<table class="table table-striped" id="table5year1st" width="100%">
										<thead class="text-white">
											<tr>
											<th hidden>id</th>
											<th><center>Code</center></th>
											<th><center>Title</center></th>
											<th scope="col"><center>Lec Hrs</center></th>
											<th scope="col"><center>Lab Hrs</center></th>
											<th scope="col"><center>Units</center></th>
											<th scope="col"><center>Prerequisite</center></th>
											<th hidden><center>Semester</center></th>
											<th hidden><center>Year</center></th>
											</tr>
										</thead>
										<tbody>
			<?php
                if(mysqli_num_rows($check_5th_sem_1st) > 0)
                {
					$total_lab = 0;
                    $total_lec = 0;
                    $total_units = 0;
					
                    while($fa = mysqli_fetch_array($check_5th_sem_1st))
                    {
                        $subjectid_save = $fa['id'];
						$subjectcode = $fa['subject_code'];
                        $prereq = $fa['prerequisite'];
            ?>
                    <tr>
                        <td hidden><?php echo $fa['id']?></td>
                        <td scope="row"><center><?php echo $fa['subject_code']?></center></td>
                        <td><center><?php echo $fa['description']?></center></td>
                        <td><center><?php echo $fa['lec']?></center></td>
                        <td><center><?php echo $fa['lab']?></center></td>
                        <td><center><?php echo $fa['units']?></center></td>
                        <?php
                        if($prereq == "NONE")
                        {
                            echo '<td><center>NONE</center></td>';
                        }
                        else if($prereq == "HAVE")
                        {              
                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$subjectid_save' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                            $get_check = mysqli_query($connection,$checkprereq);
                            $Rows = mysqli_fetch_array($get_check);
                            $SubID = $Rows[0];
                            
                            if($SubID == 1)
                            {
                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$subjectid_save' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                $checkpreq = mysqli_query($connection,$getpreq);
                                foreach($checkpreq as $rows)
                                {
                                    $new = $rows['subject_id'];    
                                }
                                $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$new' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                while($sa = mysqli_fetch_array($getsubcode))
                                {
                                    $subCode = $sa['subject_code'];
                                }
                                echo '<td><center>'.$subCode.'</center></td>';
                            }
                            else if($SubID > 1)
                            {
            ?>
                        <td><center>
            <?php
                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$subjectid_save' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                foreach($getpreq as $rows)
                                {
                                    $news = $rows['subject_id'];       
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$news' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
                                        print_r($sa['subject_code']);
                                        echo "\t";
                                    }                                              
                                }
            ?>
                        </center></td>
            <?php
                            }
                        }
            ?>
                        <td hidden><center><?php echo $fa['semester']?></center></td>
                        <td hidden><center><?php echo $fa['yearlevel']?></center></td>
                    </tr>
            <?php
					$lab = $fa['lab'];
					$lec = $fa['lec'];
					$units = $fa['units'];
					$t_units = $lab + $lec;
										
					$total_lab = $total_lab + $lab;
					$total_lec = $total_lec + $lec;
					$total_units = $total_units + $units;
                    }
                }
				echo'<tr>
						<td></td>
						<td class="text-center" ><b>TOTAL</b></td>
						<td><center>'.$total_lec.'</center></td>
						<td><center>'.$total_lab.'</center></td>
						<td><center>'.$total_units.'</center></td>
						<td></td>
						<td></td>
                	 </tr>';
            ?>
										</tbody>
										<tfoot >	
											<!-- table footer -->
										</tfoot>
									</table>

									<div class="text-uppercase fw-bold mb-2">
										<span>2nd Semester</span>
									</div>
			<?php
                $check_5th_sem_2nd = mysqli_query($connection,"SELECT * FROM tblsubject WHERE semester='2nd' and curr_id_fk='$Currid' and course_id_fk='$courseid' and yearlevel='5'");
            ?>
									<table class="table table-striped" id="table5year2nd" width="100%">
										<thead class="text-white">
											<tr>
											<th hidden>id</th>
											<th><center>Code</center></th>
											<th><center>Title</center></th>
											<th scope="col"><center>Lec Hrs</center></th>
											<th scope="col"><center>Lab Hrs</center></th>
											<th scope="col"><center>Units</center></th>
											<th scope="col"><center>Prerequisite</center></th>
											<th hidden><center>Semester</center></th>
											<th hidden><center>Year</center></th>
											</tr>
										</thead>
										<tbody>
			<?php
                if(mysqli_num_rows($check_5th_sem_2nd) > 0)
                {
                    while($fa = mysqli_fetch_array($check_5th_sem_2nd))
                    {
                        $subjectid_save = $fa['id'];
						$subjectcode = $fa['subject_code'];
                        $prereq = $fa['prerequisite'];
            ?>
                    <tr>
                        <td hidden><?php echo $fa['id']?></td>
                        <td scope="row"><center><?php echo $fa['subject_code']?></center></td>
                        <td><center><?php echo $fa['description']?></center></td>
                        <td><center><?php echo $fa['lec']?></center></td>
                        <td><center><?php echo $fa['lab']?></center></td>
                        <td><center><?php echo $fa['units']?></center></td>
                        <?php
                        if($prereq == "NONE")
                        {
                            echo '<td><center>NONE</center></td>';
                        }
                        else if($prereq == "HAVE")
                        {              
                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$subjectid_save' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                            $get_check = mysqli_query($connection,$checkprereq);
                            $Rows = mysqli_fetch_array($get_check);
                            $SubID = $Rows[0];
                            
                            if($SubID == 1)
                            {
                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$subjectid_save' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                $checkpreq = mysqli_query($connection,$getpreq);
                                foreach($checkpreq as $rows)
                                {
                                    $new = $rows['subject_id'];    
                                }
                                $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$new' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                while($sa = mysqli_fetch_array($getsubcode))
                                {
                                    $subCode = $sa['subject_code'];
                                }
                                echo '<td><center>'.$subCode.'</center></td>';
                            }
                            else if($SubID > 1)
                            {
            ?>
                        <td><center>
            <?php
                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$subjectid_save' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                foreach($getpreq as $rows)
                                {
                                    $news = $rows['subject_id'];   
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$news' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
                                        print_r($sa['subject_code']);
                                        echo "\t";
                                    }                                                  
                                }
            ?>
                        </center></td>
            <?php
                            }
                        }
            ?>
                        <td hidden><center><?php echo $fa['semester']?></center></td>
                        <td hidden><center><?php echo $fa['yearlevel']?></center></td>
                    </tr>
            <?php
					$total_lab5 = 0;
					$total_lec5 = 0;
					$total_units5 = 0;

					$lab = $fa['lab'];
					$lec = $fa['lec'];
					$units = $fa['units'];
					$t_units = $lab + $lec;
										
					$total_lab = $total_lab5 + $lab;
					$total_lec = $total_lec5 + $lec;
					$total_units = $total_units5 + $units;
                    }
                }
				echo'<tr>
						<td></td>
						<td class="text-center" ><b>TOTAL</b></td>
						<td><center>'.$total_lec.'</center></td>
						<td><center>'.$total_lab.'</center></td>
						<td><center>'.$total_units.'</center></td>
						<td></td>
						<td></td>
                	 </tr>';
            ?>
										</tbody>
										<tfoot >	
											<!-- table footer -->
										</tfoot>
									</table>

                                    <div class="text-uppercase fw-bold mb-2">
										<span>Summer</span>
									</div>
			<?php
                $check_5th_sem_summer = mysqli_query($connection,"SELECT * FROM tblsubject WHERE semester='summer' and curr_id_fk='$Currid' and course_id_fk='$courseid' and yearlevel='5'");
            ?>
									<table class="table table-striped" id="table5year1st" width="100%">
										<thead class="text-white">
											<tr>
											<th hidden>id</th>
											<th><center>Code</center></th>
											<th><center>Title</center></th>
											<th scope="col"><center>Lec Hrs</center></th>
											<th scope="col"><center>Lab Hrs</center></th>
											<th scope="col"><center>Units</center></th>
											<th scope="col"><center>Prerequisite</center></th>
											<th hidden><center>Semester</center></th>
											<th hidden><center>Year</center></th>
											</tr>
										</thead>
										<tbody>
			<?php
                if(mysqli_num_rows($check_5th_sem_summer) > 0)
                {
					$total_lab = 0;
                    $total_lec = 0;
                    $total_units = 0;
					
                    while($fa = mysqli_fetch_array($check_5th_sem_summer))
                    {
                        $subjectid_save = $fa['id'];
						$subjectcode = $fa['subject_code'];
                        $prereq = $fa['prerequisite'];
            ?>
                    <tr>
                        <td hidden><?php echo $fa['id']?></td>
                        <td scope="row"><center><?php echo $fa['subject_code']?></center></td>
                        <td><center><?php echo $fa['description']?></center></td>
                        <td><center><?php echo $fa['lec']?></center></td>
                        <td><center><?php echo $fa['lab']?></center></td>
                        <td><center><?php echo $fa['units']?></center></td>
                        <?php
                        if($prereq == "NONE")
                        {
                            echo '<td><center>NONE</center></td>';
                        }
                        else if($prereq == "HAVE")
                        {              
                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$subjectid_save' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                            $get_check = mysqli_query($connection,$checkprereq);
                            $Rows = mysqli_fetch_array($get_check);
                            $SubID = $Rows[0];
                            
                            if($SubID == 1)
                            {
                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$subjectid_save' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                $checkpreq = mysqli_query($connection,$getpreq);
                                foreach($checkpreq as $rows)
                                {
                                    $new = $rows['subject_id'];    
                                }
                                $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$new' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                while($sa = mysqli_fetch_array($getsubcode))
                                {
                                    $subCode = $sa['subject_code'];
                                }
                                echo '<td><center>'.$subCode.'</center></td>';
                            }
                            else if($SubID > 1)
                            {
            ?>
                        <td><center>
            <?php
                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$subjectid_save' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                foreach($getpreq as $rows)
                                {
                                    $news = $rows['subject_id'];       
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$news' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
                                        print_r($sa['subject_code']);
                                        echo "\t";
                                    }                                              
                                }
            ?>
                        </center></td>
            <?php
                            }
                        }
            ?>
                        <td hidden><center><?php echo $fa['semester']?></center></td>
                        <td hidden><center><?php echo $fa['yearlevel']?></center></td>
                    </tr>
            <?php
					$lab = $fa['lab'];
					$lec = $fa['lec'];
					$units = $fa['units'];
					$t_units = $lab + $lec;
										
					$total_lab = $total_lab + $lab;
					$total_lec = $total_lec + $lec;
					$total_units = $total_units + $units;
                    }
                }
				echo'<tr>
						<td></td>
						<td class="text-center" ><b>TOTAL</b></td>
						<td><center>'.$total_lec.'</center></td>
						<td><center>'.$total_lab.'</center></td>
						<td><center>'.$total_units.'</center></td>
						<td></td>
						<td></td>
                	 </tr>';
            ?>
										</tbody>
										<tfoot >	
											<!-- table footer -->
										</tfoot>
									</table>
								</div>
								<!-- End of 5th Year Subjects -->
								
						</div>

						<div class="modal-footer" align="right">
							<button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- End of Viw Subjects Modal -->

	<!-- ADD NEW SUBJECT POPUP -->
	<div class="container container-fluid">
        <div class="modal fade" id="addSubjectsmodal" tabindex="-1" role="dialog" aria-labelledby="addSubjectsLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document" style="max-width: 1240px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="addSubjectsLabel">Create Subject For Student</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>

                        <div class="modal-body">
                    <form action="managedata.php" method="POST">
                            <!-- Inputs -->
                            <table class="table table-striped" id="table_add_sub" width="100%">
                            <input type="hidden" name="currid" value="<?php echo $Currid?>">
                            <input type="hidden" name="adviserid" value="<?php echo $adminid?>">
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
                                    <th ><center>Semester</center></th>
                                </tr>
                            </thead>
                            <tbody>
                    <?php
                        $select_subject_sem = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$Currid' and course_id_fk='$courseid'");
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

                                $check_send_subid = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE remarks='PASSED' and adviser_id_fk='$adminid' and student_id='$Studid' and subject_id_fk='$subjectID' and curri_id='$Currid' and course_id_fk='$courseid'");
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
                                <td><center><?php echo $se['semester']?></center></td>
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
                        </div>

                        <div class="modal-footer" align="right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Closed</button>
                            <button type="submit" name="create_sub" id="button" class="btn btn-success" style="display: none;">Add Subject</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ADD SUBJECT END -->

    <!-- Start Input All Grades Subject -->
    <div class="container container-fluid">
        <div class="modal fade" id="input_grades_1st_1st_sem" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document" style="max-width: 1250px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Input Grades Subjects For Student</h5></h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <div class="modal-body">
                            <form action="managedata.php" method="POST">
                                <input type="hidden" name="studid" value="<?php echo $Studid?>">
                                <input type="hidden" name="currid" value="<?php echo $Currid ?>">
                                <table class="table table-striped" id="table_grade_input" width="100%">
                                    <thead class="text-white">
                                        <tr>
                                            <th><center></center></th>
                                            <th><center>Title</center></th>
                                            <th><center>Grades</center></th>
                                            <th><center>Year Level</center></th>
                                            <th><center>Semester</center></th>
                                            <th hidden><center>Subjectid</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                        <?php
                            $get_subject = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE remarks='' or remarks='PASSED' and adviser_id_fk='$adminid' and student_id='$Studid' and curri_id='$Currid'");
                            if(mysqli_num_rows($get_subject) > 0)
                            {
                                while($fa = mysqli_fetch_array($get_subject))
                                {
                                    $PreID = $fa['id'];
                                    $SubID = $fa['subject_id_fk'];
                                    $Course_id = $fa['course_id_fk'];
                                    $Grades = $fa['grades'];
                                    $YrLvl = $fa['yearlevel'];
                                    $Sem = $fa['semester'];
                                    $SubjectID = $fa['subject_id_fk'];
                                    $GetSub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$SubID'");
                                    while($su=mysqli_fetch_array($GetSub))
                                    {
                                        $SubDes = $su['description'];
                                    }
                        ?>
                                        <tr>
                                            
                                            <td><center><?php echo $SubDes?></center></td>
                                            <td><center>
                                            <div class="form-group">
                                                <select name="grades_<?=$PreID ?>" value="<?=$Grades?>" class="form-control text-center">
                                                    <option value="0">Select Grade</option>
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
                                                    <option value="CREDITED">CREDITED</option>
                                                    <option value="DRP">DRP</option>
                                                </select>
                                            </div>
                                            </center></td>
                                            <td><center><?php echo $YrLvl?></center></td>
                                            <td><center><?php echo $Sem?></center></td>
                                            
                                        </tr>
                        <?php
                                }
                            }
                        ?>
                                    </tbody>
                                </table>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Closed</button>
                            
                        </div>                     
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Input Grades 1st Sem Subject -->

	<!-- DELETE All Subject MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteAllSubjectModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete All Student Subjects</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="managedata.php" method="POST">
                        <input type="hidden" name="studentid" value="<?php echo $Studid?>">
                        <input type="hidden" name="currid" value="<?php echo $Currid?>">
                        <center>
                            <div class="modal-body">
                                All data will be deleted! 
                                Are you sure you want to delete All Student Subjects?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                <button type="submit" name="delete_all_subject" class="btn btn-success">Yes</button>
                            </div>                     
                        </center>
                    </form>
                </div>
            </div>
        </div>
	</div>
    <!--END OF DELETE All Subject Modal -->

    <!-- Start Send A subject to student -->
    <div class="container container-fluid">
        <div class="modal fade" id="sendSubjectModal" tabindex="-1" role="dialog" aria-labelledby="addSubjectsLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="addSubjectsLabel">Send Subject to Student</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>

                        <div class="modal-body">
                    <form action="managedata.php" method="POST">
						<input type="hidden" name="studentid" value="<?php echo $Studid?>">
						<input type="hidden" name="currid" value="<?php echo $Currid?>">
						<input type="hidden" name="collegeid" value="<?php echo $collegeid?>">
						<input type="hidden" name="courseid" value="<?php echo $courseid?>">
                            <!-- Inputs -->

                            <div class="form-group">
                                <label for="multiple">Select Subjects</label>
                                <select name="select_subid[]" class="form-control multiple-1" id="multiple" style="width: 29rem; border: #F2F3F5 1px;" multiple required>
                                    <?php
                                        $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$Currid' and course_id_fk='$courseid'");
                                        if(mysqli_num_rows($getsub) > 0)
                                        {
                                            foreach($getsub as $datas)
                                            {   
                                    ?>
                                        <option value="<?php echo $datas['id']; ?>"><?php echo $datas['subject_code']; ?></option>
                                    <?php
                                            }
                                        }
                                        else
                                        {
                                            echo "No Records Found!!";
                                        }
                                    ?> 
                                </select>
                                <div>Hold <span class="text-danger">CTRL</span> to multiple selection</div>	
                            </div>

                            <!-- Semester -->
                            <div class="container p-0 mb-3" id="select-prereq">
								<label for="select-prereq" class="form-label" >Semester</label>
								<select name="semester" class="custom-select text-center p-2" id="select-prereq" required>
									<option value="">Select Semester</option>
									<option value="1st">1st Semester</option>
									<option value="2nd">2nd Semester</option>
								</select>			
							</div>			
                        </div>

                        <div class="modal-footer" align="right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" name="send_sub" class="btn btn-success">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Start Send A subject to student -->

    <!-- Start View Send A subject to student -->
    <div class="container container-fluid">
        <div class="modal fade" id="viewSendSubjectModal" tabindex="-1" role="dialog" aria-labelledby="addSubjectsLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document" style="max-width: 1280px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="addSubjectsLabel">Send Subject to Student</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
        <?php
            $select_sub = mysqli_query($connection,"SELECT * FROM tbladviser_send_sub_to_stud WHERE status='Approved' and adviser_id_fk='$adminid' and student_id_fk='$Studid' and curri_id_fk='$Currid'");
        ?>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                            <table class="table table-striped" id="" width="100%">
						    <thead class="text-white">
								<tr>
                                    <th hidden><center>id</center></th>
									<th><center>Code</center></th>
									<th><center>Title</center></th>
									<th scope="col"><center>Lec</center></th>
									<th scope="col"><center>Lab</center></th>
									<th scope="col"><center>Units</center></th>
									<th scope="col"><center>School Year</center></th>
								</tr>
							</thead>
                            <tbody>
        <?php
            if(mysqli_num_rows($select_sub) > 0)
            {
                while($ca=mysqli_fetch_array($select_sub))
                {
                    $SubID = $ca['subject_id_fk'];
                    $SY = $ca['school_year'];

                    $select_subj = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$SubID'");
                    while($sa=mysqli_fetch_array($select_subj))
                    {
                        $SubCode = $sa['subject_code'];
                        $SubDes = $sa['description'];
                        $SubLec = $sa['lec'];
                        $SubLab = $sa['lab'];
                        $SubUnits = $sa['units'];
                        $SubPreq = $sa['prerequisite'];
                    }   
        ?>
                                <tr>
                                    <td hidden><center><?php echo $ca['id'] ?></center></td>
                                    <td><center><?php echo $SubCode?></center></td>
                                    <td><center><?php echo $SubDes?></center></td>
                                    <td><center><?php echo $SubLec?></center></td>
                                    <td><center><?php echo $SubLab?></center></td>
                                    <td><center><?php echo $SubUnits?></center></td>
                                    <td><center><?php echo $SY?></center></td>
                                </tr>
        <?php
                }
            }
            $select_units = "SELECT sum(units) FROM tbladviser_send_sub_to_stud WHERE status='Approved' and adviser_id_fk='$adminid' and student_id_fk='$Studid' and curri_id_fk='$Currid' and course_id_fk='$courseid'";
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
								</tr>
							</tfoot>
						</table>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer" align="right">
                        <button class="btn btn-secondary" data-dismiss="modal">Closed</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End View Send A subject to student -->

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

    <!-- Start Send Delete Data -->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteSendSubjectModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Student Send Subjects</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="managedata.php" method="POST">
                        <input type="hidden" name="send_subid" id="stud_send_subjectid">
                        <center>
                            <div class="modal-body">
                                This data will be deleted! 
                                Are you sure you want to delete this subject?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                <button type="submit" name="delete_send_subject" class="btn btn-success">Yes</button>
                            </div>                     
                        </center>
                    </form>
                </div>
            </div>
        </div>
	</div>
    <!-- End Send Delete Data -->

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

<!-- First Year List -->
    <!-- MANAGE 1st SUBJECTS 1st Sem -->
    <div class="modal fade" id="edit1stSubject1stModal" role="dialog" data-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="manage-subject" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="manage-curriculum">Manage Subject</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                    <div class="modal-body">
                <form action="managedata.php" method="POST">
                        <input type="hidden" name="idPreSub" id="1st_subject_preid_1st">
                        <input type="hidden" name="subject_id" id="1st_subject_id_1st">
                        <input type="hidden" name="studentid" value="<?php echo $Studid?>">
						<input type="hidden" name="currid" value="<?php echo $Currid?>">
						<input type="hidden" name="collegeid" value="<?php echo $collegeid?>">
						<input type="hidden" name="courseid" value="<?php echo $courseid?>">
                            <!-- Inputs -->
                            <div class="form-group">
                                <label for="1st_subject_1st">Subjects</label>                 
                                <select name="subjectdes" class="form-control text-center" id="1st_subject_1st" disabled>
                                    <?php
                                        $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$Currid' and course_id_fk='$courseid'");
                                        if(mysqli_num_rows($getsub) > 0)
                                        {
                                            foreach($getsub as $datas)
                                            {   
                                    ?>
                                        <option value="<?php echo $datas['description']; ?>"><?php echo $datas['description']; ?></option>
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

                            <div class="container p-0 mb-3" id="select-prereq">
								<label for="1st_sem_1st" class="form-label" >Semester</label>
								<select name="semester" class="custom-select text-center p-2" id="1st_sem_1st" disabled>
									<option value="0">Select Semester</option>
									<option value="1st">1st Semester</option>
									<option value="2nd">2nd Semester</option>
                                    <option value="summer">Summer</option>
								</select>			
							</div>		

							<!-- Year Level -->		
							<div class="container p-0 mb-3" id="select-course">
								<label for="1st_year_1st" class="form-label" >Year Level</label>
								<select name="year" class="custom-select text-center p-2" id="1st_year_1st" disabled>
									<option value="0">Select Year Level</option>
									<option value="1">1st </option>
									<option value="2">2nd</option>
									<option value="3">3rd</option>
									<option value="4">4th</option>
									<option value="5">5th</option>
								</select>			
							</div>	

                            <div class="container p-0 mb-3" id="select-prereq">
                                <label for="1st_schoolyear_1st" class="form-label" >School Year</label>
                                <input type="text" name="sy" class="form-control text-center p-2" id="1st_schoolyear_1st">
                            </div>

                            <!-- School Year 		
							<div class="container p-0 mb-3" id="select-course">
								<label for="1st_schoolyear_1st" class="form-label" >School Year</label>
								<select name="sy" class="custom-select text-center p-2" id="1st_schoolyear_1st">
									<option value="0">Select School Year</option>
									<?php
                                        $getsub = mysqli_query($connection,"SELECT * FROM tblschool_year WHERE status='Activated'");
                                        if(mysqli_num_rows($getsub) > 0)
                                        {
                                            foreach($getsub as $datas)
                                            {   
                                    ?>
                                        <option value="<?php echo $datas['school_year']; ?>"><?php echo $datas['school_year']; ?></option>
                                    <?php
                                            }
                                        }
                                        else
                                        {
                                            echo "No Records Found!!";
                                        }
                                    ?> 
								</select>			
							</div>	-->

                            <!-- Remarks 	
							<div class="container p-0 mb-3" id="select-course">
								<label for="1st_remarks_1st" class="form-label" >Remarks</label>
								<select name="remarks" class="custom-select text-center p-2" required id="1st_remarks_1st">
									<option value="0">Select Year Level</option>
									<option value="PASSED">PASSED </option>
									<option value="FAILED">FAILED</option>
								</select>			
							</div>	-->	
                    </div>	

                    <div class="modal-footer" align="right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="update_sub" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- MANAGE 1st SUBJECTS 1st Sem END -->

	<!-- MANAGE 1st SUBJECTS 2nd Sem -->
    <div class="modal fade" id="edit1stSubject2ndModal" role="dialog" data-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="manage-subject" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="manage-curriculum">Manage Subject</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                    <div class="modal-body">
                <form action="managedata.php" method="POST">
                        <input type="hidden" name="idPreSub" id="1st_subject_preid_2nd">
                        <input type="hidden" name="subject_id" id="1st_subject_id_2nd">
                        <input type="hidden" name="studentid" value="<?php echo $Studid?>">
						<input type="hidden" name="currid" value="<?php echo $Currid?>">
						<input type="hidden" name="collegeid" value="<?php echo $collegeid?>">
						<input type="hidden" name="courseid" value="<?php echo $courseid?>">
                            <!-- Inputs -->
                            <div class="form-group">
                                <label for="1st_subject_1st">Subjects</label>                 
                                <select name="subjectdes" class="form-control text-center" id="1st_subject_2nd" disabled>
                                    <?php
                                        $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$Currid' and course_id_fk='$courseid'");
                                        if(mysqli_num_rows($getsub) > 0)
                                        {
                                            foreach($getsub as $datas)
                                            {   
                                    ?>
                                        <option value="<?php echo $datas['description']; ?>"><?php echo $datas['description']; ?></option>
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

							<!-- year -->		
							<div class="container p-0 mb-3" id="select-course">
								<label for="1st_year_1st" class="form-label" >Year Level</label>
								<select name="year" class="custom-select text-center p-2" id="1st_year_2nd" disabled>
									<option value="0">Select Year Level</option>
									<option value="1">1st </option>
									<option value="2">2nd</option>
									<option value="3">3rd</option>
									<option value="4">4th</option>
									<option value="5">5th</option>
								</select>			
							</div>	

                            <!-- Semester -->
                            <div class="container p-0 mb-3" id="select-prereq">
								<label for="1st_sem_2nd" class="form-label" >Semester</label>
								<select name="semester" class="custom-select text-center p-2" id="1st_sem_2nd" disabled>
									<option value="0">Select Semester</option>
									<option value="1st">1st Semester</option>
									<option value="2nd">2nd Semester</option>
                                    <option value="summer">Summer</option>
								</select>			
							</div>

                            <div class="container p-0 mb-3" id="select-prereq">
                                <label for="1st_schoolyear_2nd" class="form-label" >School Year</label>
                                <input type="text" name="sy" class="form-control text-center p-2" id="1st_schoolyear_2nd">
                            </div>

                            <!-- School Year 	
							<div class="container p-0 mb-3" id="select-course">
								<label for="1st_schoolyear_2nd" class="form-label" >School Year</label>
								<select name="sy" class="custom-select text-center p-2" id="1st_schoolyear_2nd">
									<?php
                                        $getsub = mysqli_query($connection,"SELECT * FROM tblschool_year WHERE status='Activated'");
                                        if(mysqli_num_rows($getsub) > 0)
                                        {
                                            foreach($getsub as $datas)
                                            {   
                                    ?>
                                        <option value="<?php echo $datas['school_year']; ?>"><?php echo $datas['school_year']; ?></option>
                                    <?php
                                            }
                                        }
                                        else
                                        {
                                            echo "No Records Found!!";
                                        }
                                    ?> 
								</select>			
							</div>	-->	

                            <!-- Remarks 	
							<div class="container p-0 mb-3" id="select-course">
								<label for="1st_remarks_1st" class="form-label" >Remarks</label>
								<select name="remarks" class="custom-select text-center p-2" required id="1st_remarks_2nd">
									<option value="0">Select Year Level</option>
									<option value="PASSED">PASSED </option>
									<option value="FAILED">FAILED</option>
								</select>			
							</div>	-->	
                    </div>	

                    <div class="modal-footer" align="right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="update_sub" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- MANAGE 1st SUBJECTS 2nd Sem END -->

    <!-- MANAGE 1st SUBJECTS summer Sem -->
    <div class="modal fade" id="edit1stSubjectsummerModal" role="dialog" data-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="manage-subject" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="manage-curriculum">Manage Subject</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                    <div class="modal-body">
                <form action="managedata.php" method="POST">
                        <input type="hidden" name="idPreSub" id="1st_subject_preid_summer">
                        <input type="hidden" name="subject_id" id="1st_subject_id_summer">
                        <input type="hidden" name="studentid" value="<?php echo $Studid?>">
						<input type="hidden" name="currid" value="<?php echo $Currid?>">
						<input type="hidden" name="collegeid" value="<?php echo $collegeid?>">
						<input type="hidden" name="courseid" value="<?php echo $courseid?>">
                            <!-- Inputs -->
                            <div class="form-group">
                                <label for="1st_subject_summer">Subjects</label>                 
                                <select name="subjectdes" class="form-control text-center" id="1st_subject_summer" disabled>
                                    <?php
                                        $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$Currid' and course_id_fk='$courseid'");
                                        if(mysqli_num_rows($getsub) > 0)
                                        {
                                            foreach($getsub as $datas)
                                            {   
                                    ?>
                                        <option value="<?php echo $datas['description']; ?>"><?php echo $datas['description']; ?></option>
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

							<!-- year -->		
							<div class="container p-0 mb-3" id="select-course">
								<label for="1st_year_summer" class="form-label" >Year Level</label>
								<select name="year" class="custom-select text-center p-2" id="1st_year_summer" disabled>
									<option value="0">Select Year Level</option>
									<option value="1">1st </option>
									<option value="2">2nd</option>
									<option value="3">3rd</option>
									<option value="4">4th</option>
									<option value="5">5th</option>
								</select>			
							</div>	

                            <!-- Semester -->
                            <div class="container p-0 mb-3" id="select-prereq">
								<label for="1st_sem_summer" class="form-label" >Semester</label>
								<select name="semester" class="custom-select text-center p-2" id="1st_sem_summer" disabled>
									<option value="0">Select Semester</option>
									<option value="1st">1st Semester</option>
									<option value="2nd">2nd Semester</option>
                                    <option value="summer">Summer</option>
								</select>			
							</div>

                            <div class="container p-0 mb-3" id="select-prereq">
                                <label for="1st_schoolyear_summer" class="form-label" >School Year</label>
                                <input type="text" name="sy" class="form-control text-center p-2" id="1st_schoolyear_summer">
                            </div>

                            <!-- School Year 		
							<div class="container p-0 mb-3" id="select-course">
								<label for="1st_schoolyear_summer" class="form-label" >School Year</label>
								<select name="sy" class="custom-select text-center p-2" id="1st_schoolyear_summer">
									<?php
                                        $getsub = mysqli_query($connection,"SELECT * FROM tblschool_year WHERE status='Activated'");
                                        if(mysqli_num_rows($getsub) > 0)
                                        {
                                            foreach($getsub as $datas)
                                            {   
                                    ?>
                                        <option value="<?php echo $datas['school_year']; ?>"><?php echo $datas['school_year']; ?></option>
                                    <?php
                                            }
                                        }
                                        else
                                        {
                                            echo "No Records Found!!";
                                        }
                                    ?> 
								</select>			
							</div>-->

                            <!-- Remarks 
							<div class="container p-0 mb-3" id="select-course">
								<label for="1st_remarks_summer" class="form-label" >Remarks</label>
								<select name="remarks" class="custom-select text-center p-2" required id="1st_remarks_summer">
									<option value="0">Select Year Level</option>
									<option value="PASSED">PASSED </option>
									<option value="FAILED">FAILED</option>
								</select>			
							</div>	-->		
                    </div>	

                    <div class="modal-footer" align="right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="update_sub" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- MANAGE 1st SUBJECTS summer Sem END -->

        <!-- DELETE 1st SUBJECTS 1st Sem MODAL-->
        <div class="container container-fluid">
            <div class="modal fade" id="delete1stSubject1stModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Subject</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="subid" id="delete_sub_id_1st_1st">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Subject?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_sub_1st_1st" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--END OF DELETE 1st SUBJECTS 1st Sem MODAL-->

		<!-- DELETE 1st SUBJECTS 2nd Sem MODAL-->
        <div class="container container-fluid">
            <div class="modal fade" id="delete1stSubject2ndModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Subject</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="subid" id="delete_sub_id_1st_2nd">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Subject?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_sub_1st_2nd" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--END OF DELETE 1st SUBJECTS 2nd Sem MODAL-->
<!-- End Of First Year List -->

<!-- Second Year List -->
    <!-- MANAGE SUBJECTS 2nd 1st sem -->
    <div class="modal fade" id="edit2ndSubject1stModal" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="manage-subject" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="manage-curriculum">Manage Subject</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                    <div class="modal-body">
                    <form action="managedata.php" method="POST">
                        <input type="hidden" name="idPreSub" id="2nd_subject_preid_1st">
                        <input type="hidden" name="subject_id" id="2nd_subject_id_1st">
                        <input type="hidden" name="studentid" value="<?php echo $Studid?>">
						<input type="hidden" name="currid" value="<?php echo $Currid?>">
						<input type="hidden" name="collegeid" value="<?php echo $collegeid?>">
						<input type="hidden" name="courseid" value="<?php echo $courseid?>">
                            <!-- Inputs -->
                            <div class="form-group">
                                <label for="2nd_subject_1st">Subjects</label>                 
                                <select name="subjectdes" class="form-control text-center" id="2nd_subject_1st" disabled>
                                    <?php
                                        $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$Currid' and course_id_fk='$courseid'");
                                        if(mysqli_num_rows($getsub) > 0)
                                        {
                                            foreach($getsub as $datas)
                                            {   
                                    ?>
                                        <option value="<?php echo $datas['description']; ?>"><?php echo $datas['description']; ?></option>
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

							<!-- Year -->		
							<div class="container p-0 mb-3" id="select-course">
								<label for="2nd_year_1st" class="form-label" >Year Level</label>
								<select name="year" class="custom-select text-center p-2" id="2nd_year_1st" disabled>
									<option value="0">Select Year Level</option>
									<option value="1">1st </option>
									<option value="2">2nd</option>
									<option value="3">3rd</option>
									<option value="4">4th</option>
									<option value="5">5th</option>
								</select>			
							</div>	

                            <!-- Semester -->
                            <div class="container p-0 mb-3" id="select-prereq">
								<label for="2nd_sem_1st" class="form-label" >Semester</label>
								<select name="semester" class="custom-select text-center p-2" id="2nd_sem_1st" disabled>
									<option value="0">Select Semester</option>
									<option value="1st">1st Semester</option>
									<option value="2nd">2nd Semester</option>
                                    <option value="summer">Summer</option>
								</select>			
							</div>	

                            <div class="container p-0 mb-3" id="select-prereq">
                                <label for="2nd_schoolyear_1st" class="form-label" >School Year</label>
                                <input type="text" name="sy" class="form-control text-center p-2" id="2nd_schoolyear_1st">
                            </div>

                            <!-- Grade 		
							<div class="container p-0 mb-3" id="select-course">
								<label for="2nd_grade_1st" class="form-label" >Grade</label>
								<select name="grade" class="custom-select text-center p-2" required id="2nd_grade_1st">
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
							</div>	-->

                            <!-- Remarks 		
							<div class="container p-0 mb-3" id="select-course">
								<label for="2nd_remarks_1st" class="form-label" >Remarks</label>
								<select name="remarks" class="custom-select text-center p-2" required id="2nd_remarks_1st">
									<option selected>Select Year Level</option>
									<option value="PASSED">PASSED </option>
									<option value="FAILED">FAILED</option>
								</select>			
							</div>	-->
                    </div>	

                    <div class="modal-footer" align="right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="update_sub" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- MANAGE SUBJECTS 2nd 1st sem END -->

	<!-- MANAGE SUBJECTS 2nd 2nd sem -->
    <div class="modal fade" id="edit2ndSubject2ndModal" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="manage-subject" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="manage-curriculum">Manage Subject</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                    <div class="modal-body">
                <form action="managedata.php" method="POST">
                        <input type="hidden" name="idPreSub" id="2nd_subject_preid_2nd">
                        <input type="hidden" name="subject_id" id="2nd_subject_id_2nd">
                        <input type="hidden" name="studentid" value="<?php echo $Studid?>">
						<input type="hidden" name="currid" value="<?php echo $Currid?>">
						<input type="hidden" name="collegeid" value="<?php echo $collegeid?>">
						<input type="hidden" name="courseid" value="<?php echo $courseid?>">
                            <!-- Inputs -->
                            <div class="form-group">
                                <label for="2nd_subject_2nd">Subjects</label>                 
                                <select name="subjectdes" class="form-control text-center" id="2nd_subject_2nd" disabled>
                                    <?php
                                        $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$Currid' and course_id_fk='$courseid'");
                                        if(mysqli_num_rows($getsub) > 0)
                                        {
                                            foreach($getsub as $datas)
                                            {   
                                    ?>
                                        <option value="<?php echo $datas['description']; ?>"><?php echo $datas['description']; ?></option>
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

							<!-- Year -->		
							<div class="container p-0 mb-3" id="select-course">
								<label for="2nd_year_2nd" class="form-label" >Year Level</label>
								<select name="year" class="custom-select text-center p-2" id="2nd_year_2nd" disabled>
									<option value="0">Select Year Level</option>
									<option value="1">1st </option>
									<option value="2">2nd</option>
									<option value="3">3rd</option>
									<option value="4">4th</option>
									<option value="5">5th</option>
								</select>			
							</div>	

                            <!-- Semester -->
                            <div class="container p-0 mb-3" id="select-prereq">
								<label for="2nd_sem_2nd" class="form-label" >Semester</label>
								<select name="semester" class="custom-select text-center p-2" id="2nd_sem_2nd" disabled>
									<option value="0">Select Semester</option>
									<option value="1st">1st Semester</option>
									<option value="2nd">2nd Semester</option>
                                    <option value="summer">Summer</option>
								</select>			
							</div>	

                            <div class="container p-0 mb-3" id="select-prereq">
                                <label for="2nd_schoolyear_2nd" class="form-label" >School Year</label>
                                <input type="text" name="sy" class="form-control text-center p-2" id="2nd_schoolyear_2nd">
                            </div>

                            <!-- Grade 		
							<div class="container p-0 mb-3" id="select-course">
								<label for="2nd_grade_2nd" class="form-label" >Grade</label>
								<select name="grade" class="custom-select text-center p-2" required id="2nd_grade_2nd">
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
							</div>	-->

                            <!-- Remarks 		
							<div class="container p-0 mb-3" id="select-course">
								<label for="2nd_remarks_2nd" class="form-label" >Remarks</label>
								<select name="remarks" class="custom-select text-center p-2" required id="2nd_remarks_2nd">
									<option selected>Select Year Level</option>
									<option value="PASSED">PASSED </option>
									<option value="FAILED">FAILED</option>
								</select>			
							</div>	-->
                    </div>	

                    <div class="modal-footer" align="right">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="update_sub" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- MANAGE SUBJECTS 2nd 2nd sem END -->

    <!-- MANAGE SUBJECTS 2nd summer sem -->
    <div class="modal fade" id="edit2ndSubjectsummerModal" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="manage-subject" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="manage-curriculum">Manage Subject</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                    <div class="modal-body">
                <form action="managedata.php" method="POST">
                        <input type="hidden" name="idPreSub" id="2nd_subject_preid_summer">
                        <input type="hidden" name="subject_id" id="2nd_subject_id_summer">
                        <input type="hidden" name="studentid" value="<?php echo $Studid?>">
						<input type="hidden" name="currid" value="<?php echo $Currid?>">
						<input type="hidden" name="collegeid" value="<?php echo $collegeid?>">
						<input type="hidden" name="courseid" value="<?php echo $courseid?>">
                            <!-- Inputs -->
                            <div class="form-group">
                                <label for="2nd_subject_2nd">Subjects</label>                 
                                <select name="subjectdes" class="form-control text-center" id="2nd_subject_summer" disabled>
                                    <?php
                                        $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$Currid' and course_id_fk='$courseid'");
                                        if(mysqli_num_rows($getsub) > 0)
                                        {
                                            foreach($getsub as $datas)
                                            {   
                                    ?>
                                        <option value="<?php echo $datas['description']; ?>"><?php echo $datas['description']; ?></option>
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

							<!-- Year -->		
							<div class="container p-0 mb-3" id="select-course">
								<label for="2nd_year_2nd" class="form-label" >Year Level</label>
								<select name="year" class="custom-select text-center p-2" id="2nd_year_summer" disabled>
									<option value="0">Select Year Level</option>
									<option value="1">1st </option>
									<option value="2">2nd</option>
									<option value="3">3rd</option>
									<option value="4">4th</option>
									<option value="5">5th</option>
								</select>			
							</div>	

                            <!-- Semester -->
                            <div class="container p-0 mb-3" id="select-prereq">
								<label for="2nd_sem_2nd" class="form-label" >Semester</label>
								<select name="semester" class="custom-select text-center p-2" id="2nd_sem_summer" disabled>
									<option value="0">Select Semester</option>
									<option value="1st">1st Semester</option>
									<option value="2nd">2nd Semester</option>
                                    <option value="summer">Summer</option>
								</select>			
							</div>	

                            <div class="container p-0 mb-3" id="select-prereq">
                                <label for="2nd_schoolyear_summer" class="form-label" >School Year</label>
                                <input type="text" name="sy" class="form-control text-center p-2" id="2nd_schoolyear_summer">
                            </div>

                            <!-- Grade 
							<div class="container p-0 mb-3" id="select-course">
								<label for="2nd_grade_2nd" class="form-label" >Grade</label>
								<select name="grade" class="custom-select text-center p-2" required id="2nd_grade_2nd">
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
							</div>	-->		

                            <!-- Remarks 		
							<div class="container p-0 mb-3" id="select-course">
								<label for="2nd_remarks_2nd" class="form-label" >Remarks</label>
								<select name="remarks" class="custom-select text-center p-2" required id="2nd_remarks_2nd">
									<option selected>Select Year Level</option>
									<option value="PASSED">PASSED </option>
									<option value="FAILED">FAILED</option>
								</select>			
							</div>	-->
                    </div>	

                    <div class="modal-footer" align="right">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="update_sub" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- MANAGE SUBJECTS 2nd summer sem END -->

        <!-- DELETE Subject 1st MODAL-->
        <div class="container container-fluid">
            <div class="modal fade" id="delete2ndSubject1stModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Subject</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="subid" id="deleteid_sub_id_2nd_1st">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Subject?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_sub_1st_1st" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
		</div>
        <!--END OF DELETE Admin MODAL-->

		<!-- DELETE Subject 2nd MODAL-->
        <div class="container container-fluid">
            <div class="modal fade" id="delete2ndSubject2ndModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Subject</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="subid" id="deleteid_sub_id_2nd_2nd">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Subject?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_sub_1st_1st" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
		</div>
        <!--END OF DELETE Admin MODAL-->
<!-- End Of Second Year List -->

<!-- Third Year List -->
    <!-- MANAGE SUBJECTS 3rd 1st sem -->
    <div class="modal fade" id="edit3rdSubject1stModal" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="manage-subject" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="manage-curriculum">Manage Subject</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                    <div class="modal-body">
                <form action="managedata.php" method="POST">
                        <input type="hidden" name="idPreSub" id="3rd_subject_preid_1st">
                        <input type="hidden" name="subject_id" id="3rd_subject_id_1st">
                        <input type="hidden" name="studentid" value="<?php echo $Studid?>">
						<input type="hidden" name="currid" value="<?php echo $Currid?>">
						<input type="hidden" name="collegeid" value="<?php echo $collegeid?>">
						<input type="hidden" name="courseid" value="<?php echo $courseid?>">
                            <!-- Inputs -->
                            <div class="form-group">
                                <label for="3rd_subject_1st">Subjects</label>                 
                                <select name="subjectdes" class="form-control text-center" id="3rd_subject_1st" disabled>
                                    <?php
                                        $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$Currid' and course_id_fk='$courseid'");
                                        if(mysqli_num_rows($getsub) > 0)
                                        {
                                            foreach($getsub as $datas)
                                            {   
                                    ?>
                                        <option value="<?php echo $datas['description']; ?>"><?php echo $datas['description']; ?></option>
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

							<!-- Year -->		
							<div class="container p-0 mb-3" id="select-course">
								<label for="3rd_year_1st" class="form-label" >Year Level</label>
								<select name="year" class="custom-select text-center p-2" id="3rd_year_1st" disabled>
									<option value="0">Select Year Level</option>
									<option value="1">1st </option>
									<option value="2">2nd</option>
									<option value="3">3rd</option>
									<option value="4">4th</option>
									<option value="5">5th</option>
								</select>			
							</div>	

                            <!-- Semester -->
                            <div class="container p-0 mb-3" id="select-prereq">
								<label for="3rd_sem_1st" class="form-label" >Semester</label>
								<select name="semester" class="custom-select text-center p-2" id="3rd_sem_1st" disabled>
									<option value="0">Select Semester</option>
									<option value="1st">1st Semester</option>
									<option value="2nd">2nd Semester</option>
                                    <option value="summer">Summer</option>
								</select>			
							</div>	

                            <div class="container p-0 mb-3" id="select-prereq">
                                <label for="3rd_schoolyear_1st" class="form-label" >School Year</label>
                                <input type="text" name="sy" class="form-control text-center p-2" id="3rd_schoolyear_1st">
                            </div>

                            <!-- Grade 		
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
							</div>	-->

                            <!-- Remarks 		
							<div class="container p-0 mb-3" id="select-course">
								<label for="3rd_remarks_1st" class="form-label" >Remarks</label>
								<select name="remarks" class="custom-select text-center p-2" required id="3rd_remarks_1st">
									<option selected>Select Year Level</option>
									<option value="PASSED">PASSED </option>
									<option value="FAILED">FAILED</option>
								</select>			
							</div>-->
                    </div>	

                    <div class="modal-footer" align="right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="update_sub" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- MANAGE SUBJECTS 3rd 1st sem END -->

	<!-- MANAGE SUBJECTS 3rd 2nd sem -->
    <div class="modal fade" id="edit3rdSubject2ndModal" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="manage-subject" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="manage-curriculum">Manage Subject</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                    <div class="modal-body">
                <form action="managedata.php" method="POST">
                        <input type="hidden" name="idPreSub" id="3rd_subject_preid_2nd">
                        <input type="hidden" name="subject_id" id="3rd_subject_id_2nd">
                        <input type="hidden" name="studentid" value="<?php echo $Studid?>">
						<input type="hidden" name="currid" value="<?php echo $Currid?>">
						<input type="hidden" name="collegeid" value="<?php echo $collegeid?>">
						<input type="hidden" name="courseid" value="<?php echo $courseid?>">
                            <!-- Inputs -->
                            <div class="form-group">
                                <label for="3rd_subject_2nd">Subjects</label>                 
                                <select name="subjectdes" class="form-control text-center" id="3rd_subject_2nd" disabled>
                                    <?php
                                        $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$Currid' and course_id_fk='$courseid'");
                                        if(mysqli_num_rows($getsub) > 0)
                                        {
                                            foreach($getsub as $datas)
                                            {   
                                    ?>
                                        <option value="<?php echo $datas['description']; ?>"><?php echo $datas['description']; ?></option>
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

							<!-- Year -->		
							<div class="container p-0 mb-3" id="select-course">
								<label for="3rd_year_2nd" class="form-label" >Year Level</label>
								<select name="year" class="custom-select text-center p-2" id="3rd_year_2nd" disabled>
									<option value="0">Select Year Level</option>
									<option value="1">1st </option>
									<option value="2">2nd</option>
									<option value="3">3rd</option>
									<option value="4">4th</option>
									<option value="5">5th</option>
								</select>			
							</div>	

                            <!-- Semester -->
                            <div class="container p-0 mb-3" id="select-prereq">
								<label for="3rd_sem_2nd" class="form-label" >Semester</label>
								<select name="semester" class="custom-select text-center p-2" id="3rd_sem_2nd" disabled>
									<option value="0">Select Semester</option>
									<option value="1st">1st Semester</option>
									<option value="2nd">2nd Semester</option>
                                    <option value="summer">Summer</option>
								</select>			
							</div>	

                            <div class="container p-0 mb-3" id="select-prereq">
                                <label for="3rd_schoolyear_2nd" class="form-label" >School Year</label>
                                <input type="text" name="sy" class="form-control text-center p-2" id="3rd_schoolyear_2nd">
                            </div>

                            <!-- Grade 		
							<div class="container p-0 mb-3" id="select-course">
								<label for="3rd_grade_2nd" class="form-label" >Grade</label>
								<select name="grade" class="custom-select text-center p-2" required id="3rd_grade_2nd">
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
							</div>	-->

                            <!-- Remarks 		
							<div class="container p-0 mb-3" id="select-course">
								<label for="3rd_remarks_2nd" class="form-label" >Remarks</label>
								<select name="remarks" class="custom-select text-center p-2" required id="3rd_remarks_2nd">
									<option selected>Select Year Level</option>
									<option value="PASSED">PASSED </option>
									<option value="FAILED">FAILED</option>
								</select>			
							</div>	-->
                    </div>	

                    <div class="modal-footer" align="right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="update_sub" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- MANAGE SUBJECTS 3rd 2nd sem END -->

    <!-- MANAGE SUBJECTS 3rd summer sem -->
    <div class="modal fade" id="edit3rdSubjectsummerModal" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="manage-subject" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="manage-curriculum">Manage Subject</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                    <div class="modal-body">
                <form action="managedata.php" method="POST">
                        <input type="hidden" name="idPreSub" id="3rd_subject_preid_summer">
                        <input type="hidden" name="subject_id" id="3rd_subject_id_summer">
                        <input type="hidden" name="studentid" value="<?php echo $Studid?>">
						<input type="hidden" name="currid" value="<?php echo $Currid?>">
						<input type="hidden" name="collegeid" value="<?php echo $collegeid?>">
						<input type="hidden" name="courseid" value="<?php echo $courseid?>">
                            <!-- Inputs -->
                            <div class="form-group">
                                <label for="3rd_subject_summer">Subjects</label>                 
                                <select name="subjectdes" class="form-control text-center" id="3rd_subject_summer" disabled>
                                    <?php
                                        $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$Currid' and course_id_fk='$courseid'");
                                        if(mysqli_num_rows($getsub) > 0)
                                        {
                                            foreach($getsub as $datas)
                                            {   
                                    ?>
                                        <option value="<?php echo $datas['description']; ?>"><?php echo $datas['description']; ?></option>
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

							<!-- Year -->		
							<div class="container p-0 mb-3" id="select-course">
								<label for="3rd_year_summer" class="form-label" >Year Level</label>
								<select name="year" class="custom-select text-center p-2" id="3rd_year_summer" disabled>
									<option value="0">Select Year Level</option>
									<option value="1">1st </option>
									<option value="2">2nd</option>
									<option value="3">3rd</option>
									<option value="4">4th</option>
									<option value="5">5th</option>
								</select>			
							</div>	

                            <!-- Semester -->
                            <div class="container p-0 mb-3" id="select-prereq">
								<label for="3rd_sem_summer" class="form-label" >Semester</label>
								<select name="semester" class="custom-select text-center p-2" id="3rd_sem_summer" disabled>
									<option value="0">Select Semester</option>
									<option value="1st">1st Semester</option>
									<option value="2nd">2nd Semester</option>
                                    <option value="summer">Summer</option>
								</select>			
							</div>	

                            <div class="container p-0 mb-3" id="select-prereq">
                                <label for="3rd_schoolyear_summer" class="form-label" >School Year</label>
                                <input type="text" name="sy" class="form-control text-center p-2" id="3rd_schoolyear_summer">
                            </div>

                            <!-- Grade 	
							<div class="container p-0 mb-3" id="select-course">
								<label for="3rd_grade_2nd" class="form-label" >Grade</label>
								<select name="grade" class="custom-select text-center p-2" required id="3rd_grade_2nd">
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
							</div>	-->	

                            <!-- Remarks 	
							<div class="container p-0 mb-3" id="select-course">
								<label for="3rd_remarks_2nd" class="form-label" >Remarks</label>
								<select name="remarks" class="custom-select text-center p-2" required id="3rd_remarks_2nd">
									<option selected>Select Year Level</option>
									<option value="PASSED">PASSED </option>
									<option value="FAILED">FAILED</option>
								</select>			
							</div>	-->	
                    </div>	

                    <div class="modal-footer" align="right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="update_sub" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- MANAGE SUBJECTS 3rd summer sem END -->

        <!-- DELETE Admin MODAL-->
        <div class="container container-fluid">
            <div class="modal fade" id="delete3rdSubject1stModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Subject</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="subid" id="deleteid_sub_id_3rd_1st">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Subject?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_sub_1st_1st" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
		</div>
        <!--END OF DELETE Admin MODAL-->

		<!-- DELETE Admin MODAL-->
        <div class="container container-fluid">
            <div class="modal fade" id="delete3rdSubject2ndModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Subject</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="subid" id="deleteid_sub_id_3rd_2nd">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Subject?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_sub_1st_1st" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
		</div>
        <!--END OF DELETE Admin MODAL-->
<!-- End Of Third Year List -->

<!-- Fourth Year List -->
    <!-- MANAGE SUBJECTS 4th 1st sem -->
    <div class="modal fade" id="edit4thSubject1stModal" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="manage-subject" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="manage-curriculum">Manage Subject</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                    <div class="modal-body">
                <form action="managedata.php" method="POST">
                        <input type="hidden" name="idPreSub" id="4th_subject_preid_1st">
                        <input type="hidden" name="subject_id" id="4th_subject_id_1st">
                        <input type="hidden" name="studentid" value="<?php echo $Studid?>">
						<input type="hidden" name="currid" value="<?php echo $Currid?>">
						<input type="hidden" name="collegeid" value="<?php echo $collegeid?>">
						<input type="hidden" name="courseid" value="<?php echo $courseid?>">
                            <!-- Inputs -->
                            <div class="form-group">
                                <label for="4th_subject_1st">Subjects</label>                 
                                <select name="subjectdes" class="form-control text-center" id="4th_subject_1st" disabled>
                                    <?php
                                        $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$Currid' and course_id_fk='$courseid'");
                                        if(mysqli_num_rows($getsub) > 0)
                                        {
                                            foreach($getsub as $datas)
                                            {   
                                    ?>
                                        <option value="<?php echo $datas['description']; ?>"><?php echo $datas['description']; ?></option>
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

							<!-- Year -->		
							<div class="container p-0 mb-3" id="select-course">
								<label for="4th_year_1st" class="form-label" >Year Level</label>
								<select name="year" class="custom-select text-center p-2" id="4th_year_1st" disabled>
									<option value="0">Select Year Level</option>
									<option value="1">1st </option>
									<option value="2">2nd</option>
									<option value="3">3rd</option>
									<option value="4">4th</option>
									<option value="5">5th</option>
								</select>			
							</div>	

                            <!-- Semester -->
                            <div class="container p-0 mb-3" id="select-prereq">
								<label for="4th_sem_1st" class="form-label" >Semester</label>
								<select name="semester" class="custom-select text-center p-2" id="4th_sem_1st" disabled>
									<option value="0">Select Semester</option>
									<option value="1st">1st Semester</option>
									<option value="2nd">2nd Semester</option>
                                    <option value="summer">Summer</option>
								</select>			
							</div>	

                            <div class="container p-0 mb-3" id="select-prereq">
                                <label for="4th_schoolyear_1st" class="form-label" >School Year</label>
                                <input type="text" name="sy" class="form-control text-center p-2" id="4th_schoolyear_1st">
                            </div>

                            <!-- Grade 		
							<div class="container p-0 mb-3" id="select-course">
								<label for="4th_grade_1st" class="form-label" >Grade</label>
								<select name="grade" class="custom-select text-center p-2" required id="4th_grade_1st">
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
							</div>	-->

                            <!-- Remarks 	
							<div class="container p-0 mb-3" id="select-course">
								<label for="4th_remarks_1st" class="form-label" >Remarks</label>
								<select name="remarks" class="custom-select text-center p-2" required id="4th_remarks_1st">
									<option selected>Select Year Level</option>
									<option value="PASSED">PASSED </option>
									<option value="FAILED">FAILED</option>
								</select>			
							</div>	-->	
                    </div>	

                    <div class="modal-footer" align="right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="update_sub" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- MANAGE SUBJECTS 4th 1st sem END -->

	<!-- MANAGE SUBJECTS 4th 2nd sem -->
    <div class="modal fade" id="edit4thSubject2ndModal" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="manage-subject" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="manage-curriculum">Manage Subject</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                    <div class="modal-body">
                <form action="managedata.php" method="POST">
                        <input type="hidden" name="idPreSub" id="4th_subject_preid_2nd">
                        <input type="hidden" name="subject_id" id="4th_subject_id_2nd">
                        <input type="hidden" name="studentid" value="<?php echo $Studid?>">
						<input type="hidden" name="currid" value="<?php echo $Currid?>">
						<input type="hidden" name="collegeid" value="<?php echo $collegeid?>">
						<input type="hidden" name="courseid" value="<?php echo $courseid?>">
                            <!-- Inputs -->
                            <div class="form-group">
                                <label for="4th_subject_2nd">Subjects</label>                 
                                <select name="subjectdes" class="form-control text-center" id="4th_subject_2nd" disabled>
                                    <?php
                                        $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$Currid' and course_id_fk='$courseid'");
                                        if(mysqli_num_rows($getsub) > 0)
                                        {
                                            foreach($getsub as $datas)
                                            {   
                                    ?>
                                        <option value="<?php echo $datas['description']; ?>"><?php echo $datas['description']; ?></option>
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

							<!-- Year -->		
							<div class="container p-0 mb-3" id="select-course">
								<label for="4th_year_2nd" class="form-label" >Year Level</label>
								<select name="year" class="custom-select text-center p-2" id="4th_year_2nd" disabled>
									<option value="0">Select Year Level</option>
									<option value="1">1st </option>
									<option value="2">2nd</option>
									<option value="3">3rd</option>
									<option value="4">4th</option>
									<option value="5">5th</option>
								</select>			
							</div>	

                            <!-- Semester -->
                            <div class="container p-0 mb-3" id="select-prereq">
								<label for="4th_sem_2nd" class="form-label" >Semester</label>
								<select name="semester" class="custom-select text-center p-2" id="4th_sem_2nd" disabled>
									<option value="0">Select Semester</option>
									<option value="1st">1st Semester</option>
									<option value="2nd">2nd Semester</option>
                                    <option value="summer">Summer</option>
								</select>			
							</div>	

                            <div class="container p-0 mb-3" id="select-prereq">
                                <label for="4th_schoolyear_2nd" class="form-label" >School Year</label>
                                <input type="text" name="sy" class="form-control text-center p-2" id="4th_schoolyear_2nd">
                            </div>

                            <!-- Grade 		
							<div class="container p-0 mb-3" id="select-course">
								<label for="4th_grade_2nd" class="form-label" >Grade</label>
								<select name="grade" class="custom-select text-center p-2" required id="4th_grade_2nd">
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
							</div>	-->	

                            <!-- Remarks 	
							<div class="container p-0 mb-3" id="select-course">
								<label for="4th_remarks_2nd" class="form-label" >Remarks</label>
								<select name="remarks" class="custom-select text-center p-2" required id="4th_remarks_2nd">
									<option selected>Select Year Level</option>
									<option value="PASSED">PASSED </option>
									<option value="FAILED">FAILED</option>
								</select>			
							</div>	-->	
                    </div>	

                    <div class="modal-footer" align="right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="update_sub" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- MANAGE SUBJECTS 4th 2nd sem END -->

    <!-- MANAGE SUBJECTS 4th summer sem -->
    <div class="modal fade" id="edit4thSubjectsummerModal" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="manage-subject" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="manage-curriculum">Manage Subject</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                    <div class="modal-body">
                <form action="managedata.php" method="POST">
                        <input type="hidden" name="idPreSub" id="4th_subject_preid_summer">
                        <input type="hidden" name="subject_id" id="4th_subject_id_summer">
                        <input type="hidden" name="studentid" value="<?php echo $Studid?>">
						<input type="hidden" name="currid" value="<?php echo $Currid?>">
						<input type="hidden" name="collegeid" value="<?php echo $collegeid?>">
						<input type="hidden" name="courseid" value="<?php echo $courseid?>">
                            <!-- Inputs -->
                            <div class="form-group">
                                <label for="4th_subject_summer">Subjects</label>                 
                                <select name="subjectdes" class="form-control text-center" id="4th_subject_summer" disabled>
                                    <?php
                                        $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$Currid' and course_id_fk='$courseid'");
                                        if(mysqli_num_rows($getsub) > 0)
                                        {
                                            foreach($getsub as $datas)
                                            {   
                                    ?>
                                        <option value="<?php echo $datas['description']; ?>"><?php echo $datas['description']; ?></option>
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

							<!-- Year -->		
							<div class="container p-0 mb-3" id="select-course">
								<label for="4th_year_summer" class="form-label" >Year Level</label>
								<select name="year" class="custom-select text-center p-2" id="4th_year_summer" disabled>
									<option value="0">Select Year Level</option>
									<option value="1">1st </option>
									<option value="2">2nd</option>
									<option value="3">3rd</option>
									<option value="4">4th</option>
									<option value="5">5th</option>
								</select>			
							</div>	

                            <!-- Semester -->
                            <div class="container p-0 mb-3" id="select-prereq">
								<label for="4th_sem_summer" class="form-label" >Semester</label>
								<select name="semester" class="custom-select text-center p-2" id="4th_sem_summer" disabled>
									<option value="0">Select Semester</option>
									<option value="1st">1st Semester</option>
									<option value="2nd">2nd Semester</option>
                                    <option value="summer">Summer</option>
								</select>			
							</div>	

                            <div class="container p-0 mb-3" id="select-prereq">
                                <label for="4th_schoolyear_summer" class="form-label" >School Year</label>
                                <input type="text" name="sy" class="form-control text-center p-2" id="4th_schoolyear_summer">
                            </div>

                            <!-- Grade 		
							<div class="container p-0 mb-3" id="select-course">
								<label for="4th_grade_2nd" class="form-label" >Grade</label>
								<select name="grade" class="custom-select text-center p-2" required id="4th_grade_2nd">
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
							</div>	-->

                            <!-- Remarks 		
							<div class="container p-0 mb-3" id="select-course">
								<label for="4th_remarks_2nd" class="form-label" >Remarks</label>
								<select name="remarks" class="custom-select text-center p-2" required id="4th_remarks_2nd">
									<option selected>Select Year Level</option>
									<option value="PASSED">PASSED </option>
									<option value="FAILED">FAILED</option>
								</select>			
							</div>	-->
                    </div>	

                    <div class="modal-footer" align="right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="update_sub" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- MANAGE SUBJECTS 4th summer sem END -->

        <!-- DELETE Admin MODAL-->
        <div class="container container-fluid">
            <div class="modal fade" id="delete4thSubject1stModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Subject</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="subid" id="deleteid_sub_id_4th_1st">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Subject?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_sub_1st_1st" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
		</div>
        <!--END OF DELETE Subject MODAL-->

		<!-- DELETE Admin MODAL-->
        <div class="container container-fluid">
            <div class="modal fade" id="delete4thSubject2ndModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Subject</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="subid" id="deleteid_sub_id_4th_2nd">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Subject?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_sub_1st_1st" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
		</div>
        <!--END OF DELETE Subject MODAL-->
<!-- End Of Fourth Year List -->

<!-- Fifth Year List -->
    <!-- MANAGE SUBJECTS 5th 1st sem -->
    <div class="modal fade" id="edit5thSubject1stModal" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="manage-subject" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="manage-curriculum">Manage Subject</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                    <div class="modal-body">
                <form action="managedata.php" method="POST">
                        <input type="hidden" name="idPreSub" id="5th_subject_preid_1st">
                        <input type="hidden" name="subject_id" id="5th_subject_id_1st">
                        <input type="hidden" name="studentid" value="<?php echo $Studid?>">
						<input type="hidden" name="currid" value="<?php echo $Currid?>">
						<input type="hidden" name="collegeid" value="<?php echo $collegeid?>">
						<input type="hidden" name="courseid" value="<?php echo $courseid?>">
                            <!-- Inputs -->
                            <div class="form-group">
                                <label for="5th_subject_1st">Subjects</label>                 
                                <select name="subjectdes" class="form-control text-center" id="5th_subject_1st" disabled>
                                    <?php
                                        $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$Currid' and course_id_fk='$courseid'");
                                        if(mysqli_num_rows($getsub) > 0)
                                        {
                                            foreach($getsub as $datas)
                                            {   
                                    ?>
                                        <option value="<?php echo $datas['description']; ?>"><?php echo $datas['description']; ?></option>
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

							<!-- Year -->		
							<div class="container p-0 mb-3" id="select-course">
								<label for="5th_year_1st" class="form-label" >Year Level</label>
								<select name="year" class="custom-select text-center p-2" id="5th_year_1st" disabled>
									<option value="0">Select Year Level</option>
									<option value="1">1st </option>
									<option value="2">2nd</option>
									<option value="3">3rd</option>
									<option value="4">4th</option>
									<option value="5">5th</option>
								</select>			
							</div>	

                            <!-- Semester -->
                            <div class="container p-0 mb-3" id="select-prereq">
								<label for="5th_sem_1st" class="form-label" >Semester</label>
								<select name="semester" class="custom-select text-center p-2" id="5th_sem_1st" disabled>
									<option value="0">Select Semester</option>
									<option value="1st">1st Semester</option>
									<option value="2nd">2nd Semester</option>
                                    <option value="summer">Summer</option>
								</select>			
							</div>	

                            <div class="container p-0 mb-3" id="select-prereq">
                                <label for="5th_schoolyear_1st" class="form-label" >School Year</label>
                                <input type="text" name="sy" class="form-control text-center p-2" id="5th_schoolyear_1st">
                            </div>

                            <!-- Grade 	
							<div class="container p-0 mb-3" id="select-course">
								<label for="5th_grade_1st" class="form-label" >Grade</label>
								<select name="grade" class="custom-select text-center p-2" required id="5th_grade_1st">
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
							</div>	-->

                            <!-- Remarks 		
							<div class="container p-0 mb-3" id="select-course">
								<label for="5th_remarks_1st" class="form-label" >Remarks</label>
								<select name="remarks" class="custom-select text-center p-2" required id="5th_remarks_1st">
									<option selected>Select Year Level</option>
									<option value="PASSED">PASSED </option>
									<option value="FAILED">FAILED</option>
								</select>			
							</div>-->
                    </div>	

                    <div class="modal-footer" align="right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="update_sub" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- MANAGE SUBJECTS 5th 1st sem END -->

	<!-- MANAGE SUBJECTS 5th 2nd sem -->
    <div class="modal fade" id="edit5thSubject2ndModal" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="manage-subject" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="manage-curriculum">Manage Subject</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                    <div class="modal-body">
                <form action="managedata.php" method="POST">
                        <input type="hidden" name="idPreSub" id="5th_subject_preid_2nd">
                        <input type="hidden" name="subject_id" id="5th_subject_id_2nd">
                        <input type="hidden" name="studentid" value="<?php echo $Studid?>">
						<input type="hidden" name="currid" value="<?php echo $Currid?>">
						<input type="hidden" name="collegeid" value="<?php echo $collegeid?>">
						<input type="hidden" name="courseid" value="<?php echo $courseid?>">
                            <!-- Inputs -->
                            <div class="form-group">
                                <label for="5th_subject_2nd">Subjects</label>                 
                                <select name="subjectdes" class="form-control text-center" id="5th_subject_2nd" disabled>
                                    <?php
                                        $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$Currid' and course_id_fk='$courseid'");
                                        if(mysqli_num_rows($getsub) > 0)
                                        {
                                            foreach($getsub as $datas)
                                            {   
                                    ?>
                                        <option value="<?php echo $datas['description']; ?>"><?php echo $datas['description']; ?></option>
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

							<!-- Year -->		
							<div class="container p-0 mb-3" id="select-course">
								<label for="5th_year_2nd" class="form-label" >Year Level</label>
								<select name="year" class="custom-select text-center p-2" id="5th_year_2nd" disabled>
									<option value="0">Select Year Level</option>
									<option value="1">1st </option>
									<option value="2">2nd</option>
									<option value="3">3rd</option>
									<option value="4">4th</option>
									<option value="5">5th</option>
								</select>			
							</div>	

                            <!-- Semester -->
                            <div class="container p-0 mb-3" id="select-prereq">
								<label for="5th_sem_2nd" class="form-label" >Semester</label>
								<select name="semester" class="custom-select text-center p-2" id="5th_sem_2nd" disabled>
									<option value="0">Select Semester</option>
									<option value="1st">1st Semester</option>
									<option value="2nd">2nd Semester</option>
                                    <option value="summer">Summer</option>
								</select>			
							</div>	

                            <div class="container p-0 mb-3" id="select-prereq">
                                <label for="5th_schoolyear_2nd" class="form-label" >School Year</label>
                                <input type="text" name="sy" class="form-control text-center p-2" id="5th_schoolyear_2nd">
                            </div>

                            <!-- Grade 		
							<div class="container p-0 mb-3" id="select-course">
								<label for="5th_grade_2nd" class="form-label" >Grade</label>
								<select name="grade" class="custom-select text-center p-2" required id="5th_grade_2nd">
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
							</div>	-->

                            <!-- Remarks 	
							<div class="container p-0 mb-3" id="select-course">
								<label for="5th_remarks_2nd" class="form-label" >Remarks</label>
								<select name="remarks" class="custom-select text-center p-2" required id="5th_remarks_2nd">
									<option selected>Select Year Level</option>
									<option value="PASSED">PASSED </option>
									<option value="FAILED">FAILED</option>
								</select>			
							</div>-->
                    </div>	

                    <div class="modal-footer" align="right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="update_sub" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- MANAGE SUBJECTS 5th 2nd sem END -->

    <!-- MANAGE SUBJECTS 5th summer sem -->
    <div class="modal fade" id="edit5thSubjectsummerModal" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="manage-subject" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="manage-curriculum">Manage Subject</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                    <div class="modal-body">
                <form action="managedata.php" method="POST">
                        <input type="hidden" name="idPreSub" id="5th_subject_preid_summer">
                        <input type="hidden" name="subject_id" id="5th_subject_id_summer">
                        <input type="hidden" name="studentid" value="<?php echo $Studid?>">
						<input type="hidden" name="currid" value="<?php echo $Currid?>">
						<input type="hidden" name="collegeid" value="<?php echo $collegeid?>">
						<input type="hidden" name="courseid" value="<?php echo $courseid?>">
                            <!-- Inputs -->
                            <div class="form-group">
                                <label for="5th_subject_summer">Subjects</label>                 
                                <select name="subjectdes" class="form-control text-center" id="5th_subject_summer" disabled>
                                    <?php
                                        $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$Currid' and course_id_fk='$courseid'");
                                        if(mysqli_num_rows($getsub) > 0)
                                        {
                                            foreach($getsub as $datas)
                                            {   
                                    ?>
                                        <option value="<?php echo $datas['description']; ?>"><?php echo $datas['description']; ?></option>
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

							<!-- Year -->		
							<div class="container p-0 mb-3" id="select-course">
								<label for="5th_year_summer" class="form-label" >Year Level</label>
								<select name="year" class="custom-select text-center p-2" id="5th_year_summer" disabled>
									<option value="0">Select Year Level</option>
									<option value="1">1st </option>
									<option value="2">2nd</option>
									<option value="3">3rd</option>
									<option value="4">4th</option>
									<option value="5">5th</option>
								</select>			
							</div>	

                            <!-- Semester -->
                            <div class="container p-0 mb-3" id="select-prereq">
								<label for="5th_sem_summer" class="form-label" >Semester</label>
								<select name="semester" class="custom-select text-center p-2" id="5th_sem_summer" disabled>
									<option value="0">Select Semester</option>
									<option value="1st">1st Semester</option>
									<option value="2nd">2nd Semester</option>
                                    <option value="summer">Summer</option>
								</select>			
							</div>	

                            <div class="container p-0 mb-3" id="select-prereq">
                                <label for="5th_schoolyear_summer" class="form-label" >School Year</label>
                                <input type="text" name="sy" class="form-control text-center p-2" id="5th_schoolyear_summer">
                            </div>

                            <!-- Grade 	
							<div class="container p-0 mb-3" id="select-course">
								<label for="5th_grade_2nd" class="form-label" >Grade</label>
								<select name="grade" class="custom-select text-center p-2" required id="5th_grade_2nd">
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
							</div>	-->	

                            <!-- Remarks 		
							<div class="container p-0 mb-3" id="select-course">
								<label for="5th_remarks_2nd" class="form-label" >Remarks</label>
								<select name="remarks" class="custom-select text-center p-2" required id="5th_remarks_2nd">
									<option selected>Select Year Level</option>
									<option value="PASSED">PASSED </option>
									<option value="FAILED">FAILED</option>
								</select>			
							</div>-->
                    </div>	

                    <div class="modal-footer" align="right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="update_sub" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- MANAGE SUBJECTS 5th summer sem END -->

        <!-- DELETE Admin MODAL-->
        <div class="container container-fluid">
            <div class="modal fade" id="delete5thSubject1stModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Subject</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="subid" id="deleteid_sub_id_5th_1st">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Subject?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_sub_1st_1st" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
		</div>
        <!--END OF DELETE Subject MODAL-->

		<!-- DELETE Admin MODAL-->
        <div class="container container-fluid">
            <div class="modal fade" id="delete5thSubject2ndModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Subject</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="subid" id="deleteid_sub_id_5th_2nd">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Subject?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_sub_1st_1st" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
		</div>
        <!--END OF DELETE Subject MODAL-->
<!-- End Of Fifth Year List -->

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

    <!-- Select 2 JQuery script -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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
        
        $('#table_add_sub').on('change', ':checkbox', function() {
			$('#button').toggle(!!$('input:checkbox:checked').length);
		});

        $(".multiple-1").select2({
            //maximumSelectionLength: 2
        });

        $('#table-send').DataTable();

        $(document).ready(function() {
            $('#table_add_sub').DataTable( {
                "paging":   false,
                "ordering": false,
                "info":     false
            } );
        } );

        $(document).ready(function() {
            $('#table_grade_input').DataTable( {
                "paging":   false,
                "ordering": false,
                "info":     false
            } );
        } );

        $(document).ready(function() {
            $('body').on('click','.editSendSubject',function() {
                $('#editSendSubjectModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#').val(data[0]);
            });
        });

        $(document).ready(function() {
            $('body').on('click','.deleteSendSubject',function() {
                $('#deleteSendSubjectModal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#stud_send_subjectid').val(data[0]);
            });
        }); 

		$('#table1year1st').DataTable();
		$('#table1year2nd').DataTable();

		$('#table2year1st').DataTable();
		$('#table2year2nd').DataTable();

		$('#table3year1st').DataTable();
		$('#table3year2nd').DataTable();

		$('#table4year1st').DataTable();
		$('#table4year2nd').DataTable();

		$('#table5year1st').DataTable();
		$('#table5year2nd').DataTable();
	</script>

	<script>
		function firsttable(){
            document.getElementById('firstYear').style.display='block'; 
            document.getElementById('secondYear').style.display='none'; 
            document.getElementById('thirdYear').style.display='none'; 
            document.getElementById('fourthYear').style.display='none'; 
            document.getElementById('fifthYear').style.display='none';

            document.getElementById('tab1').style.color = 'white'; 
            document.getElementById('tab2').style.color = 'red'; 
            document.getElementById('tab3').style.color = 'red'; 
            document.getElementById('tab4').style.color = 'red';
            document.getElementById('tab5').style.color = 'red'; 

            document.getElementById('tab1').style.backgroundColor = 'red'; 
            document.getElementById('tab2').style.backgroundColor = 'white'; 
            document.getElementById('tab3').style.backgroundColor = 'white'; 
            document.getElementById('tab4').style.backgroundColor = 'white';
            document.getElementById('tab5').style.backgroundColor = 'white';

            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })

            $(function () {
                $(".check_1st_sem_1st").click(function () {
                    if ($(this).is(":checked")) {
                        $(".hide_1st_grade_1st").show();
                        $(".show_1st_grade_1st").hide();
                    } else {
                        $(".hide_1st_grade_1st").hide();
                        $(".show_1st_grade_1st").show();
                    }
                });
            });

            $(function () {
                $("#chckAll1stsem1st").click(function () {
                    if ($(this).is(":checked")) {
                        $(".hide_1st_grade_1st").show();
                        $(".show_1st_grade_1st").hide();
                    } else {
                        $(".hide_1st_grade_1st").hide();
                        $(".show_1st_grade_1st").show();chckAll1stsem1st
                    }
                });
            });

            $(function () {
                $(".check_1st_sem_2nd").click(function () {
                    if ($(this).is(":checked")) {
                        $(".hide_1st_grade_2nd").show();
                        $(".show_1st_grade_2nd").hide();
                    } else {
                        $(".hide_1st_grade_2nd").hide();
                        $(".show_1st_grade_2nd").show();
                    }
                });
            });

            $(function () {
                $("#chckAll1stsem2nd").click(function () {
                    if ($(this).is(":checked")) {
                        $(".hide_1st_grade_2nd").show();
                        $(".show_1st_grade_2nd").hide();
                    } else {
                        $(".hide_1st_grade_2nd").hide();
                        $(".show_1st_grade_2nd").show();chckAll1stsem1st
                    }
                });
            });

            $(function () {
                $(".check_1st_sem_summer").click(function () {
                    if ($(this).is(":checked")) {
                        $(".hide_1st_grade_summer").show();
                        $(".show_1st_grade_summer").hide();
                    } else {
                        $(".hide_1st_grade_summer").hide();
                        $(".show_1st_grade_summer").show();
                    }
                });
            });

            $(function () {
                $("#chckAll1stsemsummer").click(function () {
                    if ($(this).is(":checked")) {
                        $(".hide_1st_grade_summer").show();
                        $(".show_1st_grade_summer").hide();
                    } else {
                        $(".hide_1st_grade_summer").hide();
                        $(".show_1st_grade_summer").show();chckAll1stsem1st
                    }
                });
            });

            $(document).ready(function() {
                var $selectAll1stsem1st = $('#chckAll1stsem1st'); // main checkbox inside table thead
                var $table1stsem1st = $('#table11stsem'); // table selector 
                var $tdCheckbox1stsem1st = $table1stsem1st.find('tbody input:checkbox'); // checboxes inside table body
                var tdCheckboxChecked1stsem1st = 0; // checked checboxes

                // Select or deselect all checkboxes depending on main checkbox change
                $selectAll1stsem1st.on('click', function () {
                    $tdCheckbox1stsem1st.prop('checked', this.checked);
                });

                // Toggle main checkbox state to checked when all checkboxes inside tbody tag is checked
                $tdCheckbox1stsem1st.on('change', function(e){
                    tdCheckboxChecked1stsem1st = $table1stsem1st.find('tbody input:checkbox:checked').length; // Get count of checkboxes that is checked
                    // if all checkboxes are checked, then set property of main checkbox to "true", else set to "false"
                    $selectAll1stsem1st.prop('checked', (tdCheckboxChecked1stsem1st === $tdCheckbox1stsem1st.length));
                })
            });

            $(document).ready(function() {
                var $selectAll1stsem2nd = $('#chckAll1stsem2nd'); // main checkbox inside table thead
                var $table1stsem2nd = $('#table12ndsem'); // table selector 
                var $tdCheckbox1stsem2nd= $table1stsem2nd.find('tbody input:checkbox'); // checboxes inside table body
                var tdCheckboxChecked1stsem2nd = 0; // checked checboxes

                // Select or deselect all checkboxes depending on main checkbox change
                $selectAll1stsem2nd.on('click', function () {
                    $tdCheckbox1stsem2nd.prop('checked', this.checked);
                });

                // Toggle main checkbox state to checked when all checkboxes inside tbody tag is checked
                $tdCheckbox1stsem2nd.on('change', function(e){
                    tdCheckboxChecked1stsem2nd = $table1stsem2nd.find('tbody input:checkbox:checked').length; // Get count of checkboxes that is checked
                    // if all checkboxes are checked, then set property of main checkbox to "true", else set to "false"
                    $selectAll1stsem2nd.prop('checked', (tdCheckboxChecked1stsem2nd === $tdCheckbox1stsem2nd.length));
                })
            });

            $(document).ready(function() {
                var $selectAll1stsemsummer = $('#chckAll1stsemsummer'); // main checkbox inside table thead
                var $table1stsemsummer = $('#table1summersem'); // table selector 
                var $tdCheckbox1stsemsummer = $table1stsemsummer.find('tbody input:checkbox'); // checboxes inside table body
                var tdCheckboxChecked1stsemsummer = 0; // checked checboxes

                // Select or deselect all checkboxes depending on main checkbox change
                $selectAll1stsemsummer.on('click', function () {
                    $tdCheckbox1stsemsummer.prop('checked', this.checked);
                });

                // Toggle main checkbox state to checked when all checkboxes inside tbody tag is checked
                $tdCheckbox1stsemsummer.on('change', function(e){
                    tdCheckboxChecked1stsemsummer = $table1stsemsummer.find('tbody input:checkbox:checked').length; // Get count of checkboxes that is checked
                    // if all checkboxes are checked, then set property of main checkbox to "true", else set to "false"
                    $selectAll1stsemsummer.prop('checked', (tdCheckboxChecked1stsemsummer === $tdCheckbox1stsemsummer.length));
                })
            });

            $('#table11stsem').on('change', ':checkbox', function() {
                $('#button_update').toggle(!!$('input:checkbox:checked').length);
            });

            $('#table12ndsem').on('change', ':checkbox', function() {
                $('#button_update_1st_2nd').toggle(!!$('input:checkbox:checked').length);
            });

            $('#table1summersem').on('change', ':checkbox', function() {
                $('#button_update_1st_summer').toggle(!!$('input:checkbox:checked').length);
            });

            if ( $.fn.dataTable.isDataTable( '#table11stsem' ) ) {
                table = $('#table11stsem').DataTable();
            }
            else {
                table = $('#table11stsem').DataTable( {
                    paging: false,
                    ordering: false,
                    info: false
                } );
            }

            if ( $.fn.dataTable.isDataTable( '#table12ndsem' ) ) {
                table = $('#table12ndsem').DataTable();
            }
            else {
                table = $('#table12ndsem').DataTable( {
                    paging: false,
                    ordering: false,
                    info: false
                } );
            }

            if ( $.fn.dataTable.isDataTable( '#table1summersem' ) ) {
                table = $('#table1summersem').DataTable();
            }
            else {
                table = $('#table1summersem').DataTable( {
                    paging: false,
                    ordering: false,
                    info: false
                } );
            }

            $(document).ready(function() {
            $('body').on('click','.edit1stSubject1stbtn',function() {
                $('#edit1stSubject1stModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#none1').val(data[0]);
                $('#1st_subject_preid_1st').val(data[1]);
                $('#none2').val(data[2]);
                $('#1st_subject_1st').val(data[3]);
                $('#none3').val(data[4]);
                $('#none4').val(data[5]);
                $('#none5').val(data[6]);
                $('#none6').val(data[7]);
                $('#1st_grade_1st').val(data[8]);
                $('#1st_remarks_1st').val(data[9]);
                $('#1st_year_1st').val(data[10]);
                $('#1st_sem_1st').val(data[11]);
                $('#1st_subject_id_1st').val(data[12]);
                $('#none7').val(data[13]);
                $('#1st_schoolyear_1st').val(data[14]);
            });
            });

			$(document).ready(function() {
            $('body').on('click','.edit1stSubject2ndbtn',function() {
                $('#edit1stSubject2ndModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#none1').val(data[0]);
                $('#1st_subject_preid_2nd').val(data[1]);
                $('#none2').val(data[2]);
                $('#1st_subject_2nd').val(data[3]);
                $('#none3').val(data[4]);
                $('#none4').val(data[5]);
                $('#none5').val(data[6]);
                $('#none6').val(data[7]);
                $('#1st_grade_2nd').val(data[8]);
                $('#1st_remarks_2nd').val(data[9]);
                $('#1st_year_2nd').val(data[10]);
                $('#1st_sem_2nd').val(data[11]);
                $('#1st_subject_id_2nd').val(data[12]);
                $('#none7').val(data[13]);
                $('#1st_schoolyear_2nd').val(data[14]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.edit1stSubjectsummerbtn',function() {
                $('#edit1stSubjectsummerModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#none1').val(data[0]);
                $('#1st_subject_preid_summer').val(data[1]);
                $('#none2').val(data[2]);
                $('#1st_subject_summer').val(data[3]);
                $('#none3').val(data[4]);
                $('#none4').val(data[5]);
                $('#none5').val(data[6]);
                $('#none6').val(data[7]);
                $('#1st_grade_summer').val(data[8]);
                $('#1st_remarks_summer').val(data[9]);
                $('#1st_year_summer').val(data[10]);
                $('#1st_sem_summer').val(data[11]);
                $('#1st_subject_id_summer').val(data[12]);
                $('#none7').val(data[13]);
                $('#1st_schoolyear_summer').val(data[14]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.delete1stSubject1stbtn',function() {
                $('#delete1stSubject1stModal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#delete_sub_id_1st_1st').val(data[0]);
            });
            });

			$(document).ready(function() {
            $('body').on('click','.delete1stSubject2ndbtn',function() {
                $('#delete1stSubject2ndModal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#delete_sub_id_1st_2nd').val(data[0]);
            });
            });
        }

        function secondtable(){
            document.getElementById('firstYear').style.display='none'; 
            document.getElementById('secondYear').style.display='block'; 
            document.getElementById('thirdYear').style.display='none'; 
            document.getElementById('fourthYear').style.display='none'; 
            document.getElementById('fifthYear').style.display='none'; 

            document.getElementById('tab1').style.color = 'red'; 
            document.getElementById('tab2').style.color = 'white'; 
            document.getElementById('tab3').style.color = 'red'; 
            document.getElementById('tab4').style.color = 'red'; 
            document.getElementById('tab5').style.color = 'red'; 

            document.getElementById('tab1').style.backgroundColor = 'white'; 
            document.getElementById('tab2').style.backgroundColor = 'red'; 
            document.getElementById('tab3').style.backgroundColor = 'white'; 
            document.getElementById('tab4').style.backgroundColor = 'white'; 
            document.getElementById('tab5').style.backgroundColor = 'white'; 

            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })

            $(function () {
                $(".check_2nd_sem_1st").click(function () {
                    if ($(this).is(":checked")) {
                        $(".hide_2nd_grade_1st").show();
                        $(".show_2nd_grade_1st").hide();
                    } else {
                        $(".hide_2nd_grade_1st").hide();
                        $(".show_2nd_grade_1st").show();
                    }
                });
            });

            $(function () {
                $("#chckAll2ndsem1st").click(function () {
                    if ($(this).is(":checked")) {
                        $(".hide_2nd_grade_1st").show();
                        $(".show_2nd_grade_1st").hide();
                    } else {
                        $(".hide_2nd_grade_1st").hide();
                        $(".show_2nd_grade_1st").show();chckAll1stsem1st
                    }
                });
            });

            $(function () {
                $(".check_2nd_sem_2nd").click(function () {
                    if ($(this).is(":checked")) {
                        $(".hide_2nd_grade_2nd").show();
                        $(".show_2nd_grade_2nd").hide();
                    } else {
                        $(".hide_2nd_grade_2nd").hide();
                        $(".show_2nd_grade_2nd").show();
                    }
                });
            });

            $(function () {
                $("#chckAll2ndsem2nd").click(function () {
                    if ($(this).is(":checked")) {
                        $(".hide_2nd_grade_2nd").show();
                        $(".show_2nd_grade_2nd").hide();
                    } else {
                        $(".hide_2nd_grade_2nd").hide();
                        $(".show_2nd_grade_2nd").show();chckAll1stsem1st
                    }
                });
            });

            $(function () {
                $(".check_2nd_sem_summer").click(function () {
                    if ($(this).is(":checked")) {
                        $(".hide_2nd_grade_summer").show();
                        $(".show_2nd_grade_summer").hide();
                    } else {
                        $(".hide_2nd_grade_summer").hide();
                        $(".show_2nd_grade_summer").show();
                    }
                });
            });

            $(function () {
                $("#chckAll2ndsemsummer").click(function () {
                    if ($(this).is(":checked")) {
                        $(".hide_2nd_grade_summer").show();
                        $(".show_2nd_grade_summer").hide();
                    } else {
                        $(".hide_2nd_grade_summer").hide();
                        $(".show_2nd_grade_summer").show();chckAll1stsem1st
                    }
                });
            });

            $(document).ready(function() {
                var $selectAll2ndsem1st = $('#chckAll2ndsem1st'); // main checkbox inside table thead
                var $table2ndsem1st = $('#table21stsem'); // table selector 
                var $tdCheckbox2ndsem1st = $table2ndsem1st.find('tbody input:checkbox'); // checboxes inside table body
                var tdCheckboxChecked2ndsem1st = 0; // checked checboxes

                // Select or deselect all checkboxes depending on main checkbox change
                $selectAll2ndsem1st.on('click', function () {
                    $tdCheckbox2ndsem1st.prop('checked', this.checked);
                });

                // Toggle main checkbox state to checked when all checkboxes inside tbody tag is checked
                $tdCheckbox2ndsem1st.on('change', function(e){
                    tdCheckboxChecked2ndsem1st = $table2ndsem1st.find('tbody input:checkbox:checked').length; // Get count of checkboxes that is checked
                    // if all checkboxes are checked, then set property of main checkbox to "true", else set to "false"
                    $selectAll2ndsem1st.prop('checked', (tdCheckboxChecked2ndsem1st === $tdCheckbox2ndsem1st.length));
                })
            });

            $(document).ready(function() {
                var $selectAll2ndsem2nd = $('#chckAll2ndsem2nd'); // main checkbox inside table thead
                var $table2ndsem2nd = $('#table22ndsem'); // table selector 
                var $tdCheckbox2ndsem2nd= $table2ndsem2nd.find('tbody input:checkbox'); // checboxes inside table body
                var tdCheckboxChecked2ndsem2nd = 0; // checked checboxes

                // Select or deselect all checkboxes depending on main checkbox change
                $selectAll2ndsem2nd.on('click', function () {
                    $tdCheckbox2ndsem2nd.prop('checked', this.checked);
                });

                // Toggle main checkbox state to checked when all checkboxes inside tbody tag is checked
                $tdCheckbox2ndsem2nd.on('change', function(e){
                    tdCheckboxChecked2ndsem2nd = $table2ndsem2nd.find('tbody input:checkbox:checked').length; // Get count of checkboxes that is checked
                    // if all checkboxes are checked, then set property of main checkbox to "true", else set to "false"
                    $selectAll2ndsem2nd.prop('checked', (tdCheckboxChecked2ndsem2nd === $tdCheckbox2ndsem2nd.length));
                })
            });

            $(document).ready(function() {
                var $selectAll2ndsemsummer = $('#chckAll2ndsemsummer'); // main checkbox inside table thead
                var $table2ndsemsummer = $('#table2summersem'); // table selector 
                var $tdCheckbox2ndsemsummer = $table2ndsemsummer.find('tbody input:checkbox'); // checboxes inside table body
                var tdCheckboxChecked2ndsemsummer = 0; // checked checboxes

                // Select or deselect all checkboxes depending on main checkbox change
                $selectAll2ndsemsummer.on('click', function () {
                    $tdCheckbox2ndsemsummer.prop('checked', this.checked);
                });

                // Toggle main checkbox state to checked when all checkboxes inside tbody tag is checked
                $tdCheckbox2ndsemsummer.on('change', function(e){
                    tdCheckboxChecked2ndsemsummer = $table2ndsemsummer.find('tbody input:checkbox:checked').length; // Get count of checkboxes that is checked
                    // if all checkboxes are checked, then set property of main checkbox to "true", else set to "false"
                    $selectAll2ndsemsummer.prop('checked', (tdCheckboxChecked2ndsemsummer === $tdCheckbox2ndsemsummer.length));
                })
            });

            $('#table21stsem').on('change', ':checkbox', function() {
                $('#button_update_2nd_1st').toggle(!!$('input:checkbox:checked').length);
            });

            $('#table22ndsem').on('change', ':checkbox', function() {
                $('#button_update_2nd_2nd').toggle(!!$('input:checkbox:checked').length);
            });

            $('#table2summersem').on('change', ':checkbox', function() {
                $('#button_update_2nd_summer').toggle(!!$('input:checkbox:checked').length);
            });

            if ( $.fn.dataTable.isDataTable( '#table21stsem' ) ) {
                table = $('#table21stsem').DataTable();
            }
            else {
                table = $('#table21stsem').DataTable( {
                    paging: false,
                    ordering: false,
                    info: false
                } );
            }

            if ( $.fn.dataTable.isDataTable( '#table22ndsem' ) ) {
                table = $('#table22ndsem').DataTable();
            }
            else {
                table = $('#table22ndsem').DataTable( {
                    paging: false,
                    ordering: false,
                    info: false
                } );
            }

            if ( $.fn.dataTable.isDataTable( '#table2summersem' ) ) {
                table = $('#table2summersem').DataTable();
            }
            else {
                table = $('#table2summersem').DataTable( {
                    paging: false,
                    ordering: false,
                    info: false
                } );
            }

            $(document).ready(function() {
            $('body').on('click','.edit2ndSubject1stbtn',function() {
                $('#edit2ndSubject1stModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#none1').val(data[0]);
                $('#2nd_subject_preid_1st').val(data[1]);
                $('#none2').val(data[2]);
                $('#2nd_subject_1st').val(data[3]);
                $('#none3').val(data[4]);
                $('#none4').val(data[5]);
                $('#none5').val(data[6]);
                $('#none6').val(data[7]);
                $('#2nd_grade_1st').val(data[8]);
                $('#2nd_remarks_1st').val(data[9]);
                $('#2nd_year_1st').val(data[10]);
                $('#2nd_sem_1st').val(data[11]);
                $('#2nd_subject_id_1st').val(data[12]);
                $('#none7').val(data[13]);
                $('#2nd_schoolyear_1st').val(data[14]);
                
            });
            });

			$(document).ready(function() {
            $('body').on('click','.edit2ndSubject2ndbtn',function() {
                $('#edit2ndSubject2ndModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#none1').val(data[0]);
                $('#2nd_subject_preid_2nd').val(data[1]);
                $('#none2').val(data[2]);
                $('#2nd_subject_2nd').val(data[3]);
                $('#none3').val(data[4]);
                $('#none4').val(data[5]);
                $('#none5').val(data[6]);
                $('#none6').val(data[7]);
                $('#2nd_grade_2nd').val(data[8]);
                $('#2nd_remarks_2nd').val(data[9]);
                $('#2nd_year_2nd').val(data[10]);
                $('#2nd_sem_2nd').val(data[11]);
                $('#2nd_subject_id_2nd').val(data[12]);
                $('#none7').val(data[13]);
                $('#2nd_schoolyear_2nd').val(data[14]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.edit2ndSubjectsummerbtn',function() {
                $('#edit2ndSubjectsummerModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#none1').val(data[0]);
                $('#2nd_subject_preid_summer').val(data[1]);
                $('#none2').val(data[2]);
                $('#2nd_subject_summer').val(data[3]);
                $('#none3').val(data[4]);
                $('#none4').val(data[5]);
                $('#none5').val(data[6]);
                $('#none6').val(data[7]);
                $('#2nd_grade_summer').val(data[8]);
                $('#2nd_remarks_summer').val(data[9]);
                $('#2nd_year_summer').val(data[10]);
                $('#2nd_sem_summer').val(data[11]);
                $('#2nd_subject_id_summer').val(data[12]);
                $('#none7').val(data[13]);
                $('#2nd_schoolyear_summer').val(data[14]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.delete2ndSubject1stbtn',function() {
                $('#delete2ndSubject1stModal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#deleteid_sub_id_2nd_1st').val(data[0]);
            });
            });

			$(document).ready(function() {
            $('body').on('click','.delete2ndSubject2ndbtn',function() {
                $('#delete2ndSubject2ndModal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#deleteid_sub_id_2nd_2nd').val(data[0]);
            });
            });
        }

        function thirdtable(){
            document.getElementById('firstYear').style.display='none'; 
            document.getElementById('secondYear').style.display='none'; 
            document.getElementById('thirdYear').style.display='block'; 
            document.getElementById('fourthYear').style.display='none'; 
            document.getElementById('fifthYear').style.display='none'; 

            document.getElementById('tab1').style.color = 'red'; 
            document.getElementById('tab2').style.color = 'red'; 
            document.getElementById('tab3').style.color = 'white'; 
            document.getElementById('tab4').style.color = 'red'; 
            document.getElementById('tab5').style.color = 'red'; 

            document.getElementById('tab1').style.backgroundColor = 'white'; 
            document.getElementById('tab2').style.backgroundColor = 'white'; 
            document.getElementById('tab3').style.backgroundColor = 'red'; 
            document.getElementById('tab4').style.backgroundColor = 'white'; 
            document.getElementById('tab5').style.backgroundColor = 'white';

            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })

            $(function () {
                $(".check_3rd_sem_1st").click(function () {
                    if ($(this).is(":checked")) {
                        $(".hide_3rd_grade_1st").show();
                        $(".show_3rd_grade_1st").hide();
                    } else {
                        $(".hide_3rd_grade_1st").hide();
                        $(".show_3rd_grade_1st").show();
                    }
                });
            });

            $(function () {
                $("#chckAll3rdsem1st").click(function () {
                    if ($(this).is(":checked")) {
                        $(".hide_3rd_grade_1st").show();
                        $(".show_3rd_grade_1st").hide();
                    } else {
                        $(".hide_3rd_grade_1st").hide();
                        $(".show_3rd_grade_1st").show();chckAll1stsem1st
                    }
                });
            });

            $(function () {
                $(".check_3rd_sem_2nd").click(function () {
                    if ($(this).is(":checked")) {
                        $(".hide_3rd_grade_2nd").show();
                        $(".show_3rd_grade_2nd").hide();
                    } else {
                        $(".hide_3rd_grade_2nd").hide();
                        $(".show_3rd_grade_2nd").show();
                    }
                });
            });

            $(function () {
                $("#chckAll3rdsem2nd").click(function () {
                    if ($(this).is(":checked")) {
                        $(".hide_3rd_grade_2nd").show();
                        $(".show_3rd_grade_2nd").hide();
                    } else {
                        $(".hide_3rd_grade_2nd").hide();
                        $(".hide_3rd_grade_2nd").show();chckAll1stsem1st
                    }
                });
            });

            $(function () {
                $(".check_3rd_sem_summer").click(function () {
                    if ($(this).is(":checked")) {
                        $(".hide_3rd_grade_summer").show();
                        $(".show_3rd_grade_summer").hide();
                    } else {
                        $(".hide_3rd_grade_summer").hide();
                        $(".show_3rd_grade_summer").show();
                    }
                });
            });

            $(function () {
                $("#chckAll3rdsemsummer").click(function () {
                    if ($(this).is(":checked")) {
                        $(".hide_3rd_grade_summer").show();
                        $(".show_3rd_grade_summer").hide();
                    } else {
                        $(".hide_3rd_grade_summer").hide();
                        $(".show_3rd_grade_summer").show();chckAll1stsem1st
                    }
                });
            });

            $(document).ready(function() {
                var $selectAll3rdsem1st = $('#chckAll3rdsem1st'); // main checkbox inside table thead
                var $table3rdsem1st = $('#table31stsem'); // table selector 
                var $tdCheckbox3rdsem1st = $table3rdsem1st.find('tbody input:checkbox'); // checboxes inside table body
                var tdCheckboxChecked3rdsem1st = 0; // checked checboxes

                // Select or deselect all checkboxes depending on main checkbox change
                $selectAll3rdsem1st.on('click', function () {
                    $tdCheckbox3rdsem1st.prop('checked', this.checked);
                });

                // Toggle main checkbox state to checked when all checkboxes inside tbody tag is checked
                $tdCheckbox3rdsem1st.on('change', function(e){
                    tdCheckboxChecked3rdsem1st = $table3rdsem1st.find('tbody input:checkbox:checked').length; // Get count of checkboxes that is checked
                    // if all checkboxes are checked, then set property of main checkbox to "true", else set to "false"
                    $selectAll3rdsem1st.prop('checked', (tdCheckboxChecked3rdsem1st === $tdCheckbox3rdsem1st.length));
                })
            });

            $(document).ready(function() {
                var $selectAll3rdsem2nd = $('#chckAll3rdsem2nd'); // main checkbox inside table thead
                var $table3rdsem2nd = $('#table32ndsem'); // table selector 
                var $tdCheckbox3rdsem2nd= $table3rdsem2nd.find('tbody input:checkbox'); // checboxes inside table body
                var tdCheckboxChecked3rdsem2nd = 0; // checked checboxes

                // Select or deselect all checkboxes depending on main checkbox change
                $selectAll3rdsem2nd.on('click', function () {
                    $tdCheckbox3rdsem2nd.prop('checked', this.checked);
                });

                // Toggle main checkbox state to checked when all checkboxes inside tbody tag is checked
                $tdCheckbox3rdsem2nd.on('change', function(e){
                    tdCheckboxChecked3rdsem2nd = $table3rdsem2nd.find('tbody input:checkbox:checked').length; // Get count of checkboxes that is checked
                    // if all checkboxes are checked, then set property of main checkbox to "true", else set to "false"
                    $selectAll3rdsem2nd.prop('checked', (tdCheckboxChecked3rdsem2nd === $tdCheckbox3rdsem2nd.length));
                })
            });

            $(document).ready(function() {
                var $selectAll3rdsemsummer = $('#chckAll3rdsemsummer'); // main checkbox inside table thead
                var $table3rdsemsummer = $('#table3summersem'); // table selector 
                var $tdCheckbox3rdsemsummer = $table2ndsemsummer.find('tbody input:checkbox'); // checboxes inside table body
                var tdCheckboxChecked3rdsemsummer = 0; // checked checboxes

                // Select or deselect all checkboxes depending on main checkbox change
                $selectAll3rdsemsummer.on('click', function () {
                    $tdCheckbox3rdsemsummer.prop('checked', this.checked);
                });

                // Toggle main checkbox state to checked when all checkboxes inside tbody tag is checked
                $tdCheckbox3rdsemsummer.on('change', function(e){
                    tdCheckboxChecked3rdsemsummer = $table3rdsemsummer.find('tbody input:checkbox:checked').length; // Get count of checkboxes that is checked
                    // if all checkboxes are checked, then set property of main checkbox to "true", else set to "false"
                    $selectAll3rdsemsummer.prop('checked', (tdCheckboxChecked3rdsemsummer === $tdCheckbox3rdsemsummer.length));
                })
            });

            $('#table31stsem').on('change', ':checkbox', function() {
                $('#button_update_3rd_1st').toggle(!!$('input:checkbox:checked').length);
            });

            $('#table32ndsem').on('change', ':checkbox', function() {
                $('#button_update_3rd_2nd').toggle(!!$('input:checkbox:checked').length);
            });

            $('#table3summersem').on('change', ':checkbox', function() {
                $('#button_update_3rd_summer').toggle(!!$('input:checkbox:checked').length);
            });

            if ( $.fn.dataTable.isDataTable( '#table31stsem' ) ) {
                table = $('#table31stsem').DataTable();
            }
            else {
                table = $('#table31stsem').DataTable( {
                    paging: false,
                    ordering: false,
                    info: false
                } );
            }

            if ( $.fn.dataTable.isDataTable( '#table32ndsem' ) ) {
                table = $('#table32ndsem').DataTable();
            }
            else {
                table = $('#table32ndsem').DataTable( {
                    paging: false,
                    ordering: false,
                    info: false
                } );
            }

            if ( $.fn.dataTable.isDataTable( '#table3summersem' ) ) {
                table = $('#table3summersem').DataTable();
            }
            else {
                table = $('#table3summersem').DataTable( {
                    paging: false,
                    ordering: false,
                    info: false
                } );
            }

            $(document).ready(function() {
            $('body').on('click','.edit3rdSubject1stbtn',function() {
                $('#edit3rdSubject1stModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#none1').val(data[0]);
                $('#3rd_subject_preid_1st').val(data[1]);
                $('#none2').val(data[2]);
                $('#3rd_subject_1st').val(data[3]);
                $('#none3').val(data[4]);
                $('#none4').val(data[5]);
                $('#none5').val(data[6]);
                $('#none6').val(data[7]);
                $('#3rd_grade_1st').val(data[8]);
                $('#3rd_remarks_1st').val(data[9]);
                $('#3rd_year_1st').val(data[10]);
                $('#3rd_sem_1st').val(data[11]);
                $('#3rd_subject_id_1st').val(data[12]);
                $('#none7').val(data[13]);
                $('#3rd_schoolyear_1st').val(data[14]);
            });
            });

			$(document).ready(function() {
            $('body').on('click','.edit3rdSubject2ndbtn',function() {
                $('#edit3rdSubject2ndModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#none1').val(data[0]);
                $('#3rd_subject_preid_2nd').val(data[1]);
                $('#none2').val(data[2]);
                $('#3rd_subject_2nd').val(data[3]);
                $('#none3').val(data[4]);
                $('#none4').val(data[5]);
                $('#none5').val(data[6]);
                $('#none6').val(data[7]);
                $('#3rd_grade_2nd').val(data[8]);
                $('#3rd_remarks_2nd').val(data[9]);
                $('#3rd_year_2nd').val(data[10]);
                $('#3rd_sem_2nd').val(data[11]);
                $('#3rd_subject_id_2nd').val(data[12]);
                $('#none7').val(data[13]);
                $('#3rd_schoolyear_2nd').val(data[14]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.edit3rdSubjectsummerbtn',function() {
                $('#edit3rdSubjectsummerModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#none1').val(data[0]);
                $('#3rd_subject_preid_summer').val(data[1]);
                $('#none2').val(data[2]);
                $('#3rd_subject_summer').val(data[3]);
                $('#none3').val(data[4]);
                $('#none4').val(data[5]);
                $('#none5').val(data[6]);
                $('#none6').val(data[7]);
                $('#3rd_grade_summer').val(data[8]);
                $('#3rd_remarks_summer').val(data[9]);
                $('#3rd_year_summer').val(data[10]);
                $('#3rd_sem_summer').val(data[11]);
                $('#3rd_subject_id_summer').val(data[12]);
                $('#none7').val(data[13]);
                $('#3rd_schoolyear_summer').val(data[14]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.delete3rdSubject1stbtn',function() {
                $('#delete3rdSubject1stModal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#deleteid_sub_id_3rd_1st').val(data[0]);
            });
            });

			$(document).ready(function() {
            $('body').on('click','.delete3rdSubject2ndbtn',function() {
                $('#delete3rdSubject2ndModal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#deleteid_sub_id_3rd_2nd').val(data[0]);
            });
            });
        }

        function fourthtable(){
            document.getElementById('firstYear').style.display='none'; 
            document.getElementById('secondYear').style.display='none'; 
            document.getElementById('thirdYear').style.display='none'; 
            document.getElementById('fourthYear').style.display='block'; 
            document.getElementById('fifthYear').style.display='none'; 

            document.getElementById('tab1').style.color = 'red'; 
            document.getElementById('tab2').style.color = 'red'; 
            document.getElementById('tab3').style.color = 'red'; 
            document.getElementById('tab4').style.color = 'white'; 
            document.getElementById('tab5').style.color = 'red'; 

            document.getElementById('tab1').style.backgroundColor = 'white'; 
            document.getElementById('tab2').style.backgroundColor = 'white'; 
            document.getElementById('tab3').style.backgroundColor = 'white'; 
            document.getElementById('tab4').style.backgroundColor = 'red'; 
            document.getElementById('tab5').style.backgroundColor = 'white'; 

            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })

            $(function () {
                $(".check_4th_sem_1st").click(function () {
                    if ($(this).is(":checked")) {
                        $(".hide_4th_grade_1st").show();
                        $(".show_4th_grade_1st").hide();
                    } else {
                        $(".hide_4th_grade_1st").hide();
                        $(".show_4th_grade_1st").show();
                    }
                });
            });

            $(function () {
                $("#chckAll4thsem1st").click(function () {
                    if ($(this).is(":checked")) {
                        $(".hide_4th_grade_1st").show();
                        $(".show_4th_grade_1st").hide();
                    } else {
                        $(".hide_4th_grade_1st").hide();
                        $(".show_4th_grade_1st").show();chckAll1stsem1st
                    }
                });
            });

            $(function () {
                $(".check_4th_sem_2nd").click(function () {
                    if ($(this).is(":checked")) {
                        $(".hide_4th_grade_2nd").show();
                        $(".show_4th_grade_2nd").hide();
                    } else {
                        $(".hide_4th_grade_2nd").hide();
                        $(".show_4th_grade_2nd").show();
                    }
                });
            });

            $(function () {
                $("#chckAll4thsem2nd").click(function () {
                    if ($(this).is(":checked")) {
                        $(".hide_4th_grade_2nd").show();
                        $(".show_4th_grade_2nd").hide();
                    } else {
                        $(".hide_4th_grade_2nd").hide();
                        $(".show_4th_grade_2nd").show();chckAll1stsem1st
                    }
                });
            });

            $(function () {
                $(".check_4th_sem_summer").click(function () {
                    if ($(this).is(":checked")) {
                        $(".hide_4th_grade_summer").show();
                        $(".show_4th_grade_summer").hide();
                    } else {
                        $(".hide_4th_grade_summer").hide();
                        $(".show_4th_grade_summer").show();
                    }
                });
            });

            $(function () {
                $("#chckAll4thsemsummer").click(function () {
                    if ($(this).is(":checked")) {
                        $(".hide_4th_grade_summer").show();
                        $(".show_4th_grade_summer").hide();
                    } else {
                        $(".hide_4th_grade_summer").hide();
                        $(".show_4th_grade_summer").show();chckAll1stsem1st
                    }
                });
            });

            $(document).ready(function() {
                var $selectAll4thsem1st = $('#chckAll4thsem1st'); // main checkbox inside table thead
                var $table4thsem1st = $('#table41stsem'); // table selector 
                var $tdCheckbox4thsem1st = $table4thsem1st.find('tbody input:checkbox'); // checboxes inside table body
                var tdCheckboxChecked4thsem1st = 0; // checked checboxes

                // Select or deselect all checkboxes depending on main checkbox change
                $selectAll4thsem1st.on('click', function () {
                    $tdCheckbox4thsem1st.prop('checked', this.checked);
                });

                // Toggle main checkbox state to checked when all checkboxes inside tbody tag is checked
                $tdCheckbox4thsem1st.on('change', function(e){
                    tdCheckboxChecked4thsem1st = $table4thsem1st.find('tbody input:checkbox:checked').length; // Get count of checkboxes that is checked
                    // if all checkboxes are checked, then set property of main checkbox to "true", else set to "false"
                    $selectAll4thsem1st.prop('checked', (tdCheckboxChecked4thsem1st === $tdCheckbox4thsem1st.length));
                })
            });

            $(document).ready(function() {
                var $selectAll4thsem2nd = $('#chckAll4thsem2nd'); // main checkbox inside table thead
                var $table4thsem2nd = $('#table42ndsem'); // table selector 
                var $tdCheckbox4thsem2nd= $table4thsem2nd.find('tbody input:checkbox'); // checboxes inside table body
                var tdCheckboxChecked4thsem2nd = 0; // checked checboxes

                // Select or deselect all checkboxes depending on main checkbox change
                $selectAll4thsem2nd.on('click', function () {
                    $tdCheckbox4thsem2nd.prop('checked', this.checked);
                });

                // Toggle main checkbox state to checked when all checkboxes inside tbody tag is checked
                $tdCheckbox4thsem2nd.on('change', function(e){
                    tdCheckboxChecked4thsem2nd = $table4thsem2nd.find('tbody input:checkbox:checked').length; // Get count of checkboxes that is checked
                    // if all checkboxes are checked, then set property of main checkbox to "true", else set to "false"
                    $selectAll4thsem2nd.prop('checked', (tdCheckboxChecked4thsem2nd === $tdCheckbox4thsem2nd.length));
                })
            });

            $(document).ready(function() {
                var $selectAll4thsemsummer = $('#chckAll4thsemsummer'); // main checkbox inside table thead
                var $table4thsemsummer = $('#table4summersem'); // table selector 
                var $tdCheckbox4thsemsummer = $table4thsemsummer.find('tbody input:checkbox'); // checboxes inside table body
                var tdCheckboxChecked4thsemsummer = 0; // checked checboxes

                // Select or deselect all checkboxes depending on main checkbox change
                $selectAll4thsemsummer.on('click', function () {
                    $tdCheckbox4thsemsummer.prop('checked', this.checked);
                });

                // Toggle main checkbox state to checked when all checkboxes inside tbody tag is checked
                $tdCheckbox4thsemsummer.on('change', function(e){
                    tdCheckboxChecked4thsemsummer = $table4thsemsummer.find('tbody input:checkbox:checked').length; // Get count of checkboxes that is checked
                    // if all checkboxes are checked, then set property of main checkbox to "true", else set to "false"
                    $selectAll4thsemsummer.prop('checked', (tdCheckboxChecked4thsemsummer === $tdCheckbox4thsemsummer.length));
                })
            });

            $('#table41stsem').on('change', ':checkbox', function() {
                $('#button_update_4th_1st').toggle(!!$('input:checkbox:checked').length);
            });

            $('#table42ndsem').on('change', ':checkbox', function() {
                $('#button_update_4th_2nd').toggle(!!$('input:checkbox:checked').length);
            });

            $('#table4summersem').on('change', ':checkbox', function() {
                $('#button_update_4th_summer').toggle(!!$('input:checkbox:checked').length);
            });

            if ( $.fn.dataTable.isDataTable( '#table41stsem' ) ) {
                table = $('#table41stsem').DataTable();
            }
            else {
                table = $('#table41stsem').DataTable( {
                    paging: false,
                    ordering: false,
                    info: false
                } );
            }

            if ( $.fn.dataTable.isDataTable( '#table42ndsem' ) ) {
                table = $('#table42ndsem').DataTable();
            }
            else {
                table = $('#table42ndsem').DataTable( {
                    paging: false,
                    ordering: false,
                    info: false
                } );
            }

			if ( $.fn.dataTable.isDataTable( '#table4summersem' ) ) {
                table = $('#table4summersem').DataTable();
            }
            else {
                table = $('#table4summersem').DataTable( {
                    paging: false,
                    ordering: false,
                    info: false
                } );
            }

            $(document).ready(function() {
            $('body').on('click','.edit4thSubject1stbtn',function() {
                $('#edit4thSubject1stModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#none1').val(data[0]);
                $('#4th_subject_preid_1st').val(data[1]);
                $('#none2').val(data[2]);
                $('#4th_subject_1st').val(data[3]);
                $('#none3').val(data[4]);
                $('#none4').val(data[5]);
                $('#none5').val(data[6]);
                $('#none6').val(data[7]);
                $('#4th_grade_1st').val(data[8]);
                $('#4th_remarks_1st').val(data[9]);
                $('#4th_year_1st').val(data[10]);
                $('#4th_sem_1st').val(data[11]);
                $('#4th_subject_id_1st').val(data[12]);
                $('#none7').val(data[13]);
                $('#4th_schoolyear_1st').val(data[14]);
            });
            });

			$(document).ready(function() {
            $('body').on('click','.edit4thSubject2ndbtn',function() {
                $('#edit4thSubject2ndModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#none1').val(data[0]);
                $('#4th_subject_preid_2nd').val(data[1]);
                $('#none2').val(data[2]);
                $('#4th_subject_2nd').val(data[3]);
                $('#none3').val(data[4]);
                $('#none4').val(data[5]);
                $('#none5').val(data[6]);
                $('#none6').val(data[7]);
                $('#4th_grade_2nd').val(data[8]);
                $('#4th_remarks_2nd').val(data[9]);
                $('#4th_year_2nd').val(data[10]);
                $('#4th_sem_2nd').val(data[11]);
                $('#4th_subject_id_2nd').val(data[12]);
                $('#none7').val(data[13]);
                $('#4th_schoolyear_2nd').val(data[14]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.edit4thSubjectsummerbtn',function() {
                $('#edit4thSubjectsummerModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#none1').val(data[0]);
                $('#4th_subject_preid_summer').val(data[1]);
                $('#none2').val(data[2]);
                $('#4th_subject_summer').val(data[3]);
                $('#none3').val(data[4]);
                $('#none4').val(data[5]);
                $('#none5').val(data[6]);
                $('#none6').val(data[7]);
                $('#4th_grade_summer').val(data[8]);
                $('#4th_remarks_summer').val(data[9]);
                $('#4th_year_summer').val(data[10]);
                $('#4th_sem_summer').val(data[11]);
                $('#4th_subject_id_summer').val(data[12]);
                $('#none7').val(data[13]);
                $('#4th_schoolyear_summer').val(data[14]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.delete4thSubject1stbtn',function() {
                $('#delete4thSubject1stModal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#deleteid_sub_id_4th_1st').val(data[0]);
            });
            });

			$(document).ready(function() {
            $('body').on('click','.delete4thSubject2ndbtn',function() {
                $('#delete4thSubject2ndModal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#deleteid_sub_id_4th_2nd').val(data[0]);
            });
            });
        }

        function fifthtable(){
            document.getElementById('firstYear').style.display='none'; 
            document.getElementById('secondYear').style.display='none'; 
            document.getElementById('thirdYear').style.display='none'; 
            document.getElementById('fourthYear').style.display='none'; 
            document.getElementById('fifthYear').style.display='block'; 

            document.getElementById('tab1').style.color = 'red'; 
            document.getElementById('tab2').style.color = 'red'; 
            document.getElementById('tab3').style.color = 'red'; 
            document.getElementById('tab4').style.color = 'red'; 
            document.getElementById('tab5').style.color = 'white'; 

            document.getElementById('tab1').style.backgroundColor = 'white'; 
            document.getElementById('tab2').style.backgroundColor = 'white'; 
            document.getElementById('tab3').style.backgroundColor = 'white'; 
            document.getElementById('tab4').style.backgroundColor = 'white'; 
            document.getElementById('tab5').style.backgroundColor = 'red'; 

            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })

            $(function () {
                $(".check_5th_sem_1st").click(function () {
                    if ($(this).is(":checked")) {
                        $(".hide_5th_grade_1st").show();
                        $(".show_5th_grade_1st").hide();
                    } else {
                        $(".hide_5th_grade_1st").hide();
                        $(".show_5th_grade_1st").show();
                    }
                });
            });

            $(function () {
                $("#chckAll5thsem1st").click(function () {
                    if ($(this).is(":checked")) {
                        $(".hide_5th_grade_1st").show();
                        $(".show_5th_grade_1st").hide();
                    } else {
                        $(".hide_5th_grade_1st").hide();
                        $(".show_5th_grade_1st").show();chckAll1stsem1st
                    }
                });
            });

            $(function () {
                $(".check_5th_sem_2nd").click(function () {
                    if ($(this).is(":checked")) {
                        $(".hide_5th_grade_2nd").show();
                        $(".show_5th_grade_2nd").hide();
                    } else {
                        $(".hide_5th_grade_2nd").hide();
                        $(".show_5th_grade_2nd").show();
                    }
                });
            });

            $(function () {
                $("#chckAll5thsem2nd").click(function () {
                    if ($(this).is(":checked")) {
                        $(".hide_5th_grade_2nd").show();
                        $(".show_5th_grade_2nd").hide();
                    } else {
                        $(".hide_5th_grade_2nd").hide();
                        $(".show_5th_grade_2nd").show();chckAll1stsem1st
                    }
                });
            });

            $(function () {
                $(".check_5th_sem_summer").click(function () {
                    if ($(this).is(":checked")) {
                        $(".hide_5th_grade_summer").show();
                        $(".show_5th_grade_summer").hide();
                    } else {
                        $(".hide_5th_grade_summer").hide();
                        $(".show_5th_grade_summer").show();
                    }
                });
            });

            $(function () {
                $("#chckAll5thsemsummer").click(function () {
                    if ($(this).is(":checked")) {
                        $(".hide_5th_grade_summer").show();
                        $(".show_5th_grade_summer").hide();
                    } else {
                        $(".hide_5th_grade_summer").hide();
                        $(".show_5th_grade_summer").show();chckAll1stsem1st
                    }
                });
            });

            $(document).ready(function() {
                var $selectAll5thsem1st = $('#chckAll5thsem1st'); // main checkbox inside table thead
                var $table5thsem1st = $('#table51stsem'); // table selector 
                var $tdCheckbox5thsem1st = $table5thsem1st.find('tbody input:checkbox'); // checboxes inside table body
                var tdCheckboxChecked5thsem1st = 0; // checked checboxes

                // Select or deselect all checkboxes depending on main checkbox change
                $selectAll5thsem1st.on('click', function () {
                    $tdCheckbox5thsem1st.prop('checked', this.checked);
                });

                // Toggle main checkbox state to checked when all checkboxes inside tbody tag is checked
                $tdCheckbox5thsem1st.on('change', function(e){
                    tdCheckboxChecked5thsem1st = $table5thsem1st.find('tbody input:checkbox:checked').length; // Get count of checkboxes that is checked
                    // if all checkboxes are checked, then set property of main checkbox to "true", else set to "false"
                    $selectAll5thsem1st.prop('checked', (tdCheckboxChecked5thsem1st === $tdCheckbox5thsem1st.length));
                })
            });

            $(document).ready(function() {
                var $selectAll5thsem2nd = $('#chckAll5thsem2nd'); // main checkbox inside table thead
                var $table5thsem2nd = $('#table52ndsem'); // table selector 
                var $tdCheckbox5thsem2nd= $table5thsem2nd.find('tbody input:checkbox'); // checboxes inside table body
                var tdCheckboxChecked5thsem2nd = 0; // checked checboxes

                // Select or deselect all checkboxes depending on main checkbox change
                $selectAll5thsem2nd.on('click', function () {
                    $tdCheckbox5thsem2nd.prop('checked', this.checked);
                });

                // Toggle main checkbox state to checked when all checkboxes inside tbody tag is checked
                $tdCheckbox5thsem2nd.on('change', function(e){
                    tdCheckboxChecked5thsem2nd = $table5thsem2nd.find('tbody input:checkbox:checked').length; // Get count of checkboxes that is checked
                    // if all checkboxes are checked, then set property of main checkbox to "true", else set to "false"
                    $selectAll5thsem2nd.prop('checked', (tdCheckboxChecked5thsem2nd === $tdCheckbox5thsem2nd.length));
                })
            });

            $(document).ready(function() {
                var $selectAll5thsemsummer = $('#chckAll5thsemsummer'); // main checkbox inside table thead
                var $table5thsemsummer = $('#table5summersem'); // table selector 
                var $tdCheckbox5thsemsummer = $table5thsemsummer.find('tbody input:checkbox'); // checboxes inside table body
                var tdCheckboxChecked5thsemsummer = 0; // checked checboxes

                // Select or deselect all checkboxes depending on main checkbox change
                $selectAll5thsemsummer.on('click', function () {
                    $tdCheckbox5thsemsummer.prop('checked', this.checked);
                });

                // Toggle main checkbox state to checked when all checkboxes inside tbody tag is checked
                $tdCheckbox5thsemsummer.on('change', function(e){
                    tdCheckboxChecked5thsemsummer = $table5thsemsummer.find('tbody input:checkbox:checked').length; // Get count of checkboxes that is checked
                    // if all checkboxes are checked, then set property of main checkbox to "true", else set to "false"
                    $selectAll5thsemsummer.prop('checked', (tdCheckboxChecked5thsemsummer === $tdCheckbox5thsemsummer.length));
                })
            });

            $('#table51stsem').on('change', ':checkbox', function() {
                $('#button_update_5th_1st').toggle(!!$('input:checkbox:checked').length);
            });

            $('#table52ndsem').on('change', ':checkbox', function() {
                $('#button_update_5th_2nd').toggle(!!$('input:checkbox:checked').length);
            });

            $('#table5summersem').on('change', ':checkbox', function() {
                $('#button_update_5th_summer').toggle(!!$('input:checkbox:checked').length);
            });

            if ( $.fn.dataTable.isDataTable( '#table51stsem' ) ) {
                table = $('#table51stsem').DataTable();
            }
            else {
                table = $('#table51stsem').DataTable( {
                    paging: false,
                    ordering: false,
                    info: false
                } );
            }

            if ( $.fn.dataTable.isDataTable( '#table52ndsem' ) ) {
                table = $('#table52ndsem').DataTable();
            }
            else {
                table = $('#table52ndsem').DataTable( {
                    paging: false,
                    ordering: false,
                    info: false
                } );
            }

            if ( $.fn.dataTable.isDataTable( '#table5summersem' ) ) {
                table = $('#table5summersem').DataTable();
            }
            else {
                table = $('#table5summersem').DataTable( {
                    paging: false,
                    ordering: false,
                    info: false
                } );
            }

            $('#addFifthSubject').on('click', function() {
                $('#addFifthSubjectsmodal').modal('show');
            });

            $('#deleteAllFifthSubject').on('click', function() {
                $('#deleteAllFifthSubjectsmodal').modal('show');
            });

            $(document).ready(function() {
            $('body').on('click','.edit5thSubject1stbtn',function() {
                $('#edit5thSubject1stModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#none1').val(data[0]);
                $('#5th_subject_preid_1st').val(data[1]);
                $('#none2').val(data[2]);
                $('#5th_subject_1st').val(data[3]);
                $('#none3').val(data[4]);
                $('#none4').val(data[5]);
                $('#none5').val(data[6]);
                $('#none6').val(data[7]);
                $('#5th_grade_1st').val(data[8]);
                $('#5th_remarks_1st').val(data[9]);
                $('#5th_year_1st').val(data[10]);
                $('#5th_sem_1st').val(data[11]);
                $('#5th_subject_id_1st').val(data[12]);
                $('#none7').val(data[13]);
                $('#5th_schoolyear_1st').val(data[14]);
            });
            });

			$(document).ready(function() {
            $('body').on('click','.edit5thSubject2ndbtn',function() {
                $('#edit5thSubject2ndModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#none1').val(data[0]);
                $('#5th_subject_preid_2nd').val(data[1]);
                $('#none2').val(data[2]);
                $('#5th_subject_2nd').val(data[3]);
                $('#none3').val(data[4]);
                $('#none4').val(data[5]);
                $('#none5').val(data[6]);
                $('#none6').val(data[7]);
                $('#5th_grade_2nd').val(data[8]);
                $('#5th_remarks_2nd').val(data[9]);
                $('#5th_year_2nd').val(data[10]);
                $('#5th_sem_2nd').val(data[11]);
                $('#5th_subject_id_2nd').val(data[12]);
                $('#none7').val(data[13]);
                $('#5th_schoolyear_2nd').val(data[14]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.edit5thSubjectsummerbtn',function() {
                $('#edit5thSubjectsummerModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#none1').val(data[0]);
                $('#5th_subject_preid_summer').val(data[1]);
                $('#none2').val(data[2]);
                $('#5th_subject_summer').val(data[3]);
                $('#none3').val(data[4]);
                $('#none4').val(data[5]);
                $('#none5').val(data[6]);
                $('#none6').val(data[7]);
                $('#5th_grade_summer').val(data[8]);
                $('#5th_remarks_summer').val(data[9]);
                $('#5th_year_summer').val(data[10]);
                $('#5th_sem_summer').val(data[11]);
                $('#5th_subject_id_summer').val(data[12]);
                $('#none7').val(data[13]);
                $('#5th_schoolyear_sumer').val(data[14]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.delete5thSubject1stbtn',function() {
                $('#delete5thSubject1stModal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#deleteid_sub_id_5th_1st').val(data[0]);
            });
            });

			$(document).ready(function() {
            $('body').on('click','.delete5thSubject2ndbtn',function() {
                $('#delete5thSubject2ndModal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#deleteid_sub_id_5th_2nd').val(data[0]);
            });
            });
        }
	</script>

    <script type="text/javascript">
		//the interval 'timer' is set as soon as the page loads
		var timer = setInterval(function(){ auto_logout() }, 900000);
		// the figure '20000' (20 seconds) indicates how many milliseconds the timer be set to.
		//e.g. if you want it to set 15 mins, calculate 15min= 15x60=900 sec => 900,000 milliseconds.
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