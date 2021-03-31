<?php
/*
@package: wwd blankslate
*/
// var_dump($post);
$attachment = get_the_post_thumbnail_url(get_the_ID(), 'full');
?>
<main class="site-main" role="main">
    <section id="page-<?php the_ID(); ?>" 
        <?php post_class(array('wwd-content-page', $post->post_name)); ?>>
<?php 
    the_content(); 
?>
    </section>
</main>