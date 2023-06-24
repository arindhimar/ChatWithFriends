<?php
require'try.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChatWithFriends</title>

    <link rel="stylesheet" href="css/login.css">
    <style>
    </style>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="js/login.js"></script>

</head>

<body>
    <div class="image-container">

        <div class="overlay">
            <div class="card border-light mb-3">
                <div class="card-header">
                    <h5 class="card-title">Login</h5>
                </div>
                <div class="card-body">
                    <form class="row g-5 mt-3">
                        <div class="mb-3 row">
                            <label for="UserName" class="col-sm-2 form-label">UserName</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="txtuser">
                            </div>
                        </div>


                        <div class="mb-0 row">
                            <label for="inputPassword" class="col-sm-2 form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="txtpass">
                            </div>
                        </div>


                        <div class="row mt-3">

                            <div class="col">
                                <label for="inputCaptcha" class="col-sm-2 form-label">Captcha</label>
                            </div>

                            <div class="col">
                                <img src="new.jpg" id='captchaImg'>
                            </div>

                            <div class="col">
                                <input type="text" class="form-control" id="txtCaptcha">
                            </div>
                        </div>


                        <div class="d-grid gap-2 col-3 mx-auto mt-3">
                            <button class="btn btn-primary" type="button" id='loginbtn'>Login</button>
                        </div>
                    </form>


                    <div id='forgotdiv'>
                        <input type="email" class="form-control mt-3" id="txtemail" placeholder="Your Email Address">
                        <div class="mx-auto p-2" style="width: 200px;">
                            <button type="button" class="btn btn-primary" id='sendemail'>Send</button>
                            <div class="spinner-border spinner-border-sm" id='emailstatus'></div>
                            <button type="button" class="btn btn-danger" id='cancelforget'>Cancel</button>
                        </div>
                    </div>

                    <div id='loginmsg'>

                    </div>



                </div>
                <div class="card-footer text-body-secondary">
                    <p><a href="#" id='forgot'>Forgot Credentials</a>New User?<a href="#" id='newuser'>Register Here</a></p>
                </div>
            </div>
        </div>
    </div>

</body>

</html>