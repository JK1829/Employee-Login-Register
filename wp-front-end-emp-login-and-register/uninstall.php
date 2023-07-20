<?php
/**
 * Fired when the plugin is uninstalled.
 *
 *
 *
 * @package    Wp_Emp_Register_Login
 */
// If uninstall not called from WordPress, then exit.
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}


//Delete options from db
$options = array(
    'wpmp_redirect_settings',
    'wpmp_display_settings',
    'wpmp_form_settings',
    'wpmp_email_settings');

foreach ($options as $key => $option) {
    delete_option($option);
}