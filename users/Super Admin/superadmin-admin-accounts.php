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
    <title>Accounts</title>
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
	<div class="desktop">
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

        <div class="container mb-1">
            <p class="text mt-3 text-danger fw-bold text-center fs-2">Colleges Accounts</p>
        </div>

        <!-- TABLE -->
        <div class="container p-2 container-fluid border mb-3">
            <div class="container overflow-auto" >
                <div class="row border mt-2">
                    <div class="col text-center">
                        <a href="superadmin-admin-accounts.php" id="tab1" class="btn btn-danger my-4 text-white fw-bold fs-3">Admin</a>
                    </div>
                    <div class="col text-center">
                        <a href="superadmin-adviser-accounts.php" id="tab2" class="btn my-4 border border-danger fw-bold text-center text-danger fs-3">Advisers</a>
                    </div>
                    <!-- Student Button View Account
                    <div class="col text-center">
                        <a id="tab3" class="btn my-4 border border-danger fw-bold text-center fs-3" onclick="studenttable()">Students</a>
                    </div> -->
                    <div class="w-100"></div>
                </div>

                <div class="mt-2" id="admin-table">
                    <div class="mb-3" align="right">
                        <button type="button" class="btn rounded btn-success p-2 fas fa-clipboard" title="Add" id="addAdmin"> Add</button>
            <?php
                $get_admin = mysqli_query($connection,"SELECT * FROM tbluser WHERE usertype='Admin' and status='1'");
                if(mysqli_num_rows($get_admin) > 0)
                {
            ?>
                    <button type="button" class="btn rounded btn-danger p-2 fas fa-trash-alt" title="Delete All" id="deleteAllAdmin"> Delete All</button>
            <?php
                }
            ?>
                    </div>
            <?php
                $search_admin = mysqli_query($connection,"SELECT * FROM tbluser WHERE usertype='Admin' and status='1'");
            ?>
                    <table class="table table-striped" id="table1" width="100%">
                        <thead class="text-white">
                            <tr>
                                <th hidden><center>Admin ID</center></th>
                                <th><center>Firstname</center></th>
                                <th><center>Lastname</center></th>
                                <th><center>Email</center></th>
                                <th><center>Contact</center></th>
                                <th><center>Colege</center></th>
                                <th hidden><center>Password</center></th>
                                <th hidden><center>collegeid</center></th>
                                <th><center>Action</center></th>
                            </tr>
                        </thead>
                        <tbody>
            <?php
                if(mysqli_num_rows($search_admin) > 0)
                {
                    while($fa = mysqli_fetch_array($search_admin))
                    {
                        $col_id = $fa['college_id_fk'];
                        $get_col = mysqli_query($connection,"SELECT * FROM tblcollege WHERE id='$col_id'");
                        while($col = mysqli_fetch_array($get_col))
                        {
                            $collegeName = $col['college'];
                        }
            ?>
                    <tr>
                        <td hidden><center><?php echo $fa['id'] ?></center></td>
                        <td><center><?php echo ucfirst($fa['firstname']); ?></center></td>
                        <td><center><?php echo ucfirst($fa['lastname']); ?></center></td>
                        <td><center><?php echo $fa['email']?></center></td>
                        <td><center><?php echo $fa['contact']?></center></td>
                        <td><center><?php echo $collegeName?></center></td>
                        <td hidden><center><?php echo $fa['password']?></center></td>
                        <td hidden><center><?php echo $col_id?></center></td>
                        <td><center><button style="font-size: 1.3rem;" title="Edit" class="fas fa-edit btn rounded btn-success editAdminbtn"></button>
                            <button style="font-size: 1.3rem;" title="Delete" class="fas fa-trash-alt btn rounded btn-danger deleteAdminbtn"></button>
                        </center></td>
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
                <!-- Student Table Account 
                <div id="student-table">
                    <div class="mb-3" align="right">
                        <button type="button" class="btn rounded btn-success p-2 fas fa-clipboard" title="Add" id="addStudent"> Add</button>
                        <button type="button" class="btn rounded btn-danger p-2 fas fa-trash-alt" title="Delete All" id="deleteAllStudent"> Delete All</button>
                    </div>
            <?php
                $check_student = mysqli_query($connection,"SELECT * FROM tbluser WHERE usertype='Student'");
            ?>
                    <table class="table table-striped" id="table3" width="100%">
                        <thead class="text-white">
                            <tr>
                                <th hidden><center>Students ID</center></th>
                                <th><center>Firstname</center></th>
                                <th><center>Lastname</center></th>
                                <th><center>Email</center></th>
                                <th><center>Contact</center></th>
                                <th hidden><center>Collegeid</center></th>
                                <th hidden><center>Password</center></th>
                                <th hidden><center>Courseid</center></th>
                                <th><center>Action</center></th>
                            </tr>
                        </thead>
                        <tbody>
            <?php
                if(mysqli_num_rows($check_student) > 0)
                {
                    while($fa = mysqli_fetch_array($check_student))
                    {
                        $studentid = $fa['id'];
                        $col_id = $fa['college_id_fk'];
                        $cour_id = $fa['course_id_fk'];

                        $get_col = mysqli_query($connection,"SELECT * FROM tblcollege WHERE id='$col_id'");
                        while($col = mysqli_fetch_array($get_col))
                        {
                            $collegeName = $col['college'];
                        }

                        $get_cour = mysqli_query($connection,"SELECT * FROM tblcourse WHERE id='$cour_id'");
                        while($cour = mysqli_fetch_array($get_cour))
                        {
                            $courseName = $cour['course'];
                        }
            ?>
                    <tr>
                        <td hidden><center><?php echo $studentid ?></center></td>
                        <td><center><?php echo ucfirst($fa['firstname']); ?></center></td>
                        <td><center><?php echo ucfirst($fa['lastname']); ?></center></td>
                        <td><center><?php echo $fa['email']?></center></td>
                        <td><center><?php echo $fa['contact']?></center></td>
                        <td hidden><center><?php echo $collegeName?></center></td>
                        <td hidden><center><?php echo $fa['password']?></center></td>
                        <td hidden><center><?php echo $courseName?></center></td>
                        <td><center><button style="font-size: 1.3rem;" title="Edit" class="fas fa-edit btn rounded btn-success editStudentbtn"></button>
                            <button style="font-size: 1.3rem;" title="Delete" class="fas fa-trash-alt btn rounded btn-danger deleteStudentbtn"></button>
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
                        <td></td>
                        <td><center>No Data Found</center></td>
                        <td></td>
                        <td hidden></td>
                        <td hidden></td>
                        <td hidden></td>
                        <td></td>
                    </tr>
                        ';
                }
            ?>
                        </tbody>
                        <tfoot >	
                        </tfoot>
                    </table>
                </div>-->
            </div>
            
        </div>


    <!-- For Admin Accounts -->
        <!-- ADD NEW Admin POPUP -->
        <div class="container container-fluid">
            <div class="modal fade" id="addAdminModal" tabindex="-1" role="dialog" aria-labelledby="addDepLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold" id="addDepLabel">Add New Admin</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>

                            <div class="modal-body">
                        <form action="managedata.php" method="POST">
                            <!-- Inputs -->
                                <div class="form-group">
                                    <label>Firstname</label>
                                    <input type="text" name="firstname" class="form-control text-center" placeholder="Enter Firstname" required>
                                </div>

                                <div class="form-group">
                                    <label>Lastname</label>
                                    <input type="text" name="lastname" class="form-control text-center" placeholder="Enter Lastname" required>
                                </div>  

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control text-center" placeholder="e.g. bg201802824@wmsu.edu.ph" required>
                                </div>  

                                <!-- Deapartment -->		
                                <div class="container p-0 mb-3" id="select-college">
                                    <label for="select-college" class="form-label" >Assigned To</label>
                                    <select class="custom-select p-2 text-center" name="college" id="select-college" required>
                                        <option selected>Select College Department...</option>
                                        <!-- INSERT DATABASE HERE BELOW FOR COLLEGES -->
                                        <?php
                                            $query_run =mysqli_query($connection,"SELECT * from tblcollege WHERE admin_exist='0'");
                                            if(mysqli_num_rows($query_run) > 0){
                                                while($fa= mysqli_fetch_array($query_run)){
                                                    echo "<option value=".$fa['id'].">".$fa['college']."</option>";
                                                }
                                            }
                                        ?>
                                    </select>			
                                </div>		
                            </div>

                            <div class="modal-footer" align="right">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" name="addAdmin" class="btn btn-success">Confirm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ADD NEW admin END -->

        <!-- DELETE All Admin MODAL-->
        <div class="container container-fluid">
            <div class="modal fade" id="deleteAllAdminModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete All Admin</h5></h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete All Admin?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_all_admin" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--END OF DELETE All Admin Modal -->

        <!--edit admin-->
        <div class="modal fade" id="editAdminModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Admin Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                
                    <div class="modal-body">
                <form action="managedata.php" method="POST">
                        <input type="hidden" name="adminids" id="adminid">
                        <div class="form-group">
                            <label>Firstname</label>
                            <input type="text" name="firstname" id="admin-firstname" class="form-control text-center" placeholder="Enter Firstname">
                        </div>
                        <div class="form-group">
                            <label>Lastname</label>
                            <input type="text" name="lastname" id="admin-lastname" class="form-control text-center" placeholder="Enter Lastname">
                        </div>  
                        <div class="form-group">
                            <label>Contact</label>
                            <input type="text" name="contact" id="admin-contact" class="form-control text-center" placeholder="Enter Contact">
                        </div> 
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" autocomplete="off"class="form-control text-center" id="admin-email" placeholder="e.g. bg201802824@wmsu.edu.ph" required/>
                        </div>
                        
                        <!-- College -->		
                        <div class="form-group">
                            <label>Assigned To</label>
                            <input type="text" class="form-control text-center" name="college" id="col" list="colleges" autocomplete="off" placeholder="Select..." required>
                            <datalist id="colleges">
                                <!-- SELECT COLLEGES FROM DATABASE  -->
                                <?php
                                    $sql2 = mysqli_query($connection, "SELECT * From tblcollege WHERE admin_exist = 0");  
                                    // Use select query 
                                    while($fa = mysqli_fetch_array($sql2))
                                    {
                                        echo "<option value='".$fa['college']."'></option>";  
                                        // displaying data in option menu
                                    }	
                                ?>                        
                            </datalist>	    
                        </div>

                        <div class="mb-3">
                            <label for="passeditadmin" class="form-label">Password</label>
                            <div class="input-group" id="show_hide_password">
                                <input type="password" name="password" id="passeditadmin" class="form-control text-center" placeholder="Enter Password">
                                <div class="input-group-append">
                                    <span class="input-group-text" style="border-top-left-radius: 0rem; border-bottom-left-radius: 0rem;" onclick="password_show_admin();">
                                        <i class="fas fa-eye" id="show_eyed"></i>
                                        <i class="fas fa-eye-slash d" id="hide_eyed" style="display: none;"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="editAdmins" class="btn btn-primary">Save</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <!--edit admin-->                    

        <!-- DELETE Admin MODAL-->
        <div class="container container-fluid">
            <div class="modal fade" id="deleteAdminModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Admin</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="admin_id" id="deleteadmindid">
                                <input type="hidden" name="collegeadminid" id="deletecollegeadminame">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Admin?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_admin" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--END OF DELETE Admin MODAL-->
    <!-- End of Admin Accounts -->

    <!-- For Adviser Accounts -->
        <!-- ADD NEW Adviser POPUP -->
        <div class="container container-fluid">
            <div class="modal fade" id="addAdviserModal" tabindex="-1" role="dialog" aria-labelledby="addDepLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold" id="addDepLabel">Add New Adviser</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                            <div class="modal-body">
                        <form action="managedata.php" method="POST">
                            <!-- Inputs -->
                                <div class="form-group">
                                    <label>Firstname</label>
                                    <input type="text" name="firstname" class="form-control text-center" placeholder="Enter Firstname" required>
                                </div>

                                <div class="form-group">
                                    <label>Lastname</label>
                                    <input type="text" name="lastname" class="form-control text-center" placeholder="Enter Lastname" required>
                                </div>  

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" class="form-control text-center" placeholder="e.g. bg201802824@wmsu.edu.ph" required>
                                    <span class="text-secondary mt-1 ml-2">Note: Only ID should be input not the @wmsu.edu.ph should be added in the input.</span>
                                </div> 

                                <!-- Deapartment -->		
                                <div class="container p-0 mb-3" id="select-college">
                                    <label for="select-college" class="form-label" >Assigned To</label>
                                    <select class="custom-select p-2 text-center" name="college" id="select-college" required>
                                        <option selected>Select College Department...</option>
                                        <!-- INSERT DATABASE HERE BELOW FOR COLLEGES -->
                                        <?php
                                            $query_run =mysqli_query($connection,"SELECT * from tblcollege");
                                            if(mysqli_num_rows($query_run) > 0){
                                                while($fa= mysqli_fetch_array($query_run)){
                                                    echo "<option value=".$fa['id'].">".$fa['college']."</option>";
                                                }
                                            }
                                        ?>
                                    </select>			
                                </div>			
                            </div>

                            <div class="modal-footer" align="right">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" name="addAdviser" class="btn btn-success">Confirm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ADD NEW adviser END -->

        <!-- DELETE All Adviser MODAL-->
        <div class="container container-fluid">
            <div class="modal fade" id="deleteAllAdviserModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete All Adviser</h5></h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete All Adviser?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_all_adviser" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        <!--END OF DELETE All Adviser Modal -->

        <!--edit adviser-->
        <div class="modal fade" id="editAdviserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Adviser Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                
                    <div class="modal-body">
                <form action="managedata.php" method="POST">
                        <input type="hidden" name="adviserid" id="adviserid">
                        <div class="form-group">
                            <label>Firstname</label>
                            <input type="text" name="firstname" id="adviser-firstname" class="form-control text-center" placeholder="Enter Firstname">
                        </div>
                        <div class="form-group">
                            <label>Lastname</label>
                            <input type="text" name="lastname" id="adviser-lastname" class="form-control text-center" placeholder="Enter Lastname">
                        </div>  
                        <div class="form-group">
                            <label>Contact</label>
                            <input type="text" name="contact" id="adviser-contact" class="form-control text-center" placeholder="Enter Contact">
                        </div> 
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" autocomplete="off"class="form-control text-center" id="adviser-email" placeholder="e.g. bg201802824@wmsu.edu.ph" required/>
                        </div>
                        
                        <!-- College -->		
                        <div class="form-group">
                            <label>Assigned To</label>
                            <input type="text" class="form-control text-center" name="college" id="adviser-col" list="colleges" autocomplete="off" placeholder="Select Department" required>
                            <datalist id="colleges">
                                <option value="0" selected>Select College Department...</option>
                                <!-- SELECT COLLEGES FROM DATABASE  -->
                                <?php
                                    $sql2 = mysqli_query($connection,"SELECT * FROM tblcollege");  
                                    // Use select query 

                                    while($fa = mysqli_fetch_array($sql2))
                                    {
                                        echo "<option value='".$fa['college']."'>'".$fa['college']."'</option>";  
                                        // displaying data in option menu
                                    }	
                                ?>                        
                            </datalist>	    
                        </div>

                        <div class="mb-3">
                            <label for="passeditadmin" class="form-label">Password</label>
                            <div class="input-group" id="show_hide_password">
                                <input type="password" name="password" id="passeditadviser" class="form-control text-center" placeholder="Enter Password">
                                <div class="input-group-append">
                                    <span class="input-group-text" style="border-top-left-radius: 0rem; border-bottom-left-radius: 0rem;" onclick="password_show_adviser_add();">
                                        <i class="fas fa-eye" id="show_eye_edit_adviser"></i>
                                        <i class="fas fa-eye-slash d_edit_adviser" id="hide_eye_edit_adviser"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="editAdviser" class="btn btn-primary">Save</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <!--edit adviser-->

        <!-- DELETE Adviser MODAL-->
        <div class="container container-fluid">
            <div class="modal fade" id="deleteAdviserModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Adviser</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="adviserid" id="deleteid">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Adviser?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_adviser" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        <!--END OF DELETE Adviser MODAL-->
    <!-- End of Adviser Accounts -->

    <!-- For Student Accounts -->
        <!-- ADD NEW Student POPUP -->
        <div class="container container-fluid">
            <div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="addDepLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold" id="addDepLabel">Add New Student</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                            <div class="modal-body">
                        <form action="managedata.php" method="POST">
                            <!-- Inputs -->
                                <div class="form-group">
                                    <label>Firstname</label>
                                    <input type="text" name="firstname" class="form-control text-center" placeholder="Enter Firstname" required>
                                </div>

                                <div class="form-group">
                                    <label>Lastname</label>
                                    <input type="text" name="lastname" class="form-control text-center" placeholder="Enter Lastname" required>
                                </div>  

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" class="form-control text-center" placeholder="e.g. bg201802824@wmsu.edu.ph" required>
                                </div> 

                                <!-- Deapartment -->		
                                <div class="container p-0 mb-3" id="select-college">
                                    <label for="select-college" class="form-label" >College</label>
                                    <select class="custom-select p-2 text-center" name="college" id="select-college" required>
                                        <option selected>Select College Department...</option>
                                        <!-- INSERT DATABASE HERE BELOW FOR COLLEGES -->
                                        <?php
                                            $query_run =mysqli_query($connection,"SELECT * from tblcollege");
                                            if(mysqli_num_rows($query_run) > 0){
                                                while($fa= mysqli_fetch_array($query_run)){
                                                    echo "<option value=".$fa['id'].">".$fa['college']."</option>";
                                                }
                                            }
                                        ?>
                                    </select>			
                                </div>

                                <!-- Course -->		
                                <div class="container p-0 mb-3" id="select-college">
                                    <label for="select-college" class="form-label" >Course</label>
                                    <select class="custom-select p-2 text-center" name="course" id="select-college" required>
                                        <option selected>Select Course...</option>
                                        <!-- INSERT DATABASE HERE BELOW FOR COLLEGES -->
                                        <?php
                                            $query_run =mysqli_query($connection,"SELECT * from tblcourse");
                                            if(mysqli_num_rows($query_run) > 0){
                                                while($fa= mysqli_fetch_array($query_run)){
                                                    echo "<option value=".$fa['id'].">".$fa['course']."</option>";
                                                }
                                            }
                                        ?>
                                    </select>			
                                </div>
                            </div>

                            <div class="modal-footer" align="right">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" name="addStudent" class="btn btn-success">Confirm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ADD NEW student END -->

        <!-- DELETE All Student MODAL-->
        <div class="container container-fluid">
            <div class="modal fade" id="deleteAllStudentModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete All Student</h5></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete All Student?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                    <button type="submit" name="delete_all_student" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--END OF DELETE All Student Modal -->

        <!--edit Student-->
        <div class="modal fade" id="editStudentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Student Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                
                    <div class="modal-body">
                <form action="managedata.php" method="POST">
                        <input type="hidden" name="studentid" id="studentid">
                        <div class="form-group">
                            <label>Firstname</label>
                            <input type="text" name="firstname" id="student-firstname" class="form-control text-center" placeholder="Enter Firstname">
                        </div>
                        <div class="form-group">
                            <label>Lastname</label>
                            <input type="text" name="lastname" id="student-lastname" class="form-control text-center" placeholder="Enter Lastname">
                        </div>  
                        <div class="form-group">
                            <label>Contact</label>
                            <input type="text" name="contact" id="student-contact" class="form-control text-center" placeholder="Enter Contact">
                        </div> 

                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" autocomplete="off"class="form-control text-center" id="student-email" placeholder="e.g. bg201802824@wmsu.edu.ph" readonly/>
                        </div>

                        <div class="mb-3">
                            <label for="passeditstudent" class="form-label">Password</label>
                            <div class="input-group" id="show_hide_password">
                                <input type="password" name="password" id="passeditstudent" class="form-control text-center" placeholder="Enter Password">
                                <div class="input-group-append">
                                    <span class="input-group-text" style="border-top-left-radius: 0rem; border-bottom-left-radius: 0rem;" onclick="password_show_edit_student();">
                                        <i class="fas fa-eye" id="show_eye_edit_student"></i>
                                        <i class="fas fa-eye-slash d_edit_student" id="hide_eye_edit_student"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- College -->		
                        <div class="form-group">
                            <label>College</label>
                            <input type="text" class="form-control text-center" name="college" id="student-col" list="colleges" autocomplete="off" placeholder="Select Department" required>
                            <datalist id="colleges">
                                <option value="0" selected>Select College Department...</option>
                                <!-- SELECT COLLEGES FROM DATABASE  -->
                                <?php
                                    $sql2 = mysqli_query($connection,"SELECT * FROM tblcollege");  
                                    // Use select query 

                                    while($fa = mysqli_fetch_array($sql2))
                                    {
                                        echo "<option value='".$fa['id']."'>'".$fa['college']."'</option>";  
                                        // displaying data in option menu
                                    }	
                                ?>                        
                            </datalist>	    
                        </div>

                        <!-- College -->		
                        <div class="form-group">
                            <label>Course</label>
                            <input type="text" class="form-control text-center" name="course" id="student-cour" list="colleges" autocomplete="off" placeholder="Select Department" required>
                            <datalist id="colleges">
                                <option value="0" selected>Select College Courses...</option>
                                <!-- SELECT COLLEGES FROM DATABASE  -->
                                <?php
                                    $sql2 = mysqli_query($connection,"SELECT * FROM tblcourse");  
                                    // Use select query 

                                    while($fa = mysqli_fetch_array($sql2))
                                    {
                                        echo "<option value='".$fa['course']."'>'".$fa['course']."'</option>";  
                                        // displaying data in option menu
                                    }	
                                ?>                        
                            </datalist>	    
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="editStudent" class="btn btn-primary">Save</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <!--edit Student-->

        <!-- DELETE Student MODAL-->
        <div class="container container-fluid">
            <div class="modal fade" id="deleteStudentModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Student</h5></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="managedata.php" method="POST">
                            <center>
                                <input type="hidden" name="studentid" id="student_id">

                                <div class="modal-body">
                                    All data will be deleted! 
                                    Are you sure you want to delete this Student?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" name="delete_student" class="btn btn-success">Yes</button>
                                </div>                     
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--END OF DELETE Student MODAL-->
    <!-- End of Student Accounts -->

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

    <script src="../../source/js/showpassword.js"></script>
    <script src="../../source/js/showpassword_admin2.js"></script>

    <script>
        function isNumberKey(evt)
        {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
            return false;
            return true;
        }  
            $('#table1').DataTable();

            $('#addAdmin').on('click', function() {
                $('#addAdminModal').modal('show');
            });

            $('#deleteAllAdmin').on('click', function() {
                $('#deleteAllAdminModal').modal('show');
            });

            $(document).ready(function() {
            $('body').on('click','.editAdminbtn',function() {
                $('#editAdminModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#adminid').val(data[0]);
                $('#admin-firstname').val(data[1]);
                $('#admin-lastname').val(data[2]);
                $('#admin-email').val(data[3]);
                $('#admin-contact').val(data[4]);
                $('#col').val(data[5]);
                $('#passeditadmin').val(data[6]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.deleteAdminbtn',function() {
                $('#deleteAdminModal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#deleteadmindid').val(data[0]);
                $('#deletecollegeadminame').val(data[7]);
            });
            });

        function studenttable(){
            //document.getElementById('admin-table').style.display='none'; 
            //document.getElementById('adviser-table').style.display='none'; 
            //getElementById('student-table').style.display='block'; 

            //document.getElementById('tab1').style.color = 'red'; 
            //document.getElementById('tab2').style.color = 'red'; 
            //document.getElementById('tab3').style.color = 'white'; 

            //document.getElementById('tab1').style.backgroundColor = 'white'; 
            //document.getElementById('tab2').style.backgroundColor = 'white'; 
            //document.getElementById('tab3').style.backgroundColor = 'red'; 

            $('#table3').DataTable();

            $('#addStudent').on('click', function() {
                $('#addStudentModal').modal('show');
            });

            $('#deleteAllStudent').on('click', function() {
                $('#deleteAllStudentModal').modal('show');
            });

            $(document).ready(function() {
            $('body').on('click','.editStudentbtn',function() {
                $('#editStudentModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#studentid').val(data[0]);
                $('#student-firstname').val(data[1]);
                $('#student-lastname').val(data[2]);
                $('#student-email').val(data[3]);
                $('#student-contact').val(data[4]);
                $('#student-col').val(data[5]);
                $('#passeditstudent').val(data[6]);
                $('#student-cour').val(data[7]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.deleteStudentbtn',function() {
                $('#deleteStudentModal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#student_id').val(data[0]);
            });
            });
        }

        function myFunction() {
            var x = document.getElementById("pass1");
            var y = document.getElementById("pass2");
            if (x.type === "password" || y.type === "password") {
                x.type = "text";
                y.type = "text";
            } else {
                x.type = "password";
                y.type = "password";
            }
        }

        function checkForm(form){
        if(form.password.value != "" && form.password.value == form.repeatpassword.value) {
            if(form.password.value.length < 8) {
                alert("Error: Password must contain at least eight characters!");
                form.password.focus();
                return false;
            }
            re = /[0-9]/;
            if(!re.test(form.password.value)) {
                alert("Error: password must contain at least number (0-9)!");
                form.password.focus();
            return false;
            }
            re = /[a-z]/;
            if(!re.test(form.password.value)) {
                alert("Error: password must contain at least lowercase letter (a-z)!");
                form.password.focus();
            return false;
            }
            re = /[A-Z]/;
            if(!re.test(form.password.value)) {
                alert("Error: password must contain at least uppercase letter (A-Z)!");
                form.password.focus();
            return false;
            }
            re = /[!@#$%^&*:;]/;
            if(!re.test(form.password.value)) {
                alert("Error: password must contain at least characters!");
                form.password.focus();
            return false;
        }
        } else {
                alert("Error: Please check that you've entered and confirmed your password!");
                form.password.focus();
            return false;
        }

        return true;
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