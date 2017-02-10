$('.edit-bus-btn').on('click',function () {
    var edit_id = $(this).attr('edit-id');
    var action = $(this).attr('action');
    $('#edit-bus-form').attr('action',action);
    $.ajax({
        url: 'load-bus-details/'+edit_id,
        dataType: 'json',
        success: function (data) {
            $('#number-plate').val(data['number_plate']);
            $('#alias_name').val(data['alias_name']);
            $('#owner_id').val(data['owner_id']);
            $('#status').val(data['status']);

        }
    })
});

$('.del_bus-btn').on('click',function () {
    var delete_id = $(this).attr('del-id');
    var action = $(this).attr('action');
    $('#delete-bus-form').attr('action',action);
});