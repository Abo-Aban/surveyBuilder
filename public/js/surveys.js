$(function(){

    // handle clicking the enter inside the search button
    $('#search_bar').on('keyup', function (e) {
        //if enter key is pressed
        if (e.which == 13) {
            // search for the matched surveys
            surveys_search($('#search_bar input').val())
        }
    });
    //handlde the clicking of the icon inside the search-bar
    $('#search_bar #search_btn').click(function (e) {
        e.preventDefault();
        e.stopPropagation();

        // search for the matched surveys
        surveys_search($(this).siblings('input').val())
        // console.log('searching for: ' + );
    });

    // handle the setting search
    $('#show_search_bar').click(function(){

        // if the search bar is hidden
        if($('#search_bar').is(':hidden')){
            // show the search bar
            $('#search_bar').fadeIn(500);

            // give it the focus
            $('#search_bar input').focus()
            
        }else{
            // if the search bar already shown hide it
            $('#search_bar').fadeOut(500);
            
            // reset the search results
            surveys_search('');
        }
    });


    // handling the seetting buttons onclick event
    // 1. delete button
    $('#surveys_container').on('click', '.main-card>.delete-btn', function (e){
        e.preventDefault();
        e.stopPropagation();
        // alert('delete');
        //confirm the user of deleting 
        var conf = confirm("Are You Sure You Want To Delete This Survey? This Action Cannot Be Undone.")
        
        // if confirmed submit delete form
        if(conf){
            //get survey id
            var sid = $(this).parent().attr('data-survey-id');

            // set the form action attr
            //submit the form
            $('#survey_del_form').attr('action', '/surveys/'+sid).submit();
        }
    });
    // 2. edit button
    $('#surveys_container').on('click', '.main-card>.edit-btn', function (e) 
    {
        e.preventDefault();
        e.stopPropagation();

        // get the survey id
        var sid = $(this).parent().attr('data-survey-id');

        location.assign('/surveys/'+sid+'/questions/1/edit');

        // alert('edit');
    });
    // 3. share button
    $('#surveys_container').on('click', '.main-card>.share-btn', function (e) 
    {
        // e.preventDefault();
        // e.stopPropagation();
        alert('share');
    });

    //handling the setting dropdown btns
    // 1. delete button
    $('#stng #show_delete_btn').on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        // append
        append_main_card_tiny('delete');

        //hide the dropdown
        $('.settings-dropdown').dropdown('toggle');
    });

    // 2. edit button
    $('#stng #show_edit_btn').on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        // append
        append_main_card_tiny('edit');

        //hide the dropdown
        $('.settings-dropdown').dropdown('toggle');
    });

    // 3. share button
    $('#stng #show_share_btn').on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        // append
        append_main_card_tiny('share');

        //hide the dropdown
        $('.settings-dropdown').dropdown('toggle');
    });


    // hide the tiny buttons in case uesr click outside the container
    $('body').click(function(){
        remove_tiny();
    });



    // deleteing question
    $('.quest-del-btn').on('click', function(e){
        e.preventDefault();
        e.stopPropagation();
        
        // confirm the user
        var conf = confirm("Are You Sure You Want To Delete This Question?")

        // submit the form if confirmed
        if(conf){
            // get the question id
            var qid = $(this).parent().attr('data-question-id');
            // console.log(qid);

            // set the action attribute for the quest_del_form
            $('#quest_del_form').attr('action', $('#del_path').val() + qid);

            $('#quest_del_form').submit();
        }
    });



    $('#delete_btn').click(function(){
        //confirm the user of deleting 
        var conf = confirm("Are You Sure You Want To Delete This Survey? This Action Cannot Be Undone.")
        
        // if confirmed submit delete form
        if(conf){
            $('#survey_del_form').submit();
        }
    });

    //instantiate an instance of QR
    try{
        var qrcode = new QRCode(document.getElementById("share_url_qr"), {
            width : 200,
            height : 200
        });
    }catch(exception){}

    // seal button
    $('#seal_btn').click(function(){
        // seal the survey\
        var conf = confirm("Do You Want To Seal The Survey So You Can Share It?");

        if(conf){
            // get the survey id
            var sid = $(this).attr('data-survey-id');

            data = { '_token': $('meta[name="XSRF_TOKEN"]').attr('content'), 'sid': sid };
            console.log(data);
            $.post('/ajaxSealSurvey', data).done(function(data, status){
                console.log(data);
                if(data == 'done'){
                    alert('Survey Sealed Successfuly.');
                }
            });
        }
    });

    // // share click event
    $('#share_btn').click(function(){
        // show the share modal
        $('#shareModal').modal('show');
        //generate QR sharing code
        makeCode();
    });


    
    
    function makeCode () {		
        var elText = document.getElementById("share_url");
        
        if (!elText.value) {
            alert("Input a text");
            elText.focus();
            return;
        }
        
        qrcode.makeCode(elText.value);
    }

   
    // var qrcode = new qrcode($('#shre_url_qr'), {
    //     width: 400,
    //     height: 400,
    // });










    
    //function to append tiny-option buttons
    function append_main_card_tiny(tiny_type){
        // remove the tiny button from all main-card instances 
        remove_tiny();
        // preappend the proper tiny-option-btn to all main-card objects
        switch(tiny_type){
            // delete button
            case 'delete':
                $('.main-card').prepend('<div class="tiny-option-btn delete-btn"><span class="oma-trash"></span></div>');
                break;

            // delete button
            case 'edit':
                $('.main-card').each(function(e){
                    if($(this).attr('data-sealed') == 'no')
                        $(this).prepend('<div class="tiny-option-btn edit-btn"><span class="oma-edit"></span></div>');
                    else
                    $(this).prepend('<div class="tiny-option-btn"><span class="oma-lock4"></span></div>');
                });
                break;

            // delete button
            case 'share':
                $('.main-card').prepend('<div class="tiny-option-btn share-btn"><span class="oma-share-alt"></span></div>');
                break;
        }
    }

    // remove the tiny buttons
    function remove_tiny(){
        $('.main-card .tiny-option-btn').remove();
    }


    // search function
    function surveys_search(query){
        var data = {'_token': $('meta[name="XSRF_TOKEN"]').attr('content') , 'query': query};
        $.post('/ajaxSurveysSearch', data).done(function(surveys, status){
            var temp_surveys = '';
            // show no search results found message
            if(surveys.length < 1){
                temp_surveys = '<h3 class="title text-main-dark pt-3">No Search Results Found For: ' + query + '</h3>';
            }else{
                // loop through the search results array if not empty and print the elements
                for(var i = 0; i < surveys.length; ++i){ 
                    temp_surveys += '<div class="main-card" onclick="location.assign(\'/surveys/'+surveys[i]['id']+'\')" data-survey-id="'+surveys[i]['id']+'" >';
                    temp_surveys += '<div class="main-card-bdy bg-main-dark text-main-light"><span class="img-survey-alt"></span></div>';
                    temp_surveys += '<div class="main-card-title bg-main-light-dark text-main-light">'+surveys[i]['title']+'</div>';
                    temp_surveys += '</div>';
                }
            }
            // assign the search result to surveys_container
            $('#surveys_container').html(temp_surveys);
        });
    }

});