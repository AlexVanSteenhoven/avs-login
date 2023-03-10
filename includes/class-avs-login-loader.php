<?php

/**
 * Registers all actions and filters for this plugin
 * 
 * @link https://github.com/AlexVanSteenhoven
 * @since 0.1.0
 * @package Avs_Login
 * @subpackage Avs_Login/includes
 * @author Alex van Steenhoven <alex.vs@fullstak.nl>
 */

class AvsLoginLoader
{
    /**
     * @since 0.1.0
     * @access protected
     * @var array
     */
    protected $actions;

    /**
     * @since 0.1.0
     * @access protected
     * @var array
     */
    protected $filters;


    /**
     * @since 0.1.0
     * @access public
     */
    public function __construct()
    {
        $this->actions = array();
        $this->filters = array();
    }

    /**
     * @since 0.1.0
     * @access public
     * @param string $hook
     * @param object $component
     * @param string $callback
     * @param int $priority
     * @param int $accepted_args  
     */
    public function add_action($hook, $component, $callback, $priority = 10, $accepted_args = 1)
    {
        $this->actions = $this->add($this->actions, $hook, $component, $callback, $priority, $accepted_args);
    }

    /**
     * @since 0.1.0
     * @access public
     * @param string $hook
     * @param object $component
     * @param string $callback
     * @param int $priority
     * @param int $accepted_args  
     */
    public function add_filter($hook, $component, $callback, $priority = 10, $accepted_args = 1)
    {
        $this->filters = $this->add($this->filters, $hook, $component, $callback, $priority, $accepted_args);
    }

    /**
     * @since 0.1.0
     * @access private
     * @param string $hook
     * @param object $component
     * @param string $callback
     * @param int $priority
     * @param int $accepted_args
     * @return array 
     */
    private function add($hooks, $hook, $component, $callback, $priority, $accepted_args)
    {

        $hooks[] = array(
            'hook'          => $hook,
            'component'     => $component,
            'callback'      => $callback,
            'priority'      => $priority,
            'accepted_args' => $accepted_args
        );

        return $hooks;
    }

    /**
     * @since 0.1.0
     * @access public
     */
    public function run()
    {

        foreach ($this->filters as $hook) {
            add_filter($hook['hook'], array($hook['component'], $hook['callback']), $hook['priority'], $hook['accepted_args']);
        }

        foreach ($this->actions as $hook) {
            add_action($hook['hook'], array($hook['component'], $hook['callback']), $hook['priority'], $hook['accepted_args']);
        }
    }
}
