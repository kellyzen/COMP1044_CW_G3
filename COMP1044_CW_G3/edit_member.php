<?php
    session_start();
    if(empty($_SESSION['login_user'])):
        header('Location:login.php');
      endif;
    $conn = mysqli_connect("localhost","root","","librarydb");
                if ($conn-> connect_error){
                    die("Connection failed:".$conn-> connect_error);
                }
    
    $member_id=$_GET["member_id"];
    
    $firstname="";
    $lastname="";
    $gender="";
    $address="";
    $contact="";
    $type_id="";
    $year_level="";
    $member_status="";

    $res=mysqli_query($conn,"select * from member where member_id=$member_id");
    while($row=mysqli_fetch_array($res)){
        $firstname=$row["firstname"];
        $lastname=$row["lastname"];
        $gender=$row["gender"];
        $address=$row["address"];
        $contact=$row["contact"];
        $type_id=$row["type_id"];
        $year_level=$row["year_level"];
        $member_status=$row["member_status"];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Member | Library</title>
    <link rel="icon" href="icon.png" />
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
body{
	height: 650px;
	margin-top: 0px;
    width: calc(100%);
    min-height: 900px;
    transition: all 0.5s ease;
    z-index: 2;
    background: linear-gradient(
		to top,
		rgba(44, 173, 158, 0.8),
		rgba(49, 41, 53, 0.3)
		)
}
.form-group{
    height: 800px;
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
            <h1 style="font-size: 26px;"><u>Update Member Details</u></h1><br>
            <!--firstname-->
            <label for="firstname">First Name:</label><br>
            <input type="text" class="form-control" name="firstname" required="" value="<?php echo $firstname; ?>"><br><br>
            <!--lastname-->
            <label for="lastname">Last Name:</label><br>
            <input type="text" class="form-control" name="lastname" required="" value="<?php echo $lastname; ?>"><br><br>
            <!--gender-->
            <label for="gender">Gender:</label><br>
            <select class="form-control" name="gender"> 
                <option value="Male"<?= ($gender =="Male")?"selected": ""?>>Male</option>
                <option value="Female"<?= ($gender =="Female")?"selected": ""?>>Female</option>
            </select>
            <br><br>
            <!--address-->                    
            <label for="address">Address:</label><br>
            <textarea type="text" class="form-control" name="address" required="" rows="4" cols="40"><?php echo $address; ?></textarea>
            <br><br>
            <!--contact-->
            <label for="contact">Contact:</label><br>
            <input type="text" class="form-control" name="contact" value="<?php echo $contact; ?>"><br><br>                
            <!--type_id-->
            <label for="type_id">ID Type:</label><br>
            <select class="form-control" name="type_id">
                <option value=1 <?= ($type_id =="1")?"selected": ""?>>Teacher</option>
                <option value=2 <?= ($type_id =="2")?"selected": ""?>>Employee</option>
                <option value=3 <?= ($type_id =="3")?"selected": ""?>>Non-Teaching</option>
                <option value=4 <?= ($type_id =="4")?"selected": ""?>>Student</option>
                <option value=5 <?= ($type_id =="5")?"selected": ""?>>Construction</option>

            </select>
            <br><br>
            <!--year_level-->
            <label for="year_level">Year Level:</label><br>
            <select class="form-control" name="year_level">
                <option value="First Year" <?= ($year_level =="First Year")?"selected": ""?>>First Year</option>
                <option value="Second Year" <?= ($year_level =="Second Year")?"selected": ""?>>Second Year</option>
                <option value="Third Year" <?= ($year_level =="Third Year")?"selected": ""?>>Third Year</option>
                <option value="Fourth Year" <?= ($year_level =="Fourth Year")?"selected": ""?>>Fourth Year</option>
                <option value="Faculty" <?= ($year_level =="Faculty")?"selected": ""?>>Faculty</option>
            </select>
            <br><br>
            <!--member_status-->                    
            <label for="member_status">Member Status:</label><br>
            <select class="form-control" name="member_status">
                <option value="Active" <?= ($member_status =="Active")?"selected": ""?>>Active</option>
                <option value="Banned" <?= ($member_status =="Banned")?"selected": ""?>>Banned</option>
            </select>
            <br><br><br> 
            <button type="submit" name="update">update</button>
        </div>
    </form>

    <?php

    if(isset($_POST['update'])){
        mysqli_query($conn,"update member set firstname='$_POST[firstname]',lastname='$_POST[lastname]',gender='$_POST[gender]',
        address='$_POST[address]',contact='$_POST[contact]',type_id='$_POST[type_id]',year_level='$_POST[year_level]',
        member_status='$_POST[member_status]' where member_id=$member_id");
        ?>
        <script type="text/javascript">
            window.location="members.php";
        </script>
        <?php
    }
    ?>
</body>
</html>