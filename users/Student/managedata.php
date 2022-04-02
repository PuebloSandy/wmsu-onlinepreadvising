<?php
    session_start();
    include "../../source/includes/config.php";
    include("../../source/includes/alertmessage.php");

    // Start Edit Student Grade //
    if(isset($_POST['update_grades']))
    {
        $Sendid = $_POST['sub_send_id'];
        $Grade = $_POST['grade'];

        if($Grade == "1.0" || $Grade == "1.25" || $Grade == "1.50" || $Grade == "1.75" || $Grade == "2.0" || $Grade == "2.25" || $Grade == "2.50" || $Grade == "2.75" || $Grade == "3.0" || $Grade == "INC")
        {
            $Remarks = "PASSED";
        }
        if($Grade == "5.0")
        {
            $Remarks = "FAILED";
        }

        $sql = "UPDATE tbladviser_send_sub_to_stud SET grades='$Grade' ,remarks='$Remarks' WHERE id='$Sendid'";

        if(mysqli_query($connection,$sql))
        {
            //$_SESSION['status'] = "Successfully Insert the Grade!!";
            //$_SESSION['status_code'] = "success";
            header("location: student-manual-grades.php"); 
        }
        else
        {
            $_SESSION['status'] = "Unsuccessfully Insert the Grade.Please Check your input or Contact the Personnel incharge!!";
            $_SESSION['status_code'] = "error";
            header("location: student-manual-grades.php"); 
        }
    }
    // End Edit Student Grade //

    // Start Send Grades //
    if(isset($_POST['send_grades']))
    {
        $Studentid = $_POST['studentid'];
        $Currid = $_POST['currid'];
        $Collegeid = $_POST['collegeid'];
        $Courseid = $_POST['courseid'];
        $Year = $_POST['yearlevel'];
        $sub_status = "Pending";
        $target = "../../source/upload/grade_files/".basename($_FILES['pdf-file']['name']);
		$Pdf = $_FILES['pdf-file']['name']; 

        $check_status_grade = mysqli_query($connection,"SELECT * FROM tblstudent_grade_sub WHERE submission_status='Disapproved' and student_id_fk='$Studentid' and curri_id_fk='$Currid' and college_id_fk='$Collegeid' and course_id_fk='$Courseid'");
        while($i=mysqli_fetch_array($check_status_grade))
        {
            $SubM_grades = $i['submission_status'];
        }
        $check_status_pdf = mysqli_query($connection,"SELECT * FROM tblstudent_pdf WHERE submission_status='Disapproved' and student_id_fk='$Studentid' and curri_id_fk='$Currid' and college_id_fk='$Collegeid' and course_id_fk='$Courseid'");
        while($a=mysqli_fetch_array($check_status_pdf))
        {
            $SubM_pdf = $a['submission_status'];
        }

        if($SubM_grades == "Disapproved" && $SubM_pdf == "Disapproved")
        {
            $Del_grades = "DELETE FROM tblstudent_grade_sub WHERE submission_status='Disapproved' and student_id_fk='$Studentid' and curri_id_fk='$Currid' and college_id_fk='$Collegeid' and course_id_fk='$Courseid'";
            $Del_pdf = "DELETE FROM tblstudent_pdf WHERE submission_status='Disapproved' and student_id_fk='$Studentid' and curri_id_fk='$Currid' and college_id_fk='$Collegeid' and course_id_fk='$Courseid'";
        
            $select_id_grade = mysqli_query($connection,"SELECT * FROM tblstudent_grade_sub");
            while($fa = mysqli_fetch_array($select_id_grade))
            {
                $GradID = $fa['id'];
            }
            $select_id_pdf = mysqli_query($connection,"SELECT * FROM tblstudent_pdf");
            while($fa = mysqli_fetch_array($select_id_pdf))
            {
                $PdfID = $fa['id'];
            }

            $g = "ALTER TABLE tblstudent_grade_sub AUTO_INCREMENT = $GradID";
            $p = "ALTER TABLE tblstudent_pdf AUTO_INCREMENT = $PdfID";

            if(mysqli_query($connection,$Del_grades) && mysqli_query($connection,$Del_pdf) && mysqli_query($connection,$g) && mysqli_query($connection,$p)){}

            $select_sub = mysqli_query($connection,"SELECT * FROM tbladviser_send_sub_to_stud WHERE student_id_fk='$Studentid' and curri_id_fk='$Currid' and college_id_fk='$Collegeid' and course_id_fk='$Courseid'");
            foreach($select_sub as $Sub)
            {   
                $Grades = $Sub['grades'];
                $Remarks = $Sub['remarks'];
                $SubjectID = $Sub['subject_id_fk'];
                $sql = "INSERT INTO tblstudent_grade_sub (grades,remarks,submission_status,yearlevel,student_id_fk,college_id_fk,subject_id_fk,curri_id_fk,course_id_fk) VALUES ('$Grades','$Remarks','$sub_status','$Year','$Studentid','$Collegeid','$SubjectID','$Currid','$Courseid')";

                if(mysqli_query($connection,$sql)){}
            }

            $send_pdf = "INSERT INTO tblstudent_pdf (pdf_grade,submission_status,yearlevel,student_id_fk,curri_id_fk,college_id_fk,course_id_fk) VALUES ('$Pdf','$sub_status','$Year','$Studentid','$Currid','$Collegeid','$Courseid')";
            if(mysqli_query($connection,$send_pdf) && move_uploaded_file($_FILES['pdf-file']['tmp_name'], $target))
            {
                $_SESSION['status'] = "Successfully Send the Grade!!";
                $_SESSION['status_code'] = "success";
                header("location: student-manual-grades.php"); 
            }
            else
            {
                $_SESSION['status'] = "Unsuccessfully Send the Grade.Please Check your input or Contact the Personnel incharge!!";
                $_SESSION['status_code'] = "error";
                header("location: student-manual-grades.php"); 
            }
        }
        else
        {
            $select_sub = mysqli_query($connection,"SELECT * FROM tbladviser_send_sub_to_stud WHERE student_id_fk='$Studentid' and curri_id_fk='$Currid' and college_id_fk='$Collegeid' and course_id_fk='$Courseid'");
            foreach($select_sub as $Sub)
            {   
                $Grades = $Sub['grades'];
                $Remarks = $Sub['remarks'];
                $SubjectID = $Sub['subject_id_fk'];
                $sql = "INSERT INTO tblstudent_grade_sub (grades,remarks,submission_status,yearlevel,student_id_fk,college_id_fk,subject_id_fk,curri_id_fk,course_id_fk) VALUES ('$Grades','$Remarks','$sub_status','$Year','$Studentid','$Collegeid','$SubjectID','$Currid','$Courseid')";

                if(mysqli_query($connection,$sql)){}
            }

            $send_pdf = "INSERT INTO tblstudent_pdf (pdf_grade,submission_status,yearlevel,student_id_fk,curri_id_fk,college_id_fk,course_id_fk) VALUES ('$Pdf','$sub_status','$Year','$Studentid','$Currid','$Collegeid','$Courseid')";
            if(mysqli_query($connection,$send_pdf) && move_uploaded_file($_FILES['pdf-file']['tmp_name'], $target))
            {
                $_SESSION['status'] = "Successfully Send the Grade!!";
                $_SESSION['status_code'] = "success";
                header("location: student-manual-grades.php"); 
            }
            else
            {
                $_SESSION['status'] = "Unsuccessfully Send the Grade.Please Check your input or Contact the Personnel incharge!!";
                $_SESSION['status_code'] = "error";
                header("location: student-manual-grades.php"); 
            }
        }
    }
    // End Send Grades //

    
?>