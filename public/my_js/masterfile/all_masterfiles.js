//
// var DT = $('#masterfiles').DataTable({
//     serverSide: true,
//     processing: true,
//     "aaSorting": [[ 0, 'desc' ]],
//     ajax: 'load-masterfiles',
//     columns: [
//         { data: 'id', name: 'id'},
//         { data: 'username', name: 'username'},
//         { data: 'id_no', name: 'id_no'},
//         { data: 'user_role', name: 'user_role'},
//         { data: 'phone_number', name: 'phone_number'},
//         { data: 'email', name: 'email'},
//         { data: 'physical_address', name: 'physical_address'},
//         { data: 'city', name: 'city'},
//         { data:'postal_address', name:'postal_address'}
//
//     ]
// });
//
// // refresh the grid
// $('#refresh-dt').click(function(){
//     DT.ajax.reload();
// });
//
// var hide = function (data) {
//     if (data != ''){
//         if($this == '') {
//             $('.person').hide();
//         }else{
//             $('.person').show();
//         }
//     }
// }
// alert('workong');
$('#edit-masterfile-btn').on('click',function () {

});

$('.delete-masterfile-btn').on('click',function () {
   var action = $(this).attr('action');
    // alert(action);
    $('#delete-masterfile-form').attr('action',action);
});