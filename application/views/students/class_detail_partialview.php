<?php if(isset($details)){  ?>
<div class="alert alert-block alert-success class_group_container">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <input type="hidden" name='class_id[]' value="<?php echo $details['ClassId']; ?>" />
    <strong><?php echo $details['ClassName'].'-'.$details['FirstName'].' '.$details['LastName'] ; ?></strong> 
    <p>
    <label  class="control-label input-lable pull-left ">Fees rate</label>
    <select name="class_fees[<?php echo $details['ClassId']; ?>]" <?php if($user_data['UserType']!=1){ ?>  disabled="disabled" <?php } ?>>
        <option value="1">1</option>
        <option value="0">0</option>
        <option value="0.5">1/2</option>
        <option value="0.75">3/4</option>
    </select>
    
    </p>
    <?php if(isset($details['classGroups']) && count($details['classGroups'])){ ?>
    <div class="clear-fix margin-top-10 clss_grps_parent" >
        <?php foreach ($details['classGroups'] as $group){ ?>
     
        <div class="alert alert-info span3 class_grps">
            <button type="button" class=" btn_clss_grps_rmve close" >&times;</button>
            <?php echo substr($group[0]['DayOfWeek'], 0,3). ' ( '.  date('h:i A',$group[0]['StartTime']).'-'.date('h:i A',$group[0]['EndTime']).' )'  ?>
            <p><small><?php echo $group[0]['Description'];?></small></p>
            <input type="hidden" name='class_groups[<?php echo $details['ClassId']; ?>][]' value="<?php echo $group[0]['ClassGroupId'];?>" />
        </div>
       <?php } ?>
        
    </div>
    <?php } ?>
</div>
<?php } ?>