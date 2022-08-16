<?php
    require_once "make_caller.php";
    function image_width_calculator($width_of_container)
    {
        return $pic_width = ( ($width_of_container * 100) / ( 46.2857143 ) );
    }

    if (isset($_SESSION)) 
    {
        
    }

?>


<div class="header">
        <div class="left-header">
            <a class="left-head-anchors" href="/practice/index.php?root=Home">Home</a>
            <div name="games" id="games-section">
                <a class="left-head-anchors" href="javascript:response(`/practice/games.php?root=Games`,``,`GET`)">Games</a>
                <div>
                    <div class="dropdown">
                    <?php 
                        $r_games=mysqli_query($con,'select distinct genre from games order by genre;');
                        while($row_games=mysqli_fetch_array($r_games))
                        {
                    ?>
                        <a class="left-head-anchors" href="javascript:<?php ajax_call('/practice/games.php','?category='.$row_games['genre'],'GET'); ?>">
                            <?php  echo $row_games['genre']; ?>
                        </a>
                    <?php
                        }
                    ?>
                    </div>
                </div>
            </div>
            <a class="left-head-anchors" href="/practice/index.php?root=Support">Support</a>
            <a class="left-head-anchors" href="/practice/index.php?root=About Us">About Us</a>
        </div>
        <div class="right-header">
                <p class="username">muhammadrao1246</p>
                <div class="profile-container">
                   <div class="cropped_logo"> </div>
                    <img src="/practice/images/john wick.jpg" alt="Not Found" style="width:<?php echo image_width_calculator(50); ?>px;" class="profile-picture"> 
                </div>
                
        </div>


    </div>

<script>
    
    var image = document.getElementsByClassName('profile-picture')[0];

    image.onload = set_position();

    function set_position( left_percentage = 1 , top_percentage = 1 ) 
    {
        var left_position = Number(image.clientWidth)  / 100 * left_percentage ;
        var top_position  = Number(image.clientHeight) / 100 * top_percentage  ;
        
        image.style.objectPosition = '-' + left_position +'px -' + top_position + 'px' ;
    }
</script>