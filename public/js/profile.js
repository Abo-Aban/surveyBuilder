$(document).ready(function(){
    // input fields keyup event
    $('.profile-data input, #p-img').on('keyup change', function(){
        // enable the save changes button if users change any input field
        $('.profile-data #save_changes').prop('disabled', false);
    });

    // save changes on click event handler
    $('.profile-data #save_changes').click(function(){
        // disable the save_changes button after saving
        $(this).prop('disabled', true);
    });

    // pass1, pass2 fields keyup event
    $('.profile-data #pass1, .profile-data #pass2').on('keyup input paste', function(){
        // show the password match-icon if the passwords matches
        if ($('#pass1').val() == $('#pass2').val() && $('#pass1').val() != '' && $('#pass1').val().trim().length >= 8 ){
            $('#pass2').siblings('.inpt-icon').show();
        }else{
            //hide the match-icon
            $('#pass2').siblings('.inpt-icon').hide();
            
        }
    });





/*     //show the password fields when show_pass_btn clicked
    $('#show_change_pass_btn').click(function(){
        //hide the show change pass div btn
        $(this).hide();
        
        //show the change_pass_container
        $('#change_pass_container').show();

        //show the change_pass_btn, and the show_change_pass_btn
        $('#change_pass_btn, #hide_change_pass_btn').show();
    });

    //hide the password fields when change hide_pass_btn clicked
    $('#hide_change_pass_btn').click(function () {
        //hide the change_pass_container, change_pass_btn
        $('#change_pass_container, #change_pass_btn').hide();
        //hide the hide change pass div
        $(this).hide();

        //show the show_change_pass_btn
        $('#show_change_pass_btn').show();
    }); */

});