<?php
	session_start();
	include("../source/includes/config.php"); 
?>
<!DOCTYPE html>
<html>
	<head>
		<!--Let browser know website is optimized for mobile-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<!-- Wmsu-Icon -->
        <link rel="icon" href="../source/assets/images/wmsulogo.png">
		<!-- BOOTSTRAP -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous" />
		<!-- OFFLINE BOOTSTRAP -->
		<link rel="stylesheet" href="../source/bootstrap/bootstrap-5.1.3-dist/css/bootstrap.min.css" />
		<!-- fontawesome -->
		<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
		<!-- local css -->
		<link rel="stylesheet" href="../source/css/request.css" />	
		<title>Request Account</title>
	</head>
	<body>
		<!-- CONTAINER NO MARGIN -->
		<div class="bg overflow-hidden mb-5">
			<!-- CONTAINER WITH MARGIN -->
			<div class="container mt-5">
				<!-- PARENT -->
				<div class="row">
					<!--CHILD LEFT -->
					<div class="col-6" id="left-side">
						<form id="staff-request-form" class="p-3" action="reg-Adviser.php" method="POST">
							<!-- HEADING FOR STAFF  REQUEST FORM -->
							<div class="title mb-5">
								<h3 class="mb-4">
									Staff Request Form
									<span>
										<!--<a class="role" href="student-request.php"><i class="fas fa-user-graduate"></i></a>-->
										<a class="role rounded-left" href="universal-signin.php"><i class="fas fa-chevron-left"></i></a>
										<a class="role" id="active" href="#"><i class="fas fa-user-tie"></i></a>
									</span>
								</h3>
							</div>
							<!-- HEADING END -->

							<!-- INPUT FIELDS -->

							<!-- FIRSTNAME -->
							<div class="row mb-3">
								<label for="first-name" class="col-sm-4 col-form-label">First Name</label>
								<div class="col-sm-8">
									<input type="text" name="firstname" class="form-control" id="first-name" placeholder="Enter Firstname" style="text-align:center;" required/>
								</div>
							</div>

							<!-- LASTNAME -->
							<div class="row mb-3">
								<label for="last-name" class="col-sm-4 col-form-label">Last Name</label>
								<div class="col-sm-8">
									<input type="text" name="lastname" class="form-control" id="last-name" placeholder="Enter Lastname" style="text-align:center;" required />
								</div>
							</div>
							
							<!-- CONTACT NO. -->
							<div class="row mb-3">
								<label for="last-name" class="col-sm-4 col-form-label">Contact No.</label>
								<div class="col-sm-8">
									<input type="text" name="contact" class="form-control" id="last-name" onkeypress="return isNumber(event)" onpaste="return false;" placeholder="Enter Contact No." maxlength="11" autocomplete="off" style="text-align:center;"/>
								</div>
							</div>
							
							<!-- Email -->
							<div class="row mb-3">
								<label for="email" class="col-sm-4 col-form-label">Email</label>
								<div class="col-sm-8">
									<input type="email" name="email" class="form-control" id="email" placeholder="Enter Email Address" autocomplete="off" style="text-align:center;" required/>
								</div>
								<span class="text-secondary form-text text-center">Example: sl223959@wmsu.edu.ph</span>
							</div>

							<!-- PASSWORD -->
							<div class="row mb-2">
								<label for="pass" class="col-sm-4 col-form-label">Password</label>
								<div class="col-sm-8">
									<input type="password" name="password" class="form-control" id="Password" placeholder="Enter Password" style="text-align:center;" required />
								</div>
								<div class="text-center">
									<input type="checkbox" onclick="myFunction()"> Show Password
								</div>
								<div id="emailHelp" class="form-text text-end">Note: Password must be atleast 8 or more characters!</div>
							</div>
								
							<!-- DEPARTMENT -->
							<div class="row mb-3">
								<label for="adviser-college" class="col-sm-4 col-form-label">College</label>
								<div class="col-sm-8">
									<select name="collegeid" class="form-control text-center" id="adviser-college" required>
										<option value="0">Select College</option>
									<?php
										$get_college = mysqli_query($connection,"SELECT * FROM tblcollege");
										if(mysqli_num_rows($get_college) > 0)
										{
											while($fa = mysqli_fetch_array($get_college))
											{
									?>
										<option value="<?php echo $fa['id'] ?>"><?php echo $fa['college'] ?></option>
									<?php

											}
										}
										else
										{
											echo "No Data Found!!!";
										}
									?>
									</select>
								</div>
							</div>
							
							<!-- COURSE -->
							<div class="row mb-3">
								<label for="adviser-course" class="col-sm-4 col-form-label">Course</label>
								<div class="col-sm-8">
									<select name="courseid" class="form-control text-center" id="adviser-course" required>
										<option value="0" selected>Select Course</option>
									<?php
										$get_course = mysqli_query($connection,"SELECT * FROM tblcourse");
										if(mysqli_num_rows($get_course) > 0)
										{
											while($fa = mysqli_fetch_array($get_course))
											{
									?>
										<option value="<?php echo $fa['id'] ?>"><?php echo $fa['course'] ?></option>
									<?php

											}
										}
										else
										{
											echo "No Data Found!!!";
										}
									?>
									</select>
								</div>
							</div>
							<!-- INPUT FIELDS END -->

							<!-- ACTION BUTTONS -->
							<div class="buttons">
								<!--<a href="universal-signin.php" class="btn btn-secondary" id="back-btn">Back</a>-->
								<button type="submit" name="submit_staff_request" class="btn btn-danger" id="submit-btn">Submit</button>
							</div>
							<!-- ACTION BUTTONS END -->
						</form>
					</div>
					<!-- CHILD LEFT END -->

					<!-- CHILD RIGHT -->
					<div class="col-6" id="right-side">
						<div class="bg-circle"></div>
						<div class="containr">
							<img src="../source/assets/images/request.svg" alt="" />
						</div>
					</div>
					<!-- CHILE RIGHT END -->
				</div>
				<!-- PARENT END -->
			</div>
			<!-- MARGIN WITH CONTAINER END -->
		</div>
		<!-- CONTAINER NO MARGIN END -->

		<!-- ONLINE BOOTSTRAP JS -->
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
		<!-- OFFLINE BOOTSTRAP JS -->
		<script src="../bootstrap/bootstrap.min.js"></script>
		<?php
			include("../source/includes/alertmessage.php");
		?> 
		<!-- Show/Hide Password -->
		<script>
			function myFunction() {
				var x = document.getElementById("Password");
				if (x.type === "password") {
					x.type = "text";
				} else {
					x.type = "password";
				}
			}

			function isNumber(evt) {
                evt = (evt) ? evt : window.event;
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if ( (charCode > 31 && charCode < 48) || charCode > 57) {
                    return false;
                }
                return true;
            }
    	</script> 
	</body>
</html>
