<?php

use PHPMailer\PHPMailer\PHPMailer;

   session_start();
   require("../source/includes/config.php");
   require("../source/includes/alertmessage.php");
   
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
      
      $emailname = $_POST['testemail'];
      if (empty($emailname)) {
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
				$mail->Port = '465';  // TCP port to connect to
				$mail->SMTPSecure = 'ssl';  // Enable TLS encryption, ssl also accepted
				
				//email settings
				$mail->isHTML(true); // Set email format to HTML
				$mail->setFrom('advising@wmsuics.tech','Online Pre-Advising');
				$mail->addAddress($getemail);  
        
                $mail->Subject = 'Online Pre-Advising';
                $mail->Body    = "Test email sent";
			
				$mail->send();
      }
    }

   else if($_SERVER["REQUEST_METHOD"] == "POST"){
      // email and password sent from form 
      $myemail = mysqli_real_escape_string($connection,$_POST['email']);
      $mypassword = mysqli_real_escape_string($connection,$_POST['password']);
      $sw = mysqli_real_escape_string($connection,$_POST['width']);

      $get_status = mysqli_query($connection,"SELECT * FROM tbluser WHERE email = '$myemail' and password = '$mypassword'");
      while($a = mysqli_fetch_array($get_status))
      {
         $usertype = $a['usertype'];
         $status = $a['status'];
      }

      if($usertype == "Superadmin" && $sw < "781")
      {
         $_SESSION['status'] = "Sorry You Can't Login in Mobile Devices!!!";
         $_SESSION['status_code'] = "error";     
         header("location: ../signin/universal-signin.php");
      }
      else if($usertype == "Admin" && $sw < "781")
      {
         $_SESSION['status'] = "Sorry You Can't Login in Mobile Devices!!!";
         $_SESSION['status_code'] = "error";     
         header("location: ../signin/universal-signin.php");
      }
      else if($usertype == "Adviser" && $sw < "781")
      {
         $_SESSION['status'] = "Sorry You Can't Login in Mobile Devices!!!";
         $_SESSION['status_code'] = "error";     
         header("location: ../signin/universal-signin.php");
      }
      else if($usertype == "Admin" && $status == "0")
      {
         $_SESSION['status'] = "Sorry You Can't Login Because your account has been Deactivated!!";
         $_SESSION['status_code'] = "warning";     
         header("location: ../signin/universal-signin.php");
      }
      else if($usertype == "Adviser" && $status == "0")
      {
         $_SESSION['status'] = "Sorry You Can't Login Because your account has been Deactivated!!";
         $_SESSION['status_code'] = "warning";     
         header("location: ../signin/universal-signin.php");
      }
      else
      {
         $sql = "SELECT * FROM tbluser WHERE email = '$myemail' and password = '$mypassword'";
         $result = mysqli_query($connection,$sql);
         // If result matched $myemail and $mypassword, table row must be 1 row 
         if(mysqli_num_rows($result) == 1){

            $con = mysqli_fetch_array($result);

            $_SESSION['login_user'] = $myemail;
            $_SESSION['last_login_time'] = time();
            $_SESSION['id'] = $con['id'];
            $userid= $con['id'];
            $_SESSION['college_id_fk'] = $con['college_id_fk'];
            $_SESSION['curri_id'] = $con['curri_id'];
            $_SESSION['yearlevel'] = $con['yearlevel'];
            $_SESSION['course_id_fk'] = $con['course_id_fk'];
            $_SESSION['usertype'] = $con['usertype'];
            $_SESSION['firstname'] = $con['firstname'];
            $_SESSION['lastname'] = $con['lastname'];
            $_SESSION['email'] = $con['email'];
            $_SESSION['password'] = $con['password'];
            $_SESSION['login_message'] = "success";
            
            $select_email = mysqli_query($connection,"SELECT * FROM tbluser WHERE email='$myemail'");
            while($fa = mysqli_fetch_array($select_email))
            {
               $getuser_id = $fa['id'];
               $user_email = $fa['email'];
            }

            $status_res = mysqli_query($connection,"SELECT * FROM tblstudent_grade_sub WHERE student_id_fk='$getuser_id'");
            if(mysqli_num_rows($status_res) > 0)
            {
               $sta = mysqli_fetch_array($status_res);
               $getgrad_id = $sta['id'];
               $grades_status = $sta['submission_status'];
               $_SESSION['submission_status'] = $sta['submission_status'];
            }
            else
            {
               $grades_status = 0;
            }
            
            if($con['usertype'] == "Superadmin"){
               //$_SESSION['status'] = "Login Successfully";
               //$_SESSION['status_code'] = "success"; 
               header("location: ../users/Super Admin/superadmin-homepage.php");
            }else if($con['usertype'] == "Admin"){
               $_SESSION['status'] = "Login Successfully";
               $_SESSION['status_code'] = "success"; 
               header("location: ../users/Admin/admin-homepage.php");
            }else if($con['usertype'] == "Adviser"){
               $_SESSION['status'] = "Login Successfully";
               $_SESSION['status_code'] = "success"; 
               header("location: ../users/Adviser/adviser-homepage.php"); 
            }else if($con['usertype'] == "Student" && $grades_status == "0"){
               $_SESSION['status'] = "Login Successfully";
               $_SESSION['status_code'] = "success"; 
               header("refresh: 0; url= ../users/Student/student-i.php"); 
            }else if($con['usertype'] == "Student" && $grades_status == "Pending"){
               $_SESSION['status'] = "Login Successfully";
               $_SESSION['status_code'] = "success"; 
               header("refresh: 0; url= ../users/Student/student-ii.php"); 
            }else if($con['usertype'] == "Student" && $grades_status == "Disapproved"){
               $_SESSION['status'] = "Login Successfully";
               $_SESSION['status_code'] = "success"; 
               header("refresh: 0; url= ../users/Student/student-ii.php"); 
            }else if($con['usertype'] == "Student" && $grades_status == "Approved"){
               $_SESSION['status'] = "Login Successfully";
               $_SESSION['status_code'] = "success"; 
               header("refresh: 0; url= ../users/Student/student-iii.php"); 
            }  
         }
         else 
         {
            $_SESSION['status'] = "Unsuccessfully Login!!Account isn't Exist.Please Check Your Input!!";
            $_SESSION['status_code'] = "error";     
            header("location: ../signin/universal-signin.php");
         }
      }
   }
?>