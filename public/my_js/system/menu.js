/**
 * Created by erico on 10/12/16.
 */
$('#save_menu_changes').on('click', function () {
    $('#arrange_menu').submit();
});

$('span.font-xs').on('click', function(){
    var menu_id = $(this).attr('menu-id');

    if(menu_id != ''){
        $.ajax({
            url: 'get-menu/'+menu_id,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                $('select#route').val(data['route_id']);
                $('#fa_icon').val(data['fa_icon']);
                $('#status').val(data['menu_status']);
                $('#edit_id').val(data['id']);
            }
        });
    }
});

$('#delete_menu_item').on('click', function(){
    var selected = [];
    $('input[type="checkbox"]:checked').each(function(){
        var selected_checks = $(this).val();

        selected.push(selected_checks);
    });

    var count = selected.length;
    if(count){
        if(!confirm('Are you sure you want to delete the selected Menu Items?')){
            return false;
        }

        $.ajax({
            url: 'remove-menu',
            type: 'POST',
            data: {
                'selected': selected,
                '_token': $('input[name="_token"]').val()
            },
            dataType: 'json',
            success: function (data) {
                if(data.success){
                    location.reload();
                }
            }
        });
    }else{
        alert('You must select at least one menu item!');
        return false;
    }
});