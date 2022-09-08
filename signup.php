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

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Pacifico">

    <link rel="stylesheet" type="text/css" href="root-styles/style.css" />
    <link rel="stylesheet" type="text/css" href="pages/games/post/post-styles.css"/>
    <link rel="stylesheet" type="text/css" href="root-styles/login-signup-styles.css" />
    <link rel="stylesheet" type="text/css" href="root-styles/password-animation.css" />



    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/js/all.min.js" crossorigin="anonymous"></script> -->
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.0/gsap.min.js"></script> -->

    <script src="libraries/fontawesome-free-5.15.4-web/js/all.min.js" defer></script>
    <script src="libraries/gsap-public/minified/gsap.min.js" defer></script>
    <script src="handlers-js/ajax.js" defer></script>

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
                            <input id="img" type="file" name="profile" title="" class="form-input-box" accept="image/*" multiple="multiple" />
                            
                            <div class="hovering-container">
                                <div class="img-container">
                                    <div style="width: 163px;height: 163px;background-image:url(assets/images/opaque.png)">

                                    </div>
                                </div>
                                <div class="crop-again">
                                    <label class="crop">Crop Again</label>
                                </div>
                            </div>
                            
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
            <div class="tool-container">
                <div class="tool-section">
                    <?php
                    include "handlers-php/crop.php";
                    ?>
                    <div class="tool-button-section">
                        <label class="change-picture" for="img">Change Picture</label>
                        <button class="crop">Crop</button>
                    </div>
                </div>
            </div>
            <div class="error-popup-container">
                <div class="error-container">
                    <div class="cancel-icon">
                        <button class="cancel">
                            <i role="button" class="fas fa-plus cancel-hover"></i>
                        </button>
                    </div>
                    <div class="error-icon">
                        <div class="icon-container">
                            <svg height="32" style="overflow:visible;width: 60px !important;height: min-content;enable-background:new 0 0 32 32" viewBox="0 0 32 32" width="32" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g>
                                    <g id="Error_1_">
                                        <g id="Error">
                                            <circle cx="16" cy="16" id="BG" r="16" style="fill:#D72828;" />
                                            <path d="M14.5,25h3v-3h-3V25z M14.5,6v13h3V6H14.5z" id="Exclamatory_x5F_Sign" style="fill:#E6E6E6;" />
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                    </div>
                    <div class="error-text">
                        Image Resolution Not Supported !<br>Try Greater Than 350 x 350
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="handlers-js/crop.js" defer></script>
    <script src="handlers-js/signup.js" defer></script>

    <!-- <style>
        body{
            background-image: none;
        }
        @font-face {
            font-family: 'kanit';
            src: local('kanit'), url(assets/fonts/Kanit-Regular.ttf) format('ttf');
        }

        @font-face {
            font-family: pacifico-regular-ttf;
            src: url(assets/fonts/Pacifico-Regular.ttf);
            /* src: url(../assets/fonts/Pacifico-Regular.ttf) format('true type'); */
        }

        @font-face {
            font-family: kanit-ttf;
            src: url(assets/fonts/Kanit-Regular.ttf);
            /* src: url(/assets/fonts/Kanit-Regular.ttf) format('ttf'); */
        }

        @font-face {
            font-family: kanit-woff2;
            src: url(assets/fonts/Kanit-Regular.woff2);
            /* src: url(/assets/fonts/Kanit-Regular.woff2) format('woff2'); */
        }
    </style> -->
</body>

</html>