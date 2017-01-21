jQuery(document).ready(function () {
$('#class_name').typeahead({
    onSelect: function(item) {
        $("#class_list").find('.error').remove();
        var batch=$("#batches option:selected").text();
         if($("#class_list").find("#class_"+item.value).length==0){
         $.ajax({
            type: 'post',
            url: baseurl + "classes/getClassPartialView",
            data: {c_id: item.value,c_name:item.text,batch:batch},
            dataType: 'json',
            success: function (data) {
                $("#class_list").append(data.html);
                $('#class_name').val('');
            }
        });
         }
         else{
             $("#class_name").val('');
             $("#class_list_error").removeClass('hidden');
         }
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
            $("#class_list_error").addClass('hidden');
            var batchId=$("#batches option:selected").val();
            return {
                search: query,
                batchId: batchId,
                profileClass:0
            };
        },
        preProcess: function (data) {
           
            if (data.success === false) {
                // Hide the list, there was some error
                return false;
            }
           
            return data.classList;
        }
    }
        
});

$("#class_list").on("click",".btn_close_class",function(){
    $classId=$(this).attr('classId');
    $("#class_"+$classId).remove();
    $('#class_name').val('');
});
    
      var assistant_add_form = jQuery("#assistant_add_form").validate({
      rules: {
          title:{required:true},
          firstname:{required:true},
          lastname:{required:true},
          nic:{required:true},
          address:{required:true},
          phone:{required:true},
          email:{email:true}
      },
       messages: {
          title:{required:"Please select the title."},
          firstname:{required:"Please enter first name"},
          lastname:{required:"Please enter last name"},
          nic:{required:"Please enter valid NIC."},
          address:{required:"Please enter address."},
          phone:{required:"Please enter phone no."},
          email:{email:"Please enter valid email address."}
       },
        errorElement: "span",
        errorClass: 'error help-inline',
        highlight: function (element) {
            jQuery(element).next('span.help-inline').remove();
            jQuery(element).parent().addClass('has-error');
        },
        unhighlight: function (element) {
            jQuery(element).next('span.error').remove();
            jQuery(element).parent().removeClass('has-error');
        },
        errorPlacement: function (error, element) {
            jQuery(element).next('span.error').remove();
            error.appendTo(jQuery(element).parent());
        }
      
  });
    
$(document).on("submit","#assistant_add_form",function(e){ 
    if(($("#class_list").find('.classname').length==0 && !$("#assign_all_class").is(':checked')) || !assistant_add_form.valid()){
        if($("#class_list").find('.classname').length==0){
            $("#class_list").append('<span  class="error help-inline">Please add at least one class.</span>');
        }
        e.preventDefault();
    }
});


  var search_form_validator = jQuery("#searchForm").validate({
      rules: {
          searchedText:{required:true}
      },
       messages: {
           searchedText:{required:"Please enter search term"}
       },
        errorElement: "span",
        errorClass: 'error help-inline',
        highlight: function (element) {
            jQuery(element).parent('div').next('span.help-inline').remove();
            jQuery(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function (element) {
            jQuery(element).closest('.form-group').next('span.error').remove();
            jQuery(element).closest('.form-group').removeClass('has-error');
        },
        errorPlacement: function (error, element) {
            jQuery(element).closest('.form-group').next('span.error').remove();
            error.appendTo(jQuery(element).closest('.form-group'));
        }
      
  });
  
     jQuery('#searchForm').on('click', '#btnSearch', function() {
     var searchedText = jQuery("#searchedText").val();
     if(jQuery('#searchForm').valid()){
    jQuery.ajax({
				type: 'POST',
				url: baseurl+"assistants/searchbyfield/",
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
    
    });
    