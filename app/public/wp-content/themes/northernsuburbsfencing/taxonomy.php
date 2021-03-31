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
    <section <?php echo post_class(); ?>>
<?php
        while(have_posts()): the_post();
            get_template_part('template-parts/content', 'taxonomy');
        endwhile;
?>
    </section>
<?php
    endif;
?>
</main>

<?php get_footer(); ?>