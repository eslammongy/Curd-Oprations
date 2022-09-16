<?php

include('./controller.php');
include('./config/config.php');
saveNewFriend($db_connection);

?>

<!DOCTYPE html>


<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="css/style.css" rel="stylesheet" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
    <?php
    if (isset($message)) {
        foreach ($message as $message) {
            echo '<div class="message"><span>' . $message . '</span> <button class="btn-close" onclick="this.parentElement.style.display = `none`;"></button>
            <button class="btn-goList"> <a href="friendsList.php"> </a></button>
             </div>';
        }
    };
    ?>
    <div class="container-fluid px-1 py-5 mx-auto">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
                <div class="card">
                    <h5 class="text-center mb-4">Saving new friend in your list <button class="btn-primary"> <a
                                class="text-decoration-none btn-primary" href="friendsList.php">Go Friends List
                            </a></button></h5>
                    <form class="form-card" action="" method="POST" enctype="multipart/form-data">
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label
                                    class="form-control-label px-3"><?php (in_array("userName", $errors_array)) ?  print "please enter valid user name !" : print "enter name" ?><span
                                        class="text-danger"> *</span></label>
                                <input type="text" id="user_name" name="user_name" placeholder="Enter your  name"
                                    onblur="validate(1)"
                                    value="<?php (isset($_POST['user_name'])) ? print $_POST['user_name'] : " "  ?>" />
                            </div>
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label
                                    class="form-control-label px-3"><?php (in_array("userPhone", $errors_array)) ?  print "please enter valid phone number !" : print "enter phone" ?><span
                                        class="text-danger">
                                        *</span></label>
                                <input type="text" id="user_phone" name="user_phone" placeholder="" onblur="validate(4)"
                                    value="<?php (isset($_POST['user_phone'])) ? print $_POST['user_phone'] : " "  ?>" />
                            </div>
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Business email<span class="text-danger">
                                        *</span></label>
                                <input type="text" id="email" name="email" placeholder="" onblur="validate(3)"
                                    value="<?php (isset($_POST['email'])) ? print $_POST['email'] : " "  ?>" />
                            </div>
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">jop title<span class="text-danger">
                                        *</span></label>
                                <input type="text" id="jop_title" name="jop_title" placeholder="" onblur="validate(5)"
                                    value="<?php (isset($_POST['jop_title'])) ? print $_POST['jop_title'] : " "  ?>" />
                            </div>
                        </div>
                        <div class="row justify-content-between text-left"></div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-12 flex-column d-flex">
                                <label class="form-control-label px-3">about your friend<span class="text-danger">
                                        *</span></label>
                                <input type="text" id="about-friend" name="about_friend" placeholder=""
                                    onblur="validate(6)"
                                    value="<?php (isset($_POST['about_friend'])) ? print $_POST['about_friend'] : " "  ?>" />
                            </div>
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-12 flex-column d-flex">
                                <label class="form-control-label px-3">image<span class="text-danger">
                                        *</span></label>
                                <input type="file" name="user_image" accept="image/png, image/jpeg, image/jpg" required>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="form-group col-sm">
                                <button type="submit" name="saveFriend" class="btn-block btn-primary">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <script type="text/javascript" src="./js/validator.js"></script>
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js">
    </script>
</body>

</html>