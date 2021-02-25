<?php
/*
@package: wwd blankslate
*/
global $product;
$product_id = $product->get_id();
$product_types = wp_get_object_terms($product_id, 'product_type');
// var_dump(get_post_meta($product_id, 'mwb_wgm_pricing', true));
if ( isset( $product_types[0] ) ) {
    $product_type = $product_types[0]->slug;
    if ( 'wgm_gift_card' == $product_type ) {
        $post_meta = get_post_meta($product_id, 'mwb_wgm_pricing', true);
        $post_prices = explode('|', $post_meta['price']);
        $product_price = $post_prices[0]. ' - $' .$post_prices[count($post_prices)-1];
    } else {
        $product_price = $product->get_price();
    }
}
?>

<article class="product-<?php echo $product->get_id(); ?> product-<?php echo $product->get_slug(); ?> product-type-<?php echo $product->get_type();?> ">
    <div class="product-image"><a href="<?php echo get_the_permalink(); ?>"><?php echo $product->get_image(); ?></a></div>
    <div class="product-meta">
        <div class="product-name"><a href="<?php echo get_the_permalink(); ?>"><?php echo $product->get_name(); ?></a></div>
        <div class="product-price">$<?php echo $product_price; ?></div>
    </div>
</article>
