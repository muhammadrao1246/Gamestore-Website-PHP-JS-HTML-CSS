<?php
    include "handlers/connect.php";
    require_once "handlers/game_data.php";
    include "handlers/date_approx.php";
    include "handlers/make_caller.php";
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
    <link rel="stylesheet" type="text/css" href="root-styles/style.css" />
    
</head>
<body>
    
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
                                    <a class="navigation-path" href="javascript:<?php ajax_call('/practice/pages/games/post/post.php?id='.$row[$i]['Id'],'','GET');?>">
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
                href="javascript:
                        <?php
                            if($start>1) ajax_call('/practice/games.php?start=',($limit/10).'&limit=back','GET');
                            else ajax_call('/practice/games.php?start=',($start).'&limit=back','GET');
                        ?>"
                    ><</a>
                    <div class='nav-button-num'>
<?php
    
    if (isset($total)) 
    {
        for ($k=1; $k <= $total; $k++) 
        {
            $temp=""; 
            if($k==$start) $temp="nav-button-active";
            
                echo '<a class="nav-button '.$temp.'" href="javascript:';
                ajax_call('/practice/games.php?start=',$k.'&limit='.$i,'GET');
                echo '">'.$k.'</a>';
        }
    }
        
?>
           
                </div>
                <a 
                class="nav-button" 
                href="javascript:
                        <?php
                            if($start<$total) ajax_call('/practice/games.php?start=',($start+1).'&limit=forward','GET');
                            else ajax_call('/practice/games.php?start=',($start).'&limit=forward','GET');
                        ?>"
                    >></a>
            </div>
    </div>


    
</body>
</html>