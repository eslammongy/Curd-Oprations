<?php

error_reporting(E_ERROR | E_PARSE);
include('config.php');

if (isset($_POST['saveFriend'])) {

    $friendName = $_POST['user_name'];
    $friendPhone = $_POST['user_phone'];
    $friendEmail = $_POST['email'];
    $jobTitle = $_POST['jop_title'];
    $aboutFriend = $_POST['about_friend'];

    $insertingQuery = "INSERT INTO users(userName,userEmail,jobTitle,userPhone,userEmail,aboutUser) VALUES('$friendName','$friendEmail','$jobTitle','$friendPhone','$aboutFriend')";
    $saveNewFriend = mysqli_query($db_connection, $insertingQuery) or die('error occured when adding new product');

    if ($saveNewFriend) {
        $message[] = "Saving new friend successfully";
    } else {
        $message[] = "Feild when save new friend successfully";
    }
}