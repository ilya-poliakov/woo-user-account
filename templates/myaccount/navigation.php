<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
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

do_action('woocommerce_before_account_navigation');
?>
<div class="row">
    <div class="col user_name">
        <div><img id='user' src="<?php // echo WOO_USER_ACCOUNT_PLUGIN_URI . '/assets/' ?>img/log-in2.svg"></div>
        <p><?php echo WUA()->customer->displayName; ?></p>
    </div>
    <div class="col-12 menu_item_box">
        <?php foreach (wc_get_account_menu_items() as $endpoint => $label) : ?>
            <p class="<?php echo wc_get_account_menu_item_classes($endpoint); ?> menu_item">
                <a href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>"><?php echo esc_html($label); ?></a>
            </p>
        <?php endforeach; ?>
    </div>
</div>
<?php do_action('woocommerce_after_account_navigation'); ?>



