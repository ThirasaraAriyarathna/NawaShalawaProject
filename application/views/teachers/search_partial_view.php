<?php if (isset($search_results) && count($search_results["results"]) > 0) { ?>
    <table class="table" id="student_search_list">
        <thead>
            <tr>
                <th>Admission No.</th>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Classes</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach ($search_results["results"] as $result){?>
            <tr id="teacher_<?php echo $result['TeacherId']; ?>">
                <td><?php echo $result['AdmissionID'];?></td>
                <td><?php echo $result['FirstName'].' '.$result['LastName'];?></td>
                <td><?php 
                $addrs=array($result['AddressLine1']);
                if(!empty($result['AddressLine2'])){
                    array_push($addrs, $result['AddressLine2']);
                }
                if(!empty($result['City'])){
                    array_push($addrs, $result['City']);
                }
                echo implode(',',$addrs); ?></td>
                <td><?php echo $result['Phone'];?></td>
                <td><?php
                if(isset($result['classes']) && $result['classes']){
                    foreach ($result['classes'] as $class){ ?>
                    <span class="label label-info"><?php echo $class['ClassName'].':'.$class['BatchName'].'-'.$class['BatchYear']; ?></span> 
                   <?php }
                }
                ?></td>
                <td>
                    <div class="serch_form_result_actions">
                        <!--<image class="btnEdit" studentId="<?php echo $result['TeacherId'];?>"  width="20"  title="edit" style="cursor: pointer;" src="<?php echo base_url();?>assets/images/icons/edit.jpg"/>-->
                         <?php if($user_data['UserType']==1){ ?>
                        <a target="_blank" href="<?php echo base_url().'teachers/edit/'.$result['TeacherId']; ?>" ><i class="icon-edit"></i></a>
                         
                        <a admitionId="<?php echo $result['AdmissionID'];?>" teacherId="<?php echo $result['TeacherId'];?>"  href="javascript:void(0);" class="btn_delete_teacher"><i class="icon-remove"></i></a>
                        <?php }?>
                        <!--<image class="btnDelete" studentId="<?php // echo $result['TeacherId'];?>"  width="27"  title="delete" style="cursor: pointer; margin-left: 10px;" src="<?php echo base_url();?>assets/images/icons/delete.png"/>--> 
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
