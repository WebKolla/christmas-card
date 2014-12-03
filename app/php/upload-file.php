<?php
session_start();

$valid_file;
$isPost;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $isPost = true;
    if ($_FILES['photo']['name']) {
        $date = new DateTime();
        $timeStamp = $date->getTimestamp();
        if (!$_FILES['photo']['error']) {

            $extension = end(explode(".", $_FILES["photo"]["name"]));
            $allowedExts = array("gif", "jpeg", "jpg", "png");
            $new_file_name = strtolower($_FILES['photo']["name"]).$timeStamp.".".$extension;
            $uploadFolder = 'lv-elf-images/lv-usr-uploads/';

            if ((($_FILES["file"]["type"] == "image/gif")
                    || ($_FILES["file"]["type"] == "image/jpeg")
                    || ($_FILES["file"]["type"] == "image/jpg")
                    || ($_FILES["file"]["type"] == "image/jpeg")
                    || ($_FILES["file"]["type"] == "image/x-png")
                    || ($_FILES["file"]["type"] == "image/png"))
                && ($_FILES["file"]["size"] < 2048000)
                && in_array($extension, $allowedExts)
            ) {
                $valid_file = false;
            } else {
                $valid_file = true;
                $fileNameWithPath = $uploadFolder.$new_file_name;
            }

            if ($valid_file) {
                move_uploaded_file($_FILES['photo']['tmp_name'],  $fileNameWithPath);
                $userImg = '<img src="'.$fileNameWithPath.'" class="resize-image"  id="cropbox" />';
                //echo $userImg;
                $_SESSION["img"] = $userImg;
            }

        } else {
            echo $message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['photo']['error'];
        }
    }
}

?>