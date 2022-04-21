<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Login | Library</title>
    <link rel="icon" href="icon.png" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
.main{
	height: 650px;
	margin-top: 0px;
  background: #312e4f;
  width: calc(100%);
  min-height: 100vh;
  transition: all 0.5s ease;
  z-index: 2;
}

form .login{
	margin: auto 50px;
}

.input{
	height: 40px;
	width: 300px;
  border-radius: 1vh;
  margin-bottom: 10px;
  padding-left: 10px;
  font-size: 20px;
  opacity: 0.7;
}

.button{
	height: 40px;
	width: 300px;
  border-radius: 1vh;
  margin-bottom: 10px;
  font-size: 16px;
  color: black; 
  width: 70px; 
  height: 30px;
  opacity: 0.7;
}

.button:hover, .input:hover{
  opacity: 1.0;
}

.box{
	height: 450px;
	width: 450px;
	background-color: black;
	margin: 70px auto;
	opacity: 0.7;
	color: white;
	padding: 20px;
  border-radius: 2vh;
  box-shadow: 0px 16px 24px 0px rgba(0,0,0,0.8);
}

.box p{
  color: white; 
  padding-left: 15px;
}

.box h1{
  text-align: center;
}

.box a{
  color: rgb(107, 107, 107);
}

.box a:hover{
  color: white;
}

.box img{
  height: 100px;
  object-fit: cover;
  margin-bottom: 30px;
}

}
</style>
   </head>
<body>
<section>
  <div class="main">
   <br>
    <div class="box">
        <img src="nottingham logo.png"></img>
        <h1 style="font-size: 36px;">Notts Library</h1>
        <h1 style="font-size: 26px;">Log in</h1><br>
      <form  name="login" action="" method="post">
        
        <div class="login">
          <input class="input" type="text" name="username" placeholder="  Username" required=""> <br>
          <input class="input" type="password" name="password" placeholder="  Password" required=""> <br>
          <input class="button" type="submit" name="submit" value="Login"> 
        </div>
      
        <p>
          <br><br>
          <a href="change_password.php">Forgot password?</a>
          <a href="register.php" style='float:right; padding-right:20px;'>Sign up...</a>
        </p>
      </form>
    </div>
  </div>
</section>

  <?php
    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "librarydb";
    // Create connection 
    $db = mysqli_connect($servername, $username, $password, $dbname);  
    // Check connection 
    if ($db->connect_error) { 
      die("Connection failed: " . $db->connect_error); 
    }

    if(isset($_POST['submit']))
    {
      $count=0;
      $res=mysqli_query($db,"SELECT * FROM `users` WHERE username='$_POST[username]' && password='$_POST[password]';");

      //$row= mysqli_fetch_assoc($res);

      $count=mysqli_num_rows($res);

      if($count==0)
      {
        //login unsuccessful
        echo "<script type='text/javascript'>alert('Invalid username or password!');
        document.location='login.php'</script>";
      }
      else
      {
        //login successful
        $_SESSION['login_user'] = $_POST['username'];
        echo "<script type='text/javascript'>document.location='home.php'</script>";
      }
    }

  ?>

</body>
</html>
