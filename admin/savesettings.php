<?php

include "config.php";

if(empty($_FILES['logo']['name'])){
$file_name = $_POST['old_logo'];

}else{

    $error = array();

    $file_name = $_FILES['logo']['name'];
    $file_size = $_FILES['logo']['size'];

    $file_tmp = $_FILES['logo']['tmp_name'];
    $file_type = $_FILES['logo']['type'];
   $exp = explode('.',$file_name);

   $file_ext = end($exp);


    //$file_ext = strtolower(end(explode('.',$file_name)));
    $extension = array("jpeg","jpg","png");

    if(in_array($file_ext,$extension) === false )
    {
        $error[] = "This is not extension please choose jpeg,jpg,png";
    }

    if($file_size > 2097152){

        $error[] = "FIle Size must be 2MB";
    }
    if(empty($error) == true){

        move_uploaded_file($file_tmp,"images/".$file_name);
    }else{

        print_r($error);
        die();
    }

}


$sql = "UPDATE settings SET websitename='{$_POST["website_name"]}', logo='{$file_name}',footerdesc='{$_POST["footer_desc"]}'";

$result = mysqli_query($conn, $sql);

if($result){

    header("location: {$hostname}/admin/setting.php");
}else{

    echo "Query Failed";
}

?>