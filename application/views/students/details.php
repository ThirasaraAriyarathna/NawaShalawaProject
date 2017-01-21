
                 <div id="accordion2" class="accordion">
                <div class="accordion-group">
                    <div class="accordion-heading" style="background-color: gray;">
                        <a href="#collapseOne" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle">
                            Personal Details
                        </a>
                    </div>
                    <div class="accordion-body in collapse" id="collapseOne">
                        <div class="accordion-inner">
                            <div class="span3">
                            <b>Admission  : </b><?php if(isset($details['AdmissionID'])) echo $details['AdmissionID']; ?> <b> on </b><?php if(isset($details['DateAdded'])) echo date('d M Y',$details['DateAdded']); ?><br>
                            <?php echo $details['FirstName'].' '.$details['LastName']; ?><br>
                            <?php if(isset($details['DateOfBirth'])) echo date('d M Y',$details['DateOfBirth']); ?><br>
                            <?php if(isset($details['Gender']) && $details['Gender']==0 ) echo 'Female'; elseif(isset($details['Gender']) && $details['Gender']==1 ) echo 'Male'; ?><br>
                            <?php if(isset($details['School'])) echo $details['School']; ?>, <?php if(isset($details['District'])) echo $details['District']; ?><br>
                          
                            
                            </div>
                            <div class="span3">
                                <b>Contact  : </b><br>
                                <?php
                                $address=array();
                                if(isset($details['AddressLine1']) && !empty($details['AddressLine1'])){
                                    array_push($address,$details['AddressLine1']);
                                } 
                                if(isset($details['AddressLine2']) && !empty($details['AddressLine2'])){
                                    array_push($address,$details['AddressLine2']);
                                }
                                if(isset($details['City']) && !empty($details['City'])){
                                    array_push($address,$details['City']);
                                }
                                echo implode(', ', $address).'.';
                                ?><br>
                                <?php if(isset($details['State'])) echo $details['State']; ?><br>
                                <?php
                                $phone=array();
                                if(isset($details['Phone']) && !empty($details['Phone'])){
                                    array_push($phone,$details['Phone']);
                                } 
                                if(isset($details['Mobile']) && !empty($details['Mobile'])){
                                    array_push($phone,$details['Mobile']);
                                } echo implode('/ ', $phone); ?><br>
                              <?php if(isset($details['Email'])) echo $details['Email']; ?>
                                
                            </div>
                            <div class="span4" style="margin-top: 10px;margin-bottom: 10px;">
                                <b>Parent  : </b><br>
                                <?php if(isset($details['ParentFirstName'])) echo $details['ParentFirstName']; ?> <?php if(isset($details['ParentLastName'])) echo $details['ParentLastName']; ?> (<?php if(isset($details['Relation'])) echo $details['Relation']; ?>)<br>
                                 <?php if(isset($details['ParentAddress'])) echo $details['ParentAddress']; ?><br>
                                <?php if(isset($details['ParentPhone'])) echo $details['ParentPhone']; ?><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-group">
                    <div class="accordion-heading" style="background-color: gray;">
                        <a href="#collapseTwo" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle">
                           Attendance & Fees Details
                        </a>
                    </div>
                    <div class="accordion-body collapse" id="collapseTwo" >
                        <div class="accordion-inner">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Class</th><th>Teacher</th><th>Groups</th> 

                                </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($details['classes']) && count($details['classes'])>0){
                                         foreach ($details['classes'] as $class){ ?>
                                                <tr><td><?php if(isset($class['ClassName'])) echo $class['ClassName']; ?></td><td><?php if(isset($class['FirstName'])) echo $class['FirstName']; ?> <?php if(isset($class['LastName'])) echo $class['LastName']; ?></td>
                                                    <td>
                                                        <?php if(isset($class['groups']) && count($class['groups'])>0){
                                                            $groups=array();
                                                            foreach ($class['groups'] as $group){ 
                                                                $text=substr($group['DayOfWeek'],0,3).' - ('.date('h:i A',$group['StartTime']).')';
                                                                array_push($groups, $text);
                                                            }
                                                           echo implode(' | ', $groups);
                                                        }
                                    ?>
                                                    </td>
                                                </tr>
                                             
                                     <?php    }
                                    }  ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
            </div>