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
                $userImg = '<img src="'.$fileNameWithPath.'" class="img-responsive" id="cropbox" />';

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
        <div id="userImgContainer" style="max-width: 500px;">
            <?php
                if($isPost) {
                    echo $userImg;
                }
            ?>
        </div>
        <img src="lv-elf-images/elf.png" class="img-responsive" id="elf" alt=""/>
    </div>
    <div class="row">
        <form action="index.php" method="post" role="form" enctype="multipart/form-data">
            <div class="form-group">
                <input type="file" name="photo" size="25" />
                <button type="submit" class="btn btn-success">Upload</button>
            </div>
        </form>
    </div>
    <div class="row">
        <form action="" role="crop">
            <div class="form-group">
                <input type="hidden" id="x" name="x" />
                <input type="hidden" id="y" name="y" />
                <input type="hidden" id="w" name="w" />
                <input type="hidden" id="h" name="h" />
                <input type="button" id="cropBtn"  value="Crop" class="btn btn-info" />
            </div>
        </form>
    </div>
    <div id="finalImageContainer">
        <img src="<?php echo $finalImage; ?>"  alt=""/>
    </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<!-- jCrop JS -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-jcrop/0.9.12/js/jquery.Jcrop.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>

<script type="text/javascript">
    $(function(){
        $("#userImgContainer").draggable({
            start: function(event,ui){
              $("#elf").css("z-index","1000");
            },
            stop: function(event, ui){
                $('#cropbox').Jcrop({
                    aspectRatio: 1,
                    onSelect: updateCoords
                });
            }
        });

//        if($("body").find($("#cropbox")).length > 0){
//            if($("#cropbox").attr("src").length > 0){
//                var cssObj = {
//                    position:"absolute",
//                    top:"0"
//                };
//
//                $("#elf").css(cssObj);
//            }
//        }

        $("#cropBtn").on("click",function(){
            $.ajax()
        });

        function updateCoords(c){
            $('#x').val(c.x);
            $('#y').val(c.y);
            $('#w').val(c.w);
            $('#h').val(c.h);
        };
    });
</script>
<script src="//localhost:35729/livereload.js"></script>
</body>
</html>