function updateacc(x) {
    window.location.href = "update.php?id=" + x + "?=0";
}

function del(x) {
    // console.log(x);

    let temp = { flag: 6, uid: x };

    $.ajax({
        type: "POST",
        url: "ajax/ajax.php",
        data: temp,
        // dataType: "dataType",
        success: function (response) {
            $('#navaccdisp').trigger('click');
            // console.log(response);
            console.log(response);
            if (response == 'true') {
                $("#actstatus").html('Account has been deleted!!');
                $('#actstatus').addClass('alert alert-success m-3');
                $('#actstatus').fadeIn(50).delay(2000).fadeOut(50);
            }
            else if (response == false) {
                $("#actstatus").html('Something went wrong , Please try again later!!');
                $('#actstatus').addClass('alert alert-danger m-3');
                $('#actstatus').fadeIn(50).delay(2000).fadeOut(50);
            }
            else {
                $("#actstatus").html('Internal Server Error!!');
                $('#actstatus').addClass('alert alert-dark m-3');
                $('#actstatus').fadeIn(50).delay(2000).fadeOut(50);
            }
        }
    });
}
$(document).ready(function () {
    $('#togglesidebar').trigger('click');

    function hidenav() {
        $('#confirmaddacc').hide();
        $('#divaccdisp').hide();
        $('#divaddacc').hide();
        $('#addaccstatus').hide();
        $('#addcatdiv').hide();
        $('#divallchats').hide();
        $('#userSearch').hide();
    }


    //removing class
    function removeactive() {
        let navbar = [navaccdisp, navaddacc, navaddcat, navdispchat];
        for (let i = 0; i < navbar.length; i++) {
            $(navbar[i]).removeClass('active');
        }
    }

    //Clearing form data
    function clearuserform() {
        $('#txtname').val('');
        $('#txtemail').val('');
        $('#txtpass').val('');
        $('#txtadminpass').val('');
        $('#imgfile').val('');
        $('#addaccbtn').prop('disabled', false);

        // alert('dasda')
    }


    //Search Account
    $('#searchtxt').on('change', function () {
        if ($('#searchtxt').val() == '') {
            $('#navaccdisp').trigger('click');
        } else {
            let temp = { flag: 7, uname: $('#searchtxt').val() };
            $.ajax({
                type: "POST",
                url: "ajax/ajax.php",
                data: temp,
                // dataType: "dataType",
                success: function (response) {
                    // console.log(response);
                    $('#dispdata').html(response);
                    $('#dispdata').hide();
                    $('#dispdata').slideDown(250);
                }
            });
        }
    });

    //Nav - 1 Display all account
    $('#navaccdisp').on('click', function (event) {
        
        event.preventDefault();
        removeactive();
        hidenav();
        $('#userSearch').show();
        $('#divaccdisp').show();
        $('#navaccdisp').addClass('active');




        //Req For Data
        let temp = { flag: 5 };
        $.ajax({
            type: "POST",
            url: "ajax/ajax.php",
            data: temp,
            // dataType: "dataType",
            success: function (response) {
                // console.log(response);
                $('#dispdata').html(response);
                $('#dispdata').hide();
                $('#dispdata').slideDown(250);
            }
        });

    })

    //Nav - 2 Add account
    $('#navaddacc').on('click', function (event) {
        event.preventDefault();
        $('#addaccbtn').prop('disabled', false);
        $('#divaddacc').slideDown(250);

        removeactive();
        clearuserform();
        hidenav();
        $('#divaddacc').show();
        $('#navaddacc').addClass('active');
        $('#addaccbtn').prop('disabled', false);

        let temp = { flag: 4 };


        //Adding the Category
        $.ajax({
            type: "POST",
            url: "ajax/ajax.php",
            data: temp,
            dataType: "JSON",
            success: function (response) {
                $('#act1').html('');
                $('#act2').html('');
                $('#act3').html('');
                for (let i = 0; i < response.length; i++) {

                    $('#act1').append($('<option>', {
                        value: response[i],
                        text: response[i]
                    }));


                    $('#act2').append($('<option>', {
                        value: response[i],
                        text: response[i]
                    }));


                    $('#act3').append($('<option>', {
                        value: response[i],
                        text: response[i]
                    }));

                    // $('#act1').html("<option value=" & response[i] & ">" & response[i] & "</option>")

                }
            }
        });

        //image upload event
        $('#imgfile').on('change', function (event) {
            var file = event.target.files[0];
            var formData = new FormData();
            formData.append('flag', 21);
            formData.append('imgfile', file);

            $.ajax({
                type: "POST",
                url: "ajax/ajax.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    let result = JSON.parse(response);

                    if (result.status == 1) {
                        $('#addaccstatus').html(result.message);
                        localStorage.setItem('filestatus', result.status);
                        $('#addaccstatus').addClass('alert alert-success m-3');
                        $('#addaccstatus').fadeIn(50).delay(2000).fadeOut(50);
                    }
                    else {
                        $('#addaccstatus').html(result.message);
                        localStorage.setItem('filestatus', result.status);
                        $('#addaccstatus').addClass('alert alert-danger m-3');
                        $('#addaccstatus').fadeIn(50).delay(2000).fadeOut(50);
                    }
                    setTimeout(function () {
                        $('#addaccstatus').removeClass('alert alert-danger m-3');
                    }, 2000);
                },
            });
        });



        //Submit add Button click event
        $('#addaccbtn').on('click', function (event) {
            event.preventDefault();

            let ptname = /^[a-zA-Z]{1,}$/g;
            let ptemail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            let ptpass = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

            if (ptname.test($('#txtname').val()) == true&& $('#txtname').val()!="" && ptemail.test($('#txtemail').val()) == true && $('#txtemail').val()!="" && ptpass.test($('#txtpass').val()) == true && $('#txtpass').val()!="" && localStorage.getItem('filestatus') == 1) {
                if ($('#act1').val() == $('#act2').val() || $('#act2').val() == $('#act3').val() || $('#act3').val() == $('#act1').val()) {
                    // alert('sahdah')
                    $("#addaccstatus").html('Please Select Diffrent activity!!');
                    $('#addaccstatus').addClass('alert alert-danger m-3');
                    $('#addaccstatus').fadeIn(50).delay(2000).fadeOut(50);
                    setTimeout(function () {
                        $('#addaccstatus').removeClass('alert alert-danger m-3');
                    }, 2000);
                }
                else {
                    $('#addaccbtn').prop('disabled', true);
                    $('#confirmaddacc').fadeIn(50);
                    $('#verifyadddbtn').on('click', function () {
                        let temp = { flag: 2, upass: $('#txtadminpass').val() };
                        $.ajax({
                            type: "POST",
                            url: "ajax/ajax.php",
                            data: temp,
                            // dataType: "dataType",
                            success: function (response) {
                                // console.log(response);
                                if (response == 'true') {
                                    let temp = new FormData();
                                    temp.append('flag', 3);
                                    temp.append('uname', $('#txtname').val());
                                    temp.append('uemail', $('#txtemail').val());
                                    temp.append('upass', $('#txtpass').val());
                                    temp.append('act1', $('#act1').val());
                                    temp.append('act2', $('#act2').val());
                                    temp.append('act3', $('#act3').val());
                                    let fileInput = document.getElementById('imgfile');
                                    temp.append('imgfile', fileInput.files[0]);
                                    // console.log(temp);
                                    $.ajax({
                                        type: "POST",
                                        url: "ajax/ajax.php",
                                        data: temp,
                                        // dataType: te,
                                        processData: false,
                                        contentType: false,
                                        success: function (response) {
                                            console.log(response);
                                            if (response == 'true') {
                                                $("#addaccstatus").html('User Added !! The Form data will be cleared in 2 seconds!!');
                                                $('#addaccstatus').addClass('alert alert-success m-3');
                                                $('#addaccstatus').fadeIn(50).delay(2000).fadeOut(50);
                                                $('#confirmaddacc').fadeOut(2000);
                                                setTimeout(function () {
                                                    $('#addaccstatus').removeClass('alert alert-success m-3');
                                                }, 2000);
                                                clearuserform();
                                            }
                                            else {
                                                $("#addaccstatus").html('Something Went wrong The Form data will be cleared in 2 seconds!!');
                                                $('#addaccstatus').addClass('alert alert-danger m-3');
                                                $('#addaccstatus').fadeIn(50).delay(2000).fadeOut(50);
                                                $('#confirmaddacc').fadeOut(2000);
                                                setTimeout(function () {
                                                    $('#addaccstatus').removeClass('alert alert-danger m-3');
                                                }, 2000);
                                                clearuserform();
                                            }
                                        }
                                    });
                                }
                                else {
                                    $("#addaccstatus").html('Invalid Admin Password The Form data will be cleared in 2 seconds!!');
                                    $('#addaccstatus').addClass('alert alert-danger m-3');
                                    $('#addaccstatus').fadeIn(50).delay(2000).fadeOut(50);
                                    $('#confirmaddacc').fadeOut(2000);
                                    setTimeout(function () {
                                        $('#addaccstatus').removeClass('alert alert-danger m-3');
                                    }, 2000);
                                    clearuserform();
                                    $('#addaccbtn').prop('disabled', false);
                                }
                            }
                        });
                    })
                }
            }
            else {
                let name = $('#txtname').val();
                let email = $('#txtemail').val();
                let pass = $('#txtpass').val();
                console.log(ptname.test(name));
                if (ptname.test(name) != true) {
                    $("#addaccstatus").html('Invalid Name!!');
                    $('#addaccstatus').addClass('alert alert-danger m-3');
                    $('#addaccstatus').fadeIn(50).delay(2000).fadeOut(50);
                }
                else if (ptemail.test(email) != true) {
                    $("#addaccstatus").html('Invalid Email!!');
                    $('#addaccstatus').addClass('alert alert-danger m-3');
                    $('#addaccstatus').fadeIn(50).delay(2000).fadeOut(50);
                }
                else if (ptpass.test(pass) != true) {
                    $("#addaccstatus").html('Invalid Password!!');
                    $('#addaccstatus').addClass('alert alert-danger m-3');
                    $('#addaccstatus').fadeIn(50).delay(2000).fadeOut(50);
                }
                else if (localStorage.getItem('filestatus') != 1) {
                    $("#addaccstatus").html('File Issue!!');
                    $('#addaccstatus').addClass('alert alert-danger m-3');
                    $('#addaccstatus').fadeIn(50).delay(2000).fadeOut(50);
                }
                setTimeout(function () {
                    $('#addaccstatus').removeClass('alert alert-danger m-3');
                }, 2000);

            }

        })

        $('#addaccbtn').prop('disabled', false);

    })

    //Nav Add Category
    $('#navaddcat').on('click', function (event) {
        event.preventDefault();
        hidenav();
        removeactive();

        $('#addcatdiv').slideDown(250);

        let temp = { flag: 10 };
        $.ajax({
            type: "POST",
            url: "ajax/ajax.php",
            data: temp,
            // dataType: "dataType",
            success: function (response) {
                $('#avaicat').html(response);
            }
        });


        //Show Add category Page
        $('#addcatbtn').on('click', function (event) {
            event.preventDefault();

            let ptcat = /^[a-zA-Z]{0,}$/g;

            if (ptcat.test($('#txtaddcat').val())&&$('#txtaddcat').val()!="") {
                temp = { flag: 11, txtcat: $('#txtaddcat').val() };
                $.ajax({
                    type: "POST",
                    url: "ajax/ajax.php",
                    data: temp,
                    // dataType: "dataType",
                    success: function (response) {
                        console.log(response);
                        if (response == "true") {
                            $('#addcatstatus').html('Category Added');
                            $('#addcatstatus').addClass('alert alert-success m-3');
                            $('#addcatstatus').fadeIn(50).delay(2000).fadeOut(50);
                            $('#addcatstatus').removeClass('alert alert-success m-3');
                            $('#txtaddcat').val('');
                            temp = { flag: 10 };
                            $.ajax({
                                type: "POST",
                                url: "ajax/ajax.php",
                                data: temp,
                                // dataType: "dataType",
                                success: function (response) {
                                    $('#avaicat').html(response);
                                }
                            });
                        }
                        else {
                            $('#addcatstatus').html('Failed!!');
                            $('#addcatstatus').addClass('alert alert-danger m-3');
                            $('#addcatstatus').fadeIn(50).delay(2000).fadeOut(50);
                            $('#addcatstatus').removeClass('alert alert-danger m-3');
                            $('#txtaddcat').val('');
                        }
                    }
                });
            }
            else {
                $('#addcatstatus').html('Invalid Category!!');
                $('#addcatstatus').addClass('alert alert-warning m-3');
                $('#addcatstatus').fadeIn(50).delay(2000).fadeOut(50);
                $('#addcatstatus').removeClass('alert alert-warning m-3');
            }

        })
    })

    //Nav DispChat
    $('#navdispchat').on('click', function (event) {
        event.preventDefault();
        removeactive();
        hidenav();

        let temp={flag:22}

        $.ajax({
            type: "POST",
            url: "ajax/ajax.php",
            data: temp,
            // dataType: "dataType",
            success: function (response) {
                
            }
        });

    })

    //Default
    $('#navaddcat').trigger('click');


});