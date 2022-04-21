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
    <title>Members | Library</title>
    <link rel="icon" href="icon.png" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="members.css">
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
  <section class="members-section">

    <div class="main">
      <br>
      <p><b><u>MEMBERS</u></b></p>
      <br>
      <!--ADD BUTTON-->
      <div>
        <a href="add_member.php">
          <button type="submit" name="add" class="add-button">Add Member(s)</button>
        </a>
      </div>
        
        <!--SEARCH BUTTON-->
      <span class="search-bar">
          <div class="srch">
                <form action="" class="navbar-form" method="post" name="f2">
                    <input class="form-control" type="text" name="search" placeholder="Search name..." required="">
                    <button style="background-color: #6db6b9e6;" type="submit" name="submit" class="button">
                    <span><i class="fa fa-search" id="btn"></i></span>
                    </button>
                </form>
          </div>
      </span>
          
        <!--MEMBER TABLE-->
        <!--creating table-->
          <br>
          <form action="" class="navbar-form" method="post" name="f3">
          <table class="memberstable">
            <tr>
              <th>
                <button type="submit" name="delete_multiple_btn" class="delete-button">Delete</button>
              </th>
              <th>ID</th>
              <th>Firstname</th>
              <th>Lastname</th>
              <th>Gender</th>
              <th>Address</th>
              <th>Contact</th>
              <th>Type</th>
              <th>Year Level</th>
              <th>Status</th>
              <th></th>
            </tr>
            <?php              
              //connecting to database
              $conn = mysqli_connect("localhost","root","","librarydb");
              if ($conn-> connect_error){
                die("Connection failed:".$conn-> connect_error);
              }

            //displaying table
              if(isset($_POST['submit'])&&!empty($_POST['search']))
              {
                $sql = "SELECT * from member where firstname like '%$_POST[search]%' or lastname like '%$_POST[search]%' ";
                $result = $conn-> query($sql);
                if ($result-> num_rows > 0) {
                  while ($row = $result -> fetch_assoc()){
                    ?>
                  <tr>
                    <td>
                      <input type="checkbox" class="delete" name="delete_id[]" value="<?= $row['member_id']; ?>">
                    </td>
                    <td><?= $row['member_id']; ?></td>
                    <td><?= $row['firstname']; ?></td>
                    <td><?= $row['lastname']; ?></td>
                    <td><?= $row['gender']; ?></td>
                    <td><?= $row['address']; ?></td>
                    <td><?= $row['contact']; ?></td>
                    <td><?= $row['type_id']; ?></td>
                    <td><?= $row['year_level']; ?></td>
                    <td><?= $row['member_status']; ?></td>
                    <?php
                    echo "<td>"; ?> <a href="edit_member.php?member_id=<?php echo $row["member_id"];?>"><button type="button" class="tableops">Edit</button></a><?php echo"</td>";
                    echo "</tr>";
                  }
                  echo "</table>";
                }
                else {
                  echo "0 result";
                }

              }
              else
              {
                $sql = "SELECT * from member";
                $result = $conn-> query($sql);
                if ($result-> num_rows > 0) {
                  while ($row = $result -> fetch_assoc()){
                    ?>
                  <tr>
                    <td>
                      <!--<form action="" class="navbar-form" method="post" name="f3">-->
                      <input type="checkbox" name="delete_id[]" class="delete" value="<?= $row['member_id']; ?>">
                      <!--</form>-->
                    </td>
                    <td><?= $row['member_id']; ?></td>
                    <td><?= $row['firstname']; ?></td>
                    <td><?= $row['lastname']; ?></td>
                    <td><?= $row['gender']; ?></td>
                    <td><?= $row['address']; ?></td>
                    <td><?= $row['contact']; ?></td>
                    <td><?= $row['type_id']; ?></td>
                    <td><?= $row['year_level']; ?></td>
                    <td><?= $row['member_status']; ?></td>
                  </form>
                    <?php
                    echo "<td>"; ?> <a href="edit_member.php?member_id=<?php echo $row["member_id"];?>"><button type="button" class="tableops">Edit</button></a><?php echo"</td>";
                    echo "</tr>";
                  }
                  echo "</table>";
                }
                else {
                  echo "0 result";
                }

              }
              
              //deleting member from table
              if(isset($_POST['delete_multiple_btn']))
              {
                  $all_id = $_POST['delete_id'];
                  $extract_id = implode(',' , $all_id);

                  $query = "DELETE FROM member WHERE member_id IN($extract_id) ";
                  $query_run = mysqli_query($conn, $query);
                  echo "<script type='text/javascript'>alert('Record(s) deleted successfully!');</script>";
                  echo "<script type='text/javascript'>document.location='members.php'</script>";
              }

            ?>
          </table>

        <!--TYPE TABLE-->
        <div class="typetable">
          <?php
          $sql = "SELECT * FROM type"; 
          $result = $conn->query($sql); 
          if ($result->num_rows > 0) 
          { 
            // output data of each row 
            echo "<h5><u>Type:</u></h5><br>";
            echo "
            <table> 
              <tr> 
                <th>Type ID &nbsp;&nbsp;&nbsp;</th>
                <th>Borrower Type</th>
              </tr>";
            while($row = $result->fetch_assoc()) 
            { 
              ?>
              <tr>
                <td><?= $row['type_id']; ?></td>
                <td><?= $row['borrowertype']; ?></td>
              </tr>
              <?php
            }
            echo "</table>"; 
          } 
          $conn->close(); 
          ?>
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