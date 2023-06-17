$(document).ready(function () {

    let currentURL = window.location.href;
    if ((/[?]{1}/ig).test(currentURL)) {
        // Modify the URL
        let newURL = currentURL.split("?");

        // Change the URL without reloading the page
        window.history.pushState(null, null, newURL[0]);


        //Saving the UID 
        var uid = newURL[1].split("=")[1];

    }

    function closethis() {
        uid=null;
    }

    //Clearing form data
    function clearuserform() {
        $('#txtname').val('');
        $('#txtemail').val('');
        $('#txtpass').val('');
        // alert('dasda')
    }

    //Adding the category
    let temp = { flag: 4 };
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

    //Request for old values
    temp = { flag: 12, uid: uid };
    $.ajax({
        type: "POST",
        url: "ajax/ajax.php",
        data: temp,
        // dataType: "dataType",
        success: function (response) {
            let olddata = JSON.parse(response);
            $('#txtname').val(olddata.uname);
            $('#txtemail').val(olddata.uemail);
            $('#txtpass').val(olddata.upass);
            $('#act1').val(olddata.a1);
            $('#act2').val(olddata.a2);
            $('#act3').val(olddata.a3);
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
                $('#verifyadddbtn').on('click', function (event) {
                    event.preventDefault();
                    let temp = { flag: 2, upass: $('#txtadminpass').val() };
                    $.ajax({
                        type: "POST",
                        url: "ajax/ajax.php",
                        data: temp,
                        // dataType: "dataType",
                        success: function (response) {
                            // console.log(response);
                            if (response == 'true') {
                                let temp = { flag: 13, uid: uid, uname: $('#txtname').val(), uemail: $('#txtemail').val(), upass: $('#txtpass').val(), act1: $('#act1').val(), act2: $('#act2').val(), act3: $('#act3').val() };
                                // console.log(temp);
                                $.ajax({
                                    type: "POST",
                                    url: "ajax/ajax.php",
                                    data: temp,
                                    // dataType: "dataType",
                                    success: function (response) {
                                        if (response == 'true') {
                                            $("#addaccstatus").html('User Updated !! The page data will be closed in 3 seconds!!');
                                            $('#addaccstatus').addClass('alert alert-success m-3');
                                            $('#addaccstatus').fadeIn(50).delay(2000).fadeOut(50);
                                            $('#confirmaddacc').fadeOut(3000);

                                            clearuserform();
                                        }
                                        else {
                                            $("#addaccstatus").html('Something Went wrong The page will no longer be useful in 3 seconds!!');
                                            $('#addaccstatus').addClass('alert alert-danger m-3');
                                            $('#addaccstatus').fadeIn(50).delay(2000).fadeOut(50);
                                            $('#confirmaddacc').fadeOut(2000);
                                            clearuserform();

                                        }
                                    }
                                });
                            }
                            else {
                                $("#addaccstatus").html('Invalid Admin Password . The page will no longer be useful in 3 seconds!!');
                                $('#addaccstatus').addClass('alert alert-danger m-3');
                                $('#addaccstatus').fadeIn(50).delay(2000).fadeOut(50);
                                $('#confirmaddacc').fadeOut(2000); 4
                                clearuserform();
                                $('#addaccbtn').prop('disabled', false);
                            }

                            setTimeout(closethis, 3000);
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
    $('#divaddacc').slideDown(250);
    $('#addaccstatus').hide();
    $('#confirmaddacc').hide();




});








