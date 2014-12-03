<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test</title>
</head>
<body>
<button id="crop"> Crop </button> <br />
<img id="resize-image" src="lv-elf-images/300.jpeg" />
<img id="elf" src="lv-elf-images/600.jpeg" />
<canvas id="canvas_id" width="600" height="600"></canvas>
<img id="finalImg" src="" /> <br />

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#crop").on("click", function () {
            var crop_canvas = document.getElementById("canvas_id"),
                topImg = document.getElementById("resize-image"),
                bottomImg = document.getElementById("elf");

            var ctx = crop_canvas.getContext('2d');
            ctx.drawImage(topImg, 0, 0);
            //ctx.globalAlpha = 1;
            ctx.globalCompositeOperation = 'source-in';

            ctx.drawImage(bottomImg, 0, 0);

            $("#finalImg").attr("src",crop_canvas.toDataURL("image/png"));

        });
    });
</script>
</body>
</html>