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
		<title>Send Subjects</title>
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
							<a class="nav-link active py-0" aria-current="page" href="adviser-profile.php"><i id="icons" class="fas fa-user-tie"></i><span class="nav-label"> My Profile</span></a>
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
			<p class="text mt-3 text-uppercase text-danger fw-bold text-center fs-2" style="cursor: default;"><?php echo $code?> Pre-Advise Student Subjects</p>
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
                    <form action="adviser-sendsubject.php" method="POST">
						<div class="container">
							<div class="row justify-content-end">
								<div class="col-5">
									<select class="form-select" name="yr" aria-label="Default select example" required>
										<option value="">Select Year Level</option>
										<option value="1">1st Year</option>
										<option value="2">2nd Year</option>
										<option value="3">3rd Year</option>
										<option value="4">4th Year</option>
										<option value="5">5th Year</option>
									</select>
								</div>
								<div class="col-5">
									<select class="form-select" name="sem" aria-label="Default select example" required>
										<option value="">Select Semester</option>
										<option value="1st">1st Semester</option>
										<option value="2nd">2nd Semester</option>
										<option value="summer">Summer</option>
									</select>
								</div>
								<div class="col">
									<button type="submit" name="search" class="btn btn-success fas fa-search"></button>
								</div>
							</div>
						</div>
                    </form>
                </div>
			</div>
            <?php
                if(isset($_POST['search']))
                {
					$yr = $_POST['yr'];
					$sem = $_POST['sem'];
					if($yr == "1")
					{
						$year = "1st Year";
					}
					else if($yr == "2")
					{
						$year = "2nd Year";
					}
					else if($yr == "3")
					{
						$year = "3rd Year";
					}
					else if($yr == "4")
					{
						$year = "4th Year";
					}
					else if($yr == "5")
					{
						$year = "5th Year";
					}
                    if($sem == "summer")
                    {
                        $sem = "Summer";
                    }
					$search = $year.' - '.$sem;

                    mysqli_query($connection,$search);
					mysqli_query($connection,$yr);
					mysqli_query($connection,$sem);
            ?>
            <div class="row border mt-2" style="max-height:700px;">
                <span class="fw-bold fs-4 mt-2 mb-2"><center><?php echo $search?> Semester</center></span>
                <div class="mb-2">
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
                            <th width="5%"><center><input type="checkbox" id="chckAllSubjectsAdd"></center></th>
                            <th hidden><center>id</center></th>
                            <th><center>Code</center></th>
                            <th width="25%"><center>Title</center></th>
                            <th scope="col"><center>Lec</center></th>
                            <th scope="col"><center>Lab</center></th>
                            <th scope="col"><center>Units</center></th>
			    <th ><center>Prerequisite</center></th>
                            <th ><center>Year Level</center></th>
			    <th ><center>Status</center></th>
			    <th ><center>Action</center></th>
                        </tr>
					</thead>
					<tbody>
            <?php
				$select_subject_sem = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE student_id_fk='$Studid' and  yearlevel='$yr' and semester='$sem' and curr_id_fk='$Currid' and course_id_fk='$courseid'");
                if(mysqli_num_rows($select_subject_sem) > 0)
                {
                    foreach($select_subject_sem as $se)
                    {
			$subjectID = $se['id'];
                        $yearlvl = $se['yearlevel'];
			$SubPreq = $se['prerequisite'];
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

						$check_get_subid = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE remarks in ('PASSED','CREDITED') and adviser_id_fk='$adviserid' and student_id_fk='$Studid' and id='$subjectID' and curr_id_fk='$Currid' and course_id_fk='$courseid'");
						while($k=mysqli_fetch_array($check_get_subid))
						{
							$Send_subID = $k['subject_id_fk'];
							$Remarks_pre = $k['remarks'];
						}

						if(mysqli_num_rows($check_get_subid) == 0)
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
	    ?>
                        <td><center><?php echo $yrlvl?></center></td>
			<td><center><?php echo $se['remarks'] ?></center></td>
			<td><center><button type="button" class="btn btn-danger">Disable</button></center></td>
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
                <span class="fw-bold fs-4 mt-3 mb-4"><center>Select Semester First!!</center></span>
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
								<th ><center>Prerequisite</center></th>
								<th ><center>Year Level</center></th>
								<th ><center>Remarks</center></th>
								<th ><center>Action</center></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td></td>
								<td hidden></td>
								<td></td>
								<td></td>
								<td></td>
								<td><center>No Data Found</center></td>
								<td></td>
								<td></td>
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

		<?php
			$open_view = mysqli_query($connection,"SELECT * FROM tbladviser_send_sub_to_stud WHERE status='Pending' and adviser_id_fk='$adviserid' and student_id_fk='$Studid' and curri_id_fk='$Currid' and course_id_fk='$courseid'");
			if(mysqli_num_rows($open_view) > 0)
			{
				// CALL MODAL HERE
				echo '
				<script type="text/javascript">
					window.onload = function () {
						OpenBootstrapPopup();
					};
					function OpenBootstrapPopup() {
						$("#viewPopOutSubject").modal("show");
					}
				</script>
				';
			} 
		?>

			<!-- Start View Pop out Subjects Modal -->
			<div class="container container-fluid">
				<div class="modal fade" id="viewPopOutSubject" tabindex="-1" role="dialog" aria-labelledby="manage-requestLabel" aria-hidden="true">
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
											<span class="text-uppercase fw-bold text-center fs-4 mt-2 mb-1">Final Check Pre-Advise Subject</span>
										</div>
										<table class="table table-striped" id="table_approved" width="100%">
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
													<th hidden><center>School Year</center></th>
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
												$get_subid = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE id='$SubjID'"); 
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
												<td hidden><center><?php echo $l['school_year']?></center></td>
												<td><center><button type="button" title="Delete" class="btn btn-danger fas fa-trash deleteAddSubjectbtn"></button></center></td>
											</tr>
									<?php
												}
											}
										}
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
													<td hidden></td>
													<td></td>
												</tr>
											</tfoot>
										</table>
									</div>
							</div>

							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="submit" name="approved_add_send_sub" id="button_approved" class="btn btn-success">Approve</button>
							</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- End of View Pop out Subject -->

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
										<span class="text-uppercase fw-bold text-center fs-4 mt-2 mb-1">Final Check Pre-Advise Subject</span>
									</div>
									<table class="table table-striped" id="table_approved" width="100%">
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
												<th hidden><center>School Year</center></th>
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
											$get_subid = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE id='$SubjID'"); 
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
											<td hidden><center><?php echo $l['school_year']?></center></td>
											<td><center><button type="button" title="Delete" class="btn btn-danger fas fa-trash deleteAddSubjectbtn"></button></center></td>
										</tr>
								<?php
											}
										}
									}
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
												<td hidden></td>
												<td></td>
											</tr>
										</tfoot>
									</table>
								</div>
						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="approved_add_send_sub" id="button_approved" class="btn btn-success">Approve</button>
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
							<input type="hidden" name="addid" id="addsubid">
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
		<?php
			include("../../source/includes/alertmessage.php");
		?> 

		<script>
			$(document).ready(function() {
				var $selectAllSubjectAdd = $('#chckAllSubjectsAdd'); // main checkbox inside table thead
				var $tableSendAdd = $('#tableSend'); // table selector 
				var $tdCheckboxSubAdd = $tableSendAdd.find('tbody input:checkbox'); // checboxes inside table body
				var tdCheckboxCheckedSubAdd = 0; // checked checboxes

				// Select or deselect all checkboxes depending on main checkbox change
					$selectAllSubjectAdd.on('click', function () {
					$tdCheckboxSubAdd.prop('checked', this.checked);
				});

				// Toggle main checkbox state to checked when all checkboxes inside tbody tag is checked
					$tdCheckboxSubAdd.on('change', function(e){
					tdCheckboxCheckedSubAdd = $tableSendAdd.find('tbody input:checkbox:checked').length; // Get count of checkboxes that is checked
					// if all checkboxes are checked, then set property of main checkbox to "true", else set to "false"
					$selectAllSubjectAdd.prop('checked', (tdCheckboxCheckedSubAdd === $tdCheckboxSubAdd.length));
				})
			});

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

			$(document).ready(function() {
				$('#table_approved').DataTable( {
					"paging":   false,
					"ordering": false,
					"info":     false
				} );
			} );

			$(document).ready(function() {
            $('body').on('click','.deleteAddSubjectbtn',function() {
                $('#deleteAddSubjectModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#addsubid').val(data[0]);
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

			$('#table_approved').on('change', ':checkbox', function() {
				$('#button_approved').toggle(!!$('input:checkbox:checked').length);
			});

			$(document).ready(function(){
                // Check/Uncheck ALl
                $('#checkAll').change(function(){
                    if($(this).is(':checked')){
                        $('input[name="get_sub_id[]"]').prop('checked',true);
                    }else{
                        $('input[name="get_sub_id[]"]').each(function(){
                            $(this).prop('checked',false);
                        }); 
                    }
                });
                // Checkbox click
                $('input[name="get_sub_id[]"]').click(function(){
                    var total_checkboxes = $('input[name="get_sub_id[]"]').length;
                    var total_checkboxes_checked = $('input[name="get_sub_id[]"]:checked').length;

                    if(total_checkboxes_checked == total_checkboxes){
                        $('#checkAll').prop('checked',true);
                    }else{
                        $('#checkAll').prop('checked',false);
                    }
                });
            });
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
