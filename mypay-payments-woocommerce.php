<?php
/**
 * Plugin Name: MyPay For Woocommerce
 * Plugin URI: https://github.com/mypaynepal/mypay_woocommerce
 * Author: MyPay Team
 * Author URI: https://mypay.com.np
 * Description: MyPay Payments Gateway for Woocommerce.
 * Version: 1.3.0
 * License: GPL2
 * License URL: http://www.gnu.org/licenses/gpl-2.0.txt
 * text-domain: mypay-for-woocommerce
 * 
 * Class WC_Gateway_MyPay file.
 *
 * @package WooCommerce\MyPay
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) return;

add_action( 'plugins_loaded', 'mypayfw_payment_init', 11 );
add_filter( 'woocommerce_currencies', 'mypayfw_add_npr_currencies' );
add_filter( 'woocommerce_currency_symbol', 'mypayfw_add_npr_currencies_symbol', 10, 2 );
add_filter( 'woocommerce_payment_gateways', 'mypayfw_add_to_woo_payment_gateway');

function mypayfw_payment_init() {
    if( class_exists( 'WC_Payment_Gateway' ) ) {
		require_once plugin_dir_path( __FILE__ ) . '/includes/class-wc-payment-gateway-mypay.php';
		require_once plugin_dir_path( __FILE__ ) . '/includes/mypay-order-statuses.php';
		require_once plugin_dir_path( __FILE__ ) . '/includes/mypay-checkout-description-fields.php';
	}
}

function mypayfw_add_to_woo_payment_gateway( $gateways ) {
    $gateways[] = 'WC_Gateway_MyPay';
    return $gateways;
}

function mypayfw_add_npr_currencies( $currencies ) {
	$currencies['NPR'] = __( 'Nepali Rupees', 'mypay-for-woocommerce' );
	return $currencies;
}

function mypayfw_add_npr_currencies_symbol( $currency_symbol, $currency ) {
	switch ( $currency ) {
		case 'NPR': 
			$currency_symbol = 'NPR'; 
		break;
	}
	return $currency_symbol;
}