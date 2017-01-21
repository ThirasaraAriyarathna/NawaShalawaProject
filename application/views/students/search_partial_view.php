<?php if (isset($search_results) && count($search_results["results"]) > 0) { ?>
    <table class="table" id="student_search_list">
        <thead>
            <tr>
                <th>Admission No.</th>
                <th>Name</th>
                <th>Courses taken</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach ($search_results["results"] as $result){?>
            <tr id="student_<?php echo $result['StudentId']; ?>">
                <td><a class="btn admissionID" data-toggle="modal"  studentId="<?php echo $result['StudentId'];?>" ><?php echo $result['AdmissionID'];?></a></td>
                <td><?php echo $result['FirstName'].' '.$result['LastName'];?></td>
                <td><?php if(isset($result['Subjects'])) echo $result['Subjects']; ?></td>
                <td>
                    <div class="serch_form_result_actions">
                        <!--<image class="btnEdit" studentId="<?php echo $result['StudentId'];?>"  width="20"  title="edit" style="cursor: pointer;" src="<?php echo base_url();?>assets/images/icons/edit.jpg"/>-->
                        <a target="_blank" href="<?php echo base_url().'students/edit/'.$result['StudentId']; ?>" ><i class="icon-edit"></i></a>
                        <a admitionId="<?php echo $result['AdmissionID'];?>" studentId="<?php echo $result['StudentId'];?>"  href="javascript:void(0);" class="btn_delete_student"><i class="icon-remove"></i></a>
                        <!--<image class="btnDelete" studentId="<?php // echo $result['StudentId'];?>"  width="27"  title="delete" style="cursor: pointer; margin-left: 10px;" src="<?php echo base_url();?>assets/images/icons/delete.png"/>--> 
                    </div>
                </td>
                    
            </tr>
            <?php }?>
        </tbody>
    </table>
<?php

} else {?>
<div class="no-result">
    <h1>No results found</h1>
</div>
<?php } ?>
