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
    <title>Borrow | Library</title>
    <link rel="icon" href="icon.png" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="borrow.css">
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
   
  <section class="borrow-section">
      <div class="main">

<p><b><u>BORROW</u></b></p>
<br>

<!--SEARCH BUTTON-->  
<span class="search-bar">
          <div class="srch">
                <form action="" class="navbar-form" method="post" name="f2">
                    <input class="form-control" type="text" name="search" placeholder="Search id or status..." required="">
                    <button style="background-color: #6db6b9e6;" type="submit" name="submit" class="button">
                    <span><i class="fa fa-search" id="btn"></i></span>
                    </button>
                </form>
          </div>
      </span>  

<!--BORROW TABLE-->
          <form action="" class="navbar-form" method="post" name="f3">
          <table class="borrowtable">
            <tr>
            <th>
                <button type="submit" name="delete_multiple_btn" class="delete-button">Delete</button>
              </th>
              <th>Borrow ID</th>
              <th>Book ID</th>
              <th>Member ID</th>
              <th>Borrow Status</th>
              <th>Borrow Date</th>
              <th>Return Date</th>
              <th>Due Date</th>
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
                $sql = "SELECT * from borrowdetails where borrow_id like '%$_POST[search]%' or borrow_status like '%$_POST[search]%' ";
                $result = $conn-> query($sql);
                if ($result-> num_rows > 0) {
                  while ($row = $result -> fetch_assoc()){
                    ?>
                  <tr>
                  <td>
                      <input type="checkbox" name="delete_id[]" class="delete" value="<?= $row['borrow_id']; ?>">
                    </td>
                    <td><?= $row['borrow_id']; ?></td>
                    <td><?= $row['book_id']; ?></td>
                    <td><?= $row['member_id']; ?></td>
                    <td><?= $row['borrow_status']; ?></td>
                    <td><?= $row['date_borrow']; ?></td>
                    <td><?= $row['date_return']; ?></td>
                    <td><?= $row['due_date']; ?></td>
                    <?php
                    echo "<td>"; ?> <a href="edit_borrow.php?borrow_id=<?php echo $row["borrow_id"];?>"><button type="button" class="tableops">Edit</button></a><?php echo"</td>";
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
                $sql = "SELECT * from borrowdetails";
                $result = $conn-> query($sql);
                if ($result-> num_rows > 0) {
                  while ($row = $result -> fetch_assoc()){
                    ?>
                  <tr>
                  <td>
                      <input type="checkbox" name="delete_id[]" class="delete" value="<?= $row['borrow_id']; ?>">
                    </td>
                    <td><?= $row['borrow_id']; ?></td>
                    <td><?= $row['book_id']; ?></td>
                    <td><?= $row['member_id']; ?></td>
                    <td><?= $row['borrow_status']; ?></td>
                    <td><?= $row['date_borrow']; ?></td>
                    <td><?= $row['date_return']; ?></td>
                    <td><?= $row['due_date']; ?></td>
                  </form>
                    <?php
                    echo "<td>"; ?> <a href="edit_borrow.php?borrow_id=<?php echo $row["borrow_id"];?>"><button type="button" class="tableops">Edit</button></a><?php echo"</td>";
                    echo "</tr>";
                  }
                  echo "</table>";
                }
                else {
                  echo "0 result";
                }

              }
              
              //deleting borrow details from table
              if(isset($_POST['delete_multiple_btn']))
              {
                  $all_id = $_POST['delete_id'];
                  $extract_id = implode(',' , $all_id);

                  $query = "DELETE FROM borrowdetails WHERE borrow_id IN($extract_id) ";
                  $query_run = mysqli_query($conn, $query);
                  echo "<script type='text/javascript'>alert('Record(s) deleted successfully!');</script>";
                  echo "<script type='text/javascript'>document.location='borrow.php'</script>";
              }

            ?>
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
