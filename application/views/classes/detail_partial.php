<?php
if (isset($class_details) && count($class_details) > 0) {

    foreach ($class_details as $class_detail){
      // print_r($class_detail);
        ?>
    <div class=" col-sm-6 col-md-4">
                                <div class="inline-container">
                                    <a class="class-item class_data" <?php if($class_detail['ActiveInstance']==1) echo 'active=""'; ?> href="javascript:void(0);"  id="<?php echo $class_detail['ClassId']; ?>" classdateId="<?php if(isset($class_detail['ClassDateId'])) echo $class_detail['ClassDateId']; ?> ">
                                        <div class="dashboard-menu-item" class_id="<?php echo $class_detail['ClassId']; ?>">
                                            <div class="col-xs-12 col-md-12" ><h3 class="class-name"><?php echo $class_detail['ClassName'].' : '.$class_detail['BatchName'].' - '.$class_detail['BatchYear']; ?></h3></div>
                                            <div class="col-xs-12 col-md-12"><p class="class-des"><?php echo character_limiter($class_detail['Description'],60); ?></p></div>
                                            <div class="col-xs-12 col-md-12"> 
                                                <div class="col-xs-8 col-md-9">
                                                    <h6 class="class-teacher">By <?php echo $class_detail['FirstName'].' '.$class_detail['LastName']; ?></h6>
                                                </div>
                                                <div class="col-xs-4 col-md-3 class-actions pull-right">
                                                    <?php if($class_detail['ActiveInstance']==1){ ?>
                                                    <a href="javascript:void(0);">
                                                        <i class="fa fa-circle"></i>
                                                    </a>
                                                    <?php } else {?>
                                                    <a href="javascript:void(0);">
                                                        <i class="fa fa-circle-thin"></i>
                                                    </a>
                                                    <?php }?>
                                                    <?php if($user_data['UserType']==1){ ?>
                                                    <a href="<?php echo base_url().'classes/edit/'.$class_detail['ClassId']; ?>">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="javascript:void(0);" class="btn-class-remove" class_id="<?php echo $class_detail['ClassId']; ?>" >
                                                        <i class="fa fa-remove"></i>
                                                    </a>
                                                    <?php } ?>
                                                </div>
                                            </div>

                                        </div>
                                    </a>
                                </div>
                            </div>
<!--    <div class="col-sm-4 col-md-4" style="margin-bottom:20px;">
        <a href="javascript:void(0);" class="class_data" id="<?php echo $class_detail['ClassId']; ?>" <?php if(isset($class_detail['ActiveInstance']) && $class_detail['ActiveInstance']){ echo 'active';} ?> >                                              

            <div class="inline-container">
                <div class="row" class_id="<?php echo $class_detail['ClassId']; ?>" style="border: 1px solid #0077b3;">
                    <div class="col-sm-11 col-md-11">
                        <h5><?php echo $class_detail['ClassName'] . ' : ' . $class_detail['BatchName'] . ' - ' . $class_detail['BatchYear']; ?></h5>
                        <p><?php echo character_limiter($class_detail['Description'],60); ?></p>
                        <h6>By <?php echo $class_detail['FirstName'] . ' ' . $class_detail['LastName']; ?></h6>
                    </div>
                    <div class="col-sm-1 col-md-1">
                        <a>
                            <span class="glyphicon glyphicon-remove"></span> 
                        </a>
                        <a href="#">
                            <span class="glyphicon glyphicon-edit"></span> 
                        </a>
                        <?php if(isset($class_detail['ActiveInstance']) && $class_detail['ActiveInstance']){ ?>
                        <a href="#" >
                            <span class="glyphicon  glyphicon-time" ></span> 
                        </a>
                        <?php }?>
                    </div>
                </div>
            </div>
        </a>
    </div>-->
<?php }
}
else{
    echo 'No results found.';
}
?>