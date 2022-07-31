<?php
    include "handlers/connect.php";
    include "handlers/game_data.php";
    include "handlers/date_approx.php";

    function string_handler($str)
    {
        $arr=explode("|",$str);
        $size=sizeof($arr);
        $size=$size-2;
        if (sizeof($arr) <= 2) {
            $str=preg_replace("/\|/i"," and ",$str); 
        }
        else {
            $str=preg_replace("/\|/i",", ",$str,$size);
            $str=preg_replace("/\|/i"," and ",$str); 
        }
        
        return $str;
    }

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
                
            <div class="post">

                <div>
                    <h1>
                        <a class="navigation-path" href="<?php echo $fetch['Wikipedia_Profile']; ?>" title="Wikipedia Profile"> 
                            <?php echo $fetch['Game']; ?> 
                        </a>
                    </h1>
                </div>
                <p>
                    <label>Developer:</label>
                    <span class="description code">    
                            <?php echo $fetch['Developer']; ?>
                    </span>
                </p>
                <p>
                    <label>Publisher:</label>
                    <span class="description code">    
                            <?php echo $fetch['Publisher']; ?>
                    </span>
                </p>
                <div class="description code">
                    <?php echo $fetch['Game']; ?> is <?php echo string_handler($fetch['Genre']); ?> game, developed by 
                    <?php echo string_handler($fetch['Developer']); ?> studios and 
                    published by <?php echo string_handler($fetch['Publisher']); ?>. 
                    This game is another installement in <?php echo $fetch['Series']; ?> series.
                </div>
                <div class="img-container">
                    <img src="<?php echo $fetch['Image']; ?>" alt="Not Found" class="post-image" loading="lazy">
                </div>
                <div class="description code">
                    <?php echo $fetch['Summary']; ?>
                </div>
                <p>
                    <label>Uploaded:</label>
                    <span class="description code">    
                            <?php 
                                        $message=calculate_date($fetch);
                                        if ($message[0]!=0) {
                                            echo $message[0].' '.$message[1].' ago'; 
                                        }
                                        else{
                                            echo 'Unknown';
                                        }
                            ?>
                    </span>
                </p>
                <div class="buy-and-learn">
                    <a class="buy-now" href="
                                            <?php 
                                                if($fetch['Homepage']!="")
                                                    echo $fetch['Homepage'];
                                                else {echo  "Not Found";}
                                            ?>
                                            
                                            " >
                        <i class="fas fa-store" style="color:white;"></i>  Buy Now
                    </a>
                    <a class="learn-more" href="
                                            <?php 
                                                if($fetch['Homepage']!="")
                                                    echo $fetch['Homepage'];
                                                else {echo  'Not Found';}
                                            ?>
                    
                                                ">
                        <i class="fas fa-book" style="color:white;"></i> Learn More
                    </a>
                </div>
            </div>
        </div>

        <div class="post-container" id="slider-container">
            
            <div class="post">
            <h2>Recomended For You</h2>
                <div class="slider">
                    <a class="slider-left-arrow arrow" onclick="load_slider('<');">❮</a>
                    <div class="item-container">
                            <?php
                            $i=0;
                                while($i<$num)
                                {

                            ?>
                            <div class="slider-item fade" id="<?php echo "item".$i;?>">
                            <a class="navigation-path" href="post.php?id=<?php echo $row[$i]['Id']; ?>">
                                    <img src="<?php echo $row[$i][6]; ?>" alt="Not Found" class="slider-image">
                            </a>
                            
                            <label class="slider-image-description">
                                <a class="navigation-path" href="post.php?id=<?php echo $row[$i]['Id']; ?>">
                                    <?php echo $row[$i][1]; ?>
                                </a>
                            </label>
                            
                            </div>
                            <?php
                                    $i++;
                                }
                            ?>
                    </div>

                    <a class="slider-right-arrow arrow" onclick="load_slider('>');">❯</a>
                </div>
            </div>
        </div>
    </div>



    <script>
        var items=<?php echo $num; ?>;
        var limit=Math.ceil(items/3);
        var section_number=0;
        var i=0;
        //first slider items printing initially
        function default_slider()
        {
            for (i; i < 3; i++) 
            {
                section_number++;
                if(!!document.getElementById('item'+(i)))
                {
                    document.getElementById('item'+(i)).style.display="grid";
                }
                else
                {
                    document.getElementById('slider-container').style.display="none";
                }    
            }
        }
        default_slider();

        function load_slider(path) 
        {
            if(path=="<" && i>=3 && limit > 1) 
            {
                section_number--;
                let l=i-3;
                
                for (i; i > l; i--) 
                {
                    if(!!document.getElementById('item'+(i)))
                    {
                        document.getElementById('item'+(i)).style.display="none";
                    }
                }
                if(i<=3)default_slider();
            } 
            if(path==">" && i<=(items-1) && limit>1)
            {
                section_number++;
                let l=i+3;

                for (i; i < l; i++) 
                {
                    if(!!document.getElementById('item'+(i)))
                    {
                        document.getElementById('item'+(i)).style.display="grid";
                    }
                }
                if(i>=items)i--;
                
            }
        }

    </script>
</body>
</html>