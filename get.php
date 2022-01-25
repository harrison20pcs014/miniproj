
<?php
if (isset($_POST['how']))
{
    session_start();

    $uid=$_POST['uid'];

    $imgid=$_POST['imgid'];

    $user=$_POST['data'];

    



    $conn = new mysqli("localhost", "root", "", "miniproj");

 
    $ssss=mysqli_query($conn, " SELECT * from likes where image_id='$imgid'and uimage_id='$uid'");
    if(mysqli_num_rows($ssss) == 0)
     {
         mysqli_query($conn, "INSERT INTO likes (`user_id`,image_id,uimage_id) VALUES ('$user','$imgid','$uid') ");
       
     }
     elseif (mysqli_num_rows($ssss) > 0)
     {
         mysqli_query($conn,"DELETE from likes where uimage_id='$uid'and image_id='$imgid'");
     }
}

?>


<!-- if(isset($_POST['like']))
{
   $imgid=$_POST['likes'];
   $user=$_POST['imid'];
   $uid=$_POST['uid'];

   $ssss=mysqli_query($conn, " SELECT * from likes where image_id='$imgid'and uimage_id='$uid'");
   if(mysqli_num_rows($ssss) == 0)
    {
        mysqli_query($conn, "INSERT INTO likes (`user_id`,image_id,uimage_id) VALUES ('$user','$imgid','$uid') ");
      
    }
    elseif (mysqli_num_rows($ssss) > 0)
    {
        mysqli_query($conn,"DELETE from likes where uimage_id='$uid'and image_id='$imgid'");
    }
  
} -->