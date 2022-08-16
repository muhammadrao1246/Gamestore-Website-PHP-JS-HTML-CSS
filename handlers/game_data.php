<?php
    include "current_state.php";
    $prev_nav;
$nav="";
$query="select* from dates order by seconds,minutes,hours,days,months,years;";
$prev_nav=$nav;
//initially

if(isset($_GET['root']))
{
    $root=$_GET['root'];
    $nav="<a class='navigation-path' href='javascript:response(`/practice/".strtolower($root).".php?root=$root`,``,`GET`)'> $root </a>";
}



if (isset($_GET['category'])) 
{
    $cat=$_GET['category'];
    $nav="<a class='navigation-path' href='javascript:response(`/practice/games.php?root=Games`,``,`GET`)'> Games </a>";
    $nav .= ' > '."<a class='navigation-path' href='javascript:response(`/practice/games.php?category=$cat`,``,`GET`)'> $cat </a>";
    $query='select* from dates where Genre="'.$_GET['category'].'" order by seconds,minutes,hours,days,months,years ;';    
}

if(isset($_GET['id']))    
{
    $nav="<a class='navigation-path' href='javascript:response(`/practice/games.php?root=Games`,``,`GET`)'> Games </a>";
    
    $runner=mysqli_query($con,'select * from dates where id="'.$_GET['id'].'";');
    $fetch=mysqli_fetch_assoc($runner);
    
    $cat=$fetch['Genre'];
    $nav .= ' > '."<a class='navigation-path' href='javascript:response(`/practice/games.php?category=$cat`,``,`GET`)'> $cat </a>";
    
    //noow the full categories data
    $query='select * from dates where genre="'.$fetch['Genre'].'" and Id != "'.$_GET['id'].'" order by seconds,minutes,hours,days,months,years;';
    

    $nav .= ' > '.'<a class="navigation-path" href=`/practice/pages/games/post/post.php?id="'.$_GET['id'].'"`>'.$fetch['Game'].'</a>';
}
value($nav);
$run=mysqli_query($con,$query);
$row=mysqli_fetch_all($run,MYSQLI_BOTH);
$num=mysqli_num_rows($run);
$start=1;
$limit=0;
$size=sizeof($row)/10;
$i=0;

?>