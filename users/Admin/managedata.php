<?php
    use PHPMailer\PHPMailer\PHPMailer;

    session_start();
    include "../../source/includes/config.php";
    include("../../source/includes/alertmessage.php");

//Request Account Manage//
    // Start Student Approve Data //
    if (isset($_POST['approved_request']))
    {
        $AdviserID = mysqli_real_escape_string($connection,$_POST['adviser_id']);
        
        $getsec = mysqli_query($connection,"SELECT * FROM tblrequest_account WHERE id='$AdviserID'");
        while($ew = mysqli_fetch_array($getsec))
        {
            $Adviser_first = $ew['firstname'];
            $Adviser_last = $ew['lastname'];
            $Adviser_email = $ew['email'];
            $Adviser_pass = $ew['password'];
            $Adviser_type = $ew['req_usertype'];
            $Adviser_contact = $ew['contact'];
            $Adviser_collegeid = $ew['college_id_fk'];
            $Adviser_courseid = $ew['course_id_fk'];
        }   

        $cour_code = mysqli_query($connection,"SELECT * FROM tblcourse WHERE id='$Adviser_courseid'");
        while($cour=mysqli_fetch_array($cour_code))
        {
            $CourseName = $cour['course'];
        }
        $user_save = "INSERT INTO tbluser (firstname,lastname,email,password,usertype,contact,college_id_fk,course_id_fk) VALUES ('$Adviser_first','$Adviser_last','$Adviser_email','$Adviser_pass','$Adviser_type','$Adviser_contact','$Adviser_collegeid','$Adviser_courseid')";   
        $user_del = "DELETE FROM tblrequest_account WHERE id='$AdviserID'";

        $set_id = mysqli_query($connection,"SELECT * FROM tblrequest_account");
        while($fa = mysqli_fetch_array($set_id))
        {
            $reqid = $fa['id'];
        }

        $c = "ALTER TABLE tblrequest_account AUTO_INCREMENT = 1";

        //send credentials to email
        require_once '../../PHPMailer/PHPMailer.php';
        require_once '../../PHPMailer/SMTP.php';
        require_once '../../PHPMailer/Exception.php';
        
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
        $mail->addAddress($Adviser_email);  

        $mail->Subject = 'Online Pre-Advising';
        $mail->Body    = "<p>Greetings: <br><br> 
            Adviser Account: <br><br>Your email is <b>$Adviser_email</b><br>
            Your Password is <b>$Adviser_pass</b><br>
            Your Course is <b>$CourseName</b><br> <br><br>
            <br><br><p><b>Note:</b><br>
            <b>Your Request Has Been Approved By your Admin.</b><a href='wmsu-onlinepreadvising.com'><b>ONLINE PRE-ADVISING</b></a><br>
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
            header("location:admin-accounts.php"); 
        }
        else
        {
            $_SESSION['status'] = "Unsuccessfully Approved.Please Check your input or Contact the Personnel incharge!!";
            $_SESSION['status_code'] = "error";
            header("location:admin-accounts.php");
        }
    }
    // End Student Approve Data //

    // Start Student Disapprove Data //
    if (isset($_POST['disapproved_request']))
    {
        $AdviserID = mysqli_real_escape_string($connection,$_POST['adviser_id']);

        $getsec = mysqli_query($connection,"SELECT * FROM tblrequest_account WHERE id='$AdviserID'");
        while($ew = mysqli_fetch_array($getsec))
        {
            $Adviser_email = $ew['email'];
        } 
        
        $user_del = "DELETE FROM tblrequest_account WHERE id='$AdviserID'";

        $set_id = mysqli_query($connection,"SELECT * FROM tblrequest_account");
        while($fa = mysqli_fetch_array($set_id))
        {
            $reqid = $fa['id'];
        }

        $d = "ALTER TABLE tblrequest_account AUTO_INCREMENT = 1";

        //send credentials to email
        require_once '../../PHPMailer/PHPMailer.php';
        require_once '../../PHPMailer/SMTP.php';
        require_once '../../PHPMailer/Exception.php';
        
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
        $mail->addAddress($Adviser_email);  

        $mail->Subject = 'Online Pre-Advising';
        $mail->Body    = "<p>Greetings: <br><br> 
            Sorry Your Request has been Decline by your Admin. Please Contact Your Department to provided for more info of your Request. <br<br>
            Thank You. Have A Nice Day..</p>";
        
        if($mail->send() && mysqli_query($connection, $user_del) && mysqli_query($connection, $d)){
            $_SESSION['status'] = "Successfully Disapproved!!";
            $_SESSION['status_code'] = "success";
            header("location:admin-accounts.php");
        }
        else
        {
            $_SESSION['status'] = "Unsuccessfully Disapproved.Please Check your input or Contact the Personnel incharge!!";
            $_SESSION['status_code'] = "error";
            header("location:admin-accounts.php");
        }
    }
    // End Student Disapprove Data //
//Request Account Manage//

//Profile//
    if(isset($_POST['update_admin_profile']))
    {
        $Adminid = $_POST['adminid'];
        $Firstname = $_POST['firstname'];
        $Lastname = $_POST['lastname'];
        $Email = $_POST['email'];
        $Contact = $_POST['contact'];

        $check_admin = mysqli_query($connection,"SELECT * FROM tbluser WHERE id='$Adminid'");
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
            header("location:admin-profile.php"); 
        }
        else
        {
            if($Email == $email && $Firstname == $firstname && $Lastname == $lastname && $Contact == $contact)
            {
                $_SESSION['status'] = "Email Already Exist!!";
                $_SESSION['status_code'] = "info";
                header("location:admin-profile.php"); 
            }
            else if($Email != $email)
            {
                $sql1 = "UPDATE tbluser SET firstname='$Firstname',lastname='$Lastname',contact='$Contact',email='$Email' WHERE id='$Adminid'";
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
                    header("location:admin-profile.php");
                }
            }
            else
            {
                $sql2 = "UPDATE tbluser SET firstname='$Firstname',lastname='$Lastname',contact='$Contact' WHERE id='$Adminid'";
                if(mysqli_query($connection,$sql2))
                {
                    $_SESSION['status'] = "Successfully Updated!!";
                    $_SESSION['status_code'] = "success";
                    header("location:admin-profile.php");                  
                }
                else
                {
                    $_SESSION['status'] = "Unsuccessfully Updated.. Please check The input Data!!";
                    $_SESSION['status_code'] = "error";
                    header("location:admin-profile.php");
                }
            }
        }
    }

    if(isset($_POST['update_password']))
    {   
        $Adminid = $_POST['adminid'];
        $Password = $_POST['password'];

        $check_pass = mysqli_query($connection,"SELECT * FROM tbluser WHERE id='$Adminid'");
        while($sa=mysqli_fetch_array($check_pass))
        {
            $password = $sa['password'];
        }
        if($Password == $password)
        {
            $_SESSION['status'] = "Nothing To be Updated!!";
            $_SESSION['status_code'] = "info";
            header("location:admin-profile.php"); 
        }
        else
        {
            $sql = "UPDATE tbluser SET password='$Password' WHERE id='$Adminid'";
            if(mysqli_query($connection,$sql))
            {
                $_SESSION['status'] = "Successfully Updated!!";
                $_SESSION['status_code'] = "success";
                header("location:admin-profile.php");                  
            }
            else
            {
                $_SESSION['status'] = "Unsuccessfully Updated.. Please check The input Data!!";
                $_SESSION['status_code'] = "error";
                header("location:admin-profile.php");
            }
        }
    }
//Profile//

// Start of Curriculum Manage Data //
    // Start of Add Curriculum Data //
    if (isset($_POST['addCurriculum']))
    {
        $college_id = $_POST['collegeid'];
        $CMO=mysqli_real_escape_string($connection,$_POST['CMO']);
        $BR=mysqli_real_escape_string($connection,$_POST['BoardResolution']);
        $SYfrom=mysqli_real_escape_string($connection,$_POST['SYfrom']);
        //$SYto=mysqli_real_escape_string($connection,$_POST['SYto']);
        $CourseCode=mysqli_real_escape_string($connection,$_POST['coursecode']);
		$OtherDetails=mysqli_real_escape_string($connection,$_POST['otherdetails']);
        $effectiveSY = $SYfrom." - ". $SYto;
        $status = 1;

        //get course code and display in the curriculum table
        $getcourse = mysqli_query($connection,"SELECT * FROM tblcourse WHERE coursecode='$CourseCode'");
        if(mysqli_num_rows($getcourse) > 0){
            $get = mysqli_fetch_array($getcourse);
            $CourseID =$get['id'];
        }

        if($OtherDetails == "")
        {
            $OtherDetail = "NONE";
        }
        
        $getcurr = "SELECT * FROM tblcurriculum WHERE course_id_fk='$CourseID'";
        $getresult = mysqli_query($connection,$getcurr);

        $curr_code = $CourseCode."(".$SYfrom.")";

        $check_curr = mysqli_query($connection,"SELECT * FROM tblcurriculum WHERE curr_code = '$curr_code'"); 

        if(mysqli_num_rows($check_curr) > 0){
            $_SESSION['status'] = "Already Existed!!";
            $_SESSION['status_code'] = "warning";
            header("location:admin-curriculum.php"); 
        }
        else
        {
            $sql="INSERT INTO `tblcurriculum`(`curr_code`, `cmo`, `board_reso`, `effectiveSY`,`other_details`,`status`,`college_id_fk`, `course_id_fk`) VALUES ('$curr_code','$CMO','$BR','$SYfrom','$OtherDetail','$status','$college_id',$CourseID)";
        
            if(mysqli_query($connection,$sql))
            {
                $_SESSION['status'] = "Successfully Added!!";
				$_SESSION['status_code'] = "success";
				header("location:admin-curriculum.php");                  
            }
            else
            {
                $_SESSION['status'] = "Unsuccessfully added.. Please check The input Data!!";
				$_SESSION['status_code'] = "error";
				header("location:admin-curriculum.php");
            }
        }
        
    }
    // End of Add Curriculum Data //

    // Start of Delete Curriculum Data //
    if (isset($_POST['delete_curriculum']))
	{
		$id = $_POST['curri_id'];
        $status = 0;
		$sql ="UPDATE tblcurriculum SET status='$status' WHERE id='$id'";
		if(mysqli_query($connection, $sql))
		{
			$_SESSION['status'] = "Successfully Delete!";
            $_SESSION['status_code'] = "success";
            header("location:admin-curriculum.php");
		} else {
			$_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data!!";
            $_SESSION['status_code'] = "error";
            header("location:admin-curriculum.php");
		}
	}
    // End of Delete Curriculum Data //

    // Start of Copy Curriculum Subjects //
    if(isset($_POST['copyCurriculum']))
    {
        $Copy_curri = $_POST['copy_curri'];
        $Paste_curri = $_POST['paste_curri'];
        $select_get_curri = mysqli_query($connection,"SELECT * FROM tblcurriculum WHERE id='$Copy_curri'");
        while($fa=mysqli_fetch_array($select_get_curri))
        {
            $courseid = $fa['course_id_fk'];
            $collegeid = $fa['college_id_fk'];
        }
        $get_copy_curriId = mysqli_query($connection,"SELECT * FROM tblsubject WHERE curr_id_fk='$Copy_curri' and college_id_fk='$collegeid' and course_id_fk='$courseid'");
        foreach($get_copy_curriId as $co)
        {
            $subid = $co['id'];
            $subcode = $co['subject_code'];
            $subdes = $co['description'];
            $sublec = $co['lec'];
            $sublab = $co['lab'];
            $subunits = $co['units'];
            $subyrlvl = $co['yearlevel'];
            $subsemester = $co['semester'];
            $subprereq = "NONE";
            $status = 1;

            $sql = "INSERT INTO `tblsubject`(`curr_id_fk`,`subject_code`,`description`, `lec`, `lab`, `units`,`prerequisite`,`status`, `semester`, `yearlevel`,`course_id_fk`,`college_id_fk`) VALUES ('$Paste_curri','$subcode','$subdes','$sublec','$sublab','$subunits','$subprereq','$status','$subsemester','$subyrlvl','$courseid','$collegeid')";
            if(mysqli_query($connection,$sql))
            {
                $_SESSION['status'] = "Successfully Added!!";
                $_SESSION['status_code'] = "success";
                header("location:admin-curriculum.php");                  
            }
            else
            {
                $_SESSION['status'] = "Unsuccessfully added.. Please check The input Data!!";
                $_SESSION['status_code'] = "error";
                header("location:admin-curriculum.php");
            }
        }
    }
    // End of Copy Curriculum Subjects
    
    // Start of Session Curriculum //
    if (isset($_POST['getidbtn'])){
                     
        $CurrID=mysqli_real_escape_string($connection,$_POST['id']);
        
        $_SESSION['currid'] =$CurrID;
        header("location:admin-subjects.php");
    }
    // End of Session Curriculum //
// 1st Year Subjects Data //
    // Start of Add 1st Subject 1st sem Data //
    if (isset($_POST['add_1st_year_subject']))
    {
        $SubjectCode=mysqli_real_escape_string($connection,$_POST['subjectcode']);
        $Description=mysqli_real_escape_string($connection,$_POST['description']);
        $Lec=mysqli_real_escape_string($connection,$_POST['lec']);
        $Lab=mysqli_real_escape_string($connection,$_POST['lab']);
        $Units=mysqli_real_escape_string($connection,$_POST['units']);
        $Courseid=mysqli_real_escape_string($connection,$_POST['courseid']);   
        $Semester=mysqli_real_escape_string($connection,$_POST['semester']);
        $Yearlevel=mysqli_real_escape_string($connection,$_POST['yearlevel']);
        $CurrCode=mysqli_real_escape_string($connection,$_POST['curr_code']);
        $Collegeid = $_SESSION['college_id_fk'];
        $courseid = $_SESSION['course_id_fk'];
        $Status = 1;
        $Prereq= $_POST['prereq'];
     
        $getcurrid = mysqli_query($connection, "SELECT * from tblcurriculum WHERE curr_code='$CurrCode'");

        if(mysqli_num_rows($getcurrid) > 0){
            $fa_c = mysqli_fetch_array($getcurrid);
            $curr_id = $fa_c['id']; //store cuuriculum id
        }
        $check_code = mysqli_query($connection,"SELECT * FROM tblsubject WHERE subject_code='$SubjectCode' and curr_id_fk='$curr_id' and course_id_fk='$Courseid'");
        if(mysqli_num_rows($check_code) > 0)
        {
            $_SESSION['status'] = "Subject Already Existed";
            $_SESSION['status_code'] = "info"; 
			header("location: admin-subjects.php");
        }
        else
        {
            if($Prereq =="")
            {
                $prereq = "NONE";
                
                $sql="INSERT INTO `tblsubject`(`curr_id_fk`,`subject_code`,`description`, `lec`, `lab`, `units`,`prerequisite`,`status`, `semester`, `yearlevel`,`course_id_fk`,`college_id_fk`) VALUES ($curr_id,'$SubjectCode','$Description',$Lec,$Lab,$Units,'$prereq','$Status','$Semester','$Yearlevel','$Courseid','$Collegeid')";
                
                if(mysqli_query($connection,$sql))
                {   
                    $_SESSION['status'] = "Successfully Added!";
                    $_SESSION['status_code'] = "success";
                    header("location: admin-subjects.php");            
                }else{
                    $_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data!!";
                    $_SESSION['status_code'] = "error";
                    header("location: admin-subjects.php");
                }
            }
            else
            {
                $prereq = "HAVE";

                $sql="INSERT INTO `tblsubject`(`curr_id_fk`, `subject_code`,`description`, `lec`, `lab`, `units`,`prerequisite`,`status`, `semester`, `yearlevel`,`course_id_fk`,`college_id_fk`) VALUES ($curr_id,'$SubjectCode','$Description',$Lec,$Lab,$Units,'$prereq','$Status','$Semester','$Yearlevel','$Courseid','$Collegeid')";
                if(mysqli_query($connection,$sql)){}

                $select_sub_id = mysqli_query($connection,"SELECT * FROM tblsubject WHERE subject_code='$SubjectCode' and curr_id_fk='$curr_id' and course_id_fk='$Courseid'");
                while($c=mysqli_fetch_array($select_sub_id))
                {
                    $sub_id_to_pre = $c['id'];
                }
                
                foreach($Prereq as $subject_id)
                {
                    $sql1 = "INSERT INTO tblprereq (subject_id, subject_under, curri_id_fk, course_id_fk) VALUES ('$subject_id','$sub_id_to_pre','$curr_id','$Courseid')";
                    if(mysqli_query($connection,$sql1))
                    {
                        $_SESSION['status'] = "Successfully Added!";
                        $_SESSION['status_code'] = "success";
                        header("location: admin-subjects.php"); 
                    }
                    else
                    {
                        $_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data!!";
                        $_SESSION['status_code'] = "error";
                        header("location: admin-subjects.php");
                    }
                
                }
            }
        }
    }
    // End of Add 1st Subject 1st sem Data //

    // Start of Edit 1st Subject 1st sem Data //
    if (isset($_POST['edit_1st_year_subject']))
    {
        $CurrCode=mysqli_real_escape_string($connection,$_POST['curr_code']);
        $Courseid=mysqli_real_escape_string($connection,$_POST['courseid']);    
        // up not tobe updated //
        $SubjectID = mysqli_real_escape_string($connection,$_POST['subject_id']);
        $Yearlevel=mysqli_real_escape_string($connection,$_POST['yearlevel']);
        $Semester=mysqli_real_escape_string($connection,$_POST['semester']);
        $SubjectCode=mysqli_real_escape_string($connection,$_POST['subjectcode']);
        $Description=mysqli_real_escape_string($connection,$_POST['description']);
        $Lec=mysqli_real_escape_string($connection,$_POST['lec']);
        $Lab=mysqli_real_escape_string($connection,$_POST['lab']);
        $Units=mysqli_real_escape_string($connection,$_POST['units']);
        
        $Collegeid = $_SESSION['college_id_fk'];
        $courseid = $_SESSION['course_id_fk'];

        $Prereq = $_POST['prereq'];

        $list_preq = count($subject_id);
        $data = explode(",",$subject_id,$list_preq);
        
        $getcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE subject_code='$Prereq'");
        while($fa = mysqli_fetch_array($getcode))
        {
            $getsubid = $fa['id'];
            $getsubcode = $fa['subject_code'];
            $getsubtitle = $fa['description'];
            $getsubyear = $fa['yearlevel'];
            $getsubsem = $fa['semester'];
        }
        $getcurrid = mysqli_query($connection, "SELECT * from tblcurriculum WHERE curr_code='$CurrCode'");
        if(mysqli_num_rows($getcurrid) > 0){
            $fa_c = mysqli_fetch_array($getcurrid);
            $curr_id = $fa_c['id']; //store cuuriculum id
        }
        $get_subject_info = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$SubjectID'");
        while($ca=mysqli_fetch_array($get_subject_info))
        {
            $SUBJECTCODE = $ca['subject_code'];
            $TITLE = $ca['description'];
            $LEC = $ca['lec'];
            $LAB = $ca['lab'];
            $UNITS = $ca['units'];
            $YEAR = $ca['yearlevel'];
            $SEMESTER = $ca['semester'];
        }
        $get_preq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$SUBJECTCODE'");
        foreach($get_preq as $data)
        {
            $SUBJECT_UNDER = $data['subject_id'];
        }
        $check_sub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$SUBJECT_UNDER'");
        foreach($check_sub as $A)
        {
            $SUBJECT_code = $A['subject_code'];
        }

        if($SubjectCode == "$SUBJECTCODE" && $Description == "$TITLE" && $Lec == "$LEC" && $Lab == "$LAB" && $Units == "$UNITS" && $Yearlevel == "$YEAR" && $Semester == "$SEMESTER" && $Prereq == "$SUBJECT_code")
        {
            $_SESSION['status'] = "Nothing To Be Upated!!";
            $_SESSION['status_code'] = "info";
            header("location: admin-subjects.php");   
        }
        else
        {
            if($Prereq =="NONE")
            {
                $sql = "UPDATE `tblsubject` SET `subject_code`='$SubjectCode', `description`='$Description', `lec`='$Lec', `lab`='$Lab', `units`='$Units', `semester`='$Semester', `yearlevel`='$Yearlevel',`course_id_fk`='$Courseid',`college_id_fk`='$Collegeid' WHERE id='$SubjectID'";
                
                if(mysqli_query($connection,$sql))
                {   
                    $_SESSION['status'] = "Successfully Added!";
                    $_SESSION['status_code'] = "success";
                    header("location: admin-subjects.php");            
                }else{
                    $_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data!!";
                    $_SESSION['status_code'] = "error";
                    header("location: admin-subjects.php");
                }
            }
            else
            {
                $prereq = $getsubid;

                $sql = "UPDATE `tblsubject` SET `subject_code`='$SubjectCode', `description`='$Description', `lec`='$Lec', `lab`='$Lab', `units`='$Units', `semester`='$Semester', `yearlevel`='$Yearlevel',`course_id_fk`='$Courseid',`college_id_fk`='$Collegeid' WHERE id='$SubjectID'";
                foreach($prereq as $subject_id)
                {
                    $sql1 = "UPDATE tblprereq SET `subject_id`='$SubjectID' WHERE `subject_under`='$SubjectCode'";
                    mysqli_query($connection,$sql1);
                }
                if(mysqli_query($connection,$sql))
                {   
                    $_SESSION['status'] = "Successfully Updated Subject!!";
                    $_SESSION['status_code'] = "success";
                    header("location: admin-subjects.php");            
                }
                else
                {
                    $_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data or Contact the Personal incharge!!";
                    $_SESSION['status_code'] = "error";
                    header("location: admin-subjects.php");
                }   
            }
        }
    }
    // End of Edit 1st Subject 1st sem Data //

    // Start Delete 1st Subject 1st Sem //
    if (isset($_POST['delete_1st_subject_1st']))
	{
		$id = $_POST['id'];
        $status = 0;
        $sql ="UPDATE tblsubject SET status='$status' WHERE id='$id'";
		
		if(mysqli_query($connection, $sql))
		{
			$_SESSION['status'] = "Successfully Delete!";
            $_SESSION['status_code'] = "success";
            header("location:admin-subjects.php");
		} else {
			$_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data!!";
            $_SESSION['status_code'] = "error";
            header("location:admin-subjects.php");
		}
	}
    // End Delete 1st Subject 1st Sem //

    // Start Delete 1st Subject 2nd Sem //
    if (isset($_POST['delete_1st_subject_2nd']))
	{
		$id = $_POST['id'];
        $status = 0;
        $sql ="UPDATE tblsubject SET status='$status' WHERE id='$id'";
		
		if(mysqli_query($connection, $sql))
		{
			$_SESSION['status'] = "Successfully Delete!";
            $_SESSION['status_code'] = "success";
            header("location:admin-subjects.php");
		} else {
			$_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data!!";
            $_SESSION['status_code'] = "error";
            header("location:admin-subjects.php");
		}
	}
    // End Delete 1st Subject 2nd Sem //

    // Start of Delete All 1st Subject //
    if (isset($_POST['delete_all_1st_subject_1st']))
	{
		$currid = $_POST['currid'];
        $courseid = $_POST['courseid'];
        $status = 0;

		$sql ="UPDATE tblsubject SET status='$status' WHERE curr_id_fk='$currid' and course_id_fk='$courseid'";
		if(mysqli_query($connection, $sql))
		{
			$_SESSION['status'] = "Successfully Delete All Subjects!";
            $_SESSION['status_code'] = "success";
            header("location:admin-subjects.php");
		} else {
			$_SESSION['status'] = "Unsuccessfully Delete All Subjects.. Please check The input Data or Contact the Personel incharge!!";
            $_SESSION['status_code'] = "error";
            header("location:admin-subjects.php");
		}
	}
    // End of Delete All 1st Subject 1st Sem //

    // Start of Edit 1st Subject 2nd sem Data //
    if (isset($_POST['edit_1st_year_subject_2nd']))
    {
        $CurrCode=mysqli_real_escape_string($connection,$_POST['curr_code']);
        $Courseid=mysqli_real_escape_string($connection,$_POST['courseid']);    
        // up not to be updated //
        $SubjectID = mysqli_real_escape_string($connection,$_POST['subject_id']);
        $Yearlevel=mysqli_real_escape_string($connection,$_POST['yearlevel']);
        $Semester=mysqli_real_escape_string($connection,$_POST['semester']);
        $SubjectCode=mysqli_real_escape_string($connection,$_POST['subjectcode']);
        $Description=mysqli_real_escape_string($connection,$_POST['description']);
        $Lec=mysqli_real_escape_string($connection,$_POST['lec']);
        $Lab=mysqli_real_escape_string($connection,$_POST['lab']);
        $Units=mysqli_real_escape_string($connection,$_POST['units']);
        
        $Collegeid = $_SESSION['college_id_fk'];
        $courseid = $_SESSION['course_id_fk'];

        $Prereq = $_POST['prereq'];

        $list_preq = count($subject_id);
        $data = explode(",",$subject_id,$list_preq);
        
        $getcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE subject_code='$Prereq'");
        while($fa = mysqli_fetch_array($getcode))
        {
            $getsubid = $fa['id'];
            $getsubcode = $fa['subject_code'];
            $getsubtitle = $fa['description'];
            $getsubyear = $fa['yearlevel'];
            $getsubsem = $fa['semester'];
        }
     
        $getcurrid = mysqli_query($connection, "SELECT * from tblcurriculum WHERE curr_code='$CurrCode'");
        if(mysqli_num_rows($getcurrid) > 0){
            $fa_c = mysqli_fetch_array($getcurrid);
            $curr_id = $fa_c['id']; //store cuuriculum id
        }
        $get_subject_info = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$SubjectID'");
        while($ca=mysqli_fetch_array($get_subject_info))
        {
            $SUBJECTCODE = $ca['subject_code'];
            $TITLE = $ca['description'];
            $LEC = $ca['lec'];
            $LAB = $ca['lab'];
            $UNITS = $ca['units'];
            $YEAR = $ca['yearlevel'];
            $SEMESTER = $ca['semester'];
        }
        $get_preq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$SUBJECTCODE'");
        foreach($get_preq as $data)
        {
            $SUBJECT_UNDER = $data['subject_id'];
        }
        $check_sub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$SUBJECT_UNDER'");
        foreach($check_sub as $A)
        {
            $SUBJECT_code = $A['subject_code'];
        }

        if($SubjectCode == "$SUBJECTCODE" && $Description == "$TITLE" && $Lec == "$LEC" && $Lab == "$LAB" && $Units == "$UNITS" && $Yearlevel == "$YEAR" && $Semester == "$SEMESTER" && $Prereq == "$SUBJECT_code")
        {
            $_SESSION['status'] = "Nothing To Be Upated!!";
            $_SESSION['status_code'] = "info";
            header("location: admin-subjects.php");   
        }
        else
        {
            if($Prereq =="NONE")
            {
                $sql = "UPDATE `tblsubject` SET `subject_code`='$SubjectCode', `description`='$Description', `lec`='$Lec', `lab`='$Lab', `units`='$Units', `semester`='$Semester', `yearlevel`='$Yearlevel',`course_id_fk`='$Courseid',`college_id_fk`='$Collegeid' WHERE id='$SubjectID'";
                
                if(mysqli_query($connection,$sql))
                {   
                    $_SESSION['status'] = "Successfully Updated Subject!!";
                    $_SESSION['status_code'] = "success";
                    header("location: admin-subjects.php");            
                }else{
                    $_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data!!";
                    $_SESSION['status_code'] = "error";
                    header("location: admin-subjects.php");
                }
            }
            else
            {
                $prereq = $getsubid;

                $sql = "UPDATE `tblsubject` SET `subject_code`='$SubjectCode', `description`='$Description', `lec`='$Lec', `lab`='$Lab', `units`='$Units', `semester`='$Semester', `yearlevel`='$Yearlevel',`course_id_fk`='$Courseid',`college_id_fk`='$Collegeid' WHERE id='$SubjectID'";
                
                foreach($prereq as $subject_id)
                {
                    $sql1 = "UPDATE tblprereq SET `subject_id`='$SubjectID' WHERE `subject_under`='$SubjectCode'";
                    mysqli_query($connection,$sql1);
                }
                if(mysqli_query($connection,$sql))
                {   
                    $_SESSION['status'] = "Successfully Updated Subject!!";
                    $_SESSION['status_code'] = "success";
                    header("location: admin-subjects.php");            
                }
                else
                {
                    $_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data or Contact the Personal incharge!!";
                    $_SESSION['status_code'] = "error";
                    header("location: admin-subjects.php");
                }   
            }
        }
    }
    // End of Edit 1st Subject 2nd sem Data //
// 1st Year Subjects Data //

// 2nd Year Subjects Data //
    // Start of Edit 2nd Subject 1st sem Data //
    if (isset($_POST['edit_2nd_year_subject_1st']))
    {
        $CurrCode=mysqli_real_escape_string($connection,$_POST['curr_code']);
        $Courseid=mysqli_real_escape_string($connection,$_POST['courseid']); 
        // up not tobe updated //
        $SubjectID = mysqli_real_escape_string($connection,$_POST['subject_id']);
        $Yearlevel=mysqli_real_escape_string($connection,$_POST['yearlevel']);
        $Semester=mysqli_real_escape_string($connection,$_POST['semester']);
        $SubjectCode=mysqli_real_escape_string($connection,$_POST['subjectcode']);
        $Description=mysqli_real_escape_string($connection,$_POST['description']);
        $Lec=mysqli_real_escape_string($connection,$_POST['lec']);
        $Lab=mysqli_real_escape_string($connection,$_POST['lab']);
        $Units=mysqli_real_escape_string($connection,$_POST['units']);       
        
        $Collegeid = $_SESSION['college_id_fk'];
        $courseid = $_SESSION['course_id_fk'];

        $Prereq = $_POST['prereq'];
        
        $getcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE subject_code='$Prereq'");
        while($fa = mysqli_fetch_array($getcode))
        {
            $getsubid = $fa['id'];
            $getsubcode = $fa['subject_code'];
            $getsubtitle = $fa['description'];
            $getsubyear = $fa['yearlevel'];
            $getsubsem = $fa['semester'];
        }
        $getcurrid = mysqli_query($connection, "SELECT * from tblcurriculum WHERE curr_code='$CurrCode'");
        if(mysqli_num_rows($getcurrid) > 0){
            $fa_c = mysqli_fetch_array($getcurrid);
            $curr_id = $fa_c['id']; //store cuuriculum id
        }
        $get_subject_info = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$SubjectID'");
        while($ca=mysqli_fetch_array($get_subject_info))
        {
            $SUBJECTCODE = $ca['subject_code'];
            $TITLE = $ca['description'];
            $LEC = $ca['lec'];
            $LAB = $ca['lab'];
            $UNITS = $ca['units'];
            $YEAR = $ca['yearlevel'];
            $SEMESTER = $ca['semester'];
            $PREREQUISITE =$ca['prerequisite'];
        }
        $get_preq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$SUBJECTCODE'");
        foreach($get_preq as $data)
        {
            $SUBJECT_UNDER = $data['subject_id'];
        }
        $check_sub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$SUBJECT_UNDER'");
        foreach($check_sub as $A)
        {
            $SUBJECT_code = $A['subject_code'];
        }

        if($SubjectCode == "$SUBJECTCODE" && $Description == "$TITLE" && $Lec == "$LEC" && $Lab == "$LAB" && $Units == "$UNITS" && $Yearlevel == "$YEAR" && $Semester == "$SEMESTER" && $Prereq == "$SUBJECT_code")
        {
            $_SESSION['status'] = "Nothing To Be Upated!!";
            $_SESSION['status_code'] = "info";
            header("location: admin-subjects.php"); 
        }
        else
        {
            if($Prereq == "NONE")
            {
                $sql = "UPDATE `tblsubject` SET `subject_code`='$SubjectCode', `description`='$Description', `lec`='$Lec', `lab`='$Lab', `units`='$Units',`prerequisite`='$prereq', `semester`='$Semester', `yearlevel`='$Yearlevel',`course_id_fk`='$Courseid',`college_id_fk`='$Collegeid' WHERE id='$SubjectID'";
                
                if(mysqli_query($connection,$sql))
                {   
                    $_SESSION['status'] = "Successfully Updated!";
                    $_SESSION['status_code'] = "success";
                    header("location: admin-subjects.php");            
                }else{
                    $_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data!!";
                    $_SESSION['status_code'] = "error";
                    header("location: admin-subjects.php");
                }
            }
            else
            {
                $prereq = $getsubid;

                $sql = "UPDATE `tblsubject` SET `subject_code`='$SubjectCode', `description`='$Description', `lec`='$Lec', `lab`='$Lab', `units`='$Units', `semester`='$Semester', `yearlevel`='$Yearlevel',`course_id_fk`='$Courseid',`college_id_fk`='$Collegeid' WHERE id='$SubjectID'";
                
                foreach($prereq as $subject_id)
                {
                    $sql1 = "UPDATE tblprereq SET `subject_id`='$SubjectID' WHERE `subject_under`='$SubjectCode'";
                    mysqli_query($connection,$sql1);
                }
                if(mysqli_query($connection,$sql))
                {   
                    $_SESSION['status'] = "Successfully Updated Subject!!";
                    $_SESSION['status_code'] = "success";
                    header("location: admin-subjects.php");            
                }
                else
                {
                    $_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data or Contact the Personal incharge!!";
                    $_SESSION['status_code'] = "error";
                    header("location: admin-subjects.php");
                }  
            }
        }
    }
    // End of Edit 2nd Subject 1st sem Data //

    // Start of Edit 2nd Subject 2nd sem Data //
    if (isset($_POST['edit_2nd_year_subject_2nd']))
    {
        $CurrCode=mysqli_real_escape_string($connection,$_POST['curr_code']);
        $Courseid=mysqli_real_escape_string($connection,$_POST['courseid']); 
        // up not tobe updated //
        $SubjectID = mysqli_real_escape_string($connection,$_POST['subject_id']);
        $Yearlevel=mysqli_real_escape_string($connection,$_POST['yearlevel']);
        $Semester=mysqli_real_escape_string($connection,$_POST['semester']);
        $SubjectCode=mysqli_real_escape_string($connection,$_POST['subjectcode']);
        $Description=mysqli_real_escape_string($connection,$_POST['description']);
        $Lec=mysqli_real_escape_string($connection,$_POST['lec']);
        $Lab=mysqli_real_escape_string($connection,$_POST['lab']);
        $Units=mysqli_real_escape_string($connection,$_POST['units']);       
        
        $Collegeid = $_SESSION['college_id_fk'];
        $courseid = $_SESSION['course_id_fk'];

        $Prereq = $_POST['prereq'];
        
        $getcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE subject_code='$Prereq'");
        while($fa = mysqli_fetch_array($getcode))
        {
            $getsubid = $fa['id'];
            $getsubcode = $fa['subject_code'];
            $getsubtitle = $fa['description'];
            $getsubyear = $fa['yearlevel'];
            $getsubsem = $fa['semester'];
        }
        $getcurrid = mysqli_query($connection, "SELECT * from tblcurriculum WHERE curr_code='$CurrCode'");
        if(mysqli_num_rows($getcurrid) > 0){
            $fa_c = mysqli_fetch_array($getcurrid);
            $curr_id = $fa_c['id']; //store cuuriculum id
        }
        $get_subject_info = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$SubjectID'");
        while($ca=mysqli_fetch_array($get_subject_info))
        {
            $SUBJECTCODE = $ca['subject_code'];
            $TITLE = $ca['description'];
            $LEC = $ca['lec'];
            $LAB = $ca['lab'];
            $UNITS = $ca['units'];
            $YEAR = $ca['yearlevel'];
            $SEMESTER = $ca['semester'];
            $PREREQUISITE =$ca['prerequisite'];
        }
        $get_preq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$SUBJECTCODE'");
        foreach($get_preq as $data)
        {
            $SUBJECT_UNDER = $data['subject_id'];
        }
        $check_sub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$SUBJECT_UNDER'");
        foreach($check_sub as $A)
        {
            $SUBJECT_code = $A['subject_code'];
        }

        if($SubjectCode == "$SUBJECTCODE" && $Description == "$TITLE" && $Lec == "$LEC" && $Lab == "$LAB" && $Units == "$UNITS" && $Yearlevel == "$YEAR" && $Semester == "$SEMESTER" && $Prereq == "$SUBJECT_code")
        {
            $_SESSION['status'] = "Nothing To Be Upated!!";
            $_SESSION['status_code'] = "info";
            header("location: admin-subjects.php"); 
        }
        else
        {
            if($Prereq == "NONE")
            {
                $sql = "UPDATE `tblsubject` SET `subject_code`='$SubjectCode', `description`='$Description', `lec`='$Lec', `lab`='$Lab', `units`='$Units',`prerequisite`='$prereq', `semester`='$Semester', `yearlevel`='$Yearlevel',`course_id_fk`='$Courseid',`college_id_fk`='$Collegeid' WHERE id='$SubjectID'";
                
                if(mysqli_query($connection,$sql))
                {   
                    $_SESSION['status'] = "Successfully Updated!";
                    $_SESSION['status_code'] = "success";
                    header("location: admin-subjects.php");            
                }else{
                    $_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data!!";
                    $_SESSION['status_code'] = "error";
                    header("location: admin-subjects.php");
                }
            }
            else
            {
                $prereq = $getsubid;

                $sql = "UPDATE `tblsubject` SET `subject_code`='$SubjectCode', `description`='$Description', `lec`='$Lec', `lab`='$Lab', `units`='$Units', `semester`='$Semester', `yearlevel`='$Yearlevel',`course_id_fk`='$Courseid',`college_id_fk`='$Collegeid' WHERE id='$SubjectID'";
                
                foreach($prereq as $subject_id)
                {
                    $sql1 = "UPDATE tblprereq SET `subject_id`='$SubjectID' WHERE `subject_under`='$SubjectCode'";
                    mysqli_query($connection,$sql1);
                }
                if(mysqli_query($connection,$sql))
                {   
                    $_SESSION['status'] = "Successfully Updated Subject!!";
                    $_SESSION['status_code'] = "success";
                    header("location: admin-subjects.php");            
                }
                else
                {
                    $_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data or Contact the Personal incharge!!";
                    $_SESSION['status_code'] = "error";
                    header("location: admin-subjects.php");
                }  
            }
        }
    }
    // End of Edit 2nd Subject 2nd sem Data //

    // Start Delete 2ND Subject 1st Sem //
    if (isset($_POST['delete_2nd_subject_1st']))
	{
		$id = $_POST['id'];
        $status = 0;
        $sql ="UPDATE tblsubject SET status='$status' WHERE id='$id'";
		
		if(mysqli_query($connection, $sql))
		{
			$_SESSION['status'] = "Successfully Delete!";
            $_SESSION['status_code'] = "success";
            header("location:admin-subjects.php");
		} else {
			$_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data!!";
            $_SESSION['status_code'] = "error";
            header("location:admin-subjects.php");
		}
	}
    // End Delete 2ND Subject 1st Sem //

    // Start Delete 2ND Subject 2ND Sem //
    if (isset($_POST['delete_2nd_subject_2nd']))
	{
		$id = $_POST['id'];
        $status = 0;
        $sql ="UPDATE tblsubject SET status='$status' WHERE id='$id'";
		
		if(mysqli_query($connection, $sql))
		{
			$_SESSION['status'] = "Successfully Delete!";
            $_SESSION['status_code'] = "success";
            header("location:admin-subjects.php");
		} else {
			$_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data!!";
            $_SESSION['status_code'] = "error";
            header("location:admin-subjects.php");
		}
	}
    // End Delete 2ND Subject 2ND Sem //

    // Start of Delete All 2nd Subject //
    if (isset($_POST['delete_all_2nd_subject_1st']))
	{
		$currid = $_POST['currid'];
        $courseid = $_POST['courseid'];
        $yearlevel = 1;

		$sql ="DELETE FROM tblsubject WHERE curr_id_fk='$currid' and course_id_fk='$courseid'";
        $sql1 ="DELETE FROM tblprereq WHERE curri_id_fk='$currid' and course_id_fk='$courseid'";

        $pre_id = mysqli_query($connection,"SELECT * FROM tblsprereq");
        while($ha=mysqli_fetch_array($pre_id))
        {
            $preq_id = $ha['id'];
        }

		$get_id = mysqli_query($connection,"SELECT * FROM tblsubject");

		while($sa = mysqli_fetch_array($get_id))
		{
			$curid = $sa['id'];
		}

		$c = "ALTER TABLE tblsubject AUTO_INCREMENT = $curid";
        $d = "ALTER TABLE tblprereq AUTO_INCREMENT = $curid";
		
		if(mysqli_query($connection, $sql) && mysqli_query($connection, $sql1) && mysqli_query($connection, $c) && mysqli_query($connection, $c))
		{
			$_SESSION['status'] = "Successfully Delete All Subjects!!";
            $_SESSION['status_code'] = "success";
            header("location:admin-subjects.php");
		} else {
			$_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data or or Contact the Personel incharge!!";
            $_SESSION['status_code'] = "error";
            header("location:admin-subjects.php");
		}
	}
    // End of Delete All 2nd Subject //
// 2nd Year Subjects Data //

// 3rd Year Subjects Data //
    // Start of Edit 3rd Subject 1st sem Data //
    if (isset($_POST['edit_3rd_year_subject_1st']))
    {
        $CurrCode=mysqli_real_escape_string($connection,$_POST['curr_code']);
        $Courseid=mysqli_real_escape_string($connection,$_POST['courseid']); 
        // up not tobe updated //
        $SubjectID = mysqli_real_escape_string($connection,$_POST['subject_id']);
        $Yearlevel=mysqli_real_escape_string($connection,$_POST['yearlevel']);
        $Semester=mysqli_real_escape_string($connection,$_POST['semester']);
        $SubjectCode=mysqli_real_escape_string($connection,$_POST['subjectcode']);
        $Description=mysqli_real_escape_string($connection,$_POST['description']);
        $Lec=mysqli_real_escape_string($connection,$_POST['lec']);
        $Lab=mysqli_real_escape_string($connection,$_POST['lab']);
        $Units=mysqli_real_escape_string($connection,$_POST['units']);       
        
        $Collegeid = $_SESSION['college_id_fk'];
        $courseid = $_SESSION['course_id_fk'];

        $Prereq = $_POST['prereq'];
        
        $getcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE subject_code='$Prereq'");
        while($fa = mysqli_fetch_array($getcode))
        {
            $getsubid = $fa['id'];
            $getsubcode = $fa['subject_code'];
            $getsubtitle = $fa['description'];
            $getsubyear = $fa['yearlevel'];
            $getsubsem = $fa['semester'];
        }
        $getcurrid = mysqli_query($connection, "SELECT * from tblcurriculum WHERE curr_code='$CurrCode'");
        if(mysqli_num_rows($getcurrid) > 0){
            $fa_c = mysqli_fetch_array($getcurrid);
            $curr_id = $fa_c['id']; //store cuuriculum id
        }
        $get_subject_info = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$SubjectID'");
        while($ca=mysqli_fetch_array($get_subject_info))
        {
            $SUBJECTCODE = $ca['subject_code'];
            $TITLE = $ca['description'];
            $LEC = $ca['lec'];
            $LAB = $ca['lab'];
            $UNITS = $ca['units'];
            $YEAR = $ca['yearlevel'];
            $SEMESTER = $ca['semester'];
            $PREREQUISITE =$ca['prerequisite'];
        }
        $get_preq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$SUBJECTCODE'");
        foreach($get_preq as $data)
        {
            $SUBJECT_UNDER = $data['subject_id'];
        }
        $check_sub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$SUBJECT_UNDER'");
        foreach($check_sub as $A)
        {
            $SUBJECT_code = $A['subject_code'];
        }

        if($SubjectCode == "$SUBJECTCODE" && $Description == "$TITLE" && $Lec == "$LEC" && $Lab == "$LAB" && $units == "$UNITS" && $Yearlevel == "$YEAR" && $Semester == "$SEMESTER" && $Prereq == "$SUBJECT_code")
        {
            $_SESSION['status'] = "Nothing To Be Upated!!";
            $_SESSION['status_code'] = "info";
            header("location: admin-subjects.php"); 
        }
        else
        {
            if($Prereq == "NONE")
            {
                $sql = "UPDATE `tblsubject` SET `subject_code`='$SubjectCode', `description`='$Description', `lec`='$lec', `lab`='$lab', `units`='$Units',`prerequisite`='$prereq', `semester`='$Semester', `yearlevel`='$Yearlevel',`course_id_fk`='$Courseid',`college_id_fk`='$Collegeid' WHERE id='$SubjectID'";
                
                if(mysqli_query($connection,$sql))
                {   
                    $_SESSION['status'] = "Successfully Updated!";
                    $_SESSION['status_code'] = "success";
                    header("location: admin-subjects.php");            
                }else{
                    $_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data!!";
                    $_SESSION['status_code'] = "error";
                    header("location: admin-subjects.php");
                }
            }
            else
            {
                $prereq = $getsubid;

                $sql = "UPDATE `tblsubject` SET `subject_code`='$SubjectCode', `description`='$Description', `lec`='$lec', `lab`='$lab', `units`='$Units', `semester`='$Semester', `yearlevel`='$Yearlevel',`course_id_fk`='$Courseid',`college_id_fk`='$Collegeid' WHERE id='$SubjectID'";
                
                foreach($prereq as $subject_id)
                {
                    $sql1 = "UPDATE tblprereq SET `subject_id`='$SubjectID' WHERE `subject_under`='$SubjectCode'";
                    mysqli_query($connection,$sql1);
                }
                if(mysqli_query($connection,$sql))
                {   
                    $_SESSION['status'] = "Successfully Updated Subject!!";
                    $_SESSION['status_code'] = "success";
                    header("location: admin-subjects.php");            
                }
                else
                {
                    $_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data or Contact the Personal incharge!!";
                    $_SESSION['status_code'] = "error";
                    header("location: admin-subjects.php");
                }  
            }
        }
    }
    // End of Edit 3rd Subject 1st sem Data //

    // Start of Edit 3rd Subject 2nd sem Data //
    if (isset($_POST['edit_3rd_year_subject_2nd']))
    {
        $CurrCode=mysqli_real_escape_string($connection,$_POST['curr_code']);
        $Courseid=mysqli_real_escape_string($connection,$_POST['courseid']); 
        // up not tobe updated //
        $SubjectID = mysqli_real_escape_string($connection,$_POST['subject_id']);
        $Yearlevel=mysqli_real_escape_string($connection,$_POST['yearlevel']);
        $Semester=mysqli_real_escape_string($connection,$_POST['semester']);
        $SubjectCode=mysqli_real_escape_string($connection,$_POST['subjectcode']);
        $Description=mysqli_real_escape_string($connection,$_POST['description']);
        $Lec=mysqli_real_escape_string($connection,$_POST['lec']);
        $Lab=mysqli_real_escape_string($connection,$_POST['lab']);
        $Units=mysqli_real_escape_string($connection,$_POST['units']);       
        
        $Collegeid = $_SESSION['college_id_fk'];
        $courseid = $_SESSION['course_id_fk'];

        $Prereq = $_POST['prereq'];
        
        $getcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE subject_code='$Prereq'");
        while($fa = mysqli_fetch_array($getcode))
        {
            $getsubid = $fa['id'];
            $getsubcode = $fa['subject_code'];
            $getsubtitle = $fa['description'];
            $getsubyear = $fa['yearlevel'];
            $getsubsem = $fa['semester'];
        }
        $getcurrid = mysqli_query($connection, "SELECT * from tblcurriculum WHERE curr_code='$CurrCode'");
        if(mysqli_num_rows($getcurrid) > 0){
            $fa_c = mysqli_fetch_array($getcurrid);
            $curr_id = $fa_c['id']; //store cuuriculum id
        }
        $get_subject_info = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$SubjectID'");
        while($ca=mysqli_fetch_array($get_subject_info))
        {
            $SUBJECTCODE = $ca['subject_code'];
            $TITLE = $ca['description'];
            $LEC = $ca['lec'];
            $LAB = $ca['lab'];
            $UNITS = $ca['units'];
            $YEAR = $ca['yearlevel'];
            $SEMESTER = $ca['semester'];
            $PREREQUISITE =$ca['prerequisite'];
        }
        $get_preq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$SUBJECTCODE'");
        foreach($get_preq as $data)
        {
            $SUBJECT_UNDER = $data['subject_id'];
        }
        $check_sub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$SUBJECT_UNDER'");
        foreach($check_sub as $A)
        {
            $SUBJECT_code = $A['subject_code'];
        }

        if($SubjectCode == "$SUBJECTCODE" && $Description == "$TITLE" && $Lec == "$LEC" && $Lab == "$LAB" && $Units == "$UNITS" && $Yearlevel == "$YEAR" && $Semester == "$SEMESTER" && $Prereq == "$SUBJECT_code")
        {
            $_SESSION['status'] = "Nothing To Be Upated!!";
            $_SESSION['status_code'] = "info";
            header("location: admin-subjects.php"); 
        }
        else
        {
            if($Prereq == "NONE")
            {
                $sql = "UPDATE `tblsubject` SET `subject_code`='$SubjectCode', `description`='$Description', `lec`='$Lec', `lab`='$Lab', `units`='$Units',`prerequisite`='$prereq', `semester`='$Semester', `yearlevel`='$Yearlevel',`course_id_fk`='$Courseid',`college_id_fk`='$Collegeid' WHERE id='$SubjectID'";
                
                if(mysqli_query($connection,$sql))
                {   
                    $_SESSION['status'] = "Successfully Updated!";
                    $_SESSION['status_code'] = "success";
                    header("location: admin-subjects.php");            
                }else{
                    $_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data!!";
                    $_SESSION['status_code'] = "error";
                    header("location: admin-subjects.php");
                }
            }
            else
            {
                $prereq = $getsubid;

                $sql = "UPDATE `tblsubject` SET `subject_code`='$SubjectCode', `description`='$Description', `lec`='$Lec', `lab`='$Lab', `units`='$Units', `semester`='$Semester', `yearlevel`='$Yearlevel',`course_id_fk`='$Courseid',`college_id_fk`='$Collegeid' WHERE id='$SubjectID'";
                
                foreach($prereq as $subject_id)
                {
                    $sql1 = "UPDATE tblprereq SET `subject_id`='$SubjectID' WHERE `subject_under`='$SubjectCode'";
                    mysqli_query($connection,$sql1);
                }
                if(mysqli_query($connection,$sql))
                {   
                    $_SESSION['status'] = "Successfully Updated Subject!!";
                    $_SESSION['status_code'] = "success";
                    header("location: admin-subjects.php");            
                }
                else
                {
                    $_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data or Contact the Personal incharge!!";
                    $_SESSION['status_code'] = "error";
                    header("location: admin-subjects.php");
                }  
            }
        }
    }
    // End of Edit 3rd Subject 2nd sem Data //

    // Start Delete 3rd Subject 1st Sem //
    if (isset($_POST['delete_3rd_subject_1st']))
	{
		$id = $_POST['id'];
        $status = 0;
        $sql ="UPDATE tblsubject SET status='$status' WHERE id='$id'";
		
		if(mysqli_query($connection, $sql))
		{
			$_SESSION['status'] = "Successfully Delete!";
            $_SESSION['status_code'] = "success";
            header("location:admin-subjects.php");
		} else {
			$_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data!!";
            $_SESSION['status_code'] = "error";
            header("location:admin-subjects.php");
		}
	}
    // End Delete 3rd Subject 1st Sem //

    // Start Delete 3rd Subject 2nd Sem //
    if (isset($_POST['delete_3rd_subject_2nd']))
	{
		$id = $_POST['id'];
        $status = 0;
        $sql ="UPDATE tblsubject SET status='$status' WHERE id='$id'";
		
		if(mysqli_query($connection, $sql))
		{
			$_SESSION['status'] = "Successfully Delete!";
            $_SESSION['status_code'] = "success";
            header("location:admin-subjects.php");
		} else {
			$_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data!!";
            $_SESSION['status_code'] = "error";
            header("location:admin-subjects.php");
		}
	}
    // End Delete 3rd Subject 2nd Sem //

    // Start of Delete All 3rd year Subject //
    if (isset($_POST['delete_all_3rd_subject']))
	{
		$currid = $_POST['currid'];
        $courseid = $_POST['courseid'];
        $yearlevel = 1;

		$sql ="DELETE FROM tblsubject WHERE curr_id_fk='$currid' and course_id_fk='$courseid'";
        $sql1 ="DELETE FROM tblprereq WHERE curri_id_fk='$currid' and course_id_fk='$courseid'";

        $pre_id = mysqli_query($connection,"SELECT * FROM tblsprereq");
        while($ha=mysqli_fetch_array($pre_id))
        {
            $preq_id = $ha['id'];
        }

		$get_id = mysqli_query($connection,"SELECT * FROM tblsubject");

		while($sa = mysqli_fetch_array($get_id))
		{
			$curid = $sa['id'];
		}

		$c = "ALTER TABLE tblsubject AUTO_INCREMENT = $curid";
        $d = "ALTER TABLE tblprereq AUTO_INCREMENT = $curid";
		
		if(mysqli_query($connection, $sql) && mysqli_query($connection, $sql1) && mysqli_query($connection, $c) && mysqli_query($connection, $c))
		{
			$_SESSION['status'] = "Successfully Delete All Subjects!!";
            $_SESSION['status_code'] = "success";
            header("location:admin-subjects.php");
		} else {
			$_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data or or Contact the Personel incharge!!";
            $_SESSION['status_code'] = "error";
            header("location:admin-subjects.php");
		}
	}
    // End of Delete All 3rd year Subject //
// 3rd Year Subjects Data //

// 4th Year Subjects Data //
    // Start of Edit 4th Subject 1st sem Data //
    if (isset($_POST['edit_4th_year_subject_1st']))
    {
        $CurrCode=mysqli_real_escape_string($connection,$_POST['curr_code']);
        $Courseid=mysqli_real_escape_string($connection,$_POST['courseid']); 
        // up not tobe updated //
        $SubjectID = mysqli_real_escape_string($connection,$_POST['subject_id']);
        $Yearlevel=mysqli_real_escape_string($connection,$_POST['yearlevel']);
        $Semester=mysqli_real_escape_string($connection,$_POST['semester']);
        $SubjectCode=mysqli_real_escape_string($connection,$_POST['subjectcode']);
        $Description=mysqli_real_escape_string($connection,$_POST['description']);
        $Lec=mysqli_real_escape_string($connection,$_POST['lec']);
        $Lab=mysqli_real_escape_string($connection,$_POST['lab']);
        $Units=mysqli_real_escape_string($connection,$_POST['units']);       
        
        $Collegeid = $_SESSION['college_id_fk'];
        $courseid = $_SESSION['course_id_fk'];

        $Prereq = $_POST['prereq'];
        
        $getcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE subject_code='$Prereq'");
        while($fa = mysqli_fetch_array($getcode))
        {
            $getsubid = $fa['id'];
            $getsubcode = $fa['subject_code'];
            $getsubtitle = $fa['description'];
            $getsubyear = $fa['yearlevel'];
            $getsubsem = $fa['semester'];
        }
        $getcurrid = mysqli_query($connection, "SELECT * from tblcurriculum WHERE curr_code='$CurrCode'");
        if(mysqli_num_rows($getcurrid) > 0){
            $fa_c = mysqli_fetch_array($getcurrid);
            $curr_id = $fa_c['id']; //store cuuriculum id
        }
        $get_subject_info = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$SubjectID'");
        while($ca=mysqli_fetch_array($get_subject_info))
        {
            $SUBJECTCODE = $ca['subject_code'];
            $TITLE = $ca['description'];
            $LEC = $ca['lec'];
            $LAB = $ca['lab'];
            $UNITS = $ca['units'];
            $YEAR = $ca['yearlevel'];
            $SEMESTER = $ca['semester'];
            $PREREQUISITE =$ca['prerequisite'];
        }
        $get_preq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$SUBJECTCODE'");
        foreach($get_preq as $data)
        {
            $SUBJECT_UNDER = $data['subject_id'];
        }
        $check_sub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$SUBJECT_UNDER'");
        foreach($check_sub as $A)
        {
            $SUBJECT_code = $A['subject_code'];
        }

        if($SubjectCode == "$SUBJECTCODE" && $Description == "$TITLE" && $Lec == "$LEC" && $Lab == "$LAB" && $Units == "$UNITS" && $Yearlevel == "$YEAR" && $Semester == "$SEMESTER" && $Prereq == "$SUBJECT_code")
        {
            $_SESSION['status'] = "Nothing To Be Upated!!";
            $_SESSION['status_code'] = "info";
            header("location: admin-subjects.php"); 
        }
        else
        {
            if($Prereq == "NONE")
            {
                $sql = "UPDATE `tblsubject` SET `subject_code`='$SubjectCode', `description`='$Description', `lec`='$Lec', `lab`='$Lab', `units`='$Units',`prerequisite`='$prereq', `semester`='$Semester', `yearlevel`='$Yearlevel',`course_id_fk`='$Courseid',`college_id_fk`='$Collegeid' WHERE id='$SubjectID'";
                
                if(mysqli_query($connection,$sql))
                {   
                    $_SESSION['status'] = "Successfully Updated!";
                    $_SESSION['status_code'] = "success";
                    header("location: admin-subjects.php");            
                }else{
                    $_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data!!";
                    $_SESSION['status_code'] = "error";
                    header("location: admin-subjects.php");
                }
            }
            else
            {
                $prereq = $getsubid;

                $sql = "UPDATE `tblsubject` SET `subject_code`='$SubjectCode', `description`='$Description', `lec`='$Lec', `lab`='$Lab', `units`='$Units', `semester`='$Semester', `yearlevel`='$Yearlevel',`course_id_fk`='$Courseid',`college_id_fk`='$Collegeid' WHERE id='$SubjectID'";
                
                foreach($prereq as $subject_id)
                {
                    $sql1 = "UPDATE tblprereq SET `subject_id`='$SubjectID' WHERE `subject_under`='$SubjectCode'";
                    mysqli_query($connection,$sql1);
                }
                if(mysqli_query($connection,$sql))
                {   
                    $_SESSION['status'] = "Successfully Updated Subject!!";
                    $_SESSION['status_code'] = "success";
                    header("location: admin-subjects.php");            
                }
                else
                {
                    $_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data or Contact the Personal incharge!!";
                    $_SESSION['status_code'] = "error";
                    header("location: admin-subjects.php");
                }  
            }
        }
    }
    // End of Edit 4th Subject 1st sem Data //

    // Start of Edit 4th Subject 2nd sem Data //
    if (isset($_POST['edit_4th_year_subject_2nd']))
    {
        $CurrCode=mysqli_real_escape_string($connection,$_POST['curr_code']);
        $Courseid=mysqli_real_escape_string($connection,$_POST['courseid']); 
        // up not tobe updated //
        $SubjectID = mysqli_real_escape_string($connection,$_POST['subject_id']);
        $Yearlevel=mysqli_real_escape_string($connection,$_POST['yearlevel']);
        $Semester=mysqli_real_escape_string($connection,$_POST['semester']);
        $SubjectCode=mysqli_real_escape_string($connection,$_POST['subjectcode']);
        $Description=mysqli_real_escape_string($connection,$_POST['description']);
        $Lec=mysqli_real_escape_string($connection,$_POST['lec']);
        $Lab=mysqli_real_escape_string($connection,$_POST['lab']);
        $Units=mysqli_real_escape_string($connection,$_POST['units']);       
        
        $Collegeid = $_SESSION['college_id_fk'];
        $courseid = $_SESSION['course_id_fk'];

        $Prereq = $_POST['prereq'];
        
        $getcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE subject_code='$Prereq'");
        while($fa = mysqli_fetch_array($getcode))
        {
            $getsubid = $fa['id'];
            $getsubcode = $fa['subject_code'];
            $getsubtitle = $fa['description'];
            $getsubyear = $fa['yearlevel'];
            $getsubsem = $fa['semester'];
        }
        $getcurrid = mysqli_query($connection, "SELECT * from tblcurriculum WHERE curr_code='$CurrCode'");
        if(mysqli_num_rows($getcurrid) > 0){
            $fa_c = mysqli_fetch_array($getcurrid);
            $curr_id = $fa_c['id']; //store cuuriculum id
        }
        $get_subject_info = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$SubjectID'");
        while($ca=mysqli_fetch_array($get_subject_info))
        {
            $SUBJECTCODE = $ca['subject_code'];
            $TITLE = $ca['description'];
            $LEC = $ca['lec'];
            $LAB = $ca['lab'];
            $UNITS = $ca['units'];
            $YEAR = $ca['yearlevel'];
            $SEMESTER = $ca['semester'];
            $PREREQUISITE =$ca['prerequisite'];
        }
        $get_preq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$SUBJECTCODE'");
        foreach($get_preq as $data)
        {
            $SUBJECT_UNDER = $data['subject_id'];
        }
        $check_sub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$SUBJECT_UNDER'");
        foreach($check_sub as $A)
        {
            $SUBJECT_code = $A['subject_code'];
        }

        if($SubjectCode == "$SUBJECTCODE" && $Description == "$TITLE" && $Lec == "$LEC" && $Lab == "$LAB" && $Units == "$UNITS" && $Yearlevel == "$YEAR" && $Semester == "$SEMESTER" && $Prereq == "$SUBJECT_code")
        {
            $_SESSION['status'] = "Nothing To Be Upated!!";
            $_SESSION['status_code'] = "info";
            header("location: admin-subjects.php"); 
        }
        else
        {
            if($Prereq == "NONE")
            {
                $sql = "UPDATE `tblsubject` SET `subject_code`='$SubjectCode', `description`='$Description', `lec`='$Lec', `lab`='$Lab', `units`='$Units',`prerequisite`='$prereq', `semester`='$Semester', `yearlevel`='$Yearlevel',`course_id_fk`='$Courseid',`college_id_fk`='$Collegeid' WHERE id='$SubjectID'";
                
                if(mysqli_query($connection,$sql))
                {   
                    $_SESSION['status'] = "Successfully Updated!";
                    $_SESSION['status_code'] = "success";
                    header("location: admin-subjects.php");            
                }else{
                    $_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data!!";
                    $_SESSION['status_code'] = "error";
                    header("location: admin-subjects.php");
                }
            }
            else
            {
                $prereq = $getsubid;

                $sql = "UPDATE `tblsubject` SET `subject_code`='$SubjectCode', `description`='$Description', `lec`='$Lec', `lab`='$Lab', `units`='$Units', `semester`='$Semester', `yearlevel`='$Yearlevel',`course_id_fk`='$Courseid',`college_id_fk`='$Collegeid' WHERE id='$SubjectID'";
                
                foreach($prereq as $subject_id)
                {
                    $sql1 = "UPDATE tblprereq SET `subject_id`='$SubjectID' WHERE `subject_under`='$SubjectCode'";
                    mysqli_query($connection,$sql1);
                }
                if(mysqli_query($connection,$sql))
                {   
                    $_SESSION['status'] = "Successfully Updated Subject!!";
                    $_SESSION['status_code'] = "success";
                    header("location: admin-subjects.php");            
                }
                else
                {
                    $_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data or Contact the Personal incharge!!";
                    $_SESSION['status_code'] = "error";
                    header("location: admin-subjects.php");
                }  
            }
        }
    }
    // End of Edit 4th Subject 2nd sem Data //

    // Start Delete 4th Subject 1st Sem //
    if (isset($_POST['delete_4th_subject_1st']))
	{
		$id = $_POST['id'];
        $status = 0;
        $sql ="UPDATE tblsubject SET status='$status' WHERE id='$id'";
		
		if(mysqli_query($connection, $sql))
		{
			$_SESSION['status'] = "Successfully Delete!";
            $_SESSION['status_code'] = "success";
            header("location:admin-subjects.php");
		} else {
			$_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data!!";
            $_SESSION['status_code'] = "error";
            header("location:admin-subjects.php");
		}
	}
    // End Delete 4th Subject 1st Sem //

    // Start Delete 4th Subject 2nd Sem //
    if (isset($_POST['delete_4th_subject_2nd']))
	{
		$id = $_POST['id'];
        $status = 0;
        $sql ="UPDATE tblsubject SET status='$status' WHERE id='$id'";
		
		if(mysqli_query($connection, $sql))
		{
			$_SESSION['status'] = "Successfully Delete!";
            $_SESSION['status_code'] = "success";
            header("location:admin-subjects.php");
		} else {
			$_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data!!";
            $_SESSION['status_code'] = "error";
            header("location:admin-subjects.php");
		}
	}
    // End Delete 4th Subject 2nd Sem //

    // Start of Delete All 4th year Subject //
    if (isset($_POST['delete_all_4th_subject']))
	{
		$currid = $_POST['currid'];
        $courseid = $_POST['courseid'];
        $yearlevel = 1;

		$sql ="DELETE FROM tblsubject WHERE curr_id_fk='$currid' and course_id_fk='$courseid'";
        $sql1 ="DELETE FROM tblprereq WHERE curri_id_fk='$currid' and course_id_fk='$courseid'";

        $pre_id = mysqli_query($connection,"SELECT * FROM tblsprereq");
        while($ha=mysqli_fetch_array($pre_id))
        {
            $preq_id = $ha['id'];
        }

		$get_id = mysqli_query($connection,"SELECT * FROM tblsubject");

		while($sa = mysqli_fetch_array($get_id))
		{
			$curid = $sa['id'];
		}

		$c = "ALTER TABLE tblsubject AUTO_INCREMENT = $curid";
        $d = "ALTER TABLE tblprereq AUTO_INCREMENT = $curid";
		
		if(mysqli_query($connection, $sql) && mysqli_query($connection, $sql1) && mysqli_query($connection, $c) && mysqli_query($connection, $c))
		{
			$_SESSION['status'] = "Successfully Delete All Subjects!!";
            $_SESSION['status_code'] = "success";
            header("location:admin-subjects.php");
		} else {
			$_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data or or Contact the Personel incharge!!";
            $_SESSION['status_code'] = "error";
            header("location:admin-subjects.php");
		}
	}
    // End of Delete All 4th year Subject //
// 4th Year Subjects Data //

// 5th Year Subjects Data //
    // Start of Edit 5th Subject 1st sem Data //
    if (isset($_POST['edit_5th_year_subject_1st']))
    {
        $CurrCode=mysqli_real_escape_string($connection,$_POST['curr_code']);
        $Courseid=mysqli_real_escape_string($connection,$_POST['courseid']); 
        // up not tobe updated //
        $SubjectID = mysqli_real_escape_string($connection,$_POST['subject_id']);
        $Yearlevel=mysqli_real_escape_string($connection,$_POST['yearlevel']);
        $Semester=mysqli_real_escape_string($connection,$_POST['semester']);
        $SubjectCode=mysqli_real_escape_string($connection,$_POST['subjectcode']);
        $Description=mysqli_real_escape_string($connection,$_POST['description']);
        $Lec=mysqli_real_escape_string($connection,$_POST['lec']);
        $Lab=mysqli_real_escape_string($connection,$_POST['lab']);
        $Units=mysqli_real_escape_string($connection,$_POST['units']);       
        
        $Collegeid = $_SESSION['college_id_fk'];
        $courseid = $_SESSION['course_id_fk'];

        $Prereq = $_POST['prereq'];
        
        $getcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE subject_code='$Prereq'");
        while($fa = mysqli_fetch_array($getcode))
        {
            $getsubid = $fa['id'];
            $getsubcode = $fa['subject_code'];
            $getsubtitle = $fa['description'];
            $getsubyear = $fa['yearlevel'];
            $getsubsem = $fa['semester'];
        }
        $getcurrid = mysqli_query($connection, "SELECT * from tblcurriculum WHERE curr_code='$CurrCode'");
        if(mysqli_num_rows($getcurrid) > 0){
            $fa_c = mysqli_fetch_array($getcurrid);
            $curr_id = $fa_c['id']; //store cuuriculum id
        }
        $get_subject_info = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$SubjectID'");
        while($ca=mysqli_fetch_array($get_subject_info))
        {
            $SUBJECTCODE = $ca['subject_code'];
            $TITLE = $ca['description'];
            $LEC = $ca['lec'];
            $LAB = $ca['lab'];
            $UNITS = $ca['units'];
            $YEAR = $ca['yearlevel'];
            $SEMESTER = $ca['semester'];
            $PREREQUISITE =$ca['prerequisite'];
        }
        $get_preq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$SUBJECTCODE'");
        foreach($get_preq as $data)
        {
            $SUBJECT_UNDER = $data['subject_id'];
        }
        $check_sub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$SUBJECT_UNDER'");
        foreach($check_sub as $A)
        {
            $SUBJECT_code = $A['subject_code'];
        }

        if($SubjectCode == "$SUBJECTCODE" && $Description == "$TITLE" && $Lec == "$LEC" && $Lab == "$LAB" && $Units == "$UNITS" && $Yearlevel == "$YEAR" && $Semester == "$SEMESTER" && $Prereq == "$SUBJECT_code")
        {
            $_SESSION['status'] = "Nothing To Be Upated!!";
            $_SESSION['status_code'] = "info";
            header("location: admin-subjects.php"); 
        }
        else
        {
            if($Prereq == "NONE")
            {
                $sql = "UPDATE `tblsubject` SET `subject_code`='$SubjectCode', `description`='$Description', `lec`='$Lec', `lab`='$Lab', `units`='$Units',`prerequisite`='$prereq', `semester`='$Semester', `yearlevel`='$Yearlevel',`course_id_fk`='$Courseid',`college_id_fk`='$Collegeid' WHERE id='$SubjectID'";
                
                if(mysqli_query($connection,$sql))
                {   
                    $_SESSION['status'] = "Successfully Updated!";
                    $_SESSION['status_code'] = "success";
                    header("location: admin-subjects.php");            
                }else{
                    $_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data!!";
                    $_SESSION['status_code'] = "error";
                    header("location: admin-subjects.php");
                }
            }
            else
            {
                $prereq = $getsubid;

                $sql = "UPDATE `tblsubject` SET `subject_code`='$SubjectCode', `description`='$Description', `lec`='$Lec', `lab`='$Lab', `units`='$Units', `semester`='$Semester', `yearlevel`='$Yearlevel',`course_id_fk`='$Courseid',`college_id_fk`='$Collegeid' WHERE id='$SubjectID'";
                
                foreach($prereq as $subject_id)
                {
                    $sql1 = "UPDATE tblprereq SET `subject_id`='$SubjectID' WHERE `subject_under`='$SubjectCode'";
                    mysqli_query($connection,$sql1);
                }
                if(mysqli_query($connection,$sql))
                {   
                    $_SESSION['status'] = "Successfully Updated Subject!!";
                    $_SESSION['status_code'] = "success";
                    header("location: admin-subjects.php");            
                }
                else
                {
                    $_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data or Contact the Personal incharge!!";
                    $_SESSION['status_code'] = "error";
                    header("location: admin-subjects.php");
                }  
            }
        }
    }
    // End of Edit 5th Subject 1st sem Data //

    // Start of Edit 5th Subject 2nd sem Data //
    if (isset($_POST['edit_5th_year_subject_2nd']))
    {
        $CurrCode=mysqli_real_escape_string($connection,$_POST['curr_code']);
        $Courseid=mysqli_real_escape_string($connection,$_POST['courseid']); 
        // up not tobe updated //
        $SubjectID = mysqli_real_escape_string($connection,$_POST['subject_id']);
        $Yearlevel=mysqli_real_escape_string($connection,$_POST['yearlevel']);
        $Semester=mysqli_real_escape_string($connection,$_POST['semester']);
        $SubjectCode=mysqli_real_escape_string($connection,$_POST['subjectcode']);
        $Description=mysqli_real_escape_string($connection,$_POST['description']);
        $Lec=mysqli_real_escape_string($connection,$_POST['lec']);
        $Lab=mysqli_real_escape_string($connection,$_POST['lab']);
        $Units=mysqli_real_escape_string($connection,$_POST['units']);       
        
        $Collegeid = $_SESSION['college_id_fk'];
        $courseid = $_SESSION['course_id_fk'];

        $Prereq = $_POST['prereq'];
        
        $getcode = mysqli_query($connection,"SELECT * FROM tblsubject WHERE subject_code='$Prereq'");
        while($fa = mysqli_fetch_array($getcode))
        {
            $getsubid = $fa['id'];
            $getsubcode = $fa['subject_code'];
            $getsubtitle = $fa['description'];
            $getsubyear = $fa['yearlevel'];
            $getsubsem = $fa['semester'];
        }
        $getcurrid = mysqli_query($connection, "SELECT * from tblcurriculum WHERE curr_code='$CurrCode'");
        if(mysqli_num_rows($getcurrid) > 0){
            $fa_c = mysqli_fetch_array($getcurrid);
            $curr_id = $fa_c['id']; //store cuuriculum id
        }
        $get_subject_info = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$SubjectID'");
        while($ca=mysqli_fetch_array($get_subject_info))
        {
            $SUBJECTCODE = $ca['subject_code'];
            $TITLE = $ca['description'];
            $LEC = $ca['lec'];
            $LAB = $ca['lab'];
            $UNITS = $ca['units'];
            $YEAR = $ca['yearlevel'];
            $SEMESTER = $ca['semester'];
            $PREREQUISITE =$ca['prerequisite'];
        }
        $get_preq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$SUBJECTCODE'");
        foreach($get_preq as $data)
        {
            $SUBJECT_UNDER = $data['subject_id'];
        }
        $check_sub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$SUBJECT_UNDER'");
        foreach($check_sub as $A)
        {
            $SUBJECT_code = $A['subject_code'];
        }

        if($SubjectCode == "$SUBJECTCODE" && $Description == "$TITLE" && $Lec == "$LEC" && $Lab == "$LAB" && $Units == "$UNITS" && $Yearlevel == "$YEAR" && $Semester == "$SEMESTER" && $Prereq == "$SUBJECT_code")
        {
            $_SESSION['status'] = "Nothing To Be Upated!!";
            $_SESSION['status_code'] = "info";
            header("location: admin-subjects.php"); 
        }
        else
        {
            if($Prereq == "NONE")
            {
                $sql = "UPDATE `tblsubject` SET `subject_code`='$SubjectCode', `description`='$Description', `lec`='$Lec', `lab`='$Lab', `units`='$Units',`prerequisite`='$prereq', `semester`='$Semester', `yearlevel`='$Yearlevel',`course_id_fk`='$Courseid',`college_id_fk`='$Collegeid' WHERE id='$SubjectID'";
                
                if(mysqli_query($connection,$sql))
                {   
                    $_SESSION['status'] = "Successfully Updated!";
                    $_SESSION['status_code'] = "success";
                    header("location: admin-subjects.php");            
                }else{
                    $_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data!!";
                    $_SESSION['status_code'] = "error";
                    header("location: admin-subjects.php");
                }
            }
            else
            {
                $prereq = $getsubid;

                $sql = "UPDATE `tblsubject` SET `subject_code`='$SubjectCode', `description`='$Description', `lec`='$Lec', `lab`='$Lab', `units`='$Units', `semester`='$Semester', `yearlevel`='$Yearlevel',`course_id_fk`='$Courseid',`college_id_fk`='$Collegeid' WHERE id='$SubjectID'";
                
                foreach($prereq as $subject_id)
                {
                    $sql1 = "UPDATE tblprereq SET `subject_id`='$SubjectID' WHERE `subject_under`='$SubjectCode'";
                    mysqli_query($connection,$sql1);
                }
                if(mysqli_query($connection,$sql))
                {   
                    $_SESSION['status'] = "Successfully Updated Subject!!";
                    $_SESSION['status_code'] = "success";
                    header("location: admin-subjects.php");            
                }
                else
                {
                    $_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data or Contact the Personal incharge!!";
                    $_SESSION['status_code'] = "error";
                    header("location: admin-subjects.php");
                }  
            }
        }
    }
    // End of Edit 5th Subject 2nd sem Data //

    // Start Delete 5th Subject 1st Sem //
    if (isset($_POST['delete_5th_subject_1st']))
	{
		$id = $_POST['id'];
        $status = 0;
        $sql ="UPDATE tblsubject SET status='$status' WHERE id='$id'";
		
		if(mysqli_query($connection, $sql))
		{
			$_SESSION['status'] = "Successfully Delete!";
            $_SESSION['status_code'] = "success";
            header("location:admin-subjects.php");
		} else {
			$_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data!!";
            $_SESSION['status_code'] = "error";
            header("location:admin-subjects.php");
		}
	}
    // End Delete 5th Subject 1st Sem //

    // Start Delete 5th Subject 2nd Sem //
    if (isset($_POST['delete_5th_subject_2nd']))
	{
		$id = $_POST['id'];
        $status = 0;
        $sql ="UPDATE tblsubject SET status='$status' WHERE id='$id'";
		
		if(mysqli_query($connection, $sql))
		{
			$_SESSION['status'] = "Successfully Delete!";
            $_SESSION['status_code'] = "success";
            header("location:admin-subjects.php");
		} else {
			$_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data!!";
            $_SESSION['status_code'] = "error";
            header("location:admin-subjects.php");
		}
	}
    // End Delete 5th Subject 2nd Sem //

    // Start of Delete All 5th year Subject //
    if (isset($_POST['delete_all_5th_subject']))
	{
		$currid = $_POST['currid'];
        $courseid = $_POST['courseid'];
        $yearlevel = 1;

		$sql ="DELETE FROM tblsubject WHERE curr_id_fk='$currid' and course_id_fk='$courseid'";
        $sql1 ="DELETE FROM tblprereq WHERE curri_id_fk='$currid' and course_id_fk='$courseid'";

        $pre_id = mysqli_query($connection,"SELECT * FROM tblsprereq");
        while($ha=mysqli_fetch_array($pre_id))
        {
            $preq_id = $ha['id'];
        }

		$get_id = mysqli_query($connection,"SELECT * FROM tblsubject");

		while($sa = mysqli_fetch_array($get_id))
		{
			$curid = $sa['id'];
		}

		$c = "ALTER TABLE tblsubject AUTO_INCREMENT = $curid";
        $d = "ALTER TABLE tblprereq AUTO_INCREMENT = $curid";
		
		if(mysqli_query($connection, $sql) && mysqli_query($connection, $sql1) && mysqli_query($connection, $c) && mysqli_query($connection, $c))
		{
			$_SESSION['status'] = "Successfully Delete All Subjects!!";
            $_SESSION['status_code'] = "success";
            header("location:admin-subjects.php");
		} else {
			$_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data or or Contact the Personel incharge!!";
            $_SESSION['status_code'] = "error";
            header("location:admin-subjects.php");
		}
	}
    // End of Delete All 5th year Subject //
// all Year Subjects Prerequisite Data //
    // Add Prerequisite //
    if(isset($_POST['add_prereq_sub']))
    {
        $IDPreq = $_POST['idprereq'];
        $Preq_id = $_POST['prereqID'];

        $check_code = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$IDPreq'");
        while($i=mysqli_fetch_array($check_code))
        {
            $SubjecCode = $i['subject_code'];
            $SubCur = $i['curr_id_fk'];
            $SubCourse = $i['course_id_fk'];
            $SubPrereq = $i['prerequisite'];
        }

        $sel_code = mysqli_query($connection,"SELECT * FROM tblprereq WHERE subject_under='$IDPreq'");
        while($o=mysqli_fetch_array($sel_code))
        {
            $SubID = $o['subject_id'];
        }

            if($Preq_id == $SubID)
            {
                $_SESSION['status'] = "Prerequisite Already exist in this Subject!!";
                $_SESSION['status_code'] = "warning";
                header("location:admin-subjects.php");
            }
            else
            {
                foreach($Preq_id as $sid)
                {
                    $sql = "INSERT INTO tblprereq (subject_id,subject_under,curri_id_fk,course_id_fk) VALUES ('$sid','$IDPreq','$SubCur','$SubCourse')";
                    if(mysqli_query($connection,$sql)){}

                    if($SubPrereq == "NONE")
                    {
                        $have = "HAVE";
                        $Up_prereq = "UPDATE tblsubject SET prerequisite='$have' WHERE id='$IDPreq'";
                        if(mysqli_query($connection,$Up_prereq))
                        {
                            $_SESSION['status'] = "Successfully Added!!";
                            $_SESSION['status_code'] = "success";
                            header("location:admin-subjects.php");
                        }
                        else 
                        {
                            $_SESSION['status'] = "Unsuccessfully Added.. Please check The input Data or Contact Person incharge!!";
                            $_SESSION['status_code'] = "error";
                            header("location:admin-subjects.php");
                        }
                    }
                    else if($SubPrereq == "HAVE")
                    {
                        $have = "HAVE";
                        $Up_prereq = "UPDATE tblsubject SET prerequisite='$have' WHERE id='$IDPreq'";
                        if(mysqli_query($connection,$Up_prereq))
                        {
                            $_SESSION['status'] = "Successfully Added!!";
                            $_SESSION['status_code'] = "success";
                            header("location:admin-subjects.php");
                        }
                        else 
                        {
                            $_SESSION['status'] = "Unsuccessfully Added.. Please check The input Data or Contact Person incharge!!";
                            $_SESSION['status_code'] = "error";
                            header("location:admin-subjects.php");
                        }
                    }
                }
            }
        //foreach($sel_code as $C)
        //{
            
        //}
    }
    // Add Prerequisite //

    // Edit Prerequisite sem//
    if(isset($_POST['edit_prereq']))
    {
        $preqid = $_POST['idprereq'];
        $Preq = $_POST['prereq'];

        $select_preq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE id='$preqid'");
        while($c=mysqli_fetch_array($select_preq))
        {
            $IDPreq = $c['id'];
            $SubPrereq = $c['subject_id'];
        }

        if($Preq == "$SubPrereq")
        {
            $_SESSION['status'] = "Nothing To be Updated!!";
            $_SESSION['status_code'] = "info";
            header("location:admin-subjects.php");
        }
        else
        {
            $sql = "UPDATE tblprereq SET subject_id='$Preq' WHERE id='$preqid'";
            if(mysqli_query($connection,$sql))
            {
                $_SESSION['status'] = "Successfully Update!!";
                $_SESSION['status_code'] = "success";
                header("location:admin-subjects.php");
            } else {
                $_SESSION['status'] = "Unsuccessfully Update.. Please check The input Data!!";
                $_SESSION['status_code'] = "error";
                header("location:admin-subjects.php");
            }
        }
    }
    // Edit 5th Prerequisite sem//

    // Delete Prerequisite //
    if(isset($_POST['delete_prereq']))
    {
        $IdPrereq = $_POST['id'];
        $select_preq = "DELETE FROM tblprereq WHERE id='$IdPrereq'";
        $get_id = mysqli_query($connection,"SELECT * FROM tblprereq");
        while($sa = mysqli_fetch_array($get_id))
        {
            $curid = $sa['id'];
        }
        $c = "ALTER TABLE tblprereq AUTO_INCREMENT = 1";
        $check_preq = mysqli_query($connection,"SELECT * FROM tblprereq WHERE id='$IdPrereq'");
        while($sa=mysqli_fetch_array($check_preq))
        {
            $IPrereq = $sa['id'];
            $SubIdPreq = $sa['subject_id'];
            $SubCodePreq = $sa['subject_under'];
        }
        $get_subID = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$SubCodePreq'");
        while($l=mysqli_fetch_array($get_subID))
        {
            $IdSUB = $l['id'];
        }
        if(mysqli_query($connection,$select_preq) && mysqli_query($connection,$c)){}

        $checkprereq = "SELECT count(subject_under) FROM tblprereq WHERE subject_under='$SubCodePreq'";
        $get_check = mysqli_query($connection,$checkprereq);
        $Rows = mysqli_fetch_array($get_check);
        $SubID = $Rows[0];

        if($SubID == 1)
        {
            $have = "HAVE";
            $select_code = "UPDATE tblsubject SET prerequisite='$have' WHERE id='$IdSUB'";
            if(mysqli_query($connection,$select_code))
            {
                $_SESSION['status'] = "Successfully Delete!!";
                $_SESSION['status_code'] = "success";
                header("location:admin-subjects.php");
            } else {
                $_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data or or Contact the Personel incharge!!";
                $_SESSION['status_code'] = "error";
                header("location:admin-subjects.php");
            }
        }
        else if($SubID > 1)
        {
            $have = "HAVE";
            $select_code = "UPDATE tblsubject SET prerequisite='$have' WHERE id='$IdSUB'";
            if(mysqli_query($connection,$select_code))
            {
                $_SESSION['status'] = "Successfully Delete!!";
                $_SESSION['status_code'] = "success";
                header("location:admin-subjects.php");
            } else {
                $_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data or or Contact the Personel incharge!!";
                $_SESSION['status_code'] = "error";
                header("location:admin-subjects.php");
            }
        }
        else
        {
            $none = "NONE";
            $select_code = "UPDATE tblsubject SET prerequisite='$none' WHERE id='$IdSUB'";
            if(mysqli_query($connection,$select_code))
            {
                $_SESSION['status'] = "Successfully Delete!!";
                $_SESSION['status_code'] = "success";
                header("location:admin-subjects.php");
            } else {
                $_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data or or Contact the Personel incharge!!";
                $_SESSION['status_code'] = "error";
                header("location:admin-subjects.php");
            }
        }
    }
    // Delete Prerequisite //
// End of all Year Subjects Prerequisite Data //
// End of Curriculum Manage Data //
    function generate_password($len = 12){
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
        $password = substr( str_shuffle( $chars ), 0, $len );
        return $password;
    }
// Start of Department Manage Accounts //
    // Start of Add Adviser Colleges Account //
	if (isset($_POST['addAdviser']))
    {
        $Firstname=mysqli_real_escape_string($connection,$_POST['firstname']);
        $Lastname=mysqli_real_escape_string($connection,$_POST['lastname']);
        $Email=mysqli_real_escape_string($connection,$_POST['email']);
        $Course=mysqli_real_escape_string($connection,$_POST['course']); 
        $College=mysqli_real_escape_string($connection,$_POST['collegeid']); 
        $Usertype="Adviser"; 
        $Status = 1;
		$Password = generate_password(12);
        $encpt_password= sha1($password);

        //get collegeid
        $check_college= mysqli_query($connection , "SELECT * FROM tblcollege WHERE id='$College'");
        if(mysqli_num_rows($check_college) == 1){
            $fa_c = mysqli_fetch_array($check_college);
            $CollegeID = $fa_c['id'];
			$collegename = $fa_c['college'];
        }

        $check_course= mysqli_query($connection , "SELECT * FROM tblcourse WHERE id='$Course'");
        if(mysqli_num_rows($check_course) == 1){
            $fa_d = mysqli_fetch_array($check_course);
            $CourseID = $fa_d['id'];
			$coursename = $fa_d['course'];
        }

        //email validation
        $check_email= mysqli_query($connection,"SELECT * FROM tbluser WHERE email='$Email'");

        if(mysqli_num_rows($check_email) > 0){
			$_SESSION['status'] = "Already Existed!!";
            $_SESSION['status_code'] = "warning";
            header("location:admin-accounts.php");
        }
        else
		{
            //insert data
            $sql="INSERT INTO `tbluser`(`firstname`, `lastname`, `email`, `password`, `usertype`, `status`, `college_id_fk`,`course_id_fk`) VALUES ('$Firstname','$Lastname','$Email','$Password','$Usertype','$Status','$CollegeID','$CourseID')";

            //send credentials to email
            require_once '../../PHPMailer/PHPMailer.php';
            require_once '../../PHPMailer/SMTP.php';
            require_once '../../PHPMailer/Exception.php';
            
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
            $mail->addAddress($Email);  

            $mail->Subject = 'Online Pre-Advising';
            $mail->Body    = "<p>Greetings: <br><br> 
                College of <b>$collegename</b>. The Admin created you an Account.<br><br>
                Your Adviser Account: <br><br>Your email is <b>$Email</b><br>
                Your Password is <b>$Password</b><br>
                Your Course Assigned is <b>$coursename</b><br>
				<br><br>
                To Check, please go to <a href='wmsu-onlinepreadvising.com'><b>ONLINE PRE-ADVISING</b></a>
                <br><br><p><b>Note:</b><br>
                1. The password will be change to profile settings after loging to your account.<br>
                2. Make sure you remember your password before changing it.<br>
                3. The email cannot be change (Unique).<br>
                4. Create and Keep the records of the Credentials of accounts for future use.<br>
                5. Please use <b><font color='#4285F4'>G</font><font color='#DB4437'>o</font><font color='#F4B400'>o</font><font color='#4285F4'>g</font><font color='#0F9D58'>l</font><font color='#DB4437'>e</font></b> Chrome browser, if possible.<br>
                6. Please ignore this message if you already received this message previously.</p>";
			if($mail->send() && mysqli_query($connection,$sql))
            {
                $_SESSION['status'] = "Successfully Added!!";
				$_SESSION['status_code'] = "success";
				header("location:admin-accounts.php");
            }
            else
            {
                $_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data!!";
				$_SESSION['status_code'] = "error";
				header("location:admin-accounts.php");
            }
        }
    }
	// End of Add Adviser Colleges Account //

	// Start of Edit Adviser Colleges Account //
	if (isset($_POST['editAdviser']))
	{ 
        $adviser_id=mysqli_real_escape_string($connection,$_POST['adviserid']);
        $Firstname=mysqli_real_escape_string($connection,$_POST['firstname']);
        $Lastname=mysqli_real_escape_string($connection,$_POST['lastname']);
        $Email=mysqli_real_escape_string($connection,$_POST['email']);
		$Password=mysqli_real_escape_string($connection,$_POST['password']);
		$Contact=mysqli_real_escape_string($connection,$_POST['contact']);
        $CollegeID=mysqli_real_escape_string($connection,$_POST['collegeid']);
        $Course=mysqli_real_escape_string($connection,$_POST['course']); 

        $check_admin_account = mysqli_query($connection,"SELECT * FROM tbluser WHERE id='$adviser_id'");
		while($sa = mysqli_fetch_array($check_admin_account))
		{
			$id = $sa['id'];
			$firstname = $sa['firstname'];
			$lastname = $sa['lastname'];
			$email = $sa['email'];
			$password = $sa['password'];
			$contact = $sa['contact'];
			$college_id = $sa['college_id_fk'];
            $course_id = $sa['course_id_fk'];
		}
        //get collegeid
        $check_college= mysqli_query($connection , "SELECT * FROM tblcollege WHERE id='$CollegeID'");
        if(mysqli_num_rows($check_college) == 1){
            $fa_c = mysqli_fetch_array($check_college);
            $CollegeID = $fa_c['id'];
			$collegename = $fa_c['college'];
        }

        $check_course= mysqli_query($connection , "SELECT * FROM tblcourse WHERE course='$Course'");
        if(mysqli_num_rows($check_course) == 1){
            $fa_d = mysqli_fetch_array($check_course);
            $CourseID = $fa_d['id'];
			$coursename = $fa_d['course'];
        }

		if($Firstname == $firstname && $Lastname == $lastname && $Email == $email && $Password == $password && $Contact == $contact && $CollegeID == $college_id && $CourseID == $course_id)
		{
			$_SESSION['status'] = "Already Existed!!";
            $_SESSION['status_code'] = "warning";
            header("location:admin-accounts.php");
		}
		else
		{
			// Attempt update query execution
			$sql = "UPDATE `tbluser` SET `firstname`='$Firstname',`lastname`='$Lastname',`email`='$Email',`password`='$Password',`contact`='$Contact',`college_id_fk`='$CollegeID',`course_id_fk`='$course_id' WHERE id='$adviser_id'";
            
            if($Password != $password)
            {
                $save_pass = "UPDATE tbluser SET password='$Password' WHERE id='$adviser_id'";
                //send credentials to email
                require_once '../../PHPMailer/PHPMailer.php';
                require_once '../../PHPMailer/SMTP.php';
                require_once '../../PHPMailer/Exception.php';
                
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
                $mail->addAddress($Email);  

                $mail->Subject = 'Online Pre-Advising';
                $mail->Body    = "<p>Greetings: <br><br> 
                    College of <b>$collegename</b>. The Admin change your Password Account.<br><br>
                    Your Adviser Account: <br><br>Your email is <b>$Email</b><br>
                    Your Password now is <b>$Password</b><br>
                    Your Course Assigned is <b>$coursename</b><br>
                    <br><br>
                    To Check, please go to <a href='wmsu-onlinepreadvising.com'><b>ONLINE PRE-ADVISING</b></a>
                    <br><br><p><b>Note:</b><br>
                    1. The password will be change to profile settings after loging to your account.<br>
                    2. Make sure you remember your password before changing it.<br>
                    3. The email cannot be change (Unique).<br>
                    4. Create and Keep the records of the Credentials of accounts for future use.<br>
                    5. Please use <b><font color='#4285F4'>G</font><font color='#DB4437'>o</font><font color='#F4B400'>o</font><font color='#4285F4'>g</font><font color='#0F9D58'>l</font><font color='#DB4437'>e</font></b> Chrome browser, if possible.<br>
                    6. Please ignore this message if you already received this message previously.</p>";
                if($mail->send() && mysqli_query($connection,$save_pass))
                {
                    $_SESSION['status'] = "Successfully Updated!!";
                    $_SESSION['status_code'] = "success";
                    header("location:admin-accounts.php");
                }
                else
                {
                    $_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data!!";
                    $_SESSION['status_code'] = "error";
                    header("location:admin-accounts.php");
                }
            }
			if(mysqli_query($connection, $sql))
			{
				$_SESSION['status'] = "Successfully Update!!";
				$_SESSION['status_code'] = "success";
                header("location:admin-accounts.php");
			} else {
				$_SESSION['status'] = "Unsuccessfully Update.. Please check The input Data!!";
				$_SESSION['status_code'] = "error";
                header("location:admin-accounts.php");
			}
		}      
    }
	// End of Edit Adviser Colleges Account //

    // Start of Adviser Update college Account //
    if(isset($_POST['editAdviserDeactivated']))
    {
        $adviser_id=mysqli_real_escape_string($connection,$_POST['adviserid']);
        $Firstname=mysqli_real_escape_string($connection,$_POST['firstname']);
        $Lastname=mysqli_real_escape_string($connection,$_POST['lastname']);
        $Email=mysqli_real_escape_string($connection,$_POST['email']);
		$Password=mysqli_real_escape_string($connection,$_POST['password']);
		$Contact=mysqli_real_escape_string($connection,$_POST['contact']);
        $CollegeID=mysqli_real_escape_string($connection,$_POST['collegeid']);
        $Course=mysqli_real_escape_string($connection,$_POST['course']); 
        $Status=mysqli_real_escape_string($connection,$_POST['status']); 

        $check_admin_account = mysqli_query($connection,"SELECT * FROM tbluser WHERE id='$adviser_id'");
		while($sa = mysqli_fetch_array($check_admin_account))
		{
			$id = $sa['id'];
			$firstname = $sa['firstname'];
			$lastname = $sa['lastname'];
			$email = $sa['email'];
			$password = $sa['password'];
			$contact = $sa['contact'];
			$college_id = $sa['college_id_fk'];
            $course_id = $sa['course_id_fk'];
		}
        //get collegeid
        $check_college= mysqli_query($connection , "SELECT * FROM tblcollege WHERE id='$CollegeID'");
        if(mysqli_num_rows($check_college) == 1){
            $fa_c = mysqli_fetch_array($check_college);
            $CollegeID = $fa_c['id'];
			$collegename = $fa_c['college'];
        }

        $check_course= mysqli_query($connection , "SELECT * FROM tblcourse WHERE course='$Course'");
        if(mysqli_num_rows($check_course) == 1){
            $fa_d = mysqli_fetch_array($check_course);
            $CourseID = $fa_d['id'];
			$coursename = $fa_d['course'];
        }
        // Attempt update query execution
			$sql = "UPDATE `tbluser` SET `firstname`='$Firstname',`lastname`='$Lastname',`email`='$Email',`password`='$Password',`status`='$Status',`contact`='$Contact',`college_id_fk`='$CollegeID',`course_id_fk`='$course_id' WHERE id='$adviser_id'";
            
			if(mysqli_query($connection, $sql))
			{
				$_SESSION['status'] = "Successfully Update!!";
				$_SESSION['status_code'] = "success";
                header("location:admin-accounts-deactivated.php");
			} else {
				$_SESSION['status'] = "Unsuccessfully Update.. Please check The input Data!!";
				$_SESSION['status_code'] = "error";
                header("location:admin-accounts-deactivated.php");
			}
    }
    // End of Adviser Update college Account //

	// Start of Delete Single Adviser Colleges Account //
	if (isset($_POST['delete_adviser']))
	{
		$id = $_POST['adviserid'];
        $status = 0;
		$sql ="UPDATE tbluser SET status='$status' WHERE id='$id'";
		$get_id = mysqli_query($connection,"SELECT * FROM tbluser");
		while($sa = mysqli_fetch_array($get_id))
		{
			$adviserid = $sa['id'];
		}
		if(mysqli_query($connection, $sql))
		{
			$_SESSION['status'] = "Successfully Delete!";
            $_SESSION['status_code'] = "success";
            header("location:admin-accounts.php");
		} else {
			$_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data!!";
            $_SESSION['status_code'] = "error";
            header("location:admin-accounts.php");
		}
	}
	// End of Delete Single Adviser Colleges Account //
	
	// Start of Delete All Adviser Colleges Account //
	if (isset($_POST['delete_all_adviser']))
    {
        $collegeid = $_POST['collegeid'];
        $status = 0;
        $sql="UPDATE tbluser SET status='$status' WHERE usertype='Adviser' and college_id_fk='$collegeid'";
        $getadviser = mysqli_query($connection,"SELECT * FROM tbluser");
        if(mysqli_num_rows($getadviser) == 0)
        {
            $_SESSION['status'] = "Nothing To Be Deleted!!";
            $_SESSION['status_code'] = "warning";
            header("location:admin-accounts.php");
        }
        else
        {
            if(mysqli_query($connection, $sql))
            {
                $_SESSION['status'] = "Successfully Delete!";
                $_SESSION['status_code'] = "success";
                header("location:admin-accounts.php");
            } else {
                $_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data!!";
                $_SESSION['status_code'] = "error";
                header("location:admin-accounts.php");
            }
        }
    }
	// End of Delete All Adviser Colleges Account //

	// Start of Add Students Accounts //
	if (isset($_POST['addStudent']))
    {
        $Firstname=mysqli_real_escape_string($connection,$_POST['firstname']);
        $Lastname=mysqli_real_escape_string($connection,$_POST['lastname']);
        $Email=mysqli_real_escape_string($connection,$_POST['email']);
        $Course=mysqli_real_escape_string($connection,$_POST['course']); 
        $College=mysqli_real_escape_string($connection,$_POST['collegeid']); 
        $Year=mysqli_real_escape_string($connection,$_POST['year']); 
        $extension = "@wmsu.edu.ph";
        $Usertype="Student"; 

        $Emails = $Email.$extension;
		$Password = generate_password(8);
        $encpt_password= sha1($password);

        //get collegeid
        $check_college= mysqli_query($connection , "SELECT * FROM tblcollege WHERE id='$College'");
        if(mysqli_num_rows($check_college) == 1){
            $fa_c = mysqli_fetch_array($check_college);
            $CollegeID = $fa_c['id'];
			$collegename = $fa_c['college'];
        }

        $check_course= mysqli_query($connection , "SELECT * FROM tblcourse WHERE id='$Course'");
        if(mysqli_num_rows($check_course) == 1){
            $fa_d = mysqli_fetch_array($check_course);
            $CourseID = $fa_d['id'];
			$coursename = $fa_d['course'];
        }

        //email validation
        $check_email= mysqli_query($connection,"SELECT * FROM tbluser WHERE email='$Emails'");

        if(mysqli_num_rows($check_email) > 0){
			$_SESSION['status'] = "Already Existed!!";
            $_SESSION['status_code'] = "info";
            header("location:admin-accounts.php");
        }
        else
		{
            //insert data
            $sql="INSERT INTO `tbluser`(`firstname`, `lastname`, `email`, `password`, `usertype`, `college_id_fk`,`course_id_fk`,`yearlevel`) VALUES ('$Firstname','$Lastname','$Emails','$Password','$Usertype','$CollegeID','$CourseID','$Year')";

			if(mysqli_query($connection,$sql))
            {
                $_SESSION['status'] = "Successfully Added!!";
				$_SESSION['status_code'] = "success";
				header("location:admin-accounts.php");
            }
            else
            {
                $_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data!!";
				$_SESSION['status_code'] = "error";
				header("location:admin-accounts.php");
            }
        }
    }
	// End of Add Students Accounts //

	// Start of Edit Students Accounts //
	if (isset($_POST['editStudent']))
	{ 
        $student_id=mysqli_real_escape_string($connection,$_POST['studentid']);
        $Firstname=mysqli_real_escape_string($connection,$_POST['firstname']);
        $Lastname=mysqli_real_escape_string($connection,$_POST['lastname']);
        $Email=mysqli_real_escape_string($connection,$_POST['email']);
		$Password=mysqli_real_escape_string($connection,$_POST['password']);
		$Contact=mysqli_real_escape_string($connection,$_POST['contact']);
        $CollegeID=mysqli_real_escape_string($connection,$_POST['collegeid']);
        $Course=mysqli_real_escape_string($connection,$_POST['course']); 
        $Year=mysqli_real_escape_string($connection,$_POST['year']); 

        //get Course ID
        $check_course= "SELECT * FROM tblcourse WHERE course='$Course'";
		$check_cour = mysqli_query($connection,$check_course);
        if(mysqli_num_rows($check_cour) > 0){
            $fa_c = mysqli_fetch_array($check_cour);
            echo $CourseID = $fa_c['id'];
			echo $course = $fa_c['course'];
        }

		$check_admin_account = mysqli_query($connection,"SELECT * FROM tbluser WHERE id='$student_id'");
		while($sa = mysqli_fetch_array($check_admin_account))
		{
			$id = $sa['id'];
			$firstname = $sa['firstname'];
			$lastname = $sa['lastname'];
			$email = $sa['email'];
			$password = $sa['password'];
			$contact = $sa['contact'];
			$college_id = $sa['college_id_fk'];
            $course_id = $sa['course_id_fk'];
            $year = $sa['yearlevel'];
		}

		if($Firstname == "$firstname" && $Lastname == "$lastname" && $Email == "$email" && $Password == "$password" && $Contact == "$contact" && $CollegeID == "$college_id" && $CourseID == "$course_id" && $Year == "$year")
		{
			$_SESSION['status'] = "Nothing To Be Updated!!";
            $_SESSION['status_code'] = "info";
            header("location:admin-accounts.php");
		}
		else
		{
			// Attempt update query execution
			$sql = "UPDATE `tbluser` SET `firstname`='$Firstname',`lastname`='$Lastname',`email`='$Email',`password`='$Password',`contact`='$Contact',`college_id_fk`='$CollegeID',`course_id_fk`='$CourseID',`yearlevel`='$Year' WHERE id='$student_id'";
            
			if(mysqli_query($connection, $sql))
			{
				$_SESSION['status'] = "Successfully Added!!";
				$_SESSION['status_code'] = "success";
				header("location:admin-accounts.php");
			} else {
				$_SESSION['status'] = "Unsuccessfully Update.. Please check The input Data!!";
				$_SESSION['status_code'] = "error";
				header("location:admin-accounts.php");
			}
		}      
    }
	// End of Edit Students Accounts //

	// Start of Delete Single Students Accounts //
	if (isset($_POST['delete_student']))
	{
		$id = $_POST['studentid'];

		$sql ="DELETE FROM tbluser WHERE id='$id'";

		$get_id = mysqli_query($connection,"SELECT * FROM tbluser");

		while($sa = mysqli_fetch_array($get_id))
		{
			$studentid = $sa['id'];
		}

		$c = "ALTER TABLE tbluser AUTO_INCREMENT = $studentid";
		
		if(mysqli_query($connection, $sql) && mysqli_query($connection, $c))
		{
			$_SESSION['status'] = "Successfully Delete!";
            $_SESSION['status_code'] = "success";
            header("location:admin-accounts.php");
		} else {
			$_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data!!";
            $_SESSION['status_code'] = "error";
            header("location:admin-accounts.php");
		}
	}
	// End of Delete Single Students Accounts //

	// Start of Delete All Students Accounts //
	if (isset($_POST['delete_all_student']))
    {
        $collegeid = $_POST['collegeid'];

        $sql="DELETE FROM tbluser WHERE usertype='Student' and college_id_fk='$collegeid'";
        $getstudent = mysqli_query($connection,"SELECT * FROM tbluser");
    
        $c = "ALTER TABLE tbluser AUTO_INCREMENT = 1";

        if(mysqli_num_rows($getstudent) == 0)
        {
            $_SESSION['status'] = "Nothing To Be Deleted!!";
            $_SESSION['status_code'] = "info";
            header("location:admin-accounts.php");
        }
        else
        {
            if(mysqli_query($connection, $sql) && mysqli_query($connection, $c))
            {
                $_SESSION['status'] = "Successfully Delete!";
                $_SESSION['status_code'] = "success";
                header("location:admin-accounts.php");
            } else {
                $_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data!!";
                $_SESSION['status_code'] = "error";
                header("location:admin-accounts.php");
            }
        }
    }
	// End of Delete All Students Accounts //
// End of Department Manage Accounts //
?>