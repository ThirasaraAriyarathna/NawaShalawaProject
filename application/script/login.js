jQuery(document).ready(function() {
    
    var login_form_validator = jQuery("#login-form").validate({
        rules: {
            username:{
                required:true
            
            },
            password:{
               required:true 
            }
        },
        messages: {
             username:{
                required:"Please enter username."
            },
            password:{
               required:"Please enter password." 
            }
        },
        errorElement: "span",
        errorClass: 'error help-inline',
        highlight: function(element) {
            jQuery(element).parent('div').next('span.help-inline').remove();
            jQuery(element).closest('.controls').parent('div').addClass('error');
        },
        unhighlight: function(element) {
            jQuery(element).closest('.controls').next('span.error').remove();
            jQuery(element).closest('.controls').parent().removeClass('error');
        },
        errorPlacement: function(error, element) {
            jQuery(element).closest('.controls').next('span.error').remove();
            error.appendTo(jQuery(element).closest('.controls'));
        }
    });
    
   
});