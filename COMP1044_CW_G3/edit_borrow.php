<?php
    session_start();
    if(empty($_SESSION['login_user'])):
        header('Location:login.php');
      endif;
    $conn = mysqli_connect("localhost","root","","librarydb");
                if ($conn-> connect_error){
                    die("Connection failed:".$conn-> connect_error);
                }
    $borrow_id=$_GET["borrow_id"];
    $borrow_status="";
    $date_returned="";
    $due_date="";

    $res=mysqli_query($conn,"select * from borrowdetails where borrow_id=$borrow_id");
    while($row=mysqli_fetch_array($res)){
        $borrow_status=$row["borrow_status"];
        $date_returned= date("Y-m-d\TH:i:s", strtotime($row['date_return']));
        $due_date=$row["due_date"];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Borrow Details| Library</title>
    <link rel="icon" href="icon.png" />
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
body{
	height: 100px;
	margin-top: 0px;
    width: calc(100%);
    min-height: 100vh;
    transition: all 0.5s ease;
    z-index: 2;
    background: linear-gradient(
		to top,
		rgba(44, 173, 158, 0.8),
		rgba(49, 41, 53, 0.3)
		)
}
.form-group{
    height: 350px;
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
            <h1 style="font-size: 26px;"><u>Update Borrow Details</u></h1><br>
            
			<!--Date Returned-->
            <label for="date_returned">Return Date: </label><br>
            <input type="datetime-local" class="form-control" name="date_returned" required="" value="<?php echo $date_returned; ?>"><br><br>
            
            <!--Due Date-->
            <label for="due_date">Due Date: </label><br>
            <input type="date" class="form-control" name="due_date" required="" value="<?php echo $due_date; ?>"><br><br>
              
            <!--Borrow Status-->
            <label for="borrow_status">Borrow Status: </label><br>
            <select class="form-control" name="borrow_status">
                <option value="pending" <?= ($borrow_status =="pending")?"selected": ""?>>Pending</option>
                <option value="returned" <?= ($borrow_status =="returned")?"selected": ""?>>Returned</option>
            </select>
			<br><br>
            <button type="submit" name="update">Update</button>
        </div>
    </form>

    <?php
    if(isset($_POST['update'])){
        mysqli_query($conn,"update borrowdetails set date_return='$_POST[date_returned]',borrow_status='$_POST[borrow_status]',due_date='$_POST[due_date]' where borrow_id=$borrow_id");
        ?>
        <script type="text/javascript">
            window.location="borrow.php";
        </script>
        <?php
    }
    ?>
</body>
</html>