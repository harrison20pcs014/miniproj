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





    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script type="text/javascript">
         $(document).ready(function() {
          $(".like").click(function() {
          	var id=$(this).attr("title");
            var uid=$(this).children(".hell").attr("title");
            var imgid=$(this).children(".usid").attr("title");

            var i=$(this).children(".like_icon").attr("src");
          	if(i=="heart.svg"){
          		$(this).children(".like_icon").attr("src","red_heart.svg");
          		$(this).children("span").text("liked");
          	}else if(i=="red_heart.svg"){
          		$(this).children(".like_icon").attr("src","heart.svg");
          		$(this).children("span").text("unliked");
              }
          	$.post("get.php",{data:id,how:'c',uid:uid,imgid:imgid});
          });
         });
      </script>


   

   <style>
       .like{cursor:pointer}
       </style>

</head>
<body >

<div class="navbar">
   
    
    <a href="index.php"><p class="logo">lensmAn </p></a>
    <form method="post">
        <button class="probut" name="imrr"><div class="profile" >
            <div style="background-color:red">
                <img src="profile/<?php echo $mail.".jpg"?>" <?php echo time() ?> class="proimg">
            </div>
        </div>
</button>
    </form>
    <form method="POST" >
        <a href="edit.php" class="edit"  >settings</a>
        <a onclick="bup()" class="bup" <?php echo $sty?> <?php echo $err;?> >upload</a>
        <a href="login.php" <?php echo $style; ?>>login</a>
        <a href="registration.php" <?php echo $style; ?>>signup</a>
        <input type=hidden name=hid value="<?php echo $m?>">
        
        <!-- <div class="noti">
      
        <img src="no.png" <?php echo $sty?> <?php echo $err;?> style="position:relative; width:20px;">
        </div> -->
        <input type="submit" name="sub" value="logout" class="out" <?php echo $sty;?>   >
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


// $po=mysqli_query($conn ,"SELECT * FROM image ORDER BY image_id DESC");
$po=mysqli_query($conn ,"SELECT * FROM user JOIN image WHERE user.user_id=image.user_id ORDER BY image_id DESC;");


while($post1=mysqli_fetch_array($po))
{
    $post_id=$post1[7];



    $useriid=$post1[0];
 

    $imagee=$post1[9];
    $description=$post1[11];
    $usename=$post1[2];
    $mmail=$post1[1];
    $_SESSION['ph']=$post1[3];  

    // echo $mmail;
    ?>



<div  class="container" >
<p class="hidden"><?php echo $usename; ?></p>
<div class="ucont">

    <div class="utop">
    <a href="user.php"><p><?php echo $usename; ?></p></a>
   
    <form  method="POST" >
        <input type="hidden"  name="vs" value="<?php echo $usename?>" />
        <button   name="hireme" class="hb" value="<?php echo $usename?>"  onclick="hr()">hiring me</button>
    </form>
  

    </div>
    
    <form  method="POST" value="hello">
    <button name='imr' class="img"><img src='load/<?php echo $imagee?>' style='width:500px;height:fit-content;' ></button>
    <input type="hidden" value='<?php echo $mmail ?>' name="imm">
    </form>
    <h3><?php echo $description ?></h3>
   <?php $ssql=mysqli_query($conn, " SELECT count(user_id) from likes where image_id='$post_id';");
   $r=mysqli_fetch_array($ssql);
   $lc=$r[0]; 


 

   echo "<div class='uploads'>

   <div class='like' title=".$iid." >  
  
   <div class='usid' title=".$post_id."> 
   </div>
      <div class='hell' title=".$useriid.">
      </div>
      
    <img class='like_icon' src='heart.svg' style='width:2em'>
            <span title=".$lc.">".$lc."</span>
        
</div>
</div>";  




   ?>
   <form method="POST">
        <input type="hidden" value="<?php echo $post_id?>" name="likes">
        <input type="hidden" value="<?php echo $useriid?>" name="imid">
        <input type="hidden" value="<?php echo $iid?>" name="uid">
        <input type="submit" value="like<?php echo $lc ?>" name="like" >
        <input type="text"  name="ctext" placeholder="comment">
        <button name='cmt'>comment</button>
        
    </form> 
   
 
    
</div>
    <?php


$sssql="SELECT comment FROM comment WHERE image_id=$post_id";
$sqql=mysqli_query($conn,$sssql);

while($comr=mysqli_fetch_array($sqql))
{
$ccc=$comr['comment'];
?>
<h4><?php echo $ccc;?></h4>
<?php
}
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

<footer><p style="font-size:0.7em;">lensmAn is a photographer community website<br>using lensmAn as their portfolio</p></footer>
</html>
