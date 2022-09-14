<?php
include('saving_friend.php');


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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
    <div class="container-fluid px-1 py-5 mx-auto">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
                <div class="card">
                    <h5 class="text-center mb-4">Saving new friend in your list</h5>
                    <form class="form-card" action="" method="post" onsubmit="event.preventDefault()">
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
                                <button type="submit" class="btn-block btn-primary">
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