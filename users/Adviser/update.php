<?php
if(isset($_POST['but_update'])){
    if(isset($_POST['sub_list_id'])){
        foreach($_POST['sub_list_id'] as $updateid){
            echo $updateid;
            echo $name = $_POST['grades_'.$updateid];

            //$sql = "UPDATE tbladviser_presubject SET grades='$Grade' WHERE id=''";          
        }
        $alert = '<div class="alert alert-success" role="alert">Records successfully updated</div>';
    }
}
?>