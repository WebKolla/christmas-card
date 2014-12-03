<?php

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

            }

        } else {
            echo $message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['photo']['error'];
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LV= - Christmas Card - #Elfie</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <!-- jCrop styles -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-jcrop/0.9.12/css/jquery.Jcrop.min.css"/>
    <!-- App styles -->
    <link rel="stylesheet" href="css/styles.css"/>
    <link rel="stylesheet" href="css/component.css"/>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <form action="resize.php" id="uploadUserPic" method="post" role="form" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="file" name="photo" size="25" id="fileUpload" />
                    <button type="submit" class="btn btn-success">Upload</button>
                </div>
            </form>
            <button class="btn  btn-sucsess js-crop" id="btnCrop">Merge</button>
        </div>
        <div class="col-md-12">
            <div class="component">
                <div class="overlay">
                    <img src="lv-elf-images/elf.png" id="elf" />
                </div>
                <div class="row">
                    <?php
                    if($isPost) {
                        echo $userImg;
                    }
                    ?>
                </div>

            </div>
            <div class="row">
                <img id="finalImg" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <canvas id="canvas" width="557" height="997"></canvas>
        </div>
    </div>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="js/component.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        if($("body").find("#cropbox").length > 0){
            resizeableImage($('#cropbox'));
        }
    });
</script>
</body>
</html>