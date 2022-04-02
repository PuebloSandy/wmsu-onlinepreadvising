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
		<link rel="stylesheet" href="../../source/css/style-superadmin.css" />
        <link rel="stylesheet" href="../../source/preloader/loader.css" />
		<title>School Year</title>
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

            <!-- TAB -->
            <div class="container">
                <div class="row">
                    <div class="col text-center text-danger fw-bold fs-2 mt-4">
                       <span>School Year</span>
                    </div>
                    <div class="w-100"></div>
                </div>
            </div>
            <!-- TAB END -->

			<!-- CONTENT -->
			<div class="container container-fluid mt-3">
				<div class="row">
                    <div class="mb-3" align="right">
                        <button type="button" class="btn rounded btn-success p-2 fas fa-clipboard" id="myBtnAdd"> Add</button>
                        <button type="button" class="btn rounded btn-danger p-2 fas fa-trash-alt" id="myBtnDelAll"> Delete All</button>
                    </div>
                    <?php
                        $check_school = mysqli_query($connection,"SELECT * FROM tblschool_year");
                    ?>

                    <table class="table table-striped" id="table" width="100%">
                        <thead class="bg-danger text-white">
                        <tr>
                            <th hidden>id</th>
                            <th width="35%"><center>School Year</center></th>
                            <th hidden><center>From</center></th>
                            <th hidden><center>To</center></th>
                            <th ><center>Status</center></th>
                            <th ><center>Action</center></th>
                        </tr>
                        </thead>
                        <tbody>
                    <?php
                        if(mysqli_num_rows($check_school) > 0)
                        {
                            while($fa = mysqli_fetch_array($check_school))
                            {
                                $SYJoin = $fa['school_year'];
                                $split = explode("-",$SYJoin,2);
                                $SYFrom = $split[0];
                                $SYTo = $split[1];
                                $status = $fa['status'];
                    ?>
                            <tr>
                                <td hidden><center><?php echo $fa['id']; ?></center></td>
                                <td><center><?php echo $fa['school_year']; ?></center></td>
                                <td hidden><center><?php echo $SYFrom; ?></center></td>
                                <td hidden><center><?php echo $SYTo; ?></center></td>
                                <td><center>
                    <?php
                                if($status == "Activated")
                                {
                    ?>
                                <form action="managedata.php" method="POST">
                                    <input type="hidden" name="schoolid" value="<?php echo $fa['id'] ?>">
                                    <button type="submit" name="deactivated" class="btn btn-success"><?php echo $fa['status']; ?></button>
                                </form>
                    <?php 
                                }
                                else if($status == "Deactivated")
                                {
                    ?>
                                <form action="managedata.php" method="POST">
                                    <input type="hidden" name="schoolid" value="<?php echo $fa['id'] ?>">
                                    <button type="submit" name="activated" class="btn btn-danger"><?php echo $fa['status']; ?></button>
                                </form>
                    <?php 
                                }
                    ?>
                                </center></td>
                                <td><center>
                                    <button class="btn btn-white" type="button" title="More Option" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="cursor: pointer;">
                                        <a class="dropdown-item editbtn" title="Edit">Edit</a>
                                        <a class="dropdown-item deletebtn" title="Delete" >Delete</a>
                                    </div>
                                    <!--<button style="font-size: 1.3rem;" title="Edit" class="fas fa-edit btn rounded btn-success editFirstubject1stbtn"></button>
                                    <button style="font-size: 1.3rem;" title="Delete" class="fas fa-trash-alt btn rounded btn-danger deleteFirstSubject1stbtn"></button>-->
                                </center></td>
                            </tr>
                    <?php
                            }
                        }
                        else
                        {
                            echo'
                            <tr>
                                <td hidden></td>
                                <td></td>
                                <td hidden></td>
                                <td hidden></td>
                                <td><center>No Data Found</center></td>
                                <td></td>
                            </tr>
                                ';
                        }
                    ?>               
                        </tbody>
                    </table>
				</div>
			</div>

    <!-- Update School Year Status Activated MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="updateStatusActModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width: 15rem;">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h5 class="modal-title" id="exampleModalLabel">Update Status</h5>
                    </div>
                    <form action="managedata.php" method="POST">
                        <center>
                            <div class="modal-body">
                                <input type="hidden" name="schoolid" id="SchoolID">
                                <button type="submit" name="activated" class="btn btn-success">Activated</button>
                            </div>    
                            <div class="modal-footer"></div>
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--END OF Update School Year Status Activated Modal -->

    <!-- Update School Year Status Deactivated MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="updateStatusDeactModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width: 15rem;">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h5 class="modal-title" id="exampleModalLabel">Update Status</h5>
                    </div>
                    <form action="managedata.php" method="POST">
                        <center>
                            <div class="modal-body">
                                <input type="hidden" name="schoolid" id="SchoolIDdea">
                                <button type="submit" name="deactivated" class="btn btn-danger">Deactivated</button>
                            </div>    
                            <div class="modal-footer"></div>
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--END OF Update School Year Status Deactivated Modal -->

	<!-- ADD NEW School Year POPUP -->
    <div class="container container-fluid">
        <div class="modal fade" id="addmodal" tabindex="-1" aria-labelledby="addDepLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="addDepLabel">Add School Year</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="managedata.php" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                        <!-- Inputs -->
                            <div class="row mb-3">
								<p class="text-uppercase mb-0">Effectivity</p>
								<div class="col">
									<input type="number" name="SYfrom" class="form-control" placeholder="From" id="inputLec" required>
								</div>
								<div class="col">
									<input type="number" name="SYto" class="form-control" placeholder="To" id="inputLab" required>
								</div>
                                <div class="text-secondary mt-2 ml-2">
                                    <span>Example: 2018-2019</span>
                                </div>
							</div>
                        </div>
                        
                        <div class="modal-footer" align="right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" name="add_schoolYear" class="btn btn-success">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ADD NEW School Year END -->

    <!-- DELETE All School Year MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteallmodal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete All School Year</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="managedata.php" method="POST">
                        <center>
                            <div class="modal-body">
                                All data will be deleted! 
                                Are you sure you want to delete All School Year?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                <button type="submit" name="delete_all_school_year" class="btn btn-success">Yes</button>
                            </div>                     
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--END OF DELETE All School Year Modal -->

    <!-- School Year MANAGE -->
    <div class="modal fade" id="editmodal" data-bs-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="manage-curriculum" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="manage-curriculum">Manage School Year</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="managedata.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                    <!-- Inputs -->
                        <input type="hidden" name="schoolid" id="scholid">
                        <div class="row mb-3">
							<p class="text-uppercase mb-0">Effectivity</p>
							<div class="col">
								<input type="number" name="SYFROM" class="form-control" placeholder="From" id="SYFrom" required>
							</div>
							<div class="col">
								<input type="number" name="SYTO" class="form-control" placeholder="To" id="SYTo" required>
							</div>
                            <div class="text-secondary mt-2 ml-2">
                                <span>Example: 2018-2019</span>
                            </div>
						</div>       
                    </div>

                    <div class="modal-footer" align="right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="update_single_school_year" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- MANAGE School Year END -->

     <!-- DELETE School Year MODAL-->
     <div class="container container-fluid">
        <div class="modal fade" id="deletemodal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Delete This School Year</h5></h5>
                  <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="managedata.php" method="POST">
                        <center>
                            <input type="hidden" name="schoolID" id="SchoolSingleID">
                            <div class="modal-body">
                                All data will be deleted! 
                                Are you sure you want to delete this School Year?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                <button type="submit" name="delete_single_school_year" class="btn btn-success">Yes</button>
                            </div>                     
                        </center>
                    </form>
                </div>
            </div>
        </div>
    <!--END OF DELETE MODAL-->

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

        <script>
            $(document).ready(function() {
                $('#table').DataTable();
            } );

            $('#myBtnAdd').on('click', function() {
                $('#addmodal').modal('show');
            });

            $('#myBtnDelAll').on('click', function() {
                $('#deleteallmodal').modal('show');
            });

            //Edit School Year
            $(document).ready(function() {
            $('body').on('click','.editbtn',function() {
                $('#editmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#scholid').val(data[0]);
                $('#school_year').val(data[1]);
                $('#SYFrom').val(data[2]);
                $('#SYTo').val(data[3]);
                $('#status').val(data[4]);
            });
            });

            //Delete school year
            $(document).ready(function() {
            $('body').on('click','.deletebtn',function() {
                $('#deletemodal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#SchoolSingleID').val(data[0]);
            });
            });

            //Update deactive Status
            $(document).ready(function() {
            $('body').on('click','.updatedeactivebtn',function() {
                $('#updateStatusActModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#SchoolID').val(data[0]);
            });
            });

            //Update active Status
            $(document).ready(function() {
            $('body').on('click','.updateactivebtn',function() {
                $('#updateStatusDeactModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#SchoolIDdea').val(data[0]);
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
