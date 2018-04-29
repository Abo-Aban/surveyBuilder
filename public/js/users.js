$(function(){

    // handle clicking the enter inside the search button
    $('#search_bar').on('keyup', function (e) {
        //if enter key is pressed
        if (e.which == 13) {
            // search for the matched surveys
            users_search($('#search_bar input').val())
        }
    });
    //handlde the clicking of the icon inside the search-bar
    $('#search_bar #search_btn').click(function (e) {
        e.preventDefault();
        e.stopPropagation();

        // search for the matched surveys
        users_search($(this).siblings('input').val())
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
            users_search('');
        }
    });


    // handling the sort on click event
    $('#sort_btn').click(function(){
        // check the current sort method [0=>desc, 1=>asc]
        var data = {'_token': $('meta[name="XSRF_TOKEN"').attr('content')};
        if($(this).attr('data-sort') == 'asc'){// currently ascending
            data['sort'] = 'desc'; //sort in asc order
        }else{
            data['sort'] = 'asc'; //sort in desc order
        }

        $.post('/ajaxUsersSort', data).done(function(users, status){

            var temp_users = '';
            // show no search results found message
            if(users.length < 1){
                temp_users = '<h3 class="title text-main-danger pt-3"Error Occured, Please Try Again Later.</h3>';
            }else{
                // loop through the search results array if not empty and print the elements
                for(var i = 0; i < users.length; ++i){ 
                    temp_users += '<div class="main-list bg-main-white" onclick="location.assign(\'/profile/' + users[i]['id'] + '\')">';
                    temp_users += '<div class="main-list-icon text-main-dark"><span class="oma-user"></span></div><div class="main-list-sprtr"></div>';
                    temp_users += '<div class="main-list-title text-main-dark">' + users[i]['name'] + '</div>';
                    temp_users += '<div class="main-list-options text-main-dark"><span class="oma-gear"></span></div>';
                    temp_users += '</div>';
                }
                
                // change the sort button icon and data-sort attr
                if(data['sort'] == 'asc'){
                    // set icon to asc & data-sort to asc
                    $('#sort_btn').attr('data-sort', 'asc').html('<span class="oma-sort-alpha-asc"></span>');
                }else if(data['sort'] == 'desc'){
                    //set icon to desc & data-sort to desc
                    $('#sort_btn').attr('data-sort', 'desc').html('<span class="oma-sort-alpha-desc"></span>');
                }
                // assign the search result to users_container
                $('#users_container').html(temp_users);
            }
        });

    });





// deleting user handling
$('#users_container').on('click', '.del_user_btn', function(e){
    e.preventDefault();
    e.stopPropagation();
    // confirm the user
    var conf = confirm("Are You Sure You Want To Delete This User? This Action Cannot Be Undone.")

    // submit the form if confirmed
    if(conf){
        // get the user id
        var uid = $(this).parent().attr('data-user-id');
        // console.log(uid);

        // set the action attribute for the user_del_form
        $('#user_del_form').attr('action', '/users/' + uid);

        $('#user_del_form').submit();
    }
});














    function users_search(query){
        var data = {'_token': $('meta[name="XSRF_TOKEN"]').attr('content') , 'query': query};
        $.post('/ajaxUsersSearch', data).done(function(users, status){
            var temp_users = '';
            // show no search results found message
            if(users.length < 1){
                temp_users = '<h3 class="title text-main-dark pt-3">No Search Results Found For: ' + query + '</h3>';
            }else{
                // loop through the search results array if not empty and print the elements
                for(var i = 0; i < users.length; ++i){ 
                    temp_users += '<div class="main-list bg-main-white" onclick="location.assign(\'/profile/' + users[i]['id'] + '\')">';
                    temp_users += '<div class="main-list-icon text-main-dark"><span class="oma-user"></span></div><div class="main-list-sprtr"></div>';
                    temp_users += '<div class="main-list-title text-main-dark">' + users[i]['name'] + '</div>';
                    temp_users += '<div class="main-list-options text-main-dark"><span class="oma-gear"></span></div>';
                    temp_users += '</div>';
                }
            }
            // assign the search result to users_container
            $('#users_container').html(temp_users);
        });
    }




});