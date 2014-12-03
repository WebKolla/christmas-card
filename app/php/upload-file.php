<?php
    $allowedExts = array("gif", "jpeg", "jpg", "png");
    $temp = explode(".", $_FILES["file"]["name"]);
    $extension = end($temp);
    if ((($_FILES["file"]["type"] == "image/gif")
            || ($_FILES["file"]["type"] == "image/jpeg")
            || ($_FILES["file"]["type"] == "image/jpg")
            || ($_FILES["file"]["type"] == "image/pjpeg")
            || ($_FILES["file"]["type"] == "image/x-png")
            || ($_FILES["file"]["type"] == "image/png"))
        && ($_FILES["file"]["size"] < 2048000)
        && in_array($extension, $allowedExts)) {

        if ($_FILES["file"]["error"] > 0) {
            error_log($_FILES["file"]["error"]);
        } else {
            $date = new DateTime();
            $timeStamp = $date->getTimestamp();
            $uploadFolder = "../lv-elf-images/lv-usr-uploads/";
            $fullPath = "lv-elf-images/lv-usr-uploads/";
            $filename = $timeStamp.$_FILES["file"]["name"];

            if (file_exists($uploadFolder.$filename)) {
                error_log($filename."already exists");
            } else {
                move_uploaded_file($_FILES["file"]["tmp_name"], $uploadFolder.$filename);
                echo $fullPath.$filename;
            }
        }
    }else{
        echo "Invalid file";
    }
?>