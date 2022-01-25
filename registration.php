<?php

include 'db.php';
error_reporting(0);

$po=mysqli_query($conn ,"SELECT images FROM image ORDER BY RAND() LIMIT 1;");
$post1= mysqli_fetch_array($po);





if(isset($_POST['submit']))
{

$name=$_POST['name'];
$mail=$_POST['email'];
$ph=$_POST['phonenumber'];
$ps=$_POST['password'];
$type=$_POST['option'];


$ma=mysqli_query($conn ,"SELECT email FROM user WHERE email='$mail';");
$mal= mysqli_fetch_array($ma);

if($mal[0]==$mail)
{ 
  $err="mail id is already exist";
}

else{
  $proname=$mail.".jpg";
  $filename = $_FILES['file']['name'];
  $tempname = $_FILES['file']['tmp_name'];       
  $folder = getcwd()."/profile/".basename($proname);
  move_uploaded_file($tempname,$folder);


  $sql="INSERT INTO user (email,name,phone,password,pro) VALUE ('$mail','$name','$ph','$ps','$type')";
  $conn->query($sql);
  header("Location:login.php");

}


} 


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>signup</title>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:300);
header .header{
  background-color: #fff;
  height: 45px;
}
header a img{
  width: 134px;
margin-top: 4px;
}
.reg-page {
  width: 360px;
  
  margin: auto;
}
.reg-page .form .reg{
  margin-top: -31px;
margin-bottom: 26px;
}
.form {
  position: relative;
  z-index: 1;
  background: #FFFFFF61;
  max-width: 360px;
  padding: 45px;
  text-align: center;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
  border-radius:2em;
}
.form input {
  font-family: "Roboto", sans-serif;
  outline: 0;
  background: #f2f2f2;
  width: 100%;
  border:0;
  margin: 0 0 15px;
  padding: 15px;
  box-sizing: border-box;
  font-size: 14px;

}
.form input:focus
{
    border-color: green;
    box-shadow: 0px 0px 20px #18a163;

}
.form button {
  font-family: "Roboto", sans-serif;
  text-transform: uppercase;
  outline: 0;
  background-color: #328f8a;
  background-image: linear-gradient(45deg,#328f8a,#08ac4b);
  width: 100%;
  border: 0;
  padding: 15px;
  color: #FFFFFF;
  font-size: 14px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
}
.form .message {
  margin: 15px 0 0;
  color: #000000;
  font-size: 12px;
}
.form .message a {
  color: #4CAF50;
  text-decoration: none;
}

.container {
  position: relative;
  z-index: 1;
  max-width: 300px;
  margin: 0 auto;
}
img
{
    position: fixed;
    margin: 0;
    padding: 0;
    width: -webkit-fill-available;
    height: -webkit-fill-available;
    object-fit:cover;
}
.previewi
{
  position: relative;
    width: fit-content;
    height: 117px;
}

body {
  background-color: #328f8a;
  background-image: linear-gradient(45deg,#328f8a,#08ac4b);
  font-family: "Roboto", sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  margin:0;
  
}
.src
{
    
    height: 100vh;
    width: 100vw;
    background-color: tomato;
    display: flex;
    justify-content: center;
    align-items: center;

}
.option
{
    width: 100%;
    height: 3em;
    margin-bottom: 1em;
    border: none;
}
</style>
</head>
<body>
    <!-- <form method="post">
        <input type="text" placeholder="enter your name" name="name">
        <input type="email" placeholder="email" name="email">
        <input type="number" placeholder="phone no" name="phonenumber">
        <input type="password" placeholder="enter the password" name="password">
        <input type="password" placeholder="confirm password" name="cpassword">
        <input type="submit" value="submit" name="submit">
    </form> -->
    <img src='load/<?php echo $post1[0]?>'>
<div class="src">
    <div class="reg-page">
      <div class="form">
        <div class="reg">
          <div class="reg-header">
            <h3>SIGNUP</h3>
          
          </div>
        </div>
        <form class="reg-form" enctype="multipart/form-data" method="post">
        <select class="option" name="option">
          <option name="user" value="0">user</option>
          <option name="photographer" value="1">photographer</option>
        </select>
       
        <input type="text" placeholder="enter your name" name="name">
        <input type="email" placeholder="email" name="email">
        <p style="color:red"><?php echo $err?></p>
        <input type="number" placeholder="phone no" name="phonenumber">
        <input type="password" placeholder="Password" id="password" name="password" required>
        <input type="password" placeholder="Confirm Password" id="confirm_password" name="cpassword" required>
        <input type="file" name="file"  class="infi" accept="image/*" onchange="previewImage(event)" id="file">
        <img id="previewIMG" class="previewi" >
            
        <button  name="submit">Submit</button>
          <p class="message">ALREADY HAVE AN ACCOUNT  <a href="login.php">LOGIN</a></p>
        </form>
      </div>
    </div>
</div>


<script>

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


if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}




var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword; 
</script>

</body>
</html>