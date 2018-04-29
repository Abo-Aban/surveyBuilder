$(function(){
    //changing the number of alters event
    $('#no_of_alters').change(function(){
        //get the number of alters as integer 
        var alters = parseInt($(this).val());
        var cur_alters = $('#alters .ques-alter').length;
        // var alter_tag = '<div class="inpt-lbl w-100"><div class="bg-main-white ques-alter p-0 m-0 mt-2" ><input type="text" name="alters[]" class="inpt px-3 text-main-dark" placeholder="Alternative"></div></div >';
        //check if the current no of alters is less than the new no.. remove the additional ones
        if(cur_alters > alters){
            for(var i = cur_alters; i > alters; --i){
                $('#alters .ques-alter:last').remove();
            }
        } else { //else if the no of alters is greater than the current alters add the difference
            for (var i = cur_alters; i < alters; ++i) {
                $('#alters').append('<div class="inpt-lbl w-100"><div class="bg-main-white ques-alter p-0 m-0 mt-2" ><input type="text" name="alter_' + (i+1) + '" class="inpt px-3 text-main-dark" placeholder="Alternative"></div></div >');
            }
        }

    });

    //changing the question_type event
    $('.quest-type-btn').on('click', function(){
        //remove the active class of all and add it to the current item
        $('.quest-type-btn').removeClass('active');
        $(this).addClass('active');

        //set the question-type
        $('#question_type').val($(this).attr('data-question-type'));

    });

    // // cancel_survey onclick event
    // $('#cancel_survey').click(function(){
    //     location.assign('{{ url('/surveys/'.$quest->survey_id) }}');
    // });

    

    // enable the save button n any change of the fields
    // $('#question_type, #no_of_alters, textarea.inpt, .alters .inpt, .quest-type-btn').on('keyup change paste click', function(){
    //     // enable the save changes button if users change any input field
    //     console.log('asda');
    //     $('#save_survey').prop('disabled', false);
    // });
    
    // $('#save_survey').click(function(){
    //     //disable the save button
    //     // $('#save_survey').prop('disabled', true);
    // });




});
