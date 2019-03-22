<?php
/*
Plugin Name: WooCommerce User Account extended
Plugin URI: http://webcodemarket.com
Description:
Version: 1.0
Author: Ilya Polyakov
Author URI: 
Copyright 2018-2019 ilya polyakov. All rights reserved.
Text Domain: woo-user-account
Domain Path: /i18n/
*/

use plugins\WooUserAccount\classes\AjaxRoute;
use plugins\WooUserAccount\classes\base\Base;
use plugins\WooUserAccount\classes\base\Options;
use plugins\WooUserAccount\classes\Log;
use plugins\WooUserAccount\classes\Customer;
use plugins\WooUserAccount\classes\Account;

define('WOO_USER_ACCOUNT_PLUGIN_URL', trailingslashit(dirname(__FILE__)));
define('WOO_USER_ACCOUNT_DOMAIN', untrailingslashit(basename(dirname(__FILE__))));
define('WOO_USER_ACCOUNT_PLUGIN_URI', trailingslashit(plugins_url() .'/'.WOO_USER_ACCOUNT_DOMAIN. '/'));



require_once __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . '/autoload.php';

/**
 * Class WOO_USER_ACCOUNT
 *
 * @property wpdb db
 * @property Options options
 * @property Log log
 * @property Customer customer
 * @property Account account
 * @property string pluginVersion
 */


class WOO_USER_ACCOUNT extends Base {

    const LOCALE_RU = 'ru_RU';

    public function init()
    {
        register_activation_hook(__FILE__, array($this, 'activatePlugin'));
        register_deactivation_hook(__FILE__, array($this, 'deactivatePlugin'));
        if ($this->isWoocommerce()) {
            //general plugin actions
            add_action('init', array(AjaxRoute::getClass(), 'init'));
            add_action('plugins_loaded', array($this, 'loadPluginDomain'));
            add_action('wp_enqueue_scripts', array($this, 'scripts'));
            add_action('wp_enqueue_scripts', array($this, 'styles'));
            add_action('admin_enqueue_scripts', array($this, 'adminScripts'));
            add_action('admin_enqueue_scripts', array($this, 'adminStyles'));
            add_filter('woocommerce_locate_template', array($this, 'rewriteTemplates'));
            $this->account->init();
        }
    }

    public function isWoocommerce()
    {
        return in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')));
    }

    /**
     * @param string $template
     * @param string $template_name
     * @param string $template_path
     * @return string
     */
    public function rewriteTemplates($template, $template_name = null, $template_path = null)
    {
        global $woocommerce;
        $_template = $template;
        if( !$template_name )
            $template_name = substr($template, strpos($template, "templates/"));

        if ( ! $template_path )
            $template_path = $woocommerce->template_url;

        $plugin_path  = untrailingslashit( plugin_dir_path( __FILE__ ) )  . '/';

        // Look within passed path within the theme - this is priority
        $template = locate_template(
            array(
                $template_path . $template_name,
                $template_name
            )
        );


        if( ! $template_path && file_exists( $plugin_path . $template_name ) )
            $template = $plugin_path . $template_name;
        if ( ! $template )
            $template = $_template;

        return $template;
    }

    /**
     * Enqueue all required scripts
     */

    public function scripts()
    {
        if(is_account_page()) {
            $fileName = 'assets/js/user-account.js';
            wp_enqueue_script(
                'user-account-js',
                WOO_USER_ACCOUNT_PLUGIN_URI . $fileName,
                ['jquery']
            );

            $this->localizeHelper('user-account-js');

            wp_enqueue_script('user-account-js');
        }
    }

    /**
     * Enqueue all required scripts for admin panel
     */

    public function adminScripts()
    {

    }

    /**
     * Enqueue all required styles
     */

    public function styles()
    {
        if(is_account_page()) {
            $fileName = 'assets/css/style.css';
            wp_register_style('user-account-style',
                WOO_USER_ACCOUNT_PLUGIN_URI . $fileName

            );

            wp_enqueue_style('user-account-style');
        }
    }

    /**
     * Enqueue all required styles for admin panel
     */

    public function adminStyles()
    {
        global $wp_scripts;
        $jquery_version = isset($wp_scripts->registered['jquery-ui-core']->ver) ? $wp_scripts->registered['jquery-ui-core']->ver : '1.9.2';
        $fileName = 'assets/css/style.css';
        wp_register_style('user-account-style',
            WOO_USER_ACCOUNT_PLUGIN_URI . $fileName,
            [],
            $jquery_version
        );
        wp_enqueue_style('user-account-style');
    }

    /**
     * @param string $handle
     */
    public function localizeHelper($handle)
    {
        wp_localize_script($handle, 'NovaPoshtaHelper', [
            'ajaxUrl' => admin_url('admin-ajax.php', 'relative'),
        ]);
    }

    /**
     * Activation hook handler
     */
    public function activatePlugin()
    {
    }

    /**
     * Deactivation hook handler
     */
    public function deactivatePlugin()
    {
    }

    /**
     * @return wpdb
     */
    protected function getDb()
    {
        global $wpdb;
        return $wpdb;
    }

    /**
     * @return Log
     */
    protected function getLog()
    {
        return Log::instance();
    }

    /**
     * @return Customer
     */
    protected function getCustomer()
    {
        return Customer::instance();
    }
    /**
     * @return Account
     */
    protected function getAccount()
    {
        return Account::instance();
    }

    /**
     * @return Options
     */
    protected function getOptions()
    {
        return Options::instance();
    }

    /**
     * Register translations directory
     * Register text domain
     */
    public function loadPluginDomain()
    {
        $path = sprintf('./%s/i18n', WOO_USER_ACCOUNT_DOMAIN);
        load_plugin_textdomain(WOO_USER_ACCOUNT_DOMAIN, false, $path);
    }

    /**
     * @return bool
     */
    public function isDebug()
    {
        return false;
    }

    /**
     * @return Customer
     */
    public function isAutorized()
    {
        return $this->customer;
    }



    /**
     * @return string
     */
    protected function getPluginVersion()
    {
        require_once ABSPATH . 'wp-admin/includes/plugin.php';
        $pluginData = get_plugin_data(__FILE__);
        return $pluginData['Version'];
    }

    /**
     * @var WOO_USER_ACCOUNT
     */
    private static $_instance;

    /**
     * @return WOO_USER_ACCOUNT
     */
    public static function instance()
    {
        if (static::$_instance == null) {
            static::$_instance = new static();
        }
        return static::$_instance;
    }

    /**
     * WOO_USER_ACCOUNT constructor.
     *
     * @access private
     */
    private function __construct()
    {
    }

    /**
     * @access private
     */
    private function __clone()
    {
    }
}

WOO_USER_ACCOUNT::instance()->init();


/**
 * @return WOO_USER_ACCOUNT
 */
if(!function_exists('WUA')){
    function WUA()
    {
        return WOO_USER_ACCOUNT::instance();
    }
}
