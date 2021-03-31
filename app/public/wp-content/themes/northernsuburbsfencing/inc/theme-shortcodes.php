<?php

/*
@package: wwd blankslate
*/
add_action( 'init', 'register_shortcodes');

/*  Shortcodes can be found in wwd-theme-functions.php */
function register_shortcodes() {
    add_shortcode('yoast_social', 'yoast_social_links');
    add_shortcode('wwd-template', 'wwd_template_shortcode');
}