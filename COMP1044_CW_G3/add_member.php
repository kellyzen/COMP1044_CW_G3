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
    <title>Add Member | Library</title>
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
                <a href="members.php" >Back to Member Page</a>
                <div class="card mt-4">
                    <div class="card-header">
                        <h4>Add New Member
                            <a href="javascript:void(0)" class="add-more-form float-end btn btn-primary">ADD MORE</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <form action="multiple_member.php" method="POST">
                        
                            <div class="main-form mt-3 border-bottom">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <!--firstname-->
                                            <label for="firstname">First Name:</label><br>
                                            <input type="text" class="form-control" name="firstname[]" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <!--lastname-->
                                            <label for="lastname">Last Name:</label><br>
                                            <input type="text" class="form-control" name="lastname[]" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <!--gender-->
                                            <label for="gender">Gender:</label><br>
                                            <select class="form-control" name="gender[]"> 
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <!--address-->
                                            <label for="address">Address:</label><br>
                                            <input type="text" class="form-control" name="address[]" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <!--contact-->
                                            <label for="contact">Contact:</label><br>
                                            <input type="text" class="form-control" name="contact[]" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <!--type_id-->
                                            <label for="type_id">ID Type:</label><br>
                                            <select class="form-control" name="type_id[]">
                                                <option value=1>Teacher</option>
                                                <option value=2>Employee</option>
                                                <option value=3>Non-Teaching</option>
                                                <option value=4>Student</option>
                                                <option value=5>Construction</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                        <!--year_level-->
                                        <label for="year_level">Year Level:</label><br>
                                        <select class="form-control" name="year_level[]">
                                            <option value="First Year">First Year</option>
                                            <option value="Second Year">Second Year</option>
                                            <option value="Third Year">Third Year</option>
                                            <option value="Fourth Year">Fourth Year</option>
                                            <option value="Faculty">Faculty</option>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <!--member_status-->
                                            <label for="member_status">Member Status:</label><br>
                                            <select class="form-control" name="member_status[]">
                                                <option value="Active">Active</option>
                                                <option value="Banned">Banned</option>
                                            </select>
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
                                            <!--firstname-->\
                                            <label for="firstname">First Name:</label><br>\
                                            <input type="text" class="form-control" name="firstname[]" required="">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-4">\
                                    <div class="form-group mb-2">\
                                            <!--lastname-->\
                                            <label for="lastname">Last Name:</label><br>\
                                            <input type="text" class="form-control" name="lastname[]" required="">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-4">\
                                        <div class="form-group mb-2">\
                                            <!--gender-->\
                                            <label for="gender">Gender:</label><br>\
                                            <select class="form-control" name="gender[]"> \
                                                <option value="Male">Male</option>\
                                                <option value="Female">Female</option>\
                                            </select>\
                                        </div>\
                                    </div>\
                                    <div class="col-md-4">\
                                        <div class="form-group mb-2">\
                                            <!--address-->\
                                            <label for="address">Address:</label><br>\
                                            <input type="text" class="form-control" name="address[]" required="">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-4">\
                                        <div class="form-group mb-2">\
                                            <!--contact-->\
                                            <label for="contact">Contact:</label><br>\
                                            <input type="text" class="form-control" name="contact[]" required="">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-4">\
                                        <div class="form-group mb-2">\
                                            <!--type_id-->\
                                            <label for="type_id">ID Type:</label><br>\
                                            <select class="form-control" name="type_id[]">\
                                                <option value=1>Teacher</option>\
                                                <option value=2>Employee</option>\
                                                <option value=3>Non-Teaching</option>\
                                                <option value=4>Student</option>\
                                                <option value=5>Construction</option>\
                                            </select>\
                                        </div>\
                                    </div>\
                                    <div class="col-md-4">\
                                        <div class="form-group mb-2">\
                                        <!--year_level-->\
                                        <label for="year_level">Year Level:</label><br>\
                                        <select class="form-control" name="year_level[]">\
                                            <option value="First Year">First Year</option>\
                                            <option value="Second Year">Second Year</option>\
                                            <option value="Third Year">Third Year</option>\
                                            <option value="Fourth Year">Fourth Year</option>\
                                            <option value="Faculty">Faculty</option>\
                                        </select>\
                                        </div>\
                                    </div>\
                                    <div class="col-md-4">\
                                        <div class="form-group mb-2">\
                                            <!--member_status-->\
                                            <label for="member_status">Member Status:</label><br>\
                                            <select class="form-control" name="member_status[]">\
                                                <option value="Active">Active</option>\
                                                <option value="Banned">Banned</option>\
                                            </select>\
                                        </div>\
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