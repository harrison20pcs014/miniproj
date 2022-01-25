<?php

include 'db.php';

session_start();

error_reporting(0);


if(isset($_POST['imr']))
{
$_SESSION['umail']=$_POST['imm'];
header('Location:user.php');
}







// if(isset($_POST['like']))
// {
//    $imgid=$_POST['likes'];
//    $user=$_POST['imid'];
//    $uid=$_POST['uid'];
//    $ssss=mysqli_query($conn, " SELECT * from likes where image_id='$imgid'and uimage_id='$uid'");
//    if(mysqli_num_rows($ssss) == 0)
//     {
//         mysqli_query($conn, "INSERT INTO likes (`user_id`,image_id,uimage_id) VALUES ('$user','$imgid','$uid') ");
      
//     }
//     elseif (mysqli_num_rows($ssss) > 0)
//     {
//         mysqli_query($conn,"DELETE from likes where uimage_id='$uid'and image_id='$imgid'");
//     }
  
// }


// if(isset($_POST['cmt']))
// {
//     $imgid=$_POST['likes'];
//     $user=$_POST['imid'];
//     $uid=$_POST['uid']; 
//     $comment=$_POST['ctext'];
//     mysqli_query($conn, "INSERT INTO comment (`user_id`,image_id,uimage_id,comment) VALUES ('$user','$imgid','$uid','$comment') ");
// }



// if(isset($_POST['db']))
// {
//    $user=$_POST['del'];
//    mysqli_query($conn, "DELETE FROM image WHERE image_id='$user'");
// }

// $m=$_SESSION['mail'];

// $ii=mysqli_query($conn,"SELECT * FROM user where email='$m'");

// $row=mysqli_fetch_array($ii);
// $iid="0";
// // echo $m;
// $iid=$row['user_id'];
// $uname=$row['name'];
?>

<?php
// if(isset($_POST['sub']))
// {
//     unset($_SESSION['mail']);
//     // session_destroy();
//     $_SESSION['mail']=" ";
    
//     header("Location:index.php");
// }

// if (isset($_POST['submit']))
// {

// $des=$_POST['descr'];

// $filename = $_FILES['file']['name'];

// $tempname = $_FILES['file']['tmp_name'];       
// $folder = getcwd()."/load/".basename($filename);
 
// move_uploaded_file($tempname,$folder);
// if ($iid==0)
// {
//     echo '<script>alert("login to upload")</script>';
// }
 
// $ss = " INSERT INTO image (`user_id`,images,Descr) VALUES ('$iid','$filename','$des') ";

// $conn->query($ss);

// }





?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>lensmAn</title>
    <link rel="stylesheet" href="style.css">
  


</head>
<body >

<div class="navbar">
    <p>lensmAn</p>
    <a href="user.php"><p><?php echo $usename ?></p></a>
    <form method="POST" >
        <a href="#">admin</a>
        <input type=hidden name=hid value="<?php echo $m?>">
    
        
    </form>
</div>

    <div style="display:flex;align-items:center;flex-direction:column">
    


<?php


// $po=mysqli_query($conn ,"SELECT * FROM image ORDER BY image_id DESC");
$po=mysqli_query($conn ,"SELECT * FROM user ORDER BY user_id DESC;");
?>
<table>
<thead>
    <tr>
        
        <td>user_id</td>
        <td>email</td>
        <td>name</td>
        <td>phno</td>
        <td>create at</td>   
    </tr>
</thead>

<?php
while($post1= mysqli_fetch_array($po))
{
    $user_id=$post1[0];
    $emaill=$post1[1];
    $username=$post1[2];
    $phno=$post1[3];
    $cre=$post1[5];
    
   ?>


    <tbody>
        <tr>
            <form method="post">
            <td><?php echo $user_id ?></td>
            <td><input type="hidden" value="<?php echo $emaill ?>" name="imm"><?php echo $emaill ?> </td>
            <td><button name="imr"><?php echo $username ?></button></td>
            <td><?php echo $phno ?></td>
            <td><?php echo $cre ?></td>
            </form>
        </tr>
    </tbody>
  
<?php
}
?>
  </table>





<script>
    if ( window.history.replaceState )
        {
            window.history.replaceState( null, null, window.location.href );
        }

    </script>
</body>

</html>
