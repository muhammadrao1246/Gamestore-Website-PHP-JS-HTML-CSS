<?php
    include "current_state.php";
    $prev_nav;
$nav="";
$query="select* from dates order by seconds,minutes,hours,days,months,years;";
$prev_nav=$nav;

$header_flag=0;
if (isset($_GET['header_flag'])) 
{
   if ($_GET['header_flag'] == 1) 
   {
    $header_flag=1;
   } 
}
//initially

if(isset($_GET['root']))
{
    $root=$_GET['root'];
    $nav="<a class='navigation-path' href='/practice/".strtolower($root).".php?root=$root'> $root </a>";
}



if (isset($_GET['category'])) 
{
    $cat=$_GET['category'];
    $nav="<a class='navigation-path' href='/practice/games.php?root=Games'> Games </a>";
    $nav .= ' > '."<a class='navigation-path' href='javascript:response(`/practice/games.php?category=$cat`,`&header_flag=".$_GET['header_flag']."`,`GET`)'> $cat </a>";
    $query='select* from dates where Genre="'.$_GET['category'].'" order by seconds,minutes,hours,days,months,years ;';    
}

if(isset($_GET['id']))    
{
    $nav="<a class='navigation-path' href='/practice/games.php?root=Games'> Games </a>";
    
    $runner=mysqli_query($con,'select * from dates where id="'.$_GET['id'].'";');
    $fetch=mysqli_fetch_assoc($runner);
    
    $cat=$fetch['Genre'];

    if (isset($_GET['header_flag'])) $nav .= ' > '."<a class='navigation-path' href='/practice/games.php?category=$cat&header_flag=".$_GET['header_flag']."'> $cat </a>";
    else $nav .= ' > '."<a class='navigation-path' href='/practice/games.php?category=$cat&header_flag=0'> $cat </a>";
    //noow the full categories data
    $query='select * from dates where genre="'.$fetch['Genre'].'" and Id != "'.$_GET['id'].'" order by seconds,minutes,hours,days,months,years;';
    

    $nav .= ' > '.'<a class="navigation-path" href="#">'.$fetch['Game'].'</a>';
}

$run=mysqli_query($con,$query);
$row=mysqli_fetch_all($run,MYSQLI_BOTH);
$num=mysqli_num_rows($run);
$start=1;
$limit=0;
$size=sizeof($row)/10;
$i=0;

?>