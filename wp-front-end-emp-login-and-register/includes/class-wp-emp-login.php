<?php
/**

 * @since      1.0.0
 *
 * @package    Wp_Mp_Register_Login
 * @subpackage Wp_Mp_Register_Login/includes
 */

/**

 *
 * @since      1.0.0
 * @package    Wp_Emp_Login
 * @subpackage Wp_Emp_Login/includes
 */
class Wp_Emp_Login
{

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      Wp_Emp_Login_Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $plugin_name    The string used to uniquely identify this plugin.
     */
    protected $plugin_name;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $version    The current version of the plugin.
     */
    protected $version;

    /**
     * Define the core functionality of the plugin.

     *
     * @since    1.1.0
     */
    public function __construct()
    {

        $this->plugin_name = 'wp-emp-login';
        $this->version = '1.0.0';

        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }

    private function set_locale()
    {

       
    }
    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Wp_Emp_Login_Loader. Orchestrates the hooks of the plugin.
     * - Wp_Emp_Login_Admin. Defines all hooks for the admin area.
     * - Wp_Emp_Login_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies()
    {

        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-wp-emp-loader.php';

        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-wp-emp-login-admin.php';

        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-wp-emp-login-public.php';

        $this->loader = new Wp_Emp_Login_Loader();
    }

  

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_admin_hooks()
    {

        $plugin_admin = new Wp_Emp_Login_Admin($this->get_plugin_name(), $this->get_version());
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');

        // Can be used later on
        //$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
        //Neelkanth
        $this->loader->add_action('admin_menu', $plugin_admin, 'wpemp_plugin_settings');
        $this->loader->add_action('admin_notices', $plugin_admin, 'wpemp_update_notice');
    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_public_hooks()
    {

        $plugin_public = new Wp_Emp_Login_Public($this->get_plugin_name(), $this->get_version());

        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');
        $this->loader->add_action('wp_ajax_nopriv_wpemp_user_login', $plugin_public, 'wpemp_user_login');
        $this->loader->add_action('wp_ajax_nopriv_wpemp_user_registration', $plugin_public, 'wpemp_user_registration');
        $this->loader->add_action('wp_ajax_nopriv_wpemp_resetpassword', $plugin_public, 'wpemp_resetpassword');

        $this->loader->add_shortcode('wpemp_login_form', $plugin_public, 'wpemp_display_login_form');
        $this->loader->add_shortcode('wpemp_register_form', $plugin_public, 'wpemp_display_register_form');

        $this->loader->add_shortcode('wpemp_resetpassword_form', $plugin_public, 'wpemp_display_resetpassword_form');
        //profile
        $this->loader->add_shortcode('wpemp_user_profile', $plugin_public, 'wpemp_user_profile_page');
        //wpemp_updateProfile
        $this->loader->add_action( 'wp_ajax_nopriv_updateProfile', $plugin_public,'updateProfile' );
        $this->loader->add_action( 'wp_ajax_updateProfile', $plugin_public,'updateProfile' );
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run()
    {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     1.0.0
     * @return    string    The name of the plugin.
     */
    public function get_plugin_name()
    {
        return $this->plugin_name;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since     1.0.0
     * @return    Wp_Emp_Login_Loader    Orchestrates the hooks of the plugin.
     */
    public function get_loader()
    {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     * @return    string    The version number of the plugin.
     */
    public function get_version()
    {
        return $this->version;
    }
}
