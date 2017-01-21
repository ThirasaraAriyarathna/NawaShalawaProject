jQuery(document).ready(function () {
    
            $("#start-time").timepicker();
            $("#end-time").timepicker();
            $("#date_of_class").datepicker();
             var d = new Date();
        var startYear = d.getFullYear() - 3;
        var endYear = d.getFullYear() + 3;

        $('.select-year').datepicker({
            format: " yyyy",
            viewMode: "years",
            minViewMode: "years",
            startDate: startYear.toString(),
            endDate: endYear.toString()
        }).datepicker("setDate", new Date());
        
         
     $("#class_group_date").datepicker({autoclose: true});
      $("#classgroup_start").timepicker();
      $("#classgroup_end").timepicker();
    var subject_form_validator = jQuery("#subject-detail").validate({
        rules: {
            subjectName: {
                required: true
            }

        },
        messages: {
            subjectName: {
                required: "Please enter Subject Name"
            }
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
    
    var class_group_form = jQuery("#class_group_form").validate({
        rules: {
            class_date: {
                required: true
            },
            description: {
                required: true
            },
            start: {
                required: true
            },
            end: {
                required: true
            }
        },
        messages: {
            class_date: {
                required: "Please select date."
            },
            start: {
                required: "Please select start time."
            },
            end: {
                required: "Please select end time."
            },
            description: {
                required: "Please enter description."
            }
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
    
    var class_form_validator = jQuery("#class-add-form").validate({
        rules: {
            class_name: {
                required: true
            },
            class_fees: {
                required: true,
                number:true
            },
            batches: {
                isSelected: true
            },
            subjects: {
                isSelected: true
            },
            teachers: {
                isSelected: true
            }

        },
        messages: {
            class_name: {
                required: "Please enter Class Name"
            },
            class_fees: {
                required: "Please enter Class Fees",
                number: "Please enter numeric value",
            },
            batches: {
                isSelected: "Please select a Batch"
            },
            subjects: {
                isSelected: "Please select a Subject"
            },
            teachers: {
                isSelected: "Please select a Teacher"
            }

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

    var batch_form_validator = jQuery("#batch-detail").validate({
        rules: {
            batchName: {
                required: true
            },
            year: {
                required: true
            }
        },
        messages: {
            batchName: {
                required: "Please enter Batch Name"
            },
            year: {
                required: "Please select Year"
            }
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
    jQuery.validator.addMethod("isSelected", function (value, element) {
        if (value != 0)
        {
            return true;
        }
    });


    jQuery('#class-add-form').on('keyup', '#sName , #sDescription', function (e) {
        if (e.keyCode == 13) {
            jQuery("#addBtn").trigger("click");
        }
    });

    jQuery('#class-add-form').on('change', '#teachers', function () {
        var selection = jQuery('#teachers :selected').val();
        if (selection == "add") {
            window.location.replace(baseurl + "teachers/add");
        }

    });

    jQuery('#batch_delete_confermationModal').on('click', '#delete-conf-yes-btn', function () {
        var selectBatch = jQuery('#batches :selected').val();
        jQuery.ajax({
            type: 'POST',
            url: baseurl + "batch/delete",
            data: {id: selectBatch},
            dataType: 'json',
            async: false,
            cache: false,
            success: function (data) {
                if (data.status == "success") {
                    jQuery("#batches option[value='" + selectBatch + "']").remove();
                    jQuery('#batch_delete_confermationModal').modal('hide');
                }

            }
        });
    }
    );
    jQuery('#class_list_container').on('click', '.btn-class-remove', function () {
        $("#btn-class-remove-yes").attr('class_id',$(this).attr('class_id'));
        $("#delete_class").modal('show');
    });
    
    jQuery('#delete_class').on('click', '#btn-class-remove-yes', function () {
        var classId=$(this).attr('class_id');
        window.location.replace(baseurl+"classes/delete/"+classId);
    });
    
    jQuery('#class-add-form').on('click', '#batchDeleteBtn', function () {
        var selectBatch = jQuery('#batches :selected').val();
        if (selectBatch == 0) {
            jQuery('#batches').valid();
        }
        else {
            jQuery('#batch_delete_confermationModal').modal('show');
            var msg = "Are you sure to delete <b>" + jQuery('#batches :selected').text() + "</b> batch ?";
            jQuery('#delete-msg').html(msg);

        }
    });
    jQuery('#class-add-form').on('click', '#subjectDeleteBtn', function () {
        var selectSubject = jQuery('#subjects :selected').val();
        if (selectSubject == 0) {
            jQuery('#subjects').valid();
        }
        else {
            jQuery('#subject_delete_confermationModal').modal('show');
            var msg = "Are you sure to delete <b>" + jQuery('#subjects :selected').text() + "</b> subject ?";
            jQuery('#subject-delete-msg').html(msg);

        }
    });
    jQuery('#subject_delete_confermationModal').on('click', '#delete-yes-btn', function () {
        var selectSubject = jQuery('#subjects :selected').val();
        jQuery.ajax({
            type: 'POST',
            url: baseurl + "subjects/delete",
            data: {id: selectSubject},
            dataType: 'json',
            async: false,
            cache: false,
            success: function (data) {
                if (data.status == "success") {
                    jQuery("#subjects option[value='" + selectSubject + "']").remove();
                    jQuery('#subject_delete_confermationModal').modal('hide');
                }

            }
        });
    }
    );
    jQuery('#batch-detail').on('click', '#btn_batch_add', function () {

        if (jQuery('#batch-detail').valid()) {
            var batchName = jQuery('#batchName').val();
            var description = jQuery('#description').val();
            var year = jQuery('#year').val();

            jQuery.ajax({
                type: 'POST',
                url: baseurl + "batch/add",
                data: {batchName: batchName, description: description, year: year},
                dataType: 'json',
                async: false,
                cache: false,
                success: function (data) {
                    if (data.status == "success") {
                        jQuery('#batches').append(jQuery("<option/>", {
                            value: data.detail.id,
                            text: data.detail.Name + '-' + data.detail.Year
                        }));
                        jQuery('#batch-detail')[0].reset();
                        batch_form_validator.resetForm();
                        jQuery('#batchModal').modal('hide');
                        jQuery("#batches option[value=" + data.detail.id + "]").prop("selected", true);
                    }
                }
            });

        }
    });

    jQuery('#subject-detail').on('click', '#btn_subject_add', function () {

        if (jQuery('#subject-detail').valid()) {
            var subjectName = jQuery('#subjectName').val();
            var description = jQuery('#subject-detail #description').val();

            jQuery.ajax({
                type: 'POST',
                url: baseurl + "subjects/add",
                data: {subjectName: subjectName, description: description},
                dataType: 'json',
                async: false,
                cache: false,
                success: function (data) {
                    if (data.status == "success") {
                        jQuery('#subjects').append(jQuery("<option/>", {
                            value: data.detail.id,
                            text: subjectName
                        }));
                        jQuery('#subject-detail')[0].reset();
                        subject_form_validator.resetForm();
                        jQuery('#subjectModal').modal('hide');
                        jQuery("#subjects option[value=" + data.detail.id + "]").prop("selected", true);
                    }
                }
            });

        }
    });
var search_class_form_validator = jQuery("#class_search_form").validate({
        rules: {
            batch: {
                isSelected: true
            }
        },
        messages: {
            batch: {
                isSelected: "Please Select Batch Name"
            }
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
var class_index_search_form = jQuery("#class_index_search_form").validate({
        rules: {
            batch: {
                isSelected: true
            }
        },
        messages: {
            batch: {
                isSelected: "Please Select Batch Name"
            }
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

    jQuery("#class_search_form").on("click", "#search-btn", function () {
        if(search_class_form_validator.valid()){
            var batch = jQuery("#batch option:selected").val();
            var class_name = jQuery("#class_name").val();
            jQuery.ajax({
                type:'post',
                url: baseurl + "classes/search",
                data:{batch:batch,class_name:class_name},
                dataType: 'json',
                success:function(data){
                    console.log(data)
                    jQuery("#class_list_container").html(data.html);
                    if(data.status=="success"){
                    if(data.loadmore){
                        jQuery("#load_more_classes").removeClass('hidden');
                        jQuery("#load_more_classes").attr('offset',data.offset);
                        jQuery("#load_more_classes").attr('batch_id',batch);
                        jQuery("#load_more_classes").attr('class_name',class_name);
                    }
                    else {
                        jQuery("#load_more_classes").addClass('hidden');
                    }
                }
                    else{
                        jQuery("#class_list_container").html("No Results Found.");
                        jQuery("#load_more_classes").addClass('hidden');
                    }
                    
                }
            });
            
        }
    });
    jQuery("#class_index_search_form").on("click", "#search-btn", function () {
        if(class_index_search_form.valid()){
            var batch = jQuery("#batch option:selected").val();
            var class_name = jQuery("#class_name").val();
            jQuery.ajax({
                type:'post',
                url: baseurl + "classes/search/1",
                data:{batch:batch,class_name:class_name},
                dataType: 'json',
                success:function(data){
                    console.log(data)
                    jQuery("#class_list_container").html(data.html);
                    if(data.status=="success"){
                    if(data.loadmore){
                        jQuery("#load_more_classes").removeClass('hidden');
                        jQuery("#load_more_classes").attr('offset',data.offset);
                        jQuery("#load_more_classes").attr('batch_id',batch);
                        jQuery("#load_more_classes").attr('class_name',class_name);
                    }
                    else {
                        jQuery("#load_more_classes").addClass('hidden');
                    }
                }
                    else{
                        jQuery("#class_list_container").html("No Results Found.");
                        jQuery("#load_more_classes").addClass('hidden');
                    }
                    
                }
            });
            
        }
    });
    jQuery("#load_more_show").on("click", "#load_more_classes", function () {
            var batch = jQuery(this).attr('batch_id');
            var class_name = jQuery(this).attr('class_name');
            var type = jQuery(this).attr('searchtype');
            var url = "";
            if(batch!=""){
                if(type==undefined){
                    type="";
                }
                
                url=baseurl + "classes/search_more/"+type;
            }
            var offset = jQuery(this).attr('offset');
            jQuery.ajax({
                type:'post',
                url: url,
                data:{offset:offset,batch:batch,class_name:class_name},
                dataType: 'json',
                success:function(data){
                    if(data.status=="success"){
                         jQuery("#class_list_container").append(data.html);
                        if(data.loadmore){
                            jQuery("#load_more_classes").removeClass('hidden');
                            jQuery("#load_more_classes").attr('offset',data.offset);
                        }
                        else {
                            jQuery("#load_more_classes").addClass('hidden');
                        }
                    }
                    else{
                        jQuery("#class_list_container").html("No Results Found.");
                        jQuery("#load_more_classes").addClass('hidden');
                    }
                   
                }
           
        
    });
    });
        jQuery("#class_list_container").on("click", ".class_data", function () {
            var isActive = jQuery(this).attr('active');
            var class_id=jQuery(this).attr('id');
            var classdateid=jQuery(this).attr('classdateid');
            if(isActive==undefined){
                
                jQuery.ajax({
                    type:'post',
                    url: baseurl + "classes/getClassDetails",
                    data:{class_id:class_id},
                    dataType: 'json',
                    success:function(data){
                        $("#class_instanceModal").html(data.html);
                        $("#class_instanceModal").modal('show');
                        
                        $('#class_date').datepicker({ startDate: '-0d',endDate: '+0d',autoclose: true}).on('changeDate',changeDate);
                        $("#start").timepicker();
                        $("#end").timepicker();
                        set_classInstance_validator();
                    }
                });
            }
            else{
                location.replace(baseurl+'attendance/marking/'+classdateid);
            }
            
        });
        
        jQuery("#class_instanceModal").on("click",".add_extra_class_instance",function(){
            
            $(".extra_class").slideDown();
            $(this).toggleClass('remove_extra_class_instance');
            $(this).children('span').toggleClass('glyphicon-minus');
            $.each($('.class-groups'),function(){
                $(this).removeClass('hidden'); 
                
            });
            $('#is_new_group').val(1);
        });
        jQuery("#class_instanceModal").on("click",".remove_extra_class_instance",function(){
            $(".extra_class").slideUp();
            $(".classs_timeslots").removeAttr('readonly');
            $('#class_date').val('');
            $('#is_new_group').val(0);
            $('.check-icon').removeClass('fa-check');
             $('.class_group_d').val(0);
        });
        
        $('#class_list').typeahead({
    onSelect: function(item) {
        $("#selectclassId").val(item.value);
        $('#from_group').find('option').remove().end().append('<option value="0">Select Group</option>').val('0');
        $.ajax({
            type: 'post',
            url: baseurl + "classes/get_group_list",
            data: {class_id: item.value},
            dataType: 'json',
            success: function (data) {
                $.each(data.groupList, function (i, group) {
                    $('#from_group').append($('<option>', { 
                        value: group.value,
                        text : group.text 
                    }));
                });
                
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
            var batchId=$("#batchId").val();
            $("#class_list").closest('.form-group').removeClass('has-error');
            $("#class_list").closest('.form-group').find('.error').remove();
            $("#selectclassId").val('');
            var profileClass=$("#profileclassId").val();
            return {
                search: query,
                batchId: batchId,
                profileClass:profileClass
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

});
function changeDate(ev){
    var weekday = new Array(7);
    weekday[0]=  "Sunday";
    weekday[1] = "Monday";
    weekday[2] = "Tuesday";
    weekday[3] = "Wednesday";
    weekday[4] = "Thursday";
    weekday[5] = "Friday";
    weekday[6] = "Saturday";

    var day = weekday[ev.date.getDay()];
    $.each($('.class-groups'),function(){
        if(!$(this).hasClass(day.toLowerCase())){
           $(this).addClass('hidden'); 
           $(this).find('.check-icon').removeClass('fa-check');
           $(this).find('.class_group_d').val(0);
        }
        else{
            $(this).removeClass('hidden'); 
        }
    });
   
}

$("#class_instanceModal").on('click','.class-groups',function(){
    if($("#is_new_group").val()==0){
        $('.check-icon').removeClass('fa-check');
         $('.class_group_d').val(0);
    }
    $(this).find('.check-icon').toggleClass('fa-check');
    if($(this).find('.check-icon').hasClass('fa-check')){
        $(this).find('.class_group_d').val(1);
    }
    else{
        $(this).find('.class_group_d').val(0);
    }
});
$("#class_instanceModal").on('submit',"#class_instance_form",function(e){
    var isSelctctgroup = false;
    $.each($('.class_group_d'),function(){
                if($(this).val()==1){
                    isSelctctgroup=true;
                    return false;
                }
                
            });
    if($("#is_new_group").val()==0 && !isSelctctgroup){
        e.preventDefault();
        $("#group_set").append('<span class="error help-inline">Please select or create class group.</span>');
    }
});

function set_classInstance_validator(){    
    var class_instance_form_validator = jQuery("#class_instance_form").validate({
        rules: {
            class_date: {
                required: true
            },
            description: {
                required: true
            },
            start: {
                required: true
            },
            assistanKey: {
                required: true
            },
            end: {
                required: true
            }
        },
        messages: {
            class_date: {
                required: "Please select date."
            },
            start: {
                required: "Please select start time."
            },
            end: {
                required: "Please select end time."
            },
            description: {
                required: "Please enter description."
            },
            assistanKey: {
                required: "Please enter assistant key."
            }
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
    
}
    $('#class_group_container').on('click','.btn-remove-group',function(){
        var class_group_id =$(this).attr('class_group_id');
        var classId =$(this).attr('classId');
        $("#class_group_delete_modal #btn-delete-classgroup-yes").attr('class_group_id',class_group_id);
        $("#class_group_delete_modal #btn-delete-classgroup-yes").attr('classId',classId);
        $("#class_group_delete_modal").modal('show');
    });
    
    $('#class_group_delete_modal').on('click','#btn-delete-classgroup-yes',function(){
        var class_group_id =$(this).attr('class_group_id');
        var classId =$(this).attr('classId');
        $.ajax({
            type: 'post',
            url: baseurl + "classes/delete_group/"+class_group_id,
            data: {class_id: classId},
            dataType: 'json',
            success: function (data) {
               location.reload();
               
            }
        });
    });
    
    $('#class_group_container').on('click','.btn-edit-group',function(){
        var class_group_id =$(this).attr('class_group_id');
        var classId =$(this).attr('classId');
        $.ajax({
            type: 'post',
            url: baseurl + "classes/load_edit_group/"+class_group_id,
            data: {class_id: classId},
            dataType: 'json',
            success: function (data) {
               if(data.status="success"){
                   $("#edit_class_groupModal").html(data.html);
                   $("#edit_class_groupModal").modal('show');
                   $("#edit_class_groupModal #class_group_date").datepicker({autoclose: true});
                    $("#edit_class_groupModal #classgroup_start").timepicker();
                    $("#edit_class_groupModal #classgroup_end").timepicker();
                    setEditGroupValidator();
               }

            }
        });
    });

    $('#class_group_container').on('click','.btn-show-group-students',function(){
        confirm('This is an example of using JS to create some interaction on a website. Click OK to continue!');
        //var class_group_id =$(this).attr('class_group_id');
        //var classId =$(this).attr('classId');
        //$.ajax({
            //type: 'post',
            //url: baseurl + "classes/load_edit_group/"+class_group_id,
            //data: {class_id: classId},
            //dataType: 'json',
            //success: function (data) {
               //if(data.status="success"){
                    //$("#edit_class_groupModal").html(data.html);
                    //$("#edit_class_groupModal").modal('show');
                    //$("#edit_class_groupModal #class_group_date").datepicker({autoclose: true});
                    //$("#edit_class_groupModal #classgroup_start").timepicker();
                    //$("#edit_class_groupModal #classgroup_end").timepicker();
                    //setEditGroupValidator();
                //}

            //}
        //});
    });


    var edit_class_group_form;
    function setEditGroupValidator(){ 
     edit_class_group_form = jQuery("#edit_class_group_form").validate({
        rules: {
            class_date: {
                required: true
            },
            description: {
                required: true
            },
            start: {
                required: true
            },
            end: {
                required: true
            }
        },
        messages: {
            class_date: {
                required: "Please select date."
            },
            start: {
                required: "Please select start time."
            },
            end: {
                required: "Please select end time."
            },
            description: {
                required: "Please enter description."
            }
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
    }
    


$('#assign_byclass').on('submit','#student_assign_byClass_form',function(e){
    if($("#selectclassId").val()==""){
        e.preventDefault();
        if($("#class_list").closest('.form-group').find('.error').length==0){
            $("#class_list").after('<span class="error help-inline" for="class_list">Please select an available class.</span>');
        }
    }
    else{
         $("#class_list").closest('.form-group').find('.error').remove();
    }
    if($("#from_group").val()==0){
         e.preventDefault();
         if($("#from_group").closest('.form-group').find('.error').length==0){
            $("#from_group").after('<span class="error help-inline" for="class_list">Please select an available group.</span>');
             
         }
    }
    else{
        $("#from_group").closest('.form-group').find('.error').remove();
    }
    if($("#to_group").val()==0){
         e.preventDefault();
         if($("#to_group").closest('.form-group').find('.error').length==0){
            $("#to_group").after('<span class="error help-inline" for="class_list">Please select an available group.</span>');
         }
    }
    else{
        $("#to_group").closest('.form-group').find('.error').remove();
    }
    $("#assign_byclass").modal('hide');

    $.blockUI({ message: '<h1> Just a moment...</h1>' });
});

$('#assign_bygroup').on('submit','#student_assign_byGroup_form',function(e){console.log($("#Fromgroup").val());
    console.log($("#Togroup").val());
   
    $('#assign_bygroup').find('.error').remove();
    if($("#Fromgroup").val()==0){
         e.preventDefault();
         if($("#Fromgroup").closest('.form-group').find('.error').length==0){
            $("#Fromgroup").after('<span class="error help-inline" for="class_list">Please select a group.</span>');
         }
    }
    if($("#Togroup").val()==0){
         e.preventDefault();
         if($("#Togroup").closest('.form-group').find('.error').length==0){
            $("#Togroup").after('<span class="error help-inline" for="class_list">Please select a group.</span>');
         }
    }
    if($("#Fromgroup").val()==$("#Togroup").val()){
         e.preventDefault();
         if($("#Togroup").closest('.form-group').find('.error').length==0){
            $("#Togroup").after('<span class="error help-inline" for="class_list">Please select different group.</span>');
         }
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
				url: baseurl+"students/search/"+1,
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
    
    $("#search_result").on("click",".btn-assign-student",function(){
        var studentId = $(this).attr('studentId');
        $("#assign_group").modal('show');
        $("#assign_group #studentId").val(studentId);
    });
    
  $('#class_fees_modal').on('shown.bs.modal', function () {
    var date = $("#due_date").val();
    $("#due_date").datepicker({
        startDate :date,
        autoclose: true
    });
  });
  
    var changeClassFees = jQuery("#changeclassfees_form").validate({
      rules: {
          amount:{
              required:true,
              number:true
          },
          due_date:{
              required:true
          }
      },
       messages: {
           amount:{
              required:"Please enter class fees",
              number:"Please enter numeric value"
          },
          due_date:{
              required:"Please select due date"
          }
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
  
$("#btn_edit_subject").on('click', function () {
    var selectSubject = jQuery('#subjects :selected').val();
    if (selectSubject == 0) {
        jQuery('#subjects').valid();
    }
    else {
        jQuery.ajax({
            type: 'POST',
            url: baseurl + "subjects/loadEditSubject/",
            data: {id: selectSubject},
            dataType: 'json',
            success: function (data) {
                $("#editSubjectModal").html(data.html);
                $("#editSubjectModal").modal('show');
                setEditSubjectValidation();
            }
        });
    }

});
var editsubject_formvalidator;
function setEditSubjectValidation(){
      editsubject_formvalidator = jQuery("#editsubject-form").validate({
        rules: {
            subjectName: {
                required: true
            }

        },
        messages: {
            subjectName: {
                required: "Please enter Subject Name"
            }
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
    
}

  jQuery('#editSubjectModal').on('click', '#btn_subject_edit', function () {

        if (jQuery('#subject-detail').valid()) {
            var subjectName = jQuery('#subjectName').val();
            var description = jQuery('#editSubjectModal #description').val();
            var id =$(this).attr('subid');
            jQuery.ajax({
                type: 'POST',
                url: baseurl + "subjects/edit/"+id,
                data: {subjectName: subjectName, description: description},
                dataType: 'json',
                async: false,
                cache: false,
                success: function (data) {
                    if (data.status == "success") {
                        jQuery('#editsubject-form')[0].reset();
                        editsubject_formvalidator.resetForm();
                        jQuery('#editSubjectModal').modal('hide');
                        jQuery("#subjects option[value=" + id + "]").text(subjectName);
                    }
                }
            });

        }
    });
    
     
$("#btn_edit_batch").on('click', function () {
    var selectBatch = jQuery('#batches :selected').val();
    if (selectBatch == 0) {
        jQuery('#batches').valid();
    }
    else {
        jQuery.ajax({
            type: 'POST',
            url: baseurl + "batch/loadEditBatch/",
            data: {id: selectBatch},
            dataType: 'json',
            success: function (data) {
                $("#editBatchModal").html(data.html);
                $("#editBatchModal").modal('show');
                setEditBatchValidation();
                $('#editBatchModal #year').datepicker({
                      format: " yyyy",
                    viewMode: "years",
                    minViewMode: "years",
                    autoclose: true
                }
                
                        );
                /*
                  var d = new Date();
        var startYear = d.getFullYear() - 3;
        var endYear = d.getFullYear() + 3;
                $('#editBatchModal #year').datepicker({
                    format: " yyyy",
                    viewMode: "years",
                    minViewMode: "years",
                    startDate: startYear,
                    endDate: endYear
                }).datepicker("setDate", new Date());*/
            }
        });
    }

});
   var edit_batch_form_validator;
function setEditBatchValidation(){
     edit_batch_form_validator = jQuery("#edit_batch_form").validate({
        rules: {
            batchName: {
                required: true
            },
            year: {
                required: true
            }
        },
        messages: {
            batchName: {
                required: "Please enter Batch Name"
            },
            year: {
                required: "Please select Year"
            }
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
}

  jQuery('#editBatchModal').on('click', '#btn_batch_edit', function () {

        if (edit_batch_form_validator.valid()) {
            var batchName = jQuery('#batchName').val();
            var description = jQuery('#editBatchModal #description').val();
            var year = jQuery('#editBatchModal #year').val();
            var id =$(this).attr('batchid');
            jQuery.ajax({
                type: 'POST',
                url: baseurl + "batch/edit/"+id,
                data: {batchName: batchName, description: description,year:year},
                dataType: 'json',
                async: false,
                cache: false,
                success: function (data) {
                    if (data.status == "success") {
                        jQuery('#edit_batch_form')[0].reset();
                        edit_batch_form_validator.resetForm();
                        jQuery('#editBatchModal').modal('hide');
                        jQuery("#batches option[value=" + id + "]").text(batchName+'-'+year);
                    }
                }
            });

        }
    });
    
   