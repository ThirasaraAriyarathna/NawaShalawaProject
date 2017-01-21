
<?php include(APPPATH.'views/common/page-header.php') ?>
<?php // include(APPPATH.'views/common/menu-bar.php') ?> 
            <!-- end menu content-->
            <!-- start page content-->
            <div id="content_wrapper">
                <div id="content"> 
                    <div id="content-header" class="row">
                        <div class="span2 pull-left">
                            <img src="<?php echo base_url() ?>/assets/images/dashboard/news-icon.jpg" alt="Manage_news_logo" class="pull-left">
                        </div>
                        <ul class="unstyled pull-left">
                            <li><h1>Student Details</h1></li>
                            <li><h3>View Details</h3></li>
                        </ul>

                    </div>

                    <div class="extender"></div>
                    <div class="div_divider" ></div>
                    <div class="extender"></div>
                    <div id="sub-menu" class="row pull-right">
                        <button class="btn btn-primary" id="btn_viewAll" type="button">View All</button>
                        <!--<button class="btn btn-primary" type="button" id="ele-adv-btn">Advanced Search</button>-->
                    </div>
                     <div class="extender"></div>
                    <div id="ele-student_search_form" class="well student_search_form">
                        
                            
                        <form id="searchForm" onsubmit="return false;"  class="form-search">
                            <div class="control-group span4">
                                    <div class="controls">
                                        <input type="text" id="searchedText" autocomplete="off"  name="searchedText" class="input-large search-query">
                                <!--<button class="btn" type="button" id="btnSearch">Search</button>-->
                                    </div>
                            </div>
<!--                                <label class="radio ">
                                    <input type="radio" checked="" value="option1" id="optionsRadios1" name="optionsRadios">
                                    Present students
                                </label>
                                <label class="radio ">
                                    <input type="radio" value="option2" id="optionsRadios2" name="optionsRadios">
                                    Former students
                                </label>  -->
                                <button class="btn" type="button" id="btnSearch">Search</button>
                                
                            </form>
                         

                    </div>
<!--                     <div id="ele-student_advance_search_form" style="display: none;" class="well student_search_form">
                        
                            <a class="close" data-dismiss="modal">�</a> 
                             <div class="extender"></div>
                     
                            <form class=" form-search ">
                                <input type="text" class="input-large search-query">
                                <select id="select01">
                                    <option>Grade</option>
                                    <option>10</option>
                                    <option>11</option>
                                    <option>12</option>
                                    <option>13</option>
                                </select>
                                <select id="select01">
                                    <option>Course</option>
                                    <option>Chemistry</option>
                                    <option>Physics</option>
                                    <option>Maths</option>
                                </select>
                                
                                <label class="radio">
                                    <input type="radio" checked="" value="option1" id="optionsRadios1" name="optionsRadios">
                                    Present students
                                </label>
                                <label class="radio">
                                    <input type="radio" value="option2" id="optionsRadios2" name="optionsRadios">
                                    Former students
                                </label>  
                            
                                <button class="btn" type="submit">Search</button>
                            </form>
                            

                   

                    </div>-->
                     
                    <div id="search_result" class="search-result">
                        
                    </div>

                </div>
            </div>
            <!-- end page content-->
        </div>
<!--Start student detail view-->
<div class="modal fade" id="DetailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Student Detail</h4>
        </div>
        <div class=" student-detail-body modal-body">
           
        </div>
        <div class="modal-footer">
        </div>
    </div>
</div> 
</div>
<!--End student detail view-->

<div class="modal fade" id="student_delete_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Delete Student</h4>
        </div>
        <div class="modal-body">
            <div   class="col-md-12">
           
                <div id="delete_conf_body" class="inline-container">
                  
                
                 </div>
            </div>
        </div>
        <div class="modal-footer">
            <button  studentId="" type="button" class="btn btn-danger " id="btn-delete-student-yes">Yes</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        </div>
    </div>
</div>
</div>

       
 <?php include(APPPATH.'views/common/page-footer.php') ?>  
 <script type="text/javascript">
            // When the document is ready
            $(document).ready(function() {
                $('#searchedText').focus();
            });
        </script>
   
