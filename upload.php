<?php
include "handlers/connect.php";

// Some pre uploading configuration you have to make in your xampp server config filesize
// -   open apache->config-> php.ini
//     => search "file_uploads=on" turn on 
//     => also configure "upload_max_filesize=40M" according to your need default is very low it is not 40mb 
//     => also you can make "max_file_uploads=20" to your required need number of files at one time


// Database Structure
// Database-Name: "dbname"
// table structure: create table upload( id int(10) auto_increment primary key,image mediumblob  );
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploading and Retrieval Of Files From Database</title>
</head>
<?php
$pic=null;
    if(isset($_POST['submit']))
    {
        $img=$_FILES['img'];

        $image_name=basename($img['name']);
        $temp_name=$img['tmp_name'];
        $image_size=$img['size'];
        
        //doing file handling
        $read_descriptor=fopen($temp_name,'r');
        $image=fread($read_descriptor,filesize($temp_name));
        $image1=addslashes($image);
        $pic=$image1;
        fclose($read_descriptor);

        // $path_info=pathinfo($temp_name,PATHINFO_ALL); //extension dirname name 
        // $arr='<br>';

        // foreach ($path_info as $key => $value)  //fetching all data from pathinfo function
        // {
        //    $arr.=$key.': '.$value.'<br>';
        // }
        // echo $image_name.'    '.$arr;
        
        $id=$_POST['id'];
        $query="INSERT INTO upload values($id,'$image1')";
        
        mysqli_query($con,$query);
        }
?>


<body>
      <h2>Uploading and Retrieval Of Files From Database</h2>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="number" name="id" required>
        <input type="file" name="img">
        <input type="submit" name="submit" value="upload">
    </form>

    <br><br><br>
    <h1>Uploaded Image:</h1>
<?php
  if (isset($pic)) 
  {
    $query="select * from upload where id=$id";
    $run=mysqli_query($con,$query);
    $data=mysqli_fetch_array($run);
    echo '<img src="data:image/*;base64,'.base64_encode($data[1]).'" alt="Not Found" width=500/>';
  }  

?>

</body>
</html>