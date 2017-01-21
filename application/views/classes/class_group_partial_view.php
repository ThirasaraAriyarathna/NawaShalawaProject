<div class="col-md-4">
    <div class=" alert-info margin-bottum-5 ">
        <div class="inline-container clearfix ">
            <div class="col-md-10">
                <div class="col-md-12">
                    <strong>
                        <?php echo $group['DayOfWeek'] . ' ( ' . date('h:i a', $group['StartTime']) . '-' . date('h:i a', $group['EndTime']) . ' )'; ?>
                    </strong>
                </div>
                <div class="col-md-10"><small><?php echo $group['Description']; ?></small></div>
            </div>
            <div class="col-md-2 text-right">
                <?php if ($group['IsActive'] == 0) { ?>
                    <a href="#" classId="<?php echo $group['ClassId']; ?>" class_group_id="<?php echo $group['ClassGroupId']; ?>"><i class="fa fa-remove"></i></a>
                    <?php } ?>
            </div>
        </div>
    </div>
</div>