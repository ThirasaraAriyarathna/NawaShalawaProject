<?php 
 include(APPPATH . 'views/common/header.php');
 ?>

<div class="container">
   
        <div class="row main-page">

            <div class="vd-page-container">

                <div class="vd-page-content">
                    <?php 
                                            if($this->session->flashdata('message-success')){ ?>
                                                <div class="alert alert-success vd-alert"><?php echo $this->session->flashdata('message-success'); ?></div>
                                          <?php  }
                                            else if($this->session->flashdata('message-error')){ ?>
                                                <div class="alert alert-danger vd-alert"><?php echo $this->session->flashdata('message-error'); ?></div>
                                        <?php    }
                                            else if($this->session->flashdata('message-info')){ ?>
                                                <div class="alert alert-info vd-alert"><?php echo $this->session->flashdata('message-info'); ?></div>
                                         <?php   }
                                        ?>
                    <div class="row">
                        <div class="col-md-12 col-xs-12 col-sm-6">
                            <div class="inline-container">
                            <form class="navbar-form navbar-left col-md-12" id="class_search_form" role="search" onsubmit="return false;">
                                                <div class="form-group">
                                                    <select name="batch" id="batch" class="form-control">
                                                        <?php foreach ($batches as $batch) { ?>
                                                        <option value="<?php echo $batch['BatchId']; ?>" ><?php echo $batch['Name'].' - '.$batch['Year']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" id="class_name" name="class_name" class="form-control" placeholder="Class Name">
                                                </div>
                                                <button id="search-btn" class="btn btn-default btn-flat">Search</button>
                            </form>
                            <div class="col-md-2 navbar-right">
                                <div class="inline-container">
                                    <?php if($user_data['UserType']==1){ ?>
                                    <a href="<?php echo base_url().'classes/add'; ?>" class="btn btn-primary btn-flat">Add Class</a>
                                    <?php } ?>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12" id="class_list_container">
                            <?php
                                            foreach($classes as $class) {
                                                ?>
                            <div class=" col-sm-6 col-md-4">
                                <div class="inline-container">
                                    <a class="class-item class_data" <?php if($class['ActiveInstance']==1) echo 'active=""'; ?> href="javascript:void(0);" classdateid="<?php echo $class['ClassDateId']; ?>" id="<?php echo $class['ClassId']; ?>">
                                        <div class="dashboard-menu-item" class_id="<?php echo $class['ClassId']; ?>">
                                            <div class="col-xs-12 col-md-12" ><h3 class="class-name"><?php echo $class['ClassName'].' : '.$class['BatchName'].' - '.$class['BatchYear']; ?></h3></div>
                                            <div class="col-xs-12 col-md-12"><p class="class-des"><?php echo character_limiter($class['Description'],60); ?></p></div>
                                            <div class="col-xs-12 col-md-12"> 
                                                <div class="col-xs-8 col-md-9">
                                                    <h6 class="class-teacher">By <?php echo $class['FirstName'].' '.$class['LastName']; ?></h6>
                                                </div>
                                                <div class="col-xs-4 col-md-3 class-actions pull-right">

                                                    <?php if($class['ActiveInstance']==1){ ?>
                                                    <a href="javascript:void(0);">
                                                        <i class="fa fa-circle"></i>
                                                    </a>
                                                    <?php } else {?>
                                                    <a href="javascript:void(0);">
                                                        <i class="fa fa-circle-thin"></i>
                                                    </a>
                                                    <?php }?>
                                                   <?php if($user_data['UserType']==1){ ?>
                                                     <a href="<?php echo base_url().'classes/edit/'.$class['ClassId']; ?>">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="javascript:void(0);" class="btn-class-remove" class_id="<?php echo $class['ClassId']; ?>" >
                                                        <i class="fa fa-remove"></i>
                                                    </a>
                                                   <?php } ?>
                                                </div>
                                            </div>

                                        </div>
                                    </a>
                                </div>
                            </div>
                            
                            
                                            <?php }?>
                            
                        </div>
                    </div>
                    <div class=" clearfix">
                        <div class="col-md-12" id="load_more_show">
                            <input type="button" batch_id="" class_name="" offset="" id="load_more_classes" class="hidden col-md-12 btn btn-default btn-flat" value="Load More" />
                        </div>
                    </div>
                </div>
            </div>

    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="class_instanceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  
</div>
<div class="modal fade" id="delete_class" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel">Delete the class</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div  class="col-md-12">
                   <div class="inline-container">
                       <div class="col-md-12">
                           Are you sure want to delete this class ?
                       </div>
                   </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            <button class_id="" class="btn btn-danger" id="btn-class-remove-yes" >Yes</button>
        </div>
    </div>
</div>
</div>
<?php 
 include(APPPATH . 'views/common/footer.php');
 ?>
