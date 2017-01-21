<?php 
        
        include(APPPATH . 'views/common/header.php');
        date_default_timezone_set($this->config->item("time_zone"));
        
        ?>
<style>
    .bottom-margin-5{
        margin-bottom:  5px;
    }
    .left-padding-10{
        padding-left: 10px;
    }
</style>
<div class="container">

    <div class="row main-page">

        <div class="vd-page-container">

            <div class="vd-page-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-9">
                            <div class="inline-container">
                                <h1><?php echo $class_detail['ClassName']; ?> <small> - <?php echo $class_detail['Description']; ?></small></h1>
                            </div>
                        </div>
                        <div class="col-md-3 text-right">
                            <div class="inline-container">
                                <div class="col-md-12"><h1><?php echo date('d-M-Y',time()); ?></h1></div>
                                <div class="col-md-12">@ <?php echo date('h:i a',time()); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="inline-container">
                            <div class="col-md-3"> <i class="fa fa-link"></i> Conducted By <?php echo $class_detail['TFName'] . ' ' . $class_detail['TLName']; ?> </div>
<!--                            <div class="col-md-3"> <i class="fa fa-link"></i> Assits By Mr. Jhone 
                            </div>-->
                            <div class="col-md-3"> <i class="fa fa-link"></i> <?php echo $class_detail['BatchName'] . '-' . $class_detail['BatchYear']; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="inline-container">
                            <div class="col-md-12">
                                <table class="table table-hover">
                                    
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Student Id</th>
                                            <th>Name</th>
                                            <th>Fees Rate</th>
                                            <th>Arrival Time</th>
                                            <th>Topup</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $totalFees=0;
                                        
                                        foreach ($students as $i=>$student){
                                            if(isset($student['Amount']))
                                                $totalFees+=$student['Amount'];
                                            ?>
                                            <tr>
                                            <td><?php echo ($i+1); ?></td>
                                            <td><?php echo $student['AdmissionID'] ?></td>
                                            <td><?php echo (($student['Gender']==0)?'Ms':'Mr').' '.$student['FirstName'].' '.$student['LastName']; ?></td>
                                            <td><?php echo ($student['FeesRate']==0?'Free card':$student['FeesRate']); ?></td>
                                            <td><?php echo date('h:i A',$student['Time']); ?></td>
                                            <td><?php echo (isset($student['Amount']))?$student['Amount']:'-'; ?></td>
                                           
                                            </tr>
                                       <?php } ?>
                                        
                                     
                                    </tbody>
                                    
                                </table>
                               
                            </div>
                                            
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="inline-container">
                            <div class="col-md-11 text-right">
                                <div class="col-md-12">
                                    <div class="col-md-9">Total Numbers of students attend the class</div>
                                    <div class="col-md-1">=</div>
                                    <div class="col-md-2 text-right"><?php echo count($students);?></div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-9">Total amount of the fees that collect today</div>
                                    <div class="col-md-1">=</div>
                                    <div class="col-md-2 text-right"><?php echo $totalFees;?></div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

<?php include(APPPATH . 'views/common/footer.php'); ?>  