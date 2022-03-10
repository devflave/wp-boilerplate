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
class Elemext_Loader
{

    /**
     * @access   protected
     * @var      array    $actions
     */
    protected $actions;

    /**
     * @access   protected
     * @var      array    $filters
     */
    protected $filters;

    /**
     * Construct
     */
    public function __construct()
    {

        $this->actions = array();
        $this->filters = array();
    }

    /**
     * @param    string  $hook
     * @param    object  $component
     * @param    string  $callback
     * @param    int     $priority 
     * @param    int     $args 
     */
    public function add_action($hook, $component, $callback, $priority = 10, $args = 1)
    {
        $this->actions = $this->add($this->actions, $hook, $component, $callback, $priority, $args);
    }

    /**
     * @param    string  $hook
     * @param    object  $component
     * @param    string  $callback
     * @param    int     $priority 
     * @param    int     $args 
     */
    public function add_filter($hook, $component, $callback, $priority = 10, $args = 1)
    {
        $this->filters = $this->add($this->filters, $hook, $component, $callback, $priority, $args);
    }

    /**
     * @access   private
     * @param    string  $hook
     * @param    object  $component
     * @param    string  $callback
     * @param    int     $priority 
     * @param    int     $args 
     * @return   array
     */
    private function add($hooks, $hook, $component, $callback, $priority, $args): array
    {

        $hooks[] = array(
            'hook'          => $hook,
            'component'     => $component,
            'callback'      => $callback,
            'priority'      => $priority,
            'args'          => $args
        );

        return $hooks;
    }

    public function run()
    {

        foreach ($this->filters as $hook) {
            add_filter($hook['hook'], array($hook['component'], $hook['callback']), $hook['priority'], $hook['args']);
        }

        foreach ($this->actions as $hook) {
            add_action($hook['hook'], array($hook['component'], $hook['callback']), $hook['priority'], $hook['args']);
        }
    }
}
