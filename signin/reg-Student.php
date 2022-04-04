<?php
	use PHPMailer\PHPMailer\PHPMailer;

	session_start();
	include("../source/includes/config.php");
	include("../source/includes/alertmessage.php");

	if (isset($_POST['submit-request']))
	{
			$firstname = mysqli_real_escape_string($connection,$_POST['firstname']);
			$lastname = mysqli_real_escape_string($connection,$_POST['lastname']);
			$contact = mysqli_real_escape_string($connection,$_POST['contact']);
			$email = mysqli_real_escape_string($connection,$_POST['email']);
			$password = mysqli_real_escape_string($connection,$_POST['password']);
			$department = mysqli_real_escape_string($connection,$_POST['college']);
			$coursecode = mysqli_real_escape_string($connection,$_POST['coursecode']);
			$yearlevel = mysqli_real_escape_string($connection,$_POST['yearlevel']);
			$section = mysqli_real_escape_string($connection,$_POST['section']);

			$usertype = "Student";
			$Section = strtoupper($section);
			$yrsec = $yearlevel.''.$Section;

			//get college id
			$check_college = mysqli_query($connection,"SELECT * FROM tblcollege WHERE id='$department'");
			while($co=mysqli_fetch_array($check_college))
			{
				$College = $co['college'];
			}
			//get course id
			$check_course = mysqli_query($connection,"SELECT * FROM tblcourse WHERE id='$coursecode'");
			if(mysqli_num_rows($check_course) > 0){
				$fa_c = mysqli_fetch_array($check_course);
				$courseid = $fa_c['id'];
				$coursename = $fa_c['course'];
			}		
			//get adviser id
			$check_adviser = mysqli_query($connection,"SELECT * FROM tbluser WHERE usertype='Adviser' and course_id_fk='$courseid' and yearlevel='$yearlevel'");
			while($fa = mysqli_fetch_array($check_adviser))
			{
			    $getadviserid = $fa['id'];
			    $getemail = $fa['email'];
			}
			// Check Email //
			$check_email = mysqli_query($connection,"SELECT * FROM tbluser WHERE email='$email'");
			if(mysqli_num_rows($check_email) > 0){
				$fa_c = mysqli_fetch_array($check_email);
				$Email = $fa_c['email'];
				$_SESSION['status'] = "Email Already Existed!!";
				$_SESSION['status_code'] = "info";
				header("location: student-request.php"); 
			}
			else
			{	
				$sql_a ="INSERT INTO `tblrequest_account`(`firstname`, `lastname`,`contact`, `email`, `password`,`section`, `req_usertype`,`college_id_fk`,`course_id_fk`,`yearlevel`) VALUES ('$firstname', '$lastname','$contact','$email','$password','$Section','$usertype','$department','$coursecode','$yearlevel')";
				
				//send credentials to email
				require_once '../PHPMailer/PHPMailer.php';
				require_once '../PHPMailer/SMTP.php';
				require_once '../PHPMailer/Exception.php';
				
				$mail = new PHPMailer();
				
				$mail->isSMTP();
				$mail->Host = 'smtp.hostinger.ph';  // Specify main and backup SMTP servers
				$mail->SMTPAuth = true;         // Enable SMTP authentication
				$mail->Username = 'advising@wmsuics.tech';  // SMTP username
				$mail->Password = 'Advising123_;';  // SMTP password
				$mail->Port = 465;  // TCP port to connect to
				$mail->SMTPSecure = 'ssl';  // Enable TLS encryption, ssl also accepted
				
				//email settings
				$mail->isHTML(true); // Set email format to HTML
				$mail->setFrom('advising@wmsuics.tech','Online Pre-Advising');
				$mail->addAddress($getemail);  
        
                $mail->Subject = 'Online Pre-Advising';
                $mail->Body    = "<p>Greetings: <br><br> 
				Here with Student Request Account: <br><br>
				Student email is <b>$email</b><br>
				Student College is <b>$College</b><br>
				Student course is <b>$coursename</b><br>
				Student Year and Section is <b>$yrsec</b></br> <br><br>
				To Check, please go to <a href='wmsu-onlinepreadvising.com'>Online Pre-Advising</a>
                    <br><br><p>Note:<br>
                    1. The password will be change to profile settings after login in website.<br>
                    2. The email cannot be change (Unique).<br>
                    3. Create and Keep the records of the Credentials of accounts for future use.<br>
                    4. Please use <b><font color='#4285F4'>G</font><font color='#DB4437'>o</font><font color='#F4B400'>o</font><font color='#4285F4'>g</font><font color='#0F9D58'>l</font><font color='#DB4437'>e</font></b> Chrome browser, if possible.<br>
                    5. Please ignore this message if you already received this message previously.</p>";
			
				if($mail->send() && mysqli_query($connection,$sql_a)){
					$_SESSION['status'] = "Successfully Added.. Please Wait the Confirmation to your Email Account!!";
                	$_SESSION['status_code'] = "success";
					header("location: student-request.php");
				}
				else{
					$_SESSION['status'] = "Unsuccessfully Added.Please Check your input or Contact the Personnel incharge!!";
                	$_SESSION['status_code'] = "error";
					header("location: student-request.php");  
				}  
			}
	}
?>