<?php

if ( class_exists( 'WooCommerce' ) ) {

  remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
  remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
  remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
  remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
  remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
  remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
  add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

  function woo_remove_product_tabs( $tabs ) {
    unset( $tabs['description'] );
    unset( $tabs['additional_information'] );
    return $tabs;
  }

  // Add AJAX cart support.
  add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
  add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
  function woocommerce_ajax_add_to_cart() {
    ob_start();
    $product_id = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_POST['product_id'] ) );
    $quantity = empty( $_POST['quantity'] ) ? 1 : apply_filters( 'woocommerce_stock_amount', $_POST['quantity'] );
    $variation_id = $_POST['variation_id'];
    $variation  = $_POST['variation'];
    $passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );
    if ( $passed_validation && WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $variation  ) ) {
      do_action( 'woocommerce_ajax_added_to_cart', $product_id );
      if ( get_option( 'woocommerce_cart_redirect_after_add' ) == 'yes' ) {
        wc_add_to_cart_message( $product_id );
      }
      WC_AJAX::get_refreshed_fragments();
    } else {
      $this->json_headers();			
      $data = array(				
        'error' => true,				
        'product_url' => apply_filters( 'woocommerce_cart_redirect_after_error', get_permalink( $product_id ), $product_id ));
        echo json_encode( $data );
      }
    die();
  }

  // Add parameter to emptify cart.
  add_action( 'init', 'woocommerce_clear_cart_url' );
  function woocommerce_clear_cart_url() {
    global $woocommerce;
    
    if ( isset( $_GET['empty-cart'] ) ) {
      $woocommerce->cart->empty_cart(); 
    }
  }

}