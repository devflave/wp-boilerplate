<?php

/**
 * 
 * @link       https://www.gruppedrei.com/
 * @package    Elemext
 * 
 * Plugin Name: Elemext
 * Plugin URI: https://www.gruppedrei.com/
 * Description: Elementor CMS extender
 * Version: 1.0
 * Author: Gruppedrei GmbH - Developer: Flavio Castell - f.castell@gruppedrei.com
 * Author URI: https://www.gruppedrei.com/
 **/
class Elemext_Activator
{
    public static function activate()
    {
        flush_rewrite_rules();
    }
}
