<?php
    include "handlers-php/connect.php";
    require_once "handlers-php/game_data.php";
    include "handlers-php/date_approx.php";
    include "handlers-php/make_caller.php";
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
    <link rel="stylesheet" type="text/css" href="/practice/root-styles/style.css" />
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php
    if ($header_flag != 1) 
    {
        require_once "handlers-php/header.php";
    }
        
    ?>
    <div id="content">
        <div class="section">
            <?php
            include "handlers-php/breadcrumb.php";  
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
                                        <a class="navigation-path" href="/practice/pages/games/post/post.php?id=<?php echo $row[$i]['Id']; ?>">
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
                                if($start>1) ajax_call('/practice/games.php?start=',($limit/10).'&limit=back&header_flag='.$header_flag,'GET');
                                else ajax_call('/practice/games.php?start=',($start).'&limit=back&header_flag='.$header_flag,'GET');
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
                    ajax_call('/practice/games.php?start=',$k.'&limit='.$i.'&header_flag='.$header_flag,'GET');
                    echo '">'.$k.'</a>';
            }
        }
            
    ?>
            
                    </div>
                    <a 
                    class="nav-button" 
                    href="javascript:
                            <?php
                                if($start<$total) ajax_call('/practice/games.php?start=',($start+1).'&limit=forward&header_flag='.$header_flag,'GET');
                                else ajax_call('/practice/games.php?start=',($start).'&limit=forward&header_flag='.$header_flag,'GET');
                            ?>"
                        >></a>
                </div>
        </div>
    </div>


<script src="handlers-js/ajax.js"></script>  
</body>
</html>