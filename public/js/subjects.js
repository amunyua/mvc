$('.delete-subject').on('click', function(){
    if(confirm('Are you sure you want to delete subject?')){
        // do some ajax for deleting
        var delete_id = $(this).attr('delete-id');
        if(delete_id != ''){
            $.ajax({
                url: 'delete-subject/'+delete_id,
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    if(data.success){
                        location.reload();
                    }else if(!data.success){

                    }
                }
            });
        }
    }else{
        return false;
    }
});

$('.edit-subject').on('click', function(){
    var edit_id = $(this).attr('edit-id');

    if(edit_id != ''){
        $.ajax({
            url: 'subject_data/'+edit_id,
            type: 'GET',
            dataType: 'json',
            success: function(data){
                $('#subject_name').val(data['subject_name']);
                $('#subject_code').val(data['subject_code']);
                $('#mandatory').val(data['mandatory']);
            }
        });
    }
});

