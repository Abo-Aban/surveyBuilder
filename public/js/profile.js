$(document).ready(function(){
    // input fields keyup event
    $('.profile-data input, #p-img').on('keyup change', function(){
        // enable the save changes button if users change any input field
        $('.profile-data #save_changes').prop('disabled', false);
    });

    // save changes on click event handler
    $('.profile-data #save_changes').click(function(){
        // submit the form
        $('#profile_form').submit();
        
        
        // disable the save_changes button after saving
        $(this).prop('disabled', true);
    });

    // password, password2 fields keyup event
    $('.profile-data #password, .profile-data #password2').on('keyup input paste', function(){
        // show the password match-icon if the passwords matches
        if ($('#password').val() == $('#password2').val() && $('#password').val() != '' && $('#password').val().trim().length >= 6 ){
            $('#password2').siblings('.inpt-icon').show();
        }else{
            //hide the match-icon
            $('#password2').siblings('.inpt-icon').hide();
            
        }
    });


    // delete account button onlcick event handler
    $('#del_acc_btn').click(function(){
        //confirm the user of deleting 
        var conf = confirm("Are You Sure You Want To Delete Your Account..? This Action Cannot Be Undone.")
        
        // if confirmed submit delete form
        if(conf){
            $('#del_form').submit();
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