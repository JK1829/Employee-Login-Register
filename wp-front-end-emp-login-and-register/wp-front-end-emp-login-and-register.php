<?php
/**
 * Plugin Name:       WP Frontend Employee Login and Register
 * Plugin URI:        https://github.com/JK1829/Employee-Login-Register
 * Description:       Wordpress Plugin For Registration and login for Employee and also view data in dashboard after login.
 * Version:           1.0.0
 * Author:            Jaykishan
 * Author URI:        https://github.com/JK1829/Employee-Login-Register
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Function that runs during plugin activation.
 */
function activate_wp_emp_login() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-emp-activator.php';
	Wp_Emp_Login_Activator::activate();
}

/**
 * Function that runs during plugin deactivation.
 */
function deactivate_wp_emp_login() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-emp-deactivator.php';
	Wp_Emp_Login_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_emp_login' );
register_deactivation_hook( __FILE__, 'deactivate_wp_emp_login' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-emp-login.php';

/**
 * Begins execution of the plugin.
 *
 * @since    1.0.0
 */
function run_wp_emp_login() {

	$plugin = new Wp_Emp_Login();
	$plugin->run();

}
run_wp_emp_login();
