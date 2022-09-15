<?php

error_reporting(E_ERROR | E_PARSE);
include('./config/config.php');

$errors_array = [];
if (isset($_POST['saveFriend'])) {

    if (isset($_POST['user_name']) && empty($_POST['user_name'])) {
        $errors_array[] = "userName";
    }
    if (isset($_POST['user_phone']) && empty($_POST['user_phone'])) {
        $errors_array[] = "userPhone";
    }
    if (isset($_POST['jop_title']) && empty($_POST['jop_title'])) {
        $errors_array[] = "jopTitle";
    }
    if (isset($_POST['about_friend']) && empty($_POST['about_friend'])) {
        $errors_array[] = "aboutFriend";
    }
    if (!isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors_array[] = "userEemail";
    }

    if (!$errors_array) {

        if (!$db_connection) {
            mysqli_connect_errno();
            exit();
        }
        $friendName = mysqli_escape_string($db_connection, $_POST['user_name']);
        $friendPhone = mysqli_escape_string($db_connection, $_POST['user_phone']);
        $friendEmail = mysqli_escape_string($db_connection, $_POST['user_email']);
        $jobTitle = mysqli_escape_string($db_connection, $_POST['jop_title']);
        $aboutFriend = mysqli_escape_string($db_connection, $_POST['about_friend']);
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
            mysqli_close($db_connection);
            //header('location:index.php');
        }
    }
}