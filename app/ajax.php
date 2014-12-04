<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LV= - Christmas Card - #Elfie</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <link href='http://fonts.googleapis.com/css?family=Shadows+Into+Light' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
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
<div class="container">
    <div class="row">
       <div class="col-md-6">
            <div class="component">
                <div class="overlay">
                    <img  src="lv-elf-images/elf.png" id="elf" class="img-responsive" />

                </div>
            </div>
           <img src=""  class="resize-image"  id="cropbox" />
       </div>
        <div class="col-md-6">
            <img id="finalImg" class="hide" />
        </div>
       <div class="col-md-6">
           <div class="col-md-12">
               <h1>'Tis the season to be jolly!</h1>
               <h3>Upload an image, resize and position your face until you are happy, Download you elfie and share it with your friends.</h3>
           </div>
           <div class="col-md-12 centered vertical-center">
               <form  id="uploadUserPic" method="post" role="form" enctype="multipart/form-data">
                   <div class="form-group">
                       <input type="file" name="file" size="25" id="fileUpload" />
                       <button type="submit" class="btn" id="upload">Upload</button>

                   </div>
               </form>
               <button class="btn  btn-sucsess js-crop" id="btnCrop">Download</button>
           </div>

       </div>
        <div class="row hide">
            <div class="col-md-12">
                <canvas id="canvas" width="557" height="997"></canvas>
            </div>
        </div>
    </div>
    <div class="row footer">
        <h4>Terms and conditions</h4>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eget nunc justo. In euismod purus in diam eleifend dictum. Nunc condimentum ut metus vitae finibus. Phasellus aliquam nunc eu eros dignissim consequat. Curabitur cursus neque in nunc egestas sodales. Vivamus hendrerit et libero non auctor. Vivamus vitae elit ante. Sed accumsan nisi in augue facilisis, id ultricies leo pellentesque. Fusce blandit, ante eu tempus sodales, est nisl porta justo, eget ultrices diam dui quis ligula. Nullam placerat mollis pulvinar. Etiam nec lectus pellentesque, ornare massa non, consequat ligula. Praesent faucibus, libero vitae ultricies tempus, metus ex auctor justo, et eleifend elit sapien sed nunc. Donec in dolor odio. Etiam luctus turpis id dignissim ultricies. Donec auctor nulla non magna convallis, sed venenatis felis placerat.
        </p>
    </div>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="js/component.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        if($("body").find("#downloadMe").length > 0){
            $("#downloadMe").click();
            $("#downloadMe").hide();
        };
        $("#btnCrop").hide();
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
                    $("#uploadUserPic").hide();
                    $("#btnCrop").show();
                }
            });

        });

    });
</script>
</body>
</html>