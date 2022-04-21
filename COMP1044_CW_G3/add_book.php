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
    <title>Add Books | Library</title>
    <link rel="icon" href="icon.png" />
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body{
    height: 100vh;
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
</style>
   </head>

    <body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <?php 
                    if(isset($_SESSION['status']))
                    {
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Hey!</strong> <?php echo $_SESSION['status']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                        unset($_SESSION['status']);
                    }
                ?>
                <br><br>
                <a href="books.php" >Back to Books Page</a>
                <div class="card mt-4">
                    <div class="card-header">
                        <h4>Add New Book
                            <a href="javascript:void(0)" class="add-more-form float-end btn btn-primary">ADD MORE</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <form action="multiple_book.php" method="POST">
                        
                            <div class="main-form mt-3 border-bottom">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <!--title-->
                                            <label for="book_title">Book Title:</label><br>
                                            <input type="text" class="form-control" name="book_title[]" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <!--category-->
                                            <label for="category_id">Category:</label><br>
                                            <select class="form-control" name="category_id[]">
                                                <option value=1>Periodical</option>
                                                <option value=2>English</option>
												<option value=3>Math</option>
												<option value=4>Science</option>
												<option value=5>Encyclopedia</option>
                                                <option value=6>Filipiniana</option>
                                                <option value=7>Newspaper</option>
                                                <option value=8>General</option>
                                                <option value=9>References</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <!--author-->
                                            <label for="author">Author:</label><br>
                                            <input type="text" class="form-control" name="author[]" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                          <!--copies-->
                                            <label for="book_copies">Copies:</label><br>
                                            <input type="number" class="form-control" name="book_copies[]" required="" value="1" min="1">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                         <!--publication-->
                                            <label for="book_pub">Publication:</label><br>
                                            <input type="text" class="form-control" name="book_pub[]" required="">
                                        </div>
                                    </div>
									
									 <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <!--place_of_publication-->
                                            <label for="place_of_publication">Place of Publication:</label><br>
                                            <input type="text" class="form-control" name="place_of_publication[]" required="">
                                        </div>
                                    </div>
									
									 <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <!--isbn-->
                                            <label for="isbn">ISBN:</label><br>
                                            <input type="text" class="form-control" name="isbn[]">
                                        </div>
                                    </div>
                                   
								    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <!--copyright_year-->
                                            <label for="copyright_year">Copyright Year:</label><br>
                                            <input type="year" class="form-control" name="copyright_year[]" required="">
                                        </div>
                                    </div>
									
									 <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <!--date_added-->
                                            <label for="date_added">Date Added:</label><br>
                                            <input type="datetime-local" class="form-control" name="date_added[]" required="">
                                        </div>
										
                                    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <!--book_status-->
                                            <label for="status">Book Status:</label><br>
                                            <select class="form-control" name="status[]">
                                                <option value="New">New</option>
                                                <option value="Archive">Archive</option>
												<option value="Damage">Damage</option>
												<option value="Lost">Lost</option>
												<option value="Old">Old</option>
                                                </select>
                                        </div>
                                    </div>
                                    
                                    </div>
                                </div>
                            </div>

                            <div class="paste-new-forms"></div>

                            <button type="submit" name="save_multiple_data" class="btn btn-primary">Save Multiple Data</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function () {

            $(document).on('click', '.remove-btn', function () {
                $(this).closest('.main-form').remove();
            });
            
            $(document).on('click', '.add-more-form', function () {
                $('.paste-new-forms').append('<div class="main-form mt-3 border-bottom">\
                                <div class="row">\
                                    <div class="col-md-4">\
                                        <div class="form-group mb-2">\
                                            <!--title-->\
                                            <label for="book_title">Book Title:</label><br>\
                                            <input type="text" class="form-control" name="book_title[]" required="">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-4">\
                                        <div class="form-group mb-2">\
                                            <!--category-->\
                                            <label for="category_id">Category:</label><br>\
                                            <select class="form-control" name="category_id[]">\
                                                <option value=1>Periodical</option>\
                                                <option value=2>English</option>\
												<option value=3>Math</option>\
												<option value=4>Science</option>\
												<option value=5>Encyclopedia</option>\
                                                <option value=6>Filipiniana</option>\
                                                <option value=7>Newspaper</option>\
                                                <option value=8>General</option>\
                                                <option value=9>References</option>\
                                                </select>\
                                        </div>\
                                    </div>\
                                    <div class="col-md-4">\
                                        <div class="form-group mb-2">\
                                            <!--author-->\
                                            <label for="author">Author:</label><br>\
                                            <input type="text" class="form-control" name="author[]" required="">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-4">\
                                        <div class="form-group mb-2">\
                                            <!--copies-->\
                                            <label for="book_copies">Copies:</label><br>\
                                            <input type="number" class="form-control" name="book_copies[]" required="" value="1" min="1">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-4">\
                                        <div class="form-group mb-2">\
                                         <!--publication-->\
                                            <label for="book_pub">Publication:</label><br>\
                                            <input type="text" class="form-control" name="book_pub[]" required="">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-4">\
                                        <div class="form-group mb-2">\
                                            <!--place_of_publication-->\
                                            <label for="place_of_publication">Place of Publication:</label><br>\
                                            <input type="text" class="form-control" name="place_of_publication[]" required="">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-4">\
                                        <div class="form-group mb-2">\
                                            <!--isbn-->\
                                            <label for="isbn">ISBN:</label><br>\
                                            <input type="text" class="form-control" name="isbn[]">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-4">\
                                        <div class="form-group mb-2">\
                                            <!--copyright_year-->\
                                            <label for="copyright_year">Copyright Year:</label><br>\
                                            <input type="year" class="form-control" name="copyright_year[]" required="">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-4">\
                                        <div class="form-group mb-2">\
                                            <!--date_added-->\
                                            <label for="date_added">Date Added:</label><br>\
                                            <input type="datetime-local" class="form-control" name="date_added[]" required="">\
                                        </div>\
                                    </div>\
									<div class="col-md-4">\
                                        <div class="form-group mb-2">\
                                            <!--book_status-->\
                                            <label for="status">Book Status:</label><br>\
                                            <select class="form-control" name="status[]">\
                                                <option value="New">New</option>\
                                                <option value="Archive">Archive</option>\
												<option value="Damage">Damage</option>\
												<option value="Lost">Lost</option>\
												<option value="Old">Old</option>\
                                                </select>\
                                        </div>\
                                    <div class="col-md-4">\
                                        <div class="form-group mb-2">\
                                            <br>\
                                            <button type="button" class="remove-btn btn btn-danger">Remove</button>\
                                        </div>\
                                    </div>\
                                </div>\
                            </div>');
            });

        });
    </script>
    </body>
</html>