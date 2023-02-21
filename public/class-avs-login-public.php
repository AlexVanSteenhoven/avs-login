<?php

/**
 * The public-facing functionality of the plugin.
 * 
 * @link https://github.com/AlexVanSteenhoven
 * @since 0.1.0
 * @package Avs_Login
 * @subpackage Avs_Login/includes
 * @author Alex van Steenhoven <alex.vs@fullstak.nl>
 */
class AvsLoginPublic
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
     * Register the stylesheet for the public
     *
     * @since 0.1.0
     * @access public
     * @return void
     */
    public function enqueue_styles()
    {
        wp_enqueue_style($this->pluginName, plugin_dir_url(__FILE__) . 'css/avs-login-public.css', array(), $this->version, 'all');
    }

    /**
     * Register the javascript for the public
     *
     * @since 0.1.0
     * @access public
     * @return void
     */
    public function enqueue_scripts()
    {
        wp_enqueue_script($this->pluginName, plugin_dir_url(__FILE__) . 'js/avs-login-public.js', array('jquery'), $this->version, false);
    }
}
