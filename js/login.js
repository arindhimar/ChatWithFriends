$(document).ready(function () {
    // alert('works')
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
                    }
                    else {
                        window.location.href = response;
                    }
                }
            });
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
            let temp = { flag: 16, email: $('#txtemail').val() };
            $('#emailstatus').show();
            $.ajax({
                type: "POST",
                url: "ajax/ajax.php",
                data: temp,
                // dataType: "dataType",
                success: function (response) {
                    if (response == 1) {
                        $('#loginmsg').fadeIn(1000).delay(2000).fadeOut(1000);
                        $('#loginmsg').addClass('alert alert-success mt-3');
                        $('#loginmsg').html('Email has been sent!');
                        $('#txtemail').val('');
                        $('#emailstatus').hide();
                    }
                    else if (response == 'wrong') {
                        $('#loginmsg').fadeIn(1000).delay(2000).fadeOut(1000);
                        $('#loginmsg').addClass('alert alert-warning mt-3');
                        $('#loginmsg').html('Unregistered email');
                        
                        $('#txtemail').val('');
                        $('#emailstatus').hide();
                    }
                    else {
                        $('#loginmsg').fadeIn(1000).delay(2000).fadeOut(1000);
                        $('#loginmsg').addClass('alert alert-danger mt-3');
                        $('#loginmsg').html('Something went wrong!!');
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