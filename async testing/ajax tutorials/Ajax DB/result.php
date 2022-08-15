<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello</title>
</head>
<body>
    <table border="1" cellpadding="10">
             
    <?php
        include "/xampp/htdocs/practice/handlers/connect.php";

        if (isset($_GET['id'])) 
        {
            $query = "select * from student where rollno=".$_GET['id']."; ";
            
            if($data=mysqli_fetch_array(mysqli_query($con,$query)))
            {

    ?>
            <tr>
                <td><?php echo $data['rollno']; ?></td>
                <td><?php echo $data['name']; ?></td>
                <td><?php echo $data['address']; ?></td>
                <td><?php echo '<img src="data:image/*;base64,'.base64_encode($data['image']).'" alt="Not Found" style="width:200px;">'; ?></td>
            </tr>
    <?php
            }
            else
            {
                echo '<tr><td>Your Id Is Not Found</td></tr>';
            }
        }
    ?>
    </table>
</body>
</html>