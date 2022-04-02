<?php
    session_start();
    include "../../source/includes/config.php";

	$usertype = "Student";
    $username = $_SESSION['login_user'];
    $sql = "SELECT * usertype='Student' FROM tbluser";
    $result = mysqli_query($connection,$sql);

    $get_user = mysqli_query($connection,"SELECT * FROM tbluser WHERE email='$username'");
    while($getuser=mysqli_fetch_array($get_user))
    {
        $studentid = $getuser['id'];
        $firstname = $getuser['firstname'];
        $lastname = $getuser['lastname'];
        $fullname = ucfirst($firstname).' '.ucfirst($lastname);
		$collegeid = $getuser['college_id_fk'];
		$courseid = $getuser['course_id_fk'];
		$year = $getuser['yearlevel'];
		$section = $getuser['section'];
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
		<link rel="stylesheet" href="../../source/css/style-student.css" />
		<title>Home</title>
	</head>
	<body>
		<!-- NAVBAR -->
		<nav class="navbar navbar-expand-lg navbar-dark sticky-top" id="navbar">
			<div class="container-fluid">
				<!-- COLLEGE LOGO/SEAL -->
				<a class="navbar-brand p-0 m-0" id="nav-logo" style="cursor: default;">
					<img class="rounded-circle p-0" src="../../source/upload/college_seal/<?php echo $seal?>" alt="ICS SEAL" width="32" height="32" />
					<span class="text-uppercase text-light">Online Pre-Advising</span>
				</a>

				<!-- MOBILE TOGGLE -->
				<button class="navbar-toggler m-0" type="button" data-toggle="collapse"data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span><i class="fas fa-bars"></i></span></button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav">
						<!-- Help -->
						<li class="nav-item" data-toggle="tooltip" data-placement="bottom" title="Help">
							<a id="icons" class="nav-link active py-0" href="#" data-toggle="modal" data-target="#help" aria-disabled="true"><i class="fas fa-question"></i><span class="nav-label"> Help</span></a>
						</li>
						<!-- logout -->
						<li class="nav-item">
							<a id="icons" class="nav-link active py-0" href="#" data-toggle="modal" data-target="#logoutmodal" aria-disabled="true"><i class="fas fa-sign-out-alt"></i><span class="nav-label"> Logout</span></a>
						</li>
					</ul>
				</div>
			</div>
		</nav>

		<!-- HELP POPUP -->
        <div class="modal fade" id="help" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="exampleModalLabel">Help <p class="badge  bg-info rounded-circle">?</p></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <p>Download your grades from WMSU portal .<br> <br>
                            Not downloaded yet?<br>
                        <a href="#" onclick="site()">Check your grades from the WMSU Portal</a></p>
                    </div>

                    <script>
                        function site(){
                            window.open('http://wmsu.edu.ph/');
                        }
                    </script>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>     
                </div>
            </div>
        </div>
        <!-- HELP POPUP END -->
		
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
                            <input type="hidden" name="id" id="deleteid" value="<?php echo $studentid?>">

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
		<!-- END OF NAVBAR -->

		<!-- CURRICULUM POPUP -->
		<!-- <div class="modal fade" id="curriculum" tabindex="-1" aria-labelledby="curriculumLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="curriculumLabel">View Curriculum</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<a href="../../curriculum/CS-Prospectus.pdf" target="_blank" class="btn btn-danger w-100 my-2">BSCS</a>
						<a href="../../curriculum/IT-Prospectus.pdf" target="_blank" class="btn btn-danger w-100 my-2">BSIT</a>
					</div>
				</div>
			</div>
		</div> -->
		<!-- CURRICULUM POPUP END -->

        <!-- Profile -->
		<div class="container">
            <center>
                <img id="avatar-student" src="../../source/assets/images/avatar-student.svg" class="text mt-3" alt="avatar" />
			    <p class="text mt-3 text-danger fw-bold text-center fs-2" style="cursor: default;">Hello, <?php echo $fullname ?><span class="text-dark">
				</span></p>
            </center>
		</div>
        <!-- profile -->

        <!-- PROGRESS BAR -->
		<div class="container container-fluid" id="container-progress">
            <!-- CIRCLE -->
            <span class="dot start text float-start" id="active"></span> <!-- CIRCLE 1 -->
            <span class="dot center" ></span>           <!-- CIRCLE 2 -->
            <span class="dot end text float-end" ></span>         <!-- CIRCLE 3 -->

			<div class="progress mx-auto" id="progressbar" style="height: 5px">
				<div class="progress-bar progress-bar-striped " role="progressbar" id="progress-no-anim" style="width: 0%"></div>
            </div>
            
           	<!-- DESCRIPTION -->
		   	<span class="title first text float-start" id="active-title" style="cursor: default;">Start</span> 
            <span class="title second text fw-bold" style="cursor: default;">Submit Grades</span>         
            <span class="title third text float-end fw-bold" style="cursor: default;">Finish</span>       
       

		</div>
        <!-- PROGRESS BAR -->
		<br> <br>

		<!-- FEEDBACK -->
        <center>
            <div class="contaier container-fluid" >
                <p class="text bg-light w-75 p-5" id="feedback" style="cursor: default;">Submit your grades to generate your subjects. Click the <span><a class="fw-bold text-uppercase">Grades</a> </span>  button below.</p>
            </div>
        </center>
        <!-- FEEDBACK END -->
 
        <!-- BUTTONS -->
        <div class="container fixed-bottom text-center mt-3 mb-4">
			<a class="btn btn-danger text-white ms-1" href="student-grade-input.php">Grades</a>
            
        </div>
		<!-- BUTTONS END -->

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
	</body>
</html>
