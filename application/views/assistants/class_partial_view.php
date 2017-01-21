<div class="col-md-3" id="class_<?php echo $classId;?>">
    <div class=" alert-info bottom-margin-5 ">
        <div class="inline-container clearfix ">
            <div class="col-md-10"><?php echo $className.' - '.$batch; ?></div>
            <div class="col-md-2 text-right">
                <a href="javascript:void(0);" class="btn_close_class" classId="<?php echo $classId;?>"><i class="fa fa-remove"></i></a>
            </div>
            <input class="classname" type="hidden" name="class_list[]" value="<?php echo $classId;?>"/>
        </div>
    </div>
</div>