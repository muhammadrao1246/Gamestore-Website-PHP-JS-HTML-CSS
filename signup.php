<?php
include "handlers-php/connect.php";
include "handlers-php/game_data.php";
include "handlers-php/date_approx.php";

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
    include "handlers-php/header.php";
    ?>
<div id="content">
    <div class="section">
        <?php
        include "handlers-php/breadcrumb.php";
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
                        
                        <input type="number" name="width" id="width" hidden>
                        <input type="number" name="height" id="height" hidden>
                        <input type="number" name="box" id="box" hidden>
                        <input type="number" name="x" id="x" hidden>
                        <input type="number" name="y" id="y" hidden>
                        
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
                            include "handlers-php/password-animation.php";
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
    <div>
                            <?php
                                include "handlers-php/image-cropper.php";
                            ?>
    </div>
</div>

    
    <script src="handlers-js/signup.js" ></script>
    <script src="handlers-js/crop.js" ></script>
    <script src="handlers-js/ajax.js"></script>

</body>

</html>