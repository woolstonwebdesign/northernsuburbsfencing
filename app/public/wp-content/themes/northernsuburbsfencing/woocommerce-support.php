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
add_filter('woocommerce_available_variation', 'show_price_if_all_variations_same', 10, 3);

// function poa_request_quots() {
//     $html = '<div class="poa">POA</div>';
//     $html .= '<button type="submit" id="trigger_cf" class="single_add_to_cart_button button alt"> Request Price Now </button>';
//     $html .=  '<div id="product_inq">';
//     //$html .= do_shortcode('[contact_form_7_2]');
//     $html .= 'SBW POA';
//     $html .=  '</div>';
//     return $html;
// }
// add_filter('woocommerce_variation_empty_price_html', 'poa_request_quots');

function poa_request_content() {
    $html = '<div class="poa">POA</div>';
    $html .= '<button type="submit" id="trigger_cf" class="single_add_to_cart_button button alt"> Request Price Now </button>';
    $html .=  '<div id="product_inq">';
    //$html .= do_shortcode('[contact_form_7_2]');
    $html .= 'SBW POA';
    $html .=  '</div>';
    return $html;    
}

// Variable and simple product displayed prices
add_filter( 'woocommerce_get_price_html', 'empty_and_zero_price_html', 20, 2 );
function empty_and_zero_price_html( $price, $product ) {

    if( $product->is_type('variable') )
    {
        $prices = $product->get_variation_prices( true );

        if ( empty( $prices['price'] ) ) {
            return poa_request_content(); // <=== HERE below for empty price
        } else {
            $min_price     = current( $prices['price'] );
            $max_price     = end( $prices['price'] );
            if ( $min_price === $max_price && 0 == $min_price ) {
                return poa_request_content(); // <=== HERE for zero price
            }
            elseif ( $min_price !== $max_price && 0 == $min_price ) {
                return wc_price( $max_price );
            }
        }
    }
    elseif( $product->is_type('simple') )
    {
        if ( '' === $product->get_price() || 0 == $product->get_price() ) {
            return poa_request_content(); // <=== HERE for empty and zero prices
        }
    }
    return $price;
}

// Product Variation displayed prices
add_filter( 'woocommerce_available_variation', 'empty_and_zero_variation_prices_html', 10, 3);
function empty_and_zero_variation_prices_html( $data, $product, $variation ) {

    var_dump($variation);
    if( '' === $variation->get_price() || 0 == $variation->get_price() )
        $data['price_html'] = poa_request_content(); // <=== HERE for empty and zero prices

    return $data;
}