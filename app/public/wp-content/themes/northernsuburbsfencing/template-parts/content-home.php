<?php
/*
@package: wwd blankslate
*/
// var_dump($post);
$attachment = wp_get_attachment_image_src(get_the_ID(), 'full')[0];
?>
<section id="page-<?php the_ID(); ?>" 
        <?php post_class(array('wwd-content-page', $post->post_name)); ?>>
<?php 
    the_content(); 
?>
</section>