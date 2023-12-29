<?php
    $target_dir="Foto/";
    $target_file_name=$target_dir.basename($_FILES['file']['name']);
    $response=array();

    if (isset($_FILES['file'])){
        if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file_name)){
            $success=true;
            $message='Success Upload';
        }else{
            $success=false;
            $message='Error While Uploading';
        }
    }else{
        $success=false;
        $message="Required File Missing";
    }
    $response['success']=$success;
    $response['message']=$message;
?>