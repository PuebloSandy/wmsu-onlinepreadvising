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
    <title>Submit Grade</title>
</head>
<style>
    #picture{
        width: 500px;
    }
    
    @media (max-width: 1000px) {
        #left{
            display: none;
        }
        #right{
            width: 100%;
        }
    }
</style>
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
                    <li class="nav-item" data-toggle="tooltip" data-placement="bottom" title="Logout">
                        <a id="icons" class="nav-link active py-0" href="#" data-toggle="modal" data-target="#logoutmodal" aria-disabled="true"><i class="fas fa-sign-out-alt"></i><span class="nav-label"> Logout</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END OF NAVBAR -->
    
    <?php
    /*
    $getfile = mysqli_query($connection,"SELECT * FROM tblstudent_grades_sub WHERE student_id_fk='$getidstudent'");
    while($sa = mysqli_fetch_array($getfile))
    {
        $getfilename = $sa['grades_filename'];
    }  */  
    ?>

    <!-- CONTENT -->
    <div class="container container-fluid overflow-auto" id="desktop-view">
         <h2 class="text fw-bold text-center mt-4 text-danger text-uppercase" style="cursor: default;">Grades Submission</h2>
        <!-- <h4 class="text-center fw-light">via Manual Input</h4> -->

        <!-- Choices -->
        <div class="container container-fluid mt-1">
            <div class="row pt-5">
                <!--
                <div class="col-sm-6 border mb-3">
                    <h4 class="text fw-bold text-danger text-center mt-4 mb-3">Submit PDF Grades</h4>
                    <form action="managegradesubmissions.php" method="POST" enctype="multipart/form-data"></form>
                        <input type="hidden" name="studentid"> 
                        <input type="hidden" name="collegeid" value="">
                        <input type="file" name="grades_file" class="bg-light form-control mb-3" accept=".pdf" required/>
                        <span class="text-center text-secondary">Note: Send PDF files Grades first.</span>
                    
                        <?php
                        /*
                            $getadviser = mysqli_query($connection,"SELECT * FROM tbluser WHERE usertype='Adviser' and course_id_fk='$courseid' and yearlevel='$year'");
                            while($fa = mysqli_fetch_array($getadviser))
                            {
                                $getid = $fa['id'];
                                $getfirst = $fa['firstname'];
                                $getlast = $fa['lastname'];
                                $fullname = $getlast.','.$getfirst;
                            }
                            */
                        ?>
                        
                        <input type="hidden" name="adviser_name" value="" class="bg-light form-control mb-3">
                        <button type="submit" name="submit-grade" class="btn w-100 btn-danger mt-3 mb-5" >
                            <span class="float-start"><i class="fas fa-check"></i></span> Submit
                        </button>
                    </form>
                </div>-->

                <div class="col" id="left">
					<div class="col-6" >
						<img id="picture" src="../../source/assets/images/student.png" alt="rocket"/>
					</div>
				</div>

                <div class="col g-5 mb-3" id="right">
                    <form action="" method="POST">
                        <h4 class="text fw-bold text-danger text-center mt-4 mb-3" style="cursor: default;">Submit Manual Grades</h4>
                        <!-- POPUP HELP 
                        <button type="button" class="btn  btn-secondary w-100 mb-2" data-toggle="modal" data-target="#help">
                            <span class="float-start"><i class="fas fa-question"></i></span> Help
                        </button> --> 
                        <input type="hidden" name="studid" value="">
                        <button type="button" name="sub" class="btn btn-danger w-100 mb-2 p-2" onclick="location.href='student-manual-grades.php'">
                            <span class="float-start"><i class="fas fa-check"></i></span> Input Grades
                        </button>
                        <button type="button" class="btn btn-secondary w-100 mb-2 p-2" onclick="history.back()">
                            <span class="float-start"><i class="fas fa-chevron-left"></i></span> Back
                        </button>
                        <div class="mt-2 mb-3">
                            <span class="text-secondary" style="cursor: default;">Note: Manual Input Grade but you need to send a PDF File Grades too.</span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Container of Choices END-->


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
    </div>
    <!-- CONTENT END -->
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