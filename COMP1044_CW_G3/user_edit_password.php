<?php
    session_start();
    if(empty($_SESSION['login_user'])):
      header('Location:login.php');
    endif;
    $conn = mysqli_connect("localhost","root","","librarydb");
                if ($conn-> connect_error){
                    die("Connection failed:".$conn-> connect_error);
                }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Reset Password | Library</title>
    <link rel="icon" href="icon.png" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="change_password.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
.main{
	height: 700px;
	margin-top: 0px;
  padding-top: 90px;
  width: calc(100%);
  min-height: 100vh;
  transition: all 0.5s ease;
  z-index: 2;
  background: linear-gradient(
		to top,
		rgba(238, 130, 238, 0.6),
		rgba(106, 90, 205, 0.457)
		)
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

form{
  margin: auto 50px;
}

.button{
	height: 40px;
	width: 300px;
  border-radius: 1vh;
  margin-bottom: 10px;
  font-size: 16px;
  color: black; 
  width: 100px; 
  height: 30px;
  opacity: 0.7;
}

.button:hover, .input:hover{
  opacity: 1.0;
}

.box{
  margin: auto;
	height: 520px;
	width: 450px;
	background-color: black;
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
  font-size: 36px;
  color: white;
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
</style>  
   </head>
<body>
<section class="main">
	<div class="box">
    <img src="nottingham logo.png"></img>
		<h1>Reset Password</h1><br><br>
		<div>
      <form action="" method="post" >
        <label for="password">Current Password:</label><br>
        <input type="password" name="current_password" class="input" placeholder="  Enter current password" required="" ><br>
        <label for="password">New Password:</label><br>
        <input type="password" name="password" class="input" placeholder="  Enter new password" required="" ><br>
        <label for="confirm_password">Re-enter New Password:</label><br>
        <input type="password" name="confirm_password" class="input" placeholder="  Re-enter new password" required="" ><br><br>
        <button class="button" type="submit" name="submit" >Update</button><br>
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
    ?>
  
    <?php
      if(isset($_POST['submit']))
      {
        if($_POST['password'] == $_POST['confirm_password'])
        {
          $count=0;
          $res=mysqli_query($db,"SELECT * FROM `users` WHERE password='$_POST[current_password]' AND username='$_SESSION[login_user]';");

          $row= mysqli_fetch_assoc($res);

          $count=mysqli_num_rows($res);

          if($count==0)
          {
              ?>
                  <script type="text/javascript">
                      alert("Error! Current password is incorrect. Please try again.");
                      document.location='user_edit_password.php';
                  </script>

                  <?php
          }
          else
          {
              mysqli_query($db,"UPDATE users SET password='$_POST[password]' WHERE username='$_SESSION[login_user]';")
          ?>
            <script type="text/javascript">
              alert("Profile is updated successfully! Now redirecting back to login screen.");
              document.location='login.php';
            </script> 

          <?php
          }
        }
        else
        {
          echo "<script type='text/javascript'>alert('Error! Please re-enter new password!');</script>";
        }
     }
	?>

</body>
</html>
