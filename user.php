<?php

include 'db.php';

session_start();

error_reporting(0);

$mail=$_SESSION['mail'];


$poo=mysqli_query($conn ,"SELECT * FROM user where email='$mail'");
$post0=mysqli_fetch_array($poo);
$photographer=$post0[6];


if($photographer==0)
{
    $err="style='display:none'";
    
}


if(isset($_POST['imrr']))
{
$_SESSION['umail']=$_SESSION['mail'];
header('Location:user.php');
}

if(isset($_POST['button']))
{
$_SESSION['poid']=$_POST['pid'];
$_SESSION['hell']=$_POST['immg'];
header('Location:photo.php');
}

if(isset($_POST['imr']))
{
$_SESSION['umail']=$_POST['imm'];
header('Location:pro.php');
}

if(isset($_POST['like']))
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
  
}


if(isset($_POST['cmt']))
{
    $imgid=$_POST['likes'];
    $user=$_POST['imid'];
    $uid=$_POST['uid']; 
    $comment=$_POST['ctext'];
    mysqli_query($conn, "INSERT INTO comment (`user_id`,image_id,uimage_id,comment) VALUES ('$user','$imgid','$uid','$comment') ");
}



if(isset($_POST['db']))
{
   $user=$_POST['del'];
   mysqli_query($conn, "DELETE FROM image WHERE image_id='$user'");
}

$m=$_SESSION["mail" ];
$iid="0";
$sty="style='display:none'";   
$style="";
if ($m!="")
{
$ii=mysqli_query($conn,"SELECT * FROM user where email='$m'");
$row=mysqli_fetch_array($ii);
$iid=$row['user_id'];
$uname=$row['name'];
$style="style='display:none'";
$sty="";
}


if(isset($_POST['sub']))
{
    unset($_SESSION['mail']);
    session_destroy();
    $m=" ";
    $iid=" ";
    header("Location:index.php");
}

if (isset($_POST['submit']))
{
$des=$_POST['descr'];
$filename = $_FILES['file']['name'];
$tempname = $_FILES['file']['tmp_name'];       
$folder = getcwd()."/load/".basename($filename);
move_uploaded_file($tempname,$folder);

    if ($iid==0)
    {
        echo '<script> alert("login to upload")</script>';
    }

    elseif($photographer==1)
    {
        $ss = "INSERT INTO image (`user_id`,images,Descr) VALUES ('$iid','$filename','$des') ";
        $conn->query($ss);
    }
    else{
        echo '<script> alert("Your not a photographer")</script>';

    }
}



if(isset($_POST['hireme']))
{
    $userv=$_POST['vs'];
    $_SESSION['namme']=$_POST['vs'];

    header('Location:hire.php');
}

echo  $userv;

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>lensmAn</title>
    <link rel="stylesheet" href="style.css">
    <script src="js.js"></script>


</head>
<body >

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
        <a href="login.php" <?php echo $style; ?>>login</a>
        <a href="registration.php" <?php echo $style; ?>>signup</a>
        <input type=hidden name=hid value="<?php echo $m?>">
      
        <input type="submit" name="sub" value="logout" <?php echo $sty;?>   >
    </form>
</div>

    

    <div class="upload" >
        <div class="upcont">
        <span onclick="bdw()" class="closew"></span>
        <img id="previewIMG" class="previewi" >
        <form method="POST" enctype="multipart/form-data" class=upform >
            
            <input type="file" name="file"  class="infi" accept="image/*" onchange="previewImage(event)" id="file">
            
            <input type="text" name="descr" class="intx" placeholder="like to say something about your photo">
            <button name="submit" class="upbt">submit</button>
            
           
        </form>
        </div>
    </div>

    
<?php
$m=$_SESSION['umail'];
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
    margin-top: 3em;
    grid-template-columns: auto auto auto;
    /* padding: 39px; */
    grid-gap: 2em;
    text-align: center;">

<?php
while($post1= mysqli_fetch_array($po))
{
    $post_id=$post1[7];

    $imagee=$post1[9];
    
    $description=$post1[11];
    $usename=$post1[2];
    ?>

    <!-- <p><?php echo $usename ?></p> -->
    <form  method="POST">
    <button name="button" value='hello' style="border-decoration:none;cursor:pointer;"><div style="    width: 200px;
    height: 200px;
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-content: center;">
    <img src='load/<?php echo $imagee; ?> ' style='width:auto;height: auto;' >
</div></button>
<input type="hidden" value='<?php echo $imagee;?>' name="immg">
<input type="hidden" value='<?php echo $post_id;?>' name="pid">
</form> 
    <!-- <h3><?php echo $description ?></h3> -->
    <!-- <form  method="POST">
        <input type="hidden" value="<?php echo $post_id?>" name="del">
        <input type="submit" value="delete" name="db">
    </form>  -->
    

    <?php
}
?>
</div>

   



<script>
    if ( window.history.replaceState )
        {
            window.history.replaceState( null, null, window.location.href );
        }
    function previewImage(event)
    {
        
        // var a=document.getElementById("file").value;
        // document.getElementById("previewIMG").src=a;
        // reader.readAsDataURL(event.target.files[0]);
        // // document.getElementById("previewIMG").src=a;


        var reader=new FileReader();
        reader.onload=function()
        {
            var output=document.getElementById('previewIMG');
            output.src=reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
    function bup()
{
    document.querySelector('.upload').style="visibility: visible;"
    document.querySelector('.container').style="filter:blur(3px)"
    
}
function bdw()
    {
    document.querySelector('.upload').style="visibility:hidden;"
    document.querySelector('.container').style="filter:blur(0px)"
   }


    </script>

<!-- <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&callback=initMap&libraries=&v=weekly&channel=2"
      async
    ></script> -->
</body>

</html>
