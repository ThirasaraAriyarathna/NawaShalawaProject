<?php if (isset($search_results) && count($search_results["results"]) > 0) { ?>
    <table class="table">
        <thead>
            <tr>
                <th>Admission No.</th>
                <th>Name</th>
                <th>Classes</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach ($search_results["results"] as $result){?>
            <tr>
                <td><a target="_blank" class="btn admissionID assistant_data" id="<?php echo $result['AdmissionID'];?>" href="<?php echo base_url().'assistants/details/'.$result['AssistantId']; ?>"><?php echo $result['AdmissionID'];?></a></td>
                <td><?php echo $result['Title'].' '.$result['FirstName'].' '.$result['LastName'];?></td>
                <td>
                    <?php
                        $classes = explode(',',$result['Classes']);
                        $batchesName = explode(',',$result['BatchName']);
                        $batchesYear = explode(',',$result['BatchYear']);
                        if(count($classes)>0){
                        foreach ($classes as $k=>$class){ 
                            if(!empty($class)){ ?>
                    <span class="label label-info"><?php echo $class." : ".$batchesName[$k].'-'.$batchesYear[$k]; ?></span>
                            <?php   } }}
                    ?>
                </td>
                <td>
                    <?php  if($result['IsActive']==1){ 
                        ?>
                    <span class="label label-success">Active</span>
                   <?php }
                    else{?>
                        <span class="label label-danger">De-active</span>
                 <?php   }
?>
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
