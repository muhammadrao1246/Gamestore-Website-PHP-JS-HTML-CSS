<?php
include "/xampp/htdocs/practice/handlers/connect.php";
// Some pre uploading configuration you have to make in your xampp server config filesize
// -   open apache->config-> php.ini
//     => search "file_uploads=on" turn on 
//     => also configure "upload_max_filesize=40M" according to your need default is very low it is not 40mb 
//     => also you can make "max_file_uploads=20" to your required need number of files at one time

// Database Structure
// Table Structure: CREATE TABLE upload_by_path(id int(10) AUTO_INCREMENT PRIMARY KEY,path varchar(100));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploading and Retrieval Of Files From Server Directory</title>
</head>
<?php
$pic_path = null;
if (isset($_POST['submit'])) 
{
    $img = $_FILES['img'];
    $image_name = basename($img['name']);
    $temp_name = $img['tmp_name'];
    
    $image_extension=pathinfo($image_name,PATHINFO_EXTENSION);
    echo $image_extension;
    $image_size = $img['size'];

    print_r($_FILES['img']);
    
    $pic_path = $destination = '' . $image_name;

    // if (file_exists($image_name)) {
        
        // move_uploaded_file($temp_name, $destination);
        $cropped=imagecreatefromjpeg($temp_name);
        $width = imagesx($cropped);
        $height = imagesy($cropped);
$box_percentage=46.2857143;
$cur_w=($width/100)*($box_percentage);
$x=($width/100)*((175/350)*100);
$y=($height/100)*((23/197)*100);

        $cropped = 
        imagecrop
        (
        $cropped,
        [
            'x'=>$x,
            'y'=>$y,
            'width'=>$cur_w,
            'height'=>$cur_w
        ]
        );
        /* FOR RELATIVE POSITIONING OF CROPPED AREA IN THE UPLOADED BOX WE HAVE TO CALCULATE ALSO X, Y, WIDTH, AND HEIGHT FOR INSTRINSIC RESOLUTION
        EQUIVALENET TO IN TERMS WITH UPLOADED BOX */

        // $cropped = 
        // imagecrop
        // (
        // $cropped,
        // [
        //     'x'=>(($intrinsic_width/100)*(($box_x/$server_width)/100)),
        //     'y'=>(($intrinsic_height/100)*(($box_y/$server_height)/100)),
        //     'width'=>($intrinsic_width/100)($box_percentage),
        //     'height'=>($intrinsic_width/100)($box_percentage)
        // ]
        // );

        imagejpeg($cropped,'Cropped.jpeg');
        
    // }



    // $path_info=pathinfo($temp_name,PATHINFO_ALL); //extension dirname name 
    // $arr='<br>';

    // foreach ($path_info as $key => $value)  //fetching all data from pathinfo function
    // {
    //    $arr.=$key.': '.$value.'<br>';
    // }
    // echo $image_name.'    '.$arr;


}
?>


<body>
    <h2>Cropping and Saving Selected File</h2>
    <form action="crop.php" method="post" enctype="multipart/form-data" >

        <div>
            <h3>Select Image</h3>
            <input type="file" name="img" placeholder="For Image" accept="image/*" id="pic">
        </div>
        
        <div>
            <input type="submit" name="submit" value="upload">
        </div>

    </form>

    <br><br><br>
    <h1>Uploaded Image:</h1>
    <?php
    if (isset($pic_path)) {
        echo '<img src="' . $pic_path . '" alt="Not Found" width=500/>';
    }

    ?>
    
</body>

</html>