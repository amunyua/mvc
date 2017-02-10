$('.delete-btn').on('click', function () {
    var action = $(this).attr('action');
    if( action != ''){
        $('#delete-transaction-form').attr('action',action);
    }
})