<?php
include "handlers/connect.php";
include "handlers/game_data.php";
include "handlers/date_approx.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gamology</title>
    <link rel="stylesheet" type="text/css" href="root-styles/style.css" />
    <link rel="stylesheet" type="text/css" href="pages/games/post/post-styles.css" />
    <link rel="stylesheet" type="text/css" href="root-styles/login-signup-styles.css" />

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include "handlers/header.php";
    ?>

    <div class="section">
        <?php
        include "handlers/breadcrumb.php";
        ?>
        <div class="post-container">

            <form action="signup.php" method="post" enctype="multipart/form-data" class="login-signup-container" style="row-gap: 0px;" onsubmit="validate();">
                <i class="icon">Gamology</i>
                <div class="form-input-container " style="margin-top: 15px;">
                    <div>
                        <h4 class="form-input-label modified-form-input-label">Username</h4>
                        <input id="uname" type="text" name="username" placeholder="Enter Username" title="please type username" pattern="([a-zA-Z0-9]+)" class="form-input-box">
                        <p id="p-uname"></p>
                    </div>
                    <div class="mark-container">
                        <i class="fas fa-check marker" id="i-uname"></i>
                    </div>
                </div>

                <div class="form-input-container ">
                    <div>
                        <h4 class="form-input-label modified-form-input-label">Email</h4>
                        <input id="mail" type="email" name="email" placeholder="Enter Email" title="please type email" pattern="(.{3,20}[@]{1}.{3,20}[.com]{4})" class="form-input-box">
                        <p id="p-mail"></p>
                    </div>
                    <div class="mark-container">
                        <i class="fas fa-check marker" id="i-mail"></i>
                    </div>
                </div>
                <div class="form-input-container ">
                    <div>
                        <h4 class="form-input-label modified-form-input-label">Profile Picture</h4>
                        <input id="img" type="file" name="profile" class="form-input-box" accept="image/*" multiple="multiple">
                        <p id="p-img"></p>
                    </div>
                    <div class="mark-container">
                        <i class="fas fa-check marker" id="i-img"></i>
                    </div>
                </div>
                <div class="form-input-container ">
                    <div>
                        <h4 class="form-input-label modified-form-input-label">New Password</h4>
                        <input id="npass" type="password" placeholder="Enter New Password" title="password must be 8 to 20 characters long" class="form-input-box" pattern="([a-zA-Z0-9]{8,20})">
                        <p id="p-npass"></p>
                    </div>
                    <div class="mark-container">
                        <i class="fas fa-check marker" id="i-npass"></i>
                    </div>
                </div>
                <div class="form-input-container ">
                    <div>
                        <h4 class="form-input-label modified-form-input-label">Confirm Password</h4>
                        <input id="cpass" type="password" placeholder="Again Enter Password" title="password must be 8 to 20 characters long" class="form-input-box" pattern="([a-zA-Z0-9]{8,20})">
                        <p id="p-cpass"></p>
                    </div>
                    <div class="mark-container">
                        <i class="fas fa-check marker" id="i-cpass"></i>
                    </div>
                </div>
                <div>
                    <input type="submit" value="Sign Up" class="submit-button" style="margin:10px 0px;">
                </div>
            </form>

        </div>

    </div>

    <?php  ?>

    <script>
        //Class Declaration for tick & cross
        var tick = "fas fa-check marker marker-green";
        var cross = "fas fa-plus marker marker-red";

        //All Input References
        let input_names = ['uname', 'mail', 'img', 'npass', 'cpass'];

        window[input_names[0]] = document.getElementById(input_names[0]);
        window[input_names[1]] = document.getElementById(input_names[1]);
        window[input_names[2]] = document.getElementById(input_names[2]);
        window[input_names[3]] = document.getElementById(input_names[3]);
        window[input_names[4]] = document.getElementById(input_names[4]);
var hold;

        //Image Validations 
        var image_flag=0;
        var image_count=0;
        img.onchange = function()
        {
            var arr=img.files;
            hold=arr;
            for (const key in arr) 
            {
                myfunction(key,arr);
                if (image_flag==-1) 
                {
                    document.getElementById('i-' + input_names[2]).className = cross;
                    document.getElementById('i-' + input_names[2]).title = "Image Not Selected";
                    break;
                }
            }
        }

        function myfunction(index,image)
        { 
            let img_type=/(jpg|png|jpeg|ico)/i;
            if(!isNaN(index))
            {
                if (!!image[index])  
                {
                    if(img_type.test(image[index].type))
                    {
                        if (((image[index].size) / 1024) < 165) 
                        {
                            image_flag=1;
                            document.getElementById('p-' + input_names[2]).innerText = "";
                            document.getElementById('i-' + input_names[2]).className = tick;
                            document.getElementById('i-' + input_names[2]).title = "Image Selected";
                        } 
                        else 
                        {
                            image_flag=-1;
                            document.getElementById('p-' + input_names[2]).innerText = "*Image size must be less than 2MB(2048KB)";
                            document.getElementById('i-' + input_names[2]).className = cross;
                            document.getElementById('i-' + input_names[2]).title = "Image Not Selected";
                        }
                    }
                    else
                    {
                        image_flag=-1;
                        document.getElementById('p-' + input_names[2]).innerText = "*Selected file must type of .png .jpg .jpeg .ico";
                        document.getElementById('i-' + input_names[2]).className = cross;
                        document.getElementById('i-' + input_names[2]).title = "Image Not Selected";
                    }
                } 
                else
                {
                    document.getElementById('p-' + input_names[2]).innerText = "";
                    document.getElementById('i-' + input_names[2]).className = "";
                    document.getElementById('i-' + input_names[2]).title = "";
                }
            }
            if (image.length==0) 
            {
                image_flag=image_count=0;
                document.getElementById('p-' + input_names[2]).innerText = "";
                document.getElementById('i-' + input_names[2]).className = "";
                document.getElementById('i-' + input_names[2]).title = "";   
            }
        }

        //Password Validation
        npass.onkeyup = function() {

        }

        function validate() {

            // username must have atleast 1 numbers and 4 letters 
            var username_regex1 = /.{0,}[a-zA-Z]{1,}.{0,}[a-zA-Z]{1,}.{0,}[a-zA-Z]{1,}.{0,}[a-zA-Z]{1,}.{0,}/g;
            var username_regex2 = /[0-9]{1,}/;

            // /((^[a-zA-Z]{0,}[0-9]{1,}[a-zA-Z0-9]{0,}@gmail.com))/g.exec('muhammadrao1246@gmail.com')
            //|(^.{0,}[a-zA-Z]{3,}.{0,}@gmail.com$)
            var email_regex1 = /((^[a-zA-Z0-9]{0,}[0-9]{1,}[a-zA-Z0-9]{0,}@gmail.com$))/g; //for to have atleast 1 number
            var email_regex2 = /(^.{0,}[a-zA-Z]{1,}.{0,}[a-zA-Z]{1,}.{0,}[a-zA-Z]{1,}.{0,}@gmail.com$)/g; //for to have atleast 3 characters

            if (image.files[0].size > 0) {

            }
        }
        //window.onload.validate();






        //Event Listeners For Page Icon
        document.getElementById("games-section").onmouseover = function() {

            document.getElementsByClassName('icon')[0].style.visibility = "hidden";
        };

        document.getElementById("games-section").onmouseout = function() {
            document.getElementsByClassName('icon')[0].style.visibility = "visible";
        };
    </script>
</body>

</html>