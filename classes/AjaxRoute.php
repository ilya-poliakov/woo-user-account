<?php


namespace plugins\WooUserAccount\classes;

use plugins\WooUserAccount\classes\base\Base;

class AjaxRoute extends Base
{

    //const GET_CITIES_ROUTE = 'nova_poshta_get_cities_by_area';

    /**
     * @var string
     */
    private $route;


    /**
     * @var array
     */
    private $handler;

    /**
     * @return void
     */
    public static function init()
    {
        foreach (self::getHandlers() as $key => $handler) {
            $ajaxRoute = new self($key, $handler);
            $ajaxRoute->handleRequest();
        }
        foreach (self::getAdminHandlers() as $key => $handler) {
            add_action('wp_ajax_' . $key, $handler);
        }
    }

    /**
     * @return array
     */
    public static function getHandlers()
    {
        //$factory = AreaRepositoryFactory::instance();
        return array(
            //self::GET_CITIES_ROUTE => array($factory->cityRepo(), 'ajaxGetAreasByNameSuggestion'),
        );
    }

    /**
     * @return array
     */
    public static function getAdminHandlers()
    {
        //$factory = AreaRepositoryFactory::instance();
        return array(
            //self::GET_CITIES_ROUTE => array($factory->cityRepo(), 'ajaxGetAreasByNameSuggestion'),
        );
    }

    /**
     * AjaxRoute constructor.
     * @param string $route
     * @param string $handler
     */
    public function __construct($route, $handler)
    {
        $this->route = $route;
        $this->handler = $handler;
    }


    /**
     * Handle ajax request
     */
    public function handleRequest()
    {
        add_action('wp_ajax_' . $this->route, $this->handler);
        add_action('wp_nopriv_ajax_' . $this->route, $this->handler);

        if (isset($_REQUEST['action']) && $_REQUEST['action'] == $this->route) {
            do_action('wp_ajax_' . $_REQUEST['action']);
            do_action('wp_ajax_nopriv_' . $_REQUEST['action']);
        }
    }

}