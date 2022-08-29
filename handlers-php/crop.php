<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/practice/root-styles/crop.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Pacifico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Crop Tool</title>

</head>
<body style="margin: 0;">





<div class="cropping-container" >

    <div class="cropper from-left">
        <div class="loader-1">
            <span>Loading</span>
            <span class="rotate-animation">⟲</span>
        </div>
        <img src="" alt="" class="target" draggable="false">
        <div draggable="false" class="resizable border-animation"></div>
    </div>
    <div class="intro-container">
        <h3 class="intro-label">Instructions</h3>
        <ul type="circle">
            <li class="list">
                Use mouse <i class="material-icons">mouse</i> to drag cropped box.
            </li>
            <li class="list-space list">
                Use keyboard <i class="material-icons">keyboard</i> arrow keys to move.
            </li>
            <li class="list">
                Click on arrow buttons to move cropped box.
            </li>
        </ul>
    </div>
    <div class="processed">
        

        
        <h4 class="tool-label">Cropped Image !</h4>
        
        <div class="cropper from_right" style="overflow: hidden;width: 162px;height: 162px;align-items: unset;">
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