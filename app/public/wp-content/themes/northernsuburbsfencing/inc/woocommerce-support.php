<?php
/*
@package: wwd blankslate
*/

function wwd_add_woocommerce_support() {
	add_theme_support('woocommerce', array(
        'thumbnail_image_width' => 200,
        'gallery_thumbnail_image_width' => 300,
		'single_image_width'    => 800,

        'product_grid'          => array(
            'default_rows'    => 3,
            'min_rows'        => 2,
            'max_rows'        => 8,
            'default_columns' => 4,
            'min_columns'     => 2,
            'max_columns'     => 5,
       ),
	));
}
add_action('after_setup_theme', 'wwd_add_woocommerce_support');

function wwd_include_font_awesome_css() {
	// Enqueue Font Awesome from a CDN.
	wp_enqueue_style('font-awesome-cdn', get_template_directory_uri() . '/css/line-awesome.min.css');
}
add_action('wp_enqueue_scripts', 'wwd_include_font_awesome_css');

/**
 * Show cart contents / total Ajax
 */
add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
function woocommerce_header_add_to_cart_fragment($fragments) {
	global $woocommerce;
	ob_start();
	?>
	<a class="wwd-cart-total" href="<?php echo wc_get_cart_url();?>">(<?php echo WC()->cart->get_cart_contents_count(); ?>)</a>
	<?php
	$fragments['a.wwd-cart-total'] = ob_get_clean();
	return $fragments;
}

/*
* Show price even if all variations have the same price
*/
function show_price_if_all_variations_same($available_variations, \WC_Product_Variable $variable, \WC_Product_Variation $variation) {
    if (empty($available_variations['price_html'])) {
        $available_variations['price_html'] = '<span class="price">' . $variation->get_price_html() . '</span>';
    }
    return $available_variations;
}
// add_filter('woocommerce_available_variation', 'show_price_if_all_variations_same', 10, 3);

function poa_request_content($variation) {
    $nonce = wp_create_nonce( 'variation_enquiry_'.$variation->ID );
    $html = '<div class="poa-container">';
    $html .= '<h3 class="text-center">We need to talk to you about this selection. Submit your information and we will contact you.</h3>';
    $html .= '<div class="poa-form">';
    $html .= '<form method="post" class="form">';
    $html .= '<div class="form-group">';
    $html .= '    <label for="name">Your Name<span class="form-required">*</span></label>';
    $html .= '    <input type="text" class="form-control" required="required" id="enq-name" name="enq-name">';
    $html .= '</div>';
    $html .= '<div class="form-group">';
    $html .= '    <label for="enq-email">Your Email<span class="form-required">*</span></label>';
    $html .= '    <input type="email" class="form-control" required="required" id="enq-email" name="enq-email">';
    $html .= '</div>';
    $html .= '<div class="form-group">';
    $html .= '    <label for="enq-phone">Your Phone<span class="form-required">*</span></label>';
    $html .= '    <input type="text" class="form-control" required="required" id="enq-phone" name="enq-phone">';
    $html .= '</div>';
    $html .= '<input type="text" value="' . $variation->name . '"/>';
    $html .= '<input type="text" id="_variationnonce" name="_variationnonce" value="' .$nonce. '" />';
    $html .= '<button type="submit" class="md-btn btn-block">Send Us Your Information</button>';
    $html .= '</form>';
    $html .= '</div>';
    $html .= '</div>';
    return $html;
}

// Product Variation displayed prices
add_filter('woocommerce_available_variation', 'zero_price_variation_html', 10, 3);
function zero_price_variation_html($data, $product, $variation) {
    if (0 == $variation->get_price()) {
        $data['price_html'] = poa_request_content($variation); // <=== HERE for empty and zero prices
    }
    return $data;
}

add_filter('woocommerce_variation_is_purchasable', 'remove_add_to_cart_for_zero_price_variations', 10, 2);
function remove_add_to_cart_for_zero_price_variations($purchasable, $product) {
    // For product variations (from variable products)
    if ($product->is_type('variation') && 0 == $product->get_price()) {
        $purchasable = false;
    } 
    return $purchasable;
}

add_filter('woocommerce_is_purchasable', 'remove_add_to_cart_for_tag_id', 10, 2);
add_filter('woocommerce_variation_is_purchasable', 'remove_add_to_cart_for_tag_id', 10, 2);
function remove_add_to_cart_for_tag_id ($purchasable, $product) {
    // For product variations (from variable products)
    if ($product->is_type('variation')) {
        $parent = wc_get_product($product->get_parent_id());
        $tag_ids = $parent->get_tag_ids(); 
    } 
    // For other product types
    else {
        $tag_ids = $product->get_tag_ids();
    }

    if(in_array(181, $tag_ids)) {
        $purchasable = false;
    }

    return $purchasable;
}