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
		<!-- BOOTSTRAP -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous" />
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.css" />
		<!-- OFFLINE BOOTSTRAP -->
		<!-- OFFLINE BOOTSTRAP -->
		<link rel="stylesheet" href="../../source/bootstrap/bootstrap-4.6.1-dist/css/bootstrap.min.css" />
		<!-- fontawesome -->
		<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
		<link rel="stylesheet" href="../../source/bootstrap/fontawesome.min.css">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<!-- local css -->
		<link rel="stylesheet" href="../../source/css/style-superadmin.css" />
		<link rel="stylesheet" href="../../source/preloader/loader.css" />
    <title>My Profile</title>
</head>
<body>
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
				$email = $getuser['email'];
				$password = $getuser['password'];
				$contact = $getuser['contact'];
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

    <!-- MY PROFILE -->
	<!-- HEAD -->
    <div class="container" id="MY-ACCOUNT">
        <p class="text mt-5 text-danger text-center fw-bold fs-1">Profile</p>
	</div>
    <div class="container container-fluid  p-3 mb-3 mt-3" id="myprofile">
        <div class="row">
            <!-- LEFT SIDE 
            <div class="col-sm-4 ">
                <center>
                    <img class="img w-50  mb-3 rounded-circle" src="../../source/assets/images/user.png" alt="Profile Picture" id="profilepicture">
                    <br>
                    <label class="mb-3" for="upload">Change Profile:</label>
                    <br>
                    <div class="input-group input-group-sm w-75 mb-1">
                        <input type="file" class="form-control" id="upload" aria-describedby="upload" aria-label="Upload">
                        <button class="btn btn-danger" type="button" id="upload">Upload</button>
                    </div>       
                </center>
            </div>-->
            
            <!-- RIGHT SIDE -->
            <div class="col">
                <div class="container mt-4 mb-4" style="width: 70%;">
                    <form class="row" action="managedata.php" method="POST">
                        <input type="hidden" name="adminid" value="<?php echo $adminid?>">
                        <!-- first line -->
                        <div class="col-md-6">
                            <label for="first" class="form-label">First name</label>
                            <input type="text" name="firstname" class="form-control text-center" id="first" value="<?php echo ucfirst($firstname)?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="last" class="form-label">Last name</label>
                            <input type="text" name="lastname" class="form-control text-center" id="last" value="<?php echo ucfirst($lastname)?>" required>
                        </div>
                        
                        <!-- third line -->
                        <div class="col-md-12 mt-2">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" name="email" class="form-control text-center" id="email" value="<?php echo $email?>" required>
                            <span class="text-secondary">Note: If you want to update your email. Remember your input Email first. It automatically logout your account in the site.</span>
                        </div>
                       
                        <!-- fourth line -->
                        <div class="col-md-12 mt-2">
                            <label for="Contact" class="form-label">Contact</label>
                            <input type="number" name="contact" class="form-control text-center" id="Contact" value="<?php echo $contact?>" onkeypress="return isNumber(event)" onpaste="return false;" required>
                        </div>
                       
                        <span class="input-group-sm mt-5">
                            <center>
                                <button type="submit" name="update_admin_profile" class="btn btn-success">Update</button>
                                <button type="button" data-toggle="modal" data-target="#passwordmodal" class="btn btn-secondary text-white">Change Password</button>
                            </center>
                        </span>
                    </form>
                </div>
            </div>
        
        </div>
    </div>
    

        <!-- User Password Modal -->
        <div class="container container-fluid">
        	<div class="modal fade" id="passwordmodal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            	<div class="modal-dialog">
                	<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Change Password</h5></h5>
							<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
					</div>
                    <form action="managedata.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="adminid" value="<?php echo $adminid?>">

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control text-center" value="<?php echo $password?>" id="password">
                            </div>
                            <div>
                                <center><input type="checkbox" onclick="myFunction()"> Show Password</center>
							</div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <button type="submit" name="update_password" class="btn btn-success">Update</button>
                        </div>                     
                    </form>
                </div>
            </div>
        </div>
        <!--END OF Password MODAL-->

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
<?php
    }    
    else
	{
		header("location: ../../signin/universal-signin.php");
	}   
?>
</body>
</html>