<!DOCTYPE html>
<html lang="en">
	<head>
		<!--Let browser know website is optimized for mobile-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<!-- Wmsu-Icon -->
		<link rel="icon" href="../../source/assets/images/wmsulogo.png">
		<!-- BOOTSTRAP -->
		<link
			href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"
			rel="stylesheet"
			integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1"
			crossorigin="anonymous"
		/>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.css" />
		<!-- OFFLINE BOOTSTRAP -->
		<link rel="stylesheet" href="../../source/bootstrap/bootstrap-5.1.3-dist/css/bootstrap.min.css" />
		<!-- fontawesome -->
		<link
			rel="stylesheet"
			href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
			integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
			crossorigin="anonymous"
		/>
		<link rel="stylesheet" href="../../soure/bootstrap/fontawesome.min.css" />
		<!-- local css -->
		<link rel="stylesheet" href="../../source/css/style-student.css" />

		<title>Student View Grades</title>
	</head>
	<body>
		<!-- NAVBAR -->
		<nav class="navbar navbar-expand-lg navbar-dark sticky-top" id="navbar">
			<div class="container-fluid">
				<!-- COLLEGE LOGO/SEAL -->
				<a class="navbar-brand p-0 m-0" href="#" id="nav-logo">
					<!--
						<?php 
						while($getcollege = mysqli_fetch_array($query1))
						{ 
							$college_check = $getcollege['college_id_fk'];
							$getdata = mysqli_query($connection,"SELECT * FROM tblcollege WHERE id='$college_check'");

							while($fa = mysqli_fetch_array($getdata))
							{
								$boom = $fa['seal'];
								echo "<span id='department'>  "."<img style='width: 2rem; height: 2rem; margin-right: 10px;' src='../upload/$boom'>".$fa['college']."</span>";
							}
						}							
					?> 
					-->
					<img class="rounded-circle p-0" src="../../source/assets/images/ics-seal-250.png" alt="ICS SEAL" width="32" height="32" />
					<span class="text-uppercase">Online Pre-Advising</span>
				</a>

				<!-- MOBILE TOGGLE -->
				<button class="navbar-toggler m-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span><i class="fas fa-bars"></i></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav">
						<!-- Curriculum
						<li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Curriculum">
							<a class="nav-link active py-0" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#curriculum"
								><i class ="fas fa-scroll"></i><span class="nav-label"> Curriculum</span></a
							>
						</li> -->
					
						<!-- logout -->
						<li class="nav-item">
							<a type="button" id="icons" class="nav-link active py-0" data-bs-toggle="modal" data-bs-target="#logoutModal" aria-disabled="true"><i class="fas fa-sign-out-alt"></i><span class="nav-label"> Logout</span></a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- END OF NAVBAR -->
		
		<!-- Logout Modal-->
		 <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Log out</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>

					<div class="modal-body d-flex justify-content-center">
						<form action="../includes/logout.php" method="POST"> 
						<span>Are you sure you want to logout?</span>
					</div>

					<div class="modal-footer">
						<button class="btn btn-danger" type="button" data-bs-dismiss="modal">No</button>
						<button type="submit" name="logout" class="btn btn-success">Yes</button>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- CURRICULUM POPUP -->
		<div class="modal fade" id="curriculum" tabindex="-1" aria-labelledby="curriculumLabel" aria-hidden="true">
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
		</div>
		<!-- CURRICULUM POPUP END -->

	<div class="mt-4">     
		<h2 class="mb-3 fw-bold text-danger font-weight-bold  text-center ">Student Subjects</h2>

		<!-- BUTTONS -->
        <div class="container text-center border mb-4">
			<div class="mt-2 mb-2">
				<a class="btn btn-danger text-white ms-1" href="student-grade-input.html">Grades</a>
            	<a class="btn btn-danger text-white me-1 " onclick="window.history.back()"> Back </a>
			</div>
        </div>
		
		<div class="container mb-5">
			<div class="row">
				<div class="border">
					<!-- 1st Year Subjects -->
					<div class="border-bottom mb-2" id="first year Subjects">
						<span class="d-flex justify-content-center text-danger text-uppercase fw-bold fs-4 mt-3">1st Year</span>
						<div class="mb-3" id="1st sem">
							<span class="text-uppercase text-danger fw-bold fs-5">1st Semester</span>
							<table class="table table-bordered" id="1st-year-1st-sem" width="50%" cellspacing="0">
								<thead class="bg-danger text-white">
								<tr>
									<th><center>Subject Code</center></th>
									<th><center>Description</center></th>
									<th><center>Lec Units</center></th>
									<th><center>Lab Units</center></th>
									<th><center>Total Units</center></th>
									<th><center>Prerequisites</center></th>
								</tr>
								</thead>
								<tbody>
									<tr>
										<td><center>BSCS2323</center></td>
										<td><center>Com Prog</center></td>
										<td><center>3</center></td>
										<td><center>5</center></td>
										<td><center>5</center></td>
										<td><center>none</center></td>
									</tr>
								</tbody>
							</table>
						</div>
	
						<div class="mt-3 mb-3" id="2nd sem">
							<span class="text-uppercase text-danger fw-bold fs-5">2nd Semester</span>
							<table class="table table-bordered" id="1st-year-1st-sem" width="50%" cellspacing="0">
								<thead class="bg-danger text-white">
								<tr>
									<th><center>Subject Code</center></th>
									<th><center>Description</center></th>
									<th><center>Lec Units</center></th>
									<th><center>Lab Units</center></th>
									<th><center>Total Units</center></th>
									<th><center>Prerequisites</center></th>
								</tr>
								</thead>
								<tbody>
									<tr>
										<td><center>BSCS2323</center></td>
										<td><center>Com Prog</center></td>
										<td><center>3</center></td>
										<td><center>5</center></td>
										<td><center>5</center></td>
										<td><center>none</center></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<!-- End 1st Year Subjects -->

					<!-- 2nd Year Subjects -->
					<div class="border-bottom mb-2" id="second year Subjects">
						<span class="d-flex justify-content-center text-danger text-uppercase fw-bold fs-4 mt-3">2nd Year</span>
						<div class="mb-3" id="1st sem">
							<span class="text-uppercase text-danger fw-bold fs-5">1st Semester</span>
							<table class="table table-bordered" id="1st-year-1st-sem" width="50%" cellspacing="0">
								<thead class="bg-danger text-white">
								<tr>
									<th><center>Subject Code</center></th>
									<th><center>Description</center></th>
									<th><center>Lec Units</center></th>
									<th><center>Lab Units</center></th>
									<th><center>Total Units</center></th>
									<th><center>Prerequisites</center></th>
								</tr>
								</thead>
								<tbody>
									<tr>
										<td><center>BSCS2323</center></td>
										<td><center>Com Prog</center></td>
										<td><center>3</center></td>
										<td><center>5</center></td>
										<td><center>5</center></td>
										<td><center>none</center></td>
									</tr>
								</tbody>
							</table>
						</div>
	
						<div class="mt-3 mb-3" id="2nd sem">
							<span class="text-uppercase text-danger fw-bold fs-5">2nd Semester</span>
							<table class="table table-bordered" id="1st-year-1st-sem" width="50%" cellspacing="0">
								<thead class="bg-danger text-white">
								<tr>
									<th><center>Subject Code</center></th>
									<th><center>Description</center></th>
									<th><center>Lec Units</center></th>
									<th><center>Lab Units</center></th>
									<th><center>Total Units</center></th>
									<th><center>Prerequisites</center></th>
								</tr>
								</thead>
								<tbody>
									<tr>
										<td><center>BSCS2323</center></td>
										<td><center>Com Prog</center></td>
										<td><center>3</center></td>
										<td><center>5</center></td>
										<td><center>5</center></td>
										<td><center>none</center></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<!-- End of 2nd Year Subjects -->

					<!-- 3rd Year Subjects -->
					<div class="border-bottom mb-2" id="third year Subjects">
						<span class="d-flex justify-content-center text-danger text-uppercase fw-bold fs-4 mt-3">3rd Year</span>
						<div class="mb-3" id="1st sem">
							<span class="text-uppercase text-danger fw-bold fs-5">1st Semester</span>
							<table class="table table-bordered" id="1st-year-1st-sem" width="50%" cellspacing="0">
								<thead class="bg-danger text-white">
								<tr>
									<th><center>Subject Code</center></th>
									<th><center>Description</center></th>
									<th><center>Lec Units</center></th>
									<th><center>Lab Units</center></th>
									<th><center>Total Units</center></th>
									<th><center>Prerequisites</center></th>
								</tr>
								</thead>
								<tbody>
									<tr>
										<td><center>BSCS2323</center></td>
										<td><center>Com Prog</center></td>
										<td><center>3</center></td>
										<td><center>5</center></td>
										<td><center>5</center></td>
										<td><center>none</center></td>
									</tr>
								</tbody>
							</table>
						</div>
	
						<div class="mt-3 mb-3" id="2nd sem">
							<span class="text-uppercase text-danger fw-bold fs-5">2nd Semester</span>
							<table class="table table-bordered" id="1st-year-1st-sem" width="50%" cellspacing="0">
								<thead class="bg-danger text-white">
								<tr>
									<th><center>Subject Code</center></th>
									<th><center>Description</center></th>
									<th><center>Lec Units</center></th>
									<th><center>Lab Units</center></th>
									<th><center>Total Units</center></th>
									<th><center>Prerequisites</center></th>
								</tr>
								</thead>
								<tbody>
									<tr>
										<td><center>BSCS2323</center></td>
										<td><center>Com Prog</center></td>
										<td><center>3</center></td>
										<td><center>5</center></td>
										<td><center>5</center></td>
										<td><center>none</center></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<!-- End of 3rd Year Subjects -->

					<!-- 4th Year Subjects -->
					<div class="border-bottom mb-2" id="fourth year Subjects">
						<span class="d-flex justify-content-center text-danger text-uppercase fw-bold fs-4 mt-3">4th Year</span>
						<div class="mb-3" id="1st sem">
							<span class="text-uppercase text-danger fw-bold fs-5">1st Semester</span>
							<table class="table table-bordered" id="1st-year-1st-sem" width="50%" cellspacing="0">
								<thead class="bg-danger text-white">
								<tr>
									<th><center>Subject Code</center></th>
									<th><center>Description</center></th>
									<th><center>Lec Units</center></th>
									<th><center>Lab Units</center></th>
									<th><center>Total Units</center></th>
									<th><center>Prerequisites</center></th>
								</tr>
								</thead>
								<tbody>
									<tr>
										<td><center>BSCS2323</center></td>
										<td><center>Com Prog</center></td>
										<td><center>3</center></td>
										<td><center>5</center></td>
										<td><center>5</center></td>
										<td><center>none</center></td>
									</tr>
								</tbody>
							</table>
						</div>
	
						<div class="mt-3 mb-3" id="2nd sem">
							<span class="text-uppercase text-danger fw-bold fs-5">2nd Semester</span>
							<table class="table table-bordered" id="1st-year-1st-sem" width="50%" cellspacing="0">
								<thead class="bg-danger text-white">
								<tr>
									<th><center>Subject Code</center></th>
									<th><center>Description</center></th>
									<th><center>Lec Units</center></th>
									<th><center>Lab Units</center></th>
									<th><center>Total Units</center></th>
									<th><center>Prerequisites</center></th>
								</tr>
								</thead>
								<tbody>
									<tr>
										<td><center>BSCS2323</center></td>
										<td><center>Com Prog</center></td>
										<td><center>3</center></td>
										<td><center>5</center></td>
										<td><center>5</center></td>
										<td><center>none</center></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<!-- End of 4th Year Subjects -->

					<!-- 5th Year Subjects -->
					<div class="border-bottom mb-3" id="fifth year Subjects">
						<span class="d-flex justify-content-center text-danger text-uppercase fw-bold fs-4 mt-3">5th Year</span>
						<div class="mb-3" id="1st sem">
							<span class="text-uppercase text-danger fw-bold fs-5">1st Semester</span>
							<table class="table table-bordered" id="1st-year-1st-sem" width="50%" cellspacing="0">
								<thead class="bg-danger text-white">
								<tr>
									<th><center>Subject Code</center></th>
									<th><center>Description</center></th>
									<th><center>Lec Units</center></th>
									<th><center>Lab Units</center></th>
									<th><center>Total Units</center></th>
									<th><center>Prerequisites</center></th>
								</tr>
								</thead>
								<tbody>
									<tr>
										<td><center>BSCS2323</center></td>
										<td><center>Com Prog</center></td>
										<td><center>3</center></td>
										<td><center>5</center></td>
										<td><center>5</center></td>
										<td><center>none</center></td>
									</tr>
								</tbody>
							</table>
						</div>
	
						<div class="mt-3 mb-3" id="2nd sem">
							<span class="text-uppercase text-danger fw-bold fs-5">2nd Semester</span>
							<table class="table table-bordered" id="1st-year-1st-sem" width="50%" cellspacing="0">
								<thead class="bg-danger text-white">
								<tr>
									<th><center>Subject Code</center></th>
									<th><center>Description</center></th>
									<th><center>Lec Units</center></th>
									<th><center>Lab Units</center></th>
									<th><center>Total Units</center></th>
									<th><center>Prerequisites</center></th>
								</tr>
								</thead>
								<tbody>
									<tr>
										<td><center>BSCS2323</center></td>
										<td><center>Com Prog</center></td>
										<td><center>3</center></td>
										<td><center>5</center></td>
										<td><center>5</center></td>
										<td><center>none</center></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<!-- End of 5th Year Subjects -->

				</div>
			</div>
		<!-- content 
			<table class="table table-bordered" id="dataTable" width="50%" cellspacing="0">
			<thead class="bg-danger text-white">
			<tr>
				<th>Subject Code</th>
				<th>Description</th>
				<th>Lec Units</th>
				<th>Lab Units</th>
				<th>Total Units</th>
				<th>Prerequisites</th>
			</tr>
			</thead>
			<tbody>
			<tr>
			<?php
			if(isset($_POST['search'])){
			$collegeid = $_SESSION['college_id_fk'];
			$getyear = mysqli_real_escape_string($connection,$_POST['year']);
			$getsemester = mysqli_real_escape_string($connection,$_POST['semester']);
			
			$search = mysqli_query($connection,"SELECT * FROM tbladviser_sub_stud WHERE yearlevel='$getyear' AND semester='$getsemester' AND college_id_fk='$collegeid'");
			
			while($getsubject = mysqli_fetch_array($search))
			{ 
				$getsubid = $getsubject['id'];
				$getsubcode = $getsubject['subject_code'];
				$getsubdes = $getsubject['description'];
				$getsublec = $getsubject['lec'];
				$getsublab = $getsubject['lab'];
				$getsubunits = $getsubject['units'];
				$getsubyear = $getsubject['yearlevel'];
				$getsubsemester = $getsubject['semester'];
				$getsubpreq = $getsubject['prerequisite'];
				
					echo "<tr>";
					echo "<td hidden>".$getsubid."</td>";
					echo "<td>".$getsubcode."</td>";
					echo "<td>".$getsubdes."</td>";
					echo "<td>".$getsublec."</td>";
					echo "<td>".$getsublab."</td>";
					echo "<td>".$getsubunits."</td>";
					
					if($getsubpreq == "NONE"){
						echo "<td>".NONE."</td>";
					}
					else if($getsubpreq == "HAVE"){
												
					$getpreq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$getsubcode'");
						while($te = mysqli_fetch_array($getpreq))
						{
							$new = $te['subjectcode'];
						}
					echo "<td>".$new."</td>";
					}
					echo "</tr>";  
				}  
			}
			?>
			</table>
			end php code-->
		
		</div>
	</div>
        
		<!-- BUTTONS END -->

		<!-- Option 2: Separate Popper and Bootstrap JS -->
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
	</body>
</html>
