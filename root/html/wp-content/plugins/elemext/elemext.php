<?php

/**
 * 
 * @link       https://www.gruppedrei.com/
 * @package    Elemext
 * 
 * Plugin Name: Elemext
 * Depends: Elementor, BI APIs
 * Plugin URI: https://www.gruppedrei.com/
 * Description: Elementor CMS extender
 * Version: 1.0
 * Author: Gruppedrei GmbH - Developer: Flavio Castell - f.castell@gruppedrei.com
 * Author URI: https://www.gruppedrei.com/
 * Text Domain: elemext
 **/

if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PLUGIN_VERSION' , '1.0.0' );

/**
 * Activate plugin.
 */
function activate_elemext_plugin()
{
    require_once plugin_dir_path( __FILE__ ) . 'includes/elemext-activator.php';
	Elemext_Activator::activate();
}

/**
 * Deactivation hook.
 */
function deactivate_elemext_plugin()
{
    require_once plugin_dir_path( __FILE__ ) . 'includes/elemext-deactivator.php';
	Elemext_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_elemext_plugin');
register_deactivation_hook(__FILE__, 'deactivate_elemext_plugin');
require plugin_dir_path( __FILE__ ) . 'includes/main.php';


function run_elemext()
{
    $plugin = new Elemext();
    $plugin->run();
}
run_elemext();
