<?php
    use PHPMailer\PHPMailer\PHPMailer;

    session_start();
    include "../../source/includes/config.php";
    include("../../source/includes/alertmessage.php");

    function generate_password($len = 12){
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
        $password = substr( str_shuffle( $chars ), 0, $len );
        return $password;
    }

//Profile//
    if(isset($_POST['update_adviser_profile']))
    {
        $Adviserid = $_POST['adviserid'];
        $Firstname = $_POST['firstname'];
        $Lastname = $_POST['lastname'];
        $Email = $_POST['email'];
        $Contact = $_POST['contact'];

        $check_admin = mysqli_query($connection,"SELECT * FROM tbluser WHERE id='$Adviserid'");
        while($sa=mysqli_fetch_array($check_admin))
        {
            $firstname = $sa['firstname'];
            $lastname = $sa['lastname'];
            $contact = $sa['contact'];
            $email = $sa['email'];
        }

        if($Firstname == $firstname && $Lastname == $lastname && $Contact == $contact && $Email == $email)
        {
            $_SESSION['status'] = "Nothing To be Updated!!";
            $_SESSION['status_code'] = "info";
            header("location:adviser-profile.php"); 
        }
        else
        {
            if($Email == $email && $Firstname == $firstname && $Lastname == $lastname && $Contact == $contact)
            {
                $_SESSION['status'] = "Email Already Exist!!";
                $_SESSION['status_code'] = "info";
                header("location:adviser-profile.php"); 
            }
            else if($Email != $email)
            {
                $sql1 = "UPDATE tbluser SET firstname='$Firstname',lastname='$Lastname',contact='$Contact',email='$Email' WHERE id='$Adviserid'";
                if(mysqli_query($connection,$sql1))
                {
                    session_destroy();
                    $_SESSION['status'] = "Successfully Sign out";
                    $_SESSION['status_code'] = "success";
                    header("location: ../../signin/universal-signin.php");                
                }
                else
                {
                    $_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data!!";
                    $_SESSION['status_code'] = "error";
                    header("location:adviser-profile.php");
                }
            }
            else
            {
                $sql2 = "UPDATE tbluser SET firstname='$Firstname',lastname='$Lastname',contact='$Contact' WHERE id='$Adviserid'";
                if(mysqli_query($connection,$sql2))
                {
                    $_SESSION['status'] = "Successfully Updated!!";
                    $_SESSION['status_code'] = "success";
                    header("location:adviser-profile.php");                  
                }
                else
                {
                    $_SESSION['status'] = "Unsuccessfully Updated.. Please check The input Data!!";
                    $_SESSION['status_code'] = "error";
                    header("location:adviser-profile.php");
                }
            }
        }
    }

    if(isset($_POST['update_password']))
    {   
        $Adviserid = $_POST['adviserid'];
        $Password = $_POST['password'];

        $check_pass = mysqli_query($connection,"SELECT * FROM tbluser WHERE id='$Adviserid'");
        while($sa=mysqli_fetch_array($check_pass))
        {
            $password = $sa['password'];
        }
        if($Password == $password)
        {
            $_SESSION['status'] = "Nothing To be Updated!!";
            $_SESSION['status_code'] = "info";
            header("location:adviser-profile.php"); 
        }
        else
        {
            $sql = "UPDATE tbluser SET password='$Password' WHERE id='$Adviserid'";
            if(mysqli_query($connection,$sql))
            {
                $_SESSION['status'] = "Successfully Updated!!";
                $_SESSION['status_code'] = "success";
                header("location:adviser-profile.php");                  
            }
            else
            {
                $_SESSION['status'] = "Unsuccessfully Updated.. Please check The input Data!!";
                $_SESSION['status_code'] = "error";
                header("location:adviser-profile.php");
            }
        }
    }
//Profile//

// Student Data MAnage //
// Current Student Enrolled //
    // Start Student Add Data //
    if(isset($_POST['addStudent']))
    {
        $curriculum = mysqli_real_escape_string($connection,$_POST['currid']);
        $Firstname = mysqli_real_escape_string($connection,$_POST['firstname']);
        $Lastname = mysqli_real_escape_string($connection,$_POST['lastname']);
        $Middle = mysqli_real_escape_string($connection,$_POST['middle']);
        $Suffix = mysqli_real_escape_string($connection,$_POST['suffix']);
        $Email = mysqli_real_escape_string($connection,$_POST['email']);
        $Student_status = mysqli_real_escape_string($connection,$_POST['college_status']);
        $Contact = mysqli_real_escape_string($connection,$_POST['contact']);
        $Courseid = mysqli_real_escape_string($connection,$_POST['courseid']);
        $Collegeid = mysqli_real_escape_string($connection,$_POST['collegeid']);
        $Adviserid = mysqli_real_escape_string($connection,$_POST['adviserid']);

        $Status="Enrolled"; 
        $FIRSTNAME = ucfirst($Firstname);
        $LASTNAME = ucfirst($Lastname);
        $MIDDLE = ucfirst($Middle).'.';
        $SUFFIX = ucfirst($Suffix);
        $Status = "Enrolled";

        $check_email = mysqli_query($connection,"SELECT email FROM tblstudent_list WHERE status='$Status' and email='$Email' and curri_id_fk='$curriculum'");
        if(mysqli_num_rows($check_email) > 0)
        {
            $get = mysqli_fetch_array($check_email);
            $stud_email = $get['email'];
            $_SESSION['status'] = "Email Already Existed!!";
            $_SESSION['status_code'] = "info";
            header("location:adviser-studentlists.php"); 
        }
        else
        {      
            $sql="INSERT INTO `tblstudent_list`(`firstname`,`middle`, `lastname`,`suffix`,`status`,`college_status`,`email`, `contact`,`college_id_fk`,`course_id_fk`,`curri_id_fk`,`adviser_id_fk`) VALUES ('$FIRSTNAME','$MIDDLE','$LASTNAME','$SUFFIX','$Status','$Student_status','$Email','$Contact','$Collegeid',$Courseid,'$curriculum','$Adviserid')";
            if(mysqli_query($connection,$sql))
            {
                $_SESSION['status'] = "Successfully Added!!";
                $_SESSION['status_code'] = "success";
                header("location:adviser-studentlists.php"); 
            }    
            else
            {
                $_SESSION['status'] = "Unsuccessfully Added.Please Check your input or Contact the Personnel incharge!!";
                $_SESSION['status_code'] = "error";
                header("location:adviser-studentlists.php"); 
            }
        }
    }
    // End Student Add Data //

    // Start Student Edit Data //
    if(isset($_POST['editStudent']))
    {
        $Collegeid = mysqli_real_escape_string($connection,$_POST['collegeid']);
        $Studentid = mysqli_real_escape_string($connection,$_POST['studentid']);
        $Adviserid = mysqli_real_escape_string($connection,$_POST['adviserid']);
        // Nothing to be updated at top //
        $curri_id = mysqli_real_escape_string($connection,$_POST['curr_code']);
        $Firstname = mysqli_real_escape_string($connection,$_POST['firstname']);
        $Lastname = mysqli_real_escape_string($connection,$_POST['lastname']);
        $Middle = mysqli_real_escape_string($connection,$_POST['middle']);
        $Suffix = mysqli_real_escape_string($connection,$_POST['suffix']);
        $Status = mysqli_real_escape_string($connection,$_POST['status']);
        $Student_status = mysqli_real_escape_string($connection,$_POST['college_status']);
        $Email = mysqli_real_escape_string($connection,$_POST['email']);
        $Contact = mysqli_real_escape_string($connection,$_POST['contact']);
        $Courseid = mysqli_real_escape_string($connection,$_POST['courseid']);

        $FIRSTNAME = ucfirst($Firstname);
        $MIDDLE = ucfirst($Middle);
        $LASTNAME = ucfirst($Lastname);
        $SUFFIX = ucfirst($Suffix);
        $Status = "Enrolled";

        $Check_info = mysqli_query($connection,"SELECT * FROM tblstudent_list WHERE id='$Studentid' and status='$Status'");
        while($fa=mysqli_fetch_array($Check_info))
        {
            $firstname = $fa['firstname'];
            $lastname = $fa['lastname'];
            $middle = $fa['middle'];
            $suffix = $fa['suffix'];
            $status = $fa['status'];
            $student_status = $fa['college_status'];
            $email = $fa['email'];
            $contact = $fa['contact'];
            $courseid = $fa['course_id_fk'];
            $curri = $fa['curri_id_fk'];
        }

        if($curri_id == $curri && $Firstname == $firstname && $Lastname == $lastname && $Middle == $middle && $Email == $email && $Suffix == $suffix && $Status == $status && $Student_status == $student_status && $Contact == $contact && $Courseid == $courseid)
        {
            $_SESSION['status'] = "Nothing To Be Updated!!";
            $_SESSION['status_code'] = "info";
            header("location:adviser-studentlists.php"); 
        }
        else
        {
            $save = "UPDATE tblstudent_list SET firstname='$FIRSTNAME',middle='$MIDDLE',lastname='$LASTNAME',suffix='$SUFFIX',status='$Status',college_status='$Student_status',email='$Email',contact='$Contact',curri_id_fk='$curri_id',course_id_fk='$Courseid',adviser_id_fk='$Adviserid' WHERE id='$Studentid'";
            if(mysqli_query($connection,$save))
            {
                $_SESSION['status'] = "Successfully Updated!!";
                $_SESSION['status_code'] = "success";
                header("location:adviser-studentlists.php"); 
            }    
            else
            {
                $_SESSION['status'] = "Unsuccessfully Updated.Please Check your input or Contact the Personnel incharge!!";
                $_SESSION['status_code'] = "error";
                header("location:adviser-studentlists.php");
            }
        }
    }
    // End Student Edit Data //

    // Start Student Delete Single Data //
    if(isset($_POST['deleteStudent']))
    {
        $id = $_POST['id'];
        $Unenrolled = "Unenrolled";
        $delStud = "UPDATE tblstudent_list SET status='$Unenrolled' WHERE id='$id'";

        if(mysqli_query($connection,$delStud))
        {
            $_SESSION['status'] = "Successfully Deactivate Account!!";
            $_SESSION['status_code'] = "success";
            header("location:adviser-studentlists.php");
        }
        else
        {
            $_SESSION['status'] = "Unsuccessfully Deactivate Account!!.. Please check The input Data or Contact Personnel incharge!!";
            $_SESSION['status_code'] = "error";
            header("location:adviser-studentlists.php");
        }
    }
    // End Student Delete Single Data //

    // Start Student Delete All Data //
    if(isset($_POST['deleteAllStudent']))
    {
        $courseid = $_POST['courseid'];
        $adviserid = $_POST['adviserid'];
        $Unenrolled = "Unenrolled";

        $delStud = "UPDATE tblstudent_list SET status='$Unenrolled' WHERE course_id_fk='$courseid' and adviser_id_fk='$adviserid'";
        if(mysqli_query($connection,$delStud))
        {
            $_SESSION['status'] = "Successfully Deactivate All Account!!";
            $_SESSION['status_code'] = "success";
            header("location:adviser-studentlists.php");
        }
        else
        {
            $_SESSION['status'] = "Unsuccessfully Deactivate All Account.. Please check The input Data or Contact Personnel incharge!!";
            $_SESSION['status_code'] = "error";
            header("location:adviser-studentlists.php");
        }
    }
    // End Student Delete All Data //

    // Start Student Approve Data //
    if (isset($_POST['approved']))
    {
        $StudentID = mysqli_real_escape_string($connection,$_POST['student_id']);
        $CurrID = mysqli_real_escape_string($connection,$_POST['currid']);
        
        $getsec = mysqli_query($connection,"SELECT * FROM tblrequest_account WHERE id='$StudentID'");
        while($ew = mysqli_fetch_array($getsec))
        {
            $Student_first = $ew['firstname'];
            $Student_last = $ew['lastname'];
            $Student_email = $ew['email'];
            $Student_pass = $ew['password'];
            $Student_type = $ew['req_usertype'];
            $Student_contact = $ew['contact'];
            $Student_sec = $ew['section'];
            $Student_year = $ew['yearlevel'];
            $Student_collegeid = $ew['college_id_fk'];
            $Student_courseid = $ew['course_id_fk'];

            $YearSec = $Student_year.''.$Student_sec;
        }   

        $cour_code = mysqli_query($connection,"SELECT * FROM tblcourse WHERE id='$Student_courseid'");
        while($cour=mysqli_fetch_array($cour_code))
        {
            $CourseCode = $cour['coursecode'];
        }
        $user_save = "INSERT INTO tbluser (firstname,lastname,email,password,usertype,contact,curri_id,college_id_fk,course_id_fk,yearlevel,section) VALUES ('$Student_first','$Student_last','$Student_email','$Student_pass','$Student_type','$Student_contact',$CurrID,'$Student_collegeid','$Student_courseid','$Student_year','$Student_sec')";   
        $user_del = "DELETE FROM tblrequest_account WHERE id='$StudentID'";

        $set_id = mysqli_query($connection,"SELECT * FROM tblrequest_account");
        while($fa = mysqli_fetch_array($set_id))
        {
            $reqid = $fa['id'];
        }

        $c = "ALTER TABLE tblrequest_account AUTO_INCREMENT = $reqid";

        //send credentials to email
        require_once '../../PHPMailer/PHPMailer.php';
        require_once '../../PHPMailer/SMTP.php';
        require_once '../../PHPMailer/Exception.php';
        
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
        $mail->addAddress($Student_email);  

        $mail->Subject = 'Online Pre-Advising';
        $mail->Body    = "<p>Greetings: <br><br> 
            Student Account: <br><br>Your email is <b>$Student_email</b><br>
            Your Password is <b>$Student_pass</b><br>
            Student course is <b>$CourseCode</b><br>
            Student Year and Section is <b>$YearSec</b></br> <br><br>
            <br><br><p><b>Note:</b><br>
            <b>Your Request Has Been Approved By your Adviser.</b><a href='wmsu-onlinepreadvising.com'><b>ONLINE PRE-ADVISING</b></a><br>
            Now You may login in the Website..<br>
            1. The password will be change to profile settings after loging to your account.<br>
            2. Make sure you remember your password before changing it.<br>
            3. The email cannot be change (Unique).<br>
            4. Create and Keep the records of the Credentials of accounts for future use.<br>
            5. Please use <b><font color='#4285F4'>G</font><font color='#DB4437'>o</font><font color='#F4B400'>o</font><font color='#4285F4'>g</font><font color='#0F9D58'>l</font><font color='#DB4437'>e</font></b> Chrome browser, if possible.<br>
            6. Please ignore this message if you already received this message previously.</p>";

        if($mail->send() && mysqli_query($connection, $user_save) && mysqli_query($connection, $user_del) && mysqli_query($connection, $c)){
            $_SESSION['status'] = "Successfully Approved!!";
            $_SESSION['status_code'] = "success";
            header("location:adviser-studentlists.php"); 
        }
        else
        {
            $_SESSION['status'] = "Unsuccessfully Approved.Please Check your input or Contact the Personnel incharge!!";
            $_SESSION['status_code'] = "error";
            header("location:adviser-studentlists.php");
        }
    }
    // End Student Approve Data //

    // Start Student Disapprove Data //
    if (isset($_POST['disapproved']))
    {
        $StudentID = mysqli_real_escape_string($connection,$_POST['student_id']);

        $getsec = mysqli_query($connection,"SELECT * FROM tblrequest_account WHERE id='$StudentID'");
        while($ew = mysqli_fetch_array($getsec))
        {
            $Student_email = $ew['email'];
        } 
        
        $user_del = "DELETE FROM tblrequest_account WHERE id='$StudentID'";

        $set_id = mysqli_query($connection,"SELECT * FROM tblrequest_account");
        while($fa = mysqli_fetch_array($set_id))
        {
            $reqid = $fa['id'];
        }

        $d = "ALTER TABLE tblrequest_account AUTO_INCREMENT = $reqid";

        //send credentials to email
        require_once '../../PHPMailer/PHPMailer.php';
        require_once '../../PHPMailer/SMTP.php';
        require_once '../../PHPMailer/Exception.php';
        
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
        $mail->addAddress($Student_email);  

        $mail->Subject = 'Online Pre-Advising';
        $mail->Body    = "<p>Greetings: <br><br> 
            Sorry Your Request has been Decline by your Adviser. Please Contact Your Department to provided for more info of your Request. <br<br>
            Thank You. Have A Nice Day..</p>";
        
        if($mail->send() && mysqli_query($connection, $user_del) && mysqli_query($connection, $d)){
            $_SESSION['status'] = "Successfully Disapproved!!";
            $_SESSION['status_code'] = "success";
            header("location:adviser-studentlists.php"); 
        }
        else
        {
            $_SESSION['status'] = "Unsuccessfully Disapproved.Please Check your input or Contact the Personnel incharge!!";
            $_SESSION['status_code'] = "error";
            header("location:adviser-studentlists.php");
        }
    }
    // End Student Disapprove Data //
// Current Student Enrolled //

// Uncurrent Student Unenrolled //
    // Start Student Edit Data //
    if(isset($_POST['editStudents']))
    {
        $Collegeid = mysqli_real_escape_string($connection,$_POST['collegeid']);
        $Studentid = mysqli_real_escape_string($connection,$_POST['studentid']);
        $Adviserid = mysqli_real_escape_string($connection,$_POST['adviserid']);
        // Nothing to be updated at top //
        $curri_id = mysqli_real_escape_string($connection,$_POST['curr_code']);
        $Firstname = mysqli_real_escape_string($connection,$_POST['firstname']);
        $Lastname = mysqli_real_escape_string($connection,$_POST['lastname']);
        $Middle = mysqli_real_escape_string($connection,$_POST['middle']);
        $Suffix = mysqli_real_escape_string($connection,$_POST['suffix']);
        $Status = mysqli_real_escape_string($connection,$_POST['status']);
        $Student_status = mysqli_real_escape_string($connection,$_POST['college_status']);
        $Email = mysqli_real_escape_string($connection,$_POST['email']);
        $Contact = mysqli_real_escape_string($connection,$_POST['contact']);
        $Courseid = mysqli_real_escape_string($connection,$_POST['courseid']);

        $FIRSTNAME = ucfirst($Firstname);
        $MIDDLE = ucfirst($Middle);
        $LASTNAME = ucfirst($Lastname);
        $SUFFIX = ucfirst($Suffix);

        $Check_info = mysqli_query($connection,"SELECT * FROM tblstudent_list WHERE id='$Studentid'");
        while($fa=mysqli_fetch_array($Check_info))
        {
            $firstname = $fa['firstname'];
            $lastname = $fa['lastname'];
            $middle = $fa['middle'];
            $suffix = $fa['suffix'];
            $status = $fa['status'];
            $student_status = $fa['college_status'];
            $email = $fa['email'];
            $contact = $fa['contact'];
            $courseid = $fa['course_id_fk'];
            $curri = $fa['curri_id_fk'];
        }

        if($curri_id == $curri && $Firstname == $firstname && $Lastname == $lastname && $Middle == $middle && $Suffix == $suffix && $Status == $status && $Student_status == $student_status && $Contact == $contact && $Courseid == $courseid)
        {
            $_SESSION['status'] = "Nothing To Be Updated!!";
            $_SESSION['status_code'] = "info";
            header("location:adviser-oldstudentlists.php"); 
        }
        else
        {
            $save = "UPDATE tblstudent_list SET firstname='$FIRSTNAME',middle='$MIDDLE',lastname='$LASTNAME',suffix='$SUFFIX',status='$Status',college_status='$Student_status',email='$Email',contact='$Contact',curri_id_fk='$curri_id',course_id_fk='$Courseid',adviser_id_fk='$Adviserid' WHERE id='$Studentid'";
            if(mysqli_query($connection,$save))
            {
                $_SESSION['status'] = "Successfully Updated!!";
                $_SESSION['status_code'] = "success";
                header("location:adviser-oldstudentlists.php"); 
            }    
            else
            {
                $_SESSION['status'] = "Unsuccessfully Updated.Please Check your input or Contact the Personnel incharge!!";
                $_SESSION['status_code'] = "error";
                header("location:adviser-oldstudentlists.php");
            }
        }
    }
    // End Student Edit Data //

    // Start Student Delete Single Data //
    if(isset($_POST['deleteStudents']))
    {
        $id = $_POST['id'];
        $delStud = "DELETE FROM tblstudent_list WHERE id='$id'";
        $c = "ALTER TABLE tblstudent_list AUTO_INCREMENT = 1";

        if(mysqli_query($connection,$delStud) && mysqli_query($connection,$c))
        {
            $_SESSION['status'] = "Successfully Delete!";
            $_SESSION['status_code'] = "success";
            header("location:adviser-oldstudentlists.php");
        }
        else
        {
            $_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data or Contact Personnel incharge!!";
            $_SESSION['status_code'] = "error";
            header("location:adviser-oldstudentlists.php");
        }
    }
    // End Student Delete Single Data //
// Uncurrent Student Unenrolled //
// Student Data Manage //

// Start Student Check Subject //
    if(isset($_POST['check']))
    {
        $studid = $_POST['studentid'];
        $currid = $_POST['curr_id'];

        $_SESSION['studentid'] = $studid;
        $_SESSION['currid'] = $currid;
        header("location: adviser-loadsubjects.php");
    }
// End Check Student Subject //

// Start Student Check old Subject //
if(isset($_POST['old_check']))
{
    $studid = $_POST['studentid'];
    $currid = $_POST['curr_id'];

    $_SESSION['studentid'] = $studid;
    $_SESSION['currid'] = $currid;
    header("location: adviser-oldloadsubjects.php");
}
// End Check Student old Subject //

// Start of Student Session Add Page //
if(isset($_POST['session-add']))
{
    $studid = $_POST['studentid'];
    $currid = $_POST['curr_id'];

    $_SESSION['studentid'] = $studid;
    $_SESSION['currid'] = $currid;
    header("location: adviser-addsubject.php");
}
// End of Student Session Add Page //

// Start of Student Session Send Page //
    if(isset($_POST['session-send']))
    {
        $studid = $_POST['studentid'];
        $currid = $_POST['curr_id'];

        $_SESSION['studentid'] = $studid;
        $_SESSION['currid'] = $currid;
        header("location: adviser-sendsubject.php");
    }
// End of Student Session Send Page //

// Start of Session Curriculum //
    if (isset($_POST['getidbtn'])){
                        
        $CurrID=mysqli_real_escape_string($connection,$_POST['curri_id']);
        
        $_SESSION['currid'] =$CurrID;
        header("location:adviser-loadstudents.php");
    }
// End of Session Curriculum //

// Create All Subject //
    if(isset($_POST['session_curi']))
    {
        $Currid = $_POST['currid'];

        $_SESSION['currid'] = $Currid;
        header("location: adviser-loadstudents.php");
    }
// Create All Subject //

// Start Student Subjects Data //
    // Start Approved final Pre-advised Subject for Student //
    if(isset($_POST['approved_add_send_sub']))
    {
        $Currid = $_POST['currid'];
        $Studid = $_POST['studid'];
        $Adviserid = $_POST['adviserid'];
        $Courseid = $_POST['courseid'];
        $Status = "Pending";
        $Approved = "Approved";

        $update_status = "UPDATE tbladviser_send_sub_to_stud SET status='$Approved' WHERE adviser_id_fk='$Adviserid' and student_id_fk='$Studid' and curri_id_fk='$Currid' and course_id_fk='$Courseid'";
        if(mysqli_query($connection,$update_status)){}

        $get_student = mysqli_query($connection,"SELECT * FROM tblstudent_list WHERE id='$Studid' and status'Enrolled'");
        while($s=mysqli_fetch_array($get_student))
        {
            $StudEmail = $s['email'];
            $StudCourseid =$s['course_id_fk'];
        }
        $get_course = mysqli_query($connection,"SELECT * FROM tblcourse WHERE id='$StudCourseid'");
        while($c=mysqli_fetch_array($get_course))
        {
            $coursename = $c['course'];
        }

        $get_adviser = mysqli_query($connection,"SELECT * FROM tbluser WHERE id='$Adviserid'");
        while($a=mysqli_fetch_array($get_adviser))
        {
            $Fullname = ucfirst($a['lastname']).', '.ucfirst($a['firstname']);
        }

        $select_add_send = mysqli_query($connection,"SELECT * FROM tbladviser_send_sub_to_stud WHERE adviser_id_fk='$Adviserid' and student_id_fk='$Studid' and curri_id_fk='$Currid' and course_id_fk='$Courseid'");
        while($g=mysqli_fetch_array($select_add_send))
        {
            $Send_id = $g['id'];
            $send_status = $g['status'];
        }
        if($send_status == $Approved);
        {
            $select_add_send = mysqli_query($connection,"SELECT * FROM tbladviser_send_sub_to_stud WHERE adviser_id_fk='$Adviserid' and student_id_fk='$Studid' and curri_id_fk='$Currid' and course_id_fk='$Courseid'");
            foreach($select_add_send as $get_sub)
            {
                $Lec = $get_sub['lec'];
                $Lab = $get_sub['lab'];
                $Units = $get_sub['units'];
                $Semester = $get_sub['semester'];
                $YearLevel = $get_sub['yearlevel'];
                $SchoolYear = $get_sub['school_year'];
                $Subject_id_fk = $get_sub['subject_id_fk'];
                $College_id_fk = $get_sub['college_id_fk'];

                $get_SY = mysqli_query($connection,"SELECT * FROM tblschool_year WHERE status='Activated'");
                while($sy=mysqli_fetch_array($get_SY))
                {
                    $SY_pre = $sy['school_year'];
                }

                $check_subId_pre = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE subject_id_fk='$Subject_id_fk' and adviser_id_fk='$Adviserid' and student_id='$Studid' and curri_id='$Currid' and course_id_fk='$Courseid'");
                while($g=mysqli_fetch_array($check_subId_pre))
                {
                    $SubID_PRE = $g['id'];
                    $subject_id_pre = $g['subject_id_fk'];
                    $remarks_pre = $g['remarks'];
                    $grades_pre = $g['grades'];
                    $sy_pre = $g['school_year'];
                    $stud_id_pres = $g['student_id'];
                    $currid_pres = $g['curri_id'];
                    $course_id_pres = $g['course_id_fk'];
                }
                if($subject_id_pre == $Subject_id_fk && $grades_pre == "" && $remarks_pre == "" && $sy_pre == "" && $Studid == $stud_id_pres && $Currid == $currid_pres && $Adviserid == $Adviserid && $Courseid == $course_id_pres)
                {
                    //$update_sub_pre = "UPDATE tbladviser_presubject SET school_year='$SY_pre' WHERE subject_id_fk='$subject_id_pre' and adviser_id_fk='$Adviserid' and student_id='$Studid' and curri_id='$Currid' and course_id_fk='$Courseid'";
                    //if(mysqli_query($connection,$update_sub_pre)){}
                    $del = "DELETE FROM tbladviser_presubject WHERE grades='0' and remarks='0' and school_year='0' and subject_id_fk='$subject_id_pre' and adviser_id_fk='$Adviserid' and student_id='$Studid' and curri_id='$Currid' and course_id_fk='$Courseid'";
                    if(mysqli_query($connection,$del)){}
                }
                else
                {
                    $insert_sub = "INSERT INTO tbladviser_presubject (lec,lab,units,school_year,yearlevel,semester,adviser_id_fk,student_id,subject_id_fk,curri_id,college_id_fk,course_id_fk) VALUES ('$Lec','$Lab','$Units','$SchoolYear','$YearLevel','$Semester','$Adviserid','$Studid','$Subject_id_fk','$Currid','$College_id_fk','$Courseid')";
                    if(mysqli_query($connection,$insert_sub)){}
                }
            }

            //send credentials to email
            require_once '../../PHPMailer/PHPMailer.php';
            require_once '../../PHPMailer/SMTP.php';
            require_once '../../PHPMailer/Exception.php';
            
            $mail = new PHPMailer();
            
            $mail->isSMTP();
            $mail->Host = 'smtp.hostinger.ph';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;         // Enable SMTP authentication
            $mail->Username = 'advising@wmsuics.tech';  // SMTP username
            $mail->Password = 'Advising123_';  // SMTP password
            $mail->Port = 465;  // TCP port to connect to
            $mail->SMTPSecure = 'ssl';  // Enable TLS encryption, ssl also accepted

            //email settings
            $mail->isHTML(true); // Set email format to HTML
            $mail->setFrom('advising@wmsuics.tech','Online Pre-Advising');
            $mail->addAddress($StudEmail);  

            $mail->Subject = 'Online Pre-Advising';
            $mail->Body    = "<p>Greetings Student: <br><br> 
                Your Subject Has been Approved by your Adviser: <br>Your Adviser is <b>$Fullname</b><br>
                Your Course is <b>$coursename</b><br><br>
                Your Subject Lists:".
                "<table width='100%' style='margin-top:15px;' align='left class='table table-striped border'>". 
                    "<thead><tr>".
                        "<th><b>SN</b></th>".
                        "<th nowrap='nowrap'><b>Code</b></th>".
                        "<th nowrap='nowrap'><b>Title</b></th>".
                        "<th nowrap='nowrap'><b>Lec</b></th>".
                        "<th nowrap='nowrap'><b>Lab</b></th>".
                        "<th nowrap='nowrap'><b>Units</b></th>".
                        "<th nowrap='nowrap'><b>School Year</b></th>".
                    "</tr></thead><tbody>";
                $get_add_send = mysqli_query($connection,"SELECT * FROM tbladviser_send_sub_to_stud WHERE status='Approved' and adviser_id_fk='$Adviserid' and student_id_fk='$Studid' and curri_id_fk='$Currid' and course_id_fk='$Courseid' ORDER BY id");
                $d = 0;
                while($c = mysqli_fetch_array($get_add_send)){ $d++;
                    $subjectid = $c['subject_id_fk'];
                    $units = $c['units'];
                    $total_units = $total_units + $units;
                    $get_add_subject = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$subjectid'");
                    while($a=mysqli_fetch_array($get_add_subject)){
            $mail->Body.= 
                    "<tr>".
                        "<td nowrap='nowrap'><center>".$d."</center></td>".
                        "<td nowrap='nowrap'><center>".$a['subject_code']."</center></td>".
                        "<td nowrap='nowrap'><center>".$a['description']."</center></td>".
                        "<td nowrap='nowrap'><center>".$c['lec']."</center></td>".
                        "<td nowrap='nowrap'><center>".$c['lab']."</center></td>".
                        "<td nowrap='nowrap'><center>".$c['units']."</center></td>".
                        "<td nowrap='nowrap'><center>".$c['school_year']."</center></td>
                    </tr>";
                        }
                    }            
            $mail->Body.= "</tbody>".
                        "<tfoot>".
                            "<tr style='vertical-align: bottom;'>".
                            "<td></td>".
                            "<td></td>".
                            "<td><center><b>Total:</b></center></td>".
                            "<td><center></center></td>".
                            "<td></td>".
                            "<td><center><b>".$total_units."</b></center></td>".
                            "<td></td>".
                            "</tr>".
                        "</tfoot></table>";
    
            if($mail->send()){
                $_SESSION['status'] = "Successfully Send!!";
                $_SESSION['status_code'] = "success";
                header("location:adviser-sendsubject.php");
            }
            else
            {
                $_SESSION['status'] = "Unsuccessfully Send.Please Check your input or Contact the Personnel incharge!!";
                $_SESSION['status_code'] = "error";
                header("location:adviser-sendsubject.php");
            }
        }
    }
    // End Approved final Pre-advised Subject for Student //

    // Start Add Delete subject for Student //
    if(isset($_POST['delete_view_add_subject']))
    {
        $Add_id = $_POST['addid'];
        $select_del_id = "DELETE FROM tbladviser_send_sub_to_stud WHERE id='$Add_id'";
        $get_id_del = "ALTER TABLE tbladviser_send_sub_to_stud AUTO_INCREMENT = 1";

        if(mysqli_query($connection,$select_del_id) && mysqli_query($connection,$get_id_del))
        {
            $_SESSION['status'] = "Successfully Delete The Subject!!";
            $_SESSION['status_code'] = "success";
            header("location: adviser-sendsubject.php");
        }
        else
        {
            $_SESSION['status'] = "Unsuccessfully Delete. Please check your input or Contact the Personnel Incharge!!";
            $_SESSION['status_code'] = "error";
            header("location: adviser-sendsubject.php");
        }
    }
    // End Add Delete subject for Student //

    // Start Add Subject for students //
    if(isset($_POST['save_send']))
    {
        $all_Sub_id = $_POST['sub_id'];
        $Currid = $_POST['currid'];
        $Adviserid = $_POST['adviserid'];
        $Studid = $_POST['studid'];
        $Courseid = $_POST['courseid'];
        $Collegeid = $_POST['collegeid'];
        $Status = "Pending";

        $select_school_year = mysqli_query($connection,"SELECT * FROM tblschool_year WHERE status='Activated'");
        if(mysqli_num_rows($select_school_year) == 0)
        {
            $_SESSION['status'] = "School Year has not been Activated yet!! Please contact the Personnel Incharge..";
            $_SESSION['status_code'] = "info";
            header("location: adviser-sendsubject.php");
        }
        else
        {
            foreach($all_Sub_id as $sub)
            {
                $select_subject = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id IN($sub) and curr_id_fk='$Currid' and college_id_fk='$Collegeid' and course_id_fk='$Courseid'");
                while($s = mysqli_fetch_array($select_subject))
                {
                    $Subid = $s['id'];
                    $SubCode = $s['subject_code'];
                    $SubDes = $s['description'];
                    $SubLec = $s['lec'];
                    $SubLab = $s['lab'];
                    $SubUnits = $s['units'];
                    $SubYear = $s['yearlevel'];
                    $SubSem = $s['semester'];
                }

                $select_school_year = mysqli_query($connection,"SELECT * FROM tblschool_year WHERE status='Activated'");
                while($s=mysqli_fetch_array($select_school_year))
                {
                    $schoolYearId = $s['school_year'];
                }

                $select_send_sub = mysqli_query($connection,"SELECT * tbladviser_send_sub_to_stud WHERE adviser_id_fk='$Adviserid' and student_id_fk='$Studid' and subject_id_fk='$sub' and curri_id_fk='$Currid' and course_id_fk='$Courseid'");
                while($a = mysqli_fetch_array($select_send_sub))
                {
                    $sub_id = $a['subject_id_fk'];
                }

                if($Subid == $sub_id)
                {
                    $_SESSION['status'] = "Subject Already Exist!!";
                    $_SESSION['status_code'] = "info";
                    header("location: adviser-sendsubject.php");
                }
                else
                {
                    $add = "INSERT INTO tbladviser_send_sub_to_stud (lec,lab,units,yearlevel,semester,school_year,status,adviser_id_fk,student_id_fk,subject_id_fk,curri_id_fk,college_id_fk,course_id_fk) VALUES ('$SubLec','$SubLab','$SubUnits','$SubYear','$SubSem','$schoolYearId','$Status','$Adviserid','$Studid','$Subid','$Currid','$Collegeid','$Courseid')";
                    if(mysqli_query($connection,$add))
                    {
                        $_SESSION['status'] = "Successfully Added!!";
                        $_SESSION['status_code'] = "success";
                        header("location: adviser-sendsubject.php");
                    }
                    else
                    {
                        $_SESSION['status'] = "Unsuccessfully Added. Please check your input or Contact the Personnel Incharge!!";
                        $_SESSION['status_code'] = "error";
                        header("location: adviser-sendsubject.php");
                    }
                }
            }
        }
    }
    // End Add Subject for students //

    // Start Create Subject for Student //
    if(isset($_POST['create_sub']))
    {
        $Studentid = $_POST['studid'];
        $Currid = $_POST['currid'];
        $Collegeid = $_POST['collegeid'];
        $Courseid = $_POST['courseid'];
        $Subjectid = $_POST['sub_id'];
        $Adviserid = $_POST['adviserid'];

        foreach($Subjectid as $sub)
        {
            $Get_Sub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$sub'");
            while($su = mysqli_fetch_array($Get_Sub))
            {
                $Lec = $su['lec'];
                $Lab = $su['lab'];
                $Units = $su['units'];
                $YearLvl = $su['yearlevel'];
                $Semester = $su['semester'];
            }

            $check_subject = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE student_id='$Studentid' and subject_id_fk='$sub'");
            if(mysqli_num_rows($check_subject) > 0)
            {
                $_SESSION['status'] = "Subject Already Exist!!";
                $_SESSION['status_code'] = "info";
                header("location: adviser-loadsubjects.php");
            }
            else
            {
                $sql = "INSERT INTO tbladviser_presubject (lec,lab,units,yearlevel,semester,adviser_id_fk,student_id,subject_id_fk,curri_id,college_id_fk,course_id_fk) VALUES ('$Lec','$Lab','$Units','$YearLvl','$Semester','$Adviserid','$Studentid','$sub','$Currid','$Collegeid','$Courseid')";

                if(mysqli_query($connection,$sql))
                {
                    $_SESSION['status'] = "Successfully Added!!";
                    $_SESSION['status_code'] = "success";
                    header("location: adviser-loadsubjects.php");
                }
                else
                {
                    $_SESSION['status'] = "Unsuccessfully Added. Please check your input or Contact the Personnel Incharge!!";
                    $_SESSION['status_code'] = "error";
                    header("location: adviser-loadsubjects.php");
                }
            }
        }
    }
    // End Create Subject for Student //

    // Start Delete All Student Subject //
    if(isset($_POST['delete_all_subject']))
    {
        $Studid = $_POST['studentid'];
        $Currid = $_POST['currid'];

        $select_pre = "DELETE FROM tbladviser_presubject WHERE student_id='$Studid' and curri_id='$Currid'";

        $select_id = mysqli_query($connection,"SELECT * FROM tbladviser_presubject");
        while($fa = mysqli_fetch_array($select_id))
        {
            $ID = $fa['id'];
        }

        $d = "ALTER TABLE tbladviser_presubject AUTO_INCREMENT = 1";

        if(mysqli_query($connection,$select_pre) && mysqli_query($connection,$d))
        {
            $_SESSION['status'] = "Successfully Delete The Subject!!";
            $_SESSION['status_code'] = "success";
            header("location: adviser-loadsubjects.php");
        }
        else
        {
            $_SESSION['status'] = "Unsuccessfully Delete. Please check your input or Contact the Personnel Incharge!!";
            $_SESSION['status_code'] = "error";
            header("location: adviser-loadsubjects.php");
        }
    }
    // End Delete All Student Subject //

    // Start Send Delete Subject to Student //
    if(isset($_POST['delete_send_subject']))
    {
        $SendID = $_POST['send_subid'];

        $Del_send = "DELETE FROM tbladviser_send_sub_to_stud WHERE id='$SendID'";

        $select_send_id = mysqli_query($connection,"SELECT * FROM tbladviser_send_sub_to_stud");
        while($fa = mysqli_fetch_array($select_send_id))
        {
            $ID = $fa['id'];
        }
        $d = "ALTER TABLE tbladviser_send_sub_to_stud AUTO_INCREMENT = $ID";

        if(mysqli_query($connection,$Del_send) && mysqli_query($connection,$d))
        {
            $_SESSION['status'] = "Successfully Delete The Subject!!";
            $_SESSION['status_code'] = "success";
            header("location: adviser-loadsubjects.php");
        }
        else
        {
            $_SESSION['status'] = "Unsuccessfully Delete. Please check your input or Contact the Personnel Incharge!!";
            $_SESSION['status_code'] = "error";
            header("location: adviser-loadsubjects.php");
        }
    }
    // End Send Delete Subject to Student //
    
// First Year Subjects //
    // Start Save Grade Subject of Student //
    if(isset($_POST['but_update']))
    {
        if(isset($_POST['sub_list_id']))
        {
            $Studid = $_POST['studid'];
            $Currid = $_POST['currid'];
            
            foreach($_POST['sub_list_id'] as $updateid)
            {
                $grade = $_POST['grades_'.$updateid];
                $subject_idFK = $_POST['subject_id_fk_'.$updateid];
                $school_year = $_POST['SY_'.$updateid];

                if($updateid && $grade == "0" && $school_year == "" || $updateid && $grade != "0" && $school_year == "")
                {
                    $_SESSION['status'] = "Please check if you check and select something in Grades and School Year!!";
                    $_SESSION['status_code'] = "warning";
                    header("location: adviser-loadsubjects.php");
                }
                else
                {  
                    if($grade == "1.0" || $grade == "1.25" || $grade == "1.50" || $grade == "1.75" || $grade == "2.0" || $grade == "2.25" || $grade == "2.50" || $grade == "2.75" || $grade == "3.0" || $grade == "INC")
                    {
                        $Remarks = "PASSED";
                        $select_act_SY = mysqli_query($connection,"SELECT * FROM tblschool_year WHERE status='Activated'");
                        while($sy_c = mysqli_fetch_array($select_act_SY))
                        {
                            $school_year_act = $sy_c['school_year'];
                        }
                        $select_sy = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE id='$updateid'");
                        while($sy=mysqli_fetch_array($select_sy))
                        {
                            $SY_SUBID = $sy['id'];
                            $SY_SUBSY = $sy['school_year']; 
                            $Units_pre = $sy['units'];
                            $Grades_pre = $sy['grades'];
                            $Remarks_pre = $sy['remarks'];
                            if($Grades_pre == 0 && $Remarks_pre == 0)
                            {
                                if($grade == "INC")
                                {
                                    $total_grades = "INC";
                                }
                                else
                                {
                                    $total_grades = $Units_pre * $grade;
                                }
                            }
                            else if($Grades_pre != 0 && $Remarks_pre == "PASSED")
                            {
                                if($grade == "INC")
                                {
                                    $total_grades = "INC";
                                }
                                else
                                {
                                    $total_grades = $Units_pre * $grade;
                                }
                            }
                            else
                            {
                                $total_grades = $Units_pre * $grade;
                            }
                        }
                        if($updateid == $SY_SUBID && $school_year == $SY_SUBSY)
                        {
                            $sql = "UPDATE tbladviser_presubject SET grades='$grade',total_grades='$total_grades', remarks='$Remarks', school_year='$school_year' WHERE id='$updateid'";
                        }
                        else if($updateid == $SY_SUBID && $school_year != $SY_SUBSY)
                        {
                            $sql = "UPDATE tbladviser_presubject SET grades='$grade',total_grades='$total_grades', remarks='$Remarks', school_year='$school_year' WHERE id='$updateid'"; 
                        }
                        $getisnot_failed = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE id='$updateid'");
                        if(mysqli_num_rows($getisnot_failed) > 0)
                        {
                            $h=mysqli_fetch_array($getisnot_failed);
                            $SUbId_Passed = $h['subject_id_fk'];
                            $CourseId_Passed = $h['course_id_fk'];
                            $AdviseridFK = $h['adviser_id_fk'];
                            $check_del_pre = mysqli_query($connection,"SELECT * FROM tbladviser_send_sub_to_stud WHERE subject_id_fk='$SUbId_Passed' and adviser_id_fk='$AdviseridFK' and student_id_fk='$Studid' and curri_id_fk='$Currid' and course_id_fk='$CourseId_Passed'");
                            if(mysqli_num_rows($check_del_pre) > 0)
                            {
                                $del_pre_sub = "DELETE FROM tbladviser_send_sub_to_stud WHERE status='Approved' and subject_id_fk='$SUbId_Passed' and adviser_id_fk='$AdviseridFK' and student_id_fk='$Studid' and curri_id_fk='$Currid' and course_id_fk='$CourseId_Passed'";
                                $select_app_sub = "ALTER TABLE tbladviser_send_sub_to_stud AUTO_INCREMENT = 1";
                                if(mysqli_query($connection,$sql) && mysqli_query($connection,$del_pre_sub) && mysqli_query($connection,$select_app_sub))
                                {
                                    $_SESSION['status'] = "Successfully Updated The Grades!!";
                                    $_SESSION['status_code'] = "success";
                                    header("location: adviser-loadsubjects.php");
                                }
                                else
                                {
                                    $_SESSION['status'] = "Unsuccessfully Updated. Please check your input or Contact the Personnel Incharge!!";
                                    $_SESSION['status_code'] = "error";
                                    header("location: adviser-loadsubjects.php");
                                }
                            }
                        }
                        if(mysqli_query($connection,$sql))
                        {
                            $_SESSION['status'] = "Successfully Updated The Grades!!";
                            $_SESSION['status_code'] = "success";
                            header("location: adviser-loadsubjects.php");
                        }
                        else
                        {
                            $_SESSION['status'] = "Unsuccessfully Updated. Please check your input or Contact the Personnel Incharge!!";
                            $_SESSION['status_code'] = "error";
                            header("location: adviser-loadsubjects.php");
                        }
    
                        $get_sub_app = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE remarks='PASSED' and subject_id_fk='$subject_idFK' and student_id='$Studid' and curri_id='$Currid'");
                        foreach($get_sub_app as $ap)
                        {
                            $sub_id_fk = $ap['subject_id_fk'];
                            $CourSub = $ap['course_id_fk'];
                            $adviser_id_fk = $ap['adviser_id_fk'];
                            //For Prerequisite//
                            $Check_Sub = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_id='$sub_id_fk' and curri_id_fk='$Currid' and course_id_fk='$CourSub'");
                            foreach($Check_Sub as $u)
                            {
                                $subject_id = $u['subject_id'];
                                $subject_code = $u['subject_under'];
    
                                $search_sub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$subject_code' and curr_id_fk='$Currid' and course_id_fk='$CourSub'");
                                foreach($search_sub as $p)
                                {
                                    $subjectID = $p['id'];
                                    $SubjectCode = $p['subject_code'];
                                    $SubLec = $p['lec'];
                                    $SubLab = $p['lab'];
                                    $SubUnits = $p['units'];
                                    $SubYear = $p['yearlevel'];
                                    $SubSem = $p['semester'];
                                    $SubCollege = $p['college_id_fk'];
                                    $SubCuri = $p['curr_id_fk'];
                                    $SubCourse = $p['course_id_fk'];
    
                                    $check_idSUB = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE subject_id_fk='$subjectID' and adviser_id_fk='$adviser_id_fk' and student_id='$Studid' and curri_id='$SubCuri' and course_id_fk='$SubCourse'");
                                    if(mysqli_num_rows($check_idSUB) > 0)
                                    {
                                        $v=mysqli_fetch_array($check_idSUB);
                                        $SUB_id_pre = $v['subject_id_fk'];
                                        $SUB_Adviser_id = $v['adviser_id_fk'];
                                        $SUB_Stud_id = $v['student_id'];
                                        $SUB_Course_id = $v['course_id_fk'];
                                        $SUB_Curri_id = $v['curri_id'];
                                        $Grades_PRE = $v['grades'];
                                        $Remarks_PRE = $v['remarks'];                     
                                    }
    
                                    if($subjectID != $SUB_id_pre)
                                    {
                                        $del = "DELETE FROM tbladviser_presubject WHERE grades='0' and remarks='0' and school_year='0' and subject_id_fk='$subjectID' and adviser_id_fk='$adviser_id_fk' and student_id='$Studid' and curri_id='$Currid' and course_id_fk='$CourSub'";
                                        if(mysqli_query($connection,$del)){}

                                        $sqls = "INSERT INTO tbladviser_presubject (lec,lab,units,yearlevel,semester,adviser_id_fk,student_id,subject_id_fk,curri_id,college_id_fk,course_id_fk) VALUES ('$SubLec','$SubLab','$SubUnits','$SubYear','$SubSem','$adviser_id_fk','$Studid','$subjectID','$SubCuri','$SubCollege','$SubCourse')";
                                        $getisnot_failed = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE id='$updateid'");
                                        if(mysqli_num_rows($getisnot_failed) > 0)
                                        {
                                            $h=mysqli_fetch_array($getisnot_failed);
                                            $SUbId_Passed = $h['subject_id_fk'];
                                            $CourseId_Passed = $h['course_id_fk'];
                                            $AdviseridFK = $h['adviser_id_fk'];
                                            $check_del_pre = mysqli_query($connection,"SELECT * FROM tbladviser_send_sub_to_stud WHERE subject_id_fk='$SUbId_Passed' and status='Approved' and adviser_id_fk='$AdviseridFK' and student_id_fk='$Studid' and curri_id_fk='$Currid' and course_id_fk='$CourseId_Passed'");
                                            if(mysqli_num_rows($check_del_pre) > 0)
                                            {
                                                $del_pre_sub = "DELETE FROM tbladviser_send_sub_to_stud WHERE status='Approved' and subject_id_fk='$SUbId_Passed' and adviser_id_fk='$AdviseridFK' and student_id_fk='$Studid' and curri_id_fk='$Currid' and course_id_fk='$CourseId_Passed'";
                                                $select_app_sub = "ALTER TABLE tbladviser_send_sub_to_stud AUTO_INCREMENT = 1";
                                                if(mysqli_query($connection,$del_pre_sub) && mysqli_query($connection,$select_app_sub)){}
                                            }
                                        }
                                        if(mysqli_query($connection,$sqls))
                                        {
                                            $_SESSION['status'] = "Successfully Updated The Grades!!";
                                            $_SESSION['status_code'] = "success";
                                            header("location: adviser-loadsubjects.php");
                                        } 
                                        else
                                        {
                                            $_SESSION['status'] = "Unsuccessfully Updated. Please check your input or Contact the Personnel Incharge!!";
                                            $_SESSION['status_code'] = "error";
                                            header("location: adviser-loadsubjects.php");
                                        } 
                                    }           
                                }
                            }
                        }
                    }
                    else if($grade == "CREDITED")
                    {
                        $Remarks = "PASSED";
                        $select_sy = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE id='$updateid'");
                        while($sy=mysqli_fetch_array($select_sy))
                        {
                            $SY_SUBID = $sy['id'];
                            $SY_SUBSY = $sy['school_year']; 
                            $Units_pre = $sy['units'];
                            $Grades_pre = $sy['grades'];
                            $Remarks_pre = $sy['remarks'];
                            if($Grades_pre == 0 && $Remarks_pre == 0)
                            {
                                if($grade == "CREDITED")
                                {
                                    $total_grades = "CREDITED";
                                }
                                else
                                {
                                    $total_grades = $Units_pre * $grade;
                                }
                            }
                            else if($Grades_pre != 0 && $Remarks_pre == "PASSED")
                            {
                                if($grade == "CREDITED")
                                {
                                    $total_grades = "CREDITED";
                                }
                                else
                                {
                                    $total_grades = $Units_pre * $grade;
                                }
                            }
                        }
                        $sql = "UPDATE tbladviser_presubject SET grades='$grade',total_grades='$total_grades', remarks='$Remarks' WHERE id='$updateid'";   
                        if(mysqli_query($connection,$sql))
                        {
                            $_SESSION['status'] = "Successfully Updated The Grades!!";
                            $_SESSION['status_code'] = "success";
                            header("location: adviser-loadsubjects.php");
                        }   
    
                        $get_sub_app = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE remarks='PASSED' and subject_id_fk='$subject_idFK' and student_id='$Studid' and curri_id='$Currid'");
                        foreach($get_sub_app as $ap)
                        {
                            $sub_id_fk = $ap['subject_id_fk'];
                            $CourSub = $ap['course_id_fk'];
                            $adviser_id_fk = $ap['adviser_id_fk'];
                            //For Prerequisite//
                            $Check_Sub = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_id='$sub_id_fk' and curri_id_fk='$Currid' and course_id_fk='$CourSub'");
                            foreach($Check_Sub as $u)
                            {
                                $subject_id = $u['subject_id'];
                                $subject_code = $u['subject_under'];
    
                                $search_sub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$subject_code' and curr_id_fk='$Currid' and course_id_fk='$CourSub'");
                                foreach($search_sub as $p)
                                {
                                    $subjectID = $p['id'];
                                    $SubjectCode = $p['subject_code'];
                                    $SubLec = $p['lec'];
                                    $SubLab = $p['lab'];
                                    $SubUnits = $p['units'];
                                    $SubYear = $p['yearlevel'];
                                    $SubSem = $p['semester'];
                                    $SubCollege = $p['college_id_fk'];
                                    $SubCuri = $p['curr_id_fk'];
                                    $SubCourse = $p['course_id_fk'];
    
                                    $sqls = "INSERT INTO tbladviser_presubject (lec,lab,units,yearlevel,semester,adviser_id_fk,student_id,subject_id_fk,curri_id,college_id_fk,course_id_fk) VALUES ('$SubLec','$SubLab','$SubUnits','$SubYear','$SubSem','$adviser_id_fk','$Studid','$subjectID','$SubCuri','$SubCollege','$SubCourse')";
                                    if(mysqli_query($connection,$sqls))
                                    {
                                        $_SESSION['status'] = "Successfully Updated The Grades!!";
                                        $_SESSION['status_code'] = "success";
                                        header("location: adviser-loadsubjects.php");
                                    } 
                                    else
                                    {
                                        $_SESSION['status'] = "Unsuccessfully Updated. Please check your input or Contact the Personnel Incharge!!";
                                        $_SESSION['status_code'] = "error";
                                        header("location: adviser-loadsubjects.php");
                                    }    
                                }
                            }
                        }
                    }
                    else if($grade == "5.0" || $grade == "DRP")
                    {
                        $Remarks = "FAILED";
                        $select_sy = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE id='$updateid'");
                        while($sy=mysqli_fetch_array($select_sy))
                        {
                            $SY_SUBID = $sy['id'];
                            $SY_SUBSY = $sy['school_year']; 
                            $Units_pre = $sy['units'];
                            $Grades_pre = $sy['grades'];
                            $Remarks_pre = $sy['remarks'];
                            if($Grades_pre == 0 && $Remarks_pre == 0)
                            {
                                if($grade == "5.0")
                                {
                                    $total_grades = "FAILED";
                                }
                                else if($grade == "DRP")
                                {
                                    $total_grades = "FAILED";
                                }
                                else
                                {
                                    $total_grades = $Units_pre * $grade;
                                }
                            }
                            else if($Grades_pre != 0 && $Remarks_pre == "PASSED")
                            {
                                if($grade == "5.0")
                                {
                                    $total_grades = "FAILED";
                                }
                                else if($grade == "DRP")
                                {
                                    $total_grades = "FAILED";
                                }
                                else
                                {
                                    $total_grades = $Units_pre * $grade;
                                }
                            }
                            else if($Grades_pre != 0 && $Remarks_pre == "FAILED")
                            {
                                if($grade == "5.0")
                                {
                                    $total_grades = "FAILED";
                                }
                                else if($grade == "DRP")
                                {
                                    $total_grades = "FAILED";
                                }
                                else
                                {
                                    $total_grades = $Units_pre * $grade;
                                }
                            }
                        }
                        $sql = "UPDATE tbladviser_presubject SET grades='$grade',total_grades='$total_grades', remarks='$Remarks' WHERE id='$updateid'";   
                        $getisnot_failed = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE id='$updateid'");
                        if(mysqli_num_rows($getisnot_failed) > 0)
                        {
                            $h=mysqli_fetch_array($getisnot_failed);
                            $SUbId_Passed = $h['subject_id_fk'];
                            $CourseId_Passed = $h['course_id_fk'];
                            $AdviserIDFK = $h['adviser_id_fk'];
                            $check_del_pre = mysqli_query($connection,"SELECT * FROM tbladviser_send_sub_to_stud WHERE subject_id_fk='$SUbId_Passed' and status='Approved' and adviser_id_fk='$AdviserIDFK' and student_id_fk='$Studid' and curri_id_fk='$Currid' and course_id_fk='$CourseId_Passed'");
                            if(mysqli_num_rows($check_del_pre) > 0)
                            {
                                $del_pre_sub = "DELETE FROM tbladviser_send_sub_to_stud WHERE status='Approved' and subject_id_fk='$SUbId_Passed' and adviser_id_fk='$AdviserIDFK' and student_id_fk='$Studid' and curri_id_fk='$Currid' and course_id_fk='$CourseId_Passed'";
                                $select_app_sub = "ALTER TABLE tbladviser_send_sub_to_stud AUTO_INCREMENT = 1";
                                if(mysqli_query($connection,$sql) && mysqli_query($connection,$del_pre_sub) && mysqli_query($connection,$select_app_sub))
                                {
                                    $_SESSION['status'] = "Successfully Updated The Grades!!";
                                    $_SESSION['status_code'] = "success";
                                    header("location: adviser-loadsubjects.php");
                                }
                                else
                                {
                                    $_SESSION['status'] = "Unsuccessfully Updated. Please check your input or Contact the Personnel Incharge!!";
                                    $_SESSION['status_code'] = "error";
                                    header("location: adviser-loadsubjects.php");
                                }
                            }
                        } 
                        if(mysqli_query($connection,$sql))
                        {
                            $_SESSION['status'] = "Successfully Updated The Grades!!";
                            $_SESSION['status_code'] = "success";
                            header("location: adviser-loadsubjects.php");
                        }
                        else
                        {
                            $_SESSION['status'] = "Unsuccessfully Updated. Please check your input or Contact the Personnel Incharge!!";
                            $_SESSION['status_code'] = "error";
                            header("location: adviser-loadsubjects.php");
                        }
                    }
                }
            }
        }
    }
    // End Save Grade Subject of Student //

    // Start Update Subject Grade and Remarks of Student Sem //
    if(isset($_POST['update_sub']))
    {
        $SubPreId = $_POST['idPreSub'];
        $SubjectID = $_POST['subject_id'];
        $StudentID = $_POST['studentid'];
        $CurriID = $_POST['currid'];
        $CourseID = $_POST['courseid'];
        // Nothing to be update at the top //
        $Grade = $_POST['grade'];
        $Remarks = $_POST['remarks'];
        $SY = $_POST['sy'];

        $sql = "UPDATE tbladviser_presubject SET school_year='$SY' WHERE id='$SubPreId'";
    
        if(mysqli_query($connection,$sql))
        {
            $_SESSION['status'] = "Successfully Updated The Subject!!";
            $_SESSION['status_code'] = "success";
            header("location: adviser-loadsubjects.php");
        }
        else
        {
            $_SESSION['status'] = "Unsuccessfully Updated. Please check your input or Contact the Personnel Incharge!!";
            $_SESSION['status_code'] = "error";
            header("location: adviser-loadsubjects.php");
        }
    }
    // Start Update Subject Grade and Remarks of Student Sem //

    // Start Update Subject Grade and Remarks of Student Old Subject per Sem //
    if(isset($_POST['update_subs']))
    {
        $SubPreId = $_POST['idPreSub'];
        $SubjectID = $_POST['subject_id'];
        $StudentID = $_POST['studentid'];
        $CurriID = $_POST['currid'];
        $CourseID = $_POST['courseid'];
        // Nothing to be update at the top //
        $Grade = $_POST['grades'];
        $Remarks = $_POST['remarks'];
        $SY = $_POST['sy'];

        $sql = "UPDATE tbladviser_presubject SET grades='$Grade', remarks='$Remarks', school_year='$SY' WHERE id='$SubPreId'";
    
        if(mysqli_query($connection,$sql))
        {
            $_SESSION['status'] = "Successfully Updated The Subject!!";
            $_SESSION['status_code'] = "success";
            header("location: adviser-oldloadsubjects.php");
        }
        else
        {
            $_SESSION['status'] = "Unsuccessfully Updated. Please check your input or Contact the Personnel Incharge!!";
            $_SESSION['status_code'] = "error";
            header("location: adviser-oldloadsubjects.php");
        }
    }
    // Start Update Subject Grade and Remarks of Student Old Subject per Sem //

    // Start Delete Single Student Subject 1st 1st Sem//
    if(isset($_POST['delete_sub_1st_1st']))
    {
        $Subid = $_POST['subid'];

        $sql = "DELETE FROM tbladviser_presubject WHERE id='$Subid'";

        $get_sub = mysqli_query($connection,"SELECT * FROM tbladviser_presubject");
        while($fa = mysqli_fetch_array($get_sub))
        {
            $id = $fa['id'];
        }
        $c = "ALTER TABLE tbladviser_presubject AUTO_INCREMENT = $id";

        if(mysqli_query($connection,$sql) && mysqli_query($connection,$c))
        {
            $_SESSION['status'] = "Successfully Delete The Subject!!";
            $_SESSION['status_code'] = "success";
            header("location: adviser-loadsubjects.php");
        }
        else
        {
            $_SESSION['status'] = "Unsuccessfully Delete. Please check your input or Contact the Personnel Incharge!!";
            $_SESSION['status_code'] = "error";
            header("location: adviser-loadsubjects.php");
        }
    }
    // End Delete Single Student Subject 1st 1st Sem//

    // Start Delete Single Student Subject 1st 2nd Sem//
    if(isset($_POST['delete_sub_1st_2nd']))
    {
        $Subid = $_POST['subid'];

        $sql = "DELETE FROM tbladviser_presubject WHERE id='$Subid'";

        $get_sub = mysqli_query($connection,"SELECT * FROM tbladviser_presubject");
        while($fa = mysqli_fetch_array($get_sub))
        {
            $id = $fa['id'];
        }
        $c = "ALTER TABLE tbladviser_presubject AUTO_INCREMENT = $id";

        if(mysqli_query($connection,$sql) && mysqli_query($connection,$c))
        {
            $_SESSION['status'] = "Successfully Delete The Subject!!";
            $_SESSION['status_code'] = "success";
            header("location: adviser-loadsubjects.php");
        }
        else
        {
            $_SESSION['status'] = "Unsuccessfully Delete. Please check your input or Contact the Personnel Incharge!!";
            $_SESSION['status_code'] = "error";
            header("location: adviser-loadsubjects.php");
        }
    }
    // End Delete Single Student Subject 1st 2nd Sem//
// First Year Subjects /
// End Student Subjects Data //

// Start Function Student interraction of adviser //
//Start Send All Subject to Student//
if(isset($_POST['send_sub']))
{
    $Studentid = $_POST['studentid'];
    $Currid = $_POST['currid'];
    $Collegeid = $_POST['collegeid'];
    $Courseid = $_POST['courseid'];
    $Subjectid = $_POST['select_subid'];
    $Year = $_POST['year'];
    $Semester = $_POST['semester'];

    $check_stud = "DELETE FROM tbladviser_send_sub_to_stud WHERE status='Approved' and student_id_fk='$Studentid' and curri_id_fk='$Currid' and course_id_fk='$Courseid'";
    $gradstud = "DELETE FROM tblstudent_grade_sub WHERE submission_status='Approved' and student_id_fk='$Studentid' and curri_id_fk='$Currid' and course_id_fk='$Courseid'";
    $get_pdf = "DELETE FROM tblstudent_pdf WHERE student_id_fk='$Studentid' and curri_id_fk='$Currid' and course_id_fk='$Courseid'";
    $get_id_sub = mysqli_query($connection,"SELECT * FROM tbladviser_send_sub_to_stud");
    while($u=mysqli_fetch_array($get_id_sub))
    {
        $IdSEND = $u['id'];
    }
    $get_id_grade = mysqli_query($connection,"SELECT * FROM tblstudent_grade_sub");
    while($p=mysqli_fetch_array($get_id_grade))
    {
        $IdGRADE = $p['id'];
    }
    $get_id_pdf = mysqli_query($connection,"SELECT * FROM tblstudent_pdf");
    while($o=mysqli_fetch_array($get_id_pdf))
    {
        $IdPDF = $o['id'];
    }
    $a= "ALTER TABLE tbladviser_send_sub_to_stud AUTO_INCREMENT = 1";
    $b= "ALTER TABLE tblstudent_pdf AUTO_INCREMENT = 1";
    $c= "ALTER TABLE tblstudent_grade_sub AUTO_INCREMENT = 1";
    if(mysqli_query($connection,$check_stud) && mysqli_query($connection,$gradstud) && mysqli_query($connection,$get_pdf) && mysqli_query($connection,$a) && mysqli_query($connection,$b) && mysqli_query($connection,$c)){}

    foreach($Subjectid as $SubID)
    {
        $select_sub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$SubID'");
        while($fa = mysqli_fetch_array($select_sub))
        {
            $Lec = $fa['lec'];
            $Lab = $fa['lab'];
            $Units = $fa['units'];

            $check_sub = mysqli_query($connection,"SELECT * FROM tbladviser_send_sub_to_stud WHERE subject_id_fk='$SubID' and student_id_fk='$Studentid'");
            if(mysqli_num_rows($check_sub) > 0)
            {
                $_SESSION['status'] = "The Subject !!";
                $_SESSION['status_code'] = "info";
                header("location: adviser-loadsubjects.php");
            }
            else
            {
                $status = "Approved";
                $insert_sub = "INSERT INTO tbladviser_send_sub_to_stud (yearlevel,semester,status,student_id_fk,subject_id_fk,curri_id_fk,college_id_fk,course_id_fk) VALUES ('$Year','$Semester','$status','$Studentid','$SubID','$Currid','$Collegeid','$Courseid')";

                if(mysqli_query($connection,$insert_sub))
                {
                    $_SESSION['status'] = "Successfully Save The Subject !!";
                    $_SESSION['status_code'] = "success";
                    header("location: adviser-loadsubjects.php");
                }
                else
                {
                    $_SESSION['status'] = "Unsuccessfully Save. Please check your input or Contact the Personnel Incharge!!";
                    $_SESSION['status_code'] = "error";
                    header("location: adviser-loadsubjects.php");
                }
            }
        }
    }
}
//End Send All Subject to Student//

// Start Approved Grades Submission Data Student //
if(isset($_POST['approved_grades']))
{
    $studi = $_POST['studentid'];
    $StudCurriid = $_POST['currid'];
    $Approved = "Approved";

    $get_grade_pen = mysqli_query($connection,"SELECT * FROM tblstudent_grade_sub WHERE submission_status='Pending' and student_id_fk='$studi' and curri_id_fk='$StudCurriid'");
    foreach($get_grade_pen as $Re)
    {
        $Remarks = $Re['remarks'];
        $Courseid = $Re['course_id_fk'];
    
        $slect_sub = mysqli_query($connection,"SELECT * FROM tblstudent_grade_sub WHERE submission_status='Pending' and student_id_fk='$studi' and curri_id_fk='$StudCurriid'");
        foreach($slect_sub as $SUB)
        {
            $SubGrades = $SUB['grades'];
            $SubRemarks = $SUB['remarks'];
            $SubjectID = $SUB['subject_id_fk'];
            $StudentID = $SUB['student_id_fk'];
            $SubCURI = $SUB['curri_id_fk'];
            $SubCOURSE = $SUB['course_id_fk'];

            //Subject with Grades//
            $Select_SUB = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$SubjectID' and curr_id_fk='$SubCURI' and course_id_fk='$SubCOURSE'");
            foreach($Select_SUB as $t)
            {
                $IdSubject = $t['id'];
                $CodeSub = $t['subject_code'];
                $DesSub = $t['description'];
                $LecSub = $t['lec'];
                $LabSub = $t['lab'];
                $UnitsSub = $t['units'];
                $YearSub = $t['yearlevel'];
                $SemSub = $t['semester'];
                $CurSub = $t['curr_id_fk'];
                $ColSub = $t['college_id_fk'];
                $CourSub = $t['course_id_fk'];

                $check_sub_id = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE subject_id_fk='$IdSubject' and curri_id='$CurSub' and course_id_fk='$CourSub'");
                while($h=mysqli_fetch_array($check_sub_id))
                {
                    $Subject_ID = $h['subject_id_fk'];
                    $SUBGrades = $h['grades'];
                }
                if($IdSubject == $Subject_ID)
                {
                    $save_up_grade = "UPDATE tbladviser_presubject SET grades='$SubGrades',remarks='$SubRemarks' WHERE student_id='$StudentID' and subject_id_fk='$IdSubject' and curri_id='$CurSub' and course_id_fk='$CourSub'";
                    $del_grade = "UPDATE tblstudent_grade_sub SET submission_status='Approved' WHERE student_id_fk='$StudentID' and curri_id_fk='$CurSub' and course_id_fk='$CourSub' and submission_status='Pending'";
                    $del_pdf = "UPDATE tblstudent_pdf SET submission_status='Approved' WHERE student_id_fk='$StudentID' and curri_id_fk='$CurSub' and course_id_fk='$CourSub' and submission_status='Pending'";
                    if(mysqli_query($connection,$save_up_grade) && mysqli_query($connection,$del_grade) && mysqli_query($connection,$del_pdf)){header("location: adviser-loadstudents.php");}
                }
                else if($IdSubject != $Subject_ID)
                {
                    $save_grade = "INSERT INTO tbladviser_presubject (lec,lab,units,grades,remarks,yearlevel,semester,student_id,subject_id_fk,curri_id,college_id_fk,course_id_fk) VALUES ('$LecSub','$LabSub','$UnitsSub','$SubGrades','$SubRemarks','$YearSub','$SemSub','$StudentID','$IdSubject','$CurSub','$ColSub','$CourSub')";
                    $del_grade = "UPDATE tblstudent_grade_sub SET submission_status='Approved' WHERE student_id_fk='$StudentID' and curri_id_fk='$CurSub' and course_id_fk='$CourSub' and submission_status='Pending'";
                    $del_pdf = "UPDATE tblstudent_pdf SET submission_status='Approved' WHERE student_id_fk='$StudentID' and curri_id_fk='$CurSub' and course_id_fk='$CourSub' and submission_status='Pending'";
                    if(mysqli_query($connection,$save_grade) && mysqli_query($connection,$del_grade) && mysqli_query($connection,$del_pdf)){header("location: adviser-loadstudents.php");}
                }
            }
            
            $check_idPreq = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE subject_id_fk='$IdSubject' and curri_id='$CurSub' and course_id_fk='$CourSub' and remarks='PASSED'");
            foreach($check_idPreq as $I)
            {
                $SUBID = $I['subject_id_fk'];
                //For Prerequisite//
                $Check_Sub = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_id='$SUBID' and curri_id_fk='$CurSub' and course_id_fk='$CourSub'");
                foreach($Check_Sub as $u)
                {
                    $subject_id = $u['subject_id'];
                    $subject_code = $u['subject_under'];

                    $search_sub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE subject_code='$subject_code' and curr_id_fk='$CurSub' and course_id_fk='$CourSub'");
                    foreach($search_sub as $p)
                    {
                        $subjectID = $p['id'];
                        $SubjectCode = $p['subject_code'];
                        $SubLec = $p['lec'];
                        $SubLab = $p['lab'];
                        $SubUnits = $p['units'];
                        $SubYear = $p['yearlevel'];
                        $SubSem = $p['semester'];
                        $SubCollege = $p['college_id_fk'];
                        $SubCuri = $p['curr_id_fk'];
                        $SubCourse = $p['course_id_fk'];

                        $check_sub_pre = mysqli_query($connection,"SELECT * FROM tbladviser_presubject WHERE subject_id_fk='$subjectID' and curri_id='$SubCuri' and course_id_fk='$SubCourse'");
                        if(mysqli_num_rows($check_sub_pre) > 0)
                        {
                            $h=mysqli_fetch_array($check_sub_pre);
                            $subject_ID = $h['subject_id_fk'];
                        }

                        if($subjectID != $subject_ID)
                        {
                            $sqlsd = "INSERT INTO tbladviser_presubject (lec,lab,units,yearlevel,semester,student_id,subject_id_fk,curri_id,college_id_fk,course_id_fk) VALUES ('$SubLec','$SubLab','$SubUnits','$SubYear','$SubSem','$StudentID','$subjectID','$SubCuri','$SubCollege','$SubCourse')";
                            if(mysqli_query($connection,$sql1))
                            {
                                //$_SESSION['status'] = "Successfully Approved The Grades!!";
                                // $_SESSION['status_code'] = "success";
                                header("location: adviser-loadstudents.php");
                            }
                            else
                            {
                                $_SESSION['status'] = "Unsuccessfully Approved The Grades. Please check your input or Contact the Personnel Incharge!!";
                                $_SESSION['status_code'] = "error";
                                header("location: adviser-loadstudents.php");
                            }
                        }
                    }
                }
            }
        }
    }
}
// End Approved Grades Submission Data Student //

// Start Disapproved Grades Submission Data Student //
if(isset($_POST['disapproved_grades']))
{
    $studi = $_POST['studentid'];
    $StudCurriid = $_POST['currid'];
    $Disapproved = "Disapproved";

    $select_Stu = mysqli_query($connection,"SELECT * FROM tbluser WHERE id='$studi' and curri_id='$StudCurriid'");
    while($ca=mysqli_fetch_array($select_Stu))
    {
        $Student_email = $ca['email'];
    }

    $sql1 = "UPDATE tblstudent_pdf SET submission_status='$Disapproved' WHERE student_id_fk='$studi' and curri_id_fk='$StudCurriid'";
    $sql2 = "UPDATE tblstudent_grade_sub SET submission_status='$Disapproved' WHERE student_id_fk='$studi' and curri_id_fk='$StudCurriid'";

    //send credentials to email
    require_once '../../PHPMailer/PHPMailer.php';
    require_once '../../PHPMailer/SMTP.php';
    require_once '../../PHPMailer/Exception.php';
    
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
    $mail->addAddress($Student_email);  

    $mail->Subject = 'Online Pre-Advising';
    $mail->Body    = "<p>Greetings: <br><br> 
        Your Grades have been Disapproved by your adviser.<br>
        Please Check the input of your grades or contact your <b>Adviser</b> for more information.<br>
        <a href='wmsu-onlinepreadvising.com'><b>ONLINE PRE-ADVISING</b></a><br>
        <br>
        Please ignore this message if you already received this message previously</p>";

    if($mail->send() && mysqli_query($connection,$sql1) && mysqli_query($connection,$sql2))
    {
        $_SESSION['status'] = "Successfully Disapproved The Grades!!";
        $_SESSION['status_code'] = "success";
        header("location: adviser-loadstudents.php");
    }
    else
    {
        $_SESSION['status'] = "Unsuccessfully Disapproved The Grades. Please check your input or Contact the Personnel Incharge!!";
        $_SESSION['status_code'] = "error";
        header("location: adviser-loadstudents.php");
    }
}
// End Disapproved Grades Submission Data Student //
// End Function Student interraction of adviser //

?>
