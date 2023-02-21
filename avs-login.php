<?php

/**
 * @link              https://github.com/AlexVanSteenhoven
 * @since             0.1.0
 * @package           avs-login
 *
 * @wordpress-plugin
 * Plugin Name:       Custom Admin Login
 * Plugin Uri:        https://fullstak.nl
 * Description:       A Simple plugin that changes the theme on the admin login screen
 * Version:           0.1.0
 * Author:            Alex van Steenhoven
 * Author URI:        https://github.com/AlexVanSteenhoven
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       avs-login
 * Domain Path:       /languages
 */


// This displays the current version
define('AVS_LOGIN_VERSION', '0.1.0');

function activateAvsLogin()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-avs-login-activator.php';
    CustomLoginActivator::activate();
}

function deactivateAvsLogin()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-avs-login-deactivator.php';
    CustomLoginDeactivator::deactivate();
}

register_activation_hook(__FILE__, 'activateAvsLogin');
register_deactivation_hook(__FILE__, 'deactivateAvsLogin');

require_once plugin_dir_path(__FILE__) . 'includes/class-avs-login.php';

function run()
{
    $plugin = new AvsLogin();
    $plugin->run();
}

run();
