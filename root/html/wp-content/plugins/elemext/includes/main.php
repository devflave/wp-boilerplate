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
class Elemext
{

    /**
     * @access   protected
     * @var      $loader
     */
    protected $loader;

    /**
     * @access   protected
     * @var      string
     */
    protected $elemext;

    /**
     * @access   protected
     * @var      string
     */
    protected $version;

    /**
     * Construct
     */
    public function __construct()
    {
        if (defined('PLUGIN_VERSION')) {
            $this->version = PLUGIN_VERSION;
        } else {
            $this->version = '1.0.0';
        }
        $this->plugin_name = 'Elemext';

        $this->load_dependencies();
        $this->set_locale();
        $this->define_public_hooks();
        $this->define_custom_widgets();
    }

    /**
     * @access   private
     */
    private function load_dependencies()
    {
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/elemext-loader.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/elemext-i18n.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/elemext-widgets.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'public/elemext-public.php';

        $this->loader = new Elemext_Loader();
    }

    /**
     * Define locale for internationalization
     * @access   private
     */
    private function set_locale()
    {

        $plugin_i18n = new Elemext_i18n();

        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
    }

    /**
     * Register public hooks
     * @access   private
     */
    private function define_public_hooks()
    {

        $elemextPublic = new Elemext_Public($this->get_plugin_name(), $this->get_version());

        $this->loader->add_action('wp_enqueue_scripts', $elemextPublic, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $elemextPublic, 'enqueue_scripts');
    }

    /**
     * Register custom widgets
     * @access   private
     */
    private function define_custom_widgets()
    {
        $plugin_widgets = new Elemext_Widgets();

        $this->loader->add_action('plugins_loaded', $plugin_widgets, 'load_plugin_widgets');
    }

    /**
     * Run loader
     */
    public function run()
    {
        $this->loader->run();
    }

    /**
     * @return string
     */
    public function get_plugin_name() : string
    {
        return $this->plugin_name;
    }

    /**
     * @return Elemext_Loader
     */
    public function get_loader()
    {
        return $this->loader;
    }

    /**
     * @return string
     */
    public function get_version() : string
    {
        return $this->version;
    }
}
