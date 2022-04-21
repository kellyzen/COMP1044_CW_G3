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
    <title>Books | Library</title>
    <link rel="icon" href="icon.png" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="books.css">
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
 <style>
      /*books table*/
      .bookstable {
        border-collapse: collapse;
        font-size: 18px;
        margin-left: 10px;
        table-layout: auto;
      }

      .bookstable th,.bookstable td{
        padding: 7px;
        width:0.1%;
        max-width:78px;
        border: 1px solid black;
        overflow-wrap: break-word;
      }

      .bookstable th {
        background-color: #c9c7de;
        color: #ffffff;
        text-align: left;
        font-weight: bold;
        font-size: 20px;
      }

      .bookstable tbody tr {
        border-bottom: 1px solid #262240;
      }

      .bookstable tbody tr:nth-of-type(even) {
        background-color: #2f2b4f;
      }

      .bookstable tbody tr:last-of-type {
        border-bottom: 2px solid #c9c7de;
      }

      .bookstable tbody tr.active-row {
        font-weight: bold;
        color: #009879;
      }

      .tableops{
        font-size: 17px;
        padding: 5px;
        background-color:#c9c7de;
        color:#ffffff;
        border: none;
        cursor: pointer;
      }

      /*top buttons*/
      .link{
        font-size: 20px;
        padding:10px;
        padding-left:23px;
        padding-right:23px;
        background-color:#c9c7de;
        color:#ffffff;
        border: none;
        margin-left: 20px;
      }
      .form-control{
        font-size: 11px;
      }

      .link:hover, .tableops:hover, .displayall:hover{
        background-color:#d7d5eb;
      }

      .search-bar{
        display: inline-block;
        margin-top: 10px;
        margin-bottom: 20px;
        margin-left: 20px;
      }

    .form-control{
    font-size: 16px;
    padding: 5px;
    }

    .button{
    border-radius: 1vh;
    margin-bottom: 10px;
    font-size: 16px;
    color: black; 
    width: 70px; 
    height: 30px;
    opacity: 0.7;
    cursor: pointer;
    }

    .button:hover{
      opacity: 1.0;
    }

    .add-button{
      height: 40px;
      width: 120px;
      border-radius: 1vh;
      margin-bottom: 10px;
      margin-left: 20px;
      font-size: 16px;
      color: black; 
      opacity: 0.7;
      cursor: pointer;
    }

    .add-button:hover{
      opacity: 1.0;
    }

    .delete{
      height: 25px;
      width: 25px;
      opacity: 0.7;
    }

    .delete:hover{
      cursor: pointer;
      opacity: 1;
    }

    .delete-button{
    border-radius: 1vh;
    margin-bottom: 10px;
    font-size: 16px;
    color: black; 
    width: 60px; 
    height: 25px;
    opacity: 0.7;
    cursor: pointer;
    }

    .delete-button:hover{
      opacity: 1.0;
    }

    .categorytable{
      margin-top: 30px;
      margin-left: 20px;
      background-color:#93679f;
      width: 250px;
      padding: 10px;

    }

    .categorytable td{
      font-size: 18px;
    }
    
    .categorytable th{
      font-size: 20px;
    }
    </style>
    <!--/////////////////////Books/////////////////////-->
    <section class="books-section">
     <div class="main">
      <br>
      <p><b><u>BOOKS</u></b></p>
      <br>
      <!--ADD BUTTON-->
      <div>
        <a href="add_book.php">
          <button type="submit" name="add" class="add-button">Add Book(s)</button>
        </a>
      </div>
        
        <!--SEARCH BUTTON-->
      <span class="search-bar">
          <div class="srch">
                <form action="" class="navbar-form" method="post" name="f2">
                    <input class="form-control" type="text" name="search" placeholder="Search title or author..." required="">
                    <button style="background-color: #6db6b9e6;" type="submit" name="submit" class="button">
                    <span><i class="fa fa-search" id="btn"></i></span>
                    </button>
                </form>
          </div>
      </span>
          
        <!--BOOK TABLE-->
        <!--creating table-->
          <br>
          <form action="" class="navbar-form" method="post" name="f3">
          <table class="bookstable">
            <tr>
              <th>
                <button type="submit" name="delete_multiple_btn" class="delete-button">Delete</button>
              </th>
              <th>ID</th>
              <th>Title</th>
              <th>Category</th>
              <th>Author</th>
              <th>Copies</th>
              <th>Publication</th>
              <th>Place</th>
              <th>ISBN</th>
              <th>Copyright</th>
              <th>Date Added</th>
              <th>Book Status</th>
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
                $sql = "SELECT * from book where book_title like '%$_POST[search]%' or author like '%$_POST[search]%' ";
                $result = $conn-> query($sql);
                if ($result-> num_rows > 0) {
                  while ($row = $result -> fetch_assoc()){
                    ?>
                  <tr>
                    <td>
                      <input type="checkbox" class="delete" name="delete_id[]" value="<?= $row['book_id']; ?>">
                    </td>
                    <td><?= $row['book_id']; ?></td>
                    <td><?= $row['book_title']; ?></td>
                    <td><?= $row['category_id']; ?></td>
                    <td><?= $row['author']; ?></td>
                    <td><?= $row['book_copies']; ?></td>
                    <td><?= $row['book_pub']; ?></td>
                    <td><?= $row['place_of_publication']; ?></td>
                    <td><?= $row['isbn']; ?></td>
                    <td><?= $row['copyright_year']; ?></td>
                    <td><?= $row['date_added']; ?></td>
                    <td><?= $row['status']; ?></td>
                    <?php
                    echo "<td>"; ?> <a href="edit_book.php?book_id=<?php echo $row["book_id"];?>"><button type="button" class="tableops">Edit</button></a><?php echo"</td>";
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
                $sql = "SELECT * from book";
                $result = $conn-> query($sql);
                if ($result-> num_rows > 0) {
                  while ($row = $result -> fetch_assoc()){
                    ?>
                  <tr>
                    <td>
                      <input type="checkbox" name="delete_id[]" class="delete" value="<?= $row['book_id']; ?>">
                    </td>
                    <td><?= $row['book_id']; ?></td>
                    <td><?= $row['book_title']; ?></td>
                    <td><?= $row['category_id']; ?></td>
                    <td><?= $row['author']; ?></td>
                    <td><?= $row['book_copies']; ?></td>
                    <td><?= $row['book_pub']; ?></td>
                    <td><?= $row['place_of_publication']; ?></td>
                    <td><?= $row['isbn']; ?></td>
                    <td><?= $row['copyright_year']; ?></td>
					<td><?= $row['date_added']; ?></td>
					<td><?= $row['status']; ?></td>
                  </form>
                    <?php
                    echo "<td>"; ?> <a href="edit_book.php?book_id=<?php echo $row["book_id"];?>"><button type="button" class="tableops">Edit</button></a><?php echo"</td>";
                    echo "</tr>";
                  }
                  echo "</table>";
                }
                else {
                  echo "0 result";
                }

              }
              
              //deleting books from table
              if(isset($_POST['delete_multiple_btn']))
              {
                  $all_id = $_POST['delete_id'];
                  $extract_id = implode(',' , $all_id);

                  $query = "DELETE FROM book WHERE book_id IN($extract_id) ";
                  $query_run = mysqli_query($conn, $query);
                  echo "<script type='text/javascript'>alert('Record(s) deleted successfully!');</script>";
                  echo "<script type='text/javascript'>document.location='books.php'</script>";
              }

            ?>
          </table>

          <!--CATEGORY TABLE-->
        <div class="categorytable">
          <?php
          $sql = "SELECT * FROM category"; 
          $result = $conn->query($sql); 
          if ($result->num_rows > 0) 
          { 
            // output data of each row 
            echo "<h5><u>Category:</u></h5><br>";
            echo "
            <table> 
              <tr> 
                <th>Category ID &nbsp;&nbsp;&nbsp;</th>
                <th>Class name</th>
              </tr>";
            while($row = $result->fetch_assoc()) 
            { 
              ?>
              <tr>
                <td><?= $row['category_id']; ?></td>
                <td><?= $row['classname']; ?></td>
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
  
 <div> 
 
</body>
</html>
