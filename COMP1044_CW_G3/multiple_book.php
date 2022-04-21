<?php
session_start();
$con = mysqli_connect("localhost","root","","librarydb");

if(isset($_POST['save_multiple_data']))
{
    $book_title = $_POST['book_title'];
    $category_id = $_POST['category_id'];
    $author = $_POST['author'];
    $book_copies = $_POST['book_copies'];
    $book_pub = $_POST['book_pub'];
    $place_of_publication = $_POST['place_of_publication'];
    $isbn = $_POST['isbn'];
    $copyright_year = $_POST['copyright_year'];
    $date_added = $_POST['date_added'];
    $status = $_POST['status'];

    foreach($book_title as $index => $book_title)
    {
        $s_book_title = $book_title;
        $s_category_id = $category_id[$index];
        $s_author = $author[$index];
        $s_book_copies = $book_copies[$index];
        $s_book_pub = $book_pub[$index];
        $s_place_of_publication = $place_of_publication[$index];
        $s_isbn = $isbn[$index];
        $s_copyright_year = $copyright_year[$index];
        $s_date_added = $date_added[$index];
        $s_status = $status[$index];

        $query = "INSERT INTO book (book_title, category_id, author, book_copies, book_pub, place_of_publication, isbn, copyright_year, date_added, status) VALUES ('$s_book_title','$s_category_id','$s_author','$s_book_copies','$s_book_pub','$s_place_of_publication','$s_isbn','$s_copyright_year','$s_date_added','$s_status')";
        $query_run = mysqli_query($con, $query);
    }

    if($query_run)
    {
        $_SESSION['status'] = "Multiple Data Inserted Successfully";
        header("Location: add_book.php");
        exit(0);
    }
    else
    {
        $_SESSION['status'] = "Data Not Inserted";
        header("Location: add_book.php");
        exit(0);
    }
}
?>