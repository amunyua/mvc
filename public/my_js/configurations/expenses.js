/**
 * Created by alex on 16/11/16.
 */

$('.edit-expense-btn').on('click',function () {
   var edit_id = $(this).attr('edit-id');
    var action = $(this).attr('action');
    $('#edit-expense-form').attr('action',action);
    $.ajax({
       url: '/load-expense-edit-details/'+edit_id,
        dataType: 'json',
        success: function (data) {
            $('#expense_name').val(data['expense_name']);
            $('#code').val(data['code']);
            $('#amount').val(data['amount']);
            $('#amount_type').val(data['amount_type']);
            $('#status').val(data['status']);

        }
    });
});

$('.delete-expense-btn').on('click',function () {
    var action = $(this).attr('action');
    // alert(action);
    $('#delete-expense-form').attr('action',action);
});
