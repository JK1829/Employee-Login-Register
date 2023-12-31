<table class="form-table">
    <tr valign="top">
    <th>
        <label><?php _e("Want admin to receive new user notification email?", $this->plugin_name); ?></label>
    </th>
    <td>
        <input style="margin:0px; padding:0px; width:auto;" type="checkbox" name="wpemp_admin_email_notification" value='1' class='wide' <?php echo (!empty($wpemp_settings['wpemp_admin_email_notification']) && $wpemp_settings['wpemp_admin_email_notification'] == '1' ) ? 'checked="checked"' : ''; ?> />
        <em><?php _e("Use this feature, if you want to make sure admin receives email on new user registration.", $this->plugin_name); ?></em>
    </td>
</tr>


<tr valign="top">
    <th scope="row">
        <label><?php _e("Enable New User Email Confirmation", $this->plugin_name); ?></label>
    </th>
    <td>
        <input  type="checkbox" name="wpemp_user_email_confirmation" value= '1' class='wide' <?php echo (!empty($wpemp_settings['wpemp_user_email_confirmation']) && $wpemp_settings['wpemp_user_email_confirmation'] == '0' ) ? 'checked="checked"' : ''; ?> />
        <em><?php _e("Use this feature, if you want to make sure new user must confirm his/her email address at the time of registration.", $this->plugin_name); ?></em>
    </td>
</tr>

<tr valign="top">
    <th colspan="2">
        <h2>New user welcome email</h2>
    </th>
</tr>

<tr valign="top">
    <th>
        <label><?php _e("Subject", $this->plugin_name); ?></label>
    </th>
    <td>
       
        <input type="text" name="wpemp_notification_subject" value='<?php echo (!empty($wpemp_settings['wpemp_notification_subject'])) ? $wpemp_settings['wpemp_notification_subject'] : ''; ?>' class='wide' />
        
        <em><?php _e("<code>%BLOGNAME%</code> will be replaced with the name of your blog.", $this->plugin_name); ?></em>
        
    </td>
</tr>
<tr valign="top">
    <th>
        <label><?php _e("Message", $this->plugin_name); ?></label>
    </th>
    <td>
        
        <textarea name="wpemp_notification_message" class='wide' style="width:100%; height:250px;"><?php echo $wpemp_settings['wpemp_notification_message'] ?></textarea>
        <em><?php _e("<code>%FIRSTNAME%</code> will be replaced with a user's first name.", $this->plugin_name); ?></em><br />
        <em><?php _e("<code>%LASTNAME%</code> will be replaced with a user's lastname.", $this->plugin_name); ?></em><br />
        <em><?php _e("<code>%USERNAME%</code> will be replaced with a username.", $this->plugin_name); ?></em><br />
        <em><?php _e("<code>%USEREMAIL%</code> will be replaced with a user's email.", $this->plugin_name); ?></em><br />
        <em><?php _e("<code>%BLOGNAME%</code> will be replaced with the name of your blog.", $this->plugin_name); ?></em><br />
        <em><?php _e("<code>%BLOGURL%</code> will be replaced with the url of your blog.", $this->plugin_name); ?></em>
    </td>
</tr>

<tr valign="top">
    <th colspan="2">
        <h2>New Account verification Email</h2>
    </th>
</tr>
<tr valign="top">
    <th>
        <label><?php _e("Subject", $this->plugin_name); ?></label>
    </th>
    <td>
        
        <input type="text" name="wpemp_new_account_verification_email_subject" value='<?php echo (!empty($wpemp_settings['wpemp_new_account_verification_email_subject'])) ? $wpemp_settings['wpemp_new_account_verification_email_subject'] : ''; ?>' class='wide' />
        
        <em><?php _e("<code>%BLOGNAME%</code> will be replaced with the name of your blog.", $this->plugin_name); ?></em>
       
    </td>
</tr>
<tr valign="top">
    <th>
        <label><?php _e("Message", $this->plugin_name); ?></label>
    </th>
    <td>
        
        <textarea name="wpemp_new_account_verification_email_message" class='wide' style="width:100%; height:250px;"><?php echo (!empty($wpemp_settings['wpemp_new_account_verification_email_message'])) ? $wpemp_settings['wpemp_new_account_verification_email_message'] : ''; ?></textarea>
        <em><?php _e("<code>%ACTIVATIONLINK%</code> will be replaced with the new account activation link.", $this->plugin_name); ?></em><br />
        <em><?php _e("<code>%BLOGNAME%</code> will be replaced with the name of your blog.", $this->plugin_name); ?></em><br/>
        <em><?php _e("<code>%BLOGURL%</code> will be replaced with the url of your blog.", $this->plugin_name); ?></em>
    </td>
</tr>

<tr valign="top">
    <th colspan="2">
        <h2>Password Reset Email</h2>
    </th>
</tr>
<tr valign="top">
    <th>
        <label><?php _e("Subject", $this->plugin_name); ?></label>
        <em><?php _e("<code>%BLOGNAME%</code> will be replaced with the name of your blog.", $this->plugin_name); ?></em>
    </th>
    <td>
        
        <input type="text" name="wpemp_password_reset_email_subject" value='<?php echo (!empty($wpemp_settings['wpemp_password_reset_email_subject'])) ? $wpemp_settings['wpemp_password_reset_email_subject'] : ''; ?>' class='wide' />
       
    </td>
</tr>
<tr valign="top">
    <th>
        <label><?php _e("Message", $this->plugin_name); ?></label>
    </th>
    <td>
        
        <textarea name="wpemp_password_reset_email_message" class="wide" style="width:100%; height:250px;"><?php echo (!empty($wpemp_settings['wpemp_password_reset_email_message'])) ? $wpemp_settings['wpemp_password_reset_email_message'] : ''; ?></textarea>
        <em><?php _e("<code>%USERNAME%</code> will be replaced with the username.", $this->plugin_name); ?></em><br />
        <em><?php _e("<code>%RECOVERYLINK%</code> will be replaced with the password recovery link.", $this->plugin_name); ?></em><br/>
        <em><?php _e("<code>%BLOGNAME%</code> will be replaced with the name of your blog.", $this->plugin_name); ?></em>
    </td>
</tr>
</table>

