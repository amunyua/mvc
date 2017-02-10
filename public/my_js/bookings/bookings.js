$('#add-book').on('click',function () {
    var div = $('body').find('.booking-d').first().clone();
    div.appendTo($('#added'));

})