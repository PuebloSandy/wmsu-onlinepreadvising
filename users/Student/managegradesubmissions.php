<?php
    session_start();
    include("../includes/config.php");

    if(isset($_POST['submit-grade']))
    {

        $StudentID = $_SESSION['id'];
        $target = "../upload/docu-files/".basename($_FILES['grades_file']['name']);
		$gf = $_FILES['grades_file']['name'];  
        $sub_status = "Pending";  
        $collegeid = mysqli_real_escape_string($connection,$_POST['collegeid']); 
        $adviser=mysqli_real_escape_string($connection,$_POST['adviser_name']); 
        
        $getadviserid = mysqli_query($connection,"SELECT * FROM tbluser WHERE id='$adviser'");
        
        while($da = mysqli_fetch_array($getadviserid))
        {
          $adviserid = $da['id'];
          $email = $da['email'];
        }
        
        $getstud_check = mysqli_query($connection,"SELECT * FROM tblstudent_grades_sub WHERE student_id_fk='$StudentID'");
        
        if(mysqli_num_rows($getstud_check) > 0){
            
            $update = "UPDATE tblstudent_grades_sub SET grades_filename='$gf',submission_status='$sub_status' WHERE student_id_fk='$StudentID'";
            
             if(mysqli_query($connection,$update) && move_uploaded_file($_FILES['grades_file']['tmp_name'], $target))
            {
                echo '<script>alert("Successfully Submit..")</script>';
                header("location: student-ii.php");
            }
        else
        {
            echo "ERROR:Could not be able to execute $update. " .mysqli_error($connection);
        }
        }
        else{

        $grades_query = "INSERT INTO `tblstudent_grades_sub`(`grades_filename`,`student_id_fk`,`college_id_fk`,`submission_status`,`adviser`) VALUES ('$gf',$StudentID,$collegeid,'$sub_status','$adviserid')";
        
        if(mysqli_query($connection,$grades_query) && move_uploaded_file($_FILES['grades_file']['tmp_name'], $target))
        {
            echo '<script>alert("Successfully Submit..")</script>';
            header("location: student-ii.php");
        }
        else
        {
            echo '<script>alert("Their is a Problem on your submission. Please Check...")</script>';
        }
    }
    }
    
    if(isset($_POST['send_grades']))
    {
        $subs = mysqli_real_escape_string($connection,$_POST['s']);
        $sub2 = mysqli_real_escape_string($connection,$_POST['su']);
        $sub3 = mysqli_real_escape_string($connection,$_POST['sub']);
        $sub4 = mysqli_real_escape_string($connection,$_POST['subj']);
        $sub5 = mysqli_real_escape_string($connection,$_POST['subje']);
        $sub6 = mysqli_real_escape_string($connection,$_POST['subjec']);
        $sub7 = mysqli_real_escape_string($connection,$_POST['subject']);
        $sub8 = mysqli_real_escape_string($connection,$_POST['subjects']);
        
        $grades = mysqli_real_escape_string($connection,$_POST['g']); 
        $grade2 = mysqli_real_escape_string($connection,$_POST['gr']);
        $grade3 = mysqli_real_escape_string($connection,$_POST['gra']);
        $grade4 = mysqli_real_escape_string($connection,$_POST['grad']);
        $grade5 = mysqli_real_escape_string($connection,$_POST['grade']);
        $grade6 = mysqli_real_escape_string($connection,$_POST['grades']);
        $grade7 = mysqli_real_escape_string($connection,$_POST['gradess']);
        $grade8 = mysqli_real_escape_string($connection,$_POST['gradesss']);
        
        $Semester = mysqli_real_escape_string($connection,$_POST['semester']);
        
        $collegeid = $_SESSION['college_id_fk'];
        $courseid = $_SESSION['course_id_fk'];
        $yearlevel = $_SESSION['yearlevel'];
        $currid = $_SESSION['curr_id'];
        $email = $_SESSION['email'];
        
        $getstudid = mysqli_query($connection,"SELECT * FROM tbluser WHERE email='$email'");
        
        while($fa = mysqli_fetch_array($getstudid))
        {
            $studid = $fa['id'];
        }
        
        $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$subs'");
            while($fa = mysqli_query($getsub))
            {
                $getsubcode = $fa['subject_code'];
                $getprereq = $fa['prerequisite'];
            }
        
        //input subject 1
        if($subs != "0" && $grades != "0" && $studid && $collegeid && $courseid && $yearlevel && $Semester){
            $save1 = "INSERT INTO tblstudent_sub_grades (subject_id,grades,student_id,college_id_fk,course_id_fk,yearlevel,semester) VALUES ('$subs','$grades','$studid','$collegeid','$courseid','$yearlevel','$Semester')";
            
            if(mysqli_query($connection,$save1)){
                 echo '<script>alert("Successfully Submit..")</script>';
                 header("location: student-grade-input.php");
            }else{
                 echo '<script>alert("Their is a Problem on your submission. Please Check...")</script>';
                 header("location: student-grade-input.php");
            }
            
        }if($subs == "0" && $grades == "0" && $studid == "" && $collegeid == "" && $courseid == "" && $yearlevel == "" && $Semester== ""){
             $save1 = "INSERT INTO tblstudent_sub_grades (subject_id,grades,student_id,college_id_fk,course_id_fk,yearlevel,semester) VALUES ('$subs','$grades','$studid','$collegeid','$courseid','$yearlevel','$Semester')";
            if(!mysqli_query($connection,$save1)){
                 echo '<script>alert("Successfully Submit..")</script>';
                 header("location: student-grade-input.php");
            }else{
                 echo '<script>alert("Their is a Problem on your submission. Please Check...")</script>';
                 header("location: student-grade-input.php");
            }
        }
        //input subject 2
        if($sub2 != "0" && $grade2 != "0" && $studid && $collegeid && $courseid && $yearlevel && $Semester){
            $save2 = "INSERT INTO tblstudent_sub_grades (subject_id,grades,student_id,college_id_fk,course_id_fk,yearlevel,semester) VALUES ('$sub2','$grade2','$studid','$collegeid','$courseid','$yearlevel','$Semester')";
            if(mysqli_query($connection,$save2)){
                 echo '<script>alert("Successfully Submit..")</script>';
                 header("location: student-grade-input.php");
            }else{
                 echo '<script>alert("Their is a Problem on your submission. Please Check...")</script>';
                 header("location: student-grade-input.php");
            }
        }if($sub2 == "0" && $grade2 == "0" && $studid == "" && $collegeid == "" && $courseid == "" && $yearlevel == "" && $Semester== ""){
             $save2 = "INSERT INTO tblstudent_sub_grades (subject_id,grades,student_id,college_id_fk,course_id_fk,yearlevel,semester) VALUES ('$sub2','$grade2','$studid','$collegeid','$courseid','$yearlevel','$Semester')";
            if(!mysqli_query($connection,$save2)){
                 echo '<script>alert("Successfully Submit..")</script>';
                 header("location: student-grade-input.php");
            }else{
                 echo '<script>alert("Their is a Problem on your submission. Please Check...")</script>';
                 header("location: student-grade-input.php");
            }
        }
        //input subject 3
         if($sub3 != "0" && $grade3 != "0" && $studid && $collegeid && $courseid && $yearlevel && $Semester){
            $save3 = "INSERT INTO tblstudent_sub_grades (subject_id,grades,student_id,college_id_fk,course_id_fk,yearlevel,semester) VALUES ('$sub3','$grade3','$studid','$collegeid','$courseid','$yearlevel','$Semester')";
            if(mysqli_query($connection,$save3)){
                 echo '<script>alert("Successfully Submit..")</script>';
                 header("location: student-grade-input.php");
            }else{
                 echo '<script>alert("Their is a Problem on your submission. Please Check...")</script>';
                 header("location: student-grade-input.php");
            }
        }if($sub3 == "0" && $grade3 == "0" && $studid == "" && $collegeid == "" && $courseid == "" && $yearlevel == "" && $Semester== ""){
             $save3 = "INSERT INTO tblstudent_sub_grades (subject_id,grades,student_id,college_id_fk,course_id_fk,yearlevel,semester) VALUES ('$sub3','$grade3','$studid','$collegeid','$courseid','$yearlevel','$Semester')";
            if(!mysqli_query($connection,$save3)){
                 echo '<script>alert("Successfully Submit..")</script>';
                 header("location: student-grade-input.php");
            }else{
                 echo '<script>alert("Their is a Problem on your submission. Please Check...")</script>';
                 header("location: student-grade-input.php");
            }
        }
        //input subject 4
         if($sub4 != "0" && $grade4 != "0" && $studid && $collegeid && $courseid && $yearlevel && $Semester){
            $save4 = "INSERT INTO tblstudent_sub_grades (subject_id,grades,student_id,college_id_fk,course_id_fk,yearlevel,semester) VALUES ('$sub4','$grade4','$studid','$collegeid','$courseid','$yearlevel','$Semester')";
            if(mysqli_query($connection,$save4)){
                 echo '<script>alert("Successfully Submit..")</script>';
                 header("location: student-grade-input.php");
            }else{
                 echo '<script>alert("Their is a Problem on your submission. Please Check...")</script>';
                 header("location: student-grade-input.php");
            }
        }if($sub4 == "0" && $grade4 == "0" && $studid == "" && $collegeid == "" && $courseid == "" && $yearlevel == "" && $Semester== ""){
             $save4 = "INSERT INTO tblstudent_sub_grades (subject_id,grades,student_id,college_id_fk,course_id_fk,yearlevel,semester) VALUES ('$sub4','$grade4','$studid','$collegeid','$courseid','$yearlevel','$Semester')";
            if(!mysqli_query($connection,$save4)){
                 echo '<script>alert("Successfully Submit..")</script>';
                 header("location: student-grade-input.php");
            }else{
                 echo '<script>alert("Their is a Problem on your submission. Please Check...")</script>';
                 header("location: student-grade-input.php");
            }
        }
        //input subject 5
        if($sub5 != "0" && $grade5 != "0" && $studid && $collegeid && $courseid && $yearlevel && $Semester){
            $save5 = "INSERT INTO tblstudent_sub_grades (subject_id,grades,student_id,college_id_fk,course_id_fk,yearlevel,semester) VALUES ('$sub5','$grade5','$studid','$collegeid','$courseid','$yearlevel','$Semester')";
            if(mysqli_query($connection,$save5)){
                 echo '<script>alert("Successfully Submit..")</script>';
                 header("location: student-grade-input.php");
            }else{
                 echo '<script>alert("Their is a Problem on your submission. Please Check...")</script>';
                 header("location: student-grade-input.php");
            }
        }if($sub5 == "0" && $grade5 == "0" && $studid == "" && $collegeid == "" && $courseid == "" && $yearlevel == "" && $Semester== ""){
             $save5 = "INSERT INTO tblstudent_sub_grades (subject_id,grades,student_id,college_id_fk,course_id_fk,yearlevel,semester) VALUES ('$sub5','$grade5','$studid','$collegeid','$courseid','$yearlevel','$Semester')";
            if(!mysqli_query($connection,$save5)){
                 echo '<script>alert("Successfully Submit..")</script>';
                 header("location: student-grade-input.php");
            }else{
                 echo '<script>alert("Their is a Problem on your submission. Please Check...")</script>';
                 header("location: student-grade-input.php");
            }
        }
        //input subject 6
        if($sub6 != "0" && $grade6 != "0" && $studid && $collegeid && $courseid && $yearlevel && $Semester){
            $save6 = "INSERT INTO tblstudent_sub_grades (subject_id,grades,student_id,college_id_fk,course_id_fk,yearlevel,semester) VALUES ('$sub6','$grade6','$studid','$collegeid','$courseid','$yearlevel','$Semester')";
            if(mysqli_query($connection,$save6)){
                 echo '<script>alert("Successfully Submit..")</script>';
                 header("location: student-grade-input.php");
            }else{
                 echo '<script>alert("Their is a Problem on your submission. Please Check...")</script>';
                 header("location: student-grade-input.php");
            }
        }if($sub6 == "0" && $grade6 == "0" && $studid == "" && $collegeid == "" && $courseid == "" && $yearlevel == "" && $Semester== ""){
             $save6 = "INSERT INTO tblstudent_sub_grades (subject_id,grades,student_id,college_id_fk,course_id_fk,yearlevel,semester) VALUES ('$sub6','$grade6','$studid','$collegeid','$courseid','$yearlevel','$Semester')";
            if(!mysqli_query($connection,$save6)){
                 echo '<script>alert("Successfully Submit..")</script>';
                 header("location: student-grade-input.php");
            }else{
                 echo '<script>alert("Their is a Problem on your submission. Please Check...")</script>';
                 header("location: student-grade-input.php");
            }
        }
        //input subject 7
        if($sub7 != "0" && $grade7 != "0" && $studid && $collegeid && $courseid && $yearlevel && $Semester){
            $save7 = "INSERT INTO tblstudent_sub_grades (subject_id,grades,student_id,college_id_fk,course_id_fk,yearlevel,semester) VALUES ('$sub7','$grade7','$studid','$collegeid','$courseid','$yearlevel','$Semester')";
            if(mysqli_query($connection,$save7)){
                 echo '<script>alert("Successfully Submit..")</script>';
                 header("location: student-grade-input.php");
            }else{
                 echo '<script>alert("Their is a Problem on your submission. Please Check...")</script>';
                 header("location: student-grade-input.php");
            }
        }if($sub7 == "0" && $grade7 == "0" && $studid == "" && $collegeid == "" && $courseid == "" && $yearlevel == "" && $Semester== ""){
             $save7 = "INSERT INTO tblstudent_sub_grades (subject_id,grades,student_id,college_id_fk,course_id_fk,yearlevel,semester) VALUES ('$sub7','$grade7','$studid','$collegeid','$courseid','$yearlevel','$Semester')";
            if(!mysqli_query($connection,$save7)){
                 echo '<script>alert("Successfully Submit..")</script>';
                 header("location: student-grade-input.php");
            }else{
                 echo '<script>alert("Their is a Problem on your submission. Please Check...")</script>';
                 header("location: student-grade-input.php");
            }
        }
        //input subject 8
        if($sub8 != "0" && $grade8 != "0" && $studid && $collegeid && $courseid && $yearlevel && $Semester){
            $save8 = "INSERT INTO tblstudent_sub_grades (subject_id,grades,student_id,college_id_fk,course_id_fk,yearlevel,semester) VALUES ('$sub8','$grade8','$studid','$collegeid','$courseid','$yearlevel','$Semester')";
            if(mysqli_query($connection,$save8)){
                 echo '<script>alert("Successfully Submit..")</script>';
                 header("location: student-grade-input.php");
            }else{
                 echo '<script>alert("Their is a Problem on your submission. Please Check...")</script>';
                 header("location: student-grade-input.php");
            }
        }if($sub8 == "0" && $grade8 == "0" && $studid == "" && $collegeid == "" && $courseid == "" && $yearlevel == "" && $Semester== ""){
             $save8 = "INSERT INTO tblstudent_sub_grades (subject_id,grades,student_id,college_id_fk,course_id_fk,yearlevel,semester) VALUES ('$sub8','$grade8','$studid','$collegeid','$courseid','$yearlevel','$Semester')";
            if(!mysqli_query($connection,$save8)){
                 echo '<script>alert("Successfully Submit..")</script>';
                 header("location: student-grade-input.php");
            }else{
                 echo '<script>alert("Their is a Problem on your submission. Please Check...")</script>';
                 header("location: student-grade-input.php");
            }
        }
    }
    
    if(isset($_POST['send_grades']))
    {
        $subs = mysqli_real_escape_string($connection,$_POST['s']);
        $sub2 = mysqli_real_escape_string($connection,$_POST['su']);
        $sub3 = mysqli_real_escape_string($connection,$_POST['sub']);
        $sub4 = mysqli_real_escape_string($connection,$_POST['subj']);
        $sub5 = mysqli_real_escape_string($connection,$_POST['subje']);
        $sub6 = mysqli_real_escape_string($connection,$_POST['subjec']);
        $sub7 = mysqli_real_escape_string($connection,$_POST['subject']);
        $sub8 = mysqli_real_escape_string($connection,$_POST['subjects']);
        
        $grades = mysqli_real_escape_string($connection,$_POST['g']); 
        $grade2 = mysqli_real_escape_string($connection,$_POST['gr']);
        $grade3 = mysqli_real_escape_string($connection,$_POST['gra']);
        $grade4 = mysqli_real_escape_string($connection,$_POST['grad']);
        $grade5 = mysqli_real_escape_string($connection,$_POST['grade']);
        $grade6 = mysqli_real_escape_string($connection,$_POST['grades']);
        $grade7 = mysqli_real_escape_string($connection,$_POST['gradess']);
        $grade8 = mysqli_real_escape_string($connection,$_POST['gradesss']);
        
        $Semester = mysqli_real_escape_string($connection,$_POST['semester']);
        
        $collegeid = $_SESSION['college_id_fk'];
        $courseid = $_SESSION['course_id_fk'];
        $yearlevel = $_SESSION['yearlevel'];
        $currid = $_SESSION['curr_id'];
        $email = $_SESSION['email'];
        
        $getstudid = mysqli_query($connection,"SELECT * FROM tbluser WHERE email='$email'");
        
        while($fa = mysqli_fetch_array($getstudid))
        {
            $studid = $fa['id'];
        }
        
        $getsub = mysqli_query($connection,"SELECT * FROM tblsubject WHERE id='$subs'");
            while($fa = mysqli_query($getsub))
            {
                $getsubcode = $fa['subject_code'];
                $getprereq = $fa['prerequisite'];
            }
            
            
            
        if($subs && $grades == '1.0' && $getprereq = "NONE"){
                $grades_stat="Passed";
                $getcodep = "NONE";
        }    
        if($subs && $grades == '1.25' && $getprereq = "NONE"){
                $grades_stat="Passed";
                
        }
        if($subs && $grades == '1.50' && $getprereq = "NONE"){
                $grades_stat="Passed";
                
        }
        if($subs && $grades == '1.75' && $getprereq = "NONE"){
                $grades_stat="Passed";
                
        }
        if($subs && $grades == '2.0' && $getprereq = "NONE"){
                $grades_stat="Passed";
                
        }
        if($subs && $grades == '2.25' && $getprereq = "NONE"){
                $grades_stat="Passed";
                
        }
        if($subs && $grades == '2.50' && $getprereq = "NONE"){
                $grades_stat="Passed";
                
        }
        if($subs && $grades == '2.75' && $getprereq = "NONE"){
                $grades_stat="Passed";
        }
        if($subs && $grades == '3.0' && $getprereq = "NONE"){
                $grades_stat="Passed";
                
        }
        if($subs && $grades == '5.0' && $getprereq = "NONE"){
                $grades_stat="Failed";
                
        }
        if($subs && $grades == 'INC' && $getprereq = "NONE"){
                $grades_stat="INC";
                
        }
        if($subs && $grades == 'DROP' && $getprereq = "NONE"){
                $grades_stat="DROP";
                
        }
        if($subs && $grades == 'DG' && $getprereq = "NONE"){
                $grades_stat="DG";
                
        }
        //prereq
        if($subs && $grades == '1.0' && $getprereq = "HAVE"){
                $grades_stat="Passed";
                $preq = mysqli_query($connection,"SELECT * FROM tblprereq subject_code='$getsubcode'");
                while($sa = mysqli_fetch_array($preq))
                {
                    $getsubidc = $sa['id'];
                    $getcode = $sa['subjectcode'];
                    $getunder = $sa['subject_under'];
                }
            $getcodep = $getunder;
        }    
        if($subs && $grades == '1.25' && $getprereq = "HAVE"){
                $grades_stat="Passed";
                
        }
        if($subs && $grades == '1.50' && $getprereq = "HAVE"){
                $grades_stat="Passed";
                 
        }
        if($subs && $grades == '1.75' && $getprereq = "HAVE"){
                $grades_stat="Passed";
                 
        }
        if($subs && $grades == '2.0' && $getprereq = "HAVE"){
                $grades_stat="Passed";
                 
        }
        if($subs && $grades == '2.25' && $getprereq = "HAVE"){
                $grades_stat="Passed";
        }
        if($subs && $grades == '2.50' && $getprereq = "HAVE"){
                $grades_stat="Passed";
                 
        }
        if($subs && $grades == '2.75' && $getprereq = "HAVE"){
                $grades_stat="Passed";
                
        }
        if($subs && $grades == '3.0' && $getprereq = "HAVE"){
                $grades_stat="Passed";
        }
        if($subs && $grades == '5.0' && $getprereq = "HAVE"){
                $grades_stat="Failed";
                 
        }
        if($subs && $grades == 'INC' && $getprereq = "HAVE"){
                $grades_stat="INC";
                 
        }
        if($subs && $grades == 'DROP' && $getprereq = "HAVE"){
                $grades_stat="DROP";
                
        }
        if($subs && $grades == 'DG' && $getprereq = "HAVE"){
                $grades_stat="DG";
                 
        }
            $auto = "INSERT INTO `tblstudent_generate_sub` (subject_id,grades,prerequisite,grade_status) VALUES ('$subs','$grades','$getcodep','$grades_stat')";
                
            if(mysqli_query($connection,$auto)){
                echo '<script>alert("Successfully Submit..")</script>';
                header("location: student-grade-input.php");
            }else{
                echo '<script>alert("Their is a Problem on your submission. Please Check...")</script>';
                header("location: student-grade-input.php");
            }
    }
    
?>