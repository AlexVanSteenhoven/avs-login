<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 * 
 * @link https://github.com/AlexVanSteenhoven
 * @since 0.1.0
 * @package Avs_Login
 * @subpackage Avs_Login/includes
 * @author Alex van Steenhoven <alex.vs@fullstak.nl>
 */
class AvsLoginI18n {
    
    /**
     * @since 0.1.0
     * @access private
     */
    public function load_plugin_textdomain() {
        load_plugin_textdomain(
            'avs-login',
            false,
            dirname(dirname(plugin_basename(__FILE__))) . '/languages/'
        );
    }
}