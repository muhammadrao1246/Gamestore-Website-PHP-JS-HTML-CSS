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
    <link rel="stylesheet" type="text/css" href="root-styles/password-animation.css" />
    
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

            <form action="post.php" method="post" enctype="multipart/form-data" class="login-signup-container" style="row-gap: 0px;" onsubmit=" return validate_all();">
                <i class="icon">Gamology</i>
                <div class="form-input-container " style="margin-top: 15px;">
                    <div>
                        <h4 class="form-input-label modified-form-input-label">Username</h4>
                        <input id="uname" type="text" name="username" placeholder="abc12" title="please type username" pattern="([a-zA-Z0-9]+)" class="form-input-box">
                        <p id="p-uname"></p>
                    </div>
                    <div class="mark-container">
                        <i class="fas fa-check marker" id="i-uname"></i>
                    </div>
                </div>

                <div class="form-input-container ">
                    <div>
                        <h4 class="form-input-label modified-form-input-label">Email</h4>
                        <input id="mail" type="email" name="email" placeholder="abc1@[domain123].com" title="please type email" pattern="(.{3,20}[@]{1}.{3,20}[.com]{4})" class="form-input-box" />
                        <p id="p-mail"></p>
                    </div>
                    <div class="mark-container">
                        <i class="fas fa-check marker" id="i-mail"></i>
                    </div>
                </div>
                <div class="form-input-container ">
                    <div>
                        <h4 class="form-input-label modified-form-input-label">Profile Picture</h4>
                        <input id="img" type="file" name="profile" class="form-input-box" accept="image/*" multiple="multiple" />
                        <p id="p-img"></p>
                    </div>
                    <div class="mark-container">
                        <i class="fas fa-check marker" id="i-img"></i>
                    </div>
                </div>
                <div class="form-input-container ">
                    <div>
                        <h4 class="form-input-label modified-form-input-label">New Password</h4>
                        <input id="npass" type="password" placeholder="john_doe1234" title="password must be 8 or more characters long" class="form-input-box" />
                        <p id="p-npass"></p>
                        <?php
                            include "handlers/password-animation.php";
                        ?>
                    </div>
                    <div class="mark-container">
                        <i class="fas fa-check marker" id="i-npass"></i>
                    </div>
                </div>
                <div class="form-input-container " style="margin-top: 15px;">
                    <div>
                        <h4 class="form-input-label modified-form-input-label">Confirm Password</h4>
                        <input id="cpass" type="password" placeholder="Again Enter Password" title="password must be 8 or more characters long" class="form-input-box" />
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
        
        //Image Validations Robust Algorithm
        var image_flag=0;
        var image_count=0;
        img.onchange = () => { validate_images(); };
        function validate_images()
        {
            var arr=img.files;
            image_flag=0;
            for (const key in arr) 
            {
                image_validate(key,arr);
                if (image_flag==-1) 
                {
                   break;
                }
            }
        }

        function image_validate(index,image)
        { 
            let img_type=/(jpg|png|jpeg|ico)/i;
            if(!isNaN(index))
            {
                if (!!image[index])  
                {
                    if(img_type.test(image[index].type))
                    {
                        if (((image[index].size) / 1024) < 2048) 
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
                image_count=0;
                image_flag=-1;
                document.getElementById('p-' + input_names[2]).innerText = "*Profile Picture Is Required";
                document.getElementById('i-' + input_names[2]).className = cross;
                document.getElementById('i-' + input_names[2]).title = "Image Not Selected";  
            }
        }
        
        //Password Validation
        var password_flag=0;
        var weak    =['bar weak-half-animation'   ,  'bar weak-full-animation'];
        var good    =['bar good-half-animation'   ,  'bar good-full-animation'];
        var strong  =['bar strong-half-animation' ,'bar strong-full-animation'];
        let animation_container = document.getElementsByClassName('flex');

        // npass.addEventListener("change",password_validate);
        npass.addEventListener("blur",password_validate);

        var password_accepted = function () 
        {
                password_flag=1;
                document.getElementById('p-' + input_names[3]).innerText = "";
                document.getElementById('i-' + input_names[3]).className = tick;
                document.getElementById('i-' + input_names[3]).title= "Password Accepted!";   
        }
        
        var password_anmimation = (weak_animation = "bar",good_animation = "bar",strong_animation = "bar") => 
        {
            animation_container[0].children[0].children[1].className = weak_animation;
            animation_container[0].children[1].children[1].className = good_animation;
            animation_container[0].children[2].children[1].className = strong_animation;
        } 
        
        function password_validate() 
        {
            var password_regex1=/[a-zA-Z]{1,}/;//must include one letter
            var password_regex2=/[0-9]{1,}/;
            var password_regex3=/[~!@#$%^&*()_{}`"|'/.<>,\?\]\[+=]{1,}/;
            
            if (npass.value) 
            {
                if(password_regex1.test(npass.value) && password_regex2.test(npass.value) && password_regex3.test(npass.value))
                {
                    if (npass.value.length == 8) 
                    {
                        password_accepted();
                        password_anmimation(weak[1],"bar","bar");                    
                    }
                    else if(npass.value.length > 8 && npass.value.length < 16)
                    {
                        password_accepted();
                        password_anmimation(weak[1],good[0],"bar");
                    }
                    else if(npass.value.length == 16)
                    {
                        password_accepted();
                        password_anmimation(weak[1],good[1],"bar");
                    }
                    else if(npass.value.length > 16 && npass.value.length < 32)
                    {
                        password_accepted();
                        password_anmimation(weak[1],good[1],strong[0]);
                    }
                    else if(npass.value.length >= 32)
                    {
                        password_accepted();
                        password_anmimation(weak[1],good[1],strong[1]);
                    }
                    else
                    {
                        password_flag=0;
                        password_anmimation(weak[0],"bar","bar");
                        document.getElementById('p-' + input_names[3]).innerText = "*Password must be 8 or more characters long";
                        document.getElementById('i-' + input_names[3]).className = cross;
                        document.getElementById('i-' + input_names[3]).title = "Password Not Accepted";
                    }
                }
                else
                {
                    password_flag=0;
                    password_anmimation();
                    document.getElementById('p-' + input_names[3]).innerText = "*Please use mix of letters, numbers & symbols";
                    document.getElementById('i-' + input_names[3]).className = cross;
                    document.getElementById('i-' + input_names[3]).title = "Password Not Accepted";
                }
            }
            else
            {
                password_flag=0;
                password_anmimation();
                document.getElementById('p-' + input_names[3]).innerText = "*Password Required";
                document.getElementById('i-' + input_names[3]).className = cross;
                document.getElementById('i-' + input_names[3]).title = "Password Not Accepted";
            }
        }


        //Confirming Password
        cpass.addEventListener("blur",confirm_password);
        npass.addEventListener("change",confirm_password);

        var password_equals_flag=0;
        function confirm_password() 
        {
             if(npass.value && password_flag==1)
             {
                if (cpass.value) 
                {
                    if(npass.value == cpass.value)
                    {
                        password_equals_flag=1;
                        document.getElementById('p-' + input_names[4]).innerText = "";
                        document.getElementById('i-' + input_names[4]).className = tick;
                        document.getElementById('i-' + input_names[4]).title= "Password Accepted!";                        
                    }
                    else
                    {
                        password_equals_flag=0;
                        document.getElementById('p-' + input_names[4]).innerText = "*This password not equal to new password";
                        document.getElementById('i-' + input_names[4]).className = cross;
                        document.getElementById('i-' + input_names[4]).title = "Password Not Accepted";
                    }
                }
                else
                {
                    password_equals_flag=0;
                    document.getElementById('p-' + input_names[4]).innerText = "*Password Confirmation Required";
                    document.getElementById('i-' + input_names[4]).className = cross;
                    document.getElementById('i-' + input_names[4]).title = "Password Not Accepted";
                }
             }  
             else
             {
                password_equals_flag=0;
                document.getElementById('p-' + input_names[4]).innerText = "*Please First Fill The New Password Field";
                document.getElementById('i-' + input_names[4]).className = cross;
                document.getElementById('i-' + input_names[4]).title = "Password Not Accepted";
             }
        }

        //username validation
        username_flag = 0;
        uname.addEventListener('blur',username_validate);

        function username_validate() 
        {
            // username must have atleast 1 numbers and 4 letters 
            var username_regex1 = /[a-zA-Z]{1,}/g;
            var username_regex2 = /[0-9]{1,}/;

            if(uname.value)
            {
                if(username_regex1.test(uname.value) && username_regex2.test(uname.value))
                {
                    if(uname.value.length >= 5)
                    {
                        username_flag = 1;
                        document.getElementById('p-' + input_names[0]).innerText = "";
                        document.getElementById('i-' + input_names[0]).className = tick;
                        document.getElementById('i-' + input_names[0]).title = "Username Accepted";
                    }
                    else
                    {
                        username_flag=0;
                        document.getElementById('p-' + input_names[0]).innerText = "*Username must be 5 or more characters long";
                        document.getElementById('i-' + input_names[0]).className = cross;
                        document.getElementById('i-' + input_names[0]).title = "Username Not Accepted";
                    }
                }
                else
                {
                    username_flag=0;
                    document.getElementById('p-' + input_names[0]).innerText = "*Username must include numbers and letters";
                    document.getElementById('i-' + input_names[0]).className = cross;
                    document.getElementById('i-' + input_names[0]).title = "Username Not Accepted";
                }
            }
            else
            {
                username_flag=0;
                document.getElementById('p-' + input_names[0]).innerText = "*Username Required";
                document.getElementById('i-' + input_names[0]).className = cross;
                document.getElementById('i-' + input_names[0]).title = "Username Not Accepted";
            }
        }

        //Email Vaildation
        email_flag = 0;

        mail.addEventListener('blur',email_validate);

        function email_validate() 
        {
            // /((^[a-zA-Z]{0,}[0-9]{1,}[a-zA-Z0-9]{0,}@gmail.com))/g.exec('muhammadrao1246@gmail.com')
            //|(^.{0,}[a-zA-Z]{3,}.{0,}@gmail.com$)
            var email_regex1 = /(^[a-zA-Z0-9]{0,}[0-9]{1,}[a-zA-Z0-9]{0,})/g; //for to have atleast 1 number
            var email_regex2 = /(^.{0,}[a-zA-Z]{1,}.{0,}[a-zA-Z]{1,}.{0,}[a-zA-Z]{1,}.{0,})/g; //for to have atleast 3 characters
            var email_regex3 = /(@.{1,}.com$)/g;

            if (mail.value) 
            {
                if ( email_regex1.test(mail.value) && email_regex2.test(mail.value) ) 
                {
                    if ( email_regex3.test(mail.value) ) 
                    {
                        email_flag=1;
                        document.getElementById('p-' + input_names[1]).innerText = "";
                        document.getElementById('i-' + input_names[1]).className = tick;
                        document.getElementById('i-' + input_names[1]).title = "Email Accepted";                         
                    } 
                    else 
                    {
                        email_flag=0;
                        document.getElementById('p-' + input_names[1]).innerText = "*Email must end with '@[domain].com'";
                        document.getElementById('i-' + input_names[1]).className = cross;
                        document.getElementById('i-' + input_names[1]).title = "Email Not Accepted";                         
                    }                   
                } 
                else 
                {
                    email_flag=0;
                    document.getElementById('p-' + input_names[1]).innerText = "*Email must contain atleast 3 letters and 1 number";
                    document.getElementById('i-' + input_names[1]).className = cross;
                    document.getElementById('i-' + input_names[1]).title = "Email Not Accepted";                    
                }
            } 
            else 
            {
                email_flag=0;
                document.getElementById('p-' + input_names[1]).innerText = "*Email Required";
                document.getElementById('i-' + input_names[1]).className = cross;
                document.getElementById('i-' + input_names[1]).title = "Email Not Accepted";                
            }
        }
        


        function validate_all() 
        {
            if (email_flag == username_flag == image_flag == password_equals_flag == password_flag == 1) 
            {
                return true;    
            } 
            else 
            {
                //run all self validation functions to validate all form at once
                validate_images  ();
                password_validate();
                confirm_password ();
                username_validate();
                email_validate   ();

                return false;
            }
            
        }


        //Event Listeners For Page Icon
        document.getElementById("games-section").onmouseover = function() 
        {

            document.getElementsByClassName('icon')[0].style.visibility = "hidden";
        };

        document.getElementById("games-section").onmouseout = function() 
        {
            document.getElementsByClassName('icon')[0].style.visibility = "visible";
        };
    </script>
</body>

</html>