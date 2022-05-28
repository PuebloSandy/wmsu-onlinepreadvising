<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    session_start();
    include "../../source/includes/config.php";
    include("../../source/includes/alertmessage.php");

    function generate_password($len = 12){
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
        $password = substr( str_shuffle( $chars ), 0, $len );
        return $password;
    }

// Start Save Grade Subject of Student //
if(isset($_POST['but_update']))
{
    if(isset($_POST['sub_list_id']))
    {
        $Studid = $_POST['studid'];
        $Currid = $_POST['currid'];
        
        foreach($_POST['sub_list_id'] as $updateid)
        {
            echo $updateid."\n";
            $grade = $_POST['grades_'.$updateid];
            //$subject_idFK = $_POST['subject_id_fk_'.$updateid];

            $select_at_sub_grade = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE id='$updateid'");
            while($n=mysqli_fetch_array($select_at_sub_grade))
            {
                $up_id_list = $n['id'];
                $up_grade_list = $n['grades'];
                $school_year = $n['school_year'];
            }
                if($updateid && $grade != "0")
                {  
                    if($grade == "1.0" || $grade == "1.25" || $grade == "1.50" || $grade == "1.75" || $grade == "2.0" || $grade == "2.25" || $grade == "2.50" || $grade == "2.75" || $grade == "3.0" || $grade == "INC")
                    {
                        $Remarks = "PASSED";
                        $select_act_SY = mysqli_query($connection,"SELECT * FROM tblschool_year WHERE status='Activated'");
                        while($sy_c = mysqli_fetch_array($select_act_SY))
                        {
                            $school_year_act = 0;
                        }
                        $select_sy = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE id='$up_id_list'");
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
                            else if($Grades_pre == 0 && $Remarks_pre == "Recommended")
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
                            else if($Grades_pre != 0 && $Remarks_pre == "CREDITED")
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
                            else if($Grades_pre != 0 && $Remarks_pre == "FAILED" || $Remarks_pre == "RETAKE")
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
                        if($up_id_list == $SY_SUBID && $school_year == $SY_SUBSY)
                        {
                            $sql = "UPDATE tblstudent_subject SET grades='$grade',total_grades='$total_grades', remarks='$Remarks', school_year='$school_year' WHERE id='$up_id_list'";
                        }
                        else if($up_id_list == $SY_SUBID && $school_year != $SY_SUBSY)
                        {
                            $sql = "UPDATE tblstudent_subject SET grades='$grade',total_grades='$total_grades', remarks='$Remarks', school_year='$school_year' WHERE id='$up_id_list'"; 
                        }
                        $getisnot_failed = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE id='$up_id_list'");
                        if(mysqli_num_rows($getisnot_failed) > 0)
                        {
                            $h=mysqli_fetch_array($getisnot_failed);
                            $SUbId_Passed = $h['id'];
                            $CourseId_Passed = $h['course_id_fk'];
                            $AdviseridFK = $h['adviser_id_fk'];
                            $check_del_pre = mysqli_query($connection,"SELECT * FROM tbladviser_send_sub_to_stud WHERE subject_id_fk='$SUbId_Passed' and adviser_id_fk='$AdviseridFK' and student_id_fk='$Studid' and curri_id_fk='$Currid' and course_id_fk='$CourseId_Passed'");
                            if(mysqli_num_rows($check_del_pre) > 0)
                            {
                                $del_pre_sub = "DELETE FROM tbladviser_send_sub_to_stud WHERE status='Currently Enrolled' and subject_id_fk='$SUbId_Passed' and adviser_id_fk='$AdviseridFK' and student_id_fk='$Studid' and curri_id_fk='$Currid' and course_id_fk='$CourseId_Passed'";
                                $select_app_sub = "ALTER TABLE tbladviser_send_sub_to_stud AUTO_INCREMENT = 1";
                                if(mysqli_query($connection,$sql) && mysqli_query($connection,$del_pre_sub) && mysqli_query($connection,$select_app_sub))
                                {
                                    $_SESSION['status'] = "Successfully Updated The Grades!!";
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
                        }
                        if(mysqli_query($connection,$sql))
                        {
                            $_SESSION['status'] = "Successfully Updated The Grades!!";
                            $_SESSION['status_code'] = "success";
                            header("location: adviser-oldloadsubjects.php");
                        }
                        else
                        {
                            $_SESSION['status'] = "Unsuccessfully Updated. Please check your input or Contact the Personnel Incharge!!";
                            $_SESSION['status_code'] = "error";
                            header("location: adviser-oldloadsubjects.php");
                        }
    
                        $get_sub_app = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE id='$updateid' and remarks IN ('PASSED','Recommended') and student_id_fk='$Studid' and curr_id_fk='$Currid'");
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
    
                                    $check_idSUB = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE subject_id_fk='$subject_code' and adviser_id_fk='$adviser_id_fk' and student_id_fk='$Studid' and curr_id_fk='$SubCuri' and course_id_fk='$SubCourse'");
                                    if(mysqli_num_rows($check_idSUB) > 0)
                                    {
                                        $v=mysqli_fetch_array($check_idSUB);
                                        $SUB_ID_stu_sub = $v['id'];
                                        $SUB_id_pre = $v['subject_id_fk'];
                                        $SUB_Adviser_id = $v['adviser_id_fk'];
                                        $SUB_Stud_id = $v['student_id'];
                                        $SUB_Course_id = $v['course_id_fk'];
                                        $SUB_Curri_id = $v['curri_id'];
                                        $Grades_PRE = $v['grades'];
                                        $Remarks_PRE = $v['remarks'];                     
                                    }
    
                                    if($subject_code == $SUB_ID_stu_sub && $Grades_PRE == 0 && $Remarks_PRE == "Not Yet Taken")
                                    {
                                        $remarks_recommended = "Recommended";
                                        $sqls = "UPDATE tblstudent_subject SET remarks='$remarks_recommended' WHERE id='$SUB_ID_stu_sub' and adviser_id_fk='$adviser_id_fk' and student_id_fk='$Studid' and curr_id_fk='$SubCuri' and course_id_fk='$SubCourse'";
                                        $getisnot_failed = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE id='$updateid' and adviser_id_fk='$adviser_id_fk' and student_id_fk='$Studid' and curr_id_fk='$SubCuri' and course_id_fk='$SubCourse'");
                                        if(mysqli_num_rows($getisnot_failed) > 0)
                                        {
                                            $h=mysqli_fetch_array($getisnot_failed);
                                            $SUbId_Passed = $h['subject_id_fk'];
                                            $CourseId_Passed = $h['course_id_fk'];
                                            $AdviseridFK = $h['adviser_id_fk'];
                                            $check_del_pre = mysqli_query($connection,"SELECT * FROM tbladviser_send_sub_to_stud WHERE subject_id_fk='$SUbId_Passed' and status='Currently Enrolled' and adviser_id_fk='$AdviseridFK' and student_id_fk='$Studid' and curri_id_fk='$Currid' and course_id_fk='$CourseId_Passed'");
                                            if(mysqli_num_rows($check_del_pre) > 0)
                                            {
                                                $del_pre_sub = "DELETE FROM tbladviser_send_sub_to_stud WHERE status='Currently Enrolled' and subject_id_fk='$SUbId_Passed' and adviser_id_fk='$AdviseridFK' and student_id_fk='$Studid' and curri_id_fk='$Currid' and course_id_fk='$CourseId_Passed'";
                                                $select_app_sub = "ALTER TABLE tbladviser_send_sub_to_stud AUTO_INCREMENT = 1";
                                                mysqli_query($connection,$del_pre_sub);
                                                mysqli_query($connection,$select_app_sub);
                                            }
                                        }
                                        if(mysqli_query($connection,$sqls))
                                        {
                                            $_SESSION['status'] = "Successfully Updated The Grades!!";
                                            $_SESSION['status_code'] = "success";
                                            header("location: adviser-oldloadsubjects.php");
                                        } 
                                        else
                                        {
                                            $_SESSION['status'] = "Unsuccessfully Updated. Please check your input or Contact the Personnel Incharge!! is not connected";
                                            $_SESSION['status_code'] = "error";
                                            header("location: adviser-oldloadsubjects.php");
                                        } 
                                    }
                                }
                            }
                        }
                    }
                    else if($grade == "CREDITED")
                    {
                        $Remarks = "CREDITED";
                        $get_stud_info = mysqli_query($connection,"SELECT * FROM tblstudent_list WHERE id='$Studid'");
                        while($y = mysqli_fetch_array($get_stud_info))
                        {
                            $stud_adviser_id = $y['adviser_id_fk'];
                            $stud_course_id = $y['course_id_fk'];
                            $stud_college_id = $y['college_id_fk'];
                        }
                        $get_sub_in_student_sub = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE id='$updateid'");
                        while($z = mysqli_fetch_array($get_sub_in_student_sub))
                        {
                            $stud_sub_id = $z['id'];
                            $stud_sub_lec = $z['lec'];
                            $stud_sub_lab = $z['lab'];
                            $stud_sub_units = $z['units'];
                            $stud_sub_yearlevel = $z['yearlevel'];
                            $stud_sub_semester = $z['semester'];
                            $school_year = 0;
                        }

                        $select_sy = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE id='$updateid'");
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
                            else if($Grades_pre == 0 && $Remarks_pre == "Recommended")
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
                            else if($Grades_pre != 0 && $Remarks_pre == "CREDITED")
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
                            else if($Grades_pre != 0 && $Remarks_pre == "FAILED")
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
                        $sql = "UPDATE tblstudent_subject SET grades='$grade',total_grades='$total_grades',school_year='$school_year', remarks='$Remarks' WHERE id='$updateid'";   
                        if(mysqli_query($connection,$sql))
                        {
                            $_SESSION['status'] = "Successfully Updated The Grades!!";
                            $_SESSION['status_code'] = "success";
                            header("location: adviser-oldloadsubjects.php");
                        }   
    
                        $get_sub_app = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE id='$updateid' and remarks IN ('CREDITED','Recommended') and student_id_fk='$Studid' and curr_id_fk='$Currid' and course_id_fk='$stud_course_id'");
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
    
                                $search_sub_curriculum = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$subject_code' and curr_id_fk='$Currid' and course_id_fk='$CourSub'");
                                foreach($search_sub_curriculum as $p)
                                {
                                    $subjectID = $p['id'];
                                    $SubLec = $p['lec'];
                                    $SubLab = $p['lab'];
                                    $SubUnits = $p['units'];
                                    $SubYear = $p['yearlevel'];
                                    $subjectID = $p['semester'];
                                    $SubCollege = $p['college_id_fk'];
                                    $SubCuri = $p['curr_id_fk'];
                                    $SubCourse = $p['course_id_fk'];
                                    $SubjectCode = $p['subject_code'];

                                    $remarks_auto = "Recommended";

                                    $del_pre_sub_cred = "DELETE FROM tbladviser_send_sub_to_stud WHERE status='Currently Enrolled' and subject_id_fk='$student_subid' and adviser_id_fk='$adviser_id_fk' and student_id_fk='$Studid' and curri_id_fk='$SubCuri' and course_id_fk='$SubCourse'";
                                    $auto_update_remarks_sub = "UPDATE tblstudent_subject SET remarks='$remarks_auto' WHERE subject_id_fk='$subject_code' and student_id_fk='$Studid' and curr_id_fk='$SubCuri' and course_id_fk='$SubCourse'";
                                    if(mysqli_query($connection,$auto_update_remarks_sub) && mysqli_query($connection,$del_pre_sub_cred))
                                    {
                                        $_SESSION['status'] = "Successfully Updated The Grades!!";
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
                            }
                        }
                    }
                    else if($grade == "5.0" || $grade == "DRP")
                    {
                        $Remarks = "FAILED";
                        $select_act_SY = mysqli_query($connection,"SELECT * FROM tblschool_year WHERE status='Activated'");
                        while($sy_c = mysqli_fetch_array($select_act_SY))
                        {
                            $school_year_act = 0;
                        }
                        $get_stud_info = mysqli_query($connection,"SELECT * FROM tblstudent_list WHERE id='$Studid'");
                        while($y = mysqli_fetch_array($get_stud_info))
                        {
                            $stud_adviser_id = $y['adviser_id_fk'];
                            $stud_course_id = $y['course_id_fk'];
                            $stud_college_id = $y['college_id_fk'];
                        }
                        $select_sy = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE id='$updateid'");
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
                            else if($Grades_pre == 0 && $Remarks_pre == "Currently Enrolled")
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
                        $sql = "UPDATE tblstudent_subject SET grades='$grade',total_grades='$total_grades',school_year='$school_year_act', remarks='$Remarks' WHERE id='$updateid'";   
                        if(mysqli_query($connection,$sql))
                        {
                            $_SESSION['status'] = "Successfully Updated The Grades!!";
                            $_SESSION['status_code'] = "success";
                            header("location: adviser-oldloadsubjects.php");
                        }
                        else
                        {
                            $_SESSION['status'] = "Unsuccessfully Updated. Please check your input or Contact the Personnel Incharge!!";
                            $_SESSION['status_code'] = "error";
                            header("location: adviser-oldloadsubjects.php");
                        }

                        $getisnot_failed = mysqli_query($connection,"SELECT * FROM tblstudent_subject WHERE id='$updateid' and student_id_fk='$Studid' and curri_id_fk='$Currid' and course_id_fk='$stud_course_id'");
                        foreach($getisnot_failed as $h)
                        {
                            $SUbId_Passed = $h['id'];
                            $CourseId_Passed = $h['course_id_fk'];
                            $AdviserIDFK = $h['adviser_id_fk'];
                            $check_del_pre = mysqli_query($connection,"SELECT * FROM tbladviser_send_sub_to_stud WHERE subject_id_fk='$SUbId_Passed' and status='Currently Enrolled' and adviser_id_fk='$AdviserIDFK' and student_id_fk='$Studid' and curri_id_fk='$Currid' and course_id_fk='$CourseId_Passed'");
                            if(mysqli_num_rows($check_del_pre) > 0)
                            {
                                $del_pre_sub = "DELETE FROM tbladviser_send_sub_to_stud WHERE status='Currently Enrolled' and subject_id_fk='$SUbId_Passed' and adviser_id_fk='$AdviserIDFK' and student_id_fk='$Studid' and curri_id_fk='$Currid' and course_id_fk='$CourseId_Passed'";
                                $select_app_sub = "ALTER TABLE tbladviser_send_sub_to_stud AUTO_INCREMENT = 1";
                                if(mysqli_query($connection,$del_pre_sub) && mysqli_query($connection,$select_app_sub))
                                {
                                    $_SESSION['status'] = "Successfully Updated The Grades!!";
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
                        } 
                    }
                }
                else
                {
                    //$_SESSION['status'] = "No Input of Grades!!";
                    //$_SESSION['status_code'] = "warning";
                    header("location: adviser-oldloadsubjects.php");
                }

        }
    }
}
// End Save Grade Subject of Student //
?>