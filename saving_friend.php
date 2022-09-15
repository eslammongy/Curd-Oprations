<?php

error_reporting(E_ERROR | E_PARSE);
include('./config/config.php');

if (isset($_POST['saveFriend'])) {

    $friendName = $_POST['user_name'];
    $friendPhone = $_POST['user_phone'];
    $friendEmail = $_POST['email'];
    $jobTitle = $_POST['jop_title'];
    $aboutFriend = $_POST['about_friend'];
    $proImage = $_FILES['user_image']['name'];
    $proImageTempName = $_FILES['user_image']['tmp_name'];
    $proImageFolder = 'uploaded_images/' . $proImage;

    $insertingQuery = "INSERT INTO users(userName,userEmail,jobTitle,userPhone,aboutUser,userImage) VALUES('$friendName','$friendEmail','$jobTitle','$friendPhone','$aboutFriend','$proImage')";
    $saveNewFriend = mysqli_query($db_connection, $insertingQuery) or die('error occured when adding new product');

    if ($saveNewFriend) {
        move_uploaded_file($proImageTempName, $proImageFolder);
        $message[] = "Saving new friend successfully";
        // header('location:index.php');
    } else {

        $message[] = "Feild when save new friend successfully";
        //header('location:index.php');
    }
}