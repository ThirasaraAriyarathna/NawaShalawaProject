 jQuery(document).ready(function() {
       var search_form_validator = jQuery("#searchTeacherForm").validate({
      rules: {
          searchedText:{required:true}
      },
       messages: {
           searchedText:{required:"Please enter search term"}
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
  
 jQuery('#sub-menu').on('click', '#btn_viewAllteachers', function() {
    jQuery("#searchedText").val('');
    jQuery.ajax({
            type: 'POST',
            url: baseurl+"teachers/search",
            data: {term:"TCH"},
            dataType: 'json',
            success:function(data) {

                jQuery('#search_result').html(data.html);
            }
        });
    });
    
    jQuery('#searchTeacherForm').on('keyup', '#searchedText', function(e) { 
       if(e.keyCode == 13){
            jQuery("#btnteacherSearch").trigger( "click" );
       }
    });
    
 jQuery('#searchTeacherForm').on('click', '#btnteacherSearch', function() {
     var searchedText = jQuery("#searchedText").val();
     if(jQuery('#searchTeacherForm').valid()){
    jQuery.ajax({
            type: 'POST',
	    url: baseurl+"teachers/search",
            data: {term:searchedText},
            dataType: 'json',
            success:function(data) {
                jQuery('#search_result').html(data.html);
            }
        });
    }
    });
    
    $("#search_result").on('click','.btn_delete_teacher',function(){
        var teacherid=$(this).attr('teacherid');
        var admitionId=$(this).attr('admitionId');

        $('#teacher_delete_modal #delete_conf_body').html('Are you sure want to delete '+admitionId+ ' teacher ?');
        $('#teacher_delete_modal #btn-delete-teacher-yes').attr('teacherId',teacherid);
        $('#teacher_delete_modal').modal();
    });
    
    $("#teacher_delete_modal").on('click','#btn-delete-teacher-yes',function(){
    var teacherId = $(this).attr('teacherId');
    $.ajax({
        type: 'POST',
        url: baseurl+"teachers/delete",
        data: {id:teacherId},
        dataType: 'json',
        async:false,
        cache:false,
        success:function(data) {
            if(data.status=="success"){
                $("#teacher_"+teacherId).remove();
                $('#teacher_delete_modal').modal('hide');
            }
          
        }
    });
});

 });