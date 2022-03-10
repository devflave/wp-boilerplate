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
class Elemext_Public
{

	/**
	 * @access   private
	 * @var      string    $name
	 */
	private $name;

	/**
	 * @access   private
	 * @var      string    $version
	 */
	private $version;

	/**
	 * @param      string    $name
	 * @param      string    $version
	 */
	public function __construct($name, $version)
	{

		$this->name = $name;
		$this->version = $version;
	}

	/**
	 * Include additional styles
	 */
	public function enqueue_styles()
	{
		wp_enqueue_style($this->name, plugin_dir_url(__FILE__) . 'css/elemext.min.css', array(), $this->version, 'all');
	}

	/**
	 * Include additional scripts
	 */
	public function enqueue_scripts()
	{
		wp_enqueue_script($this->name, plugin_dir_url(__FILE__) . 'js/elemext.min.js', array('jquery'), $this->version, false);
	}
}
