<?php

$valid_file;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_FILES['photo']['name']) {
        $date = new DateTime();
        $timeStamp = $date->getTimestamp();
        if (!$_FILES['photo']['error']) {
            $extension = end(explode(".", $_FILES["photo"]["name"]));
            $allowedExts = array("gif", "jpeg", "jpg", "png");
            $new_file_name = strtolower($_FILES['photo']["name"]) . $timeStamp . "." . $extension; //rename file RIGHT

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
            }


            if ($valid_file) {
                move_uploaded_file($_FILES['photo']['tmp_name'], '../lv-elf-images/lv-usr-uploads/' . $new_file_name);
                echo $message = 'Congratulations!  Your file was accepted.';
            }

        } else {
            echo $message = 'Ooops!  Your upload triggered the following error:  ' . $_FILES['photo']['error'];
        }
    }
}

?> 