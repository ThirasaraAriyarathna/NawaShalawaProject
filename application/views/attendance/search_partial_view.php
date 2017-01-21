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
                <td><a class="btn admissionID student_data" id="<?php echo $result['AdmissionID'];?>"><?php echo $result['AdmissionID'];?></a></td>
                <td><?php echo $result['FirstName'].' '.$result['LastName'];?></td>
                <td><?php if(isset($result['Subjects'])) echo $result['Subjects']; ?></td>
               
                    
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
