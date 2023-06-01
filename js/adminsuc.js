$(document).ready(function () {
    $('#togglesidebar').trigger('click');

    function removeactive() {
        let navbar = [navaccdisp, navaddacc];
        for (let i = 0; i < navbar.length; i++) {
            $(navbar[i]).removeClass('active');
        }
    }




    $('#navaccdisp').on('click', function () {
        removeactive();
        $('#divaccdisp').show();
        $('#divaddacc').hide();
        $('#navaccdisp').addClass('active');

    })

    $('#navaddacc').on('click', function () {
        removeactive();
        $('#divaccdisp').hide();
        $('#divaddacc').show();
        $('#navaddacc').addClass('active');

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

        $('#addaccbtn').on('click', function () {

            let ptname = /^[a-zA-Z]+$/g;
            let ptemail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            let ptpass = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

            if  (ptname.test($('#txtname').val()) == true && ptemail.test($('#txtemail').val()) == true && ptpass.test($('#txtpass').val()) == true) {
                if ($('#act1').val() == $('#act2').val() || $('#act2').val() == $('#act3').val() || $('#act3').val() == $('#act1').val()) {
                    alert('sahdah')
                    $("#addaccstatus").html('Please Select Diffrent activity!!');
                    $('#addaccstatus').addClass('alert alert-danger m-3');
                    $('#addaccstatus').fadeIn(50).delay(2000).fadeOut(50);
                }
                else {
                    $('#confirmaddacc').fadeIn(50);
                    $('#verifyadddbtn').on('click', function () {
                        let temp = { flag: 2, upass: $('#txtadminpass').val() };
                        $.ajax({
                            type: "POST",
                            url: "ajax/ajax.php",
                            data: temp,
                            // dataType: "dataType",
                            success: function (response) {
                                console.log(response);
                                if (response == 'true') {
                                    let temp = { flag: 3 };
                                }
                                else {
                                    $("#addaccstatus").html('Invalid Admin Password The Form data will be cleared in 2 seconds!!');
                                    $('#addaccstatus').addClass('alert alert-danger m-3');
                                    $('#addaccstatus').fadeIn(50).delay(2000).fadeOut(50);
                                    $('#confirmaddacc').fadeOut(2000);
                                }
                            }
                        });
                    })
                }
            }
            else if (ptname.test($('#txtname').val())==false) {
                console.log(ptname.test($('#txtname').val()))
                console.log($('#txtname').val())
                $("#addaccstatus").html('Invalid Name!!');
                $('#addaccstatus').addClass('alert alert-danger m-3');
                $('#addaccstatus').fadeIn(50).delay(2000).fadeOut(50);
            }
            else if (ptemail.test($('#txtemail').val()) == false) {
                $("#addaccstatus").html('Invalid Email Id!!');
                $('#addaccstatus').addClass('alert alert-danger m-3');
                $('#addaccstatus').fadeIn(50).delay(2000).fadeOut(50);
            }
            else if (ptpass.test($('#txtpass').val()) == false) {
                $("#addaccstatus").html('Invalid Password!!');
                $('#addaccstatus').addClass('alert alert-danger m-3');
                $('#addaccstatus').fadeIn(50).delay(2000).fadeOut(50);
            }



        })

    })

    //Deafult
    $('#confirmaddacc').hide();
    $('#divaccdisp').hide();
    $('#divaddacc').hide();
    $('#addaccstatus').hide();
    $('#navaccdisp').trigger('click');


});