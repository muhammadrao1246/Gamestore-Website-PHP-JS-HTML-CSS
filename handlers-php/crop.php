<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/practice/root-styles/crop.css">
    <title>Crop Tool</title>

</head>
<body style="margin: 0;">





<div class="cropping-container" >

    <div class="cropper">
        <div class="loader-1">
            <span>Loading</span>
            <span class="rotate-animation">⟲</span>
        </div>
        <img src="" alt="" class="target" draggable="false">
        <div draggable="false" class="resizable border-animation"></div>
    </div>

    <div class="processed">
        
        <input type="file" id="upload">
        
        <h4>Cropped Image !</h4>
        
        <div class="cropper" style="overflow: hidden;width: 162px;height: 162px;align-items: unset;">
            <div class="loader-1 loader-2">
                <span>Loading</span>
                <span class="rotate-animation">⟲</span>
            </div>
            <img src=""  alt="" class="target cropped_picture_container">
            <div class="cropped-image " id="capture"></div>
        </div>
        
        <div class="movement-handlers">
            <button id="left" class="button">
                <div class="left">
                    ➜
                </div>
            </button>
            <div class="up-down">
                <button id="up" class="button">
                    <div class="up">➜</div>
                </button>
                <button id="down" class="button">
                    <div class="down">➜</div>
                </button>   
            </div>
            <button id="right" class="button">➜</button>
        </div>
    </div>
</div>

</body>
</html>