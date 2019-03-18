<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_edit_account_form'); ?>

<div class="row">
    <div class="col-12 privat_info_title">
        <form class="woocommerce-EditAccountForm edit-account" action="" method="post">
            <?php do_action('woocommerce_edit_account_form_start'); ?>

            <p class="edit_account_title">Управление аккаунтом</p>
            <div class="container_info">
                <div class="but_conteiner">
                    <div class="account_links_box">
                        <a id="userdata-edit" class="account_click_link"><?php _e('Редактировать личные данные', WOO_USER_ACCOUNT_DOMAIN); ?></a>
                    </div>
                    <div style="display: none" id="userdata-editor" class="account_box_showed_first">
                        <label for="account_first_name"><?php esc_html_e('Имя', WOO_USER_ACCOUNT_DOMAIN); ?>&nbsp;<span
                                    class="required">*</span></label><br>
                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text"
                               name="account_first_name" id="account_first_name" autocomplete="given-name"
                               value="<?php echo esc_attr(WUA()->customer->firstName); ?>"/><br>
                        <label for="account_last_name"><?php esc_html_e('Фамилимя', WOO_USER_ACCOUNT_DOMAIN); ?>
                            &nbsp;<span class="required">*</span></label><br>
                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text"
                               name="account_last_name" id="account_last_name" autocomplete="family-name"
                               value="<?php echo esc_attr(WUA()->customer->lastName); ?>"/><br>
                        <label for="account_display_name"><?php esc_html_e('Никнейм', WOO_USER_ACCOUNT_DOMAIN); ?>&nbsp;<span
                                    class="required">*</span></label><br>
                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text"
                               name="account_display_name" id="account_display_name"
                               value="<?php echo esc_attr(WUA()->customer->displayName); ?>"/><br><span><em><?php esc_html_e('This will be how your name will be displayed in the account section and in reviews', 'woocommerce'); ?></em></span><br>
                        <label for="account_email"><?php esc_html_e('Email адрес', WOO_USER_ACCOUNT_DOMAIN); ?>
                            &nbsp;<span class="required">*</span></label><br>
                        <input type="email" class="woocommerce-Input woocommerce-Input--email input-text"
                               name="account_email" id="account_email" autocomplete="email"
                               value="<?php echo esc_attr(WUA()->customer->email); ?>"/><br>
                        <input type="text" name="billing_phone" value="<?php echo WUA()->customer->phone; ?>"
                               class="passwor" placeholder="<?php esc_html_e('Телефон', WOO_USER_ACCOUNT_DOMAIN); ?>">
                        <br>
                        <input type="text" name="birthday" value="<?php echo WUA()->customer->birthDate; ?>"
                               class="passwor"
                               placeholder="<?php esc_html_e('Дата Рождения', WOO_USER_ACCOUNT_DOMAIN); ?>"> <br>
                        <select name="billing_country" class="passwor form-control"
                                placeholder="<?php esc_html_e('Страна', WOO_USER_ACCOUNT_DOMAIN); ?>">
                            <?php WC()->countries->country_dropdown_options(WUA()->customer->countryCode, '*'); ?>
                        </select><br>
                        <input type="text" name="billing_state" value="<?php echo WUA()->customer->state; ?>"
                               placeholder="<?php esc_html_e('Область', WOO_USER_ACCOUNT_DOMAIN); ?>"> <br>
                        <input type="text" name="billing_city" value="<?php echo WUA()->customer->city; ?>"
                               placeholder="<?php esc_html_e('Город', WOO_USER_ACCOUNT_DOMAIN); ?>"> <br>
                        <input type="text" name="billing_address_1" value="<?php echo WUA()->customer->address1; ?>"
                               placeholder="<?php esc_html_e('Строка адреса 1', WOO_USER_ACCOUNT_DOMAIN); ?>"> <br>
                        <input type="text" name="billing_address_2" value="<?php echo WUA()->customer->address2; ?>"
                               placeholder="<?php esc_html_e('Строка адреса 2', WOO_USER_ACCOUNT_DOMAIN); ?>"> <br>
                    </div>
                    <div class="account_links_box">
                        <a id="password-edit"><?php esc_html_e('Изменить пароль', WOO_USER_ACCOUNT_DOMAIN); ?></a><br>
                    </div>
                    <div style="display: none" id="password-editor" class="account_box_showed_second">
                        <fieldset>
                            <legend><?php esc_html_e('Password change', 'woocommerce'); ?></legend>

                            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                <label for="password_current"><?php esc_html_e('Current password (leave blank to leave unchanged)', 'woocommerce'); ?></label>
                                <input type="password" class="woocommerce-Input woocommerce-Input--password input-text"
                                       name="password_current" id="password_current" autocomplete="off"/>
                            </p>
                            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                <label for="password_1"><?php esc_html_e('New password (leave blank to leave unchanged)', 'woocommerce'); ?></label>
                                <input type="password" class="woocommerce-Input woocommerce-Input--password input-text"
                                       name="password_1" id="password_1" autocomplete="off"/>
                            </p>
                            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                <label for="password_2"><?php esc_html_e('Confirm new password', 'woocommerce'); ?></label>
                                <input type="password" class="woocommerce-Input woocommerce-Input--password input-text"
                                       name="password_2" id="password_2" autocomplete="off"/>
                            </p>
                        </fieldset>
                    </div>
                    <div class="account_links_box">
                        <a href="<?php echo esc_url(wc_logout_url(wc_get_page_permalink('myaccount'))); ?>"
                           class="exit"><?php esc_html_e('Выход', WOO_USER_ACCOUNT_DOMAIN); ?></a>
                    </div>
                    <div class='acsess_conteiner'>
                        <div>
                            <input id="data_using"
                                   type="checkbox" <?php if (WUA()->customer->getMetadata('allow_data_using') == 'on') {
                                echo 'checked';
                            } ?> name="allow_data_using">
                            <label for="data_using"
                                   class="acsess_descript"><?php esc_html_e('Использовать мои данные для заполнения формы заказа,для доставки курьером', WOO_USER_ACCOUNT_DOMAIN); ?> </label>
                        </div>
                    </div>
                </div>
            </div>

            <?php do_action('woocommerce_edit_account_form'); ?>

            <div class="button_form_container">
                <?php wp_nonce_field('save_account_details', 'save-account-details-nonce'); ?>
                <button style="display: none" type="submit" class="woocommerce-Button button userdata-submit"
                        name="save_account_details"
                        value="<?php esc_attr_e('Save changes', 'woocommerce'); ?>"><?php esc_html_e('Save changes', 'woocommerce'); ?></button>
                <input type="hidden" name="action" value="save_account_details"/>
            </div>

            <?php do_action('woocommerce_edit_account_form_end'); ?>
        </form>
        <?php do_action('woocommerce_after_edit_account_form'); ?>
    </div>
</div>
