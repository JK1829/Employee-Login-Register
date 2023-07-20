<?php
/**
 * Provide a public-facing view for the reset password form
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @package    Wp_Emp_Login
 * @subpackage Wp_Emp_Login/public/partials
 */

?>
<?php 
if(isset($_GET['wpemp_reset_password_token'])){
$is_url_has_token = $_GET['wpemp_reset_password_token']; }else{
$is_url_has_token ='';
 } ?>
<div id="wpempResetPasswordSection" class="container-fluid <?php echo empty($is_url_has_token) ? ' hidden' : 'ds' ?>">
    <div class="row">
        <div class="col-xs-8 col-md-10"> 
            <?php
            $wpemp_form_settings = get_option('wpemp_form_settings');

            $resetpassword_form_heading = empty($wpemp_form_settings['wpemp_resetpassword_heading']) ? 'Reset Password' : $wpemp_form_settings['wpemp_resetpassword_heading'];
            $resetpassword_button_text = empty($wpemp_form_settings['wpemp_resetpassword_button_text']) ? 'Reset password' : $wpemp_form_settings['wpemp_resetpassword_button_text'];
            $returntologin_button_text = empty($wpemp_form_settings['wpemp_returntologin_button_text']) ? 'Return to Login' : $wpemp_form_settings['wpemp_returntologin_button_text'];           

            ?>
            <h3><?php _e($resetpassword_form_heading, $this->plugin_name); ?></h3>

            <div id="wpemp-resetpassword-loader-info" class="wpemp-loader" style="display:none;">
                <img src="<?php echo plugins_url('images/ajax-loader.gif', dirname(__FILE__)); ?>"/>
                <span><?php _e('Please wait ...', $this->plugin_name); ?></span>
            </div>
            <div id="wpemp-resetpassword-alert" class="alert alert-danger" role="alert" style="display:none;"></div>

            <form name="wpempResetPasswordForm" id="wpempResetPasswordForm" method="post">
                <?php
                // check if the url has token
                if (!$is_url_has_token) :

                    ?>
                    <div class="form-group">
                        <label for="email"><?php _e('Email', $this->plugin_name); ?></label>
                        <input type="text" class="form-control" name="wpemp_rp_email" id="wpemp_rp_email" placeholder="Email">
                    </div>
                    <input type="hidden" name="wpemp_current_url" id="wpemp_current_url" value="<?php echo get_permalink(); ?>" />
                    <?php
                else:

                    ?>
                    <div class="form-group">
                        <label for="newpassword"><?php _e('New password', $this->plugin_name); ?></label>
                        <input type="password" class="form-control" name="wpemp_newpassword" id="wpemp_newpassword" placeholder="New Password">
                    </div>
                    <input type="hidden" name="wpemp_rp_email" id="wpemp_rp_email" value="<?php echo $_GET['email'] ?>" />
                    <input type="hidden" name="wpemp_reset_password_token" id="wpemp_reset_password_token" value="<?php echo $_GET['wpemp_reset_password_token']; ?>" />

                <?php
                endif;

                ?>
                <?php
                // this prevent automated script for unwanted spam
                if (function_exists('wp_nonce_field'))
                    wp_nonce_field('wpemp_resetpassword_action', 'wpemp_resetpassword_nonce');

                ?>
                <button type="submit" class="btn btn-primary"><?php _e($resetpassword_button_text, $this->plugin_name); ?></button>
                <button type="button" id="btnReturnToLogin" class="btn btn-primary"><?php _e($returntologin_button_text, $this->plugin_name); ?></button>

            </form>

        </div>
    </div>
</div>
