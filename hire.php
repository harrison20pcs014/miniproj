<?php
session_start();
error_reporting(0);
include 'db.php';
$po=mysqli_query($conn ,"SELECT images FROM image ORDER BY RAND() LIMIT 1;");
$post1= mysqli_fetch_array($po);
// echo $post1[0];
if(isset($_POST['submit']))
{

    $email=$_POST['mail'];
    $_SESSION['mail']=$email;
    $ps=$_POST['pass'];



    $sql="SELECT email,password FROM user WHERE email='$email' AND password='$ps'";
    $re=mysqli_query($conn,$sql);
    
    if(mysqli_num_rows($re) > 0 && strlen($email) > 0 & strlen($ps)>0)
    {
        header("location:index.php");
    }
    else{
        $err="Enter the correct password";
    }
    

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>HIRE</title>
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
/* .login-page {
  width: 520px;
  /* padding: 8% 0 0; */
  margin: auto;
}
.login-page .form .login{
  margin-top: -31px;
margin-bottom: 26px;
}
/* .form {
  position: relative;
  z-index: 1;
  background: #b2ffef;
  max-width: 520px;
  
  padding: 45px;
  text-align: center;
  border-radius:0em;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
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

} */

.src
{
    display: flex;
    justify-content: center;
    height: 100vh;
    align-items: center;
}
.form
{
    background-color: #4a4a4ab0;
    padding:1em;
    margin:1em;

}

.form button {
  
  outline: 0;
  background-color: #328f8a;
  background-image: linear-gradient(45deg,#328f8a,#08ac4b);
  width: 100%;
  border: 0;
  padding: 15px;
  color: #FFFFFF;
  margin:1em 0em;
  font-size: 14px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
}
body {
  background-color: #328f8a;
  background-image: linear-gradient(45deg,#328f8a,#08ac4b);
  font-family: "Roboto", sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  margin:0;
  color:#ffffff;

}

</style>
</head>
<body>
    <!-- <form method="post">
        <input type=email name=mail placeholder="email">
        <input type=password name=pass placeholder="password" >
        <input type=submit name=submit>

    </form> -->

<div class="src">
    <div class="login-page">
      <div class="form">
        <div class="login">
          <div class="login-header">
          </div>
        </div>
        <form class="login-form" method="post">
            <div>
            <h3 style="text-align:center">HIRE</h3>
<div >
        <label for="photographer">Photographer: <?php echo $_SESSION['namme']?></label>
        <p></p>
        <label for="photographer">Photographer Ph No: <?php echo $_SESSION['ph']?></label>
</div>
<div>
    <h4>Per hour Rs 100, Per day Rs 1000</h4>
       
</div>
        
          <p class="message"> <a href="#">Note: Charges may differ depent on Photographer.</a></p>
        </form>
      </div>
    </div>
    </div>
</div>



</body>
</html>