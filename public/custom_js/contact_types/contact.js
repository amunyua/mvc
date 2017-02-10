$('.delete_cont_type').on('click', function () {
    var id = $(this).attr('delete-id');
    var action = ['route',['contact_types.destroy',id]];
    $('#delete-contact-type-form').attr('action',action);
});

$('.edit_contact_type').on('click',function () {
    var id = $(this).attr('edit-id');
    $('#edit-contact-type-form').attr('action', +id);
})