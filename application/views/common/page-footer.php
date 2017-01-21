<!-- start footer-->
        <footer class="footer">
            <div id="footer_logo">
                <div id="powered_by">

                </div>
            </div>
        </footer>
        <!-- end content-->

        <!-- Load jQuery and bootstrap datepicker scripts -->
        <!-- <script src="<?php //echo base_url(); ?>assets/js/jquery-1.7.2.min.js"></script>
        <script src="<?php //echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
        <script src="<?php //echo base_url(); ?>assets/js/bootstrap.js"></script> -->
        <script type="text/javascript">
             var baseurl = '<?php echo $this->config->item("base_url"); ?>';
        </script> 
        
        <?php
        $jsfiles = array();
        $jsfiles = $this->session->userdata('scripts');
        $_js = array();
        $isset_js = false;

        $_js_3rd = array();
        $isset_js_3rd = false;
        if (isset($js_3rd) && is_array($js_3rd) && count($js_3rd) > 0) {
            $_js_3rd = $js_3rd;
            $isset_js_3rd = true;
        }
        if (is_array($jsfiles['js_3rd']) && count($jsfiles['js_3rd']) > 0 && !$isset_js_3rd) {
            $_js_3rd = $jsfiles['js_3rd'];
        } else if (is_array($jsfiles['js_3rd']) && count($jsfiles['js_3rd']) > 0 && $isset_js_3rd) {
            $_js_3rd = array_merge($js_3rd, $jsfiles['js_3rd']);
        }

        if (count($_js_3rd) > 0) {
            foreach ($_js_3rd as $js_3rd_val) {
                ?>
                <script type="text/javascript" src="<?php echo $this->config->item('js_3rd') . $js_3rd_val; ?>"></script>
            <?php
            }
        }
        ?> 
        <?php
       
        $js = array();
       
        if (is_array($jsfiles['js']) && count($jsfiles['js']) > 0) {
            $js = $jsfiles['js'];
        }
        if (is_array($js) && count($js) > 0) {
            foreach ($js as $js_value) {
                ?>
                <script type="text/javascript" src="<?php echo $this->config->item('js_path') . $js_value; ?>"></script>
            <?php
            }
        }

        if (is_array($jsfiles['js_scripts']) && count($jsfiles['js_scripts']) > 0) {
            foreach ($jsfiles['js_scripts'] as $js_script) {
                ?>
                <script type="text/javascript" src="<?php echo $this->config->item('script') . $js_script; ?>"></script>
            <?php
            }
        }

        $jsfiles = array();
        $jsfiles = $this->session->userdata('scripts');
        if (is_array($jsfiles['js_ie']) && count($jsfiles['js_ie']) > 0) {

            $ies = $jsfiles['js_ie']['ie-7'];
            if (is_array($ies) && count($ies) > 0) {
                ?>
                <!--[if IE 7]>
                <?php foreach ($ies as $ie) {
                    ?>
                            <script type="text/javascript" src="<?php echo $this->config->item('js_path') . $ie; ?>"></script>
                <?php } ?>
                <![endif]-->
            <?php
            }

            $ies = $jsfiles['js_ie']['ie-8'];
            if (is_array($ies) && count($ies) > 0) {
                ?>
                <!--[if IE 8]>
                <?php foreach ($ies as $ie) {
                    ?>
                            <script type="text/javascript" src="<?php echo $this->config->item('js_path') . $ie; ?>"></script>
                <?php } ?>
                <![endif]-->
            <?php
            }
            if (isset($jsfiles['js_ie']['ie-9'])) {
                $ies = $jsfiles['js_ie']['ie-9'];

                if (is_array($ies) && count($ies) > 0) {
                    ?>
                    <!--[if IE 9]>

                    <?php foreach ($ies as $ie) {
                        ?>
                                <script type="text/javascript" src="<?php echo $this->config->item('js_path') . $ie; ?>"></script>
                    <?php } ?>
                    <![endif]-->
                <?php
                }
            }
        }
        ?>
        
        
        
       
    </body>
</html>
