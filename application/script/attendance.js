jQuery(document).ready(function() {
   

  var search_form_validator = jQuery("#attendanceForm").validate({
      rules: {
          searchedText:{required:true}
      },
       messages: {
           searchedText:{required:"Please enter student id"}
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
  var topup_form_validator = jQuery("#topup_form").validate({
        rules: {
            feesValue: {required: true}
        },
        messages: {
            feesValue: {required: "Please enter fees amount."}
        },
        errorElement: "span",
        errorClass: 'error help-inline',
        highlight: function (element) {
            //jQuery(element).parent('div').next('span.help-inline').remove();
            jQuery(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function (element) {
            jQuery(element).closest('.form-group').find('span.error').remove();
            jQuery(element).closest('.form-group').removeClass('has-error');
        },
        errorPlacement: function (error, element) {
            jQuery(element).closest('.form-group').find('span.error').remove();
            error.appendTo(jQuery(element).parent('div'));
        }

  });   


    jQuery('#DetailModal').on('click', '#btn-topup', function() { 
        $("#topup_btn_yes").attr('classStudentId',$(this).attr('classStudentId'));
        $("#topup_btn_yes").attr('classFeesId',$(this).attr('classFeesId'));
        $("#TopUpConfermationModal #feesValue").val($(this).attr('fees'));
        $("#TopUpConfermationModal #feesValue").attr('readonly','readonly');
        jQuery('#TopUpConfermationModal').modal('show');
    });
    jQuery('#TopUpConfermationModal').on('click', '#btn-edit', function() { 
        jQuery('#TopUpConfermationModal #feesValue').removeAttr('readonly');
    });
    jQuery('#TopUpConfermationModal').on('click', '#topup_btn_yes', function(e) {
        var classStudentId=$("#topup_btn_yes").attr('classStudentId');
        var classFeesId=$("#topup_btn_yes").attr('classFeesId');
        var class_date_id=$("#topup_btn_yes").attr('class_date_id');
        var fees = $("#feesValue").val();
        var remarks = $("#remarkValue").val();
        if(jQuery('#topup_form').valid()){
                    $.ajax({
                        type: 'POST',
			url: baseurl+'attendance/topUpStudent/'+classStudentId+'/'+classFeesId+'/'+class_date_id,
			data: {feesValue:fees,remarkValue:remarks},
			dataType: 'json',
			success:function(data) {
                            if(data.status=='success'){
                                $('#btn-topup').remove();
                                $('#month_menu').find('.red-back').toggleClass('green-back');
                                $('#TopUpConfermationModal').modal('hide');
                                
                            }
                        }
                    });
                    
                }
    } );
    $('#TopUpConfermationModal').on('hidden.bs.modal', function (e) {
        $('body').addClass('modal-open');
    });
    jQuery('#multiple-result').on('click', '.student_data', function(e) {
        jQuery("#searchedText").val($(this).attr('id'));
        var event = jQuery.Event( "keyup" );
        event.keyCode = 13;
        jQuery("#searchedText").trigger(event);
    } );
    jQuery('#attendanceForm').on('keyup', '#searchedText', function(e) { console.log(e.keyCode);
       if(e.keyCode == 13){
           // jQuery("#btnSearch").trigger( "click" );
                var searchedText = jQuery("#searchedText").val();
                var classDateId = jQuery("#searchedText").attr('class_date_id');
                var class_id = jQuery("#searchedText").attr('class_id');
                if(jQuery('#attendanceForm').valid()){
                    $.ajax({
                        type: 'POST',
			url: baseurl+"students/viewStudentDetail",
			data: {term:searchedText,classId:class_id,classDateId:classDateId},
			dataType: 'json',
			success:function(data) {
                            if(data.status="success"){
                                if(data.count==1){
                                   $("#DetailModal .modal-content").html(data.html);  
                                   jQuery('#DetailModal').modal('show');
                                }
                                else{
                                    jQuery("#multiple-result").html(data.html);
                                    
                                }
                           }
                        }
                    });
                    
                }
       }
    });
    
 jQuery('#attendanceForm').on('click', '#btnSearch', function() {
     var searchedText = jQuery("#searchedText").val();
   
     if(jQuery('#attendanceForm').valid()){
     jQuery('#DetailModal').modal('show');
     }
//     if(jQuery('#attendanceForm').valid()){
//    jQuery.ajax({
//				type: 'POST',
//				url: baseurl+"students/search",
//				data: {term:searchedText},
//				dataType: 'json',
//				async:false,
//				cache:false,
//				success:function(data) {
//                                  
//                                }
//                            });
//                        }
    });
 jQuery('#sub-menu').on('click', '#btn_viewAll', function() {
    jQuery("#searchedText").val('');
    jQuery.ajax({
				type: 'POST',
				url: baseurl+"students/search",
				data: {term:"STD"},
				dataType: 'json',
				async:false,
				cache:false,
				success:function(data) {
                                   
                                    jQuery('#search_result').html(data.html);
                                }
                            });
    });
    
    jQuery("#search_result").on('click', '.admissionID', function() {
        var studentID = jQuery(this).attr('studentId');
        jQuery.ajax({
				type: 'POST',
				url: baseurl+"students/getStudentDetail",
				data: {studentId:studentID},
				dataType: 'json',
				async:false,
				cache:false,
				success:function(data) {
                                    jQuery('#DetailModal').modal('show');
									jQuery('.modal-body').html(data.html);
                                }
                            });
    });
    
     jQuery("#search_result").on('click', '.btnEdit', function() {
         console.log(1);
     });
});