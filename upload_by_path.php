<?php
include "handlers/connect.php";
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
if (isset($_POST['submit'])) {
    $img = $_FILES['img'];
    $image_name = basename($img['name']);
    $temp_name = $img['tmp_name'];
    $image_size = $img['size'];

    $pic_path = $destination = 'uploads/' . $image_name;

    if (!file_exists($image_name)) {
        move_uploaded_file($temp_name, $destination);
        $id = $_POST['id'];
        $query = "INSERT INTO upload_by_path values($id,'$destination')";
        mysqli_query($con, $query);
    }

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
    <h2>Uploading and Retrieval Of Files From Server Directory</h2>
    <form action="upload_by_path.php" method="post" enctype="multipart/form-data" style="display: grid;column-gap:10px;width:min-content;grid-gap:5px;grid-template-columns:auto auto auto auto">

        <div>
            <h3>Enter Id</h3>
            <input type="number" name="id" required>
        </div>
        <div>
            <h3>Select Image</h3>
            <input type="file" name="img" placeholder="For Image" accept="image/*" id="pic">
            <h3>Live Preview of Image Below</h3>
            <img src="" alt="Not Found" id="disp" style="width:240px;height:240px;display:block;border:1px solid black;">
        </div>
        <div>
            <h3>Select Video</h3>
            <input type="file" name="video" id="video" accept="video/*">
            <h3>Live Preview of Video Below</h3>
            <video src="" id="v-disp" controls style="width: 400px;display:block;"></video><br>
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
    <script>
        //Live Image Display right after upload
        var img = document.getElementById('disp');
        var pic = document.getElementById('pic');

        pic.onchange = function() {
            img.src = URL.createObjectURL(pic.files[0]);
            // URL.revokeObjectURL()
        }


        //Live Video Display right after upload
        var video = document.getElementById('video');
        var target_screen = document.getElementById('v-disp');
        video.onchange = function() {
            target_screen.src = URL.createObjectURL(video.files[0]);
        }
    </script>
</body>

</html>