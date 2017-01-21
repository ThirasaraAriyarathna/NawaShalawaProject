jQuery(document).ready(function() {
    
    var student_form_validator = jQuery("#student-detail").validate({
        rules: {
            batches: {
                isSelectBatch: true

            },
            admissionDate: {
                required: true
            },
            firstName: {
                required: true
            },
            DOB: {
                required: true
            },
            gender: {
                required: true
            },
            addressLine1: {
                required: true
            },
            city: {
                required: true
            },
            email: {
                email: true
            },
            p_firstName: {
                required: true
            },
            relation: {
                required: true
            },
            p_address: {
                isAddressRequired: true
            }
        },
        messages: {
            admissionDate: {
                required: "Please enter admission date."
            },
            firstName: {
                required: "Please enter first name."
            },
            DOB: {
                required: "Please enter date of birth."
            },
            gender: {
                required: "Please enter gender."
            },
            addressLine1: {
                required: "Please enter address line 1."
            },
            city: {
                required: "Please enter city."
            },
            email: {
                email: "Please enter valid email."
            },
            p_firstName: {
                required: "Please enter first name."
            },
            relation: {
                required: "Please enter relation."
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

    jQuery.validator.addMethod("isSelectBatch", function(value, element){
        if (value != 0)
        {
            return true;
        }
    },"Please select a batch.");

    var search_form_validator = jQuery("#searchForm").validate({
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
        unhighlight: function(element){
            jQuery(element).closest('.controls').next('span.error').remove();
            jQuery(element).closest('.controls').parent().removeClass('error');
        },
        errorPlacement: function(error, element){
            jQuery(element).closest('.controls').next('span.error').remove();
            error.appendTo(jQuery(element).closest('.controls'));
        }
      
    });
  
    jQuery.validator.addMethod("isAddressRequired", function(value, element) {
        if (jQuery("#sameAddress").is(':checked'))
        {
            return true;
        }
        else {
            if (jQuery("#p_address").val() == "")
                return false;
            else
                return true;
        }
    }, "Please enter address.");


    jQuery("#student-detail").on('change', '#batches-dropdown', function() {
        var admissionId = jQuery('#batches-dropdown :selected').text();
        if (admissionId != "undefined")
        {
            jQuery('#admissionID').val(admissionId);
        }
        else
        {
            jQuery('#admissionID').val('');
        }
    });
    jQuery("#student-detail").on('change', '#sameAddress', function() {
        if (jQuery(this).is(':checked'))
        {
            jQuery("#p_address").val('Same');
            jQuery("#p_address").prop("disabled", "disabled");
        }
        else {
            jQuery("#p_address").val('');
            jQuery("#p_address").removeProp("disabled");
        }
    });

    jQuery('#sub-menu').on('click', '#ele-adv-btn', function() {
        jQuery('#ele-student_search_form').slideUp();
        jQuery('#ele-student_advance_search_form').slideDown();


    });
    jQuery('#ele-student_advance_search_form').on('click', '.close', function() {
        jQuery('#ele-student_advance_search_form').slideUp();
        jQuery('#ele-student_search_form').slideDown();
    });
    jQuery('#searchForm').on('keyup', '#searchedText', function(e) { 
       if(e.keyCode == 13){
            jQuery("#btnSearch").trigger( "click" );
       }
    });
    
 jQuery('#searchForm').on('click', '#btnSearch', function() {
     var searchedText = jQuery("#searchedText").val();
     if(jQuery('#searchForm').valid()){
    jQuery.ajax({
				type: 'POST',
				url: baseurl+"students/search",
				data: {term:searchedText},
				dataType: 'json',
				async:false,
				cache:false,
				success:function(data) {
                                  
                                    jQuery('#search_result').html(data.html);
                                }
                            });
                        }
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
    
    jQuery('#class_list').typeahead({
    onSelect: function(item) {
     jQuery.ajax({
            type: 'POST',
            url: baseurl+"classes/getClassDetailView/"+item.value,
            dataType: 'json',
            async:false,
            success:function(data) {
                $(this).val("");
                
               $("#class_detail_container").append(data.html);


            }
        });
    },
    ajax: {
        url: baseurl+"classes/autosuggestClasses",
        timeout: 500,
        displayField: "ClassName",
        valueField:"ClassId",
        triggerLength: 1,
        method: "get",
        loadingClass: "loading-circle",
        preDispatch: function (query) {
            var batchId=$("#batches-dropdown option:selected").val();
            return {
                search: query,
                batchId: batchId
            };
        },
        preProcess: function (data) {
            if (data.success === false) {
                // Hide the list, there was some error
                return false;
            }
            $("#selectclassId").val('');
            return data.classList;
        }
    }
});

$("#search_result").on('click','.btn_delete_student',function(){
    var studentid=$(this).attr('studentId');
    var admitionId=$(this).attr('admitionId');
    
    $('#student_delete_modal #delete_conf_body').html('Are you sure want to delete '+admitionId+ ' student ?');
    $('#student_delete_modal #btn-delete-student-yes').attr('studentId',studentid);
    $('#student_delete_modal').modal();
});

$("#student_delete_modal").on('click','#btn-delete-student-yes',function(){
    var studentId = $(this).attr('studentId');
    $.ajax({
        type: 'POST',
        url: baseurl+"students/delete",
        data: {id:studentId},
        dataType: 'json',
        async:false,
        cache:false,
        success:function(data) {
            if(data.status=="success"){
                $("#student_"+studentId).remove();
                $('#student_delete_modal').modal('hide');
            }
          
        }
    });
});

$(document).on('click','.btn_clss_grps_rmve',function(){
      var group=$(this).closest('.class_grps');
      var parentgroup=group.closest('.clss_grps_parent');
      if(parentgroup.find('.class_grps').length>1){
          group.remove();
      }else{
          alert('Sorry you can not remove all groups');
      }
   });
});