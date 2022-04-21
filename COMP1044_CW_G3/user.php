<?php 
session_start();
if(empty($_SESSION['login_user'])):
  header('Location:login.php');
endif;
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>User | Library</title>
    <link rel="icon" href="icon.png" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="user.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <style>
       .user-section{
  position: relative;
  background: #1d1b31;
  min-height: 100vh;
  top: 0;
  left: 78px;
  padding-bottom: 80px;
  width: calc(100% - 78px);
  transition: all 0.5s ease;
  z-index: 2;
}

.sidebar.open ~ .user-section{
  left: 250px;
  width: calc(100% - 250px);
}

.user-section .main{
  display: inline-block;
  color: #ffffff;
  font-size: 26px;
  font-weight: 500;
  margin: 18px
}

.user-section .main p{
  display: inline-block;
  color: #c9c7de;
  font-size: 33px;
  font-weight: 500;
  margin: 18px
}

/*Big Container*/
.big-container{
	text-align: center;
	margin: auto;
	max-width: 500px;
	padding-left: 25px;
	padding-right: 25px;
  padding-bottom: 10px;
	border-radius: 3vh;
	box-shadow: 0px 6px 14px 0px rgba(0,0,0,0.2);
	background: linear-gradient(
		to top,
		rgba(68, 71, 101, 0.6),
		rgba(255, 255, 255, 0.457)
		)
}

.small-container{
  display: inline-block;
  text-align: left;
  flex-basis: 25%;
  padding: 10px;
  margin-left: 20px;
}

.small-container img{
  border-radius: 14vh;
  width: 300px;
}

.info{
	font-size: 23px;
  color: #ffffff;
  padding-left: 30px;
  padding-top: 30px;
  padding-bottom: 30px;
}

.button{
	height: 50px;
	width: 120px;
  border-radius: 1vh;
  margin-bottom: 10px;
  font-size: 18px;
  color: black; 
  opacity: 0.7;
}

.button:hover, input:hover{
  opacity: 1.0;
}

</style>
</head>
<body>

  <!--/////////////////////Sidebar/////////////////////-->

  <div class="sidebar">

    <!--Logo-->
    <div class="logo-details">
      <div class="logo_pic">
        <img src="nottingham logo.png"></img>
        <div class="logo_name"><u>Notts Library</u></div>
      </div>
        <i class="fa fa-bars" id="btn"></i>
    </div>
    <ul class="nav-list">
    
      <li>
        <!--Home-->
        <a href="home.php">
          <i class="fa fa-home" id="btn"></i>
          <span class="links_name">Home</span>
        </a>
         <span class="tooltip">Home</span>
      </li>
      <li>
        <!--User-->
       <a href="user.php">
        <i class="fa fa-user-circle-o" id="btn"></i>
         <span class="links_name">User</span>
       </a>
       <span class="tooltip">User</span>
     </li>
     <li>
       <!--Members-->
       <a href="members.php">
        <i class="fa fa-users" id="btn"></i>
         <span class="links_name">Members</span>
       </a>
       <span class="tooltip">Members</span>
     </li>
     <li>
       <!--Books-->
       <a href="books.php">
        <i class="fa fa-book" id="btn"></i>
         <span class="links_name">Books</span>
       </a>
       <span class="tooltip">Books</span>
     </li>
     <li>
       <!--Borrow-->
       <a href="borrow.php">
        <i class="fa fa-address-book" id="btn"></i>
         <span class="links_name">Borrow</span>
       </a>
       <span class="tooltip">Borrow</span>
     </li>
     <!--Logout-->
     <a href="logout.php">
      <li class="logout">
          <div class= "word">Logout</div>
          <i class="fa fa-sign-out" id="log_out"></i>
      </li>
    </a>
    </ul>
  </div>

  <!--/////////////////////User/////////////////////-->
  <section class="user-section">
    <?php 
    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "librarydb";

    // Create connection 
    $conn = new mysqli($servername, $username, $password, $dbname); 
    // Check connection 
    if ($conn->connect_error) { 
      die("Connection failed: " . $conn->connect_error); 
    }

    $sql = "SELECT * FROM users where username='$_SESSION[login_user]' ;"; 
    $result = $conn->query($sql);
    ?>
      <div class="main">
        <p><b><u>USER</u></b></p>
      </div>
      <div class="big-container"> 
        <div class="small-container">
          <img src="nott2.jpg">
        </div>
        <div class="small-container">
          <?php 
          if ($result->num_rows > 0) { 
            while($row = $result->fetch_assoc()) {
              //user id
              echo "<div class='info'>USER ID: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $row["user_id"]. "</div>";
              
              //username
              echo "<div class='info'>USERNAME: &nbsp;&nbsp;" . $row["username"]. "</div>";
              
              //full name
              echo "<div class='info'>FULL NAME: &nbsp;&nbsp;" . $row["first_name"]. " " . $row["last_name"]. "</div>";
              
              //password
              $asterik = "*";
              for($i=1; $i<strlen($row["password"]);$i++){
                $asterik .= "*";
              }
              echo "<div class='info'>PASSWORD: &nbsp;&nbsp;" . $asterik. "</div>";
            } 
            $conn->close();
          }
          ?>
        </div>
        <br>
        <a href="user_edit_profile.php">
          <button type="submit" name="submit" class="button">Edit Profile</button>
        </a> 
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="user_edit_password.php">
          <button type="submit" name="submit" class="button">Reset Password</button>
        </a>
      </div>
      </div>
  </section>
  

  <!--Java Script when clicking sidebar-->
  <script>
  let sidebar = document.querySelector(".sidebar");
  let closeBtn = document.querySelector("#btn");

  closeBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("open");
  });
  </script>
</body>
</html>
