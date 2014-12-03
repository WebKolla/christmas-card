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
            <form  id="uploadUserPic" method="post" role="form" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="file" name="file" size="25" id="fileUpload" />
                    <button type="submit" class="btn btn-success" id="upload">Upload</button>
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
                    <img src=""  class="resize-image"  id="cropbox" />
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
        $('#upload').on('click', function(e) {
            e.preventDefault();
            var file_data = $('#fileUpload').prop('files')[0];
            var form_data = new FormData();
            form_data.append('file', file_data);
            $.ajax({
                url: 'php/upload-file.php',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'POST',
                enctype: 'multipart/form-data',
                success: function(data){
                    $("#cropbox").attr("src", data);
                    resizeableImage($('#cropbox'));
                }
            });
        });
    });
</script>
</body>
</html>