<html>
    <head> 
        <title>Fedena</title>
      <!--  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap/bootstrap-responsive.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap/bootstrap-responsive.min.css" /> -->
        
        <?php
        $css_path = $this->config->item('css_path');
        $js_path = $this->config->item('js_path');
        $css_3rd_path = $this->config->item('css_3rd');
        $js_script_path = $this->config->item('script');

        $scriptfiles = $this->session->userdata('scripts');

        if (!empty($scriptfiles['css'])) {
            foreach ($scriptfiles['css'] as $css) {
                ?>
                <link rel="stylesheet" href="<?php echo $css_path . $css ?>">
                <?php
            }
        }
        if (!empty($scriptfiles['css_3rd'])) {
            foreach ($scriptfiles['css_3rd'] as $css_3rd) {
                ?>
                <link rel="stylesheet" href="<?php echo $css_3rd_path . $css_3rd ?>">
                <?php
            }
        }
        ?>
    </head>

    <body>

        <div id="wrapper">
            <div class="alert-content">
                <?php if (isset($message)) { ?>
                    <div class="alert alert-error">
                        <h4>Error!</h4>
                        <?php echo $message; ?>
                    </div>
                <?php } ?>
            </div>
            <div class="login_back">
                
                <div id="login_area_bg" class="well well-large login_wrapper">
                    
                    <form action="<?php echo base_url(); ?>login/me" method="post" id="login-form">
                        <fieldset>

                            <div class="control-group login_area">

                                <div class="controls">
                                    <input id="user_username" name="username" class="text_field" type="text" value="" placeholder="Username"/>
                                </div>
                            </div>
<!--                            <div class="clear-fix"></div>-->
                            <div class="control-group login_area">

                                <div class="controls">
                                    <input class="text_field" type="password" name="password" value="" placeholder="Password"/>
                                    <span class="help-inline"></span>
                                </div>
                            </div>
<!--                            <div class="clear-fix"></div>-->
                            <div class="control-group login_area">

                                <div class="controls">
                                    <button class="btn btn-large btn-primary pull-right" type="submit">Login</button>
                                </div>
                            </div>

                        </fieldset>
                    </form>
                    <!--                <form action="/" method="post">
                                        
                                        <div id="login_area">
                                            <label for="username">Username</label>
                                                                    <div id="username_textbox_bg"> 
                                            <input id="user_username" maxlength="40" name="user[username]" size="40" type="text" placeholder="Username" class="text_field"/>
                                                                    </div>
                    
                    
                                            <label for="password">Password</label>
                                                                    <div id="password_textbox_bg"> 
                                            <input id="user_password" name="user[password]" size="30" type="password" placeholder="Password" class="text_field"/>
                                            <a href="../../libraries/index.html"></a>
                                                                    </div>
                    
                                            <button type="submit" name="commit" class="btn btn-primary pull-right btn-large">Login</button>
                    
                                           
                    
                                            <label for="forgot_password" class="forgot_password_link">
                                                <a href="/user/forgot_password">Forgot Password?</a>
                                            </label>
                    
                    
                                        </div>
                                    </form>-->
                </div>
            </div>

            <div id="help_forgot_pw">

            </div>
            <div class="clearfooter"></div>
        </div>
        <!--  <div id="login_area_bg" class="login_area">
        
            
          <div id="help_forgot_pw">
        
          </div>
          <div class="clearfooter"></div>
        </div>-->
         <script type="text/javascript">
            document.getElementById('user_username').focus();
        </script>
         <?php include(APPPATH.'views/common/page-footer.php') ?> 
       
       