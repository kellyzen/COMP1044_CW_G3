<?php
session_start();
$con = mysqli_connect("localhost","root","","librarydb");

if(isset($_POST['save_multiple_data']))
{
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $type_id = $_POST['type_id'];
    $year_level = $_POST['year_level'];
    $member_status = $_POST['member_status'];

    foreach($firstname as $index => $firstname)
    {
        $s_firstname = $firstname;
        $s_lastname = $lastname[$index];
        $s_gender = $gender[$index];
        $s_address = $address[$index];
        $s_contact = $contact[$index];
        $s_type_id = $type_id[$index];
        $s_year_level = $year_level[$index];
        $s_member_status = $member_status[$index];

        $query = "INSERT INTO member (firstname, lastname, gender, address, contact, type_id, year_level, member_status) VALUES ('$s_firstname','$s_lastname','$s_gender','$s_address','$s_contact','$s_type_id','$s_year_level','$s_member_status')";
        $query_run = mysqli_query($con, $query);
    }

    if($query_run)
    {
        $_SESSION['status'] = "Multiple Data Inserted Successfully";
        header("Location: add_member.php");
        exit(0);
    }
    else
    {
        $_SESSION['status'] = "Data Not Inserted";
        header("Location: add_member.php");
        exit(0);
    }
}
?>