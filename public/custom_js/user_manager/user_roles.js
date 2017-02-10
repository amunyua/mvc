/**
 * Created by alex on 01/11/16.
 */
var UserRole = {
    checkAllocatedRoute: function(role_id){
        $(this).attr('data-toggle', 'modal');
        $('#allocate-routes').modal('show');

        if(role_id != ''){
            $.ajax({
                url: 'check-allocated-route/'+role_id,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    var count = data.length,
                        route_id;
                    // get the allocated routes and loop while checking them
                    for (var i = 0; i < count; i++){
                        route_id = data[i].route_id;
                        $(document).find('input.custom_checkbox[value="'+route_id+'"]').attr('checked', 'checked');
                    }
                }
            });
        }
    }
}

$('.del_role').on('click', function () {
    var delete_id = $(this).attr('del-id');
    var action = $('#delete-role').attr('action');
    var new_action = action +'/'+delete_id;
    $('#delete-role').attr('action','');
    $('#delete-role').attr('action', new_action);
});

$('#routes-for-allocation').DataTable(
{
    // processing: true,
    // serverSide: false,
    // ajax: 'load-routes-allocation',
    // "aaSorting": [[ 1, 'asc' ]],
    // columns: [
    //     { data: 'route_name', 'name': 'route_name' },
    //     { data: 'parent_route', 'name': 'parent_route' },
    //     { data: 'attach_detach', 'name': 'attach_detach' }
    // ],
    columnDefs: [
        { searchable: false, targets: [2] },
        { orderable: false, targets: [2] }
    ],
    iDisplayLength: 1000
}
);

$('#allocate-routes-view').on('click', function(){
    var selected = $('table#dt_basic > tbody > tr.select_tr').length;

    if(selected){
        if(selected == 1) {
            var role_id = $('#dt_basic > tbody > tr.select_tr').find('td:first').text();
            $('input:checkbox.attach').attr('role-id', role_id);

            UserRole.checkAllocatedRoute(role_id);
        }else if(selected > 1){
            alert('You can only allocate routes to one role at a time!');
        }
    }else{
        alert('You must select a route first!');
    }
});

$('table').on('click', 'input:checkbox.attach', function(){
    // check if the checkbox is checked
    var checked = $(this).is(':checked');
    var route_id = $(this).val();
    var role_id = $(this).attr('role-id');

    if(checked){
        if (route_id != ''){
            $.ajax({
                url: 'attach-route',
                type: 'POST',
                data: {
                    'route_id': route_id,
                    '_token': $('input[name="_token"]').val(),
                    'role_id': role_id
                },
                dataType: 'json',
                success: function(data){
                    if(data.success){
                        $.smallBox({
                            title : "Attached",
                            content : data.message,
                            color : "green",
                            iconSmall : "fa fa-check bounce animated",
                            timeout : 4000
                        });
                    }
                }
            });
        }
    }else{
        if (route_id != ''){
            $.ajax({
                url: 'detach-route',
                type: 'POST',
                data: {
                    'route_id': route_id,
                    '_token': $('input[name="_token"]').val(),
                    'role_id': role_id
                },
                dataType: 'json',
                success: function(data){
                    if(data.success){
                        $.smallBox({
                            title : "Detached",
                            content : data.message,
                            color : "orange",
                            iconSmall : "fa fa-remove bounce animated",
                            timeout : 4000
                        });
                    }
                }
            });
        }
    }
});

$('.edit-role-btn').on('click', function () {
    var action = $(this).attr('action');
    var edit_id = $(this).attr('edit-id');
    $('#edit-userrole-form').attr('action',action);

    $.ajax({
        url: 'get-role-edit-details/'+edit_id,
        dataType: 'json',
        success: function (data) {
            $('#role_name').val(data['role_name']);
            $('#role_code').val(data['role_code']);
            $('#status').val(data['role_status']);
        }
    })
});