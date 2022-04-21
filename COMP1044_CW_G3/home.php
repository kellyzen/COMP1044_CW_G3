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
    <title>Home | Library</title>
    <link rel="icon" href="icon.png" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

  <!--/////////////////////Home/////////////////////-->
  <section class="home-section">
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

    ?>
      <div class="main">
        <p><b><u>HOME</u></b></p>
      </div>

      <!--Members-->
      <div class="big-container"> 
        <a href="members.php">
        <div class="small-container">
          <i class="fa fa-users" id="btn"></i>
        <?php 
          $sql = "SELECT member.member_id FROM member, users where users.username='$_SESSION[login_user]' ;"; 
          $result = $conn->query($sql);
          if ($result->num_rows > 0) { 
            $num_members = 0;
            while($row = $result->fetch_assoc()) {
              //user id
              $num_members++;
            } 
            echo "<div class='info'>No. Member(s):&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $num_members. "</div>";
          }
          ?>
        </div>
        </a>

        <!--Books-->
          <a href="books.php"> 
          <div class="small-container">
            <i class="fa fa-book" id="btn"></i>
          <?php 
            $sql = "SELECT book.book_id FROM book, users where users.username='$_SESSION[login_user]' ;"; 
            $result = $conn->query($sql);
            if ($result->num_rows > 0) { 
              $num_books = 0;
              while($row = $result->fetch_assoc()) {
                //user id
                $num_books++;
              } 
              echo "<div class='info'>No. Book(s):&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $num_books. "</div>";
            }
            ?>
          </div>
          </a>

        <!--User-->
        <a href="user.php"> 
        <div class="small-container">
          <i class="fa fa-user-circle-o" id="btn"></i>
          <?php 
          $sql = "SELECT * FROM users where username='$_SESSION[login_user]' ;"; 
          $result = $conn->query($sql);
          if ($result->num_rows > 0) { 
            while($row = $result->fetch_assoc()) {
              //username
              echo "<div class='info'>Username: &nbsp;&nbsp;" . $row["username"]. "</div>";
            } 
            $conn->close();
          }
          ?>
        </div>
        </a>
      </div>

      <!--/////////////////////Footer/////////////////////-->
      <div class="footer">
        <p>ABOUT US -----></p>
        <table>
          <tr>
            <td valign="top">
              <ul>
                <li><b><u>Location: </u></b></li><br>
                <li class="title">Block G<br>
                    University of Nottingham Malaysia <br>
                    Jalan Broga, 43500 Semenyih<br>
                    Selangor Darul Ehsan<br>
                    Malaysia
                </li>
              </ul>
            </td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td valign="top">
              <ul>
                <li><b><u>Operating hours: </u></b></li><br>
                <li class="title">Monday to Friday: 9am to 12 midnight <br>
                                  Saturday and Sunday: 10am to 12 midnight<br><br>
                                  <i>*subject to change.</i>
                </li>
              </ul>
            </td>
          </tr>
          <tr>
            <td colspan="3"><br>For more enquiries, please look out for members of staff at The Library or call us on <b>03-8924 8318</b>.</td>
          </tr>
        </table>
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
