<?php

include 'db.php';

session_start();

error_reporting(0);

$mail=$_SESSION['mail'];
$imm= $_SESSION['hell'];




if(isset($_POST['db']))
{
   $user=$_POST['del'];
   mysqli_query($conn, "DELETE FROM image WHERE image_id='$user'");
   header('location:user.php');
}

$m=$_SESSION['mmail'];

$ii=mysqli_query($conn,"SELECT * FROM user where email='$m'");

$row=mysqli_fetch_array($ii);
$iid="0";
// echo $m;
$iid=$row['user_id'];
$uname=$row['name'];
// echo $uname;

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <title>lensmAn</title>
    <link rel="stylesheet" href="style.css">


</head>
<body style="display:flex;align-items:center;flex-direction:column">

<div class="navbar">
   
    
    <a href="index.php"><p class="logo">lensmAn </p></a>
    <form method="post">
        <button class="probut" name="imrr"><div class="profile" <?php echo $err;?> <?php echo $sty?> >
            <div style="background-color:red">
                <img src="profile/<?php echo $mail.".jpg"?>" <?php echo time() ?> class="proimg">
            </div>
        </div>
</button>
    </form>
    <form method="POST" >
        <!-- <a onclick="bup()" class="bup" <?php echo $sty?> <?php echo $err;?> >upload</a> -->
     
        <input type=hidden name=hid value="<?php echo $m?>">
      
        <input type="submit" name="sub" value="logout" <?php echo $sty;?>   >
    </form>
</div>



<?php


// $po=mysqli_query($conn ,"SELECT * FROM image ORDER BY image_id DESC");
$po=mysqli_query($conn ,"SELECT * FROM user JOIN image WHERE user.user_id=image.user_id AND email='$m' ORDER BY image_id DESC ;");

?>

<div style="
    width: 400px;
    height: 99px;
    /* position: absolute; */
    /* bottom: 5.3em; */
    /* left: 5em; */
    /* overflow: hidden; */
    /* display: flex; */
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 100vw;
    display: grid;
    margin: 3em;
    grid-template-columns: auto auto auto;
    /* padding: 39px; */
    grid-gap: 2em;
    text-align: center;">



    <!-- <p><?php echo $usename ?></p> -->
    <a href="photo.php"><div style="    width: 200px;
    height: 200px;
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-content: center;">
    <img src='load/<?php echo  $imm?>' style='width:auto;height: auto;' >
</div></a>
    <h3><?php echo $description ?></h3>
    <form  method="POST">
        <input type="hidden" value="<?php echo $_SESSION['poid']?>" name="del">
        <input type="submit" value="delete" name="db">
    </form> 
    
    


</div>
<script>
    if ( window.history.replaceState )
        {
            window.history.replaceState( null, null, window.location.href );
        }
 
    </script>
</body>

</html>
