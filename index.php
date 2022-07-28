<?php
    include "handlers/connect.php";
    require_once "handlers/game_data.php";
    include "handlers/date_approx.php";
    if(isset($_GET['start']) && isset($_GET['limit']))
    {
        $start=($_GET['start']);
        $limit=($start*10)-10;
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
    
</head>
<body>
    <?php
        include "handlers/header.php";    
    ?>
    <div class="section">
        <?php
          include "handlers/breadcrumb.php";  
        ?>
            <div class="gallery">
<?php
    $i=$limit;
    
    while($i < 10*$start)
    {
        if(isset($row[$i]))
        {
        $message=calculate_date($row[$i]);
?>
                <div class="item">    
                    <img src="<?php echo $row[$i]['Image']; ?>" alt="Not found" >
                    <div class="product-detail">
                            
                                <h2>
                                    <a class="navigation-path" href="post.php?id=<?php echo $row[$i]['Id']; ?>&nav=<?php echo $nav; ?>">
                                        <?php echo $row[$i]['Game']; ?>
                                    </a>
                                    </h2>
                            
                            <p id="up">
                                <label>Uploaded: </label> 
                                    <code>
                                        <?php 
                                            if ($message[0]!=0) {
                                                echo $message[0].' '.$message[1].' ago'; 
                                            }
                                            else{
                                                echo 'Unknown';
                                            }
                                        ?>
                                    </code>
                            </p>
                            <p id="cat">
                                <label>Category: </label> 
                                    <code>
                                        <?php
                                            echo $row[$i]['Genre'];
                                        ?>
                                    </code>
                            </p>
                            <p id="desc">
                                <label>Description: </label> 
                                    <code>
                                        <?php
                                            
                                            $desc=(explode(".",$row[$i]['Summary']));
                                            echo $desc[0].'.'.$desc[1].'....(more also)';
                                        ?>
                                    </code>
                            </p>
                    </div>      
                    
                </div>
<?php
        }
        $total=round($num/10);
    
        $i++;
    }
?>
            </div>
            <div class="game-nav">
                <a 
                class="nav-button" 
                href="index.php?start=
                        <?php
                            if($start>1) echo $limit/10;
                            else echo $start;
                        ?>
                    &limit=back"><</a>
                    <div class='nav-button-num'>
<?php
    
    if (isset($total)) 
    {
        for ($k=1; $k <= $total; $k++) 
        {
            $temp=""; 
            if($k==$start) $temp="nav-button-active";
            
                echo '<a class="nav-button '.$temp.'" href="index.php?start='.$k.'&limit='.($i).'">'.$k.'</a>';
        }
    }
        
?>
           
                </div>
                <a 
                class="nav-button" 
                href="index.php?start=
                        <?php
                            if($start<$total) echo ($start+1);
                            else echo $start;
                        ?>
                    &limit=forward">></a>
            </div>
    </div>

    <div class="footer">
        <div class="foot-nav">
            <div class="foot-section">
                <h3>Contact</h3>
            </div>
            <div class="foot-section">
                <h3>Community</h3>
            </div>
            <div class="foot-section"></div>
            <div class="foot-section">Rao</div>
        </div>
    </div>

    
</body>
</html>