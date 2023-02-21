<?php

/**
 * The admin-specific functionality of the plugin.
 * 
 * @link https://github.com/AlexVanSteenhoven
 * @since 0.1.0
 * @package Avs_Login
 * @subpackage Avs_Login/includes
 * @author Alex van Steenhoven <alex.vs@fullstak.nl>
 */


class AvsLoginAdmin
{
    /**
     * The Id of this plugin
     *
     * @since 0.1.0
     * @access private
     * @var string
     */
    private $pluginName;

    /**
     * The version of this plugin
     *
     * @since 0.1.0
     * @access private
     * @var string
     */
    private $version;

    private $notices = [];
    private $themes = ['default', 'elegant', 'dark'];

    /**
     * Initialize the class
     * 
     * @since 0.1.0
     * @access public
     * @param string $pluginName
     * @param string $version
     */
    public function __construct($pluginName, $version)
    {
        $this->pluginName = $pluginName;
        $this->version = $version;
    }

    /**
     * Register the stylesheet for the admin area
     *
     * @since 0.1.0
     * @access public
     * @return void
     */
    public function enqueue_styles()
    {
        wp_enqueue_style($this->pluginName, plugin_dir_url(__FILE__) . 'css/avs-login-admin.css', array(), $this->version . time(), 'all');
    }

    /**
     * Register the javascript for the admin area
     *
     * @since 0.1.0
     * @access public
     * @return void
     */
    public function enqueue_scripts()
    {
        wp_enqueue_script($this->pluginName, plugin_dir_url(__FILE__) . 'js/avs-login-admin.js', array('jquery'), $this->version, false);
    }

    public function add_menu()
    {
        add_menu_page('AVS Login || Settings', 'AVS Login', 'manage_options', 'avs-login', [$this, 'settings_page']);
    }

    public function settings_page()
    {

        if (isset($_POST['avs_select_theme']))
            $this->saveSettings();

        include(dirname(__FILE__) . '/templates/settings/main_page.php');
    }

    private function saveSettings()
    {
        $loginUrl = $_POST['avs_login_url'];
        $loginTheme = $_POST['avs_select_theme'];

        if (!isset($loginUrl)) {
            $loginUrl = '/wp-login';
        }

        if (!isset($loginTheme)) {
            $loginTheme = 'default';
        }

        $this->addOrUpdateSettings('avs_login_url', $loginUrl);
        $this->addOrUpdateSettings('avs_login_theme', $loginTheme);

        $this->set_theme($loginTheme);
    }

    private function addOrUpdateSettings($setting, $value)
    {
        if (!get_option($setting, false))
            add_option($setting, $value);
        else
            update_option($setting, $value);
    }

    public function set_login_url($url, $redirect, $force_reauth)
    {
        $url = site_url(get_option('avs_login_url', false), 'login');

        if (!empty($redirect)) {
            $url = add_query_arg('redirect_to', urlencode($redirect), $url);
        }

        if ($force_reauth) {
            $url = add_query_arg('reauth', '1', $url);
        }

        return $url;
    }

    private function set_theme($theme)
    {
        if (!in_array($theme, $this->themes)) {
            $this->notices = [
                'type' => 'error',
                'message' => 'The theme: ' . $theme . ' is not found!'
            ];
        }
    }
}
