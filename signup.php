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
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="post-styles.css" />
    <link rel="stylesheet" type="text/css" href="login-signup-styles.css" />
    
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
            
            <form action="stop" method="post" enctype="multipart/form-data" class="login-signup-container"  style="row-gap: 0px;" onsubmit="validate();">
                <i class="icon">Gamology</i>
                <div>
                    <h4 class="form-input-label">Username</h4>
                    <input id="uname" type="text" name="username" placeholder="Enter Username" title="please type username" pattern="([a-zA-Z0-9]+)" class="form-input-box">
                    <p></p>
                </div>
                <div>
                    <h4 class="form-input-label">Email</h4>
                    <input id="mail" type="email" name="email" placeholder="Enter Email" title="please type email" pattern="(.{3,20}[@]{1}.{3,20}[.com]{4})" class="form-input-box">
                    <p></p>
                </div>
                <div>
                    <div>
                        <h4 class="form-input-label">Profile Picture</h4>
                        <input id="img" type="file" name="profile" class="form-input-box" accept="image/*">
                    </div>
                    <div>
                        <i class="fas fa-tick"></i>
                    </div>
                    
                    <p id="img-error"></p>
                </div>
                <div>
                    <h4 class="form-input-label">New Password</h4>
                    <input id="npass" type="password" placeholder="Enter New Password" title="password must be 8 to 20 characters long" class="form-input-box" pattern="([a-zA-Z0-9]{8,20})">
                    <p></p>
                </div>
                <div>
                    <h4 class="form-input-label">Confirm Password</h4>
                    <input id="cpass" type="password" placeholder="Again Enter Password" title="password must be 8 to 20 characters long" class="form-input-box" pattern="([a-zA-Z0-9]{8,20})">
                    <p></p>
                </div>
                <div>
                    <input type="submit" value="Sign Up" class="submit-button"  style="margin:10px 0px;">
                </div>
            </form>   

        </div>

    </div>

<?php  ?>

    <script>
        var image=document.getElementById('img');
    
        image.onchange=function(){
            
                if(((image.files[0].size)/1024) < 165)
                {
                    document.getElementById('img-error').innerText="";
                }
                else
                {
                    document.getElementById('img-error').innerText="*Image size must be less than 2MB(2048KB)";
                }
        }
       function validate() 
       {
            var uname=document.getElementById('uname').value;
            var username_pattern="";



            if(image.files[0].size > 0)
            {
            
            }
       }
    </script>
</body>
</html>