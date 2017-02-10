/**
 * Created by joel on 12/7/16.
 */

$('.delete_user').on('click', function(){
    if(confirm('Are you sure you want to DELETE the selected User?')){
        return true;
    }else{
        return false;
    }
});

$('.block-btn').on('click', function(){
    if(confirm('Are you sure you want to BLOCK the selected User?')){
        var user_id = $(this).attr('user-id');
        var block_btn = $(this);
        $.ajax({
            url: 'all_users/block-user',
            type: 'POST',
            data: {
                user_id:  user_id,
                _token: $('input[name="_token"]').val()
            },
            dataType: 'json',
            success: function(data){
                if(data.success){
                    Common.splash(data.type,data.message,'#nomodal');
                    setTimeout(function () {
                        location.reload(); // refreshes the page
                    }, 2000);
                } else {
                    Common.splash(data.type,data.message,'#nomodal');
                }
            }
        });
    }else{
        return false;
    }
});

$('.unblock-btn').on('click', function(){
    if(confirm('Are you sure you want to UNBLOCK the selected User?')){
        var user_id = $(this).attr('user-id');
        var block_btn = $(this);
        $.ajax({
            url: 'all_users/unblock-user',
            type: 'POST',
            data: {
                user_id:  user_id,
                _token: $('input[name="_token"]').val()
            },
            dataType: 'json',
            success: function(data){
                if(data.success){
                    Common.splash(data.type,data.message,'#nomodal');
                    setTimeout(function () {
                        location.reload(); // refreshes the page
                    }, 1000);
                } else {
                    Common.splash(data.type,data.message,'#nomodal');
                }
            }
        });
    }else{
        return false;
    }
});

