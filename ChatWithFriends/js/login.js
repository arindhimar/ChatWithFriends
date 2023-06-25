$(document).ready(function () {
    // alert('works')

    let temp = { flag: 9 };

    var serverCaptcha;

    $.ajax({
        type: "POST",
        url: "ajax/ajax.php",
        data: temp,
        // dataType: "dataType",
        success: function (response) {
            // console.log(response);
            serverCaptcha = (JSON.parse(response)).captcha;
        }
    });

    $('#forgotdiv').hide();
    history.pushState(null, null, location.href);
    window.onpopstate = function () {
        history.go(1);
    }
    $('#loginbtn').on('click', function (event) {
        event.preventDefault();




        if ($('#txtuser').val() === '' || $('#txtpass').val() === '') {
            $('#loginmsg').fadeIn(1000).delay(2000).fadeOut(1000);
            $('#loginmsg').addClass('alert alert-danger mt-3');
            $('#loginmsg').html('Invalid Credenetials');
        }
        else {

            console.log($('#txtCaptcha').val())
            //Captcha
            if ($('#txtCaptcha').val() === '') {

                $('#loginmsg').fadeIn(1000).delay(2000).fadeOut(1000);
                $('#loginmsg').addClass('alert alert-warning mt-3');
                $('#loginmsg').html('Please Enter Captcha');
                setTimeout(function () {
                    $('#loginmsg').removeClass('alert alert-warning m-3');
                }, 2000);
            }
            else {
                if ($('#txtCaptcha').val() == serverCaptcha) {
                    let temp = { flag: 1, uid: $('#txtuser').val(), upass: $('#txtpass').val() };
                    $.ajax({
                        type: "POST",
                        url: "ajax/ajax.php",
                        data: temp,
                        // dataType: "dataType",
                        success: function (response) {
                            // console.log(response);
                            if (response == 'invalid') {
                                $('#loginmsg').fadeIn(1000).delay(2000).fadeOut(1000);
                                $('#loginmsg').addClass('alert alert-danger mt-3');
                                $('#loginmsg').html('Invalid Credenetials');
                                setTimeout(function () {
                                    $('#loginmsg').removeClass('alert alert-danger m-3');

                                }, 2000);
                            }
                            else {
                                window.location.href = response;
                            }
                        }
                    });
                }
                else{
                    $('#loginmsg').fadeIn(1000).delay(2000).fadeOut(1000);
                    $('#loginmsg').addClass('alert alert-danger mt-3');
                    $('#loginmsg').html('Invalid Captcha');
                    setTimeout(function () {
                        $('#loginmsg').removeClass('alert alert-warning m-3');
                    }, 2000);
                }
            }



        }
    })

    $('#forgot').on('click', function (event) {
        event.preventDefault();
        $('#forgotdiv').show();
        $('#emailstatus').hide();
    })

    $('#sendemail').on('click', function (event) {
        event.preventDefault();
        let ptemail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (ptemail.test($('#txtemail').val())) {
            let temp = { flag: 16, email: $('#txtemail').val(), accessType: 1 };
            $('#emailstatus').show();
            $.ajax({
                type: "POST",
                url: "ajax/ajax.php",
                data: temp,
                // dataType: "dataType",
                success: function (response) {
                    console.log(response)
                    if (response == 1) {
                        $('#loginmsg').fadeIn(1000).delay(2000).fadeOut(1000);
                        $('#loginmsg').addClass('alert alert-success mt-3');
                        $('#loginmsg').html('Email has been sent!');
                        $('#loginmsg').html('Invalid Credenetials');
                        setTimeout(function () {
                            $('#loginmsg').removeClass('alert alert-success m-3');

                        }, 2000);
                        $('#txtemail').val('');
                        $('#emailstatus').hide();
                    }
                    else if (response == 'wrong') {
                        $('#loginmsg').fadeIn(1000).delay(2000).fadeOut(1000);
                        $('#loginmsg').addClass('alert alert-warning mt-3');
                        $('#loginmsg').html('Unregistered email');
                        setTimeout(function () {
                            $('#loginmsg').removeClass('alert alert-warning m-3');

                        }, 2000);

                        $('#txtemail').val('');
                        $('#emailstatus').hide();
                    }
                    else {
                        $('#loginmsg').fadeIn(1000).delay(2000).fadeOut(1000);
                        $('#loginmsg').addClass('alert alert-danger mt-3');
                        $('#loginmsg').html('Something went wrong!!');
                        setTimeout(function () {
                            $('#loginmsg').removeClass('alert alert-success m-3');

                        }, 2000);
                        $('#txtemail').val('');
                        $('#emailstatus').hide();
                    }
                    $('#forgotdiv').hide();
                }

            });
        }
        else {
            $('#loginmsg').fadeIn(1000).delay(2000).fadeOut(1000);
            $('#loginmsg').addClass('alert alert-danger mt-3');
            $('#loginmsg').html('Please enter a valid Email');
            $('#forgotdiv').hide();
        }
    })


    $('#cancelforget').on('click', function (event) {
        event.preventDefault();
        $('#forgotdiv').hide();

    })

    $('#newuser').on('click', function (event) {
        event.preventDefault();
        // alert('n')
    })

});