<?php
include('./controller.php');
include('./config/config.php');

$friendsList = searchForFriend($db_connection);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
</head>

<body>
    <div class="container-fluid px-1 py-5 mx-auto">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
                <div class="card">
                    <h5 class="text-center mb-4">Search for a friend <button class="btn-primary"> <a
                                class="text-decoration-none btn-primary" href="friendsList.php">Add New Friend
                            </a></button></h5>
                    <form class="form-card" action="" method="GET">
                        <div class="row justify-content-between text-left">
                            <div class="form-group search-input">
                                <input style="width:80% !important;" type="text" name="search"
                                    placeholder="enter name of friend your search for...">

                                <button class="btn-primary" type="submit" name="submit_search">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="friends-list container-fluid">
            <h1 class="text-center">Friends List</h1>
            <div class="row gy-4">

                <?php

                if (mysqli_num_rows($friendsList) > 0) {
                    while ($row = mysqli_fetch_assoc($friendsList)) {

                ?>
                <div class="col-sm">
                    <div class="card h-100">

                        <img src="uploaded_images/<?php echo $row['userImage']; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title fw-bold"><?php echo $row['userName']; ?></h5>
                            <p class="card-text"><?php echo $row['aboutUser']; ?></p>
                        </div>
                    </div>
                </div>

                <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>

</body>

</html>