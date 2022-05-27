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
		<div class="container border mt-4">
            <div class="row border mb-3">
                <div class="col mt-2 mb-2">
                    <button type="button" class="btn rounded btn-secondary p-2 fas fa-chevron-left" title="Back" onclick="location.href='adviser-studentlists.php'"> Back</button>
                    <?php
                        $show_school_year = mysqli_query($connection,"SELECT * FROM tblschool_year WHERE status='Activated'"); 
                        if(mysqli_num_rows($show_school_year) > 0)
                        {
                            $y = mysqli_fetch_array($show_school_year);
                            $sy_show = $y['school_year'];
                    ?>
                            <span class="fw-bold ml-2" style="cursor: default;">This School Year: <?php echo $sy_show ?></span>
                    <?php
                        }
                        else
                        {
                    ?> 
                            <span class="fw-bold ml-2" style="cursor: default;">School Year hasn't been Activate Yet!</span>
                    <?php
                        }
                    ?>
                </div>
                <div class="col mt-2 mb-2" align="right">
                    <div class="d-flex">
                        <div class="mr-auto"></div>
                        <div class="mr-1">
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
                        <div class="">
                        <?php
                            $select_sub = mysqli_query($connection,"SELECT * FROM tbladviser_send_sub_to_stud WHERE status='Currently Enrolled' and adviser_id_fk='$adminid' and student_id_fk='$Studid' and curri_id_fk='$Currid' and course_id_fk='$courseid'");
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
            </div>
			<p class="text mt-3 text-uppercase text-danger fw-bold text-center fs-2" style="cursor: default;"><?php echo $code?> Student of PreAdvised Subjects</p>
            <p class="text text-uppercase text-danger fw-bold text-center fs-4" style="cursor: default;"><?php echo $full.' - '.$currCode?></p>
        
            <!-- TABLE -->
            <div class="container p-2 container-fluid mb-3" >
                <div class="container overflow-auto" >
                    <div class="row border-top mb-2">
                        <span class="fw-bold text-uppercase text-danger text-center mt-2 fs-3" style="cursor: default;">Curriculum Year Subjects</span>
                    </div>
                    <div class="row border-top border-bottom mb-2">
                        <div class="col text-center">
                            <a id="tab1" class="btn my-4 border border-danger fw-bold fs-5" onclick="firsttable()">First Year</a>
                        </div>
                        <div class="col text-center">
                            <a id="tab2" class="btn my-4 border border-danger fw-bold fs-5" onclick="secondtable()">Second Year</a>
                        </div>
                        <div class="col text-center">
                            <a id="tab3" class="btn my-4 border border-danger fw-bold fs-5" onclick="thirdtable()">Third Year</a>
                        </div>
                        <div class="col text-center">
                            <a id="tab4" class="btn my-4 border border-danger fw-bold fs-5" >Fourth Year</a>
                        </div>
                        <div class="col text-center">
                            <a id="tab5" class="btn my-4 border border-danger fw-bold fs-5" >Fifth Year</a>
                        </div>
                        <div class="w-100"></div>
                    </div>
                    <!-- 1st Year and Semester Subjects -->
                    <div class="mb-4" id="firstYear">
						<div class="mt-4 mb-3" align="right"></div>
                        <!-- 1st Year 1st Semester -->
						<div class="border-bottom mb-2">
                            <form action="managedata.php" method="POST">
                                <input type="hidden" name="studid" value="<?php echo $Studid?>">
                                <input type="hidden" name="currid" value="<?php echo $Currid ?>">
                                <div class="row mb-2">
                                    <div class="col bg-secondary text-light" align="left">
                                        <div class="mt-2 mb-2">
                                            <span style="cursor: default;">Check to Update Grade Semester : </span>
                                        </div>
                                    </div>
                                    <div class="col bg-secondary text-light" align="right">
                                        <div class="mt-2 mb-2">
                                            <input type="checkbox" class="ml-2 mr-2 up_1st_sem_1st" style="transform: scale(1.5); cursor: pointer;"><span style="cursor: default;">1st Semester</span>
                                            <input type="checkbox" class="ml-2 mr-2 up_1st_sem_2nd" style="transform: scale(1.5); cursor: pointer;"><span style="cursor: default;">2nd Semester</span>
                                            <input type="checkbox" class="ml-2 mr-2 up_1st_sem_summer" style=" transform: scale(1.5); cursor: pointer;"><span style="cursor: default;">Summer Semester</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col mt-2" align="left">
                                        <span class="text-uppercase fw-bold">1st Semester</span>
                                    </div>
                                    <div class="col" align="right">
                                        <button type="submit" name="but_update" id="button_update" class="btn btn-success up_grade_button" style="display: none;">Save</button>
                                    </div>
                                </div>
                            <?php
                                $check_1st_subject_1st = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE student_id_fk='$Studid' and status='1' and curr_id_fk='$Currid' and course_id_fk='$courseid' and yearlevel='1' and semester='1st'");
                            ?>
							<table class="table table-striped" id="table11stsem" width="100%">
								<thead class="text-white">
									<tr>
                                        <th hidden></th>
                                        <th hidden><center>id</center></th>
                                        <th><center>Code</center></th>
                                        <th width="25%"><center>Title</center></th>
                                        <th ><center>Lec</center></th>
                                        <th ><center>Lab</center></th>
                                        <th ><center>Units</center></th>
                                        <th ><center>Prerequisite</center></th>
                                        <th hidden><center>year</center></th>
                                        <th hidden><center>semester</center></th>
                                        <th ><center>Grades</center></th>
                                        <th ><center>Remarks</center></th>
									</tr>
								</thead>
								<tbody>
                            <?php
                            if(mysqli_num_rows($check_1st_subject_1st) > 0)
                            {
                                while($fa = mysqli_fetch_array($check_1st_subject_1st))
                                {
                                    $SubID_1st_1st = $fa['id'];
                                    $SubCode = $fa['subject_code'];
                                    $SubDes = $fa['description'];
                                    $SubLec = $fa['lec'];
                                    $SubLab = $fa['lab'];
                                    $SubUnits = $fa['units'];
                                    $SubPreq = $fa['prerequisite'];
                                    $Sub_subid_1st_1st = $fa['subject_id_fk'];

                                    $get_at_advised_sub_1st_1st = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE id='$SubID_1st_1st' and student_id_fk='$Studid' and curr_id_fk='$Currid' and yearlevel='1' and semester='1st' and course_id_fk='$curr_courseid'");
                                    if(mysqli_num_rows($get_at_advised_sub_1st_1st) > 0)
                                    {
                                        while($re_ad = mysqli_fetch_array($get_at_advised_sub_1st_1st))
                                        {
                                            $Grades_ad_1st_1st = $re_ad['grades'];
                                            $Remarks_ad_1st_1st = $re_ad['remarks'];
                                        }
                                        if($SubID_1st_1st && $Grades_ad_1st_1st == "INC" && $Remarks_ad_1st_1st == "PASSED")
                                        {
                                            $color_tr_bg = "#FFFF66";
                                        }
                                        else if($SubID_1st_1st && $Grades_ad_1st_1st == "CREDITED" && $Remarks_ad_1st_1st == "CREDITED")
                                        {
                                            $color_tr_bg = "#00FFFF";
                                        }
                                        else if($SubID_1st_1st && $Remarks_ad_1st_1st == "PASSED")
                                        {
                                            $color_tr_bg = "#90EE90";
                                        }
                                        else if($SubID_1st_1st && $Remarks_ad_1st_1st == "FAILED")
                                        {
                                            $color_tr_bg = "#F08080";
                                        }
                                        else
                                        {
                                            $color_tr_bg = "#F5F5F5";
                                        }
                                    }
                                    else
                                    {
                                        $color_tr_bg = "#F5F5F5";
                                    }
                            ?>
								<tr style="background: <?php echo $color_tr_bg?>">
                                    <td hidden><center><input type="checkbox" name="sub_list_id[]" value="<?php echo $SubID_1st_1st?>" class="check_1st_sem_1st"></center></td>
                                    <td hidden><center><?php echo $SubID_1st_1st ?></center></td>
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
                                        $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$Sub_subid_1st_1st' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                        $get_check = mysqli_query($connection,$checkprereq);
                                        $Rows = mysqli_fetch_array($get_check);
                                        $SubID = $Rows[0];
                                                        
                                        if($SubID == 1)
                                        {
                                            $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$Sub_subid_1st_1st' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                            $checkpreq = mysqli_query($connection,$getpreq);
                                            foreach($checkpreq as $rows)
                                            {
                                                $new = $rows['subject_id'];    
                                            }
                                            $getsubcode = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE student_id_fk='$Studid' and subject_id_fk='$new' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
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
                                            $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$Sub_subid_1st_1st' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                            foreach($getpreq as $rows)
                                            {
                                                $news = $rows['subject_id'];     
                                                $getsubcode = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE student_id_fk='$Studid' and subject_id_fk='$news' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
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
                                    $select_at_advised_sub_1st_1st = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE id='$SubID_1st_1st' and student_id_fk='$Studid' and curr_id_fk='$Currid' and yearlevel='1' and semester='1st' and course_id_fk='$curr_courseid'");
                                    if(mysqli_num_rows($select_at_advised_sub_1st_1st) > 0)
                                    {
                                        $re_ad_1st_1st = mysqli_fetch_array($select_at_advised_sub_1st_1st);
                                        $Grades_ad_1st_1st = $re_ad_1st_1st['grades'];
                                        $Remarks_ad_1st_1st = $re_ad_1st_1st['remarks'];
                                    }
                            ?>
                                        <td><center>
                                            <div class="form-group show_1st_grade_1st">
                                                <?php echo $Grades_ad_1st_1st; ?>
                                            </div>
                                            <div class="form-group hide_1st_grade_1st" style="width: 8rem; display: none;">
                                                <select name="grades_<?=$SubID_1st_1st ?>" value="<?php echo $Grades_ad_1st_1st?>" class="form-control text-center">
                                                    <option value="0"><?php echo $Grades_ad_1st_1st?></option>
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
                                        <td ><center><?php echo $Remarks_ad_1st_1st ?></center></td>
                                </tr>
                            <?php
                                }				
                            }
                            $sum_units = "SELECT sum(units) FROM tblstudent_subject WHERE student_id_fk='$Studid' and curr_id_fk='$Currid' and yearlevel='1' and semester='1st' and course_id_fk='$courseid'";
                            $units_check = mysqli_query($connection,$sum_units);
                            $units_total = mysqli_fetch_array($units_check);
                            $units_row = $units_total[0];

                            $get_total_grades_1st_1st = mysqli_query($connection,"SELECT total_grades FROM tblstudent_subject WHERE student_id_fk='$Studid' and total_grades in ('INC','DRP','FAILED','CREDITED') and curr_id_fk='$Currid' and yearlevel='1' and semester='1st' and course_id_fk='$courseid'");
                            if(mysqli_num_rows($get_total_grades_1st_1st) > 0)
                            {
                                $total_grade_units_1st_1st = '<span data-toggle="tooltip" data-placement="top" class="fas fa-ellipsis-h" title="Average not available due to missing grades/Failed grades/INC grades/Credited subjects."></span>'; 
                            }
                            else if(mysqli_num_rows($get_total_grades_1st_1st) == 0)
                            {
                                $sum_stud_grade_1st_1st = "SELECT sum(total_grades) FROM tblstudent_subject WHERE student_id_fk='$Studid' and curr_id_fk='$Currid' and yearlevel='1' and semester='1st' and course_id_fk='$courseid'";
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
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td></td>
                                        <td class="fw-bold"><center>Total:</center></td>
                                        <td></td>
                                        <td></td>
                                        <td class="fw-bold"><center><?php echo $units_row?></center></td>
                                        <td class="fw-bold"><center>Average: </center></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td class="fw-bold"><center><?php echo $total_grade_units_1st_1st?></center></td>
                                        <td></td>
                                    </tr>
								</tfoot>
							</table>
                            </form>
						</div>
                        <!-- 1st Year 2nd Semester -->
						<div class="mt-2">
                            <form action="managedata.php" method="POST">
                                <input type="hidden" name="studid" value="<?php echo $Studid?>">
                                <input type="hidden" name="currid" value="<?php echo $Currid ?>">
                                <div class="row mb-2">
                                    <div class="col mt-2" align="left">
                                        <span class="text-uppercase fw-bold">2nd Semester</span>
                                    </div>
                                    <div class="col" align="right">
                                        <button type="submit" name="but_update" id="button_update_1st_2nd" class="btn btn-success up_grade_button_1st_2nd" style="display: none;">Save</button>
                                    </div>
                                </div>
                            <?php
                                $check_1st_subject_2nd = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE student_id_fk='$Studid' and status='1' and curr_id_fk='$Currid' and course_id_fk='$courseid' and yearlevel='1' and semester='2nd'");
                            ?>
							<table class="table table-striped" id="table12ndsem" width="100%">
								<thead class="text-white">
									<tr>
                                        <th hidden></th>
                                        <th hidden><center>id</center></th>
                                        <th><center>Code</center></th>
                                        <th width="25%"><center>Title</center></th>
                                        <th ><center>Lec</center></th>
                                        <th ><center>Lab</center></th>
                                        <th ><center>Units</center></th>
                                        <th ><center>Prerequisite</center></th>
                                        <th hidden><center>year</center></th>
                                        <th hidden><center>semester</center></th>
                                        <th ><center>Grades</center></th>
                                        <th ><center>Remarks</center></th>
									</tr>
								</thead>
								<tbody>
                            <?php
                                if(mysqli_num_rows($check_1st_subject_2nd) > 0)
                                {
                                    while($fa = mysqli_fetch_array($check_1st_subject_2nd))
                                    {
                                        $SubID_1st_2nd = $fa['id'];
                                        $SubCode = $fa['subject_code'];
                                        $SubDes = $fa['description'];
                                        $SubLec = $fa['lec'];
                                        $SubLab = $fa['lab'];
                                        $SubUnits = $fa['units'];
                                        $SubPreq = $fa['prerequisite'];
                                        $Sub_subid_1st_2nd = $fa['subject_id_fk'];

                                        $get_at_advised_sub_1st_2nd = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE id='$SubID_1st_2nd' and student_id_fk='$Studid' and curr_id_fk='$Currid' and yearlevel='1' and semester='2nd' and course_id_fk='$curr_courseid'");
                                        if(mysqli_num_rows($get_at_advised_sub_1st_2nd) > 0)
                                        {
                                            while($re_ad = mysqli_fetch_array($get_at_advised_sub_1st_2nd))
                                            {
                                                $Grades_ad_1st_2nd = $re_ad['grades'];
                                                $Remarks_ad_1st_2nd = $re_ad['remarks'];
                                            }
                                            if($SubID_1st_2nd && $Grades_ad_1st_2nd == "INC" && $Remarks_ad_1st_2nd == "PASSED")
                                            {
                                                $color_tr_bg = "#FFFF66";
                                            }
                                            else if($SubID_1st_2nd && $Grades_ad_1st_2nd == "CREDITED" && $Remarks_ad_1st_2nd == "CREDITED")
                                            {
                                                $color_tr_bg = "#00FFFF";
                                            }
                                            else if($SubID_1st_2nd && $Remarks_ad_1st_2nd == "PASSED")
                                            {
                                                $color_tr_bg = "#90EE90";
                                            }
                                            else if($SubID_1st_2nd && $Remarks_ad_1st_2nd == "FAILED")
                                            {
                                                $color_tr_bg = "#FFCCCB";
                                            }
                                            else
                                            {
                                                $color_tr_bg = "#F5F5F5";
                                            }
                                        }
                                        else
                                        {
                                            $color_tr_bg = "#F5F5F5";
                                        }
                            ?>
								<tr style="background: <?php echo $color_tr_bg?>">
									<td hidden><center><input type="checkbox" name="sub_list_id[]" value="<?php echo $SubID_1st_2nd?>" class="check_1st_sem_2nd"></center></td>
									<td hidden><center><?php echo $SubID_1st_2nd ?></center></td>
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
                                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$Sub_subid_1st_2nd' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                            $get_check = mysqli_query($connection,$checkprereq);
                                            $Rows = mysqli_fetch_array($get_check);
                                            $SubID = $Rows[0];
                                            
                                            if($SubID == 1)
                                            {
                                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$Sub_subid_1st_2nd' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                                $checkpreq = mysqli_query($connection,$getpreq);
                                                foreach($checkpreq as $rows)
                                                {
                                                    $new = $rows['subject_id'];    
                                                }
                                                $getsubcode = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE student_id_fk='$Studid' and subject_id_fk='$new' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
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
                                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$Sub_subid_1st_2nd' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                                foreach($getpreq as $rows)
                                                {
                                                    $news = $rows['subject_id'];    
                                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE student_id_fk='$Studid' and subject_id_fk='$news' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
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
                                        $select_at_advised_sub_1st_2nd = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE id='$SubID_1st_2nd' and student_id_fk='$Studid' and curr_id_fk='$Currid' and yearlevel='1' and semester='2nd' and course_id_fk='$curr_courseid'");
                                        if(mysqli_num_rows($select_at_advised_sub_1st_2nd) > 0)
                                        {
                                            $re_ad_1st_2nd = mysqli_fetch_array($select_at_advised_sub_1st_2nd);
                                            $Grades_ad_1st_2nd = $re_ad_1st_2nd['grades'];
                                            $Remarks_ad_1st_2nd = $re_ad_1st_2nd['remarks'];
                                        }
                            ?>
                                                <td><center>
                                                    <div class="form-group show_1st_grade_2nd">
                                                        <?php echo $Grades_ad_1st_2nd; ?>
                                                    </div>
                                                    <div class="form-group hide_1st_grade_2nd" style="width: 8rem; display: none;"> 
                                                        <select name="grades_<?=$SubID_1st_2nd ?>" value="<?php echo $Grades_ad_1st_2nd?>" class="form-control text-center">
                                                            <option value="0"><?php echo $Grades_ad_1st_2nd?></option>
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
                                                <td ><center><?php echo $Remarks_ad_1st_2nd ?></center></td>
                                            </tr>
                            <?php
                                    }				
                                }
                                $sum_units_1st_2nd = "SELECT sum(units) FROM tblstudent_subject WHERE student_id_fk='$Studid' and curr_id_fk='$Currid' and yearlevel='1' and semester='2nd' and course_id_fk='$courseid'";
                                $units_check_1st_2nd = mysqli_query($connection,$sum_units_1st_2nd);
                                $units_total_1st_2nd = mysqli_fetch_array($units_check_1st_2nd);
                                $units_row_1st_2nd = $units_total_1st_2nd[0];

                                $get_total_grades_1st_2nd = mysqli_query($connection,"SELECT total_grades FROM tblstudent_subject WHERE student_id_fk='$Studid' and total_grades in ('INC','DRP','FAILED','CREDITED') and curr_id_fk='$Currid' and yearlevel='1' and semester='2nd' and course_id_fk='$courseid'");
                                if(mysqli_num_rows($get_total_grades_1st_2nd) > 0)
                                {
                                    $total_grade_units_1st_2nd = '<span data-toggle="tooltip" data-placement="top" class="fas fa-ellipsis-h" title="Average not available due to missing grades/Failed grades/INC grades/Credited subjects."></span>'; 
                                }
                                else if(mysqli_num_rows($get_total_grades_1st_2nd) == 0)
                                {
                                    $sum_stud_grade_1st_2nd = "SELECT sum(total_grades) FROM tblstudent_subject WHERE student_id_fk='$Studid' and curr_id_fk='$Currid' and yearlevel='1' and semester='2nd' and course_id_fk='$courseid'";
                                    $check_total_1st_2nd = mysqli_query($connection,$sum_stud_grade_1st_2nd);
                                    $fetch_total_1st_2nd = mysqli_fetch_array($check_total_1st_2nd);
                                    $total_grade_1st_2nd = $fetch_total_1st_2nd[0];            
                                    if($units_row_1st_2nd != 0 && $total_grade_1st_2nd != 0)
                                    {
                                        $total_grade_units_1st_2nd = round($total_grade_1st_2nd / $units_row_1st_2nd, 4);
                                    }
                                    else
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
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td></td>
                                        <td class="fw-bold"><center>Total:</center></td>
                                        <td></td>
                                        <td></td>
                                        <td class="fw-bold"><center><?php echo $units_row_1st_2nd?></center></td>
                                        <td class="fw-bold"><center>Average: </center></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td class="fw-bold"><center><?php echo $total_grade_units_1st_2nd?></center></td>
                                        <td></td>
                                    </tr>
								</tfoot>
							</table>
                            </form>
						</div>
                        <!-- 1st Year Summer Semester -->
                        <div class="mt-2">
                            <form action="managedata.php" method="POST">
                                <input type="hidden" name="studid" value="<?php echo $Studid?>">
                                <input type="hidden" name="currid" value="<?php echo $Currid ?>">
                                <div class="row mb-2">
                                    <div class="col mt-2" align="left">
                                        <span class="text-uppercase fw-bold">Summer</span>
                                    </div>
                                    <div class="col" align="right">
                                        <button type="submit" name="but_update" id="button_update_1st_summer" class="btn btn-success up_grade_button_1st_summer" style="display: none;">Save</button>
                                    </div>
                                </div>
                            <?php
                                $check_1st_subject_summer = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE student_id_fk='$Studid' and status='1' and curr_id_fk='$Currid' and course_id_fk='$courseid' and yearlevel='1' and semester='summer'");
                            ?>
							<table class="table table-striped" id="table1summersem" width="100%">
								<thead class="text-white">
									<tr>
                                        <th hidden></th>
                                        <th hidden><center>id</center></th>
                                        <th><center>Code</center></th>
                                        <th width="25%"><center>Title</center></th>
                                        <th ><center>Lec</center></th>
                                        <th ><center>Lab</center></th>
                                        <th ><center>Units</center></th>
                                        <th ><center>Prerequisite</center></th>
                                        <th hidden><center>year</center></th>
                                        <th hidden><center>semester</center></th>
                                        <th ><center>Grades</center></th>
                                        <th ><center>Remarks</center></th>
									</tr>
								</thead>
								<tbody>
                            <?php
                                if(mysqli_num_rows($check_1st_subject_summer) > 0)
                                {
                                    while($fa = mysqli_fetch_array($check_1st_subject_summer))
                                    {
                                        $SubID_1st_summer = $fa['id'];
                                        $SubCode = $fa['subject_code'];
                                        $SubDes = $fa['description'];
                                        $SubLec = $fa['lec'];
                                        $SubLab = $fa['lab'];
                                        $SubUnits = $fa['units'];
                                        $SubPreq_1st_summer = $fa['prerequisite'];
                                        $Sub_subid_1st_summer = $fa['subject_id_fk'];

                                        $get_at_advised_sub_1st_summer = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE id='$SubID_1st_summer' and student_id_fk='$Studid' and curr_id_fk='$Currid' and yearlevel='1' and semester='summer' and course_id_fk='$curr_courseid'");
                                        if(mysqli_num_rows($get_at_advised_sub_1st_summer) > 0)
                                        {
                                            while($re_ad = mysqli_fetch_array($get_at_advised_sub_1st_summer))
                                            {
                                                $Grades_ad_1st_summer = $re_ad['grades'];
                                                $Remarks_ad_1st_summer = $re_ad['remarks'];
                                            }
                                            if($SubID_1st_summer && $Grades_ad_1st_summer == "INC" && $Remarks_ad_1st_summer == "PASSED")
                                            {
                                                $color_tr_bg = "#FFFF66";
                                            }
                                            else if($SubID_1st_summer && $Grades_ad_1st_summer == "CREDITED" && $Remarks_ad_1st_summer == "CREDITED")
                                            {
                                                $color_tr_bg = "#00FFFF";
                                            }
                                            else if($SubID_1st_summer && $Remarks_ad_1st_summer == "PASSED")
                                            {
                                                $color_tr_bg = "#90EE90";
                                            }
                                            else if($SubID_1st_summer && $Remarks_ad_1st_summer == "FAILED")
                                            {
                                                $color_tr_bg = "#FFCCCB";
                                            }
                                            else
                                            {
                                                $color_tr_bg = "#F5F5F5";
                                            }
                                        }
                                        else
                                        {
                                            $color_tr_bg = "#F5F5F5";
                                        }
                            ?>
								<tr style="background: <?php echo $color_tr_bg?>">
									<td><center><input type="checkbox" name="sub_list_id[]" value="<?php echo $SubID_1st_summer?>" class="check_1st_sem_summer"></center></td>
									<td hidden><center><?php echo $SubID_1st_summer ?></center></td>
                                    <td><center><?php echo $SubCode ?></center></td>
									<td><center><?php echo $SubDes ?></center></td>
									<td><center><?php echo $SubLec ?></center></td>
									<td><center><?php echo $SubLab ?></center></td>
									<td><center><?php echo $SubUnits ?></center></td>
                            <?php
                                        if($SubPreq_1st_summer == "NONE")
                                        {
                                            echo '<td><center>NONE</center></td>';
                                        }
                                        else if($SubPreq_1st_summer == "HAVE")
                                        {              
                                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$Sub_subid_1st_summer' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                            $get_check = mysqli_query($connection,$checkprereq);
                                            $Rows = mysqli_fetch_array($get_check);
                                            $SubID_1st_summer = $Rows[0];
                                            
                                            if($SubID_1st_summer == 1)
                                            {
                                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$Sub_subid_1st_summer' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                                $checkpreq = mysqli_query($connection,$getpreq);
                                                foreach($checkpreq as $rows)
                                                {
                                                    $new = $rows['subject_id'];    
                                                }
                                                $getsubcode = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE student_id_fk='$Studid' and subject_id_fk='$new' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                                while($sa = mysqli_fetch_array($getsubcode))
                                                {
                                                    $subCode = $sa['subject_code'];
                                                }
                                                echo '<td><center>'.$subCode.'</center></td>';
                                            }
                                            else if($SubID_1st_summer > 1)
                                            {
                            ?>
                                                <td><center>
                            <?php
                                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$Sub_subid_1st_summer' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                                foreach($getpreq as $rows)
                                                {
                                                    $news = $rows['subject_id'];    
                                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE student_id_fk='$Studid' and subject_id_fk='$news' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
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
                                        $select_at_advised_sub_1st_summer = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE id='$SubID_1st_summer' and student_id_fk='$Studid' and curr_id_fk='$Currid' and yearlevel='1' and semester='summer' and course_id_fk='$curr_courseid'");
                                        if(mysqli_num_rows($select_at_advised_sub_1st_summer) > 0)
                                        {
                                            $re_ad_1st_summer = mysqli_fetch_array($select_at_advised_sub_1st_summer);
                                            $Grades_ad_1st_summer = $re_ad_1st_summer['grades'];
                                            $Remarks_ad_1st_summer = $re_ad_1st_summer['remarks'];
                                        }
                            ?>
                                                <td><center>
                                                    <div class="form-group show_1st_grade_2nd">
                                                        <?php echo $Grades_ad_1st_summer; ?>
                                                    </div>
                                                    <div class="form-group hide_1st_grade_2nd" style="width: 8rem; display: none;"> 
                                                        <select name="grades_<?=$SubID_1st_summer ?>" value="<?php echo $Grades_ad_1st_summer?>" class="form-control text-center">
                                                            <option value="0"><?php echo $Grades_ad_1st_summer?></option>
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
                                                <td ><center><?php echo $Remarks_ad_1st_summer ?></center></td>
                                            </tr>
                            <?php
                                    }				
                                }
                                $sum_units_1st_summer = "SELECT sum(units) FROM tblstudent_subject WHERE student_id_fk='$Studid' and curr_id_fk='$Currid' and yearlevel='1' and semester='summer' and course_id_fk='$courseid'";
                                $units_check_1st_summer = mysqli_query($connection,$sum_units_1st_summer);
                                $units_total_1st_summer = mysqli_fetch_array($units_check_1st_summer);
                                $units_row_1st_summer = $units_total_1st_summer[0];

                                $get_total_grades_1st_summer = mysqli_query($connection,"SELECT total_grades FROM tblstudent_subject WHERE student_id_fk='$Studid' and total_grades in ('INC','DRP','FAILED','CREDITED') and curr_id_fk='$Currid' and yearlevel='1' and semester='summer' and course_id_fk='$courseid'");
                                if(mysqli_num_rows($get_total_grades_1st_summer) > 0)
                                {
                                    $total_grade_units_1st_summer = '<span data-toggle="tooltip" data-placement="top" class="fas fa-ellipsis-h" title="Average not available due to missing grades/Failed grades/INC grades/Credited subjects."></span>'; 
                                }
                                else if(mysqli_num_rows($get_total_grades_1st_summer) == 0)
                                {
                                    $sum_stud_grade_1st_summer = "SELECT sum(total_grades) FROM tblstudent_subject WHERE student_id_fk='$Studid' and curr_id_fk='$Currid' and yearlevel='1' and semester='summer' and course_id_fk='$courseid'";
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
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td></td>
                                        <td class="fw-bold"><center>Total:</center></td>
                                        <td></td>
                                        <td></td>
                                        <td class="fw-bold"><center><?php echo $units_row_1st_summer?></center></td>
                                        <td class="fw-bold"><center>Average: </center></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td class="fw-bold"><center><?php echo $total_grade_units_1st_summer?></center></td>
                                        <td></td>
                                    </tr>
								</tfoot>
							</table>
                            </form>
						</div>
					</div>
                    <!-- 2nd Year and Semester Subjects -->
                    <div class="mb-4" id="secondYear">
						<div class="mt-4 mb-3" align="right"></div>
                        <!-- 2nd Year 1st Semester -->
						<div class="border-bottom mb-2">
                            <form action="managedata.php" method="POST">
                                <input type="hidden" name="studid" value="<?php echo $Studid?>">
                                <input type="hidden" name="currid" value="<?php echo $Currid ?>">
                                <div class="row mb-2">
                                    <div class="col bg-secondary text-light" align="left">
                                        <div class="mt-2 mb-2">
                                            <span style="cursor: default;">Check to Update Grade Semester : </span>
                                        </div>
                                    </div>
                                    <div class="col bg-secondary text-light" align="right">
                                        <div class="mt-2 mb-2">
                                            <input type="checkbox" class="ml-2 mr-2 up_2nd_sem_1st" style="transform: scale(1.5); cursor: pointer;"><span style="cursor: default;">1st Semester</span>
                                            <input type="checkbox" class="ml-2 mr-2 up_2nd_sem_2nd" style="transform: scale(1.5); cursor: pointer;"><span style="cursor: default;">2nd Semester</span>
                                            <input type="checkbox" class="ml-2 mr-2 up_2nd_sem_summer" style=" transform: scale(1.5); cursor: pointer;"><span style="cursor: default;">Summer Semester</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col mt-2" align="left">
                                        <span class="text-uppercase fw-bold">1st Semester</span>
                                    </div>
                                    <div class="col" align="right">
                                        <button type="submit" name="but_update" id="button_update_2nd_1st" class="btn btn-success up_grade_button_2nd_1st" style="display: none;">Save</button>
                                    </div>
                                </div>
                            <?php
                                $check_2nd_subject_1st = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE student_id_fk='$Studid' and status='1' and curr_id_fk='$Currid' and course_id_fk='$courseid' and yearlevel='2' and semester='1st'");
                            ?>
							<table class="table table-striped" id="table21stsem" width="100%">
								<thead class="text-white">
									<tr>
                                        <th hidden></th>
                                        <th hidden><center>id</center></th>
                                        <th><center>Code</center></th>
                                        <th width="25%"><center>Title</center></th>
                                        <th ><center>Lec</center></th>
                                        <th ><center>Lab</center></th>
                                        <th ><center>Units</center></th>
                                        <th ><center>Prerequisite</center></th>
                                        <th hidden><center>year</center></th>
                                        <th hidden><center>semester</center></th>
                                        <th ><center>Grades</center></th>
                                        <th ><center>Remarks</center></th>
									</tr>
								</thead>
								<tbody>
                            <?php
                            if(mysqli_num_rows($check_2nd_subject_1st) > 0)
                            {
                                while($fa = mysqli_fetch_array($check_2nd_subject_1st))
                                {
                                    $SubID_2nd_1st = $fa['id'];
                                    $SubCode = $fa['subject_code'];
                                    $SubDes = $fa['description'];
                                    $SubLec = $fa['lec'];
                                    $SubLab = $fa['lab'];
                                    $SubUnits = $fa['units'];
                                    $SubPreq = $fa['prerequisite'];
                                    $Sub_subid_2nd_1st = $fa['subject_id_fk'];

                                    $get_at_advised_sub_2nd_1st = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE id='$SubID_2nd_1st' and student_id_fk='$Studid' and curr_id_fk='$Currid' and yearlevel='2' and semester='1st' and course_id_fk='$curr_courseid'");
                                    if(mysqli_num_rows($get_at_advised_sub_2nd_1st) > 0)
                                    {
                                        while($re_ad = mysqli_fetch_array($get_at_advised_sub_2nd_1st))
                                        {
                                            $Grades_ad_2nd_1st = $re_ad['grades'];
                                            $Remarks_ad_2nd_1st = $re_ad['remarks'];
                                        }
                                        if($SubID_2nd_1st && $Grades_ad_2nd_1st == "INC" && $Remarks_ad_2nd_1st == "PASSED")
                                        {
                                            $color_tr_bg = "#FFFF66";
                                        }
                                        else if($SubID_2nd_1st && $Grades_ad_2nd_1st == "CREDITED" && $Remarks_ad_2nd_1st == "CREDITED")
                                        {
                                            $color_tr_bg = "#00FFFF";
                                        }
                                        else if($SubID_2nd_1st && $Remarks_ad_2nd_1st == "PASSED")
                                        {
                                            $color_tr_bg = "#90EE90";
                                        }
                                        else if($SubID_2nd_1st && $Remarks_ad_2nd_1st == "FAILED")
                                        {
                                            $color_tr_bg = "#F08080";
                                        }
                                        else
                                        {
                                            $color_tr_bg = "#F5F5F5";
                                        }
                                    }
                                    else
                                    {
                                        $color_tr_bg = "#F5F5F5";
                                    }
                            ?>
								<tr style="background: <?php echo $color_tr_bg?>">
                                    <td hidden><center><input type="checkbox" name="sub_list_id[]" value="<?php echo $SubID_2nd_1st?>" class="check_2nd_sem_1st"></center></td>
                                    <td hidden><center><?php echo $SubID_2nd_1st ?></center></td>
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
                                        $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$Sub_subid_2nd_1st' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                        $get_check = mysqli_query($connection,$checkprereq);
                                        $Rows = mysqli_fetch_array($get_check);
                                        $SubID = $Rows[0];
                                                        
                                        if($SubID == 1)
                                        {
                                            $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$Sub_subid_2nd_1st' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                            $checkpreq = mysqli_query($connection,$getpreq);
                                            foreach($checkpreq as $rows)
                                            {
                                                $new = $rows['subject_id'];    
                                            }
                                            $getsubcode = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE student_id_fk='$Studid' and subject_id_fk='$new' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
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
                                            $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$Sub_subid_2nd_1st' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                            foreach($getpreq as $rows)
                                            {
                                                $news = $rows['subject_id'];     
                                                $getsubcode = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE student_id_fk='$Studid' and subject_id_fk='$news' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
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
                                    $select_at_advised_sub_2nd_1st = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE id='$SubID_1st_1st' and student_id_fk='$Studid' and curr_id_fk='$Currid' and yearlevel='2' and semester='1st' and course_id_fk='$curr_courseid'");
                                    if(mysqli_num_rows($select_at_advised_sub_2nd_1st) > 0)
                                    {
                                        $re_ad_2nd_1st = mysqli_fetch_array($select_at_advised_sub_2nd_1st);
                                        $Grades_ad_2nd_1st = $re_ad_2nd_1st['grades'];
                                        $Remarks_ad_2nd_1st = $re_ad_2nd_1st['remarks'];
                                    }
                            ?>
                                        <td><center>
                                            <div class="form-group show_2nd_grade_1st">
                                                <?php echo $Grades_ad_2nd_1st; ?>
                                            </div>
                                            <div class="form-group hide_2nd_grade_1st" style="width: 8rem; display: none;">
                                                <select name="grades_<?=$SubID_2nd_1st ?>" value="<?php echo $Grades_ad_2nd_1st?>" class="form-control text-center">
                                                    <option value="0"><?php echo $Grades_ad_2nd_1st?></option>
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
                                        <td ><center><?php echo $Remarks_ad_2nd_1st ?></center></td>
                                </tr>
                            <?php
                                }				
                            }
                            $sum_units_2nd_1st = "SELECT sum(units) FROM tblstudent_subject WHERE student_id_fk='$Studid' and curr_id_fk='$Currid' and yearlevel='2' and semester='1st' and course_id_fk='$courseid'";
                            $units_check_2nd_1st = mysqli_query($connection,$sum_units_2nd_1st);
                            $units_total_2nd_1st = mysqli_fetch_array($units_check_2nd_1st);
                            $units_row_2nd_1st = $units_total_2nd_1st[0];

                            $get_total_grades_2nd_1st = mysqli_query($connection,"SELECT total_grades FROM tblstudent_subject WHERE student_id_fk='$Studid' and total_grades in ('INC','DRP','FAILED','CREDITED') and curr_id_fk='$Currid' and yearlevel='2' and semester='1st' and course_id_fk='$courseid'");
                            if(mysqli_num_rows($get_total_grades_2nd_1st) > 0)
                            {
                                $total_grade_units_2nd_1st = '<span data-toggle="tooltip" data-placement="top" class="fas fa-ellipsis-h" title="Average not available due to missing grades/Failed grades/INC grades/Credited subjects."></span>'; 
                            }
                            else if(mysqli_num_rows($get_total_grades_2nd_1st) == 0)
                            {
                                $sum_stud_grade_2nd_1st = "SELECT sum(total_grades) FROM tblstudent_subject WHERE student_id_fk='$Studid' and curr_id_fk='$Currid' and yearlevel='2' and semester='1st' and course_id_fk='$courseid'";
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
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td></td>
                                        <td class="fw-bold"><center>Total:</center></td>
                                        <td></td>
                                        <td></td>
                                        <td class="fw-bold"><center><?php echo $units_row_2nd_1st?></center></td>
                                        <td class="fw-bold"><center>Average: </center></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td class="fw-bold"><center><?php echo $total_grade_units_2nd_1st?></center></td>
                                        <td></td>
                                    </tr>
								</tfoot>
							</table>
                            </form>
						</div>
                        <!-- 2nd Year 2nd Semester -->
						<div class="mt-2">
                            <form action="managedata.php" method="POST">
                                <input type="hidden" name="studid" value="<?php echo $Studid?>">
                                <input type="hidden" name="currid" value="<?php echo $Currid ?>">
                                <div class="row mb-2">
                                    <div class="col mt-2" align="left">
                                        <span class="text-uppercase fw-bold">2nd Semester</span>
                                    </div>
                                    <div class="col" align="right">
                                        <button type="submit" name="but_update" id="button_update_2nd_2nd" class="btn btn-success up_grade_button_2nd_2nd" style="display: none;">Save</button>
                                    </div>
                                </div>
                            <?php
                                $check_2nd_subject_2nd = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE student_id_fk='$Studid' and status='1' and curr_id_fk='$Currid' and course_id_fk='$courseid' and yearlevel='2' and semester='2nd'");
                            ?>
							<table class="table table-striped" id="table22ndsem" width="100%">
								<thead class="text-white">
									<tr>
                                        <th hidden></th>
                                        <th hidden><center>id</center></th>
                                        <th><center>Code</center></th>
                                        <th width="25%"><center>Title</center></th>
                                        <th ><center>Lec</center></th>
                                        <th ><center>Lab</center></th>
                                        <th ><center>Units</center></th>
                                        <th ><center>Prerequisite</center></th>
                                        <th hidden><center>year</center></th>
                                        <th hidden><center>semester</center></th>
                                        <th ><center>Grades</center></th>
                                        <th ><center>Remarks</center></th>
									</tr>
								</thead>
								<tbody>
                            <?php
                                if(mysqli_num_rows($check_2nd_subject_2nd) > 0)
                                {
                                    while($fa = mysqli_fetch_array($check_2nd_subject_2nd))
                                    {
                                        $SubID_2nd_2nd = $fa['id'];
                                        $SubCode = $fa['subject_code'];
                                        $SubDes = $fa['description'];
                                        $SubLec = $fa['lec'];
                                        $SubLab = $fa['lab'];
                                        $SubUnits = $fa['units'];
                                        $SubPreq = $fa['prerequisite'];
                                        $Sub_subid_2nd_2nd = $fa['subject_id_fk'];

                                        $get_at_advised_sub_2nd_2nd = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE id='$SubID_2nd_2nd' and student_id_fk='$Studid' and curr_id_fk='$Currid' and yearlevel='2' and semester='2nd' and course_id_fk='$curr_courseid'");
                                        if(mysqli_num_rows($get_at_advised_sub_2nd_2nd) > 0)
                                        {
                                            while($re_ad = mysqli_fetch_array($get_at_advised_sub_2nd_2nd))
                                            {
                                                $Grades_ad_2nd_2nd = $re_ad['grades'];
                                                $Remarks_ad_2nd_2nd = $re_ad['remarks'];
                                            }
                                            if($SubID_2nd_2nd && $Grades_ad_2nd_2nd == "INC" && $Remarks_ad_2nd_2nd == "PASSED")
                                            {
                                                $color_tr_bg = "#FFFF66";
                                            }
                                            else if($SubID_2nd_2nd && $Grades_ad_2nd_2nd == "CREDITED" && $Remarks_ad_2nd_2nd == "CREDITED")
                                            {
                                                $color_tr_bg = "#00FFFF";
                                            }
                                            else if($SubID_2nd_2nd && $Remarks_ad_2nd_2nd == "PASSED")
                                            {
                                                $color_tr_bg = "#90EE90";
                                            }
                                            else if($SubID_2nd_2nd && $Remarks_ad_2nd_2nd == "FAILED")
                                            {
                                                $color_tr_bg = "#FFCCCB";
                                            }
                                            else
                                            {
                                                $color_tr_bg = "#F5F5F5";
                                            }
                                        }
                                        else
                                        {
                                            $color_tr_bg = "#F5F5F5";
                                        }
                            ?>
								<tr style="background: <?php echo $color_tr_bg?>">
									<td hidden><center><input type="checkbox" name="sub_list_id[]" value="<?php echo $SubID_2nd_2nd?>" class="check_2nd_sem_2nd"></center></td>
									<td hidden><center><?php echo $SubID_2nd_2nd ?></center></td>
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
                                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$Sub_subid_2nd_2nd' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                            $get_check = mysqli_query($connection,$checkprereq);
                                            $Rows = mysqli_fetch_array($get_check);
                                            $SubID = $Rows[0];
                                            
                                            if($SubID == 1)
                                            {
                                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$Sub_subid_2nd_2nd' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                                $checkpreq = mysqli_query($connection,$getpreq);
                                                foreach($checkpreq as $rows)
                                                {
                                                    $new = $rows['subject_id'];    
                                                }
                                                $getsubcode = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE student_id_fk='$Studid' and subject_id_fk='$new' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
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
                                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$Sub_subid_2nd_2nd' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                                foreach($getpreq as $rows)
                                                {
                                                    $news = $rows['subject_id'];    
                                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE student_id_fk='$Studid' and subject_id_fk='$news' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
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
                                        $select_at_advised_sub_2nd_2nd = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE id='$SubID_2nd_2nd' and student_id_fk='$Studid' and curr_id_fk='$Currid' and yearlevel='2' and semester='2nd' and course_id_fk='$curr_courseid'");
                                        if(mysqli_num_rows($select_at_advised_sub_2nd_2nd) > 0)
                                        {
                                            $re_ad_2nd_2nd = mysqli_fetch_array($select_at_advised_sub_2nd_2nd);
                                            $Grades_ad_2nd_2nd = $re_ad_2nd_2nd['grades'];
                                            $Remarks_ad_2nd_2nd = $re_ad_2nd_2nd['remarks'];
                                        }
                            ?>
                                                <td><center>
                                                    <div class="form-group show_2nd_grade_2nd">
                                                        <?php echo $Grades_ad_2nd_2nd; ?>
                                                    </div>
                                                    <div class="form-group hide_2nd_grade_2nd" style="width: 8rem; display: none;"> 
                                                        <select name="grades_<?=$SubID_2nd_2nd ?>" value="<?php echo $Grades_ad_2nd_2nd?>" class="form-control text-center">
                                                            <option value="0"><?php echo $Grades_ad_2nd_2nd?></option>
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
                                                <td ><center><?php echo $Remarks_ad_2nd_2nd ?></center></td>
                                            </tr>
                            <?php
                                    }				
                                }
                                $sum_units_2nd_2nd = "SELECT sum(units) FROM tblstudent_subject WHERE student_id_fk='$Studid' and curr_id_fk='$Currid' and yearlevel='2' and semester='2nd' and course_id_fk='$courseid'";
                                $units_check_2nd_2nd = mysqli_query($connection,$sum_units_2nd_2nd);
                                $units_total_2nd_2nd = mysqli_fetch_array($units_check_2nd_2nd);
                                $units_row_2nd_2nd = $units_total_2nd_2nd[0];

                                $get_total_grades_2nd_2nd = mysqli_query($connection,"SELECT total_grades FROM tblstudent_subject WHERE student_id_fk='$Studid' and total_grades in ('INC','DRP','FAILED','CREDITED') and curr_id_fk='$Currid' and yearlevel='2' and semester='2nd' and course_id_fk='$courseid'");
                                if(mysqli_num_rows($get_total_grades_2nd_2nd) > 0)
                                {
                                    $total_grade_units_2nd_2nd = '<span data-toggle="tooltip" data-placement="top" class="fas fa-ellipsis-h" title="Average not available due to missing grades/Failed grades/INC grades/Credited subjects."></span>'; 
                                }
                                else if(mysqli_num_rows($get_total_grades_2nd_2nd) == 0)
                                {
                                    $sum_stud_grade_2nd_2nd = "SELECT sum(total_grades) FROM tblstudent_subject WHERE student_id_fk='$Studid' and curr_id_fk='$Currid' and yearlevel='2' and semester='2nd' and course_id_fk='$courseid'";
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
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td></td>
                                        <td class="fw-bold"><center>Total:</center></td>
                                        <td></td>
                                        <td></td>
                                        <td class="fw-bold"><center><?php echo $units_row_2nd_2nd?></center></td>
                                        <td class="fw-bold"><center>Average: </center></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td class="fw-bold"><center><?php echo $total_grade_units_2nd_2nd?></center></td>
                                        <td></td>
                                    </tr>
								</tfoot>
							</table>
                            </form>
						</div>
                        <!-- 2nd Year Summer Semester -->
                        <div class="mt-2">
                            <form action="managedata.php" method="POST">
                                <input type="hidden" name="studid" value="<?php echo $Studid?>">
                                <input type="hidden" name="currid" value="<?php echo $Currid ?>">
                                <div class="row mb-2">
                                    <div class="col mt-2" align="left">
                                        <span class="text-uppercase fw-bold">Summer</span>
                                    </div>
                                    <div class="col" align="right">
                                        <button type="submit" name="but_update" id="button_update_2nd_summer" class="btn btn-success up_grade_button_2nd_summer" style="display: none;">Save</button>
                                    </div>
                                </div>
                            <?php
                                $check_2nd_subject_summer = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE student_id_fk='$Studid' and status='1' and curr_id_fk='$Currid' and course_id_fk='$courseid' and yearlevel='2' and semester='summer'");
                            ?>
							<table class="table table-striped" id="table2summersem" width="100%">
								<thead class="text-white">
									<tr>
                                        <th hidden></th>
                                        <th hidden><center>id</center></th>
                                        <th><center>Code</center></th>
                                        <th width="25%"><center>Title</center></th>
                                        <th ><center>Lec</center></th>
                                        <th ><center>Lab</center></th>
                                        <th ><center>Units</center></th>
                                        <th ><center>Prerequisite</center></th>
                                        <th hidden><center>year</center></th>
                                        <th hidden><center>semester</center></th>
                                        <th ><center>Grades</center></th>
                                        <th ><center>Remarks</center></th>
									</tr>
								</thead>
								<tbody>
                            <?php
                                if(mysqli_num_rows($check_2nd_subject_summer) > 0)
                                {
                                    while($fa = mysqli_fetch_array($check_2nd_subject_summer))
                                    {
                                        $SubID_2nd_summer = $fa['id'];
                                        $SubCode = $fa['subject_code'];
                                        $SubDes = $fa['description'];
                                        $SubLec = $fa['lec'];
                                        $SubLab = $fa['lab'];
                                        $SubUnits = $fa['units'];
                                        $SubPreq_2nd_summer = $fa['prerequisite'];
                                        $Sub_subid_2nd_summer = $fa['subject_id_fk'];

                                        $get_at_advised_sub_2nd_summer = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE id='$SubID_2nd_summer' and student_id_fk='$Studid' and curr_id_fk='$Currid' and yearlevel='2' and semester='summer' and course_id_fk='$curr_courseid'");
                                        if(mysqli_num_rows($get_at_advised_sub_2nd_summer) > 0)
                                        {
                                            while($re_ad = mysqli_fetch_array($get_at_advised_sub_2nd_summer))
                                            {
                                                $Grades_ad_2nd_summer = $re_ad['grades'];
                                                $Remarks_ad_2nd_summer = $re_ad['remarks'];
                                            }
                                            if($SubID_2nd_summer && $Grades_ad_2nd_summer == "INC" && $Remarks_ad_2nd_summer == "PASSED")
                                            {
                                                $color_tr_bg = "#FFFF66";
                                            }
                                            else if($SubID_2nd_summer && $Grades_ad_2nd_summer == "CREDITED" && $Remarks_ad_2nd_summer == "CREDITED")
                                            {
                                                $color_tr_bg = "#00FFFF";
                                            }
                                            else if($SubID_2nd_summer && $Remarks_ad_2nd_summer == "PASSED")
                                            {
                                                $color_tr_bg = "#90EE90";
                                            }
                                            else if($SubID_2nd_summer && $Remarks_ad_2nd_summer == "FAILED")
                                            {
                                                $color_tr_bg = "#FFCCCB";
                                            }
                                            else
                                            {
                                                $color_tr_bg = "#F5F5F5";
                                            }
                                        }
                                        else
                                        {
                                            $color_tr_bg = "#F5F5F5";
                                        }
                            ?>
								<tr style="background: <?php echo $color_tr_bg?>">
									<td><center><input type="checkbox" name="sub_list_id[]" value="<?php echo $SubID_2nd_summer?>" class="check_2nd_sem_summer"></center></td>
									<td hidden><center><?php echo $SubID_2nd_summer ?></center></td>
                                    <td><center><?php echo $SubCode ?></center></td>
									<td><center><?php echo $SubDes ?></center></td>
									<td><center><?php echo $SubLec ?></center></td>
									<td><center><?php echo $SubLab ?></center></td>
									<td><center><?php echo $SubUnits ?></center></td>
                            <?php
                                        if($SubPreq_2nd_summer == "NONE")
                                        {
                                            echo '<td><center>NONE</center></td>';
                                        }
                                        else if($SubPreq_2nd_summer == "HAVE")
                                        {              
                                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$Sub_subid_2nd_summer' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                            $get_check = mysqli_query($connection,$checkprereq);
                                            $Rows = mysqli_fetch_array($get_check);
                                            $SubID_2nd_summer = $Rows[0];
                                            
                                            if($SubID_2nd_summer == 1)
                                            {
                                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$Sub_subid_2nd_summer' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                                $checkpreq = mysqli_query($connection,$getpreq);
                                                foreach($checkpreq as $rows)
                                                {
                                                    $new = $rows['subject_id'];    
                                                }
                                                $getsubcode = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE student_id_fk='$Studid' and subject_id_fk='$new' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                                while($sa = mysqli_fetch_array($getsubcode))
                                                {
                                                    $subCode = $sa['subject_code'];
                                                }
                                                echo '<td><center>'.$subCode.'</center></td>';
                                            }
                                            else if($SubID_2nd_summer > 1)
                                            {
                            ?>
                                                <td><center>
                            <?php
                                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$Sub_subid_2nd_summer' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                                foreach($getpreq as $rows)
                                                {
                                                    $news = $rows['subject_id'];    
                                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE student_id_fk='$Studid' and subject_id_fk='$news' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
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
                                        $select_at_advised_sub_2nd_summer = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE id='$SubID_2nd_summer' and student_id_fk='$Studid' and curr_id_fk='$Currid' and yearlevel='2' and semester='summer' and course_id_fk='$curr_courseid'");
                                        if(mysqli_num_rows($select_at_advised_sub_2nd_summer) > 0)
                                        {
                                            $re_ad_2nd_summer = mysqli_fetch_array($select_at_advised_sub_2nd_summer);
                                            $Grades_ad_2nd_summer = $re_ad_2nd_summer['grades'];
                                            $Remarks_ad_2nd_summer = $re_ad_2nd_summer['remarks'];
                                        }
                            ?>
                                                <td><center>
                                                    <div class="form-group show_2nd_grade_summer">
                                                        <?php echo $Grades_ad_2nd_summer; ?>
                                                    </div>
                                                    <div class="form-group hide_2nd_grade_summer" style="width: 8rem; display: none;"> 
                                                        <select name="grades_<?=$SubID_2nd_summer ?>" value="<?php echo $Grades_ad_2nd_summer?>" class="form-control text-center">
                                                            <option value="0"><?php echo $Grades_ad_2nd_summer?></option>
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
                                                <td ><center><?php echo $Remarks_ad_2nd_summer ?></center></td>
                                            </tr>
                            <?php
                                    }				
                                }
                                $sum_units_2nd_summer = "SELECT sum(units) FROM tblstudent_subject WHERE student_id_fk='$Studid' and curr_id_fk='$Currid' and yearlevel='2' and semester='summer' and course_id_fk='$courseid'";
                                $units_check_2nd_summer = mysqli_query($connection,$sum_units_2nd_summer);
                                $units_total_2nd_summer = mysqli_fetch_array($units_check_2nd_summer);
                                $units_row_2nd_summer = $units_total_2nd_summer[0];

                                $get_total_grades_2nd_summer = mysqli_query($connection,"SELECT total_grades FROM tblstudent_subject WHERE student_id_fk='$Studid' and total_grades in ('INC','DRP','FAILED','CREDITED') and curr_id_fk='$Currid' and yearlevel='2' and semester='summer' and course_id_fk='$courseid'");
                                if(mysqli_num_rows($get_total_grades_2nd_summer) > 0)
                                {
                                    $total_grade_units_2nd_summer = '<span data-toggle="tooltip" data-placement="top" class="fas fa-ellipsis-h" title="Average not available due to missing grades/Failed grades/INC grades/Credited subjects."></span>'; 
                                }
                                else if(mysqli_num_rows($get_total_grades_2nd_summer) == 0)
                                {
                                    $sum_stud_grade_2nd_summer = "SELECT sum(total_grades) FROM tblstudent_subject WHERE student_id_fk='$Studid' and curr_id_fk='$Currid' and yearlevel='2' and semester='summer' and course_id_fk='$courseid'";
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
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td></td>
                                        <td class="fw-bold"><center>Total:</center></td>
                                        <td></td>
                                        <td></td>
                                        <td class="fw-bold"><center><?php echo $units_row_2nd_summer?></center></td>
                                        <td class="fw-bold"><center>Average: </center></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td class="fw-bold"><center><?php echo $total_grade_units_2nd_summer?></center></td>
                                        <td></td>
                                    </tr>
								</tfoot>
							</table>
                            </form>
						</div>
					</div>
                    <!-- 3rd Year and Semester Subjects -->
                    <div class="mb-4" id="thirdYear">
						<div class="mt-4 mb-3" align="right"></div>
                        <!-- 3rd Year 1st Semester -->
						<div class="border-bottom mb-2">
                            <form action="managedata.php" method="POST">
                                <input type="hidden" name="studid" value="<?php echo $Studid?>">
                                <input type="hidden" name="currid" value="<?php echo $Currid ?>">
                                <div class="row mb-2">
                                    <div class="col bg-secondary text-light" align="left">
                                        <div class="mt-2 mb-2">
                                            <span style="cursor: default;">Check to Update Grade Semester : </span>
                                        </div>
                                    </div>
                                    <div class="col bg-secondary text-light" align="right">
                                        <div class="mt-2 mb-2">
                                            <input type="checkbox" class="ml-2 mr-2 up_3rd_sem_1st" style="transform: scale(1.5); cursor: pointer;"><span style="cursor: default;">1st Semester</span>
                                            <input type="checkbox" class="ml-2 mr-2 up_3rd_sem_2nd" style="transform: scale(1.5); cursor: pointer;"><span style="cursor: default;">2nd Semester</span>
                                            <input type="checkbox" class="ml-2 mr-2 up_3rd_sem_summer" style=" transform: scale(1.5); cursor: pointer;"><span style="cursor: default;">Summer Semester</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col mt-2" align="left">
                                        <span class="text-uppercase fw-bold">1st Semester</span>
                                    </div>
                                    <div class="col" align="right">
                                        <button type="submit" name="but_update" id="button_update_3rd_1st" class="btn btn-success up_grade_button_3rd_1st" style="display: none;">Save</button>
                                    </div>
                                </div>
                            <?php
                                $check_3rd_subject_1st = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE student_id_fk='$Studid' and status='1' and curr_id_fk='$Currid' and course_id_fk='$courseid' and yearlevel='3' and semester='1st'");
                            ?>
							<table class="table table-striped" id="table31stsem" width="100%">
								<thead class="text-white">
									<tr>
                                        <th hidden></th>
                                        <th hidden><center>id</center></th>
                                        <th><center>Code</center></th>
                                        <th width="25%"><center>Title</center></th>
                                        <th ><center>Lec</center></th>
                                        <th ><center>Lab</center></th>
                                        <th ><center>Units</center></th>
                                        <th ><center>Prerequisite</center></th>
                                        <th hidden><center>year</center></th>
                                        <th hidden><center>semester</center></th>
                                        <th ><center>Grades</center></th>
                                        <th ><center>Remarks</center></th>
									</tr>
								</thead>
								<tbody>
                            <?php
                            if(mysqli_num_rows($check_3rd_subject_1st) > 0)
                            {
                                while($fa = mysqli_fetch_array($check_3rd_subject_1st))
                                {
                                    $SubID_3rd_1st = $fa['id'];
                                    $SubCode = $fa['subject_code'];
                                    $SubDes = $fa['description'];
                                    $SubLec = $fa['lec'];
                                    $SubLab = $fa['lab'];
                                    $SubUnits = $fa['units'];
                                    $SubPreq = $fa['prerequisite'];
                                    $Sub_subid_3rd_1st = $fa['subject_id_fk'];

                                    $get_at_advised_sub_3rd_1st = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE id='$SubID_3rd_1st' and student_id_fk='$Studid' and curr_id_fk='$Currid' and yearlevel='3' and semester='1st' and course_id_fk='$curr_courseid'");
                                    if(mysqli_num_rows($get_at_advised_sub_3rd_1st) > 0)
                                    {
                                        while($re_ad = mysqli_fetch_array($get_at_advised_sub_3rd_1st))
                                        {
                                            $Grades_ad_3rd_1st = $re_ad['grades'];
                                            $Remarks_ad_3rd_1st = $re_ad['remarks'];
                                        }
                                        if($SubID_3rd_1st && $Grades_ad_3rd_1st == "INC" && $Remarks_ad_3rd_1st == "PASSED")
                                        {
                                            $color_tr_bg = "#FFFF66";
                                        }
                                        else if($SubID_3rd_1st && $Grades_ad_3rd_1st == "CREDITED" && $Remarks_ad_3rd_1st == "CREDITED")
                                        {
                                            $color_tr_bg = "#00FFFF";
                                        }
                                        else if($SubID_3rd_1st && $Remarks_ad_3rd_1st == "PASSED")
                                        {
                                            $color_tr_bg = "#90EE90";
                                        }
                                        else if($SubID_3rd_1st && $Remarks_ad_3rd_1st == "FAILED")
                                        {
                                            $color_tr_bg = "#F08080";
                                        }
                                        else
                                        {
                                            $color_tr_bg = "#F5F5F5";
                                        }
                                    }
                                    else
                                    {
                                        $color_tr_bg = "#F5F5F5";
                                    }
                            ?>
								<tr style="background: <?php echo $color_tr_bg?>">
                                    <td hidden><center><input type="checkbox" name="sub_list_id[]" value="<?php echo $SubID_3rd_1st?>" class="check_3rd_sem_1st"></center></td>
                                    <td hidden><center><?php echo $SubID_3rd_1st ?></center></td>
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
                                        $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$Sub_subid_3rd_1st' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                        $get_check = mysqli_query($connection,$checkprereq);
                                        $Rows = mysqli_fetch_array($get_check);
                                        $SubID = $Rows[0];
                                                        
                                        if($SubID == 1)
                                        {
                                            $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$Sub_subid_3rd_1st' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                            $checkpreq = mysqli_query($connection,$getpreq);
                                            foreach($checkpreq as $rows)
                                            {
                                                $new = $rows['subject_id'];    
                                            }
                                            $getsubcode = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE student_id_fk='$Studid' and subject_id_fk='$new' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
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
                                            $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$Sub_subid_3rd_1st' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                            foreach($getpreq as $rows)
                                            {
                                                $news = $rows['subject_id'];     
                                                $getsubcode = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE student_id_fk='$Studid' and subject_id_fk='$news' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
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
                                    $select_at_advised_sub_3rd_1st = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE id='$SubID_3rd_1st' and student_id_fk='$Studid' and curr_id_fk='$Currid' and yearlevel='3' and semester='1st' and course_id_fk='$curr_courseid'");
                                    if(mysqli_num_rows($select_at_advised_sub_3rd_1st) > 0)
                                    {
                                        $re_ad_3rd_1st = mysqli_fetch_array($select_at_advised_sub_3rd_1st);
                                        $Grades_ad_3rd_1st = $re_ad_3rd_1st['grades'];
                                        $Remarks_ad_3rd_1st = $re_ad_3rd_1st['remarks'];
                                    }
                            ?>
                                        <td><center>
                                            <div class="form-group show_3rd_grade_1st">
                                                <?php echo $Grades_ad_3rd_1st; ?>
                                            </div>
                                            <div class="form-group hide_3rd_grade_1st" style="width: 8rem; display: none;">
                                                <select name="grades_<?=$SubID_3rd_1st ?>" value="<?php echo $Grades_ad_3rd_1st?>" class="form-control text-center">
                                                    <option value="0"><?php echo $Grades_ad_3rd_1st?></option>
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
                                        <td ><center><?php echo $Remarks_ad_3rd_1st ?></center></td>
                                </tr>
                            <?php
                                }				
                            }
                            $sum_units_3rd_1st = "SELECT sum(units) FROM tblstudent_subject WHERE student_id_fk='$Studid' and curr_id_fk='$Currid' and yearlevel='3' and semester='1st' and course_id_fk='$courseid'";
                            $units_check_3rd_1st = mysqli_query($connection,$sum_units_3rd_1st);
                            $units_total_3rd_1st = mysqli_fetch_array($units_check_3rd_1st);
                            $units_row_3rd_1st = $units_total_3rd_1st[0];

                            $get_total_grades_3rd_1st = mysqli_query($connection,"SELECT total_grades FROM tblstudent_subject WHERE student_id_fk='$Studid' and total_grades in ('INC','DRP','FAILED','CREDITED') and curr_id_fk='$Currid' and yearlevel='3' and semester='1st' and course_id_fk='$courseid'");
                            if(mysqli_num_rows($get_total_grades_3rd_1st) > 0)
                            {
                                $total_grade_units_3rd_1st = '<span data-toggle="tooltip" data-placement="top" class="fas fa-ellipsis-h" title="Average not available due to missing grades/Failed grades/INC grades/Credited subjects."></span>'; 
                            }
                            else if(mysqli_num_rows($get_total_grades_3rd_1st) == 0)
                            {
                                $sum_stud_grade_3rd_1st = "SELECT sum(total_grades) FROM tblstudent_subject WHERE student_id_fk='$Studid' and curr_id_fk='$Currid' and yearlevel='3' and semester='1st' and course_id_fk='$courseid'";
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
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td></td>
                                        <td class="fw-bold"><center>Total:</center></td>
                                        <td></td>
                                        <td></td>
                                        <td class="fw-bold"><center><?php echo $units_row_3rd_1st?></center></td>
                                        <td class="fw-bold"><center>Average: </center></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td class="fw-bold"><center><?php echo $total_grade_units_3rd_1st?></center></td>
                                        <td></td>
                                    </tr>
								</tfoot>
							</table>
                            </form>
						</div>
                        <!-- 3rd Year 2nd Semester -->
						<div class="mt-2">
                            <form action="managedata.php" method="POST">
                                <input type="hidden" name="studid" value="<?php echo $Studid?>">
                                <input type="hidden" name="currid" value="<?php echo $Currid ?>">
                                <div class="row mb-2">
                                    <div class="col mt-2" align="left">
                                        <span class="text-uppercase fw-bold">2nd Semester</span>
                                    </div>
                                    <div class="col" align="right">
                                        <button type="submit" name="but_update" id="button_update_3rd_2nd" class="btn btn-success up_grade_button_3rd_2nd" style="display: none;">Save</button>
                                    </div>
                                </div>
                            <?php
                                $check_3rd_subject_2nd = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE student_id_fk='$Studid' and status='1' and curr_id_fk='$Currid' and course_id_fk='$courseid' and yearlevel='3' and semester='2nd'");
                            ?>
							<table class="table table-striped" id="table32ndsem" width="100%">
								<thead class="text-white">
									<tr>
                                        <th hidden></th>
                                        <th hidden><center>id</center></th>
                                        <th><center>Code</center></th>
                                        <th width="25%"><center>Title</center></th>
                                        <th ><center>Lec</center></th>
                                        <th ><center>Lab</center></th>
                                        <th ><center>Units</center></th>
                                        <th ><center>Prerequisite</center></th>
                                        <th hidden><center>year</center></th>
                                        <th hidden><center>semester</center></th>
                                        <th ><center>Grades</center></th>
                                        <th ><center>Remarks</center></th>
									</tr>
								</thead>
								<tbody>
                            <?php
                                if(mysqli_num_rows($check_3rd_subject_2nd) > 0)
                                {
                                    while($fa = mysqli_fetch_array($check_3rd_subject_2nd))
                                    {
                                        $SubID_3rd_2nd = $fa['id'];
                                        $SubCode = $fa['subject_code'];
                                        $SubDes = $fa['description'];
                                        $SubLec = $fa['lec'];
                                        $SubLab = $fa['lab'];
                                        $SubUnits = $fa['units'];
                                        $SubPreq = $fa['prerequisite'];
                                        $Sub_subid_3rd_2nd = $fa['subject_id_fk'];

                                        $get_at_advised_sub_3rd_2nd = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE id='$SubID_3rd_2nd' and student_id_fk='$Studid' and curr_id_fk='$Currid' and yearlevel='3' and semester='2nd' and course_id_fk='$curr_courseid'");
                                        if(mysqli_num_rows($get_at_advised_sub_3rd_2nd) > 0)
                                        {
                                            while($re_ad = mysqli_fetch_array($get_at_advised_sub_3rd_2nd))
                                            {
                                                $Grades_ad_3rd_2nd = $re_ad['grades'];
                                                $Remarks_ad_3rd_2nd = $re_ad['remarks'];
                                            }
                                            if($SubID_3rd_2nd && $Grades_ad_3rd_2nd == "INC" && $Remarks_ad_3rd_2nd == "PASSED")
                                            {
                                                $color_tr_bg = "#FFFF66";
                                            }
                                            else if($SubID_3rd_2nd && $Grades_ad_3rd_2nd == "CREDITED" && $Remarks_ad_3rd_2nd == "CREDITED")
                                            {
                                                $color_tr_bg = "#00FFFF";
                                            }
                                            else if($SubID_3rd_2nd && $Remarks_ad_3rd_2nd == "PASSED")
                                            {
                                                $color_tr_bg = "#90EE90";
                                            }
                                            else if($SubID_3rd_2nd && $Remarks_ad_3rd_2nd == "FAILED")
                                            {
                                                $color_tr_bg = "#FFCCCB";
                                            }
                                            else
                                            {
                                                $color_tr_bg = "#F5F5F5";
                                            }
                                        }
                                        else
                                        {
                                            $color_tr_bg = "#F5F5F5";
                                        }
                            ?>
								<tr style="background: <?php echo $color_tr_bg?>">
									<td hidden><center><input type="checkbox" name="sub_list_id[]" value="<?php echo $SubID_3rd_2nd?>" class="check_3rd_sem_2nd"></center></td>
									<td hidden><center><?php echo $SubID_3rd_2nd ?></center></td>
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
                                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$Sub_subid_3rd_2nd' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                            $get_check = mysqli_query($connection,$checkprereq);
                                            $Rows = mysqli_fetch_array($get_check);
                                            $SubID = $Rows[0];
                                            
                                            if($SubID == 1)
                                            {
                                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$Sub_subid_3rd_2nd' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                                $checkpreq = mysqli_query($connection,$getpreq);
                                                foreach($checkpreq as $rows)
                                                {
                                                    $new = $rows['subject_id'];    
                                                }
                                                $getsubcode = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE student_id_fk='$Studid' and subject_id_fk='$new' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
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
                                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$Sub_subid_3rd_2nd' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                                foreach($getpreq as $rows)
                                                {
                                                    $news = $rows['subject_id'];    
                                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE student_id_fk='$Studid' and subject_id_fk='$news' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
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
                                        $select_at_advised_sub_3rd_2nd = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE id='$SubID_3rd_2nd' and student_id_fk='$Studid' and curr_id_fk='$Currid' and yearlevel='3' and semester='2nd' and course_id_fk='$curr_courseid'");
                                        if(mysqli_num_rows($select_at_advised_sub_3rd_2nd) > 0)
                                        {
                                            $re_ad_3rd_2nd = mysqli_fetch_array($select_at_advised_sub_3rd_2nd);
                                            $Grades_ad_3rd_2nd = $re_ad_3rd_2nd['grades'];
                                            $Remarks_ad_3rd_2nd = $re_ad_3rd_2nd['remarks'];
                                        }
                            ?>
                                                <td><center>
                                                    <div class="form-group show_3rd_grade_2nd">
                                                        <?php echo $Grades_ad_3rd_2nd; ?>
                                                    </div>
                                                    <div class="form-group hide_3rd_grade_2nd" style="width: 8rem; display: none;"> 
                                                        <select name="grades_<?=$SubID_3rd_2nd ?>" value="<?php echo $Grades_ad_3rd_2nd?>" class="form-control text-center">
                                                            <option value="0"><?php echo $Grades_ad_3rd_2nd?></option>
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
                                                <td ><center><?php echo $Remarks_ad_3rd_2nd ?></center></td>
                                            </tr>
                            <?php
                                    }				
                                }
                                $sum_units_3rd_2nd = "SELECT sum(units) FROM tblstudent_subject WHERE student_id_fk='$Studid' and curr_id_fk='$Currid' and yearlevel='3' and semester='2nd' and course_id_fk='$courseid'";
                                $units_check_3rd_2nd = mysqli_query($connection,$sum_units_3rd_2nd);
                                $units_total_3rd_2nd = mysqli_fetch_array($units_check_3rd_2nd);
                                $units_row_3rd_2nd = $units_total_3rd_2nd[0];

                                $get_total_grades_3rd_2nd = mysqli_query($connection,"SELECT total_grades FROM tblstudent_subject WHERE student_id_fk='$Studid' and total_grades in ('INC','DRP','FAILED','CREDITED') and curr_id_fk='$Currid' and yearlevel='3' and semester='2nd' and course_id_fk='$courseid'");
                                if(mysqli_num_rows($get_total_grades_3rd_2nd) > 0)
                                {
                                    $total_grade_units_3rd_2nd = '<span data-toggle="tooltip" data-placement="top" class="fas fa-ellipsis-h" title="Average not available due to missing grades/Failed grades/INC grades/Credited subjects."></span>'; 
                                }
                                else if(mysqli_num_rows($get_total_grades_3rd_2nd) == 0)
                                {
                                    $sum_stud_grade_3rd_2nd = "SELECT sum(total_grades) FROM tblstudent_subject WHERE student_id_fk='$Studid' and curr_id_fk='$Currid' and yearlevel='3' and semester='2nd' and course_id_fk='$courseid'";
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
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td></td>
                                        <td class="fw-bold"><center>Total:</center></td>
                                        <td></td>
                                        <td></td>
                                        <td class="fw-bold"><center><?php echo $units_row_3rd_2nd?></center></td>
                                        <td class="fw-bold"><center>Average: </center></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td class="fw-bold"><center><?php echo $total_grade_units_3rd_2nd?></center></td>
                                        <td></td>
                                    </tr>
								</tfoot>
							</table>
                            </form>
						</div>
                        <!-- 3rd Year Summer Semester -->
                        <div class="mt-2">
                            <form action="managedata.php" method="POST">
                                <input type="hidden" name="studid" value="<?php echo $Studid?>">
                                <input type="hidden" name="currid" value="<?php echo $Currid ?>">
                                <div class="row mb-2">
                                    <div class="col mt-2" align="left">
                                        <span class="text-uppercase fw-bold">Summer</span>
                                    </div>
                                    <div class="col" align="right">
                                        <button type="submit" name="but_update" id="button_update_3rd_summer" class="btn btn-success up_grade_button_3rd_summer" style="display: none;">Save</button>
                                    </div>
                                </div>
                            <?php
                                $check_3rd_subject_summer = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE student_id_fk='$Studid' and status='1' and curr_id_fk='$Currid' and course_id_fk='$courseid' and yearlevel='3' and semester='summer'");
                            ?>
							<table class="table table-striped" id="table3summersem" width="100%">
								<thead class="text-white">
									<tr>
                                        <th hidden></th>
                                        <th hidden><center>id</center></th>
                                        <th><center>Code</center></th>
                                        <th width="25%"><center>Title</center></th>
                                        <th ><center>Lec</center></th>
                                        <th ><center>Lab</center></th>
                                        <th ><center>Units</center></th>
                                        <th ><center>Prerequisite</center></th>
                                        <th hidden><center>year</center></th>
                                        <th hidden><center>semester</center></th>
                                        <th ><center>Grades</center></th>
                                        <th ><center>Remarks</center></th>
									</tr>
								</thead>
								<tbody>
                            <?php
                                if(mysqli_num_rows($check_3rd_subject_summer) > 0)
                                {
                                    while($fa = mysqli_fetch_array($check_3rd_subject_summer))
                                    {
                                        $SubID_3rd_summer = $fa['id'];
                                        $SubCode = $fa['subject_code'];
                                        $SubDes = $fa['description'];
                                        $SubLec = $fa['lec'];
                                        $SubLab = $fa['lab'];
                                        $SubUnits = $fa['units'];
                                        $SubPreq_3rd_summer = $fa['prerequisite'];
                                        $Sub_subid_3rd_summer = $fa['subject_id_fk'];

                                        $get_at_advised_sub_3rd_summer = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE id='$SubID_3rd_summer' and student_id_fk='$Studid' and curr_id_fk='$Currid' and yearlevel='3' and semester='summer' and course_id_fk='$curr_courseid'");
                                        if(mysqli_num_rows($get_at_advised_sub_3rd_summer) > 0)
                                        {
                                            while($re_ad = mysqli_fetch_array($get_at_advised_sub_3rd_summer))
                                            {
                                                $Grades_ad_3rd_summer = $re_ad['grades'];
                                                $Remarks_ad_3rd_summer = $re_ad['remarks'];
                                            }
                                            if($SubID_3rd_summer && $Grades_ad_3rd_summer == "INC" && $Remarks_ad_3rd_summer == "PASSED")
                                            {
                                                $color_tr_bg = "#FFFF66";
                                            }
                                            else if($SubID_3rd_summer && $Grades_ad_3rd_summer == "CREDITED" && $Remarks_ad_3rd_summer == "CREDITED")
                                            {
                                                $color_tr_bg = "#00FFFF";
                                            }
                                            else if($SubID_3rd_summer && $Remarks_ad_3rd_summer == "PASSED")
                                            {
                                                $color_tr_bg = "#90EE90";
                                            }
                                            else if($SubID_3rd_summer && $Remarks_ad_3rd_summer == "FAILED")
                                            {
                                                $color_tr_bg = "#FFCCCB";
                                            }
                                            else
                                            {
                                                $color_tr_bg = "#F5F5F5";
                                            }
                                        }
                                        else
                                        {
                                            $color_tr_bg = "#F5F5F5";
                                        }
                            ?>
								<tr style="background: <?php echo $color_tr_bg?>">
									<td hidden><center><input type="checkbox" name="sub_list_id[]" value="<?php echo $SubID_3rd_summer?>" class="check_3rd_sem_summer"></center></td>
									<td hidden><center><?php echo $SubID_3rd_summer ?></center></td>
                                    <td><center><?php echo $SubCode ?></center></td>
									<td><center><?php echo $SubDes ?></center></td>
									<td><center><?php echo $SubLec ?></center></td>
									<td><center><?php echo $SubLab ?></center></td>
									<td><center><?php echo $SubUnits ?></center></td>
                            <?php
                                        if($SubPreq_3rd_summer == "NONE")
                                        {
                                            echo '<td><center>NONE</center></td>';
                                        }
                                        else if($SubPreq_3rd_summer == "HAVE")
                                        {              
                                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$Sub_subid_3rd_summer' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                            $get_check = mysqli_query($connection,$checkprereq);
                                            $Rows = mysqli_fetch_array($get_check);
                                            $SubID_3rd_summer = $Rows[0];
                                            
                                            if($SubID_3rd_summer == 1)
                                            {
                                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$Sub_subid_3rd_summer' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'";
                                                $checkpreq = mysqli_query($connection,$getpreq);
                                                foreach($checkpreq as $rows)
                                                {
                                                    $new = $rows['subject_id'];    
                                                }
                                                $getsubcode = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE student_id_fk='$Studid' and subject_id_fk='$new' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                                while($sa = mysqli_fetch_array($getsubcode))
                                                {
                                                    $subCode = $sa['subject_code'];
                                                }
                                                echo '<td><center>'.$subCode.'</center></td>';
                                            }
                                            else if($SubID_3rd_summer > 1)
                                            {
                            ?>
                                                <td><center>
                            <?php
                                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$Sub_subid_3rd_summer' and curri_id_fk='$Currid' and course_id_fk='$curr_courseid'");
                                                foreach($getpreq as $rows)
                                                {
                                                    $news = $rows['subject_id'];    
                                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE student_id_fk='$Studid' and subject_id_fk='$news' and curr_id_fk='$Currid' and course_id_fk='$curr_courseid'");
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
                                        $select_at_advised_sub_3rd_summer = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE id='$SubID_3rd_summer' and student_id_fk='$Studid' and curr_id_fk='$Currid' and yearlevel='3' and semester='summer' and course_id_fk='$curr_courseid'");
                                        if(mysqli_num_rows($select_at_advised_sub_3rd_summer) > 0)
                                        {
                                            $re_ad_3rd_summer = mysqli_fetch_array($select_at_advised_sub_3rd_summer);
                                            $Grades_ad_3rd_summer = $re_ad_3rd_summer['grades'];
                                            $Remarks_ad_3rd_summer = $re_ad_3rd_summer['remarks'];
                                        }
                            ?>
                                                <td><center>
                                                    <div class="form-group show_3rd_grade_summer">
                                                        <?php echo $Grades_ad_3rd_summer; ?>
                                                    </div>
                                                    <div class="form-group hide_3rd_grade_summer" style="width: 8rem; display: none;"> 
                                                        <select name="grades_<?=$SubID_3rd_summer ?>" value="<?php echo $Grades_ad_3rd_summer?>" class="form-control text-center">
                                                            <option value="0"><?php echo $Grades_ad_3rd_summer?></option>
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
                                                <td ><center><?php echo $Remarks_ad_3rd_summer ?></center></td>
                                            </tr>
                            <?php
                                    }				
                                }
                                $sum_units_3rd_summer = "SELECT sum(units) FROM tblstudent_subject WHERE student_id_fk='$Studid' and curr_id_fk='$Currid' and yearlevel='3' and semester='summer' and course_id_fk='$courseid'";
                                $units_check_3rd_summer = mysqli_query($connection,$sum_units_3rd_summer);
                                $units_total_3rd_summer = mysqli_fetch_array($units_check_3rd_summer);
                                $units_row_3rd_summer = $units_total_3rd_summer[0];

                                $get_total_grades_3rd_summer = mysqli_query($connection,"SELECT total_grades FROM tblstudent_subject WHERE student_id_fk='$Studid' and total_grades in ('INC','DRP','FAILED','CREDITED') and curr_id_fk='$Currid' and yearlevel='3' and semester='summer' and course_id_fk='$courseid'");
                                if(mysqli_num_rows($get_total_grades_3rd_summer) > 0)
                                {
                                    $total_grade_units_3rd_summer = '<span data-toggle="tooltip" data-placement="top" class="fas fa-ellipsis-h" title="Average not available due to missing grades/Failed grades/INC grades/Credited subjects."></span>'; 
                                }
                                else if(mysqli_num_rows($get_total_grades_3rd_summer) == 0)
                                {
                                    $sum_stud_grade_3rd_summer = "SELECT sum(total_grades) FROM tblstudent_subject WHERE student_id_fk='$Studid' and curr_id_fk='$Currid' and yearlevel='3' and semester='summer' and course_id_fk='$courseid'";
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
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td></td>
                                        <td class="fw-bold"><center>Total:</center></td>
                                        <td></td>
                                        <td></td>
                                        <td class="fw-bold"><center><?php echo $units_row_3rd_summer?></center></td>
                                        <td class="fw-bold"><center>Average: </center></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td class="fw-bold"><center><?php echo $total_grade_units_3rd_summer?></center></td>
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

        <!-- ADD CREDITED SUBJECT MODAL -->
        <div class="container container-fluid">
            <div class="modal fade" id="addSubjectsmodal" tabindex="-1" role="dialog" aria-labelledby="addSubjectsLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document" style="max-width: 1380px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold" id="addSubjectsLabel">Add Credited Subject For Student</h5>
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
                                        <th ><center>Remarks</center></th>
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

                                    $check_send_subid = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE adviser_id_fk='$adminid' and student_id='$Studid' and subject_id_fk='$subjectID' and curri_id='$Currid' and course_id_fk='$courseid'");
                                    while($k=mysqli_fetch_array($check_send_subid))
                                    {
                                        $Send_subID = $k['subject_id_fk'];
                                        $Send_remarks = $k['remarks'];
                                    }
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
                        <?php
                                    if(mysqli_num_rows($check_send_subid) == 0)
                                    {
                        ?>
                                        <td><center>Not Yet Taken</center></td>
                        <?php
                                    }
                                    else
                                    {
                        ?>
                                        <td><center><?php echo $Send_remarks?></center></td>
                        <?php
                                    }
                        ?>
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

                            <div class="modal-footer" align="right">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Closed</button>
                                <button type="submit" name="create_sub" id="button" class="btn btn-success" style="display: none;">Add Subject</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ADD CREDITED SUBJECT END -->

        <!-- Start View Send A subject to student -->
        <div class="container container-fluid">
            <div class="modal fade" id="viewSendSubjectModal" tabindex="-1" role="dialog" aria-labelledby="addSubjectsLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document" style="max-width: 1280px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold" id="addSubjectsLabel">Sended A Subject To A Student</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
            <?php
                $select_sub = mysqli_query($connection,"SELECT * FROM tbladviser_send_sub_to_stud WHERE status='Currently Enrolled' and adviser_id_fk='$adminid' and student_id_fk='$Studid' and curri_id_fk='$Currid'");
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
                                        <th hidden><center>School Year</center></th>
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

                        $select_subj = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE id='$SubID'");
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
                                        <td hidden><center><?php echo $SY?></center></td>
                                    </tr>
            <?php
                    }
                }
                $select_units = "SELECT sum(units) FROM tbladviser_send_sub_to_stud WHERE status='Currently Enrolled' and adviser_id_fk='$adminid' and student_id_fk='$Studid' and curri_id_fk='$Currid' and course_id_fk='$courseid'";
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
                                        <td hidden></td>
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
    <script src="../../source/js/adviser-loadsubjects.js"></script>

	<?php
		include("../../source/includes/alertmessage.php");
	?> 
<?php
	}
	else
	{
		header("location: ../../signin/universal-signin.php");
	}
?>
</body>
</html>
