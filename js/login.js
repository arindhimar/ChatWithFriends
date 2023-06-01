$(document).ready(function () {
    // alert('works')
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
                        if (response == 'admin') {
                            window.location.href = 'adminsuc.php';
                        }
                        else if (response == 'user') {
                            window.location.href = 'usersuc.php';
                        }
                        else {
                            $('#loginmsg').fadeIn(1000).delay(2000).fadeOut(1000);
                            $('#loginmsg').addClass('alert alert-danger mt-3');
                            $('#loginmsg').html('Invalid Credenetials');
                        }
                    }
                });
            }
        })

    });