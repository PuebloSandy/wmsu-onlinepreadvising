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
		header("location:superadmin-profile.php"); 
	}
	else
	{
		if($Email == $email && $Firstname == $firstname && $Lastname == $lastname && $Contact == $contact)
		{
			$_SESSION['status'] = "Email Already Exist!!";
			$_SESSION['status_code'] = "info";
			header("location:superadmin-profile.php"); 
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
				header("location:superadmin-profile.php");
			}
		}
		else
		{
			$sql2 = "UPDATE tbluser SET firstname='$Firstname',lastname='$Lastname',contact='$Contact' WHERE id='$Adminid'";
			if(mysqli_query($connection,$sql2))
			{
				$_SESSION['status'] = "Successfully Updated!!";
				$_SESSION['status_code'] = "success";
				header("location:superadmin-profile.php");                  
			}
			else
			{
				$_SESSION['status'] = "Unsuccessfully Updated.. Please check The input Data!!";
				$_SESSION['status_code'] = "error";
				header("location:superadmin-profile.php");
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
		header("location:superadmin-profile.php"); 
	}
	else
	{
		$sql = "UPDATE tbluser SET password='$Password' WHERE id='$Adminid'";
		if(mysqli_query($connection,$sql))
		{
			$_SESSION['status'] = "Successfully Updated!!";
			$_SESSION['status_code'] = "success";
			header("location:superadmin-profile.php");                  
		}
		else
		{
			$_SESSION['status'] = "Unsuccessfully Updated.. Please check The input Data!!";
			$_SESSION['status_code'] = "error";
			header("location:superadmin-profile.php");
		}
	}
}
//Profile//

//start of School Year Manage Data//
	//Add School Year//
	if(isset($_POST['add_schoolYear']))
	{
		$SYFrom = $_POST['SYfrom'];
		$SYTo = $_POST['SYto'];
		$SYjoin = $SYFrom.'-'.$SYTo;
		$Status = "Deactivated";

		$check_school = mysqli_query($connection,"SELECT * FROM tblschool_year WHERE school_year='$SYjoin'");
		while($c=mysqli_fetch_array($check_school))
		{
			$SYcheck = $c['school_year'];
		}

		if($SYjoin == $SYcheck)
		{
			$_SESSION['status'] = "Already Existed";
            $_SESSION['status_code'] = "info"; 
			header("location: superadmin-school-year.php");
		}
		else
		{
			$sql = "INSERT INTO tblschool_year (school_year,status) VALUES ('$SYjoin','$Status')";

			if(mysqli_query($connection,$sql))
			{
				$_SESSION['status'] = "Successfully Added";
                $_SESSION['status_code'] = "success"; 
				header("location: superadmin-school-year.php");
	
			}
			else
			{
				$_SESSION['status'] = "Something went wrong. Please check service provider!!";
                $_SESSION['status_code'] = "error"; 
				header("location: superadmin-school-year.php");
			}
		}
	}
	//End of School Year//

	//Start Update School Year//
	if(isset($_POST['update_single_school_year']))
	{
		$schoolID = $_POST['schoolid'];
		$SYFrom = $_POST['SYFROM'];
		$SYTo = $_POST['SYTO'];
		$SYJoin = $SYFrom.'-'.$SYTo;
		$check_sy = mysqli_query($connection,"SELECT * FROM tblschool_year WHERE id='$schoolID'");
		while($sa=mysqli_fetch_array($check_sy))
		{
			$SY = $sa['school_year'];
		}
		if($SYJoin == $SY){
			$_SESSION['status'] = "Nothing To be Updated!!";
            $_SESSION['status_code'] = "warning";
            header("location: superadmin-school-year.php");
        }
        else
		{
			$update_sy = "UPDATE tblschool_year SET school_year='$SYJoin' WHERE id='$schoolID'";
			if(mysqli_query($connection,$update_sy))
			{
				$_SESSION['status'] = "Successfully Updated!!";
				$_SESSION['status_code'] = "success";
				header("location: superadmin-school-year.php");
			}
			else
			{
				$_SESSION['status'] = "Something went wrong. Please check service provider!!";
				$_SESSION['status_code'] = "error"; 
				header("location: superadmin-school-year.php");
			}
		}
	}
	//End Update School Year//

	//Start Delete Single School Year//
	if(isset($_POST['delete_single_school_year']))
	{
		$SchoolID = $_POST['schoolID'];
		$del_school="DELETE FROM tblschool_year WHERE id='$SchoolID'";
		$get_id = mysqli_query($connection,"SELECT * FROM tblschool_year");
		while($sa=mysqli_fetch_array($get_id))
		{
			$id = $sa['id'];
		}
		$c = "ALTER TABLE tblschool_year AUTO_INCREMENT = 1";
		if(mysqli_query($connection,$del_school) && mysqli_query($connection,$c))
		{
			$_SESSION['status'] = "Successfully Delete School Year!!";
			$_SESSION['status_code'] = "success"; 
			header("location: superadmin-school-year.php");
		}
		else
		{
			$_SESSION['status'] = "Something went wrong. Please check service provider!!";
			$_SESSION['status_code'] = "error"; 
			header("location: superadmin-school-year.php");
		}

	}
	//End Delete Single School Year//

	//Start Delete All School Year//
	if(isset($_POST['delete_all_school_year']))
	{
		$del_school="DELETE FROM tblschool_year";
		$get_id = mysqli_query($connection,"SELECT * FROM tblschool_year");
		while($sa=mysqli_fetch_array($get_id))
		{
			$id = $sa['id'];
		}
		$c = "ALTER TABLE tblschool_year AUTO_INCREMENT = 1";
		if(mysqli_query($connection,$del_school) && mysqli_query($connection,$c))
		{
			$_SESSION['status'] = "Successfully Delete All School Year!!";
			$_SESSION['status_code'] = "success"; 
			header("location: superadmin-school-year.php");
		}
		else
		{
			$_SESSION['status'] = "Something went wrong. Please check service provider!!";
			$_SESSION['status_code'] = "error"; 
			header("location: superadmin-school-year.php");
		}
	}
	//End Delete All School Year//

	//Start Update School Year Status//
	if(isset($_POST['activated']))
	{	
		$schoolID = $_POST['schoolid'];
		$check_act = mysqli_query($connection,"SELECT * FROM tblschool_year WHERE id='$schoolID'");
		while($sa=mysqli_fetch_array($check_act))
		{
			$activated = $sa['status'];
		}
		
		if($activated == "Deactivated")
		{
			$check_act_session = mysqli_query($connection,"SELECT * FROM tblschool_year WHERE status='Activated'");
			if(mysqli_num_rows($check_act_session) > 0)
			{
				$_SESSION['status'] = "Please Check Status...There is still the Activated School Year set it to Deactivated First!!";
				$_SESSION['status_code'] = "warning"; 
				header("location: superadmin-school-year.php");
			}
			else
			{
				$Activated = "Activated";
				$update1 = "UPDATE tblschool_year SET status='$Activated' WHERE id='$schoolID'";
				if(mysqli_query($connection,$update1))
				{
					header("location: superadmin-school-year.php");
				}
				else
				{
					$_SESSION['status'] = "Something went wrong. Please check service provider!!";
					$_SESSION['status_code'] = "error"; 
					header("location: superadmin-school-year.php");
				}
			}
		}
		else
		{
			$_SESSION['status'] = "Something went wrong. Please check service provider!!";
            $_SESSION['status_code'] = "error"; 
			header("location: superadmin-school-year.php");
		}
	}

	if(isset($_POST['deactivated']))
	{	
		$schoolID = $_POST['schoolid'];
		$check_act = mysqli_query($connection,"SELECT * FROM tblschool_year WHERE id='$schoolID'");
		while($sa=mysqli_fetch_array($check_act))
		{
			$deactivated = $sa['status'];
		}
		
		if($deactivated == "Activated")
		{
			$Deactivated = "Deactivated";
			$update1 = "UPDATE tblschool_year SET status='$Deactivated' WHERE id='$schoolID'";

			if(mysqli_query($connection,$update1))
			{
				header("location: superadmin-school-year.php");
			}
			else
			{
				$_SESSION['status'] = "Something went wrong. Please check service provider!!";
                $_SESSION['status_code'] = "error"; 
				header("location: superadmin-school-year.php");
			}
		}
		else
		{
			$_SESSION['status'] = "Something went wrong. Please check service provider!!";
            $_SESSION['status_code'] = "error"; 
			header("location: superadmin-school-year.php");
		}
	}
	//End Update School Year Status//
//End of School Year Manage Data//

// Start of College Manage Data//
    // Add College //
    if(isset($_POST['add_college']))
    {
        $CollegeCode=mysqli_real_escape_string($connection,$_POST['collegecode']);
		$CollegeName=mysqli_real_escape_string($connection,$_POST['collegename']);
		$target = "../../source/upload/college_seal/".basename($_FILES['image']['name']);

        /*college-table*/
		$image=$_FILES['image']['name'];

		$check_collegename="SELECT * FROM tblcollege WHERE college='$CollegeName'";
		$check_collegecode="SELECT * FROM tblcollege WHERE collegecode='$CollegeCode'";

		$check_collegename_run = mysqli_query($connection,$check_collegename);
		$check_collegecode_run = mysqli_query($connection,$check_collegecode);

		if(mysqli_num_rows($check_collegename_run) > 0)
		{
			$_SESSION['status'] = "Already Existed";
            $_SESSION['status_code'] = "warning"; 
			header("location: superadmin-departments.php");
		}
		else if(mysqli_num_rows($check_collegecode_run) > 0)
		{
			$_SESSION['status'] = "Already Existed";
            $_SESSION['status_code'] = "info"; 
			header("location:superadmin-departments.php");
		}
		else if(file_exists("../../source/upload/college_seal/" .$_FILES["image"]["name"]))
		{
		    $_SESSION['status'] = "Already Existed";
            $_SESSION['status_code'] = "warning"; 
			header("location:superadmin-departments.php");
		}
		else
		{
			$query="INSERT INTO tblcollege (collegecode,college,seal)
			VALUES('$CollegeCode','$CollegeName','$image')";
			$query_run = mysqli_query($connection,$query);
			

			if($query_run)
			{
				move_uploaded_file($_FILES['image']['tmp_name'], $target);
				$_SESSION['status'] = "Successfully Added";
                $_SESSION['status_code'] = "success"; 
				header("location:superadmin-departments.php"); 
	
			}
			else
			{
				$_SESSION['status'] = "Something went wrong. Please check service provider!!";
                $_SESSION['status_code'] = "error"; 
				header("location:superadmin-departments.php");
			}
		
		}
    }
    // End of Add College //

	// start of Edit College //
	if (isset($_POST['update']))
	{
		$CollegeID=mysqli_real_escape_string($connection,$_POST['col_id']);
		$CollegeCode=mysqli_real_escape_string($connection,$_POST['college_code']);
		$CollegeName=mysqli_real_escape_string($connection,$_POST['collge_name']);
		$pic = "../../source/upload/college_seal/".basename($_FILES['image']['name']);

		/*college-table*/
		$image=$_FILES['image']['name'];

		$selectdata = "SELECT * FROM tblcollege WHERE id=$CollegeID";
		$selectdata_run = mysqli_query($connection,$selectdata);

		foreach($selectdata_run as $fa_row)
		{
			if($image == NULL || file_exists("../../source/upload/college_seal/" .$_FILES["image"]["name"])){
				//message user that seal image is already existed
				$image_data = $fa_row['seal'];
			}
			else{
				//update new seal and delete old seal
				unlink("../../source/upload/college_seal/" .$fa_row['seal']);
				$image_data = $image;
			}
		}
		
		// Attempt update query execution
		$query = "UPDATE `tblcollege` SET `collegecode`= '$CollegeCode',`college`='$CollegeName',`seal`='$image_data' WHERE `id`=$CollegeID";
		$que_run = mysqli_query($connection,$query);

		if($que_run)
		{
			if(file_exists("../../source/upload/college_seal/" .$_FILES["image"]["name"])){
				$_SESSION['status'] = "Already Existed";
            	$_SESSION['status_code'] = "warning"; 
				header("location:superadmin-departments.php");
			}
			else{
				//update new seal and delete old seal
				move_uploaded_file($_FILES['image']['tmp_name'], $pic);

				unlink("../../source/upload/college_seal/" .$que_run['seal']);
				$_SESSION['status'] = "Successfully Updated";
            	$_SESSION['status_code'] = "success"; 
				header("location:superadmin-departments.php");
			} 
		}
		else
		{
			$_SESSION['status'] = "Something went wrong. Please check service provider!!";
            $_SESSION['status_code'] = "error"; 
			header("location:superadmin-departments.php");
		}
	}
	// End of Edit College //

	// Start Delete Single College //
	if (isset($_POST['delete_col']))
	{
		$id=$_POST['col_id'];

		echo $id;
		$selectdata = "SELECT * FROM tblcollege WHERE id='$id'";
		$selectdata_run = mysqli_query($connection,$selectdata);

		foreach($selectdata_run as $fa_row)
		{
			unlink("../../source/upload/college_seal/" .$fa_row['seal']);
			$image_data = $image;
		}
		
		$query="DELETE FROM tblcollege WHERE id='$id'";

		$get_id = mysqli_query($connection,"SELECT * FROM tblcollege");

		while($sa = mysqli_fetch_array($get_id))
		{
			$colid = $sa['id'];
		}

		$c = "ALTER TABLE tblcollege AUTO_INCREMENT = $colid";
		$d = mysqli_query($connection, $c);
		$del = mysqli_query($connection, $query);

		if($del){
			unlink("../../source/upload/college_seal/" .$del['seal']);
			$_SESSION['status'] = "Successfully Deleted";
            $_SESSION['status_code'] = "success"; 
			header("location:superadmin-departments.php"); 
		} else {
			$_SESSION['status'] = "Something went wrong. Please check service provider!!";
            $_SESSION['status_code'] = "error"; 
			header("location:superadmin-departments.php");
		}
	}
	// End of Delete Single College //

	// Start Delete All College //
	if (isset($_POST['delete_all']))
	{
		$files = glob('../../source/upload/college_seal/*'); // get all file names
		foreach($files as $file){ // iterate files
			if(is_file($file)) {
				unlink($file); // delete file
			}
		}
		
		$query="DELETE FROM tblcollege";

		$get_id = mysqli_query($connection,"SELECT * FROM tblcollege");

		$c = "ALTER TABLE tblcollege AUTO_INCREMENT = 1";
		$d = mysqli_query($connection, $c);

		if(mysqli_num_rows($get_id) == 0)
        {
            $_SESSION['status'] = "Nothing To Be Deleted!!";
            $_SESSION['status_code'] = "info";
            header("location:superadmin-departments.php");
        }
        else
        {
            if(mysqli_query($connection, $query) && mysqli_query($connection, $c))
            {
                $_SESSION['status'] = "Successfully Delete!";
                $_SESSION['status_code'] = "success";
                header("location:superadmin-departments.php");
            } else {
                $_SESSION['status'] = "Unsuccessfully Delete!";
                $_SESSION['status_code'] = "error";
                header("location:superadmin-departments.php");
            }
        }
	}
	// End Delete All College //
	// End of College Manage Data//

	// Start of Course Manage Data //
	// Start of Add Course //
	if (isset($_POST['addCourse']))
	{
		$CourseCode=mysqli_real_escape_string($connection,$_POST['coursecode']);
		$CourseName=mysqli_real_escape_string($connection,$_POST['coursename']);
		$CollegeID=mysqli_real_escape_string($connection,$_POST['collegeid']);

		$check_coursename="SELECT * FROM tblcourse WHERE course='$CourseName'";
		$check_coursecode="SELECT * FROM tblcourse WHERE coursecode='$CourseCode'";

		$check_coursename_run = mysqli_query($connection,$check_coursename);
		$check_coursecode_run = mysqli_query($connection,$check_coursecode);

		if(mysqli_num_rows($check_coursename_run) > 0)
		{
			$_SESSION['status'] = "Already Existed!!";
            $_SESSION['status_code'] = "info";
			header("location:superadmin-courses.php");
		}
		else if(mysqli_num_rows($check_coursecode_run) > 0)
		{
			$_SESSION['status'] = "Already Existed!!";
            $_SESSION['status_code'] = "info";
			header("location:superadmin-courses.php");
		}
		else
		{
			$sql="INSERT INTO `tblcourse`(`coursecode`,`course`,`college_id_fk`) VALUES ('$CourseCode','$CourseName','$CollegeID')";

			if(mysqli_query($connection,$sql))
			{
				$_SESSION['status'] = "Successfully Added";
            	$_SESSION['status_code'] = "success";
				header("location:superadmin-courses.php");
			}
			else
			{
				$_SESSION['status'] = "Something went wrong. Please check service provider!!";
				$_SESSION['status_code'] = "error"; 
				header("location:superadmin-courses.php");
			}
		}
	}
	// End of Add Course //

	// Start of Edit Course //
	if (isset($_POST['editCourse'])){
		
		$CourseID=mysqli_real_escape_string($connection,$_POST['courseid']);
		$CourseCode=mysqli_real_escape_string($connection,$_POST['coursecode']);
		$CourseName=mysqli_real_escape_string($connection,$_POST['coursename']);
		$College=mysqli_real_escape_string($connection,$_POST['college']);
		
		
 		$get_collegeid="SELECT * FROM tblcollege WHERE id='$College'";
 		$get_collegeid_run= mysqli_query($connection,$get_collegeid);

 		if(mysqli_num_rows($get_collegeid_run) > 0)
 		{
 			$fa_c = mysqli_fetch_array($get_collegeid_run);
 			$CollegeID = $fa_c['id'];
			$collegename = $fa_c['college'];
 		}

		$check_course = mysqli_query($connection,"SELECT * FROM tblcourse WHERE id='$Courseid'");
		while($ca = mysqli_fetch_array($check_course))
		{
			$courseid = $ca['id'];
			$coursecode = $ca['coursecode'];
			$cousename = $ca['course'];
		}

			// Attempt update query execution
			$sql = "UPDATE `tblcourse` SET `coursecode`='$CourseCode',`course`='$CourseName',`college_id_fk`= $CollegeID WHERE id='$CourseID'";
		
			if(mysqli_query($connection, $sql)){
			   $_SESSION['status'] = "Successfully Updated!!";
			   $_SESSION['status_code'] = "success";
				header("location:superadmin-courses.php");
			} else {
			   $_SESSION['status'] = "Unsuccessfully Updated.. Please check The input Data!!";
			   $_SESSION['status_code'] = "error";
			   header("location:superadmin-courses.php");
			}	
	}
	// End of Edit Course //

	// Start of Delete Single Course //
	if (isset($_POST['delete_course']))
	{
		$id=$_POST['id'];

		$sql ="DELETE FROM tblcourse WHERE id='$id'";

		$get_id = mysqli_query($connection,"SELECT * FROM tblcourse");

		while($sa = mysqli_fetch_array($get_id))
		{
			$courid = $sa['id'];
		}

		$c = "ALTER TABLE tblcourse AUTO_INCREMENT = 1";
		
		if(mysqli_query($connection, $sql) && mysqli_query($connection, $c))
		{
			$_SESSION['status'] = "Successfully Delete!";
            $_SESSION['status_code'] = "success";
            header("location:superadmin-courses.php");
		} else {
			$_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data!!";
            $_SESSION['status_code'] = "error";
            header("location:superadmin-courses.php");
		}
	}
	// End of Delete Single Course //

	// Start of Delete All Courses //
	if (isset($_POST['delete_all_courses']))
    {
        $sql="DELETE FROM tblcourse";
        $getcourse = mysqli_query($connection,"SELECT * FROM tblcourse");
    
        $c = "ALTER TABLE tblcourse AUTO_INCREMENT = 1";

        if(mysqli_num_rows($getcourse) == 0)
        {
            $_SESSION['status'] = "Nothing To Be Deleted!!";
            $_SESSION['status_code'] = "info";
            header("location:superadmin-courses.php");
        }
        else
        {
            if(mysqli_query($connection, $sql) && mysqli_query($connection, $c))
            {
                $_SESSION['status'] = "Successfully Delete!";
                $_SESSION['status_code'] = "success";
                header("location:superadmin-courses.php");
            } else {
                $_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data!!";
                $_SESSION['status_code'] = "error";
                header("location:superadmin-courses.php");
            }
        }
    }
	//End of Delete All Courses //
// End of Course Manage Data //

// Start of Colleges Accounts Manage Data //
	// Start of Add Admin Colleges Account //
	if (isset($_POST['addAdmin']))
    {
        $Firstname=mysqli_real_escape_string($connection,$_POST['firstname']);
        $Lastname=mysqli_real_escape_string($connection,$_POST['lastname']);
        $Email=mysqli_real_escape_string($connection,$_POST['email']);
        $College=mysqli_real_escape_string($connection,$_POST['college']); 
        $Usertype="Admin"; 
		$Status = 1;

		$Password = generate_password(12);
        $encpt_password= sha1($Password);

        //get collegeid
        $check_college= mysqli_query($connection,"SELECT * FROM tblcollege WHERE id='$College'");
        if(mysqli_num_rows($check_college) == 1){
            $fa_c = mysqli_fetch_array($check_college);
            $CollegeID = $fa_c['id'];
			$collegeName = $fa_c['college'];
        }

        //email validation
        $check_email= mysqli_query($connection,"SELECT * FROM tbluser WHERE email='$Email'");

        if(mysqli_num_rows($check_email) > 0){
			$_SESSION['status'] = "Already Existed!!";
            $_SESSION['status_code'] = "warning";
            header("location:superadmin-admin-accounts.php");
        }
        else
		{
            //insert data
            $sql="INSERT INTO `tbluser`(`firstname`, `lastname`, `email`, `password`, `usertype`,`status`, `college_id_fk`) VALUES ('$Firstname','$Lastname','$Email','$Password','$Usertype','$Status',$CollegeID)";

            //update college as already assigned to an admin
            $updatecollege = mysqli_query($connection,"UPDATE tblcollege SET admin_exist = 1 WHERE id=$CollegeID");

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
                Your Admin Account: <br><br>Your email is <b>$Email</b><br>
                Your Password is <b>$Password</b><br>
                Your College is <b>$collegeName</b><br>
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
				header("location:superadmin-admin-accounts.php");
            }
            else
            {
                $_SESSION['status'] = "Unsuccessfully Added.. Please check The input Data!!";
				$_SESSION['status_code'] = "error";
				header("location:superadmin-admin-accounts.php");
            }
        }
    }
	// End of Add Admin Colleges Account //

	// Start of Edit Admin Colleges Account //
	if (isset($_POST['editAdmins']))
	{             
        $admin_id=mysqli_real_escape_string($connection,$_POST['adminids']);
        $Firstname=mysqli_real_escape_string($connection,$_POST['firstname']);
        $Lastname=mysqli_real_escape_string($connection,$_POST['lastname']);
        $Email=mysqli_real_escape_string($connection,$_POST['email']);
		$Password=mysqli_real_escape_string($connection,$_POST['password']);
		$Contact=mysqli_real_escape_string($connection,$_POST['contact']);
        $College=mysqli_real_escape_string($connection,$_POST['college']);

        //get College ID
        $check_college= "SELECT * FROM tblcollege WHERE college='$College'";
		$check_cols = mysqli_query($connection,$check_college);
        if(mysqli_num_rows($check_cols) > 0){
            $fa_c = mysqli_fetch_array($check_cols);
            $CollegeID = $fa_c['id'];
			$collegename = $fa['college'];
        }

		$check_admin_account = mysqli_query($connection,"SELECT * FROM tbluser WHERE id='$admin_id'");
		while($sa = mysqli_fetch_array($check_admin_account))
		{
			$id = $sa['id'];
			$firstname = $sa['firstname'];
			$lastname = $sa['lastname'];
			$email = $sa['email'];
			$password = $sa['password'];
			$contact = $sa['contact'];
			$college_id = $sa['college_id_fk'];
		}

		if($Firstname == $firstname && $Lastname == $lastname && $Email == $email && $Password == $password && $Contact == $contact)
		{
			$_SESSION['status'] = "Nothing to be updated!!";
            $_SESSION['status_code'] = "warning";
            header("location:superadmin-admin-accounts.php");
		}
		else
		{
			// Attempt update query execution
			$sql = "UPDATE `tbluser` SET `firstname`='$Firstname',`lastname`='$Lastname',`email`='$Email',`password`='$Password',`contact`='$Contact',`college_id_fk`= $CollegeID WHERE id='$admin_id'";
            
			if($Password != $password)
            {
                $save_pass = "UPDATE tbluser SET password='$Password' WHERE id='$admin_id'";

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
                    Your Account Change a Password By Superadmin: <br><br>
                    Your Password is <b>$Password</b><br>
                    To Check, please go to <a href='wmsu-onlinepreadvising.com'><b>ONLINE PRE-ADVISING</b></a>
                    <br><br><p><b>Note:</b><br>
                    1. The password will be change to profile settings after loging to your account.<br>
                    2. Please Make sure you remember your password before changing it.<br>
                    3. The email cannot be change (Unique).<br>
                    4. Create and Keep the records of the Credentials of accounts for future use.<br>
                    5. Please use <b><font color='#4285F4'>G</font><font color='#DB4437'>o</font><font color='#F4B400'>o</font><font color='#4285F4'>g</font><font color='#0F9D58'>l</font><font color='#DB4437'>e</font></b> Chrome browser, if possible.<br>
                    6. Please ignore this message if you already received this message previously.</p>";

                if($mail->send() && mysqli_query($connection,$save_pass))
                {
                    $_SESSION['status'] = "Successfully Added!!";
                    $_SESSION['status_code'] = "success";
                    header("location:superadmin-admin-accounts.php");
                }
                else
                {
                    $_SESSION['status'] = "Unsuccessfully Added.Please Check your input or Contact the Personnel incharge!!";
                    $_SESSION['status_code'] = "error";
                    header("location:superadmin-admin-accounts.php");
                }
			}
			if(mysqli_query($connection,$sql))
			{
				$_SESSION['status'] = "Successfully Updated!!";
				$_SESSION['status_code'] = "success";
				header("location:superadmin-admin-accounts.php");
			} else {
				$_SESSION['status'] = "Unsuccessfully Update.. Please check The input Data!!";
				$_SESSION['status_code'] = "error";
				header("location:superadmin-admin-accounts.php");
			}
		}      
    }
	// End of Edit Admin Colleges Account //

	// Start of Delete All Admin Colleges Account //
	if (isset($_POST['delete_all_admin']))
    {
		$status = 0;
        $sql="UPDATE tbluser SET status='$status' WHERE usertype='Admin'";
        $getadmin = mysqli_query($connection,"SELECT * FROM tbluser");
		$select_college = "UPDATE `tblcollege` SET `admin_exist`='0'";
        if(mysqli_num_rows($getadmin) == 0)
        {
            $_SESSION['status'] = "Nothing To Be Deleted!!";
            $_SESSION['status_code'] = "warning";
            header("location:superadmin-admin-accounts.php");
        }
        else
        {
            if(mysqli_query($connection, $sql) && mysqli_query($connection, $select_college))
            {
                $_SESSION['status'] = "Successfully Delete!";
                $_SESSION['status_code'] = "success";
                header("location:superadmin-admin-accounts.php");
            } else {
                $_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data or Contact Person incharge!!";
                $_SESSION['status_code'] = "error";
                header("location:superadmin-admin-accounts.php");
            }
        }
    }
	// End of Delete All Admin Colleges Account //

	// Start of Delete Single Admin Colleges Account //
	if (isset($_POST['delete_admin']))
	{
		$id = $_POST['admin_id'];
		$collegeid = $_POST['collegeadminid'];
		$value = 0;
		$status = 0;

		$select_col = mysqli_query($connection,"SELECT * FROM tblcollege WHERE id='$collegeid'");
		$up_col = "UPDATE `tblcollege` SET `admin_exist`='$value' WHERE id='$collegeid'";
		$sql ="UPDATE tbluser SET status='$status' WHERE id='$id'";
		$get_id = mysqli_query($connection,"SELECT * FROM tbluser");
		while($sa = mysqli_fetch_array($get_id))
		{
			$adminid = $sa['id'];
		}		
		if(mysqli_query($connection, $sql) && mysqli_query($connection, $up_col))
		{
			$_SESSION['status'] = "Successfully Delete!";
            $_SESSION['status_code'] = "success";
            header("location:superadmin-admin-accounts.php");
		} else {
			$_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data!!";
            $_SESSION['status_code'] = "error";
            header("location:superadmin-admin-accounts.php");
		}
	}
	// End of Delete Single Admin Colleges Account //

	// Start of Add Adviser Colleges Account //
	if (isset($_POST['addAdviser']))
    {
        $Firstname=mysqli_real_escape_string($connection,$_POST['firstname']);
        $Lastname=mysqli_real_escape_string($connection,$_POST['lastname']);
        $Email=mysqli_real_escape_string($connection,$_POST['email']);
        $College=mysqli_real_escape_string($connection,$_POST['college']); 
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

        //email validation
        $check_email= mysqli_query($connection,"SELECT * FROM tbluser WHERE email='$Emails'");

        if(mysqli_num_rows($check_email) > 0){
			$_SESSION['status'] = "Already Existed!!";
            $_SESSION['status_code'] = "warning";
            header("location:superadmin-adviser-accounts.php");
        }
        else
		{
            //insert data
            $sql="INSERT INTO `tbluser`(`firstname`, `lastname`, `email`, `password`, `usertype`, `status`,`college_id_fk`) VALUES ('$Firstname','$Lastname','$Email','$Password','$Usertype','$Status',$CollegeID)";

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
            $mail->addAddress($Emails);  
            $mail->Subject = 'Online Pre-Advising';
            $mail->Body    = "<p>Greetings: <br><br> 
                Your Adviser Account: <br><br>Your email is <b>$Emails</b><br>
                Your Password is <b>$Password</b><br>
                Your College is <b>$collegename</b><br>
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
				header("location:superadmin-adviser-accounts.php");
            }
            else
            {
                $_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data!!";
				$_SESSION['status_code'] = "error";
				header("location:superadmin-adviser-accounts.php");
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
        $College=mysqli_real_escape_string($connection,$_POST['college']);

        //get College ID
        $check_college=  mysqli_query($connection,"SELECT * FROM tblcollege WHERE college='$College'");
        while($la=mysqli_fetch_array($check_college))
		{
            $CollegeID = $la['id'];
			$collegename = $la['college'];
        }

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
		}

		if($Firstname == $firstname && $Lastname == $lastname && $Email == $email && $Password == $password && $Contact == $contact && $College == $collegename)
		{
			$_SESSION['status'] = "Nothing to be updated!!";
            $_SESSION['status_code'] = "info";
            header("location:superadmin-adviser-accounts.php");
		}
		else
		{
			// Attempt update query execution
			$sql = "UPDATE `tbluser` SET `firstname`='$Firstname',`lastname`='$Lastname',`email`='$Email',`password`='$Password',`contact`='$Contact',`college_id_fk`= $CollegeID WHERE id='$adviser_id'";
            
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
                    Your Account Change a Password By Superadmin: <br><br>
                    Your Password is <b>$Password</b><br>
                    To Check, please go to <a href='wmsu-onlinepreadvising.com'><b>ONLINE PRE-ADVISING</b></a>
                    <br><br><p><b>Note:</b><br>
                    1. The password will be change to profile settings after loging to your account.<br>
                    2. Please Make sure you remember your password before changing it.<br>
                    3. The email cannot be change (Unique).<br>
                    4. Create and Keep the records of the Credentials of accounts for future use.<br>
                    5. Please use <b><font color='#4285F4'>G</font><font color='#DB4437'>o</font><font color='#F4B400'>o</font><font color='#4285F4'>g</font><font color='#0F9D58'>l</font><font color='#DB4437'>e</font></b> Chrome browser, if possible.<br>
                    6. Please ignore this message if you already received this message previously.</p>";

                if($mail->send() && mysqli_query($connection,$save_pass))
                {
                    $_SESSION['status'] = "Successfully Updated!!";
                    $_SESSION['status_code'] = "success";
                    header("location:superadmin-adviser-accounts.php");
                }
                else
                {
                    $_SESSION['status'] = "Unsuccessfully Added.Please Check your input or Contact the Personnel incharge!!";
                    $_SESSION['status_code'] = "error";
                    header("location:superadmin-adviser-accounts.php");
                }
			}
			if(mysqli_query($connection, $sql))
			{
				$_SESSION['status'] = "Successfully Updated!!";
				$_SESSION['status_code'] = "success";
				header("location:superadmin-adviser-accounts.php");
			} else {
				$_SESSION['status'] = "Unsuccessfully Update.. Please check The input Data!!";
				$_SESSION['status_code'] = "error";
				header("location:superadmin-adviser-accounts.php");
			}
		}      
    }
	// End of Edit Adviser Colleges Account //

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
            header("location:superadmin-adviser-accounts.php");
		} else {
			$_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data!!";
            $_SESSION['status_code'] = "error";
            header("location:superadmin-adviser-accounts.php");
		}
	}
	// End of Delete Single Adviser Colleges Account //
	
	// Start of Delete All Adviser Colleges Account //
	if (isset($_POST['delete_all_adviser']))
    {
		$Status = 0;
        $sql="UPDATE tbluser SET status='$Status' WHERE usertype='Adviser'";
        $getadviser = mysqli_query($connection,"SELECT * FROM tbluser");
        if(mysqli_num_rows($getadviser) == 0)
        {
            $_SESSION['status'] = "Nothing To Be Deleted!!";
            $_SESSION['status_code'] = "warning";
            header("location:superadmin-adviser-accounts.php");
        }
        else
        {
            if(mysqli_query($connection, $sql))
            {
                $_SESSION['status'] = "Successfully Delete!";
                $_SESSION['status_code'] = "success";
                header("location:superadmin-adviser-accounts.php");
            } else {
                $_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data!!";
                $_SESSION['status_code'] = "error";
                header("location:superadmin-adviser-accounts.php");
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
        $College=mysqli_real_escape_string($connection,$_POST['college']); 
		$Course=mysqli_real_escape_string($connection,$_POST['course']);
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

        //email validation
        $check_email= mysqli_query($connection,"SELECT * FROM tbluser WHERE email='$Emails'");

        if(mysqli_num_rows($check_email) > 0){
			$_SESSION['status'] = "Already Existed!!";
            $_SESSION['status_code'] = "info";
            header("location:superadmin-colleges-accounts.php");
        }
        else
		{
            //insert data
            $sql="INSERT INTO `tbluser`(`firstname`, `lastname`, `email`, `password`, `usertype`,`college_id_fk`,`course_id_fk`) VALUES ('$Firstname','$Lastname','$Emails','$Password','$Usertype','$CollegeID','$Course')";

			if(mysqli_query($connection,$sql))
            {
                $_SESSION['status'] = "Successfully Added!!";
				$_SESSION['status_code'] = "success";
				header("location:superadmin-colleges-accounts.php");
            }
            else
            {
                $_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data!!";
				$_SESSION['status_code'] = "error";
				header("location:superadmin-colleges-accounts.php");
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
        $College=mysqli_real_escape_string($connection,$_POST['college']);
		$Course=mysqli_real_escape_string($connection,$_POST['course']);

        //get College ID
        $check_college= "SELECT * FROM tblcollege WHERE college='$College'";
		$check_cols = mysqli_query($connection,$check_college);
        if(mysqli_num_rows($check_cols) > 0){
            $fa_c = mysqli_fetch_array($check_cols);
            $CollegeID = $fa_c['id'];
			$collegename = $fa_c['college'];
        }

		//get Course ID
		$check_course= "SELECT * FROM tblcourse WHERE course='$Course'";
		$check_cours = mysqli_query($connection,$check_course);
		if(mysqli_num_rows($check_cours) > 0){
			$fa_c = mysqli_fetch_array($check_cours);
			$CourseID = $fa_c['id'];
			$course = $fa_c['course'];
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
		}

		if($Firstname == "$firstname" && $Lastname == "$lastname" && $Email == "$email" && $Password == "$password" && $Contact == "$contact" && $College == "$collegename")
		{
			$_SESSION['status'] = "Nothing To Be Updated!!";
            $_SESSION['status_code'] = "info";
            header("location:superadmin-colleges-accounts.php");
		}
		else
		{
			// Attempt update query execution
			$sql = "UPDATE `tbluser` SET `firstname`='$Firstname',`lastname`='$Lastname',`email`='$Email',`password`='$Password',`contact`='$Contact',`college_id_fk`= $CollegeID, `course_id_fk`= $CourseID WHERE id='$student_id'";
            
			if(mysqli_query($connection, $sql))
			{
				$_SESSION['status'] = "Successfully Added!!";
				$_SESSION['status_code'] = "success";
				header("location:superadmin-colleges-accounts.php");
			} else {
				$_SESSION['status'] = "Unsuccessfully Update.. Please check The input Data!!";
				$_SESSION['status_code'] = "error";
				header("location:superadmin-colleges-accounts.php");
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
            header("location:superadmin-colleges-accounts.php");
		} else {
			$_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data!!";
            $_SESSION['status_code'] = "error";
            header("location:superadmin-colleges-accounts.php");
		}
	}
	// End of Delete Single Students Accounts //

	// Start of Delete All Students Accounts //
	if (isset($_POST['delete_all_student']))
    {
        $sql="DELETE FROM tbluser WHERE usertype='Student'";
        $getstudent = mysqli_query($connection,"SELECT * FROM tbluser");
    
        $c = "ALTER TABLE tbluser AUTO_INCREMENT = 1";

        if(mysqli_num_rows($getstudent) == 0)
        {
            $_SESSION['status'] = "Nothing To Be Deleted!!";
            $_SESSION['status_code'] = "info";
            header("location:superadmin-colleges-accounts.php");
        }
        else
        {
            if(mysqli_query($connection, $sql) && mysqli_query($connection, $c))
            {
                $_SESSION['status'] = "Successfully Delete!";
                $_SESSION['status_code'] = "success";
                header("location:superadmin-colleges-accounts.php");
            } else {
                $_SESSION['status'] = "Unsuccessfully Delete.. Please check The input Data!!";
                $_SESSION['status_code'] = "error";
                header("location:superadmin-colleges-accounts.php");
            }
        }
    }
	// End of Delete All Students Accounts //
// End of Colleges Accounts Manage Data //
?>
