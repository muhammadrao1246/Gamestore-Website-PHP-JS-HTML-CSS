<?php
    include "handlers/current_state.php";
    $prev_nav;

$nav="<a class='navigation-path' href='index.php?root=Games'> Games </a>";
$query="select* from dates order by seconds,minutes,hours,days,months,years;";
$prev_nav=$nav;
//initially

if(isset($_GET['root']))
{
    $root=$_GET['root'];
    $nav="<a class='navigation-path' href='index.php?root=$root'> $root </a>";
}



if (isset($_GET['category'])) 
{
    $cat=$_GET['category'];
    $nav .= ' > '."<a class='navigation-path' href='index.php?category=$cat'> $cat </a>";
    $query='select* from dates where Genre="'.$_GET['category'].'" order by seconds,minutes,hours,days,months,years ;';    
}

if(isset($_GET['id']))    
{
    
    $runner=mysqli_query($con,'select * from dates where id="'.$_GET['id'].'";');
    $fetch=mysqli_fetch_assoc($runner);
    
    $cat=$fetch['Genre'];
    $nav .= ' > '."<a class='navigation-path' href='index.php?category=$cat'> $cat </a>";

    //noow the full categories data
    $query='select * from dates where genre="'.$fetch['Genre'].'" and Id != "'.$_GET['id'].'" order by seconds,minutes,hours,days,months,years;';
    

    $nav .= ' > '.'<a class="navigation-path" href="post.php?id='.$_GET['id'].'&nav='.$nav.'">'.$fetch['Game'].'</a>';
}

$run=mysqli_query($con,$query);
$row=mysqli_fetch_all($run,MYSQLI_BOTH);
$num=mysqli_num_rows($run);
$start=1;
$limit=0;
$size=sizeof($row)/10;
$i=0;

?>