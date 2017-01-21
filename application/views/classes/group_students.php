<?php include(APPPATH.'views/common/header.php') ?>
<?php  //include(APPPATH.'views/common/menu-bar.php') ?>

<div class = "col-md-offset-3 col-xs-6 col-sm-6">
<table class="table" id="student_class_list">
    <br><br><br><br>
    <thead>
    <tr>
        <th>Admission No.</th>
        <th>Name</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($students as $student){?>
        <tr id="student_<?php echo $student['StudentId']; ?>">
            <td><a class="btn admissionID" data-toggle="modal"  studentId="<?php echo $student['StudentId'];?>" ><?php echo $student['AdmissionID'];?></a></td>
            <td><?php echo $student['FirstName'].' '.$student['LastName'];?></td>
            <td><?php if(isset($student['Subjects'])) echo $student['Subjects']; ?></td>
            <td>
                <div class="serch_form_result_actions">
                    <!--<image class="btnEdit" studentId="<?php echo $student['StudentId'];?>"  width="20"  title="edit" style="cursor: pointer;" src="<?php echo base_url();?>assets/images/icons/edit.jpg"/>-->
                    <a target="_blank" href="<?php echo base_url().'students/edit/'.$student['StudentId']; ?>" ><i class="icon-edit"></i></a>
                    <a admitionId="<?php echo $student['AdmissionID'];?>" studentId="<?php echo $student['StudentId'];?>"  href="javascript:void(0);" class="btn_delete_student"><i class="icon-remove"></i></a>
                    <!--<image class="btnDelete" studentId="<?php // echo $student['StudentId'];?>"  width="27"  title="delete" style="cursor: pointer; margin-left: 10px;" src="<?php echo base_url();?>assets/images/icons/delete.png"/>-->
                </div>
            </td>

        </tr>
    <?php }?>
    </tbody>
</table>
</div>
<?php include(APPPATH.'views/common/page-footer.php') ?>
<script type="text/javascript">
    // When the document is ready
    $(document).ready(function() {
        $('#searchedText').focus();
    });
</script>

