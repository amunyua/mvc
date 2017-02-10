$('#supplier').on('change',function () {
    $('#fields').html('');
    var supplier_id = $(this).val();
    if (supplier_id != 0) {
        $.ajax({
            url: 'load-invoice-fields/'+ supplier_id,
            dataType: 'json',
            success: function (data) {
                var length = data.length;
                var label = '';

                if(length>0){
                    for (var i=0;i<length;i++){
                        label += '<section><div class="row"><label class="label col col-2">'
                            + data[i]['item_name']+ '</label><div class="col col-10"><label class="input"><i class="icon-append fa fa-keyboard-o"></i>'
                        + '<input type="number" required name="'+ data[i]['id'] +'" value="'+ data[i]['amount'] +'" autocomplete="off"></label></div></div></section>';
                        // $(label).insertAfter($('#before'));

                    }
                }
                $('#fields').html(label);
            }
        });
    }

});

$('.delete-invoice').on('click',function () {
    var action = $(this).attr('action');
    $('#delete-invoice-form').attr('action',action);
});

$('.paybill_btn').on('click',function () {
   var invoice_id = $(this).attr('invoice-id');
    // alert(invoice_id);
    var action = $(this).attr('action');
    $('#pay-bill-form').attr('action',action);
    $.ajax({
        url: 'load-inv-details/'+invoice_id,
        dataType: 'json',
        success: function (data) {
            $('#initial-amount').val(data['bill_amount']);
            $('#bill-balance  ').val(data['bill_balance']);
        }
    })
});

$('#submit-btn').on('click',function (e) {
    e.preventDefault();
    var paid_amount = $('#amount-paid').val();
    // alert(paid_amount);
    if(paid_amount != ''){
        var amount_payable = $('#bill-balance').val();
        // alert(amount_payable);
        if((amount_payable<paid_amount)){
            alert('The amount payable may not be greater than the bill balance');
        }else{
            $('#pay-bill-form').submit();
        }
    }else{
        alert('please enter amount to pay');
    }
})