$(function(){

    $('#next_btn').attr('disabled', true);

    //never enable next untile user has selected at least one choice

    $('#alters input').on('click keyup change', function(){
        var fg_sel = false;
        $('#alters input').each(function(){
            if($(this).prop('checked')){
                fg_sel = true;
            }
        });
        if(fg_sel){
            //enable
            $('#next_btn').attr('disabled', false);
        }else{
            //disable
            $('#next_btn').attr('disabled', true);
        }
    });
});