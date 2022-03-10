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
class Elemext_Widgets
{
    public function load_plugin_widgets()
    {
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', [$this, 'missing_elementor']);
            return;
        }

        add_action('elementor/elements/categories_registered', [$this, 'add_elementor_widget_categories']);
        add_action('elementor/widgets/widgets_registered', [$this, 'init_widgets']);
    }


    public function add_elementor_widget_categories($elements_manager)
    {
        $category_prefix = 'aqb-';
        $elements_manager->add_category(
            $category_prefix . 'widgets',
            [
                'title' => __('Custom G3 Elements', 'elemext'),
                'icon' => 'fa fa-plug',
            ]
        );

        $reorder_cats = function () use ($category_prefix) {
            uksort($this->categories, function ($keyOne, $keyTwo) use ($category_prefix) {
                if (substr($keyOne, 0, 4) == $category_prefix) {
                    return -1;
                }
                if (substr($keyTwo, 0, 4) == $category_prefix) {
                    return 1;
                }
                return 0;
            });
        };
        $reorder_cats->call($elements_manager);
    }


    public function missing_elementor()
    {

        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }

        $message = 'Elemext needs Elementor Plugin to run';
        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }


    public function init_widgets()
    {
        $widget_directory =  __DIR__ . '/widgets/';
        $scanDir = scandir($widget_directory, SCANDIR_SORT_ASCENDING);
        foreach ($scanDir as $filename) {
            if ($filename === '.' || $filename === '..') {
                continue;
            }

            $className = $this->filename_to_classname($filename);
            $filePath = $widget_directory . $filename;
            $this->generate_widget_requirement($filePath, $className);
        }
    }


    private function filename_to_classname($filename = ''): string
    {
        $filename = str_replace('-', ' ', $filename);
        $filename = str_replace('.php', '', $filename);
        $filename = ucwords($filename);
        $filename = str_replace(' ', '_', $filename);
        return '\Elementor_' . $filename;
    }


    private function generate_widget_requirement($filePath = '', $className = ''): void
    {
        require_once($filePath);
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new $className());
    }
}
