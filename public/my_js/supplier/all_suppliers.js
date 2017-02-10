$('.edit-supplier-btn').on('click',function () {
    var edit_id = $(this).attr('edit-id');
    var action = $(this).attr('action');
    $('#edit-supplier-form').attr('action',action);

    $.ajax({
       url: 'load-supplier-edit-d/'+edit_id,
        dataType: 'json',
        success: function (data) {
            $('#supplier-name').val(data['supplier_name']);
            $('#supp-code').val(data['code']);
            $('#registration_number').val(data['registration_number']);
            $('#phone_number').val(data['phone_number']);
            $('#city').val(data['city']);
            $('#physical_location').val(data['physical_location']);
            $('#supp-status').val(data['status']);
        }
    });
});

$('.delete-supplier-btn').on('click',function(){
    var action = $(this).attr('action');
    $('#delete-supplier-form').attr('action',action);
});