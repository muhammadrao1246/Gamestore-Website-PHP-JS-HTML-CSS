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
            <form action="stop" method="post" class="login-signup-container">
                <i class="icon">Gamology</i>
                <div>
                    <h4 class="form-input-label">Username</h4>
                    <input type="text" placeholder="Enter Username or Email" title="please type email or username" pattern="(([a-zA-Z0-9]+))|(.{3,20}[@]{1}.{3,20}[.com]{4})" class="form-input-box">
                </div>
                <div>
                    <h4 class="form-input-label">Password</h4>
                    <input type="password" placeholder="Enter Your Password" title="password must be 8 to 20 characters long" class="form-input-box" pattern="([a-zA-Z0-9]{8,20})">
                </div>
                <div>
                    <input type="submit" value="Login" class="submit-button">
                </div>
                <div>
                    Don't Have Account? <a href="/practice/signup.php?root=Sign Up" class="create-anchor">Create Account</a>
                </div>
            </form>   

        </div>

    </div>



    <script>
       

       document.getElementById("games-section").onmouseover=function()
       {
        
        document.getElementsByClassName('icon')[0].style.visibility="hidden";
       };
       
       document.getElementById("games-section").onmouseout=function()
       {
        document.getElementsByClassName('icon')[0].style.visibility="visible";
       };
       
    </script>
</body>
</html>