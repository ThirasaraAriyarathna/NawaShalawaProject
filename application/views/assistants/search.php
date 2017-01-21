<?php
include(APPPATH . 'views/common/header.php');
date_default_timezone_set($this->config->item("time_zone"));
?>


<div class="container">
    <div class="row main-page">
        <div class="vd-page-container">
            <div class="vd-page-content">
                <?php if ($this->session->flashdata('message-success')) { ?>
                    <div class="alert alert-success vd-alert"><?php echo $this->session->flashdata('message-success'); ?></div>
                <?php } else if ($this->session->flashdata('message-error')) {
                    ?>
                    <div class="alert alert-danger vd-alert"><?php echo $this->session->flashdata('message-error'); ?></div>
                <?php } else if ($this->session->flashdata('message-info')) {
                    ?>
                    <div class="alert alert-info vd-alert"><?php echo $this->session->flashdata('message-info'); ?></div>
                <?php }
                ?>
                <div class="row">
                    <div class="col-md-12 col-xs-12 col-sm-6">
                        <div class="inline-container">
                            <div class="col-img col-sm-4 col-xs-3">
                                <img class='header-icon' src='<?php echo base_url(); ?>assets/boostrap/images/assistant.png'/>
                            </div>
                            <div class="col-md-7 col-sm-4 col-xs-3">
                                <div class="col-md-12 "><h2>Search Assistant</h2></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <!--                <hr>-->
                <div class="col-md-12">
                    <div class="inline-container">
                        <div class="col-md-12">
                            <div class="row ">
                                <div class="col-md-12">
                                    <div class="inline-container">
                                        <div class="col-md-12">
                                            <form id="searchForm" onsubmit="return false;"  >
                                                <div class="form-group col-md-3">
                                                    <input type="text" id="searchedText" class="form-control input-flat" autocomplete="off" name="searchedText" id="student" placeholder="Assistant Id / Name">
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-success" id="btnSearch">Search</button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="inline-container">
                                        <div id="search_result" class="col-md-12 ">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>

            </div>
        </div>

    </div>
</div>
<?php
include(APPPATH . 'views/common/footer.php');
?>