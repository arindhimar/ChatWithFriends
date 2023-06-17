function updateacc(x) {
    window.location.href = "update.php?id=" + x + "?=a";
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
    }


    //removing class
    function removeactive() {
        let navbar = [navaccdisp, navaddacc,navaddcat,navdispchat];
        for (let i = 0; i < navbar.length; i++) {
            $(navbar[i]).removeClass('active');
        }
    }

    //Clearing form data
    function clearuserform() {
        $('#txtname').val('');
        $('#txtemail').val('');
        $('#txtpass').val('');
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

        $('#addaccbtn').on('click', function (event) {
            event.preventDefault();

            let ptname = /^[a-zA-Z]{0,}$/g;
            let ptemail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            let ptpass = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

            if (ptname.test($('#txtname').val()) == true && ptemail.test($('#txtemail').val()) == true && ptpass.test($('#txtpass').val()) == true) {
                if ($('#act1').val() == $('#act2').val() || $('#act2').val() == $('#act3').val() || $('#act3').val() == $('#act1').val()) {
                    // alert('sahdah')
                    $("#addaccstatus").html('Please Select Diffrent activity!!');
                    $('#addaccstatus').addClass('alert alert-danger m-3');
                    $('#addaccstatus').fadeIn(50).delay(2000).fadeOut(50);
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
                                    let temp = { flag: 3, uname: $('#txtname').val(), uemail: $('#txtemail').val(), upass: $('#txtpass').val(), act1: $('#act1').val(), act2: $('#act2').val(), act3: $('#act3').val() };
                                    // console.log(temp);
                                    $.ajax({
                                        type: "POST",
                                        url: "ajax/ajax.php",
                                        data: temp,
                                        // dataType: "dataType",
                                        success: function (response) {
                                            if (response == 'true') {
                                                $("#addaccstatus").html('User Added !! The Form data will be cleared in 2 seconds!!');
                                                $('#addaccstatus').addClass('alert alert-success m-3');
                                                $('#addaccstatus').fadeIn(50).delay(2000).fadeOut(50);
                                                $('#confirmaddacc').fadeOut(2000);
                                                clearuserform();
                                            }
                                            else {
                                                $("#addaccstatus").html('Something Went wrong The Form data will be cleared in 2 seconds!!');
                                                $('#addaccstatus').addClass('alert alert-danger m-3');
                                                $('#addaccstatus').fadeIn(50).delay(2000).fadeOut(50);
                                                $('#confirmaddacc').fadeOut(2000);
                                                clearuserform();
                                            }
                                        }
                                    });
                                }
                                else {
                                    $("#addaccstatus").html('Invalid Admin Password The Form data will be cleared in 2 seconds!!');
                                    $('#addaccstatus').addClass('alert alert-danger m-3');
                                    $('#addaccstatus').fadeIn(50).delay(2000).fadeOut(50);
                                    $('#confirmaddacc').fadeOut(2000); 4
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
                if (ptname.test(name) != true) {
                    $("#addaccstatus").html('Invalid Name!!');
                    $('#addaccstatus').addClass('alert alert-danger m-3');
                    $('#addaccstatus').fadeIn(50).delay(2000).fadeOut(50);
                }
                else if (ptemail.test(email) != true) {
                    $("#addaccstatus").html('Invalid Name!!');
                    $('#addaccstatus').addClass('alert alert-danger m-3');
                    $('#addaccstatus').fadeIn(50).delay(2000).fadeOut(50);
                }
                else if (ptpass.test(pass) != true) {
                    $("#addaccstatus").html('Invalid Name!!');
                    $('#addaccstatus').addClass('alert alert-danger m-3');
                    $('#addaccstatus').fadeIn(50).delay(2000).fadeOut(50);
                }

            }

        })

    })

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

            if (ptcat.test($('#txtaddcat').val())) {
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

    $('#navdispchat').on('click',function(event){
        event.preventDefault();
        removeactive();
        hidenav();

    })

    //Default
    $('#navaddcat').trigger('click');


});