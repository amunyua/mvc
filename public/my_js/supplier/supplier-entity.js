$('.delete-s-p').on('click',function () {
    var action = $(this).attr('action');
    $('#delete-supp-item').attr('action',action);
});

$('.edit-s-p').on('click',function () {
    var edit_id = $(this).attr('edit-id');
    var action = $(this).attr('action');
    $('#edit-supplier-entity-form').attr('action',action);
    //ajax to get edit ailments
    $.ajax({
        url: 'get-supplier-d-ailm/'+edit_id,
        dateType: 'json',
        success: function (data) {
            $('#supplier-e-id').val(data['supplier_id']);
            $('#s-item_name').val(data['item_name']);
            $('#s-item-code').val(data['item_code']);
            $('#s-item-amount').val(data['amount']);
            $('#i-status').val(data['status']);
        }
    })
})