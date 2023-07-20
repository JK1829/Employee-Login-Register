<?php
/**
 * Provide a public-facing view for the plugin
 *
 * @package    Wp_Emp_Login
 * @subpackage Wp_Emp_Login/public/partials
 */

?>

<div id="wpempLoginSection" class="container-fluid">
    <div class="row">
        <div class="col-xs-8 col-md-10"> 
            <?php
            $wpemp_redirect_settings = get_option('wpemp_redirect_settings');
            $wpemp_form_settings = get_option('wpemp_form_settings');

            // check if the user already login
            if (!is_user_logged_in()) :
                
                $form_heading = empty($wpemp_form_settings['wpemp_signin_heading']) ? 'Login' : $wpemp_form_settings['wpemp_signin_heading'];
                $submit_button_text = empty($wpemp_form_settings['wpemp_signin_button_text']) ? 'Login' : $wpemp_form_settings['wpemp_signin_button_text'];
                $forgotpassword_button_text = empty($wpemp_form_settings['wpemp_forgot_password_button_text']) ? 'Forgot Password' : $wpemp_form_settings['wpemp_forgot_password_button_text'];
                if(isset($_GET['wpemp_reset_password_token']) && $_GET['wpemp_reset_password_token'] !=''){
                    $is_url_has_token = $_GET['wpemp_reset_password_token'];
                }else{ $is_url_has_token; }
                
                ?>
                <form name="wpempLoginForm" id="wpempLoginForm" method="post" class="<?php echo empty($is_url_has_token) ? '' : 'hidden' ?>">
                    
                    <h3><?php _e($form_heading, $this->plugin_name); ?></h3>
                    <div id="wpemp-login-loader-info" class="wpemp-loader" style="display:none;">
                        <img src="<?php echo plugins_url('images/ajax-loader.gif', dirname(__FILE__)); ?>"/>
                        <span><?php _e('Please wait ...', $this->plugin_name); ?></span>
                    </div>
                    <div id="wpemp-login-alert" class="alert alert-danger" role="alert" style="display:none;"></div>

                    <div class="form-group">
                        <label for="username"><?php _e('Username/Email', $this->plugin_name); ?></label>
                        <input type="text" class="form-control" name="wpemp_username" id="wpemp_username" placeholder="Username/Email">
                    </div>
                    <div class="form-group">
                        <label for="password"><?php _e('Password', $this->plugin_name); ?></label>
                        <input type="password" class="form-control" name="wpemp_password" id="wpemp_password" placeholder="Password" >
                    </div>
                    <?php
                    $login_redirect = (empty($wpemp_redirect_settings['wpemp_login_redirect']) || $wpemp_redirect_settings['wpemp_login_redirect'] == '-1') ? '' : $wpemp_redirect_settings['wpemp_login_redirect'];
                    
                    ?>
                    <input type="hidden" name="redirection_url" id="redirection_url" value="<?php echo get_permalink($login_redirect); ?>" />

                    <?php
                    // this prevent automated script for unwanted spam
                    if (function_exists('wp_nonce_field'))
                        wp_nonce_field('wpemp_login_action', 'wpemp_login_nonce');

                    ?>
                    <button type="submit" class="btn btn-primary"><?php _e($submit_button_text, $this->plugin_name); ?></button>
                    <?php
                        //render forgot password button
                        if($wpemp_form_settings['wpemp_enable_forgot_password']){                            
                    ?>
                    <button id="btnForgotPassword" type="button" class="btn btn-primary"><?php _e($forgotpassword_button_text, $this->plugin_name); ?></button>
                    <?php
                        }
                    ?>
                </form>
                <?php
                    //render the reset password form
                    if($wpemp_form_settings['wpemp_enable_forgot_password']){
                        echo do_shortcode('[wpemp_resetpassword_form]');
                    }
                ?>
            
                <?php
            else:
                $current_user = wp_get_current_user();
                $logout_redirect = (empty($wpemp_redirect_settings['wpemp_logout_redirect']) || $wpemp_redirect_settings['wpemp_logout_redirect'] == '-1') ? '' : $wpemp_redirect_settings['wpemp_logout_redirect'];                
                echo 'Logged in as <strong>' . ucfirst($current_user->user_login) . '</strong>. <a href="' . wp_logout_url(get_permalink($logout_redirect)) . '">Log out ? </a>';

            endif;

            ?>
        </div>
    </div>
</div>
