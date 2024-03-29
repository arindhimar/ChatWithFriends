<!DOCTYPE html>
<html lang="en">
<?php

require "try.php";

?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChatWithFriends</title>

    <style>

        
        .gradient-custom-2 {
            /* fallback for old browsers */
            background: #fccb90;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
        }

        @media (min-width: 768px) {
            .gradient-form {
                height: 100vh !important;
            }
        }

        @media (min-width: 769px) {
            .gradient-custom-2 {
                border-top-right-radius: .3rem;
                border-bottom-right-radius: .3rem;
            }
        }

        
    </style>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="js/login.js"></script>

</head>

<body>
    <section class="h-100 gradient-form mt-5" style="background-color: #eee;">
        <div class="container py-5 pt-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">

                                    <div class="text-center">

                                        <h4 class="mt-1 mb-5 pb-1">Chat With Friends</h4>
                                    </div>

                                    <form>
                                        <p>Please login to your account</p>

                                        <div class="form-outline mb-4">
                                            <input type="text" class="form-control" id="txtuser" placeholder="Username">

                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" class="form-control" id="txtpass" placeholder="Password">
                                        </div>


                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            <img src="new.jpg" id='captchaImg'>
                                            <input type="text" class="form-control" id="txtCaptcha" placeholder="Enter Catcha">
                                        </div>

                                        <div class="text-center pt-1 mb-1 pb-1">
                                            <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" id='loginbtn' type="button">Login</button>
                                            <a class="text-muted" href="#" id='forgot'>Forgot Credentials</a>
                                        </div>

                                        <div class="form-outline mb-4" id="forgotdiv">
                                            <input type="email" class="form-control mt-3" id="txtemail" placeholder="Your Email Address">
                                            <div class="mx-auto p-2" style="width: 200px;">
                                                <button type="button" class="btn btn-primary" id='sendemail'>Send</button>
                                                <div class="spinner-border spinner-border-sm" id='emailstatus'></div>
                                                <button type="button" class="btn btn-danger" id='cancelforget'>Cancel</button>
                                            </div>

                                        </div>


                                        <div id='loginmsg'>

                                        </div>


                                    </form>

                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h4 class="mb-4">We are more than just a normal chatting website</h4>
                                    <p class="small mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>