<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>

<?php wc_print_notices(); ?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>
    <div id="login_form_container">
        <div class="col">
            <p class="avtoriz"><?php _e('Авторизация', WOO_USER_ACCOUNT_DOMAIN);?></p>
        </div>

        <div class="container-fluid full">
            <div class="row justify-content-center">
                <form method="post">
                    <?php do_action( 'woocommerce_login_form_start' ); ?>
                    <div class="col vhodmater" style="text-align: center;">
                        <?php do_action( 'woocommerce_login_form' ); ?>
                        <input type="text" name="username" class="login" placeholder="Имя или E-mail"></br>
                        <input type="password" name="password" class="passwor" placeholder="Пароль">
                        <div class="pommat">
                            <input type="checkbox" name="rememberme" class="pomnim"> Запомнить меня
                        </div>
                        <div class="foget">
                            <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Забыли пароль?', WOO_USER_ACCOUNT_DOMAIN ); ?></a>
                        </div>
                        <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
                        <input type="submit" class="bottom" name="login" value="Войти">
                        <div class="foget">
                            <span style="color: black">Нет аккаунта?</span><a class="switch_mode" id="to_register">Зарегистрироваться</a>
                        </div>
                    </div>
                    <?php do_action( 'woocommerce_login_form_end' ); ?>
                </form>
            </div>
        </div>
    </div>
    <div id="register_form_container" style="display: none">
        <?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

            <div class="col">
                <p class="avtoriz">Регистрация</p>
            </div>

            <div class="container-fluid full">
                <div class="row justify-content-center">
                    <form method="post">
                        <?php do_action( 'woocommerce_register_form_start' ); ?>
                        <div class="col vhodmater" style="text-align: center;">
                            <?php do_action( 'woocommerce_register_form' ); ?>
                            <input type="text" name="email" class="login"   placeholder="E-mail"> </br>
                            <input type="text" name="billing_phone" class="passwor" placeholder="Телефон"> </br>
                            <input type="text" name="birthday" class="passwor" placeholder="Дата Рождения"> </br>
                            <input type="password" name="password" class="passwor" placeholder="Пароль"> </br>
                            <input type="password" name="password2" class="passwor" placeholder="Подтвердите пароль"> </br>
                            <select name="billing_country" class="passwor" placeholder="Страна">
                                <?php WC()->countries->country_dropdown_options(); ?>
                            </select> </br>
                            <input type="text" name="billing_state" class="passwor" placeholder="Область"> </br>
                            <input type="text" name="billing_city" class="passwor" placeholder="Город"> </br>
                            <input type="text" name="billing_address_1" class="passwor" placeholder="Строка адреса 1"> </br>
                            <input type="text" name="billing_address_2" class="passwor" placeholder="Строка адреса 2"> </br>
                            <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
                            <input type="submit" name="register" class="bottom" value="Зарегистрироваться">
                            <div class="foget">
                                <span style="color: black">Есть аккаунт?</span><a class="switch_mode" id="to_login">Войти</a>
                            </div>
                        </div>
                        <?php do_action( 'woocommerce_register_form_end' ); ?>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </div>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>