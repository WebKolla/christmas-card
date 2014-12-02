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
            <form action="resize.php" method="post" role="form" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="file" name="photo" size="25" />
                    <button type="submit" class="btn btn-success">Upload</button>
                </div>
            </form>
            <button class="btn  btn-sucsess js-crop" id="btnCrop">Merge</button>
        </div>
        <div class="col-md-12">
            <div class="component">
                <div class="overlay">
                    <img src="lv-elf-images/elf.png" class="img-responsive" id="elf" alt=""/>
                </div>
                <?php
                    if($isPost) {
                        echo $userImg;
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <canvas id="canvas"></canvas>
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
            resizeableImage($('.resize-image'));
        }

/*       $("#btnCrop").on("click", function(){

           var img1 = document.getElementById('elf');
           var img2 = document.getElementById('cropbox');
           var canvas = document.getElementById("canvas");
           var context = canvas.getContext("2d");

           var width = img1.width;
           var height = img1.height;
           canvas.width = width;
           canvas.height = height;


           var pixels = 4 * width * height;
           context.drawImage(img1, 0, 0);
           var image1 = context.getImageData(0, 0, width, height);
           var imageData1 = image1.data;
           context.drawImage(img2, 200, 10);
           var image2 = context.getImageData(0, 0, width, height);
           var imageData2 = image2.data;
           while (pixels--) {
               imageData1[pixels] = imageData1[pixels] * 1 + imageData2[pixels] * 1;
           }
           image1.data = imageData1;
           context.putImageData(image1, 0, 0);
           $(img1).hide();
           $(img2).hide();
       });*/
    });
</script>
</body>
</html>