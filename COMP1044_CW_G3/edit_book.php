<?php
    session_start();
    if(empty($_SESSION['login_user'])):
        header('Location:login.php');
      endif;
    $conn = mysqli_connect("localhost","root","","librarydb");
                if ($conn-> connect_error){
                    die("Connection failed:".$conn-> connect_error);
                }
    
    $book_id=$_GET["book_id"];
    
    $date_added="";
    $status="";
    $book_copies="";

    $res=mysqli_query($conn,"select * from book where book_id=$book_id");
    while($row=mysqli_fetch_array($res)){
        $book_title=$row["book_title"];
        $category_id=$row["category_id"];
        $author=$row["author"];
        $bookcopies=$row["book_copies"];
        $book_pub=$row["book_pub"];
        $place_of_publication=$row["place_of_publication"];
        $isbn=$row["isbn"];
        $copyright_year=$row["copyright_year"];
        $date_receive= date("Y-m-d\TH:i:s", strtotime($row['date_added']));
        $status=$row["status"];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Book | Library</title>
    <link rel="icon" href="icon.png" />
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
body{
	height: 100px;
	margin-top: 0px;
    width: calc(100%);
    min-height: 180vh;
    transition: all 0.5s ease;
    z-index: 2;
    background: linear-gradient(
		to top,
		rgba(44, 173, 158, 0.8),
		rgba(49, 41, 53, 0.3)
		)
}
.form-group{
    height: 940px;
	width: 450px;
	background-color: black;
	margin: 70px auto;
	opacity: 0.7;
	color: white;
	padding: 20px;
    border-radius: 2vh;
    font-size: 20px;
    box-shadow: 0px 16px 24px 0px rgba(0,0,0,0.8);
}

.form-control{
    font-size: 16px;
    padding: 5px;
}

button{
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

button:hover{
  opacity: 1.0;
}
</style>

</head>
<body>
    <form action="" name="f1" method="post">
        <!--inputs-->
        <div class="form-group">
            <h1 style="font-size: 26px;"><u>Update Book Details</u></h1><br>

            <!--Book Title-->
            <label for="book_title">Book Title: </label><br>
            <input type="text" class="form-control" name="book_title" required="" value="<?php echo $book_title; ?>" ><br><br>
  
            <!--Category-->
            <label for="category_id">Category: </label><br>
            <select class="form-control" name="category_id">
                <option value=1 <?= ($category_id =="1")?"selected": ""?>>Periodical</option>
                <option value=2 <?= ($category_id =="2")?"selected": ""?>>English</option>
                <option value=3 <?= ($category_id =="3")?"selected": ""?>>Math</option>
                <option value=4 <?= ($category_id =="4")?"selected": ""?>>Science</option>
                <option value=5 <?= ($category_id =="5")?"selected": ""?>>Encyclopedia</option>
                <option value=6 <?= ($category_id =="6")?"selected": ""?>>Filipiniana</option>
                <option value=7 <?= ($category_id =="7")?"selected": ""?>>Newspaper</option>
                <option value=8 <?= ($category_id =="8")?"selected": ""?>>General</option>
                <option value=9 <?= ($category_id =="9")?"selected": ""?>>References</option>
			</select>
            <br><br>

            <!--Author-->
            <label for="author">Author: </label><br>
            <input type="text" class="form-control" name="author" value="<?php echo $author; ?>" ><br><br>

            <!--Num of Copies-->
            <label for="book_copies">Num of Copies: </label><br>
            <input type="number" class="form-control" name="book_copies"  value="<?php echo $bookcopies; ?>" min="1"><br><br>

            <!--Book Publisher-->
            <label for="book_pub">Book Publisher: </label><br>
            <input type="text" class="form-control" name="book_pub" value="<?php echo $book_pub; ?>" ><br><br>

            <!--Place of Publication-->
            <label for="place_of_publication">Place of Publication: </label><br>
            <input type="text" class="form-control" name="place_of_publication" value="<?php echo $place_of_publication; ?>" ><br><br>

            <!--ISBN-->
            <label for="isbn">ISBN: </label><br>
            <input type="text" class="form-control" name="isbn"  value="<?php echo $isbn; ?>" ><br><br>

            <!--Copyright Year-->
            <label for="copyright_year">Copyright Year: </label><br>
            <input type="text" class="form-control" name="copyright_year"  value="<?php echo $copyright_year; ?>" ><br><br>

            <!--Date Received-->
            <label for="date_receive">Date Received: </label><br>
            <input type="datetime-local" class="form-control" name="date_receive" value="<?php echo $date_receive; ?>"><br><br>

        
            <!--Book Status-->
            <label for="status">Book Status: </label><br>
            <select class="form-control" name="status">
                <option value="New" <?= ($status =="New")?"selected": ""?>>New</option>
                <option value="Old" <?= ($status =="Old")?"selected": ""?>>Old</option>
                <option value="Archive" <?= ($status =="Archive")?"selected": ""?>>Archive</option>
                <option value="Damage" <?= ($status =="Damage")?"selected": ""?>>Damage</option>
                <option value="Lost" <?= ($status =="Lost")?"selected": ""?>>Lost</option>
			</select>
				<br><br><br>
            <button type="submit" name="update">Update</button>
        </div>
    </form>

    <?php

    if(isset($_POST['update'])){
        mysqli_query($conn,"update book set book_title='$_POST[book_title]',  category_id='$_POST[category_id]', author='$_POST[author]', book_copies='$_POST[book_copies]', book_pub='$_POST[book_pub]', place_of_publication='$_POST[place_of_publication]', isbn='$_POST[isbn]', copyright_year='$_POST[copyright_year]', date_added='$_POST[date_receive]', status='$_POST[status]' where book_id=$book_id");
        ?>
        <script type="text/javascript">
            window.location="books.php";
        </script>
        <?php
    }
    ?>
</body>
</html>
