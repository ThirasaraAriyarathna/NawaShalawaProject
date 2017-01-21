<?php if (isset($search_results) && count($search_results["results"]) > 0) { ?>
    <table class="table">
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
            <tr>
                <td><?php echo $result['AdmissionID'];?></td>
                <td><?php echo $result['FirstName'].' '.$result['LastName'];?></td>
                <td><?php if(isset($result['Subjects'])) echo $result['Subjects']; ?></td>
                <td>
                    <div class="serch_form_result_actions">
                        <a href="javascript:void(0);" class="label label-primary btn-assign-student" studentId="<?php echo $result['StudentId'];?>" >Assign</a>
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
