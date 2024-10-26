<?php
/**
 * Plugin Name: Price Changer For WooCommerce
 * Description: A simple plugin to change all WooCommerce product prices to have a .99 suffix.
 * Author: Duckname
 * Author URL: https://github.com/duckyname
 * Version: 1.0.0
 * Text Domain: wooc-price-changer-99
 * License: GPLv2 or later
 */

if (!defined('ABSPATH')) {
    exit;
}

class WooCommercePriceChanger {
    
    public function __construct() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
    }

    public function add_admin_menu() {
        add_menu_page(
            'Price Change',
            'Price Change',
            'manage_options',
            'price-change',
            array($this, 'handle_price_change'),
            'dashicons-edit',
            2
        );
    }

public function handle_price_change() {
    if (isset($_POST['change_price'])) {
        if (!isset($_POST['_price_change_nonce']) || !wp_verify_nonce($_POST['_price_change_nonce'], 'price_change')) {
            echo '<div class="notice notice-error"><p>Nonce verification failed. Please try again.</p></div>';
            return;
        }

        $args = array(
            'post_type' => 'product',
            'posts_per_page' => -1,
        );
        $products = get_posts($args);

        foreach ($products as $product_post) {
            $product = wc_get_product($product_post->ID);

            $regular_price = $product->get_regular_price();
            if ($regular_price) {
                $price_parts = explode('.', $regular_price);
                if (count($price_parts) >= 1) {
                    $new_regular_price = $price_parts[0] . '.99';
                    $product->set_regular_price($new_regular_price);
                }
            }

            $sale_price = $product->get_sale_price();
            if ($sale_price) {
                $sale_price_parts = explode('.', $sale_price);
                if (count($sale_price_parts) >= 1) {
                    $new_sale_price = $sale_price_parts[0] . '.99';
                    $product->set_sale_price($new_sale_price);
                }
            }

            $product->save();
        }

        echo '<div class="notice notice-success"><p>All prices have been updated successfully!</p></div>';
    }

    ?>
    <div class="wrap">
        <h1>Change All WooCommerce Product Prices to XX.99</h1>
        <form method="post">
            <?php wp_nonce_field('price_change', '_price_change_nonce'); ?>
            <input type="submit" name="change_price" class="button button-primary" value="Change Prices">
        </form>
    </div>
    <?php
}




}

new WooCommercePriceChanger();