
$('body').find('.select2-hidden-accessible').hide();
$('.live_search').select2();


var $validator = $("#wizard-1").validate({
    rules: {
        // email: {
        //     email: "Your email address must be in the format of name@domain.com"
        // },
        fname: {
            required: true
        },
        surname: {
            required: true
        },
        role: {
            required: true
        },
        gender: {
            required: true
        },
        // id_no: {
        //     required: true
        // },
        // wphone: {
        //     required: true,
        //     minlength: 10
        // },
        physical_address: {
            required: true
        },
        contact_type: {
            required: true
        },
        // phone_number:{
        //     required: true
        // },
        city:{
            required: true
        },
        postal_address:{
            required:true
        }
    },

    messages: {
        fname: "Please specify your First name",
        surname: "Please specify your Surname",
        // email: {
        //     required: "You must specify the email address",
        //     email: "The email address must be in the format of name@domain.com"
        // },
        // adm_no: "Please provide the Student's Admission No",
        role: "You must select the Role first",
        gender: "You must select the Gender",
        // phone_number:"Please enter a phone number",
        city: "You must enter a city",
        postal_address: "The postal address is required"
    },

    highlight: function (element) {
        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    unhighlight: function (element) {
        $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
    },
    errorElement: 'span',
    errorClass: 'help-block',
    errorPlacement: function (error, element) {
        if (element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
    }
});

$('#role').on('change',function () {
   var value = $(this).val();
   if(value == 'Dependant'){
       $('#b_role').fadeOut('slow');
    $('#dependant').fadeIn("slow");
   }else if(value == 'Staff'){
       $('#dependant').fadeOut("slow");
       $('#b_role').fadeIn('slow');
   }else{
       $('#dependant').fadeOut("slow");
       $('#b_role').fadeOut('slow');
   }
});