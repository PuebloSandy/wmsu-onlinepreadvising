<?php
    session_start();
	require("../source/includes/config.php");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!-- Wmsu-Icon -->
        <link rel="icon" href="../source/assets/images/wmsulogo.png">
		<!-- Bootstrap CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous" />
		<!-- fontawesome -->
		<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
		<!-- local css -->
		<link rel="stylesheet" href="../source/css/signin.css" />
		<link rel="stylesheet" href="../source/preloader/loader.css" />
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
		<title>Sign in</title>
	</head>
	<body>
		<!-- SIGN IN -->
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
		<script src="../source/preloader/loader.js"></script>

		<div class="containr">
			<div class="forms-container">
				<div class="signin-signup">
					<!-- INPUT -->
					<form autocomplete="off" action="loginData.php" method="POST">
						<div class="sign-in-form" id="form" >
							<h2 class="title">Sign in</h2>
							<input type="hidden" name="width" id="width">
							<div class="input-field">
								<i class="fas fa-user"></i>
								<input type="text" placeholder="Email" id="email" name="email" autocomplete="false" onclick="IsCapsLockOn(event)" onkeyup="IsCapsLockOn(event)" required/>
							</div>
							<div class="input-field">
								<i class="fas fa-lock"></i>
								<input type="password" placeholder="Password" id="Password" name="password" autocomplete="off" onclick="IsCapsLockOn(event)" onkeyup="IsCapsLockOn(event)" required />  
							</div>
							<div>
								<input type="checkbox" onclick="myFunction()"> Show Password
							</div>
							<span id="spnWarning" style='display:none;color:red'>WARNING! Caps lock is ON.</span>
							<!-- LOGIN BUTTON -->
							<button type="submit" name="login" id="login" class="btn solid">Login</button>
							<button type="submit" name="testemail" id="testemail" class="btn solid">Test Email</button>

							<p class="request-text">Don't have an account?<br />Request a student or staff account</p>
							<!-- REQUEST ICONS -->
							<div class="requests">
								<!-- Student Request Account 
								<a href="student-request.php" class="request-icon" >
									<i class="fas fa-user-graduate"></i>
								</a>-->
								<a href="staff-request.php" class="request-icon">
									<i class="fas fa-user-tie"></i>
								</a>
							</div>
						</div>
					</form>
				</div>
			</div>

			<!-- LEFT  -->
			<div class="panels-container">
				<div class="panel left-panel">
					<div class="content">
						<h3 ><span><a class="text-white" href="../index.html"><i class="fas fa-chevron-circle-left"></i> BACK TO HOMEPAGE</a> </span> </h3>	
					</div>		
					<img src="../source/assets/images/signin.svg" class="image" alt="signin" />
				</div>
			</div>
		</div>

		<!-- Option 1: Bootstrap Bundle with Popper -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
	
		<?php
			include("../source/includes/alertmessage.php");
		?> 
		<script>
			function myFunction() {
				var x = document.getElementById("Password");
				if (x.type === "password") {
					x.type = "text";
				} else {
					x.type = "password";
				}
			}
			var w = window.innerWidth;
			document.getElementById("width").value = w;

			function IsCapsLockOn(event) {
				if (event.getModifierState("CapsLock")) {  // If "caps lock" is pressed, display the warning text
					document.getElementById("spnWarning").style.display = "block";
				}
				else {
					document.getElementById("spnWarning").style.display = "none";
				}
			}
		</script>
	</body>
</html>
