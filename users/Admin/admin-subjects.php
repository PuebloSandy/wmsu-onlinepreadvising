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
    <!-- Select 2 JQuery -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- local css -->
    <link rel="stylesheet" href="../../source/css/style-admin.css" />
    <link rel="stylesheet" href="../../source/preloader/loader.css" />
    <title>Subjects</title>
</head>
<body onmousemove="reset_interval()" onclick="reset_interval()" onkeypress="reset_interval()" onscroll="reset_interval()">
<?php
	if(isset($_SESSION['login_user']))
	{
            $_SESSION['last_login_time'] = time();
			$usertype = "Admin";
            $username = $_SESSION['login_user'];
            $sql = "SELECT * usertype='Admin' FROM tbluser";
            $result = mysqli_query($connection,$sql);

            $get_user = mysqli_query($connection,"SELECT * FROM tbluser WHERE email='$username'");
            while($getuser=mysqli_fetch_array($get_user))
            {
                $adminid = $getuser['id'];
                $firstname = $getuser['firstname'];
                $lastname = $getuser['lastname'];
                $full = ucfirst($firstname).' '.ucfirst($lastname);
                $collegeid = $getuser['college_id_fk'];
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
            <a class="navbar-brand p-0 m-0" href="admin-homepage.php" id="nav-logo">
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
                        <a class="nav-link active py-0" aria-current="page" href="admin-homepage.php"><i id="icons" class="fas fa-home"></i><span class="nav-label"> Home</span></a>
                    </li>
                    <!-- Profile -->
                    <li class="nav-item">
                        <a class="nav-link active py-0" aria-current="page" href="admin-profile.php"><i id="icons" class="fas fa-user-tie"></i><span class="nav-label"> My Profile</span></a>
                    </li>
                    <!-- notifications -->
						<li class="nav-item dropstart">
							<?php
								$check_adviser_req = "SELECT count(id) FROM tblrequest_account WHERE req_usertype='Adviser' and user_id_fk='$adminid'";
								$adviser_check = mysqli_query($connection,$check_adviser_req);
								$adviser_total = mysqli_fetch_array($adviser_check);
								$adviser_row = $adviser_total[0];

								$total_noti = $adviser_row;
							?>
							<a class="nav-link dropstart active py-0" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false"> <i id="icons" class="fas fa-bell"></i><span class="badge rounded-pill bg-info text-white align-text-top" id="notif-number"><?php echo $total_noti ?></span><span class="nav-label"> Notifications</span> </a>
							<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
								<li>
								<?php
									if($adviser_row == 0){
										echo '<a class="dropdown-item" href="#">
											<span class="badge bg-success">Account</span>
											<span class="font-weight-bold" aria-disabled="true">
											There is no Request </a>';	
									}
									else
									{
										$notif_num = mysqli_query($connection,"SELECT * FROM tblrequest_account WHERE req_usertype='Adviser' and user_id_fk='$adminid'");
										echo'<a data-toggle="modal" data-target="#manage-request" class="dropdown-item" href="#">
											<span class="badge bg-success">Account</span>
											<span class="font-weight-bold" aria-disabled="true">';
											$notif_count = mysqli_num_rows($notif_num);	
										echo 'REQUEST ACCOUNT '.$notif_count;	
											while($fa=mysqli_fetch_array($notif_num))
											{
												$req_adviser_id = $fa['id'];
											}
										echo'</a>';
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
    <?php
        $id = $_SESSION['currid'];
        $discurr = mysqli_query($connection , "SELECT * FROM tblcurriculum WHERE id='$id'");
        while($fa_c = mysqli_fetch_array($discurr))
        {
            $curr_id = $fa_c['id'];
            $curr_code  = $fa_c['curr_code'];
            $cmo  = $fa_c['cmo'];
            $br  = $fa_c['board_reso'];
            $esy  = $fa_c['effectiveSY'];
            $od  = $fa_c['other_details'];

            $curr_courseid  = $fa_c['course_id_fk'];
            $getcourse = mysqli_query($connection , "SELECT * FROM tblcourse WHERE id='$curr_courseid'");
            while($get = mysqli_fetch_array($getcourse))
            {
                $course = $get['course'];
                $Course = strtoupper($course);
                $coursecode = $get['coursecode'];
            }
        }
    ?>
    <div class="container border mt-4">
        <div class="row border-bottom mt-2">
            <div class="col">
                <button type="button" class="btn btn-secondary fas fa-chevron-left mb-2" onclick="location.href='admin-curriculum.php'"> Back</button>
            </div>

            <div class="col" align="right">
                <button type="button" class="btn rounded btn-success p-2 fas fa-clipboard" title="Add Subjects" data-toggle="modal" data-target="#addSubjectsmodal"> Add Subjects</button>
            <?php
                $select_student = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE curri_id='$id' and course_id_fk='$curr_courseid'");
                if(mysqli_num_rows($select_student) == 0)
                {
            ?>
                <button type="button" class="btn rounded btn-danger p-2 fas fa-trash-alt" title="Delete All Subjects" data-toggle="modal" data-target="#deleteAllSubjectModal"> Delete All Subjects</button>
            <?php
                }
            ?>
                <!--<button type="button" class="btn btn-info fas fa-edit mb-2"> Edit</button>-->
            </div>
        </div>
        <p class="text mt-4 text-danger fw-bold text-center fs-3" style="cursor: default;"><?php echo $Course;echo "($coursecode)"?></p>
        <p class="text mt-2 text-danger text-uppercase fw-bold text-center fs-4" style="cursor: default;">Subjects</p>

        <div class="row justify-content-md-center text-center text-danger fw-bold fs-5 mb-3" style="cursor: default;">
            <div class="col col-lg-4 p-2 border-bottom border-danger">
                <span>CMO No. : <?php echo $cmo ?></span>
            </div>
            <div class="col-md-auto p-2 border-bottom border-danger">
                <span>BR No. : <?php echo $br ?></span>
            </div>
            <div class="col col-lg-4 p-2 border-bottom border-danger">
                <span>Effective S.Y: <?php echo $esy ?></span>
            </div>
        </div>
	</div>

    <!-- TABLE -->
    <div class="container p-2 container-fluid border mt-2 mb-5" >
        <div class="container overflow-auto" >
            <div class="row border-bottom mb-2">
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
            
            <!-- First Year table -->
            <div class="mb-4" id="firstYear">
                <div class="mt-4 mb-3" align="right"></div>
                <div class="border-bottom" id="1st-sem">
                    <div class="border-top text-center mt-2 mb-2">
                        <span class="fw-bold text-center fs-3 mt-2">1st Semester</span>
                    </div>
            <?php
                $check_1st_sem_1st = mysqli_query($connection,"SELECT * FROM tblsubject WHERE status='1' and curr_id_fk='$id' and course_id_fk='$curr_courseid' and yearlevel='1' and semester='1st'");
            ?>
                    <table class="table table-striped" id="table1" width="100%">
                        <thead class="text-white">
                            <tr>
                                <th hidden>id</th>
                                <th><center>Code</center></th>
                                <th width="25%"><center>Title</center></th>
                                <th scope="col"><center>Lec Hrs</center></th>
                                <th scope="col"><center>Lab Hrs</center></th>
                                <th scope="col"><center>Units</center></th>
                                <th scope="col"><center>Prerequisite</center></th>
                                <th hidden><center>Semester</center></th>
                                <th hidden><center>Year</center></th>
                                <th scope="col"><center>Action</center></th>
                            </tr>
                        </thead>
                        <tbody>
            <?php
                if(mysqli_num_rows($check_1st_sem_1st) > 0)
                {
                    while($fa = mysqli_fetch_array($check_1st_sem_1st))
                    {
                        $sub_id_fk = $fa['id'];
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
                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$sub_id_fk' and curri_id_fk='$id' and course_id_fk='$curr_courseid'";
                            $get_check = mysqli_query($connection,$checkprereq);
                            $Rows = mysqli_fetch_array($get_check);
                            $SubID = $Rows[0];
                            
                            if($SubID == 1)
                            {
            ?>           
                        <td><center>
            <?php
                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$sub_id_fk' and curri_id_fk='$id' and course_id_fk='$curr_courseid'";
                                $checkpreq = mysqli_query($connection,$getpreq);
                                foreach($checkpreq as $rows)
                                {
                                    $IDpre = $rows['id'];
                                    $new = $rows['subject_id'];    
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$new' and curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
                                        $subCode = $sa['subject_code'];
            ?>
                                <span id="idprereq1st11st<?php echo $IDpre?>" hidden><?php echo $IDpre?></span>
                                <button type="button" title="Edit" class="btn btn-white text-dark fw-bold border editSubject1st11stPreqModal" value="<?php echo $IDpre?>"><?php print_r($sa['subject_code']);?></button><button class="btn btn-danger fas fa-times fs-6 ml-1 p-1 deleteprereqfirstSubject11stbtn" title="delete" value="<?php echo $IDpre?>"></button>
            <?php
                                    }
                                }
            ?>
                        </center></td>
            <?php
                            }
                            else if($SubID > 1)
                            {
            ?>
                        <td><center>
            <?php
                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$sub_id_fk' and curri_id_fk='$id' and course_id_fk='$curr_courseid'");
                                foreach($getpreq as $rows)
                                {
                                    $IDpre = $rows['id'];
                                    $news = $rows['subject_id']; 
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$news' and curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
            ?>
                                <span id="idprereq1st21st<?php echo $IDpre?>" hidden><?php echo $IDpre?></span>
                                <button type="button" title="Edit" class="btn btn-white text-dark fw-bold border editSubject1st21stPreqModal" value="<?php echo $IDpre?>"><?php print_r($sa['subject_code']);?></button><button class="btn btn-danger fas fa-times fs-6 ml-1 p-1 deleteprereqfirstSubject21stbtn" title="delete" value="<?php echo $IDpre?>"></button><?php echo "<br/>";?>
            <?php
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
                        <td><center>
                            <button class="btn btn-white" type="button" title="More Option" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="cursor: pointer;">
                                <a class="dropdown-item editFirstubject1stbtn" title="Edit">Edit Subject</a>
            <?php
                $select_student = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE subject_id_fk='$sub_id_fk' and curri_id='$id' and course_id_fk='$curr_courseid'");
                if(mysqli_num_rows($select_student) == 0)
                {
            ?>
                                <a class="dropdown-item deleteFirstSubject1stbtn" title="Delete" >Delete Subject</a>
            <?php
                }
            ?>
                                <a class="dropdown-item addfirstPrereq21stbtn" title="Add" >Add Prerequisite</a>
                            </div>
                            <!--<button style="font-size: 1.3rem;" title="Edit" class="fas fa-edit btn rounded btn-success editFirstubject1stbtn"></button>
                            <button style="font-size: 1.3rem;" title="Delete" class="fas fa-trash-alt btn rounded btn-danger deleteFirstSubject1stbtn"></button>-->
                        </center></td>
                    </tr>
            <?php
                    }
                }
                        $select_units = "SELECT sum(units) FROM tblsubject WHERE status='1' and curr_id_fk='$id' and course_id_fk='$curr_courseid' and yearlevel='1' and semester='1st'";
                        $count_units = mysqli_query($connection,$select_units);
                        $units_count = mysqli_fetch_array($count_units);
                        $Total_units_1_1st = $units_count[0];
            ?>
                        </tbody>
                        <tfoot >	
                            <!-- table footer -->
                            <tr style="vertical-align: bottom;">
                                <td hidden></td>
                                <td></td>
                                <td class="fw-bold"><center>Total: </center></td>
                                <td class="fw-bold"><center></center></td>
                                <td class="fw-bold"><center></center></td>
                                <td class="fw-bold"><center><?php echo $Total_units_1_1st?></center></td>
                                <td></td>
                                <td hidden></td>
                                <td hidden></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="border-bottom" id="1st-sem">
                    <div class="border-top text-center mt-2 mb-2">
                        <span class="fw-bold text-center fs-3 mt-2">2nd Semester</span>
                    </div>
            <?php
                $check_1st_sem_2nd = mysqli_query($connection,"SELECT * FROM tblsubject WHERE status='1' and curr_id_fk='$id' and course_id_fk='$curr_courseid' and yearlevel='1' and semester='2nd'");
            ?>
                    <table class="table table-striped" id="table12nd" width="100%">
                        <thead class="text-white">
                            <tr>
                                <th hidden>id</th>
                                <th><center>Code</center></th>
                                <th width="25%"><center>Title</center></th>
                                <th scope="col"><center>Lec Hrs</center></th>
                                <th scope="col"><center>Lab Hrs</center></th>
                                <th scope="col"><center>Units</center></th>
                                <th scope="col"><center>Prerequisite</center></th>
                                <th hidden><center>Semester</center></th>
                                <th hidden><center>Year</center></th>
                                <th scope="col"><center>Action</center></th>
                            </tr>
                        </thead>
                        <tbody>
            <?php
                if(mysqli_num_rows($check_1st_sem_2nd) > 0)
                {
                    while($fa = mysqli_fetch_array($check_1st_sem_2nd))
                    {
                        $sub_id_fk = $fa['id'];
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
                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$sub_id_fk' and curri_id_fk='$id' and course_id_fk='$curr_courseid'";
                            $get_check = mysqli_query($connection,$checkprereq);
                            $Rows = mysqli_fetch_array($get_check);
                            $SubID = $Rows[0];
                            
                            if($SubID == 1)
                            {
            ?>           
                        <td><center>
            <?php
                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$sub_id_fk' and curri_id_fk='$id' and course_id_fk='$curr_courseid'";
                                $checkpreq = mysqli_query($connection,$getpreq);
                                foreach($checkpreq as $rows)
                                {
                                    $IDpre = $rows['id'];
                                    $new = $rows['subject_id'];    
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$new' and curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
                                        $subCode = $sa['subject_code'];
            ?>
                                <span id="idprereq1st12nd<?php echo $IDpre?>" hidden><?php echo $IDpre?></span>
                                <button type="button" title="Edit" class="btn btn-white text-dark fw-bold border editSubject1st12ndPreqModal" value="<?php echo $IDpre?>"><?php print_r($sa['subject_code']);?></button><button class="btn btn-danger fas fa-times fs-6 ml-1 p-1 deleteprereqfirstSubject12ndbtn" title="delete" value="<?php echo $IDpre?>"></button>
            <?php
                                    }
                                }
            ?>
                        </center></td>
            <?php
                            }
                            else if($SubID > 1)
                            {
            ?>
                        <td><center>
            <?php
                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$sub_id_fk' and curri_id_fk='$id' and course_id_fk='$curr_courseid'");
                                foreach($getpreq as $rows)
                                {
                                    $IDpre = $rows['id'];
                                    $news = $rows['subject_id']; 
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$news' and curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
            ?>
                                <span id="idprereq1st22nd<?php echo $IDpre?>" hidden><?php echo $IDpre?></span>
                                <button type="button" title="Edit" class="btn btn-white text-dark fw-bold border editSubject1st22ndPreqModal" value="<?php echo $IDpre?>"><?php print_r($sa['subject_code']);?></button><button class="btn btn-danger fas fa-times fs-6 ml-1 p-1 deleteprereqfirstSubject22ndbtn" title="delete" value="<?php echo $IDpre?>"></button><?php echo "<br/>";?>
            <?php
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
                        <td><center>
                            <button class="btn btn-white" type="button" title="More Option" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="cursor: pointer;">
                                <a class="dropdown-item editFirstSubject2ndbtn" title="Edit">Edit Subject</a>
            <?php
                $select_student = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE subject_id_fk='$sub_id_fk' and curri_id='$id' and course_id_fk='$curr_courseid'");
                if(mysqli_num_rows($select_student) == 0)
                {
            ?>
                                <a class="dropdown-item deleteFirstSubject2ndbtn" title="Delete" >Delete Subject</a>
            <?php
                }
            ?>
                                <a class="dropdown-item addfirstPrereq22ndbtn" title="Add" >Add Prerequisite</a>
                            </div>
                            <!--<button style="font-size: 1.3rem;" title="Edit" class="fas fa-edit btn rounded btn-success editFirstSubject2ndbtn"></button>
                            <button style="font-size: 1.3rem;" title="Delete" class="fas fa-trash-alt btn rounded btn-danger deleteFirstSubject2ndbtn"></button>-->
                        </center></td>
                    </tr>
            <?php
                    }
                }
                        $select_units = "SELECT sum(units) FROM tblsubject WHERE status='1' and curr_id_fk='$id' and course_id_fk='$curr_courseid' and yearlevel='1' and semester='2nd'";
                        $count_units = mysqli_query($connection,$select_units);
                        $units_count = mysqli_fetch_array($count_units);
                        $Total_units_1_2nd = $units_count[0];
            ?>
                        </tbody>
                        <tfoot >	
                            <!-- table footer -->
                            <tr style="vertical-align: bottom;">
                                <td hidden></td>
                                <td></td>
                                <td class="fw-bold"><center>Total:</center></td>
                                <td class="fw-bold"><center></center></td>
                                <td class="fw-bold"><center></center></td>
                                <td class="fw-bold"><center><?php echo $Total_units_1_2nd?></center></td>
                                <td></td>
                                <td hidden></td>
                                <td hidden></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="border-bottom" id="1st-sem">
                    <div class="border-top text-center mt-2 mb-2">
                        <span class="fw-bold text-center fs-3 mt-2">Summer Semester</span>
                    </div>
            <?php
                $check_1st_sem_summer = mysqli_query($connection,"SELECT * FROM tblsubject WHERE status='1' and curr_id_fk='$id' and course_id_fk='$curr_courseid' and yearlevel='1' and semester='summer'");
            ?>
                    <table class="table table-striped" id="table1summer" width="100%">
                        <thead class="text-white">
                            <tr>
                                <th hidden>id</th>
                                <th><center>Code</center></th>
                                <th width="25%"><center>Title</center></th>
                                <th scope="col"><center>Lec Hrs</center></th>
                                <th scope="col"><center>Lab Hrs</center></th>
                                <th scope="col"><center>Units</center></th>
                                <th scope="col"><center>Prerequisite</center></th>
                                <th hidden><center>Semester</center></th>
                                <th hidden><center>Year</center></th>
                                <th scope="col"><center>Action</center></th>
                            </tr>
                        </thead>
                        <tbody>
            <?php
                if(mysqli_num_rows($check_1st_sem_summer) > 0)
                {
                    while($fa = mysqli_fetch_array($check_1st_sem_summer))
                    {
                        $sub_id_fk = $fa['id'];
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
                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$sub_id_fk' and curri_id_fk='$id' and course_id_fk='$curr_courseid'";
                            $get_check = mysqli_query($connection,$checkprereq);
                            $Rows = mysqli_fetch_array($get_check);
                            $SubID = $Rows[0];
                            
                            if($SubID == 1)
                            {
            ?>           
                        <td><center>
            <?php
                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$sub_id_fk' and curri_id_fk='$id' and course_id_fk='$curr_courseid'";
                                $checkpreq = mysqli_query($connection,$getpreq);
                                foreach($checkpreq as $rows)
                                {
                                    $IDpre = $rows['id'];
                                    $new = $rows['subject_id'];    
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$new' and curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
                                        $subCode = $sa['subject_code'];
            ?>
                                <span id="idprereq1st1summer<?php echo $IDpre?>" hidden><?php echo $IDpre?></span>
                                <button type="button" title="Edit" class="btn btn-white text-dark fw-bold border editSubject1st1summerPreqModal" value="<?php echo $IDpre?>"><?php print_r($sa['subject_code']);?></button><button class="btn btn-danger fas fa-times fs-6 ml-1 p-1 deleteprereqfirstSubject1summerbtn" title="delete" value="<?php echo $IDpre?>"></button>
            <?php
                                    }
                                }
            ?>
                        </center></td>
            <?php
                            }
                            else if($SubID > 1)
                            {
            ?>
                        <td><center>
            <?php
                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$sub_id_fk' and curri_id_fk='$id' and course_id_fk='$curr_courseid'");
                                foreach($getpreq as $rows)
                                {
                                    $IDpre = $rows['id'];
                                    $news = $rows['subject_id']; 
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$news' and curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
            ?>
                                <span id="idprereq1st2summer<?php echo $IDpre?>" hidden><?php echo $IDpre?></span>
                                <button type="button" title="Edit" class="btn btn-white text-dark fw-bold border editSubject1st2summerPreqModal" value="<?php echo $IDpre?>"><?php print_r($sa['subject_code']);?></button><button class="btn btn-danger fas fa-times fs-6 ml-1 p-1 deleteprereqfirstSubject2summerbtn" title="delete" value="<?php echo $IDpre?>"></button><?php echo "<br/>";?>
            <?php
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
                        <td><center>
                            <button class="btn btn-white" type="button" title="More Option" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="cursor: pointer;">
                                <a class="dropdown-item editFirstubject1stbtn" title="Edit">Edit Subject</a>
            <?php
                $select_student = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE subject_id_fk='$sub_id_fk' and curri_id='$id' and course_id_fk='$curr_courseid'");
                if(mysqli_num_rows($select_student) == 0)
                {
            ?>
                                <a class="dropdown-item deleteFirstSubject1stbtn" title="Delete" >Delete Subject</a>
            <?php
                }
            ?>
                                <a class="dropdown-item addfirstPrereq21stbtn" title="Add" >Add Prerequisite</a>
                            </div>
                            <!--<button style="font-size: 1.3rem;" title="Edit" class="fas fa-edit btn rounded btn-success editFirstubject1stbtn"></button>
                            <button style="font-size: 1.3rem;" title="Delete" class="fas fa-trash-alt btn rounded btn-danger deleteFirstSubject1stbtn"></button>-->
                        </center></td>
                    </tr>
            <?php
                    }
                }
                            $select_units = "SELECT sum(units) FROM tblsubject WHERE status='1' and curr_id_fk='$id' and course_id_fk='$curr_courseid' and yearlevel='1' and semester='summer'";
                            $count_units = mysqli_query($connection,$select_units);
                            $units_count = mysqli_fetch_array($count_units);
                            $Total_units_1_summer = $units_count[0];
            ?>
                        </tbody>
                        <tfoot >	
                            <!-- table footer -->
                            <tr style="vertical-align: bottom;">
                                <td hidden></td>
                                <td></td>
                                <td class="fw-bold"><center>Total: </center></td>
                                <td class="fw-bold"><center></center></td>
                                <td class="fw-bold"><center></center></td>
                                <td class="fw-bold"><center><?php echo $Total_units_1_summer?></center></td>
                                <td></td>
                                <td hidden></td>
                                <td hidden></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <!-- end of 1st Year subjects -->

            <!-- Start of 2nd Year Subjects -->
            <div class="mt-4 mb-4" id="secondYear">
                <div class="mb-3" align="right"></div>
                <div class="border-bottom" id="1st-sem">
                    <div class="border-top text-center mt-2 mb-2">
                        <span class="fw-bold text-center fs-3 mt-2">1st Semester</span>
                    </div>
            <?php
                $check_2nd_sem_1st = mysqli_query($connection,"SELECT * FROM tblsubject WHERE status='1' and curr_id_fk='$id' and course_id_fk='$curr_courseid' and yearlevel='2' and semester='1st'");
            ?>
                    <table class="table table-striped" id="table2" width="100%">
                        <thead class="text-white">
                            <tr>
                                <th hidden>id</th>
                                <th><center>Code</center></th>
                                <th width="25%"><center>Title</center></th>
                                <th scope="col"><center>Lec Hrs</center></th>
                                <th scope="col"><center>Lab Hrs</center></th>
                                <th scope="col"><center>Units</center></th>
                                <th scope="col"><center>Prerequisite</center></th>
                                <th hidden><center>Semester</center></th>
                                <th hidden><center>Year</center></th>
                                <th scope="col"><center>Action</center></th>
                            </tr>
                        </thead>
                        <tbody>
            <?php
                if(mysqli_num_rows($check_2nd_sem_1st) > 0)
                {
                    while($fa = mysqli_fetch_array($check_2nd_sem_1st))
                    {
                        $sub_id_fk = $fa['id'];
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
                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$sub_id_fk' and curri_id_fk='$id' and course_id_fk='$curr_courseid'";
                            $get_check = mysqli_query($connection,$checkprereq);
                            $Rows = mysqli_fetch_array($get_check);
                            $SubID = $Rows[0];
                            
                            if($SubID == 1)
                            {
            ?>           
                        <td><center>
            <?php
                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$sub_id_fk' and curri_id_fk='$id' and course_id_fk='$curr_courseid'";
                                $checkpreq = mysqli_query($connection,$getpreq);
                                foreach($checkpreq as $rows)
                                {
                                    $IDpre = $rows['id'];
                                    $new = $rows['subject_id'];    
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$new' and curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
                                        $subCode = $sa['subject_code'];
            ?>
                                <span id="idprereq2nd11st<?php echo $IDpre?>" hidden><?php echo $IDpre?></span>
                                <button type="button" title="Edit" class="btn btn-white text-dark fw-bold border editSubject2nd11stPreqModal" value="<?php echo $IDpre?>"><?php print_r($sa['subject_code']);?></button><button class="btn btn-danger fas fa-times fs-6 ml-1 p-1 deleteprereqsecondSubject11stbtn" title="delete" value="<?php echo $IDpre?>"></button>
            <?php
                                    }
                                }
            ?>
                        </center></td>
            <?php
                            }
                            else if($SubID > 1)
                            {
            ?>
                        <td><center>
            <?php
                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$sub_id_fk' and curri_id_fk='$id' and course_id_fk='$curr_courseid'");
                                foreach($getpreq as $rows)
                                {
                                    $IDpre = $rows['id'];
                                    $news = $rows['subject_id']; 
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$news' and curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
            ?>
                                <span id="idprereq2nd21st<?php echo $IDpre?>" hidden><?php echo $IDpre?></span>
                                <button type="button" title="Edit" class="btn btn-white text-dark fw-bold border editSubject2nd21stPreqModal" value="<?php echo $IDpre?>"><?php print_r($sa['subject_code']);?></button><button class="btn btn-danger fas fa-times fs-6 ml-1 p-1 deleteprereqsecondSubject21stbtn" title="delete" value="<?php echo $IDpre?>"></button><?php echo "<br/>";?>
            <?php
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
                        <td><center>
                            <button class="btn btn-white" type="button" title="More Option" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="cursor: pointer;">
                                <a class="dropdown-item editSecondSubject2ndbtn" title="Edit">Edit Subject</a>
            <?php
                $select_student = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE subject_id_fk='$sub_id_fk' and curri_id='$id' and course_id_fk='$curr_courseid'");
                if(mysqli_num_rows($select_student) == 0)
                {
            ?>
                                <a class="dropdown-item deleteSecondSubject2ndbtn" title="Delete" >Delete Subject</a>
            <?php
                }
            ?>
                                <a class="dropdown-item addsecondPrereq21stbtn" title="Add" >Add Prerequisite</a>
                            </div>
                            <!--<button style="font-size: 1.3rem;" title="Edit" class="fas fa-edit btn rounded btn-success editSecondSubject2ndbtn"></button>
                            <button style="font-size: 1.3rem;" title="Delete" class="fas fa-trash-alt btn rounded btn-danger deleteSecondSubject2ndbtn"></button>-->
                        </center></td>
                    </tr>
            <?php
                    }
                }
                            $select_units = "SELECT sum(units) FROM tblsubject WHERE status='1' and curr_id_fk='$id' and course_id_fk='$curr_courseid' and yearlevel='2' and semester='1st'";
                            $count_units = mysqli_query($connection,$select_units);
                            $units_count = mysqli_fetch_array($count_units);
                            $Total_units_2_1 = $units_count[0];
            ?>          
                        </tbody>
                        <tfoot >	
                            <!-- table footer -->
                            <tr style="vertical-align: bottom;">
                                <td hidden></td>
                                <td></td>
                                <td class="fw-bold"><center>Total: </center></td>
                                <td class="fw-bold"><center></center></td>
                                <td class="fw-bold"><center></center></td>
                                <td class="fw-bold"><center><?php echo $Total_units_2_1?></center></td>
                                <td></td>
                                <td hidden></td>
                                <td hidden></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="border-bottom" id="2nd-sem">
                    <div class="border-top text-center mt-2 mb-2">
                        <span class="fw-bold text-center fs-3 mt-2">2nd Semester</span>
                    </div>
            <?php
                $check_2nd_sem_2nd = mysqli_query($connection,"SELECT * FROM tblsubject WHERE status='1' and curr_id_fk='$id' and course_id_fk='$curr_courseid' and yearlevel='2' and semester='2nd'");
            ?>
                    <table class="table table-striped" id="table22nd" width="100%">
                        <thead class="text-white">
                            <tr>
                                <th hidden>id</th>
                                <th><center>Code</center></th>
                                <th width="25%"><center>Title</center></th>
                                <th scope="col"><center>Lec Hrs</center></th>
                                <th scope="col"><center>Lab Hrs</center></th>
                                <th scope="col"><center>Units</center></th>
                                <th scope="col"><center>Prerequisite</center></th>
                                <th hidden><center>Semester</center></th>
                                <th hidden><center>Year</center></th>
                                <th scope="col"><center>Action</center></th>
                            </tr>
                        </thead>
                        <tbody>
            <?php
                if(mysqli_num_rows($check_2nd_sem_2nd) > 0)
                {
                    while($fa = mysqli_fetch_array($check_2nd_sem_2nd))
                    {
                        $sub_id_fk = $fa['id'];
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
                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$sub_id_fk' and curri_id_fk='$id' and course_id_fk='$curr_courseid'";
                            $get_check = mysqli_query($connection,$checkprereq);
                            $Rows = mysqli_fetch_array($get_check);
                            $SubID = $Rows[0];
                            
                            if($SubID == 1)
                            {
            ?>           
                        <td><center>
            <?php
                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$sub_id_fk' and curri_id_fk='$id' and course_id_fk='$curr_courseid'";
                                $checkpreq = mysqli_query($connection,$getpreq);
                                foreach($checkpreq as $rows)
                                {
                                    $IDpre = $rows['id'];
                                    $new = $rows['subject_id'];    
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$new' and curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
                                        $subCode = $sa['subject_code'];
            ?>
                                <span id="idprereq2nd12nd<?php echo $IDpre?>" hidden><?php echo $IDpre?></span>
                                <button type="button" title="Edit" class="btn btn-white text-dark fw-bold border editSubject2nd12ndPreqModal" value="<?php echo $IDpre?>"><?php print_r($sa['subject_code']);?></button><button class="btn btn-danger fas fa-times fs-6 ml-1 p-1 deleteprereqsecondSubject12ndbtn" title="delete" value="<?php echo $IDpre?>"></button>
            <?php
                                    }
                                }
            ?>
                        </center></td>
            <?php
                            }
                            else if($SubID > 1)
                            {
            ?>
                        <td><center>
            <?php
                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$sub_id_fk' and curri_id_fk='$id' and course_id_fk='$curr_courseid'");
                                foreach($getpreq as $rows)
                                {
                                    $IDpre = $rows['id'];
                                    $news = $rows['subject_id']; 
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$news' and curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
            ?>
                                <span id="idprereq2nd22nd<?php echo $IDpre?>" hidden><?php echo $IDpre?></span>
                                <button type="button" title="Edit" class="btn btn-white text-dark fw-bold border editSubject2nd22ndPreqModal" value="<?php echo $IDpre?>"><?php print_r($sa['subject_code']);?></button><button class="btn btn-danger fas fa-times fs-6 ml-1 p-1 deleteprereqsecondSubject22ndbtn" title="delete" value="<?php echo $IDpre?>"></button><?php echo "<br/>";?>
            <?php
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
                        <td><center>
                            <button class="btn btn-white" type="button" title="More Option" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="cursor: pointer;">
                                <a class="dropdown-item editSecondSubject2ndbtn" title="Edit">Edit Subject</a>
            <?php
                $select_student = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE subject_id_fk='$sub_id_fk' and curri_id='$id' and course_id_fk='$curr_courseid'");
                if(mysqli_num_rows($select_student) == 0)
                {
            ?>
                                <a class="dropdown-item deleteSecondSubject2ndbtn" title="Delete" >Delete Subject</a>      
            <?php
                }
            ?>
                                <a class="dropdown-item addsecondPrereq22ndbtn" title="Add" >Add Prerequisite</a>
                            </div>
                            <!--<button style="font-size: 1.3rem;" title="Edit" class="fas fa-edit btn rounded btn-success editSecondSubject2ndbtn"></button>
                            <button style="font-size: 1.3rem;" title="Delete" class="fas fa-trash-alt btn rounded btn-danger deleteSecondSubject2ndbtn"></button>-->
                        </center></td>
                    </tr>
            <?php
                    }
                }
                            $select_units = "SELECT sum(units) FROM tblsubject WHERE status='1' and curr_id_fk='$id' and course_id_fk='$curr_courseid' and yearlevel='2' and semester='2nd'";
                            $count_units = mysqli_query($connection,$select_units);
                            $units_count = mysqli_fetch_array($count_units);
                            $Total_units_2_2 = $units_count[0];
            ?>          
                        </tbody>
                        <tfoot >	
                            <!-- table footer -->
                            <tr style="vertical-align: bottom;">
                                <td hidden></td>
                                <td></td>
                                <td class="fw-bold"><center>Total: </center></td>
                                <td class="fw-bold"><center></center></td>
                                <td class="fw-bold"><center></center></td>
                                <td class="fw-bold"><center><?php echo $Total_units_2_2?></center></td>
                                <td></td>
                                <td hidden></td>
                                <td hidden></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="border-bottom" id="summer-sem">
                    <div class="border-top text-center mt-2 mb-2">
                        <span class="fw-bold text-center fs-3 mt-2">Summer</span>
                    </div>
            <?php
                $check_2nd_sem_summer = mysqli_query($connection,"SELECT * FROM tblsubject WHERE status='1' and curr_id_fk='$id' and course_id_fk='$curr_courseid' and yearlevel='2' and semester='summer'");
            ?>
                    <table class="table table-striped" id="table2summer" width="100%">
                        <thead class="text-white">
                            <tr>
                                <th hidden>id</th>
                                <th><center>Code</center></th>
                                <th width="25%"><center>Title</center></th>
                                <th scope="col"><center>Lec Hrs</center></th>
                                <th scope="col"><center>Lab Hrs</center></th>
                                <th scope="col"><center>Units</center></th>
                                <th scope="col"><center>Prerequisite</center></th>
                                <th hidden><center>Semester</center></th>
                                <th hidden><center>Year</center></th>
                                <th scope="col"><center>Action</center></th>
                            </tr>
                        </thead>
                        <tbody>
            <?php
                if(mysqli_num_rows($check_2nd_sem_summer) > 0)
                {
                    while($fa = mysqli_fetch_array($check_2nd_sem_summer))
                    {
                        $sub_id_fk = $fa['id'];
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
                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$sub_id_fk' and curri_id_fk='$id' and course_id_fk='$curr_courseid'";
                            $get_check = mysqli_query($connection,$checkprereq);
                            $Rows = mysqli_fetch_array($get_check);
                            $SubID = $Rows[0];
                            
                            if($SubID == 1)
                            {
            ?>           
                        <td><center>
            <?php
                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$sub_id_fk' and curri_id_fk='$id' and course_id_fk='$curr_courseid'";
                                $checkpreq = mysqli_query($connection,$getpreq);
                                foreach($checkpreq as $rows)
                                {
                                    $IDpre = $rows['id'];
                                    $new = $rows['subject_id'];    
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$new' and curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
                                        $subCode = $sa['subject_code'];
            ?>
                                <span id="idprereq2nd1summer<?php echo $IDpre?>" hidden><?php echo $IDpre?></span>
                                <button type="button" title="Edit" class="btn btn-white text-dark fw-bold border editSubject2nd1summerPreqModal" value="<?php echo $IDpre?>"><?php print_r($sa['subject_code']);?></button><button class="btn btn-danger fas fa-times fs-6 ml-1 p-1 deleteprereqsecondSubject1summerbtn" title="delete" value="<?php echo $IDpre?>"></button>
            <?php
                                    }
                                }
            ?>
                        </center></td>
            <?php
                            }
                            else if($SubID > 1)
                            {
            ?>
                        <td><center>
            <?php
                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$sub_id_fk' and curri_id_fk='$id' and course_id_fk='$curr_courseid'");
                                foreach($getpreq as $rows)
                                {
                                    $IDpre = $rows['id'];
                                    $news = $rows['subject_id']; 
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$news' and curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
            ?>
                                <span id="idprereq2nd2summer<?php echo $IDpre?>" hidden><?php echo $IDpre?></span>
                                <button type="button" title="Edit" class="btn btn-white text-dark fw-bold border editSubject2nd2summerPreqModal" value="<?php echo $IDpre?>"><?php print_r($sa['subject_code']);?></button><button class="btn btn-danger fas fa-times fs-6 ml-1 p-1 deleteprereqsecondSubject2summerbtn" title="delete" value="<?php echo $IDpre?>"></button><?php echo "<br/>";?>
            <?php
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
                        <td><center>
                            <button class="btn btn-white" type="button" title="More Option" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="cursor: pointer;">
                                <a class="dropdown-item editSecondSubjectsummerbtn" title="Edit">Edit Subject</a>
            <?php
                $select_student = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE subject_id_fk='$sub_id_fk' and curri_id='$id' and course_id_fk='$curr_courseid'");
                if(mysqli_num_rows($select_student) == 0)
                {
            ?>
                                <a class="dropdown-item deleteSecondSubjectsummerbtn" title="Delete" >Delete Subject</a>
            <?php
                }
            ?>
                                <a class="dropdown-item addsecondPrereq2summerbtn" title="Add" >Add Prerequisite</a>
                            </div>
                            <!--<button style="font-size: 1.3rem;" title="Edit" class="fas fa-edit btn rounded btn-success editSecondSubject2ndbtn"></button>
                            <button style="font-size: 1.3rem;" title="Delete" class="fas fa-trash-alt btn rounded btn-danger deleteSecondSubject2ndbtn"></button>-->
                        </center></td>
                    </tr>
            <?php
                    }
                }
                            $select_units = "SELECT sum(units) FROM tblsubject WHERE status='1' and curr_id_fk='$id' and course_id_fk='$curr_courseid' and yearlevel='2' and semester='summer'";
                            $count_units = mysqli_query($connection,$select_units);
                            $units_count = mysqli_fetch_array($count_units);
                            $Total_units_2_summer = $units_count[0];
            ?>          
                        </tbody>
                        <tfoot >	
                            <!-- table footer -->
                            <tr style="vertical-align: bottom;">
                                <td hidden></td>
                                <td></td>
                                <td class="fw-bold"><center>Total: </center></td>
                                <td class="fw-bold"><center></center></td>
                                <td class="fw-bold"><center></center></td>
                                <td class="fw-bold"><center><?php echo $Total_units_2_summer?></center></td>
                                <td></td>
                                <td hidden></td>
                                <td hidden></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <!-- End of 2nd Year Subjects -->

            <!-- Start of 3rd Year Subjects -->
            <div class="mt-4 mb-4" id="thirdYear">
                <div class="mb-3" align="right"></div>
                <div class="border-bottom" id="1st-sem">
                    <div class="border-top text-center mt-2 mb-2">
                        <span class="fw-bold text-center fs-3 mt-2">1st Semester</span>
                    </div>

            <?php
                $check_3rd_sem_1st = mysqli_query($connection,"SELECT * FROM tblsubject WHERE status='1' and curr_id_fk='$id' and course_id_fk='$curr_courseid' and yearlevel='3' and semester='1st'");
            ?>
                    <table class="table table-striped" id="table3" width="100%">
                        <thead class="text-white">
                            <tr>
                                <th hidden>id</th>
                                <th><center>Code</center></th>
                                <th width="25%"><center>Title</center></th>
                                <th scope="col"><center>Lec Hrs</center></th>
                                <th scope="col"><center>Lab Hrs</center></th>
                                <th scope="col"><center>Units</center></th>
                                <th scope="col"><center>Prerequisite</center></th>
                                <th hidden><center>Semester</center></th>
                                <th hidden><center>Year</center></th>
                                <th scope="col"><center>Action</center></th>
                            </tr>
                        </thead>
                        <tbody>
            <?php
                if(mysqli_num_rows($check_3rd_sem_1st) > 0)
                {
                    while($fa = mysqli_fetch_array($check_3rd_sem_1st))
                    {
                        $sub_id_fk = $fa['id'];
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
                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$sub_id_fk' and curri_id_fk='$id' and course_id_fk='$curr_courseid'";
                            $get_check = mysqli_query($connection,$checkprereq);
                            $Rows = mysqli_fetch_array($get_check);
                            $SubID = $Rows[0];
                            
                            if($SubID == 1)
                            {
            ?>           
                        <td><center>
            <?php
                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$sub_id_fk' and curri_id_fk='$id' and course_id_fk='$curr_courseid'";
                                $checkpreq = mysqli_query($connection,$getpreq);
                                foreach($checkpreq as $rows)
                                {
                                    $IDpre = $rows['id'];
                                    $new = $rows['subject_id'];    
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$new' and curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
                                        $subCode = $sa['subject_code'];
            ?>
                                <span id="idprereq3rd11st<?php echo $IDpre?>" hidden><?php echo $IDpre?></span>
                                <button type="button" title="Edit" class="btn btn-white text-dark fw-bold border editSubject3rd11stPreqModal" value="<?php echo $IDpre?>"><?php print_r($sa['subject_code']);?></button><button class="btn btn-danger fas fa-times fs-6 ml-1 p-1 deleteprereqthirdSubject11stbtn" title="delete" value="<?php echo $IDpre?>"></button>
            <?php
                                    }
                                }
            ?>
                        </center></td>
            <?php
                            }
                            else if($SubID > 1)
                            {
            ?>
                        <td><center>
            <?php
                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$sub_id_fk' and curri_id_fk='$id' and course_id_fk='$curr_courseid'");
                                foreach($getpreq as $rows)
                                {
                                    $IDpre = $rows['id'];
                                    $news = $rows['subject_id']; 
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$news' and curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
            ?>
                                <span id="idprereq3rd21st<?php echo $IDpre?>" hidden><?php echo $IDpre?></span>
                                <button type="button" title="Edit" class="btn btn-white text-dark fw-bold border editSubject3rd21stPreqModal" value="<?php echo $IDpre?>"><?php print_r($sa['subject_code']);?></button><button class="btn btn-danger fas fa-times fs-6 ml-1 p-1 deleteprereqthirdSubject21stbtn" title="delete" value="<?php echo $IDpre?>"></button><?php echo "<br/>";?>
            <?php
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
                        <td><center>
                            <button class="btn btn-white" type="button" title="More Option" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="cursor: pointer;">
                                <a class="dropdown-item editThirdSubjectbtn" title="Edit">Edit Subject</a>
            <?php
                $select_student = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE subject_id_fk='$sub_id_fk' and curri_id='$id' and course_id_fk='$curr_courseid'");
                if(mysqli_num_rows($select_student) == 0)
                {
            ?>
                                <a class="dropdown-item deleteThirdSubjectbtn" title="Delete" >Delete Subject</a>
            <?php
                }
            ?>
                                <a class="dropdown-item addthirdPrereq21stbtn" title="Add" >Add Prerequisite</a>
                            </div>
                            <!--<button style="font-size: 1.3rem;" title="Edit" class="fas fa-edit btn rounded btn-success editThirdSubjectbtn"></button>
                            <button style="font-size: 1.3rem;" title="Delete" class="fas fa-trash-alt btn rounded btn-danger deleteThirdSubjectbtn"></button>-->
                        </center></td>
                    </tr>
            <?php
                    }
                }
                            $select_units = "SELECT sum(units) FROM tblsubject WHERE status='1' and curr_id_fk='$id' and course_id_fk='$curr_courseid' and yearlevel='3' and semester='1st'";
                            $count_units = mysqli_query($connection,$select_units);
                            $units_count = mysqli_fetch_array($count_units);
                            $Total_units_3_1 = $units_count[0];
            ?> 
                        </tbody>
                        <tfoot >	
                            <!-- table footer -->
                            <tr style="vertical-align: bottom;">
                                <td hidden></td>
                                <td></td>
                                <td class="fw-bold"><center>Total: </center></td>
                                <td class="fw-bold"><center></center></td>
                                <td class="fw-bold"><center></center></td>
                                <td class="fw-bold"><center><?php echo $Total_units_3_1?></center></td>
                                <td></td>
                                <td hidden></td>
                                <td hidden></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="border-bottom" id="2nd-sem">
                    <div class="border-top text-center mt-2 mb-2">
                        <span class="fw-bold text-center fs-3 mt-2">2nd Semester</span>
                    </div>

            <?php
                $check_3rd_sem_2nd = mysqli_query($connection,"SELECT * FROM tblsubject WHERE status='1' and curr_id_fk='$id' and course_id_fk='$curr_courseid' and yearlevel='3' and semester='2nd'");
            ?>
                    <table class="table table-striped" id="table32nd" width="100%">
                        <thead class="text-white">
                            <tr>
                                <th hidden>id</th>
                                <th><center>Code</center></th>
                                <th width="25%"><center>Title</center></th>
                                <th scope="col"><center>Lec Hrs</center></th>
                                <th scope="col"><center>Lab Hrs</center></th>
                                <th scope="col"><center>Units</center></th>
                                <th scope="col"><center>Prerequisite</center></th>
                                <th hidden><center>Semester</center></th>
                                <th hidden><center>Year</center></th>
                                <th scope="col"><center>Action</center></th>
                            </tr>
                        </thead>
                        <tbody>
            <?php
                if(mysqli_num_rows($check_3rd_sem_2nd) > 0)
                {
                    while($fa = mysqli_fetch_array($check_3rd_sem_2nd))
                    {
                        $sub_id_fk = $fa['id'];
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
                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$sub_id_fk' and curri_id_fk='$id' and course_id_fk='$curr_courseid'";
                            $get_check = mysqli_query($connection,$checkprereq);
                            $Rows = mysqli_fetch_array($get_check);
                            $SubID = $Rows[0];
                            
                            if($SubID == 1)
                            {
            ?>           
                        <td><center>
            <?php
                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$sub_id_fk' and curri_id_fk='$id' and course_id_fk='$curr_courseid'";
                                $checkpreq = mysqli_query($connection,$getpreq);
                                foreach($checkpreq as $rows)
                                {
                                    $IDpre = $rows['id'];
                                    $new = $rows['subject_id'];    
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$new' and curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
                                        $subCode = $sa['subject_code'];
            ?>
                                <span id="idprereq3rd12nd<?php echo $IDpre?>" hidden><?php echo $IDpre?></span>
                                <button type="button" title="Edit" class="btn btn-white text-dark fw-bold border editSubject3rd12ndPreqModal" value="<?php echo $IDpre?>"><?php print_r($sa['subject_code']);?></button><button class="btn btn-danger fas fa-times fs-6 ml-1 p-1 deleteprereqthirdSubject12ndbtn" title="delete" value="<?php echo $IDpre?>"></button>
            <?php
                                    }
                                }
            ?>
                        </center></td>
            <?php
                            }
                            else if($SubID > 1)
                            {
            ?>
                        <td><center>
            <?php
                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$sub_id_fk' and curri_id_fk='$id' and course_id_fk='$curr_courseid'");
                                foreach($getpreq as $rows)
                                {
                                    $IDpre = $rows['id'];
                                    $news = $rows['subject_id']; 
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$news' and curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
            ?>
                                <span id="idprereq3rd22nd<?php echo $IDpre?>" hidden><?php echo $IDpre?></span>
                                <button type="button" title="Edit" class="btn btn-white text-dark fw-bold border editSubject3rd22ndPreqModal" value="<?php echo $IDpre?>"><?php print_r($sa['subject_code']);?></button><button class="btn btn-danger fas fa-times fs-6 ml-1 p-1 deleteprereqthirdSubject22ndbtn" title="delete" value="<?php echo $IDpre?>"></button><?php echo "<br/>";?>
            <?php
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
                        <td><center>
                            <button class="btn btn-white" type="button" title="More Option" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="cursor: pointer;">
                                <a class="dropdown-item editThirdSubject2ndbtn" title="Edit">Edit Subject</a>
            <?php
                $select_student = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE subject_id_fk='$sub_id_fk' and curri_id='$id' and course_id_fk='$curr_courseid'");
                if(mysqli_num_rows($select_student) == 0)
                {
            ?>
                                <a class="dropdown-item deleteThirdSubject2ndbtn" title="Delete" >Delete Subject</a>
            <?php
                }
            ?>
                                <a class="dropdown-item addthirdPrereq22ndbtn" title="Add" >Add Prerequisite</a>
                            </div>
                            <!--<button style="font-size: 1.3rem;" title="Edit" class="fas fa-edit btn rounded btn-success editThirdSubject2ndbtn"></button>
                            <button style="font-size: 1.3rem;" title="Delete" class="fas fa-trash-alt btn rounded btn-danger deleteThirdSubject2ndbtn"></button>-->
                        </center></td>
                    </tr>
            <?php
                    }
                }
                            $select_units = "SELECT sum(units) FROM tblsubject WHERE status='1' and curr_id_fk='$id' and course_id_fk='$curr_courseid' and yearlevel='3' and semester='2nd'";
                            $count_units = mysqli_query($connection,$select_units);
                            $units_count = mysqli_fetch_array($count_units);
                            $Total_units_3_2 = $units_count[0];
            ?> 
                        </tbody>
                        <tfoot >	
                            <!-- table footer -->
                            <tr style="vertical-align: bottom;">
                                <td hidden></td>
                                <td></td>
                                <td class="fw-bold"><center>Total: </center></td>
                                <td class="fw-bold"><center></center></td>
                                <td class="fw-bold"><center></center></td>
                                <td class="fw-bold"><center><?php echo $Total_units_3_2?></center></td>
                                <td></td>
                                <td hidden></td>
                                <td hidden></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="border-bottom" id="summer-sem">
                    <div class="border-top text-center mt-2 mb-2">
                        <span class="fw-bold text-center fs-3 mt-2">Summer</span>
                    </div>
            <?php
                $check_3rd_sem_summer = mysqli_query($connection,"SELECT * FROM tblsubject WHERE status='1' and curr_id_fk='$id' and course_id_fk='$curr_courseid' and yearlevel='3' and semester='summer'");
            ?>
                    <table class="table table-striped" id="table3summer" width="100%">
                        <thead class="text-white">
                            <tr>
                                <th hidden>id</th>
                                <th><center>Code</center></th>
                                <th width="25%"><center>Title</center></th>
                                <th scope="col"><center>Lec Hrs</center></th>
                                <th scope="col"><center>Lab Hrs</center></th>
                                <th scope="col"><center>Units</center></th>
                                <th scope="col"><center>Prerequisite</center></th>
                                <th hidden><center>Semester</center></th>
                                <th hidden><center>Year</center></th>
                                <th scope="col"><center>Action</center></th>
                            </tr>
                        </thead>
                        <tbody>
            <?php
                if(mysqli_num_rows($check_3rd_sem_summer) > 0)
                {
                    while($fa = mysqli_fetch_array($check_3rd_sem_summer))
                    {
                        $sub_id_fk = $fa['id'];
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
                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$sub_id_fk' and curri_id_fk='$id' and course_id_fk='$curr_courseid'";
                            $get_check = mysqli_query($connection,$checkprereq);
                            $Rows = mysqli_fetch_array($get_check);
                            $SubID = $Rows[0];
                            
                            if($SubID == 1)
                            {
            ?>           
                        <td><center>
            <?php
                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$sub_id_fk' and curri_id_fk='$id' and course_id_fk='$curr_courseid'";
                                $checkpreq = mysqli_query($connection,$getpreq);
                                foreach($checkpreq as $rows)
                                {
                                    $IDpre = $rows['id'];
                                    $new = $rows['subject_id'];    
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$new' and curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
                                        $subCode = $sa['subject_code'];
            ?>
                                <span id="idprereq3rd1summer<?php echo $IDpre?>" hidden><?php echo $IDpre?></span>
                                <button type="button" title="Edit" class="btn btn-white text-dark fw-bold border editSubject3rd1summerPreqModal" value="<?php echo $IDpre?>"><?php print_r($sa['subject_code']);?></button><button class="btn btn-danger fas fa-times fs-6 ml-1 p-1 deleteprereqthirdSubject1summerbtn" title="delete" value="<?php echo $IDpre?>"></button>
            <?php
                                    }
                                }
            ?>
                        </center></td>
            <?php
                            }
                            else if($SubID > 1)
                            {
            ?>
                        <td><center>
            <?php
                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$sub_id_fk' and curri_id_fk='$id' and course_id_fk='$curr_courseid'");
                                foreach($getpreq as $rows)
                                {
                                    $IDpre = $rows['id'];
                                    $news = $rows['subject_id']; 
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$news' and curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
            ?>
                                <span id="idprereq3rd2summer<?php echo $IDpre?>" hidden><?php echo $IDpre?></span>
                                <button type="button" title="Edit" class="btn btn-white text-dark fw-bold border editSubject3rd2summerPreqModal" value="<?php echo $IDpre?>"><?php print_r($sa['subject_code']);?></button><button class="btn btn-danger fas fa-times fs-6 ml-1 p-1 deleteprereqthirdSubject2summerbtn" title="delete" value="<?php echo $IDpre?>"></button><?php echo "<br/>";?>
            <?php
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
                        <td><center>
                            <button class="btn btn-white" type="button" title="More Option" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="cursor: pointer;">
                                <a class="dropdown-item editThirdSubjectsummerbtn" title="Edit">Edit Subject</a>
            <?php
                $select_student = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE subject_id_fk='$sub_id_fk' and curri_id='$id' and course_id_fk='$curr_courseid'");
                if(mysqli_num_rows($select_student) == 0)
                {
            ?>
                                <a class="dropdown-item deleteThirdSubjectsummerbtn" title="Delete" >Delete Subject</a>
            <?php
                }
            ?>
                                <a class="dropdown-item addthirdPrereq2summerbtn" title="Add" >Add Prerequisite</a>
                            </div>
                            <!--<button style="font-size: 1.3rem;" title="Edit" class="fas fa-edit btn rounded btn-success editThirdSubject2ndbtn"></button>
                            <button style="font-size: 1.3rem;" title="Delete" class="fas fa-trash-alt btn rounded btn-danger deleteThirdSubject2ndbtn"></button>-->
                        </center></td>
                    </tr>
            <?php
                    }
                }
                            $select_units = "SELECT sum(units) FROM tblsubject WHERE status='1' and curr_id_fk='$id' and course_id_fk='$curr_courseid' and yearlevel='3' and semester='summer'";
                            $count_units = mysqli_query($connection,$select_units);
                            $units_count = mysqli_fetch_array($count_units);
                            $Total_units_3_summer = $units_count[0];
            ?> 
                        </tbody>
                        <tfoot >	
                            <!-- table footer -->
                            <tr style="vertical-align: bottom;">
                                <td hidden></td>
                                <td></td>
                                <td class="fw-bold"><center>Total: </center></td>
                                <td class="fw-bold"><center></center></td>
                                <td class="fw-bold"><center></center></td>
                                <td class="fw-bold"><center><?php echo $Total_units_3_summer?></center></td>
                                <td></td>
                                <td hidden></td>
                                <td hidden></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
            </div>
            <!-- End of 3rd Year Subjects -->

            <!-- Start of 4th Year Subjects -->
            <div class="mt-4 mb-4" id="fourthYear">
                <div class="mb-3" align="right"></div>
                <div class="border-bottom" id="1st-sem">
                    <div class="border-top text-center mt-2 mb-2">
                        <span class="fw-bold text-center fs-3 mt-2">1st Semester</span>
                    </div>
            <?php
                $check_4th_sem_1st = mysqli_query($connection,"SELECT * FROM tblsubject WHERE status='1' and curr_id_fk='$id' and course_id_fk='$curr_courseid' and yearlevel='4' and semester='1st'");
            ?>
                    <table class="table table-striped" id="table4" width="100%">
                        <thead class="text-white">
                            <tr>
                                <th hidden>id</th>
                                <th><center>Code</center></th>
                                <th width="25%"><center>Title</center></th>
                                <th scope="col"><center>Lec Hrs</center></th>
                                <th scope="col"><center>Lab Hrs</center></th>
                                <th scope="col"><center>Units</center></th>
                                <th scope="col"><center>Prerequisite</center></th>
                                <th hidden><center>Semester</center></th>
                                <th hidden><center>Year</center></th>
                                <th scope="col"><center>Action</center></th>
                            </tr>
                        </thead>
                        <tbody>
            <?php
                if(mysqli_num_rows($check_4th_sem_1st) > 0)
                {
                    while($fa = mysqli_fetch_array($check_4th_sem_1st))
                    {
                        $sub_id_fk = $fa['id'];
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
                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$sub_id_fk' and curri_id_fk='$id' and course_id_fk='$curr_courseid'";
                            $get_check = mysqli_query($connection,$checkprereq);
                            $Rows = mysqli_fetch_array($get_check);
                            $SubID = $Rows[0];
                            
                            if($SubID == 1)
                            {
            ?>           
                        <td><center>
            <?php
                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$sub_id_fk' and curri_id_fk='$id' and course_id_fk='$curr_courseid'";
                                $checkpreq = mysqli_query($connection,$getpreq);
                                foreach($checkpreq as $rows)
                                {
                                    $IDpre = $rows['id'];
                                    $new = $rows['subject_id'];    
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$new' and curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
                                        $subCode = $sa['subject_code'];
            ?>
                                    <span id="idprereq4th11st<?php echo $IDpre?>" hidden><?php echo $IDpre?></span>
                                    <button type="button" title="Edit" class="btn btn-white text-dark fw-bold border editSubject4th11stPreqModal" value="<?php echo $IDpre?>"><?php print_r($sa['subject_code']);?></button><button class="btn btn-danger fas fa-times fs-6 ml-1 p-1 deleteprereqFourthSubject11stbtn" title="delete" value="<?php echo $IDpre?>"></button>
            <?php
                                    }
                                }
            ?>
                        </center></td>
            <?php
                            }
                            else if($SubID > 1)
                            {
            ?>
                        <td><center>
            <?php
                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$sub_id_fk' and curri_id_fk='$id' and course_id_fk='$curr_courseid'");
                                foreach($getpreq as $rows)
                                {
                                    $IDpre = $rows['id'];
                                    $news = $rows['subject_id']; 
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$news' and curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
            ?>
                                <span id="idprereq4th21st<?php echo $IDpre?>" hidden><?php echo $IDpre?></span>
                                <button type="button" title="Edit" class="btn btn-white text-dark fw-bold border editSubject4th21stPreqModal" value="<?php echo $IDpre?>"><?php print_r($sa['subject_code']);?></button><button class="btn btn-danger fas fa-times fs-6 ml-1 p-1 deleteprereqFourthSubject21stbtn" title="delete" value="<?php echo $IDpre?>"></button><?php echo "<br/>";?>
            <?php
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
                        <td><center>
                            <button class="btn btn-white" type="button" title="More Option" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="cursor: pointer;">
                                <a class="dropdown-item editFourthSubject1stbtn" title="Edit">Edit Subject</a>
            <?php
                $select_student = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE subject_id_fk='$sub_id_fk' and curri_id='$id' and course_id_fk='$curr_courseid'");
                if(mysqli_num_rows($select_student) == 0)
                {
            ?>
                                <a class="dropdown-item deleteFourthSubject1stbtn" title="Delete" >Delete Subject</a>
            <?php
                }
            ?>
                                <a class="dropdown-item addFourthPrereq11stbtn" title="Add" >Add Prerequisite</a>
                            </div>
                            <!--<button style="font-size: 1.3rem;" title="Edit" class="fas fa-edit btn rounded btn-success editFourthSubject1stbtn"></button>
                            <button style="font-size: 1.3rem;" title="Delete" class="fas fa-trash-alt btn rounded btn-danger deleteFourthSubject1stbtn"></button>-->
                        </center></td>
                    </tr>
            <?php
                    }
                }
                            $select_units = "SELECT sum(units) FROM tblsubject WHERE status='1' and curr_id_fk='$id' and course_id_fk='$curr_courseid' and yearlevel='4' and semester='1st'";
                            $count_units = mysqli_query($connection,$select_units);
                            $units_count = mysqli_fetch_array($count_units);
                            $Total_units_4_1 = $units_count[0];
            ?>
                        </tbody>
                        <tfoot >	
                            <!-- table footer -->
                            <tr style="vertical-align: bottom;">
                                <td hidden></td>
                                <td></td>
                                <td class="fw-bold"><center>Total: </center></td>
                                <td class="fw-bold"><center></center></td>
                                <td class="fw-bold"><center></center></td>
                                <td class="fw-bold"><center><?php echo $Total_units_4_1?></center></td>
                                <td></td>
                                <td hidden></td>
                                <td hidden></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="border-bottom" id="2nd-sem">
                    <div class="border-top text-center mt-2 mb-2">
                        <span class="fw-bold text-center fs-3 mt-2">2nd Semester</span>
                    </div>
            <?php
                $check_4th_sem_2nd = mysqli_query($connection,"SELECT * FROM tblsubject WHERE status='1' and curr_id_fk='$id' and course_id_fk='$curr_courseid' and yearlevel='4' and semester='2nd'");
            ?>
                    <table class="table table-striped" id="table42nd" width="100%">
                        <thead class="text-white">
                            <tr>
                                <th hidden>id</th>
                                <th><center>Code</center></th>
                                <th width="25%"><center>Title</center></th>
                                <th scope="col"><center>Lec Hrs</center></th>
                                <th scope="col"><center>Lab Hrs</center></th>
                                <th scope="col"><center>Units</center></th>
                                <th scope="col"><center>Prerequisite</center></th>
                                <th hidden><center>Semester</center></th>
                                <th hidden><center>Year</center></th>
                                <th scope="col"><center>Action</center></th>
                            </tr>
                        </thead>
                        <tbody>
            <?php
                if(mysqli_num_rows($check_4th_sem_2nd) > 0)
                {
                    while($fa = mysqli_fetch_array($check_4th_sem_2nd))
                    {
                        $sub_id_fk = $fa['id'];
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
                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$sub_id_fk' and curri_id_fk='$id' and course_id_fk='$curr_courseid'";
                            $get_check = mysqli_query($connection,$checkprereq);
                            $Rows = mysqli_fetch_array($get_check);
                            $SubID = $Rows[0];
                            
                            if($SubID == 1)
                            {
            ?>           
                        <td><center>
            <?php
                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$sub_id_fk' and curri_id_fk='$id' and course_id_fk='$curr_courseid'";
                                $checkpreq = mysqli_query($connection,$getpreq);
                                foreach($checkpreq as $rows)
                                {
                                    $IDpre = $rows['id'];
                                    $new = $rows['subject_id'];    
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$new' and curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
                                        $subCode = $sa['subject_code'];
            ?>
                                    <span id="idprereq4th12nd<?php echo $IDpre?>" hidden><?php echo $IDpre?></span>
                                    <button type="button" title="Edit" class="btn btn-white text-dark fw-bold border editSubject4th12ndPreqModal" value="<?php echo $IDpre?>"><?php print_r($sa['subject_code']);?></button><button class="btn btn-danger fas fa-times fs-6 ml-1 p-1 deleteprereqFourthSubject12ndbtn" title="delete" value="<?php echo $IDpre?>"></button>
            <?php
                                    }
                                }
            ?>
                        </center></td>
            <?php
                            }
                            else if($SubID > 1)
                            {
            ?>
                    <td><center>
            <?php
                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$sub_id_fk' and curri_id_fk='$id' and course_id_fk='$curr_courseid'");
                                foreach($getpreq as $rows)
                                {
                                    $IDpre = $rows['id'];
                                    $news = $rows['subject_id']; 
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$news' and curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
            ?>
                                <span id="idprereq4th22nd<?php echo $IDpre?>" hidden><?php echo $IDpre?></span>
                                <button type="button" title="Edit" class="btn btn-white text-dark fw-bold border editSubject4th22ndPreqModal" value="<?php echo $IDpre?>"><?php print_r($sa['subject_code']);?></button><button class="btn btn-danger fas fa-times fs-6 ml-1 p-1 deleteprereqFourthSubject22ndbtn" title="delete" value="<?php echo $IDpre?>"></button><?php echo "<br/>";?>
            <?php
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
                        <td><center>
                            <button class="btn btn-white" type="button" title="More Option" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="cursor: pointer;">
                                <a class="dropdown-item editFourthSubject2ndbtn" title="Edit">Edit Subject</a>
            <?php
                $select_student = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE subject_id_fk='$sub_id_fk' and curri_id='$id' and course_id_fk='$curr_courseid'");
                if(mysqli_num_rows($select_student) == 0)
                {
            ?>
                                <a class="dropdown-item deleteFourthSubject2ndbtn" title="Delete" >Delete Subject</a>
            <?php
                }
            ?>
                                <a class="dropdown-item addFourthPrereq22ndbtn" title="Add" >Add Prerequisite</a>
                            </div>
                            <!--<button style="font-size: 1.3rem;" title="Edit" class="fas fa-edit btn rounded btn-success editFourthSubject2ndbtn"></button>
                            <button style="font-size: 1.3rem;" title="Delete" class="fas fa-trash-alt btn rounded btn-danger deleteFourthSubject2ndbtn"></button>-->
                        </center></td>
                    </tr>
            <?php
                    }
                }
                            $select_units = "SELECT sum(units) FROM tblsubject WHERE status='1' and curr_id_fk='$id' and course_id_fk='$curr_courseid' and yearlevel='4' and semester='2nd'";
                            $count_units = mysqli_query($connection,$select_units);
                            $units_count = mysqli_fetch_array($count_units);
                            $Total_units_4_2 = $units_count[0];
            ?>
                        </tbody>
                        <tfoot >	
                            <!-- table footer -->
                            <tr style="vertical-align: bottom;">
                                <td hidden></td>
                                <td></td>
                                <td class="fw-bold"><center>Total: </center></td>
                                <td class="fw-bold"><center></center></td>
                                <td class="fw-bold"><center></center></td>
                                <td class="fw-bold"><center><?php echo $Total_units_4_2?></center></td>
                                <td></td>
                                <td hidden></td>
                                <td hidden></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="border-bottom" id="summer-sem">
                    <div class="border-top text-center mt-2 mb-2">
                        <span class="fw-bold text-center fs-3 mt-2">Summer</span>
                    </div>
            <?php
                $check_4th_sem_summer = mysqli_query($connection,"SELECT * FROM tblsubject WHERE status='1' and curr_id_fk='$id' and course_id_fk='$curr_courseid' and yearlevel='4' and semester='summer'");
            ?>
                    <table class="table table-striped" id="table4summer" width="100%">
                        <thead class="text-white">
                            <tr>
                                <th hidden>id</th>
                                <th><center>Code</center></th>
                                <th width="25%"><center>Title</center></th>
                                <th scope="col"><center>Lec Hrs</center></th>
                                <th scope="col"><center>Lab Hrs</center></th>
                                <th scope="col"><center>Units</center></th>
                                <th scope="col"><center>Prerequisite</center></th>
                                <th hidden><center>Semester</center></th>
                                <th hidden><center>Year</center></th>
                                <th scope="col"><center>Action</center></th>
                            </tr>
                        </thead>
                        <tbody>
            <?php
                if(mysqli_num_rows($check_4th_sem_summer) > 0)
                {
                    while($fa = mysqli_fetch_array($check_4th_sem_summer))
                    {
                        $sub_id_fk = $fa['id'];
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
                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$sub_id_fk' and curri_id_fk='$id' and course_id_fk='$curr_courseid'";
                            $get_check = mysqli_query($connection,$checkprereq);
                            $Rows = mysqli_fetch_array($get_check);
                            $SubID = $Rows[0];
                            
                            if($SubID == 1)
                            {
            ?>           
                        <td><center>
            <?php
                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$sub_id_fk' and curri_id_fk='$id' and course_id_fk='$curr_courseid'";
                                $checkpreq = mysqli_query($connection,$getpreq);
                                foreach($checkpreq as $rows)
                                {
                                    $IDpre = $rows['id'];
                                    $new = $rows['subject_id'];    
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$new' and curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
                                        $subCode = $sa['subject_code'];
            ?>
                                    <span id="idprereq4th1summer<?php echo $IDpre?>" hidden><?php echo $IDpre?></span>
                                    <button type="button" title="Edit" class="btn btn-white text-dark fw-bold border editSubject4th1summerPreqModal" value="<?php echo $IDpre?>"><?php print_r($sa['subject_code']);?></button><button class="btn btn-danger fas fa-times fs-6 ml-1 p-1 deleteprereqFourthSubject1summerbtn" title="delete" value="<?php echo $IDpre?>"></button>
            <?php
                                    }
                                }
            ?>
                        </center></td>
            <?php
                            }
                            else if($SubID > 1)
                            {
            ?>
                    <td><center>
            <?php
                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$sub_id_fk' and curri_id_fk='$id' and course_id_fk='$curr_courseid'");
                                foreach($getpreq as $rows)
                                {
                                    $IDpre = $rows['id'];
                                    $news = $rows['subject_id']; 
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$news' and curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
            ?>
                                <span id="idprereq4th2summer<?php echo $IDpre?>" hidden><?php echo $IDpre?></span>
                                <button type="button" title="Edit" class="btn btn-white text-dark fw-bold border editSubject4th2summerPreqModal" value="<?php echo $IDpre?>"><?php print_r($sa['subject_code']);?></button><button class="btn btn-danger fas fa-times fs-6 ml-1 p-1 deleteprereqFourthSubject2summerbtn" title="delete" value="<?php echo $IDpre?>"></button><?php echo "<br/>";?>
            <?php
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
                        <td><center>
                            <button class="btn btn-white" type="button" title="More Option" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="cursor: pointer;">
                                <a class="dropdown-item editFourthSubjectsummerbtn" title="Edit">Edit Subject</a>
            <?php
                $select_student = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE subject_id_fk='$sub_id_fk' and curri_id='$id' and course_id_fk='$curr_courseid'");
                if(mysqli_num_rows($select_student) == 0)
                {
            ?>
                                <a class="dropdown-item deleteFourthSubjectsummerbtn" title="Delete" >Delete Subject</a>
            <?php
                }
            ?>
                                <a class="dropdown-item addFourthPrereq2summerbtn" title="Add" >Add Prerequisite</a>
                            </div>
                            <!--<button style="font-size: 1.3rem;" title="Edit" class="fas fa-edit btn rounded btn-success editFourthSubject2ndbtn"></button>
                            <button style="font-size: 1.3rem;" title="Delete" class="fas fa-trash-alt btn rounded btn-danger deleteFourthSubject2ndbtn"></button>-->
                        </center></td>
                    </tr>
            <?php
                    }
                }
                            $select_units = "SELECT sum(units) FROM tblsubject WHERE status='1' and curr_id_fk='$id' and course_id_fk='$curr_courseid' and yearlevel='4' and semester='summer'";
                            $count_units = mysqli_query($connection,$select_units);
                            $units_count = mysqli_fetch_array($count_units);
                            $Total_units_4_summer = $units_count[0];
            ?>
                        </tbody>
                        <tfoot >	
                            <!-- table footer -->
                            <tr style="vertical-align: bottom;">
                                <td hidden></td>
                                <td></td>
                                <td class="fw-bold"><center>Total: </center></td>
                                <td class="fw-bold"><center></center></td>
                                <td class="fw-bold"><center></center></td>
                                <td class="fw-bold"><center><?php echo $Total_units_4_summer?></center></td>
                                <td></td>
                                <td hidden></td>
                                <td hidden></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
            <!-- End of 4th Year Subjects -->

            <!-- Start of 5th Year Subjects -->
            <div class="mt-4 mb-4" id="fifthYear">
                <div class="mb-3" align="right"></div>
                <div class="border-bottom" id="1st-sem">
                    <div class="border-top text-center mt-2 mb-2">
                        <span class="fw-bold text-center fs-3 mt-2">1st Semester</span>
                    </div>
            <?php
                $check_5th_sem_1st = mysqli_query($connection,"SELECT * FROM tblsubject WHERE status='1' and curr_id_fk='$id' and course_id_fk='$curr_courseid' and yearlevel='5' and semester='1st'");
            ?>
                    <table class="table table-striped" id="table5" width="100%">
                        <thead class="text-white">
                            <tr>
                                <th hidden>id</th>
                                <th><center>Code</center></th>
                                <th width="25%"><center>Title</center></th>
                                <th scope="col"><center>Lec Hrs</center></th>
                                <th scope="col"><center>Lab Hrs</center></th>
                                <th scope="col"><center>Units</center></th>
                                <th scope="col"><center>Prerequisite</center></th>
                                <th hidden><center>Semester</center></th>
                                <th hidden><center>Year</center></th>
                                <th scope="col"><center>Action</center></th>
                            </tr>
                        </thead>
                        <tbody>
            <?php
                if(mysqli_num_rows($check_5th_sem_1st) > 0)
                {
                    while($fa = mysqli_fetch_array($check_5th_sem_1st))
                    {
                        $sub_id_fk = $fa['id'];
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
                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$sub_id_fk' and curri_id_fk='$id' and course_id_fk='$curr_courseid'";
                            $get_check = mysqli_query($connection,$checkprereq);
                            $Rows = mysqli_fetch_array($get_check);
                            $SubID = $Rows[0];
                            
                            if($SubID == 1)
                            {
            ?>           
                        <td><center>
            <?php
                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$sub_id_fk' and curri_id_fk='$id' and course_id_fk='$curr_courseid'";
                                $checkpreq = mysqli_query($connection,$getpreq);
                                foreach($checkpreq as $rows)
                                {
                                    $IDpre = $rows['id'];
                                    $new = $rows['subject_id'];    
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$new' and curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
                                        $subCode = $sa['subject_code'];
            ?>
                                    <span id="idprereq5th11st<?php echo $IDpre?>" hidden><?php echo $IDpre?></span>
                                    <button type="button" title="Edit" class="btn btn-white text-dark fw-bold border editSubject5th11stPreqModal" value="<?php echo $IDpre?>"><?php print_r($sa['subject_code']);?></button><button class="btn btn-danger fas fa-times fs-6 ml-1 p-1 deleteprereqFifthSubject11stbtn" title="delete" value="<?php echo $IDpre?>"></button>
            <?php
                                    }
                                }
            ?>
                        </center></td>
            <?php
                            }
                            else if($SubID > 1)
                            {
            ?>
                        <td><center>
            <?php
                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$sub_id_fk' and curri_id_fk='$id' and course_id_fk='$curr_courseid'");
                                foreach($getpreq as $rows)
                                {
                                    $IDpre = $rows['id'];
                                    $news = $rows['subject_id']; 
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$news' and curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
            ?>
                                    <span id="idprereq5th21st<?php echo $IDpre?>" hidden><?php echo $IDpre?></span>
                                    <button type="button" title="Edit" class="btn btn-white text-dark fw-bold border editSubject5th21stPreqModal" value="<?php echo $IDpre?>"><?php print_r($sa['subject_code']);?></button><button class="btn btn-danger fas fa-times fs-6 ml-1 p-1 deleteprereqFifthSubject21stbtn" title="delete" value="<?php echo $IDpre?>"></button><?php echo "<br/>";?>
            <?php
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
                        <td><center>
                            <button class="btn btn-white" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="cursor: pointer;">
                                <a class="dropdown-item editFifthSubject1stbtn" title="Edit">Edit Subject</a>
            <?php
                $select_student = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE subject_id_fk='$sub_id_fk' and curri_id='$id' and course_id_fk='$curr_courseid'");
                if(mysqli_num_rows($select_student) == 0)
                {
            ?>
                                <a class="dropdown-item deleteFifthSubject1stbtn" title="Delete" >Delete Subject</a>
            <?php
                }
            ?>
                                <a class="dropdown-item addFifthPrereq11stbtn" title="Add" >Add Prerequisite</a>
                            </div>
                            <!--<button style="font-size: 1.3rem;" title="Edit" class="fas fa-edit btn rounded btn-success editFifthSubject1stbtn"></button>
                            <button style="font-size: 1.3rem;" title="Delete" class="fas fa-trash-alt btn rounded btn-danger deleteFifthSubject1stbtn"></button>-->
                        </center></td>
                    </tr>
            <?php
                    }
                }
                            $select_units = "SELECT sum(units) FROM tblsubject WHERE status='1' and curr_id_fk='$id' and course_id_fk='$curr_courseid' and yearlevel='5' and semester='1st'";
                            $count_units = mysqli_query($connection,$select_units);
                            $units_count = mysqli_fetch_array($count_units);
                            $Total_units_5_1 = $units_count[0];
            ?>
                        </tbody>
                        <tfoot >	
                            <!-- table footer -->
                            <tr style="vertical-align: bottom;">
                                <td hidden></td>
                                <td></td>
                                <td class="fw-bold"><center>Total: </center></td>
                                <td class="fw-bold"><center></center></td>
                                <td class="fw-bold"><center></center></td>
                                <td class="fw-bold"><center><?php echo $Total_units_5_1?></center></td>
                                <td></td>
                                <td hidden></td>
                                <td hidden></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="border-bottom" id="2nd-sem">
                    <div class="border-top text-center mt-2 mb-2">
                        <span class="fw-bold text-center fs-3 mt-2">2nd Semester</span>
                    </div>

            <?php
                $check_5th_sem_2nd = mysqli_query($connection,"SELECT * FROM tblsubject WHERE status='1' and curr_id_fk='$id' and course_id_fk='$curr_courseid' and yearlevel='5' and semester='2nd'");
            ?>
                    <table class="table table-striped" id="table52nd" width="100%">
                        <thead class="text-white">
                            <tr>
                                <th hidden>id</th>
                                <th><center>Code</center></th>
                                <th width="25%"><center>Title</center></th>
                                <th scope="col"><center>Lec Hrs</center></th>
                                <th scope="col"><center>Lab Hrs</center></th>
                                <th scope="col"><center>Units</center></th>
                                <th scope="col"><center>Prerequisite</center></th>
                                <th hidden><center>Semester</center></th>
                                <th hidden><center>Year</center></th>
                                <th scope="col"><center>Action</center></th>
                            </tr>
                        </thead>
                        <tbody>
            <?php
                if(mysqli_num_rows($check_5th_sem_2nd) > 0)
                {
                    while($fa = mysqli_fetch_array($check_5th_sem_2nd))
                    {
                        $sub_id_fk = $fa['id'];
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
                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$sub_id_fk' and curri_id_fk='$id' and course_id_fk='$curr_courseid'";
                            $get_check = mysqli_query($connection,$checkprereq);
                            $Rows = mysqli_fetch_array($get_check);
                            $SubID = $Rows[0];
                            
                            if($SubID == 1)
                            {
            ?>           
                        <td><center>
            <?php
                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$sub_id_fk' and curri_id_fk='$id' and course_id_fk='$curr_courseid'";
                                $checkpreq = mysqli_query($connection,$getpreq);
                                foreach($checkpreq as $rows)
                                {
                                    $IDpre = $rows['id'];
                                    $new = $rows['subject_id'];    
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$new' and curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
                                        $subCode = $sa['subject_code'];
            ?>
                                    <span id="idprereq5th12nd<?php echo $IDpre?>" hidden><?php echo $IDpre?></span>
                                    <button type="button" title="Edit" class="btn btn-white text-dark fw-bold border editSubject5th1stPreqModal" value="<?php echo $IDpre?>"><?php print_r($sa['subject_code']);?></button><button class="btn btn-danger fas fa-times fs-6 ml-1 p-1 deleteprereqFifthSubject1stbtn" title="delete" value="<?php echo $IDpre?>"></button>
            <?php
                                    }
                                }
            ?>
                        </center></td>
            <?php
                            }
                            else if($SubID > 1)
                            {
            ?>
                        <td><center>
            <?php
                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$sub_id_fk' and curri_id_fk='$id' and course_id_fk='$curr_courseid'");
                                foreach($getpreq as $rows)
                                {
                                    $IDpre = $rows['id'];
                                    $news = $rows['subject_id']; 
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$news' and curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
            ?>
                                    <span id="idprereq5th22nd<?php echo $IDpre?>" hidden><?php echo $IDpre?></span>
                                    <button type="button" title="Edit" class="btn btn-white text-dark fw-bold border editSubject5th2ndPreqModal" value="<?php echo $IDpre?>"><?php print_r($sa['subject_code']);?></button><button class="btn btn-danger fas fa-times fs-6 ml-1 p-1 deleteprereqFifthSubject2ndbtn" title="delete" value="<?php echo $IDpre?>"></button><?php echo "<br/>";?>
            <?php
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
                        <td><center>
                        <!-- <td><center><button class="btn btn-secondary"><i class="fas fa-ellipsis-h"></i> </button> -->
                        <button class="btn btn-white" type="button" title="More Option" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="cursor: pointer;">
                            <a class="dropdown-item editFifthSubject2ndbtn" title="Edit">Edit Subject</a>
            <?php
                $select_student = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE subject_id_fk='$sub_id_fk' and curri_id='$id' and course_id_fk='$curr_courseid'");
                if(mysqli_num_rows($select_student) == 0)
                {
            ?>
                            <a class="dropdown-item deleteFifthSubject2ndbtn" title="Delete" >Delete Subject</a>
            <?php
                }
            ?>
                            <a class="dropdown-item addFifthPrereq2ndbtn" title="Add" >Add Prerequisite</a>
                        </div>
                            <!-- <button style="font-size: 1.3rem;" title="Edit" class="fas fa-edit btn rounded btn-success editFifthSubject2ndbtn"></button>
                            <button style="font-size: 1.3rem;" title="Delete" class="fas fa-trash-alt btn rounded btn-danger deleteFifthSubject2ndbtn"></button> -->
                        </center></td>
                    </tr>
            <?php
                    }
                }
                            $select_units = "SELECT sum(units) FROM tblsubject WHERE status='1' and curr_id_fk='$id' and course_id_fk='$curr_courseid' and yearlevel='5' and semester='2nd'";
                            $count_units = mysqli_query($connection,$select_units);
                            $units_count = mysqli_fetch_array($count_units);
                            $Total_units_5_2 = $units_count[0];
            ?>
                        </tbody>
                        <tfoot >	
                            <!-- table footer -->
                            <tr style="vertical-align: bottom;">
                                <td hidden></td>
                                <td></td>
                                <td class="fw-bold"><center>Total: </center></td>
                                <td class="fw-bold"><center></center></td>
                                <td class="fw-bold"><center></center></td>
                                <td class="fw-bold"><center><?php echo $Total_units_5_2?></center></td>
                                <td></td>
                                <td hidden></td>
                                <td hidden></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="border-bottom" id="summer-sem">
                    <div class="border-top text-center mt-2 mb-2">
                        <span class="fw-bold text-center fs-3 mt-2">Summer</span>
                    </div>
            <?php
                $check_5th_sem_summer = mysqli_query($connection,"SELECT * FROM tblsubject WHERE status='1' and curr_id_fk='$id' and course_id_fk='$curr_courseid' and yearlevel='5' and semester='summer'");
            ?>
                    <table class="table table-striped" id="table5summer" width="100%">
                        <thead class="text-white">
                            <tr>
                                <th hidden>id</th>
                                <th><center>Code</center></th>
                                <th width="25%"><center>Title</center></th>
                                <th scope="col"><center>Lec Hrs</center></th>
                                <th scope="col"><center>Lab Hrs</center></th>
                                <th scope="col"><center>Units</center></th>
                                <th scope="col"><center>Prerequisite</center></th>
                                <th hidden><center>Semester</center></th>
                                <th hidden><center>Year</center></th>
                                <th scope="col"><center>Action</center></th>
                            </tr>
                        </thead>
                        <tbody>
            <?php
                if(mysqli_num_rows($check_5th_sem_summer) > 0)
                {
                    while($fa = mysqli_fetch_array($check_5th_sem_summer))
                    {
                        $sub_id_fk = $fa['id'];
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
                            $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$sub_id_fk' and curri_id_fk='$id' and course_id_fk='$curr_courseid'";
                            $get_check = mysqli_query($connection,$checkprereq);
                            $Rows = mysqli_fetch_array($get_check);
                            $SubID = $Rows[0];
                            
                            if($SubID == 1)
                            {
            ?>           
                        <td><center>
            <?php
                                $getpreq = "SELECT * FROM tblprereq WHERE subject_under='$sub_id_fk' and curri_id_fk='$id' and course_id_fk='$curr_courseid'";
                                $checkpreq = mysqli_query($connection,$getpreq);
                                foreach($checkpreq as $rows)
                                {
                                    $IDpre = $rows['id'];
                                    $new = $rows['subject_id'];    
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$new' and curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
                                        $subCode = $sa['subject_code'];
            ?>
                                    <span id="idprereq5th1summer<?php echo $IDpre?>" hidden><?php echo $IDpre?></span>
                                    <button type="button" title="Edit" class="btn btn-white text-dark fw-bold border editSubject5th1summerPreqModal" value="<?php echo $IDpre?>"><?php print_r($sa['subject_code']);?></button><button class="btn btn-danger fas fa-times fs-6 ml-1 p-1 deleteprereqFifthSubject1summerbtn" title="delete" value="<?php echo $IDpre?>"></button>
            <?php
                                    }
                                }
            ?>
                        </center></td>
            <?php
                            }
                            else if($SubID > 1)
                            {
            ?>
                        <td><center>
            <?php
                                $getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$sub_id_fk' and curri_id_fk='$id' and course_id_fk='$curr_courseid'");
                                foreach($getpreq as $rows)
                                {
                                    $IDpre = $rows['id'];
                                    $news = $rows['subject_id']; 
                                    $getsubcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$news' and curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                    while($sa = mysqli_fetch_array($getsubcode))
                                    {
            ?>
                                    <span id="idprereq5th2summer<?php echo $IDpre?>" hidden><?php echo $IDpre?></span>
                                    <button type="button" title="Edit" class="btn btn-white text-dark fw-bold border editSubject5th2summerPreqModal" value="<?php echo $IDpre?>"><?php print_r($sa['subject_code']);?></button><button class="btn btn-danger fas fa-times fs-6 ml-1 p-1 deleteprereqFifthSubject2summerbtn" title="delete" value="<?php echo $IDpre?>"></button><?php echo "<br/>";?>
            <?php
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
                        <td><center>
                        <!-- <td><center><button class="btn btn-secondary"><i class="fas fa-ellipsis-h"></i> </button> -->
                        <button class="btn btn-white" type="button" title="More Option" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="cursor: pointer;">
                            <a class="dropdown-item editFifthSubjectsummerbtn" title="Edit">Edit Subject</a>
            <?php
                $select_student = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE subject_id_fk='$sub_id_fk' and curri_id='$id' and course_id_fk='$curr_courseid'");
                if(mysqli_num_rows($select_student) == 0)
                {
            ?>
                            <a class="dropdown-item deleteFifthSubjectsummerbtn" title="Delete" >Delete Subject</a>
            <?php
                }
            ?>
                            <a class="dropdown-item addFifthPrereqsummerbtn" title="Add" >Add Prerequisite</a>
                        </div>
                            <!-- <button style="font-size: 1.3rem;" title="Edit" class="fas fa-edit btn rounded btn-success editFifthSubject2ndbtn"></button>
                            <button style="font-size: 1.3rem;" title="Delete" class="fas fa-trash-alt btn rounded btn-danger deleteFifthSubject2ndbtn"></button> -->
                        </center></td>
                    </tr>
            <?php
                    }
                }
                            $select_units = "SELECT sum(units) FROM tblsubject WHERE status='1' and curr_id_fk='$id' and course_id_fk='$curr_courseid' and yearlevel='5' and semester='summer'";
                            $count_units = mysqli_query($connection,$select_units);
                            $units_count = mysqli_fetch_array($count_units);
                            $Total_units_5_summer = $units_count[0];
            ?>
                        </tbody>
                        <tfoot >	
                            <!-- table footer -->
                            <tr style="vertical-align: bottom;">
                                <td hidden></td>
                                <td></td>
                                <td class="fw-bold"><center>Total: </center></td>
                                <td class="fw-bold"><center></center></td>
                                <td class="fw-bold"><center></center></td>
                                <td class="fw-bold"><center><?php echo $Total_units_5_summer?></center></td>
                                <td></td>
                                <td hidden></td>
                                <td hidden></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
            <!-- End of 5th year subjects -->

        </div>
    </div>

    <!-- ADD NEW SUBJECT POPUP -->
    <div class="container container-fluid">
        <div class="modal fade" id="addSubjectsmodal" tabindex="-1" role="dialog" aria-labelledby="addSubjectsLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document" style="max-width: 850px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="addSubjectsLabel">Create New Subject</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>

                        <div class="modal-body">
                    <form action="managedata.php" method="POST">
                            <!-- Inputs -->
                            <div class="form-group">
                                <label>Curriculum</label>
                                <input type="text" name="curr_code" value="<?php echo $curr_code?>" class="form-control text-center"  readonly>
                            </div>	

                            <div class="form-group">
                                <label>Year Level</label>
                                <select  name="yearlevel" class="form-control text-center" required>
                                        <option value="">Select Year Level...</option>
                                        <option value="1">1st</option>
                                        <option value="2">2nd</option>
                                        <option value="3">3rd</option>
                                        <option value="4">4th</option>
                                        <option value="5">5th</option>
                                </select>
                            </div> 

                            <div class="form-group">
                                <label>Semester</label>
                                <select  name="semester" class="form-control text-center" required>
                                        <option value="0">Select Semester...</option>
                                        <option value="1st">1st Semester</option>
                                        <option value="2nd">2nd Semester</option>
                                        <option value="summer">Summer</option>
                                </select>
                            </div>

							<div class="form-group">
                                <label>Subject Code</label>
                                <input type="text" name="subjectcode" class="form-control text-center" autocomplete="off" placeholder="Enter Subject Code"required>
                            </div>  

                            <div class="form-group">
                                <label>Description</label>
                                <textarea columns="2" type="text" name="description" class="form-control text-center" placeholder="Enter Subject Description"required></textarea>
                            </div>  

							<div class="form-group">
                                <label>Units</label>
                                <div class="row">
                                    <div class="col">
                                        <input  type="text" name="lec" class="form-control text-center" placeholder="Enter Lec" >
                                        <span class="text-secondary"><center>Lec</center></span>
                                    </div>
                                    <div class="col">
                                        <input  type="text" name="lab" class="form-control text-center" placeholder="Enter Lab" >
                                        <span class="text-secondary"><center>Lab</center></span>
                                    </div>
                                    <div class="col">
                                        <input  type="text" name="units" class="form-control text-center" placeholder="Enter Lab" >
                                        <span class="text-secondary"><center>Units</center></span>
                                    </div>
                                </div>
                            </div>  
                            
                            <input  type="hidden" name="courseid" value="<?php echo $curr_courseid?>" class="form-control">

                            <div class="form-group">
                                <label for="select-multiple">Prerequisites</label>                 
                                <select name="prereq[]" class="form-control multiple-data-1" id="select-multiple" multiple style="width: 100%;">
                                    <?php
                                        $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                        if(mysqli_num_rows($getsub) > 0)
                                        {
                                            foreach($getsub as $datas)
                                            {   
                                    ?>
                                        <option value="<?php echo $datas['id']; ?>"><?php echo $datas['description']; ?></option>
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
                            <div>Hold <span class="text-danger">CTRL</span> to multiple selection</div>		
                        </div>

                        <div class="modal-footer" align="right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" name="add_1st_year_subject" class="btn btn-success">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ADD SUBJECT END -->

    <!-- DELETE All Subject MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteAllSubjectModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete All Subjects</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="managedata.php" method="POST">
                        <input type="hidden" name="courseid" value="<?php echo $curr_courseid?>">
                        <input type="hidden" name="currid" value="<?php echo $curr_id?>"
                        <center>
                            <div class="modal-body">
                                All data will be deleted! 
                                Are you sure you want to delete All Subjects?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                <button type="submit" name="delete_all_1st_subject_1st" class="btn btn-success">Yes</button>
                            </div>                     
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--END OF DELETE All Subject Modal -->

<!-- First Year List -->

    <!-- Edit Subjects 1st year 1st sem-->
    <div class="modal fade" id="editFirstSubjectFirstModal" tabindex="-1" role="dialog" aria-labelledby="editsubjectModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Subject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body mt-3">
                <form action="managedata.php" method="POST">
                    <input type="hidden" name="subject_id" id="1st_subject_1st_id">
                    <input type="hidden" name="courseid" value="<?php echo $curr_courseid?>">
                    <div class="form-group">
                        <label>Curriculum</label>
                        <input type="text" name="curr_code" id="cur_1st_sub_1st" value="<?php echo $curr_code?>" class="form-control text-center"  readonly>
                    </div>
                    
                    <div class="form-group">
                        <label>Year Level</label>
                        <select name="yearlevel" id="year_1st_sub_1st" class="form-control text-center" required>
                                <option value="">Select Year Level...</option>
                                <option value="1">1st</option>
                                <option value="2">2nd</option>
                                <option value="3">3rd</option>
                                <option value="4">4th</option>
                                <option value="5">5th</option>
                        </select>
                    </div> 

                    <div class="form-group">
                        <label>Semester</label>
                        <select  name="semester" id="sem_1st_sub_1st" class="form-control text-center" required>
                                <option value="0">Select Semester...</option>
                                <option value="1st">1st Semester</option>
                                <option value="2nd">2nd Semester</option>
                                <option value="summer">Summer</option>
                        </select>
                    </div> 

                    <div class="form-group">
                        <label>Subject Code</label>
                        <input type="text" name="subjectcode" id="subcode_1st_sub_1st" class="form-control text-center" placeholder="Enter Subject Code"required>
                    </div>  
                    <div class="form-group">
                        <label>Description</label>
                        <textarea columns="2" type="text" name="description" id="des_1st_sub_1st" class="form-control text-center" placeholder="Enter Subject Description"required></textarea>
                    </div>  
                    <div class="form-group">
                        <label>Units</label>
                        <div class="row">
                            <div class="col">
                                <input  type="text" name="lec" id="lec_1st_sub_1st" class="form-control text-center" placeholder="Enter Lec Units" >
                                <span class="text-secondary"><center>Lec</center></span>
                            </div>
                            <div class="col">
                                <input  type="text" name="lab" id="lab_1st_sub_1st" class="form-control text-center" placeholder="Enter Lab Units" >
                                <span class="text-secondary"><center>Lab</center></span>
                            </div>
                            <div class="col">
                                <input  type="text" name="units" id="units_1st_sub_1st" class="form-control text-center" placeholder="Enter Lab Units" >
                                <span class="text-secondary"><center>Units</center></span>
                            </div>
                        </div>
                    </div>  

                    <!--<div class="form-group">
                        <label for="pre_1st_sub_1st">Prerequisites</label>                 
                            <select name="prereq[]" class="form-control multiple-data-1-1st-edit" id="pre_1st_sub_1st" multiple style="width: 20rem;">
                            <?php
                                $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                if(mysqli_num_rows($getsub) > 0)
                                {
                                    foreach($getsub as $datas)
                                    {   
                            ?>
                                <option value="<?php echo $datas['subject_code']; ?>"><?php echo $datas['subject_code']; ?></option>
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
                    <div>Hold <span class="text-danger">CTRL</span> to multiple selection</div>-->
                </div>
                    
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="edit_1st_year_subject" class="btn btn-primary">Save</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- Edit 1st Subjects 1st sem -->

    <!-- Edit Subjects 1st year 2nd sem-->
    <div class="modal fade" id="editFirstSubjectSecondModal" tabindex="-1" role="dialog" aria-labelledby="editsubjectModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Subject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body mt-3">
                <form action="managedata.php" method="POST">
                    <input type="hidden" name="subject_id" id="1st_subject_2nd_id">
                    <input type="hidden" name="courseid" value="<?php echo $curr_courseid?>">
                    <div class="form-group">
                        <label>Curriculum</label>
                        <input type="text" name="curr_code" id="cur_1st_sub_2nd" value="<?php echo $curr_code?>" class="form-control text-center"  readonly>
                    </div>
                    
                    <div class="form-group">
                        <label>Year Level</label>
                        <select name="yearlevel" id="year_1st_sub_2nd" class="form-control text-center" required>
                                <option value="">Select Year Level...</option>
                                <option value="1">1st</option>
                                <option value="2">2nd</option>
                                <option value="3">3rd</option>
                                <option value="4">4th</option>
                                <option value="5">5th</option>
                        </select>
                    </div> 

                    <div class="form-group">
                        <label>Semester</label>
                        <select  name="semester" id="sem_1st_sub_2nd" class="form-control text-center" required>
                                <option value="">Select Semester...</option>
                                <option value="1st">1st Semester</option>
                                <option value="2nd">2nd Semester</option>
                                <option value="summer">Summer</option>
                        </select>
                    </div> 

                    <div class="form-group">
                        <label>Subject Code</label>
                        <input type="text" name="subjectcode" id="subcode_1st_sub_2nd" class="form-control text-center" placeholder="Enter Subject Code"required>
                    </div>  
                    <div class="form-group">
                        <label>Description</label>
                        <textarea columns="2" type="text" name="description" id="des_1st_sub_2nd" class="form-control text-center" placeholder="Enter Subject Description"required></textarea>
                    </div>  
                    <div class="form-group">
                        <label>Units</label>
                        <div class="row">
                            <div class="col">
                                <input  type="text" name="lec" id="lec_1st_sub_2nd" class="form-control text-center" placeholder="Enter Lec Units" required>
                                <span class="text-secondary"><center>Lec</center></span>
                            </div>
                            <div class="col">
                                <input  type="text" name="lab" id="lab_1st_sub_2nd" class="form-control text-center" placeholder="Enter Lab Units" required>
                                <span class="text-secondary"><center>Lab</center></span>
                            </div>
                            <div class="col">
                                <input  type="text" name="units" id="units_1st_sub_2nd" class="form-control text-center" placeholder="Enter Lab Units" >
                                <span class="text-secondary"><center>Units</center></span>
                            </div>
                        </div>
                    </div>  

                    <!--<div class="form-group">
                        <label>Prerequisites</label>
                        <select name="prereq[]" id="pre_1st_sub_2nd" class="form-control multiple-data-1-2nd-edit" multiple style="width: 20rem;">
                            <?php
                                $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                if(mysqli_num_rows($getsub) > 0)
                                {
                                    foreach($getsub as $datas)
                                    {   
                            ?>
                                <option value="<?php echo $datas['subject_code']; ?>"><?php echo $datas['subject_code']; ?></option>
                            <?php
                                    }
                                }
                            else
                                {
                                    echo "No Records Found!!";
                                }
                            ?>   
                        </select>
                        <input type="hidden" name="subid" value="<?php echo $getsubid ?>">
                    </div> 
                    <div>Hold <span class="text-danger">CTRL</span> to multiple selection</div>-->
                </div>
                    
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="edit_1st_year_subject_2nd" class="btn btn-primary">Save</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- Edit 1st Subjects 2ndt sem -->

    <!-- Edit Subjects 1st year summer sem-->
    <div class="modal fade" id="editFirstSubjectSummerModal" tabindex="-1" role="dialog" aria-labelledby="editsubjectModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Subject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body mt-3">
                <form action="managedata.php" method="POST">
                    <input type="hidden" name="subject_id" id="1st_subject_summer_id">
                    <input type="hidden" name="courseid" value="<?php echo $curr_courseid?>">
                    <div class="form-group">
                        <label>Curriculum</label>
                        <input type="text" name="curr_code" id="cur_1st_sub_summer" value="<?php echo $curr_code?>" class="form-control text-center"  readonly>
                    </div>
                    
                    <div class="form-group">
                        <label>Year Level</label>
                        <select name="yearlevel" id="year_1st_sub_summer" class="form-control text-center" required>
                                <option value="">Select Year Level...</option>
                                <option value="1">1st</option>
                                <option value="2">2nd</option>
                                <option value="3">3rd</option>
                                <option value="4">4th</option>
                                <option value="5">5th</option>
                        </select>
                    </div> 

                    <div class="form-group">
                        <label>Semester</label>
                        <select  name="semester" id="sem_1st_sub_summer" class="form-control text-center" required>
                                <option value="0">Select Semester...</option>
                                <option value="1st">1st Semester</option>
                                <option value="2nd">2nd Semester</option>
                                <option value="summer">Summer</option>
                        </select>
                    </div> 

                    <div class="form-group">
                        <label>Subject Code</label>
                        <input type="text" name="subjectcode" id="subcode_1st_sub_summer" class="form-control text-center" placeholder="Enter Subject Code"required>
                    </div>  
                    <div class="form-group">
                        <label>Description</label>
                        <textarea columns="2" type="text" name="description" id="des_1st_sub_summer" class="form-control text-center" placeholder="Enter Subject Description"required></textarea>
                    </div>  
                    <div class="form-group">
                        <label>Units</label>
                        <div class="row">
                            <div class="col">
                                <input  type="text" name="lec" id="lec_1st_sub_summer" class="form-control text-center" placeholder="Enter Lec Units" required>
                                <span class="text-secondary"><center>Lec</center></span>
                            </div>
                            <div class="col">
                                <input  type="text" name="lab" id="lab_1st_sub_summer" class="form-control text-center" placeholder="Enter Lab Units" required>
                                <span class="text-secondary"><center>Lab</center></span>
                            </div>
                            <div class="col">
                                <input  type="text" name="units" id="units_1st_sub_summer" class="form-control text-center" placeholder="Enter Lab Units" >
                                <span class="text-secondary"><center>Units</center></span>
                            </div>
                        </div>
                    </div>  

                    <!--<div class="form-group">
                        <label>Prerequisites</label>
                        <select name="prereq[]" id="pre_1st_sub_2nd" class="form-control multiple-data-1-2nd-edit" multiple style="width: 20rem;">
                            <?php
                                $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                if(mysqli_num_rows($getsub) > 0)
                                {
                                    foreach($getsub as $datas)
                                    {   
                            ?>
                                <option value="<?php echo $datas['subject_code']; ?>"><?php echo $datas['subject_code']; ?></option>
                            <?php
                                    }
                                }
                            else
                                {
                                    echo "No Records Found!!";
                                }
                            ?>   
                        </select>
                        <input type="hidden" name="subid" value="<?php echo $getsubid ?>">
                    </div> 
                    <div>Hold <span class="text-danger">CTRL</span> to multiple selection</div>-->
                </div>
                    
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="edit_1st_year_subject_2nd" class="btn btn-primary">Save</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- Edit 1st Subjects summer sem -->

        <!-- DELETE Subject 1st MODAL-->
        <div class="container container-fluid">
            <div class="modal fade" id="deleteSubjectModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Subject</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="id" id="delete1stsubject1stid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Subject?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_1st_subject_1st" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--END OF DELETE Subject 1st MODAL-->

        <!-- DELETE Subject 2nd sem MODAL-->
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
                                <input type="hidden" name="id" id="delete1stsubject2ndid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Subject?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_1st_subject_2nd" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--END OF DELETE Subject 2nd sem MODAL-->

        <!-- DELETE Subject Summer sem MODAL-->
        <div class="container container-fluid">
            <div class="modal fade" id="delete1stSubjectSummerModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Subject</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="id" id="delete1stsubjectsummerid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Subject?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_1st_subject_2nd" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--END OF DELETE Subject Summer sem MODAL-->

<!-- for Prereq 1st subject 1st -->
    <!-- DELETE Subject 1st 1st 1 prereq MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteSubject1st11stPreqModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="id" id="prereq1stsub11stid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Prerequisite?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF DELETE Subject 1st 1st 1 prereq MODAL-->

    <!-- DELETE Subject 1st 1st 2 prereq MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteSubject1st21stPreqModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="id" id="prereq1stsub21stid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Prerequisite?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF DELETE Subject 1st 1st 2 prereq MODAL-->

    <!-- Add 1st subject 1st Prerequisite MODAL-->
    <div class="container container-fluid">
            <div class="modal fade" id="addprereqFirst11stModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
                <div class="modal-dialog" style="max-width: 720px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Prerequisite</h5></h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                                <div class="modal-body">
                        <form action="managedata.php" method="POST">
                                    <input type="hidden" name="idprereq" id="addprereq1st11stid">
                                    <div class="form-group">
                                        <label for="select-multiple-add-1st-1st">Prerequisites</label>                 
                                        <select name="prereqID[]" class="form-control add-prereq-multi-1st-1st" id="select-multiple-add-1st-1st" style="width: 100%;" multiple required>
                                        <?php
                                            $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                            if(mysqli_num_rows($getsub) > 0)
                                            {
                                                foreach($getsub as $datas)
                                                {   
                                        ?>
                                            <option value="<?php echo $datas['id']; ?>"><?php echo $datas['description']; ?></option>
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
                                    <div>Hold <span class="text-danger">CTRL</span> to multiple selection</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="add_prereq_sub" class="btn btn-success">Save</button>
                                </div>                     
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF Add 1st subject 1st Prerequisite MODAL-->

    <!-- EDIT 1st subject 1prereq 1st sem Prerequisite MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="editprereqFirstSubject11stModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <div class="modal-body">
                                <input type="hidden" name="idprereq" id="prereq1st11stid">
                                    <div class="form-group">
                                        <label for="prereq">Prerequisites</label>                 
                                        <select name="prereq" class="form-control" id="prereq" required>
                                            <option value="0">Select Prerequisite</option>
                                        <?php
                                            $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
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
                                    </div> 
                                    <div>Single Prerequisite Only</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="edit_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF edit 1st subject 1prereq 1st sem Prerequisite MODAL-->

    <!-- EDIT 1st subject 2prereq 1st sem Prerequisite MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="editprereqFirstSubject21stModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="idprereq" id="prereq1st21stid">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="prereq">Prerequisites</label>                 
                                        <select name="prereq" class="form-control" id="prereq" required>
                                            <option value="0">Select Prerequisite</option>
                                        <?php
                                            $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
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
                                    </div> 
                                    <div>Single Prerequisite Only</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="edit_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF edit 1st subject 2prereq 1st sem Prerequisite MODAL-->
<!-- for Prereq 1st subject 1st -->

<!-- for Prereq 1st subject 2nd -->
    <!-- DELETE Subject 1st 1st prereq MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteSubject1st12ndPreqModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="id" id="prereq1stsub12ndid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Prerequisite?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF DELETE Subject 2nd 1st prereq MODAL-->

    <!-- DELETE Subject 1st 2nd prereq MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteSubject1st22ndPreqModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="id" id="prereq1stsub22ndid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Prerequisite?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF DELETE Subject 1st 2nd prereq MODAL-->

    <!-- Add 2nd subject 1st Prerequisite MODAL-->
    <div class="container container-fluid">
            <div class="modal fade" id="addprereqFirst2ndModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
                <div class="modal-dialog" style="max-width: 720px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Prerequisite</h5></h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                                <div class="modal-body">
                        <form action="managedata.php" method="POST">
                                    <input type="hidden" name="idprereq" id="addprereq1st2ndid">
                                    <div class="form-group">
                                        <label for="select-multiple-add">Prerequisites</label>                 
                                        <select name="prereqID[]" class="form-control add-prereq-multi-1st-2nd" id="select-multiple-add" style="width: 100%;" multiple required>
                                        <?php
                                            $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                            if(mysqli_num_rows($getsub) > 0)
                                            {
                                                foreach($getsub as $datas)
                                                {   
                                        ?>
                                            <option value="<?php echo $datas['id']; ?>"><?php echo $datas['description']; ?></option>
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
                                    <div>Hold <span class="text-danger">CTRL</span> to multiple selection</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="add_prereq_sub" class="btn btn-success">Save</button>
                                </div>                     
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF Add 1st subject 2nd Prerequisite MODAL-->

    <!-- EDIT 1st subject 1prereq 2nd sem Prerequisite MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="editprereqFirstSubject12ndModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <div class="modal-body">
                                <input type="hidden" name="idprereq" id="prereq1st12ndid">
                                    <div class="form-group">
                                        <label for="prereq">Prerequisites</label>                 
                                        <select name="prereq" class="form-control" id="prereq" required>
                                            <option value="0">Select Prerequisite</option>
                                        <?php
                                            $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
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
                                    </div> 
                                    <div>Single Prerequisite Only</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="edit_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF edit 1st subject 1prereq 2nd sem Prerequisite MODAL-->

    <!-- EDIT 1st subject 2prereq 2nd sem Prerequisite MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="editprereqFirstSubject22ndModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="idprereq" id="prereq1st22ndid">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="prereq">Prerequisites</label>                 
                                        <select name="prereq" class="form-control" id="prereq" required>
                                            <option value="0">Select Prerequisite</option>
                                        <?php
                                            $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
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
                                    </div> 
                                    <div>Single Prerequisite Only</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="edit_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF edit 1st subject 2prereq 2nd sem Prerequisite MODAL-->
<!-- for Prereq 1st subject 2nd -->

<!-- for Prereq 1st subject Summer -->
    <!-- DELETE Subject 1 Summer prereq MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteSubject1st1SummerPreqModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="id" id="prereq1stsub1summerid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Prerequisite?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF DELETE Subject 1 Summer prereq MODAL-->

    <!-- DELETE Subject 1st Summer prereq MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteSubject1st2SummerPreqModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete This Prerequisite</h5></h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="id" id="prereq1stsub2summerid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Prerequisite?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF DELETE Subject 1st Summer prereq MODAL-->

    <!-- Add Summer subject 1st Prerequisite MODAL-->
    <div class="container container-fluid">
            <div class="modal fade" id="addprereqFirstSummerModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
                <div class="modal-dialog" style="max-width: 720px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Prerequisite</h5></h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                                <div class="modal-body">
                        <form action="managedata.php" method="POST">
                                    <input type="hidden" name="idprereq" id="addprereq1stsummerid">
                                    <div class="form-group">
                                        <label for="select-multiple-add-summer">Prerequisites</label>                 
                                        <select name="prereqID[]" class="form-control add-prereq-multi-1st-summer" id="select-multiple-add-summer" style="width: 100%;" multiple required>
                                        <?php
                                            $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                            if(mysqli_num_rows($getsub) > 0)
                                            {
                                                foreach($getsub as $datas)
                                                {   
                                        ?>
                                            <option value="<?php echo $datas['id']; ?>"><?php echo $datas['description']; ?></option>
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
                                    <div>Hold <span class="text-danger">CTRL</span> to multiple selection</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="add_prereq_sub" class="btn btn-success">Save</button>
                                </div>                     
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF Add Summer subject 2nd Prerequisite MODAL-->

    <!-- EDIT 1st subject 1prereq Summer sem Prerequisite MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="editprereqFirstSubject1summerModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <div class="modal-body">
                                <input type="hidden" name="idprereq" id="prereq1st1summerid">
                                    <div class="form-group">
                                        <label for="prereq">Prerequisites</label>                 
                                        <select name="prereq" class="form-control" id="prereq" required>
                                            <option value="0">Select Prerequisite</option>
                                        <?php
                                            $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                            if(mysqli_num_rows($getsub) > 0)
                                            {
                                                foreach($getsub as $datas)
                                                {   
                                        ?>
                                            <option value="<?php echo $datas['id']; ?>"><?php echo $datas['description']; ?></option>
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
                                    <div>Single Prerequisite Only</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="edit_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF edit 1st subject 1prereq Summer sem Prerequisite MODAL-->

    <!-- EDIT 1st subject 2prereq Summer sem Prerequisite MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="editprereqFirstSubject2summerModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Prerequisite</h5></h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="idprereq" id="prereq1st2summerid">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="prereq">Prerequisites</label>                 
                                        <select name="prereq" class="form-control" id="prereq" required>
                                            <option value="0">Select Prerequisite</option>
                                        <?php
                                            $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                            if(mysqli_num_rows($getsub) > 0)
                                            {
                                                foreach($getsub as $datas)
                                                {   
                                        ?>
                                            <option value="<?php echo $datas['id']; ?>"><?php echo $datas['description']; ?></option>
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
                                    <div>Single Prerequisite Only</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="edit_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF edit 1st subject 2prereq Summer sem Prerequisite MODAL-->
<!-- for Prereq 1st subject Summer -->
<!-- End Of First Year List -->

<!-- Second Year List -->
    <!-- Edit Subjects 2ND year 1st sem-->
    <div class="modal fade" id="editSecondSubjectModal" tabindex="-1" role="dialog" aria-labelledby="editsubjectModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Subject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body mt-3">
                <form action="managedata.php" method="POST">
                    <input type="hidden" name="subject_id" id="2nd_subject_1st_id">
                    <input type="hidden" name="courseid" value="<?php echo $curr_courseid?>">
                    <div class="form-group">
                        <label>Curriculum</label>
                        <input type="text" name="curr_code" id="cur_2nd_sub_1st" value="<?php echo $curr_code?>" class="form-control text-center"  readonly>
                    </div>
                    
                    <div class="form-group">
                        <label>Year Level</label>
                        <select name="yearlevel" id="year_2nd_sub_1st" class="form-control text-center" required>
                                <option value="">Select Year Level...</option>
                                <option value="1">1st</option>
                                <option value="2">2nd</option>
                                <option value="3">3rd</option>
                                <option value="4">4th</option>
                                <option value="5">5th</option>
                        </select>
                    </div> 

                    <div class="form-group">
                        <label>Semester</label>
                        <select  name="semester" id="sem_2nd_sub_1st" class="form-control text-center" required>
                                <option value="0">Select Semester...</option>
                                <option value="1st">1st Semester</option>
                                <option value="2nd">2nd Semester</option>
                                <option value="summer">Summer</option>
                        </select>
                    </div> 

                    <div class="form-group">
                        <label>Subject Code</label>
                        <input type="text" name="subjectcode" id="subcode_2nd_sub_1st" class="form-control text-center" placeholder="Enter Subject Code"required>
                    </div>  
                    <div class="form-group">
                        <label>Description</label>
                        <textarea columns="2" type="text" name="description" id="des_2nd_sub_1st" class="form-control text-center" placeholder="Enter Subject Description"required></textarea>
                    </div>  
                    <div class="form-group">
                        <label>Units</label>
                        <div class="row">
                            <div class="col">
                                <input  type="text" name="lec" id="lec_2nd_sub_1st" class="form-control text-center" placeholder="Enter Lec Units" >
                                <span class="text-secondary"><center>Lec</center></span>
                            </div>
                            <div class="col">
                                <input  type="text" name="lab" id="lab_2nd_sub_1st" class="form-control text-center" placeholder="Enter Lab Units" >
                                <span class="text-secondary"><center>Lab</center></span>
                            </div>
                            <div class="col">
                                <input  type="text" name="units" id="units_2nd_sub_1st" class="form-control text-center" placeholder="Enter Lab Units" >
                                <span class="text-secondary"><center>Units</center></span>
                            </div>
                        </div>
                    </div>  

                    <!--<div class="form-group">
                        <label>Prerequisites</label>
                        <select name="prereq[]" id="pre_2nd_sub_1st" class="form-control multiple-data-2nd-1st-edit" multiple style="width: 20rem;">
                            <?php
                                $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                if(mysqli_num_rows($getsub) > 0)
                                {
                                    foreach($getsub as $datas)
                                    {   
                            ?>
                                <option value="<?php echo $datas['subject_code']; ?>"><?php echo $datas['subject_code']; ?></option>
                            <?php
                                    }
                                }
                            else
                                {
                                    echo "No Records Found!!";
                                }
                            ?>          
                        </select>
                        <input type="hidden" name="subid" value="<?php echo $getsubid ?>">
                    </div> 
                    <div>Hold <span class="text-danger">CTRL</span> to multiple selection</div>-->
                </div>
                    
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="edit_2nd_year_subject_1st" class="btn btn-primary">Save</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- Edit 2ND Subjects 1st sem -->

    <!-- Edit Subjects 2ND year 2nd sem-->
    <div class="modal fade" id="editSecondSubject2ndModal" tabindex="-1" role="dialog" aria-labelledby="editsubjectModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Subject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body mt-3">
                <form action="managedata.php" method="POST">
                    <input type="hidden" name="subject_id" id="2nd_subject_2nd_id">
                    <input type="hidden" name="courseid" value="<?php echo $curr_courseid?>">
                    <div class="form-group">
                        <label>Curriculum</label>
                        <input type="text" name="curr_code" id="cur_2nd_sub_2nd" value="<?php echo $curr_code?>" class="form-control text-center"  readonly>
                    </div>
                    
                    <div class="form-group">
                        <label>Year Level</label>
                        <select name="yearlevel" id="year_2nd_sub_2nd" class="form-control text-center" required>
                                <option value="">Select Year Level...</option>
                                <option value="1">1st</option>
                                <option value="2">2nd</option>
                                <option value="3">3rd</option>
                                <option value="4">4th</option>
                                <option value="5">5th</option>
                        </select>
                    </div> 

                    <div class="form-group">
                        <label>Semester</label>
                        <select  name="semester" id="sem_2nd_sub_2nd" class="form-control text-center" required>
                                <option value="">Select Semester...</option>
                                <option value="1st">1st Semester</option>
                                <option value="2nd">2nd Semester</option>
                        </select>
                    </div> 

                    <div class="form-group">
                        <label>Subject Code</label>
                        <input type="text" name="subjectcode" id="subcode_2nd_sub_2nd" class="form-control text-center" placeholder="Enter Subject Code"required>
                    </div>  
                    <div class="form-group">
                        <label>Description</label>
                        <textarea columns="2" type="text" name="description" id="des_2nd_sub_2nd" class="form-control text-center" placeholder="Enter Subject Description"required></textarea>
                    </div>  
                    <div class="form-group">
                        <label>Units</label>
                        <div class="row">
                            <div class="col">
                            <input  type="text" name="lec" id="lec_2nd_sub_2nd" class="form-control text-center" placeholder="Enter Lec Units" >
                            </div>
                            <div class="col">
                            <input  type="text" name="lab" id="lab_2nd_sub_2nd" class="form-control text-center" placeholder="Enter Lab Units" >
                            </div>
                            <div class="col">
                            <input  type="text" name="units" id="units_2nd_sub_2nd" class="form-control text-center" placeholder="Enter Lab Units" >
                            </div>
                        </div>
                    </div>  

                    <!--<div class="form-group">
                        <label>Prerequisites</label>
                        <select name="prereq[]" id="pre_2nd_sub_2nd" class="form-control multiple-data-2nd-2nd-edit" multiple style="width: 20rem;">
                            <?php
                                $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                if(mysqli_num_rows($getsub) > 0)
                                {
                                    foreach($getsub as $datas)
                                    {   
                            ?>
                                <option value="<?php echo $datas['subject_code']; ?>"><?php echo $datas['subject_code']; ?></option>
                            <?php
                                    }
                                }
                            else
                                {
                                    echo "No Records Found!!";
                                }
                            ?>         
                        </select>
                        <input type="hidden" name="subid" value="<?php echo $getsubid ?>">
                    </div> 
                    <div>Hold <span class="text-danger">CTRL</span> to multiple selection</div>-->
                </div>
                    
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="edit_2nd_year_subject_2nd" class="btn btn-primary">Save</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- Edit 2ND Subjects 1st sem -->

    <!-- Edit Subjects 2ND year summer sem-->
    <div class="modal fade" id="editSecondSubjectsummerModal" tabindex="-1" role="dialog" aria-labelledby="editsubjectModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Subject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body mt-3">
                <form action="managedata.php" method="POST">
                    <input type="hidden" name="subject_id" id="2nd_subject_summer_id">
                    <input type="hidden" name="courseid" value="<?php echo $curr_courseid?>">
                    <div class="form-group">
                        <label>Curriculum</label>
                        <input type="text" name="curr_code" id="cur_2nd_sub_summer" value="<?php echo $curr_code?>" class="form-control text-center"  readonly>
                    </div>
                    
                    <div class="form-group">
                        <label>Year Level</label>
                        <select name="yearlevel" id="year_2nd_sub_summer" class="form-control text-center" required>
                                <option value="">Select Year Level...</option>
                                <option value="1">1st</option>
                                <option value="2">2nd</option>
                                <option value="3">3rd</option>
                                <option value="4">4th</option>
                                <option value="5">5th</option>
                        </select>
                    </div> 

                    <div class="form-group">
                        <label>Semester</label>
                        <select  name="semester" id="sem_2nd_sub_summer" class="form-control text-center" required>
                                <option value="0">Select Semester...</option>
                                <option value="1st">1st Semester</option>
                                <option value="2nd">2nd Semester</option>
                                <option value="summer">Summer</option>
                        </select>
                    </div> 

                    <div class="form-group">
                        <label>Subject Code</label>
                        <input type="text" name="subjectcode" id="subcode_2nd_sub_summer" class="form-control text-center" placeholder="Enter Subject Code"required>
                    </div>  
                    <div class="form-group">
                        <label>Description</label>
                        <textarea columns="2" type="text" name="description" id="des_2nd_sub_summer" class="form-control text-center" placeholder="Enter Subject Description"required></textarea>
                    </div>  
                    <div class="form-group">
                        <label>Units</label>
                        <div class="row">
                            <div class="col">
                                <input  type="text" name="lec" id="lec_2nd_sub_summer" class="form-control text-center" placeholder="Enter Lec Units" >
                                <span class="text-secondary"><center>Lec</center></span>
                            </div>
                            <div class="col">
                                <input  type="text" name="lab" id="lab_2nd_sub_summer" class="form-control text-center" placeholder="Enter Lab Units" >
                                <span class="text-secondary"><center>Lab</center></span>
                            </div>
                            <div class="col">
                                <input  type="text" name="units" id="units_2nd_sub_summer" class="form-control text-center" placeholder="Enter Lab Units" >
                                <span class="text-secondary"><center>Units</center></span>
                            </div>
                        </div>
                    </div>  

                    <!--<div class="form-group">
                        <label>Prerequisites</label>
                        <select name="prereq[]" id="pre_2nd_sub_2nd" class="form-control multiple-data-2nd-2nd-edit" multiple style="width: 20rem;">
                            <?php
                                $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                if(mysqli_num_rows($getsub) > 0)
                                {
                                    foreach($getsub as $datas)
                                    {   
                            ?>
                                <option value="<?php echo $datas['subject_code']; ?>"><?php echo $datas['subject_code']; ?></option>
                            <?php
                                    }
                                }
                            else
                                {
                                    echo "No Records Found!!";
                                }
                            ?>         
                        </select>
                        <input type="hidden" name="subid" value="<?php echo $getsubid ?>">
                    </div> 
                    <div>Hold <span class="text-danger">CTRL</span> to multiple selection</div>-->
                </div>
                    
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="edit_2nd_year_subject_2nd" class="btn btn-primary">Save</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- Edit 2ND Subjects summer sem -->

        <!-- DELETE 1st subject 1st MODAL-->
        <div class="container container-fluid">
            <div class="modal fade" id="deleteSecondSubjectModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Subject</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="id" id="delete2ndsubject1stid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Subject?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_2nd_subject_1st" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--END OF DELETE 1st subject 1st MODAL-->

        <!-- DELETE 2nd subject 2nd MODAL-->
        <div class="container container-fluid">
            <div class="modal fade" id="deleteSecondSubject2ndModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Subject</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="id" id="delete2ndsubject2ndid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Subject?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_2nd_subject_2nd" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--END OF DELETE 2nd subject 2nd MODAL-->

        <!-- DELETE 2nd subject summer MODAL-->
        <div class="container container-fluid">
            <div class="modal fade" id="deleteSecondSubjectsummerModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Subject</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="id" id="delete2ndsubjectsummerid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Subject?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_2nd_subject_2nd" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--END OF DELETE 2nd subject summer MODAL-->

<!-- for Prereq 2nd subject 1st -->
    <!-- DELETE Subject 2nd 1st 1 prereq MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteSubject2nd11stPreqModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="id" id="prereq2ndsub11stid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Prerequisite?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF DELETE Subject 2nd 1st 1 prereq MODAL-->

    <!-- DELETE Subject 2nd 1st 2 prereq MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteSubject2nd21stPreqModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="id" id="prereq2ndsub21stid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Prerequisite?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF DELETE Subject 2nd 1st 2 prereq MODAL-->

    <!-- Add 2nd subject 1st Prerequisite MODAL-->
    <div class="container container-fluid">
            <div class="modal fade" id="addprereqSecond11stModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
                <div class="modal-dialog" style="max-width: 720px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Prerequisite</h5></h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                                <div class="modal-body">
                        <form action="managedata.php" method="POST">
                                    <input type="hidden" name="idprereq" id="addprereq2nd11stid">
                                    <div class="form-group">
                                        <label for="select-multiple-add-4th-1st">Prerequisites</label>                 
                                        <select name="prereqID[]" class="form-control add-prereq-multi-2nd-1st" id="select-multiple-add-4th-1st" style="width: 100%;" multiple required>
                                        <?php
                                            $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                            if(mysqli_num_rows($getsub) > 0)
                                            {
                                                foreach($getsub as $datas)
                                                {   
                                        ?>
                                            <option value="<?php echo $datas['id']; ?>"><?php echo $datas['description']; ?></option>
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
                                    <div>Hold <span class="text-danger">CTRL</span> to multiple selection</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="add_prereq_sub" class="btn btn-success">Save</button>
                                </div>                     
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF Add 2nd subject 1st Prerequisite MODAL-->

    <!-- EDIT 2nd subject 1prereq 1st sem Prerequisite MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="editprereqSecondSubject11stModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <div class="modal-body">
                                <input type="hidden" name="idprereq" id="prereq2nd11stid">
                                    <div class="form-group">
                                        <label for="prereq">Prerequisites</label>                 
                                        <select name="prereq" class="form-control" id="prereq" required>
                                            <option value="0">Select Prerequisite</option>
                                        <?php
                                            $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
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
                                    </div> 
                                    <div>Single Prerequisite Only</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="edit_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF edit 2nd subject 1prereq 1st sem Prerequisite MODAL-->

    <!-- EDIT 2nd subject 2prereq 1st sem Prerequisite MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="editprereqSecondSubject21stModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="idprereq" id="prereq2nd21stid">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="prereq">Prerequisites</label>                 
                                        <select name="prereq" class="form-control" id="prereq" required>
                                            <option value="0">Select Prerequisite</option>
                                        <?php
                                            $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
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
                                    </div> 
                                    <div>Single Prerequisite Only</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="edit_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF edit 2nd subject 2prereq 1st sem Prerequisite MODAL-->
<!-- for Prereq 2nd subject 1st -->

<!-- for Prereq 2nd subject 2nd -->
    <!-- DELETE Subject 2nd 1st prereq MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteSubject2nd12ndPreqModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="id" id="prereq2ndsub12ndid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Prerequisite?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF DELETE Subject 2nd 1st prereq MODAL-->

    <!-- DELETE Subject 2nd 2nd prereq MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteSubject2nd22ndPreqModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="id" id="prereq2ndsub22ndid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Prerequisite?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF DELETE Subject 2nd 2nd prereq MODAL-->

    <!-- Add 2nd subject 2nd Prerequisite MODAL-->
    <div class="container container-fluid">
            <div class="modal fade" id="addprereqSecond2ndModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
                <div class="modal-dialog" style="max-width: 720px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Prerequisite</h5></h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                                <div class="modal-body">
                        <form action="managedata.php" method="POST">
                                    <input type="hidden" name="idprereq" id="addprereq2nd2ndid">
                                    <div class="form-group">
                                        <label for="select-multiple-add">Prerequisites</label>                 
                                        <select name="prereqID[]" class="form-control add-prereq-multi-2nd-2nd" id="select-multiple-add" style="width: 100%;" multiple required>
                                        <?php
                                            $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                            if(mysqli_num_rows($getsub) > 0)
                                            {
                                                foreach($getsub as $datas)
                                                {   
                                        ?>
                                            <option value="<?php echo $datas['id']; ?>"><?php echo $datas['description']; ?></option>
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
                                    <div>Hold <span class="text-danger">CTRL</span> to multiple selection</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="add_prereq_sub" class="btn btn-success">Save</button>
                                </div>                     
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF Add 2nd subject 2nd Prerequisite MODAL-->

    <!-- EDIT 2nd subject 1prereq 2nd sem Prerequisite MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="editprereqSecondSubject12ndModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <div class="modal-body">
                                <input type="hidden" name="idprereq" id="prereq2nd12ndid">
                                    <div class="form-group">
                                        <label for="prereq">Prerequisites</label>                 
                                        <select name="prereq" class="form-control" id="prereq" required>
                                            <option value="0">Select Prerequisite</option>
                                        <?php
                                            $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
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
                                    </div> 
                                    <div>Single Prerequisite Only</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="edit_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF edit 2nd subject 1prereq 2nd sem Prerequisite MODAL-->

    <!-- EDIT 2nd subject 2prereq 2nd sem Prerequisite MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="editprereqSecondSubject22ndModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="idprereq" id="prereq2nd22ndid">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="prereq">Prerequisites</label>                 
                                        <select name="prereq" class="form-control" id="prereq" required>
                                            <option value="0">Select Prerequisite</option>
                                        <?php
                                            $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
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
                                    </div> 
                                    <div>Single Prerequisite Only</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="edit_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF edit 3r2ndd subject 2prereq 2nd sem Prerequisite MODAL-->
<!-- for Prereq 2nd subject 2nd -->

<!-- for Prereq 2nd subject summer -->
    <!-- DELETE Subject 2nd summer prereq MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteSubject2nd1summerPreqModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="id" id="prereq2ndsub1summerid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Prerequisite?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF DELETE Subject 2nd summer prereq MODAL-->

    <!-- DELETE Subject 2nd summer prereq MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteSubject2nd2summerPreqModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="id" id="prereq2ndsub2summerid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Prerequisite?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF DELETE Subject 2nd summer prereq MODAL-->

    <!-- Add 2nd subject summer Prerequisite MODAL-->
    <div class="container container-fluid">
            <div class="modal fade" id="addprereqSecondsummerModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
                <div class="modal-dialog" style="max-width: 720px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Prerequisite</h5></h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                                <div class="modal-body">
                        <form action="managedata.php" method="POST">
                                    <input type="hidden" name="idprereq" id="addprereq2ndsummerid">
                                    <div class="form-group">
                                        <label for="select-multiple-add-2nd-summer">Prerequisites</label>                 
                                        <select name="prereqID[]" class="form-control add-prereq-multi-2nd-summer" id="select-multiple-add-2nd-summer" style="width: 100%;" multiple required>
                                        <?php
                                            $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                            if(mysqli_num_rows($getsub) > 0)
                                            {
                                                foreach($getsub as $datas)
                                                {   
                                        ?>
                                            <option value="<?php echo $datas['id']; ?>"><?php echo $datas['description']; ?></option>
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
                                    <div>Hold <span class="text-danger">CTRL</span> to multiple selection</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="add_prereq_sub" class="btn btn-success">Save</button>
                                </div>                     
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF Add 2nd subject summer Prerequisite MODAL-->

    <!-- EDIT 2nd subject 1prereq summer sem Prerequisite MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="editprereqSecondSubject1summerModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <div class="modal-body">
                                <input type="hidden" name="idprereq" id="prereq2nd1summerid">
                                    <div class="form-group">
                                        <label for="prereq">Prerequisites</label>                 
                                        <select name="prereq" class="form-control" id="prereq" required>
                                            <option value="0">Select Prerequisite</option>
                                        <?php
                                            $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                            if(mysqli_num_rows($getsub) > 0)
                                            {
                                                foreach($getsub as $datas)
                                                {   
                                        ?>
                                            <option value="<?php echo $datas['id']; ?>"><?php echo $datas['description']; ?></option>
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
                                    <div>Single Prerequisite Only</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="edit_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF edit 2nd subject 1prereq summer sem Prerequisite MODAL-->

    <!-- EDIT 2nd subject 2prereq summer sem Prerequisite MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="editprereqSecondSubject2summerModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="idprereq" id="prereq2nd2summerid">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="prereq">Prerequisites</label>                 
                                        <select name="prereq" class="form-control" id="prereq" required>
                                            <option value="0">Select Prerequisite</option>
                                        <?php
                                            $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                            if(mysqli_num_rows($getsub) > 0)
                                            {
                                                foreach($getsub as $datas)
                                                {   
                                        ?>
                                            <option value="<?php echo $datas['id']; ?>"><?php echo $datas['description']; ?></option>
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
                                    <div>Single Prerequisite Only</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="edit_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF edit 2nd subject 2prereq summer sem Prerequisite MODAL-->
<!-- for Prereq 2nd subject summer -->
<!-- End Of Second Year List -->


<!-- Third Year List -->
    <!-- Edit Subjects 3rd year 1st sem-->
    <div class="modal fade" id="editThirdSubjectModal" tabindex="-1" role="dialog" aria-labelledby="editsubjectModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Subject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body mt-3">
                <form action="managedata.php" method="POST">
                    <input type="hidden" name="subject_id" id="3rd_subject_1st_id">
                    <input type="hidden" name="courseid" value="<?php echo $curr_courseid?>">
                    <div class="form-group">
                        <label>Curriculum</label>
                        <input type="text" name="curr_code" id="cur_3rd_sub_1st" value="<?php echo $curr_code?>" class="form-control text-center"  readonly>
                    </div>
                    
                    <div class="form-group">
                        <label>Year Level</label>
                        <select name="yearlevel" id="year_3rd_sub_1st" class="form-control text-center" required>
                                <option value="">Select Year Level...</option>
                                <option value="1">1st</option>
                                <option value="2">2nd</option>
                                <option value="3">3rd</option>
                                <option value="4">4th</option>
                                <option value="5">5th</option>
                        </select>
                    </div> 

                    <div class="form-group">
                        <label>Semester</label>
                        <select  name="semester" id="sem_3rd_sub_1st" class="form-control text-center" required>
                                <option value="0">Select Semester...</option>
                                <option value="1st">1st Semester</option>
                                <option value="2nd">2nd Semester</option>
                                <option value="summer">Summer</option>
                        </select>
                    </div> 

                    <div class="form-group">
                        <label>Subject Code</label>
                        <input type="text" name="subjectcode" id="subcode_3rd_sub_1st" class="form-control text-center" placeholder="Enter Subject Code"required>
                    </div>  
                    <div class="form-group">
                        <label>Description</label>
                        <textarea columns="2" type="text" name="description" id="des_3rd_sub_1st" class="form-control text-center" placeholder="Enter Subject Description"required></textarea>
                    </div>  
                    <div class="form-group">
                        <label>Units</label>
                        <div class="row">
                            <div class="col">
                                <input  type="text" name="lec" id="lec_3rd_sub_1st" class="form-control text-center" placeholder="Enter Lec Units" >
                                <span class="text-secondary"><center>Lec</center></span>
                            </div>
                            <div class="col">
                                <input  type="text" name="lab" id="lab_3rd_sub_1st" class="form-control text-center" placeholder="Enter Lab Units" >
                                <span class="text-secondary"><center>Lab</center></span>
                            </div>
                            <div class="col">
                                <input  type="text" name="units" id="units_3rd_sub_1st" class="form-control text-center" placeholder="Enter Lab Units" >
                                <span class="text-secondary"><center>Units</center></span>
                            </div>
                        </div>
                    </div>  

                    <!--<div class="form-group">
                        <label>Prerequisites</label>
                        <select name="prereq[]" id="pre_3rd_sub_1st" class="form-control multiple-data-3-1st" multiple style="width: 20rem;">
                            <?php
                                $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                if(mysqli_num_rows($getsub) > 0)
                                {
                                    foreach($getsub as $datas)
                                    {   
                            ?>
                                <option value="<?php echo $datas['subject_code']; ?>"><?php echo $datas['subject_code']; ?></option>
                            <?php
                                    }
                                }
                            else
                                {
                                    echo "No Records Found!!";
                                }
                            ?>          
                        </select>
                        <input type="hidden" name="subid" value="<?php echo $getsubid ?>">
                    </div> 
                    <div>Hold <span class="text-danger">CTRL</span> to multiple selection</div>-->
                </div>
                    
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="edit_3rd_year_subject_1st" class="btn btn-primary">Save</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- Edit 3rd Subjects 1st sem -->

    <!-- Edit Subjects 3rd year 2nd sem-->
    <div class="modal fade" id="editThirdSubject2ndModal" tabindex="-1" role="dialog" aria-labelledby="editsubjectModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Subject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body mt-3">
                <form action="managedata.php" method="POST">
                    <input type="hidden" name="subject_id" id="3rd_subject_2nd_id">
                    <input type="hidden" name="courseid" value="<?php echo $curr_courseid?>">
                    <div class="form-group">
                        <label>Curriculum</label>
                        <input type="text" name="curr_code" id="cur_3rd_sub_2nd" value="<?php echo $curr_code?>" class="form-control text-center"  readonly>
                    </div>
                    
                    <div class="form-group">
                        <label>Year Level</label>
                        <select name="yearlevel" id="year_3rd_sub_2nd" class="form-control text-center" required>
                                <option value="">Select Year Level...</option>
                                <option value="1">1st</option>
                                <option value="2">2nd</option>
                                <option value="3">3rd</option>
                                <option value="4">4th</option>
                                <option value="5">5th</option>
                        </select>
                    </div> 

                    <div class="form-group">
                        <label>Semester</label>
                        <select  name="semester" id="sem_3rd_sub_2nd" class="form-control text-center" required>
                                <option value="0">Select Semester...</option>
                                <option value="1st">1st Semester</option>
                                <option value="2nd">2nd Semester</option>
                                <option value="summer">Summer</option>
                        </select>
                    </div> 

                    <div class="form-group">
                        <label>Subject Code</label>
                        <input type="text" name="subjectcode" id="subcode_3rd_sub_2nd" class="form-control text-center" placeholder="Enter Subject Code"required>
                    </div>  
                    <div class="form-group">
                        <label>Description</label>
                        <textarea columns="2" type="text" name="description" id="des_3rd_sub_2nd" class="form-control text-center" placeholder="Enter Subject Description"required></textarea>
                    </div>  
                    <div class="form-group">
                        <label>Units</label>
                        <div class="row">
                            <div class="col">
                                <input  type="text" name="lec" id="lec_3rd_sub_2nd" class="form-control text-center" placeholder="Enter Lec Units" >
                                <span class="text-secondary"><center>Lec</center></span>
                            </div>
                            <div class="col">
                                <input  type="text" name="lab" id="lab_3rd_sub_2nd" class="form-control text-center" placeholder="Enter Lab Units" >
                                <span class="text-secondary"><center>Lab</center></span>
                            </div>
                            <div class="col">
                                <input  type="text" name="units" id="units_3rd_sub_2nd" class="form-control text-center" placeholder="Enter Lab Units" >
                                <span class="text-secondary"><center>Units</center></span>
                            </div>
                        </div>
                    </div>  

                    <!--<div class="form-group">
                        <label>Prerequisites</label>
                        <select name="prereq[]" id="pre_3rd_sub_2nd" class="form-control multiple-data-3-2nd" multiple style="width: 20rem;">
                            <?php
                                $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                if(mysqli_num_rows($getsub) > 0)
                                {
                                    foreach($getsub as $datas)
                                    {   
                            ?>
                                <option value="<?php echo $datas['subject_code']; ?>"><?php echo $datas['subject_code']; ?></option>
                            <?php
                                    }
                                }
                            else
                                {
                                    echo "No Records Found!!";
                                }
                            ?>          
                        </select>
                        <input type="hidden" name="subid" value="<?php echo $getsubid ?>">
                    </div> 
                    <div>Hold <span class="text-danger">CTRL</span> to multiple selection</div>-->
                </div>
                    
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="edit_3rd_year_subject_2nd" class="btn btn-primary">Save</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- Edit 3rd Subjects 2nd sem -->

    <!-- Edit Subjects 3rd year summer sem-->
    <div class="modal fade" id="editThirdSubjectsummerModal" tabindex="-1" role="dialog" aria-labelledby="editsubjectModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Subject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body mt-3">
                <form action="managedata.php" method="POST">
                    <input type="hidden" name="subject_id" id="3rd_subject_summer_id">
                    <input type="hidden" name="courseid" value="<?php echo $curr_courseid?>">
                    <div class="form-group">
                        <label>Curriculum</label>
                        <input type="text" name="curr_code" id="cur_3rd_sub_summer" value="<?php echo $curr_code?>" class="form-control text-center"  readonly>
                    </div>
                    
                    <div class="form-group">
                        <label>Year Level</label>
                        <select name="yearlevel" id="year_3rd_sub_summer" class="form-control text-center" required>
                                <option value="">Select Year Level...</option>
                                <option value="1">1st</option>
                                <option value="2">2nd</option>
                                <option value="3">3rd</option>
                                <option value="4">4th</option>
                                <option value="5">5th</option>
                        </select>
                    </div> 

                    <div class="form-group">
                        <label>Semester</label>
                        <select  name="semester" id="sem_3rd_sub_summer" class="form-control text-center" required>
                                <option value="0">Select Semester...</option>
                                <option value="1st">1st Semester</option>
                                <option value="2nd">2nd Semester</option>
                                <option value="summer">Summer</option>
                        </select>
                    </div> 

                    <div class="form-group">
                        <label>Subject Code</label>
                        <input type="text" name="subjectcode" id="subcode_3rd_sub_summer" class="form-control text-center" placeholder="Enter Subject Code"required>
                    </div>  
                    <div class="form-group">
                        <label>Description</label>
                        <textarea columns="2" type="text" name="description" id="des_3rd_sub_summer" class="form-control text-center" placeholder="Enter Subject Description"required></textarea>
                    </div>  
                    <div class="form-group">
                        <label>Units</label>
                        <div class="row">
                            <div class="col">
                                <input  type="text" name="lec" id="lec_3rd_sub_summer" class="form-control text-center" placeholder="Enter Lec Units" >
                                <span class="text-secondary"><center>Lec</center></span>
                            </div>
                            <div class="col">
                                <input  type="text" name="lab" id="lab_3rd_sub_summer" class="form-control text-center" placeholder="Enter Lab Units" >
                                <span class="text-secondary"><center>Lab</center></span>
                            </div>
                            <div class="col">
                                <input  type="text" name="units" id="units_3rd_sub_summer" class="form-control text-center" placeholder="Enter Lab Units" >
                                <span class="text-secondary"><center>Units</center></span>
                            </div>
                        </div>
                    </div>  

                    <!--<div class="form-group">
                        <label>Prerequisites</label>
                        <select name="prereq[]" id="pre_3rd_sub_2nd" class="form-control multiple-data-3-2nd" multiple style="width: 20rem;">
                            <?php
                                $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                if(mysqli_num_rows($getsub) > 0)
                                {
                                    foreach($getsub as $datas)
                                    {   
                            ?>
                                <option value="<?php echo $datas['subject_code']; ?>"><?php echo $datas['subject_code']; ?></option>
                            <?php
                                    }
                                }
                            else
                                {
                                    echo "No Records Found!!";
                                }
                            ?>          
                        </select>
                        <input type="hidden" name="subid" value="<?php echo $getsubid ?>">
                    </div> 
                    <div>Hold <span class="text-danger">CTRL</span> to multiple selection</div>-->
                </div>
                    
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="edit_3rd_year_subject_2nd" class="btn btn-primary">Save</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- Edit 3rd Subjects summer sem -->

    <!-- DELETE 3RD subject 1st MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteThirdSubjectModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Subject</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="id" id="delete3rdsubject1stid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Subject?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_3rd_subject_1st" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                </div>
            </div>
        </div>
    </div>
    <!--END OF DELETE 3rd subject 1st MODAL-->

    <!-- DELETE 3RD subject 2nd MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteThirdSubject2ndModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Subject</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="id" id="delete3rdsubject2ndid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Subject?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_3rd_subject_2nd" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                </div>
            </div>
        </div>
    </div>
    <!--END OF DELETE 3rd subject 2nd MODAL-->

    <!-- DELETE 3RD subject summer MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteThirdSubjectsummerModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Subject</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="id" id="delete3rdsubjectsummerid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Subject?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_3rd_subject_2nd" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                </div>
            </div>
        </div>
    </div>
    <!--END OF DELETE 3rd subject summer MODAL-->

<!-- for Prereq 3rd subject 1st -->
    <!-- DELETE Subject 3rd 1st 1 prereq MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteSubject3rd11stPreqModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="id" id="prereq3rdsub11stid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Prerequisite?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF DELETE Subject 3rd 1st 1 prereq MODAL-->

    <!-- DELETE Subject 3rd 1st 2 prereq MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteSubject3rd21stPreqModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="id" id="prereq3rdsub21stid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Prerequisite?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF DELETE Subject 3rd 1st 2 prereq MODAL-->

    <!-- Add 3rd subject 1st Prerequisite MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="addprereqThird11stModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog" style="max-width: 720px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Prerequisite</h5></h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                                <div class="modal-body">
                        <form action="managedata.php" method="POST">
                                    <input type="hidden" name="idprereq" id="addprereq3rd11stid">
                                    <div class="form-group">
                                        <label for="select-multiple-add-4th-1st">Prerequisites</label>                 
                                        <select name="prereqID[]" class="form-control add-prereq-multi-3rd-1st" id="select-multiple-add-4th-1st" style="width: 100%;" multiple required>
                                        <?php
                                            $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                            if(mysqli_num_rows($getsub) > 0)
                                            {
                                                foreach($getsub as $datas)
                                                {   
                                        ?>
                                            <option value="<?php echo $datas['id']; ?>"><?php echo $datas['description']; ?></option>
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
                                    <div>Hold <span class="text-danger">CTRL</span> to multiple selection</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="add_prereq_sub" class="btn btn-success">Yes</button>
                                </div>                     
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF Add 3rd subject 1st Prerequisite MODAL-->

    <!-- EDIT 3rd subject 1prereq 1st sem Prerequisite MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="editprereqThirdSubject11stModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <div class="modal-body">
                                <input type="hidden" name="idprereq" id="prereq3rd11stid">
                                    <div class="form-group">
                                        <label for="prereq">Prerequisites</label>                 
                                        <select name="prereq" class="form-control" id="prereq" required>
                                            <option value="0">Select Prerequisite</option>
                                        <?php
                                            $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                            if(mysqli_num_rows($getsub) > 0)
                                            {
                                                foreach($getsub as $datas)
                                                {   
                                        ?>
                                            <option value="<?php echo $datas['id']; ?>"><?php echo $datas['description']; ?></option>
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
                                    <div>Single Prerequisite Only</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="edit_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF edit 3rd subject 1prereq 1st sem Prerequisite MODAL-->

    <!-- EDIT 3rd subject 2prereq 1st sem Prerequisite MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="editprereqThirdSubject21stModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="idprereq" id="prereq3rd21stid">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="prereq">Prerequisites</label>                 
                                        <select name="prereq" class="form-control" id="prereq" required>
                                            <option value="0">Select Prerequisite</option>
                                        <?php
                                            $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                            if(mysqli_num_rows($getsub) > 0)
                                            {
                                                foreach($getsub as $datas)
                                                {   
                                        ?>
                                            <option value="<?php echo $datas['id']; ?>"><?php echo $datas['description']; ?></option>
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
                                    <div>Single Prerequisite Only</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="edit_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF edit 3rd subject 2prereq 1st sem Prerequisite MODAL-->
<!-- for Prereq 3rd subject 1st -->

<!-- for Prereq 3rd subject 2nd -->
    <!-- DELETE Subject 3rd 1st prereq MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteSubject3rd12ndPreqModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="id" id="prereq3rdsub12ndid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Prerequisite?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF DELETE Subject 3rd 1st prereq MODAL-->

    <!-- DELETE Subject 3rd 2nd prereq MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteSubject3rd22ndPreqModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="id" id="prereq3rdsub22ndid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Prerequisite?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF DELETE Subject 3rd 2nd prereq MODAL-->

    <!-- Add 3rd subject 2nd Prerequisite MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="addprereqThird2ndModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog" style="max-width: 720px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Prerequisite</h5></h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                                <div class="modal-body">
                        <form action="managedata.php" method="POST">
                                    <input type="hidden" name="idprereq" id="addprereq3rd2ndid">
                                    <div class="form-group">
                                        <label for="select-multiple-add">Prerequisites</label>                 
                                        <select name="prereqID[]" class="form-control add-prereq-multi-3rd-2nd" id="select-multiple-add" style="width: 100%;" multiple required>
                                        <?php
                                            $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                            if(mysqli_num_rows($getsub) > 0)
                                            {
                                                foreach($getsub as $datas)
                                                {   
                                        ?>
                                            <option value="<?php echo $datas['id']; ?>"><?php echo $datas['description']; ?></option>
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
                                    <div>Hold <span class="text-danger">CTRL</span> to multiple selection</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="add_prereq_sub" class="btn btn-success">Yes</button>
                                </div>                     
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF Add 3rd subject 2nd Prerequisite MODAL-->

    <!-- EDIT 3rd subject 1prereq 2nd sem Prerequisite MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="editprereqThirdSubject12ndModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <div class="modal-body">
                                <input type="hidden" name="idprereq" id="prereq3rd12ndid">
                                    <div class="form-group">
                                        <label for="prereq">Prerequisites</label>                 
                                        <select name="prereq" class="form-control" id="prereq" required>
                                            <option value="0">Select Prerequisite</option>
                                        <?php
                                            $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                            if(mysqli_num_rows($getsub) > 0)
                                            {
                                                foreach($getsub as $datas)
                                                {   
                                        ?>
                                            <option value="<?php echo $datas['id']; ?>"><?php echo $datas['description']; ?></option>
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
                                    <div>Single Prerequisite Only</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="edit_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF edit 3rd subject 1prereq 2nd sem Prerequisite MODAL-->

    <!-- EDIT 3rd subject 2prereq 2nd sem Prerequisite MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="editprereqThirdSubject22ndModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="idprereq" id="prereq3rd22ndid">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="prereq">Prerequisites</label>                 
                                        <select name="prereq" class="form-control" id="prereq" required>
                                            <option value="0">Select Prerequisite</option>
                                        <?php
                                            $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                            if(mysqli_num_rows($getsub) > 0)
                                            {
                                                foreach($getsub as $datas)
                                                {   
                                        ?>
                                            <option value="<?php echo $datas['id']; ?>"><?php echo $datas['description']; ?></option>
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
                                    <div>Single Prerequisite Only</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="edit_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF edit 3rd subject 2prereq 2nd sem Prerequisite MODAL-->
<!-- for Prereq 3rd subject 2nd -->

<!-- for Prereq 3rd subject summer -->
    <!-- DELETE Subject 3rd summer prereq MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteSubject3rd1summerPreqModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="id" id="prereq3rdsub1summerid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Prerequisite?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF DELETE Subject 3rd summer prereq MODAL-->

    <!-- DELETE Subject 3rd summer prereq MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteSubject3rd2summerPreqModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="id" id="prereq3rdsub2summerid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Prerequisite?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF DELETE Subject 3rd summer prereq MODAL-->

    <!-- Add 3rd subject summer Prerequisite MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="addprereqThirdsummerModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog" style="max-width: 720px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Prerequisite</h5></h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                                <div class="modal-body">
                        <form action="managedata.php" method="POST">
                                    <input type="hidden" name="idprereq" id="addprereq3rdsummerid">
                                    <div class="form-group">
                                        <label for="select-multiple-add-3rd-summer">Prerequisites</label>                 
                                        <select name="prereqID[]" class="form-control add-prereq-multi-3rd-summer" id="select-multiple-add-3rd-summer" style="width: 100%;" multiple required>
                                        <?php
                                            $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                            if(mysqli_num_rows($getsub) > 0)
                                            {
                                                foreach($getsub as $datas)
                                                {   
                                        ?>
                                            <option value="<?php echo $datas['id']; ?>"><?php echo $datas['description']; ?></option>
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
                                    <div>Hold <span class="text-danger">CTRL</span> to multiple selection</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="add_prereq_sub" class="btn btn-success">Yes</button>
                                </div>                     
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF Add 3rd subject summer Prerequisite MODAL-->

    <!-- EDIT 3rd subject 1prereq summer sem Prerequisite MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="editprereqThirdSubject1summerModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <div class="modal-body">
                                <input type="hidden" name="idprereq" id="prereq3rd1summerid">
                                    <div class="form-group">
                                        <label for="prereq">Prerequisites</label>                 
                                        <select name="prereq" class="form-control" id="prereq" required>
                                            <option value="0">Select Prerequisite</option>
                                        <?php
                                            $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                            if(mysqli_num_rows($getsub) > 0)
                                            {
                                                foreach($getsub as $datas)
                                                {   
                                        ?>
                                            <option value="<?php echo $datas['id']; ?>"><?php echo $datas['description']; ?></option>
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
                                    <div>Single Prerequisite Only</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="edit_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF edit 3rd subject 1prereq summer sem Prerequisite MODAL-->

    <!-- EDIT 3rd subject 2prereq summer sem Prerequisite MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="editprereqThirdSubject2summerModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="idprereq" id="prereq3rd2summerid">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="prereq">Prerequisites</label>                 
                                        <select name="prereq" class="form-control" id="prereq" required>
                                            <option value="0">Select Prerequisite</option>
                                        <?php
                                            $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                            if(mysqli_num_rows($getsub) > 0)
                                            {
                                                foreach($getsub as $datas)
                                                {   
                                        ?>
                                            <option value="<?php echo $datas['id']; ?>"><?php echo $datas['description']; ?></option>
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
                                    <div>Single Prerequisite Only</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="edit_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF edit 3rd subject 2prereq summer sem Prerequisite MODAL-->
<!-- for Prereq 3rd subject summer -->
<!-- End Of Third Year List -->

<!-- Fourth Year List -->
    <!-- Edit Subjects 4th year 1st sem-->
    <div class="modal fade" id="editFourthSubjectModal" tabindex="-1" role="dialog" aria-labelledby="editsubjectModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Subject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body mt-3">
                <form action="managedata.php" method="POST">
                    <input type="hidden" name="subject_id" id="4th_subject_1st_id">
                    <input type="hidden" name="courseid" value="<?php echo $curr_courseid?>">
                    <div class="form-group">
                        <label>Curriculum</label>
                        <input type="text" name="curr_code" id="cur_4th_sub_1st" value="<?php echo $curr_code?>" class="form-control text-center"  readonly>
                    </div>
                    
                    <div class="form-group">
                        <label>Year Level</label>
                        <select name="yearlevel" id="year_4th_sub_1st" class="form-control text-center" required>
                                <option value="0">Select Year Level...</option>
                                <option value="1">1st</option>
                                <option value="2">2nd</option>
                                <option value="3">3rd</option>
                                <option value="4">4th</option>
                                <option value="5">5th</option>
                        </select>
                    </div> 

                    <div class="form-group">
                        <label>Semester</label>
                        <select name="semester" id="sem_4th_sub_1st" class="form-control text-center" required>
                                <option value="0">Select Semester...</option>
                                <option value="1st">1st Semester</option>
                                <option value="2nd">2nd Semester</option>
                                <option value="summer">Summer</option>
                        </select>
                    </div> 

                    <div class="form-group">
                        <label>Subject Code</label>
                        <input type="text" name="subjectcode" id="subcode_4th_sub_1st" class="form-control text-center" placeholder="Enter Subject Code"required>
                    </div>  
                    <div class="form-group">
                        <label>Description</label>
                        <textarea columns="2" type="text" name="description" id="des_4th_sub_1st" class="form-control text-center" placeholder="Enter Subject Description"required></textarea>
                    </div>  
                    <div class="form-group">
                        <label>Units</label>
                        <div class="row">
                            <div class="col">
                                <input  type="text" name="lec" id="lec_4th_sub_1st" class="form-control text-center" placeholder="Enter Lec Units" >
                                <span class="text-secondary"><center>Lec</center></span>
                            </div>
                            <div class="col">
                                <input  type="text" name="lab" id="lab_4th_sub_1st" class="form-control text-center" placeholder="Enter Lab Units" >
                                <span class="text-secondary"><center>Lab</center></span>
                            </div>
                            <div class="col">
                                <input  type="text" name="units" id="units_4th_sub_1st" class="form-control text-center" placeholder="Enter Lab Units" >
                                <span class="text-secondary"><center>Units</center></span>
                            </div>
                        </div>
                    </div>  
                    <!--
                    <div class="form-group">
                        <label>Prerequisites</label>
                        <select name="prereq[]" id="pre_4th_sub_1st" class="form-control multiple-data-4-1st" multiple style="width: 20rem;">
                            <?php
                                $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                if(mysqli_num_rows($getsub) > 0)
                                {
                                    foreach($getsub as $datas)
                                    {   
                            ?>
                                <option value="<?php echo $datas['subject_code']; ?>"><?php echo $datas['subject_code']; ?></option>
                            <?php
                                    }
                                }
                            else
                                {
                                    echo "No Records Found!!";
                                }
                            ?>          
                        </select>
                        <input type="hidden" name="subid" value="<?php echo $getsubid ?>">
                    </div> 
                    <div>Hold <span class="text-danger">CTRL</span> to multiple selection</div> -->
                </div>
                    
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="edit_4th_year_subject_1st" class="btn btn-primary">Save</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- Edit 4th Subjects 1st sem -->

    <!-- Edit Subjects 4th year 2nd sem-->
    <div class="modal fade" id="editFourthSubject2ndModal" tabindex="-1" role="dialog" aria-labelledby="editsubjectModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Subject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body mt-3">
                <form action="managedata.php" method="POST">
                    <input type="hidden" name="subject_id" id="4th_subject_2nd_id">
                    <input type="hidden" name="courseid" value="<?php echo $curr_courseid?>">
                    <div class="form-group">
                        <label>Curriculum</label>
                        <input type="text" name="curr_code" id="cur_4th_sub_2nd" value="<?php echo $curr_code?>" class="form-control text-center"  readonly>
                    </div>
                    
                    <div class="form-group">
                        <label>Year Level</label>
                        <select name="yearlevel" id="year_4th_sub_2nd" class="form-control text-center" required>
                                <option value="0">Select Year Level...</option>
                                <option value="1">1st</option>
                                <option value="2">2nd</option>
                                <option value="3">3rd</option>
                                <option value="4">4th</option>
                                <option value="5">5th</option>
                        </select>
                    </div> 

                    <div class="form-group">
                        <label>Semester</label>
                        <select  name="semester" id="sem_4th_sub_2nd" class="form-control text-center" required>
                                <option value="0">Select Semester...</option>
                                <option value="1st">1st Semester</option>
                                <option value="2nd">2nd Semester</option>
                                <option value="summer">Summer</option>
                        </select>
                    </div> 

                    <div class="form-group">
                        <label>Subject Code</label>
                        <input type="text" name="subjectcode" id="subcode_4th_sub_2nd" class="form-control text-center" placeholder="Enter Subject Code"required>
                    </div>  
                    <div class="form-group">
                        <label>Description</label>
                        <textarea columns="2" type="text" name="description" id="des_4th_sub_2nd" class="form-control text-center" placeholder="Enter Subject Description"required></textarea>
                    </div>  
                    <div class="form-group">
                        <label>Units</label>
                        <div class="row">
                            <div class="col">
                                <input  type="text" name="lec" id="lec_4th_sub_2nd" class="form-control text-center" placeholder="Enter Lec Units" >
                                <span class="text-secondary"><center>Lec</center></span>
                            </div>
                            <div class="col">
                                <input  type="text" name="lab" id="lab_4th_sub_2nd" class="form-control text-center" placeholder="Enter Lab Units" >
                                <span class="text-secondary"><center>Lab</center></span>
                            </div>
                            <div class="col">
                                <input  type="text" name="units" id="units_4th_sub_2nd" class="form-control text-center" placeholder="Enter Lab Units" >
                                <span class="text-secondary"><center>Units</center></span>
                            </div>
                        </div>
                    </div>  

                    <!--<div class="form-group">
                        <label>Prerequisites</label>
                        <select name="prereq[]" id="pre_4th_sub_2nd" class="form-control multiple-data-4-2nd" multiple style="width: 20rem;">
                            <?php
                                $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                if(mysqli_num_rows($getsub) > 0)
                                {
                                    foreach($getsub as $datas)
                                    {   
                            ?>
                                <option value="<?php echo $datas['subject_code']; ?>"><?php echo $datas['subject_code']; ?></option>
                            <?php
                                    }
                                }
                            else
                                {
                                    echo "No Records Found!!";
                                }
                            ?>          
                        </select>
                        <input type="hidden" name="subid" value="<?php echo $getsubid ?>">
                    </div> 
                    <div>Hold <span class="text-danger">CTRL</span> to multiple selection</div> -->
                </div>
                    
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="edit_4th_year_subject_2nd" class="btn btn-primary">Save</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- Edit 4th Subjects 2nd sem -->

    <!-- Edit Subjects 4th year summer sem-->
    <div class="modal fade" id="editFourthSubjectsummerModal" tabindex="-1" role="dialog" aria-labelledby="editsubjectModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Subject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body mt-3">
                <form action="managedata.php" method="POST">
                    <input type="hidden" name="subject_id" id="4th_subject_summer_id">
                    <input type="hidden" name="courseid" value="<?php echo $curr_courseid?>">
                    <div class="form-group">
                        <label>Curriculum</label>
                        <input type="text" name="curr_code" id="cur_4th_sub_summer" value="<?php echo $curr_code?>" class="form-control text-center"  readonly>
                    </div>
                    
                    <div class="form-group">
                        <label>Year Level</label>
                        <select name="yearlevel" id="year_4th_sub_summer" class="form-control text-center" required>
                                <option value="0">Select Year Level...</option>
                                <option value="1">1st</option>
                                <option value="2">2nd</option>
                                <option value="3">3rd</option>
                                <option value="4">4th</option>
                                <option value="5">5th</option>
                        </select>
                    </div> 

                    <div class="form-group">
                        <label>Semester</label>
                        <select  name="semester" id="sem_4th_sub_summer" class="form-control text-center" required>
                                <option value="0">Select Semester...</option>
                                <option value="1st">1st Semester</option>
                                <option value="2nd">2nd Semester</option>
                                <option value="summer">Summer</option>
                        </select>
                    </div> 

                    <div class="form-group">
                        <label>Subject Code</label>
                        <input type="text" name="subjectcode" id="subcode_4th_sub_summer" class="form-control text-center" placeholder="Enter Subject Code"required>
                    </div>  
                    <div class="form-group">
                        <label>Description</label>
                        <textarea columns="2" type="text" name="description" id="des_4th_sub_summer" class="form-control text-center" placeholder="Enter Subject Description"required></textarea>
                    </div>  
                    <div class="form-group">
                        <label>Units</label>
                        <div class="row">
                            <div class="col">
                                <input  type="text" name="lec" id="lec_4th_sub_summer" class="form-control text-center" placeholder="Enter Lec Units" >
                                <span class="text-secondary"><center>Lec</center></span>
                            </div>
                            <div class="col">
                                <input  type="text" name="lab" id="lab_4th_sub_summer" class="form-control text-center" placeholder="Enter Lab Units" >
                                <span class="text-secondary"><center>Lab</center></span>
                            </div>
                            <div class="col">
                                <input  type="text" name="units" id="units_4th_sub_summer" class="form-control text-center" placeholder="Enter Lab Units" >
                                <span class="text-secondary"><center>Units</center></span>
                            </div>
                        </div>
                    </div>  

                    <!--<div class="form-group">
                        <label>Prerequisites</label>
                        <select name="prereq[]" id="pre_4th_sub_2nd" class="form-control multiple-data-4-2nd" multiple style="width: 20rem;">
                            <?php
                                $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                if(mysqli_num_rows($getsub) > 0)
                                {
                                    foreach($getsub as $datas)
                                    {   
                            ?>
                                <option value="<?php echo $datas['subject_code']; ?>"><?php echo $datas['subject_code']; ?></option>
                            <?php
                                    }
                                }
                            else
                                {
                                    echo "No Records Found!!";
                                }
                            ?>          
                        </select>
                        <input type="hidden" name="subid" value="<?php echo $getsubid ?>">
                    </div> 
                    <div>Hold <span class="text-danger">CTRL</span> to multiple selection</div> -->
                </div>
                    
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="edit_4th_year_subject_2nd" class="btn btn-primary">Save</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- Edit 4th Subjects summer sem -->

    <!-- DELETE 4th subject 1st MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteFourthSubjectModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Subject</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="id" id="delete4thsubject1stid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Subject?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_4th_subject_1st" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                </div>
            </div>
        </div>
    </div>
    <!--END OF DELETE 4th subject 1st MODAL-->

    <!-- DELETE 4th subject 2nd MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteFourthSubject2ndModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Subject</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="id" id="delete4thsubject2ndid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Subject?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_4th_subject_2nd" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                </div>
            </div>
        </div>
    </div>
    <!--END OF DELETE 4th subject 2nd MODAL-->

    <!-- DELETE 4th subject summer MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteFourthSubjectsummerModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Subject</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="id" id="delete4thsubjectsummerid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Subject?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_4th_subject_2nd" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                </div>
            </div>
        </div>
    </div>
    <!--END OF DELETE 4th subject summer MODAL-->

<!-- for Prereq 4th subject 1st -->
    <!-- DELETE Subject 4th 1st 1 prereq MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteSubject4th11stPreqModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="id" id="prereqfourthsub11stid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Prerequisite?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF DELETE Subject 4th 1st 1 prereq MODAL-->

    <!-- DELETE Subject 4th 1st 2 prereq MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteSubject4th21stPreqModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="id" id="prereqfourthsub21stid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Prerequisite?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF DELETE Subject 4th 1st 2 prereq MODAL-->

    <!-- Add 4th subject 1st Prerequisite MODAL-->
    <div class="container container-fluid">
            <div class="modal fade" id="addprereqFourth11stModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
                <div class="modal-dialog" style="max-width: 720px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Prerequisite</h5></h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                                <div class="modal-body">
                        <form action="managedata.php" method="POST">
                                    <input type="hidden" name="idprereq" id="addprereq4th11stid">
                                    <div class="form-group">
                                        <label for="select-multiple-add-4th-1st">Prerequisites</label>                 
                                        <select name="prereqID[]" class="form-control add-prereq-multi-4th-1st" id="select-multiple-add-4th-1st" style="width: 100%;" multiple required>
                                        <?php
                                            $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                            if(mysqli_num_rows($getsub) > 0)
                                            {
                                                foreach($getsub as $datas)
                                                {   
                                        ?>
                                            <option value="<?php echo $datas['id']; ?>"><?php echo $datas['description']; ?></option>
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
                                    <div>Hold <span class="text-danger">CTRL</span> to multiple selection</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="add_prereq_sub" class="btn btn-success">Yes</button>
                                </div>                     
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF Add 4th subject 1st Prerequisite MODAL-->

    <!-- EDIT 4th subject 1prereq 1st sem Prerequisite MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="editprereqFourthSubject11stModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <div class="modal-body">
                                <input type="hidden" name="idprereq" id="prereq4th11stid">
                                    <div class="form-group">
                                        <label for="prereq">Prerequisites</label>                 
                                        <select name="prereq" class="form-control" id="prereq" required>
                                            <option value="0">Select Prerequisite</option>
                                        <?php
                                            $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                            if(mysqli_num_rows($getsub) > 0)
                                            {
                                                foreach($getsub as $datas)
                                                {   
                                        ?>
                                            <option value="<?php echo $datas['id']; ?>"><?php echo $datas['description']; ?></option>
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
                                    <div>Single Prerequisite Only</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="edit_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF edit 4th subject 1prereq 1st sem Prerequisite MODAL-->

    <!-- EDIT 4th subject 2prereq 1st sem Prerequisite MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="editprereqFourthSubject21stModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="idprereq" id="prereq4th21stid">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="prereq">Prerequisites</label>                 
                                        <select name="prereq" class="form-control" id="prereq" required>
                                            <option value="0">Select Prerequisite</option>
                                        <?php
                                            $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                            if(mysqli_num_rows($getsub) > 0)
                                            {
                                                foreach($getsub as $datas)
                                                {   
                                        ?>
                                            <option value="<?php echo $datas['id']; ?>"><?php echo $datas['description']; ?></option>
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
                                    <div>Single Prerequisite Only</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="edit_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF edit 4th subject 2prereq 1st sem Prerequisite MODAL-->
<!-- for Prereq 4th subject 1st -->

<!-- for Prereq 4th subject 2nd -->
    <!-- DELETE Subject 4th 1st prereq MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteSubject4th12ndPreqModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="id" id="prereqfourthsub12ndid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Prerequisite?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF DELETE Subject 4th 1st prereq MODAL-->

    <!-- DELETE Subject 4th 2nd prereq MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteSubject4th22ndPreqModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="id" id="prereqfourthsub22ndid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Prerequisite?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF DELETE Subject 4th 2nd prereq MODAL-->

    <!-- Add 4th subject 2nd Prerequisite MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="addprereqFourth2ndModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog" style="max-width: 720px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Prerequisite</h5></h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                                <div class="modal-body">
                        <form action="managedata.php" method="POST">
                                    <input type="hidden" name="idprereq" id="addprereq4th2ndid">
                                    <div class="form-group">
                                        <label for="select-multiple-add">Prerequisites</label>                 
                                        <select name="prereqID[]" class="form-control add-prereq-multi-4th-2nd" id="select-multiple-add" style="width: 100%;" multiple required>
                                        <?php
                                            $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                            if(mysqli_num_rows($getsub) > 0)
                                            {
                                                foreach($getsub as $datas)
                                                {   
                                        ?>
                                            <option value="<?php echo $datas['id']; ?>"><?php echo $datas['description']; ?></option>
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
                                    <div>Hold <span class="text-danger">CTRL</span> to multiple selection</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="add_prereq_sub" class="btn btn-success">Yes</button>
                                </div>                     
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF Add 4th subject 2nd Prerequisite MODAL-->

    <!-- EDIT 4th subject 1prereq 2nd sem Prerequisite MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="editprereqFourthSubject12ndModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <div class="modal-body">
                                <input type="hidden" name="idprereq" id="prereq4th12ndid">
                                    <div class="form-group">
                                        <label for="prereq">Prerequisites</label>                 
                                        <select name="prereq" class="form-control" id="prereq" required>
                                            <option value="0">Select Prerequisite</option>
                                        <?php
                                            $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                            if(mysqli_num_rows($getsub) > 0)
                                            {
                                                foreach($getsub as $datas)
                                                {   
                                        ?>
                                            <option value="<?php echo $datas['id']; ?>"><?php echo $datas['description']; ?></option>
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
                                    <div>Single Prerequisite Only</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="edit_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF edit 4th subject 1prereq 2nd sem Prerequisite MODAL-->

    <!-- EDIT 4th subject 2prereq 2nd sem Prerequisite MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="editprereqFourthSubject22ndModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="idprereq" id="prereq4th22ndid">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="prereq">Prerequisites</label>                 
                                        <select name="prereq" class="form-control" id="prereq" required>
                                            <option value="0">Select Prerequisite</option>
                                        <?php
                                            $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                            if(mysqli_num_rows($getsub) > 0)
                                            {
                                                foreach($getsub as $datas)
                                                {   
                                        ?>
                                            <option value="<?php echo $datas['id']; ?>"><?php echo $datas['description']; ?></option>
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
                                    <div>Single Prerequisite Only</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="edit_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF edit 4th subject 2prereq 2nd sem Prerequisite MODAL-->
<!-- for Prereq 4th subject 2nd -->

<!-- for Prereq 4th subject summer -->
    <!-- DELETE Subject 4th summer prereq MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteSubject4th1summerPreqModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="id" id="prereqfourthsub1summerid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Prerequisite?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF DELETE Subject 4th summer prereq MODAL-->

    <!-- DELETE Subject 4th summer prereq MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteSubject4th2summerPreqModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="id" id="prereqfourthsub2summerid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Prerequisite?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF DELETE Subject 4th summer prereq MODAL-->

    <!-- Add 4th subject 2nd Prerequisite MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="addprereqFourthsummerModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog" style="max-width: 720px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Prerequisite</h5></h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                                <div class="modal-body">
                        <form action="managedata.php" method="POST">
                                    <input type="hidden" name="idprereq" id="addprereq4thsummerid">
                                    <div class="form-group">
                                        <label for="select-multiple-add-4-summer">Prerequisites</label>                 
                                        <select name="prereqID[]" class="form-control add-prereq-multi-4th-summer" id="select-multiple-add-4-summer" style="width: 100%;" multiple required>
                                        <?php
                                            $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                            if(mysqli_num_rows($getsub) > 0)
                                            {
                                                foreach($getsub as $datas)
                                                {   
                                        ?>
                                            <option value="<?php echo $datas['id']; ?>"><?php echo $datas['description']; ?></option>
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
                                    <div>Hold <span class="text-danger">CTRL</span> to multiple selection</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="add_prereq_sub" class="btn btn-success">Yes</button>
                                </div>                     
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF Add 4th subject summer Prerequisite MODAL-->

    <!-- EDIT 4th subject 1prereq summer sem Prerequisite MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="editprereqFourthSubject1summerModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <div class="modal-body">
                                <input type="hidden" name="idprereq" id="prereq4th1summerid">
                                    <div class="form-group">
                                        <label for="prereq">Prerequisites</label>                 
                                        <select name="prereq" class="form-control" id="prereq" required>
                                            <option value="0">Select Prerequisite</option>
                                        <?php
                                            $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                            if(mysqli_num_rows($getsub) > 0)
                                            {
                                                foreach($getsub as $datas)
                                                {   
                                        ?>
                                            <option value="<?php echo $datas['id']; ?>"><?php echo $datas['description']; ?></option>
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
                                    <div>Single Prerequisite Only</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="edit_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF edit 4th subject 1prereq summer sem Prerequisite MODAL-->

    <!-- EDIT 4th subject 2prereq summer sem Prerequisite MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="editprereqFourthSubject2summerModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="idprereq" id="prereq4th2summerid">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="prereq">Prerequisites</label>                 
                                        <select name="prereq" class="form-control" id="prereq" required>
                                            <option value="0">Select Prerequisite</option>
                                        <?php
                                            $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                            if(mysqli_num_rows($getsub) > 0)
                                            {
                                                foreach($getsub as $datas)
                                                {   
                                        ?>
                                            <option value="<?php echo $datas['id']; ?>"><?php echo $datas['description']; ?></option>
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
                                    <div>Single Prerequisite Only</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="edit_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF edit 4th subject 2prereq summer sem Prerequisite MODAL-->
<!-- for Prereq 4th subject summer -->
<!-- End Of Fourth Year List -->

<!-- Fifth Year List -->
    <!-- Edit Subjects 5th year 1st sem-->
    <div class="modal fade" id="editFifthSubjectModal" tabindex="-1" role="dialog" aria-labelledby="editsubjectModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Subject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body mt-3">
                <form action="managedata.php" method="POST">
                    <input type="hidden" name="subject_id" id="5th_subject_1st_id">
                    <input type="hidden" name="courseid" value="<?php echo $curr_courseid?>">
                    <div class="form-group">
                        <label>Curriculum</label>
                        <input type="text" name="curr_code" id="cur_5th_sub_1st" value="<?php echo $curr_code?>" class="form-control text-center"  readonly>
                    </div>
                    
                    <div class="form-group">
                        <label>Year Level</label>
                        <select name="yearlevel" id="year_5th_sub_1st" class="form-control text-center" required>
                                <option value="">Select Year Level...</option>
                                <option value="1">1st</option>
                                <option value="2">2nd</option>
                                <option value="3">3rd</option>
                                <option value="4">4th</option>
                                <option value="5">5th</option>
                        </select>
                    </div> 

                    <div class="form-group">
                        <label>Semester</label>
                        <select  name="semester" id="sem_5th_sub_1st" class="form-control text-center" required>
                                <option value="">Select Semester...</option>
                                <option value="1st">1st Semester</option>
                                <option value="2nd">2nd Semester</option>
                                <option value="summer">Summer</option>
                        </select>
                    </div> 

                    <div class="form-group">
                        <label>Subject Code</label>
                        <input type="text" name="subjectcode" id="subcode_5th_sub_1st" class="form-control text-center" placeholder="Enter Subject Code"required>
                    </div>  
                    <div class="form-group">
                        <label>Description</label>
                        <textarea columns="2" type="text" name="description" id="des_5th_sub_1st" class="form-control text-center" placeholder="Enter Subject Description"required></textarea>
                    </div>  
                    <div class="form-group">
                        <label>Units</label>
                        <div class="row">
                            <div class="col">
                                <input  type="text" name="lec" id="lec_5th_sub_1st" class="form-control text-center" placeholder="Enter Lec Units" >
                                <span class="text-secondary"><center>Lec</center></span>
                            </div>
                            <div class="col">
                                <input  type="text" name="lab" id="lab_5th_sub_1st" class="form-control text-center" placeholder="Enter Lab Units" >
                                <span class="text-secondary"><center>Lab</center></span>
                            </div>
                            <div class="col">
                                <input  type="text" name="units" id="units_5th_sub_1st" class="form-control text-center" placeholder="Enter Lab Units" >
                                <span class="text-secondary"><center>Units</center></span>
                            </div>
                        </div>
                    </div>  
                    <!--
                    <div class="form-group">
                        <label>Prerequisites</label>
                        <select name="prereq[]" id="pre_5th_sub_1st" class="form-control multiple-data-5-1st" multiple style="width: 20rem;">
                            <?php
                                $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                if(mysqli_num_rows($getsub) > 0)
                                {
                                    foreach($getsub as $datas)
                                    {   
                            ?>
                                <option value="<?php echo $datas['subject_code']; ?>"><?php echo $datas['subject_code']; ?></option>
                            <?php
                                    }
                                }
                            else
                                {
                                    echo "No Records Found!!";
                                }
                            ?>          
                        </select>
                        <input type="hidden" name="subid" value="<?php echo $getsubid ?>">
                    </div> 
                    <div>Hold <span class="text-danger">CTRL</span> to multiple selection</div> -->
                </div>
                    
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="edit_5th_year_subject_1st" class="btn btn-primary">Save</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- Edit 5th Subjects 1st sem -->

    <!-- Edit Subjects 5th year 2nd sem-->
    <div class="modal fade" id="editFifthSubject2ndModal" tabindex="-1" role="dialog" aria-labelledby="editsubjectModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Subject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body mt-3">
                <form action="managedata.php" method="POST">
                    <input type="hidden" name="subject_id" id="5th_subject_2nd_id">
                    <input type="hidden" name="courseid" value="<?php echo $curr_courseid?>">
                    <div class="form-group">
                        <label>Curriculum</label>
                        <input type="text" name="curr_code" id="cur_5th_sub_2nd" value="<?php echo $curr_code?>" class="form-control text-center"  readonly>
                    </div>
                    
                    <div class="form-group">
                        <label>Year Level</label>
                        <select name="yearlevel" id="year_5th_sub_2nd" class="form-control text-center" required>
                                <option value="">Select Year Level...</option>
                                <option value="1">1st</option>
                                <option value="2">2nd</option>
                                <option value="3">3rd</option>
                                <option value="4">4th</option>
                                <option value="5">5th</option>
                        </select>
                    </div> 

                    <div class="form-group">
                        <label>Semester</label>
                        <select  name="semester" id="sem_5th_sub_2nd" class="form-control text-center" required>
                                <option value="0">Select Semester...</option>
                                <option value="1st">1st Semester</option>
                                <option value="2nd">2nd Semester</option>
                                <option value="summer">Summer</option>
                        </select>
                    </div> 

                    <div class="form-group">
                        <label>Subject Code</label>
                        <input type="text" name="subjectcode" id="subcode_5th_sub_2nd" class="form-control text-center" placeholder="Enter Subject Code"required>
                    </div>  
                    <div class="form-group">
                        <label>Description</label>
                        <textarea columns="2" type="text" name="description" id="des_5th_sub_2nd" class="form-control text-center" placeholder="Enter Subject Description"required></textarea>
                    </div>  
                    <div class="form-group">
                        <label>Units</label>
                        <div class="row">
                            <div class="col">
                                <input  type="text" name="lec" id="lec_5th_sub_2nd" class="form-control text-center" placeholder="Enter Lec Units" >
                                <span class="text-secondary"><center>Lec</center></span>
                            </div>
                            <div class="col">
                                <input  type="text" name="lab" id="lab_5th_sub_2nd" class="form-control text-center" placeholder="Enter Lab Units" >
                                <span class="text-secondary"><center>Lab</center></span>
                            </div>
                            <div class="col">
                                <input  type="text" name="units" id="units_5th_sub_2nd" class="form-control text-center" placeholder="Enter Lab Units" >
                                <span class="text-secondary"><center>Units</center></span>
                            </div>
                        </div>
                    </div>  
                    <!--
                    <div class="form-group">
                        <label>Prerequisites</label>
                        <select name="prereq[]" id="pre_5th_sub_2nd" class="form-control multiple-data-5-2nd" multiple style="width: 20rem;">
                            <?php
                                $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                if(mysqli_num_rows($getsub) > 0)
                                {
                                    foreach($getsub as $datas)
                                    {   
                            ?>
                                <option value="<?php echo $datas['subject_code']; ?>"><?php echo $datas['subject_code']; ?></option>
                            <?php
                                    }
                                }
                            else
                                {
                                    echo "No Records Found!!";
                                }
                            ?>          
                        </select>
                        <input type="hidden" name="subid" value="<?php echo $getsubid ?>">
                    </div> 
                    <div>Hold <span class="text-danger">CTRL</span> to multiple selection</div> -->
                </div>
                    
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="edit_5th_year_subject_2nd" class="btn btn-primary">Save</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- Edit 5th Subjects 2nd sem -->

    <!-- Edit Subjects 5th year summer sem-->
    <div class="modal fade" id="editFifthSubjectsummerModal" tabindex="-1" role="dialog" aria-labelledby="editsubjectModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Subject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body mt-3">
                <form action="managedata.php" method="POST">
                    <input type="hidden" name="subject_id" id="5th_subject_summer_id">
                    <input type="hidden" name="courseid" value="<?php echo $curr_courseid?>">
                    <div class="form-group">
                        <label>Curriculum</label>
                        <input type="text" name="curr_code" id="cur_5th_sub_summer" value="<?php echo $curr_code?>" class="form-control text-center"  readonly>
                    </div>
                    
                    <div class="form-group">
                        <label>Year Level</label>
                        <select name="yearlevel" id="year_5th_sub_summer" class="form-control text-center" required>
                                <option value="">Select Year Level...</option>
                                <option value="1">1st</option>
                                <option value="2">2nd</option>
                                <option value="3">3rd</option>
                                <option value="4">4th</option>
                                <option value="5">5th</option>
                        </select>
                    </div> 

                    <div class="form-group">
                        <label>Semester</label>
                        <select  name="semester" id="sem_5th_sub_summer" class="form-control text-center" required>
                                <option value="0">Select Semester...</option>
                                <option value="1st">1st Semester</option>
                                <option value="2nd">2nd Semester</option>
                                <option value="summer">Summer</option>
                        </select>
                    </div> 

                    <div class="form-group">
                        <label>Subject Code</label>
                        <input type="text" name="subjectcode" id="subcode_5th_sub_summer" class="form-control text-center" placeholder="Enter Subject Code"required>
                    </div>  
                    <div class="form-group">
                        <label>Description</label>
                        <textarea columns="2" type="text" name="description" id="des_5th_sub_summer" class="form-control text-center" placeholder="Enter Subject Description"required></textarea>
                    </div>  
                    <div class="form-group">
                        <label>Units</label>
                        <div class="row">
                            <div class="col">
                                <input  type="text" name="lec" id="lec_5th_sub_summer" class="form-control text-center" placeholder="Enter Lec Units" >
                                <span class="text-secondary"><center>Lec</center></span>
                            </div>
                            <div class="col">
                                <input  type="text" name="lab" id="lab_5th_sub_summer" class="form-control text-center" placeholder="Enter Lab Units" >
                                <span class="text-secondary"><center>Lab</center></span>
                            </div>
                            <div class="col">
                                <input  type="text" name="units" id="units_5th_sub_summer" class="form-control text-center" placeholder="Enter Lab Units" >
                                <span class="text-secondary"><center>Units</center></span>
                            </div>
                        </div>
                    </div>  
                    <!--
                    <div class="form-group">
                        <label>Prerequisites</label>
                        <select name="prereq[]" id="pre_5th_sub_2nd" class="form-control multiple-data-5-2nd" multiple style="width: 20rem;">
                            <?php
                                $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                if(mysqli_num_rows($getsub) > 0)
                                {
                                    foreach($getsub as $datas)
                                    {   
                            ?>
                                <option value="<?php echo $datas['subject_code']; ?>"><?php echo $datas['subject_code']; ?></option>
                            <?php
                                    }
                                }
                            else
                                {
                                    echo "No Records Found!!";
                                }
                            ?>          
                        </select>
                        <input type="hidden" name="subid" value="<?php echo $getsubid ?>">
                    </div> 
                    <div>Hold <span class="text-danger">CTRL</span> to multiple selection</div> -->
                </div>
                    
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="edit_5th_year_subject_2nd" class="btn btn-primary">Save</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- Edit 5th Subjects summer sem -->

    <!-- DELETE 5th subject 1st MODAL-->
        <div class="container container-fluid">
            <div class="modal fade" id="deleteFifthSubjectModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Subject</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="id" id="delete5thsubject1stid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Subject?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_5th_subject_1st" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!--END OF DELETE 5th subject 1st MODAL-->

    <!-- DELETE 5th subject 2nd MODAL-->
        <div class="container container-fluid">
            <div class="modal fade" id="deleteFifthSubject2ndModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Subject</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="id" id="delete5thsubject2ndid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Subject?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_5th_subject_2nd" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!--END OF DELETE 5th subject 2nd MODAL-->

    <!-- DELETE 5th subject summer MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteFifthSubjectsummerModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Subject</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="id" id="delete5thsubjectsummerid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Subject?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_5th_subject_2nd" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                </div>
            </div>
        </div>
    </div>
    <!--END OF DELETE 5th subject summer MODAL-->

<!-- for Prereq 5th subject 1st -->
    <!-- DELETE Subject 5th 1st 1 prereq MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteSubject5th11stPreqModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="id" id="prereqfifthsub11stid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Prerequisite?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF DELETE Subject 5th 1st 1 prereq MODAL-->

    <!-- DELETE Subject 5th 1st 2 prereq MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteSubject5th21stPreqModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="id" id="prereqfifthsub21stid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Prerequisite?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF DELETE Subject 5th 1st 2 prereq MODAL-->

    <!-- Add 5th subject 1st Prerequisite MODAL-->
    <div class="container container-fluid">
            <div class="modal fade" id="addprereqFifth11stModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
                <div class="modal-dialog" style="max-width: 720px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Prerequisite</h5></h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                                <div class="modal-body">
                        <form action="managedata.php" method="POST">
                                    <input type="hidden" name="idprereq" id="addprereq5th11stid">
                                    <div class="form-group">
                                        <label for="select-multiple-add-5th-1st">Prerequisites</label>                 
                                        <select name="prereqID[]" class="form-control add-prereq-multi-1st" id="select-multiple-add-5th-1st" style="width: 100%;" multiple required>
                                        <?php
                                            $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                            if(mysqli_num_rows($getsub) > 0)
                                            {
                                                foreach($getsub as $datas)
                                                {   
                                        ?>
                                            <option value="<?php echo $datas['id']; ?>"><?php echo $datas['description']; ?></option>
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
                                    <div>Hold <span class="text-danger">CTRL</span> to multiple selection</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="add_prereq_sub" class="btn btn-success">Yes</button>
                                </div>                     
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF Add 5th subject 1st Prerequisite MODAL-->

    <!-- EDIT 5th subject 1prereq 1st sem Prerequisite MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="editprereqFifthSubject11stModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <div class="modal-body">
                                <input type="text" name="idprereq" id="prereq5th11stid">
                                    <div class="form-group">
                                        <label for="prereq">Prerequisites</label>                 
                                        <select name="prereq" class="form-control" id="prereq" required>
                                            <option value="0">Select Prerequisite</option>
                                        <?php
                                            $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                            if(mysqli_num_rows($getsub) > 0)
                                            {
                                                foreach($getsub as $datas)
                                                {   
                                        ?>
                                            <option value="<?php echo $datas['id']; ?>"><?php echo $datas['description']; ?></option>
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
                                    <div>Single Prerequisite Only</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="edit_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF edit 5th subject 1prereq 1st sem Prerequisite MODAL-->

    <!-- EDIT 5th subject 2prereq 1st sem Prerequisite MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="editprereqFifthSubject21stModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="idprereq" id="prereq5th21stid">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="prereq">Prerequisites</label>                 
                                        <select name="prereq" class="form-control" id="prereq" required>
                                            <option value="0">Select Prerequisite</option>
                                        <?php
                                            $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                            if(mysqli_num_rows($getsub) > 0)
                                            {
                                                foreach($getsub as $datas)
                                                {   
                                        ?>
                                            <option value="<?php echo $datas['id']; ?>"><?php echo $datas['description']; ?></option>
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
                                    <div>Single Prerequisite Only</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="edit_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF edit 5th subject 2prereq 1st sem Prerequisite MODAL-->
<!-- for Prereq 5th subject 1st -->

<!-- for Prereq 5th subject 2nd -->
    <!-- DELETE Subject 5th 1st prereq MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteSubject5th1stPreqModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="id" id="prereqfifthsub1stid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Prerequisite?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF DELETE Subject 5th 1st prereq MODAL-->

    <!-- DELETE Subject 5th 2nd prereq MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteSubject5th2ndPreqModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="id" id="prereqfifthsub2ndid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Prerequisite?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF DELETE Subject 5th 2nd prereq MODAL-->

    <!-- Add 5th subject 2nd Prerequisite MODAL-->
    <div class="container container-fluid">
            <div class="modal fade" id="addprereqFifth2ndModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
                <div class="modal-dialog" style="max-width: 720px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Prerequisite</h5></h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                                <div class="modal-body">
                        <form action="managedata.php" method="POST">
                                    <input type="hidden" name="idprereq" id="addprereq5th2ndid">
                                    <div class="form-group">
                                        <label for="select-multiple-add">Prerequisites</label>                 
                                        <select name="prereqID[]" class="form-control add-prereq-multi-2nd" id="select-multiple-add" style="width: 100%;" multiple required>
                                        <?php
                                            $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                            if(mysqli_num_rows($getsub) > 0)
                                            {
                                                foreach($getsub as $datas)
                                                {   
                                        ?>
                                            <option value="<?php echo $datas['id']; ?>"><?php echo $datas['description']; ?></option>
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
                                    <div>Hold <span class="text-danger">CTRL</span> to multiple selection</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="add_prereq_sub" class="btn btn-success">Yes</button>
                                </div>                     
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF Add 5th subject 2nd Prerequisite MODAL-->

    <!-- EDIT 5th subject 1prereq 2nd sem Prerequisite MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="editprereqFifthSubject12ndModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <div class="modal-body">
                                <input type="hidden" name="idprereq" id="prereq5th1stid">
                                    <div class="form-group">
                                        <label for="prereq">Prerequisites</label>                 
                                        <select name="prereq" class="form-control" id="prereq" required>
                                            <option value="0">Select Prerequisite</option>
                                        <?php
                                            $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                            if(mysqli_num_rows($getsub) > 0)
                                            {
                                                foreach($getsub as $datas)
                                                {   
                                        ?>
                                            <option value="<?php echo $datas['id']; ?>"><?php echo $datas['description']; ?></option>
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
                                    <div>Single Prerequisite Only</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="edit_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF edit 5th subject 1prereq 2nd sem Prerequisite MODAL-->

    <!-- EDIT 5th subject 2prereq 2nd sem Prerequisite MODAL-->
    <div class="container container-fluid">
            <div class="modal fade" id="editprereqFifthSubject22ndModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="idprereq" id="prereq5th2ndid">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="prereq">Prerequisites</label>                 
                                        <select name="prereq" class="form-control" id="prereq" required>
                                            <option value="0">Select Prerequisite</option>
                                        <?php
                                            $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                            if(mysqli_num_rows($getsub) > 0)
                                            {
                                                foreach($getsub as $datas)
                                                {   
                                        ?>
                                            <option value="<?php echo $datas['id']; ?>"><?php echo $datas['description']; ?></option>
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
                                    <div>Single Prerequisite Only</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="edit_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF edit 5th subject 2prereq 2nd sem Prerequisite MODAL-->
<!-- for Prereq 5th subject 2nd -->

<!-- for Prereq 5th subject summer -->
    <!-- DELETE Subject 5th summer prereq MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteSubject5th1summerPreqModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="id" id="prereqfifthsub1summerid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Prerequisite?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF DELETE Subject 5th 1st prereq MODAL-->

    <!-- DELETE Subject 5th summer prereq MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteSubject5th2summerPreqModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="id" id="prereqfifthsub2summerid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Prerequisite?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF DELETE Subject 5th summer prereq MODAL-->

    <!-- Add 5th subject summer Prerequisite MODAL-->
    <div class="container container-fluid">
            <div class="modal fade" id="addprereqFifthsummerModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
                <div class="modal-dialog" style="max-width: 720px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Prerequisite</h5></h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                                <div class="modal-body">
                        <form action="managedata.php" method="POST">
                                    <input type="hidden" name="idprereq" id="addprereq5thsummerid">
                                    <div class="form-group">
                                        <label for="select-multiple-add">Prerequisites</label>                 
                                        <select name="prereqID[]" class="form-control add-prereq-multi-2nd" id="select-multiple-add" style="width: 100%;" multiple required>
                                        <?php
                                            $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                            if(mysqli_num_rows($getsub) > 0)
                                            {
                                                foreach($getsub as $datas)
                                                {   
                                        ?>
                                            <option value="<?php echo $datas['id']; ?>"><?php echo $datas['description']; ?></option>
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
                                    <div>Hold <span class="text-danger">CTRL</span> to multiple selection</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="add_prereq_sub" class="btn btn-success">Yes</button>
                                </div>                     
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF Add 5th subject 2nd Prerequisite MODAL-->

    <!-- EDIT 5th subject 1prereq 1st sem Prerequisite MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="editprereqFifthSubject1summerModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <div class="modal-body">
                                <input type="hidden" name="idprereq" id="prereq5th1summerid">
                                    <div class="form-group">
                                        <label for="prereq">Prerequisites</label>                 
                                        <select name="prereq" class="form-control" id="prereq" required>
                                            <option value="0">Select Prerequisite</option>
                                        <?php
                                            $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                            if(mysqli_num_rows($getsub) > 0)
                                            {
                                                foreach($getsub as $datas)
                                                {   
                                        ?>
                                            <option value="<?php echo $datas['id']; ?>"><?php echo $datas['description']; ?></option>
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
                                    <div>Single Prerequisite Only</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="edit_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF edit 5th subject 1prereq summer sem Prerequisite MODAL-->

    <!-- EDIT 5th subject 2prereq 1st summer Prerequisite MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="editprereqFifthSubject2summerModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Prerequisite</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="idprereq" id="prereq5th2summerid">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="prereq">Prerequisites</label>                 
                                        <select name="prereq" class="form-control" id="prereq" required>
                                            <option value="0">Select Prerequisite</option>
                                        <?php
                                            $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$id' and course_id_fk='$curr_courseid'");
                                            if(mysqli_num_rows($getsub) > 0)
                                            {
                                                foreach($getsub as $datas)
                                                {   
                                        ?>
                                            <option value="<?php echo $datas['id']; ?>"><?php echo $datas['description']; ?></option>
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
                                    <div>Single Prerequisite Only</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="edit_prereq" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF edit 5th subject 2prereq summer sem Prerequisite MODAL-->
<!-- for Prereq 5th subject summer -->
<!-- End Of Fifth Year List -->


        <!-- REQUEST POPUP -->
        <div class="container container-fluid">
			<div class="modal fade" id="manage-request" tabindex="-1" aria-labelledby="manage-requestLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-scrollable" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title fw-bold" id="manage-requestLabel">Adviser Account Request</h5>
							<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
						</div>
					<?php
						$get_req_adviser = mysqli_query($connection,"SELECT * FROM tblrequest_account WHERE id='$req_adviser_id'");
						while($sa=mysqli_fetch_array($get_req_adviser))
						{
							$adviser_id = $sa['id'];
							$adviser_first = $sa['firstname'];
							$adviser_last = $sa['lastname'];
							$adviser_email = $sa['email'];
							$adviser_password = $sa['password'];
							$adviser_type = $sa['req_usertype'];
							$adviser_contact = $sa['contact'];
							$adviser_colid = $sa['college_id_fk'];
							$adviser_courseid = $sa['course_id_fk'];

							$select_course = mysqli_query($connection,"SELECT * FROM tblcourse WHERE id='$adviser_courseid'");
							while($co=mysqli_fetch_array($select_course))
							{
								$Course = $co['course'];
							}
						}
					?>
						<div class="modal-body">
							<!-- Inputs -->
							<form action="managedata.php" method="POST">
								<input type="hidden" name="adviser_id" value="<?php echo $adviser_id ?>">
								<div class="mb-3">
									<label for="input-name" class="form-label">Full Name</label>
									<input type="text" class="form-control text-center" id="input-name" aria-describedby="input-name-help" value="<?php echo ucfirst($adviser_first).' '.ucfirst($adviser_last)?>" readonly>
									<!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
								</div>

								<div class="mb-3">
									<label for="input-email" class="form-label">Email</label>
									<input type="email" class="form-control text-center" id="input-email" value="<?php echo $adviser_email ?>" readonly>
								</div>

								<div class="mb-3">
									<label for="input-advised" class="form-label">Course</label>
									<input type="text" class="form-control text-center" id="input-advised" value="<?php echo $Course ?>" readonly>
								</div>
							</div>
	
							<div class="modal-footer" align="right">
								<button type="submit" name="disapproved_request" class="btn btn-danger">Disapproved</button>
								<button type="submit" name="approved_request" class="btn btn-success">Approve</button>
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
        $(".multiple-data-1").select2({
            //maximumSelectionLength: 2
        });

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

            $('#table1').DataTable();
            $('#table12nd').DataTable();
            $('#table1summer').DataTable();

            $(".multiple-data-1-1st-edit").select2({
                //maximumSelectionLength: 2
            });

            $(".multiple-data-1-2nd-edit").select2({
                //maximumSelectionLength: 2
            });

            $(".add-prereq-multi-1st-1st").select2({
                //maximumSelectionLength: 2
            });

            $(".add-prereq-multi-1st-2nd").select2({
                //maximumSelectionLength: 2
            });

            $(".add-prereq-multi-1st-summer").select2({
                //maximumSelectionLength: 2
            });

            $(document).ready(function() {
            $('body').on('click','.editFirstubject1stbtn',function() {
                $('#editFirstSubjectFirstModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#1st_subject_1st_id').val(data[0]);
                $('#subcode_1st_sub_1st').val(data[1]);
                $('#des_1st_sub_1st').val(data[2]);
                $('#lec_1st_sub_1st').val(data[3]);
                $('#lab_1st_sub_1st').val(data[4]);
                $('#units_1st_sub_1st').val(data[5]);
                $('#pre_1st_sub_1st').val(data[6]);
                $('#sem_1st_sub_1st').val(data[7]);
                $('#year_1st_sub_1st').val(data[8]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.editFirstSubject2ndbtn',function() {
                $('#editFirstSubjectSecondModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#1st_subject_2nd_id').val(data[0]);
                $('#subcode_1st_sub_2nd').val(data[1]);
                $('#des_1st_sub_2nd').val(data[2]);
                $('#lec_1st_sub_2nd').val(data[3]);
                $('#lab_1st_sub_2nd').val(data[4]);
                $('#units_1st_sub_2nd').val(data[5]);
                $('#pre_1st_sub_2nd').val(data[6]);
                $('#sem_1st_sub_2nd').val(data[7]);
                $('#year_1st_sub_2nd').val(data[8]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.editFirstubjectSummerbtn',function() {
                $('#editFirstSubjectSummerModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#1st_subject_summer_id').val(data[0]);
                $('#subcode_1st_sub_summer').val(data[1]);
                $('#des_1st_sub_summer').val(data[2]);
                $('#lec_1st_sub_summer').val(data[3]);
                $('#lab_1st_sub_summer').val(data[4]);
                $('#units_1st_sub_summer').val(data[5]);
                $('#pre_1st_sub_summer').val(data[6]);
                $('#sem_1st_sub_summer').val(data[7]);
                $('#year_1st_sub_summer').val(data[8]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.deleteFirstSubject1stbtn',function() {
                $('#deleteSubjectModal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#delete1stsubject1stid').val(data[0]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.deleteFirstSubject2ndbtn',function() {
                $('#delete1stSubject2ndModal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#delete1stsubject2ndid').val(data[0]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.deleteFirstSubjectSummerbtn',function() {
                $('#delete1stSubjectSummerModal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#delete1stsubjectsummerid').val(data[0]);
            });
            });

            // for prereq //
            $(document).ready(function() {
            $('body').on('click','.addfirstPrereq21stbtn',function() {
                $('#addprereqFirst11stModal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#addprereq1st11stid').val(data[0]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.addfirstPrereq22ndbtn',function() {
                $('#addprereqFirst2ndModal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#addprereq1st2ndid').val(data[0]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.addfirstPrereq2summerbtn',function() {
                $('#addprereqFirstSummerModal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#addprereq1stsummerid').val(data[0]);
            });
            });

            $(document).ready(function(){
                $(document).on('click', '.editSubject1st11stPreqModal', function(){
                    var id=$(this).val();
                    var prereq=$('#idprereq1st11st'+id).text();
            
                    $('#editprereqFirstSubject11stModal').modal('show');
                    $('#prereq1st11stid').val(prereq);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.editSubject1st21stPreqModal', function(){
                    var id=$(this).val();
                    var prereq=$('#idprereq1st21st'+id).text();
            
                    $('#editprereqFirstSubject21stModal').modal('show');
                    $('#prereq1st21stid').val(prereq);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.editSubject1st12ndPreqModal', function(){
                    var id=$(this).val();
                    var prereq=$('#idprereq1st12nd'+id).text();
            
                    $('#editprereqFirstSubject12ndModal').modal('show');
                    $('#prereq1st12ndid').val(prereq);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.editSubject1st22ndPreqModal', function(){
                    var id=$(this).val();
                    var prereq=$('#idprereq1st22nd'+id).text();
            
                    $('#editprereqFirstSubject22ndModal').modal('show');
                    $('#prereq1st22ndid').val(prereq);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.editSubject1st1summerPreqModal', function(){
                    var id=$(this).val();
                    var prereq=$('#idprereq1st1summer'+id).text();
            
                    $('#editprereqFirstSubject1summerModal').modal('show');
                    $('#prereq1st1summerid').val(prereq);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.editSubject1st2summerPreqModal', function(){
                    var id=$(this).val();
                    var prereq=$('#idprereq1st2summer'+id).text();
            
                    $('#editprereqFirstSubject2summerModal').modal('show');
                    $('#prereq1st2summerid').val(prereq);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.deleteprereqfirstSubject11stbtn', function(){
                    var id=$(this).val();
            
                    $('#deleteSubject1st11stPreqModal').modal('show');
                    $('#prereq1stsub11stid').val(id);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.deleteprereqfirstSubject21stbtn', function(){
                    var id=$(this).val();
            
                    $('#deleteSubject1st21stPreqModal').modal('show');
                    $('#prereq1stsub21stid').val(id);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.deleteprereqfirstSubject1summerbtn', function(){
                    var id=$(this).val();
            
                    $('#deleteSubject1st1SummerPreqModal').modal('show');
                    $('#prereq1stsub1summerid').val(id);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.deleteprereqfirstSubject2summerbtn', function(){
                    var id=$(this).val();
            
                    $('#deleteSubject1st2SummerPreqModal').modal('show');
                    $('#prereq1stsub2summerid').val(id);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.deleteprereqfirstSubject12ndbtn', function(){
                    var id=$(this).val();
            
                    $('#deleteSubject1st12ndPreqModal').modal('show');
                    $('#prereq1stsub12ndid').val(id);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.deleteprereqfirstSubject22ndbtn', function(){
                    var id=$(this).val();
            
                    $('#deleteSubject1st22ndPreqModal').modal('show');
                    $('#prereq1stsub22ndid').val(id);
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

            $('#table2').DataTable();
            $('#table22nd').DataTable();
            $('#table2summer').DataTable();

            $(".multiple-data").select2({
                //maximumSelectionLength: 2
            });

            $(".multiple-data-2nd-1st-edit").select2({
                //maximumSelectionLength: 2
            });

            $(".multiple-data-2nd-2nd-edit").select2({
                //maximumSelectionLength: 2
            });

            $(".add-prereq-multi-2nd-1st").select2({
                //maximumSelectionLength: 2
            });

            $(".add-prereq-multi-2nd-2nd").select2({
                //maximumSelectionLength: 2
            });

            $(".add-prereq-multi-2nd-summer").select2({
                //maximumSelectionLength: 2
            });

            $(document).ready(function() {
            $('body').on('click','.editSecondSubjectbtn',function() {
                $('#editSecondSubjectModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#2nd_subject_1st_id').val(data[0]);
                $('#subcode_2nd_sub_1st').val(data[1]);
                $('#des_2nd_sub_1st').val(data[2]);
                $('#lec_2nd_sub_1st').val(data[3]);
                $('#lab_2nd_sub_1st').val(data[4]);
                $('#units_2nd_sub_1st').val(data[5]);
                $('#pre_2nd_sub_1st').val(data[6]);
                $('#sem_2nd_sub_1st').val(data[7]);
                $('#year_2nd_sub_1st').val(data[8]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.editSecondSubject2ndbtn',function() {
                $('#editSecondSubject2ndModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#2nd_subject_2nd_id').val(data[0]);
                $('#subcode_2nd_sub_2nd').val(data[1]);
                $('#des_2nd_sub_2nd').val(data[2]);
                $('#lec_2nd_sub_2nd').val(data[3]);
                $('#lab_2nd_sub_2nd').val(data[4]);
                $('#units_2nd_sub_2nd').val(data[5]);
                $('#pre_2nd_sub_2nd').val(data[6]);
                $('#sem_2nd_sub_2nd').val(data[7]);
                $('#year_2nd_sub_2nd').val(data[8]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.editSecondSubjectsummerbtn',function() {
                $('#editSecondSubjectsummerModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#2nd_subject_summer_id').val(data[0]);
                $('#subcode_2nd_sub_summer').val(data[1]);
                $('#des_2nd_sub_summer').val(data[2]);
                $('#lec_2nd_sub_summer').val(data[3]);
                $('#lab_2nd_sub_summer').val(data[4]);
                $('#units_2nd_sub_summer').val(data[5]);
                $('#pre_2nd_sub_summer').val(data[6]);
                $('#sem_2nd_sub_summer').val(data[7]);
                $('#year_2nd_sub_summer').val(data[8]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.deleteSecondSubjectbtn',function() {
                $('#deleteSecondSubjectModal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#delete2ndsubject1stid').val(data[0]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.deleteSecondSubject2ndbtn',function() {
                $('#deleteSecondSubject2ndModal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#delete2ndsubject2ndid').val(data[0]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.deleteSecondSubjectsummerbtn',function() {
                $('#deleteSecondSubjectsummerModal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#delete2ndsubjectsummerid').val(data[0]);
            });
            });

            // for prereq //
            $(document).ready(function() {
            $('body').on('click','.addsecondPrereq21stbtn',function() {
                $('#addprereqSecond11stModal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#addprereq2nd11stid').val(data[0]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.addsecondPrereq22ndbtn',function() {
                $('#addprereqSecond2ndModal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#addprereq2nd2ndid').val(data[0]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.addsecondPrereq2summerbtn',function() {
                $('#addprereqSecondsummerModal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#addprereq2ndsummerid').val(data[0]);
            });
            });

            $(document).ready(function(){
                $(document).on('click', '.editSubject2nd11stPreqModal', function(){
                    var id=$(this).val();
                    var prereq=$('#idprereq2nd11st'+id).text();
            
                    $('#editprereqSecondSubject11stModal').modal('show');
                    $('#prereq2nd11stid').val(prereq);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.editSubject2nd21stPreqModal', function(){
                    var id=$(this).val();
                    var prereq=$('#idprereq2nd21st'+id).text();
            
                    $('#editprereqSecondSubject21stModal').modal('show');
                    $('#prereq2nd21stid').val(prereq);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.editSubject2nd12ndPreqModal', function(){
                    var id=$(this).val();
                    var prereq=$('#idprereq2nd12nd'+id).text();
            
                    $('#editprereqSecondSubject12ndModal').modal('show');
                    $('#prereq2nd12ndid').val(prereq);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.editSubject2nd22ndPreqModal', function(){
                    var id=$(this).val();
                    var prereq=$('#idprereq2nd22nd'+id).text();
            
                    $('#editprereqSecondSubject22ndModal').modal('show');
                    $('#prereq2nd22ndid').val(prereq);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.editSubject2nd1summerPreqModal', function(){
                    var id=$(this).val();
                    var prereq=$('#idprereq2nd1summer'+id).text();
            
                    $('#editprereqSecondSubject1summerModal').modal('show');
                    $('#prereq2nd1summerid').val(prereq);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.editSubject2nd2summerPreqModal', function(){
                    var id=$(this).val();
                    var prereq=$('#idprereq2nd2summer'+id).text();
            
                    $('#editprereqSecondSubject2summerModal').modal('show');
                    $('#prereq2nd2summerid').val(prereq);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.deleteprereqsecondSubject11stbtn', function(){
                    var id=$(this).val();
            
                    $('#deleteSubject2nd11stPreqModal').modal('show');
                    $('#prereq2ndsub11stid').val(id);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.deleteprereqsecondSubject21stbtn', function(){
                    var id=$(this).val();
            
                    $('#deleteSubject2nd21stPreqModal').modal('show');
                    $('#prereq2ndsub21stid').val(id);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.deleteprereqsecondSubject12ndbtn', function(){
                    var id=$(this).val();
            
                    $('#deleteSubject2nd12ndPreqModal').modal('show');
                    $('#prereq2ndsub12ndid').val(id);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.deleteprereqsecondSubject22ndbtn', function(){
                    var id=$(this).val();
            
                    $('#deleteSubject2nd22ndPreqModal').modal('show');
                    $('#prereq2ndsub22ndid').val(id);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.deleteprereqsecondSubject1summerbtn', function(){
                    var id=$(this).val();
            
                    $('#deleteSubject2nd1summerPreqModal').modal('show');
                    $('#prereq2ndsub1summerid').val(id);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.deleteprereqsecondSubject2summerbtn', function(){
                    var id=$(this).val();
            
                    $('#deleteSubject2nd2summerPreqModal').modal('show');
                    $('#prereq2ndsub2summerid').val(id);
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

            $('#table3').DataTable();
            $('#table32nd').DataTable();
            $('#table3summer').DataTable();

            $(".multiple-data-3").select2({
                //maximumSelectionLength: 2
            });

            $(".multiple-data-3-1st").select2({
                //maximumSelectionLength: 2
            });

            $(".multiple-data-3-2nd").select2({
                //maximumSelectionLength: 2
            });

            $(".add-prereq-multi-3rd-1st").select2({
                //maximumSelectionLength: 2
            });

            $(".add-prereq-multi-3rd-2nd").select2({
                //maximumSelectionLength: 2
            });

            $(".add-prereq-multi-3rd-summer").select2({
                //maximumSelectionLength: 2
            });

            $('#addThirdSubject').on('click', function() {
                $('#addThirdSubjectsmodal').modal('show');
            });

            $('#deleteAllThirdSubject').on('click', function() {
                $('#deleteAllThirdSubjectModal').modal('show');
            });

            $(document).ready(function() {
            $('body').on('click','.editThirdSubjectbtn',function() {
                $('#editThirdSubjectModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#3rd_subject_1st_id').val(data[0]);
                $('#subcode_3rd_sub_1st').val(data[1]);
                $('#des_3rd_sub_1st').val(data[2]);
                $('#lec_3rd_sub_1st').val(data[3]);
                $('#lab_3rd_sub_1st').val(data[4]);
                $('#units_3rd_sub_1st').val(data[5]);
                $('#pre_3rd_sub_1st').val(data[6]);
                $('#sem_3rd_sub_1st').val(data[7]);
                $('#year_3rd_sub_1st').val(data[8]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.editThirdSubject2ndbtn',function() {
                $('#editThirdSubject2ndModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#3rd_subject_2nd_id').val(data[0]);
                $('#subcode_3rd_sub_2nd').val(data[1]);
                $('#des_3rd_sub_2nd').val(data[2]);
                $('#lec_3rd_sub_2nd').val(data[3]);
                $('#lab_3rd_sub_2nd').val(data[4]);
                $('#units_3rd_sub_2nd').val(data[5]);
                $('#pre_3rd_sub_2nd').val(data[6]);
                $('#sem_3rd_sub_2nd').val(data[7]);
                $('#year_3rd_sub_2nd').val(data[8]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.editThirdSubjectsummerbtn',function() {
                $('#editThirdSubjectsummerModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#3rd_subject_summer_id').val(data[0]);
                $('#subcode_3rd_sub_summer').val(data[1]);
                $('#des_3rd_sub_summer').val(data[2]);
                $('#lec_3rd_sub_summer').val(data[3]);
                $('#lab_3rd_sub_summer').val(data[4]);
                $('#units_3rd_sub_summer').val(data[5]);
                $('#pre_3rd_sub_summer').val(data[6]);
                $('#sem_3rd_sub_summer').val(data[7]);
                $('#year_3rd_sub_summer').val(data[8]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.deleteThirdSubjectbtn',function() {
                $('#deleteThirdSubjectModal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#delete3rdsubject1stid').val(data[0]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.deleteThirdSubject2ndbtn',function() {
                $('#deleteThirdSubject2ndModal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#delete3rdsubject2ndid').val(data[0]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.deleteThirdSubjectsummerbtn',function() {
                $('#deleteThirdSubjectsummerModal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#delete3rdsubjectsummerid').val(data[0]);
            });
            });

            // for prereq //
            $(document).ready(function() {
            $('body').on('click','.addthirdPrereq21stbtn',function() {
                $('#addprereqThird11stModal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#addprereq3rd11stid').val(data[0]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.addthirdPrereq22ndbtn',function() {
                $('#addprereqThird2ndModal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#addprereq3rd2ndid').val(data[0]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.addthirdPrereq2summerbtn',function() {
                $('#addprereqThirdsummerModal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#addprereq3rdsummerid').val(data[0]);
            });
            });

            $(document).ready(function(){
                $(document).on('click', '.editSubject3rd11stPreqModal', function(){
                    var id=$(this).val();
                    var prereq=$('#idprereq3rd11st'+id).text();
            
                    $('#editprereqThirdSubject11stModal').modal('show');
                    $('#prereq3rd11stid').val(prereq);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.editSubject3rd21stPreqModal', function(){
                    var id=$(this).val();
                    var prereq=$('#idprereq3rd21st'+id).text();
            
                    $('#editprereqThirdSubject21stModal').modal('show');
                    $('#prereq3rd21stid').val(prereq);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.editSubject3rd12ndPreqModal', function(){
                    var id=$(this).val();
                    var prereq=$('#idprereq3rd12nd'+id).text();
            
                    $('#editprereqThirdSubject12ndModal').modal('show');
                    $('#prereq3rd12ndid').val(prereq);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.editSubject3rd22ndPreqModal', function(){
                    var id=$(this).val();
                    var prereq=$('#idprereq3rd22nd'+id).text();
            
                    $('#editprereqThirdSubject22ndModal').modal('show');
                    $('#prereq3rd22ndid').val(prereq);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.editSubject3rd1summerPreqModal', function(){
                    var id=$(this).val();
                    var prereq=$('#idprereq3rd1summer'+id).text();
            
                    $('#editprereqThirdSubject1summerModal').modal('show');
                    $('#prereq3rd1summerid').val(prereq);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.editSubject3rd2summerPreqModal', function(){
                    var id=$(this).val();
                    var prereq=$('#idprereq3rd2summer'+id).text();
            
                    $('#editprereqThirdSubject2summerModal').modal('show');
                    $('#prereq3rd2summerid').val(prereq);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.deleteprereqthirdSubject11stbtn', function(){
                    var id=$(this).val();
            
                    $('#deleteSubject3rd11stPreqModal').modal('show');
                    $('#prereq3rdsub11stid').val(id);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.deleteprereqthirdSubject21stbtn', function(){
                    var id=$(this).val();
            
                    $('#deleteSubject3rd21stPreqModal').modal('show');
                    $('#prereq3rdsub21stid').val(id);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.deleteprereqthirdSubject12ndbtn', function(){
                    var id=$(this).val();
            
                    $('#deleteSubject3rd12ndPreqModal').modal('show');
                    $('#prereq3rdsub12ndid').val(id);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.deleteprereqthirdSubject22ndbtn', function(){
                    var id=$(this).val();
            
                    $('#deleteSubject3rd22ndPreqModal').modal('show');
                    $('#prereq3rdsub22ndid').val(id);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.deleteprereqthirdSubject1summerbtn', function(){
                    var id=$(this).val();
            
                    $('#deleteSubject3rd1summerPreqModal').modal('show');
                    $('#prereq3rdsub1summerid').val(id);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.deleteprereqthirdSubject2summerbtn', function(){
                    var id=$(this).val();
            
                    $('#deleteSubject3rd2summerPreqModal').modal('show');
                    $('#prereq3rdsub2summerid').val(id);
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

            $('#table4').DataTable();
            $('#table42nd').DataTable();
            $('#table4summer').DataTable();

            $(".multiple-data-4").select2({
                //maximumSelectionLength: 2
            });

            $(".multiple-data-4-1st").select2({
                //maximumSelectionLength: 2
            });

            $(".multiple-data-4-2nd").select2({
                //maximumSelectionLength: 2
            });

            $(".add-prereq-multi-4th-1st").select2({
                //maximumSelectionLength: 2
            });

            $(".add-prereq-multi-4th-2nd").select2({
                //maximumSelectionLength: 2
            });

            $(".add-prereq-multi-4th-summer").select2({
                //maximumSelectionLength: 2
            });

            $('#addFourthSubject').on('click', function() {
                $('#addFourthSubjectsmodal').modal('show');
            });

            $('#deleteAllFourthSubject').on('click', function() {
                $('#deleteAllFourthSubjectsModal').modal('show');
            });

            $(document).ready(function() {
            $('body').on('click','.editFourthSubject1stbtn',function() {
                $('#editFourthSubjectModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#4th_subject_1st_id').val(data[0]);
                $('#subcode_4th_sub_1st').val(data[1]);
                $('#des_4th_sub_1st').val(data[2]);
                $('#lec_4th_sub_1st').val(data[3]);
                $('#lab_4th_sub_1st').val(data[4]);
                $('#units_4th_sub_1st').val(data[5]);
                $('#pre_4th_sub_1st').val(data[6]);
                $('#sem_4th_sub_1st').val(data[7]);
                $('#year_4th_sub_1st').val(data[8]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.editFourthSubject2ndbtn',function() {
                $('#editFourthSubject2ndModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#4th_subject_2nd_id').val(data[0]);
                $('#subcode_4th_sub_2nd').val(data[1]);
                $('#des_4th_sub_2nd').val(data[2]);
                $('#lec_4th_sub_2nd').val(data[3]);
                $('#lab_4th_sub_2nd').val(data[4]);
                $('#units_4th_sub_2nd').val(data[5]);
                $('#pre_4th_sub_2nd').val(data[6]);
                $('#sem_4th_sub_2nd').val(data[7]);
                $('#year_4th_sub_2nd').val(data[8]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.editFourthSubjectsummerbtn',function() {
                $('#editFourthSubjectsummerModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#4th_subject_summer_id').val(data[0]);
                $('#subcode_4th_sub_summer').val(data[1]);
                $('#des_4th_sub_summer').val(data[2]);
                $('#lec_4th_sub_summer').val(data[3]);
                $('#lab_4th_sub_summer').val(data[4]);
                $('#units_4th_sub_summer').val(data[5]);
                $('#pre_4th_sub_summer').val(data[6]);
                $('#sem_4th_sub_summer').val(data[7]);
                $('#year_4th_sub_summer').val(data[8]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.deleteFourthSubject1stbtn',function() {
                $('#deleteFourthSubjectModal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#delete4thsubject1stid').val(data[0]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.deleteFourthSubject2ndbtn',function() {
                $('#deleteFourthSubject2ndModal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#delete4thsubject2ndid').val(data[0]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.deleteFourthSubjectsummerbtn',function() {
                $('#deleteFourthSubjectsummerModal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#delete4thsubjectsummerid').val(data[0]);
            });
            });

            // for prereq //
            $(document).ready(function() {
            $('body').on('click','.addFourthPrereq11stbtn',function() {
                $('#addprereqFourth11stModal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#addprereq4th11stid').val(data[0]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.addFourthPrereq22ndbtn',function() {
                $('#addprereqFourth2ndModal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#addprereq4th2ndid').val(data[0]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.addFourthPrereq2summerbtn',function() {
                $('#addprereqFourthsummerModal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#addprereq4thsummerid').val(data[0]);
            });
            });

            $(document).ready(function(){
                $(document).on('click', '.editSubject4th11stPreqModal', function(){
                    var id=$(this).val();
                    var prereq=$('#idprereq4th11st'+id).text();
            
                    $('#editprereqFourthSubject11stModal').modal('show');
                    $('#prereq4th11stid').val(prereq);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.editSubject4th21stPreqModal', function(){
                    var id=$(this).val();
                    var prereq=$('#idprereq4th21st'+id).text();
            
                    $('#editprereqFourthSubject21stModal').modal('show');
                    $('#prereq4th21stid').val(prereq);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.editSubject4th12ndPreqModal', function(){
                    var id=$(this).val();
                    var prereq=$('#idprereq4th12nd'+id).text();
            
                    $('#editprereqFourthSubject12ndModal').modal('show');
                    $('#prereq4th12ndid').val(prereq);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.editSubject4th22ndPreqModal', function(){
                    var id=$(this).val();
                    var prereq=$('#idprereq4th22nd'+id).text();
            
                    $('#editprereqFourthSubject22ndModal').modal('show');
                    $('#prereq4th22ndid').val(prereq);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.editSubject4th1summerPreqModal', function(){
                    var id=$(this).val();
                    var prereq=$('#idprereq4th1summer'+id).text();
            
                    $('#editprereqFourthSubject1summerModal').modal('show');
                    $('#prereq4th1summerid').val(prereq);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.editSubject4th2summerPreqModal', function(){
                    var id=$(this).val();
                    var prereq=$('#idprereq4th2summer'+id).text();
            
                    $('#editprereqFourthSubject2summerModal').modal('show');
                    $('#prereq4th2summerid').val(prereq);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.deleteprereqFourthSubject11stbtn', function(){
                    var id=$(this).val();
            
                    $('#deleteSubject4th11stPreqModal').modal('show');
                    $('#prereqfourthsub11stid').val(id);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.deleteprereqFourthSubject21stbtn', function(){
                    var id=$(this).val();
            
                    $('#deleteSubject4th21stPreqModal').modal('show');
                    $('#prereqfourthsub21stid').val(id);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.deleteprereqFourthSubject12ndbtn', function(){
                    var id=$(this).val();
            
                    $('#deleteSubject4th12ndPreqModal').modal('show');
                    $('#prereqfourthsub12ndid').val(id);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.deleteprereqFourthSubject22ndbtn', function(){
                    var id=$(this).val();
            
                    $('#deleteSubject4th22ndPreqModal').modal('show');
                    $('#prereqfourthsub22ndid').val(id);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.deleteprereqFourthSubject1summerbtn', function(){
                    var id=$(this).val();
            
                    $('#deleteSubject4th1summerPreqModal').modal('show');
                    $('#prereqfourthsub1summerid').val(id);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.deleteprereqFourthSubject2summerbtn', function(){
                    var id=$(this).val();
            
                    $('#deleteSubject4th2summerPreqModal').modal('show');
                    $('#prereqfourthsub2summerid').val(id);
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

            $('#table5').DataTable();
            $('#table52nd').DataTable();
            $('#table5summer').DataTable();

            $(".multiple-data-5").select2({
                //maximumSelectionLength: 2
            });

            $(".multiple-data-5-1st").select2({
                //maximumSelectionLength: 2
            });

            $(".multiple-data-5-2nd").select2({
                //maximumSelectionLength: 2
            });

            $(".multiple-data-5-summer").select2({
                //maximumSelectionLength: 2
            });

            $(".add-prereq-multi").select2({
                //maximumSelectionLength: 2
            });

            $(".add-prereq-multi-1st").select2({
                //maximumSelectionLength: 2
            });

            $(".add-prereq-multi-2nd").select2({
                //maximumSelectionLength: 2
            });

            $(".add-prereq-multi-5-summer").select2({
                //maximumSelectionLength: 2
            });

            $(document).ready(function() {
            $('body').on('click','.editFifthSubject1stbtn',function() {
                $('#editFifthSubjectModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#5th_subject_1st_id').val(data[0]);
                $('#subcode_5th_sub_1st').val(data[1]);
                $('#des_5th_sub_1st').val(data[2]);
                $('#lec_5th_sub_1st').val(data[3]);
                $('#lab_5th_sub_1st').val(data[4]);
                $('#units_5th_sub_1st').val(data[5]);
                $('#pre_5th_sub_1st').val(data[6]);
                $('#sem_5th_sub_1st').val(data[7]);
                $('#year_5th_sub_1st').val(data[8]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.editFifthSubject2ndbtn',function() {
                $('#editFifthSubject2ndModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#5th_subject_2nd_id').val(data[0]);
                $('#subcode_5th_sub_2nd').val(data[1]);
                $('#des_5th_sub_2nd').val(data[2]);
                $('#lec_5th_sub_2nd').val(data[3]);
                $('#lab_5th_sub_2nd').val(data[4]);
                $('#units_5th_sub_2nd').val(data[5]);
                $('#pre_5th_sub_2nd').val(data[6]);
                $('#sem_5th_sub_2nd').val(data[7]);
                $('#year_5th_sub_2nd').val(data[8]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.editFifthSubjectsummerbtn',function() {
                $('#editFifthSubjectsummerModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#5th_subject_summer_id').val(data[0]);
                $('#subcode_5th_sub_summer').val(data[1]);
                $('#des_5th_sub_summer').val(data[2]);
                $('#lec_5th_sub_summer').val(data[3]);
                $('#lab_5th_sub_summer').val(data[4]);
                $('#units_5th_sub_summer').val(data[5]);
                $('#pre_5th_sub_summer').val(data[6]);
                $('#sem_5th_sub_summer').val(data[7]);
                $('#year_5th_sub_summer').val(data[8]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.deleteFifthSubject1stbtn',function() {
                $('#deleteFifthSubjectModal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#delete5thsubject1stid').val(data[0]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.deleteFifthSubject2ndbtn',function() {
                $('#deleteFifthSubject2ndModal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#delete5thsubject2ndid').val(data[0]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.deleteFifthSubjectsummerbtn',function() {
                $('#deleteFifthSubjectsummerModal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#delete5thsubjectsummerid').val(data[0]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.prereqFifthSubject2ndbtn',function() {
                $('#prereqFifthSubject2ndModal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#preq5thsubject2ndid').val(data[0]);
                $('#preq5thsubject2ndcode').val(data[6]);
            });
            });
            // for prereq //
            $(document).ready(function() {
            $('body').on('click','.addFifthPrereq11stbtn',function() {
                $('#addprereqFifth11stModal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#addprereq5th11stid').val(data[0]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.addFifthPrereq2ndbtn',function() {
                $('#addprereqFifth2ndModal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#addprereq5th2ndid').val(data[0]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.addFifthPrereqsummerbtn',function() {
                $('#addprereqFifthsummerModal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#addprereq5thsummerid').val(data[0]);
            });
            });

            $(document).ready(function(){
                $(document).on('click', '.editSubject5th11stPreqModal', function(){
                    var id=$(this).val();
                    var prereq=$('#idprereq5th11st'+id).text();
            
                    $('#editprereqFifthSubject11stModal').modal('show');
                    $('#prereq5th11stid').val(prereq);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.editSubject5th21stPreqModal', function(){
                    var id=$(this).val();
                    var prereq=$('#idprereq5th21st'+id).text();
            
                    $('#editprereqFifthSubject21stModal').modal('show');
                    $('#prereq5th21stid').val(prereq);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.editSubject5th1stPreqModal', function(){
                    var id=$(this).val();
                    var prereq=$('#idprereq5th12nd'+id).text();
            
                    $('#editprereqFifthSubject12ndModal').modal('show');
                    $('#prereq5th1stid').val(prereq);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.editSubject5th2ndPreqModal', function(){
                    var id=$(this).val();
                    var prereq=$('#idprereq5th22nd'+id).text();
            
                    $('#editprereqFifthSubject22ndModal').modal('show');
                    $('#prereq5th2ndid').val(prereq);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.editSubject5th1summerPreqModal', function(){
                    var id=$(this).val();
                    var prereq=$('#idprereq5th1summer'+id).text();
            
                    $('#editprereqFifthSubject1summerModal').modal('show');
                    $('#prereq5th1summerid').val(prereq);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.editSubject5th2summerPreqModal', function(){
                    var id=$(this).val();
                    var prereq=$('#idprereq5th2summer'+id).text();
            
                    $('#editprereqFifthSubject2summerModal').modal('show');
                    $('#prereq5th2summerid').val(prereq);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.deleteprereqFifthSubject11stbtn', function(){
                    var id=$(this).val();
            
                    $('#deleteSubject5th11stPreqModal').modal('show');
                    $('#prereqfifthsub11stid').val(id);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.deleteprereqFifthSubject21stbtn', function(){
                    var id=$(this).val();
            
                    $('#deleteSubject5th21stPreqModal').modal('show');
                    $('#prereqfifthsub21stid').val(id);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.deleteprereqFifthSubject1stbtn', function(){
                    var id=$(this).val();
            
                    $('#deleteSubject5th1stPreqModal').modal('show');
                    $('#prereqfifthsub1stid').val(id);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.deleteprereqFifthSubject2ndbtn', function(){
                    var id=$(this).val();
            
                    $('#deleteSubject5th2ndPreqModal').modal('show');
                    $('#prereqfifthsub2ndid').val(id);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.deleteprereqFifthSubject1summerbtn', function(){
                    var id=$(this).val();
            
                    $('#deleteSubject5th1summerPreqModal').modal('show');
                    $('#prereqfifthsub1summerid').val(id);
                });
            });

            $(document).ready(function(){
                $(document).on('click', '.deleteprereqFifthSubject2summerbtn', function(){
                    var id=$(this).val();
            
                    $('#deleteSubject5th2summerPreqModal').modal('show');
                    $('#prereqfifthsub2summerid').val(id);
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