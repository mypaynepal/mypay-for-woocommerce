<?php

add_filter( 'woocommerce_gateway_description', 'smartcard_mypay_description_fields', 20, 2 );

function smartcard_mypay_description_fields( $description, $payment_id ) {

    if ( 'mypay' !== $payment_id ) {
        return $description;
    }
    
    ob_start();

    $description .= ob_get_clean();

    return $description;
}
