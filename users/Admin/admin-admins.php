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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous" />
    <link rel="stylesheet" href="../../source/bootstrap/bootstrap-5.1.3-dist/css/bootstrap.min.css" />
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- DATATABLE -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.css"/>
    <!-- local css -->
    <link rel="stylesheet" href="../../source/css/style-superadmin.css" />
    
    <title>Accounts</title>
</head>
<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark" id="navbar">
        <div class="container-fluid">
            <!-- ICS LOGO -->
            <a class="navbar-brand p-0 m-0" id="nav-logo" href="superadmin-homepage.html">
                <img class="rounded-circle p-0" src="../../source/assets/images/wmsu-seal.png" alt="WMSU SEAL" width="32" height="32" />
                <span class="text-uppercase">Online Pre-Advising</span>
            </a>

            <!-- MOBILE TOGGLE -->
            <button class="navbar-toggler m-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span><i class="fas fa-bars"></i></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <!-- Profile -->
                    <!-- <li class="nav-item">
                        <a class="nav-link active py-0" aria-current="page" href="superadmin-myprofile.html"><i id="icons" class="fas fa-user-tie"></i><span class="nav-label"> My Profile</span></a>
                    </li> -->
                    <!-- Home -->
                    <li class="nav-item">
                        <a class="nav-link active py-0" aria-current="page" href="superadmin-homepage.html"><i id="icons" class="fas fa-home"></i><span class="nav-label"> Home</span></a>
                    </li>
                    <!-- logout -->
                    <li class="nav-item">
                        <a id="icons" class="nav-link active py-0" href="../../signin/universal-signin.html" aria-disabled="true"><i class="fas fa-sign-out-alt"></i><span class="nav-label"> Logout</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END OF NAVBAR -->

    <div class="container mb-1">
        <p class="text mt-3 text-danger fw-bold text-center fs-2">Colleges Accounts</p>

        <div class="dropdown">
            <button type="submit" name="search" class="fas fa-search btn btn-info p-2" title="Search"></button>
            <button class="btn btn-gray dropdown-toggle border p-2" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
              Search Colleges
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
        </div>
	</div>
    
    <!-- TABLE -->
    <div class="container p-2 container-fluid mb-3" >
        <div class="container overflow-auto" >
            <div class="row">
                <div class="col text-center">
                    <a id="tab1" class="btn my-4 border border-danger fw-bold fs-3" onclick="admintable()">Admin</a>
                </div>
                <div class="col text-center">
                    <a id="tab2" class="btn my-4 border border-danger fw-bold text-center fs-3" onclick="advisertable()">Advisers</a>
                </div>
                <div class="col text-center">
                    <a id="tab3" class="btn my-4 border border-danger fw-bold text-center fs-3" onclick="studenttable()">Students</a>
                </div>
                <div class="w-100"></div>
            </div>

            <div id="admin-table">
                <div class="mb-3" align="right">
                    <button type="button" class="btn rounded btn-success p-3 fas fa-clipboard" title="Add" id="addAdmin"> Add</button>
                    <button type="button" class="btn rounded btn-danger p-3 fas fa-trash-alt" title="Delete All" id="deleteAllAdmin"> Delete All</button>
                </div>

                <table class="table table-hover table-responsive table-striped table-bordered " id="table1">
                    <thead class="text-white">
                        <tr>
                            <th><center>Admin ID</center></th>
                            <th><center>Name</center></th>
                            <th><center>Email</center></th>
                            <th><center>Contact</center></th>
                            <th><center>Action</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><center>admin001</center></td>
                            <td><center>Juan Dela Cruz</center></td>
                            <td><center>Admin@wmsu.edu.ph</center></td>
                            <td><center>09123456789</center></td>
                            <td><center><button style="font-size: 1.3rem;" title="Edit" class="fas fa-edit btn rounded btn-success editAdminbtn"></button>
                                <button style="font-size: 1.3rem;" title="Delete" class="fas fa-trash-alt btn rounded btn-danger deleteAdminbtn"></button>
                            </center></td>
                        </tr>
                    </tbody>
                    <tfoot >	
                        <!-- table footer -->
                    </tfoot>
                </table>
            </div>

            <div id="adviser-table">
                <div class="mb-3" align="right">
                    <button type="button" class="btn rounded btn-success p-3 fas fa-clipboard" title="Add" id="addAdviser"> Add</button>
                    <button type="button" class="btn rounded btn-danger p-3 fas fa-trash-alt" title="Delete All" id="deleteAllAdviser"> Delete All</button>
                </div>

                <table class="table table-hover table-responsive table-striped table-bordered " id="table2">
                    <thead class="text-white">
                        <tr>
                            <th><center>Admin ID</center></th>
                            <th><center>Name</center></th>
                            <th><center>Email</center></th>
                            <th><center>Contact</center></th>
                            <th><center>Action</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><center>admin001</center></td>
                            <td><center>Juan Dela Cruz</center></td>
                            <td><center>Adviser@wmsu.edu.ph</center></td>
                            <td><center>09123456789</center></td>
                            <td><center><button style="font-size: 1.3rem;" title="Edit" class="fas fa-edit btn rounded btn-success editAdviserbtn"></button>
                                <button style="font-size: 1.3rem;" title="Delete" class="fas fa-trash-alt btn rounded btn-danger deleteAdviserbtn"></button>
                            </center></td>
                        </tr>
                    
                    </tbody>
                    <tfoot >	
                        <!-- table footer -->
                    </tfoot>
                </table>
            </div>

            <div id="student-table">
                <div class="mb-3" align="right">
                    <button type="button" class="btn rounded btn-success p-3 fas fa-clipboard" title="Add" id="addStudent"> Add</button>
                    <button type="button" class="btn rounded btn-danger p-3 fas fa-trash-alt" title="Delete All" id="deleteAllStudent"> Delete All</button>
                </div>

                <table class="table table-hover table-responsive table-striped table-bordered " id="table3">
                    <thead class="text-white">
                        <tr>
                            <th><center>Admin ID</center></th>
                            <th><center>Name</center></th>
                            <th><center>Email</center></th>
                            <th><center>Contact</center></th>
                            <th><center>Action</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><center>admin001</center></td>
                            <td><center>Juan Dela Cruz</center></td>
                            <td><center>student@wmsu.edu.ph</center></td>
                            <td><center>09123456789</center></td>
                            <td><center><button style="font-size: 1.3rem;" title="Edit" class="fas fa-edit btn rounded btn-success editStudentbtn"></button>
                                <button style="font-size: 1.3rem;" title="Delete" class="fas fa-trash-alt btn rounded btn-danger deleteStudentbtn"></button>
                            </center></td>
                        </tr>
                    
                    </tbody>
                    <tfoot >	
                        <!-- table footer -->
                    </tfoot>
                </table>
            </div>
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
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                        <div class="modal-body">
                    <form>
                        <!-- Inputs -->
                            <div class="mb-3">
								<label for="input-name" class="form-label">Name</label>
								<input type="text" class="form-control" id="input-name" aria-describedby="input-name-help" required>
								<!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
							</div>

							<div class="mb-3">
								<label for="input-id" class="form-label">Admin ID</label>
								<input type="text" class="form-control" id="input-id" required>
							</div>

							<div class="mb-3">
								<label for="input-pass" class="form-label">Password</label>
								<input type="password" class="form-control" id="input-pass" required>
							</div>
							
							<div class="mb-3">
								<label for="input-pass2" class="form-label">Confirm Password</label>
								<input type="password" class="form-control" id="input-pass2" required>
							</div>

                            <div class="mb-3">
								<label for="input-contact" class="form-label">Contact</label>
								<input type="number" class="form-control" id="input-contact" required>
							</div>


							<!-- Deapartment -->		
							<div class="container p-0 mb-3" id="select-college">
								<label for="select-college" class="form-label" >Assigned To</label>
								<select class="custom-select p-2 " id="select-college" required>
									<option selected>Select College Department...</option>

                                    <!-- INSERT DATABASE HERE BELOW FOR COLLEGES -->
                                    <option value="1">ICS</option>
                                    <option value="2">CLA</option>
                                
								</select>			
							</div>		
                        </div>

                        <div class="modal-footer" align="right">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Confirm</button>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="" method="POST">
                        <center>
                            <div class="modal-body">
                                All data will be deleted! 
                                Are you sure you want to delete All Admin?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                <button type="submit" name="delete_all_user" class="btn btn-success">Yes</button>
                            </div>                     
                        </center>
                    </form>
                </div>
            </div>
        </div>
    <!--END OF DELETE All Admin Modal -->

    <!-- COLLEGE MANAGE -->
    <div class="modal fade" id="editAdminModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="manage-curriculum" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="manage-curriculum">Manage Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                <form>
                    <!-- Inputs -->
                    <div class="mb-3">
                        <label for="input-name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="input-name" aria-describedby="input-name-help" required>
                        <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>

                    <div class="mb-3">
                        <label for="input-id" class="form-label">Admin ID</label>
                        <input type="text" class="form-control" id="input-id" required>
                    </div>

                    <div class="mb-3">
                        <label for="input-pass" class="form-label">Password</label>
                        <input type="password" class="form-control" id="input-pass" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="input-pass2" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="input-pass2" required>
                    </div>

                    <div class="mb-3">
                        <label for="input-contact" class="form-label">Contact</label>
                        <input type="number" class="form-control" id="input-contact" required>
                    </div>


                    <!-- Deapartment -->		
                    <div class="container p-0 mb-3" id="select-college">
                        <label for="select-college" class="form-label" >Assigned To</label>
                        <select class="custom-select p-2 " id="select-college" required>
                            <option selected>Select College Department...</option>

                            <!-- INSERT DATABASE HERE BELOW FOR COLLEGES -->
                            <option value="1">ICS</option>
                            <option value="2">CLA</option>
                        
                        </select>			
                    </div>		
                </div>

                <div class="modal-footer" align="right">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
                </form>    
            </div>
        </div>
    </div>
    <!-- MANAGE COLLEGE END -->

    <!-- DELETE Admin MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteAdminModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Delete This Admin</h5></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="" method="POST">
                        <center>
                            <input type="hidden" name="id" id="deleteid">

                            <div class="modal-body">
                                All data will be deleted! 
                                Are you sure you want to delete this Admin?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                <button type="submit" name="delete_user" class="btn btn-success">Yes</button>
                            </div>                     
                        </center>
                    </form>
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
                    <form>
                        <!-- Inputs -->
                            <div class="mb-3">
								<label for="input-name" class="form-label">Name</label>
								<input type="text" class="form-control" id="input-name" aria-describedby="input-name-help" required>
								<!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
							</div>

							<div class="mb-3">
								<label for="input-id" class="form-label">Adviser ID</label>
								<input type="text" class="form-control" id="input-id" required>
							</div>

							<div class="mb-3">
								<label for="input-pass" class="form-label">Password</label>
								<input type="password" class="form-control" id="input-pass" required>
							</div>
							
							<div class="mb-3">
								<label for="input-pass2" class="form-label">Confirm Password</label>
								<input type="password" class="form-control" id="input-pass2" required>
							</div>

                            <div class="mb-3">
								<label for="input-contact" class="form-label">Contact</label>
								<input type="number" class="form-control" id="input-contact" required>
							</div>


							<!-- Deapartment -->		
							<div class="container p-0 mb-3" id="select-college">
								<label for="select-college" class="form-label" >Assigned To</label>
								<select class="custom-select p-2 " id="select-college" required>
									<option selected>Select College Department...</option>

                                    <!-- INSERT DATABASE HERE BELOW FOR COLLEGES -->
                                    <option value="1">ICS</option>
                                    <option value="2">CLA</option>
                                
								</select>			
							</div>		
                        </div>

                        <div class="modal-footer" align="right">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Confirm</button>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="" method="POST">
                        <center>
                            <div class="modal-body">
                                All data will be deleted! 
                                Are you sure you want to delete All Adviser?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                <button type="submit" name="delete_all_user" class="btn btn-success">Yes</button>
                            </div>                     
                        </center>
                    </form>
                </div>
            </div>
        </div>
    <!--END OF DELETE All Adviser Modal -->

    <!-- COLLEGE MANAGE -->
    <div class="modal fade" id="editAdviserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="manage-curriculum" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="manage-curriculum">Manage Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                <form>
                    <!-- Inputs -->
                    <div class="mb-3">
                        <label for="input-name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="input-name" aria-describedby="input-name-help" required>
                        <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>

                    <div class="mb-3">
                        <label for="input-id" class="form-label">Adviser ID</label>
                        <input type="text" class="form-control" id="input-id" required>
                    </div>

                    <div class="mb-3">
                        <label for="input-pass" class="form-label">Password</label>
                        <input type="password" class="form-control" id="input-pass" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="input-pass2" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="input-pass2" required>
                    </div>

                    <div class="mb-3">
                        <label for="input-contact" class="form-label">Contact</label>
                        <input type="number" class="form-control" id="input-contact" required>
                    </div>


                    <!-- Deapartment -->		
                    <div class="container p-0 mb-3" id="select-college">
                        <label for="select-college" class="form-label" >Assigned To</label>
                        <select class="custom-select p-2 " id="select-college" required>
                            <option selected>Select College Department...</option>

                            <!-- INSERT DATABASE HERE BELOW FOR COLLEGES -->
                            <option value="1">ICS</option>
                            <option value="2">CLA</option>
                        
                        </select>			
                    </div>		
                </div>

                <div class="modal-footer" align="right">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
                </form>    
            </div>
        </div>
    </div>
    <!-- MANAGE COLLEGE END -->

    <!-- DELETE Adviser MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteAdviserModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Delete This Adviser</h5></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="" method="POST">
                        <center>
                            <input type="hidden" name="id" id="deleteid">

                            <div class="modal-body">
                                All data will be deleted! 
                                Are you sure you want to delete this Adviser?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                <button type="submit" name="delete_user" class="btn btn-success">Yes</button>
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
                    <form>
                        <!-- Inputs -->
                            <div class="mb-3">
								<label for="input-name" class="form-label">Name</label>
								<input type="text" class="form-control" id="input-name" aria-describedby="input-name-help" required>
								<!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
							</div>

							<div class="mb-3">
								<label for="input-id" class="form-label">Student ID</label>
								<input type="text" class="form-control" id="input-id" required>
							</div>

							<div class="mb-3">
								<label for="input-pass" class="form-label">Password</label>
								<input type="password" class="form-control" id="input-pass" required>
							</div>
							
							<div class="mb-3">
								<label for="input-pass2" class="form-label">Confirm Password</label>
								<input type="password" class="form-control" id="input-pass2" required>
							</div>

                            <div class="mb-3">
								<label for="input-contact" class="form-label">Contact</label>
								<input type="number" class="form-control" id="input-contact" required>
							</div>


							<!-- Deapartment -->		
							<div class="container p-0 mb-3" id="select-college">
								<label for="select-college" class="form-label" >Assigned To</label>
								<select class="custom-select p-2 " id="select-college" required>
									<option selected>Select College Department...</option>

                                    <!-- INSERT DATABASE HERE BELOW FOR COLLEGES -->
                                    <option value="1">ICS</option>
                                    <option value="2">CLA</option>
                                
								</select>			
							</div>		
                        </div>

                        <div class="modal-footer" align="right">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Confirm</button>
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
                    <form action="" method="POST">
                        <center>
                            <div class="modal-body">
                                All data will be deleted! 
                                Are you sure you want to delete All Student?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                <button type="submit" name="delete_all_user" class="btn btn-success">Yes</button>
                            </div>                     
                        </center>
                    </form>
                </div>
            </div>
        </div>
    <!--END OF DELETE All Student Modal -->

    <!-- COLLEGE MANAGE -->
    <div class="modal fade" id="editStudentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="manage-curriculum" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="manage-curriculum">Manage Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                <form>
                    <!-- Inputs -->
                    <div class="mb-3">
                        <label for="input-name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="input-name" aria-describedby="input-name-help" required>
                        <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>

                    <div class="mb-3">
                        <label for="input-id" class="form-label">Student ID</label>
                        <input type="text" class="form-control" id="input-id" required>
                    </div>

                    <div class="mb-3">
                        <label for="input-pass" class="form-label">Password</label>
                        <input type="password" class="form-control" id="input-pass" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="input-pass2" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="input-pass2" required>
                    </div>

                    <div class="mb-3">
                        <label for="input-contact" class="form-label">Contact</label>
                        <input type="number" class="form-control" id="input-contact" required>
                    </div>


                    <!-- Deapartment -->		
                    <div class="container p-0 mb-3" id="select-college">
                        <label for="select-college" class="form-label" >Assigned To</label>
                        <select class="custom-select p-2 " id="select-college" required>
                            <option selected>Select College Department...</option>

                            <!-- INSERT DATABASE HERE BELOW FOR COLLEGES -->
                            <option value="1">ICS</option>
                            <option value="2">CLA</option>
                        
                        </select>			
                    </div>		
                </div>

                <div class="modal-footer" align="right">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
                </form>    
            </div>
        </div>
    </div>
    <!-- MANAGE COLLEGE END -->

    <!-- DELETE Student MODAL-->
    <div class="container container-fluid">
        <div class="modal fade" id="deleteStudentModal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Delete This Student</h5></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="" method="POST">
                        <center>
                            <input type="hidden" name="id" id="deleteid">

                            <div class="modal-body">
                                All data will be deleted! 
                                Are you sure you want to delete this Student?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                <button type="submit" name="delete_user" class="btn btn-success">Yes</button>
                            </div>                     
                        </center>
                    </form>
                </div>
            </div>
        </div>
    <!--END OF DELETE Student MODAL-->
    <!-- End of Student Accounts -->


    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"
      integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"
      integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj"
      crossorigin="anonymous"
    ></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.js"></script>

    <script>
        function admintable(){
            document.getElementById('admin-table').style.display='block'; 
            document.getElementById('adviser-table').style.display='none'; 
            document.getElementById('student-table').style.display='none'; 

            document.getElementById('tab1').style.color = 'white'; 
            document.getElementById('tab2').style.color = 'red'; 
            document.getElementById('tab3').style.color = 'red'; 

            document.getElementById('tab1').style.backgroundColor = 'red'; 
            document.getElementById('tab2').style.backgroundColor = 'white'; 
            document.getElementById('tab3').style.backgroundColor = 'white'; 

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

                $('#userid').val(data[0]);
                $('#fname').val(data[1]);
                $('#lname').val(data[2]);
                $('#con').val(data[3]);
                $('#gen').val(data[4]);
                $('#user').val(data[5]);
                $('#pass').val(data[6]);
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
                $('#deleteid').val(data[0]);
            });
            });
        }

        function advisertable(){
            document.getElementById('admin-table').style.display='none'; 
            document.getElementById('adviser-table').style.display='block'; 
            document.getElementById('student-table').style.display='none'; 

            document.getElementById('tab1').style.color = 'red'; 
            document.getElementById('tab2').style.color = 'white'; 
            document.getElementById('tab3').style.color = 'red'; 

            document.getElementById('tab1').style.backgroundColor = 'white'; 
            document.getElementById('tab2').style.backgroundColor = 'red'; 
            document.getElementById('tab3').style.backgroundColor = 'white'; 

            $('#table2').DataTable();

            $('#addAdviser').on('click', function() {
                $('#addAdviserModal').modal('show');
            });

            $('#deleteAllAdviser').on('click', function() {
                $('#deleteAllAdviserModal').modal('show');
            });

            $(document).ready(function() {
            $('body').on('click','.editAdviserbtn',function() {
                $('#editAdviserModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#userid').val(data[0]);
                $('#fname').val(data[1]);
                $('#lname').val(data[2]);
                $('#con').val(data[3]);
                $('#gen').val(data[4]);
                $('#user').val(data[5]);
                $('#pass').val(data[6]);
            });
            });

            $(document).ready(function() {
            $('body').on('click','.deleteAdviserbtn',function() {
                $('#deleteAdviserModal').modal('show');
    
                $tr = $(this).closest('tr');
    
                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();
    
                console.log(data);
                $('#deleteid').val(data[0]);
            });
            });
        }

        function studenttable(){
            document.getElementById('admin-table').style.display='none'; 
            document.getElementById('adviser-table').style.display='none'; 
            document.getElementById('student-table').style.display='block'; 

            document.getElementById('tab1').style.color = 'red'; 
            document.getElementById('tab2').style.color = 'red'; 
            document.getElementById('tab3').style.color = 'white'; 

            document.getElementById('tab1').style.backgroundColor = 'white'; 
            document.getElementById('tab2').style.backgroundColor = 'white'; 
            document.getElementById('tab3').style.backgroundColor = 'red'; 

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

                $('#userid').val(data[0]);
                $('#fname').val(data[1]);
                $('#lname').val(data[2]);
                $('#con').val(data[3]);
                $('#gen').val(data[4]);
                $('#user').val(data[5]);
                $('#pass').val(data[6]);
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
                $('#deleteid').val(data[0]);
            });
            });
        }
    </script>

</body>
</html>