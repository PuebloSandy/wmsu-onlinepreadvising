<?php
    require "../../source/includes/config.php";
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
		<link rel="stylesheet" href="../../source/css/style-superadmin.css" />
		<link rel="stylesheet" href="../../source/preloader/loader.css" />
		<script>
			function preventBack(){
				window.history.forward();
			}
			setTimeout("preventBack()",0);
			window.onload=function()
			{
				null;
			}
		</script>
		<title>Homepage</title>
	</head>
<body onmousemove="reset_interval()" onclick="reset_interval()" onkeypress="reset_interval()" onscroll="reset_interval()">
<?php
	if(isset($_SESSION['login_user']))
	{
			$_SESSION['last_login_time'] = time();
			$usertype = "Superadmin";
			$username = $_SESSION['login_user'];
			$sql = "SELECT * usertype='Superadmin' FROM tbluser";
			$result = mysqli_query($connection,$sql);
			$get_user = mysqli_query($connection,"SELECT * FROM tbluser WHERE email='$username'");
			while($getuser=mysqli_fetch_array($get_user))
			{
				$adminid = $getuser['id'];
				$firstname = $getuser['firstname'];
				$lastname = $getuser['lastname'];
				$full = ucfirst($firstname).' '.ucfirst($lastname);
			}
?>
	<div class="mobile">
		<h1>📴</h1>
		<h3>Unavailable for Mobile Device..</h3>
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
					<a class="navbar-brand p-0 m-0" id="nav-logo" href="superadmin-homepage.php">
						<img class="rounded-circle p-0" src="../../source/assets/images/wmsu-seal.png" alt="WMSU SEAL" width="32" height="32" />
						<span class="text-uppercase">Online Pre-Advising</span>
					</a>

					<!-- MOBILE TOGGLE -->
					<button class="navbar-toggler m-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span><i class="fas fa-bars"></i></span>
					</button>

					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav mt-2">
							<!-- Home -->
							<li class="nav-item">
								<a class="nav-link active py-0" aria-current="page" href="superadmin-homepage.php"><i id="icons" class="fas fa-home"></i><span class="nav-label"> Home</span></a>
							</li>
							<!-- Profile -->
							<li class="nav-item">
								<a class="nav-link active py-0" aria-current="page" href="superadmin-profile.php"><i id="icons" class="fas fa-user-tie"></i><span class="nav-label"> My Profile</span></a>
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
			<div class="container container-fluid mt-3">
				<div class="row pt-5">
					<div class="col-6 mt-5" id="left-side">
						<div class="col-6" >
							<img id="picture" src="../../source/assets/images/superadmin.svg" alt="super admin" />
						</div>
					</div>
					<?php 
						//count number of college//
						$check_college = mysqli_query($connection,"SELECT count(id) FROM tblcollege");
						$college_total = mysqli_fetch_array($check_college);
						$col_row = $college_total[0];

						//count number of users//
						//count number of admins//
						$check_admins = "SELECT count(id) FROM tbluser WHERE usertype='Admin'";
						$admin_check = mysqli_query($connection,$check_admins);
						$admin_total = mysqli_fetch_array($admin_check);
						$admin_row = $admin_total[0];
						//count number of advisers//
						$check_adviser = "SELECT count(id) FROM tbluser WHERE usertype='Adviser'";
						$admin_check = mysqli_query($connection,$check_adviser);
						$adviser_total = mysqli_fetch_array($admin_check);
						$adviser_row = $adviser_total[0];
						//count number of advisers//
						$check_students = "SELECT count(id) FROM tbluser WHERE usertype='Student'";
						$student_check = mysqli_query($connection,$check_students);
						$student_total = mysqli_fetch_array($student_check);
						$student_row = $student_total[0];

						$all_total_users = $admin_row + $adviser_row;
						//count number of users//

						//count number of users//
						$check_course = mysqli_query($connection,"SELECT count(id) FROM tblcourse");
						$course_total = mysqli_fetch_array($check_course);
						$cor_row = $course_total[0];
					?>

					<div class="col-6 g-5" id="right-side">
						<h1 class="text fw-bold fs-1 text-center mt-2 mb-3" style="cursor: default;">Welcome <span class="text-danger">Super Admin</span></h1>
						<!-- <a class="btn btn-danger w-100 rounded-pill mb-3 text-white fs-4" href="superadmin-school-year.php"> School Year</a> -->
						<a class="btn btn-danger w-100 rounded-pill mb-3 text-white fs-4" href="superadmin-departments.php"><?php echo $col_row;?> Colleges</a>
						<a class="btn btn-danger w-100 rounded-pill mb-3 text-white fs-4" href="superadmin-courses.php"><?php echo $cor_row;?> Courses</a>
						<a class="btn btn-danger w-100 rounded-pill mb-3 text-white fs-4" href="superadmin-admin-accounts.php"><?php echo $all_total_users;?> Accounts</a>
					</div>
				</div>
			</div>

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
		<!-- CONTENET END -->

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
