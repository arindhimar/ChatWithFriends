function chat(targetId) {

    //Request for target profile
    localStorage.setItem('targetId', targetId);
    let temp = { flag: 18, uid: localStorage.getItem('targetId') };
    // console.log(temp);
    $.ajax({
        type: "POST",
        url: "ajax/ajax.php",
        data: temp,
        // dataType: "dataType",
        success: function (response) {
            // console.log(response);
            let userData = JSON.parse(response);

            $('#targetName').html(userData.uname);
            $('#targetActivity').html(userData.a1 + "," + userData.a2 + "," + userData.a3);
            $("#targetImage").attr("src", userData.imgPath);

            //Request for chat 
            temp = { flag: 19, sdid: localStorage.getItem('self'), rcid: localStorage.getItem('targetId'), chid: 0 };
            $.ajax({
                type: "POST",
                url: "ajax/ajax.php",
                data: temp,
                // dataType: "dataType",
                success: function (response) {
                    // console.log(response);
                    $('#userChatDiv').html(response);
                    $('#chatmain').show();
                    var scrollAnchor = document.getElementById('scrollAnchor');
                    scrollAnchor.scrollIntoView();
                    setInterval(update, 2000);
                }
            });
        }
    });
    // setInterval(chat(targetId),1000);
}

function update() {
    //Request for chat 
    temp = { flag: 19, sdid: localStorage.getItem('self'), rcid: localStorage.getItem('targetId'), chid: 0 };
    $.ajax({
        type: "POST",
        url: "ajax/ajax.php",
        data: temp,
        // dataType: "dataType",
        success: function (response) {    
            console.log(response);
            if(response!='same'){
                $('#userChatDiv').html(response);
            }
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

    // console.log(localStorage.getItem('self'));

    //Adding Category Into Select Tab
    function fillCategory() {
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
    }

    // Checking if Message textbox is on focus
    $(document).on('focus', '#txtMsg', function () {
        // Registering the keypress event handler
        $(document).one('keypress', '#txtMsg', function (event) {
            if (event.which === 13) {
                if ($('#txtMsg').val() != '') {
                    temp = { flag: 20, sdid: localStorage.getItem('self'), rcid: localStorage.getItem('targetId'), txtMsg: $('#txtMsg').val() };
                    console.log('called');
                    // Request to send the message
                    $.ajax({
                        type: "POST",
                        url: "ajax/ajax.php",
                        data: temp,
                        success: function (response) {
                            if (response == 'sent') {
                                $('#txtMsg').val('');
                            }
                            else {
                                // Handle the response if needed
                            }
                        }
                    });
                }
            }
        });
    });

    //Display All Friends
    //Req For Data for Display
    let temp = { flag: 8, uname: null, ucategory: $('#act1').val(), self: localStorage.getItem("self") };
    // console.log(temp);
    $.ajax({
        type: "POST",
        url: "ajax/ajax.php",
        data: temp,
        // dataType: "dataType",
        success: function (response) {
            // console.log(response);
            $('#divallfriends').html(response);
            $('#divallfriends').hide();
            $('#divallfriends').slideDown(250);
        }
    });

    //User Search On the Basis of name and category
    $(document).on('change', '#searchtxt, #act1', function () {
        temp = { flag: 8, uname: $('#searchtxt').val(), ucategory: $('#act1').val(), self: localStorage.getItem("self") };
        $.ajax({
            type: "POST",
            url: "ajax/ajax.php",
            data: temp,
            // dataType: "dataType",
            success: function (response) {
                // console.log(response);
                $('#divallfriends').html(response);
                $('#divallfriends').hide();
                $('#divallfriends').slideDown(250);
            }
        });
    });

    function defaultConfig() {
        $('#chatmain').hide();
    }

    //Default Configuration
    fillCategory();
    defaultConfig();
});
