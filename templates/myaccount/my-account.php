<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<div class="container-fluid">
    <div class="row">
        <div class='col-12 col-lg-4 col-xl-3 main_menu_container'>
            <?php wc_print_notices();
            /**
             * My Account navigation.
             * @since 2.6.0
             */
            do_action('woocommerce_account_navigation'); ?>
        </div>
        <div class='col col-lg-6 col-xl-6 main_info_container'>
            <?php
            /**
             * My Account content.
             * @since 2.6.0
             */
            do_action('woocommerce_account_content');
            ?>
        </div>
        <div class="col-12 col-lg-2 col-xl-3 bonus_box">
<!--            <div class="row">-->
<!--                <div class="col-auto col-lg-5 col-xl-6 bonus_title">-->
<!--                    <p>БОНУСЫ:</p>-->
<!--                </div>-->
<!--                <div class="col-4 col-lg-7 col-xl-6 bonus_value">-->
<!--                    <p>--><?php //echo WUA()->customer->bonusesHtml;?><!--</p>-->
<!--                </div>-->
<!--            </div>-->
        </div>
    </div>
</div>
