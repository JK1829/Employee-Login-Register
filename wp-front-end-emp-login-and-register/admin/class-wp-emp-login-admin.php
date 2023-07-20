<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @package    Wp_Emp_Login
 * @subpackage Wp_Emp_Login/admin
 */
class Wp_Emp_Login_Admin 
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/wp-emp-login-admin.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {
        // Currently not being used and loaded
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/wp-emp-login-admin.js', array('jquery'), $this->version, false);
    }
    /*
     * Adds the plugin settings menu item to dashboard
     * @since    1.0.0
     */

    public function wpemp_plugin_settings()
    {

        $settings_page = add_menu_page('WP Register Login Settings', 'WP Register Login', 'administrator', 'wpemp-settings', array($this, 'wpemp_settings_page'));

        add_action("load-{$settings_page}", array($this, 'wpemp_load_settings_page'));
    }
    /*
     * loads the settings page
     * @author Neelkanth
     * @since    2.0.0
     */

    public function wpemp_load_settings_page()
    {
        if (isset($_POST["wpemp-settings-submit"]) && $_POST["wpemp-settings-submit"] == 'Y') {
            check_admin_referer("wpemp-settings-page");
            $this->wpemp_save_theme_settings();
            $url_parameters = isset($_GET['tab']) ? 'updated=true&tab=' . $_GET['tab'] : 'updated=true';
            wp_redirect(admin_url('admin.php?page=wpemp-settings&' . $url_parameters));
            exit;
        }
    }
    /*
     * Saves the settings in tabs
     * @author Neelkanth
     * @since    2.0.0
     */

    public function wpemp_save_theme_settings()
    {
        global $pagenow;

        if ($pagenow == 'admin.php' && $_GET['page'] == 'wpemp-settings') {
            if (isset($_GET['tab'])) {
                $tab = $_GET['tab'];
            } else {
                $tab = 'redirect';
            }
            switch ($tab) {
                case $tab :
                    $wpemp_settings = get_option('wpemp_' . $tab . '_settings');
                    foreach ($wpemp_settings as $setting => $value) {
                        $wpemp_settings[$setting] = $_POST[$setting];
                    }
                    update_option('wpemp_' . $tab . '_settings', $wpemp_settings);
                    break;
            }
        }
    }
    /*
     * Creates tabs
     * @author Neelkanth
     * @since    2.0.0
     */

    public function wpemp_admin_tabs($current = 'redirect')
    {
        $tabs = array('redirect' => 'Redirect', 'display' => 'Messages', 'form' => 'Form', 'email' => 'Emails','shortcodes'=>'Shortcodes');
        $links = array();
        echo '<div id="icon-themes" class="icon32"><br></div>';
        echo '<h2 class="nav-tab-wrapper">';
        foreach ($tabs as $tab => $name) {
            $class = ( $tab == $current ) ? ' nav-tab-active' : '';
            echo "<a class='nav-tab$class' href='?page=wpemp-settings&tab=$tab'>$name</a>";
        }
        echo '</h2>';
    }
    /*
     * Renders settings page
     * @author Neelkanth
     * @since    2.0.0
     */

    public function wpemp_settings_page()
    {
        global $pagenow;

        ?>

        <div class="wrap">
            <h2><?php echo 'WP Register Login' ?> - Settings</h2>

            <?php if (isset($_GET['updated']) && 'true' == esc_attr($_GET['updated'])) { ?>
                <div class="updated"><p>Settings updated.</p></div>
                <?php
            }
            if (isset($_GET['tab'])) {
                $this->wpemp_admin_tabs($_GET['tab']);
            } else {
                $this->wpemp_admin_tabs('redirect');
            }

            ?>

            <div id="poststuff">
                <form method="post" action="<?php admin_url('admin.php?page=wpemp-settings'); ?>">
                    <?php
                    wp_nonce_field("wpemp-settings-page");

                    if ($pagenow == 'admin.php' && $_GET['page'] == 'wpemp-settings') {

                        if (isset($_GET['tab']))
                            $tab = $_GET['tab'];
                        else
                            $tab = 'redirect';

                        ?>                       
                            <?php
                            switch ($tab) {

                                case $tab :
                                    $wpemp_settings = get_option('wpemp_' . $tab . '_settings');
                                    include 'partials/settings/wpemp-' . $tab . '-settings.php';
                                    break;
                            }

                            ?>                        
                        <?php
                    }

                    ?>
                    <p class="submit" style="clear: both;">
                        <input type="submit" name="Submit"  class="button-primary" value="Update Settings" />
                        <input type="hidden" name="wpemp-settings-submit" value="Y" />
                    </p>
                </form>

            </div>

        </div>
        <?php
    }
    /*
     * Update notice
     * @since    1.0.0
     */

    public function wpemp_update_notice()
    {
        if (get_option('wpemp_settings')) {
            $update_notice = '<div class="error notice">
        <p>
            Thank you for updating to WP Register Login 1.0.0.
            <br/><br/>
            After update, It is recommended that you should <strong>Deactivate the WP Register Login plugin and then Activate it again.</strong>
            After this wpemp settings will be replaced with defaults.
        </p>    
        </div>';
            echo $update_notice;
        }
    }
}
