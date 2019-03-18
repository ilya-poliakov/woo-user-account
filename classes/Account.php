<?php
/**
 * Created by PhpStorm.
 * User: SP
 * Date: 28.12.2018
 * Time: 11:28
 */

namespace plugins\WooUserAccount\classes;

use plugins\WooUserAccount\classes\base\Base;
use WC_Meta_Data;

/**
 * Class Customer
 *
 * @property \WC_Customer wooCustomer
 * @package plugins\NovaPoshta\classes
 */
class Account extends Base
{
    /**
     * @var Account
     */
    private static $_instance;

    /**
     * @return Account
     */
    public static function instance()
    {
        if (static::$_instance == null) {
            static::$_instance = new static();
        }
        return static::$_instance;
    }

    public function init()
    {
        add_filter('woocommerce_checkout_get_value', array($this, 'setFieldsValue'));
        /** Registration section */
        add_action( 'woocommerce_register_post', array($this, 'validateExtraRegisterFields'), 10, 3 );
        add_action( 'woocommerce_created_customer', array($this, 'saveExtraRegisterFields') );
        /** Repeat password feature */
        add_filter('woocommerce_registration_errors', array($this, 'registrationErrorsValidation'), 10,3);
        /** Repeat password feature ends*/
        /** Registration section ends */
        add_filter ( 'woocommerce_account_menu_items', array($this, 'myAccountEndpointsChange') );
        add_action( 'init', array($this, 'addWishlistEndpoint') );
        add_action( 'woocommerce_account_wishlist_endpoint', array($this, 'myAccountWishlistEndpointContent')  );
        add_action( 'woocommerce_save_account_details', array($this, 'myAccountEditExtraFields'));

    }

    /**
     * Pre-populate Woocommerce checkout fields
     * @param string $value
     * @return string $value
     */
    public function setFieldsValue($value)
    {
        if(WUA()->customer->getMetadata('allow_data_using') == 'on') {
            return $value;
        }else return null;
    }

    public function validateExtraRegisterFields($username, $email, $validation_errors)
    {
        if ( isset( $_POST['billing_first_name'] ) && empty( $_POST['billing_first_name'] ) ) {
            $validation_errors->add( 'billing_first_name_error', __( '<strong>Error</strong>: First name is required!', WOO_USER_ACCOUNT_DOMAIN ) );
        }
        if ( isset( $_POST['billing_last_name'] ) && empty( $_POST['billing_last_name'] ) ) {
            $validation_errors->add( 'billing_last_name_error', __( '<strong>Error</strong>: Last name is required!.', WOO_USER_ACCOUNT_DOMAIN ) );
        }
        if ( isset( $_POST['billing_phone'] ) && empty( $_POST['billing_phone'] ) ) {
            $validation_errors->add( 'billing_phone_error', __( '<strong>Error</strong>: Phone is required!.', WOO_USER_ACCOUNT_DOMAIN ) );
        }
        if ( isset( $_POST['birthday'] ) && empty( $_POST['birthday'] ) ) {
            $validation_errors->add( 'birthday', __( '<strong>Error</strong>: Birth date is required!.', WOO_USER_ACCOUNT_DOMAIN ) );
        }
        return $validation_errors;
    }

    public function saveExtraRegisterFields()
    {
        if ( isset( $_POST['billing_phone'] ) ) {
            WUA()->customer->setMetadata('billing_phone', sanitize_text_field( $_POST['billing_phone']));
        }
        if ( isset( $_POST['billing_first_name'] ) ) {
            WUA()->customer->setMetadata('first_name', sanitize_text_field( $_POST['billing_first_name']));
            WUA()->customer->setMetadata('billing_first_name', sanitize_text_field( $_POST['billing_first_name']));
        }
        if ( isset( $_POST['billing_last_name'] ) ) {
            WUA()->customer->setMetadata('last_name', sanitize_text_field( $_POST['billing_last_name']));
            WUA()->customer->setMetadata('billing_last_name', sanitize_text_field( $_POST['billing_last_name']));
        }
        if ( isset( $_POST['birthday'] ) ) {
            WUA()->customer->setMetadata('birthday', sanitize_text_field( $_POST['birthday']));
        }
        WUA()->customer->setMetadata('bonuses', sanitize_text_field(0));
    }

    public function registrationErrorsValidation($reg_errors, $sanitized_user_login, $user_email)
    {
        global $woocommerce;
        extract($_POST);
        if ( strcmp( $password, $password2 ) !== 0 ) {
            return new \WP_Error( 'registration-error', __( 'Passwords do not match.', WOO_USER_ACCOUNT_DOMAIN ) );
        }
        return $reg_errors;
    }

    public function myAccountEndpointsChange()
    {
        $endpoints = array(
            'dashboard'          => __( 'Личные данные', WOO_USER_ACCOUNT_DOMAIN ),
            'edit-account'       => __( 'Управление Аккаунтом', 'woocommerce' ),
            'orders'             => __( 'Мои покупки', 'woocommerce' ),
           // 'wishlist'           => __( 'Мое избранное', 'woocommerce' ),
        );
        return $endpoints;
    }

    public function addWishlistEndpoint()
    {
        add_rewrite_endpoint( 'wishlist', EP_PAGES );
    }
    public function myAccountWishlistEndpointContent()
    {
        echo 'This feature is coming!';
    }

    public function myAccountEditExtraFields()
    {
        if(isset($_POST['billing_phone'])){
            WUA()->customer->setMetadata('billing_phone', sanitize_text_field($_POST['billing_phone']));
        }
        if(isset($_POST['birthday'])){
            WUA()->customer->setMetadata('birthday', sanitize_text_field($_POST['birthday']));
        }
        if(isset($_POST['billing_country'])){
            WUA()->customer->setMetadata('billing_country', sanitize_text_field($_POST['billing_country']));
        }
        if(isset($_POST['billing_state'])){
            WUA()->customer->setMetadata('billing_state', sanitize_text_field($_POST['billing_state']));
        }
        if(isset($_POST['billing_city'])){
            WUA()->customer->setMetadata('billing_city', sanitize_text_field($_POST['billing_city']));
        }
        if(isset($_POST['billing_address_1'])){
            WUA()->customer->setMetadata('billing_address_1', sanitize_text_field($_POST['billing_address_1']));
        }
        if(isset($_POST['billing_address_2'])){
            WUA()->customer->setMetadata('billing_address_2', sanitize_text_field($_POST['billing_address_2']));
        }
        if(isset($_POST['allow_data_using'])){
            WUA()->customer->setMetadata('allow_data_using', sanitize_text_field($_POST['allow_data_using']));
        }
    }


}
