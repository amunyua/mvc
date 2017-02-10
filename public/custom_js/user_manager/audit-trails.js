
 var audit_trails =$('#audit-trails').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'ajax_trails',
        columns: [
        { data: 'id', name: 'id' },
        { data: 'action_name', name: 'action_name' },
        { data: 'created_at', name: 'created_at' },
        { data: 'session_id', name: 'session_id' },
        { data: 'user_name', name: 'user_name' }
    ]
});

