<?php
    session_start();
    if(empty($_SESSION['login_user'])):
      header('Location:login.php');
    endif;
    $conn = mysqli_connect("localhost","root","","librarydb");
                if ($conn-> connect_error){
                    die("Connection failed:".$conn-> connect_error);
                }
    $username="";
    $first_name="";
    $last_name="";

    $res=mysqli_query($conn,"select * from users where username='$_SESSION[login_user]'");
    while($row=mysqli_fetch_array($res)){
        $username=$row["username"];
        $first_name=$row["first_name"];
        $last_name=$row["last_name"];
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Edit Profile | Library</title>
    <link rel="icon" href="icon.png" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="change_password.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
.main{
	height: 800px;
	margin-top: 0px;
  padding-top: 90px;
  width: calc(100%);
  min-height: 100vh;
  transition: all 0.5s ease;
  z-index: 2;
  background: linear-gradient(
		to bottom,
		rgba(44, 128, 173, 0.8),
		rgba(19, 1, 48, 0.3)
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
  width: 70px; 
  height: 30px;
  opacity: 0.7;
}

.button:hover, .input:hover{
  opacity: 1.0;
}

.box{
  margin: auto;
	height: 600px;
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
		<h1>Edit Profile</h1><br><br>
		<div>
      <form action="" method="post" >
      <label for="username">Username:</label><br>  
      <input type="text" name="username" class="input" placeholder="  Username" required="" value="<?php echo $username; ?>"><br>
      <label for="first_name">First Name:</label><br>
      <input type="text" name="first_name" class="input" placeholder="  First Name" required="" value="<?php echo $first_name; ?>"><br>
      <label for="last_name">Last Name:</label><br>
      <input type="text" name="last_name" class="input" placeholder="  Last Name" required="" value="<?php echo $last_name; ?>"><br>
      <label for="password">Enter Password:</label><br>
      <input type="password" name="password" class="input" placeholder="  Confirm Password" required=""><br><br>
      <button class="button" type="submit" name="submit" >Update</button>
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
      $count=0;
      $res = mysqli_query($db,"SELECT * from users WHERE password='$_POST[password]' AND username='$_SESSION[login_user]'");
			$count=mysqli_num_rows($res);
      if($count!=0)
			{
        mysqli_query($db,"UPDATE users SET username='$_POST[username]', first_name='$_POST[first_name]', last_name='$_POST[last_name]' WHERE username='$_SESSION[login_user]';");
        $_SESSION['login_user'] = $_POST['username'];
        echo "<script type='text/javascript'>alert('Profile updated!');
        document.location='user.php'</script>";
			}
      else
      {
        echo "<script type='text/javascript'>alert('Wrong password!');
        document.location='user_edit_profile.php'</script>";
      }
		}
	?>

</body>
</html>
