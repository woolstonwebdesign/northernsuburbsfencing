<?php
/*
@package: wwd blankslate
**	Post archive
*/
?>

<?php
get_header();
?>

<main id="main" class="site-main" role="main">
    <section <?php post_class(array('gutter')); ?>>
        <h1><?php echo post_type_archive_title(); ?></h1>
<?php
    if (have_posts()):
        while(have_posts()): the_post();
            $template = get_post_type() . (get_post_format() ? '-' . get_post_format() : '');
            //  var_dump($template, $post);
            get_template_part('template-parts/content-archive', $template);
        endwhile;
    endif;
?>
    </section>
</main>
<?php get_footer(); ?>