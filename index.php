<?php

error_reporting(E_ERROR | E_PARSE);
include('./config/config.php');

if (isset($_POST['saveFriend'])) {

  $friendName = $_POST['user_name'];
  $friendPhone = $_POST['user_phone'];
  $friendEmail = $_POST['email'];
  $jobTitle = $_POST['jop_title'];
  $aboutFriend = $_POST['about_friend'];

  $insertingQuery = "INSERT INTO users(userName,userEmail,jobTitle,userPhone,aboutUser) VALUES('$friendName','$friendEmail','$jobTitle','$friendPhone','$aboutFriend')";
  $saveNewFriend = mysqli_query($db_connection, $insertingQuery) or die('error occured when adding new product');

  if ($saveNewFriend) {

    $message[] = "Saving new friend successfully";
    // header('location:index.php');
  } else {

    $message[] = "Feild when save new friend successfully";
    //header('location:index.php');
  }
}
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
      echo '<div class="message"><span>' . $message . '</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
    }
  };
  ?>
    <div class="container-fluid px-1 py-5 mx-auto">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
                <div class="card">
                    <h5 class="text-center mb-4">Saving new friend in your list</h5>
                    <form class="form-card" action="" method="POST">
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">name<span class="text-danger"> *</span></label>
                                <input type="text" id="user_name" name="user_name" placeholder="Enter your  name"
                                    onblur="validate(1)" />
                            </div>
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Phone number<span class="text-danger">
                                        *</span></label>
                                <input type="text" id="user_phone" name="user_phone" placeholder=""
                                    onblur="validate(4)" />
                            </div>
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Business email<span class="text-danger">
                                        *</span></label>
                                <input type="text" id="email" name="email" placeholder="" onblur="validate(3)" />
                            </div>
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">jop title<span class="text-danger">
                                        *</span></label>
                                <input type="text" id="jop_title" name="jop_title" placeholder=""
                                    onblur="validate(5)" />
                            </div>
                        </div>
                        <div class="row justify-content-between text-left"></div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-12 flex-column d-flex">
                                <label class="form-control-label px-3">about your friend<span class="text-danger">
                                        *</span></label>
                                <input type="text" id="about-friend" name="about_friend" placeholder=""
                                    onblur="validate(6)" />
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

        <div class="friends-list">
            <h1 class="text-center">Friends List</h1>
        </div>
    </div>
    <script type="text/javascript" src="./js/validator.js"></script>
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js">
    </script>
</body>

</html>