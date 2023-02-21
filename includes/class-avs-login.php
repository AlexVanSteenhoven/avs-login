<?php

/**
 * The file that defines the core plugin class
 * 
 * @link https://github.com/AlexVanSteenhoven
 * @since 0.1.0
 * @package Avs_Login
 * @subpackage Avs_Login/includes
 * @author Alex van Steenhoven <alex.vs@fullstak.nl>
 */
class AvsLogin
{
    /**
     * @since 0.1.0 
     * @access protected
     * @var AvsLoginLoader $loader
     */
    protected $loader;

    /**
     * @since 0.1.0 
     * @access protected
     * @var string $pluginName
     */
    protected $pluginName;

    /**
     * @since 0.1.0
     * @access protected
     * @var string $version
     */
    protected $version;

    /**
     * @since 0.1.0
     * @access public
     */
    public function __construct()
    {
        if (defined('AVS_LOGIN_VERSION')) {
            $this->version = AVS_LOGIN_VERSION;
        } else {
            $this->version = '1.0.0';
        }

        $this->pluginName = 'AvsLogin';
        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }

    /**
     * @since 0.1.0
     * @access private
     */
    private function load_dependencies()
    {
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-avs-login-loader.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-avs-login-i18n.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-avs-login-admin.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-avs-login-public.php';

        $this->loader = new AvsLoginLoader();
    }

    /**
     * @since 0.1.0
     * @access private
     */
    private function set_locale()
    {
        $plugin_i18n = new AvsLoginI18n();
        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
    }

    /**
     * @since 0.1.0
     * @access private
     */
    private function define_admin_hooks()
    {
        $plugin_admin = new AvsLoginAdmin($this->get_plugin_name(), $this->get_version());

        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
        $this->loader->add_action('admin_menu', $plugin_admin, 'add_menu');

        $this->loader->add_filter('login_url', $plugin_admin, 'set_login_url', 10, 3);
    }

    /**
     * @since 0.1.0
     * @access private
     */
    private function define_public_hooks()
    {

        $plugin_public = new AvsLoginPublic($this->get_plugin_name(), $this->get_version());

        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');
    }

    /**
     * @since 0.1.0
     * @access public
     */
    public function run()
    {
        $this->loader->run();
    }

    /**
     * @since 0.1.0
     * @access public
     * @return string
     */
    public function get_plugin_name()
    {
        return $this->pluginName;
    }

    /**
     * @since 0.1.0
     * @access public
     * @return AvsLoginLoader
     */
    public function get_loader()
    {
        return $this->loader;
    }

    /**
     * @since 0.1.0
     * @access public
     * @return string
     */
    public function get_version()
    {
        return $this->version;
    }
}
