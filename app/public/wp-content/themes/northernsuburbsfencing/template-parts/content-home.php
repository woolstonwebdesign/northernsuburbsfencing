<?php
/*
@package: wwd blankslate
*/
// var_dump($post);
?>

<?php 
    the_content(); 
?>

<section class="instagram-feed">
    <h3 class="text-center">On the gram</h3>
    <p class="text-center">@materialdifference.com.au</p>
<?php
    echo do_shortcode('[instagram-feed]');
?>
</section>