<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.6.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
    <div class="row">
        <div class="col-12 privat_info_title purchases">
            <p><?php esc_html_e('Личные Данные', WOO_USER_ACCOUNT_DOMAIN); ?></p>
        </div>
        <div class="col-md-12 dashboard_box">
            <div class="row">
                <div class="type_info col-md-4">
                    <p><?php esc_html_e('Имя', WOO_USER_ACCOUNT_DOMAIN); ?>:</p>
                    <p><?php esc_html_e('E-mail', WOO_USER_ACCOUNT_DOMAIN); ?>:</p>
                    <p><?php esc_html_e('Телефон', WOO_USER_ACCOUNT_DOMAIN); ?>:</p>
                    <p><?php esc_html_e('Адрес доставки', WOO_USER_ACCOUNT_DOMAIN); ?>:</p>
                    <p><?php esc_html_e('Дата рождения', WOO_USER_ACCOUNT_DOMAIN); ?>:</p>
                </div>
                <div class="container_values col-md-8">
                    <p><?php echo WUA()->customer->name; ?></p>
                    <p><?php echo WUA()->customer->email; ?></p>
                    <p><?php echo WUA()->customer->phone; ?></p>
                    <p><?php echo WUA()->customer->addressLine; ?></p>
                    <p><?php echo WUA()->customer->birthDate; ?></p>
                </div>
            </div>
        </div>
    </div>
    <!--    <div class="row">-->
    <!--        <div class="col-12 privat_info_title purchases">-->
    <!--            <p>--><?php //esc_html_e( 'Личные Данные', WOO_USER_ACCOUNT_DOMAIN ); ?><!--</p>-->
    <!--            <div class="row container_info">-->
    <!--                <div class="type_info" >-->
    <!--                    <p>--><?php //esc_html_e( 'Имя', WOO_USER_ACCOUNT_DOMAIN ); ?><!--:</p>-->
    <!--                    <p>--><?php //esc_html_e( 'E-mail', WOO_USER_ACCOUNT_DOMAIN ); ?><!--:</p>-->
    <!--                    <p>--><?php //esc_html_e( 'Телефон', WOO_USER_ACCOUNT_DOMAIN ); ?><!--:</p>-->
    <!--                    <p>--><?php //esc_html_e( 'Адрес доставки', WOO_USER_ACCOUNT_DOMAIN ); ?><!--:</p>-->
    <!--                    <p>--><?php //esc_html_e( 'Дата рождения', WOO_USER_ACCOUNT_DOMAIN ); ?><!--:</p>-->
    <!--                </div>-->
    <!--                <div class="container_values" >-->
    <!--                    <p>--><?php //echo WUA()->customer->name; ?><!--</p>-->
    <!--                    <p>--><?php //echo WUA()->customer->email; ?><!--</p>-->
    <!--                    <p>--><?php //echo WUA()->customer->phone; ?><!--</p>-->
    <!--                    <p>--><?php //echo WUA()->customer->addressLine; ?><!--</p>-->
    <!--                    <p>--><?php //echo WUA()->customer->birthDate; ?><!--</p>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
<?php
/**
 * My Account dashboard.
 *
 * @since 2.6.0
 */
do_action('woocommerce_account_dashboard');

/**
 * Deprecated woocommerce_before_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action('woocommerce_before_my_account');

/**
 * Deprecated woocommerce_after_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action('woocommerce_after_my_account');

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
