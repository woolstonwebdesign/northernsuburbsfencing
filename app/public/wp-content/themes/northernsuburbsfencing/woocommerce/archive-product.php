<?php
/*
@package: wwd blankslate
**	Post archive
 * @version 4.7.0
*/

get_header();
?>

<main id="main" class="site-main" role="main">
<?php
$hero = new WP_Query(array(
    'post_type' => 'layout',
    'post_status' => 'publish',
    'posts_per_page' => 1,
    'tax_query' => array(
        array(
            'taxonomy'         => 'builder-component',
            'field'            => 'slug', // Or 'term_id' or 'name'
            'terms'            => 'shop-hero', // A slug term
        )
    )
));
if ($hero->have_posts()):
    while($hero->have_posts()): $hero->the_post();
        the_content();
    endwhile;
endif;
wp_reset_query();
?>
<?php
$categories = get_terms('product_cat', array(
    'hide_empty' => true
));
foreach($categories as $category):
    // var_dump($category);
?>
    <section class="product-category">
        <article class="product-category-content">
            <h4><a href="/product-category/<?php echo $category->slug; ?>"><?php echo $category->name; ?></a></h4>
            <div class="category-meta">
                <div class="category-description">
                    <?php echo $category->description; ?>
                </div>
                <div class="category-products">
                    <div class="category-product-list">
<?php
$products = new WP_Query(array(
    'post_type' => 'product',
    'post_status' => 'publish',
    'posts_per_page' => 3,
    'tax_query' => array(
        array(
            'taxonomy'         => 'product_cat',
            'field'            => 'slug', // Or 'term_id' or 'name'
            'terms'            => $category->slug, // A slug term
            // 'include_children' => false // or true (optional)
        )
    ),
    'orderby' => 'rand',
    'order' => 'ASC'
));
if ($products->have_posts()):
    while($products->have_posts()): $products->the_post();
        echo do_shortcode('[wwd-template template_name="content-product-thumb"]');
    endwhile;
endif;
wp_reset_query();
?>
                    </div>
                    <div class="more-products">
                        <a href="/product-category/<?php echo $category->slug; ?>/">
                            <i class="las la-angle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </article>
    </section>
<?php
endforeach;
?>
</main>
<?php
get_footer();
?>