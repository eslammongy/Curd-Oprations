<?php
include('./controller.php');
include('./config/config.php');

$friendsList = searchForFriend($db_connection);

deleteFriend($db_connection);
updateCurrentFriend($db_connection);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <title>Friends List</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
</head>

<body>
    <?php
    if (isset($messages)) {
        foreach ($messages as $messages) {
            echo '<div class="me$messages"><span>' . $messages . '</span> <button class="btn-close" onclick="this.parentElement.style.display = `none`;"></button>
            <button class="btn-goList"> <a href="friendsList.php"> </a></button>
             </div>';
        }
    };
    ?>
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
                            <a href="friendsList.php?edit=<?php echo $row['id']; ?>"
                                class="btn btn-primary text-white mt-auto align-self-start">Edit</a>
                            <a href="friendsList.php?delete=<?php echo $row['id']; ?>"
                                class="btn btn-danger text-white mt-auto align-self-end"
                                onclick="return confirm('are you sure you want to delete this product?');">Delete</a>
                        </div>
                    </div>
                </div>

                <?php } ?>
                <?php } ?>
            </div>
        </div>

        <section class="edit-form-container">

            <?php

            if (isset($_GET['edit'])) {
                $edit_id = $_GET['edit'];
                $editQuery = "SELECT * FROM users WHERE id = $edit_id LIMIT 1";

                $edit_query = mysqli_query($db_connection, $editQuery);
                if (mysqli_num_rows($edit_query) > 0) {
                    while ($fetch_edit = mysqli_fetch_assoc($edit_query)) {
            ?>

            <form action="" method="post" enctype="multipart/form-data">
                <img src="uploaded_images/<?php echo $fetch_edit['userImage']; ?>" height="100" alt="">
                <input type="hidden" name="user_id" value="<?php echo $fetch_edit['id']; ?>">
                <input type="text" class="box" required name="user_name" value="<?php echo $fetch_edit['userName']; ?>">
                <input type="email" class="box" required name="user_email"
                    value="<?php echo $fetch_edit['userEmail']; ?>">
                <input type="text" class="box" required name="user_phone"
                    value="<?php echo $fetch_edit['userPhone']; ?>">
                <input type="text" class="box" required name="user_about"
                    value="<?php echo $fetch_edit['aboutUser']; ?>">
                <input type="text" class="box" required name="job_title" value="<?php echo $fetch_edit['jobTitle']; ?>">
                <input type="file" class="box" required name="user_image" accept="image/png, image/jpg, image/jpeg">
                <input type="submit" value="update user info" name="update_friend" class="btn btn-primary text-white">
                <input type="reset" value="cancel" id="close-edit" class="option-btn">
            </form>

            <?php
                    };
                };
                echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
            };
            ?>
            <script>
            document.getElementById('close-edit').onclick = () => {
                document.querySelector('.edit-form-container').style.display = 'none';
                window.location.href = 'friendsList.php';
            }
            </script>
        </section>
    </div>

</body>

</html>