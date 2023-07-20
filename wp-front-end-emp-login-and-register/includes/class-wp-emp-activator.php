<?php
/**
 * Fired during plugin activation
 *
 *
 * @package    Wp_Emp_Login
 * @subpackage Wp_Emp_Login/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wp_Emp_Login
 * @subpackage Wp_Emp_Login/includes
 */
class Wp_Emp_Login_Activator
{

    /**
     *
     * @since    1.0.0
     */
    public static function activate()
    {
        //delete old settings "wpemp_settings"
        if (get_option('wpemp_settings')) {
            delete_option('wpemp_settings');
        }
        $wpemp_redirect_settings = get_option("wpemp_redirect_settings");
        $wpemp_display_settings = get_option("wpemp_display_settings");
        $wpemp_form_settings = get_option("wpemp_form_settings");
        $wpemp_email_settings = get_option("wpemp_email_settings");


        //initialize redirect settings
        if (empty($wpemp_redirect_settings)) {

            $wpemp_redirect_settings = array(
                'wpemp_login_redirect' => '-1',
                'wpemp_logout_redirect' => '-1',
            );
            add_option('wpemp_redirect_settings', $wpemp_redirect_settings);
        }

        //initialize display settings
        if (empty($wpemp_display_settings)) {

            $wpemp_display_settings = array(
                'wpemp_email_error_message' => 'Could not able to send the email notification.',
                'wpemp_account_activated_message' => 'Your account has been activated. You can login now.',
                'wpemp_account_notactivated_message' => 'Your account has not been activated yet, please verify your email first.',
                'wpemp_login_error_message' => 'Username or password is incorrect.',
                'wpemp_login_success_message' => 'You are successfully logged in.',
                'wpemp_password_reset_invalid_email_message' => 'We cannot identify any user with this email.',
                'wpemp_password_reset_link_sent_message' => 'A link to reset your password has been sent to you.',
                'wpemp_password_reset_link_notsent_message' => 'Password reset link not sent.',
                'wpemp_password_reset_success_message' => 'Your password has been changed successfully.',
                'wpemp_invalid_password_reset_token_message' => 'This token appears to be invalid.'
            );
            add_option('wpemp_display_settings', $wpemp_display_settings);
        }

        //initialize form settings
        if (empty($wpemp_form_settings)) {

            $wpemp_form_settings = array(
                'wpemp_signup_heading' => 'Register',
                'wpemp_signin_heading' => 'Login',
                'wpemp_resetpassword_heading' => 'Reset Password',
                'wpemp_signin_button_text' => 'Login',
                'wpemp_signup_button_text' => 'Register',
                'wpemp_returntologin_button_text' => 'Return to Login',
                'wpemp_forgot_password_button_text' => 'Forgot Password',
                'wpemp_resetpassword_button_text' => 'Reset Password',
                'wpemp_enable_captcha' => '1',
                'wpemp_enable_forgot_password' => '1'
            );
            add_option('wpemp_form_settings', $wpemp_form_settings);
        }

        //initialize email settings
        if (empty($wpemp_email_settings)) {

            $wpemp_email_settings = array(
                'wpemp_notification_subject' => 'Welcome to %BLOGNAME%',
                'wpemp_notification_message' => 'Thank you for registering on %BLOGNAME%.
<br><br>
<strong>First Name :</strong> %FIRSTNAME%<br>
<strong>Last Name : </strong>%LASTNAME%<br>
<strong>Username :</strong> %USERNAME%<br>
<strong>Email :</strong> %USEREMAIL%<br>
<strong>Password :</strong> As choosen at the time of registration.
<br><br>
Please visit %BLOGURL% to login.
<br><br>
Thanks and regards,
<br>
The team at %BLOGNAME%',
                'wpemp_admin_email_notification' => '1',
                'wpemp_user_email_confirmation' => '1',
                'wpemp_new_account_verification_email_subject' => '%BLOGNAME% | Please confirm your email',
                'wpemp_new_account_verification_email_message' => 'Thank you for registering on %BLOGNAME%.
<br><br>
Please confirm your email by clicking on below link :
<br><br>
%ACTIVATIONLINK%
<br><br>
Thanks and regards,
<br>
The team at %BLOGNAME%',
                'wpemp_password_reset_email_subject' => '%BLOGNAME% | Password Reset',
                'wpemp_password_reset_email_message' => 'Hello %USERNAME%,
<br><br>
We have received a request to change your password.
Click on the link to change your password : 
<br><br>
%RECOVERYLINK%
<br><br>
Thanks and regards,
<br>
The team at %BLOGNAME%',
            );
            add_option('wpemp_email_settings', $wpemp_email_settings);
        }
    }
}
