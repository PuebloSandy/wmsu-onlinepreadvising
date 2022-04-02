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
    <link rel="stylesheet" href="../../source/css/style-admin.css" />
    <link rel="stylesheet" href="../../source/preloader/loader.css" />
    <title>Curriculum</title>
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


    <div class="container">
        <p class="text  mt-3 text-danger fw-bold text-center fs-2" style="cursor: default;">Curriculum</p>

        <div class="row border">
            <div class="col-2 border-bottom mt-3">
                <button type="button" class="btn btn-secondary fas fa-chevron-left" onclick="location.href='admin-homepage.php'"> Back</button>
            </div>

            <div class="col border-bottom mt-3" align="right">
                <button type="button" class="btn rounded btn-success fas fa-clipboard mb-3" data-toggle="modal" data-target="#addCurriculum" id="add-curriculum"> Add Curriculum</button>
                <button type="button" class="btn rounded btn-warning text-white fas fa-edit mb-3" data-toggle="modal" data-target="#copyCurriculum" id="del-curriculum"> Copy Curriculum Subjects</button>
        <?php
            $selectcur = mysqli_query($connection, "SELECT * from tblcurriculum WHERE college_id_fk='$collegeid' and status='1'");
            if(mysqli_num_rows($selectcur) > 0)
            {
        ?>
            <button type="button" class="btn rounded btn-danger fas fa-trash-alt mb-3" data-toggle="modal" data-target="#delCurriculum" id="del-curriculum"> Deactivate Curriculum</button>
        <?php
            }
        ?>
            </div>

            <div class="justify-content-md-center bg-light bg-gradient">
                <div class="cards">
                <?php
                    $getcur =mysqli_query($connection, "SELECT * from tblcurriculum WHERE college_id_fk='$collegeid' and status='1' ORDER BY effectiveSY");
                    while($fa_curr = mysqli_fetch_array($getcur))
                    {
                        $currid = $fa_curr['id'];
                        $currcode = $fa_curr['curr_code'];
                ?>
                    <form action="managedata.php" method="POST">
                        <input type='hidden' name='id' value="<?php echo $currid ?>">
                        <button type="submit" name='getidbtn' class="btn rounded cards-single text-center fs-5" value="<?php echo $currcode ?>"> <?php echo $currcode ?></button>
                    </form>     
                <?php
                    }
                ?>
                </div>   
            </div>
        </div>
	</div>

    <!-- ADD NEW CURRICULUM POPUP -->
    <div class="container container-fluid">
        <div class="modal fade" id="addCurriculum" tabindex="-1" aria-labelledby="addCurriculumLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="addCurriculumLabel">Create New Curriculum</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <!-- Inputs -->
                        <form action="managedata.php" method="POST">
                            <input type="hidden" name="collegeid" value="<?php echo $collegeid?>">
                            <div class="mb-3">
                                <label for="cmo" class="form-label">CMO</label>
                                <span id="emailHelp" class="">(CHED Memorandum Order)</span>                           
                                <textarea rows="3" cols="50" name="CMO" class="form-control" id="cmo" placeholder="Enter text here..." required></textarea>                       
                            </div>

                            <div class="mb-3">
                                <label for="board" class="form-label">Board Resolution</label>
                                <textarea rows="3" cols="50" name="BoardResolution" class="form-control" id="board" placeholder="Enter text here..."required></textarea> 
                            </div>

                            <div class="mb-3">
								<p for="Syfrom" class="form-label">Effectivity School Year</p>
                                <input type="number" name="SYfrom" class="form-control" placeholder="From" id="Syfrom">
								<!--<p class="mb-0">School Year</p>
                                <div class="col">
									<input type="number" name="" class="form-control" placeholder="From" id="inputLec">
								</div>
								<div class="col">
									<input type="number" name="SYto" class="form-control" placeholder="To" id="inputLab" >
								</div>-->
							</div>

                            <!-- Course -->		
                            <div class="container p-0 mb-3" id="select-course">
                                <label >Course</label>
                                <select class="form-control" id="select-course" name="coursecode" required>
                                    <option value="0"> Select Course for this Curriculum...</option>
                                    <?php
                                        $CollegeID = $_SESSION['college_id_fk'] ;
                                        $getcourse = mysqli_query($connection,"SELECT * FROM tblcourse where college_id_fk=$collegeid");

                                        while($fac = mysqli_fetch_array($getcourse))
                                        {
                                            $course = $fac['course'];
                                            $coursecode = $fac['coursecode'];
                                            echo "<option value='$coursecode'>".$course."</td>";
                                        }
                                    ?>
                                    </select>
                                <!-- FETCH COURSES FROM DATABASE --> 			
                            </div>	

                            <div class="mb-3">
                                <label for="board" class="form-label">
                                Other Details(if any)</label>
                                <textarea rows="3" cols="50" name="otherdetails" class="form-control" id="board" placeholder="Enter text here..."></textarea> 
                            </div>
                    </div>	

                    <div class="modal-footer" align="right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="addCurriculum" class="btn btn-primary">Confirm</button>
                    </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ADD CURRICULUM END -->

    <!-- Copy NEW CURRICULUM POPUP -->
    <div class="container container-fluid">
        <div class="modal fade" id="copyCurriculum" tabindex="-1" aria-labelledby="addCurriculumLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="addCurriculumLabel">Copy Curriculum Subjects</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <!-- Inputs -->
                        <form action="managedata.php" method="POST">
                            <!-- Curriculum to Copy -->		
                            <div class="container p-0 mb-3" id="select-course">
                                <label >Get Copy Curriculum Subjects</label>
                                <select class="form-control" id="select-course" name="copy_curri" required>
                                    <option value="0"> Select Curriculum to Copy Subjects...</option>
                                    <?php
                                        $getcurriculumCopy = mysqli_query($connection,"SELECT * FROM tblcurriculum where college_id_fk=$collegeid and status='1'ORDER BY effectiveSY");
                                        while($fac = mysqli_fetch_array($getcurriculumCopy))
                                        {
                                            $curr_copy_id = $fac['id'];
                                            $curr_copy_code = $fac['curr_code'];
                                            $curri_copy_courseid = $fac['course_id_fk']; 
                                            $select_curri_sub_copy = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$curr_copy_id' and college_id_fk='$collegeid' and course_id_fk='$curri_copy_courseid'");
                                            if(mysqli_num_rows($select_curri_sub_copy) > 0)
                                            {
                                    ?>
                                        <option value="<?php echo $curr_copy_id?>"><?php echo $curr_copy_code ?></option>
                                    <?php
                                            }
                                        }
                                    ?>
                                    </select>
                                <!-- FETCH COURSES FROM DATABASE --> 			
                            </div>	

                            <!-- Curriculum -->		
                            <div class="container p-0 mb-3" id="select-course">
                                <label >To Paste Curriculum Subjects</label>
                                <select class="form-control" id="select-course" name="paste_curri" required>
                                    <option value="0"> Select Curriculum to Paste Subject...</option>
                                    <?php
                                        $getcurri = mysqli_query($connection,"SELECT * FROM tblcurriculum where college_id_fk='$collegeid' and status='1'ORDER BY effectiveSY");
                                        while($fa = mysqli_fetch_array($getcurri))
                                        {
                                            $curri_paste_id = $fa['id'];
                                            $curr_paste_code = $fa['curr_code'];
                                            $curri_paste_courseid = $fa['course_id_fk']; 
                                            $select_curri_sub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$curri_paste_id' and college_id_fk='$collegeid' and course_id_fk='$curri_paste_courseid'");
                                            if(mysqli_num_rows($select_curri_sub) == 0)
                                            {
                                    ?>
                                        <option value="<?php echo $curri_paste_id?>"><?php echo $curr_paste_code ?></option>
                                    <?php
                                            }
                                        }
                                    ?>
                                    </select>
                                <!-- FETCH COURSES FROM DATABASE --> 			
                            </div>
                    </div>	

                    <div class="modal-footer" align="right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="copyCurriculum" class="btn btn-primary">Save</button>
                    </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Copy CURRICULUM END -->

    <!-- ADVISER ACCOUNT -->
    <div class="modal fade" id="popup-manage-curriculum" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="manage-curriculum" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="manage-curriculum">Manage Curriculum</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="input-curriculumID" class="form-label">Curriculum ID</label>
                        <input type="text" class="form-control" id="input-curriculumID" aria-describedby="input-curriculumID-help" required>
                        <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>

                    <div class="mb-3">
                        <label for="input-cmo" class="form-label">CMO</label>
                        <span id="emailHelp" class="form-text">(CHED Memorandum Order)</span>
                        <input type="text" class="form-control" id="input-cmo" required>
                        
                    </div>

                    <div class="mb-3">
                        <label for="input-board" class="form-label">Board Resolution</label>
                        <input type="text" class="form-control" id="input-board" required>
                    </div>

                    <div class="row mb-3">
                        <p class="mb-0">School Year</p>
                        <div class="col">
                            <input type="number" class="form-control" placeholder="From" id="inputLec">
                        </div>
                        <div class="col">
                            <input type="number" class="form-control" placeholder="To" id="inputLab" >
                        </div>
                    </div>

                    <!-- Course -->		
                    <div class="container p-0 mb-3" id="select-course">
                        <label for="select-course" class="form-label" >Course</label>
                        <select class="custom-select p-2 " id="select-course" required>
                            <option selected>Select Course...</option>
                            <option value="1">BSCS</option>
                            <option value="1">BSIT</option>
                        </select>			
                    </div>		

                    <div align="right">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Delete</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ADVISER ACCOUNT END -->

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

    <!-- Delete Curriculum MODAL-->
		<div class="container container-fluid">
        	<div class="modal fade" id="delCurriculum" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            	<div class="modal-dialog">
                	<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Delete Curriculum</h5></h5>
							<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
					</div>
                    <form action="managedata.php" method="POST">
                        <input type="hidden" name="id" id="deleteid" value="<?php echo $adminid?>">

                        <div class="modal-body">
                            <!-- Curriculum -->		
                            <div class="container p-0 mb-3" id="select-course">
                                <label >Curriculum</label>
                                <select class="form-control" id="select-course" name="curri_id" required>
                                    <option value="0"> Select Curriculum to Delete...</option>
                                    <?php
                                        $getcurri = mysqli_query($connection,"SELECT * FROM tblcurriculum where college_id_fk='$collegeid' and status='1'ORDER BY effectiveSY");
                                        while($fac = mysqli_fetch_array($getcurri))
                                        {
                                            $id = $fac['id'];
                                            $curr_code = $fac['curr_code'];
                                            echo "<option value='$id'>".$curr_code."</td>";
                                        }
                                    ?>
                                    </select>
                                <!-- FETCH COURSES FROM DATABASE --> 			
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <button type="submit" name="delete_curriculum" class="btn btn-success">Yes</button>
                        </div>                     
                    </form>
                </div>
            </div>
        </div>
    <!--END OF Delete Curriculum MODAL-->

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
    <div>

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