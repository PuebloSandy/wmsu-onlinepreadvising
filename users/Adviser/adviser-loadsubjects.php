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
                </div>
                <div class="col mt-2 mb-2" align="right">
                    <button type="button" class="btn rounded btn-info p-2 fas fa-list" title="Subject" id="viewSubjects" data-toggle="modal" data-target="#viewSubject"> Curriculum Student Subjects</button>
                    <button type="button" data-toggle="modal" data-target="#addSubjectsmodal" class="btn rounded btn-success p-2 fas fa-clipboard" title="Add Subject"> Add Credited Subjects</button>
                </div>
            </div>
			<p class="text mt-3 text-uppercase text-danger fw-bold text-center fs-2" style="cursor: default;"><?php echo $code?> Student of PreAdvised Subjects</p>
            <p class="text text-uppercase text-danger fw-bold text-center fs-4" style="cursor: default;"><?php echo $full.' - '.$currCode?></p>
        
            <!-- TABLE -->
            <div class="container p-2 container-fluid mb-3" >
                <div class="container overflow-auto" >
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
                    <div class="row mb-2">
                        <span class="fw-bold text-uppercase text-danger text-center fs-3">Curriculum Year Subjects</span>
                    </div>
                    <div class="row border-top border-bottom mb-2">
                        <div class="col text-center">
                            <a id="tab1" class="btn my-4 border border-danger fw-bold fs-5" data-toggle="modal" data-target="#view1stYearListSubject">First Year</a>
                        </div>
                        <div class="col text-center">
                            <a id="tab2" class="btn my-4 border border-danger fw-bold fs-5" data-toggle="modal" data-target="#view2ndYearListSubject">Second Year</a>
                        </div>
                        <div class="col text-center">
                            <a id="tab3" class="btn my-4 border border-danger fw-bold fs-5" data-toggle="modal" data-target="#view3rdYearListSubject">Third Year</a>
                        </div>
                        <div class="col text-center">
                            <a id="tab4" class="btn my-4 border border-danger fw-bold text-center fs-5" data-toggle="modal" data-target="#view4thYearListSubject">Fourth Year</a>
                        </div>
                        <div class="col text-center">
                            <a id="tab5" class="btn my-4 border border-danger fw-bold text-center fs-5" data-toggle="modal" data-target="#view5thYearListSubject">Fifth Year</a>
                        </div>
                        <div class="w-100"></div>
                    </div>

                    <!-- Start 1st Year Semester Subjects Modal -->
                    <div class="container container-fluid">
                        <div class="modal fade" id="view1stYearListSubject" tabindex="-1" role="dialog" aria-labelledby="manage-requestLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document" style="max-width: 1380px;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title fw-bold text-uppercase" id="manage-requestLabel">Curriculum Subjects</h5>
                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <!-- 1st Year Subjects -->
                                        <div class="border-top mt-2">
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
                                                        <th width="10px"><center>Title</center></th>
                                                        <th scope="col"><center>Lec Hrs</center></th>
                                                        <th scope="col"><center>Lab Hrs</center></th>
                                                        <th scope="col"><center>Units</center></th>
                                                        <th scope="col"><center>Prerequisite</center></th>
                                                        <th hidden><center>Semester</center></th>
                                                        <th hidden><center>Year</center></th>
                                                        <th ><center>Status</center></th>
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
                        <?php
                            $check_sub_status_1st_1st = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE subject_id_fk='$subjectid_save' and student_id='$Studid' and curri_id='$Currid' and yearlevel='1' and semester='1st' and course_id_fk='$curr_courseid'");
                            while($d=mysqli_fetch_array($check_sub_status_1st_1st))
                            {
                                $re_check_1st_1st = $d['remarks'];
                            }
                            if(mysqli_num_rows($check_sub_status_1st_1st) == 0)
                            {
                        ?>
                                <td><center>Not Yet Taken</center></td>
                        <?php
                            }
                            else
                            {
                        ?>
                                <td><center><?php echo $re_check_1st_1st ?></center></td>
                        <?php
                            }
                        ?>
                                </tr>
                        <?php
                                }
                            }
                            $lec_units_1st_1st = "SELECT sum(lec) FROM tblsubject WHERE curr_id_fk='$Currid' and yearlevel='1' and semester='1st' and course_id_fk='$courseid'";
                            $lab_units_1st_1st = "SELECT sum(lab) FROM tblsubject WHERE curr_id_fk='$Currid' and yearlevel='1' and semester='1st' and course_id_fk='$courseid'";
                            $sum_units_1st_1st = "SELECT sum(units) FROM tblsubject WHERE curr_id_fk='$Currid' and yearlevel='1' and semester='1st' and course_id_fk='$courseid'";
                            $units_check_lec_1st_1st = mysqli_query($connection,$lec_units_1st_1st);
                            $units_check_lab_1st_1st = mysqli_query($connection,$lab_units_1st_1st);
                            $units_check_units_1st_1st = mysqli_query($connection,$sum_units_1st_1st);
                            $units_total_lec_1st_1st = mysqli_fetch_array($units_check_lec_1st_1st);
                            $units_total_lab_1st_1st = mysqli_fetch_array($units_check_lab_1st_1st);
                            $units_total_units_1st_1st = mysqli_fetch_array($units_check_units_1st_1st);
                            $units_row_lec_1st_1st = $units_total_lec_1st_1st[0];
                            $units_row_lab_1st_1st = $units_total_lab_1st_1st[0];
                            $units_row_units_1st_1st = $units_total_units_1st_1st[0];
                        ?>
                                                    </tbody>
                                                    <tfoot >	
                                                        <!-- table footer -->
                                                        <tr>
                                                            <td></td>
                                                            <td class="text-center" ><b>TOTAL</b></td>
                                                            <td><center><?php echo $units_row_lec_1st_1st?></center></td>
                                                            <td><center><?php echo $units_row_lab_1st_1st ?></center></td>
                                                            <td><center><?php echo $units_row_units_1st_1st ?></center></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>

                                                <div class="text-uppercase fw-bold mt-3 mb-2">
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
                                                        <th width="10px"><center>Title</center></th>
                                                        <th scope="col"><center>Lec Hrs</center></th>
                                                        <th scope="col"><center>Lab Hrs</center></th>
                                                        <th scope="col"><center>Units</center></th>
                                                        <th scope="col"><center>Prerequisite</center></th>
                                                        <th hidden><center>Semester</center></th>
                                                        <th hidden><center>Year</center></th>
                                                        <th ><center>Status</center></th>
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
                        <?php
                            $check_sub_status_1st_2nd = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE subject_id_fk='$subjectid_save' and student_id='$Studid' and curri_id='$Currid' and yearlevel='1' and semester='2nd' and course_id_fk='$curr_courseid'");
                            while($d=mysqli_fetch_array($check_sub_status_1st_2nd))
                            {
                                $re_check_1st_2nd = $d['remarks'];
                            }
                            if(mysqli_num_rows($check_sub_status_1st_2nd) == 0)
                            {
                        ?>
                                <td><center>Not Yet Taken</center></td>
                        <?php
                            }
                            else
                            {
                        ?>
                                <td><center><?php echo $re_check_1st_2nd ?></center></td>
                        <?php
                            }
                        ?>
                                </tr>
                        <?php
                                }
                            }
                            $lec_units_1st_2nd = "SELECT sum(lec) FROM tblsubject WHERE curr_id_fk='$Currid' and yearlevel='1' and semester='2nd' and course_id_fk='$courseid'";
                            $lab_units_1st_2nd = "SELECT sum(lab) FROM tblsubject WHERE curr_id_fk='$Currid' and yearlevel='1' and semester='2nd' and course_id_fk='$courseid'";
                            $sum_units_1st_2nd = "SELECT sum(units) FROM tblsubject WHERE curr_id_fk='$Currid' and yearlevel='1' and semester='2nd' and course_id_fk='$courseid'";
                            $units_check_lec_1st_2nd = mysqli_query($connection,$lec_units_1st_2nd);
                            $units_check_lab_1st_2nd = mysqli_query($connection,$lab_units_1st_2nd);
                            $units_check_units_1st_2nd = mysqli_query($connection,$sum_units_1st_2nd);
                            $units_total_lec_1st_2nd = mysqli_fetch_array($units_check_lec_1st_2nd);
                            $units_total_lab_1st_2nd = mysqli_fetch_array($units_check_lab_1st_2nd);
                            $units_total_units_1st_2nd = mysqli_fetch_array($units_check_units_1st_2nd);
                            $units_row_lec_1st_2nd = $units_total_lec_1st_2nd[0];
                            $units_row_lab_1st_2nd = $units_total_lab_1st_2nd[0];
                            $units_row_units_1st_2nd = $units_total_units_1st_2nd[0];
                        ?>
                                                    </tbody>
                                                    <tfoot >	
                                                        <!-- table footer -->
                                                        <tr>
                                                            <td></td>
                                                            <td class="text-center" ><b>TOTAL</b></td>
                                                            <td><center><?php echo $units_row_lec_1st_2nd?></center></td>
                                                            <td><center><?php echo $units_row_lab_1st_2nd ?></center></td>
                                                            <td><center><?php echo $units_row_units_1st_2nd ?></center></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
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
                                                        <th width="10px"<center>Title</center></th>
                                                        <th scope="col"><center>Lec Hrs</center></th>
                                                        <th scope="col"><center>Lab Hrs</center></th>
                                                        <th scope="col"><center>Units</center></th>
                                                        <th scope="col"><center>Prerequisite</center></th>
                                                        <th hidden><center>Semester</center></th>
                                                        <th hidden><center>Year</center></th>
                                                        <th ><center>Status</center></th>
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
                        <?php
                            $check_sub_status_1st_summer = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE subject_id_fk='$subjectid_save' and student_id='$Studid' and curri_id='$Currid' and yearlevel='1' and semester='summer' and course_id_fk='$curr_courseid'");
                            while($d=mysqli_fetch_array($check_sub_status_1st_summer))
                            {
                                $re_check_1st_summer = $d['remarks'];
                            }
                            if(mysqli_num_rows($check_sub_status_1st_summer) == 0)
                            {
                        ?>
                                <td><center>Not Yet Taken</center></td>
                        <?php
                            }
                            else
                            {
                        ?>
                                <td><center><?php echo $re_check_1st_summer ?></center></td>
                        <?php
                            }
                        ?>
                                </tr>
                        <?php
                                }
                            }
                            $lec_units_1st_summer = "SELECT sum(lec) FROM tblsubject WHERE curr_id_fk='$Currid' and yearlevel='1' and semester='summer' and course_id_fk='$courseid'";
                            $lab_units_1st_summer = "SELECT sum(lab) FROM tblsubject WHERE curr_id_fk='$Currid' and yearlevel='1' and semester='summer' and course_id_fk='$courseid'";
                            $sum_units_1st_summer = "SELECT sum(units) FROM tblsubject WHERE curr_id_fk='$Currid' and yearlevel='1' and semester='summer' and course_id_fk='$courseid'";
                            $units_check_lec_1st_summer = mysqli_query($connection,$lec_units_1st_summer);
                            $units_check_lab_1st_summer = mysqli_query($connection,$lab_units_1st_summer);
                            $units_check_units_1st_summer = mysqli_query($connection,$sum_units_1st_summer);
                            $units_total_lec_1st_summer = mysqli_fetch_array($units_check_lec_1st_summer);
                            $units_total_lab_1st_summer = mysqli_fetch_array($units_check_lab_1st_summer);
                            $units_total_units_1st_summer = mysqli_fetch_array($units_check_units_1st_summer);
                            $units_row_lec_1st_summer = $units_total_lec_1st_summer[0];
                            $units_row_lab_1st_summer = $units_total_lab_1st_summer[0];
                            $units_row_units_1st_summer = $units_total_units_1st_summer[0];
                        ?>
                                                    </tbody>
                                                    <tfoot >	
                                                        <!-- table footer -->
                                                        <tr>
                                                            <td></td>
                                                            <td class="text-center" ><b>TOTAL</b></td>
                                                            <td><center><?php echo $units_row_lec_1st_summer?></center></td>
                                                            <td><center><?php echo $units_row_lab_1st_summer ?></center></td>
                                                            <td><center><?php echo $units_row_units_1st_summer ?></center></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                        
                                        </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End 1st Year Semester Subjects Modal -->

                    <!-- Start 2nd Year Semester Subjects Modal -->
                    <div class="container container-fluid">
                        <div class="modal fade" id="view2ndYearListSubject" tabindex="-1" role="dialog" aria-labelledby="manage-requestLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document" style="max-width: 1380px;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title fw-bold text-uppercase" id="manage-requestLabel">Curriculum Subjects</h5>
                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                        <!-- 2nd Year Subjects -->
                                        <div class="mt-2">
                                            <div class="text-uppercase fw-bold text-center fs-4 mt-2 mb-1">
                                                <span>Second Year</span>
                                            </div>

                                            <div class="text-uppercase fw-bold mt-3 mb-2">
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
                                                        <th width="10px"><center>Title</center></th>
                                                        <th scope="col"><center>Lec Hrs</center></th>
                                                        <th scope="col"><center>Lab Hrs</center></th>
                                                        <th scope="col"><center>Units</center></th>
                                                        <th scope="col"><center>Prerequisite</center></th>
                                                        <th hidden><center>Semester</center></th>
                                                        <th hidden><center>Year</center></th>
                                                        <th ><center>Status</center></th>
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
                        <?php
                            $check_sub_status_2nd_1st = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE subject_id_fk='$subjectid_save' and student_id='$Studid' and curri_id='$Currid' and yearlevel='2' and semester='1st' and course_id_fk='$curr_courseid'");
                            while($d=mysqli_fetch_array($check_sub_status_2nd_1st))
                            {
                                $re_check_2nd_1st = $d['remarks'];
                            }
                            if(mysqli_num_rows($check_sub_status_2nd_1st) == 0)
                            {
                        ?>
                                <td><center>Not Yet Taken</center></td>
                        <?php
                            }
                            else
                            {
                        ?>
                                <td><center><?php echo $re_check_2nd_1st ?></center></td>
                        <?php
                            }
                        ?>
                                </tr>
                        <?php
                                }
                            }
                            $lec_units_2nd_1st = "SELECT sum(lec) FROM tblsubject WHERE curr_id_fk='$Currid' and yearlevel='2' and semester='1st' and course_id_fk='$courseid'";
                            $lab_units_2nd_1st = "SELECT sum(lab) FROM tblsubject WHERE curr_id_fk='$Currid' and yearlevel='2' and semester='1st' and course_id_fk='$courseid'";
                            $sum_units_2nd_1st = "SELECT sum(units) FROM tblsubject WHERE curr_id_fk='$Currid' and yearlevel='2' and semester='1st' and course_id_fk='$courseid'";
                            $units_check_lec_2nd_1st = mysqli_query($connection,$lec_units_2nd_1st);
                            $units_check_lab_2nd_1st = mysqli_query($connection,$lab_units_2nd_1st);
                            $units_check_units_2nd_1st = mysqli_query($connection,$sum_units_2nd_1st);
                            $units_total_lec_2nd_1st = mysqli_fetch_array($units_check_lec_2nd_1st);
                            $units_total_lab_2nd_1st = mysqli_fetch_array($units_check_lab_2nd_1st);
                            $units_total_units_2nd_1st = mysqli_fetch_array($units_check_units_2nd_1st);
                            $units_row_lec_2nd_1st = $units_total_lec_2nd_1st[0];
                            $units_row_lab_2nd_1st = $units_total_lab_2nd_1st[0];
                            $units_row_units_2nd_1st = $units_total_units_2nd_1st[0];
                        ?>
                                                    </tbody>
                                                    <tfoot >	
                                                        <!-- table footer -->
                                                        <tr>
                                                            <td></td>
                                                            <td class="text-center" ><b>TOTAL</b></td>
                                                            <td><center><?php echo $units_row_lec_2nd_1st?></center></td>
                                                            <td><center><?php echo $units_row_lab_2nd_1st ?></center></td>
                                                            <td><center><?php echo $units_row_units_2nd_1st ?></center></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>

                                                <div class="text-uppercase fw-bold mt-3 mb-2">
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
                                                        <th width="10px"><center>Title</center></th>
                                                        <th scope="col"><center>Lec Hrs</center></th>
                                                        <th scope="col"><center>Lab Hrs</center></th>
                                                        <th scope="col"><center>Units</center></th>
                                                        <th scope="col"><center>Prerequisite</center></th>
                                                        <th hidden><center>Semester</center></th>
                                                        <th hidden><center>Year</center></th>
                                                        <th ><center>Status</center></th>
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
                        <?php
                            $check_sub_status_2nd_2nd = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE subject_id_fk='$subjectid_save' and student_id='$Studid' and curri_id='$Currid' and yearlevel='2' and semester='2nd' and course_id_fk='$curr_courseid'");
                            while($d=mysqli_fetch_array($check_sub_status_2nd_2nd))
                            {
                                $re_check_2nd_2nd = $d['remarks'];
                            }
                            if(mysqli_num_rows($check_sub_status_2nd_2nd) == 0)
                            {
                        ?>
                                <td><center>Not Yet Taken</center></td>
                        <?php
                            }
                            else
                            {
                        ?>
                                <td><center><?php echo $re_check_2nd_2nd ?></center></td>
                        <?php
                            }
                        ?>
                                </tr>
                        <?php
                            $lec_units_2nd_2nd = "SELECT sum(lec) FROM tblsubject WHERE curr_id_fk='$Currid' and yearlevel='2' and semester='2nd' and course_id_fk='$courseid'";
                            $lab_units_2nd_2nd = "SELECT sum(lab) FROM tblsubject WHERE curr_id_fk='$Currid' and yearlevel='2' and semester='2nd' and course_id_fk='$courseid'";
                            $sum_units_2nd_2nd = "SELECT sum(units) FROM tblsubject WHERE curr_id_fk='$Currid' and yearlevel='2' and semester='2nd' and course_id_fk='$courseid'";
                            $units_check_lec_2nd_2nd = mysqli_query($connection,$lec_units_2nd_2nd);
                            $units_check_lab_2nd_2nd = mysqli_query($connection,$lab_units_2nd_2nd);
                            $units_check_units_2nd_2nd = mysqli_query($connection,$sum_units_2nd_2nd);
                            $units_total_lec_2nd_2nd = mysqli_fetch_array($units_check_lec_2nd_2nd);
                            $units_total_lab_2nd_2nd = mysqli_fetch_array($units_check_lab_2nd_2nd);
                            $units_total_units_2nd_2nd = mysqli_fetch_array($units_check_units_2nd_2nd);
                            $units_row_lec_2nd_2nd = $units_total_lec_2nd_2nd[0];
                            $units_row_lab_2nd_2nd = $units_total_lab_2nd_2nd[0];
                            $units_row_units_2nd_2nd = $units_total_units_2nd_2nd[0];
                                }
                            }
                        ?>
                                                    </tbody>
                                                    <tfoot >	
                                                        <!-- table footer -->
                                                        <tr>
                                                            <td></td>
                                                            <td class="text-center" ><b>TOTAL</b></td>
                                                            <td><center><?php echo $units_row_lec_2nd_2nd?></center></td>
                                                            <td><center><?php echo $units_row_lab_2nd_2nd ?></center></td>
                                                            <td><center><?php echo $units_row_units_2nd_2nd ?></center></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>

                                                <div class="text-uppercase fw-bold mt-3 mb-2">
                                                    <span>Summer</span>
                                                </div>
                        <?php
                            $check_2nd_sem_summer = mysqli_query($connection,"SELECT * FROM tblsubject WHERE yearlevel='2' and semester='summer' and curr_id_fk='$Currid' and course_id_fk='$courseid'");
                        ?>
                                                <table class="table table-striped" id="table2yearsummer" width="100%">
                                                    <thead class="text-white">
                                                        <tr>
                                                            <th hidden>id</th>
                                                            <th><center>Code</center></th>
                                                            <th width="10px"><center>Title</center></th>
                                                            <th scope="col"><center>Lec Hrs</center></th>
                                                            <th scope="col"><center>Lab Hrs</center></th>
                                                            <th scope="col"><center>Units</center></th>
                                                            <th scope="col"><center>Prerequisite</center></th>
                                                            <th hidden><center>Semester</center></th>
                                                            <th hidden><center>Year</center></th>
                                                            <th ><center>Status</center></th>
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
                        <?php
                            $check_sub_status_2nd_summer = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE subject_id_fk='$subjectid_save' and student_id='$Studid' and curri_id='$Currid' and yearlevel='2' and semester='summer' and course_id_fk='$curr_courseid'");
                            while($d=mysqli_fetch_array($check_sub_status_2nd_summer))
                            {
                                $re_check_2nd_summer = $d['remarks'];
                            }
                            if(mysqli_num_rows($check_sub_status_2nd_summer) == 0)
                            {
                        ?>
                                <td><center>Not Yet Taken</center></td>
                        <?php
                            }
                            else
                            {
                        ?>
                                <td><center><?php echo $re_check_2nd_summer ?></center></td>
                        <?php
                            }
                        ?>
                                </tr>
                        <?php
                                }
                            }
                            $lec_units_2nd_summer = "SELECT sum(lec) FROM tblsubject WHERE curr_id_fk='$Currid' and yearlevel='2' and semester='summer' and course_id_fk='$courseid'";
                            $lab_units_2nd_summer = "SELECT sum(lab) FROM tblsubject WHERE curr_id_fk='$Currid' and yearlevel='2' and semester='summer' and course_id_fk='$courseid'";
                            $sum_units_2nd_summer = "SELECT sum(units) FROM tblsubject WHERE curr_id_fk='$Currid' and yearlevel='2' and semester='summer' and course_id_fk='$courseid'";
                            $units_check_lec_2nd_summer = mysqli_query($connection,$lec_units_2nd_summer);
                            $units_check_lab_2nd_summer = mysqli_query($connection,$lab_units_2nd_summer);
                            $units_check_units_2nd_summer = mysqli_query($connection,$sum_units_2nd_summer);
                            $units_total_lec_2nd_summer = mysqli_fetch_array($units_check_lec_2nd_summer);
                            $units_total_lab_2nd_summer = mysqli_fetch_array($units_check_lab_2nd_summer);
                            $units_total_units_2nd_summer = mysqli_fetch_array($units_check_units_2nd_summer);
                            $units_row_lec_2nd_summer = $units_total_lec_2nd_summer[0];
                            $units_row_lab_2nd_summer = $units_total_lab_2nd_summer[0];
                            $units_row_units_2nd_summer = $units_total_units_2nd_summer[0];
                        ?>
                                                    </tbody>
                                                    <tfoot >	
                                                        <!-- table footer -->
                                                        <tr>
                                                            <td></td>
                                                            <td class="text-center" ><b>TOTAL</b></td>
                                                            <td><center><?php echo $units_row_lec_2nd_summer?></center></td>
                                                            <td><center><?php echo $units_row_lab_2nd_summer ?></center></td>
                                                            <td><center><?php echo $units_row_units_2nd_summer ?></center></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                        </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End 2nd Year Semester Subjects Modal -->

                    <!-- Start 3rd Year Semester Subjects Modal -->
                    <div class="container container-fluid">
                        <div class="modal fade" id="view3rdYearListSubject" tabindex="-1" role="dialog" aria-labelledby="manage-requestLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document" style="max-width: 1380px;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title fw-bold text-uppercase" id="manage-requestLabel">Curriculum Subjects</h5>
                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                        <!-- 3rd Year Subjects -->
                                            <div class="mt-2">
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
                                                        <th width="10px"><center>Title</center></th>
                                                        <th scope="col"><center>Lec Hrs</center></th>
                                                        <th scope="col"><center>Lab Hrs</center></th>
                                                        <th scope="col"><center>Units</center></th>
                                                        <th scope="col"><center>Prerequisite</center></th>
                                                        <th hidden><center>Semester</center></th>
                                                        <th hidden><center>Year</center></th>
                                                        <th ><center>Status</center></th>
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
                        <?php
                            $check_sub_status_3rd_1st = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE subject_id_fk='$subjectid_save' and student_id='$Studid' and curri_id='$Currid' and yearlevel='3' and semester='1st' and course_id_fk='$curr_courseid'");
                            while($d=mysqli_fetch_array($check_sub_status_3rd_1st))
                            {
                                $re_check_3rd_1st = $d['remarks'];
                            }
                            if(mysqli_num_rows($check_sub_status_3rd_1st) == 0)
                            {
                        ?>
                                <td><center>Not Yet Taken</center></td>
                        <?php
                            }
                            else
                            {
                        ?>
                                <td><center><?php echo $re_check_3rd_1st ?></center></td>
                        <?php
                            }
                        ?>
                                </tr>
                        <?php
                                }
                            }
                            $lec_units_3rd_1st = "SELECT sum(lec) FROM tblsubject WHERE curr_id_fk='$Currid' and yearlevel='3' and semester='1st' and course_id_fk='$courseid'";
                            $lab_units_3rd_1st = "SELECT sum(lab) FROM tblsubject WHERE curr_id_fk='$Currid' and yearlevel='3' and semester='1st' and course_id_fk='$courseid'";
                            $sum_units_3rd_1st = "SELECT sum(units) FROM tblsubject WHERE curr_id_fk='$Currid' and yearlevel='3' and semester='1st' and course_id_fk='$courseid'";
                            $units_check_lec_3rd_1st = mysqli_query($connection,$lec_units_3rd_1st);
                            $units_check_lab_3rd_1st = mysqli_query($connection,$lab_units_3rd_1st);
                            $units_check_units_3rd_1st = mysqli_query($connection,$sum_units_3rd_1st);
                            $units_total_lec_3rd_1st = mysqli_fetch_array($units_check_lec_3rd_1st);
                            $units_total_lab_3rd_1st = mysqli_fetch_array($units_check_lab_3rd_1st);
                            $units_total_units_3rd_1st = mysqli_fetch_array($units_check_units_3rd_1st);
                            $units_row_lec_3rd_1st = $units_total_lec_3rd_1st[0];
                            $units_row_lab_3rd_1st = $units_total_lab_3rd_1st[0];
                            $units_row_units_3rd_1st = $units_total_units_3rd_1st[0];
                        ?>
                                                    </tbody>
                                                    <tfoot >	
                                                        <!-- table footer -->
                                                        <tr>
                                                            <td></td>
                                                            <td class="text-center" ><b>TOTAL</b></td>
                                                            <td><center><?php echo $units_row_lec_3rd_1st?></center></td>
                                                            <td><center><?php echo $units_row_lab_3rd_1st ?></center></td>
                                                            <td><center><?php echo $units_row_units_3rd_1st ?></center></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>

                                                <div class="text-uppercase fw-bold mt-3 mb-2">
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
                                                        <th width="10px"><center>Title</center></th>
                                                        <th scope="col"><center>Lec Hrs</center></th>
                                                        <th scope="col"><center>Lab Hrs</center></th>
                                                        <th scope="col"><center>Units</center></th>
                                                        <th scope="col"><center>Prerequisite</center></th>
                                                        <th hidden><center>Semester</center></th>
                                                        <th hidden><center>Year</center></th>
                                                        <th ><center>Status</center></th>
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
                        <?php
                            $check_sub_status_3rd_2nd = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE subject_id_fk='$subjectid_save' and student_id='$Studid' and curri_id='$Currid' and yearlevel='3' and semester='2nd' and course_id_fk='$curr_courseid'");
                            while($d=mysqli_fetch_array($check_sub_status_3rd_2nd))
                            {
                                $re_check_3rd_2nd = $d['remarks'];
                            }
                            if(mysqli_num_rows($check_sub_status_3rd_2nd) == 0)
                            {
                        ?>
                                <td><center>Not Yet Taken</center></td>
                        <?php
                            }
                            else
                            {
                        ?>
                                <td><center><?php echo $re_check_3rd_2nd ?></center></td>
                        <?php
                            }
                        ?>
                                </tr>
                        <?php
                                }
                            }
                            $lec_units_3rd_2nd = "SELECT sum(lec) FROM tblsubject WHERE curr_id_fk='$Currid' and yearlevel='3' and semester='2nd' and course_id_fk='$courseid'";
                            $lab_units_3rd_2nd = "SELECT sum(lab) FROM tblsubject WHERE curr_id_fk='$Currid' and yearlevel='3' and semester='2nd' and course_id_fk='$courseid'";
                            $sum_units_3rd_2nd = "SELECT sum(units) FROM tblsubject WHERE curr_id_fk='$Currid' and yearlevel='3' and semester='2nd' and course_id_fk='$courseid'";
                            $units_check_lec_3rd_2nd = mysqli_query($connection,$lec_units_3rd_2nd);
                            $units_check_lab_3rd_2nd = mysqli_query($connection,$lab_units_3rd_2nd);
                            $units_check_units_3rd_2nd = mysqli_query($connection,$sum_units_3rd_2nd);
                            $units_total_lec_3rd_2nd = mysqli_fetch_array($units_check_lec_3rd_2nd);
                            $units_total_lab_3rd_2nd = mysqli_fetch_array($units_check_lab_3rd_2nd);
                            $units_total_units_3rd_2nd = mysqli_fetch_array($units_check_units_3rd_2nd);
                            $units_row_lec_3rd_2nd = $units_total_lec_3rd_2nd[0];
                            $units_row_lab_3rd_2nd = $units_total_lab_3rd_2nd[0];
                            $units_row_units_3rd_2nd = $units_total_units_3rd_2nd[0];
                        ?>
                                                    </tbody>
                                                    <tfoot >	
                                                        <!-- table footer -->
                                                        <tr>
                                                            <td></td>
                                                            <td class="text-center" ><b>TOTAL</b></td>
                                                            <td><center><?php echo $units_row_lec_3rd_2nd?></center></td>
                                                            <td><center><?php echo $units_row_lab_3rd_2nd ?></center></td>
                                                            <td><center><?php echo $units_row_units_3rd_2nd ?></center></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>

                                                <div class="text-uppercase fw-bold mt-3 mb-2">
                                                    <span>Summer</span>
                                                </div>
                        <?php
                            $check_3rd_sem_summer = mysqli_query($connection,"SELECT * FROM tblsubject WHERE semester='summer' and curr_id_fk='$Currid' and course_id_fk='$courseid' and yearlevel='3'");
                        ?>
                                                <table class="table table-striped" id="table3yearsummer" width="100%">
                                                    <thead class="text-white">
                                                        <tr>
                                                        <th hidden>id</th>
                                                        <th><center>Code</center></th>
                                                        <th width="10px"><center>Title</center></th>
                                                        <th scope="col"><center>Lec Hrs</center></th>
                                                        <th scope="col"><center>Lab Hrs</center></th>
                                                        <th scope="col"><center>Units</center></th>
                                                        <th scope="col"><center>Prerequisite</center></th>
                                                        <th hidden><center>Semester</center></th>
                                                        <th hidden><center>Year</center></th>
                                                        <th ><center>Status</center></th>
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
                        <?php
                            $check_sub_status_3rd_summer = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE subject_id_fk='$subjectid_save' and student_id='$Studid' and curri_id='$Currid' and yearlevel='3' and semester='summer' and course_id_fk='$curr_courseid'");
                            while($d=mysqli_fetch_array($check_sub_status_3rd_summer))
                            {
                                $re_check_3rd_summer = $d['remarks'];
                            }
                            if(mysqli_num_rows($check_sub_status_3rd_summer) == 0)
                            {
                        ?>
                                <td><center>Not Yet Taken</center></td>
                        <?php
                            }
                            else
                            {
                        ?>
                                <td><center><?php echo $re_check_3rd_summer ?></center></td>
                        <?php
                            }
                        ?>
                                </tr>
                        <?php
                                }
                            }
                            $lec_units_3rd_summer = "SELECT sum(lec) FROM tblsubject WHERE curr_id_fk='$Currid' and yearlevel='3' and semester='summer' and course_id_fk='$courseid'";
                            $lab_units_3rd_summer = "SELECT sum(lab) FROM tblsubject WHERE curr_id_fk='$Currid' and yearlevel='3' and semester='summer' and course_id_fk='$courseid'";
                            $sum_units_3rd_summer = "SELECT sum(units) FROM tblsubject WHERE curr_id_fk='$Currid' and yearlevel='3' and semester='summer' and course_id_fk='$courseid'";
                            $units_check_lec_3rd_summer = mysqli_query($connection,$lec_units_3rd_summer);
                            $units_check_lab_3rd_summer = mysqli_query($connection,$lab_units_3rd_summer);
                            $units_check_units_3rd_summer = mysqli_query($connection,$sum_units_3rd_summer);
                            $units_total_lec_3rd_summer = mysqli_fetch_array($units_check_lec_3rd_summer);
                            $units_total_lab_3rd_summer = mysqli_fetch_array($units_check_lab_3rd_summer);
                            $units_total_units_3rd_summer = mysqli_fetch_array($units_check_units_3rd_summer);
                            $units_row_lec_3rd_summer = $units_total_lec_3rd_summer[0];
                            $units_row_lab_3rd_summer = $units_total_lab_3rd_summer[0];
                            $units_row_units_3rd_summer = $units_total_units_3rd_summer[0];
                        ?>
                                                    </tbody>
                                                    <tfoot >	
                                                        <!-- table footer -->
                                                        <tr>
                                                            <td></td>
                                                            <td class="text-center" ><b>TOTAL</b></td>
                                                            <td><center><?php echo $units_row_lec_3rd_summer?></center></td>
                                                            <td><center><?php echo $units_row_lab_3rd_summer ?></center></td>
                                                            <td><center><?php echo $units_row_units_3rd_summer ?></center></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End 3rd Year Semester Subjects Modal -->

                    <!-- Start 4th Year Semester Subjects Modal -->
                    <div class="container container-fluid">
                        <div class="modal fade" id="view4thYearListSubject" tabindex="-1" role="dialog" aria-labelledby="manage-requestLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document" style="max-width: 1380px;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title fw-bold text-uppercase" id="manage-requestLabel">Curriculum Subjects</h5>
                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <!-- 4th Year Subjects -->
                                            <div class="mt-2">
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
                                                        <th width="10px"><center>Title</center></th>
                                                        <th scope="col"><center>Lec Hrs</center></th>
                                                        <th scope="col"><center>Lab Hrs</center></th>
                                                        <th scope="col"><center>Units</center></th>
                                                        <th scope="col"><center>Prerequisite</center></th>
                                                        <th hidden><center>Semester</center></th>
                                                        <th hidden><center>Year</center></th>
                                                        <th ><center>Status</center></th>
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
                        <?php
                            $check_sub_status_4th_1st = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE subject_id_fk='$subjectid_save' and student_id='$Studid' and curri_id='$Currid' and yearlevel='4' and semester='1st' and course_id_fk='$curr_courseid'");
                            while($d=mysqli_fetch_array($check_sub_status_4th_1st))
                            {
                                $re_check_4th_1st = $d['remarks'];
                            }
                            if(mysqli_num_rows($check_sub_status_4th_1st) == 0)
                            {
                        ?>
                                <td><center>Not Yet Taken</center></td>
                        <?php
                            }
                            else
                            {
                        ?>
                                <td><center><?php echo $re_check_4th_1st ?></center></td>
                        <?php
                            }
                        ?>
                                </tr>
                        <?php
                                }
                            }
                            $lec_units_4th_1st = "SELECT sum(lec) FROM tblsubject WHERE curr_id_fk='$Currid' and yearlevel='4' and semester='1st' and course_id_fk='$courseid'";
                            $lab_units_4th_1st = "SELECT sum(lab) FROM tblsubject WHERE curr_id_fk='$Currid' and yearlevel='4' and semester='1st' and course_id_fk='$courseid'";
                            $sum_units_4th_1st = "SELECT sum(units) FROM tblsubject WHERE curr_id_fk='$Currid' and yearlevel='4' and semester='1st' and course_id_fk='$courseid'";
                            $units_check_lec_4th_1st = mysqli_query($connection,$lec_units_4th_1st);
                            $units_check_lab_4th_1st = mysqli_query($connection,$lab_units_4th_1st);
                            $units_check_units_4th_1st = mysqli_query($connection,$sum_units_4th_1st);
                            $units_total_lec_4th_1st = mysqli_fetch_array($units_check_lec_4th_1st);
                            $units_total_lab_4th_1st = mysqli_fetch_array($units_check_lab_4th_1st);
                            $units_total_units_4th_1st = mysqli_fetch_array($units_check_units_4th_1st);
                            $units_row_lec_4th_1st = $units_total_lec_4th_1st[0];
                            $units_row_lab_4th_1st = $units_total_lab_4th_1st[0];
                            $units_row_units_4th_1st = $units_total_units_4th_1st[0];
                        ?>
                                                    </tbody>
                                                    <tfoot >	
                                                        <!-- table footer -->
                                                        <tr>
                                                            <td></td>
                                                            <td class="text-center" ><b>TOTAL</b></td>
                                                            <td><center><?php echo $units_row_lec_4th_1st?></center></td>
                                                            <td><center><?php echo $units_row_lab_4th_1st ?></center></td>
                                                            <td><center><?php echo $units_row_units_4th_1st ?></center></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>

                                                <div class="text-uppercase fw-bold mt-3 mb-2">
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
                                                        <th width="10px"><center>Title</center></th>
                                                        <th scope="col"><center>Lec Hrs</center></th>
                                                        <th scope="col"><center>Lab Hrs</center></th>
                                                        <th scope="col"><center>Units</center></th>
                                                        <th scope="col"><center>Prerequisite</center></th>
                                                        <th hidden><center>Semester</center></th>
                                                        <th hidden><center>Year</center></th>
                                                        <th ><center>Status</center></th>
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
                        <?php
                            $check_sub_status_4th_2nd = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE subject_id_fk='$subjectid_save' and student_id='$Studid' and curri_id='$Currid' and yearlevel='4' and semester='2nd' and course_id_fk='$curr_courseid'");
                            while($d=mysqli_fetch_array($check_sub_status_4th_2nd))
                            {
                                $re_check_4th_2nd = $d['remarks'];
                            }
                            if(mysqli_num_rows($check_sub_status_4th_2nd) == 0)
                            {
                        ?>
                                <td><center>Not Yet Taken</center></td>
                        <?php
                            }
                            else
                            {
                        ?>
                                <td><center><?php echo $re_check_4th_2nd ?></center></td>
                        <?php
                            }
                        ?>
                                </tr>
                        <?php
                                }
                            }
                            $lec_units_4th_2nd = "SELECT sum(lec) FROM tblsubject WHERE curr_id_fk='$Currid' and yearlevel='4' and semester='2nd' and course_id_fk='$courseid'";
                            $lab_units_4th_2nd = "SELECT sum(lab) FROM tblsubject WHERE curr_id_fk='$Currid' and yearlevel='4' and semester='2nd' and course_id_fk='$courseid'";
                            $sum_units_4th_2nd = "SELECT sum(units) FROM tblsubject WHERE curr_id_fk='$Currid' and yearlevel='4' and semester='2nd' and course_id_fk='$courseid'";
                            $units_check_lec_4th_2nd = mysqli_query($connection,$lec_units_4th_2nd);
                            $units_check_lab_4th_2nd = mysqli_query($connection,$lab_units_4th_2nd);
                            $units_check_units_4th_2nd = mysqli_query($connection,$sum_units_4th_2nd);
                            $units_total_lec_4th_2nd = mysqli_fetch_array($units_check_lec_4th_2nd);
                            $units_total_lab_4th_2nd = mysqli_fetch_array($units_check_lab_4th_2nd);
                            $units_total_units_4th_2nd = mysqli_fetch_array($units_check_units_4th_2nd);
                            $units_row_lec_4th_2nd = $units_total_lec_4th_2nd[0];
                            $units_row_lab_4th_2nd = $units_total_lab_4th_2nd[0];
                            $units_row_units_4th_2nd = $units_total_units_4th_2nd[0];
                        ?>
                                                    </tbody>
                                                    <tfoot >	
                                                        <!-- table footer -->
                                                        <tr>
                                                            <td></td>
                                                            <td class="text-center" ><b>TOTAL</b></td>
                                                            <td><center><?php echo $units_row_lec_4th_2nd?></center></td>
                                                            <td><center><?php echo $units_row_lab_4th_2nd ?></center></td>
                                                            <td><center><?php echo $units_row_units_4th_2nd ?></center></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>

                                                <div class="text-uppercase fw-bold mt-3 mb-2">
                                                    <span>Summer</span>
                                                </div>
                        <?php
                            $check_4th_sem_summer = mysqli_query($connection,"SELECT * FROM tblsubject WHERE semester='summer' and curr_id_fk='$Currid' and course_id_fk='$courseid' and yearlevel='4'");
                        ?>
                                                <table class="table table-striped" id="table4yearsummer" width="100%">
                                                    <thead class="text-white">
                                                        <tr>
                                                        <th hidden>id</th>
                                                        <th><center>Code</center></th>
                                                        <th width="10px"><center>Title</center></th>
                                                        <th scope="col"><center>Lec Hrs</center></th>
                                                        <th scope="col"><center>Lab Hrs</center></th>
                                                        <th scope="col"><center>Units</center></th>
                                                        <th scope="col"><center>Prerequisite</center></th>
                                                        <th hidden><center>Semester</center></th>
                                                        <th hidden><center>Year</center></th>
                                                        <th ><center>Status</center></th>
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
                        <?php
                            $check_sub_status_4th_summer = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE subject_id_fk='$subjectid_save' and student_id='$Studid' and curri_id='$Currid' and yearlevel='4' and semester='summer' and course_id_fk='$curr_courseid'");
                            while($d=mysqli_fetch_array($check_sub_status_4th_summer))
                            {
                                $re_check_4th_summer = $d['remarks'];
                            }
                            if(mysqli_num_rows($check_sub_status_4th_summer) == 0)
                            {
                        ?>
                                <td><center>Not Yet Taken</center></td>
                        <?php
                            }
                            else
                            {
                        ?>
                                <td><center><?php echo $re_check_4th_summer ?></center></td>
                        <?php
                            }
                        ?>
                                </tr>
                        <?php
                                }
                            }
                            $lec_units_4th_summer = "SELECT sum(lec) FROM tblsubject WHERE curr_id_fk='$Currid' and yearlevel='4' and semester='summer' and course_id_fk='$courseid'";
                            $lab_units_4th_summer = "SELECT sum(lab) FROM tblsubject WHERE curr_id_fk='$Currid' and yearlevel='4' and semester='summer' and course_id_fk='$courseid'";
                            $sum_units_4th_summer = "SELECT sum(units) FROM tblsubject WHERE curr_id_fk='$Currid' and yearlevel='4' and semester='summer' and course_id_fk='$courseid'";
                            $units_check_lec_4th_summer = mysqli_query($connection,$lec_units_4th_summer);
                            $units_check_lab_4th_summer = mysqli_query($connection,$lab_units_4th_summer);
                            $units_check_units_4th_summer = mysqli_query($connection,$sum_units_4th_summer);
                            $units_total_lec_4th_summer = mysqli_fetch_array($units_check_lec_4th_summer);
                            $units_total_lab_4th_summer = mysqli_fetch_array($units_check_lab_4th_summer);
                            $units_total_units_4th_summer = mysqli_fetch_array($units_check_units_4th_summer);
                            $units_row_lec_4th_summer = $units_total_lec_4th_summer[0];
                            $units_row_lab_4th_summer = $units_total_lab_4th_summer[0];
                            $units_row_units_4th_summer = $units_total_units_4th_summer[0];
                        ?>
                                                    </tbody>
                                                    <tfoot >	
                                                        <!-- table footer -->
                                                        <tr>
                                                            <td></td>
                                                            <td class="text-center" ><b>TOTAL</b></td>
                                                            <td><center><?php echo $units_row_lec_4th_summer?></center></td>
                                                            <td><center><?php echo $units_row_lab_4th_summer ?></center></td>
                                                            <td><center><?php echo $units_row_units_4th_summer ?></center></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End 4th Year Semester Subjects Modal -->

                    <!-- Start 5th Year Semester Subjects Modal -->
                    <div class="container container-fluid">
                        <div class="modal fade" id="view5thYearListSubject" tabindex="-1" role="dialog" aria-labelledby="manage-requestLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document" style="max-width: 1380px;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title fw-bold text-uppercase" id="manage-requestLabel">Curriculum Subjects</h5>
                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <!-- 5th Year Subjects -->
                                            <div class="mt-2">
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
                                                        <th width="10px"><center>Title</center></th>
                                                        <th scope="col"><center>Lec Hrs</center></th>
                                                        <th scope="col"><center>Lab Hrs</center></th>
                                                        <th scope="col"><center>Units</center></th>
                                                        <th scope="col"><center>Prerequisite</center></th>
                                                        <th hidden><center>Semester</center></th>
                                                        <th hidden><center>Year</center></th>
                                                        <th ><center>Status</center></th>
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
                        <?php
                            $check_sub_status_5th_1st = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE subject_id_fk='$subjectid_save' and student_id='$Studid' and curri_id='$Currid' and yearlevel='5' and semester='1st' and course_id_fk='$curr_courseid'");
                            while($d=mysqli_fetch_array($check_sub_status_5th_1st))
                            {
                                $re_check_5th_1st = $d['remarks'];
                            }
                            if(mysqli_num_rows($check_sub_status_5th_1st) == 0)
                            {
                        ?>
                                <td><center>Not Yet Taken</center></td>
                        <?php
                            }
                            else
                            {
                        ?>
                                <td><center><?php echo $re_check_5th_1st ?></center></td>
                        <?php
                            }
                        ?>
                                </tr>
                        <?php
                                }
                            }
                            $lec_units_5th_1st = "SELECT sum(lec) FROM tblsubject WHERE curr_id_fk='$Currid' and yearlevel='5' and semester='1st' and course_id_fk='$courseid'";
                            $lab_units_5th_1st = "SELECT sum(lab) FROM tblsubject WHERE curr_id_fk='$Currid' and yearlevel='5' and semester='1st' and course_id_fk='$courseid'";
                            $sum_units_5th_1st = "SELECT sum(units) FROM tblsubject WHERE curr_id_fk='$Currid' and yearlevel='5' and semester='1st' and course_id_fk='$courseid'";
                            $units_check_lec_5th_1st = mysqli_query($connection,$lec_units_5th_1st);
                            $units_check_lab_5th_1st = mysqli_query($connection,$lab_units_5th_1st);
                            $units_check_units_5th_1st = mysqli_query($connection,$sum_units_5th_1st);
                            $units_total_lec_5th_1st = mysqli_fetch_array($units_check_lec_5th_1st);
                            $units_total_lab_5th_1st = mysqli_fetch_array($units_check_lab_5th_1st);
                            $units_total_units_5th_1st = mysqli_fetch_array($units_check_units_5th_1st);
                            $units_row_lec_5th_1st = $units_total_lec_5th_1st[0];
                            $units_row_lab_5th_1st = $units_total_lab_5th_1st[0];
                            $units_row_units_5th_1st = $units_total_units_5th_1st[0];
                        ?>
                                                    </tbody>
                                                    <tfoot >	
                                                        <!-- table footer -->
                                                        <tr>
                                                            <td></td>
                                                            <td class="text-center" ><b>TOTAL</b></td>
                                                            <td><center><?php echo $units_row_lec_5th_1st ?></center></td>
                                                            <td><center><?php echo $units_row_lab_5th_1st ?></center></td>
                                                            <td><center><?php echo $units_row_units_5th_1st ?></center></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>

                                                <div class="text-uppercase fw-bold mt-3 mb-2">
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
                                                        <th width="10px"><center>Title</center></th>
                                                        <th scope="col"><center>Lec Hrs</center></th>
                                                        <th scope="col"><center>Lab Hrs</center></th>
                                                        <th scope="col"><center>Units</center></th>
                                                        <th scope="col"><center>Prerequisite</center></th>
                                                        <th hidden><center>Semester</center></th>
                                                        <th hidden><center>Year</center></th>
                                                        <th ><center>Status</center></th>
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
                        <?php
                            $check_sub_status_5th_2nd = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE subject_id_fk='$subjectid_save' and student_id='$Studid' and curri_id='$Currid' and yearlevel='5' and semester='2nd' and course_id_fk='$curr_courseid'");
                            while($d=mysqli_fetch_array($check_sub_status_5th_2nd))
                            {
                                $re_check_5th_2nd = $d['remarks'];
                            }
                            if(mysqli_num_rows($check_sub_status_5th_2nd) == 0)
                            {
                        ?>
                                <td><center>Not Yet Taken</center></td>
                        <?php
                            }
                            else
                            {
                        ?>
                                <td><center><?php echo $re_check_5th_2nd ?></center></td>
                        <?php
                            }
                        ?>
                                </tr>
                        <?php
                                }
                            }
                            $lec_units_5th_2nd = "SELECT sum(lec) FROM tblsubject WHERE curr_id_fk='$Currid' and yearlevel='5' and semester='2nd' and course_id_fk='$courseid'";
                            $lab_units_5th_2nd = "SELECT sum(lab) FROM tblsubject WHERE curr_id_fk='$Currid' and yearlevel='5' and semester='2nd' and course_id_fk='$courseid'";
                            $sum_units_5th_2nd = "SELECT sum(units) FROM tblsubject WHERE curr_id_fk='$Currid' and yearlevel='5' and semester='2nd' and course_id_fk='$courseid'";
                            $units_check_lec_5th_2nd = mysqli_query($connection,$lec_units_5th_2nd);
                            $units_check_lab_5th_2nd = mysqli_query($connection,$lab_units_5th_2nd);
                            $units_check_units_5th_2nd = mysqli_query($connection,$sum_units_5th_2nd);
                            $units_total_lec_5th_2nd = mysqli_fetch_array($units_check_lec_5th_2nd);
                            $units_total_lab_5th_2nd = mysqli_fetch_array($units_check_lab_5th_2nd);
                            $units_total_units_5th_2nd = mysqli_fetch_array($units_check_units_5th_2nd);
                            $units_row_lec_5th_2nd = $units_total_lec_5th_2nd[0];
                            $units_row_lab_5th_2nd = $units_total_lab_5th_2nd[0];
                            $units_row_units_5th_2nd = $units_total_units_5th_2nd[0];
                        ?>
                                                    </tbody>
                                                    <tfoot >	
                                                        <!-- table footer -->
                                                        <tr>
                                                            <td></td>
                                                            <td class="text-center" ><b>TOTAL</b></td>
                                                            <td><center><?php echo $units_row_lec_5th_2nd?></center></td>
                                                            <td><center><?php echo $units_row_lab_5th_2nd ?></center></td>
                                                            <td><center><?php echo $units_row_units_5th_2nd ?></center></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>

                                                <div class="text-uppercase fw-bold mt-3 mb-2">
                                                    <span>Summer</span>
                                                </div>
                        <?php
                            $check_5th_sem_summer = mysqli_query($connection,"SELECT * FROM tblsubject WHERE semester='summer' and curr_id_fk='$Currid' and course_id_fk='$courseid' and yearlevel='5'");
                        ?>
                                                <table class="table table-striped" id="table5yearsummer" width="100%">
                                                    <thead class="text-white">
                                                        <tr>
                                                            <th hidden>id</th>
                                                            <th><center>Code</center></th>
                                                            <th width="10px"><center>Title</center></th>
                                                            <th scope="col"><center>Lec Hrs</center></th>
                                                            <th scope="col"><center>Lab Hrs</center></th>
                                                            <th scope="col"><center>Units</center></th>
                                                            <th scope="col"><center>Prerequisite</center></th>
                                                            <th hidden><center>Semester</center></th>
                                                            <th hidden><center>Year</center></th>
                                                            <th ><center>Status</center></th>
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
                        <?php
                            $check_sub_status_5th_summer = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE subject_id_fk='$subjectid_save' and student_id='$Studid' and curri_id='$Currid' and yearlevel='5' and semester='summer' and course_id_fk='$curr_courseid'");
                            while($d=mysqli_fetch_array($check_sub_status_5th_summer))
                            {
                                $re_check_5th_summer = $d['remarks'];
                            }
                            if(mysqli_num_rows($check_sub_status_5th_summer) == 0)
                            {
                        ?>
                                <td><center>Not Yet Taken</center></td>
                        <?php
                            }
                            else
                            {
                        ?>
                                <td><center><?php echo $re_check_5th_summer ?></center></td>
                        <?php
                            }
                        ?>
                                </tr>
                        <?php
                                }
                            }
                            $lec_units_5th_summer = "SELECT sum(lec) FROM tblsubject WHERE curr_id_fk='$Currid' and yearlevel='5' and semester='summer' and course_id_fk='$courseid'";
                            $lab_units_5th_summer = "SELECT sum(lab) FROM tblsubject WHERE curr_id_fk='$Currid' and yearlevel='5' and semester='summer' and course_id_fk='$courseid'";
                            $sum_units_5th_summer = "SELECT sum(units) FROM tblsubject WHERE curr_id_fk='$Currid' and yearlevel='5' and semester='summer' and course_id_fk='$courseid'";
                            $units_check_lec_5th_summer = mysqli_query($connection,$lec_units_5th_summer);
                            $units_check_lab_5th_summer = mysqli_query($connection,$lab_units_5th_summer);
                            $units_check_units_5th_summer = mysqli_query($connection,$sum_units_5th_summer);
                            $units_total_lec_5th_summer = mysqli_fetch_array($units_check_lec_5th_summer);
                            $units_total_lab_5th_summer = mysqli_fetch_array($units_check_lab_5th_summer);
                            $units_total_units_5th_summer = mysqli_fetch_array($units_check_units_5th_summer);
                            $units_row_lec_5th_summer = $units_total_lec_5th_summer[0];
                            $units_row_lab_5th_summer = $units_total_lab_5th_summer[0];
                            $units_row_units_5th_summer = $units_total_units_5th_summer[0];
                        ?>
                                                    </tbody>
                                                    <tfoot >	
                                                        <!-- table footer -->
                                                        <tr>
                                                            <td></td>
                                                            <td class="text-center" ><b>TOTAL</b></td>
                                                            <td><center><?php echo $units_row_lec_5th_summer?></center></td>
                                                            <td><center><?php echo $units_row_lab_5th_summer ?></center></td>
                                                            <td><center><?php echo $units_row_units_5th_summer ?></center></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End 5th Year Semester Subjects Modal -->

                </div>
            </div>
        </div>

        <!-- Start View Students Subjects with Grades Modal -->
		<div class="container container-fluid">
			<div class="modal fade" id="viewSubject" tabindex="-1" role="dialog" aria-labelledby="manage-requestLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document" style="max-width: 1380px;">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title fw-bold text-uppercase" id="manage-requestLabel">Curriculum Student Subjects</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
						    <div class="modal-body">
                                <!-- Start First Year Subjects -->
                                <div>
                                    <div id="1st-year-1st-sem"><!-- Start of First Semester Subjects -->
                                                    <form action="managedata.php" method="POST">
                                                        <input type="hidden" name="studid" value="<?php echo $Studid?>">
                                                        <input type="hidden" name="currid" value="<?php echo $Currid ?>">
                                                        <div class="row mb-2" style="background-color: #C0C0C0;">
                                                            <div class="col mt-3 mb-3" align="left">
                                                                <span class="text-uppercase fw-bold">1st Year - 1st Semester</span>
                                                            </div>
                                                            <div class="col mt-2" align="right">
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
                                                                <th ><center>Lec</center></th>
                                                                <th ><center>Lab</center></th>
                                                                <th ><center>Units</center></th>
                                                                <th ><center>Prerequisite</center></th>
                                                                <th ><center>Grades</center></th>
                                                                <th hidden><center>year</center></th>
                                                                <th hidden><center>semester</center></th>
                                                                <th hidden><center>subid</center></th>
                                                                <th ><center>SY</center></th>
                                                                <th ><center>Remarks</center></th>
                                                                <th hidden><center>SY</center></th>
                                                                <th hidden><center>Total</center></th>
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
                                                else if($PreID && $Grades == "CREDITED" && $Remarks == "CREDITED")
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
                                                            <div class="form-group hide_1st_grade_1st" style="width: 7rem; display: none;">
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
                                                            <td hidden><center><?php echo $Year ?></center></td>
                                                            <td hidden><center><?php echo $Semester ?></center></td>
                                                            <td hidden><center><input type="text" name="subject_id_fk_<?=$PreID ?>" value="<?=$SubID?>"></center></td>
                                                            <td ><center>
                                                            <?php
                                                                if($Grades == 0 && $Grades != "INC" && $Grades != "5.0" && $Grades != "DRP" && $Grades != "CREDITED")
                                                                {
                                                            ?>
                                                                <div class="show_1st_grade_1st">
                                                                    <?php echo $SY?>
                                                                </div>
                                                                <div class="hide_1st_grade_1st" style="width: 7rem; display: none;">
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
                                                                    <input type="text" name="SY_<?=$PreID ?>" value="<?php echo $SY?>" class="form-control text-center" style="width: 50px;">
                                                                </div>
                                                            <?php
                                                                }
                                                            ?>
                                                            </center></td>
                                                            <td ><center><?php echo $Remarks ?></center></td>
                                                            <td hidden><center><?php echo $SY ?></center></td>
                                                            <td hidden><center><?php echo $total_grade_units ?></center></td>
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
                                                                <td></td>
                                                                <td></td>
                                                                <td hidden></td>
                                                                <td hidden></td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                    </form>    
                                    </div><!-- End of First Semester Subjects -->

                                    <div id="1st-year-2nd-sem"><!-- Start of Second Semester Subjects -->
                                                    <form action="managedata.php" method="POST">
                                                        <input type="hidden" name="studid" value="<?php echo $Studid?>">
                                                        <input type="hidden" name="currid" value="<?php echo $Currid ?>">
                                                        <div class="row mb-2" style="background-color: #C0C0C0;">
                                                            <div class="col mt-3 mb-3" align="left">
                                                                <span class="text-uppercase fw-bold">1st Year - 2nd Semester</span>
                                                            </div>
                                                            <div class="col mt-2" align="right">
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
                                                                <th ><center>Lec</center></th>
                                                                <th ><center>Lab</center></th>
                                                                <th ><center>Units</center></th>
                                                                <th ><center>Prerequisite</center></th>
                                                                <th ><center>Grades</center></th>
                                                                <th hidden><center>year</center></th>
                                                                <th hidden><center>semester</center></th>
                                                                <th hidden><center>subid</center></th>
                                                                <th><center>SY</center></th>
                                                                <th ><center>Remarks</center></th>
                                                                <th hidden><center>SY</center></th>
                                                                <th hidden><center>Total Grades</center></th>
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
                                                else if($PreID && $Grades == "CREDITED" && $Remarks == "CREDITED")
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
                                                            <div class="form-group hide_1st_grade_2nd" style="width: 7rem; display: none;"> 
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
                                                                <div class="form-group hide_1st_grade_2nd" style="width: 7rem; display: none;">
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
                                                            <td ><center><?php echo $Remarks ?></center></td>
                                                            <td hidden><center><?php echo $SY ?></center></td>
                                                            <td hidden><center><?php echo $$total_grade_units ?></center></td>
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
                                                                <td></td>
                                                                <td></td>
                                                                <td hidden></td>
                                                                <td hidden></td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                    </form>
                                    </div><!-- End of Second Semester Subjects -->

                                    <div id="1st-year-summer-sem"><!-- Start of Summer Semester Subjects -->
                                                    <form action="managedata.php" method="POST">
                                                        <input type="hidden" name="studid" value="<?php echo $Studid?>">
                                                        <input type="hidden" name="currid" value="<?php echo $Currid ?>">
                                                        <div class="row mb-2" style="background-color: #C0C0C0;">
                                                            <div class="col mt-3 mb-3" align="left">
                                                                <span class="text-uppercase fw-bold">1st Year - Summer Semester</span>
                                                            </div>
                                                            <div class="col mt-2" align="right">
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
                                                                <th ><center>Lec</center></th>
                                                                <th ><center>Lab</center></th>
                                                                <th ><center>Units</center></th>
                                                                <th ><center>Prerequisite</center></th>
                                                                <th ><center>Grades</center></th>
                                                                <th hidden><center>year</center></th>
                                                                <th hidden><center>semester</center></th>
                                                                <th hidden><center>subid</center></th>
                                                                <th><center>SY</center></th>
                                                                <th ><center>Remarks</center></th>
                                                                <th hidden><center>SY</center></th>
                                                                <th hidden><center>Total Grades</center></th>
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
                                                else if($PreID && $Grades == "CREDITED" && $Remarks == "CREDITED")
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
                                                            <div class="form-group hide_1st_grade_summer" style="width: 7rem; display: none;">
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
                                                                <div class="form-group hide_1st_grade_summer" style="width: 7rem; display: none;">
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
                                                            <td ><center><?php echo $Remarks ?></center></td>
                                                            <td hidden><center><?php echo $SY ?></center></td>
                                                            <td hidden><center><?php echo $total_grade_units ?></center></td>
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
                                                                <td></td>
                                                                <td></td>
                                                                <td hidden></td>
                                                                <td hidden></td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                    </form>  
                                    </div><!-- End of Summer Semester Subjects -->
                                </div>
                                <!--End of First Year Subjects -->
                                <!-- Start Second Year Subjects -->
                                <div>
                                    <div id="2nd-year-1st-sem"><!-- Start of First Semester Subjects -->
                                                    <form action="managedata.php" method="POST">
                                                        <input type="hidden" name="studid" value="<?php echo $Studid?>">
                                                        <input type="hidden" name="currid" value="<?php echo $Currid ?>">
                                                        <div class="row mb-2" style="background-color: #C0C0C0;">
                                                            <div class="col mt-3 mb-3" align="left">
                                                                <span class="text-uppercase fw-bold">2nd Year - 1st Semester</span>
                                                            </div>
                                                            <div class="col mt-2" align="right">
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
                                                                <th ><center>Lec</center></th>
                                                                <th ><center>Lab</center></th>
                                                                <th ><center>Units</center></th>
                                                                <th ><center>Prerequisite</center></th>
                                                                <th ><center>Grades</center></th>
                                                                <th hidden><center>year</center></th>
                                                                <th hidden><center>semester</center></th>
                                                                <th hidden><center>subid</center></th>
                                                                <th ><center>SY</center></th>
                                                                <th ><center>Remarks</center></th>
                                                                <th hidden><center>SY</center></th>
                                                                <th hidden><center>Total Grades</center></th>
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
                                                else if($PreID && $Grades == "CREDITED" && $Remarks == "CREDITED")
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
                                                            <div class="form-group hide_2nd_grade_1st" style="width: 7rem; display: none;">
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
                                                                <div class="form-group hide_2nd_grade_1st" style="width: 7rem; display: none;">
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
                                                            <td ><center><?php echo $Remarks ?></center></td>
                                                            <td hidden><center><?php echo $SY ?></center></td>
                                                            <td hidden><center><?php echo $total_grade_units ?></center></td>
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
                                                                <td></td>
                                                                <td></td>
                                                                <td hidden></td>
                                                                <td hidden></td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                    </form>
                                    </div><!-- End of First Semester Subjects -->

                                    <div id="2nd-year-2nd-sem"><!-- Start of Second Semester Subjects -->
                                                    <form action="managedata.php" method="POST">
                                                        <input type="hidden" name="studid" value="<?php echo $Studid?>">
                                                        <input type="hidden" name="currid" value="<?php echo $Currid ?>">
                                                        <div class="row mb-2" style="background-color: #C0C0C0;">
                                                            <div class="col mt-3 mb-3" align="left">
                                                                <span class="text-uppercase fw-bold">2nd Year - 2nd Semester</span>
                                                            </div>
                                                            <div class="col mt-2" align="right">
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
                                                                <th ><center>Lec</center></th>
                                                                <th ><center>Lab</center></th>
                                                                <th ><center>Units</center></th>
                                                                <th ><center>Prerequisite</center></th>
                                                                <th ><center>Grades</center></th>
                                                                <th hidden><center>year</center></th>
                                                                <th hidden><center>semester</center></th>
                                                                <th hidden><center>subid</center></th>
                                                                <th ><center>SY</center></th>
                                                                <th ><center>Remarks</center></th>
                                                                <th hidden><center>SY</center></th>
                                                                <th hidden><center>Total Grades</center></th>
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
                                                else if($PreID && $Grades == "CREDITED" && $Remarks == "CREDITED")
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
                                                            <div class="form-group hide_2nd_grade_2nd" style="width: 7rem; display: none;">
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
                                                                <div class="form-group hide_2nd_grade_2nd" style="width: 7rem; display: none;">
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
                                                            <td ><center><?php echo $Remarks ?></center></td>
                                                            <td hidden><center><?php echo $SY ?></center></td>
                                                            <td hidden><center><?php echo $total_grade_units ?></center></td>
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
                                                                <td></td>
                                                                <td></td>
                                                                <td hidden></td>
                                                                <td hidden></td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                    </form>
                                    </div><!-- End of Second Semester Subjects -->

                                    <div id="2nd-year-summer-sem"><!-- Start of Summer Semester Subjects -->
                                                    <form action="managedata.php" method="POST">
                                                        <input type="hidden" name="studid" value="<?php echo $Studid?>">
                                                        <input type="hidden" name="currid" value="<?php echo $Currid ?>">
                                                        <div class="row mb-2" style="background-color: #C0C0C0;">
                                                            <div class="col mt-3 mb-3" align="left">
                                                                <span class="text-uppercase fw-bold">2nd Year - Summer Semester</span>
                                                            </div>
                                                            <div class="col mt-2" align="right">
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
                                                                <th ><center>Lec</center></th>
                                                                <th ><center>Lab</center></th>
                                                                <th ><center>Units</center></th>
                                                                <th ><center>Prerequisite</center></th>
                                                                <th ><center>Grades</center></th>
                                                                <th hidden><center>year</center></th>
                                                                <th hidden><center>semester</center></th>
                                                                <th hidden><center>subid</center></th>
                                                                <th ><center>SY</center></th>
                                                                <th ><center>Remarks</center></th>
                                                                <th hidden><center>SY</center></th>
                                                                <th hidden><center>Total Grades</center></th>
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
                                                else if($PreID && $Grades == "CREDITED" && $Remarks == "CREDITED")
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
                                                            <div class="form-group hide_2nd_grade_summer" style="width: 7rem; display: none;">
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
                                                                <div class="form-group hide_2nd_grade_summer" style="width: 7rem; display: none;">
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
                                                            <td ><center><?php echo $Remarks ?></center></td>
                                                            <td hidden><center><?php echo $SY ?></center></td>
                                                            <td hidden><center><?php echo $total_grade_units ?></center></td>
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
                                                                <td></td>
                                                                <td></td>
                                                                <td hidden></td>
                                                                <td hidden></td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                    </form>
                                    </div><!-- End of Summer Semester Subjects -->
                                </div>
                                <!--End of Second Year Subjects -->
                                <!-- Start Third Year Subjects -->
                                <div>
                                    <div id="3rd-year-1st-sem"><!-- Start of First Semester Subjects -->
                                                    <form action="managedata.php" method="POST">
                                                        <input type="hidden" name="studid" value="<?php echo $Studid?>">
                                                        <input type="hidden" name="currid" value="<?php echo $Currid ?>">
                                                        <div class="row mb-2" style="background-color: #C0C0C0;">
                                                            <div class="col mt-3 mb-3" align="left">
                                                                <span class="text-uppercase fw-bold">3rd Year - 1st Semester</span>
                                                            </div>
                                                            <div class="col mt-2" align="right">
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
                                                                <th ><center>Lec</center></th>
                                                                <th ><center>Lab</center></th>
                                                                <th ><center>Units</center></th>
                                                                <th ><center>Prerequisite</center></th>
                                                                <th ><center>Grades</center></th>
                                                                <th hidden><center>year</center></th>
                                                                <th hidden><center>semester</center></th>
                                                                <th hidden><center>subid</center></th>
                                                                <th ><center>SY</center></th>
                                                                <th ><center>Remarks</center></th>
                                                                <th hidden><center>SY</center></th>
                                                                <th hidden><center>Total Grades</center></th>
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
                                                else if($PreID && $Grades == "CREDITED" && $Remarks == "CREDITED")
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
                                                            <div class="form-group hide_3rd_grade_1st" style="width: 7rem; display: none;">
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
                                                                <div class="form-group hide_3rd_grade_1st" style="width: 7rem; display: none;">
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
                                                            <td ><center><?php echo $Remarks ?></center></td>
                                                            <td hidden><center><?php echo $SY ?></center></td>
                                                            <td hidden><center><?php echo $total_grade_units ?></center></td>
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
                                                                <td></td>
                                                                <td></td>
                                                                <td hidden></td>
                                                                <td hidden></td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                    </form>
                                    </div><!-- End of First Semester Subjects -->

                                    <div id="3rd-year-2nd-sem"><!-- Start of Second Semester Subjects -->
                                                    <form action="managedata.php" method="POST">
                                                        <input type="hidden" name="studid" value="<?php echo $Studid?>">
                                                        <input type="hidden" name="currid" value="<?php echo $Currid ?>">
                                                        <div class="row mb-2" style="background-color: #C0C0C0;">
                                                            <div class="col mt-3 mb-3" align="left">
                                                                <span class="text-uppercase fw-bold">3rd Year - 2nd Semester</span>
                                                            </div>
                                                            <div class="col mt-2" align="right">
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
                                                                <th ><center>Lec</center></th>
                                                                <th ><center>Lab</center></th>
                                                                <th ><center>Units</center></th>
                                                                <th ><center>Prerequisite</center></th>
                                                                <th ><center>Grades</center></th>
                                                                <th hidden><center>year</center></th>
                                                                <th hidden><center>semester</center></th>
                                                                <th hidden><center>subid</center></th>
                                                                <th ><center>SY</center></th>
                                                                <th ><center>Remarks</center></th>
                                                                <th hidden><center>SY</center></th>
                                                                <th hidden><center>Total Grades</center></th>
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
                                                else if($PreID && $Grades == "CREDITED" && $Remarks == "CREDITED")
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
                                                            <div class="form-group hide_3rd_grade_2nd" style="width: 7rem; display: none;">
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
                                                                <div class="form-group hide_3rd_grade_2nd" style="width: 7rem; display: none;">
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
                                                            <td ><center><?php echo $Remarks ?></center></td>
                                                            <td hidden><center><?php echo $SY ?></center></td>
                                                            <td hidden><center><?php echo $total_grade_units ?></center></td>
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
                                                                <td></td>
                                                                <td></td>
                                                                <td hidden></td>
                                                                <td hidden></td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                    </form>
                                    </div><!-- End of Second Semester Subjects -->

                                    <div id="3rd-year-summer-sem"><!-- Start of Summer Semester Subjects -->
                                                    <form action="managedata.php" method="POST">
                                                        <input type="hidden" name="studid" value="<?php echo $Studid?>">
                                                        <input type="hidden" name="currid" value="<?php echo $Currid ?>">
                                                        <div class="row mb-2" style="background-color: #C0C0C0;">
                                                            <div class="col mt-3 mb-3" align="left">
                                                                <span class="text-uppercase fw-bold">3rd Year - Summer Semester</span>
                                                            </div>
                                                            <div class="col mt-2" align="right">
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
                                                                <th ><center>Lec</center></th>
                                                                <th ><center>Lab</center></th>
                                                                <th ><center>Units</center></th>
                                                                <th ><center>Prerequisite</center></th>
                                                                <th ><center>Grades</center></th>
                                                                <th hidden><center>year</center></th>
                                                                <th hidden><center>semester</center></th>
                                                                <th hidden><center>subid</center></th>
                                                                <th ><center>SY</center></th>
                                                                <th ><center>Remarks</center></th>
                                                                <th hidden><center>SY</center></th>
                                                                <th hidden><center>Total Grades</center></th>
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
                                                else if($PreID && $Grades == "CREDITED" && $Remarks == "CREDITED")
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
                                                            <div class="form-group hide_3rd_grade_summer" style="width: 7rem; display: none;">
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
                                                                <div class="form-group hide_3rd_grade_summer" style="width: 7rem; display: none;">
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
                                                            <th ><center>Remarks</center></th>
                                                            <td hidden><center><?php echo $SY ?></center></td>
                                                            <td hidden><center><?php echo $total_grade_units ?></center></td>
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
                                                                <td></td>
                                                                <td></td>
                                                                <td hidden></td>
                                                                <td hidden></td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                    </form>
                                    </div><!-- End of Summer Semester Subjects -->
                                </div>
                                <!--End of Third Year Subjects -->
                                <!-- Start Fourth Year Subjects -->
                                <div>
                                    <div id="4th-year-1st-sem"><!-- Start of First Semester Subjects -->
                                                    <form action="managedata.php" method="POST">
                                                        <input type="hidden" name="studid" value="<?php echo $Studid?>">
                                                        <input type="hidden" name="currid" value="<?php echo $Currid ?>">
                                                        <div class="row mb-2" style="background-color: #C0C0C0;">
                                                            <div class="col mt-3 mb-3" align="left">
                                                                <span class="text-uppercase fw-bold">4th Year - 1st Semester</span>
                                                            </div>
                                                            <div class="col mt-2" align="right">
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
                                                                <th ><center>Lec</center></th>
                                                                <th ><center>Lab</center></th>
                                                                <th ><center>Units</center></th>
                                                                <th ><center>Prerequisite</center></th>
                                                                <th ><center>Grades</center></th>
                                                                <th hidden><center>year</center></th>
                                                                <th hidden><center>semester</center></th>
                                                                <th hidden><center>subid</center></th>
                                                                <th ><center>SY</center></th>
                                                                <th ><center>Remarks</center></th>
                                                                <th hidden><center>SY</center></th>
                                                                <th hidden><center>Total Grades</center></th>
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
                                                else if($PreID && $Grades == "CREDITED" && $Remarks == "CREDITED")
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
                                                            <div class="form-group hide_4th_grade_1st" style="width: 7rem; display: none;">
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
                                                                <div class="form-group hide_4th_grade_1st" style="width: 7rem; display: none;">
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
                                                            <td ><center><?php echo $Remarks ?></center></td>
                                                            <td hidden><center><?php echo $SY ?></center></td>
                                                            <td hidden><center><?php echo $total_grade_units ?></center></td>
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
                                                                <td></td>
                                                                <td></td>
                                                                <td hidden></td>
                                                                <td hidden></td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                    </form>
                                    </div><!-- End of First Semester Subjects -->

                                    <div id="4th-year-2nd-sem"><!-- Start of Second Semester Subjects -->
                                                    <form action="managedata.php" method="POST">
                                                        <input type="hidden" name="studid" value="<?php echo $Studid?>">
                                                        <input type="hidden" name="currid" value="<?php echo $Currid ?>">
                                                        <div class="row mb-2" style="background-color: #C0C0C0;">
                                                            <div class="col mt-3 mb-3" align="left">
                                                                <span class="text-uppercase fw-bold">4th Year - 2nd Semester</span>
                                                            </div>
                                                            <div class="col mt-2" align="right">
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
                                                                <th ><center>Lec</center></th>
                                                                <th ><center>Lab</center></th>
                                                                <th ><center>Units</center></th>
                                                                <th ><center>Prerequisite</center></th>
                                                                <th ><center>Grades</center></th>
                                                                <th hidden><center>year</center></th>
                                                                <th hidden><center>semester</center></th>
                                                                <th hidden><center>subid</center></th>
                                                                <th ><center>SY</center></th>
                                                                <th ><center>Remarks</center></th>
                                                                <th hidden><center>SY</center></th>
                                                                <th hidden><center>Total Grades</center></th>
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
                                                else if($PreID && $Grades == "CREDITED" && $Remarks == "CREDITED")
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

                                                            <div class="form-group hide_4th_grade_2nd" style="width: 7rem; display: none;">
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
                                                                <div class="form-group hide_4th_grade_2nd" style="width: 7rem; display: none;">
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
                                                            <td ><center><?php echo $Remarks ?></center></td>
                                                            <td hidden><center><?php echo $SY ?></center></td>
                                                            <td hidden><center><?php echo $total_grade_units ?></center></td>
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
                                                                <td></td>
                                                                <td></td>
                                                                <td hidden></td>
                                                                <td hidden></td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                    </form>
                                    </div><!-- End of Second Semester Subjects -->

                                    <div id="4th-year-summer-sem"><!-- Start of Summer Semester Subjects -->
                                                    <form action="managedata.php" method="POST">
                                                        <input type="hidden" name="studid" value="<?php echo $Studid?>">
                                                        <input type="hidden" name="currid" value="<?php echo $Currid ?>">
                                                        <div class="row mb-2" style="background-color: #C0C0C0;">
                                                            <div class="col mt-3 mb-3" align="left">
                                                                <span class="text-uppercase fw-bold">4th Year - Summer Semester</span>
                                                            </div>
                                                            <div class="col mt-2" align="right">
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
                                                                <th ><center>Lec</center></th>
                                                                <th ><center>Lab</center></th>
                                                                <th ><center>Units</center></th>
                                                                <th ><center>Prerequisite</center></th>
                                                                <th ><center>Grades</center></th>
                                                                <th hidden><center>year</center></th>
                                                                <th hidden><center>semester</center></th>
                                                                <th hidden><center>subid</center></th>
                                                                <th ><center>SY</center></th>
                                                                <th ><center>Remarks</center></th>
                                                                <th hidden><center>SY</center></th>
                                                                <th hidden><center>Total Grades</center></th>
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
                                                else if($PreID && $Grades == "CREDITED" && $Remarks == "CREDITED")
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
                                                            <div class="form-group hide_4th_grade_summer" style="width: 7rem; display: none;">
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
                                                                <div class="form-group hide_4th_grade_summer" style="width: 7rem; display: none;">
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
                                                            <td ><center><?php echo $Remarks ?></center></td>
                                                            <td hidden><center><?php echo $SY ?></center></td>
                                                            <td hidden><center><?php echo $total_grade_units ?></center></td>
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
                                                                <td></td>
                                                                <td></td>
                                                                <td hidden></td>
                                                                <td hidden></td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                    </form>
                                    </div><!-- End of Summer Semester Subjects -->
                                </div>
                                <!--End of Fourth Year Subjects -->
                                <!-- Start Fifth Year Subjects -->
                                <div>
                                    <div id="5th-year-1st-sem"><!-- Start of First Semester Subjects -->
                                                    <form action="managedata.php" method="POST">
                                                        <input type="hidden" name="studid" value="<?php echo $Studid?>">
                                                        <input type="hidden" name="currid" value="<?php echo $Currid ?>">
                                                        <div class="row mb-2" style="background-color: #C0C0C0;">
                                                            <div class="col mt-3 mb-3" align="left">
                                                                <span class="text-uppercase fw-bold">5th Year - 1st Semester</span>
                                                            </div>
                                                            <div class="col mt-2" align="right">
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
                                                                <th ><center>Lec</center></th>
                                                                <th ><center>Lab</center></th>
                                                                <th ><center>Units</center></th>
                                                                <th ><center>Prerequisite</center></th>
                                                                <th ><center>Grades</center></th>
                                                                <th hidden><center>year</center></th>
                                                                <th hidden><center>semester</center></th>
                                                                <th hidden><center>subid</center></th>
                                                                <th ><center>SY</center></th>
                                                                <th ><center>Remarks</center></th>
                                                                <th hidden><center>SY</center></th>
                                                                <th hidden><center>Total Grades</center></th>
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
                                                else if($PreID && $Grades == "CREDITED" && $Remarks == "CREDITED")
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
                                                            <div class="form-group hide_5th_grade_1st" style="width: 7rem; display: none;">
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
                                                                <div class="form-group hide_5th_grade_1st" style="width: 7rem; display: none;">
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
                                                            <td ><center><?php echo $Remarks ?></center></td>
                                                            <td hidden><center><?php echo $SY ?></center></td>
                                                            <td hidden><center><?php echo $total_grade_units ?></center></td>
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
                                                                <td></td>
                                                                <td></td>
                                                                <td hidden></td>
                                                                <td hidden></td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                    </form>
                                    </div><!-- End of First Semester Subjects -->

                                    <div id="5th-year-2nd-sem"><!-- Start of Second Semester Subjects -->
                                                    <form action="managedata.php" method="POST">
                                                        <input type="hidden" name="studid" value="<?php echo $Studid?>">
                                                        <input type="hidden" name="currid" value="<?php echo $Currid ?>">
                                                        <div class="row mb-2" style="background-color: #C0C0C0;">
                                                            <div class="col mt-3 mb-3" align="left">
                                                                <span class="text-uppercase fw-bold">5th Year - 2nd Semester</span>
                                                            </div>
                                                            <div class="col mt-2" align="right">
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
                                                                <th ><center>Lec</center></th>
                                                                <th ><center>Lab</center></th>
                                                                <th ><center>Units</center></th>
                                                                <th ><center>Prerequisite</center></th>
                                                                <th ><center>Grades</center></th>
                                                                <th hidden><center>year</center></th>
                                                                <th hidden><center>semester</center></th>
                                                                <th hidden><center>subid</center></th>
                                                                <th ><center>SY</center></th>
                                                                <th ><center>Remarks</center></th>
                                                                <th hidden><center>SY</center></th>
                                                                <th hidden><center>Total Grades</center></th>
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
                                                else if($PreID && $Grades == "CREDITED" && $Remarks == "CREDITED")
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
                                                            <div class="form-group hide_5th_grade_2nd" style="width: 7rem; display: none;">
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
                                                                <div class="form-group hide_5th_grade_2nd" style="width: 7rem; display: none;">
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
                                                            <td ><center><?php echo $Remarks ?></center></td>
                                                            <td hidden><center><?php echo $SY ?></center></td>
                                                            <td hidden><center><?php echo $total_grade_units ?></center></td>
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
                                                                <td></td>
                                                                <td></td>
                                                                <td hidden></td>
                                                                <td hidden></td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                    </form>
                                    </div><!-- End of Second Semester Subjects -->

                                    <div id="5th-year-summer-sem"><!-- Start of Summer Semester Subjects -->
                                                    <form action="managedata.php" method="POST">
                                                        <input type="hidden" name="studid" value="<?php echo $Studid?>">
                                                        <input type="hidden" name="currid" value="<?php echo $Currid ?>">
                                                        <div class="row mb-2" style="background-color: #C0C0C0;">
                                                            <div class="col mt-3 mb-3" align="left">
                                                                <span class="text-uppercase fw-bold">5th Year - Summer Semester</span>
                                                            </div>
                                                            <div class="col mt-2" align="right">
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
                                                                <th ><center>Lec</center></th>
                                                                <th ><center>Lab</center></th>
                                                                <th ><center>Units</center></th>
                                                                <th ><center>Prerequisite</center></th>
                                                                <th ><center>Grades</center></th>
                                                                <th hidden><center>year</center></th>
                                                                <th hidden><center>semester</center></th>
                                                                <th hidden><center>subid</center></th>
                                                                <th ><center>SY</center></th>
                                                                <th ><center>Remarks</center></th>
                                                                <th hidden><center>SY</center></th>
                                                                <th hidden><center>Total Grades</center></th>
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
                                                else if($PreID && $Grades == "CREDITED" && $Remarks == "CREDITED")
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
                                                            <div class="form-group hide_5th_grade_summer" style="width: 7rem; display: none;">
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
                                                                <div class="form-group hide_5th_grade_summer" style="width: 7rem; display: none;">
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
                                                            <td ><center><?php echo $Remarks ?></center></td>
                                                            <td hidden><center><?php echo $SY ?></center></td>
                                                            <td hidden><center><?php echo $total_grade_units ?></center></td>
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
                                                                <td></td>
                                                                <td></td>
                                                                <td hidden></td>
                                                                <td hidden></td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                    </form>
                                    </div><!-- End of Summer Semester Subjects -->
                                </div>
                                <!--End of Fifth Year Subjects -->
						    </div>
						<div class="modal-footer">
                            <div align="left">
                                <span class="fas fa-info-circle" tabindex="0" data-toggle="tooltip" 
                                title="Check School Year Input First Before saving with grade. You can't change it if you save it already." 
                                style="font-size: 1.8rem;">
                                </span>
                            </div>
                            <div class="ml-4" align="right">
                                <div class="dropdown">
                                    <button class="btn btn-warning text-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Select Year and Semester
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#1st-year-1st-sem">1st Year-1st Semester</a>
                                        <a class="dropdown-item" href="#1st-year-2nd-sem">1st Year-2nd Semester</a>
                                        <a class="dropdown-item" href="#1st-year-summer-sem">1st Year-Summer Semester</a>
                                        <a class="dropdown-item" href="#2nd-year-1st-sem">2nd Year-1st Semester</a>
                                        <a class="dropdown-item" href="#2nd-year-2nd-sem">2nd Year-2nd Semester</a>
                                        <a class="dropdown-item" href="#2nd-year-summer-sem">2nd Year-Summer Semester</a>
                                        <a class="dropdown-item" href="#3rd-year-1st-sem">3rd Year-1st Semester</a>
                                        <a class="dropdown-item" href="#3rd-year-2nd-sem">3rd Year-2nd Semester</a>
                                        <a class="dropdown-item" href="#3rd-year-summer-sem">3rd Year-Summer Semester</a>
                                        <a class="dropdown-item" href="#4th-year-1st-sem">4th Year-1st Semester</a>
                                        <a class="dropdown-item" href="#4th-year-2nd-sem">4th Year-2nd Semester</a>
                                        <a class="dropdown-item" href="#4th-year-summer-sem">4th Year-Summer Semester</a>
                                        <a class="dropdown-item" href="#5th-year-1st-sem">5th Year-1st Semester</a>
                                        <a class="dropdown-item" href="#5th-year-2nd-sem">5th Year-2nd Semester</a>
                                        <a class="dropdown-item" href="#5th-year-summer-sem">5th Year-Summer Semester</a>
                                    </div>
                                </div>
                            </div>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>  
					</div>
				</div>
			</div>
		</div>
		<!-- End of View Students Subjects with Grades Modal -->

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
