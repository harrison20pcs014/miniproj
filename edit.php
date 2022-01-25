<?php


include 'db.php';

session_start();

$mail=$_SESSION['mail'];

$poo=mysqli_query($conn ,"SELECT * FROM user where email='$mail'");
$post0=mysqli_fetch_array($poo);
$id=$post0[0];
$mail=$post0[1];
$name=$post0[2];
$ph=$post0[3];
$photographer=$post0[6];



if(isset($_POST['submit']))
{
    $newname=$_POST['newname'];

    $proname=$mail.".jpg";
    $filename = $_FILES['file']['name'];
    $tempname = $_FILES['file']['tmp_name'];       
    $folder = getcwd()."/profile/".basename($proname);
    move_uploaded_file($tempname,$folder);



    mysqli_query($conn,"UPDATE user SET name='$newname' WHERE user_id=$id");

    header("location:index.php");


}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <style>
    .propic
    {
        width: 12em;
        height: 12em;
        overflow: hidden;
        transform: translate(-142px, 42px);
        position:absolute;
        z-index:1;
    } 
    .propick
    {
        width: 12em;
        height: 12em;
        overflow: hidden;
        transform: translate(103px, 42px);
    }   
    img 
    {
        width: fit-content;
        height: 12em;
        transform: translate(-68px, 7px);
    }  
    .cont{
        display: flex;
    flex-direction: row;
    grid-gap: 10em;
    width: 100vw;
    height: 100vh;
    justify-content: center;
    }
    .savebut
    {
        width: 6em;
    height: 2em;
    font-family: fantasy;
    font-size: larger;
    background: #15b810;
    color: white;
    border-radius: 0.3em;

    }
    h3
    {
        margin:0;
    }
    .previewpro
    {
        width: fit-content;
    height: 12em;
    transform: translate(-68px, 7px);
    }
    </style>
</head>
<body>
<div class="navbar">
   
    
   <a href="index.php"><p class="logo">lensmAn </p></a>
   
</div>
<div class="cont">
<div onclick="file()" class="propic">
<img id="previewIMG" class="previewpro" >
</div>


<div class="propick">

<a onclick="file()"><img src="profile/<?php echo $mail.".jpg"?>" ></a>
</div>
<div>
    <form method="post" enctype="multipart/form-data">
        <h1 style="color:green">EDIT PROFILE</h1>
        <h3>Name</h3>
        <input name="newname" type="text" value="<?php echo $name ?>">
        <h3>Phone</h3>
        <input name="newph" type="text" value="<?php echo $ph?>">
        <input type="file" name="file" id="su" style="display:none" onchange="previewImage(event)">  
        <div>
        <button name="submit" class="savebut">save & exit</button>
</div>      
       
    </form>
    
</div>
<div>

</div>

</div>
<script>
    function file(){
        document.getElementById("su").click();  
    }

    if ( window.history.replaceState )
        {
            window.history.replaceState( null, null, window.location.href );
        }
    function previewImage(event)
    {
        


        var reader=new FileReader();
        reader.onload=function()
        {
            var output=document.getElementById('previewIMG');
            output.src=reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
</body>
</html>