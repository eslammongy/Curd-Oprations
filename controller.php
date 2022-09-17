<?php

error_reporting(E_ERROR | E_PARSE);
include('./config/config.php');

$errors_array = [];
$messages = [];

function saveNewFriend($db_connection)
{
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
}

function searchForFriend($db_connection)
{

    if (!$db_connection) {
        echo mysqli_connect_errno();
        exit();
    }

    $searchQuery = "SELECT * FROM users ORDER BY id DESC";
    $searchResult = mysqli_query($db_connection, $searchQuery);
    if (isset($_POST['submit_search'])) {
        $searchKey = mysqli_escape_string($db_connection, $_POST['search']);
        $searchQuery = "SELECT * FROM users WHERE `users`.`userName` LIKE '%" . $searchKey . "%' OR `users`.`userEmail` LIKE '%" . $searchKey . "%' ORDER BY id DESC";
        $searchResult = mysqli_query($db_connection, $searchQuery);
        return $searchResult;
    }
    return $searchResult;
}

function deleteFriend($db_connection)
{

    if (!$db_connection) {
        echo mysqli_connect_errno();
        exit();
    }

    if (isset($_POST['delete'])) {
        $deleteID = $_POST['delete'];
        $searchQuery = "DELETE FROM users WHERE id =$deleteID";
        mysqli_query($db_connection, $searchQuery);
        header('location:friendsList.php');
    }
}

function updateCurrentFriend($db_connection)
{
    if (isset($_POST['update_friend'])) {

        if (!$db_connection) {
            mysqli_connect_errno();
            exit();
        }
        $friendID = $_POST['user_id'];
        $friendName = mysqli_escape_string($db_connection, $_POST['user_name']);
        $friendPhone = mysqli_escape_string($db_connection, $_POST['user_phone']);
        $friendEmail = mysqli_escape_string($db_connection, $_POST['user_email']);
        $jobTitle = mysqli_escape_string($db_connection, $_POST['job_title']);
        $aboutFriend = mysqli_escape_string($db_connection, $_POST['user_about']);
        $proImage = $_FILES['user_image']['name'];
        $proImageTempName = $_FILES['user_image']['tmp_name'];
        $proImageFolder = 'uploaded_images/' . $proImage;
        ///"UPDATE products SET name = '$proNameUp', price = '$proPriceUp', image = '$proImageUp' WHERE id = '$updateID'")
        $updatingQuery = "UPDATE users SET userName = '$friendName', userEmail = '$friendEmail', userPhone = '$friendPhone', userImage = '$proImage', jobTitle = '$jobTitle', aboutUser= '$aboutFriend' WHERE id = '$friendID'";
        $updateCurrFriend = mysqli_query($db_connection, $updatingQuery) or die('error occured when adding new product');

        if ($updateCurrFriend) {
            move_uploaded_file($proImageTempName, $proImageFolder);
            $message[] = "update selected friend successfully";
            header('location:friendsList.php');
        } else {
            $message[] = "update selected friend successfully";
            mysqli_close($db_connection);
            header('location:friendsList.php');
        }
    }
}