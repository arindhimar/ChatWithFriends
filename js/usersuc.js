function chat(x) {
    // $('#dispdata').hide();
    // $('#chatdiv').show();
    // $('#chatcontacts').show();
    // $('#chatscreen').show();

    // let temp={flag:14,uid1:localStorage.getItem('self'),uid2:x}
    // $.ajax({
    //     type: "POST",
    //     url: "ajax/ajax.php",
    //     data: temp,
        
    //     // dataType: "dataType",
    //     success: function (response) {
    //         if(response=='done'){
    //             $('navaddacc').trigger('click')
    //         }
    //         else{
    //             $('#addfriendstatus').html('Failed!!');
    //             $('#addfriendstatus').addClass('alert alert-danger m-3');
    //             $('#addfriendstatus').fadeIn(50).delay(2000).fadeOut(50);
    //             $('#addfriendstatus').removeClass('alert alert-danger m-3');
    //         }
            
    //     }
    // });
    

}

function remove(x,y){
    
    let temp={flag:16,uid1:x,uid2:y};
    
    $.ajax({
        type: "POST",
        url: "ajax.ajax.php",
        data: temp,
        dataType: "dataType",   
        success: function (response) {
            
        }
    });
}

$(document).ready(function () {

    let currentURL = window.location.href;
    if ((/[?]{1}/ig).test(currentURL)) {
        // Modify the URL
        let newURL = currentURL.split("?");

        // Change the URL without reloading the page
        window.history.pushState(null, null, newURL[0]);


        //Saving the UID 
        uid = newURL[1].split("=")[1];

        localStorage.setItem("self", uid);
    }



    //Removing class in SideNav Bar
    function removeactive() {
        let navbar = [navaccdisp, chatnavdiv,navshowfr];
        for (let i = 0; i < navbar.length; i++) {
            $(navbar[i]).removeClass('active');
        }
    }


    function hidediv() {
        $('#divaccdisp').hide();
        $('#divaddacc').hide();
        $('#chatscreen').hide();
        $('#chatdiv').hide();
        $('#divallfriends').hide();
        removeactive();
    }

    hidediv();




    //Disp Nav click 
    $('#navaccdisp').on('click', function (event) {
        event.preventDefault();
        hidediv();
        $('#divaccdisp').show();



        //Request for The Category
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
                    // $('#act1').html("<option value=" & response[i] & ">" & response[i] & "</option>")

                }
            }
        });

        $('#navaccdisp').addClass('active');

        //Req For Data for Display
        temp = { flag: 8, uname: null, ucategory: $('#act1').val(), self: localStorage.getItem("self") };
        // console.log(temp);
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



        $('#searchtxt,#act1').on('change', function () {
            temp = { flag: 8, uname: $('#searchtxt').val(), ucategory: $('#act1').val(), self: localStorage.getItem("self") };
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

    })




    $('#chatnavdiv').on('click', function (event) {
        event.preventDefault();
        hidediv();
        $('#chatdiv').show();
    })

    //Trigger Show Friends Div
    $('#navshowfr').on('click',function(event){
        event.preventDefault();
        hidediv();
        $('#divallfriends').show();

        let temp={flag:15,uid:localStorage.getItem('self')};

        $.ajax({
            type: "POST",
            url: "ajax/ajax.php",
            data: temp,
            // dataType: "dataType",
            success: function (response) {
                $('#fralldata').html(response);
            }
        });

    })

    $('#navaccdisp').trigger('click');

});