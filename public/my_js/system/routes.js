var DT = $('#routes').DataTable({
    serverSide: true,
    processing: true,
    "aaSorting": [[ 0, 'desc' ]],
    ajax: 'load-routes',
    columns: [
        { data: 'id', name: 'id'},
        { data: 'route_name', name: 'route_name'},
        { data: 'url', name: 'url'},
        { data: 'parent_route', name: 'parent_route'},
        { data: 'route_status', name: 'route_status'}
    ]
});

// refresh the grid
$('#refresh-dt').click(function(){
    DT.ajax.reload();
});

// load all parent routes
$('#add-parent').select2({
    placeholder: 'Select a Route',
    allowClear: true,
    ajax: {
        url: 'parent-routes',
        dataType: 'json',
        delay: 250,
        data: function(params){
            return {
                q: params.term, // search term
                page: params.page
            };
        },
        processResults: function(data, params){
            params.page = params.page || 1;

            return {
                results: data.items,
                pagination: {
                    more: (params.page * 30) < data.total_count
                }
            };
        },
        cache: true
    },
    escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
    minimumInputLength: 1
    // templateResult: formatRepo, // omitted for brevity, see the source of this page
    // templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
});

// add route
$('#add-route-form').on('submit', function(e){
    e.preventDefault();

    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(data){
            if(data.success){
                $('#add-route').modal('hide');
                $('#warnings').hide();
                $('#success').fadeIn('slow');

                DT.ajax.reload();
                $('input[type="text"], select').val('');
            }else if(!data.success){
                $('#success').hide();
                $('#add-route').modal('hide');

                var html = '';
                $('#warnings').fadeIn('slow', function(){
                    for(var key in data.errors) {
                        var errors = data.errors[key];
                        for(var i = 0; i < errors.length; i++){
                            html += '<li>'+errors[i]+'</li>';
                        }
                    }
                    $('#warnings > ul').html(html);
                });
            }
        }
    });
});

// get route details
$('#edit-route-btn').on('click', function(){
    var count = $('tr.select_tr').length;

    if(count){
        if(count > 1) {
            alert('You can only edit one record at a time!');
            $('#edit-route-btn').removeAttr('data-toggle');
        }else{
            var route_id = $('tr.select_tr').find('td:first').text();
            $('#edit-route-btn').attr('data-toggle', 'modal');
            $('#edit_id').val(route_id);

            $.ajax({
                url: 'get-route/' + route_id,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    $('#route_name').val(data['route_name']);
                    $('#url').val(data['url']);
                    $('#parent').val(data['parent_route']);
                    $('#status').val(data['route_status']);
                }
            });
        }
    }else{
        alert('You select a record first!');
        $('#edit-route-btn').removeAttr('data-toggle');
    }
});

// edit route
$('#edit-route-form').on('submit', function(e){
    e.preventDefault();

    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(data){
            if(data.success){
                $('#edit-route').modal('hide');
                $('#warnings').hide();
                $('#ed-success').fadeIn('slow');

                DT.ajax.reload();
                $('input[type="text"], select').val('');
            }else if(!data.success){
                $('#ed-success').hide();
                $('#edit-route').modal('hide');

                var html = '';
                $('#warnings').fadeIn('slow', function(){
                    for(var key in data.errors) {
                        var errors = data.errors[key];
                        for(var i = 0; i < errors.length; i++){
                            html += '<li>'+errors[i]+'</li>';
                        }
                    }
                    $('#warnings > ul').html(html);
                });
            }
        }
    });
});

// delete route
$('#delete-route-btn').on('click', function(){
    var count = $('tr.select_tr').length;

    if(count) {
        if(!confirm('Are you sure you want to delete the selected records?')){
            return false;
        }

        var ids = [];
        $('tr.select_tr').each(function () {
            var route_id = $(this).find('td:first').text();
            ids.push(route_id);

            // ajax
            $.ajax({
                url: 'delete-route/'+route_id,
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    if(data.success){
                        DT.ajax.reload();
                    }
                }
            });
        });
    }else{
        alert('You must select at least one record!');
    }
});