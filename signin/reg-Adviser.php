<?php
	use PHPMailer\PHPMailer\PHPMailer;

	session_start();
	include("../source/includes/config.php");
	include("../source/includes/alertmessage.php");

	if (isset($_POST['submit_staff_request']))
	{
			$firstname = mysqli_real_escape_string($connection,$_POST['firstname']);
			$lastname = mysqli_real_escape_string($connection,$_POST['lastname']);
			$contact = mysqli_real_escape_string($connection,$_POST['contact']);
			$email = mysqli_real_escape_string($connection,$_POST['email']);
			$password = mysqli_real_escape_string($connection,$_POST['password']);
			$collegeid = mysqli_real_escape_string($connection,$_POST['collegeid']);
			$courseid = mysqli_real_escape_string($connection,$_POST['courseid']);

			$usertype = "Adviser";

			$get_college = mysqli_query($connection,"SELECT * FROM tblcollege WHERE id='$collegeid'");
			while($col=mysqli_fetch_array($get_college))
			{
				$CollegeName = $col['college'];
			}
			$get_course = mysqli_query($connection,"SELECT * FROM tblcourse WHERE id='$courseid'");
			while($cour=mysqli_fetch_array($get_course))
			{
				$CourseName = $cour['course'];
			}

			//get admin account
			$check_admin = mysqli_query($connection,"SELECT * FROM tbluser WHERE usertype='Admin' and college_id_fk='$collegeid'");
			while($sa = mysqli_fetch_array($check_admin))
			{
			    $getadminid = $sa['id'];
				$getemail = $sa['email'];
			}

			$check_email = mysqli_query($connection,"SELECT * from tbluser WHERE email='$email'");
			//password length
			$pass_len = strlen($password);

			if(mysqli_num_rows($check_email) > 0)
			{
				$_SESSION['status'] = "Email Already Exist!!";
				$_SESSION['status_code'] = "info";
				header("location: staff-request.php");
			}
			else if($pass_len < 8)
			{
				$_SESSION['status'] = "Your Password is to short!!";
				$_SESSION['status_code'] = "info";
				header("location: staff-request.php");
			}
			else
			{	
				$sql_a ="INSERT INTO `tblrequest_account`(`firstname`, `lastname`,`contact` ,`email`, `password`, `req_usertype`,`college_id_fk`,`course_id_fk`,`user_id_fk`) VALUES ('$firstname','$lastname','$contact','$email','$password','$usertype','$collegeid','$courseid','$getadminid')";
			
				//send credentials to email
				require_once '../PHPMailer/PHPMailer.php';
				require_once '../PHPMailer/SMTP.php';
				require_once '../PHPMailer/Exception.php';
				
				$mail = new PHPMailer();
				
				$mail->isSMTP();
				$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
				$mail->SMTPAuth = true;         // Enable SMTP authentication
				$mail->Username = 'devureteam26@gmail.com';  // SMTP username
				$mail->Password = 'Devureteam22;';  // SMTP password
				$mail->Port = 465;  // TCP port to connect to
				$mail->SMTPSecure = 'ssl';  // Enable TLS encryption, ssl also accepted
				
				//email settings
				$mail->isHTML(true); // Set email format to HTML
				$mail->setFrom('devureteam26@gmail.com','Online Pre-Advising');
				$mail->addAddress($getemail);  
        
                $mail->Subject = 'Online Pre-Advising';
                $mail->Body    = "<p>Greetings: <br><br> 
				Here with Adviser Request Account: <br><br>
				Adviser email is <b>$email</b><br>
				Adviser College is <b>$CollegeName</b><br>
				Adviser course is <b>$CourseName</b><br> <br><br>
				To Check, please go to <a href='wmsu-onlinepreadvising.com'>Online Pre-Advising</a>
                    <br><br><p>Note:<br>
                    1. The password will be change to profile settings after login in website.<br>
                    2. The email cannot be change (Unique).<br>
                    3. Create and Keep the records of the Credentials of accounts for future use.<br>
                    4. Please use <b><font color='#4285F4'>G</font><font color='#DB4437'>o</font><font color='#F4B400'>o</font><font color='#4285F4'>g</font><font color='#0F9D58'>l</font><font color='#DB4437'>e</font></b> Chrome browser, if possible.<br>
                    5. Please ignore this message if you already received this message previously.</p>";
			
				if($mail->send() && mysqli_query($connection,$sql_a))
				{
					$_SESSION['status'] = "Successfully Created!!";
					$_SESSION['status_code'] = "success";
					header("location: staff-request.php");
				}
				else
				{
					$_SESSION['status'] = "Unsuccessfully Created.Please Check your input or Contact the Personnel incharge!!";
                	$_SESSION['status_code'] = "error";
					
				}  
			}
	}
?>