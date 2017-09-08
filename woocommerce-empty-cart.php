<?php
/**
 * Plugin Name: WooCommerce Empty Cart
 * Plugin URI: www.itsl.net
 * Description: Empty cart button for woocommerce
 * Version: 1.0
 * Author: Infoway LLC
 * Author URI: http://www.infoway.us
 * 
 *
 *
 */
add_action('plugins_loaded', 'empty_cart_callback');

function empty_cart_callback() {

    define('WC_EMPTY_CART_FILE_PATH', dirname(__FILE__));
    define('WC_EMPTY_CART_FOLDER', dirname(plugin_basename(__FILE__)));
    define('WC_EMPTY_CART_URL', untrailingslashit(plugins_url('/', __FILE__)));
    define('WC_EMPTY_CART_NAME', plugin_basename(__FILE__));
    define('WC_EMPTY_CART_IMAGES_URL', WC_QUICK_VIEW_URL . '/assets/images');
    define('WC_EMPTY_CART_JS_URL', WC_QUICK_VIEW_URL . '/assets/js');
    define('WC_EMPTY_CART_CSS_URL', WC_QUICK_VIEW_URL . '/assets/css');

    include ('admin/empty-cart-button.php');


    if (get_option('woocommerce_empty_cart') == 'yes') {
        /*         * *** Empty cart button  starts*** */
        add_action('woocommerce_after_cart_contents', 'woocommerce_empty_cart_button');

        function woocommerce_empty_cart_button($cart) {
            global $woocommerce;
            $cart_url = $woocommerce->cart->get_cart_url();
            ?>

            <tr>
                <td colspan="6" class="actions">
                    <?php if (empty($_GET)) { ?>
                        <a class="button emptycart" href="<?php echo $cart_url; ?>?clear-cart=empty-cart"><?php _e('Empty Cart', 'wc-emptycart'); ?></a>
                    <?php } else { ?>
                        <a class="button emptycart" href="<?php echo $cart_url; ?>&clear-cart=empty-cart"><?php _e('Empty Cart', 'wc-emptycart'); ?></a>
                    <?php } ?>


                </td></tr>


            <?php
        }

        add_action('init', 'woocommerce_clear_cart_url');

        function woocommerce_clear_cart_url() {
            // Add text domain for plugin. 

            global $woocommerce;
            if (isset($_REQUEST['clear-cart'])) {
                $woocommerce->cart->empty_cart();
            }
        }

        /*         * *** Empty cart button ends*** */
    }
}
?>