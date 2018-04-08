$(function(){


    /* ============ Fade Alerty When Clicked ============= */
    /* hide the alerty component when clicked if it has a
    fade class*/

    $('.alerty.alerty-fade').click(function(){
        $(this).fadeOut(500);
    });

    /* =================================================== */










    // password, password2 fields keyup event
    $('#password, #password2').on('keyup input paste', function () {
        // show the password match-icon if the passwords matches
        if ($('#password').val() == $('#password2').val() && $('#password').val() != '' && $('#password').val().trim().length >= 6) {
            $('#password2').siblings('.inpt-icon').show();
        } else {
            //hide the match-icon
            $('#password2').siblings('.inpt-icon').hide();

        }
    });

});