<?php
/**
 * Orders
 *
 * Shows orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/orders.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see    https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.2.0
 */

if (!defined('ABSPATH')) {
    exit;
}

do_action('woocommerce_before_account_orders', $has_orders); ?>

<?php if ($has_orders) : ?>
    <div class="row">
        <div class="col-12 privat_info_title">
            <p>Мои покупки</p>
            <div class="row container_info">
                <?php foreach ($customer_orders->orders as $customer_order) :
                    $order = wc_get_order($customer_order);
                    $items = $order->get_items();
                    $preview_item =  array_values($items)[0];
                    $preview_item_data = $preview_item->get_data();
                    $preview_image_url = get_the_post_thumbnail_url($preview_item_data['product_id']);
                    ?>
                    <div class="product">
                        <div class='product_date_conteiner'>
                            <div class="date">
                                <p class="date_text"><?php echo esc_html(wc_format_datetime($order->get_date_created())); ?></p>
                            </div>
                        </div>
                        <div class='product_image_conteiner'>
                            <div class='product_image' style="background-image: url('<?php echo $preview_image_url; ?>');: "></div>
                            <p class="product_name"><?php echo $preview_item_data['name']; ?></p>
                            <p class="product_price"><?php echo $order->get_formatted_order_total(); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>


    <?php do_action('woocommerce_before_account_orders_pagination'); ?>

    <?php if (1 < $customer_orders->max_num_pages) : ?>
        <div class="woocommerce-pagination woocommerce-pagination--without-numbers woocommerce-Pagination">
            <?php if (1 !== $current_page) : ?>
                <a class="woocommerce-button woocommerce-button--previous woocommerce-Button woocommerce-Button--previous button"
                   href="<?php echo esc_url(wc_get_endpoint_url('orders', $current_page - 1)); ?>"><?php _e('Previous', 'woocommerce'); ?></a>
            <?php endif; ?>

            <?php if (intval($customer_orders->max_num_pages) !== $current_page) : ?>
                <a class="woocommerce-button woocommerce-button--next woocommerce-Button woocommerce-Button--next button"
                   href="<?php echo esc_url(wc_get_endpoint_url('orders', $current_page + 1)); ?>"><?php _e('Next', 'woocommerce'); ?></a>
            <?php endif; ?>
        </div>
    <?php endif; ?>

<?php else : ?>
    <div class="woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info">
        <a class="woocommerce-Button button"
           href="<?php echo esc_url(apply_filters('woocommerce_return_to_shop_redirect', wc_get_page_permalink('shop'))); ?>">
            <?php _e('Go shop', 'woocommerce') ?>
        </a>
        <?php _e('No order has been made yet.', 'woocommerce'); ?>
    </div>
<?php endif; ?>

<?php do_action('woocommerce_after_account_orders', $has_orders); ?>
