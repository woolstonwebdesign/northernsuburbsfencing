<?php
/*
@package: wwd blankslate
**	Post archive
 * @version 4.7.0
*/
?>

<?php
get_header();
$taxonomy = get_queried_object();
// var_dump($taxonomy);
?>

<main id="main" class="site-main" role="main">
<?php
    if (have_posts()):
?>
    <section <?php echo post_class(array('content-page')); ?>>
        <div class="archive-breadcrumb">
            <i class="las la-arrow-circle-left"></i>
            <a href="/shop">Back to Shop</a>
        </div>
        <div class="taxonomy-meta">
            <h2><?php echo $taxonomy->name; ?></h2>
            <p><?php echo $taxonomy->description; ?></p>
        </div>
        <div class="taxonomy-terms category-products">
<?php
        while(have_posts()): the_post();
            get_template_part('template-parts/content', 'product-thumb');
        endwhile;
?>
        </div>
        <div class="archive-breadcrumb">
            <i class="las la-arrow-circle-left"></i>
            <a href="/shop">Back to Shop</a>
        </div>
    </section>
<?php
    endif;
?>
</main>

<?php get_footer(); ?>